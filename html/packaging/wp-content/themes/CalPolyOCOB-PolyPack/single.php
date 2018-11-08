<?php// File: single.php ?>
<?php
$post = $wp_query->post;
$thisdir = dirname(__FILE__).'/';
$directory = get_term_by('name', 'Directory', 'category');
if (get_current_blog_id() == 7) { //EP Site
	echo "<!-- EP Redirect -->";
	include($thisdir.'single-ep.php');
} elseif ($directory !== false && in_category($directory->term_id, $post->ID)){
	echo '<h1>DIRECTORY</h1>';
	include($thisdir.'single-employee_profile.php');
} elseif (get_current_blog_id() == 9) {
	include($thisdir.'single-handbook.php');
}else{ // Everything else
	echo "<!-- Defult Redirectio -->";
	include($thisdir.'single-default.php');
}
?>