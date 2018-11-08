<style type="text/css">

/** 
*
* WHAT THIS FILE DOES:;
* 1. Define default values for customizable elements.
* 2. Grab the user-created values (or the defaults) from OptionTree and assign them to CSS selectors.
*
* Note to theme-developers: Make sure you're not setting any of these values in your theme stylesheets. That just makes for extra work...
*
**/

/* Run NiceScroll CSS based on user OPTIONS - Also see Run Scripts at the bottom of this document */
<?php
global $nice_scroll;
$nice_scroll = ot_get_option('nice_scroll');
if ($nice_scroll != "off") { ?> 
	html {
  		overflow: hidden !important;
	} 
<?php
	/* ANDROID SCROLLING PATCH */
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {
	    echo 'html{overflow-y: scroll !important}';
	}
}
else if ($nice_scroll == "off"){
}
?>

<?php if(ot_get_option('show_course_listings') == 'off' OR get_custom_field('show_course_listings') == 'No' ) : ?>
	#course-list {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_id') == 'off' OR get_custom_field('show_course_listing_id') == 'No' ) : ?>
	#course-list .course-id {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_number') == 'off' OR get_custom_field('show_course_listing_number') == 'No' ) : ?>
	#course-list .course-number {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_name') == 'off' OR get_custom_field('show_course_listing_instructor') == 'No' ) : ?>
	#course-list .course-name {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_instructor') == 'off' OR get_custom_field('show_course_listing_instructor') == 'No' ) : ?>
	#course-list .course-instructor {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_room') == 'off' OR get_custom_field('show_course_listing_room') == 'No' ) : ?>
	#course-list .course-room-number {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_days') == 'off' OR get_custom_field('show_course_listing_days') == 'No' ) : ?>
	#course-list .course-days {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_time') == 'off' OR get_custom_field('show_course_listing_time') == 'No' ) : ?>
	#course-list .course-time {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_credits') == 'off' OR get_custom_field('show_course_listing_credits') == 'No' ) : ?>
	#course-list .course-credits {display: none;}
<?php endif; ?>
<?php if(ot_get_option('show_course_listing_prerequisites') == 'off' OR get_custom_field('show_course_listing_prerequisites') == 'No' ) : ?>
	#course-list .course-prerequisites {display: none;}
<?php endif; ?>

<?php /* Custom CSS Modifications from the Admin Panel */
global $theme_options; 

// DECLARE OUR GLOBAL VARIABLES

global $theme_primary_color;		// Main link colors, nav menu hovers, post hovers.
global $theme_secondary_color;		// Used only for some button hovers.

global $tophat_dropdown_background_color;	// Establish Skin Builder Color Variables
global $tophat_background_color;
global $header_background_color;
global $sticky_header_background_color;
global $menu_hover_border_color;
global $sub_menu_border_color;
global $sub_menu_background_color;
global $body_background_color;
global $content_background_color;
global $footer_background_color;
global $subfooter_background_color;

global $tophat_background_image;	// Establish Skin Builder Image Variables
global $header_background_image;
global $sticky_header_background_image;
global $sub_menu_backgound_image;
global $body_background_image;
global $content_background_image;
global $footer_background_image;
global $subfooter_background_image;

global $header_background_image_grayscale;
global $header_background_color_opacity;

global $vc_tab_bg_color;
global $vc_tab_bg_hover_color;
global $vc_tab_bg_active_color;
global $vc_tab_panel_bg_color;
global $vc_tab_panel_border_color;

global $header_menu_top_margin;
global $header_menu_bottom_margin;

global $stripe_bg_transparency;		// #section-header & #section-sub-footer BG transparency.
$stripe_bg_transparency 	= "0.8";			// #section-header & #section-sub-footer BG transparency.
if (ot_get_option("stripe_bg_transparency")) : $stripe_bg_transparency = ot_get_option("stripe_bg_transparency"); endif;


// SET DEFAULT VALUES

$theme_primary_color 				= "#144563";		// Main link colors, nav menu hovers, post hovers.
$theme_secondary_color 				= "#0db896";		// Used only for some button hovers.

