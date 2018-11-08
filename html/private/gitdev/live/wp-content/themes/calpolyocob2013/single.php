<?php
	echo '<h1>SINGLE!</h1>';
$post = $wp_query->post;
$thisdir = dirname(__FILE__).'/';
$directory = get_term_by('name', 'Directory', 'category');

if (get_current_blog_id() == 36) { //EP Site
	include($thisdir.'single-ep.php');
} elseif ($directory !== false && in_category($directory->term_id, $post->ID)){
	echo '<h1>DIRECTORY</h1>';
	include($thisdir.'single-employee_profile.php');
}else{ // Everything else
	include($thisdir.'single-default.php');
}
?>