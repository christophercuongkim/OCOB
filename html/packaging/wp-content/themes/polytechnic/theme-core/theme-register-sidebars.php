<?php

/* ---------------------------------------------------------*/
/* REGISTER SIDEBARS */ 
/* ---------------------------------------------------------*/
function mythology_register_sidebars() {
	register_sidebar( array(
		'name' => __( 'Primary Theme Sidebar', 'mythology' ),
		'id' => 'default-widget-area',
		'description' => __( 'Default widget area for posts/pages. ', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<hr /></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Secondary Theme Sidebar', 'mythology' ),
		'id' => 'default-widget-area-2',
		'description' => __( 'Default widget area for the "dual" sidebar. ', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<hr /></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Tophat Dropdown Column 1', 'mythology' ),
		'id' => 'dropdown-widget-1',
		'description' => __( 'The first column in the tophat dropdown widget area. ', 'mythology' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Tophat Dropdown Column 2', 'mythology' ),
		'id' => 'dropdown-widget-2',
		'description' => __( 'The second column in the tophat dropdown widget area. ', 'mythology' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Tophat Dropdown Column 3', 'mythology' ),
		'id' => 'dropdown-widget-3',
		'description' => __( 'The third column in the tophat dropdown widget area. ', 'mythology' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Tophat Dropdown Column 4', 'mythology' ),
		'id' => 'dropdown-widget-4',
		'description' => __( 'The fourth column in the tophat dropdown widget area. ', 'mythology' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Column 1', 'mythology' ),
		'id' => 'footer-widget-1',
		'description' => __( 'The first column in the footer widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Footer Column 2', 'mythology' ),
		'id' => 'footer-widget-2',
		'description' => __( 'The second column in the footer widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Footer Column 3', 'mythology' ),
		'id' => 'footer-widget-3',
		'description' => __( 'The third column in the footer widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Column 4', 'mythology' ),
		'id' => 'footer-widget-4',
		'description' => __( 'The fourth column in the footer widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Column 5', 'mythology' ),
		'id' => 'footer-widget-5',
		'description' => __( 'The fourth column in the footer widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Column 6', 'mythology' ),
		'id' => 'footer-widget-6',
		'description' => __( 'The fourth column in the footer widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Bonus Sidebar 1', 'mythology' ),
		'id' => 'bonus-widget-1',
		'description' => __( 'The first bonus widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<hr /></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Bonus Sidebar 2', 'mythology' ),
		'id' => 'bonus-widget-2',
		'description' => __( 'The second bonus widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<hr /></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Bonus Sidebar 3', 'mythology' ),
		'id' => 'bonus-widget-3',
		'description' => __( 'The third bonus widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<hr /></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Bonus Sidebar 4', 'mythology' ),
		'id' => 'bonus-widget-4',
		'description' => __( 'The fourth bonus widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<hr /></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Bonus Sidebar 5', 'mythology' ),
		'id' => 'bonus-widget-5',
		'description' => __( 'The fifth bonus widget area.', 'mythology' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<hr /></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action('widgets_init', 'mythology_register_sidebars'); 

?>