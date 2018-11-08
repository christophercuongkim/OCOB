<?php
$post = $wp_query->post;
$thisdir = dirname(__FILE__).'/';
if (get_current_blog_id() == 36) { //EP Site
	include($thisdir.'category-ep.php');
} else { // Everything else
	include($thisdir.'category-default.php');
}
?>