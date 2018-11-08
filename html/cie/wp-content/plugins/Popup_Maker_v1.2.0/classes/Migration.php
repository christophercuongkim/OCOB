<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class PUM_ATC_Migration
 */
class PUM_ATC_Migration {

	/**
	 * Initialization
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'process_updates' ) );
	}

	/**
	 * Used to check for and process individual updates.
	 */
	public static function process_updates() {

		$v  = PUM_ATC::$DB_VER;
		$cv = get_option( 'pum_atc_db_ver', 0 );

		if ( ! $cv || $v > $cv ) {

			// Assume initial release was db_ver 1.
			if ( ! $cv ) {
				$cv = 1;
			}

			for ( ; $v > $cv; $cv ++ ) {
				PUM_ATC_Migration::run( $cv );
			}

		}

	}


	/**
	 * Runs a specific update.
	 *
	 * @param null $version
	 */
	public static function run( $version = null ) {
		if ( ! $version ) {
			return;
		}

		if ( ! method_exists( __CLASS__, 'v' . $version . '_migration' ) ) {
			return;
		}

		ignore_user_abort( true );

		if ( ! pum_is_func_disabled( 'set_time_limit' ) && ! ini_get( 'safe_mode' ) ) {
			@set_time_limit( 0 );
		}

		call_user_func( array( __CLASS__, 'v' . $version . '_migration' ) );

		if ( method_exists( __CLASS__, 'v' . $version . '_cleanup' ) ) {
			call_user_func( array( __CLASS__, 'v' . $version . '_cleanup' ) );
		}

		update_option( 'pum_atc_db_ver', $version + 1 );
	}

	/**
	 * DB v2 Migration
	 */
	public static function v1_migration() {

		$popups = get_posts( array(
			'post_type'      => 'popup',
			'post_status'    => array( 'any', 'trash' ),
			'posts_per_page' => - 1,
		) );

		foreach ( $popups as $popup ) {
			PUM_ATC_Migration::v1_convert_conditions( $popup->ID );
		}


	}

