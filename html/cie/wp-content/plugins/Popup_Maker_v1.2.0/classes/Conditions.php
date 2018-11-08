<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class PUM_ATC_Conditions
 */
class PUM_ATC_Conditions {

	/**
	 * Initialization
	 */
	public static function init() {
		add_filter( 'pum_get_conditions', array( __CLASS__, 'get_conditions' ) );
		add_filter( 'pum_condition_sort_order', array( __CLASS__, 'condition_sort_order' ) );
	}

	/**
	 * Merges all the Advanced Conditions into the available conditions array.
	 *
	 * @param array $conditions
	 *
	 * @return array
	 */
	public static function get_conditions( $conditions = array() ) {

		# region User conditions
		$conditions['user_is_logged_in']  = array(
			'group'    => __( 'User', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Is Logged In', 'popup-maker-advanced-targerting-conditions' ),
			),
			'callback' => 'is_user_logged_in',
		);
		$conditions['user_has_role']      = array(
			'group'    => __( 'User', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Has Role', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'selected' => array(
					'placeholder' => __( 'Select User Roles', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'select',
					'select2'     => true,
					'multiple'    => true,
					'as_array'    => true,
					'options'     => array_flip( self::allowed_user_roles() ),
				),
			),
			'callback' => array( 'PUM_ATC_Condition_Callbacks', 'user_has_role' ),
		);
		$conditions['user_has_commented'] = array(
			'group'    => __( 'User', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Has Commented', 'popup-maker-advanced-targeting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => 'More Than (optional)',
					'type'  => 'number',
					'std'   => 0,
				),
				'lessthan' => array(
					'label' => 'Less Than (optional)',
					'type'  => 'number',
					'std'   => 0,
				),
			),
			'callback' => array( 'PUM_ATC_Condition_Callbacks', 'user_has_commented' ),
		);

		$conditions['page_views']  = array(
			'advanced' => true,
			'group'    => __( 'User', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Has Viewed X Pages', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => __( 'More Than (optional)', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 100,
					'unit'  => 'px',
				),
				'lessthan' => array(
					'label' => __( 'Less Than (optional)', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 100,
					'unit'  => 'px',
				),
			),
		);

		$conditions['has_viewed_page']  = array(
			'advanced' => true,
			'group'    => __( 'User', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Has Viewed Selected Pages', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'selected' => array(
					'label' => __( 'Comma list of IDs', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
					'placeholder' => '41,85,199',
				),
			),
		);

		$conditions['time_on_site']  = array(
			'advanced' => true,
			'group'    => __( 'User', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Time On Site', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => __( 'More Than (minutes, optional)', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 100,
					'unit'  => 'M',
				),
				'lessthan' => array(
					'label' => __( 'Less Than (minutes, optional)', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 100,
					'unit'  => 'M',
				),
			),
		);

		# endregion

