<?php

/*
Plugin Name: GroupDocs Viewer Embedder
Plugin URI: http://www.groupdocs.com/
Description: Lets you embed PPT, PPTX, XLS, XLSX, DOC, DOCX, PDF and many other formats from your GroupDocs acount in a web page using the GroupDocs Embedded Viewer (no Flash or PDF browser plug-ins required).
Author: GroupDocs Team <support@groupdocs.com>
Author URI: http://www.groupdocs.com/
Version: 1.4.7
License: GPLv2
*/

include_once('grpdocs-functions.php');


function grpdocs_getdocument($atts) {

	extract(shortcode_atts(array(
		'file' => '',
		'width' => '',
		'height' => '',
		'protocol' => '',
        'fullscreen' => '',
        'download' => '',
        'print' => '',
        'use_pdf' => '',
        'use_scrollbar' => '',
        'quality' => '',
		'page' => 0,
		'version' => 1,
	), $atts));

    if(class_exists('GroupDocsRequestSigner')){
        $signer = new GroupDocsRequestSigner(get_option('viewer_privateKey'));
    }else{
        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/APIClient.php');
        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/StorageApi.php');
        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/GroupDocsRequestSigner.php');
        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/FileStream.php');
        $signer = new GroupDocsRequestSigner(get_option('viewer_privateKey'));
    }
    // Use scrollbar in iframe
    $use_scrollbar == 'True' ? $use_scrollbar = "scrolling='yes'" : $use_scrollbar = "scrolling='no' style='min-width: {$width}px;min-height: {$height}px'";


	$no_iframe = "If you can see this text, your browser does not support iframes. Please enable iframe support in your browser or use the latest version of any popular web browser such as Mozilla Firefox or Google Chrome. For more help, please check our documentation Wiki: <a href='http://groupdocs.com/docs/display/Viewer/GroupDocs+Viewer+Integration+with+3rd+Party+Platforms'>http://groupdocs.com/docs/display/Viewer/GroupDocs+Viewer+Integration+with+3rd+Party+Platforms</a>";

	if (isset($protocol) && $protocol == 'https') {
		$code = "https://apps.groupdocs.com/document-viewer/embed/{$file}";
	} 
	else {
		$code = "http://apps.groupdocs.com/document-viewer/embed/{$file}";
	}

    $url = $signer->signUrl($code);
    $button = '';
    if($fullscreen == "True"){
        wp_enqueue_script('grpdocs-fullscreen', plugins_url('js/groupdocs-fullscreen.js', __FILE__),array('jquery'));
        $button = '<input type="button" value="Fullscreen" onClick="jQuery(document).fullScreen(true)"></input>';
    }

    $code = "<iframe id='gd_viewer' src='{$url}&quality={$quality}&use_pdf={$use_pdf}&download={$download}&print={$print}&referer=wordpress-viewer/1.4.7' frameborder='0' width='{$width}' height='{$height}' {$use_scrollbar} webkitAllowFullScreen mozallowfullscreen allowFullScreen  >{$no_iframe}</iframe>";
 	return $button . $code;
}
function gd_script() {
    wp_enqueue_script('grpdocs-fullscreen', plugins_url('js/jquery.fullscreen.js', __FILE__),array('jquery'));
}
//activate shortcode
add_shortcode('grpdocsview', 'grpdocs_getdocument');

//add_action( 'wp_enqueue_scripts', 'gd_script' );

// editor integration

// add quicktag
add_action( 'admin_print_scripts', 'grpdocs_admin_print_scripts' );

// add tinymce button
add_action('admin_init','grpdocs_mce_addbuttons');

// add an option page
add_action('admin_menu', 'grpdocs_option_page');

register_uninstall_hook( __FILE__, 'groupdocs_viewer_deactivate' );

function groupdocs_viewer_deactivate()
{
	delete_option('viewer_userId');
	delete_option('viewer_privateKey');	

}
function grpdocs_option_page() {
	global $grpdocs_settings_page;

	$grpdocs_settings_page = add_options_page('GroupDocs Viewer', 'GroupDocs Viewer', 'manage_options', basename(__FILE__), 'grpdocs_options');

}
function grpdocs_options() {
	if ( function_exists('current_user_can') && !current_user_can('manage_options') ) die(t('An error occurred.'));
	if (! user_can_access_admin_page()) wp_die('You do not have sufficient permissions to access this page');

	require(ABSPATH. 'wp-content/plugins/groupdocs-viewer/options.php');
}
