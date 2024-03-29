<?php
/**
 * OpenStack Swift based file backend.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup FileBackend
 * @author Russ Nelson
 * @author Aaron Schulz
 */

/**
 * @brief Class for an OpenStack Swift (or Ceph RGW) based file backend.
 *
 * Status messages should avoid mentioning the Swift account name.
 * Likewise, error suppression should be used to avoid path disclosure.
 *
 * @ingroup FileBackend
 * @since 1.19
 */
class SwiftFileBackend extends FileBackendStore {
	/** @var MultiHttpClient */
	protected $http;

	/** @var int TTL in seconds */
	protected $authTTL;

	/** @var string Authentication base URL (without version) */
	protected $swiftAuthUrl;

	/** @var string Swift user (account:user) to authenticate as */
	protected $swiftUser;

	/** @var string Secret key for user */
	protected $swiftKey;

	/** @var string Shared secret value for making temp URLs */
	protected $swiftTempUrlKey;

	/** @var string S3 access key (RADOS Gateway) */
	protected $rgwS3AccessKey;

	/** @var string S3 authentication key (RADOS Gateway) */
	protected $rgwS3SecretKey;

	/** @var BagOStuff */
	protected $srvCache;

	/** @var ProcessCacheLRU Container stat cache */
	protected $containerStatCache;

	/** @var array */
	protected $authCreds;

	/** @var int UNIX timestamp */
	protected $authSessionTimestamp = 0;

	/** @var int UNIX timestamp */
	protected $authErrorTimestamp = null;

	/** @var bool Whether the server is an Ceph RGW */
	protected $isRGW = false;

	/**
	 * @see FileBackendStore::__construct()
	 * Additional $config params include:
	 *   - swiftAuthUrl       : Swift authentication server URL
	 *   - swiftUser          : Swift user used by MediaWiki (account:username)
	 *   - swiftKey           : Swift authentication key for the above user
	 *   - swiftAuthTTL       : Swift authentication TTL (seconds)
	 *   - swiftTempUrlKey    : Swift "X-Account-Meta-Temp-URL-Key" value on the account.
	 *                          Do not set this until it has been set in the backend.
	 *   - shardViaHashLevels : Map of container names to sharding config with:
	 *                             - base   : base of hash characters, 16 or 36
	 *                             - levels : the number of hash levels (and digits)
	 *                             - repeat : hash subdirectories are prefixed with all the
	 *                                        parent hash directory names (e.g. "a/ab/abc")
	 *   - cacheAuthInfo      : Whether to cache authentication tokens in APC, XCache, ect.
	 *                          If those are not available, then the main cache will be used.
	 *                          This is probably insecure in shared hosting environments.
	 *   - rgwS3AccessKey     : Rados Gateway S3 "access key" value on the account.
	 *                          Do not set this until it has been set in the backend.
	 *                          This is used for generating expiring pre-authenticated URLs.
	 *                          Only use this when using rgw and to work around
	 *                          http://tracker.newdream.net/issues/3454.
	 *   - rgwS3SecretKey     : Rados Gateway S3 "secret key" value on the account.
	 *                          Do not set this until it has been set in the backend.
	 *                          This is used for generating expiring pre-authenticated URLs.
	 *                          Only use this when using rgw and to work around
	 *                          http://tracker.newdream.net/issues/3454.
	 */
	public function __construct( array $config ) {
		parent::__construct( $config );
		// Required settings
		$this->swiftAuthUrl = $config['swiftAuthUrl'];
		$this->swiftUser = $config['swiftUser'];
		$this->swiftKey = $config['swiftKey'];
		// Optional settings
		$this->authTTL = isset( $config['swiftAuthTTL'] )
			? $config['swiftAuthTTL']
			: 5 * 60; // some sane number
		$this->swiftTempUrlKey = isset( $config['swiftTempUrlKey'] )
			? $config['swiftTempUrlKey']
			: '';
		$this->shardViaHashLevels = isset( $config['shardViaHashLevels'] )
			? $config['shardViaHashLevels']
			: '';
		$this->rgwS3AccessKey = isset( $config['rgwS3AccessKey'] )
			? $config['rgwS3AccessKey']
			: '';
		$this->rgwS3SecretKey = isset( $config['rgwS3SecretKey'] )
			? $config['rgwS3SecretKey']
			: '';
		// HTTP helper client
		$this->http = new MultiHttpClient( array() );
		// Cache container information to mask latency
		$this->memCache = wfGetMainCache();
		// Process cache for container info
		$this->containerStatCache = new ProcessCacheLRU( 300 );
		// Cache auth token information to avoid RTTs
		if ( !empty( $config['cacheAuthInfo'] ) ) {
			if ( PHP_SAPI === 'cli' ) {
				$this->srvCache = wfGetMainCache(); // preferrably memcached
			} else {
				try { // look for APC, XCache, WinCache, ect...
					$this->srvCache = ObjectCache::newAccelerator( array() );
				} catch ( Exception $e ) {
				}
			}
		}
		$this->srvCache = $this->srvCache ?: new EmptyBagOStuff();
	}

	public function getFeatures() {
		return ( FileBackend::ATTR_HEADERS | FileBackend::ATTR_METADATA );
	}

	protected function resolveContainerPath( $container, $relStoragePath ) {
		if ( !mb_check_encoding( $relStoragePath, 'UTF-8' ) ) { // mb_string required by CF
			return null; // not UTF-8, makes it hard to use CF and the swift HTTP API
		} elseif ( strlen( urlencode( $relStoragePath ) ) > 1024 ) {
			return null; // too long for Swift
		}

		return $relStoragePath;
	}

	public function isPathUsableInternal( $storagePath ) {
		list( $container, $rel ) = $this->resolveStoragePathReal( $storagePath );
		if ( $rel === null ) {
			return false; // invalid
		}

		return is_array( $this->getContainerStat( $container ) );
	}

	/**
	 * Sanitize and filter the custom headers from a $params array.
	 * We only allow certain Content- and X-Content- headers.
	 *
	 * @param array $headers
	 * @return array Sanitized value of 'headers' field in $params
	 */
	protected function sanitizeHdrs( array $params ) {
		$headers = array();

		// Normalize casing, and strip out illegal headers
		if ( isset( $params['headers'] ) ) {
			foreach ( $params['headers'] as $name => $value ) {
				$name = strtolower( $name );
				if ( preg_match( '/^content-(type|length)$/', $name ) ) {
					continue; // blacklisted
				} elseif ( preg_match( '/^(x-)?content-/', $name ) ) {
					$headers[$name] = $value; // allowed
				} elseif ( preg_match( '/^content-(disposition)/', $name ) ) {
					$headers[$name] = $value; // allowed
				}
			}
		}
		// By default, Swift has annoyingly low maximum header value limits
		if ( isset( $headers['content-disposition'] ) ) {
			$disposition = '';
			foreach ( explode( ';', $headers['content-disposition'] ) as $part ) {
				$part = trim( $part );
				$new = ( $disposition === '' ) ? $part : "{$disposition};{$part}";
				if ( strlen( $new ) <= 255 ) {
					$disposition = $new;
				} else {
					break; // too long; sigh
				}
			}
			$headers['content-disposition'] = $disposition;
		}

		return $headers;
	}

	protected function doCreateInternal( array $params ) {
		$status = Status::newGood();

		list( $dstCont, $dstRel ) = $this->resolveStoragePathReal( $params['dst'] );
		if ( $dstRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['dst'] );

			return $status;
		}

		$sha1Hash = wfBaseConvert( sha1( $params['content'] ), 16, 36, 31 );
		$contentType = $this->getContentType( $params['dst'], $params['content'], null );

