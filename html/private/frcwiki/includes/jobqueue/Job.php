<?php
/**
 * Job queue task base code.
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
 * @defgroup JobQueue JobQueue
 */

/**
 * Class to both describe a background job and handle jobs.
 * The queue aspects of this class are now deprecated.
 * Using the class to push jobs onto queues is deprecated (use JobSpecification).
 *
 * @ingroup JobQueue
 */
abstract class Job implements IJobSpecification {
	/** @var string */
	public $command;

	/** @var array|bool Array of job parameters or false if none */
	public $params;

	/** @var array Additional queue metadata */
	public $metadata = array();

	/** @var Title */
	protected $title;

	/** @var bool Expensive jobs may set this to true */
	protected $removeDuplicates;

	/** @var string Text for error that occurred last */
	protected $error;

	/*-------------------------------------------------------------------------
	 * Abstract functions
	 *------------------------------------------------------------------------*/

	/**
	 * Run the job
	 * @return bool Success
	 */
	abstract public function run();

	/*-------------------------------------------------------------------------
	 * Static functions
	 *------------------------------------------------------------------------*/

	/**
	 * Create the appropriate object to handle a specific job
	 *
	 * @param string $command Job command
	 * @param Title $title Associated title
	 * @param array|bool $params Job parameters
	 * @throws MWException
	 * @return Job
	 */
	public static function factory( $command, Title $title, $params = false ) {
		global $wgJobClasses;
		if ( isset( $wgJobClasses[$command] ) ) {
			$class = $wgJobClasses[$command];

			return new $class( $title, $params );
		}
		throw new MWException( "Invalid job command `{$command}`" );
	}

	/**
	 * Batch-insert a group of jobs into the queue.
	 * This will be wrapped in a transaction with a forced commit.
	 *
	 * This may add duplicate at insert time, but they will be
	 * removed later on, when the first one is popped.
	 *
	 * @param array $jobs Array of Job objects
	 * @return bool
	 * @deprecated since 1.21
	 */
	public static function batchInsert( $jobs ) {
		JobQueueGroup::singleton()->push( $jobs );
		return true;
	}

	/**
	 * Insert a group of jobs into the queue.
	 *
	 * Same as batchInsert() but does not commit and can thus
	 * be rolled-back as part of a larger transaction. However,
	 * large batches of jobs can cause slave lag.
	 *
	 * @param array $jobs Array of Job objects
	 * @return bool
	 * @deprecated since 1.21
	 */
	public static function safeBatchInsert( $jobs ) {
		JobQueueGroup::singleton()->push( $jobs, JobQueue::QOS_ATOMIC );
		return true;
	}

	/**
	 * Pop a job of a certain type.  This tries less hard than pop() to
	 * actually find a job; it may be adversely affected by concurrent job
	 * runners.
	 *
	 * @param string $type
	 * @return Job|bool Returns false if there are no jobs
	 * @deprecated since 1.21
	 */
	public static function pop_type( $type ) {
		return JobQueueGroup::singleton()->get( $type )->pop();
	}

	/**
	 * Pop a job off the front of the queue.
	 * This is subject to $wgJobTypesExcludedFromDefaultQueue.
	 *
	 * @return Job|bool False if there are no jobs
	 * @deprecated since 1.21
	 */
	public static function pop() {
		return JobQueueGroup::singleton()->pop();
	}

	/*-------------------------------------------------------------------------
	 * Non-static functions
	 *------------------------------------------------------------------------*/

	/**
	 * @param string $command
	 * @param Title $title
	 * @param array|bool $params
	 */
	public function __construct( $command, $title, $params = false ) {
		$this->command = $command;
		$this->title = $title;
		$this->params = $params;

		// expensive jobs may set this to true
		$this->removeDuplicates = false;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->command;
	}

	/**
	 * @return Title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return array
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * @return int|null UNIX timestamp to delay running this job until, otherwise null
	 * @since 1.22
	 */
	public function getReleaseTimestamp() {
		return isset( $this->params['jobReleaseTimestamp'] )
			? wfTimestampOrNull( TS_UNIX, $this->params['jobReleaseTimestamp'] )
			: null;
	}

	/**
	 * @return bool Whether only one of each identical set of jobs should be run
	 */
	public function ignoreDuplicates() {
		return $this->removeDuplicates;
	}