$tophat_dropdown_background_color 	= "#1f3345";		// Skin Builder Colors...
$tophat_background_color 			= "#011a29";
$header_background_color 			= "#1f3345";			//#2e2f34 #FFF
$sticky_header_background_color 	= "#011A29";

$menu_hover_border_color 			= "#FFFFFF";
$sub_menu_border_color 				= "";
$sub_menu_background_color 			= "#eeeeee";

$body_background_color 				= "#ffffff";			//#e1e1e1 #FFF
$content_background_color 			= "#ffffff";
$footer_background_color 			= "#1f3345";			
$subfooter_background_color 		= "#011a29";

$vc_tab_bg_color 					= "";
$vc_tab_bg_hover_color 				= "";
$vc_tab_bg_active_color 			= "";
$vc_tab_panel_bg_color 				= "";
$vc_tab_panel_border_color 			= "";

$header_background_image_grayscale	= "on";
$header_background_color_opacity	= "0.8";

$header_menu_top_margin     		= "4.5rem";			// Layout Options...
$header_menu_bottom_margin     		= "4.5rem";		


// OVERWRITE DEFAULTS WITH OPTION-TREE VALUES

if (ot_get_option("theme_primary_color")) : $theme_primary_color = ot_get_option("theme_primary_color"); endif;
if (ot_get_option("theme_secondary_color")) : $theme_secondary_color = ot_get_option("theme_secondary_color"); endif;

if (ot_get_option("tophat_dropdown_background_image")) : $tophat_dropdown_background_image = ot_get_option("tophat_dropdown_background_image"); endif;
if (ot_get_option("tophat_dropdown_background_color")) : $tophat_dropdown_background_color = ot_get_option("tophat_dropdown_background_color"); endif;

if (ot_get_option("tophat_background_image")) : $tophat_background_image = ot_get_option("tophat_background_image"); endif;
if (ot_get_option("tophat_background_color")) : $tophat_background_color = ot_get_option("tophat_background_color"); endif;

if (ot_get_option("header_background_image")) : $header_background_image = ot_get_option("header_background_image"); endif;
if (ot_get_option("header_background_color")) : $header_background_color = ot_get_option("header_background_color"); endif;

if (ot_get_option("header_background_image_grayscale")) : $header_background_image_grayscale = ot_get_option("header_background_image_grayscale"); endif;
if (ot_get_option("header_background_color_opacity")) : $header_background_color_opacity = ot_get_option("header_background_color_opacity"); endif;

if (ot_get_option("sticky_header_background_image")) : $sticky_header_background_image = ot_get_option("sticky_header_background_image"); endif;
if (ot_get_option("sticky_header_background_color")) : $sticky_header_background_color = ot_get_option("sticky_header_background_color"); endif;

if (ot_get_option("menu_hover_border_color")) : $menu_hover_border_color = ot_get_option("menu_hover_border_color"); endif;
if (ot_get_option("sub_menu_border_color")) : $sub_menu_border_color = ot_get_option("sub_menu_border_color"); endif;

if (ot_get_option("sub_menu_background_color")) : $sub_menu_background_color = ot_get_option("sub_menu_background_color"); endif;
if (ot_get_option("sub_menu_background_image")) : $sub_menu_background_image = ot_get_option("sub_menu_background_image"); endif;

if (ot_get_option("body_background_image")) : $body_background_image = ot_get_option("body_background_image"); endif;
if (ot_get_option("body_background_color")) : $body_background_color = ot_get_option("body_background_color"); endif;

if (ot_get_option("content_background_image")) : $content_background_image = ot_get_option("content_background_image"); endif;
if (ot_get_option("content_background_color")) : $content_background_color = ot_get_option("content_background_color"); endif;

if (ot_get_option("footer_background_image")) : $footer_background_image = ot_get_option("footer_background_image"); endif;
if (ot_get_option("footer_background_color")) : $footer_background_color = ot_get_option("footer_background_color"); endif;