		$reqs = array( array(
			'method' => 'PUT',
			'url' => array( $dstCont, $dstRel ),
			'headers' => array(
				'content-length' => strlen( $params['content'] ),
				'etag' => md5( $params['content'] ),
				'content-type' => $contentType,
				'x-object-meta-sha1base36' => $sha1Hash
			) + $this->sanitizeHdrs( $params ),
			'body' => $params['content']
		) );

		$be = $this;
		$method = __METHOD__;
		$handler = function ( array $request, Status $status ) use ( $be, $method, $params ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $request['response'];
			if ( $rcode === 201 ) {
				// good
			} elseif ( $rcode === 412 ) {
				$status->fatal( 'backend-fail-contenttype', $params['dst'] );
			} else {
				$be->onError( $status, $method, $params, $rerr, $rcode, $rdesc );
			}
		};

		$opHandle = new SwiftFileOpHandle( $this, $handler, $reqs );
		if ( !empty( $params['async'] ) ) { // deferred
			$status->value = $opHandle;
		} else { // actually write the object in Swift
			$status->merge( current( $this->doExecuteOpHandlesInternal( array( $opHandle ) ) ) );
		}

		return $status;
	}

	protected function doStoreInternal( array $params ) {
		$status = Status::newGood();

		list( $dstCont, $dstRel ) = $this->resolveStoragePathReal( $params['dst'] );
		if ( $dstRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['dst'] );

			return $status;
		}

		wfSuppressWarnings();
		$sha1Hash = sha1_file( $params['src'] );
		wfRestoreWarnings();
		if ( $sha1Hash === false ) { // source doesn't exist?
			$status->fatal( 'backend-fail-store', $params['src'], $params['dst'] );

			return $status;
		}
		$sha1Hash = wfBaseConvert( $sha1Hash, 16, 36, 31 );
		$contentType = $this->getContentType( $params['dst'], null, $params['src'] );

		$handle = fopen( $params['src'], 'rb' );
		if ( $handle === false ) { // source doesn't exist?
			$status->fatal( 'backend-fail-store', $params['src'], $params['dst'] );

			return $status;
		}

		$reqs = array( array(
			'method' => 'PUT',
			'url' => array( $dstCont, $dstRel ),
			'headers' => array(
				'content-length' => filesize( $params['src'] ),
				'etag' => md5_file( $params['src'] ),
				'content-type' => $contentType,
				'x-object-meta-sha1base36' => $sha1Hash
			) + $this->sanitizeHdrs( $params ),
			'body' => $handle // resource
		) );

		$be = $this;
		$method = __METHOD__;
		$handler = function ( array $request, Status $status ) use ( $be, $method, $params ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $request['response'];
			if ( $rcode === 201 ) {
				// good
			} elseif ( $rcode === 412 ) {
				$status->fatal( 'backend-fail-contenttype', $params['dst'] );
			} else {
				$be->onError( $status, $method, $params, $rerr, $rcode, $rdesc );
			}
		};

		$opHandle = new SwiftFileOpHandle( $this, $handler, $reqs );
		if ( !empty( $params['async'] ) ) { // deferred
			$status->value = $opHandle;
		} else { // actually write the object in Swift
			$status->merge( current( $this->doExecuteOpHandlesInternal( array( $opHandle ) ) ) );
		}

		return $status;
	}

	protected function doCopyInternal( array $params ) {
		$status = Status::newGood();

		list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $params['src'] );
		if ( $srcRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['src'] );

			return $status;
		}

		list( $dstCont, $dstRel ) = $this->resolveStoragePathReal( $params['dst'] );
		if ( $dstRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['dst'] );

			return $status;
		}

		$reqs = array( array(
			'method' => 'PUT',
			'url' => array( $dstCont, $dstRel ),
			'headers' => array(
				'x-copy-from' => '/' . rawurlencode( $srcCont ) .
					'/' . str_replace( "%2F", "/", rawurlencode( $srcRel ) )
			) + $this->sanitizeHdrs( $params ), // extra headers merged into object
		) );

		$be = $this;
		$method = __METHOD__;
		$handler = function ( array $request, Status $status ) use ( $be, $method, $params ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $request['response'];
			if ( $rcode === 201 ) {
				// good
			} elseif ( $rcode === 404 ) {
				$status->fatal( 'backend-fail-copy', $params['src'], $params['dst'] );
			} else {
				$be->onError( $status, $method, $params, $rerr, $rcode, $rdesc );
			}
		};

		$opHandle = new SwiftFileOpHandle( $this, $handler, $reqs );
		if ( !empty( $params['async'] ) ) { // deferred
			$status->value = $opHandle;
		} else { // actually write the object in Swift
			$status->merge( current( $this->doExecuteOpHandlesInternal( array( $opHandle ) ) ) );
		}

		return $status;
	}

	protected function doMoveInternal( array $params ) {
		$status = Status::newGood();

		list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $params['src'] );
		if ( $srcRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['src'] );

			return $status;
		}

		list( $dstCont, $dstRel ) = $this->resolveStoragePathReal( $params['dst'] );
		if ( $dstRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['dst'] );

			return $status;
		}

		$reqs = array(
			array(
				'method' => 'PUT',
				'url' => array( $dstCont, $dstRel ),
				'headers' => array(
					'x-copy-from' => '/' . rawurlencode( $srcCont ) .
						'/' . str_replace( "%2F", "/", rawurlencode( $srcRel ) )
				) + $this->sanitizeHdrs( $params ) // extra headers merged into object
			)
		);
		if ( "{$srcCont}/{$srcRel}" !== "{$dstCont}/{$dstRel}" ) {
			$reqs[] = array(
				'method' => 'DELETE',
				'url' => array( $srcCont, $srcRel ),
				'headers' => array()
			);
		}

		$be = $this;
		$method = __METHOD__;
		$handler = function ( array $request, Status $status ) use ( $be, $method, $params ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $request['response'];
			if ( $request['method'] === 'PUT' && $rcode === 201 ) {
				// good
			} elseif ( $request['method'] === 'DELETE' && $rcode === 204 ) {
				// good
			} elseif ( $rcode === 404 ) {
				$status->fatal( 'backend-fail-move', $params['src'], $params['dst'] );
			} else {
				$be->onError( $status, $method, $params, $rerr, $rcode, $rdesc );
			}
		};

		$opHandle = new SwiftFileOpHandle( $this, $handler, $reqs );
		if ( !empty( $params['async'] ) ) { // deferred
			$status->value = $opHandle;
		} else { // actually move the object in Swift
			$status->merge( current( $this->doExecuteOpHandlesInternal( array( $opHandle ) ) ) );
		}

		return $status;
	}

	protected function doDeleteInternal( array $params ) {
		$status = Status::newGood();

		list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $params['src'] );
		if ( $srcRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['src'] );

			return $status;
		}

		$reqs = array( array(
			'method' => 'DELETE',
			'url' => array( $srcCont, $srcRel ),
			'headers' => array()
		) );

		$be = $this;
		$method = __METHOD__;
		$handler = function ( array $request, Status $status ) use ( $be, $method, $params ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $request['response'];
			if ( $rcode === 204 ) {
				// good
			} elseif ( $rcode === 404 ) {
				if ( empty( $params['ignoreMissingSource'] ) ) {
					$status->fatal( 'backend-fail-delete', $params['src'] );
				}
			} else {
				$be->onError( $status, $method, $params, $rerr, $rcode, $rdesc );
			}
		};

		$opHandle = new SwiftFileOpHandle( $this, $handler, $reqs );
		if ( !empty( $params['async'] ) ) { // deferred
			$status->value = $opHandle;
		} else { // actually delete the object in Swift
			$status->merge( current( $this->doExecuteOpHandlesInternal( array( $opHandle ) ) ) );
		}

		return $status;
	}

	protected function doDescribeInternal( array $params ) {
		$status = Status::newGood();

		list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $params['src'] );
		if ( $srcRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['src'] );

			return $status;
		}

		// Fetch the old object headers/metadata...this should be in stat cache by now
		$stat = $this->getFileStat( array( 'src' => $params['src'], 'latest' => 1 ) );
		if ( $stat && !isset( $stat['xattr'] ) ) { // older cache entry
			$stat = $this->doGetFileStat( array( 'src' => $params['src'], 'latest' => 1 ) );
		}
		if ( !$stat ) {
			$status->fatal( 'backend-fail-describe', $params['src'] );

			return $status;
		}

		// POST clears prior headers, so we need to merge the changes in to the old ones
		$metaHdrs = array();
		foreach ( $stat['xattr']['metadata'] as $name => $value ) {
			$metaHdrs["x-object-meta-$name"] = $value;
		}
		$customHdrs = $this->sanitizeHdrs( $params ) + $stat['xattr']['headers'];

		$reqs = array( array(
			'method' => 'POST',
			'url' => array( $srcCont, $srcRel ),
			'headers' => $metaHdrs + $customHdrs
		) );

		$be = $this;
		$method = __METHOD__;
		$handler = function ( array $request, Status $status ) use ( $be, $method, $params ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $request['response'];
			if ( $rcode === 202 ) {
				// good
			} elseif ( $rcode === 404 ) {
				$status->fatal( 'backend-fail-describe', $params['src'] );
			} else {
				$be->onError( $status, $method, $params, $rerr, $rcode, $rdesc );
			}
		};

		$opHandle = new SwiftFileOpHandle( $this, $handler, $reqs );
		if ( !empty( $params['async'] ) ) { // deferred
			$status->value = $opHandle;
		} else { // actually change the object in Swift
			$status->merge( current( $this->doExecuteOpHandlesInternal( array( $opHandle ) ) ) );
		}

		return $status;
	}

	protected function doPrepareInternal( $fullCont, $dir, array $params ) {
		$status = Status::newGood();

		// (a) Check if container already exists
		$stat = $this->getContainerStat( $fullCont );
		if ( is_array( $stat ) ) {
			return $status; // already there
		} elseif ( $stat === null ) {
			$status->fatal( 'backend-fail-internal', $this->name );

			return $status;
		}

		// (b) Create container as needed with proper ACLs
		if ( $stat === false ) {
			$params['op'] = 'prepare';
			$status->merge( $this->createContainer( $fullCont, $params ) );
		}

		return $status;
	}

	protected function doSecureInternal( $fullCont, $dir, array $params ) {
		$status = Status::newGood();
		if ( empty( $params['noAccess'] ) ) {
			return $status; // nothing to do
		}

		$stat = $this->getContainerStat( $fullCont );
		if ( is_array( $stat ) ) {
			// Make container private to end-users...
			$status->merge( $this->setContainerAccess(
				$fullCont,
				array( $this->swiftUser ), // read
				array( $this->swiftUser ) // write
			) );
		} elseif ( $stat === false ) {
			$status->fatal( 'backend-fail-usable', $params['dir'] );
		} else {
			$status->fatal( 'backend-fail-internal', $this->name );
		}

		return $status;
	}

	protected function doPublishInternal( $fullCont, $dir, array $params ) {
		$status = Status::newGood();

		$stat = $this->getContainerStat( $fullCont );
		if ( is_array( $stat ) ) {
			// Make container public to end-users...
			$status->merge( $this->setContainerAccess(
				$fullCont,
				array( $this->swiftUser, '.r:*' ), // read
				array( $this->swiftUser ) // write
			) );
		} elseif ( $stat === false ) {
			$status->fatal( 'backend-fail-usable', $params['dir'] );
		} else {
			$status->fatal( 'backend-fail-internal', $this->name );
		}

		return $status;
	}

	protected function doCleanInternal( $fullCont, $dir, array $params ) {
		$status = Status::newGood();

		// Only containers themselves can be removed, all else is virtual
		if ( $dir != '' ) {
			return $status; // nothing to do
		}

		// (a) Check the container
		$stat = $this->getContainerStat( $fullCont, true );
		if ( $stat === false ) {
			return $status; // ok, nothing to do
		} elseif ( !is_array( $stat ) ) {
			$status->fatal( 'backend-fail-internal', $this->name );

			return $status;
		}

		// (b) Delete the container if empty
		if ( $stat['count'] == 0 ) {
			$params['op'] = 'clean';
			$status->merge( $this->deleteContainer( $fullCont, $params ) );
		}

		return $status;
	}

	protected function doGetFileStat( array $params ) {
		$params = array( 'srcs' => array( $params['src'] ), 'concurrency' => 1 ) + $params;
		unset( $params['src'] );
		$stats = $this->doGetFileStatMulti( $params );

		return reset( $stats );
	}

	/**
	 * Convert dates like "Tue, 03 Jan 2012 22:01:04 GMT"/"2013-05-11T07:37:27.678360Z".
	 * Dates might also come in like "2013-05-11T07:37:27.678360" from Swift listings,
	 * missing the timezone suffix (though Ceph RGW does not appear to have this bug).
	 *
	 * @param string $ts
	 * @param int $format Output format (TS_* constant)
	 * @return string
	 * @throws FileBackendError
	 */
	protected function convertSwiftDate( $ts, $format = TS_MW ) {
		try {
			$timestamp = new MWTimestamp( $ts );

			return $timestamp->getTimestamp( $format );
		} catch ( MWException $e ) {
			throw new FileBackendError( $e->getMessage() );
		}
	}

	/**
	 * Fill in any missing object metadata and save it to Swift
	 *
	 * @param array $objHdrs Object response headers
	 * @param string $path Storage path to object
	 * @return array New headers
	 */
	protected function addMissingMetadata( array $objHdrs, $path ) {
		if ( isset( $objHdrs['x-object-meta-sha1base36'] ) ) {
			return $objHdrs; // nothing to do
		}

		$section = new ProfileSection( __METHOD__ . '-' . $this->name );
		trigger_error( "$path was not stored with SHA-1 metadata.", E_USER_WARNING );

		$auth = $this->getAuthentication();
		if ( !$auth ) {
			$objHdrs['x-object-meta-sha1base36'] = false;

			return $objHdrs; // failed
		}

		$status = Status::newGood();
		$scopeLockS = $this->getScopedFileLocks( array( $path ), LockManager::LOCK_UW, $status );
		if ( $status->isOK() ) {
			$tmpFile = $this->getLocalCopy( array( 'src' => $path, 'latest' => 1 ) );
			if ( $tmpFile ) {
				$hash = $tmpFile->getSha1Base36();
				if ( $hash !== false ) {
					$objHdrs['x-object-meta-sha1base36'] = $hash;
					list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $path );
					list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
						'method' => 'POST',
						'url' => $this->storageUrl( $auth, $srcCont, $srcRel ),
						'headers' => $this->authTokenHeaders( $auth ) + $objHdrs
					) );
					if ( $rcode >= 200 && $rcode <= 299 ) {
						return $objHdrs; // success
					}
				}
			}
		}
		trigger_error( "Unable to set SHA-1 metadata for $path", E_USER_WARNING );
		$objHdrs['x-object-meta-sha1base36'] = false;

		return $objHdrs; // failed
	}

	protected function doGetFileContentsMulti( array $params ) {
		$contents = array();

		$auth = $this->getAuthentication();

		$ep = array_diff_key( $params, array( 'srcs' => 1 ) ); // for error logging
		// Blindly create tmp files and stream to them, catching any exception if the file does
		// not exist. Doing stats here is useless and will loop infinitely in addMissingMetadata().
		$reqs = array(); // (path => op)

		foreach ( $params['srcs'] as $path ) { // each path in this concurrent batch
			list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $path );
			if ( $srcRel === null || !$auth ) {
				$contents[$path] = false;
				continue;
			}
			// Create a new temporary memory file...
			$handle = fopen( 'php://temp', 'wb' );
			if ( $handle ) {
				$reqs[$path] = array(
					'method'  => 'GET',
					'url'     => $this->storageUrl( $auth, $srcCont, $srcRel ),
					'headers' => $this->authTokenHeaders( $auth )
						+ $this->headersFromParams( $params ),
					'stream'  => $handle,
				);
			}
			$contents[$path] = false;
		}

		$opts = array( 'maxConnsPerHost' => $params['concurrency'] );
		$reqs = $this->http->runMulti( $reqs, $opts );
		foreach ( $reqs as $path => $op ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $op['response'];
			if ( $rcode >= 200 && $rcode <= 299 ) {
				rewind( $op['stream'] ); // start from the beginning
				$contents[$path] = stream_get_contents( $op['stream'] );
			} elseif ( $rcode === 404 ) {
				$contents[$path] = false;
			} else {
				$this->onError( null, __METHOD__,
					array( 'src' => $path ) + $ep, $rerr, $rcode, $rdesc );
			}
			fclose( $op['stream'] ); // close open handle
		}

		return $contents;
	}

	protected function doDirectoryExists( $fullCont, $dir, array $params ) {
		$prefix = ( $dir == '' ) ? null : "{$dir}/";
		$status = $this->objectListing( $fullCont, 'names', 1, null, $prefix );
		if ( $status->isOk() ) {
			return ( count( $status->value ) ) > 0;
		}

		return null; // error
	}

	/**
	 * @see FileBackendStore::getDirectoryListInternal()
	 * @param string $fullCont
	 * @param string $dir
	 * @param array $params
	 * @return SwiftFileBackendDirList
	 */
	public function getDirectoryListInternal( $fullCont, $dir, array $params ) {
		return new SwiftFileBackendDirList( $this, $fullCont, $dir, $params );
	}

	/**
	 * @see FileBackendStore::getFileListInternal()
	 * @param string $fullCont
	 * @param string $dir
	 * @param array $params
	 * @return SwiftFileBackendFileList
	 */
	public function getFileListInternal( $fullCont, $dir, array $params ) {
		return new SwiftFileBackendFileList( $this, $fullCont, $dir, $params );
	}

	/**
	 * Do not call this function outside of SwiftFileBackendFileList
	 *
	 * @param string $fullCont Resolved container name
	 * @param string $dir Resolved storage directory with no trailing slash
	 * @param string|null $after Resolved container relative path to list items after
	 * @param int $limit Max number of items to list
	 * @param array $params Parameters for getDirectoryList()
	 * @return array List of container relative resolved paths of directories directly under $dir
	 * @throws FileBackendError
	 */
	public function getDirListPageInternal( $fullCont, $dir, &$after, $limit, array $params ) {
		$dirs = array();
		if ( $after === INF ) {
			return $dirs; // nothing more
		}

		$section = new ProfileSection( __METHOD__ . '-' . $this->name );

		$prefix = ( $dir == '' ) ? null : "{$dir}/";
		// Non-recursive: only list dirs right under $dir
		if ( !empty( $params['topOnly'] ) ) {
			$status = $this->objectListing( $fullCont, 'names', $limit, $after, $prefix, '/' );
			if ( !$status->isOk() ) {
				return $dirs; // error
			}
			$objects = $status->value;
			foreach ( $objects as $object ) { // files and directories
				if ( substr( $object, -1 ) === '/' ) {
					$dirs[] = $object; // directories end in '/'
				}
			}
		} else {
			// Recursive: list all dirs under $dir and its subdirs
			$getParentDir = function ( $path ) {
				return ( strpos( $path, '/' ) !== false ) ? dirname( $path ) : false;
			};

			// Get directory from last item of prior page
			$lastDir = $getParentDir( $after ); // must be first page
			$status = $this->objectListing( $fullCont, 'names', $limit, $after, $prefix );

			if ( !$status->isOk() ) {
				return $dirs; // error
			}

			$objects = $status->value;

			foreach ( $objects as $object ) { // files
				$objectDir = $getParentDir( $object ); // directory of object

				if ( $objectDir !== false && $objectDir !== $dir ) {
					// Swift stores paths in UTF-8, using binary sorting.
					// See function "create_container_table" in common/db.py.
					// If a directory is not "greater" than the last one,
					// then it was already listed by the calling iterator.
					if ( strcmp( $objectDir, $lastDir ) > 0 ) {
						$pDir = $objectDir;
						do { // add dir and all its parent dirs
							$dirs[] = "{$pDir}/";
							$pDir = $getParentDir( $pDir );
						} while ( $pDir !== false // sanity
							&& strcmp( $pDir, $lastDir ) > 0 // not done already
							&& strlen( $pDir ) > strlen( $dir ) // within $dir
						);
					}
					$lastDir = $objectDir;
				}
			}
		}
		// Page on the unfiltered directory listing (what is returned may be filtered)
		if ( count( $objects ) < $limit ) {
			$after = INF; // avoid a second RTT
		} else {
			$after = end( $objects ); // update last item
		}

		return $dirs;
	}

	/**
	 * Do not call this function outside of SwiftFileBackendFileList
	 *
	 * @param string $fullCont Resolved container name
	 * @param string $dir Resolved storage directory with no trailing slash
	 * @param string|null $after Resolved container relative path of file to list items after
	 * @param int $limit Max number of items to list
	 * @param array $params Parameters for getDirectoryList()
	 * @return array List of resolved container relative paths of files under $dir
	 * @throws FileBackendError
	 */
	public function getFileListPageInternal( $fullCont, $dir, &$after, $limit, array $params ) {
		$files = array(); // list of (path, stat array or null) entries
		if ( $after === INF ) {
			return $files; // nothing more
		}

		$section = new ProfileSection( __METHOD__ . '-' . $this->name );

		$prefix = ( $dir == '' ) ? null : "{$dir}/";
		// $objects will contain a list of unfiltered names or CF_Object items
		// Non-recursive: only list files right under $dir
		if ( !empty( $params['topOnly'] ) ) {
			if ( !empty( $params['adviseStat'] ) ) {
				$status = $this->objectListing( $fullCont, 'info', $limit, $after, $prefix, '/' );
			} else {
				$status = $this->objectListing( $fullCont, 'names', $limit, $after, $prefix, '/' );
			}
		} else {
			// Recursive: list all files under $dir and its subdirs
			if ( !empty( $params['adviseStat'] ) ) {
				$status = $this->objectListing( $fullCont, 'info', $limit, $after, $prefix );
			} else {
				$status = $this->objectListing( $fullCont, 'names', $limit, $after, $prefix );
			}
		}

		// Reformat this list into a list of (name, stat array or null) entries
		if ( !$status->isOk() ) {
			return $files; // error
		}

		$objects = $status->value;
		$files = $this->buildFileObjectListing( $params, $dir, $objects );

		// Page on the unfiltered object listing (what is returned may be filtered)
		if ( count( $objects ) < $limit ) {
			$after = INF; // avoid a second RTT
		} else {
			$after = end( $objects ); // update last item
			$after = is_object( $after ) ? $after->name : $after;
		}

		return $files;
	}

	/**
	 * Build a list of file objects, filtering out any directories
	 * and extracting any stat info if provided in $objects (for CF_Objects)
	 *
	 * @param array $params Parameters for getDirectoryList()
	 * @param string $dir Resolved container directory path
	 * @param array $objects List of CF_Object items or object names
	 * @return array List of (names,stat array or null) entries
	 */
	private function buildFileObjectListing( array $params, $dir, array $objects ) {
		$names = array();
		foreach ( $objects as $object ) {
			if ( is_object( $object ) ) {
				if ( isset( $object->subdir ) || !isset( $object->name ) ) {
					continue; // virtual directory entry; ignore
				}
				$stat = array(
					// Convert various random Swift dates to TS_MW
					'mtime'  => $this->convertSwiftDate( $object->last_modified, TS_MW ),
					'size'   => (int)$object->bytes,
					// Note: manifiest ETags are not an MD5 of the file
					'md5'    => ctype_xdigit( $object->hash ) ? $object->hash : null,
					'latest' => false // eventually consistent
				);
				$names[] = array( $object->name, $stat );
			} elseif ( substr( $object, -1 ) !== '/' ) {
				// Omit directories, which end in '/' in listings
				$names[] = array( $object, null );
			}
		}

		return $names;
	}

	/**
	 * Do not call this function outside of SwiftFileBackendFileList
	 *
	 * @param string $path Storage path
	 * @param array $val Stat value
	 */
	public function loadListingStatInternal( $path, array $val ) {
		$this->cheapCache->set( $path, 'stat', $val );
	}

	protected function doGetFileXAttributes( array $params ) {
		$stat = $this->getFileStat( $params );
		if ( $stat ) {
			if ( !isset( $stat['xattr'] ) ) {
				// Stat entries filled by file listings don't include metadata/headers
				$this->clearCache( array( $params['src'] ) );
				$stat = $this->getFileStat( $params );
			}

			return $stat['xattr'];
		} else {
			return false;
		}
	}

	protected function doGetFileSha1base36( array $params ) {
		$stat = $this->getFileStat( $params );
		if ( $stat ) {
			if ( !isset( $stat['sha1'] ) ) {
				// Stat entries filled by file listings don't include SHA1
				$this->clearCache( array( $params['src'] ) );
				$stat = $this->getFileStat( $params );
			}

			return $stat['sha1'];
		} else {
			return false;
		}
	}

	protected function doStreamFile( array $params ) {
		$status = Status::newGood();

		list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $params['src'] );
		if ( $srcRel === null ) {
			$status->fatal( 'backend-fail-invalidpath', $params['src'] );
		}

		$auth = $this->getAuthentication();
		if ( !$auth || !is_array( $this->getContainerStat( $srcCont ) ) ) {
			$status->fatal( 'backend-fail-stream', $params['src'] );

			return $status;
		}

		$handle = fopen( 'php://output', 'wb' );

		list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
			'method' => 'GET',
			'url' => $this->storageUrl( $auth, $srcCont, $srcRel ),
			'headers' => $this->authTokenHeaders( $auth )
				+ $this->headersFromParams( $params ),
			'stream' => $handle,
		) );

		if ( $rcode >= 200 && $rcode <= 299 ) {
			// good
		} elseif ( $rcode === 404 ) {
			$status->fatal( 'backend-fail-stream', $params['src'] );
		} else {
			$this->onError( $status, __METHOD__, $params, $rerr, $rcode, $rdesc );
		}

		return $status;
	}

	protected function doGetLocalCopyMulti( array $params ) {
		$tmpFiles = array();

		$auth = $this->getAuthentication();

		$ep = array_diff_key( $params, array( 'srcs' => 1 ) ); // for error logging
		// Blindly create tmp files and stream to them, catching any exception if the file does
		// not exist. Doing a stat here is useless causes infinite loops in addMissingMetadata().
		$reqs = array(); // (path => op)

		foreach ( $params['srcs'] as $path ) { // each path in this concurrent batch
			list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $path );
			if ( $srcRel === null || !$auth ) {
				$tmpFiles[$path] = null;
				continue;
			}
			// Get source file extension
			$ext = FileBackend::extensionFromPath( $path );
			// Create a new temporary file...
			$tmpFile = TempFSFile::factory( 'localcopy_', $ext );
			if ( $tmpFile ) {
				$handle = fopen( $tmpFile->getPath(), 'wb' );
				if ( $handle ) {
					$reqs[$path] = array(
						'method'  => 'GET',
						'url'     => $this->storageUrl( $auth, $srcCont, $srcRel ),
						'headers' => $this->authTokenHeaders( $auth )
							+ $this->headersFromParams( $params ),
						'stream'  => $handle,
					);
				} else {
					$tmpFile = null;
				}
			}
			$tmpFiles[$path] = $tmpFile;
		}

		$opts = array( 'maxConnsPerHost' => $params['concurrency'] );
		$reqs = $this->http->runMulti( $reqs, $opts );
		foreach ( $reqs as $path => $op ) {
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $op['response'];
			fclose( $op['stream'] ); // close open handle
			if ( $rcode >= 200 && $rcode <= 299
				// double check that the disk is not full/broken
				&& $tmpFiles[$path]->getSize() == $rhdrs['content-length']
			) {
				// good
			} elseif ( $rcode === 404 ) {
				$tmpFiles[$path] = false;
			} else {
				$tmpFiles[$path] = null;
				$this->onError( null, __METHOD__,
					array( 'src' => $path ) + $ep, $rerr, $rcode, $rdesc );
			}
		}

		return $tmpFiles;
	}

	public function getFileHttpUrl( array $params ) {
		if ( $this->swiftTempUrlKey != '' ||
			( $this->rgwS3AccessKey != '' && $this->rgwS3SecretKey != '' )
		) {
			list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $params['src'] );
			if ( $srcRel === null ) {
				return null; // invalid path
			}

			$auth = $this->getAuthentication();
			if ( !$auth ) {
				return null;
			}

			$ttl = isset( $params['ttl'] ) ? $params['ttl'] : 86400;
			$expires = time() + $ttl;

			if ( $this->swiftTempUrlKey != '' ) {
				$url = $this->storageUrl( $auth, $srcCont, $srcRel );
				// Swift wants the signature based on the unencoded object name
				$contPath = parse_url( $this->storageUrl( $auth, $srcCont ), PHP_URL_PATH );
				$signature = hash_hmac( 'sha1',
					"GET\n{$expires}\n{$contPath}/{$srcRel}",
					$this->swiftTempUrlKey
				);

				return "{$url}?temp_url_sig={$signature}&temp_url_expires={$expires}";
			} else { // give S3 API URL for rgw
				// Path for signature starts with the bucket
				$spath = '/' . rawurlencode( $srcCont ) . '/' .
					str_replace( '%2F', '/', rawurlencode( $srcRel ) );
				// Calculate the hash
				$signature = base64_encode( hash_hmac(
					'sha1',
					"GET\n\n\n{$expires}\n{$spath}",
					$this->rgwS3SecretKey,
					true // raw
				) );
				// See http://s3.amazonaws.com/doc/s3-developer-guide/RESTAuthentication.html.
				// Note: adding a newline for empty CanonicalizedAmzHeaders does not work.
				return wfAppendQuery(
					str_replace( '/swift/v1', '', // S3 API is the rgw default
						$this->storageUrl( $auth ) . $spath ),
					array(
						'Signature' => $signature,
						'Expires' => $expires,
						'AWSAccessKeyId' => $this->rgwS3AccessKey )
				);
			}
		}

		return null;
	}

	protected function directoriesAreVirtual() {
		return true;
	}

	/**
	 * Get headers to send to Swift when reading a file based
	 * on a FileBackend params array, e.g. that of getLocalCopy().
	 * $params is currently only checked for a 'latest' flag.
	 *
	 * @param array $params
	 * @return array
	 */
	protected function headersFromParams( array $params ) {
		$hdrs = array();
		if ( !empty( $params['latest'] ) ) {
			$hdrs['x-newest'] = 'true';
		}

		return $hdrs;
	}

	protected function doExecuteOpHandlesInternal( array $fileOpHandles ) {
		$statuses = array();

		$auth = $this->getAuthentication();
		if ( !$auth ) {
			foreach ( $fileOpHandles as $index => $fileOpHandle ) {
				$statuses[$index] = Status::newFatal( 'backend-fail-connect', $this->name );
			}

			return $statuses;
		}

		// Split the HTTP requests into stages that can be done concurrently
		$httpReqsByStage = array(); // map of (stage => index => HTTP request)
		foreach ( $fileOpHandles as $index => $fileOpHandle ) {
			$reqs = $fileOpHandle->httpOp;
			// Convert the 'url' parameter to an actual URL using $auth
			foreach ( $reqs as $stage => &$req ) {
				list( $container, $relPath ) = $req['url'];
				$req['url'] = $this->storageUrl( $auth, $container, $relPath );
				$req['headers'] = isset( $req['headers'] ) ? $req['headers'] : array();
				$req['headers'] = $this->authTokenHeaders( $auth ) + $req['headers'];
				$httpReqsByStage[$stage][$index] = $req;
			}
			$statuses[$index] = Status::newGood();
		}

		// Run all requests for the first stage, then the next, and so on
		$reqCount = count( $httpReqsByStage );
		for ( $stage = 0; $stage < $reqCount; ++$stage ) {
			$httpReqs = $this->http->runMulti( $httpReqsByStage[$stage] );
			foreach ( $httpReqs as $index => $httpReq ) {
				// Run the callback for each request of this operation
				$callback = $fileOpHandles[$index]->callback;
				call_user_func_array( $callback, array( $httpReq, $statuses[$index] ) );
				// On failure, abort all remaining requests for this operation
				// (e.g. abort the DELETE request if the COPY request fails for a move)
				if ( !$statuses[$index]->isOK() ) {
					$stages = count( $fileOpHandles[$index]->httpOp );
					for ( $s = ( $stage + 1 ); $s < $stages; ++$s ) {
						unset( $httpReqsByStage[$s][$index] );
					}
				}
			}
		}

		return $statuses;
	}

	/**
	 * Set read/write permissions for a Swift container.
	 *
	 * @see http://swift.openstack.org/misc.html#acls
	 *
	 * In general, we don't allow listings to end-users. It's not useful, isn't well-defined
	 * (lists are truncated to 10000 item with no way to page), and is just a performance risk.
	 *
	 * @param string $container Resolved Swift container
	 * @param array $readGrps List of the possible criteria for a request to have
	 * access to read a container. Each item is one of the following formats:
	 *   - account:user        : Grants access if the request is by the given user
	 *   - ".r:<regex>"        : Grants access if the request is from a referrer host that
	 *                           matches the expression and the request is not for a listing.
	 *                           Setting this to '*' effectively makes a container public.
	 *   -".rlistings:<regex>" : Grants access if the request is from a referrer host that
	 *                           matches the expression and the request is for a listing.
	 * @param array $writeGrps A list of the possible criteria for a request to have
	 * access to write to a container. Each item is of the following format:
	 *   - account:user       : Grants access if the request is by the given user
	 * @return Status
	 */
	protected function setContainerAccess( $container, array $readGrps, array $writeGrps ) {
		$status = Status::newGood();
		$auth = $this->getAuthentication();

		if ( !$auth ) {
			$status->fatal( 'backend-fail-connect', $this->name );

			return $status;
		}

		list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
			'method' => 'POST',
			'url' => $this->storageUrl( $auth, $container ),
			'headers' => $this->authTokenHeaders( $auth ) + array(
				'x-container-read' => implode( ',', $readGrps ),
				'x-container-write' => implode( ',', $writeGrps )
			)
		) );

		if ( $rcode != 204 && $rcode !== 202 ) {
			$status->fatal( 'backend-fail-internal', $this->name );
		}

		return $status;
	}

	/**
	 * Get a Swift container stat array, possibly from process cache.
	 * Use $reCache if the file count or byte count is needed.
	 *
	 * @param string $container Container name
	 * @param bool $bypassCache Bypass all caches and load from Swift
	 * @return array|bool|null False on 404, null on failure
	 */
	protected function getContainerStat( $container, $bypassCache = false ) {
		$section = new ProfileSection( __METHOD__ . '-' . $this->name );

		if ( $bypassCache ) { // purge cache
			$this->containerStatCache->clear( $container );
		} elseif ( !$this->containerStatCache->has( $container, 'stat' ) ) {
			$this->primeContainerCache( array( $container ) ); // check persistent cache
		}
		if ( !$this->containerStatCache->has( $container, 'stat' ) ) {
			$auth = $this->getAuthentication();
			if ( !$auth ) {
				return null;
			}

			wfProfileIn( __METHOD__ . "-{$this->name}-miss" );
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
				'method' => 'HEAD',
				'url' => $this->storageUrl( $auth, $container ),
				'headers' => $this->authTokenHeaders( $auth )
			) );
			wfProfileOut( __METHOD__ . "-{$this->name}-miss" );

			if ( $rcode === 204 ) {
				$stat = array(
					'count' => $rhdrs['x-container-object-count'],
					'bytes' => $rhdrs['x-container-bytes-used']
				);
				if ( $bypassCache ) {
					return $stat;
				} else {
					$this->containerStatCache->set( $container, 'stat', $stat ); // cache it
					$this->setContainerCache( $container, $stat ); // update persistent cache
				}
			} elseif ( $rcode === 404 ) {
				return false;
			} else {
				$this->onError( null, __METHOD__,
					array( 'cont' => $container ), $rerr, $rcode, $rdesc );

				return null;
			}
		}

		return $this->containerStatCache->get( $container, 'stat' );
	}

	/**
	 * Create a Swift container
	 *
	 * @param string $container Container name
	 * @param array $params
	 * @return Status
	 */
	protected function createContainer( $container, array $params ) {
		$status = Status::newGood();

		$auth = $this->getAuthentication();
		if ( !$auth ) {
			$status->fatal( 'backend-fail-connect', $this->name );

			return $status;
		}

		// @see SwiftFileBackend::setContainerAccess()
		if ( empty( $params['noAccess'] ) ) {
			$readGrps = array( '.r:*', $this->swiftUser ); // public
		} else {
			$readGrps = array( $this->swiftUser ); // private
		}
		$writeGrps = array( $this->swiftUser ); // sanity

		list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
			'method' => 'PUT',
			'url' => $this->storageUrl( $auth, $container ),
			'headers' => $this->authTokenHeaders( $auth ) + array(
				'x-container-read' => implode( ',', $readGrps ),
				'x-container-write' => implode( ',', $writeGrps )
			)
		) );

		if ( $rcode === 201 ) { // new
			// good
		} elseif ( $rcode === 202 ) { // already there
			// this shouldn't really happen, but is OK
		} else {
			$this->onError( $status, __METHOD__, $params, $rerr, $rcode, $rdesc );
		}

		return $status;
	}

	/**
	 * Delete a Swift container
	 *
	 * @param string $container Container name
	 * @param array $params
	 * @return Status
	 */
	protected function deleteContainer( $container, array $params ) {
		$status = Status::newGood();

		$auth = $this->getAuthentication();
		if ( !$auth ) {
			$status->fatal( 'backend-fail-connect', $this->name );

			return $status;
		}

		list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
			'method' => 'DELETE',
			'url' => $this->storageUrl( $auth, $container ),
			'headers' => $this->authTokenHeaders( $auth )
		) );

		if ( $rcode >= 200 && $rcode <= 299 ) { // deleted
			$this->containerStatCache->clear( $container ); // purge
		} elseif ( $rcode === 404 ) { // not there
			// this shouldn't really happen, but is OK
		} elseif ( $rcode === 409 ) { // not empty
			$this->onError( $status, __METHOD__, $params, $rerr, $rcode, $rdesc ); // race?
		} else {
			$this->onError( $status, __METHOD__, $params, $rerr, $rcode, $rdesc );
		}

		return $status;
	}

	/**
	 * Get a list of objects under a container.
	 * Either just the names or a list of stdClass objects with details can be returned.
	 *
	 * @param string $fullCont
	 * @param string $type ('info' for a list of object detail maps, 'names' for names only)
	 * @param integer $limit
	 * @param string|null $after
	 * @param string|null $prefix
	 * @param string|null $delim
	 * @return Status With the list as value
	 */
	private function objectListing(
		$fullCont, $type, $limit, $after = null, $prefix = null, $delim = null
	) {
		$status = Status::newGood();

		$auth = $this->getAuthentication();
		if ( !$auth ) {
			$status->fatal( 'backend-fail-connect', $this->name );

			return $status;
		}

		$query = array( 'limit' => $limit );
		if ( $type === 'info' ) {
			$query['format'] = 'json';
		}
		if ( $after !== null ) {
			$query['marker'] = $after;
		}
		if ( $prefix !== null ) {
			$query['prefix'] = $prefix;
		}
		if ( $delim !== null ) {
			$query['delimiter'] = $delim;
		}

		list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
			'method' => 'GET',
			'url' => $this->storageUrl( $auth, $fullCont ),
			'query' => $query,
			'headers' => $this->authTokenHeaders( $auth )
		) );

		$params = array( 'cont' => $fullCont, 'prefix' => $prefix, 'delim' => $delim );
		if ( $rcode === 200 ) { // good
			if ( $type === 'info' ) {
				$status->value = FormatJson::decode( trim( $rbody ) );
			} else {
				$status->value = explode( "\n", trim( $rbody ) );
			}
		} elseif ( $rcode === 204 ) {
			$status->value = array(); // empty container
		} elseif ( $rcode === 404 ) {
			$status->value = array(); // no container
		} else {
			$this->onError( $status, __METHOD__, $params, $rerr, $rcode, $rdesc );
		}

		return $status;
	}

	protected function doPrimeContainerCache( array $containerInfo ) {
		foreach ( $containerInfo as $container => $info ) {
			$this->containerStatCache->set( $container, 'stat', $info );
		}
	}

	protected function doGetFileStatMulti( array $params ) {
		$stats = array();

		$auth = $this->getAuthentication();

		$reqs = array();
		foreach ( $params['srcs'] as $path ) {
			list( $srcCont, $srcRel ) = $this->resolveStoragePathReal( $path );
			if ( $srcRel === null ) {
				$stats[$path] = false;
				continue; // invalid storage path
			} elseif ( !$auth ) {
				$stats[$path] = null;
				continue;
			}

			// (a) Check the container
			$cstat = $this->getContainerStat( $srcCont );
			if ( $cstat === false ) {
				$stats[$path] = false;
				continue; // ok, nothing to do
			} elseif ( !is_array( $cstat ) ) {
				$stats[$path] = null;
				continue;
			}

			$reqs[$path] = array(
				'method'  => 'HEAD',
				'url'     => $this->storageUrl( $auth, $srcCont, $srcRel ),
				'headers' => $this->authTokenHeaders( $auth ) + $this->headersFromParams( $params )
			);
		}

		$opts = array( 'maxConnsPerHost' => $params['concurrency'] );
		$reqs = $this->http->runMulti( $reqs, $opts );

		foreach ( $params['srcs'] as $path ) {
			if ( array_key_exists( $path, $stats ) ) {
				continue; // some sort of failure above
			}
			// (b) Check the file
			list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $reqs[$path]['response'];
			if ( $rcode === 200 || $rcode === 204 ) {
				// Update the object if it is missing some headers
				$rhdrs = $this->addMissingMetadata( $rhdrs, $path );
				// Fetch all of the custom metadata headers
				$metadata = array();
				foreach ( $rhdrs as $name => $value ) {
					if ( strpos( $name, 'x-object-meta-' ) === 0 ) {
						$metadata[substr( $name, strlen( 'x-object-meta-' ) )] = $value;
					}
				}
				// Fetch all of the custom raw HTTP headers
				$headers = $this->sanitizeHdrs( array( 'headers' => $rhdrs ) );
				$stat = array(
					// Convert various random Swift dates to TS_MW
					'mtime' => $this->convertSwiftDate( $rhdrs['last-modified'], TS_MW ),
					// Empty objects actually return no content-length header in Ceph
					'size'  => isset( $rhdrs['content-length'] ) ? (int)$rhdrs['content-length'] : 0,
					'sha1'  => $rhdrs[ 'x-object-meta-sha1base36'],
					// Note: manifiest ETags are not an MD5 of the file
					'md5'   => ctype_xdigit( $rhdrs['etag'] ) ? $rhdrs['etag'] : null,
					'xattr' => array( 'metadata' => $metadata, 'headers' => $headers )
				);
				if ( $this->isRGW ) {
					$stat['latest'] = true; // strong consistency
				}
			} elseif ( $rcode === 404 ) {
				$stat = false;
			} else {
				$stat = null;
				$this->onError( null, __METHOD__, $params, $rerr, $rcode, $rdesc );
			}
			$stats[$path] = $stat;
		}

		return $stats;
	}

	/**
	 * @return array|null Credential map
	 */
	protected function getAuthentication() {
		if ( $this->authErrorTimestamp !== null ) {
			if ( ( time() - $this->authErrorTimestamp ) < 60 ) {
				return null; // failed last attempt; don't bother
			} else { // actually retry this time
				$this->authErrorTimestamp = null;
			}
		}
		// Session keys expire after a while, so we renew them periodically
		$reAuth = ( ( time() - $this->authSessionTimestamp ) > $this->authTTL );
		// Authenticate with proxy and get a session key...
		if ( !$this->authCreds || $reAuth ) {
			$this->authSessionTimestamp = 0;
			$cacheKey = $this->getCredsCacheKey( $this->swiftUser );
			$creds = $this->srvCache->get( $cacheKey ); // credentials
			// Try to use the credential cache
			if ( isset( $creds['auth_token'] ) && isset( $creds['storage_url'] ) ) {
				$this->authCreds = $creds;
				// Skew the timestamp for worst case to avoid using stale credentials
				$this->authSessionTimestamp = time() - ceil( $this->authTTL / 2 );
			} else { // cache miss
				list( $rcode, $rdesc, $rhdrs, $rbody, $rerr ) = $this->http->run( array(
					'method' => 'GET',
					'url' => "{$this->swiftAuthUrl}/v1.0",
					'headers' => array(
						'x-auth-user' => $this->swiftUser,
						'x-auth-key' => $this->swiftKey
					)
				) );

				if ( $rcode >= 200 && $rcode <= 299 ) { // OK
					$this->authCreds = array(
						'auth_token' => $rhdrs['x-auth-token'],
						'storage_url' => $rhdrs['x-storage-url']
					);
					$this->srvCache->set( $cacheKey, $this->authCreds, ceil( $this->authTTL / 2 ) );
					$this->authSessionTimestamp = time();
				} elseif ( $rcode === 401 ) {
					$this->onError( null, __METHOD__, array(), "Authentication failed.", $rcode );
					$this->authErrorTimestamp = time();

					return null;
				} else {
					$this->onError( null, __METHOD__, array(), "HTTP return code: $rcode", $rcode );
					$this->authErrorTimestamp = time();

					return null;
				}
			}
			// Ceph RGW does not use <account> in URLs (OpenStack Swift uses "/v1/<account>")
			if ( substr( $this->authCreds['storage_url'], -3 ) === '/v1' ) {
				$this->isRGW = true; // take advantage of strong consistency
			}
		}

		return $this->authCreds;
	}

	/**
	 * @param array $creds From getAuthentication()
	 * @param string $container
	 * @param string $object
	 * @return array
	 */
	protected function storageUrl( array $creds, $container = null, $object = null ) {
		$parts = array( $creds['storage_url'] );
		if ( strlen( $container ) ) {
			$parts[] = rawurlencode( $container );
		}
		if ( strlen( $object ) ) {
			$parts[] = str_replace( "%2F", "/", rawurlencode( $object ) );
		}

		return implode( '/', $parts );
	}

	/**
	 * @param array $creds From getAuthentication()
	 * @return array
	 */
	protected function authTokenHeaders( array $creds ) {
		return array( 'x-auth-token' => $creds['auth_token'] );
	}

	/**
	 * Get the cache key for a container
	 *
	 * @param string $username
	 * @return string
	 */
	private function getCredsCacheKey( $username ) {
		return 'swiftcredentials:' . md5( $username . ':' . $this->swiftAuthUrl );
	}

	/**
	 * Log an unexpected exception for this backend.
	 * This also sets the Status object to have a fatal error.
	 *
	 * @param Status|null $status
	 * @param string $func
	 * @param array $params
	 * @param string $err Error string
	 * @param integer $code HTTP status
	 * @param string $desc HTTP status description
	 */
	public function onError( $status, $func, array $params, $err = '', $code = 0, $desc = '' ) {
		if ( $status instanceof Status ) {
			$status->fatal( 'backend-fail-internal', $this->name );
		}
		if ( $code == 401 ) { // possibly a stale token
			$this->srvCache->delete( $this->getCredsCacheKey( $this->swiftUser ) );
		}
		wfDebugLog( 'SwiftBackend',
			"HTTP $code ($desc) in '{$func}' (given '" . FormatJson::encode( $params ) . "')" .
			( $err ? ": $err" : "" )
		);
	}
}

