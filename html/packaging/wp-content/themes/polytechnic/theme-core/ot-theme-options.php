<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
  'sections'        => array( 
    array(
    'id'          => 'basics',
    'title'       => __('Theme Basics', 'mythology')
    ),
    array(
    'id'          => 'tophat',
    'title'       => __('Top Hat Options', 'mythology')
    ),
    array(
    'id'          => 'sticky-header',
    'title'       => __('Sticky Header Options', 'mythology')
    ),
    array(
    'id'          => 'layout',
    'title'       => __('Layout Options', 'mythology')
    ),
    array(
    'id'          => 'skin-builder',
    'title'       => __('Skin Builder', 'mythology')
    ),
    array(
    'id'          => 'post',
    'title'       => __('Post Options', 'mythology')
    ),
    array(
    'id'          => 'course',
    'title'       => __('Course Options', 'mythology')
    ),
    array(
    'id'          => 'faculty',
    'title'       => __('Faculty Options', 'mythology')
    ),
    array(
    'id'          => 'footer',
    'title'       => __('Footer Options', 'mythology')
    ),
    array(
    'id'          => 'social',
    'title'       => __('Social Options', 'mythology')
    ),
    array(
    'id'          => 'custom-css',
    'title'       => __('Custom CSS', 'mythology')
    ),
    array(
    'id'          => 'custom-scripts',
    'title'       => __('Custom Scripts', 'mythology')
    ),
    array(
    'id'          => 'quick-start',
    'title'       => __('Documentation', 'mythology')
    ),
    array(
    'id'          => 'custom-login',
    'title'       => __('Custom Login', 'mythology')
    )
  ),
  'settings'        => array(

/* ---------------------------------------------------------*/
/* THEME BASICS */ 
/* section: basics */ 
/* ---------------------------------------------------------*/

    array(
    'id'          => 'general_notes',
    'label'       => __('Welcome to the Theme Options Page!', 'mythology'),
    'desc'        => __('This panel sets up the basic theme options, like general layout rules, post behavior, and social media. To change other visual style elements, visit the optional <a href="customize.php">Appearances > Customize</a> panel. <br /><br />', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'basics',
    ),
    array(
    'id'          => 'logo',
    'label'       => __('Upload Your Logo', 'mythology'),
    'desc'        => __('Upload your logo image (JPG, GIF, PNG). If you upload an image that is too large for the space allotted to it by the theme, it will scale down.', 'mythology'),
    'type'        => 'upload',
    'section'     => 'basics',
    ),
    array(
    'id'          => 'favicon',
    'label'       => __('Upload Your Browser Icon', 'mythology'),
    'desc'        => __('Upload the 16x16px image (GIF or ICO) that you\'d like to show up in the browser address bar.', 'mythology'),
    'type'        => 'upload',
    'section'     => 'basics',
    ),
    array(
    'id'          => 'responsive_toggle',
    'label'       => __('Responsive Mode?', 'mythology'),
    'desc'        => __('Select Off to turn off responsive mode. Default is On.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'basics',
    ),
    array(
    'id'          => 'rtl_support',
    'label'       => __('RTL?', 'mythology'),
    'desc'        => __('Select On to turn on RTL stylesheet. Default is Off.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'section'     => 'basics',
    ),
    

/* ---------------------------------------------------------*/
/* TOPHAT OPTIONS */ 
/* section: tophat */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'tophat_notes',
    'label'       => __('Top Hat Options', 'mythology'),
    'desc'        => __('This is where you can set some basic options for the header section. The Top Hat is an optional page section that shows up at the top of your header. It usually contains some text and a set of social icons (set this up in the Social Icons tab).', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'tophat',
    ),
    array(
    'id'          => 'top_hat',
    'label'       => __('Show the Top Hat?', 'mythology'),
    'desc'        => __('The Top Hat is the row at the top of the site that displays a search bar and social-media links (setup later in this panel).', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'tophat',
    ),
    array(
    'id'          => 'top_hat_login',
    'label'       => __('Show the Login Links?', 'mythology'),
    'desc'        => __('Toggle this option to manage login/register/cart links in the tophat. This is an advanced option for users who want to use WooCommerce, but don\'t want the links in the tophat. Users who don\'t want to use WooCommerce can simply deactive the plugin to remove these links.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'tophat',
    'condition'   => 'top_hat:is(on)'
    ),
    array(
    'id'          => 'top_hat_right_blurb',
    'label'       => __('Custom Tophat Text/HTML', 'mythology'),
    'desc'        => __('Enter some text that you\'d like used for the top-hat\'s right-side blurb. This could be your motto, a telephone number, or anything else. Note: this will be displayed between Login Links and the Social Icons in the tophat. Most users will want to turn the Login Links option off and use this to replace that content.', 'mythology'),
    'std'         => '',
    'type'        => 'textarea-simple',
    'section'     => 'tophat',
    'rows'        => '2',
    'condition'   => 'top_hat:is(on)'
    ),
    array(
    'id'          => 'top_hat_social',
    'label'       => __('Show the Social Icons?', 'mythology'),
    'desc'        => __('Fill out the social icons later on in this panel. This just hides or reveals them.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'tophat',
    'condition'   => 'top_hat:is(on)'
    ),
    array(
    'id'          => 'top_hat_search',
    'label'       => __('Show the Search Bar?', 'mythology'),
    'desc'        => __('This hides or reveals the search bar in the top hat. *Requires the AJAXY plugin.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'section'     => 'tophat',
    'condition'   => 'top_hat:is(on)'
    ),
    array(
    'id'          => 'top_hat_dropdown',
    'label'       => __('TopHat Dropdown Area', 'mythology'),
    'desc'        => __('The top-hat has an optional "dropdown" area that can hold custom widget content. Turning this ON will enable it. Turning this OFF will hide it.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'tophat',
    'condition'   => 'top_hat:is(on)'
    ),
    array(
    'id'          => 'top_hat_blurb',
    'label'       => __('Dropdown Button Label', 'mythology'),
    'desc'        => __('Enter some text that you\'d like used for the top-hat\'s left-side blurb. This could be your motto, a telephone number, or anything else.', 'mythology'),
    'std'         => __('University News Panel', 'mythology'),
    'type'        => 'textarea-simple',
    'section'     => 'tophat',
    'rows'        => '2',
    'condition'   => 'top_hat_dropdown:is(on)'
    ),
    array(
        'id'          => 'tophat_columns_count',
        'label'       => __('Dropdown Area Columns', 'mythology'),
        'desc'        => __('Manage the content of each column in Appearance > Widgets > Tophat Dropdown Column 1, 2, 3, & 4. 
                          <br /><br />For example, if you want 3 columns each with only one widget, add one widget to each of the first three Tophat Dropdown Columns in Appearance > Widgets.
                          <br /><br />In the demo, we are using a JetPack Email Subscription Form with ONE column.', 'mythology'),
        'std'         => 'four columns',
        'type'        => 'select',
        'section'     => 'tophat',
        'condition'   => 'top_hat_dropdown:is(on)',
        'choices'     => array(
          array(
            'value'       => 'sixteen columns',
            'label'       => __('1 Column', 'mythology'),
          ),
          array(
            'value'       => 'eight columns',
            'label'       => __('2 Columns', 'mythology'),
          ),
          array(
            'value'       => 'one-third column',
            'label'       => __('3 Columns', 'mythology'),
          ),
          array(
            'value'       => 'four columns',
            'label'       => __('4 Columns', 'mythology'),
          )
        ),
      ),
    
/* ---------------------------------------------------------*/
/* HEADER/NAVIGATION DROPDOWN */ 
/* section: navigation-dropdown */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'sticky_header_notes',
    'label'       => __('Sticky Header Options', 'mythology'),
    'desc'        => __('This is where you can set some basic options for the header section. The Top Hat is an optional page section that shows up at the top of your header. It usually contains some text and a set of social icons (set this up in the Social Icons tab).
    </br></br><strong>To assign a MENU to your Sticky Header</strong>: Navigate to Appearance > Menus > Menu Locations and assign a menu to the Sticky Header menu location. You can use the same menu that your Primary Menu location is using, or build/assign a new custom menu for your users.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'sticky-header',
    ),
    array(
    'id'          => 'sticky_header',
    'label'       => __('Show the Sticky Header?', 'mythology'),
    'desc'        => __('The Sticky Header is the row at the top of the page that drops down and displays the logo and navigation is the user scrolls down past the Header Section', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'section'     => 'sticky-header',
    ),
    array(
    'id'          => 'sticky_logo',
    'label'       => __('Upload Your Logo For This Section', 'mythology'),
    'desc'        => __('Upload your logo image (JPG, GIF, PNG). If you upload an image that is too large for the space allotted to it by the theme, it will scale down.', 'mythology'),
    'type'        => 'upload',
    'section'     => 'sticky-header',
    'condition'   => 'sticky_header:is(on)'
    ),
    array(
    'label'       => __('Logo Top Margin (Sticky Header Mode)', 'mythology'),
    'id'          => 'sticky_logo_top_margin',
    'desc'        => __('Default: "0.1". Set the margin (in REMs) that drops the menu down from the top of the page. 1REM = @ 10PX.', 'mythology'),
    'std'         => '0.5',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'sticky-header',
    'condition'   => 'sticky_header:is(on)'
    ),
    array(
    'label'       => __('Logo Bottom Margin (Sticky Header Mode)', 'mythology'),
    'id'          => 'sticky_logo_bottom_margin',
    'desc'        => __('Default: "0.1". Set the margin (in REMs) that drops the content area down from the menu. 1REM = @ 10PX.', 'mythology'),
    'std'         => '0.5',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'sticky-header',
    'condition'   => 'sticky_header:is(on)'
    ),
    array(
    'label'       => __('Menu Top Margin (Sticky Header Mode)', 'mythology'),
    'id'          => 'sticky_menu_top_margin',
    'desc'        => __('Default: "0.4". Set the margin (in REMs) that drops the menu down from the top of the page. 1REM = @ 10PX.', 'mythology'),
    'std'         => '0.4',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'sticky-header',
    'condition'   => 'sticky_header:is(on)'
    ),
    array(
    'label'       => __('Menu Bottom Margin (Sticky Header Mode)', 'mythology'),
    'id'          => 'sticky_menu_bottom_margin',
    'desc'        => __('Default: "0.4". Set the margin (in REMs) that drops the content area down from the menu. 1REM = @ 10PX.', 'mythology'),
    'std'         => '0.4',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'sticky-header',
    'condition'   => 'sticky_header:is(on)'
    ),
    array(
    'label'       => __('Sticky Header Height', 'mythology'),
    'id'          => 'sticky_header_height',
    'desc'        => __('Default: "4". Set the height (in REMs) that drops the content area down from the menu. 1REM = @ 10PX.', 'mythology'),
    'std'         => '4',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'sticky-header',
    'condition'   => 'sticky_header:is(on)'
    ),
    array(
    'id'          => 'dynamic_to_top',
    'label'       => __('Use Theme Styles for Dynamic To Top?', 'mythology'),
    'desc'        => __('The "Dynamic To Top" has it\'s own panel that you can use to control the style of this element (in Appearance > To Top). Turning this option "OFF" will remove the theme styles for this element and allow the "To Top" option panel to take precedent. ', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'sticky-header',
    ),



/* ---------------------------------------------------------*/
/* THEME LAYOUT */ 
/* section: layout */ 
/* ---------------------------------------------------------*/
  array(
    'id'          => 'layout_notes',
    'label'       => __('Welcome to the Theme Options Page!', 'mythology'),
    'desc'        => __('This panel sets up the basic theme layout rules.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'layout',
    ),
    array(
    'label'       => __('Header Layout', 'mythology'),
    'id'          => 'header_layout',
    'type'        => 'radio-image',
    'desc'        => __('Select the theme header layout. This theme comes with one.', 'mythology'),
    'std'         => 'default',
    'section'     => 'layout'
    ),
    array(
    'label'       => __('Default Page Layout', 'mythology'),
    'id'          => 'content_layout',
    'type'        => 'radio-image',
    'desc'        => __('Select the default page layout. You can override this on invididual pages and posts.', 'mythology'),
    'std'         => 'default',
    'section'     => 'layout'
    ),  
    array(
    'label'       => __('Logo Top Margin', 'mythology'),
    'id'          => 'header_logo_top_margin',
    'desc'        => __('Based on the height of your logo, you may want to tinker with the vertical spacing. Default is "2.6". Set the margin (in REMs) that drops the menu down from the top of the page. 1REM = @ 10PX.', 'mythology'),
    'std'         => '3.6',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'layout',
    ),
    array(
    'label'       => __('Logo Bottom Margin', 'mythology'),
    'id'          => 'header_logo_bottom_margin',
    'desc'        => __('Based on the height of your logo, you may want to tinker with the vertical spacing. Default is "2.6". Set the margin (in REMs) that drops the content area down from the menu. 1REM = @ 10PX.', 'mythology'),
    'std'         => '3.6',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'layout',
    ), 
    array(
    'label'       => __('Menu Top Margin', 'mythology'),
    'id'          => 'header_menu_top_margin',
    'desc'        => __('Default: "4.5". Set the margin (in REMs) that drops the menu down from the top of the page. 1REM = @ 10PX.', 'mythology'),
    'std'         => '4.5',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'layout',
    ),
    array(
    'label'       => __('Menu Bottom Margin', 'mythology'),
    'id'          => 'header_menu_bottom_margin',
    'desc'        => __('Default: "4.5". Set the margin (in REMs) that drops the content area down from the menu. 1REM = @ 10PX.', 'mythology'),
    'std'         => '4.5',
    'type'        => 'numeric-slider',
    'min_max_step'=> '-3,5,0.1',
    'section'     => 'layout',
    ),
    array(
    'label'       => __('Nice Scroll', 'mythology'),
    'id'          => 'nice_scroll',
    'type'        => 'on_off',
    'desc'        => __('This toggle manages the custom scrolling "Nice Scroll" included with this theme. We understand that you may or may not want to use this, so feel free to use this option to turn this fuctionality On or Off.', 'mythology'),
    'std'         => 'on',
    'section'     => 'layout'
    ),
    

/* ---------------------------------------------------------*/
/* THEME SKIN */ 
/* section: layout */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'skin-notes',
    'label'       => __('Skin Options', 'mythology'),
    'desc'        => __('This section will allow you to set starting colors, background colors and some additional color options for the theme. If you\'re looking for Typography Options (Font Families, Font Colors, Font Sizes, etc.) > Navigate to Appeanace > Customize. See Documentation for more info. ', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'skin-builder',
    ),

    /* array(
    'id'          => 'main-color-notes',
    'label'       => __('Main Colors', 'mythology'),
    'desc'        => __('This section will allow you to set basic layout options for the theme.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'skin-builder',
    ), */

	    array(
	    'id'          => 'theme_primary_color',
	    'label'       => __('Theme Primary Color', 'mythology'),
	    'desc'        => __('To help you out a bit, we included this starting color option. To control all of your Colors & Fonts, navigate to Appearance > Customize. Note: Each theme uses this differently, but this will be normally used for primary elements like links and key highlight spots.', 'mythology'),
	    'type'        => 'colorpicker',
	    'section'     => 'skin-builder',
	    ),
	    array(
	    'id'          => 'theme_secondary_color',
	    'label'       => __('Theme Secondary Color', 'mythology'),
	    'desc'        => __('To help you out a bit, we included this starting color option. To control all of your Colors & Fonts, navigate to Appearance > Customize. Note: Each theme uses this differently, but this will be normally used for secondary elements like basic hover link colors.', 'mythology'),
	    'type'        => 'colorpicker',
	    'section'     => 'skin-builder',
	    ),

    array(
    'id'          => 'bg-notes',
    'label'       => __('Background Styles', 'mythology'),
    'desc'        => __('The front end design is broken up into sections (section-tophat-dropdown, section-tophat, section-header, section-content, section-pre-footer, section-footer, section-sub-footer). With the following options, you can set the background image/color for each section.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'skin-builder',
    ),
      array(
        'id'          => 'tophat_dropdown_background_image',
        'label'       => __('Top Hat Dropdown BG Image', 'mythology'),
        'desc'        => __('The top hat dropdown space a custom feature included with this theme and is revealed when the dropdown trigger (in the tophat) is clicked. This space is above the tophat and holds the Tophat Dropdown Widgets which can managed via the Appearance > Widgets panel. Additional controls can be found in Appearance > Theme Options > Tophat Options.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'tophat_dropdown_background_color',
        'label'       => __('Top Hat Dropdown BG Color', 'mythology'),
        'desc'        => __('The top hat dropdown space a custom feature included with this theme and is revealed when the dropdown trigger (in the tophat) is clicked. This space is above the tophat and holds the Tophat Dropdown Widgets which can managed via the Appearance > Widgets panel. Additional controls can be found in Appearance > Theme Options > Tophat Options.', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'tophat_background_image',
        'label'       => __('Top Hat BG Image', 'mythology'),
        'desc'        => __('The top hat space is usually the dark black bar at the top of the theme that holds a small piece of text and social icons.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'tophat_background_color',
        'label'       => __('Top Hat BG Color', 'mythology'),
        'desc'        => __('The top hat space is usually the dark black bar at the top of the theme that holds a small piece of text and social icons.', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),

      array(
        'id'          => 'header_background_image',
        'label'       => __('Header BG Image', 'mythology'),
        'desc'        => __('Depending on the theme, the header space usually includes the logo, navigation, etc.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'header_background_image_grayscale',
        'label'       => __('Header BG Grayscale', 'mythology'),
        'type'        => 'on_off',
        'desc'        => __('This toggle manages the grayscale styling for the Header Background Image. The default is On. If you would like to remove the grayscaling of the Header BG Image, toggle this option to Off.', 'mythology'),
        'std'         => 'on',
        'section'     => 'skin-builder'
        ),

      array(
        'id'          => 'header_background_color',
        'label'       => __('Header BG Color', 'mythology'),
        'desc'        => __('Depending on the theme, the header space usually includes the logo, navigation, etc.', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'header_background_color_opacity',
        'label'       => __('Header Overlay Opacity', 'mythology'),
        'desc'        => __('The transparency of the background image overlay for the header.', 'mythology'),
        'std'         => '0.8',
        'type'        => 'numeric-slider',
        'min_max_step'=> '0,1.01,0.01',
        'section'     => 'skin-builder',
      ),

      array(
        'id'          => 'sticky_header_background_image',
        'label'       => __('Sticky Header BG Image', 'mythology'),
        'desc'        => __('The background for the header after the user scrolls down the page.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'sticky_header_background_color',
        'label'       => __('Sticky Header BG Color', 'mythology'),
        'desc'        => __('The background for the header after the user scrolls down the page.', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),
      /* array(
        'id'          => 'sticky_header_background_color_opacity',
        'label'       => 'Sticky Header BG Opacity',
        'desc'        => 'The transparency of the background for the sticky header - after the user scrolls down the page.',
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ), */

      array(
        'id'          => 'menu_hover_border_color',
        'label'       => __('Menu Hover Color', 'mythology'),
        'desc'        => __('This is the small line below the menu item when hovered', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'sub_menu_border_color',
        'label'       => __('Sub Menu Highlight Border', 'mythology'),
        'desc'        => __('This is the small line above the sub menu (when visible)', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'sub_menu_background_color',
        'label'       => __('Sub Menu BG Color', 'mythology'),
        'desc'        => __('The background color for the sub menu.', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'sub_menu_background_image',
        'label'       => __('Sub Menu BG Image', 'mythology'),
        'desc'        => __('The background color for the sub menu.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),

      array(
        'id'          => 'body_background_image',
        'label'       => __('Body BG Image', 'mythology'),
        'desc'        => __('The main background area.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'body_background_color',
        'label'       => __('Body BG Color', 'mythology'),
        'desc'        => __('The main background area.', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),  
      array(
        'id'          => 'content_background_image',
        'label'       => __('Content Box BG Image', 'mythology'),
        'desc'        => __('The main background area.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'content_background_color',
        'label'       => __('Content Block BG Color', 'mythology'),
        'desc'        => __('The main background area.', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),  
      array(
        'id'          => 'footer_background_image',
        'label'       => __('Footer BG Image', 'mythology'),
        'desc'        => __('The footer area usually is the dark area below the main content that holds a series of widgets.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'footer_background_color',
        'label'       => __('Footer BG Color', 'mythology'),
        'desc'        => __('The footer area usually is the dark area below the main content that holds a series of widgets.', 'mythology'),
        'type'        => 'colorpicker', 
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'subfooter_background_image',
        'label'       => __('Sub-Footer BG Image', 'mythology'),
        'desc'        => __('The sub-footer area is below the footer (usually a dark stripe below the main theme area).', 'mythology'),
        'type'        => 'upload',
        'section'     => 'skin-builder',
      ),
      array(
        'id'          => 'subfooter_background_color',
        'label'       => __('Sub-Footer BG Color', 'mythology'),
        'desc'        => __('The sub-footer area is below the footer (usually a dark stripe below the main theme area).', 'mythology'),
        'type'        => 'colorpicker',
        'section'     => 'skin-builder',
      ),

    array(
    'id'          => 'vc-color-notes',
    'label'       => __('More Colors (Beta - Optional)', 'mythology'),
    'desc'        => __('We\'ve tried to make this as simple as possible. There are still going to be users out there that want some additional control, so this section will include some additional options.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'skin-builder',
    ),
    	array(
    'id'          => 'vc_more_notes_hidden',
    'label'       => '',
    'desc'        => '',
    'type'        => 'textblock-titled',
    'section'     => 'skin-builder'
    ),

    	array(
	        'id'          => 'vc_tab_bg_color',
	        'label'       => __('VC Tab - BG Color', 'mythology'),
	        'desc'        => __('.', 'mythology'),
	        'type'        => 'colorpicker',
	        'section'     => 'skin-builder',
	    ),
    	array(
	        'id'          => 'vc_tab_bg_hover_color',
	        'label'       => __('VC Tab:Hover - BG Color', 'mythology'),
	        'desc'        => __('.', 'mythology'),
	        'type'        => 'colorpicker',
	        'section'     => 'skin-builder',
	    ),
	    array(
	        'id'          => 'vc_tab_bg_active_color',
	        'label'       => __('VC Tab:Active - BG Color', 'mythology'),
	        'desc'        => __('.', 'mythology'),
	        'type'        => 'colorpicker',
	        'section'     => 'skin-builder',
	    ),
	    array(
	        'id'          => 'vc_tab_panel_bg_color',
	        'label'       => __('VC Tab Panel - BG Color', 'mythology'),
	        'desc'        => __('.', 'mythology'),
	        'type'        => 'colorpicker',
	        'section'     => 'skin-builder',
	    ),
	    array(
	        'id'          => 'vc_tab_panel_border_color',
	        'label'       => __('VC Tab Panel - Border Color', 'mythology'),
	        'desc'        => __('.', 'mythology'),
	        'type'        => 'colorpicker',
	        'section'     => 'skin-builder',
	    ),


 /* ---------------------------------------------------------*/
/* POST OPTIONS */ 
/* section: post */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'post_notes',
    'label'       => __('Post Options', 'mythology'),
    'desc'        => __('This section will allow you to set default post-options for the theme\'s main blog templates.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'post'
    ),
      array(
      'id'          => 'show_title',
      'label'       => __('Show the Title?', 'mythology'),
      'desc'        => __('Select "No" to remove the post title.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      ),
      array(
      'id'          => 'show_edit',
      'label'       => __('Show the Edit Button?', 'mythology'),
      'desc'        => __('Select "No" to remove the Edit button from the bottom of the post when logged in.', 'mythology'),
      'std'         => 'off',
      'type'        => 'on_off',
      'section'     => 'post',
      ),
      array(
      'id'          => 'show_post_meta',
      'label'       => __('**Show the Post Meta?', 'mythology'),
      'desc'        => __('Select "No" to remove the entire post meta (which may include some of these other options).', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      ),
      array(
      'id'          => 'show_post_featured_image',
      'label'       => __('Show the Featured Image?', 'mythology'),
      'desc'        => __('Select "No" to remove the Featured Image from displaying on the Single.php/single post instance. If you would like to remove the Featured Image from displaying in a feed or blog loop, just remove the featured image for posts.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_meta:is(on)'
      ),
      array(
      'id'          => 'show_by',
      'label'       => __('Show the Author in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the Author (Note: this is note the Author Box - see below).', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_meta:is(on)'
      ),
      array(
      'id'          => 'show_date',
      'label'       => __('Show the Date?', 'mythology'),
      'desc'        => __('Select "No" to remove the date.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_meta:is(on)'
      ),
      array(
      'id'          => 'show_categories',
      'label'       => __('Show the Categories?', 'mythology'),
      'desc'        => __('Select "No" to remove the category links.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_meta:is(on)'
      ),
      array(
      'id'          => 'show_comments_count',
      'label'       => __('Show the Comments Count?', 'mythology'),
      'desc'        => __('Select "No" to remove the comments count.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_meta:is(on)'
      ),
      array(
      'id'          => 'show_post_footer',
      'label'       => __('**Show the Post Footer?', 'mythology'),
      'desc'        => __('Select "No" to remove the entire post meta (which may include some of these other options).', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      ),
      array(
      'id'          => 'show_tags',
      'label'       => __('Show the Tags?', 'mythology'),
      'desc'        => __('Select "No" to remove the tag links.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_footer:is(on)'
      ),
      array(
      'id'          => 'show_author_box',
      'label'       => __('Show the Author Box?', 'mythology'),
      'desc'        => __('Select "No" to remove the Author Box from the bottom of the posts.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_footer:is(on)'
      ),
      array(
      'id'          => 'show_cross_links',
      'label'       => __('Show Cross-Post Navigation?', 'mythology'),
      'desc'        => __('Select "No" to remove the navigation links in the single-post template that allow users to move forward and backward one post.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_footer:is(on)'
      ),
      array(
      'id'          => 'show_comments',
      'label'       => __('Show the Comments?', 'mythology'),
      'desc'        => __('Select "No" to remove the comments from bottom of posts.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'post',
      'condition'   => 'show_post_footer:is(on)'
      ),

/* ---------------------------------------------------------*/
/* COURSE OPTIONS */ 
/* section: course */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'course_notes',
    'label'       => __('Course Options', 'mythology'),
    'desc'        => __('This section will allow you to set default course-options for the theme.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'course'
    ),
    array(
                    'label'       => __( 'Single Course', 'option-tree-theme' ),
                    'id'          => 'course_single_tab',
                    'type'        => 'tab',
                    'section'     => 'course',
                    ),
    array(
    'id'          => 'course_single_notes',
    'label'       => __('Single Course Options', 'mythology'),
    'desc'        => __('This section will allow you to set default course-options for the theme\'s single course template.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'course'
    ),
      array(
      'id'          => 'show_course_title',
      'label'       => __('Show Course Title?', 'mythology'),
      'desc'        => __('Select "No" to remove the course title.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      ),
      array(
      'id'          => 'show_course_meta',
      'label'       => __('**Show the Course Meta?', 'mythology'),
      'desc'        => __('Select "No" to remove the entire course meta (which may include some of these other options).', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      ),
      
      array(
      'id'          => 'show_course_image',
      'label'       => __('Show the Featured Image?', 'mythology'),
      'desc'        => __('Select "No" to remove the course name.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
      array(
      'id'          => 'show_course_description',
      'label'       => __('Show the Course Description?', 'mythology'),
      'desc'        => __('Select "No" to remove the course name.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
      array(
      'id'          => 'course_image_width',
      'label'       => __('Customize Width of Featured Image?', 'mythology'),
      'desc'        => __('This is optional.', 'mythology'),
      'std'         => '',
      'type'        => 'text',
      'rows'        => '1',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on),show_course_image:is(on)'
      ),
      array(
      'id'          => 'course_image_height',
      'label'       => __('Customize Height of Featured Image?', 'mythology'),
      'desc'        => __('This is optional.', 'mythology'),
      'std'         => '',
      'type'        => 'text',
      'rows'        => '1',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on),show_course_image:is(on)'
      ),
      
      array(
      'id'          => 'show_course_name',
      'label'       => __('Show the Name in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course name.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
      array(
      'id'          => 'show_course_number',
      'label'       => __('Show the Numbers in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course number(s) from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
      array(
      'id'          => 'show_course_time',
      'label'       => __('Show the Times in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course time from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
      array(
      'id'          => 'show_course_prerequisites',
      'label'       => __('Show the Prerequisites in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course prerequisits from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
      array(
      'id'          => 'show_course_credits',
      'label'       => __('Show the Credits in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course credit(s) from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
    array(
      'id'          => 'show_course_id',
      'label'       => __('Show the ID in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course ID from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
    array(
      'id'          => 'show_course_room',
      'label'       => __('Show the Room in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course room from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
    array(
      'id'          => 'show_course_days',
      'label'       => __('Show the Days in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course day(s) from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
    array(
      'id'          => 'show_course_components',
      'label'       => __('Show the Components in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course component(s) from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
    array(
      'id'          => 'show_course_location',
      'label'       => __('Show the Location in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course location from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
    array(
      'id'          => 'show_course-notes',
      'label'       => __('Show the Notes in Meta Section?', 'mythology'),
      'desc'        => __('Select "No" to remove the course notes from the meta section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      'condition'   => 'show_course_meta:is(on)'
      ),
    array(
      'id'          => 'show_course_edit',
      'label'       => __('Show the Edit Button?', 'mythology'),
      'desc'        => __('Select "No" to remove the Edit button from the bottom of the post when logged in.', 'mythology'),
      'std'         => 'off',
      'type'        => 'on_off',
      'section'     => 'course',
      ),


    // COURSE LISTING OPTIONS
    array(
                    'label'       => __( 'Course Listings', 'option-tree-theme' ),
                    'id'          => 'course_listings_tab',
                    'type'        => 'tab',
                    'section'     => 'course',
                    ),
    array(
    'id'          => 'course_more_notes',
    'label'       => __('Course Listing Options', 'mythology'),
    'desc'        => __('This section will allow you to set default course-options when courses are displayed in a list. For example, the theme\'s course listing templates like course catalog(s), course searches, and the course listings that show up on faculty pages.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'course'
    ),
    array(
    'id'          => 'course_more_notes_hidden',
    'label'       => '',
    'desc'        => '',
    'type'        => 'textblock-titled',
    'section'     => 'course'
    ),
    array(
      'id'          => 'show_course_listings',
      'label'       => __('Show the Course Listings?', 'mythology'),
      'desc'        => __('Select "No" to remove the course listings from the theme..', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'course',
      ),
        array(
          'id'          => 'show_course_listing_id',
          'label'       => __('Show the ID in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course ID from the listings.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),

        array(
          'id'          => 'show_course_listing_number',
          'label'       => __('Show the Number in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course number from the listings.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),
        array(
	      'id'          => 'link_course_number',
	      'label'       => __('Turn Number into a Link?', 'mythology'),
	      'desc'        => __('Select "No/Off" to remove the link from number for listings. Select "Yes" to have the Course Number link to the course.', 'mythology'),
	      'std'         => 'on',
	      'type'        => 'on_off',
	      'section'     => 'course',
	      ),
        
        array(
          'id'          => 'show_course_listing_name',
          'label'       => __('Show the Name in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course name from the listings.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),
        array(
	      'id'          => 'link_course_name',
	      'label'       => __('Turn Name into a Link?', 'mythology'),
	      'desc'        => __('Select "No/Off" to remove the link from name for listings. Select "Yes" to have the Course Name link to the course.', 'mythology'),
	      'std'         => 'on',
	      'type'        => 'on_off',
	      'section'     => 'course',
	      ),

        array(
          'id'          => 'show_course_listing_instructor',
          'label'       => __('Show the Instructor in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course instructor from the listings.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),
        array(
	      'id'          => 'link_course_instructor',
	      'label'       => __('Turn Instructor into a Link?', 'mythology'),
	      'desc'        => __('Select "No/Off" to remove the link from name for listings. Select "Yes" to have the Course Instructor link to the author page.', 'mythology'),
	      'std'         => 'on',
	      'type'        => 'on_off',
	      'section'     => 'course',
	      ),

        array(
          'id'          => 'show_course_listing_room',
          'label'       => __('Show the Room in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course room from the listings.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),
        array(
          'id'          => 'show_course_listing_days',
          'label'       => __('Show the Days in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course days from the listings.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),
        array(
          'id'          => 'show_course_listing_time',
          'label'       => __('Show the Time in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course time from the listings.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),
        array(
          'id'          => 'show_course_listing_credits',
          'label'       => __('Show the Credits in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course credits from the listings.', 'mythology'),
          'std'         => 'off',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),
        array(
          'id'          => 'show_course_listing_prerequisites',
          'label'       => __('Show the Prerequisites in Listings?', 'mythology'),
          'desc'        => __('Select "No" to remove the course prerequisites from the listings.', 'mythology'),
          'std'         => 'off',
          'type'        => 'on_off',
          'section'     => 'course',
          'condition'   => 'show_course_listings:is(on)'
          ),

        // COURSE OUTPUTS
        array(
                    'label'       => __( 'Course Outputs', 'option-tree-theme' ),
                    'id'          => 'course_output_tab',
                    'type'        => 'tab',
                    'section'     => 'course',
                    ),
        array(
        'id'          => 'course_output_notes',
        'label'       => __('Course Output Options', 'mythology'),
        'desc'        => __('This section will allow you to change the default text being used for courses. For example, if you wanted to change "Room Number" to "Venue" - you would do it here. This is completely optional and provided for users who want that extra control without using a child theme.
            <br/> <br/> Leave BLANK if you want to use the default.', 'mythology'),
        'type'        => 'textblock-titled',
        'section'     => 'course'
        ),
        array(
          'id'          => 'course_output_name',
          'label'       => __('Change "Course Name"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_number',
          'label'       => __('Change "Course Number"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_instructor',
          'label'       => __('Change "Course Instructor"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_time',
          'label'       => __('Change "Course Time"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_prerequisites',
          'label'       => __('Change "Prerequisite(s)"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_credits',
          'label'       => __('Change "Credit(s)"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_id',
          'label'       => __('Change "Course ID"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),

        array(
          'id'          => 'course_output_room',
          'label'       => __('Change "Room Number"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_days',
          'label'       => __('Change "Course Days"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_components',
          'label'       => __('Change "Component(s)"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output_location',
          'label'       => __('Change "Location"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),
        array(
          'id'          => 'course_output-notes',
          'label'       => __('Change "Course Notes"?', 'mythology'),
          'desc'        => __('', 'mythology'),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'course',
          'condition'   => ''
          ),

/* ---------------------------------------------------------*/
/* Faculty OPTIONS */ 
/* section: faculty */ 
/* ---------------------------------------------------------*/
    // FACULTY/AUTHOR OUTPUT
        array(
                    'label'       => __( 'Faculty/Author Outputs', 'option-tree-theme' ),
                    'id'          => 'author_output_tab',
                    'type'        => 'tab',
                    'section'     => 'faculty',
                    ),
    array(
    'id'          => 'faculty_notes',
    'label'       => __('Faculty Options', 'mythology'),
    'desc'        => __('This section will allow you to set default faculty-options for the theme\'s main faculty template (ie. the faculty page).', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'faculty'
    ),
        
      array(
      'id'          => 'show_faculty_header',
      'label'       => __('**Show Faculty Header?', 'mythology'),
      'desc'        => __('Select "No" to remove the faculty header (which may include some of these other options).', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'faculty',
      ),
          array(
          'id'          => 'show_faculty_name_h',
          'label'       => __('Show Faculty Name in Header?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty name.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_header:is(on)'
          ),
          array(
          'id'          => 'show_faculty_title_h',
          'label'       => __('Show Faculty Title in Header?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty title.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_header:is(on)'
          ),
          array(
          'id'          => 'show_faculty_dept_h',
          'label'       => __('Show Faculty Department in Header?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty department.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_header:is(on)'
          ),
          array(
          'id'          => 'show_faculty_avatar_h',
          'label'       => __('Show Faculty Avatar in Header?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty name.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_header:is(on)'
          ),
      array(
      'id'          => 'show_faculty_meta',
      'label'       => __('**Show the Faculty Meta?', 'mythology'),
      'desc'        => __('Select "No" to remove the entire faculty meta section (which may include some of these other options).', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'faculty',
      ),
          array(
          'id'          => 'show_faculty_name',
          'label'       => __('Show the Name in Meta Section?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty name.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_meta:is(on)'
          ),
          array(
          'id'          => 'show_faculty_title',
          'label'       => __('Show the Title/Position in Meta Section?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty title/position(s) from the meta section.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_meta:is(on)'
          ),
          array(
          'id'          => 'show_faculty_dept',
          'label'       => __('Show the Department in Meta Section?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty department from the meta section.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_meta:is(on)'
          ),
          array(
          'id'          => 'show_faculty_specialties',
          'label'       => __('Show the Specialties in Meta Section?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty specialties from the meta section.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_meta:is(on)'
          ),
          array(
          'id'          => 'show_faculty_email',
          'label'       => __('Show the Email in Meta Section?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty email from the meta section.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_meta:is(on)'
          ),
            array(
              'id'          => 'show_faculty_email_link',
              'label'       => __('Make Email a Mailto Link in Meta Section?', 'mythology'),
              'desc'        => __('Select "Yes" to make email a mailto link in the meta section.', 'mythology'),
              'std'         => 'off',
              'type'        => 'on_off',
              'section'     => 'faculty',
              'condition'   => 'show_faculty_meta:is(on),show_faculty_email:is(on)'
              ),
        array(
          'id'          => 'show_faculty_phone',
          'label'       => __('Show the Phone in Meta Section?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty phone from the meta section.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_meta:is(on)'
          ),
    array(
      'id'          => 'show_faculty_bio',
      'label'       => __('Show the Faculty Bio?', 'mythology'),
      'desc'        => __('Select "No" to remove the faculty bio section.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'faculty',
      ),
    array(
      'id'          => 'show_faculty_course_list',
      'label'       => __('Show the Faculty Course List?', 'mythology'),
      'desc'        => __('Select "No" to remove the faculty course list.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'faculty',
      ),
    array(
      'id'          => 'show_faculty_contact_section',
      'label'       => __('Show the Faculty Contact Section?', 'mythology'),
      'desc'        => __('Select "no" to remove the faculty contact section.', 'mythology'),
      'std'         => 'off',
      'type'        => 'on_off',
      'section'     => 'faculty',
      ),
    array(
    'id'          => 'faculty_contact_shortcode',
    'label'       => __('Contact Form 7 Shortcode', 'mythology'),
    'desc'        => __('Optional: Enter a contact form 7 shortcode here.<br /><br /> <strong>Not sure what that is?</strong> Build your contact form at the Contact admin panel in the left sidebar. Once it\'s built, copy and paste the shortcode that the plugin gives you here in this text field. The contact form represented by the shortcode will then show up at the bottom of the author page. It\'ll look something like this: <br /><br /><code>[contact-form-7 id="7393" title="Message Faculty Member"]</code>', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'faculty',
    'condition'   => 'show_faculty_contact_section:is(on)'
    ),

    // FACULTY/AUTHOR SIDEBAR
    array(
                'label'       => __( 'Faculty in Sidebar', 'option-tree-theme' ),
                'id'          => 'author_sidebar_tab',
                'type'        => 'tab',
                'section'     => 'faculty',
                ),

    array(
    'id'          => 'faculty_more_notes',
    'label'       => __('Faculty Sidebar Options', 'mythology'),
    'desc'        => __('This section will allow you to set default faculty-options when faculty members are displayed in the course sidebar. For example, when you navigate to a course, the faculty member assigned to that class is displayed in the sidebar with additional information.', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'faculty'
    ),
    /* array(
    'id'          => 'faculty_more_notes_hidden',
    'label'       => '',
    'desc'        => '',
    'type'        => 'textblock-titled',
    'section'     => 'faculty'
    ), */

    array(
      'id'          => 'show_faculty_sidebars',
      'label'       => __('Show the Faculty in Course Sidebar?', 'mythology'),
      'desc'        => __('Select "No" to remove faculty members from showing up in sidebar of courses.', 'mythology'),
      'std'         => 'on',
      'type'        => 'on_off',
      'section'     => 'faculty',
      ),
        array(
          'id'          => 'show_faculty_sidebar_name',
          'label'       => __('Show the Name in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty name from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),
        array(
          'id'          => 'show_faculty_sidebar_title',
          'label'       => __('Show the Position/Title in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty position/title from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),
        array(
          'id'          => 'show_faculty_sidebar_dept',
          'label'       => __('Show the Department in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty department from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),
        array(
          'id'          => 'show_faculty_sidebar_avatar',
          'label'       => __('Show the Avatar in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty avatar from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),
        array(
          'id'          => 'show_faculty_sidebar_about_me',
          'label'       => __('Show the About Me in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty "About Me" section from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),
        array(
          'id'          => 'show_faculty_sidebar_email',
          'label'       => __('Show the Email in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty email from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),
            array(
              'id'          => 'show_faculty_sidebar_email_link',
              'label'       => __('Link the Email in Sidebar?', 'mythology'),
              'desc'        => __('Select "Yes" to make the email a mailto link.', 'mythology'),
              'std'         => 'off',
              'type'        => 'on_off',
              'section'     => 'faculty',
              'condition'   => 'show_faculty_sidebars:is(on),show_faculty_sidebar_email:is(on)'
              ),
        array(
          'id'          => 'show_faculty_sidebar_phone',
          'label'       => __('Show the Phone in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty phone from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),
        array(
          'id'          => 'show_faculty_sidebar_nav',
          'label'       => __('Show the "Back to Courses" in Sidebar?', 'mythology'),
          'desc'        => __('Select "No" to remove the faculty "Back to Courses" from the course sidebar.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
          'section'     => 'faculty',
          'condition'   => 'show_faculty_sidebars:is(on)'
          ),


/* ---------------------------------------------------------*/
/* FOOTER OPTIONS */ 
/* section: footer */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'footer_notes',
    'label'       => __('Footer Option Notes', 'mythology'),
    'desc'        => __('The footer space shows up below the main content area.', 'mythology'),
    'std'         => '',
    'type'        => 'textblock-titled',
    'section'     => 'footer',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'show_footer',
    'label'       => __('Display Footer Widget Space?', 'mythology'),
    'desc'        => __('Choose whether or not you\'d like the footer widget space to be visible. These 3 widget spaces (sidebars) are controlled from the Appearance &gt; Widgets panel.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'footer',
    ),
    array(
    'id'          => 'pre-footer-image',
    'label'       => __('Upload Your Pre-Footer-Image', 'mythology'),
    'desc'        => __('Upload your pre-footer-image image (JPG, GIF, PNG). If you upload an image that is too large for the space allotted to it by the theme, it will scale down.', 'mythology'),
    'type'        => 'upload',
    'section'     => 'footer',
    'condition'   => 'show_footer:is(on)'
    ),
    array(
    'id'          => 'pre-footer-blurb',
    'label'       => __('Pre Footer Blurb', 'mythology'),
    'desc'        => __('The text that you\'d like to display at the left side of the bottom footer row. IE: Discover Polytechnic.', 'mythology'),
    'std'         => '',
    'type'        => 'textarea-simple',
    'section'     => 'footer',
    'rows'        => '1',
    'condition'   => 'show_footer:is(on)'
    ),

    array(
        'id'          => 'footer_columns_count',
        'label'       => __('How Many Columns In Footer Section?', 'mythology'),
        'desc'        => __('The Top Hat is the black row at the top of the site that displays a search bar and social-media links (setup later in this panel).', 'mythology'),
        'std'         => 'one-sixth column',
        'type'        => 'select',
        'section'     => 'footer',
        'condition'   => 'show_footer:is(on)',
        'choices'     => array(
          array(
            'value'       => 'sixteen columns',
            'label'       => __('1 Column', 'mythology'),
            'src'         => ''
          ),
          array(
            'value'       => 'eight columns',
            'label'       => __('2 Columns', 'mythology'),
            'src'         => ''
          ),
          array(
            'value'       => 'one-third column',
            'label'       => __('3 Columns', 'mythology'),
            'src'         => ''
          ),
          array(
            'value'       => 'four columns',
            'label'       => __('4 Columns', 'mythology'),
            'src'         => ''
          ),
          array(
            'value'       => 'one-fifth column',
            'label'       => __('5 Columns', 'mythology'),
            'src'         => ''
          ),
          array(
            'value'       => 'one-sixth column',
            'label'       => __('6 Columns', 'mythology'),
            'src'         => ''
          )
        ),
      ),
    array(
    'id'          => 'post-footer-widget',
    'label'       => __('Upload Your Post-Footer-Image', 'mythology'),
    'desc'        => __('Upload your post-footer-image image (JPG, GIF, PNG). If you upload an image that is too large for the space allotted to it by the theme, it will scale down.', 'mythology'),
    'type'        => 'upload',
    'section'     => 'footer',
    'condition'   => 'show_footer:is(on)'
    ),
    array(
    'id'          => 'show_sub_footer',
    'label'       => __('Display Sub Footer Space?', 'mythology'),
    'desc'        => __('Choose whether or not you\'d like the sub-footer space to be visible.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'footer',
    ),
    array(
    'id'          => 'footer_blurb_left',
    'label'       => __('Left-side Sub-Footer Text', 'mythology'),
    'desc'        => __('The text that you\'d like to display at the left side of the bottom footer row. IE: Copyright 2014, Your Company.', 'mythology'),
    'std'         => __('Left Side Footer Text', 'mythology'),
    'type'        => 'textarea-simple',
    'section'     => 'footer',
    'rows'        => '2',
    'condition'   => 'show_sub_footer:is(on)'
    ),
    array(
    'id'          => 'footer_blurb_right',
    'label'       => __('Right-side Sub-Footer Text', 'mythology'),
    'desc'        => __('The text that shows up on the right side of your footer.', 'mythology'),
    'std'         => __('Right Side Footer Text.', 'mythology'),
    'type'        => 'textarea-simple',
    'section'     => 'footer',
    'rows'        => '3',
    'condition'   => 'show_sub_footer:is(on)'
    ),
    array(
    'id'          => 'footer_social',
    'label'       => __('Show the Social Icons?', 'mythology'),
    'desc'        => __('Fill out the social icons later on in this panel. This just hides or reveals them.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'footer',
    'condition'   => 'show_sub_footer:is(on)'
    ),



/* ---------------------------------------------------------*/
/* SOCIAL OPTIONS */ 
/* section: social */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'social_notes',
    'label'       => __('Social Option Notes', 'mythology'),
    'desc'        => __('The following settings control the icons that show up in the tophat, header, &/or footer of this theme. You can choose to leave all of them blank if you wish, or add your own custom buttons (they don\'t have to be social networks of course!) to create a unique set of clickable buttons in this space.', 'mythology'),
    'std'         => '',
    'type'        => 'textblock-titled',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),      
    array(
    'id'          => 'social_twitter',
    'label'       => __('Twitter Link', 'mythology'),
    'desc'        => __('Enter your Twitter URL that you\'d like to use for all theme-specific social links.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_facebook',
    'label'       => __('Facebook Link', 'mythology'),
    'desc'        => __('Enter your Facebook URL that you\'d like to use for all theme-specific social links.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_google',
    'label'       => __('Google+ Link', 'mythology'),
    'desc'        => __('Enter your Google+ URL that you\'d like to use for all theme-specific social links.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_youtube',
    'label'       => __('YouTube Link', 'mythology'),
    'desc'        => __('Insert the full URL you\'d like used for your YouTube link. Leave empty and the icon won\'t show up at all.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_vimeo',
    'label'       => __('Vimeo Link', 'mythology'),
    'desc'        => __('Enter your Vimeo URL that you\'d like to use for all theme-specific social links.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_linkedin',
    'label'       => __('Linked-In Link', 'mythology'),
    'desc'        => __('Enter your LinkedIn URL that you\'d like to use for all theme-specific social links.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_pinterest',
    'label'       => __('Pinterest Link', 'mythology'),
    'desc'        => __('Your Pinterest URL.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_skype',
    'label'       => __('Skype Link', 'mythology'),
    'desc'        => __('Your Skype URL', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_email',
    'label'       => __('Email Link', 'mythology'),
    'desc'        => __('Your Email URL', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_dribbble',
    'label'       => __('Dribbble Link', 'mythology'),
    'desc'        => __('Your Dribbble URL', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_foursquare',
    'label'       => __('FourSquare Link', 'mythology'),
    'desc'        => __('Your FourSquare URL', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_instagram',
    'label'       => __('Instagram Link', 'mythology'),
    'desc'        => __('Your Instagram URL', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'social_custom',
    'label'       => __('Add Your Own Social Icons:', 'mythology'),
    'desc'        => __('Add a new item for each custom icon that you want to add. An uploaded image and a link are required. The image should be a PNG, sized to about 32x32, but the theme will likely scale these down if you upload anything bigger. Here\'s a good place to start looking for <a href="http://www.komodomedia.com/blog/2009/06/social-network-icon-pack/">additional icons</a>. Don\'t forget to add "http://" before your URL!', 'mythology'),
    'std'         => '',
    'type'        => 'list-item',
    'section'     => 'social',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),  
    array(
    'id'          => 'social_rss',
    'label'       => __('Add your blog\'s RSS link?', 'mythology'),
    'desc'        => __('Want to display your blog\'s RSS feed link?', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'social',
    ),
      
      
/* ---------------------------------------------------------*/
/* CUSTOM CSS */ 
/* section: custom-css */ 
/* ---------------------------------------------------------*/      
    array(
    'id'          => 'customcss',
    'label'       => __('Custom CSS', 'mythology'),
    'desc'        => __('You can enter custom style rules into this box if you\'d like. IE: <i>a{color: red !important;}</i><br />
      This is an advanced option! This is not recommended for users not fluent in CSS... but if you do know CSS, anything you add here will override the default styles.', 'mythology'),
    'std'         => '',
    'type'        => 'textarea-simple',
    'section'     => 'custom-css',
    'rows'        => '20',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
    ),
    array(
    'id'          => 'options_skin',
    'label'       => __('Options Panel Skin', 'mythology'),
    'desc'        => __('If you encounter styling or layout issues with the options-panel, you can turn this off to use default styling.', 'mythology'),
    'std'         => 'on',
    'type'        => 'on_off',
    'section'     => 'custom-css',
    ),



/* ---------------------------------------------------------*/
/* CUSTOM SCRIPTS */ 
/* section: custom-scripts */ 
/* ---------------------------------------------------------*/      
    array(
    'id'          => 'customscripts',
    'label'       => __('Custom Scripts', 'mythology'),
    'desc'        => __('You can enter any custom scripts you need inserted into the header here. For example: <br/>
    <i>
    <code>jQuery(document).ready(function($) {</code><br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<code>$(\'a\').css({"color":"green"});</code><br/>
    <code>});</code>
    </i>', 'mythology'),
    'type'        => 'textarea-simple',
    'section'     => 'custom-scripts',
    'rows'        => '20',
    ),           
   
      
 
/* ---------------------------------------------------------*/
/* QUICK START */ 
/* section: quick-start */ 
/* ---------------------------------------------------------*/       
    array(
    'id'          => 'helpme',
    'label'       => __('Theme Documentation', 'mythology'),
    'desc'        => '
    You can check out the most up-to-date <a href="http://wordpresshelp.wpengine.com/polytechnic/" target="_blank">installation guide here</a>.
    <br />
    You can check out the most up-to-date <a href="http://wordpresshelp.wpengine.com/polytechnic/" target="_blank">full documentation here</a>.

    <br /><hr /><br />

    This theme is designed to be "intuitive" to use, which means that the more you use it, the more comfortable you\'ll get. The first time using any theme can feel overwhelming though, so what follows is a guide for the first steps you should take after activating the theme. 
    <br />

    <br /><hr /><br />

    <h3 class="label">Required Theme Plugins</h3>

    This theme requires you to install a handful of plugins to ensure that you have access to everything we used in the demo. You don\'t need to use these plugins, and advanced users can manually disable them if you choose, but we do ask that you install them upon theme activation.<br /><br />
    Forgot to install any of the required plugins for this theme? No worries, click this link to review any that you missed (this button only works if you haven\'t installed the plugins, otherwise it will say that you do not have access to the page): <br /><br />
    <a href="themes.php?page=install-required-plugins" class="option-tree-ui-button blue load-demo" style="padding: 5px;">Install Required Plugins</a>.

    <br /><hr /><br />

    <h3 class="label">Basic Guide</h3>
    The following is a general guide to setting up. If you are looking for the full detailed <strong>step by step guide</strong> for <strong>setting up the demo</strong>, check out the <a href="http://wordpresshelp.wpengine.com/polytechnic/" target="_blank">installation guide here</a><br />
       
          <br /><br />
          
          <strong style="color: #5ead29;">Note:</strong> Users that already have their own content can skip to Step 2 (if you want to import the Theme Options) OR Step 3 (if you plan on filling them out yourself).<br />
          
          <br /><br />
          
          If this is a fresh WordPress installation (meaning, you don\'t have any content yet, there ain\'t no shame in wanting to just copy some of the demo-content to get a head start. We have included a few files that you can import to your WordPress installation to copy the theme-demo data. They are located inside the "<strong>Resources/Theme-Demo-Content</strong>" folder of the theme package you downloaded when you purchased this theme... Find the following two files and get them ready:
          
          <ol>
          <li>Theme-Package-Name/Resources/Theme-Demo-Content/<strong>Demo-Content.XML</strong></li>
          <li>Theme-Package-Name/Resources/Theme-Demo-Content/<strong>Demo-Theme-Options.TXT</strong></li>
          </ol>
        
          <br /><hr /><br />
           
    <h3 class="label">Step 1: Import "Demo-Content.xml" (Imports Posts, Pages & Menus)</h3>
    
    This file will load any Posts, Pages, and Menu items that the demo uses. Use the following steps to import this file:
        <ol>
          <li>Open the <a target="_blank" href="'.admin_url().'import.php">Tools > Import</a> panel. Select "WordPress". 
            <ol>
            <li>You may be prompted to install & activate the WordPress Importer plugin if this is your first time. Go ahead and do so, then return to the Importer.</li></ol>
            </li>
          <li>Import the provided XML file: Demo-Content.xml </li>
        <li>Wait a few minutes for the process to complete, then you\'re done! Review the imported content:
            <ol>
            <li>Visit the <a target="_blank" href="'.admin_url().'nav-menus.php">Appearances > Menus</a> panel to make sure the menu spaces are saved properly.</li>
            <li>Visit the <a target="_blank" href="'.admin_url().'edit.php?post_type=page">Pages</a> panel to take a quick peek at the <strong>Pages</strong> that you imported.</li>
            <li>Visit the <a target="_blank" href="'.admin_url().'edit.php">Posts</a> panel to take a quick peek at the <strong>Posts</strong> that you imported.</li>
            </ol>
        </li>
        <li>At any point, you can delete the Posts, Pages, Menus, and Users that were imported here from their respective admin panels.</li>
      </ol><br /><br />
      
  <br /><hr /><br />
  
   <h3 class="label">Step 2: Import "Demo-Theme-Options.txt" (Imports the settings in this panel)</h3>
    
   This will load any Theme Options that we used in the demo:
   
        <ol>
          <li>Go to the <a target="_blank" href="'.admin_url().'admin.php?page=ot-settings">OptionTree > Settings</a> panel.</li>
          <li>Open the "<strong>Demo-Theme-Options.txt</strong>" file in a text editor.</li>
          <li>Copy & paste the strange looking content from that .TXT file into the "<strong>Options</strong>" text field at the bottom of this page. (<a href="http://tinyurl.com/d6sajqp">See Image</a>)</li>         
          <li>Note that <strong>some settings may still need to be filled out or adjusted to your specific site</strong> (like the Slider Shortcode, Categories, and Images), so take a few minutes to review the options and play around with it. This import method is a quick way to start, but by no means should it conclude your work in the Theme Options panel!</li>
      </ol><br /><br />
   
  <br /><hr /><br />    
  
  
   <h3 class="label">Step 3: Check the Content for Missing Options (and fill it out as needed)</h3>
   
   We\'ve now imported the Theme-Options and the demo Posts and Pages. Some settings may not have imported properly though - so it is best to check the pages (especially those like The Skeleton Grid) and the Theme Options panel for any settings that may have been left blank. This usually just includes the "Category Filter" on the Blog and Skeleton Grid pages.<br />
   
   Next, make sure the Menus were added successfully. In most cases, the Menus will import, but you must assign then to their <strong style="color: #57ac2d">Menu Location</strong> in the <strong style="color: #57ac2d">Appearances > Menus</strong> panel. <br />
   
   Last, we should note that the <strong style="color: #57ac2d">Layout Builder</strong> content does not have a stable import method of as right now. You can use their handy <strong style="color: #57ac2d">Sample Layout</strong> button to quickly see how to use this system though.
   
   <br /><hr /><br />
   
   
  <h3 class="label">Step 4: Add Your Widgets</h3>
  It should be noted that this will not import all of the demo widgets. This is because we may use some widgets that require plugins that you have not yet installed and in many cases, importing widgets along with their custom settings is impossible & will break a theme because it is dependent upon unique user settings. Take a minute to add some of your own desired widgets from the <a href="'.admin_url().'widgets.php">Appearances > Widgets</a> panel.
  To help out, we\'ve included a Demo-Widgets.WIE import file. This file includes the demo widgets and some placeholder widgets to help out with the ones that need some extra help. Find this file in: 
  <br />
  Theme-Package-Name/Resources/Theme-Demo-Content/Widgets.WIE
  <br />
  Follow these steps to load all of the widget and sidebar settings that the demo uses.
  <ol>
    <li>First, navigate to your Plugins panel and make sure that the Widget Importer & Exporter plugin is installed and activated. Search and download this free plugin if it is not. </li>
    <li>Navigate to the Tools > Widget Import/Export panel.</li>
    <li>Click "Browse" > navigate and select the provided WIE file "widgets.wie" > click "Import Widgets"</li>
    <li>If there are any error produced they could be from content that already exists or from missing plugins. This is normal but if you are concerned with the results, you can re-upload this file again after installing/activating any missing plugins.</li>
    <li>Navigate to Appearance > Widgets to review the widgets and sidebar settings uploaded.</li>
  </ol>

  <br /><hr /><br />   
  
  <h3 class="label">Step 5: Assign A Homepage</h3>
  This theme will display a list of posts on the front page by default. If you want to use a "Static Page" with your own custom content instead, just visit the <a target="_blank" href="'.admin_url().'options-reading.php">Settings > Reading</a> panel to display a Static Page as the Front Page.<br />
  
  You will be able to add your own further customizations to the the page that you have selected for this in Pages > "Your Page."

  The demo is using the "Welcome" page included in the Demo-Content.XML file.
  
  <br /><hr /><br />   
  
  <h3 class="label">Step 6: Import Sliders, Copy the Shortcode</h3>
  To import the sliders used in the demo you\'ll need to upload the slider_examples.txt files found in: 
Theme-Package-Name/Resources/Slider-Skeletons/slider_examples.txt (This includes: slider_header_ad_space.txt , slider_homepage_primary.txt and slider_one_third.txt)
6.1.1  This will load all of the sliders that the demo uses. 

6.2  Use the following steps to import each of these files: 

6.2.1  Open the Revolution Slider Panel > Click Import Slider > Browse > and select the slider_header_ad_space.txt file found in Theme-Package-Name > Resources > Slider Skeletons folder. 

  
  <br /><hr /><br />   
  
  <h3 class="label">Step 7: Have Fun!</h3>
  At this point you should have a fairly decent looking front-end site. That\'s good! But you won\'t really be able to call it your own until you start adding your own content (posts, pages, etc.) and filling out your own Theme Options. This might take an afternoon or two for new users, but we\'re confident that you\'ll be rocking out awesome sites with this theme in no time. Remember that there is a <strong style="color: #57ac2d">full & thorough set of documentation here</strong>.
  

    <br /><hr /><br />

    <h3 class="label">Leave a Rating</h3>
    Like this theme? Rate it from your ThemeForest "downloads" page & we\'ll keep bringing new features & updates!<br /> It honestly means a LOT of us that you take a moment to do this. Little stuff like this helps us to hire additional support staff, release updates to keep up with the latest new core code, and lots more! So, if you like it, rate it <img alt="star" src="http://makedesign.wpengine.com/reactor/star.png"><img alt="star" src="http://makedesign.wpengine.com/reactor/star.png"><img alt="star" src="http://makedesign.wpengine.com/reactor/star.png"><img alt="star" src="http://makedesign.wpengine.com/reactor/star.png"><img alt="star" src="http://makedesign.wpengine.com/reactor/star.png">

    <br /><hr /><br />

    <h3 class="label">File a Support Ticket</h3>
        Need help? Check out this <a target="_blank" href="http://themeisland.ticksy.com/faq/1954">FAQ</a>, then please file a ticket at our support forum if your question fits into any of these general categories:
        
        <ol>
        <li><strong style="color: #57ac2d;">Basic Theme Usage.</strong> <i>How to use any core, advertised features.</i></li>
        <li><strong style="color: #57ac2d;">Bugs.</strong> <i>Report these and we\'ll squash them ASAP if we can.</i></li>
        <li><strong style="color: #57ac2d;">Feature Requests.</strong> <i>Have a brilliant idea for how to make this theme better? Let us know!</i></li>
        </ol>
        
        <strong>Unfortunatly, we can\'t help out with the following stuff</strong>:
        
        <ol>
        <li><strong style="color: #d44848;">Plugin Integrations.</strong> We do our best to keep the theme as clean and compliant as possible - if you notice a glaring problem that\'s blocking a plugin from working, report it - Beyond that, we can\'t provide much help with integrating add-on plugins as there are literally 10,000+ plugins of varying qualities floating around the interwebs.</li>
        <li><strong style="color: #d44848;">Non-Trivial Customizations.</strong> This can be anything from "restyling the portfolio grid" to "adding a rotating banner to the header that links with Google AdSense". We provide a lot of customization options in our theme, for those that aren\'t covered, we will gladly entertain them as a Feature Request, but we can\'t provide the code for you on an on-demand basis without shorting other customers. Still, it doesn\'t hurt to ask - sometimes we will be able to help out even if it\'s outside of the scope if you catch us on a light support day!</li>
        <li><strong style="color: #d44848;">Webhost-Related Issues (including site loading speed).</strong> These types of issues are pretty rare nowadays as most non-free webhosts have gotten really good, but if it is determined that a problem is the result of a web-host specific setting (such as a bottlenecked upload limit, an obscure WP-Config setting, etc.), we\'ll usually ask that you take it up with the webhost.</li>
    
        </ol>


<br />      

<a target="_blank" href="http://themeisland.ticksy.com/" style="float: none !important; padding: 5px;" class="option-tree-ui-button blue light save-layout" title="Open in New Window or Tab to File a Ticket" type="submit">I\'ve Read the Disclaimers. File a Ticket</a><br /><br />      
 
<br /><hr /><br />

    ',
    'type'        => 'textblock-titled',
    'section'     => 'quick-start',
    ),


/* ---------------------------------------------------------*/
/* CUSTOM LOGIN */ 
/* section: custom-login */ 
/* ---------------------------------------------------------*/
    array(
    'id'          => 'login_details',
    'label'       => __('Custom Login Options! Beta!', 'mythology'),
    'desc'        => __('This panel is where you can set some basic options for the login page. The login page is handled by WordPress, but we\'ve included some options so that you can customize this. This option is still considered beta, but it\'s here if you would like to try it out. <br /><br />', 'mythology'),
    'type'        => 'textblock-titled',
    'section'     => 'custom-login',

    ),
    array(
    'id'          => 'custom_login',
    'label'       => __('Show the Custom Login?', 'mythology'),
    'desc'        => __('The login is the page that users see when trying to login to WordPress (ie. domain.com/wp-admin). Turning the Custom Login "On" will use these options to override the default styling for your WordPress Login.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'section'     => 'custom-login',
    ),
        array(
            'id'          => 'custom_login_align',
            'label'       => __('Position of Login', 'mythology'),
            'desc'        => __('Choose the position of the login form.', 'mythology'),
            'std'         => 'center',
            'type'        => 'select',
            'section'     => 'custom-login',
            'condition'   => 'custom_login:is(on)',
            'choices'     => array(
              array(
                'value'       => 'left',
                'label'       => __('Left', 'mythology'),
              ),
              array(
                'value'       => 'center',
                'label'       => __('Center', 'mythology'),
              ),
              array(
                'value'       => 'right',
                'label'       => __('Right', 'mythology'),
              )
            ),
          ),
        array(
        'id'          => 'login_bgimage',
        'label'       => __('Upload Your Login Background Image', 'mythology'),
        'desc'        => __('Upload your login background image (JPG, GIF, PNG). If you upload an image that is too large for the space allotted to it by the theme, it will scale down. Just make sure to upload an image large enough for large size screens.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'custom-login',
        'condition'   => 'custom_login:is(on)',
        ),
        array(
        'id'          => 'login_logo',
        'label'       => __('Upload Your Login Logo', 'mythology'),
        'desc'        => __('Upload your login logo image (JPG, GIF, PNG). If you upload an image that is too large for the space allotted to it by the theme, it will scale down.', 'mythology'),
        'type'        => 'upload',
        'section'     => 'custom-login',
        'condition'   => 'custom_login:is(on)',
        ),
        array(
        'id'          => 'login_background_color',
        'label'       => __('Login Fallback BG Color', 'mythology'),
        'desc'        => __('The main background color fallback (if no bg image is loaded or something happens to the bg image).', 'mythology'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'custom-login',
        'condition'   => 'custom_login:is(on)',
         ),  
        array(
        'id'          => 'login_footer_blurb',
        'label'       => __('Footer Text', 'mythology'),
        'desc'        => __('The text that you\'d like to display at the bottom footer row. IE: Copyright 2014, Your Company.', 'mythology'),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'custom-login',
        'rows'        => '2',
        'condition'   => 'custom_login:is(on)'
        ),
        array(
            'id'          => 'login_footer_blurb_align',
            'label'       => __('Position of Footer Text', 'mythology'),
            'desc'        => __('Choose the position of the Footer Text.', 'mythology'),
            'std'         => 'left',
            'type'        => 'select',
            'section'     => 'custom-login',
            'condition'   => 'custom_login:is(on)',
            'choices'     => array(
              array(
                'value'       => 'left',
                'label'       => __('Left', 'mythology'),
              ),
              array(
                'value'       => 'right',
                'label'       => __('Right', 'mythology'),
              )
            ),
          ),
      
      

  )
);


  /* ---------------------------------------------------------*/
  /* THAT'S IT! */ 
  /* NO MORE THEME OPTIONS */ 
  /* ---------------------------------------------------------*/  

  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}