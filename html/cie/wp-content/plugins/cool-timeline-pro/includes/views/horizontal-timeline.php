<?php

$ctl_html='';
$ctl_format_html='';
$display_s_date='';
$same_day_post='';
$dates_li='';
$s_styles='';
$ctl_slideshow ='';

//$ctl_title_pos = $ctl_title_pos ? $ctl_title_pos : 'left';
$ctl_content_length ? $ctl_content_length : 100;
$itcls='';
if(in_array($active_design,array("design-2","design-3","design-4"))){

    $items = $attribute['items'] ? $attribute['items'] : "3";
	$itcls='hori-items-'.$items;
	
}else{
    $items ='0';
	$itcls='hori-items-1';
}

$i=0;
$ctl_loop = new WP_Query(apply_filters( 'ctl_stories_query',$args));

if ($ctl_loop->have_posts()) {

    while ($ctl_loop->have_posts()) : $ctl_loop->the_post();
         global $post;
        $post_id=get_the_ID();
        $story_format = get_post_meta( $post_id, 'story_format', true);
        $img_cont_size = get_post_meta( $post_id, 'img_cont_size', true);
        $ctl_story_date = get_post_meta( $post_id, 'ctl_story_date', true);
        $ctl_story_color = get_post_meta( $post_id, 'ctl_story_color', true);
      
        $container_cls=isset($img_cont_size)?$img_cont_size:"full";
        $ctl_format_html='';
        $story_id="story-id-".$post_id;
        $i++;
        $s_styles.=CooltimelineStyles::ctl_h_story_styles($post_id);
       
        $posted_date='';
        $ctl_story_date_lbl = get_post_meta($post_id, 'ctl_story_date_lbl', true);
        $posted_date=ctl_get_story_date($post_id,$date_formats);
        
        $custom_link = get_post_meta($post_id, 'story_custom_link', true);

          $slink_s='';
          $slink_e='';
          if($r_more=="yes"){
            if(isset($custom_link)&& !empty($custom_link)){
            $slink_s='<a target="_blank" title="'.esc_attr(get_the_title()).'" href="'.esc_url($custom_link).'">';
             $slink_e='</a>';
            }else{
            $slink_s='<a title="'.esc_attr(get_the_title()).'" href="'.esc_url(get_the_permalink()).'">';
             $slink_e='</a>';
                }
          } 
        $selected='';
        if($i==1){
            $selected='selected';
        }

        $clt_icon='';
        if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
            $icon=ctl_post_icon($post->ID,$default_icon);
            $clt_icon .='<span class="icon-placeholder">'.$icon.'</span> ';
         }
       
         if($based=="custom"){
         $ctl_story_lbl = get_post_meta( $post_id, 'ctl_story_lbl',true);
         $ctl_story_lbl2 = get_post_meta( $post_id, 'ctl_story_lbl_2',true);
        $lb1= '<span class="custom_story_lbl">'.__($ctl_story_lbl,'cool-timeline').'</span>';
        $lb2= '<span class="custom_story_lbl_2">'.__($ctl_story_lbl2,'cool-timeline'). '</span>';
          $dates_li .= ' <li id="' . esc_attr($story_id ). '" class="ht-dates-'.esc_attr($design).'" data-date="' . esc_attr($story_id ). '">'.$clt_icon.'<span class="ctl-story-time ' . esc_attr($selected ). '"  data-date="' .esc_attr($story_id). '" >'. $lb1.$lb2.'</span></li>';
        
        }else{

     if($active_design=='design-3'||$active_design=='design-4'||$active_design=='design-6') {
            $dates_li .= ' <li class="ht-dates-'.esc_attr($design).'" id="' . esc_attr($story_id ). '" data-date="' . esc_attr($story_id ). '">'.$clt_icon.'<span class="ctl-story-time ' . esc_attr($selected ). '"  data-date="' .esc_attr($story_id). '" ><div class="ctl-tooltips"><span>'. apply_filters('ctl_story_dates',$posted_date).'</span></div></span></li>';
            }else{
             $dates_li .= ' <li  id="' . esc_attr($story_id ). '" class="ht-dates-'.esc_attr($design).'" data-date="' . esc_attr($story_id ). '">'.$clt_icon.'<span class="ctl-story-time ' . esc_attr($selected ). '"  data-date="' .esc_attr($story_id). '" >'. apply_filters('ctl_story_dates',$posted_date).'</span></li>';
            }
         }
     $ctl_html .= '<li id="' . esc_attr($story_id ). '-content" data-date="'.esc_attr($story_id).'" class="ht-'.esc_attr($design).'">';
    $ctl_html .= '<div class="timeline-post '.esc_attr($post_skin_cls).' ht-content-'.esc_attr($design).'">';
        if($active_design=="default" || $active_design=="design-2") { 
            $ctl_html .= '<h2 class="content-title">'.$slink_s . get_the_title() .$slink_e.'</h2>';
          }
    $ctl_html .= '<div class="ctl_info event-description '.esc_attr($container_cls) .'">';

        if ($story_format == "video") {
             $ctl_html .=clt_story_video($post->ID);
         } elseif ($story_format == "slideshow") {  
              $ctl_html .=clt_story_slideshow($post->ID,$layout,$ctl_options_arr);
         }else{
            $ctl_html .=clt_story_featured_img($post->ID,$ctl_options_arr);
             }

         if($active_design=='design-3'|| $active_design=='design-4') {
            $ctl_html .= '<h2 class="content-title-simple">'.$slink_s. get_the_title() .$slink_e.'</h2>';
        }

        if($active_design!='design-4') {
            $ctl_html .= '<div class="content-details">';

             if($active_design=='design-5'|| $active_design=='design-6') {
            $ctl_html .= '<h2 class="content-title-simple">'.$slink_s. get_the_title() .$slink_e.'</h2>';
                 }
              if ($story_content=="full") {
             $ctl_html .= apply_filters('the_content', $post->post_content);
            } else {
            $ctl_html .= "<p>" .apply_filters('ctl_story_excerpt',get_the_excerpt()) . "</p>";
             }

           $ctl_html.='</div>';
        }

         $ctl_html .= '</div></div>';
        $ctl_html .='</li>';
        $post_content = '';

    endwhile;
    wp_reset_postdata();
}