/**
 * @see FileBackendStoreOpHandle
 */
class SwiftFileOpHandle extends FileBackendStoreOpHandle {
	/** @var array List of Requests for MultiHttpClient */
	public $httpOp;
	/** @var Closure */
	public $callback;

	/**
	 * @param SwiftFileBackend $backend
	 * @param Closure $callback Function that takes (HTTP request array, status)
	 * @param array $httpOp MultiHttpClient op
	 */
	public function __construct( SwiftFileBackend $backend, Closure $callback, array $httpOp ) {
		$this->backend = $backend;
		$this->callback = $callback;
		$this->httpOp = $httpOp;
	}
}

/**
 * SwiftFileBackend helper class to page through listings.
 * Swift also has a listing limit of 10,000 objects for sanity.
 * Do not use this class from places outside SwiftFileBackend.
 *
 * @ingroup FileBackend
 */
abstract class SwiftFileBackendList implements Iterator {
	/** @var array List of path or (path,stat array) entries */
	protected $bufferIter = array();

	/** @var string List items *after* this path */
	protected $bufferAfter = null;

	/** @var int */
	protected $pos = 0;

	/** @var array */
	protected $params = array();

	/** @var SwiftFileBackend */
	protected $backend;

	/** @var string Container name */
	protected $container;

