<?php

function WPJJ_SWFOBJECT_plugin_url( $path = '' )
{
  return plugins_url( $path, WPJJ_SWFOBJECT_PLUGIN_BASENAME );
}

function WPJJ_SWFOBJECT_enqueue_scripts()
{
  if( !is_admin() )
  {
    wp_enqueue_script( 'swfobject', WPJJ_SWFOBJECT_plugin_url( 'swfobject/swfobject.js' ), array('jquery'), '', false );
  }
}

function WPJJ_SWFOBJECT_enqueue_styles()
{
  if( !is_admin() )
  {
    wp_enqueue_style( 'jj-swfoject-style', WPJJ_SWFOBJECT_plugin_url( 'stylesheets/style.css' ), array(), '', 'all' );
  }
}

function WPJJ_SWFOBJECT_use_default($instance, $key)
{
  return !array_key_exists($key, $instance) || trim($instance[$key]) == '';
}

function jj_swfobject_shortcode_handler($atts)
{
  $instance = array();
  foreach($atts as $att => $val)
  {
    $instance[$att] = $val;
  }

  // Set defaults
  if(WPJJ_SWFOBJECT_use_default($instance, 'html_id')) { $instance['html_id'] = 'jj_swfobject'; }
  $instance['shortcode'] = '1';

  ob_start();
  the_widget("JJ_SwfObject", $instance, array());
  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}

?>