if (ot_get_option("subfooter_background_image")) : $subfooter_background_image = ot_get_option("subfooter_background_image"); endif;
if (ot_get_option("subfooter_background_color")) : $subfooter_background_color = ot_get_option("subfooter_background_color"); endif;

if (ot_get_option("vc_tab_bg_color")) : $vc_tab_bg_color = ot_get_option("vc_tab_bg_color"); endif;
if (ot_get_option("vc_tab_bg_hover_color")) : $vc_tab_bg_hover_color = ot_get_option("vc_tab_bg_hover_color"); endif;
if (ot_get_option("vc_tab_bg_active_color")) : $vc_tab_bg_active_color = ot_get_option("vc_tab_bg_active_color"); endif;
if (ot_get_option("vc_tab_panel_bg_color")) : $vc_tab_panel_bg_color = ot_get_option("vc_tab_panel_bg_color"); endif;
if (ot_get_option("vc_tab_panel_border_color")) : $vc_tab_panel_border_color = ot_get_option("vc_tab_panel_border_color"); endif;

if (ot_get_option("header_menu_top_margin")) : $header_menu_top_margin = ot_get_option("header_menu_top_margin"); endif;
if (ot_get_option("header_menu_bottom_margin")) : $header_menu_bottom_margin = ot_get_option("header_menu_bottom_margin"); endif;