	/** @var string Storage directory */
	protected $dir;

	/** @var int */
	protected $suffixStart;

	const PAGE_SIZE = 9000; // file listing buffer size

	/**
	 * @param SwiftFileBackend $backend
	 * @param string $fullCont Resolved container name
	 * @param string $dir Resolved directory relative to container
	 * @param array $params
	 */
	public function __construct( SwiftFileBackend $backend, $fullCont, $dir, array $params ) {
		$this->backend = $backend;
		$this->container = $fullCont;
		$this->dir = $dir;
		if ( substr( $this->dir, -1 ) === '/' ) {
			$this->dir = substr( $this->dir, 0, -1 ); // remove trailing slash
		}
		if ( $this->dir == '' ) { // whole container
			$this->suffixStart = 0;
		} else { // dir within container
			$this->suffixStart = strlen( $this->dir ) + 1; // size of "path/to/dir/"
		}
		$this->params = $params;
	}

	/**
	 * @see Iterator::key()
	 * @return int
	 */
	public function key() {
		return $this->pos;
	}

	/**
	 * @see Iterator::next()
	 */
	public function next() {
		// Advance to the next file in the page
		next( $this->bufferIter );
		++$this->pos;
		// Check if there are no files left in this page and
		// advance to the next page if this page was not empty.
		if ( !$this->valid() && count( $this->bufferIter ) ) {
			$this->bufferIter = $this->pageFromList(
				$this->container, $this->dir, $this->bufferAfter, self::PAGE_SIZE, $this->params
			); // updates $this->bufferAfter
		}
	}

