<?php// File: category.php ?>
<?php
$post = $wp_query->post;
$thisdir = dirname(__FILE__).'/';
if (get_current_blog_id() == 7) { //EP Site
	include($thisdir.'category-ep.php');
} elseif (get_current_blog_id() == 10) { // LITC
	include($thisdir.'category-litc.php');
} else { // Everything else
	include($thisdir.'category-default.php');
}
?>