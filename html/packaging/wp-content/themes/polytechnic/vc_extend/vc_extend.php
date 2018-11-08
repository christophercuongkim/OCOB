<?php
/*
Plugin Name: Hover Image - A Visual Composer Extention
Plugin URI: http://wpbakery.com/vc
Description: A Visual Composer Extention that adds the Hover Image Module
Version: 0.1
Author: Theme Island Studios
Author URI: http://themeisland.net
License: GPLv2 or later
*/

/*
This example/starter plugin can be used to speed up Visual Composer plugins creation process.
More information can be found here: http://kb.wpbakery.com/index.php?title=Category:Visual_Composer

In this example all plugin related functions will have a "vc_extend" prefix, make sure to use unique prefix
in your plugin. Otherwise, you (or your users) may experience "Cannot redaclare function" error.
*/

// don't load directly
if (!defined('ABSPATH')) die('-1');

/*
Display notice if Visual Composer is not installed or activated.
*/
if ( !defined('WPB_VC_VERSION') ) { add_action('admin_notices', 'vc_extend_notice'); return; }
function vc_extend_notice() {
  $plugin_data = get_plugin_data(__FILE__);
 /*  print '
  <div class="updated">
    <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
  </div>'; */
}

/*
Load plugin css and javascript files
*/
add_action('wp_enqueue_scripts', 'vc_extend_js_css');
function vc_extend_js_css() {
  wp_register_style( 'vc_extend_style', get_template_directory_uri() . '/vc_extend/vc_extend.css' );
  wp_enqueue_style( 'vc_extend_style' );
  
  // If you need any javascript files on front end, here is how you can load them.
  // wp_register_style( 'vc_extend_js', get_template_directory_uri() . '/vc_extend/vc_extend.js' );
  // wp_enqueue_style( 'vc_extend_js' );

  // wp_enqueue_script( 'vc_extend_js', get_template_directory_uri() . '/vc_extend/vc_extend.js' );
}

/*
Lets register our shortcode with bartag base and few params (attributes):
  * foo
  * color
  * content
  
  [bartag foo="something" color="#FFF"] Content here [/bartag]
  
  More information can be found here:
  http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
*/
add_shortcode( 'themesingleimage', 'themesingleimage_func' );


function themesingleimage_func( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'pb_title'    => '',
    'img_width' => '100%',
    'img_height' => 'auto',
    'alignment' => 'left',
    'img_height' => '',
    'color' => '#6AC9F5',
    'opacity' => '0.9',
    'start_height' => '40px',
    'end_height' => '100%',
    'start_height_tablet' => '25px',
    'end_height_tablet' => '100%',
    //'el_class' => '',
    'image' => '',
    'img_size'  => '',
    'img_link'  => '',
    'img_alt'   => '',
  ), $atts ) );

  $i=1;
  foreach ($atts as $at) {
    $i++;
  }

  // PRIMARY VARIABLES AND STATEMENTS
  if ( $pb_title == NULL ) $pb_title_output = '';
  elseif ( $pb_title != NULL ) $pb_title_output = '<h4 class="pb_title">'.$pb_title.'</h4>';

  $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

  //add_image_size( 'new_single_image_thumb', $img_size, true );
  $sanitized_img_alt = esc_attr($img_alt);

  $img_id = preg_replace('/[^\d]/', '', $image);
  $img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => 'image-inner', ));
  //if ( $img == NULL ) $img['thumbnail'] = '<img class="' '" src="'  '" />'; //' <small>'.__('This is image placeholder, edit your page to replace it.', 'js_composer').'</small>';
  
  $img_attachment = wp_get_attachment_image_src( $img_id, $img_size);
  //$img_url = $img_attachment[0];
  if ( $img_size == NULL ) $img_output = '<img alt="'.$img_alt.'" src="'.$img_attachment[0].'">';
  elseif ( $img_size != NULL ) $img_output = $img['thumbnail'];
  

  $css_align = ' vc_align_'.$alignment;


  $sanitized_img_link     = esc_url($img_link);
  if ( $img_link == NULL ) :
    $img_link_start = '';
    $img_link_end = '';
  elseif ( $img_link != NULL ) :
    $img_link_start = '<a href="'.$sanitized_img_link.'">';
    $img_link_end = '</a>';
    endif;

  //$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, ) );
  //if ( $img == NULL ) $img['thumbnail'] = '<img class="' '" src="' . vc_asset_url( 'vc/no_image.png' ) . '" />'; //' <small>'.__('This is image placeholder, edit your page to replace it.', 'js_composer').'</small>';
  //$img_output = $img['thumbnail'];

  //<div class='module-image' style='width:".$img_attachment[1]."; height:".$img_attachment[2].";'>

  //wpb_single_image

  $sanitized_css_align     = esc_attr($css_align);
  $sanitized_img_width     = esc_attr($img_width);

  $sanitized_color       = esc_attr($color);
  $sanitized_opacity     = esc_attr($opacity);
  $sanitized_start_height  = esc_attr($start_height);
  $sanitized_end_height    = esc_attr($end_height);

  $sanitized_start_height_tablet  = esc_attr($start_height_tablet);
  $sanitized_end_height_tablet    = esc_attr($end_height_tablet);

  return " 
 
          <div class='poly_custom-".$i." hover-image wpb_content_element ".$sanitized_css_align."'>
            <div class='module-inner' style='width:{$sanitized_img_width};'>
              
              {$img_link_start}
                <div class='module-image'>
                  {$img_output}
                </div>
              {$img_link_end}

              <div class='module-content'  style=''>
                <div class='content-inner'>
                  {$pb_title_output}
                  {$content}
                </div>
              </div>
              
              <div class='module-background' style='background-color:{$sanitized_color}; opacity:{$sanitized_opacity}'>
              </div>

              <div class='pb_transitions'>
                <div class='pb_css'>
                <style>
                      html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner .module-content,
                      html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner .module-background {
                        height: {$sanitized_start_height};
                      }
                      html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner:hover .module-content, 
                      html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner:hover .module-background { 
                        height: {$sanitized_end_height};
                      }
                      /* #Tablet (Portrait) */
                      @media only screen and (min-width: 768px) and (max-width: 959px) {
                        html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner .module-content, 
                        html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner .module-background {
                            height: {$sanitized_start_height_tablet};
                        }
                        html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner:hover .module-content, 
                        html:not(.no-csstransitions) .poly_custom-".$i.".hover-image .module-inner:hover .module-background { 
                          height: {$sanitized_end_height_tablet};
                        }
                      }
                  </style>
                </div>
                <div class='pb_jquery'>
                  <input class='start_position' type='text' value='{$sanitized_start_height}' style='display:none;'>
                      <input class='end_position' type='text' value='{$sanitized_end_height}' style='display:none;'>
                    </div>
                </div>

            </div>

      </div>


  ";
}

