<?php


/*
 * settings
 */
  require(CTP_PLUGIN_DIR.'includes/settings-vars.php');

  $date_formats =ctl_date_formats($attribute['date-format'],$ctl_options_arr);

  $category_id ='';
  $ctl_avtar_html = '';$timeline_id = '';$clt_icons='';$story_content='';
   $row=0;
  $story_content=$attribute['story-content'];
  $stories_images_link =isset($ctl_options_arr['stories_images'])?$ctl_options_arr['stories_images']:'';
  $active_design=$attribute['designs']?$attribute['designs']:'default';
 if($attribute['pagination']=="ajax_load_more"){
      $i=$alternate+1;
    }

$ctl_format_html = '';
$output = '';$display_year ='';
$wrp_cls = '';
 if (isset($attribute['icons']) && $attribute['icons']=="YES"){
        $clt_icons='icons_yes';
    }else{
        $clt_icons='icons_no';
    }
  $post_skin_cls = '';
 $timeline_skin = isset($attribute['skin']) ? $attribute['skin'] : 'default';
if ($timeline_skin == "light") {
    $wrp_cls = 'light-timeline';
    $wrapper_cls = 'light-timeline-wrapper';
    $post_skin_cls = 'white-post';
} else if ($timeline_skin == "dark") {
    $wrp_cls = 'dark-timeline';
    $wrapper_cls = 'dark-timeline-wrapper';
    $post_skin_cls = 'black-post';
} else {
    $wrp_cls = 'white-timeline';
    $post_skin_cls = 'light-grey-post';
    $wrapper_cls = 'white-timeline-wrapper';
  }  
  /*Posts query*/

  $args['post_type'] =$attribute['post-type'];
  $args['post_status'] = array('publish');

  if ($attribute['show-posts']) {
      $args['posts_per_page'] = $attribute['show-posts'];
  } else {
      $args['posts_per_page'] = $ctl_post_per_page;
  }

 if ($enable_pagination == "yes") {
       if ( get_query_var('paged') ) { 
          $paged = get_query_var('paged'); 
          } elseif ( get_query_var('page') ) { 
          $paged = get_query_var('page'); 
          } else { 
          $paged = 1; 
          }
         $args['paged'] = $paged;
      }

  if (isset($_POST['page']) && $attribute['pagination'] == "ajax_load_more") {
      $args['paged']=esc_attr( $_POST['page'] );
  }

  $stories_order = '';
  if ($attribute['order']) {
      $args['order'] = $attribute['order'];
      $stories_order = $attribute['order'];
  } else {
      $args['order'] = $ctl_posts_orders;
      $stories_order = $ctl_posts_orders;
  }
if(!empty($attribute['taxonomy'])&& !empty($attribute['post-category'])) {

     if ( strpos( $attribute['post-category'], "," ) !== false ) {
        $attribute['post-category'] = explode( ",", $attribute['post-category'] );
        $attribute['post-category'] = array_map( 'trim',$attribute['post-category'] );
      } else {
        $attribute['post-category'] = $attribute['post-category'];
        }
      
    $args['tax_query'] = array(array(
        'taxonomy' =>$attribute['taxonomy'],
        'field' => 'slug',
        'terms' => $attribute['post-category']));
        }

  if(!empty($attribute['tags'])) {
      $args['tag'] =$attribute['tags'];
  }
  $ctl_loop = new WP_Query(apply_filters( 'ctl_content_timeline_query',$args));

