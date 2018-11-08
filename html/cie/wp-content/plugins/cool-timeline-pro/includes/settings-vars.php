<?php 
    $ctl_options_arr = get_option('cool_timeline_options');
   
    $default_icon = isset($ctl_options_arr['default_icon'])?$ctl_options_arr['default_icon']:'';
    $ctl_post_per_page = isset($ctl_options_arr['post_per_page'])?$ctl_options_arr['post_per_page']:0;
    $story_desc_type =isset($ctl_options_arr['desc_type'])?$ctl_options_arr['desc_type']:'';
    $ctl_content_length =isset($ctl_options_arr['content_length']);
    $ctl_posts_orders =isset( $ctl_options_arr['posts_orders']) ? $ctl_options_arr['posts_orders'] : "DESC";
    $disable_months = isset($ctl_options_arr['disable_months']) ? $ctl_options_arr['disable_months'] : "no";
         	$enable_navigation = isset($ctl_options_arr['enable_navigation'] )? $ctl_options_arr['enable_navigation'] : 'yes';
    $navigation_position =isset( $ctl_options_arr['navigation_position']) ? $ctl_options_arr['navigation_position'] : 'right';

    $enable_pagination = isset($ctl_options_arr['enable_pagination']) ? $ctl_options_arr['enable_pagination'] : 'no';

    $slider_animation =  isset($ctl_options_arr['slider_animation']) ? $ctl_options_arr['slider_animation'] : "slide";
    $ctl_slideshow =  isset($ctl_options_arr['ctl_slideshow']) ? $ctl_options_arr['ctl_slideshow'] : true;
    $animation_speed = isset($ctl_options_arr['animation_speed'])? $ctl_options_arr['animation_speed'] : 7000;      
  
    $r_more=  isset($ctl_options_arr['display_readmore'])?$ctl_options_arr['display_readmore']:"yes";

    /*
    Content timeline only
    */

    //$ctl_posts_order='date';
    $post_meta =  isset($ctl_options_arr['post_meta']) ? $ctl_options_arr['post_meta'] : 'yes';

    $format = __('d/M/Y', 'cool-timeline');
    $year_position = 2;
     $ctl_post_per_page = $ctl_post_per_page ? $ctl_post_per_page : 10;
     $ctl_content_length ? $ctl_content_length : 100;
?>