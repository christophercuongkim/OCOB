<?php

/* Load up our Layout Options */
/* We'll use these in the theme-options and meta-boxes for OptionTree */

/*
/* How to make changes: 
/* 1. Start here. Add/Remove any layout options you want to register. For each option, also include a link to a layout icon file.
/* 2. Open [ot-theme-options.php] and [ot-meta-boxes.php] files to hook the layout options into the actual option panels.
/* 3. Then move into [theme-layout-variables.php] to assign classes to each layout option. Make sure you register any new global variables at the top of the file!
/* 4. The actual template files (header.php, page.php, etc.) will plug the classes into the appropriate DIVs. Make sure you re-call your global variables here as well!
*/

function filter_radio_images( $array, $field_id ) {  
  /* only run the filter where the field ID is my_radio_images */
  if(!defined('mythology_THEME_URL')) {
    define( 'mythology_THEME_URL', get_template_directory_uri());
  }

  if ( $field_id == 'content_layout' ) {
    $array = array(
        array(
          'value'   => 'default',
          'label'   => __( 'Theme Default', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/default.png'
        ),
        array(
          'value'   => 'left-sidebar',
          'label'   => __( 'Left Sidebar', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/left-sidebar.png'
        ),
        array(
          'value'   => 'right-sidebar',
          'label'   => __( 'Right Sidebar', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/right-sidebar.png'
        ),
        array(
          'value'   => 'no-sidebar',
          'label'   => __( 'No Sidebar', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/no-sidebar.png'
        ),      
        array(
          'value'   => 'dual-right-sidebar',
          'label'   => __( '2 Right Sidebars', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/dual-right-sidebar.png'
        ),
        array(
          'value'   => 'dual-left-sidebar',
          'label'   => __( '2 Left Sidebars', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/dual-left-sidebar.png'
        ),
        array(
          'value'   => 'dual-outside-sidebar',
          'label'   => __( '2 Outside Sidebars', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/dual-outside-sidebar.png'
        )
      );
    }

    if ( $field_id == 'header_layout' ) {
    $array = array(
        array(
          'value'   => 'default',
          'label'   => __( 'Theme Default', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/default.png'
        ),        
        array(
          'value'   => 'logo-left-menu-right',
          'label'   => __( 'Logo Left, Ad Right', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/left-right.png'
        ),
        array(
          'value'   => 'logo-center-menu-center',
          'label'   => __( 'Logo Center, Ad Center', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/center-center-stack.png'
        ),
        array(
          'value'   => 'logo-right-menu-left',
          'label'   => __( 'Logo Right, Ad Left', 'mythology' ),
          'src'     => mythology_THEME_URL . '/mythology-core/option-tree-candy-skin/images/right-left.png'
        ),
      );
    }
  
  return $array;
  
}
add_filter( 'ot_radio_images', 'filter_radio_images', 10, 2 );

/* Layout Variables Function Start */

function get_layout_variables(){

/* DECLARE HEADER LAYOUT VARIABLES & DEFAULTS */
global $myth_header_layout;
global $myth_logo_layout_classes;
global $myth_menu_layout_classes;

$myth_header_layout = "default";
$myth_logo_layout_classes = "left";
$myth_menu_layout_classes = "right";

if(ot_get_option('header_layout')) :
	$myth_header_layout = ot_get_option('header_layout');
	endif;

	if( $myth_header_layout == "default" OR $myth_header_layout == "" OR $myth_header_layout == "logo-left-menu-right" ) :
		$myth_logo_layout_classes = "left text-left";
		$myth_menu_layout_classes = "right text-right";

	elseif ( $myth_header_layout == "logo-right-menu-left" ) :
		$myth_logo_layout_classes = "right text-right";
		$myth_menu_layout_classes = "left text-left";

	elseif ( $myth_header_layout == "logo-center-menu-center" ) :
		$myth_logo_layout_classes = "center clearfix text-center";
		$myth_menu_layout_classes = "sixteen center clearfix text-center";

	endif;


/* DECLARE LAYOUT VARIABLES & DEFAULTS */

global $myth_primary_layout_classes;
global $myth_secondary_layout_classes;
global $tertiary_layout_classes; 
global $myth_content_layout;

$myth_content_layout = "default";
$myth_primary_layout_classes = "eleven columns right";
$myth_secondary_layout_classes = "five columns left";


if(ot_get_option('content_layout')) :
	$myth_content_layout = ot_get_option('content_layout');
	endif;

	if( get_custom_field('content_layout') && get_custom_field('content_layout') != "default" ) :
		$myth_content_layout = get_custom_field('content_layout');
		endif;

	if( $myth_content_layout == "default" OR $myth_content_layout == "" OR $myth_content_layout == "right-sidebar" ) :
		$myth_primary_layout_classes = "left eleven columns";
		$myth_secondary_layout_classes = "right five columns";

	elseif ( $myth_content_layout == "left-sidebar" ) :
		$myth_primary_layout_classes = "right eleven columns";
		$myth_secondary_layout_classes = "left five columns";

	elseif ( $myth_content_layout == "no-sidebar" ) :
		$myth_primary_layout_classes = "sixteen columns";
		$myth_secondary_layout_classes = "hide";

	elseif ( $myth_content_layout == "dual-left-sidebar" ) :
		$myth_primary_layout_classes = "right eight columns";
		$myth_secondary_layout_classes = "left four columns";
		$tertiary_layout_classes = "left four columns";

	elseif ( $myth_content_layout == "dual-right-sidebar" ) :
		$myth_primary_layout_classes = "left eight columns";
		$myth_secondary_layout_classes = "right four columns";
		$tertiary_layout_classes = "right four columns";

	elseif ( $myth_content_layout == "dual-outside-sidebar" ) :
		$myth_primary_layout_classes = "left eight columns";
		$myth_secondary_layout_classes = "right four columns";
		$tertiary_layout_classes = "left four columns"; 

	endif;
}

?>