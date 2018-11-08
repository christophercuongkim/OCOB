<?php



/* ---------------------------------------------------------*/

/* REGISTER THEME STYLESHEETS */

/* ---------------------------------------------------------*/

function mythology_register_styles() {

	if(!is_admin()){	

        // LOAD THEME STYLESHEETS

    	wp_register_style ( 'theme-structure', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-1-structure.css' );
    	wp_enqueue_style( 'theme-structure' );

        wp_register_style ( 'mobile-menu', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-2-mobile-menu.css' );
        wp_enqueue_style( 'mobile-menu' );

		wp_register_style ( 'theme-typography', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-3-typography.css' );
		wp_enqueue_style( 'theme-typography' );

        wp_register_style ( 'theme-plugins', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-4-plugins.css' );
        wp_enqueue_style( 'theme-plugins' );   

        wp_register_style ( 'theme-media-queries', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-5-media-queries.css' );
        wp_enqueue_style( 'theme-media-queries' );

        wp_register_style ( 'theme-colors', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-6-colors.css' );
        wp_enqueue_style( 'theme-colors' );

        wp_register_style ( 'Theme-Custom', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-7-custom.css' );
        wp_enqueue_style( 'Theme-Custom' );

        wp_register_style ( 'Theme-Hover', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-8-hover.css' );
        wp_enqueue_style( 'Theme-Hover' );

        wp_register_style ( 'Theme-Scroll-Dropdown', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-9-scroll-dropdown.css' );
        wp_enqueue_style( 'Theme-Scroll-Dropdown' );   
        

        // prettyPhoto
        wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/theme-core/theme-assets/javascripts/prettyPhoto/css/prettyPhoto.css', false, null, false);
        wp_enqueue_style( 'prettyPhoto' ); 

        if(ot_get_option('rtl_support') == "on") {
            wp_register_style ( 'Theme-RTL', get_template_directory_uri() . '/theme-core/theme-assets/stylesheets/theme-10-rtl.css' );
            wp_enqueue_style( 'Theme-RTL' );  
        }


    }

}

add_action('wp_enqueue_scripts', 'mythology_register_styles'); /* Run the above function at the init() hook */


?>