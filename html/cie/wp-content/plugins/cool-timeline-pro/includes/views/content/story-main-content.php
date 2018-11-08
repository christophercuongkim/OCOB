<?php 

        $post_date = explode('/', get_the_date($ctl_story_date));
        $post_year = (int)$post_date[$year_position];
         if ($post_year != $display_year) {
              $display_year = $post_year;
    
      $ctle_year_lbl = sprintf('<span  class="ctl-timeline-date">%s</span>',$post_year);
          
      if($attribute['pagination']=="ajax_load_more" && $last_year== $post_year){
                    $ctl_html .='';
                  }else{
                  $ctl_html .='<div data-cls="sc-nv-'.esc_attr($design).' '.esc_attr($wrp_cls).'" class="timeline-year scrollable-section '.esc_attr($design).'-year"data-section-title="' . esc_attr($post_year) . '" id="year-'.esc_attr($post_year).'"> <div class="icon-placeholder">' .apply_filters('ctl_story_year',$ctle_year_lbl). '</div><div class="timeline-bar"></div></div>';
                    }
           
                }      

  $ctl_html .= '<!-- .timeline-post-start-->';
  $ctl_html .= '<div data-alternate="'.$i.'" id="story-'.esc_attr($post->ID).'" class="'.implode(" ",$p_cls).'">';
    
  
    $ctl_html .='<div class="timeline-meta"><div class="meta-details">';
    if($active_design=="design-6") {
        if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
          $icon=ctl_post_icon($post->ID,$default_icon);
           $ctl_html .='<div class="timeline-icon '.esc_attr($design).'-icon">
          <div class="icon-placeholder">'.$icon.'</div>
       </div>';
        }
     }else{
       if ($disable_months == "no") {
         $ctl_html .=apply_filters('ctl_story_dates',$posted_date);
        }
    }
  $ctl_html .='</div></div>';


       
   if($active_design=="design-6") {
     $ctl_html .= '<div class="timeline-icon icon-dot-full '.esc_attr($design).'-dot"><div class="timeline-bar"></div></div>';
  }else{
  if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
      $icon=ctl_post_icon($post->ID,$default_icon);
     $ctl_html .='<div class="timeline-icon icon-larger iconbg-turqoise icon-color-white '.esc_attr($design).'-icon">
                        <div class="icon-placeholder">'.$icon.'</div>
                        <div class="timeline-bar"></div>
                    </div>';
    }else {
      $ctl_html .= '<div class="timeline-icon icon-dot-full '.esc_attr($design).'-dot"><div class="timeline-bar"></div></div>';
     }
   }
    
    $ctl_html .= '<div   id="story-' . esc_attr($post->ID) . '" class="timeline-content  clearfix ' .esc_attr($even_odd) . '  ' . esc_attr($container_cls) .' '.esc_attr($design).'-content '.$stop_ani.'">';

        if(in_array($active_design,array("design-2","default","design-4","design-5","design-6"))){
         if($active_design=="design-6"){
                    $ctl_html .='<div class="story-date clt-meta-date">'.apply_filters('ctl_story_dates',$posted_date).'</div>';
                }else{
                    $ctl_html .='<h2 class="content-title">'.$slink_s. get_the_title() .$slink_e.'</h2>';
                }
           }

        $ctl_html .= '<div class="ctl_info event-description ' . $container_cls. '">';
       
         if ($story_format == "video") {
             $ctl_html .=clt_story_video($post->ID);
         } elseif ($story_format == "slideshow") {  
              $ctl_html .=clt_story_slideshow($post->ID,$attribute['type'],$ctl_options_arr);
         }else{
             $ctl_html .=clt_story_featured_img($post->ID,$ctl_options_arr);
          }

           $ctl_html .= '<div class="content-details">';

            if($active_design=="design-3"||$active_design=="design-6") {
            $ctl_html .= '<h2 class="content-title-2">'.$slink_s. get_the_title() .$slink_e.'</h2>';
             }
          
           if ($story_content=="full") {
             $ctl_html .= apply_filters('the_content', $post->post_content);
            } else {
            $ctl_html .= "<p>" . apply_filters('ctl_story_excerpt',get_the_excerpt()). "</p>";
             }
         $ctl_html .='</div>';
         $ctl_html .= '</div>';
        $ctl_html .= '</div><!-- timeline content --></div>
        <!-- .timeline-post-end -->';