$timeline_id=uniqid();
$category= $attribute['category'] ?$attribute['category']:'all-cats';
$timeline_wrp_id="ctl-horizontal-slider-".$timeline_id;
$sl_dir=is_rtl() ? "rtl":"";
$rtl=is_rtl()?"true":"false";

     $main_wrp_id='tm-'.$attribute['layout'].'-'.$attribute['designs'].'-'.rand(1,20);
     $main_wrp_cls=array();
    $main_wrp_cls[]="cool-timeline-horizontal";
    $main_wrp_cls[]=esc_attr($wrp_cls);
    if(isset($category)){
    $main_wrp_cls[]=esc_attr($category);
    }
    $main_wrp_cls[]=esc_attr($design_cls);
    $main_wrp_cls=apply_filters('ctl_wrapper_clasess',$main_wrp_cls);  

$clt_hori_view ='<! ========= Cool Timeline PRO '.CTLPV.' =========>';
$clt_hori_view .= '<div class="'.implode(" ",$main_wrp_cls).'"  id="'.esc_attr($timeline_wrp_id).'" data-rtl="'.$rtl.'" date-slider="ctl-h-slider-'.esc_attr($timeline_id).'" data-nav="nav-slider-'.esc_attr($timeline_id).'" data-items="'.esc_attr($items).'" data-start-on="'.esc_attr($attribute['start-on']).'" data-autoplay="'.esc_attr($attribute['autoplay']).'">

<div class="timeline-wrapper '.esc_attr($wrapper_cls).' '.esc_attr($itcls).'" >';

if($active_design=="design-4") {
    $clt_hori_view .= '<div  class="wrp-desgin-4" dir="'.$sl_dir.'">';
}else{
    $clt_hori_view .= '<div class="clt_carousel_slider"  dir="'.$sl_dir.'">';
}
      
if($active_design!='design-4') {
    $clt_hori_view .= '<ul class="ctl_h_nav" id="nav-slider-' . $timeline_id . '">';
    $clt_hori_view .= $dates_li;
    $clt_hori_view .= '</ul></div>';
}

$clt_hori_view .= '<div  class="clt_caru_slider"  dir="'.$sl_dir.'">';
$clt_hori_view .= '<ul class="ctl_h_slides"  id="ctl-h-slider-'.$timeline_id.'">';
$clt_hori_view .=$ctl_html;
$clt_hori_view .= '</ul></div>';

if($active_design=='design-4') {
    $clt_hori_view .= '<ul class="ctl_h_nav" id="nav-slider-' . $timeline_id . '">';
    $clt_hori_view .= $dates_li;
    $clt_hori_view .= '</ul></div>';
}
$stories_styles='<style type="text/css">'.$s_styles.'</style>';
$clt_hori_view .='</div></div>'.$stories_styles;
$clt_hori_view .='<!-- end  ================================================== -->';
  
