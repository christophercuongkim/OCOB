<?php
/*
Plugin Name: Collapsing Pages OCOB
Plugin URI: http://blog.robfelty.com/plugins/collapsing-pages
Description: Uses javascript to expand and collapse pages to show the posts that belong to the link category 
Author: Cal Poly OCOB
Version: 1.0
Author URI: 
Tags: sidebar, widget, pages

Copyright 2011 Cal Poly OCOB

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
$collapsPageVersion = '0.5.3';
if (!is_admin()) {
  add_action('wp_head', wp_enqueue_script('jquery'));
  add_action('wp_head', wp_enqueue_script('collapsFunctions',
  "$url/wp-content/plugins/collapsing-pages/collapsFunctions.js",'', '1.6'));
  add_action( 'wp_head', array('collapsPage','get_head'));
} else {
  // call upgrade function if current version is lower than actual version
  $dbversion = get_option('collapsPageVersion');
  if (!$dbversion || $collapsPageVersion != $dbversion)
    collapsPage::init();
}
add_action('init', array('collapsPage','init_textdomain'));
add_action('activate_collapsing-pages/collapsPage.php', array('collapsPage','init'));
add_action('admin_menu', array('collapsPage','setup'));

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

	function setup() {
		if( function_exists('add_options_page') &&
        current_user_can('manage_options')) {
			add_options_page(__('Collapsing Pages', 'collapsing-pages'),__('Collapsing
      Pages', 'collapsing-pages'),1,basename(__FILE__),array('collapsPage','ui'));
		}
	}
	function ui() {
		include_once( 'collapsPageUI.php' );
	}

	function get_head() {
    $style=stripslashes(get_option('collapsPageStyle'));
    echo "<style type='text/css'>
    $style
    </style>\n";

	}
}


function collapsPage($args='') {
  if (!is_admin()) {
    include_once( 'collapsPageList.php' );
    list_pages($args);
  }
}
include('collapsPageWidget.php');
?>