		# region URL conditions
		$conditions['url_is']          = array(
			'advanced' => true,
			'group'    => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'URL Is', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Exact URL', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['url_contains']    = array(
			'advanced' => true,
			'group'    => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'URL Contains', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Contains', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['url_begins_with'] = array(
			'advanced' => true,
			'group'    => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'URL Begins With', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Begins With', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['url_ends_with']   = array(
			'advanced' => true,
			'group'    => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'URL Ends With', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Ends With', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['url_regex']       = array(
			'advanced' => true,
			'group'    => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'URL Regex Search', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Valid RegExp', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		# endregion

		# region Query Arg conditions
		$conditions['query_arg_exists'] = array(
			'advanced' => true,
			'group'    => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Query Argument Exists', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'arg_name' => array(
					'placeholder' => __( '?argument_name=value', 'popup-maker-advanced-targerting-conditions' ),
					'label'       => __( 'Agument Name', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
			),
		);
		$conditions['query_arg_is']     = array(
			'advanced' => true,
			'group'    => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Query Argument Is', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'arg_name'  => array(
					'placeholder' => __( '?argument_name=value', 'popup-maker-advanced-targerting-conditions' ),
					'label'       => __( 'Argument Name', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
				'arg_value' => array(
					'placeholder' => __( '?argument_name=value', 'popup-maker-advanced-targerting-conditions' ),
					'label'       => __( 'Agument Value', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
			),
		);
		# endregion

		# region Referrer conditions
		$conditions['referrer_is']               = array(
			'advanced' => true,
			'group'    => __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Referrer URL Is', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'URL', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['referrer_contains']         = array(
			'advanced' => true,
			'group'    => __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Referrer URL Contains', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Contains', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['referrer_begins_with']      = array(
			'advanced' => true,
			'group'    => __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Referrer URL Begins With', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Begins With', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['referrer_ends_with']        = array(
			'advanced' => true,
			'group'    => __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Referrer URL Ends With', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Ends With', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['referrer_regex']            = array(
			'advanced' => true,
			'group'    => __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Referrer Regex Search', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'label' => __( 'Valid RegExp', 'popup-maker-advanced-targerting-conditions' ),
					'type'  => 'text',
				),
			),
		);
		$conditions['referrer_is_search_engine'] = array(
			'advanced' => true,
			'group'    => __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Referrer Is Search Engine', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'search' => array(
					'placeholder' => __( 'Select Search Engines', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'select',
					'select2'     => true,
					'multiple'    => true,
					'as_array'    => true,
					'options'     => array(
						__( 'Google', 'popup-maker-advanced-targeting-conditions' ) => __( 'www.google.com', 'popup-maker-advanced-targeting-conditions' ),
						__( 'Bing', 'popup-maker-advanced-targeting-conditions' )   => __( 'www.bing.com', 'popup-maker-advanced-targeting-conditions' ),
						__( 'Yahoo', 'popup-maker-advanced-targeting-conditions' )  => __( 'search.yahoo.com', 'popup-maker-advanced-targeting-conditions' ),
					),
				),
			),
		);
		$conditions['referrer_is_external']      = array(
			'advanced' => true,
			'group'    => __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Referrer Is External URL', 'popup-maker-advanced-targerting-conditions' ),
			),
		);
		# endregion

		# region Browser conditions
		$conditions['browser_is']      = array(
			'advanced' => true,
			'group'    => __( 'Browser', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Is Specific Browser', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'selected' => array(
					'placeholder' => __( 'Select Browsers', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'select',
					'select2'     => true,
					'multiple'    => true,
					'as_array'    => true,
					'options'     => array(
						__( 'Internet Explorer' ) => 'Internet Explorer',
						__( 'Firefox' )           => 'Firefox',
						__( 'Safari' )            => 'Safari',
						__( 'Chrome' )            => 'Chrome',
						__( 'Android Browser' )   => 'Android Browser',
						__( 'Opera' )             => 'Opera',
					),
				),
			),
		);
		$conditions['browser_version'] = array(
			'advanced' => true,
			'group'    => __( 'Browser', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Version Is', 'popup-maker-advanced-targeting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => 'Higher Than',
					'type'  => 'number',
				),
				'lessthan' => array(
					'label' => 'Lower Than',
					'type'  => 'number',
				),
			),
		);
		$conditions['browser_width']   = array(
			'advanced' => true,
			'group'    => __( 'Browser', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Browser Width', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => 'More Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
				'lessthan' => array(
					'label' => 'Less Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
			),
		);
		$conditions['browser_height']  = array(
			'advanced' => true,
			'group'    => __( 'Browser', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Browser Height', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => 'More Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
				'lessthan' => array(
					'label' => 'Less Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
			),
		);
		# endregion

		# region Device conditions
		$conditions['device_is_mobile']     = array(
			'advanced' => true,
			'group'    => __( 'Device', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Device Is Mobile', 'popup-maker-advanced-targerting-conditions' ),
			),
		);
		$conditions['device_is_phone']      = array(
			'advanced' => true,
			'group'    => __( 'Device', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Device Is Phone', 'popup-maker-advanced-targerting-conditions' ),
			),
		);
		$conditions['device_is_tablet']     = array(
			'advanced' => true,
			'group'    => __( 'Device', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Device Is Tablet', 'popup-maker-advanced-targerting-conditions' ),
			),
		);
		$conditions['device_is_brand']      = array(
			'advanced' => true,
			'group'    => __( 'Device', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Device Is Brand', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'selected' => array(
					'placeholder' => __( 'Select Brands', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'select',
					'select2'     => true,
					'multiple'    => true,
					'as_array'    => true,
					'options'     => array(
						__( 'iPhone', 'popup-maker-advanced-targeting-conditions' )     => 'iPhone',
						__( 'BlackBerry', 'popup-maker-advanced-targeting-conditions' ) => 'BlackBerry',
						__( 'HTC', 'popup-maker-advanced-targeting-conditions' )        => 'HTC',
						__( 'Nexus', 'popup-maker-advanced-targeting-conditions' )      => 'Nexus',
						__( 'Motorola', 'popup-maker-advanced-targeting-conditions' )   => 'Motorola',
						__( 'Dell', 'popup-maker-advanced-targeting-conditions' )       => 'Dell',
						__( 'Samsung', 'popup-maker-advanced-targeting-conditions' )    => 'Samsung',
						__( 'LG', 'popup-maker-advanced-targeting-conditions' )         => 'LG',
						__( 'Sony', 'popup-maker-advanced-targeting-conditions' )       => 'Sony',
						__( 'Asus', 'popup-maker-advanced-targeting-conditions' )       => 'Asus',
						__( 'Micromax', 'popup-maker-advanced-targeting-conditions' )   => 'Micromax',
						__( 'Palm', 'popup-maker-advanced-targeting-conditions' )       => 'Palm',
						__( 'Vertu', 'popup-maker-advanced-targeting-conditions' )      => 'Vertu',
						__( 'Pantech', 'popup-maker-advanced-targeting-conditions' )    => 'Pantech',
						__( 'Fly', 'popup-maker-advanced-targeting-conditions' )        => 'Fly',
						__( 'iMobile', 'popup-maker-advanced-targeting-conditions' )    => 'iMobile',
						__( 'SimValley', 'popup-maker-advanced-targeting-conditions' )  => 'SimValley',
						__( 'Wolfgang', 'popup-maker-advanced-targeting-conditions' )   => 'Wolfgang',
						__( 'Alcatel', 'popup-maker-advanced-targeting-conditions' )    => 'Alcatel',
						__( 'Nintendo', 'popup-maker-advanced-targeting-conditions' )   => 'Nintendo',
						__( 'Amoi', 'popup-maker-advanced-targeting-conditions' )       => 'Amoi',
						__( 'INQ', 'popup-maker-advanced-targeting-conditions' )        => 'INQ',
						__( 'Generic', 'popup-maker-advanced-targeting-conditions' )    => 'Generic',
					),
				),
			),
		);
		$conditions['device_screen_width']  = array(
			'advanced' => true,
			'group'    => __( 'Device', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Screen Width', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => 'More Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
				'lessthan' => array(
					'label' => 'Less Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
			),
		);
		$conditions['device_screen_height'] = array(
			'advanced' => true,
			'group'    => __( 'Device', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Screen Height', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'morethan' => array(
					'label' => 'More Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
				'lessthan' => array(
					'label' => 'Less Than (optional)',
					'type'  => 'number',
					'std'   => 0,
					'min'   => 0,
					'step'  => 1,
					'max'   => 1080,
					'unit'  => 'px',
				),
			),
		);

		/*
		array(
			__( 'Windows' )	=> 'Windows',
			__( 'Macintosh' )	=> 'Macintosh',
			__( 'Linux' )	=> 'Linux',
		)
		array(
			__( 'iOS', 'popup-maker-advanced-targeting-conditions' )	=> 'iOS',
			__( 'AndroidOS', 'popup-maker-advanced-targeting-conditions' )	=> 'AndroidOS',
			__( 'BlackBerryOS', 'popup-maker-advanced-targeting-conditions' )	=> 'BlackBerryOS',
			__( 'PalmOS', 'popup-maker-advanced-targeting-conditions' )	=> 'PalmOS',
			__( 'SymbianOS', 'popup-maker-advanced-targeting-conditions' )	=> 'SymbianOS',
			__( 'WindowsMobileOS', 'popup-maker-advanced-targeting-conditions' )	=> 'WindowsMobileOS',
			__( 'WindowsPhoneOS', 'popup-maker-advanced-targeting-conditions' )	=> 'WindowsPhoneOS',
			__( 'MeeGoOS', 'popup-maker-advanced-targeting-conditions' )	=> 'MeeGoOS',
			__( 'MaemoOS', 'popup-maker-advanced-targeting-conditions' )	=> 'MaemoOS',
			__( 'JavaOS', 'popup-maker-advanced-targeting-conditions' )	=> 'JavaOS',
			__( 'webOS', 'popup-maker-advanced-targeting-conditions' )	=> 'webOS',
			__( 'badaOS', 'popup-maker-advanced-targeting-conditions' )	=> 'badaOS',
			__( 'BREWOS', 'popup-maker-advanced-targeting-conditions' )	=> 'BREWOS',
		)
		 */
		# endregion

		# region Cookie conditions
		$conditions['cookie_exists'] = array(
			'advanced' => true,
			'group'    => __( 'Cookie', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Cookie Exists', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'cookie_name' => array(
					'label'       => __( 'Cookie Name', 'popup-maker-advanced-targerting-conditions' ),
					'placeholder' => __( 'my-cookie', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
			),
		);
		$conditions['cookie_is']     = array(
			'advanced' => true,
			'group'    => __( 'Cookie', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Cookie Is', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'cookie_name'  => array(
					'label'       => __( 'Cookie Name', 'popup-maker-advanced-targerting-conditions' ),
					'placeholder' => __( 'page_count', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
				'cookie_value' => array(
					'label'       => __( 'Cookie Value', 'popup-maker-advanced-targerting-conditions' ),
					'placeholder' => __( '10', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
			),
		);
		# endregion

		# region Function conditions
		$conditions['php_function'] = array(
			'group'    => __( 'Custom', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Custom PHP Function', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'function_name' => array(
					'label'       => __( 'Custom Function Name', 'popup-maker-advanced-targerting-conditions' ),
					'placeholder' => __( 'user_is_logged_in', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
			),
			'callback' => array( 'PUM_ATC_Condition_Callbacks', 'php_function' ),
		);
		$conditions['js_function']  = array(
			'advanced' => true,
			'group'    => __( 'Custom', 'popup-maker-advanced-targerting-conditions' ),
			'labels'   => array(
				'name' => __( 'Custom JS Function', 'popup-maker-advanced-targerting-conditions' ),
			),
			'fields'   => array(
				'function_name' => array(
					'label'       => __( 'Custom Function Name', 'popup-maker-advanced-targerting-conditions' ),
					'placeholder' => __( 'callback_function', 'popup-maker-advanced-targerting-conditions' ),
					'type'        => 'text',
				),
			),
		);

		# endregion

		return $conditions;
	}

	/**
	 * Gets a filterable array of the allowed user roles.
	 *
	 * @return array|mixed|void
	 */
	public static function allowed_user_roles() {
		global $wp_roles;

		static $roles;

		if ( ! isset( $roles ) ) {
			$roles = apply_filters( 'pum_atc_user_roles', $wp_roles->role_names );

			if ( ! is_array( $roles ) || empty( $roles ) ) {
				$roles = array();
			}

		}

		return $roles;
	}

	/**
	 * Allows sorting of the advanced condition groups.
	 *
	 * @param array $order
	 *
	 * @return array
	 */
	public static function condition_sort_order( $order = array() ) {

		$order[ __( 'User', 'popup-maker-advanced-targerting-conditions' ) ]     = 20;
		$order[ __( 'URL', 'popup-maker-advanced-targerting-conditions' ) ]      = 20;
		$order[ __( 'Referrer', 'popup-maker-advanced-targerting-conditions' ) ] = 20;
		$order[ __( 'Browser', 'popup-maker-advanced-targerting-conditions' ) ]  = 20;
		$order[ __( 'Device', 'popup-maker-advanced-targerting-conditions' ) ]   = 20;
		$order[ __( 'Custom', 'popup-maker-advanced-targerting-conditions' ) ]   = 20;

		return $order;
	}

}