/*
Lets call wpb_map function to "register" our custom shortcode within Visual Composer interface.
*/

vc_map( array(
  "name" => __("Hover Image", 'vc_extend'),
  "description" => "A Custom Theme Module",
  "base" => "themesingleimage",
  "class" => "",
  "controls" => "full",
  "icon" => "themesingleimage",
  "category" => __('Content', 'js_composer'),
  'admin_enqueue_js' => array( get_template_directory_uri() . '/vc_extend/vc_extend.js'),
  'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extend/vc_extend_admin.css' ),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widet Title", "js_composer"),
      "param_name" => "pb_title",
      "value" => "",
      "description" => __("Optional. Add a Title for this Pixel Box.", "js_composer")
    ),
    array(
      "type" => "attach_image",
      "heading" => __("Image", "js_composer"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "js_composer")
    ),
    /*
    array(
      "type" => "textfield",
      "heading" => __("Image Width", "js_composer"),
      "param_name" => "img_width",
      "value" => "",
      "description" => __("Select your image width (ie. 100px, 100%).", "js_composer")
    ),*/
    /*
    array(
      "type" => "textfield",
      "heading" => __("Image Height", "js_composer"),
      "param_name" => "img_height",
      "value" => "",
      "description" => __("Select your image height (ie. 100px, 100%).", "js_composer")
    ),*/
    /* array(
      "type" => "dropdown",
      "heading" => __("Image alignment", "js_composer"),
      "param_name" => "alignment",
      "value" => array(__("Align left", "js_composer") => "left",
       __("Align right", "js_composer") => "right", 
       __("Align center", "js_composer") => "center"),
      "description" => __("Select image alignment.", "js_composer")
    ), */
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => __("Hover Background Color", 'vc_extend'),
      "param_name" => "color",
      "value" => '#FF0000', //Default Red color
      "description" => __("Choose hover content background color", 'vc_extend')
    ),
    /*
    array(
      "type" => "textfield",
      "heading" => __("Scale Image by Height", "js_composer"),
      "param_name" => "img_height",
      "value" => "",
      "description" => __("Optional: This will crop your images based on the height set. Select your image height (default = 'auto').", "js_composer")
    ),*/
    
    array(
      "type" => "textfield",
      "heading" => __("Image Size", "js_composer"),
      "param_name" => "img_size",
      "value" => "",
      "description" => __("Select your image size.", "js_composer")
    ),

    /* FEATURE REQUEST */
    array(
      "type" => "textfield",
      "heading" => __("Image Link/URL", "js_composer"),
      "param_name" => "img_link",
      "value" => "",
      "description" => __("If you want the image to have a link.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Image Alt", "js_composer"),
      "param_name" => "img_alt",
      "value" => "",
      "description" => __("If 'Image Size' is not set, use this field to add an alt-tag to the image.", "js_composer")
    ),
   
    /*
    array(
      "type" => "textfield",
      "holder" => "div",
      "class" => "",
      "heading" => __("Text", 'vc_extend'),
      "param_name" => "foo",
      "value" => __("Default params value", 'vc_extend'),
      "description" => __("Description for foo param.", 'vc_extend')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Background Opacity", "js_composer"),
      "param_name" => "opacity",
      "value" => "",
      "description" => __("Select hover content background opacity (default = 0.9).", "js_composer")
    ),
    */
    array(
      "type" => "textfield",
      "heading" => __("Start Height", "js_composer"),
      "param_name" => "start_height",
      "value" => "",
      "description" => __("Select hover content start height (default = 40px).", "js_composer")
    ),
    
    array(
      "type" => "textfield",
      "heading" => __("End Height", "js_composer"),
      "param_name" => "end_height",
      "value" => "",
      "description" => __("Select hover content end height (default = 100%).", "js_composer")
    ),

    array(
      "type" => "textfield",
      "heading" => __("Tablet(Portrait): Start Height", "js_composer"),
      "param_name" => "start_height_tablet",
      "value" => "",
      "description" => __("Select hover content start height (default = 25px).", "js_composer"),
      "group" => "Responsive Settings",
    ),
    
    array(
      "type" => "textfield",
      "heading" => __("Tablet(Portrait): End Height", "js_composer"),
      "param_name" => "end_height_tablet",
      "value" => "",
      "description" => __("Select hover content end height (default = 100%).", "js_composer"),
      "group" => "Responsive Settings",
    ),
    

    array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "",
      "heading" => __("Hover Content Field", 'vc_extend'),
      "param_name" => "content",
      "value" => __("<p>I am test text block. Click edit button to change this text.</p>", 'vc_extend'),
      "description" => __("Enter your content.", 'vc_extend')
    ), 
  )
) );




