<?php
/*
Plugin Name: Collapsing Pages
Plugin URI: http://blog.robfelty.com/plugins/collapsing-pages
Description: Uses javascript to expand and collapse pages to show the posts that belong to the link category 
Author: Robert Felty
Version: 1.0.1
Author URI: http://robfelty.com
Tags: sidebar, widget, pages

Copyright 2007-2010 Robert Felty

This file is part of Collapsing Pages

		Collapsing Pages is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published by 
    the Free Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    Collapsing Pages is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Pages; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/ 


global $collapsPageVersion;
$collapsPageVersion = '1.0.1';
if (!is_admin()) {
  add_action('wp_head', wp_enqueue_script('jquery'));
  add_action( 'wp_head', array('collapsPage','get_head'));
} else {
  // call upgrade function if current version is lower than actual version
  $dbversion = get_option('collapsPageVersion');
  if (!$dbversion || $collapsPageVersion != $dbversion)
    collapsPage::init();
}
add_action('init', array('collapsPage','init_textdomain'));
add_action('activate_collapsing-pages/collapsPage.php', array('collapsPage','init'));

class collapsPage {
	function init_textdomain() {
	  $plugin_dir = basename(dirname(__FILE__));
	  load_plugin_textdomain( 'collapsing-pages', 'wp-content/plugins/' . $plugin_dir, $plugin_dir );
	}

	function init() {
    global $collapsPageVersion;
	  include('collapsPageStyles.php');
		$defaultStyles=compact('selected','default','block','noArrows','custom');
    $dbversion = get_option('collapsPageVersion');
    if ($collapsPageVersion != $dbversion && $selected!='custom') {
      $style = $defaultStyles[$selected];
      update_option( 'collapsPageStyle', $style);
      update_option( 'collapsPageVersion', $collapsPageVersion);
    }
		$defaultStyles=compact('selected','default','block','noArrows','custom');
    if( function_exists('add_option') ) {
      update_option( 'collapsPageOrigStyle', $style);
      update_option( 'collapsPageDefaultStyles', $defaultStyles);
    }
    if (!get_option('collapsPageStyle')) {
      add_option( 'collapsPageStyle', $style);
		}
    if (!get_option('collapsPageSidebarId')) {
      add_option( 'collapsPageSidebarId', 'sidebar');
		}
    if (!get_option('collapsPageVersion')) {
      add_option( 'collapsPageVersion', $collapsPageVersion);
		}
	}


	function get_head() {
    echo "<style type='text/css'>\n";
    echo collapsPage::set_styles();
    echo "</style>\n";

	}

  function set_styles() {
    $widget_options = get_option('widget_collapspage');
    include('collapsPageStyles.php');
    $css = '';
    $oldStyle=true;
    foreach ($widget_options as $key=>$value) {
      $id = "widget-collapspage-$key-top";
      if (isset($value['style'])) {
        $oldStyle=false;
        $style = $defaultStyles[$value['style']];
        $css .= str_replace('{ID}', '#' . $id, $style);
      }
    }
    if ($oldStyle)
      $css=stripslashes(get_option('collapsPageStyle'));
    return($css);
  }
}


function collapsPage($args='') {
  if (!is_admin()) {
    extract($args);
    include('symbols.php');
    include_once( 'collapsPageList.php' );
    list_pages($args);
		$url = get_settings('siteurl');
		echo "<li style='display:none'><script type=\"text/javascript\">\n";
		echo "// <![CDATA[\n";
		echo '
/* These variables are part of the Collapsing Pages Plugin
* version: 1.0.1
* revision: $Id: collapsPage.php 1413262 2016-05-09 18:59:55Z robfelty $
* Copyright 2007-2010 Robert Felty (robfelty.com)
*/'. "\n";
    echo "var expandSym=\"$expandSym\";";
    echo "var collapseSym=\"$collapseSym\";";
    include_once('collapsFunctions.js');
    if ( ! $accordion ) {
      $accordion = '0'; // false sometimes echos as blank
    }
    echo "addExpandCollapse('widget-collapspage-$number-top'," . 
        "'$expandSym', '$collapseSym', " . $accordion . ")";
		echo ";\n// ]]>\n</script></li>\n";
  }
}
include('collapsPageWidget.php');
?>
