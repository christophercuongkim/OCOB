<?php
/**
 * Dummy object caching.
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
 * @ingroup Cache
 */

/**
 * A BagOStuff object with no objects in it. Used to provide a no-op object to calling code.
 *
 * @ingroup Cache
 */
class EmptyBagOStuff extends BagOStuff {

	/**
	 * @param $key string
	 * @param $casToken[optional] mixed
	 * @return bool
	 */
	function get( $key, &$casToken = null ) {
		return false;
	}

	/**
	 * @param $key string
	 * @param $value mixed
	 * @param $exp int
	 * @return bool
	 */
	function set( $key, $value, $exp = 0 ) {
		return true;
	}

	/**
	 * @param $casToken mixed
	 * @param $key string
	 * @param $value mixed
	 * @param $exp int
	 * @return bool
	 */
	function cas( $casToken, $key, $value, $exp = 0 ) {
		return true;
	}

	/**
	 * @param $key string
	 * @param $time int
	 * @return bool
	 */
	function delete( $key, $time = 0 ) {
		return true;
	}

	/**
	 * @param $key string
	 * @param $callback closure Callback method to be executed
	 * @param int $exptime Either an interval in seconds or a unix timestamp for expiry
	 * @param int $attempts The amount of times to attempt a merge in case of failure
	 * @return bool success
	 */
	public function merge( $key, closure $callback, $exptime = 0, $attempts = 10 ) {
		return true;
	}
}
