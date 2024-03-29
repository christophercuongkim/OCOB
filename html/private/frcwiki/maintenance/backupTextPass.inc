<?php
/**
 * BackupDumper that postprocesses XML dumps from dumpBackup.php to add page text
 *
 * Copyright (C) 2005 Brion Vibber <brion@pobox.com>
 * https://www.mediawiki.org/
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
 * @ingroup Maintenance
 */

require_once __DIR__ . '/backup.inc';

/**
 * @ingroup Maintenance
 */
class TextPassDumper extends BackupDumper {
	public $prefetch = null;

	// when we spend more than maxTimeAllowed seconds on this run, we continue
	// processing until we write out the next complete page, then save output file(s),
	// rename it/them and open new one(s)
	public $maxTimeAllowed = 0; // 0 = no limit

	protected $input = "php://stdin";
	protected $history = WikiExporter::FULL;
	protected $fetchCount = 0;
	protected $prefetchCount = 0;
	protected $prefetchCountLast = 0;
	protected $fetchCountLast = 0;

	protected $maxFailures = 5;
	protected $maxConsecutiveFailedTextRetrievals = 200;
	protected $failureTimeout = 5; // Seconds to sleep after db failure

	protected $php = "php";
	protected $spawn = false;

	/**
	 * @var bool|resource
	 */
	protected $spawnProc = false;

	/**
	 * @var bool|resource
	 */
	protected $spawnWrite = false;

	/**
	 * @var bool|resource
	 */
	protected $spawnRead = false;

	/**
	 * @var bool|resource
	 */
	protected $spawnErr = false;

	protected $xmlwriterobj = false;

	protected $timeExceeded = false;
	protected $firstPageWritten = false;
	protected $lastPageWritten = false;
	protected $checkpointJustWritten = false;
	protected $checkpointFiles = array();

	/**
	 * @var DatabaseBase
	 */
	protected $db;

	/**
	 * Drop the database connection $this->db and try to get a new one.
	 *
	 * This function tries to get a /different/ connection if this is
	 * possible. Hence, (if this is possible) it switches to a different
	 * failover upon each call.
	 *
	 * This function resets $this->lb and closes all connections on it.
	 *
	 * @throws MWException
	 */
	function rotateDb() {
		// Cleaning up old connections
		if ( isset( $this->lb ) ) {
			$this->lb->closeAll();
			unset( $this->lb );
		}

		if ( $this->forcedDb !== null ) {
			$this->db = $this->forcedDb;

			return;
		}

		if ( isset( $this->db ) && $this->db->isOpen() ) {
			throw new MWException( 'DB is set and has not been closed by the Load Balancer' );
		}

		unset( $this->db );

		// Trying to set up new connection.
		// We do /not/ retry upon failure, but delegate to encapsulating logic, to avoid
		// individually retrying at different layers of code.

		// 1. The LoadBalancer.
		try {
			$this->lb = wfGetLBFactory()->newMainLB();
		} catch ( Exception $e ) {
			throw new MWException( __METHOD__
				. " rotating DB failed to obtain new load balancer (" . $e->getMessage() . ")" );
		}

		// 2. The Connection, through the load balancer.
		try {
			$this->db = $this->lb->getConnection( DB_SLAVE, 'dump' );
		} catch ( Exception $e ) {
			throw new MWException( __METHOD__
				. " rotating DB failed to obtain new database (" . $e->getMessage() . ")" );
		}
	}

	function initProgress( $history = WikiExporter::FULL ) {
		parent::initProgress();
		$this->timeOfCheckpoint = $this->startTime;
	}

	function dump( $history, $text = WikiExporter::TEXT ) {
		// Notice messages will foul up your XML output even if they're
		// relatively harmless.
		if ( ini_get( 'display_errors' ) ) {
			ini_set( 'display_errors', 'stderr' );
		}

		$this->initProgress( $this->history );

		// We are trying to get an initial database connection to avoid that the
		// first try of this request's first call to getText fails. However, if
		// obtaining a good DB connection fails it's not a serious issue, as
		// getText does retry upon failure and can start without having a working
		// DB connection.
		try {
			$this->rotateDb();
		} catch ( Exception $e ) {
			// We do not even count this as failure. Just let eventual
			// watchdogs know.
			$this->progress( "Getting initial DB connection failed (" .
				$e->getMessage() . ")" );
		}

		$this->egress = new ExportProgressFilter( $this->sink, $this );

		// it would be nice to do it in the constructor, oh well. need egress set
		$this->finalOptionCheck();

		// we only want this so we know how to close a stream :-P
		$this->xmlwriterobj = new XmlDumpWriter();

		$input = fopen( $this->input, "rt" );
		$this->readDump( $input );

		if ( $this->spawnProc ) {
			$this->closeSpawn();
		}

		$this->report( true );
	}