?>	

	/*  - THEME PRIMARY COLOR -  */	
	.theme_primary_color_text,
	.th_show_hide.th_flag_toggle:hover,
	h2.entry-title > a:hover,
	a, 
	a:visited,
	#page .tagcloud a,
	#page .vc_tta.vc_general .vc_tta-panel-title > a,
	.vc_tta-tabs .vc_grid h5 a,
	#page nav ul.menu .sub-menu li.menu-item a:hover,
	#page nav ul.menu .sub-menu li.menu-item > a,
	#page #section-navigation #site-navigation ul.mega-sub-menu li.mega-menu-item a,
	button, .button, input[type="button"], input[type="reset"], input[type="submit"],
	#page table tr td > a {	
		color: <?php echo esc_attr( $theme_primary_color ); ?>; 
	}

	/*  - THEME SECONDARY COLORS -  */
	#page a:hover,
	.duration, .tribe-event-duration,
	.author-description > h3,	
	.flag_toggle .icon > i:hover,
	#page #section-tophat-dropdown a:hover,
	#section-tophat .th_flag_toggle:hover .th_trigger i,
	#section-tophat .th_flag_toggle:hover .th_trigger.blurb,
	#section-tophat .menu-item-title:hover,
	#page #section-tophat a:hover, 
	#page .vc_tta.vc_general .vc_tta-panel-title:hover > a {
		color: <?php echo esc_attr( $theme_secondary_color ); ?>; 
	}

	#page .vc_btn_outlined:hover,
	.nav-next:hover, .nav-previous:hover,
	#section-content .tribe-events-widget-link:hover, 
	#section-content .tribe-events-widget-link:hover a,
	#page .add_to_cart_button:hover {
    border-color: <?php echo esc_attr( $theme_secondary_color ); ?> !important;
    background-color: <?php echo esc_attr( $theme_secondary_color ); ?> !important;
    color: white !important;
	}

	/*  - THEME SECONDARY BG-COLORS -  */
	#section-header nav ul.menu ul li:hover, 
	#section-header nav ul.menu ul li.sfHover,
	#section-header nav ul.menu ul li:hover > a, 
	#section-header nav ul.menu ul li.sfHover > a,
	#page #section-navigation .mega-menu-flyout .mega-sub-menu li.mega-menu-item:hover,
	#page #section-navigation .mega-menu-flyout .mega-sub-menu li.mega-menu-item:hover > a,
	#page #section-sticky-header .mega-menu-flyout .mega-sub-menu li.mega-menu-item:hover,
	#page #section-sticky-header .mega-menu-flyout .mega-sub-menu li.mega-menu-item:hover > a,
	.wpb_tabs_nav li.ui-state-default a,
	#page .vc_tta-tabs-list li.vc_tta-tab > a,
	.course-meta .status.in-progress,
	.meter.red > span, 
	#page .tagcloud a:hover,
	.sensei .nav-next a:hover, .sensei .nav-prev a:hover, 
	#page .lesson input:hover {
		background-color: <?php echo esc_attr( $theme_secondary_color ); ?>; 
		color: white !important;
	}

	
	#page .button.wc-forward, 
	.highlight-row, 
	.ui-accordion-header-active a,
	.theme_primary_color_bg,
	.ui-state-active .ui-tabs-anchor,
	.wpb_content_element .wpb_tabs_nav li:hover a,
	#page .vc_tta-tabs-list li.vc_tta-tab:hover > a,
	#page .vc_tta-tabs-list li.vc_tta-tab.vc_active > a,
	#page .button,
	#page .tagcloud a,
	.wpb_tabs_nav li.ui-state-active a,
	.vc_tta-accordion .vc_tta-panels .vc_active .vc_tta-panel-title a,
	#my-courses.ui-tabs .ui-tabs-nav li.ui-state-active a, 
	#page a.my-messages-link:hover, 
    #page .ui-state-active a.ui-tabs-anchor:hover, 
    #page #my-courses.ui-tabs .ui-tabs-nav li a:hover,
    .lesson input[type="submit"], 
    .course input[type="submit"] {
		background-color: <?php echo esc_attr( $theme_primary_color ); ?>; 
		color: white !important;
	}


	/* - !IMPORTANT OVERRIDES */	
	.woocommerce span.onsale, 
	.woocommerce-page span.onsale, 
	.button.add_to_cart_button.product_type_simple, 
	#page .woocommerce .form-row input.button {
	  background: <?php echo esc_attr( $theme_primary_color ); ?> !important;
	  text-shadow: 0 1px 0 <?php echo esc_attr( $theme_primary_color ); ?> !important;
	}
	.woocommerce a.button, 
	.woocommerce button.button .woocommerce input.button, 
	.woocommerce #respond input#submit, 
	.woocommerce #content input.button, 
	.woocommerce-page a.button, 
	.woocommerce-page button.button, 
	.woocommerce-page input.button, 
	.woocommerce-page #respond input#submit, 
	.woocommerce-page #content input.button {
		background: -moz-linear-gradient(center top , #FFF -100%, <?php echo esc_attr( $theme_primary_color ); ?> 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
		border-color: <?php echo esc_attr( $theme_primary_color ); ?> !important;
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.6);
		}
	.woocommerce a.button:hover, 
	.woocommerce button.button .woocommerce input.button:hover, 
	.woocommerce #respond input#submit:hover, 
	.woocommerce #content input.button:hover, 
	.woocommerce-page a.button:hover, 
	.woocommerce-page button.button:hover, 
	.woocommerce-page input.button:hover, 
	.woocommerce-page #respond input#submit:hover, 
	.woocommerce-page #content input.button:hover, 
	#page .woocommerce .form-row input.button:hover {
		background: -moz-linear-gradient(center top , #FFF -100%, <?php echo esc_attr( $theme_secondary_color ); ?> 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
		border-color: <?php echo esc_attr( $theme_secondary_color ); ?> !important;
		}
	.woocommerce ul.products li.product .price, 
	.woocommerce-page ul.products li.product .price, 
	.woocommerce div.product span.price, 
	.woocommerce div.product p.price, 
	.woocommerce #content div.product span.price, 
	.woocommerce #content div.product p.price, 
	.woocommerce-page div.product span.price, 
	.woocommerce-page div.product p.price, 
	.woocommerce-page #content div.product span.price, 
	.woocommerce-page #content div.product p.price {
		color: <?php echo esc_attr( $theme_secondary_color ); ?> !important;
	}

	/* STRIPE BACKGROUND COLOR & OPACITY */

	#page #section-super-header, #page #section-tophat{background: transparent; position: relative; z-index: 9999;}	
	#page #section-header{width: 100%;}

	#page #section-header .container,
	#page #section-tophat .container{z-index: 3;}

	#section-tophat .stripe_color{
		position:absolute;
		top:0px;
		width:100%;
		height:100%;
		background-color: <?php echo esc_attr( $tophat_background_color ); ?>; 
		z-index: 2;
		}

	#section-header .stripe_color{
		position:absolute;
		top:0px;
		width:100%;
		height:100%;
		background-color: <?php echo esc_attr( $header_background_color ); ?>; 
		opacity:<?php echo esc_attr( $stripe_bg_transparency ); ?>;
		z-index: 2;
		}

	/*  - THEME SECONDARY BG-COLORS -  */
	#sf_results #sf_val ul li.sf_selected,
	.button:hover,
	.button:active,
	.button:focus,
	input[type="submit"]:hover,
	input[type="submit"]:active,
	input[type="submit"]:focus{
		background-color: <?php echo esc_attr( $theme_secondary_color ); ?> !important;
	}

	#page #section-super-header nav#site-navigation .mega-menu-wrap .mega-menu > li.mega-menu-item-has-children ul.mega-sub-menu,
	#section-header nav ul.menu > li > .sub-menu li:first-child, 
	#sticky-superfish-menu > ul.menu > li.menu-item > ul.sub-menu > li:first-child {
		border-top-color: <?php echo esc_attr( $theme_secondary_color ); ?> !important;
	}

	/*  - THEME PRIMARY BG-COLORS OVERRIDES -  */
	#section-footer,
	#page .pptwj-tabs-wrap .tab-links {	
		background-color: <?php echo esc_attr( $theme_primary_color ); ?>; 
	}
	
	#page .pptwj-tabs-wrap .tab-links,
	.th_slidingDiv, 
	.wpb_tabs_nav {
		border-bottom-color: <?php echo esc_attr( $theme_primary_color ); ?> !important;
	}

	/*  - THEME SECONDARY BG-COLORS OVERRIDES -  */
	.pptwj-tabs-wrap .tab-links li a.selected, 
	.pptwj-tabs-wrap .tab-links li a:hover {
		background-color: <?php echo esc_attr( $theme_secondary_color ); ?> !important; 
	}

	/* DEFAULT POST-GRID HOVER COLORS */
		.module-content{background: transparent;}
		.module-inner .color_background{ 
			position:absolute;
			top:0px;
			left:0px;
			width:100%;
			height:100%;
			z-index: 1 !important;
			background-color: <?php echo esc_attr( $theme_primary_color ); ?>; 
			opacity:0;
			}
			.module-inner:hover .color_background{
				opacity: 0.9;
				}
	
	/*  - Slider Arrows -  */
	.tp-leftarrow.default {
	  background-color: <?php echo esc_attr( $theme_primary_color ); ?>;
	  background-image: url("<?php echo esc_url( WP_THEME_URL ); ?>/theme-core/theme-assets/images/slider_arrow_left.png") !important;
	  border-radius: 20px;
	}
	.tp-rightarrow.default {
	  background-color: <?php echo esc_attr( $theme_primary_color ); ?>;
	  background-image: url("<?php echo esc_attr( WP_THEME_URL ); ?>/theme-core/theme-assets/images/slider_arrow_right.png") !important;
	  border-radius: 20px;
	}


	/* SKIN BUILDER */

	#section-tophat-dropdown{
		background-color: <?php echo esc_attr( $tophat_dropdown_background_color ); ?>;
		<?php if(ot_get_option('tophat_dropdown_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('tophat_dropdown_background_image') ); ?>") repeat;
		<?php endif; ?>
		}
	#section-tophat .stripe_color{
		background-color: <?php echo esc_attr( $tophat_background_color ); ?>;
		<?php if(ot_get_option('tophat_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('tophat_background_image') ); ?>") repeat;
		<?php endif; ?>
		}
	#section-header .stripe_image{
		position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 1;
		<?php if(ot_get_option('header_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('header_background_image') ); ?>") repeat;
			background-size: cover;
			background-position: 50% 50%;
		<?php endif; ?>
		}

	<?php if(ot_get_option('header_background_image_grayscale') == 'off' OR ot_get_option('header_background_image_grayscale') == 'No' ) : ?>
	    #section-header .stripe_image {
			filter: none !important;
			filter: unset !important;
			-webkit-filter: grayscale(0);
			-moz-filter: grayscale(0%);
			-ms-filter: grayscale(0%);
			-o-filter: grayscale(0%);
		}
	<?php else : ?>
		#section-header .stripe_image {
			-moz-filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
	         -o-filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
	         -webkit-filter: grayscale(100%);
	         filter: gray;
	         filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
		}
	<?php endif; ?>

    #section-header .stripe_color {
    	background-color: <?php echo esc_attr( $header_background_color ); ?>;
		opacity: <?php echo esc_attr( $header_background_color_opacity ); ?>;
	}

	#section-sticky-header-background{
		background-color: <?php echo esc_attr( $sticky_header_background_color ); ?>;
		<?php if(ot_get_option('sticky_header_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('sticky_header_background_image') ); ?>") repeat;
		<?php endif; ?>
		}
	#section-header nav ul.menu > li:after, #page #section-navigation ul.mega-menu li.mega-menu-item a:after{
		background-color: <?php echo esc_attr( $menu_hover_border_color ); ?>;
		}
	#page #section-super-header nav#site-navigation .mega-menu-wrap .mega-menu > li.mega-menu-item-has-children ul.mega-sub-menu, #section-header nav ul.menu > li > .sub-menu li:first-child{
		border-top-color: <?php echo esc_attr( $sub_menu_border_color ); ?> !important;
		}
	#mega-menu-wrap-primary_menu-241 #mega-menu-primary_menu-241 > li.mega-menu-megamenu > ul.mega-sub-menu, #page #section-super-header ul.mega-sub-menu li{
		background-color: <?php echo esc_attr( $sub_menu_background_color ); ?>;
		<?php if(ot_get_option('sub_menu_backgound_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('sub_menu_backgound_image') ); ?>") repeat;
		<?php endif; ?>
		}
	html, body, #section-content{
		background-color: <?php echo esc_attr( $body_background_color ); ?>;
		<?php if(ot_get_option('body_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('body_background_image') ); ?>") repeat;
		<?php endif; ?>
		}
	#section-content .container > .sixteen{
		background-color: <?php echo esc_attr( $content_background_color ); ?>;
		<?php if(ot_get_option('content_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('content_background_image') ); ?>") repeat;
		<?php endif; ?>
		}
	#section-footer{
		background-color: <?php echo esc_attr( $footer_background_color ); ?>;
		<?php if(ot_get_option('footer_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('footer_background_image') ); ?>") repeat;
		<?php endif; ?>
		}
	#section-sub-footer{
		background-color: <?php echo esc_attr( $subfooter_background_color ); ?>;
		<?php if(ot_get_option('subfooter_background_image')) : ?>
			background: url("<?php echo esc_url( ot_get_option('subfooter_background_image') ); ?>") repeat;
		<?php endif; ?>
		}


/* NEW VISUAL COMPOSER STYLING OPTIONS */
<?php 
if (ot_get_option("vc_tab_bg_color")) : ?>
	#page #section-content .vc_tta-tabs-list li.vc_tta-tab > a {
		background-color: <?php echo esc_attr( $vc_tab_bg_color ); ?>;
		}
<?php endif; 
if (ot_get_option("vc_tab_bg_hover_color")) : ?>
	#page #section-content .vc_tta-tabs-list li.vc_tta-tab:hover > a {
		background-color: <?php echo esc_attr( $vc_tab_bg_hover_color ); ?>;
		}
<?php endif; 
if (ot_get_option("vc_tab_bg_active_color")) : ?>
	#page #section-content .vc_tta-tabs-list li.vc_tta-tab.vc_active > a {
		background-color: <?php echo esc_attr( $vc_tab_bg_active_color ); ?>;
		}
