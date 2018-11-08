<?php
$ctl_html .= '<!-- .timeline-post-start-->';
  $ctl_html .= '<div data-alternate="'.$i.'" id="story-'.esc_attr($post->ID).'" class="'.implode(" ",$p_cls).'">';
     $ctl_story_lbl = get_post_meta($post->ID, 'ctl_story_lbl',true);
     $ctl_story_lbl2 = get_post_meta($post->ID, 'ctl_story_lbl_2',true);
          if($layout!="compact"){
         $ctl_html .= '<div class="timeline-meta"><div class="meta-details">';
        $ctl_html .= '<span class="custom_story_lbl">'.__($ctl_story_lbl,'cool-timeline').'</span>';
        $ctl_html .= '<span class="custom_story_lbl_2">'.__($ctl_story_lbl2,'cool-timeline'). '</span></div></div>';
            }

   if($active_design=="design-6") {
     $ctl_html .= '<div class="timeline-icon icon-dot-full '.esc_attr($design).'-dot"><div class="timeline-bar"></div></div>';
    }else{
  if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
      $icon=ctl_post_icon($post->ID,$default_icon);
     $ctl_html .='<div class="timeline-icon icon-larger iconbg-turqoise icon-color-white '.esc_attr($design).'-icon">
      <div class="icon-placeholder">'.$icon.'</div><div class="timeline-bar"></div></div>';

    }else {
      $ctl_html .= '<div class="timeline-icon icon-dot-full '.esc_attr($design).'-dot"><div class="timeline-bar"></div></div>';
     }
   }

     $ctl_html .= '<div   id="story-' . esc_attr($post->ID) . '" class="timeline-content  clearfix ' .esc_attr($even_odd) . '  ' . esc_attr($container_cls) .' '.esc_attr($design).'-content '.$stop_ani.'">';

     if(in_array($active_design,array("design-2","default","design-4","design-5","design-6"))){
        if($attribute['layout']=="compact" && $attribute['compact-ele-pos']=="main-date" ){
                if($based=="custom"){
            $ctl_html .='<h2 class="content-title clt-cstm-lbl-f">'.$ctl_story_lbl.' <small class="clt-cstm-lbl-s">'.$ctl_story_lbl2.'</small></h2>';
              }else{
                    $ctl_html .='<div class="content-title clt-meta-date">'.apply_filters('ctl_story_dates',$posted_date).'</div>';
                      if($active_design=="design-6"){
                     if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
                        $icon=ctl_post_icon($post->ID,$default_icon);
                         $ctl_html .='<div class="timeline-icon '.esc_attr($design).'-icon">
                        <div class="icon-placeholder">'.$icon.'</div>
                     </div>';
                      }
                    }
                }
              }else{
                if($active_design=="design-6"){
                    $ctl_html .='<h2 class="story-date clt-meta-date">'.apply_filters('ctl_story_dates',$posted_date).'</h2>';
                }else{
                    $ctl_html .='<h2 class="content-title">'.$slink_s. get_the_title() .$slink_e.'</h2>';
                }
          
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
      
      if($attribute['layout']=="compact"){
         if($attribute['compact-ele-pos']=="main-title" ){
          if($active_design=="design-3" || $active_design=="design-6") {
                $ctl_html .='<h2 class="compact-content-title">'.$slink_s. get_the_title() .$slink_e.'</h2>';
                  }
           
            $ctl_html .='<h2 class="clt-compact-date">'.$ctl_story_lbl.' <small class="clt-cstm-lbl-s">'.$ctl_story_lbl2.'</small></h2>';
              
         }else if($attribute['compact-ele-pos']=="main-date" ){
              if($active_design=="design-3") {
              $ctl_html .='<h2 class="clt-compact-date">'.$ctl_story_lbl.' <small class="clt-cstm-lbl-s">'.$ctl_story_lbl2.'</small></h2>';
               }

              $ctl_html .='<h2 class="compact-content-title">'.$slink_s. get_the_title() .$slink_e.'</h2>';
           }
    }else{
            if($active_design=="design-3"||$active_design=="design-6") {
            $ctl_html .= '<h2 class="content-title-2">'.$slink_s. get_the_title() .$slink_e.'</h2>';
             }
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