	/**
	 * @see Iterator::rewind()
	 */
	public function rewind() {
		$this->pos = 0;
		$this->bufferAfter = null;
		$this->bufferIter = $this->pageFromList(
			$this->container, $this->dir, $this->bufferAfter, self::PAGE_SIZE, $this->params
		); // updates $this->bufferAfter
	}

	/**
	 * @see Iterator::valid()
	 * @return bool
	 */
	public function valid() {
		if ( $this->bufferIter === null ) {
			return false; // some failure?
		} else {
			return ( current( $this->bufferIter ) !== false ); // no paths can have this value
		}
	}

	/**
	 * Get the given list portion (page)
	 *
	 * @param string $container Resolved container name
	 * @param string $dir Resolved path relative to container
	 * @param string $after null
	 * @param int $limit
	 * @param array $params
	 * @return Traversable|array
	 */
	abstract protected function pageFromList( $container, $dir, &$after, $limit, array $params );
}

/**
 * Iterator for listing directories
 */
class SwiftFileBackendDirList extends SwiftFileBackendList {
	/**
	 * @see Iterator::current()
	 * @return string|bool String (relative path) or false
	 */
	public function current() {
		return substr( current( $this->bufferIter ), $this->suffixStart, -1 );
	}

	protected function pageFromList( $container, $dir, &$after, $limit, array $params ) {
		return $this->backend->getDirListPageInternal( $container, $dir, $after, $limit, $params );
	}
}

/**
 * Iterator for listing regular files
 */
class SwiftFileBackendFileList extends SwiftFileBackendList {
	/**
	 * @see Iterator::current()
	 * @return string|bool String (relative path) or false
	 */
	public function current() {
		list( $path, $stat ) = current( $this->bufferIter );
		$relPath = substr( $path, $this->suffixStart );
		if ( is_array( $stat ) ) {
			$storageDir = rtrim( $this->params['dir'], '/' );
			$this->backend->loadListingStatInternal( "$storageDir/$relPath", $stat );
		}

		return $relPath;
	}

	protected function pageFromList( $container, $dir, &$after, $limit, array $params ) {
		return $this->backend->getFileListPageInternal( $container, $dir, $after, $limit, $params );
	}
}
