<?php
         /*
           Common code for both vertical and horizontal
          */
             $args = array();
             $cat_timeline = array();
             $based=$attribute['based'];
				     $wrp_cls = '';
             $wrapper_cls = '';
             $post_skin_cls = '';

             require('settings-vars.php');
             
             $active_design=$attribute['designs']?$attribute['designs']:'default';
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
            $story_content=$attribute['story-content'];
          $stories_images_link =isset($ctl_options_arr['stories_images'])?$ctl_options_arr['stories_images']:'';
         
            $format = __('d/m/Y', 'cool-timeline');
              $display_year = '';
            $output = '';
            $year_position = 2;
          $date_formats =ctl_date_formats($attribute['date-format'],$ctl_options_arr);
      
         if ($attribute['category']) {
            $category = $attribute['category'];
            if(is_numeric($attribute['category'])){
               $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'ctl-stories',
                        'field' => 'term_id',
                        'terms' => $attribute['category'],
                    ));  
            }else{
             $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'ctl-stories',
                        'field' => 'slug',
                        'terms' => $attribute['category'],
                    ));
                }
           }
    
           $args['posts_per_page'] =isset($attribute['show-posts'])?$attribute['show-posts']:$ctl_post_per_page;
       
            $args['post_status'] = array('publish','future');
            $args['post_type'] = 'cool_timeline';
  
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

            $args['order']=isset($attribute['order'])?$attribute['order']:$ctl_posts_orders;

            if($based=="custom"){
                $args['meta_query'] = array(
                     'ctl_story_order' => array(
                        'key' => 'ctl_story_order',
                        'compare' => 'EXISTS',
                        'type'    => 'NUMERIC'
                        ),
                     array(
                        'key'     => 'story_based_on',
                        'value'   => 'custom',
                        'compare' => '=',
                    ));
                $args['orderby'] = array(
                    'ctl_story_order' =>$args['order']);
            }else{
             

            $args['meta_query']= array(
                    'relation' => 'AND',
              array('key'     => 'story_based_on',
                        'value'   => 'default',
                        'compare' => '=',
                        'type'    => 'CHAR'
                         ), 
              array('relation'    => 'AND',
              'ctl_story_year' => array(
                  'key'     => 'ctl_story_year',
                  'compare' => 'EXISTS',
                ),
                'ctl_story_date'    => array(
                'key'     => 'ctl_story_date',
                'compare' => 'EXISTS',
                )));

            $args['orderby'] = array(
                'ctl_story_year' =>$args['order'],
                'ctl_story_date' => $args['order'] );
                }
   
 

 /*---------------end common --------------*/