<?php endif; 
if (ot_get_option("vc_tab_panel_bg_color")) : ?>
	#page .vc_tta-panel-body {
		background-color: <?php echo esc_attr( $vc_tab_panel_bg_color ); ?>;
		}
<?php endif; 
if (ot_get_option("vc_tab_panel_border_color")) : ?>
	#page .vc_tta-panel-body{
		border-color: <?php echo esc_attr( $vc_tab_panel_border_color ); ?>;
		}
<?php endif; 
?>


/*  - Layout: Content AD Space -  */
<?php 
if(ot_get_option('content_ad_space_layout') == 'on' OR ot_get_option('content_ad_space_layout') == 'Yes' ) : ?>
    .content-ad-space {margin: 0 1.04167%; padding: 25px 17px 10px!important;}
<?php else : ?>
	.content-ad-space {margin-bottom: 2rem;}
<?php endif;


/*  - Layout: Title ON/OFF -  */

if(get_custom_field('show_title') == 'off' OR get_custom_field('show_title') == 'No' ) : ?>
	.fp_banner_page {margin-top: 0px;}
	.breadcrumbs {margin: 0rem 1rem 0rem 0;float:left;}
<?php endif;


/* Layout: Tophat Dropdown - Set the columns class for each tophat dropdown. */

if(ot_get_option('tophat_columns_count') == "one_column" ) { ?>

	#section-flagdropdown .widget {width: 1100px;}

<?php } else if(ot_get_option('tophat_columns_count') == "two_columns" ) { ?>

	#section-flagdropdown .widget {width: 515px;}

<?php } else if(ot_get_option('tophat_columns_count') == "three_columns" ) { ?>

	#section-flagdropdown .widget {width: 340px;}

<?php } else if(ot_get_option('tophat_columns_count') == "four_columns" ) { ?>

	#section-flagdropdown .widget {width: 245px;}

<?php }	

