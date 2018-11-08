<!-- Pre Footer -->

	<?php $contentoption = get_custom_field('post_content_area');
	if(get_custom_field('post_content_area')) : 
		?> <div class="post-content-area"> <?php
		if(strstr($slidershortcode, 'rev_slider')) { 

		//It's Revolution - Do Something
		$strip_this_shit = array("[", "]", " ", "rev_slider");
		$revslider_shortcode_prestrip = get_custom_field('post_content_area');
		$revslider_shortcode_poststrip = str_replace($strip_this_shit, "", "$revslider_shortcode_prestrip");

		putRevSlider( "$revslider_shortcode_poststrip" );
		} else { echo do_shortcode( "$contentoption" ); }
		?> </div> <?php		        		
	else : ?>
	<?php endif; ?>