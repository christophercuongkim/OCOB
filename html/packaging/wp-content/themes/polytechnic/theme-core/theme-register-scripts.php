<?php

/* ---------------------------------------------------------*/
/* REGISTER THEME SCRIPTS */
/* ---------------------------------------------------------*/
function mythology_register_scripts() {
	if(!is_admin()){

        // LOAD THEME SCRIPTS
        
        //Responsive Menu
        function detect_ie($ie7_check = true, $ie8_check = true) {
            $ie7 = ($ie7_check == true) ? strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') : false;
            $ie8 = ($ie8_check == true) ? strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') : false;
            if ($ie7 !== false || $ie8 !== false) {
                return true;
            } else {
                return false;
            }
        }

        wp_register_script( 'Modernizer2', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/modernizr.custom.js', false, null, true);
        wp_enqueue_script( 'Modernizer2' );

        // Sortable Masonry 
        // wp_register_script( 'Isotope', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/isotope/jquery.isotope.js', false, null, true);
        // wp_enqueue_script( 'Isotope' ); 

        // Sortable Masonry - Conditionals Help Support Plugins That Register This Script and Limits Registration to the Post Grid Page Template
        if ( is_page_template( 'template-post-grid.php' ) ) {
            $handle = 'jquery.isotope.js';
            $list = 'enqueued';
            if (wp_script_is( $handle, $list )) {
                return;
            } else {
               wp_register_script( 'jquery.isotope.js', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/isotope/jquery.isotope.js', false, null, true);
               wp_enqueue_script( 'jquery.isotope.js' );
            }
        } else {
            // Returns false when 'template-post-grid.php' is not being used.
        }
        
        wp_register_script( 'Modernizer', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/isotope/modernizr.custom.69142.js', false, null, true);
        wp_enqueue_script( 'Modernizer' );

        // Hover Affects
        /** wp_register_script( 'HoverFlow', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/hoverflow/jquery.hoverflow.js', false, null, true);
        wp_enqueue_script( 'HoverFlow' ); 

        wp_register_script( 'HoverFlowMin', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/hoverflow/jquery.hoverflow.min.js', false, null, true);
        wp_enqueue_script( 'HoverFlowMin' ); **/

        // Scrolling Waypoints
        wp_register_script( 'Waypoints', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/waypoints/waypoints.min.js', false, null, true);
        wp_enqueue_script( 'Waypoints' );

        // Nice Scroll
        $nice_scroll = ot_get_option('nice_scroll');
        if ($nice_scroll != "off") {
            wp_register_script( 'NiceScroll', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/jquery.nicescroll/jquery.nicescroll.js', false, null, true);
            wp_enqueue_script( 'NiceScroll' );
            }
        else if ($nice_scroll == "off"){
        }

        // prettyPhoto
        wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/prettyPhoto/js/jquery.prettyPhoto.js', false, null, true);
        wp_enqueue_script( 'prettyPhoto' ); 

    	// Pre-Script Action
    	wp_register_script( 'SkeletonKeyPreScripts', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/mythology-key-prescripts.js', false, null, true);
    	wp_enqueue_script( 'SkeletonKeyPreScripts' ); 
    	
		// The Activation Scripts
		wp_register_script( 'SkeletonKey', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/mythology-key.js', false, null, true);
    	wp_enqueue_script( 'SkeletonKey' ); 
		
        
    }
}
add_action('wp_enqueue_scripts', 'mythology_register_scripts'); 

?>