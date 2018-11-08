<?php
	/*	
	*	Goodlayers Session File
	*/	

	// print session category
	function gdlr_print_session_category_item( $settings ){
		$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

		global $gdlr_spaces;
		$margin = (!empty($settings['margin-bottom']) && 
			$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
		$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';

		// get child category list
		$parent_cat = get_term_by('slug', $settings['category'], 'session_category');
		$child_cat = get_term_children($parent_cat->term_id, 'session_category');
		$child_cat = get_categories( array('taxonomy'=>'session_category', 'hide_empty'=>0, 'parent'=>$parent_cat->term_id) );
		
		// query posts section
		$args = array('post_type' => 'session', 'suppress_filters' => false);
		$args['posts_per_page'] = '9999';
		$args['meta_key'] = 'session-date';
		$args['orderby'] = 'meta_value';
		$args['order'] = 'asc';
		
		echo gdlr_get_item_title($settings);
		echo '<div class="session-item-wrapper" ' . $item_id . $margin_style . ' >'; 	
		if( !empty($settings['num-excerpt']) ){
			global $gdlr_excerpt_length; $gdlr_excerpt_length = $settings['num-excerpt'];
			add_filter('excerpt_length', 'gdlr_set_excerpt_length');
		}
		
		// type section
		if( $settings['session-style'] == 'full' ){
			echo '<div class="gdlr-session-item gdlr-full-session-item gdlr-item" >';
		}else{
			if( $settings['session-style'] == 'tab' ){
				echo '<div class="gdlr-session-item gdlr-tab-session-item gdlr-item" >';
			}else if( $settings['session-style'] == 'small' ){
				echo '<div class="gdlr-session-item gdlr-small-session-item gdlr-item" >';
			}
			
			$tab_num = 1;
			echo '<div class="gdlr-session-item-head"  >';
			foreach($child_cat as $cat){
				echo '<div class="gdlr-session-item-head-info ' . (($tab_num == 1)? 'gdlr-active': '') . '" data-tab="gdlr-tab-' . $tab_num . '">';
				echo '<div class="gdlr-session-head-day">' . sprintf($cat->name, $tab_num) . '</div>';
				if( !empty($cat->description) ){
					echo '<div class="gdlr-session-head-date">' . $cat->description . '</div>';
				}
				echo '</div>';
				
				$tab_num++;
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // session-item-head		
		}		
		
		$tab_num = 1;
		foreach($child_cat as $cat){
			$args['tax_query'] = array(array('terms'=>explode(',', $cat->term_id), 'taxonomy'=>'session_category', 'field'=>'id'));
			$query = new WP_Query($args);	

			if( $settings['session-style'] == 'full' ){
				gdlr_print_full_session_category($query, $cat->term_id, $tab_num);
			}else if( $settings['session-style'] == 'tab' ){
				gdlr_print_tab_session_category($query, $tab_num);
			}else if( $settings['session-style'] == 'small' ){
				gdlr_print_small_session_category($query, $tab_num);
			}
			$tab_num++;
		}
		
		
		echo '</div>'; // close type section
		remove_filter('excerpt_length', 'gdlr_set_excerpt_length');
		echo '<div class="clear"></div>';
		echo '</div>'; // session item wrapper
	}	
	
	// print full session item
	function gdlr_print_full_session_category($query, $cat, $tab_num){
		global $theme_option;
		if( !empty($theme_option['new-fontawesome']) && $theme_option['new-fontawesome'] == 'enable' ){
			$icon_class = array('time'=>'fa-clock-o');
		}else{
			$icon_class = array('time'=>'icon-time');
		}	
		
		$cat_term = get_term_by('id', $cat, 'session_category');
		echo '<div class="gdlr-session-item-head ' . (($tab_num == 1)? 'gdlr-first': '') . '">';
		echo '<div class="gdlr-session-item-head-info gdlr-active">';
		echo '<div class="gdlr-session-head-day">' . sprintf($cat_term->name, $tab_num) . '</div>';
		if( !empty($cat_term->description) ){
			echo '<div class="gdlr-session-head-date">' . $cat_term->description . '</div>';
		}
		echo '</div>';
		echo '</div>';
				
		while($query->have_posts()){ $query->the_post();
			$gdlr_post_option = gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true));
			$gdlr_post_option = json_decode($gdlr_post_option, true);
			$gdlr_speakers = gdlr_get_session_speaker_list($gdlr_post_option['session-speaker']);
			
			echo '<div class="gdlr-session-item-content-wrapper">';
			echo '<div class="gdlr-session-item-divider"></div>';
			if( !empty($gdlr_post_option['session-type']) && $gdlr_post_option['session-type'] == 'break' ){
				echo '<div class="session-break-content">';
				echo '<div class="session-break-info">';
				echo '<i class="fa ' . $icon_class['time'] . '" ></i>';
				echo gdlr_session_time_conversion($gdlr_post_option['session-time']);						
				echo '</div>';	
				echo '<h3 class="gdlr-session-break-title">' . get_the_title() . '</h3>'; 
				echo '</div>';
			}else{			
				echo '<div class="gdlr-session-item-content-info">';
				echo gdlr_get_session_info(array('time', 'location', 'speaker'), $gdlr_post_option, $gdlr_speakers); 
				echo '</div>';
				
				echo '<div class="gdlr-session-item-content" >';
				echo '<h3 class="gdlr-session-item-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'; 
				echo '<div class="gdlr-session-item-excerpt">' . get_the_excerpt() . '</div>';
				
				if( !empty($gdlr_speakers) ){
					echo '<div class="gdlr-session-thumbnail-wrapper">';
					foreach( $gdlr_speakers as $speaker ){
						echo gdlr_get_speaker_thumbnail('thumbnail', $speaker->ID, array(), true, true);
					}
					echo '</div>';
				}
				
				echo '</div>';
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // session-item-content-wrapper
		}
		
		wp_reset_postdata();
		
	}
	
	// print tab session item
	function gdlr_print_tab_session_category($query, $tab_num){
		global $theme_option;
		if( !empty($theme_option['new-fontawesome']) && $theme_option['new-fontawesome'] == 'enable' ){
			$icon_class = array('time'=>'fa-clock-o');
		}else{
			$icon_class = array('time'=>'icon-time');
		}	

		echo '<div class="gdlr-session-item-tab-content gdlr-tab-' . $tab_num . ' ' . (($tab_num == 1)? 'gdlr-active': '') . '">';
		while($query->have_posts()){ $query->the_post();
			$gdlr_post_option = gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true));
			$gdlr_post_option = json_decode($gdlr_post_option, true);
			$gdlr_speakers = gdlr_get_session_speaker_list($gdlr_post_option['session-speaker']);		

			echo '<div class="gdlr-session-item-content-wrapper">';
			echo '<div class="gdlr-session-item-divider"></div>';
			if( !empty($gdlr_post_option['session-type']) && $gdlr_post_option['session-type'] == 'break' ){
				echo '<div class="session-break-content">';
				echo '<div class="session-break-info">';
				echo '<i class="fa ' . $icon_class['time'] . '" ></i>';
				echo gdlr_session_time_conversion($gdlr_post_option['session-time']);
				echo '</div>';	
				echo '<h3 class="gdlr-session-break-title">' . get_the_title() . '</h3>'; 
				echo '</div>';
			}else{
				echo '<div class="gdlr-session-item-content-info">';
				echo gdlr_get_session_info(array('time', 'location', 'speaker'), $gdlr_post_option, $gdlr_speakers); 
				echo '</div>';
				
				echo '<div class="gdlr-session-item-content" >';
				echo '<h3 class="gdlr-session-item-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'; 
				echo '<div class="gdlr-session-item-excerpt">' . get_the_excerpt() . '</div>';
				
				if( !empty($gdlr_speakers) ){
					echo '<div class="gdlr-session-thumbnail-wrapper">';
					foreach( $gdlr_speakers as $speaker ){
						echo gdlr_get_speaker_thumbnail('thumbnail', $speaker->ID, array(), true, true);
					}
					echo '</div>';
				}
				
				echo '</div>';
			}
			echo '<div class="clear"></div>';
			echo '</div>'; // session-item-content-wrapper
			
		}
		echo '</div>'; // gdlr-session-item-tab-content 
		
		wp_reset_postdata();
		
	}

	// print small session item
	function gdlr_print_small_session_category($query, $tab_num){
		global $theme_option;
		if( !empty($theme_option['new-fontawesome']) && $theme_option['new-fontawesome'] == 'enable' ){
			$icon_class = array('time'=>'fa-clock-o');
		}else{
			$icon_class = array('time'=>'icon-time');
		}	

		echo '<div class="gdlr-session-item-tab-content gdlr-tab-' . $tab_num . ' ' . (($tab_num == 1)? 'gdlr-active': '') . '">';
		while($query->have_posts()){ $query->the_post();
			$gdlr_post_option = gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true));
			$gdlr_post_option = json_decode($gdlr_post_option, true);
			$gdlr_speakers = gdlr_get_session_speaker_list($gdlr_post_option['session-speaker']);		

			echo '<div class="gdlr-session-item-content-wrapper">';
			echo '<div class="gdlr-session-item-divider"></div>';
			
			if( !empty($gdlr_post_option['session-type']) && $gdlr_post_option['session-type'] == 'break' ){
				echo '<div class="session-break-content">';
				echo '<div class="session-break-info">';
				echo '<i class="fa ' . $icon_class['time'] . '" ></i>';
				echo gdlr_session_time_conversion($gdlr_post_option['session-time']);				
				echo '</div>';	
				echo '<h3 class="gdlr-session-break-title">' . get_the_title() . '</h3>'; 
				echo '</div>';
			}else{
				echo '<div class="gdlr-session-item-content" >';
				if( !empty($gdlr_speakers) ){
					echo '<div class="gdlr-session-thumbnail-wrapper">';
					echo gdlr_get_speaker_thumbnail('thumbnail', $gdlr_speakers[0]->ID, array(), true, true);
					echo '</div>';
				}			
				
				echo '<div class="gdlr-session-item-content-inner" >';
				echo '<h3 class="gdlr-session-item-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'; 
				echo '<div class="gdlr-session-item-content-info">';
				echo gdlr_get_session_info(array('time', 'location', 'speaker'), $gdlr_post_option, $gdlr_speakers); 
				echo '</div>'; // session-item-content-info		 
				echo '</div>'; // session-item-content-inner
				echo '</div>'; // session-item-content
			}
			
			echo '<div class="clear"></div>';
			echo '</div>'; // session-item-content-wrapper
			
		}
		echo '</div>'; // gdlr-session-item-tab-content 
		
		wp_reset_postdata();
		
	}	
	
?>