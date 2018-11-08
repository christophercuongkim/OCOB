<?php
/*
Plugin Name: Inline Javascript Plugin
Plugin URI: http://www.ooso.net/inline-js
Feed URI: http://feed.ooso.net
Description: Plugin that insert inline javascript in Posts/Pages 
Version: 0.6
Author: Volcano
Author URI: http://www.ooso.net
*/

$_inline_autop = defined('EXECPHP_VERSION') ? false : true; 
$_inline_excerpt = true;

function inline_autop($content) {
	global $_inline_autop;

	$str = str_replace(array('[inline]', '[/inline]'), '', $content);
	if($str != $content)
		$_inline_autop = false;

	if($_inline_autop) {
		$content = wpautop($content);
		$content = wptexturize($content);
		$content = convert_chars($content);
	}

	return $content;
}

function inline_javascript($content){
	global $_inline_autop;

	$str = $content;
	$str = preg_replace_callback('/\[inline\](.*?)\[\/inline\]/is', 'inline_render', $content);

	if(is_home() or is_page() or is_single())
		$str = str_replace(array('[inline]', '[/inline]'), '', $str);

	return $str;
}

function inline_render($m) {
	$str = $m[1];
	$str = str_replace('[/script]', '</script>', $str);
	$str = preg_replace(array("/\[script(.*?)\]/i"), array("<script$1>"), $str);
	return $str;
}

function inline_callback($m) {
	$str = $m[0];
	$str = str_replace(array('</script>', '</SCRIPT>'), '[/script]', $str);
	$str = preg_replace(array("'<script(.*?)>'i"), array("[script$1]"), $str);
	return $str;
}

function inline_save_pre($content) {
	$str = preg_replace_callback('/\[inline\](.*?)\[\/inline\]/is', 'inline_callback', $content);
	return $str;
}

// {{{ content filter
remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');
remove_filter('the_content', 	'convert_chars');

add_filter('content_save_pre', 	'inline_save_pre',		0);
add_filter('the_content', 		'inline_javascript', 	99);
add_filter('the_content', 		'inline_autop',			1);

add_filter('content_edit_pre',	'inline_save_pre');
// }}}

// {{{ excerpt filter
if($_inline_excerpt) {
	remove_filter('the_excerpt',	'wpautop');
	remove_filter('the_excerpt',	'wptexturize');
	remove_filter('the_excerpt', 	'convert_chars');

	add_filter('excerpt_save_pre', 	'inline_save_pre',		0);
	add_filter('the_excerpt', 		'inline_javascript', 	99);
	add_filter('the_excerpt', 		'inline_autop',			1);

	add_filter('excerpt_edit_pre',	'inline_save_pre');
}
// }}}
