<?php
/**
 * @file
 * @author Niklas Laxström
 * @license GPL-2.0+
 */

/**
 * Interface for file readers.
 */
interface LU_Reader {
	/**
	 * Returns a list of messages indexed by language code. Example
	 *  array( 'en' => array( 'key' => 'value' ) );
	 * @param string $contents File contents as a string.
	 * @return array
	 */
	public function parse( $contents );
}
