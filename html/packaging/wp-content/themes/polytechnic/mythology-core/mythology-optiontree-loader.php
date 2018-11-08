<?php

/* ---------------------------------------------------------*/
/* OPTION TREE - Load Theme Options Panel */
/* ---------------------------------------------------------*/

add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_pages', '__return_true' );
add_filter( 'ot_show_options_ui', '__return_false' );
add_filter( 'ot_show_settings_import', '__return_true' );
add_filter( 'ot_show_settings_export', '__return_true' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_show_docs', '__return_false' );

require_once( trailingslashit( get_template_directory() ) . 'mythology-core/option-tree/ot-loader.php' ); // Load OptionTree.

/* Load up our admin JS and Stylesheets */

add_action('admin_enqueue_scripts', 'mythology_admin_script');
function mythology_admin_script(){
     if(ot_get_option('options_skin') == "off" ) : ; else :
     wp_enqueue_style ( 'mythology-candy-stylesheet', get_template_directory_uri(). '/mythology-core/option-tree-candy-skin/candy-admin-simple.css', array('ot-admin-css') );
     wp_enqueue_style ( 'mythology-admin-stylesheet', get_template_directory_uri(). '/mythology-core/option-tree-candy-skin/candy-plugin-notification.css');
     wp_enqueue_script('mythology-admin-js', get_template_directory_uri(). '/mythology-core/option-tree-candy-skin/candy-admin.js' );
     endif;
  }

?>