if ($ctl_loop->have_posts()) {
  while ($ctl_loop->have_posts()) : $ctl_loop->the_post();
       global $post;
        $container_cls = 'full';
        $compact_year=''; 
        $ctl_v_html='';
        $ctl_h_html='';
        $posted_date=get_the_date(__("$date_formats",'cool-timeline'));
        $post_date = explode('/',get_the_date(__("D/M/Y",'cool-timeline')));
        $post_date_def =get_the_date(__("d/m/Y,H:i",'cool-timeline'));
        $post_year = (int)$post_date[$year_position];
        $timeline_post_id='timeline-post-id-'.$post->ID;
           $p_id="post-".$post->ID;
          $post_id=$post->ID;
        if ($story_content == 'full') {
         $post_content = apply_filters('the_content', $post->post_content);

        } else {
            $read_m_btn='';
             if ($r_more == 'yes') {
                 if(isset($ctl_options_arr['read_more_lbl']))
                    {
                    $rmore_lbl=__($ctl_options_arr['read_more_lbl'],'cool-timeline');
                     } else{
                     $rmore_lbl=__('Read More', 'cool-timeline');
                     }  
                   $read_m_btn= '..<a class="read_more ctl_read_more" href="' . get_permalink(get_the_ID()) . '">' .$rmore_lbl. '</a>';
                   }
            $format = get_post_format() ? : 'standard';  
            if ($format=="standard") {
               $gte= preg_replace( '/<a [^>]+>Continue reading*?< \/a>/i', '',apply_filters('ctl_content_timeline_excerpt',get_the_excerpt()));

            $post_content = "<p>" .$gte. $read_m_btn. "</p>";  
            }else{
           $post_content = apply_filters('the_content', $post->post_content);
            }
           }
    
          $s_l_close='';
         if ($stories_images_link =="popup") {

            $img_f_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

            $story_img_link = '<a title="' . esc_attr(get_the_title()). '"  href="' . $img_f_url . '" class="ctl_prettyPhoto">';
            $s_l_close='</a>';

        } else if ($stories_images_link == "single") {

            $story_img_link = '<a title="' . esc_attr(get_the_title()) . '"  href="' . get_the_permalink() . '" class="single-page-link">';
            $s_l_close='</a>';

        } else if ($stories_images_link == "disable_links") {
             $story_img_link = '';
              $s_l_close='';
        }
        else {
            $s_l_close='';
            $story_img_link = '<a title="' . esc_attr(get_the_title()) . '"  href="' . get_the_permalink() . '" class="">';
         }

          if ( has_post_thumbnail($post->ID) ) {
         $ctl_format_html .= '<div class="full-width">';
        $ctl_format_html.=$story_img_link;
        $ctl_format_html.=get_the_post_thumbnail($post->ID, 'large', array( 'class' => 'story-img' ) );
         $ctl_format_html.='</a></div>';
         }

        if ($i % 2 == 0) {
        $even_odd = "even";
         } else {
         $even_odd = "odd";
            }
        $selected='';
       if($i==1){
          $selected='selected';
        }
         $icon=ctl_post_icon($post->ID,$default_icon);
        $clt_icon='';
        if (isset($attribute['icons']) && $attribute['icons'] == "YES") {
          $clt_icon .='<span class="icon-placeholder">'.$icon.'</span> ';
         }

     $categories = get_the_category($post->ID);
        if(isset($categories) && !empty($categories)){
        foreach($categories as $category) {
            $category_id = $category->term_id;
        }
         }
     $icon=ctl_post_icon($post->ID,$default_icon);
     $compt_cls=$layout=="compact"?"timeline-mansory":'';
        
        $p_cls=array();
        $p_cls[]="timeline-post";
        $p_cls[]=esc_attr($even_odd);
        $p_cls[]=esc_attr($post_skin_cls);
        $p_cls[]=esc_attr($clt_icons);
        $p_cls[]='post-'.esc_attr($post->ID);
        $p_cls[]='cat-id-'.esc_attr($category_id);
        $p_cls[]=$layout=="compact"?"timeline-mansory":'';
        $p_cls[]= esc_attr($design).'-meta';
         $p_cls=apply_filters('ctl_content_timeline_clasess',$p_cls);
       

    // Vertical layout html
     if ($attribute['layout'] != "horizontal"){
            /// vertical layout html end here
             include(CTP_PLUGIN_DIR.'includes/views/content/ct-vertical-content.php');
               $ctl_html.= $ctl_v_html;
          }else{
            // Horizontal layout html
             include(CTP_PLUGIN_DIR.'includes/views/content/ct-horizontal-content.php');
              $ctl_html.=$ctl_h_html;
          }
       

        if ($row >= 3) {
            $row = 0;
        }
        $row++;
        $i++;
        $ctl_format_html = '';
        $ctl_h_html='';
         $ctl_v_html='';
        $post_content = '';
    endwhile;
    wp_reset_postdata();
} else {
    $ctl_html_no_cont .= '<div class="no-content"><h4>';
    //$ctl_html_no_cont.=$ctl_no_posts;
    $ctl_html_no_cont .= __('Sorry,You have not added any story yet', 'cool-timeline');
    $ctl_html_no_cont .= '</h4></div>';
}