/* LAYOUT: PAGE TITLE */
if(get_custom_field('align_title') == "left" ) { ?>

	#page .entry-title, #page .breadcrumbs {text-align: left;}

<?php } else if(get_custom_field('align_title') == "right" ) { ?>

	#page .entry-title, #page .breadcrumbs {text-align: right;}

<?php } else if(get_custom_field('align_title') == "center" ) { ?>

	#page .entry-title, #page .breadcrumbs {text-align: center;}

<?php }	

/*  - Portfolio Image With Hover -  */
if(get_custom_field('portfolio_hover_height') == 'on' OR get_custom_field('portfolio_hover_height') == 'Yes' ) :

	if (get_custom_field("portfolio_hover_start_height")) : ?>
			.module.hover-text .module-content, .module.hover-text .module-background { 
				height: <?php echo esc_attr( get_custom_field("portfolio_hover_start_height") ); ?> !important; 
			}
	<?php endif;

if (get_custom_field("portfolio_hover_end_height")) : ?>
		.module.hover-text:hover .module-content, .module.hover-text:hover .module-background { 
			height: <?php echo esc_attr( get_custom_field("portfolio_hover_end_height") ); ?> !important; 
		}
<?php endif;


endif;

/* HEADER */
	/* LOGO TOP OFFSET */
	if (ot_get_option("header_logo_top_margin")) : ?>	
		#section-header h1.site-title{
			margin-top: <?php echo esc_attr( ot_get_option("header_logo_top_margin") ); ?>rem !important; 
			}
	<?php endif;

	/* LOGO BOTTOM OFFSET */
	if (ot_get_option("header_logo_bottom_margin")) : ?>	
		#section-header h1.site-title{
			margin-bottom: <?php echo esc_attr( ot_get_option("header_logo_bottom_margin") ); ?>rem !important; 
			}
	<?php endif;

	/* MENU TOP OFFSET */
	if (ot_get_option("header_menu_top_margin")) : ?>	
		#section-header nav ul.menu, #section-header nav ul.mega-menu, #section-header nav .menu > ul {
			padding-top: <?php echo esc_attr( ot_get_option("header_menu_top_margin") ); ?>rem !important; 
			}
	<?php endif;

	/* MENU BOTTOM OFFSET */
	if (ot_get_option("header_menu_bottom_margin")) : ?>	
		#section-header nav ul.menu, #section-header nav ul.mega-menu, #section-header nav .menu > ul {
			padding-bottom: <?php echo esc_attr( ot_get_option("header_menu_bottom_margin") ); ?>rem !important; 
			}
	<?php endif;

