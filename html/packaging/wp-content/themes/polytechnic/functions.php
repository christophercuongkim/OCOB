<?php

/**
 * The theme functions file.
 *
 * Runs after_theme_setup();
 *
 * WHAT THIS FILE DOES:
 * 1. Load the [mythology-core] files & defaults.
 * 2. Load the [theme-core] files & defaults. 
 * 3. Set theme-support declarations. 
 *
 * DEVELOPERS NOTES:
 * This file acts as a "hub" of sorts. Rather than including any advanced code in this file, we will call other files to do that stuff for us.
 * Why? This keeps the core/theme files organized and easy to maintain. 
 * The stuff in the [mythology-core] should never be changed or editted. It's all "foundational" code that you shouldn't really need to mess around with.
 * The stuff in the [theme-core] is basically what makes this theme happen. If you want to make customizations, you'll start either here, or in the root folder template files.
 * We've done our best to name all files in a way that makes it easy for beginning theme-developers to use and edit, but ALWAYS keep a backup copy of any files that you intend to change.
 * 
 * WHERE'S THE FRONTEND MARKUP COMING FROM?
 * All basic template files are found in the theme root folder. 
 *   *  In some rare instances, markup will come from a custom function, but the rest of the markup comes from these files and the element files (below).
 * You will also find "element" files inside the [theme-core/theme-elements] folder. 
 *   * These include things like content-loop-templates, navigation bars, etc.
 *   * These are essentially just micro-templates that are used more than once in the theme.
 * 
 * LOOKING FOR SOMETHING IN PARTICULAR? 
 * Know where to look first - This theme loads two different sets of files, a "CORE" set, and a "THEME" set.
 *
 * 1. All core stylesheets, scripts, and functions are loaded from the "MYTHOLOGY-CORE" folder. 
 *    * The [core-register-xxxxx.php] files do most of the work here.
 *    * We do not recommend making alterations to anything in this folder. 
 *    * If you need to remove a core stylesheet or script, simply de-register it after the core loads in this file. An example is provided below.
 * 
 * 2. All theme stylesheets, scripts, elements, and functions are loaded from the "THEME-CORE" folder. 
 *    * Feel free to make edits to the files in this folder if you are comfortable editting WP themes. 
 *	  * You can also add new stylesheets/scripts and register them here in the [theme-register-xxxxx.php] files.
 * 
 * SUPPORT:
 * Please note that we do NOT support any customizations/edits/changes that you might make to these files.
 * The only support that we provide is bug-fixes. We understand that this sucks... but it's how it's gotta be. 
 * File a bug report at http://makedesign.ticksy.com if you spot something that isn't working.
 * For everything else, use the documentation or review the theme-demo.
 * 
 * 
 * @package mythology
 *
 */

/* ---------------------------------------------------------*/
/* PRE - INITIALIZE MYTHOLOGY CORE */ 
/* ---------------------------------------------------------*/

/* OPTIONTREE LOADER */
require get_template_directory() . '/mythology-core/mythology-optiontree-loader.php';

load_template( trailingslashit( get_template_directory() ) . 'theme-core/ot-theme-options.php' ); // Load theme options.
load_template( trailingslashit( get_template_directory() ) . 'theme-core/ot-meta-boxes.php' ); // Load Page/Post options.



