<?php 


if(in_array($active_design,array('design-3','design-4','design-6'))){
  
	$dates_li .= ' <li class="ht-dates-'.esc_attr($design).'" data-date="' . esc_attr($p_id ). '">'.$clt_icon.'<span class="ctl-story-time ' . esc_attr($selected ). '"  data-date="' .esc_attr($p_id). '" ><div class="ctl-tooltips"><span>'. $posted_date.'</span></div></li>';
	}else{
	 $dates_li .= ' <li class="ht-dates-'.esc_attr($design).'" data-date="' . esc_attr($p_id ). '">'.$clt_icon.'<span class="ctl-story-time ' . esc_attr($selected ). '"  data-date="' .esc_attr($p_id). '" >'. $posted_date.'</li>';
	}

      $ctl_h_html .='<li data-date="'.esc_attr($timeline_post_id).'" class="ht-'.esc_attr($design).'">';
       $ctl_h_html .= '<!-- .timeline-post-start-->';
        $ctl_h_html .= '<div id="post-'.esc_attr($post->ID).'" class="'.implode(" ",$p_cls).'"><div class="timeline-meta"></div>';
     
       $ctl_h_html .= '<div id="' . esc_attr($row). '" class="timeline-content  clearfix ' . esc_attr($even_odd) . '  ' . esc_attr($container_cls) . ' ' . $design . '-content">';
       
      if(in_array($active_design,array('default','design-2','design-3'))) {
       	$ctl_h_html .= '<h2 class="content-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
        }

     	  $ctl_h_html .= '<div class="ctl_info event-description ">';
          $ctl_h_html .= $ctl_format_html;
        
         $ctl_h_html .= '<div class="content-details">';
       	if(in_array($active_design,array('design-4','design-5','design-6'))) {
            $ctl_h_html .= '<h2 class="content-title-simple"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
          }

            if($active_design!="design-4"){
            $ctl_h_html .=$post_content;
              }
            $ctl_h_html .= '<div class="post_meta_details">';
         if($post_meta=="yes"){
            if(!empty($attribute['taxonomy'])&& $attribute['taxonomy']=='category') {
                $ctl_h_html .= ctl_entry_taxonomies();
                $ctl_h_html .= ctl_post_tags();
                }
          }
        $ctl_h_html .= '</div></div>';
        $ctl_h_html .= '</div></div><!-- timeline content -->
        </div></li><!-- .timeline-post-end -->';
