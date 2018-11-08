<?php

require_once WPJJ_SWFOBJECT_PLUGIN_DIR . '/includes/functions.php';
require_once WPJJ_SWFOBJECT_PLUGIN_DIR . '/includes/jj_swfobject.php';

add_action( 'widgets_init', create_function('', 'return register_widget("JJ_SwfObject");') );
add_shortcode( 'jj-swfobject', 'jj_swfobject_shortcode_handler' );

if( !is_admin() )
{
  add_action( 'init', 'WPJJ_SWFOBJECT_enqueue_scripts' );
  add_action( 'init', 'WPJJ_SWFOBJECT_enqueue_styles' );  
}

?>