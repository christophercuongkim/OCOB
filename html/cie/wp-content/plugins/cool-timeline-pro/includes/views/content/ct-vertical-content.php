  <?php 

     // year section 
        if ($post_year != $display_year) {
        $display_year = $post_year;
        $ctle_year_lbl = sprintf('<span class="ctl-timeline-date">%s</span>', $post_year);

        if(in_array($layout,array("compact"),TRUE)!=true){
        if( $attribute['pagination']=="ajax_load_more" && $last_year==$post_year)
          {
              $ctl_v_html .='';
           }else{

        $ctl_v_html .= '<div data-cls="sc-nv-'.esc_attr($design).' '.esc_attr($wrp_cls).'"  class="timeline-year  scrollable-section '.esc_attr($design).'-year" data-section-title="' . esc_attr($post_year) . '" id="clt-' . esc_attr($post_year) . '"><div class="icon-placeholder">' . $ctle_year_lbl . '</div>
            <div class="timeline-bar"></div>
             </div>';
            }
         } else{
          if( $attribute['pagination']=="ajax_load_more" && $last_year==$post_year)
          {
              $ctl_v_html .='';
           }else{
         $ctl_v_html .= '<span data-cls="sc-nv-'.esc_attr($design).' '.esc_attr($wrp_cls).'" class="compact-year scrollable-section '.esc_attr($design).'-year"data-section-title="' . esc_attr($post_year) . '" id="year-'.esc_attr($post_year).'"></span>'; 
            }
        }    
        } 
          
// story section start
$ctl_v_html .= '<!-- .timeline-post-start-->';
  $ctl_v_html .= '<div data-alternate="'.$i.'" id="post-'.esc_attr($post->ID).'" class="'.implode(" ",$p_cls).'"><div class="timeline-meta">';

    if($layout!="compact" ){
     if($active_design=="design-6") {
        if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
          $ctl_v_html .='<div class="timeline-icon '.esc_attr($design).'-icon">
          <div class="icon-placeholder">'.$icon.'</div>
       </div>';
        }
     }else{
        if ($disable_months == "no") {
          if ($layout!="compact") {
              $ctl_v_html .= '<div class="meta-details">' . $posted_date . '</div>';
              }
            }
      }      
   }   

      $ctl_v_html .= '</div>';
    
       if($layout=="compact" && $active_design=="design-6"){
          if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
         $ctl_v_html .= '<div class="timeline-icon icon-larger iconbg-turqoise icon-color-white main-icon-' .esc_attr($design). '">
            <div class="icon-placeholder">' . $icon . '</div>
            <div class="timeline-bar"></div></div>';

            }else {
            $ctl_v_html .= '<div class="timeline-icon icon-dot-full main-dot-' .esc_attr($design) . '">
            <div class="timeline-bar"></div>
            </div>';
            }
        }
       else if($active_design=="design-6") {
         $ctl_v_html .= '<div class="timeline-icon icon-dot-full main-dot-' .esc_attr($design) . '">
            <div class="timeline-bar"></div>
            </div>';
       }else{
     if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
         $ctl_v_html .= '<div class="timeline-icon icon-larger iconbg-turqoise icon-color-white main-icon-' .esc_attr($design). '">
            <div class="icon-placeholder">' . $icon . '</div>
            <div class="timeline-bar"></div></div>';

            }else {
            $ctl_v_html .= '<div class="timeline-icon icon-dot-full main-dot-' .esc_attr($design) . '">
            <div class="timeline-bar"></div>
            </div>';
            }
       }   
    

    $ctl_v_html .= '<div  id="' . esc_attr($row). '" class="timeline-content  clearfix ' .esc_attr($even_odd) . '  ' . esc_attr($container_cls) . '  ht-content-'.esc_attr($design).'">';

     if(in_array($active_design,array("design-2","default","design-4","design-5","design-6"))){
         if($active_design=="design-6"){
            $ctl_v_html .= '<div class="story-date clt-meta-date">' . $posted_date . '</div>';
           }else{
            $ctl_v_html .= '<h2 class="content-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
         }
       }  
             $ctl_v_html .= '<div class="ctl_info event-description ">';
             $ctl_v_html .= $ctl_format_html;

             if($active_design=="design-3"||$active_design=="design-6") {
             $ctl_v_html .= '<h2 class="content-title-simple"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
              }

            $ctl_v_html .='<div class="content-details">'; 
             if($layout=="compact" ){
                   if($active_design!="design-6") {
                $ctl_v_html .= '<div class="compact-meta-details"><strong><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $posted_date . '</strong></div>';
                   }
              }

            $ctl_v_html .=$post_content;
            $ctl_v_html .= '<div class="post_meta_details">';
         if($post_meta=="yes"){
            if(!empty($attribute['taxonomy'])&& $attribute['taxonomy']=='category') {
                $ctl_v_html .= ctl_entry_taxonomies();
                $ctl_v_html .= ctl_post_tags();
                }
          }
        $ctl_v_html .= '</div></div>';
        $ctl_v_html .= '</div></div><!-- timeline content -->
        </div><!-- .timeline-post-end -->';