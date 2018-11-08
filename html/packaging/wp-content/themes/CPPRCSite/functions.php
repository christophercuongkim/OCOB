<?php

/**
* Initiate Chile Theme Options
*/

function child_theme_enqueue_styles() {

    $parent_style = 'polytechnic';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );

    // EXAMPLE ENQUEUE 1
    // wp_enqueue_style( $parent_style, get_template_directory_uri() . '/dynamic.css' );
    // wp_enqueue_style( 'child-dynamic',
        // get_stylesheet_directory_uri() . '/dynamic.css',
        // array( $parent_style )
    // );

    // EXAMPLE ENQUEUE 2
    // wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	// wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/dynamic.css' );

    // EXAMPLE ENQUEUE 3
	// wp_register_style ( 'child-dynamic-stylesheet', get_template_directory_uri() . '/dynamic.css' );
	// wp_enqueue_style( 'child-dynamic-stylesheet' );
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

if(get_current_blog_id() == 6) {
    add_action( 'init', 'create_post_type_symposium_speakers' );
}
function create_post_type_symposium_speakers() {
    register_post_type( 'symposium_speakers',
        array(
            'labels' => array(
            'name' => __( 'Symposium Speakers' ),
            'singular_name' => __( 'Symposium Speaker' ),
            'edit_item' => "Edit Speaker",
            'view_item' => "Symposium Speaker",
            'new_item' => "Symposium Speaker"
            ),
            'taxonomies' => array('category'),
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'symposium-speakers'),
            'capability_type' => 'post',
            'supports' => array( 'title', 'editor','author','thumbnail','custom-fields', 'revisions' ),
            'menu_icon' => 'dashicons-groups'
        )
    );
}

/* Snippet to add Google Analytics to the header */
function addAnalytics(){
    include "/var/www/www.cob.calpoly.edu/html/_googleAnalytics.php";
};
add_action('wp_head', 'addAnalytics');
?>