	function processOption( $opt, $val, $param ) {
		global $IP;
		$url = $this->processFileOpt( $val, $param );

		switch ( $opt ) {
			case 'prefetch':
				require_once "$IP/maintenance/backupPrefetch.inc";
				$this->prefetch = new BaseDump( $url );
				break;
			case 'stub':
				$this->input = $url;
				break;
			case 'maxtime':
				$this->maxTimeAllowed = intval( $val ) * 60;
				break;
			case 'checkpointfile':
				$this->checkpointFiles[] = $val;
				break;
			case 'current':
				$this->history = WikiExporter::CURRENT;
				break;
			case 'full':
				$this->history = WikiExporter::FULL;
				break;
			case 'spawn':
				$this->spawn = true;
				if ( $val ) {
					$this->php = $val;
				}
				break;
		}
	}

	function processFileOpt( $val, $param ) {
		$fileURIs = explode( ';', $param );
		foreach ( $fileURIs as $URI ) {
			switch ( $val ) {
				case "file":
					$newURI = $URI;
					break;
				case "gzip":
					$newURI = "compress.zlib://$URI";
					break;
				case "bzip2":
					$newURI = "compress.bzip2://$URI";
					break;
				case "7zip":
					$newURI = "mediawiki.compress.7z://$URI";
					break;
				default:
					$newURI = $URI;
			}
			$newFileURIs[] = $newURI;
		}
		$val = implode( ';', $newFileURIs );

		return $val;
	}

	/**
	 * Overridden to include prefetch ratio if enabled.
	 */
	function showReport() {
		if ( !$this->prefetch ) {
			parent::showReport();

			return;
		}

		if ( $this->reporting ) {
			$now = wfTimestamp( TS_DB );
			$nowts = microtime( true );
			$deltaAll = $nowts - $this->startTime;
			$deltaPart = $nowts - $this->lastTime;
			$this->pageCountPart = $this->pageCount - $this->pageCountLast;
			$this->revCountPart = $this->revCount - $this->revCountLast;

			if ( $deltaAll ) {
				$portion = $this->revCount / $this->maxCount;
				$eta = $this->startTime + $deltaAll / $portion;
				$etats = wfTimestamp( TS_DB, intval( $eta ) );
				if ( $this->fetchCount ) {
					$fetchRate = 100.0 * $this->prefetchCount / $this->fetchCount;
				} else {
					$fetchRate = '-';
				}
				$pageRate = $this->pageCount / $deltaAll;
				$revRate = $this->revCount / $deltaAll;
			} else {
				$pageRate = '-';
				$revRate = '-';
				$etats = '-';
				$fetchRate = '-';
			}
			if ( $deltaPart ) {
				if ( $this->fetchCountLast ) {
					$fetchRatePart = 100.0 * $this->prefetchCountLast / $this->fetchCountLast;
				} else {
					$fetchRatePart = '-';
				}
				$pageRatePart = $this->pageCountPart / $deltaPart;
				$revRatePart = $this->revCountPart / $deltaPart;
			} else {
				$fetchRatePart = '-';
				$pageRatePart = '-';
				$revRatePart = '-';
			}
			$this->progress( sprintf(
				"%s: %s (ID %d) %d pages (%0.1f|%0.1f/sec all|curr), "
					. "%d revs (%0.1f|%0.1f/sec all|curr), %0.1f%%|%0.1f%% "
					. "prefetched (all|curr), ETA %s [max %d]",
				$now, wfWikiID(), $this->ID, $this->pageCount, $pageRate,
				$pageRatePart, $this->revCount, $revRate, $revRatePart,
				$fetchRate, $fetchRatePart, $etats, $this->maxCount
			) );
			$this->lastTime = $nowts;
			$this->revCountLast = $this->revCount;
			$this->prefetchCountLast = $this->prefetchCount;
			$this->fetchCountLast = $this->fetchCount;
		}
	}

	function setTimeExceeded() {
		$this->timeExceeded = true;
	}

	function checkIfTimeExceeded() {
		if ( $this->maxTimeAllowed
			&& ( $this->lastTime - $this->timeOfCheckpoint > $this->maxTimeAllowed )
		) {
			return true;
		}

		return false;
	}

