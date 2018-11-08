<?php
/*
Plugin Name: Widget Visibility
Plugin URI: http://www.codefleet.net/widget-visibility/
Description: Control which pages your widgets appear on WordPress
Version: 1.3.1
Author: Nico Amarilla
Author URI: http://www.codefleet.net/
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

require_once 'src/autoloader.php';

// Hook the plugin
add_action('plugins_loaded', 'widvis_init');
function widvis_init() {
    
    $plugin = new WidVis_Plugin();

    $plugin['path'] = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR;
    $plugin['url'] = plugin_dir_url(__FILE__);
    $plugin['textdomain'] = 'widvis';
    $plugin['view_folder'] = $plugin['path'].'views';

    $plugin['plugin_headers'] = 'widvis_service_plugin_headers';
    $plugin['version'] = 'widvis_service_plugin_version';
    $plugin['slug'] = 'widvis_service_plugin_slug';
    $plugin['view'] = new WidVis_View( $plugin['view_folder'] );
    $plugin['admin'] = 'widvis_service_admin';
    $plugin['deactivate'] = new WidVis_Deactivate($plugin['textdomain'], $plugin['slug'], $plugin['view']);

    load_plugin_textdomain( $plugin['textdomain'], false, basename(dirname(__FILE__)).'/languages/' ); // Load language files

    $plugin->run();
}

// Service Definitions
function widvis_service_plugin_headers(){

    $default_headers = array(
        'name' => 'Plugin Name',
        'plugin_uri' => 'Plugin URI',
        'version' => 'Version',
        'author' => 'Author',
        'author_uri' => 'Author URI',
        'license' => 'License',
        'license_uri' => 'License URI',
        'domain_path' => 'Domain Path',
        'text_domain' => 'Text Domain'
    );
    $object = get_file_data( __FILE__, $default_headers, 'plugin' ); // WP Func

    return $object;
}

function widvis_service_plugin_version($plugin){
    $object = $plugin['plugin_headers']['version'];
    return $object;
}

function widvis_service_plugin_slug() {
    $parts = pathinfo(__FILE__);
    $object = basename($parts['dirname']).'/'.$parts['basename'];
    return $object;
}

function widvis_service_admin( $plugin ) {

    $object = new WidVis_Admin(
        $plugin['version'],
        $plugin['url'],
        $plugin['textdomain'],
        $plugin['slug'],
        $plugin['view']
    );
    return $object;
}