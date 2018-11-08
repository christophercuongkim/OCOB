<?php
/**
 * Integral enqueue scripts
 *
 * @package integral
 */

function integral_scripts() {  
    wp_enqueue_style( 'integral_bootstrap_css', get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style( 'integral_multicolumnsrow_css', get_template_directory_uri().'/css/multi-columns-row.css');
    wp_enqueue_style( 'integral_flexslider_css', get_template_directory_uri().'/css/flexslider.css');
    wp_enqueue_style( 'integral_prettyphoto_css', get_template_directory_uri().'/css/prettyPhoto.css');
    wp_enqueue_style( 'integral_basestylesheet', get_stylesheet_uri() );
    wp_enqueue_style( 'integral_fontawesome_css', get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style( 'integral_googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600,700,700italic,600italic,400italic|Cabin:400,500,600,700|Montserrat:400,700');
    wp_enqueue_script('jquery-effects-core');
    wp_enqueue_script('integral_parallax_js', get_template_directory_uri().'/js/parallax.js', array('jquery'), '1.1.3', true );
    wp_enqueue_script('integral_bootstrap_js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.3.4', true );
    wp_enqueue_script('integral_prettyphoto_js', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), '3.1.6', true );
    wp_enqueue_script('integral_flexslider_js', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '2.6.4', true );

    if( is_front_page() ) {
        wp_enqueue_script('integral_smoothscroll_js', get_template_directory_uri().'/js/smooth-scroll.js', array('jquery'), '1.0', true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}  
add_action('wp_enqueue_scripts', 'integral_scripts');