	function finalOptionCheck() {
		if ( ( $this->checkpointFiles && !$this->maxTimeAllowed )
			|| ( $this->maxTimeAllowed && !$this->checkpointFiles )
		) {
			throw new MWException( "Options checkpointfile and maxtime must be specified together.\n" );
		}
		foreach ( $this->checkpointFiles as $checkpointFile ) {
			$count = substr_count( $checkpointFile, "%s" );
			if ( $count != 2 ) {
				throw new MWException( "Option checkpointfile must contain two '%s' "
					. "for substitution of first and last pageids, count is $count instead, "
					. "file is $checkpointFile.\n" );
			}
		}

		if ( $this->checkpointFiles ) {
			$filenameList = (array)$this->egress->getFilenames();
			if ( count( $filenameList ) != count( $this->checkpointFiles ) ) {
				throw new MWException( "One checkpointfile must be specified "
					. "for each output option, if maxtime is used.\n" );
			}
		}
	}

	/**
	 * @throws MWException Failure to parse XML input
	 * @param string $input
	 * @return bool
	 */
	function readDump( $input ) {
		$this->buffer = "";
		$this->openElement = false;
		$this->atStart = true;
		$this->state = "";
		$this->lastName = "";
		$this->thisPage = 0;
		$this->thisRev = 0;

		$parser = xml_parser_create( "UTF-8" );
		xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, false );

		xml_set_element_handler(
			$parser,
			array( &$this, 'startElement' ),
			array( &$this, 'endElement' )
		);
		xml_set_character_data_handler( $parser, array( &$this, 'characterData' ) );

		$offset = 0; // for context extraction on error reporting
		$bufferSize = 512 * 1024;
		do {
			if ( $this->checkIfTimeExceeded() ) {
				$this->setTimeExceeded();
			}
			$chunk = fread( $input, $bufferSize );
			if ( !xml_parse( $parser, $chunk, feof( $input ) ) ) {
				wfDebug( "TextDumpPass::readDump encountered XML parsing error\n" );

				$byte = xml_get_current_byte_index( $parser );
				$msg = wfMessage( 'xml-error-string',
					'XML import parse failure',
					xml_get_current_line_number( $parser ),
					xml_get_current_column_number( $parser ),
					$byte . ( is_null( $chunk ) ? null : ( '; "' . substr( $chunk, $byte - $offset, 16 ) . '"' ) ),
					xml_error_string( xml_get_error_code( $parser ) ) )->escaped();

				xml_parser_free( $parser );

				throw new MWException( $msg );
			}
			$offset += strlen( $chunk );
		} while ( $chunk !== false && !feof( $input ) );
		if ( $this->maxTimeAllowed ) {
			$filenameList = (array)$this->egress->getFilenames();
			// we wrote some stuff after last checkpoint that needs renamed
			if ( file_exists( $filenameList[0] ) ) {
				$newFilenames = array();
				# we might have just written the header and footer and had no
				# pages or revisions written... perhaps they were all deleted
				# there's no pageID 0 so we use that. the caller is responsible
				# for deciding what to do with a file containing only the
				# siteinfo information and the mw tags.
				if ( !$this->firstPageWritten ) {
					$firstPageID = str_pad( 0, 9, "0", STR_PAD_LEFT );
					$lastPageID = str_pad( 0, 9, "0", STR_PAD_LEFT );
				} else {
					$firstPageID = str_pad( $this->firstPageWritten, 9, "0", STR_PAD_LEFT );
					$lastPageID = str_pad( $this->lastPageWritten, 9, "0", STR_PAD_LEFT );
				}

				$filenameCount = count( $filenameList );
				for ( $i = 0; $i < $filenameCount; $i++ ) {
					$checkpointNameFilledIn = sprintf( $this->checkpointFiles[$i], $firstPageID, $lastPageID );
					$fileinfo = pathinfo( $filenameList[$i] );
					$newFilenames[] = $fileinfo['dirname'] . '/' . $checkpointNameFilledIn;
				}
				$this->egress->closeAndRename( $newFilenames );
			}
		}
		xml_parser_free( $parser );