/* STICKY HEADER */
	/* STICKY LOGO TOP OFFSET */
	if (ot_get_option("sticky_logo_top_margin")) : ?>	
		#section-sticky-header h1.site-title{
			margin-top: <?php echo esc_attr( ot_get_option("sticky_logo_top_margin") ); ?>rem !important; 
			}
	<?php endif;

	/* STICKY LOGO BOTTOM OFFSET */
	if (ot_get_option("sticky_logo_bottom_margin")) : ?>	
		#section-sticky-header h1.site-title{
			margin-bottom: <?php echo esc_attr( ot_get_option("sticky_logo_bottom_margin") ); ?>rem !important; 
			}
	<?php endif;

	/* STICKY MENU TOP OFFSET */
	if (ot_get_option("sticky_menu_top_margin")) : ?>	
		#section-sticky-header nav ul.menu{
			padding-top: <?php echo esc_attr( ot_get_option("sticky_menu_top_margin") ); ?>rem !important; 
			}
	<?php endif;

	/* STICKY MENU BOTTOM OFFSET */
	if (ot_get_option("sticky_menu_bottom_margin")) : ?>	
		#section-sticky-header nav ul.menu, #section-sticky-header li ul.sub-menu{
			padding-bottom: <?php echo esc_attr( ot_get_option("sticky_menu_bottom_margin") ); ?>rem !important; 
			}
	<?php endif;

	/* STICKY HEADER HEIGHT */
	if (ot_get_option("sticky_header_height")) : ?>	
		#section-sticky-header, #section-sticky-header-background {
			height: <?php echo esc_attr( ot_get_option("sticky_header_height") ); ?>rem !important; 
			}
	<?php endif;

	/* USE THEME STYLES FOR DYNAMIC TO TOP */
	if(ot_get_option('dynamic_to_top') == 'on' OR ot_get_option('dynamic_to_top') == 'Yes' ) : ?>	
		#dynamic-to-top {
		  background-color: transparent !important;
		  border: 2px solid transparent !important;
		  border-radius: 0 !important;
		  bottom: auto !important;
		  box-shadow: none !important;
		  padding: 0 !important;
		  right: 5% !important;
		  top: 13px !important;
		  transition: all 0.5s ease 0s !important;
		}
		.page #dynamic-to-top span {
		  background: url("<?php echo esc_url( WP_THEME_URL ); ?>/theme-core/theme-assets/images/up.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
		  display: block;
		  height: 10px;
		  overflow: hidden;
		  width: 14px;
		}
		#dynamic-to-top:hover {
		  background-color: transparent !important;
		  background-image: url("") !important;
		  border: 2px solid transparent !important;
		  opacity: 1 !important;
		}
		#dynamic-to-top:hover span {	
			background-image: url("<?php echo esc_url( WP_THEME_URL ); ?>/theme-core/theme-assets/images/up.png") !important;
		}
	<?php endif;

/* Custom CSS (from user) */
print ot_get_option('customcss');
?> 
</style>

<script type="text/javascript">
<?php 

/* Run Nice Scroll SCRIPTS based on user OPTIONS */
$nice_scroll = ot_get_option('nice_scroll');
if ($nice_scroll != "off") {
?> jQuery(document).ready(function($) { $("html").niceScroll({cursorcolor:"#afafaf", cursorwidth:"10px", cursorminheight: "50", background: "#eeeeee", zindex: "99999"}); }); <?php
}
else if ($nice_scroll == "off"){
}

/* Custom SCRIPTS (from user) */
print ot_get_option('customscripts');
?>
</script>