if ( ! function_exists( 'mythology_setup' ) ) :
function mythology_setup() {

	/* CONTENT WIDTH */
	if ( ! isset( $content_width ) )
	$content_width = 1120; /* pixels */

	/* THEME URL CONSTANT */
	if(!defined('WP_THEME_URL')) {
		define( 'WP_THEME_URL', get_template_directory_uri());
	}

	/* ---------------------------------------------------------*/
	/* INITIALIZE MYTHOLOGY CORE */ 
	/* ---------------------------------------------------------*/

	/* CORE PLUGINS */
	require get_template_directory() . '/mythology-core/mythology-plugin-loader.php';

	/* CORE FUNCTIONS */
	require get_template_directory() . '/mythology-core/mythology-core-functions.php';

	/* CORE STYLESHEETS */
	require get_template_directory() . '/mythology-core/mythology-register-stylesheets.php';

	/* CORE SCRIPTS */
	require get_template_directory() . '/mythology-core/mythology-register-scripts.php';

	/* CORE COMMENTS */
	require get_template_directory() . '/mythology-core/mythology-comments.php';

	/* CORE VT-RESIZE */
	$imgwidth = "515";
	$imgheight = "200";
	$imagecrop = "true";
	require get_template_directory() . '/mythology-core/mythology-vt-resize.php';

	/* DEACTIVATE ANY CORE STYLESHEETS/SCRIPTS HERE */
	/*
	Stylesheet Example:
		wp_deregister_style('stylesheet-slug');
	Script Example:
		wp_deregister_script('script-slug');	
	*/

	/* ---------------------------------------------------------*/
	/* INITIALIZE THEME */ 
	/* ---------------------------------------------------------*/

	/* THEME LAYOUT VARIABLES */
	require get_template_directory() . '/theme-core/theme-layout-variables.php';

	/* THEME PLUGINS */
	require get_template_directory() . '/theme-core/theme-plugin-loader.php';

	/* THEME STYLESHEETS */
	require get_template_directory() . '/theme-core/theme-register-stylesheets.php';

	/* THEME SCRIPTS */
	require get_template_directory() . '/theme-core/theme-register-scripts.php';

	/* THEME MENUS */
	require get_template_directory() . '/theme-core/theme-register-menus.php';

	/* THEME USERS - FACULTY ROLE */
	require get_template_directory() . '/theme-core/theme-register-users.php';

	/* THEME USERS - FACULTY IMAGE */
	require get_template_directory() . '/theme-core/theme-functions/custom-user-profile-photo/3five_cupp.php';

	/* THEME LOGIN */
	require get_template_directory() . '/theme-core/theme-functions/login/login-styles.php';

	/* THEME DETECT MOBILE */
	require get_template_directory() . '/theme-core/theme-detect-mobile.php';


	function search_template_chooser($template)   
	{    
	  global $wp_query;   
	  $post_type = get_query_var('post_type');   
	  if( $wp_query->is_search && $post_type == 'polytechnic_courses' )   
	  {
	    return locate_template('archive-search.php');  //  redirect to archive-search.php
	  }   
	  return $template;   
	}
	add_filter('template_include', 'search_template_chooser');   


	/* THEME SIDEBARS */
	require get_template_directory() . '/theme-core/theme-register-sidebars.php';

	/* THEME EXTENDED SHORTCODES */
	require get_template_directory() . '/vc_extend/vc_extend.php';

	function mythology_style_embed(){
		get_template_part( 'theme-core/ot', 'user-styles' ); 
		}
	add_action('wp_head', 'mythology_style_embed');


	/* ---------------------------------------------------------*/
	/* THEME SUPPORT DECLARATIONS */
	/* ---------------------------------------------------------*/

	add_action( 'after_setup_theme', 'declare_sensei_support' );
	function declare_sensei_support() {
	add_theme_support( 'sensei' );
	}

	/* WOOCOMMERCE */
	add_theme_support( 'woocommerce' );

	/* Course Order By */
	function course_unique_id_orderby( $orderby, $wp_query ) {
		global $wpdb;

		if ( isset( $wp_query->query['orderby'] ) && 'course_unique_id' == $wp_query->query['orderby'] ) {
			$orderby = "(
				SELECT GROUP_CONCAT(name ORDER BY name ASC)
				FROM $wpdb->term_relationships
				INNER JOIN $wpdb->term_taxonomy USING (term_taxonomy_id)
				INNER JOIN $wpdb->terms USING (term_id)
				WHERE $wpdb->posts.ID = object_id
				AND taxonomy = 'color'
				GROUP BY object_id
			) ";
			$orderby .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
		}

		return $orderby;
	}
	add_filter( 'posts_orderby', 'course_unique_id_orderby', 10, 2 );

	/* Post Formats & Automatic feed links */
	add_theme_support( 'automatic-feed-links' );

	/* Post Thumbnail Support */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 750, 450, true );
	add_image_size( 'single-post-thumbnail', 515, 200 );
	add_image_size( 'faculty-thumbnail', 82, 82 );
	add_image_size( 'faculty-avatar', 100, 100 );
	add_image_size( 'author-avatar', 156, 156 );

	/* Add shortcode support in widgets */
	add_filter('widget_text', 'do_shortcode');

	/* Theme Check Recommendations */
	// add_theme_support( 'custom-header', $args );
	// add_theme_support( 'custom-background', $args );

	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );

	/* Remove some theme customizer default fields */
	function mythology_customize_register($wp_customize){
	  $wp_customize->remove_section( 'colors');
	  $wp_customize->remove_section( 'nav');
	  $wp_customize->remove_section( 'static_front_page');
	}
	add_action( 'customize_register', 'mythology_customize_register' );
	

	function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
	}
	add_filter( 'style_loader_src', 'remove_cssjs_ver', 1000 );
	add_filter( 'script_loader_src', 'remove_cssjs_ver', 1000 );

	/* Remove underscore from being used in valid usernames - breaks course query for author page
	function custom_validate_username($valid, $username ) {
			if (preg_match("/_/", $username)) {
	   			// there are spaces
				return $valid=false;
			}
		return $valid;
	}
	add_filter('validate_username' , 'custom_validate_username', 10, 2);
	 */
