<?php
//UTILS

function tshowcase_strip_http($url) {	
	$url = preg_replace('#^https?://#', '', $url);
    return $url;
}

//To Show styled messages
function tshowcase_message($msg) { ?>
<div id="message" class="updated"><p><?php echo $msg; ?></p></div>
<?php	
}

function tshowcase_get_img_style($style) {
	
	global $ts_imgstyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_imgstyles)) {
		$css .= $ts_imgstyles[$st].' ';
		}
	}
	
	return $css;
}

function tshowcase_get_info_style($style) {
	
	global $ts_infostyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_infostyles)) {
		$css .= $ts_infostyles[$st].' ';
		}
	}
	
	return $css;
}


function tshowcase_get_box_style($style) {
	
	global $ts_boxstyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_boxstyles)) {
		$css .= $ts_boxstyles[$st].' ';
		}
	}
	
	return $css;
}

function tshowcase_get_innerbox_style($style) {
	
	global $ts_innerboxstyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_innerboxstyles)) {
		$css .= $ts_innerboxstyles[$st].' ';
		}
	}
	
	return $css;
}


function tshowcase_get_wrap_style($style) {
	
	global $ts_wrapstyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_wrapstyles)) {
		$css .= $ts_wrapstyles[$st].' ';
		}
	}
	
	return $css;
}


function tshowcase_get_txt_style($style) {
	global $ts_txtstyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_txtstyles)) {
		$css .= $ts_txtstyles[$st].' ';
		}
	}
	
	return $css;
}

function tshowcase_get_pager_style($style) {
	global $ts_pagerstyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_pagerstyles)) {
		$css .= $ts_pagerstyles[$st].' ';
		}
	}
	
	return $css;
}

function tshowcase_get_pager_box_style($style) {
	global $ts_pagerboxstyles;
	
	$css = "";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$ts_pagerboxstyles)) {
		$css .= $ts_pagerboxstyles[$st].' ';
		}
	}
	
	return $css;
}

function tshowcase_get_themes($style,$layout) {
	global $ts_theme_names;
	
	$themearray = $ts_theme_names[$layout];
		
	$css = "default";
	$styles = explode(',',$style);
	
	foreach ($styles as $st) {
	if(array_key_exists($st,$themearray)) {
		$css = $themearray[$st]['key'];
		}
	}
		
	return $css;
}


//CREATE MAILTO LINKS
function tshowcase_mailto_filter($str) {
    //$regex = '/(\S+@\S+\.\S+)/';
    //$replace = '<a href="mailto:$1">$1</a>';
	//return preg_replace($regex, $replace, $str);

	return "<a href='mailto:".$str."'>".$str."</a>";
	//return "<a href='mailto:".$str."'>email me</a>";
}

function tshowcase_mailto_filter_ico($str) {
    //$regex = '/(\S+@\S+\.\S+)/';
    //$replace = 'mailto:$1';
    //return preg_replace($regex, $replace, $str);
    return "mailto:".$str;
}

function tshowcase_pagination($loop) {

		global $ts_labels;

		$max_page = $loop->max_num_pages;
		$numbers = "";

		$ii = 1;
		while ($ii <= $max_page) {
			$current = (isset($_GET['tpage']) && $_GET['tpage'] == $ii) || (!isset($_GET['tpage']) && $ii == 1) ? 'tshowcase_current_page' : '';
			$numbers .= " <a class='tshowcase_page ".$current."' data-page-number='".$ii."' href='?tpage=".$ii."'>".$ii."</a> ";
			$ii++;
		}


		$html = "<div class='tshowcase_pager'>";

		if(isset($_GET['tpage']) && $_GET['tpage']!='1' && $_GET['tpage'] < $max_page){ 
			
			$next = intval($_GET['tpage']) + 1;
			$previous = intval($_GET['tpage'])-1;

			$html .= "<a class='tshowcase_previous' data-page-number='".$previous."' href='?tpage=".$previous."'>".$ts_labels['pagination']['previous_page']."</a>";
			$html .= $numbers;
			$html .= "<a class='tshowcase_next' data-page-number='".$next."' href='?tpage=".$next."'>".$ts_labels['pagination']['next_page']."</a>";

		} if(!isset($_GET['tpage']) || $_GET['tpage']=='1' ) {

			$html .= $numbers." <a data-page-number='2' class='tshowcase_next_page' href='?tpage=2'>".$ts_labels['pagination']['next_page']."</a>";
		
		}

		if(isset($_GET['tpage']) && $_GET['tpage']!='1' && $_GET['tpage']>=$max_page){ 
			
			
			$previous = intval($_GET['tpage'])-1;

			$html .= "<a class='tshowcase_previous_page' data-page-number='".$previous."' href='?tpage=".$previous."'>".$ts_labels['pagination']['previous_page']."</a>";
			$html .= $numbers;
			

		} 

		$html .= "</div>";
		return $html;

}

//To filter links
function tshowcase_custom_link( $url, $post ) {

	if ( 'tshowcase' == get_post_type( $post ) ) {

		$tsuser = get_post_meta( $post->ID , '_tspersonal', true );

		if($tsuser!='') {

			return $tsuser;

		}

		else {

			return $url;

		}

	}

	return $url;

}

function tshowcase_custom_link_empty( $url, $post ) {

	if ( 'tshowcase' == get_post_type( $post ) ) {

		$tsuser = get_post_meta( $post->ID , '_tspersonal', true );

		if($tsuser!='') {

			return $tsuser;

		}

		else {

			return '';

		}

	}

	return $url;

}

function tshowcase_author_link( $url, $post ) {

	if ( 'tshowcase' == get_post_type( $post ) ) {

		$tsuser = get_post_meta( $post->ID , '_tsuser', true );

		if($tsuser!='0') {

			return get_author_posts_url($tsuser);

		}

		else {

			return $url;

		}

	}

	return $url;

}

//To order by last name
function tshowcase_posts_orderby_lastname ($orderby_statement) 
{
	
  	$orderby_statement = "RIGHT(post_title, LOCATE(' ', REVERSE(post_title)) - 1) DESC";
    return $orderby_statement;
}


//Custom CSS

function tshowcase_custom_css () {
	$options = get_option( 'tshowcase-settings' );
	$css = $options['tshowcase_custom_css'];
	if($css!=''){
		echo '
		<!-- Custom Styles for Team Showcase -->
		<style type="text/css">
		'.$css.'
		</style>';
	}
	$js = $options['tshowcase_custom_js'];
	if($js!=''){
		echo "
		<!-- Custom Javascript for Team Showcase -->
		<script type='text/javascript'>
		".$js."
		</script>";
	}
}


?>