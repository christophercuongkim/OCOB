<?php

//
//Single Member Page Check

function tshowcase_member_page($content) {
	
	$html = "";
	$infodiv = array();
	
	global $post;
	global $ts_display_order;
	
	$options = get_option('tshowcase-settings');

	$options['tshowcase_single_photo_shape'] = isset($options['tshowcase_single_photo_shape']) ? $options['tshowcase_single_photo_shape'] : 'img-square';
	$imgstyle = tshowcase_get_img_style($options['tshowcase_single_photo_shape']);

	if(is_singular( 'tshowcase' )) {

		add_action('wp_footer', 'tshowcase_custom_css');

	}
		
	if(is_singular( 'tshowcase' ) && $options['tshowcase_single_page_style']!="none") {

		
	$truesocial = false; 
	if(isset($options['tshowcase_single_show_social']))	{
		$truesocial = true;
	}

	//if rich snippet for person is ON
	$itemscope = "itemscope itemtype='http://data-vocabulary.org/Person'";
	
	$html = "<div id='tshowcase-single-wrap' ".$itemscope." >";

	//display meta field
	//$tsposition = get_post_meta( $post->ID, '_tsposition', true );
	//$html .= '<div id="tshowcase-single-position" item-prop="role">'.$tsposition.'</div>';

	
	tshowcase_add_global_css();		
		
					
		//RESPONSIVE
		if($options['tshowcase_single_page_style']=="responsive") {		
			$html .=  '<div class="tshowcase-row-fluid">';		
			$html .=  '<div class="ts-col_3">';	
			//$html .= get_the_post_thumbnail( $post->ID, 'full' );		
			$html .= '<div class="'.$imgstyle.'">'.tshowcase_get_image($post->ID).'</div>';	//image	
			//$html .= '<div class="tshowcase-single-title">'.get_the_title($post->ID).'</div>';	// title		
			$html .= tshowcase_get_information($post->ID,true,array(),true);	//Information
			$html .= '<div class="tshowcase-box-social">';
			$html .= tshowcase_get_social($post->ID,$truesocial);	//social links	
			//$html .= tshowcase_get_twitter($post->ID);	//twitter
			$html .= '</div></div><div class="ts-col_3c">';						
			$html .= $content;					
			$html .= tshowcase_latest_posts($post->ID); //show latest posts
			$html .= '</div></div>';
			}
		
		//VCARD
		if($options['tshowcase_single_page_style']=="vcard") {		
			$html .=  '<div class="tshowcase-vcard">';	
			$html .= '<div class="tshowcase-vcard-left">';	
			$html .= '<div class="'.$imgstyle.'">'.tshowcase_get_image($post->ID).'</div>';	//image	
			$html .= '</div>';
						
			$html .=  '<div class="tshowcase-vcard-right">';						
			
			$infodiv['details'] = tshowcase_get_information($post->ID,true,array(),true);	//Information	
			$infodiv['social'] = '<div class="tshowcase-box-social">';
			$infodiv['social'] .= tshowcase_get_social($post->ID,$truesocial);	//social links		
			$infodiv['social'] .= '</div>';
			
			//ordering
			foreach ($ts_display_order as $info) {
					if(isset($infodiv[$info])) {
					$html.=$infodiv[$info];
					}
				}
			
			
			$html .= '</div>';	
			$html .= '<div class="ts-clear-both">&nbsp;</div></div>';								
			$html .= $content;	
			//$html .= tshowcase_get_twitter($post->ID);	//twitter - currently not working			
			$html .= tshowcase_latest_posts($post->ID); //show latest posts			
			}
		
		
			
			
		$html .= "</div>";	
		return $html;
	}

	else {
		return $content;
	}
	
	
	
}

add_filter( 'the_content', 'tshowcase_member_page' );






/*Add a Back Button */
//add_filter( 'the_content', 'tshowcase_back_button' );
function tshowcase_back_button($content) {

	if(is_singular( 'tshowcase' )) {
		$urlcode = '<div id="tshowcase_back"><a href="javascript:history.back()">Go Back</a></div>';
		$content = $urlcode.$content; 
	}

	return $content; 
}

/* Add Navigation */
//add_filter( 'the_content', 'tshowcase_navigation_links' );
function tshowcase_navigation_links($content) {
	if(is_singular( 'tshowcase' )) {
		
		$content .= 'XX'.get_previous_posts_link('Go to next page'); 
	}

	return $content; 
	
}


function tshowcase_vc_filter($content) {

	global $post;
	$options = get_option('tshowcase-settings');
	$options['tshowcase_single_photo_shape'] = isset($options['tshowcase_single_photo_shape']) ? $options['tshowcase_single_photo_shape'] : 'img-square';
	$imgstyle = tshowcase_get_img_style($options['tshowcase_single_photo_shape']);
	$truesocial = isset($options['tshowcase_single_show_social']) ? true : false;

	if(is_singular('tshowcase')) {

			tshowcase_add_global_css();

			$html = "<div id='tshowcase-single-wrap'>";
			$html .= '<div class="'.$imgstyle.'">'.tshowcase_get_image($post->ID).'</div>';		
			$html .= tshowcase_get_information($post->ID,true,array(),true);
			$html .= '<div class="tshowcase-box-social">';
			$html .= tshowcase_get_social($post->ID,$truesocial);
			$html .= '</div></div>';
			$content = str_replace("{tshowcase}",$html,$content);
	}

	return $content;

}

add_filter( 'the_content', 'tshowcase_vc_filter' );


//add_filter( 'the_content', 'tshowcase_twitter' );
function tshowcase_twitter($content) {
	global $post;
	if(is_singular( 'tshowcase' )) {
		
		$twitterhandler = get_post_meta( $post->ID, '_tstwitter', true );
		$content .= 'Twitter handler is:'.$twitterhandler;

	}

	return $content; 
}


?>