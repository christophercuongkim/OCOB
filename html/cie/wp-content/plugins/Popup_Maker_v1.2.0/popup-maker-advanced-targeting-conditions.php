<?php
/**
 * Plugin Name: Popup Maker - Advanced Targeting Conditions
 * Plugin URI: https://wppopupmaker.com/extensions/advanced-targeting-conditions/
 * Description: Adds advanced targeting conditions.
 * Author: WP Popup Maker
 * Version: 1.2.0
 * Author URI: https://wppopupmaker.com/
 * Text Domain: popup-maker-advanced-targeting-conditions
 * Requires Popup Maker: 1.4.19
 *
 * @author       WP Popup Maker
 * @copyright    Copyright (c) 2016, WP Popup Maker
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class Autoloader
 *
 * @param $class
 */
function pum_atc_autoloader( $class ) {

	// project-specific namespace prefix
	$prefix = 'PUM_ATC_';

	// base directory for the namespace prefix
	$base_dir = __DIR__ . '/classes/';

	// does the class use the namespace prefix?
	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		// no, move to the next registered autoloader
		return;
	}

	// get the relative class name
	$relative_class = substr( $class, $len );

	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir . str_replace( '_', '/', $relative_class ) . '.php';

	// if the file exists, require it
	if ( file_exists( $file ) ) {
		require_once $file;
	}

}

if ( ! function_exists( 'spl_autoload_register' ) ) {
	include 'includes/compat.php';
}

spl_autoload_register( 'pum_atc_autoloader' ); // Register autoloader

/**
 * Class PUM_ATC
 */
class PUM_ATC {

	/**
	 * @var int
	 */
	public static $ID = 5108;

	/**
	 * @var string
	 */
	public static $NAME = 'Advanced Targeting Conditions';

	/**
	 * @var string
	 */
	public static $VER = '1.2.0';

	/**
	 * @var int DB Version
	 */
	public static $DB_VER = 2;

	/**
	 * @var string
	 */
	public static $URL = '';

	/**
	 * @var string
	 */
	public static $DIR = '';

	/**
	 * @var string
	 */
	public static $FILE = '';
	
	/**
	 * @var         PUM_ATC $instance The one true PUM_ATC
	 * @since       1.0.0
	 */
	private static $instance;

	/**
	 * Get active instance
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      object self::$instance The one true PUM_ATC
	 */
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new static;
			self::$instance->setup_constants();

			self::$instance->load_textdomain();

			self::$instance->includes();
			self::$instance->init();
		}

		return self::$instance;
	}

	/**
	 * Setup plugin constants
	 *
	 * @access      private
	 * @since       1.0.0
	 * @return      void
	 */
	private function setup_constants() {
		PUM_ATC::$DIR  = self::$instance->plugin_path();
		PUM_ATC::$URL  = self::$instance->plugin_url();
		PUM_ATC::$FILE = __FILE__;
	}

	/**
	 * Include necessary files
	 *
	 * @access      private
	 * @since       1.0.0
	 * @return      void
	 */
	private function includes() {}

	/**
	 * Initialize everything
	 *
	 * @access      private
	 * @since       1.0.0
	 * @return      void
	 */
	private function init() {

		PUM_ATC_Site_Assets::init();
		PUM_ATC_Conditions::init();
		PUM_ATC_Migration::init();

		// Handle licensing
		if ( class_exists( 'PUM_Extension_License' ) ) {
			new PUM_Extension_License( self::$FILE, self::$NAME, self::$VER, 'WP Popup Maker' );
		}
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return plugin_dir_path( __FILE__ );
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return plugins_url( '/', __FILE__ );
	}

	/**
	 * Internationalization
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'popup-maker-advanced-targeting-conditions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Get Ajax URL.
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

}

/**
 * Get the ball rolling. Fire up the correct version.
 */
function pum_atc_init() {
	if ( ! class_exists( 'Popup_Maker' ) && ! class_exists( 'PUM' ) ) {
		if ( ! class_exists( 'PUM_Extension_Activation' ) ) {
			require_once 'includes/pum-sdk/class-pum-extension-activation.php';
		}

		$activation = new PUM_Extension_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
		$activation->run();
	} else {
		PUM_ATC::instance();
	}
}
add_action( 'plugins_loaded', 'pum_atc_init' );