	/**
	 * @return bool Whether this job can be retried on failure by job runners
	 * @since 1.21
	 */
	public function allowRetries() {
		return true;
	}

	/**
	 * @return int Number of actually "work items" handled in this job
	 * @see $wgJobBackoffThrottling
	 * @since 1.23
	 */
	public function workItemCount() {
		return 1;
	}

	/**
	 * Subclasses may need to override this to make duplication detection work.
	 * The resulting map conveys everything that makes the job unique. This is
	 * only checked if ignoreDuplicates() returns true, meaning that duplicate
	 * jobs are supposed to be ignored.
	 *
	 * @return array Map of key/values
	 * @since 1.21
	 */
	public function getDeduplicationInfo() {
		$info = array(
			'type' => $this->getType(),
			'namespace' => $this->getTitle()->getNamespace(),
			'title' => $this->getTitle()->getDBkey(),
			'params' => $this->getParams()
		);
		if ( is_array( $info['params'] ) ) {
			// Identical jobs with different "root" jobs should count as duplicates
			unset( $info['params']['rootJobSignature'] );
			unset( $info['params']['rootJobTimestamp'] );
			// Likewise for jobs with different delay times
			unset( $info['params']['jobReleaseTimestamp'] );
		}

		return $info;
	}

	/**
	 * @see JobQueue::deduplicateRootJob()
	 * @param string $key A key that identifies the task
	 * @return array Map of:
	 *   - rootJobSignature : hash (e.g. SHA1) that identifies the task
	 *   - rootJobTimestamp : TS_MW timestamp of this instance of the task
	 * @since 1.21
	 */
	public static function newRootJobParams( $key ) {
		return array(
			'rootJobSignature' => sha1( $key ),
			'rootJobTimestamp' => wfTimestampNow()
		);
	}

	/**
	 * @see JobQueue::deduplicateRootJob()
	 * @return array
	 * @since 1.21
	 */
	public function getRootJobParams() {
		return array(
			'rootJobSignature' => isset( $this->params['rootJobSignature'] )
				? $this->params['rootJobSignature']
				: null,
			'rootJobTimestamp' => isset( $this->params['rootJobTimestamp'] )
				? $this->params['rootJobTimestamp']
				: null
		);
	}

	/**
	 * @see JobQueue::deduplicateRootJob()
	 * @return bool
	 * @since 1.22
	 */
	public function hasRootJobParams() {
		return isset( $this->params['rootJobSignature'] )
			&& isset( $this->params['rootJobTimestamp'] );
	}

	/**
	 * Insert a single job into the queue.
	 * @return bool True on success
	 * @deprecated since 1.21
	 */
	public function insert() {
		JobQueueGroup::singleton()->push( $this );
		return true;
	}

	/**
	 * @return string
	 */
	public function toString() {
		$truncFunc = function ( $value ) {
			$value = (string)$value;
			if ( mb_strlen( $value ) > 1024 ) {
				$value = "string(" . mb_strlen( $value ) . ")";
			}
			return $value;
		};

		$paramString = '';
		if ( $this->params ) {
			foreach ( $this->params as $key => $value ) {
				if ( $paramString != '' ) {
					$paramString .= ' ';
				}
				if ( is_array( $value ) ) {
					$filteredValue = array();
					foreach ( $value as $k => $v ) {
						if ( is_scalar( $v ) ) {
							$filteredValue[$k] = $truncFunc( $v );
						} else {
							$filteredValue = null;
							break;
						}
					}
					if ( $filteredValue ) {
						$value = FormatJson::encode( $filteredValue );
					} else {
						$value = "array(" . count( $value ) . ")";
					}
				} elseif ( is_object( $value ) && !method_exists( $value, '__toString' ) ) {
					$value = "object(" . get_class( $value ) . ")";
				}

				$paramString .= "$key={$truncFunc( $value )}";
			}
		}

		if ( is_object( $this->title ) ) {
			$s = "{$this->command} " . $this->title->getPrefixedDBkey();
			if ( $paramString !== '' ) {
				$s .= ' ' . $paramString;
			}

			return $s;
		} else {
			return "{$this->command} $paramString";
		}
	}

	protected function setLastError( $error ) {
		$this->error = $error;
	}

	public function getLastError() {
		return $this->error;
	}
}
