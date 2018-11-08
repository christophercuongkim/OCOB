<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class PUM_ATC_Condition_Callbacks
 */
class PUM_ATC_Condition_Callbacks {

	/**
	 * Checks if a user has one of the selected roles.
	 *
	 * @param array $settings
	 *
	 * @return bool
	 */
	public static function user_has_role( $settings = array() ) {

		if ( ! is_user_logged_in() ) {
			return false;
		} else {

			if ( empty( $settings['selected'] ) ) {
				return true;
			}
		}

		// Get Enabled Roles to check for.
		$user_roles     = array_keys( PUM_ATC_Conditions::allowed_user_roles() );
		$required_roles = array_intersect( $user_roles, $settings['selected'] );

		if ( empty( $required_roles ) ) {
			return true;
		}

		$check = false;
		foreach ( $required_roles as $role ) {
			if ( current_user_can( $role ) ) {
				$check = true;
				break;
			}
		}

		return $check;
	}

	/**
	 * Checks if user has commented.
	 *
	 * Accepts more than & less than arguments as well.
	 *
	 * @param array $settings
	 *
	 * @return bool
	 */
	public static function user_has_commented( $settings = array() ) {
		if ( ! is_user_logged_in() ) {
			return false;
		}

		$user_ID = get_current_user_id();
		$args    = array(
			'user_id' => $user_ID, // use user_id
			'count'   => true //return only the count
		);

		$comments = get_comments( $args );

		if ( $settings['morethan'] && ! $settings['lessthan'] ) {
			return $comments > $settings['morethan'];
		}

		if ( $settings['lessthan'] && ! $settings['morethan'] ) {
			return $settings['lessthan'] > $comments;
		}

		if ( $settings['lessthan'] && $settings['morethan'] ) {
			return $settings['lessthan'] > $comments && $comments > $settings['morethan'];
		}

		return $comments > 0;
	}

	/**
	 * Calls a custom function by name and returns a boolean representation.
	 *
	 * @param array $settings
	 *
	 * @return bool
	 */
	public static function php_function( $settings = array() ) {
		if ( ! empty( $settings['function_name'] ) && is_callable( $settings['function_name'] ) ) {
			return (bool) call_user_func( $settings['function_name'] );
		}

		return false;
	}

}