		return true;
	}

	/**
	 * Tries to get the revision text for a revision id.
	 *
	 * Upon errors, retries (Up to $this->maxFailures tries each call).
	 * If still no good revision get could be found even after this retrying, "" is returned.
	 * If no good revision text could be returned for
	 * $this->maxConsecutiveFailedTextRetrievals consecutive calls to getText, MWException
	 * is thrown.
	 *
	 * @param string $id The revision id to get the text for
	 *
	 * @return string The revision text for $id, or ""
	 * @throws MWException
	 */
	function getText( $id ) {
		global $wgContentHandlerUseDB;

		$prefetchNotTried = true; // Whether or not we already tried to get the text via prefetch.
		$text = false; // The candidate for a good text. false if no proper value.
		$failures = 0; // The number of times, this invocation of getText already failed.

		// The number of times getText failed without yielding a good text in between.
		static $consecutiveFailedTextRetrievals = 0;

		$this->fetchCount++;

		// To allow to simply return on success and do not have to worry about book keeping,
		// we assume, this fetch works (possible after some retries). Nevertheless, we koop
		// the old value, so we can restore it, if problems occur (See after the while loop).
		$oldConsecutiveFailedTextRetrievals = $consecutiveFailedTextRetrievals;
		$consecutiveFailedTextRetrievals = 0;

		while ( $failures < $this->maxFailures ) {

			// As soon as we found a good text for the $id, we will return immediately.
			// Hence, if we make it past the try catch block, we know that we did not
			// find a good text.

			try {
				// Step 1: Get some text (or reuse from previous iteratuon if checking
				//         for plausibility failed)

				// Trying to get prefetch, if it has not been tried before
				if ( $text === false && isset( $this->prefetch ) && $prefetchNotTried ) {
					$prefetchNotTried = false;
					$tryIsPrefetch = true;
					$text = $this->prefetch->prefetch( intval( $this->thisPage ),
						intval( $this->thisRev ) );
					if ( $text === null ) {
						$text = false;
					}
				}

				if ( $text === false ) {
					// Fallback to asking the database
					$tryIsPrefetch = false;
					if ( $this->spawn ) {
						$text = $this->getTextSpawned( $id );
					} else {
						$text = $this->getTextDb( $id );
					}

					// No more checks for texts from DB for now.
					// If we received something that is not false,
					// We treat it as good text, regardless of whether it actually is or is not
					if ( $text !== false ) {
						return $text;
					}
				}

				if ( $text === false ) {
					throw new MWException( "Generic error while obtaining text for id " . $id );
				}

				// We received a good candidate for the text of $id via some method

				// Step 2: Checking for plausibility and return the text if it is
				//         plausible
				$revID = intval( $this->thisRev );
				if ( !isset( $this->db ) ) {
					throw new MWException( "No database available" );
				}

				$revLength = strlen( $text );
				if ( $wgContentHandlerUseDB ) {
					$row = $this->db->selectRow(
						'revision',
						array( 'rev_len', 'rev_content_model' ),
						array( 'rev_id' => $revID ),
						__METHOD__
					);
					if ( $row ) {
						// only check the length for the wikitext content handler,
						// it's a wasted (and failed) check otherwise
						if ( $row->rev_content_model == CONTENT_MODEL_WIKITEXT ) {
							$revLength = $row->rev_len;
						}
					}
				} else {
					$revLength = $this->db->selectField( 'revision', 'rev_len', array( 'rev_id' => $revID ) );
				}

				if ( strlen( $text ) == $revLength ) {
					if ( $tryIsPrefetch ) {
						$this->prefetchCount++;
					}

					return $text;
				}

				$text = false;
				throw new MWException( "Received text is unplausible for id " . $id );
			} catch ( Exception $e ) {
				$msg = "getting/checking text " . $id . " failed (" . $e->getMessage() . ")";
				if ( $failures + 1 < $this->maxFailures ) {
					$msg .= " (Will retry " . ( $this->maxFailures - $failures - 1 ) . " more times)";
				}
				$this->progress( $msg );
			}

			// Something went wrong; we did not a text that was plausible :(
			$failures++;

			// A failure in a prefetch hit does not warrant resetting db connection etc.
			if ( !$tryIsPrefetch ) {
				// After backing off for some time, we try to reboot the whole process as
				// much as possible to not carry over failures from one part to the other
				// parts
				sleep( $this->failureTimeout );
				try {
					$this->rotateDb();
					if ( $this->spawn ) {
						$this->closeSpawn();
						$this->openSpawn();
					}
				} catch ( Exception $e ) {
					$this->progress( "Rebooting getText infrastructure failed (" . $e->getMessage() . ")" .
						" Trying to continue anyways" );
				}
			}
		}

		// Retirieving a good text for $id failed (at least) maxFailures times.
		// We abort for this $id.

		// Restoring the consecutive failures, and maybe aborting, if the dump
		// is too broken.
		$consecutiveFailedTextRetrievals = $oldConsecutiveFailedTextRetrievals + 1;
		if ( $consecutiveFailedTextRetrievals > $this->maxConsecutiveFailedTextRetrievals ) {
			throw new MWException( "Graceful storage failure" );
		}

		return "";
	}

	/**
	 * May throw a database error if, say, the server dies during query.
	 * @param int $id
	 * @return bool|string
	 * @throws MWException
	 */
	private function getTextDb( $id ) {
		global $wgContLang;
		if ( !isset( $this->db ) ) {
			throw new MWException( __METHOD__ . "No database available" );
		}
		$row = $this->db->selectRow( 'text',
			array( 'old_text', 'old_flags' ),
			array( 'old_id' => $id ),
			__METHOD__ );
		$text = Revision::getRevisionText( $row );
		if ( $text === false ) {
			return false;
		}
		$stripped = str_replace( "\r", "", $text );
		$normalized = $wgContLang->normalize( $stripped );

		return $normalized;
	}

	private function getTextSpawned( $id ) {
		wfSuppressWarnings();
		if ( !$this->spawnProc ) {
			// First time?
			$this->openSpawn();
		}
		$text = $this->getTextSpawnedOnce( $id );
		wfRestoreWarnings();

		return $text;
	}

	function openSpawn() {
		global $IP;

		if ( file_exists( "$IP/../multiversion/MWScript.php" ) ) {
			$cmd = implode( " ",
				array_map( 'wfEscapeShellArg',
					array(
						$this->php,
						"$IP/../multiversion/MWScript.php",
						"fetchText.php",
						'--wiki', wfWikiID() ) ) );
		} else {
			$cmd = implode( " ",
				array_map( 'wfEscapeShellArg',
					array(
						$this->php,
						"$IP/maintenance/fetchText.php",
						'--wiki', wfWikiID() ) ) );
		}
		$spec = array(
			0 => array( "pipe", "r" ),
			1 => array( "pipe", "w" ),
			2 => array( "file", "/dev/null", "a" ) );
		$pipes = array();

		$this->progress( "Spawning database subprocess: $cmd" );
		$this->spawnProc = proc_open( $cmd, $spec, $pipes );
		if ( !$this->spawnProc ) {
			// shit
			$this->progress( "Subprocess spawn failed." );

			return false;
		}
		list(
			$this->spawnWrite, // -> stdin
			$this->spawnRead, // <- stdout
		) = $pipes;

		return true;
	}

	private function closeSpawn() {
		wfSuppressWarnings();
		if ( $this->spawnRead ) {
			fclose( $this->spawnRead );
		}
		$this->spawnRead = false;
		if ( $this->spawnWrite ) {
			fclose( $this->spawnWrite );
		}
		$this->spawnWrite = false;
		if ( $this->spawnErr ) {
			fclose( $this->spawnErr );
		}
		$this->spawnErr = false;
		if ( $this->spawnProc ) {
			pclose( $this->spawnProc );
		}
		$this->spawnProc = false;
		wfRestoreWarnings();
	}

	private function getTextSpawnedOnce( $id ) {
		global $wgContLang;

		$ok = fwrite( $this->spawnWrite, "$id\n" );
		// $this->progress( ">> $id" );
		if ( !$ok ) {
			return false;
		}

		$ok = fflush( $this->spawnWrite );
		// $this->progress( ">> [flush]" );
		if ( !$ok ) {
			return false;
		}

		// check that the text id they are sending is the one we asked for
		// this avoids out of sync revision text errors we have encountered in the past
		$newId = fgets( $this->spawnRead );
		if ( $newId === false ) {
			return false;
		}
		if ( $id != intval( $newId ) ) {
			return false;
		}

		$len = fgets( $this->spawnRead );
		// $this->progress( "<< " . trim( $len ) );
		if ( $len === false ) {
			return false;
		}

		$nbytes = intval( $len );
		// actual error, not zero-length text
		if ( $nbytes < 0 ) {
			return false;
		}

		$text = "";

		// Subprocess may not send everything at once, we have to loop.
		while ( $nbytes > strlen( $text ) ) {
			$buffer = fread( $this->spawnRead, $nbytes - strlen( $text ) );
			if ( $buffer === false ) {
				break;
			}
			$text .= $buffer;
		}

		$gotbytes = strlen( $text );
		if ( $gotbytes != $nbytes ) {
			$this->progress( "Expected $nbytes bytes from database subprocess, got $gotbytes " );

			return false;
		}

		// Do normalization in the dump thread...
		$stripped = str_replace( "\r", "", $text );
		$normalized = $wgContLang->normalize( $stripped );

		return $normalized;
	}

	function startElement( $parser, $name, $attribs ) {
		$this->checkpointJustWritten = false;

		$this->clearOpenElement( null );
		$this->lastName = $name;

		if ( $name == 'revision' ) {
			$this->state = $name;
			$this->egress->writeOpenPage( null, $this->buffer );
			$this->buffer = "";
		} elseif ( $name == 'page' ) {
			$this->state = $name;
			if ( $this->atStart ) {
				$this->egress->writeOpenStream( $this->buffer );
				$this->buffer = "";
				$this->atStart = false;
			}
		}

		if ( $name == "text" && isset( $attribs['id'] ) ) {
			$text = $this->getText( $attribs['id'] );
			$this->openElement = array( $name, array( 'xml:space' => 'preserve' ) );
			if ( strlen( $text ) > 0 ) {
				$this->characterData( $parser, $text );
			}
		} else {
			$this->openElement = array( $name, $attribs );
		}
	}

	function endElement( $parser, $name ) {
		$this->checkpointJustWritten = false;

		if ( $this->openElement ) {
			$this->clearOpenElement( "" );
		} else {
			$this->buffer .= "</$name>";
		}

		if ( $name == 'revision' ) {
			$this->egress->writeRevision( null, $this->buffer );
			$this->buffer = "";
			$this->thisRev = "";
		} elseif ( $name == 'page' ) {
			if ( !$this->firstPageWritten ) {
				$this->firstPageWritten = trim( $this->thisPage );
			}
			$this->lastPageWritten = trim( $this->thisPage );
			if ( $this->timeExceeded ) {
				$this->egress->writeClosePage( $this->buffer );
				// nasty hack, we can't just write the chardata after the
				// page tag, it will include leading blanks from the next line
				$this->egress->sink->write( "\n" );

				$this->buffer = $this->xmlwriterobj->closeStream();
				$this->egress->writeCloseStream( $this->buffer );

				$this->buffer = "";
				$this->thisPage = "";
				// this could be more than one file if we had more than one output arg

				$filenameList = (array)$this->egress->getFilenames();
				$newFilenames = array();
				$firstPageID = str_pad( $this->firstPageWritten, 9, "0", STR_PAD_LEFT );
				$lastPageID = str_pad( $this->lastPageWritten, 9, "0", STR_PAD_LEFT );
				$filenamesCount = count( $filenameList );
				for ( $i = 0; $i < $filenamesCount; $i++ ) {
					$checkpointNameFilledIn = sprintf( $this->checkpointFiles[$i], $firstPageID, $lastPageID );
					$fileinfo = pathinfo( $filenameList[$i] );
					$newFilenames[] = $fileinfo['dirname'] . '/' . $checkpointNameFilledIn;
				}
				$this->egress->closeRenameAndReopen( $newFilenames );
				$this->buffer = $this->xmlwriterobj->openStream();
				$this->timeExceeded = false;
				$this->timeOfCheckpoint = $this->lastTime;
				$this->firstPageWritten = false;
				$this->checkpointJustWritten = true;
			} else {
				$this->egress->writeClosePage( $this->buffer );
				$this->buffer = "";
				$this->thisPage = "";
			}
		} elseif ( $name == 'mediawiki' ) {
			$this->egress->writeCloseStream( $this->buffer );
			$this->buffer = "";
		}
	}

	function characterData( $parser, $data ) {
		$this->clearOpenElement( null );
		if ( $this->lastName == "id" ) {
			if ( $this->state == "revision" ) {
				$this->thisRev .= $data;
			} elseif ( $this->state == "page" ) {
				$this->thisPage .= $data;
			}
		}
		// have to skip the newline left over from closepagetag line of
		// end of checkpoint files. nasty hack!!
		if ( $this->checkpointJustWritten ) {
			if ( $data[0] == "\n" ) {
				$data = substr( $data, 1 );
			}
			$this->checkpointJustWritten = false;
		}
		$this->buffer .= htmlspecialchars( $data );
	}

	function clearOpenElement( $style ) {
		if ( $this->openElement ) {
			$this->buffer .= Xml::element( $this->openElement[0], $this->openElement[1], $style );
			$this->openElement = false;
		}
	}
}
