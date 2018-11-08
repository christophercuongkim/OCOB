<?php


function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

//Enqueue JS and CSS
function calpoly_cei_enqueue() {
	/* CSS */
	wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/css/main.css');
	wp_enqueue_style( 'slick-styles', get_template_directory_uri() . '/css/slick.css');
	//wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css');
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/style.css');


	/* Javascript */
	wp_enqueue_script('slick-js', get_stylesheet_directory_uri() . '/js/slick.min.js', array( 'jquery'), null, true);
	wp_enqueue_script('parsley', get_stylesheet_directory_uri() . '/js/parsley.min.js', array( 'jquery' ), null, true);
	wp_enqueue_script('main-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' , 'slick-js' , 'jquery-ui-core', 'jquery-color' ), null, true);
	//wp_enqueue_script('retina', get_stylesheet_directory_uri() . '/js/retina.min.js', null, null, true);

	if ( is_page( '2908' ) ) {
		wp_register_script( 'waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', null, null, true );
		wp_enqueue_script('waypoints');
		wp_register_script( 'inview', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/shortcuts/inview.min.js', null, null, true );
		wp_enqueue_script('inview');
	}
}

add_action( 'wp_enqueue_scripts', 'calpoly_cei_enqueue' );





// Create Options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
	acf_add_options_sub_page('Header');
	acf_add_options_sub_page('About');
	acf_add_options_sub_page('News & Events');
	acf_add_options_sub_page('Learn');
	acf_add_options_sub_page('Prepare');
	acf_add_options_sub_page('Launch');
	acf_add_options_sub_page('Mentors');
}


// Adjust Read More

	//remove scroll after click
	function remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
	add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

	//change text
	add_filter( 'the_content_more_link', 'modify_read_more_link' );
	function modify_read_more_link() {
		return '<a class="read-more" href="' . get_permalink() . '">Read More</a>';
	}


// Thumbnails!
add_theme_support( 'post-thumbnails' );
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

function cie_the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);

	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
	if ($thumbnail_id && $thumbnail_image && isset($thumbnail_image[0])) {
    	echo '<div class="hero-caption">'.$thumbnail_image[0]->post_excerpt.'</div>';
  	}
}


function the_news_thumbnail_caption($newsID) {
  $thumbnail_id    = get_post_thumbnail_id($newsID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
  	echo $thumbnail_id;
    //return '<div class="hero-caption">'.$thumbnail_image[0]->post_excerpt.'</div>';
  }
}


// Thumbnails for CIE homepage!
add_image_size( 'cie_homepage_thumbnail', 268, 163, true ); //hard crop


// Pullquote Shortcode!
function pullquote_shortcode( $atts, $content = null ) {
	$pull_quote_atts = shortcode_atts( array(
        'name' => null,
        'title' => null
    ), $atts );
	return '<div class="pullquote"><p>' . $content . '</p>
			<p class="source">&mdash; ' . $pull_quote_atts['name'] . ', ' . $pull_quote_atts['title'] . '</p></div>';
}
add_shortcode( 'pullquote', 'pullquote_shortcode' );



// Calendar Nonsense!
function calendar_widgets_init() {

	register_sidebar( array(
		'name'          => 'Calendar sidebar',
		'id'            => 'calendar_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'calendar_widgets_init' );



// Custom Menus
register_nav_menus( array(
	'learn_menu' => 'Learn Menu',
) );


/** COMMENTS WALKER */
class calpoly_comments extends Walker_Comment {

    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>

        <h3 id="comments-title">Comments</h3>
        <ul id="comment-list">

    <?php }

    /** START_LVL
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

                <ul class="children">
    <?php }

    /** END_LVL
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

        </ul><!-- /.children -->

    <?php }

    /** START_EL */
    function start_el( &$output, $comment, $depth = 0, $args = Array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>

        <li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
            <div id="comment-body-<?php comment_ID() ?>" class="comment-body">

                <div class="comment-author vcard author">
                    <?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
                    <cite class="fn n author-name"><?php echo get_comment_author_link(); ?></cite>
                    <a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>" class="date-time"><?php comment_date(); ?> at <?php comment_time(); ?></a> <?php edit_comment_link( '(Edit)' ); ?>
                </div><!-- /.comment-author -->

                <div id="comment-content-<?php comment_ID(); ?>" class="comment-content">
                    <?php if( !$comment->comment_approved ) : ?>
                    <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>

                    <?php else: comment_text(); ?>
                    <?php endif; ?>
                </div><!-- /.comment-content -->

            </div><!-- /.comment-body -->

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

        </li><!-- /#comment-' . get_comment_ID() . ' -->

    <?php }

    /** DESTRUCTOR
     * I'm just using this since we needed to use the constructor to reach the top
     * of the comments list, just seems to balance out nicely:) */
    function __destruct() { ?>

    </ul><!-- /#comment-list -->

    <?php }
}



/*
* Events
*/

// Format Date/Time info

//add_filter('tribe_events_event_schedule_details','event_format_date_time');

add_filter('tribe_events_event_schedule_details_formatting','event_format_date_time');
function event_format_date_time($datetime){
	$datetime = '<strong>'.$datetime;
	$datetime = str_replace(' @ ', '</strong>&nbsp;&nbsp;|&nbsp;&nbsp;', $datetime);
	return $datetime;
}

function calendar_event_categories($postID){
	$categories = tribe_get_event_categories($postID);
	$categories = str_replace('<div>Event Category:</div>', '', $categories);
	$categories = str_replace('<div>Event Categories:</div>', '', $categories);
	return $categories;
}




/*
* News Custom Post Type

*/

// Register Custom Post Type
function news_item() {

	$labels = array(
		'name'                => _x( 'News Items', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'News Item', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'News', 'text_domain' ),
		'name_admin_bar'      => __( 'News', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Item', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'news',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'News Item', 'text_domain' ),
		'description'         => __( 'News Item', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'news_category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'news_item', $args );

}
add_action( 'init', 'news_item', 0 );

// Register Custom Taxonomy
function news_category() {

	$labels = array(
		'name'                       => _x( 'News Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'News Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'News Categories', 'text_domain' ),
		'all_items'                  => __( 'All Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Category', 'text_domain' ),
		'update_item'                => __( 'Update Category', 'text_domain' ),
		'view_item'                  => __( 'View Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Categories', 'text_domain' ),
		'search_items'               => __( 'Search Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'news-category',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'news_category', array( 'news_item' ), $args );

}
add_action( 'init', 'news_category', 0 );


function is_tribe_calendar() {
	if (tribe_is_event() || tribe_is_event_category() || tribe_is_in_main_loop() || tribe_is_view() || 'tribe_events' == get_post_type() || is_singular( 'tribe_events' )) {
		return true;
	}
}


/*
* Footer
*/

$footer_args = array(
	'name' => __( 'Footer', 'theme_text_domain' ),
	'id' => 'footer-boxes',
	'before_widget' => '<div class="box">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
);



register_sidebar($footer_args);

function alter_comment_form_fields($fields){
    $fields['url'] = '';  //removes website field

    return $fields;
}

add_filter('comment_form_default_fields','alter_comment_form_fields');




// Tribe event filters

add_filter('tribe_get_events_title', 'hijack_events_title');
function hijack_events_title($title) {
	if (tribe_is_month())
        $title = date_i18n( tribe_get_option('monthAndYearFormat', 'F Y'), strtotime(tribe_get_month_view_date()));
    return $title;
}


function get_root_parent_id($post_id){
	$ancestors = get_post_ancestors($post_id);
	end($ancestors);
	$root_id = prev($ancestors);
	return $root_id[0];
}