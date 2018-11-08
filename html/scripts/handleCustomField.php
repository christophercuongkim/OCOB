<?php
	$postID = $_POST["postID"];
	$value = $_POST["value"];
	update_post_meta($post_id, "sidebarSelectArea", $value);
?>