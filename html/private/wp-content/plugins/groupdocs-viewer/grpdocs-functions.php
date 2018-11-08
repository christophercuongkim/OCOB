<?php

if ( ! defined( 'GRPDOCS_PLUGIN_URL' ) )  define( 'GRPDOCS_PLUGIN_URL', WP_PLUGIN_URL . '/groupdocs-viewer');

function grpdocs_getGuid($link = "http://apps.groupdocs.com/document-viewer/17b5b1da8d3227b12a28e1780e2beab76e760ecc5f9f5e6fc8594edc189eb786/1") {
    preg_match('/([0-9a-f]){64}/', $link, $matches);
    return isset($matches[0]) ? $matches[0] : '';
}

function grpdocs_mce_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;

   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "grpdocs_add_tinymce_plugin");
     add_filter('mce_buttons', 'grpdocs_register_mce_button');
   }
}

function grpdocs_register_mce_button($buttons) {
   array_push($buttons, "separator", "grpdocs");
   return $buttons;
}

function grpdocs_add_tinymce_plugin($plugin_array) {
	// Load the TinyMCE plugin
   $plugin_array['grpdocs'] = GRPDOCS_PLUGIN_URL.'/js/grpdocs_plugin.js';
   return $plugin_array;
}

function grpdocs_admin_print_scripts($arg) {
	global $pagenow;
	if (is_admin() && ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) ) {
		$js = GRPDOCS_PLUGIN_URL.'/js/grpdocs-quicktags.js';
		wp_enqueue_script("grpdocs_qts", $js, array('quicktags') );
	}
}

// footer credit
function grpdocs_admin_footer() {
	$pdata = get_plugin_data(__FILE__);
	printf('%1$s plugin | Version %2$s<br />', $pdata['Title'], $pdata['Version']);
}