	/**
	 * DB v2 Condition Mapping
	 *
	 * @param $popup_id
	 */
	public static function v1_convert_conditions( $popup_id ) {
		$popup          = new PUM_Popup( $popup_id );
		$conditions     = $popup->get_conditions();
		$old_conditions = PUM_ATC_Migration::v1_get_conditions( $popup_id );

		if ( empty( $old_conditions ) ) {
			return;
		}

		foreach ( $old_conditions as $old ) {
			$old = wp_parse_args( $old, array(
				'target'    => '',
				'condition' => '',
				'options'   => array(),
			) );

			$new = array(
				'target'      => '',
				'not_operand' => false,
			);

			if ( empty( $old['target'] ) ) {
				continue;
			}

			switch ( $old['target'] ) {
				case 'user':
					if ( in_array( $old['condition'], array( 'is_logged_in', 'is_not_logged_in' ) ) ) {
						$new['target'] = 'user_is_logged_in';
					}
					if ( in_array( $old['condition'], array( 'has_user_role', 'is_not_user_role' ) ) ) {
						$new['target']   = 'user_has_role';
						$new['selected'] = ! empty( $old['options']['roles'] ) ? $old['options']['roles'] : array();
					}
					if ( in_array( $old['condition'], array(
						'has_commented',
						'has_not_commented',
						'has_commented_at_least',
					) ) ) {
						$new['target']   = 'user_has_commented';
						$new['morethan'] = ! empty( $old['options']['minimum_comments'] ) ? $old['options']['minimum_comments'] : '';
					}
					break;

				case 'query_string':
					if ( in_array( $old['condition'], array( 'argument_exists', 'argument_does_not_exist' ) ) ) {
						$new['target']   = 'query_arg_exists';
						$new['arg_name'] = ! empty( $old['options']['query_arg'] ) ? $old['options']['query_arg'] : '';
					}
					if ( in_array( $old['condition'], array( 'argument_is', 'argument_is_not' ) ) ) {
						$new['target']    = 'query_arg_is';
						$new['arg_name']  = ! empty( $old['options']['query_arg'] ) ? $old['options']['query_arg'] : '';
						$new['arg_value'] = ! empty( $old['options']['query_arg_value'] ) ? $old['options']['query_arg_value'] : '';
					}
					break;

				case 'referrer':
					switch ( $old['condition'] ) {
						case 'is_url':
							$new['target'] = 'referrer_is';
							$new['search'] = ! empty( $old['options']['url'] ) ? $old['options']['url'] : '';
							break;
						case 'url_contains':
							$new['target'] = 'referrer_contains';
							$new['search'] = ! empty( $old['options']['url_contains'] ) ? $old['options']['url_contains'] : '';
							break;
						case 'is_external_link':
							$new['target'] = 'referrer_is_external';
							break;
						case 'is_search_engine':
							$new['target'] = 'referrer_is_search_engine';
							$new['search'] = ! empty( $old['options']['search_engines'] ) ? $old['options']['search_engines'] : array();
							break;
					}
					break;

				case 'device':
					if ( in_array( $old['condition'], array( 'is_mobile', 'is_not_mobile' ) ) ) {
						$new['target'] = 'device_is_mobile';
					}
					if ( in_array( $old['condition'], array( 'is_mobile_brand', 'is_not_mobile_brand' ) ) ) {
						$new['target']   = 'device_is_brand';
						$new['selected'] = ! empty( $old['options']['mobile_brands'] ) ? $old['options']['mobile_brands'] : array();
					}
					break;

				case 'browser':
					if ( in_array( $old['condition'], array( 'browser_is', 'browser_is_not' ) ) ) {
						$new['target']   = 'browser_is';
						$new['selected'] = ! empty( $old['options']['browsers'] ) ? $old['options']['browsers'] : array();
					}
					if ( $old['condition'] == 'version_higher_than' ) {
						$new['target']   = 'browser_version';
						$new['morethan'] = ! empty( $old['options']['browser_version'] ) ? $old['options']['browser_version'] : '';
					}
					if ( $old['condition'] == 'version_lower_than' ) {
						$new['target']   = 'browser_version';
						$new['lessthan'] = ! empty( $old['options']['browser_version'] ) ? $old['options']['browser_version'] : '';
					}
					break;

				case 'custom':
					if ( $old['condition'] == 'function' ) {
						$new['target']        = 'php_function';
						$new['function_name'] = ! empty( $old['options']['custom_function'] ) ? $old['options']['custom_function'] : '';
					}
					break;
			}

			// Check for not operand usage.
			switch ( $old['condition'] ) {
				case 'is_not_logged_in':
				case 'is_not_user_role':
				case 'has_not_commented':
				case 'argument_does_not_exist':
				case 'argument_is_not':
				case 'is_not_mobile':
				case 'is_not_mobile_brand':
				case 'browser_is_not':
					$new['not_operand'] = true;
					break;
			}

			// Add new AND condition group with this condition.
			$conditions[][] = $new;
		}

		update_post_meta( $popup_id, 'popup_conditions', $conditions );

		delete_post_meta( $popup_id, 'popup_advanced_targeting_conditions' );
	}

	/**
	 * Get DB v1 Condition data.
	 *
	 * @param int $popup_id
	 *
	 * @return array|mixed
	 */
	public static function v1_get_conditions( $popup_id = 0 ) {
		$advanced_targeting_conditions = get_post_meta( $popup_id, 'popup_advanced_targeting_conditions', true );

		return ! empty( $advanced_targeting_conditions ) ? $advanced_targeting_conditions : array();
	}

	/**
	 * Clean up old meta keys.
	 */
	public static function v1_cleanup() {
		global $wpdb;

		$meta_keys = array( 'popup_advanced_targeting_conditions' );

		$meta_keys = implode( "','", $meta_keys );

		$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key IN('$meta_keys');" );
	}

}