/**
 * Category Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_poly_cpt_checkbox' ) ) {
  
  function ot_type_poly_cpt_checkbox( $args = array() ) {

    $mb_cpt_args = array(
       'public'   => true,
       // '_builtin' => false
    );

    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-mb-cpt-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* get category array */
        // $categories = get_categories( apply_filters( 'ot_type_category_checkbox_query', array( 'hide_empty' => false ), $field_id ) );
        $post_types = get_post_types( $mb_cpt_args, $output, $operator ); 
        
        /* build categories */
        if ( ! empty( $post_types ) ) {
          foreach ( $post_types as $post_type ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $post_type ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $post_type ) . '" value="' . esc_attr( $post_type ) . '" ' . ( isset( $field_value[$post_type] ) ? checked( $field_value[$post_type], $post_type, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $post_type ) . '">' . esc_attr( $post_type ) . '</label>';
            echo '</p>';
          } 
        } else {
          echo '<p>' . __( 'No Post Types Found', 'option-tree' ) . '</p>';
        }
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

    function add_theme_caps() {
        // gets the author role
        global $role;
        $role = get_role('faculty');

        $role->add_cap('delete_posts');
        $role->add_cap('delete_published_posts');
        $role->add_cap('edit_posts' );
        $role->add_cap('edit_published_posts');
        $role->add_cap('publish_posts');
        $role->add_cap('read');
        $role->add_cap('upload_files');

        $role->add_cap('edit_pages');
        $role->add_cap('edit_published_pages');

        $role->add_cap('edit_private_posts');
        $role->add_cap('edit_others_posts');
        
       /* //Standard Author Capabilities
            $role->add_cap('delete_posts');
            $role->add_cap('delete_published_posts');
            $role->add_cap('edit_posts' );
            $role->add_cap('edit_published_posts');
            $role->add_cap('publish_posts');
            $role->add_cap('read');
            $role->add_cap('upload_files');

        //Custom Faculty Capabilities
            $role->add_cap('edit_pages');
            $role->add_cap('edit_published_pages');
            $role->add_cap('edit_private_posts'); // This enables the ability to upload to the media library via profile.php
            */


    }
    add_action( 'admin_init', 'add_theme_caps');

    /* Troubleshoot User Permissions

    add_action( 'your-custom-action', 'wptuts_wpuserclass' );     
        function wptuts_wpuserclass() {
            $user = new WP_User( 8 );
            echo '<pre>'. print_r( $user, 1 ) .'</pre>';
        }
        */


    //Shortcode for Contact Form 7$curauth->user_email;
        //Shortcode CF7 Email autore annuncio
function author_email($post_ID)  {
    $user_email = get_the_author_meta('user_email',$authid); // retrieve user email
    return $user_email;
}
add_shortcode('authormail', 'author_email');

/**
 * Add HTML5 theme support.
 */
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

}
endif; // mythology_setup
add_action( 'after_setup_theme', 'mythology_setup' );