<?php
/*
Plugin Name: Team Showcase
Plugin URI: http://www.cmoreira.net/team-showcase
Description: This plugin allows you to manage the members of your team/staff and display them in multiple ways.
Author: Carlos Moreira
Version: 1.7.5
Author URI: http://cmoreira.net
Text Domain: tshowcase
Domain Path: /lang
*/

//Last modified: November 2nd 2016

// next *possible* updates
// > option to download vcard
// > translation files
// > table layout and field order
// > Layers Integration
// > improve ajax pagination (target div issue - filter issue)
// > improve filter code - multiple filters in same page issue
// > set image by url
// > wait for images to load ajax pagination
// > ASC/DESC order option for shortcode


//Latest updates
//meta_key and orderby='meta_value_num' shortcode parameters added
//check group description for URL
//fixed css bug
//added twitch and steam social profiles
//added new rewrite parameter when registering cpt
//bug fix ajax pagination
//bug fix category filter
//changed filter code to allow for non-latin chars as the filter identifier
//order code improvement
//isotope filter improved
//new social network fields
//improved responsive css
//fixed ajax pagination issue
//started fixing url bug
//added second taxonomy
//Visual Composer Bug Fix
//orderby bug fixed
//added isotope hide filter
//custom js field added to settings page
//search code improved
//added yelp to social network links
//hidden display parameters display='hovertitle,hovertitleup'
//filter.js code improvement
//fixed pager thumbnails bug 
//auto complete search
//bug fix for shortcode generator preview (order by menu_order)
//search form category dropdown improvements
//link css option (to help lightbox integration)
//fontawesome version updated
//css improvements for filter menu
//new entry url option - personal url (defaults to inactive)
//fixed table layout bug (Name displaying twice)
//pager code improvement
//better search input sanitazing
//option to display groups
//redirect option to fix breadcrumb issue
//translation improvements
//added page template options
//filter nav fix for pager layout
//search fixes
//small fix for search terms with quotes
//Added option for social nofollow links
//New link option - link to full image (works good with lightbox plugins)


// Localization
add_action('init', 'tshowcase_lang_init');
function tshowcase_lang_init() {
  $path = dirname(plugin_basename( __FILE__ )) . '/lang/';
  $loaded = load_plugin_textdomain( 'tshowcase', false, $path);
} 

// ordering code

require_once dirname(__FILE__) . '/ordering-code.php';

//include advanced settings
require_once dirname( __FILE__ ) . '/advanced-options.php';
//util functions
require_once dirname( __FILE__ ) . '/utils.php';
//shortcode generator functions
require_once dirname( __FILE__ ) . '/shortcode-generator.php';
//single page settings and functions
require_once dirname( __FILE__ ) . '/single-page-build.php';
//default settings page
require_once dirname( __FILE__ ) . '/settings-page.php';

// search widget code
require_once dirname(__FILE__) . '/search-widget.php';

//count for multiple pager layouts in same page
$tshowcase_pager_count = 0;
$tshowcase_id_count = 0;

//Adding the necessary actions to initiate the plugin
add_action('init', 'register_cpt_tshowcase' );
add_action('admin_init', 'register_tshowcase_settings' );
add_action('admin_menu' , 'tshowcase_shortcode_page_add');
add_action('admin_menu' , 'tshowcase_admin_page');
add_action('admin_menu' , 'tshowcase_advanced_admin_page');


//runs only when plugin is activated to flush permalinks
register_activation_hook(__FILE__, 'tshowcase_flush_rules');
function tshowcase_flush_rules(){
	//register post type
	register_cpt_tshowcase();
	//and flush the rules.
	flush_rewrite_rules();
}

//Add support for post-thumbnails in case theme does not
add_action('init' , 'tshowcase_add_thumbnails_for_cpt');

function tshowcase_add_thumbnails_for_cpt() {

    global $_wp_theme_features;

   if($_wp_theme_features['post-thumbnails']==1) {
		return;		
	  }	
	  
	  if(is_array($_wp_theme_features['post-thumbnails'][0]) && count($_wp_theme_features['post-thumbnails'][0]) >= 1) {
		array_push($_wp_theme_features['post-thumbnails'][0],'tshowcase');
		return;
		}
	if( empty($_wp_theme_features['post-thumbnails']) ) {
        $_wp_theme_features['post-thumbnails'] = array( array('tshowcase') );
		return;
	}
}


//Add New Thumbnail Size
$tshowcase_crop = false;
$tshowcase_options = get_option('tshowcase-settings');
if($tshowcase_options['tshowcase_thumb_crop']=="true") {
$tshowcase_crop = true;
}
add_image_size( 'tshowcase-thumb', $tshowcase_options['tshowcase_thumb_width'], $tshowcase_options['tshowcase_thumb_height'], $tshowcase_crop);


//Add new Image column 
function tshowcase_columns_head($defaults) {
	global $post;
    if (isset($post->post_type) && $post->post_type == 'tshowcase') {

  $options = get_option('tshowcase-settings');
  $defaults['tshowcase-categories'] = $options['tshowcase_name_category'];
	$defaults['featured_image'] = 'Image';
  $defaults['db_id'] = 'Database ID';
	//if we want the order to display
	//$defaults['order'] = '<a href="'.$_SERVER['PHP_SELF'].'?post_type=tshowcase&orderby=menu_order&order=ASC"><span>Order</span><span class="sorting-indicator"></span></a>';
	
  

  }
	return $defaults;
}




// SHOW THE FEATURED IMAGE in admin
function tshowcase_columns_content($column_name, $post_ID) {
	
	global $post;
    if ($post->post_type == 'tshowcase') {

      if($column_name == 'tshowcase-categories') {
      $term_list = wp_get_post_terms($post_ID, 'tshowcase-categories', array("fields" => "names"));
      foreach ( $term_list as $term ) {
        echo $term.'<br>';
        }
     }


		if ($column_name == 'featured_image') {		
			echo get_the_post_thumbnail($post_ID, array(50,50));		
		}
		
		//if we want the order to display
		 if ($column_name == 'order') {		
			echo $post->menu_order;		
		}

     if ($column_name == 'db_id') {   
      echo $post->ID;   
    }
		 
     
		
	}
}

add_filter('manage_posts_columns', 'tshowcase_columns_head');
add_action('manage_posts_custom_column', 'tshowcase_columns_content', 10, 2);

// move featured image box to top

function tshowcase_image_box()
{
  remove_meta_box( 'postimagediv', 'tshowcase', 'side' );

  $options = get_option('tshowcase-settings');
  $name = $options['tshowcase_name_singular'];

  add_meta_box( 'postimagediv', $name. __( ' Image','tshowcase' ) , 'post_thumbnail_meta_box', 'tshowcase', 'side', 'default' );
}

add_action( 'do_meta_boxes', 'tshowcase_image_box' , 10, 2);

//register the custom post type for the logos showcase
function register_cpt_tshowcase() {

	$options = get_option('tshowcase-settings');
	if(!is_array($options)) {
			tshowcase_defaults();
			$options = get_option('tshowcase-settings');
		}
		
	$name = $options['tshowcase_name_singular'];
	$nameplural = $options['tshowcase_name_plural'];
	$slug = $options['tshowcase_name_slug'];
	$singlepage = $options['tshowcase_single_page'];
	$exclude_from_search = (isset($options['tshowcase_exclude_from_search']) ? true : false);

    $labels = array( 
        'name' => _x( $nameplural, 'tshowcase' ),
        'singular_name' => _x( $name, 'tshowcase' ),
        'add_new' => _x( 'Add New '.$name, 'tshowcase' ),
        'add_new_item' => _x( 'Add New '.$name, 'tshowcase' ),
        'edit_item' => _x( 'Edit '.$name, 'tshowcase' ),
        'new_item' => _x( 'New '.$name, 'tshowcase' ),
        'view_item' => _x( 'View '.$name, 'tshowcase' ),
        'search_items' => _x( 'Search '.$nameplural, 'tshowcase' ),
        'not_found' => _x( 'No '.$nameplural.' found', 'tshowcase' ),
        'not_found_in_trash' => _x( 'No '.$nameplural.' found in Trash', 'tshowcase' ),
        'parent_item_colon' => _x( 'Parent '.$name.':', 'tshowcase' ),
        'menu_name' => _x( $nameplural, 'tshowcase' ),
    );
	
	$singletrue = true;
	if($singlepage=="false") { $singletrue = false; }
	

	
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'thumbnail', 'custom-fields', 'editor','page-attributes','author' ),
        'public' => $singletrue,
        'show_ui' => true,
        'show_in_menu' => true,       
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => $exclude_from_search,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        //'taxonomies' => array('post_tag'),
		'menu_icon' => plugins_url( 'img/icon16.png', __FILE__ ),
		 //'menu_position' => 17,
		'rewrite' => array( 'slug' => $slug, 'with_front' => false )

    );

    register_post_type( 'tshowcase', $args );
}


//register custom category

// WP Menu Categories
add_action( 'init', 'tshowcase_build_taxonomies', 0 );

function tshowcase_build_taxonomies() {
	
	$options = get_option('tshowcase-settings');	
	$categories = $options['tshowcase_name_category'];
  $categories2 = isset($options['tshowcase_name_tax2']) ? $options['tshowcase_name_tax2'] : 'Groups 2' ;

	$capability = 'edit_posts';
	
  register_taxonomy( 'tshowcase-categories', 
    					'tshowcase', 
    					array( 
    						'hierarchical' => true, 
    						'label' => $categories, 
    						'query_var' => true, 
    						'rewrite' => true,
    						'capabilities' => array(
    							'manage_terms' => $capability,
								'edit_terms' => $capability,
								'delete_terms' => $capability,
								'assign_terms' => $capability
    							) 
    						));

  if(isset($options['tshowcase_second_tax'])) {

    register_taxonomy( 'tshowcase-taxonomy', 
              'tshowcase', 
              array( 
                'hierarchical' => true, 
                'label' => $categories2, 
                'query_var' => true, 
                'rewrite' => true,
                'capabilities' => array(
                'manage_terms' => $capability,
                'edit_terms' => $capability,
                'delete_terms' => $capability,
                'assign_terms' => $capability
                  ) 
                ));


  }


}



//change Title Info

function tshowcase_change_default_title( $title ){
     $screen = get_current_screen();
	 $options = get_option('tshowcase-settings');	
	$name = $options['tshowcase_name_singular'];
	$nameplural = $options['tshowcase_name_plural'];
 
     if  ( 'tshowcase' == $screen->post_type ) {
          $title = __('Insert ','tshowcase').$name.__(' Name Here','tshowcase');
     }
 
     return $title;
}

if($ts_change_default_title_en) {
add_filter( 'enter_title_here', 'tshowcase_change_default_title' );
}


function tshowcase_admin_order($wp_query) {

  if (is_post_type_archive( 'tshowcase' ) && is_admin() ) {   

		if (!isset($_GET['orderby'])) {
		  $wp_query->set('orderby', 'menu_order');
		  $wp_query->set('order', 'ASC');
	
  		}
  	}
}

//This will default the ordering admin to the 'menu_order' - will disable other ordering options
add_filter('pre_get_posts', 'tshowcase_admin_order');


// to dispay all entries in admin

function tshowcase_posts_per_page_admin($wp_query) {
  if (is_post_type_archive( 'tshowcase' ) && is_admin() ) {    
		

		  $wp_query->set( 'posts_per_page', '500' );
      //$wp_query->set('nopaging', 1);
	
  		
  	}
}

//This will the filter above to display all entries in the admin page
add_filter('pre_get_posts', 'tshowcase_posts_per_page_admin');


//This does the same thing as the above code, but in a different way
function tshowcase_no_nopaging_admin($query) {
 if (is_post_type_archive( 'tshowcase' ) && is_admin() ) {   

      $query->set('nopaging', 1);
      $query->set( 'posts_per_page', '-1' );
  
  }
}

//add_action('parse_query', 'tshowcase_no_nopaging_admin');


/**
 * Display the metaboxes
 */
 
function tshowcase_info_metabox() {
	global $post;	
	global $ts_labels;
	
	 
	$tsposition = get_post_meta( $post->ID, '_tsposition', true );
	$tsemail = get_post_meta( $post->ID, '_tsemail', true );
	$tstel = get_post_meta( $post->ID, '_tstel', true );
	$tsuser = get_post_meta( $post->ID, '_tsuser', true );
	$tsfreehtml = get_post_meta( $post->ID, '_tsfreehtml', true );
	$tspersonal = get_post_meta( $post->ID, '_tspersonal', true );
  $tspersonalanchor = get_post_meta( $post->ID, '_tspersonalanchor', true );
	$tslocation = get_post_meta( $post->ID, '_tslocation', true );


	
	
	?>
    
    
<table cellpadding="2">

<tr>
  <td align="right" valign="top"><label for="_tsfreehtml"><?php echo $ts_labels['html']['label'] ?>:</label></td>
  <td><textarea name="_tsfreehtml" cols="35" rows="2" id="_tsfreehtml"><?php if( $tsfreehtml ) { echo $tsfreehtml; } ?>
</textarea></td>
  <td><p class="howto"><?php echo $ts_labels['html']['description'] ?></p></td>
</tr>
<tr><td align="right">	
  <label for="_tsposition"><?php echo $ts_labels['position']['label'] ?>:<br></label>
  </td>
  <td><input id="_tsposition" size="37" name="_tsposition" type="text" value="<?php if( $tsposition ) { echo htmlentities($tsposition); } ?>" /></td>
  <td><p class="howto"><?php echo $ts_labels['position']['description'] ?></p></td>
</tr>
        
        <tr><td align="right">	
<label for="_tsemail"><?php echo $ts_labels['email']['label'] ?>:<br></label>
        </td>
          <td><input id="_tsemail" size="37" name="_tsemail" type="text" value="<?php if( $tsemail ) { echo $tsemail; } ?>" /></td>
          <td><p class="howto"><?php echo $ts_labels['email']['description'] ?></p></td>
  </tr>



  <tr>
    <td align="right"><?php echo $ts_labels['location']['label'] ?>:</td>
          <td><input id="_tslocation" size="37" name="_tslocation" type="text" value="<?php if( $tslocation ) { echo htmlentities($tslocation); } ?>" /></td>
          <td><p class="howto"><?php echo $ts_labels['location']['description'] ?></p></td>
  </tr>
  <tr>
          <td align="right"><?php echo $ts_labels['telephone']['label'] ?>:</td>
    <td><input id="_tstel" size="37" name="_tstel" type="text" value="<?php if( $tstel ) { echo htmlentities($tstel); } ?>" /></td>
    <td><p class="howto"><?php echo $ts_labels['telephone']['description'] ?></p></td>
  </tr>
  <tr>
    <td align="right" nowrap><?php echo $ts_labels['user']['label'] ?>:</td>
    <td><select name="_tsuser" id="_tsuser">
      <option value="0">No User Associated</option>
      <?php
    $blogusers = get_users();
    if(is_array($blogusers)) {
    foreach ($blogusers as $user) { ?>
      <option value="<?php echo $user->ID; ?>" <?php selected( $tsuser, $user->ID ) ?>><?php echo $user->display_name; ?></option>
      <?php 
    } }
      ?>
    </select></td>
    <td><p class="howto"><?php echo $ts_labels['user']['description'] ?>
     
    </p></td>
  </tr>
  <tr>
    <td align="right"><p>
      <label for="_tspersonal"><?php echo $ts_labels['website']['label'] ?>:<br>
      </label>
    </p></td>
    <td><input id="_tspersonal" size="37" name="_tspersonal" type="url" value="<?php if( $tspersonal ) { echo $tspersonal; } ?>" /></td>
    <td><p class="howto"><?php echo $ts_labels['website']['description'] ?></p></td>
  </tr>

  <tr>
    <td align="right"><p>
      <label for="_tspersonalanchor"><?php echo $ts_labels['websiteanchor']['label'] ?>:<br>
      </label>
    </p></td>
    <td><input id="_tspersonalachor" size="37" name="_tspersonalanchor" type="text" value="<?php if( $tspersonalanchor ) { echo $tspersonalanchor; } ?>" /></td>
    <td><p class="howto"><?php echo $ts_labels['websiteanchor']['description'] ?></p></td>
  </tr>


</table>
<p>
  <?php
}

/**
 * Process the custom metabox fields
 */
function tshowcase_save_info( $post_id ) {
	global $post;
	
	// Skip auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	
	if(isset($post)) {
		if ($post->post_type == 'tshowcase') {
			if( $_POST ) {
				
				update_post_meta( $post->ID, '_tsemail', $_POST['_tsemail'] );
				update_post_meta( $post->ID, '_tstel', $_POST['_tstel'] );
				update_post_meta( $post->ID, '_tsposition', $_POST['_tsposition'] );
				update_post_meta( $post->ID, '_tsuser', $_POST['_tsuser'] );
				update_post_meta( $post->ID, '_tsfreehtml', $_POST['_tsfreehtml'] );
				update_post_meta( $post->ID, '_tspersonal', $_POST['_tspersonal'] );
        update_post_meta( $post->ID, '_tspersonalanchor', $_POST['_tspersonalanchor'] );
				update_post_meta( $post->ID, '_tslocation', $_POST['_tslocation'] );
				
			}
		}
	}
}

// Add action hooks. Without these we are lost
add_action( 'admin_init', 'tshowcase_add_info_metabox' );
add_action( 'save_post', 'tshowcase_save_info' );

/**
 * Add meta box for Aditional Information
 */
function tshowcase_add_info_metabox() {
	
	global $ts_labels;
	$title = $ts_labels['titles']['info'];
	
	add_meta_box( 'tshowcase-info-metabox', $title, 'tshowcase_info_metabox', 'tshowcase', 'normal', 'high' );
	
	
}

 
 
 
//Social Links Meta Box HTML 
function tshowcase_social_metabox() {
	global $post;	
	global $ts_labels;
  global $ts_social_networks;
	$helptext = $ts_labels['help']['social'];

	$tsemailico = htmlentities ( get_post_meta( $post->ID, '_tsemailico', true ) );
	
	?>
<p class="howto"><?php echo $helptext; ?></p>
<table width="100%" cellpadding="0" class="tshowcase-box-social">
        <?php foreach ($ts_social_networks as $social_key => $sn) {
         ?>
        <tr>
          <td align="right" style="min-width:150px;">	 
            <label for="ts<?php echo $sn[0]; ?>">
               <i class="fa <?php echo $sn[2] ?> fa-lg"></i>
              <?php echo __($sn[1],'tshowcase'); ?>:
            </label>
          </td>
          <td><input id="_ts<?php echo $sn[0]; ?>" size="37" name="_ts<?php echo $sn[0]; ?>" type="url" value="<?php if( get_post_meta( $post->ID, '_ts'.$sn[0], true ) ) { echo get_post_meta( $post->ID, '_ts'.$sn[0], true ); } ?>" />

          </td>
          <td>
            <?php if(isset($sn[3])) { ?>
                  <span class="howto"><?php echo __($sn[3],'tshowcase'); ?></span>
            <?php } ?>
          </td>
        </tr>

        <?php } ?>

        <tr>       
          <td align="right">
            <i class="fa fa-envelope-o fa-lg"></i> <?php echo __('Email','tshowcase'); ?>:
          </td>
          <td>
            <input id="_tsemailico" size="37" name="_tsemailico" type="text" value="<?php if( $tsemailico ) { echo $tsemailico; } ?>" />
          </td>
          <td>
            <span class="howto"><?php echo __('If the "mailto" option is enabled in the settings, it will work as an email link','tshowcase'); ?></span>
          </td>
        </tr>


</table>
<?php
}

/**
 * Process the custom metabox fields
 */
function tshowcase_save_social( $post_id ) {
	global $post;
	if(isset($post)) {
		if ($post->post_type == 'tshowcase') {
			if( $_POST ) {

        global $ts_social_networks;

        foreach ($ts_social_networks as $social_key => $sn) {
				  update_post_meta( $post->ID, '_ts'.$sn[0], $_POST['_ts'.$sn[0]] );
        }

				update_post_meta( $post->ID, '_tsemailico', $_POST['_tsemailico'] );

				
			}
		}
	}
}

// Add action hooks. Without these we are lost
add_action( 'admin_init', 'tshowcase_add_social_metabox' );
add_action( 'save_post', 'tshowcase_save_social' );

/**
 * Add meta box for social links
 */
function tshowcase_add_social_metabox() {
	
	global $ts_labels;
	$title = $ts_labels['titles']['social'];
	
	add_meta_box( 'tshowcase-social-metabox',$title, 'tshowcase_social_metabox', 'tshowcase', 'normal', 'high' );
}



//add options page
function tshowcase_admin_page() {
	
	$menu_slug = 'edit.php?post_type=tshowcase';
	$submenu_page_title = __('Settings','tshowcase');
    $submenu_title = __('Settings','tshowcase');
	$capability = 'manage_options';
    $submenu_slug = 'tshowcase_settings';
    $submenu_function = 'tshowcase_settings_page';
    $defaultp = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
	
   }


//add advanced options page

   function tshowcase_advanced_admin_page() {
  
  $menu_slug = null;
  $submenu_page_title = __('Advanced Settings','tshowcase');
    $submenu_title = __('Advanced Settings','tshowcase');
  $capability = 'manage_options';
    $submenu_slug = 'tshowcase_advanced_settings';
    $submenu_function = 'tshowcase_advanced_settings_page';
    $defaultp = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
  
   }
   
 
  


//Shortcode

//Add shortcode functionality
add_shortcode('show-team', 'shortcode_tshowcase');
add_shortcode('show-team-search', 'shortcode_tshowcase_search');
add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');


$tshowcase_global_atts = array();

function shortcode_tshowcase( $atts ) {	


   global $tshowcase_id_count;
   global $tshowcase_global_atts;

	if (!is_array($atts) || isset($atts['visual_composer_team_build']) ) { 


    $s_settings = get_option( 'tshowcase_shortcode', '' );
    if($s_settings!='') {
      $html = do_shortcode(stripslashes($s_settings));
      $html = '<div id="tshowcase_id_'.$tshowcase_id_count.'">'.$html.'</div>';  

    }

    else {

      $html = "<!-- Empty Team Showcase Container: No arguments or no saved shortcode -->";

    }


   }

	

  else {

  $orderby = (array_key_exists('orderby', $atts) ? $atts['orderby'] : "menu_order");
  $limit = (array_key_exists('limit', $atts) ? $atts['limit'] : 0);
  $idsfilter = (array_key_exists('ids', $atts) ? $atts['ids'] : "0");
  $exclude = (array_key_exists('exclude', $atts) ? $atts['exclude'] : "0");
  $category = (array_key_exists('category', $atts) ? $atts['category'] : "0");
  $url =  (array_key_exists('url', $atts) ? $atts['url'] : "inactive");
  $layout = (array_key_exists('layout', $atts) ? $atts['layout'] : "grid");
  $style = (array_key_exists('style', $atts) ? $atts['style'] : "img-square,normal-float");
  $display = (array_key_exists('display', $atts) ? $atts['display'] : "photo,position,email"); 
  $img = (array_key_exists('img', $atts) ? $atts['img'] : ""); 
  $searchact = (array_key_exists('search', $atts) ? $atts['search'] : "true");
  $pagination = (array_key_exists('pagination', $atts) ? $atts['pagination'] : "false");
  $showid = (array_key_exists('showid', $atts) ? $atts['showid'] : "true");
  $relation = (array_key_exists('relation', $atts) ? $atts['relation'] : "OR");
  $taxonomy = (array_key_exists('taxonomy', $atts) ? $atts['taxonomy'] : "0");
  $metakey = (array_key_exists('meta_key', $atts) ? $atts['meta_key'] : "");

  
  $page = (array_key_exists('page', $atts) ? $atts['page'] : 1);
  if(isset($_GET['tpage'])) {
    $page = $_GET['tpage'];
    
  }

  $atts['page'] = $page;
  $id = $tshowcase_id_count;

  $atts['div_id'] = $id;

  $tshowcase_global_atts[$id] = $atts;



  $html = build_tshowcase($orderby,$limit,$idsfilter,$exclude,$category,$url,$layout,$style,$display,$pagination,$img,$searchact,$showid,$relation,$page,$id,$taxonomy,$metakey,$atts);

  $html = '<div id="tshowcase_id_'.$tshowcase_id_count.'">'.$html.'</div>';  

  }

 
 
  $tshowcase_id_count++;

  return $html;
	
}

function shortcode_tshowcase_search( $atts ) {	

	if (!is_array($atts)) { $atts = array(); }

	$title = (array_key_exists('title', $atts) ? $atts['title'] : "");
	$taxonomies = (array_key_exists('filter', $atts) ? $atts['filter'] : "false");
  $taxonomies2 = (array_key_exists('taxonomy', $atts) ? $atts['taxonomy'] : "false");
	$custom_fields = (array_key_exists('fields', $atts) ? $atts['fields'] : "true");
	$url =  (array_key_exists('url', $atts) ? $atts['url'] : "");
	 
	$html = tshowcase_search_form ($title,$taxonomies,$taxonomies2,$custom_fields,$url);
	return $html;	
	
}



/*
 *
 * /////////////////////////////
 * FUNCTION TO DISPLAY THE LIST
 * /////////////////////////////
 *
 */

function build_tshowcase($orderby="menu_order",$limit=-1,$idsfilter="0",$exclude="0",$category="0",$url="inactive",$layout="grid",$style="float-normal",$display="photo,name,position,email",$pagination="false",$imgwo="",$searchact="true",$show_id="true",$relation="OR",$page=1,$id='0',$taxonomy='0',$metakey='',$atts=array()) {
	

	tshowcase_add_global_css();
	add_action('wp_footer', 'tshowcase_custom_css',99);
	
	$html = '';
  $pagejs = '';
	$thumbsize = "tshowcase-thumb";
	global $post;
	global $ts_labels;
	
	$options = get_option('tshowcase-settings');

  $searchmeta = (isset($options['tshowcase_search_meta']) ? true : false);

  $linkcssclass = isset($options['tshowcase_linkcssclass']) ? 'class="'.$options['tshowcase_linkcssclass'].'"' : '';
	$linkcssclass .= isset($options['tshowcase_linkrel']) ? ' rel="'.$options['tshowcase_linkrel'].'"' : '';

	//order


	
	if($orderby=='none') {
		$orderby = 'menu_order';
		};
	
	$ascdesc = 'DESC';
	if($orderby == 'title' || $orderby == 'menu_order') {
		$ascdesc = 'ASC';
		};


	
	//post per page
	$postsperpage = -1;
	$nopaging=true;
	if($limit >= 1) { 
  	$postsperpage = $limit;
  	$nopaging = false;
	}

	$paged = $page;

	if($pagination=="true") {
		$postsperpage = $limit;
		$nopaging = false;
		$paged = $page;

		if(isset($_GET['tpage'])){ $paged = $_GET['tpage'];}

    global $tshowcase_global_atts;

    if(isset($options['tshowcase_ajax_pagination'])) {
         tshowcase_ajax_pagination($tshowcase_global_atts);
    }
   

	}
	
	//display
	$display = explode(',',$display);
	$socialshow = false;
	if(in_array('social',$display)) {
		$socialshow = true;
	}
	
	//image size override
	$imgwidth = "";
	if($imgwo!=""){
		$imgwidth = explode(',',$imgwo);
		}
	
	//icons
	if(in_array('smallicons',$display)) {
	tshowcase_add_smallicons_css();	
	}

	
	//SEARCH RELATED CODE
	$search = "";
	$label = "";
	$catlabel = "";
  $taxlabel = '';

	if(isset($_GET['tshowcase-categories']) && $_GET['tshowcase-categories']!="" && $searchact == "true"){

			$category = esc_attr($_GET['tshowcase-categories']);

      $catarray = explode(',',$category);

      $catlabel = '';

      foreach ($catarray as $catdisplay) {
        $catObj = get_term_by('slug', $catdisplay, 'tshowcase-categories');
        $catlabel .= '  <i>'.$catObj->name.'</i>';
      }
			
	}

  
  if(isset($_GET['tshowcase-taxonomy']) && $_GET['tshowcase-taxonomy']!="" && $searchact == "true"){

      $taxonomy = esc_attr($_GET['tshowcase-taxonomy']);

      $taxarray = explode(',',$taxonomy);

      $taxlabel = ' &';

      foreach ($taxarray as $taxdisplay) {
        $taxObj = get_term_by('slug', $taxdisplay, 'tshowcase-taxonomy');
        $taxlabel .= '  <i>'.$taxObj->name.'</i>';
      }
      
  }

	if(isset($_GET['search']) && $searchact == "true"){
	
    $search = sanitize_text_field($_GET['search']);
		$searchlabel = '<i>'.stripslashes($search).'</i>';
		if($_GET['tshowcase-categories'] != '' || $_GET['search'] != '') {
			$label = '<div class="tshowcase-search-label">'.$ts_labels['search']['results-for'].' '.$searchlabel.' '.$catlabel.$taxlabel.'</div>';
		}
	}
	
	
	//If Custom Fields Search ON
	if($search!="" && $searchact == "true" && $searchmeta) {

  	$args = array( 'post_type' => 'tshowcase',

  				   'orderby' => $orderby, 
  				   'order' => $ascdesc, 
  				   'posts_per_page'=> -1, 
  				   'nopaging'=> true,
  				   'meta_value' => sanitize_title_for_query($_GET['search']),
  				   'meta_compare' => "LIKE",
  				   
  				   );

    $taxi=0;
    if($category!='0' && $category!='') {

      $cat = explode(',', $category);

      if(isset($_GET['tshowcase-taxonomy']) && $searchact=='true') {
        $relation = 'AND';
      }

      $args['tax_query']['relation'] = $relation;
      
      foreach ($cat as $cattax) {
          
          $args['tax_query'][$taxi] = array(
              'taxonomy' => 'tshowcase-categories',
              'field'    => 'slug',
              'terms'    => $cattax,
            );

        $taxi++;
      }

    }


    if(isset($taxonomy) && $taxonomy!='0' && $taxonomy!='') {

      $tax = explode(',', $taxonomy);

      if(isset($_GET['tshowcase-taxonomy']) && $searchact=='true') {
        $relation = 'AND';
      }

      $args['tax_query']['relation'] = $relation;
      
      foreach ($tax as $ctax) {
          
          $args['tax_query'][$taxi] = array(
              'taxonomy' => 'tshowcase-taxonomy',
              'field'    => 'slug',
              'terms'    => $ctax,
            );

        $taxi++;
      }

    }

		$cf_query = new WP_Query( $args );
		wp_reset_postdata();
	}
  //end custom fields search


   $suppress_filters = true;

   //WPML constant
   if (defined('ICL_LANGUAGE_CODE')) {

   	$current_language = ICL_LANGUAGE_CODE;

  		if ( $current_language ) { $suppress_filters = false; }

   }

	

	$args = array( 'post_type' => 'tshowcase',
				   'orderby' => $orderby, 
				   'order' => $ascdesc, 
				   'posts_per_page'=> $postsperpage, 
				   'nopaging'=> $nopaging,
				   'paged' => $paged,
				   'suppress_filters' => $suppress_filters,
           'post_status' => 'publish'
				   );


  //To make the proper group query
  $i=0;
  if($category!='0' && $category!='') {

    $cat = explode(',', $category);
 
     if(isset($_GET['tshowcase-taxonomy']) && $searchact == 'true') {
        $relation = 'AND';
      }

     $args['tax_query']['relation'] = $relation;

   
    foreach ($cat as $cattax) {
        
        $args['tax_query'][$i] = array(
            'taxonomy' => 'tshowcase-categories',
            'field'    => 'slug',
            'terms'    => $cattax,
          );

      $i++;
    }

  }

  //To make the proper group query
  if(isset($taxonomy) && $taxonomy!='0' && $taxonomy!='') {

      $tax = explode(',', $taxonomy);

      if(isset($_GET['tshowcase-taxonomy']) && $searchact == 'true') {
        $relation =  'AND';
      }

      $args['tax_query']['relation'] = $relation;
      
      foreach ($tax as $ctax) {
          
          $args['tax_query'][$i] = array(
              'taxonomy' => 'tshowcase-taxonomy',
              'field'    => 'slug',
              'terms'    => $ctax,
            );

        $i++;
      }

  }


  //if search is enabled
	if($search != '' && $searchact=='true') {

		$args['s'] = $search;
    $args['posts_per_page'] = -1;
    $args['nopaging'] = true;
    
	}

  if((isset($_GET['tshowcase-categories']) || isset($_GET['tshowcase-taxonomy']))  && $searchact =='true') {

    $args['posts_per_page'] = -1;
    $args['nopaging'] = true;

  }


	
	
	if($idsfilter != '0' && $idsfilter != '') {
		$postarray = explode(',', $idsfilter);

	 	if($postarray[0]!='') {
		$args['post__in'] = $postarray;
		$args['post_status'] = 'any';
    $args['order'] = 'post__in';
 		}

	} 

  if($exclude != '0' && $exclude != '') {
    $postarray = explode(',', $exclude);

    if($postarray[0]!='') {
    $args['post__not_in'] = $postarray;
    }
  } 

  //print_r($args);

  if($orderby=='meta_value' || $orderby=='meta_value_num') {

    $args['order'] = 'ASC';
    $args['orderby'] = $orderby;
    $args['meta_key'] = $metakey;
  }
	
	$loop = new WP_Query( $args );

	

	//Merge If Search is ON
  //Currently not working well, it's disabled
	if($search!="" && $searchact == "true" && $searchmeta) {

    $loop->posts = array_unique(array_merge($cf_query->posts, $loop->posts),SORT_REGULAR);
    $loop->post_count = count( $loop->posts );

	}

	//If order by last name is ON
	if($orderby == 'lastname') {

		$lastname = array();
		foreach( $loop->posts as $key => $post ) {
			$exploded = explode( ' ', $post->post_title );
        //$remove = array("Dr.","Mr.");
        //$name = str_replace($remove,'',$post->post_title);
        $name = $post->post_title;
		    $word = end($exploded);
        // $word = end($exploded).$name;
        //to order by second last
        //$word = prev($exploded);
		    $lastname[$key] = $word;
        
		}
		array_multisort( $lastname, SORT_ASC|SORT_NATURAL|SORT_FLAG_CASE, $loop->posts );
   

	}

  // to force random again - uncomment in case random is not working
  // if($orderby=='rand' ) {
  // shuffle( $loop->posts );
  // }

	//CHECK STYLE AND LAYOUT
	if($layout=='table') {
	
		$html .= tshowcase_build_table_layout($loop,$url,$display,$style,$category);

		if($pagination=="true" && !isset($_GET['search'])) {

			 if(($limit > 0) && (intval($loop->found_posts) > intval($limit))) {

          $html .= tshowcase_pagination($loop);

      }  

		}
	
		
	} 
	
	if($layout=='pager' || $layout=='thumbnails' ) {
		
		global $tshowcase_pager_count;
		tshowcase_pager_layout($tshowcase_pager_count);

		
		$imgstyle = tshowcase_get_img_style($style);
		$txtstyle = tshowcase_get_txt_style($style);
		$pagerstyle = tshowcase_get_pager_style($style);
		$pagerboxstyle = tshowcase_get_pager_box_style($style);
		$infostyle = tshowcase_get_info_style($style);	
		$pagerfilteractive = '';

		
		$theme = tshowcase_get_themes($style,'pager');	
		tshowcase_add_theme($theme,'pager');
			
		$thumbshtml ="";
		$previewhtml ="";
		$ic = 0;
			
		$lshowcase_options = get_option('tshowcase-settings');
		$dwidth = $lshowcase_options['tshowcase_thumb_width'];	
		
		
		if(is_array($imgwidth)) {
				$thumbsize = $imgwidth;
				$dwidth = $thumbsize[0];
			}
		

		  //BUILD CATEGORY FILTERS
	
			if (in_array('filter',$display) || in_array('enhance-filter',$display) || in_array('isotope-filter',$display) ) {
	
  			$html .= tshowcase_build_categories_filter($display,$category);
  			if(in_array('isotope-filter',$display)) { $pagerfilteractive .=" tshowcase-isotope"; }
        else { $pagerfilteractive .=" tshowcase-filter-active"; }
			
			}
				
			//Build Category filter end	





		while ( $loop->have_posts() ) : $loop->the_post(); 
		
		$title = the_title_attribute( 'echo=0' );	

      $id = get_the_ID();
      $cat = $pagerfilteractive.' ';
    
      $terms = get_the_terms( $id , 'tshowcase-categories' );
      if(is_array($terms)) {
        foreach ( $terms as $term ) {
        $cat .= 'ts-'.$term->slug.' '.'ts-id-'.$term->term_id.' ';
        }
      } 
		
			//If Photo is True
			if ( has_post_thumbnail() && in_array('photo',$display)) :     
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumbsize );
			$width = $image[1];			
			$twidth = $options['tshowcase_tpimg_width'];
			$theight = $options['tshowcase_tpimg_height'];
						
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),array($twidth,$theight),true); 
      //$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'full',true); 
     

			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($alt!='') {
				$alt = 'alt="'.$alt.'"';
			}

    		
			
			$previewhtml .='<li><div class="tshowcase-box">';
			
			if($options['tshowcase_single_page']=="true" && $url =="active") {
				$previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></a></div>';
			} 

			if($options['tshowcase_single_page']=="true" && $url =="active_new") {
				$previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.' target="_blank"><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></a></div>';
			} 

			if($url =="active_custom") {
				
        $this_url = get_post_meta( $post->ID , '_tspersonal', true );
        if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }

				$previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><a href="'.$this_url.'" '.$linkcssclass.'><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></a></div>';
			} 

			if($url =="active_custom_new") {
				$this_url = get_post_meta( $post->ID , '_tspersonal', true );
        if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
				$previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><a href="'.$this_url.'" '.$linkcssclass.' target="_blank"><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></a></div>';
			} 

      if($url =="custom") {
        add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
        $urlperm = get_permalink($post->ID);
        if($urlperm!='') {
          $previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><a href="'.$urlperm.'" '.$linkcssclass.'><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></a></div>';
        } else {
          $previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></div>';
        }
      } 

			if($url =="active_user") {
				add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );
				$previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></a></div>';
			} 

      if($url =="full_image") {
          $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
          $previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><a href="'.$fullimage[0].'" '.$linkcssclass.'><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></a></div>';
        } 

			if($url =="inactive") {
				$previewhtml .='<div class="tshowcase-box-photo '.$imgstyle.'"><img src="'.$image[0].'" width="'.$width.'" '.$alt.' /></div>';
			}
			
			$previewhtml .= "<div class='tshowcase-box-info ".$infostyle." ".$txtstyle."'>";
			

      $display_array = array();

			//if title is active
			if (in_array('name',$display)) : 
				
				if($options['tshowcase_single_page']=="true" && $url =="active") {
					$display_array['name'] ='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 	

				if($options['tshowcase_single_page']=="true" && $url =="active_new") {
					$display_array['name'] ='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.' target="_blank">'.$title.'</a></div>';
				} 	

				if($url =="active_custom") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$display_array['name'] ='<div class="tshowcase-box-title"><a href="'.$this_url.'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 	

				if($url =="active_custom_new") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$display_array['name'] ='<div class="tshowcase-box-title"><a href="'.$this_url.'" '.$linkcssclass.' target="_blank">'.$title.'</a></div>';
				} 

        if($url =="custom") {
              add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
              $urlperm = get_permalink($post->ID);
              if($urlperm!='') {
                $display_array['name'] ='<div class="tshowcase-box-title"><a href="'.$urlperm.'" '.$linkcssclass.'>'.$title.'</a></div>';
              } else {
                $display_array['name'] ='<div class="tshowcase-box-title">'.$title.'</div>';
              }
            }   	

				if($url =="active_user") {
					add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );
					$display_array['name'] ='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 

        if($url =="full_image") {
          $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
          $display_array['name'] ='<div class="tshowcase-box-title"><a href="'.$fullimage[0].'" '.$linkcssclass.'>'.$title.'</a></div>';
        } 



				if($url =="inactive") {
					$display_array['name'] = "<div class='tshowcase-box-title'>".$title."</div>";
				}


			endif;
			
      $display_array['social'] = '';
			//if Social is true
			if ($socialshow) : 		
			$display_array['social'] = "<div class='tshowcase-box-social'>".tshowcase_get_social(get_the_ID(),$socialshow)."</div>";
			endif;
			
			//if details exist		
			$display_array['details'] = "<div class='tshowcase-box-details'>".tshowcase_get_information(get_the_ID(),true,$display,false)."</div>";
			

      //Order 3 main blocks here

      global $ts_display_order;
      
      
      foreach($ts_display_order as $disp) {
        $previewhtml .= $display_array[$disp];
      }


			
			$previewhtml .="</div></div></li>";
			
			
			
			
      
      $thumbshtml .= '<div class="tshowcase-pager-thumbnail '.$cat.' '.$pagerfilteractive.'"><div class="'.$imgstyle.'"><a data-slide-index="'.$ic.'" href=""><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.'/></a></div></div>';     
      //to display title below thumbnail:
      //$thumbshtml .= '<div class="tshowcase-pager-thumbnail '.$cat.' '.$pagerfilteractive.'"><div class="'.$imgstyle.'"><a data-slide-index="'.$ic.'" href=""><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.'/></a></div><div class="tshowcase_thumb_title">'.get_the_title($id).'</div></div>';     
      //to display title and job title below testimonial
      //$thumbshtml .= '<div class="tshowcase-pager-thumbnail '.$cat.' '.$pagerfilteractive.'"><div class="'.$imgstyle.'"><a data-slide-index="'.$ic.'" href=""><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.'/></a></div><div class="tshowcase_thumb_title">'.get_the_title($id).'</div><div class="tshowcase_thumb_job">'.get_post_meta( $id, '_tsposition', true ).'</div></div>';     




      $ic++;	 
			endif;
		
		 
		endwhile;
		
		$wrapclass = '';
		if($theme!="default") {  $wrapclass .= " tshowcase-pager-".$theme."-wrap";  }
		

    //If image above, left or right
    if(strpos($style,'thumbs-above') === false) {
    
		$html .= '<div class="tshowcase-pager-wrap '.$wrapclass.'" style="display:none;">';
		$html .= '<div class="'.$pagerboxstyle.'"><ul class="tshowcase-bxslider-'.$tshowcase_pager_count.'">';
		$html .= $previewhtml;
		$html .= '</ul></div>';
		$html .= '<div id="tshowcase-bx-pager-'.$tshowcase_pager_count.'" class="'.$pagerstyle.'">';
		$html .= $thumbshtml;
		$html .= '</div>';
		$html .= '<div class="ts-clear-both"></div></div>';
    
    }
    
    else {

    
    $html .= '<div class="tshowcase-pager-wrap '.$wrapclass.'" style="display:none;">';
    $html .= '<div id="tshowcase-bx-pager-'.$tshowcase_pager_count.'" class="'.$pagerstyle.'">';
    $html .= $thumbshtml;
    $html .= '</div>';
    $html .= '<div class="'.$pagerboxstyle.'"><ul class="tshowcase-bxslider-'.$tshowcase_pager_count.'">';
    $html .= $previewhtml;
    $html .= '</ul></div>';
    $html .= '<div class="ts-clear-both"></div></div>';
        
    }

		
		$tshowcase_pager_count++;

		if($pagination=="true" && !isset($_GET['search'])) {

			 if(($limit > 0) && (intval($loop->found_posts) > intval($limit))) {

          $html .= tshowcase_pagination($loop);

      }  

		}


	}
	
	
	if($layout=='grid') {
		
	//theme	
	
	
	$imgstyle = tshowcase_get_img_style($style);
	$txtstyle = tshowcase_get_txt_style($style);
	$boxstyle = tshowcase_get_box_style($style);
	$innerboxstyle = tshowcase_get_innerbox_style($style);
	$infostyle = tshowcase_get_info_style($style);	
	$wrapstyle = tshowcase_get_wrap_style($style);
	$theme = tshowcase_get_themes($style,'grid');
	
	tshowcase_add_theme($theme,'grid');	

    //BUILD CATEGORY FILTERS

    if (in_array('filter',$display) || in_array('enhance-filter',$display) || in_array('isotope-filter',$display) ) {

      $html .= tshowcase_build_categories_filter($display,$category);
      if(in_array('isotope-filter',$display)) { $boxstyle .=" tshowcase-isotope";}
      else { $boxstyle .=" tshowcase-filter-active"; }
    
    }
        
      //Build Category filter end 

    if(in_array('isotope-filter',$display)) {
      $wrapstyle .=' tshowcase-isotope-wrap';
    }
		
		$html .="<div class='".$wrapstyle."'>";	
		
		

		
		
		
		while ( $loop->have_posts() ) : $loop->the_post(); 
		
			$title = the_title_attribute( 'echo=0' );
			$id = get_the_ID();
			$cat = "";
		
			$terms = get_the_terms( $post->ID , 'tshowcase-categories' );
			if(is_array($terms)) {
				foreach ( $terms as $term ) {
				$cat .= 'ts-'.$term->slug.' '.'ts-id-'.$term->term_id.' ';
				}
			}	

			$slug='';
			if($show_id == 'true') {
			$post_data = get_post($id, ARRAY_A);
    		$slug = $post_data['post_name'];
    		$slug = "id='".$slug."'";
    		}

			
			$html .="<div class='tshowcase-box ".$boxstyle." ".$cat."' ".$slug." >";	
			$html .="<div class='tshowcase-inner-box ".$innerboxstyle."'>";	
			
			$tshowcase_options = get_option('tshowcase-settings');
			$dwidth = $tshowcase_options['tshowcase_thumb_width'];	

      //display a field before photo
      //$html .= "<div class='tshowcase-single-position'>".get_post_meta( $id, '_tsposition', true )."</div>"; 
			
			//If Photo is True
			if ( has_post_thumbnail() && in_array('photo',$display)) {  
			

			if(is_array($imgwidth)) {
				$thumbsize = $imgwidth;
			}
			   
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumbsize ); 
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($alt!='') {
				$alt = 'alt="'.$alt.'"';
			}		
			
			$width = $image[1];	


			
			
				if($options['tshowcase_single_page']=="true" && $url =="active") {
					$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".get_permalink($post->ID)."' ".$linkcssclass."><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></a></div>";
				} 

				if($options['tshowcase_single_page']=="true" && $url =="active_new") {
					$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".get_permalink($post->ID)."' ".$linkcssclass." target='_blank'><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></a></div>";
				} 

				if($url =="active_custom") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".$this_url."' ".$linkcssclass."><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></a></div>";
				}

				if($url =="active_custom_new") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".$this_url."' ".$linkcssclass." target='_blank'><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></a></div>";
				} 

        if($url =="custom") {
              add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
              $urlperm = get_permalink($post->ID);
              if($urlperm!='') {
                $html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".$urlperm."' ".$linkcssclass."><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></a></div>";
              } else {
                $html .= "<div class='tshowcase-box-photo ".$imgstyle."'><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></div>";
              }
            }   


				if($url =="active_user") {
					add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );
					$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".get_permalink($post->ID)."' ".$linkcssclass."><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></a></div>";
				} 
        if($url =="full_image") {
          $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
          $html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".$fullimage[0]."' ".$linkcssclass."><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></a></div>";
        } 

				if($url =="inactive") {
					$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><img src='".$image[0]."' width='".$width."' title='".$title."' ".$alt." /></div>";
				}
								
			} else {
				
				if ( !has_post_thumbnail() && in_array('photo',$display)) {  
						
						$alt='';

						if($options['tshowcase_single_page']=="true" && $url =="active") {
							$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".get_permalink($post->ID)."' ".$linkcssclass."><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></a></div>";
						} 

						if($options['tshowcase_single_page']=="true" && $url =="active_new") {
							$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".get_permalink($post->ID)."' ".$linkcssclass." target='_blank'><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></a></div>";
						} 

						if($url =="active_custom") {
							$this_url = get_post_meta( $post->ID , '_tspersonal', true );
              if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
							$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".$this_url."' ".$linkcssclass."><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></a></div>";
						}

						if($url =="active_custom_new") {
							$this_url = get_post_meta( $post->ID , '_tspersonal', true );
              if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
							$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".$this_url."' ".$linkcssclass." target='_blank'><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></a></div>";
						}

            if($url =="custom") {
              add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
              $urlperm = get_permalink($post->ID);
              if($urlperm!='') {
                $html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".$urlperm."' ".$linkcssclass."><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></a></div>";
              } else {
                $html .= "<div class='tshowcase-box-photo ".$imgstyle."'><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></div>";
              }
            }   

						if($url =="active_user") {
							add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );
							$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".get_permalink($post->ID)."' ".$linkcssclass."><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></a></div>";
						} 

            if($url =="full_image") {
             
              $html .= "<div class='tshowcase-box-photo ".$imgstyle."'><a href='".plugins_url( '/img/default.png', __FILE__ )."' ".$linkcssclass."><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></a></div>";
            } 

						if($url =="inactive") {
							$html .= "<div class='tshowcase-box-photo ".$imgstyle."'><img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."' title='".$title."' ".$alt." /></div>";
						}
								
					}				
				
				}
			
				
      if(strpos($style,'img-above') === false) {

      //if(1 === false) {

              $html .= "<div class='tshowcase-box-info ".$txtstyle." '>";


      } else {

              $html .= "<div style='max-width:".$width."px' class='tshowcase-box-info ".$infostyle." ".$txtstyle." '>";


      } 
			
			
			//content array for ordering
			$display_array = array();
			
			$display_array['name']="";		
			//if title is active
			if (in_array('name',$display)) : 	
					


				if($options['tshowcase_single_page']=="true" && $url =="active") {
					$display_array['name'] .='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 	

				if($options['tshowcase_single_page']=="true" && $url =="active_new") {
					$display_array['name'] .='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.' target="_blank">'.$title.'</a></div>';
				} 	

				if($url =="active_custom") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$display_array['name'] .='<div class="tshowcase-box-title"><a href="'.$this_url.'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 	

				if($url =="active_custom_new") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$display_array['name'] .='<div class="tshowcase-box-title"><a href="'.$this_url.'" '.$linkcssclass.' target="_blank">'.$title.'</a></div>';
				}

        if($url =="custom") {
          add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
          $urlperm = get_permalink($post->ID);
          if($urlperm!='') {
            $display_array['name'] .='<div class="tshowcase-box-title"><a href="'.$urlperm.'" '.$linkcssclass.'>'.$title.'</a></div>';
          } else {
            $display_array['name'] .='<div class="tshowcase-box-title">'.$title.'</div>';
          }
        }  	

				if($url =="active_user") {
					add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );
					$display_array['name'] .='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 	

        if($url =="full_image") {
          $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
          $display_array['name'] .='<div class="tshowcase-box-title"><a href="'.$fullimage[0].'" '.$linkcssclass.'>'.$title.'</a></div>';
        } 

				if($url =="inactive") {
					$display_array['name'] .= "<div class='tshowcase-box-title'>".$title."</div>";
				}
			
			
			endif;
			
			$display_array['social'] = "";
			//if Social is true
			if ($socialshow) : 		
			$display_array['social'] = "<div class='tshowcase-box-social'>".tshowcase_get_social(get_the_ID(),$socialshow)."</div>";
			endif;
			
			$display_array['details'] = "";
			//if details exist		
			$display_array['details'] = "<div class='tshowcase-box-details'>".tshowcase_get_information(get_the_ID(),true,$display,false)."</div>";
			
			
			//ORDER INFORMATION
			global $ts_display_order;
			
			
			foreach($ts_display_order as $disp) {
				$html .= $display_array[$disp];
			}
			//END ORDER
			
			
			$html .="</div>";
			$html .="</div>";
			$html .="</div>";
			
			
		endwhile; 
		$html .="</div>";

		if($pagination=="true" && !isset($_GET['search'])) {


      if(($limit > 0) && (intval($loop->found_posts) > intval($limit))) {

          $html .= tshowcase_pagination($loop);

      }  

		}

	}
	
	
	//HOVER THUMBS LAYOUT
	
	if($layout=='hover') {
		
	$imgstyle = tshowcase_get_img_style($style);
	$txtstyle = tshowcase_get_txt_style($style);
	$boxstyle = tshowcase_get_box_style($style);
	$infostyle = tshowcase_get_info_style($style);	
	$wrapstyle = tshowcase_get_wrap_style($style);	
	
	$theme = tshowcase_get_themes($style,'hover');	
	tshowcase_add_theme($theme,'hover');
	
	
	

  //BUILD CATEGORY FILTERS
  
    if (in_array('filter',$display) || in_array('enhance-filter',$display) || in_array('isotope-filter',$display) ) {

      $html .= tshowcase_build_categories_filter($display,$category);
      if(in_array('isotope-filter',$display)) { $boxstyle .=" tshowcase-isotope";}
      else { $boxstyle .=" tshowcase-filter-active"; }
    
    }

    
  //Build Category filter end 

  $wrapid = "tshowcase-hover-wrap";

  

  if($theme!="default") { $wrapstyle .= " tshowcase-".$theme."-wrap"; }
		
  if(in_array('isotope-filter',$display)) {
    $wrapstyle .=' tshowcase-isotope-wrap';
  }


	$html .="<div class='".$wrapstyle."' id='".$wrapid."'>";			
	
	$html .= "";
		
		
		
		$lshowcase_options = get_option('tshowcase-settings');
		$dwidth = $lshowcase_options['tshowcase_thumb_width'];	
		if(is_array($imgwidth)) {
				$thumbsize = $imgwidth;
				$dwidth = $thumbsize[0];
			}
			
		while ( $loop->have_posts() ) : $loop->the_post(); 

		
		$title = the_title_attribute( 'echo=0' );
		
		$id = get_the_ID();
		$cat = "";
		
		$terms = get_the_terms( $post->ID , 'tshowcase-categories' );
			if(is_array($terms)) {
				foreach ( $terms as $term ) {
				$cat .= 'ts-'.$term->slug.' '.'ts-id-'.$term->term_id.' ';
				}
			}
		
    //$html .='<a href="'.get_permalink($post->ID).'">';
		
		$html .='<div class="tshowcase-hover-box '.$boxstyle.' '.$cat.'"><div style="margin-left:auto; margin-right:auto; max-width:'.$dwidth.'px;">';
		
    //add title below image
      if(in_array('hovertitleup',$display)) {
      $html .= "<div class='tshowcase-box-title'>".$title."</div>";          
      }

    

    $html .='<span class="'.$imgstyle.'">';
                        
			if ( has_post_thumbnail()) :
			     
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumbsize ); 	
			$width = $image[1];	
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($alt!='') {
				$alt = 'alt="'.$alt.'"';
			}		
			
			$html .= "<img src='".$image[0]."' width='".$width."' ".$alt."/>";

      //$html .= "<a href='".get_permalink($post->ID)."'><img src='".$image[0]."' width='".$width."' ".$alt."/></a>";

			
						
			endif;
			
			
			if ( !has_post_thumbnail()) {  
					
			$html .= "<img src='".plugins_url( '/img/default.png', __FILE__ )."' width='".$dwidth."'/>";
			
			}
			
						
			$html .='<span class="tshowcase-hover-info">';
            $html .= "<div class='tshowcase-box-info ".$txtstyle."'><div class='tshowcase-box-info-inner'>";
			
			//if title is active
			if (in_array('name',$display)) : 	
					
				if($options['tshowcase_single_page']=="true" && $url =="active") {
					$display_array['name']='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 	
				if($options['tshowcase_single_page']=="true" && $url =="active_new") {
					$display_array['name']='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.' target="_blank">'.$title.'</a></div>';
				} 
				if($url =="active_custom") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$display_array['name']='<div class="tshowcase-box-title"><a href="'.$this_url.'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 	
				if($url =="active_custom_new") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$display_array['name']='<div class="tshowcase-box-title"><a href="'.$this_url.'" '.$linkcssclass.' target="_blank">'.$title.'</a></div>';
				} 

        if($url =="custom") {
          add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
          $urlperm = get_permalink($post->ID);
          if($urlperm!='') {
            $display_array['name']='<div class="tshowcase-box-title"><a href="'.$urlperm.'" '.$linkcssclass.'>'.$title.'</a></div>';
          } else {
            $display_array['name']='<div class="tshowcase-box-title">'.$title.'</div>';
          }
        } 

				if($url =="active_user") {
					add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );
					$display_array['name']='<div class="tshowcase-box-title"><a href="'.get_permalink($post->ID).'" '.$linkcssclass.'>'.$title.'</a></div>';
				} 

        if($url =="full_image") {
          $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
          $display_array['name']='<div class="tshowcase-box-title"><a href="'.$fullimage[0].'" '.$linkcssclass.'>'.$title.'</a></div>';
        } 

				if($url =="inactive") {
					$display_array['name'] = "<div class='tshowcase-box-title'>".$title."</div>";
				}
			
			
			endif;
			
			//if Social is true
			if ($socialshow) : 		
			$display_array['social'] = "<div class='tshowcase-box-social'>".tshowcase_get_social(get_the_ID(),$socialshow)."</div>";
			endif;
			
			//if details exist		
			$display_array['details'] = "<div class='tshowcase-box-details'>".tshowcase_get_information(get_the_ID(),true,$display,false)."</div>";
			
      //ORDER INFORMATION
      global $ts_display_order;
      foreach($ts_display_order as $disp) {
        if(isset($display_array[$disp])) {
          $html .= $display_array[$disp];
        }
        
      }
      //END ORDER
			
			$html .="</div></div>";   
						 
      $html .='</span></span>';

     

      //add title below image
      if(in_array('hovertitle',$display)) {
      $html .= "<div class='tshowcase-box-title'>".$title."</div>";  
      //$html .= "<div class='tshowcase-box-title'><a href='".get_permalink($post->ID)."'>".$title."</a></div>";        
      }


      
      $html .= ' </div></div>';	

      //$html .='</a>';
			
		endwhile; 
		$html .="</div>";

		if($pagination=="true" && !isset($_GET['search'])) {

			 if(($limit > 0) && (intval($loop->found_posts) > intval($limit))) {

          $html .= tshowcase_pagination($loop);

      }  

		}

		
	}
	
	
	
		
		// Restore original Post Data 
		wp_reset_postdata();
	
	$html = "<div class='tshowcase'>".$label.$html.$pagejs."</div>";



	return $html;
}

//BUILDING TABLE LAYOUT

function tshowcase_build_table_layout($loop,$url,$display,$style,$category) {
		
	$theme = tshowcase_get_themes($style,'table');	
	tshowcase_add_theme($theme,'table');	
	
	$html = "";
	$options = get_option('tshowcase-settings');
	$imgstyle = tshowcase_get_img_style($style);
	$txtstyle = tshowcase_get_txt_style($style);
	$wrapstyle = tshowcase_get_wrap_style($style);

  $linkcssclass = isset($options['tshowcase_linkcssclass']) ? 'class="'.$options['tshowcase_linkcssclass'].'"' : '';
  $linkcssclass .= isset($options['tshowcase_linkrel']) ? ' rel="'.$options['tshowcase_linkrel'].'"' : '';


      if (in_array('filter',$display) || in_array('enhance-filter',$display) || in_array('isotope-filter',$display) ) {
  
        $html .= tshowcase_build_categories_filter($display,$category);
        if(in_array('isotope-filter',$display)) { $txtstyle .=" tshowcase-isotope";}
        else { $txtstyle .=" tshowcase-filter-active"; }
      
      }

	
	$html .= "<div class='tshowcase-wrap'><table class='tshowcase-box-table ".$wrapstyle."'>";

  //add title manually:
  /*
  $html .= "<tr>
    <td>Jill</td>
    <td>Smith</td> 
    <td>50</td>
  </tr>";
  */

  
	
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$title = the_title_attribute( 'echo=0' );
	$id = get_the_ID();
	$smallicons = in_array('smallicons',$display);

  $cat = ' ';
  $terms = get_the_terms( $id , 'tshowcase-categories' );
      if(is_array($terms)) {
        foreach ( $terms as $term ) {
        $cat .= 'ts-'.$term->slug.' '.'ts-id-'.$term->term_id.' ';
        }
      } 
	
	global $ts_small_icons;
		
		if($smallicons) {
		$iconposition = $ts_small_icons['position'];
		$iconemail = $ts_small_icons['email'];
		$icontel = $ts_small_icons['telephone'];
		$iconhtml = $ts_small_icons['html'];
		$iconpersonal = $ts_small_icons['website'];
		$iconlocation = $ts_small_icons['location'];
    $icongroups = $ts_small_icons['groups'];
    $icontax = $ts_small_icons['taxonomy'];
		} else {
		$iconposition = '';
		$iconemail = '';
		$icontel = '';
		$iconhtml = '';
		$iconpersonal = '';
		$iconlocation = '';	
    $icongroups = '';
    $icontax = '';
		}
	
	
  // Image Code

	$html .= "<tr class='".$txtstyle.$cat."'>";
	
	if(in_array('photo',$display)){
		$width = $options['tshowcase_timg_width'];
		$height = $options['tshowcase_timg_height'];
		
		$html .= '<td><div class="'.$imgstyle.'">';
		if ( has_post_thumbnail() ) {
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($id),array($width,$height));	
		$thumbnail_id = get_post_thumbnail_id( $id );
		$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
		if($alt!='') {
			$alt = 'alt="'.$alt.'"';
		}		
		
				if($options['tshowcase_single_page']=="true" && $url =="active") {
					$html .='<a href="'.get_permalink($id).'" '.$linkcssclass.'><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' /></a>';
				} 	
				if($options['tshowcase_single_page']=="true" && $url =="active_new") {
					$html .='<a href="'.get_permalink($id).'" '.$linkcssclass.' target="_blank"><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' /></a>';
				} 

				if($url =="active_custom") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$html .='<a href="'.$this_url.'" '.$linkcssclass.'><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' /></a>';
				} 	
				if($url =="active_custom_new") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
					$html .='<a href="'.$this_url.'" '.$linkcssclass.' target="_blank"><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' /></a>';
				} 

        if($url =="custom") {
          add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
          $urlperm = get_permalink($id);
          if($urlperm!='') {
            $html .='<a href="'.$urlperm.'" '.$linkcssclass.'><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' /></a>';
          } else {
            $html .='<img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' />';
          }
        } 

				if($url =="active_user") {
					add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );	
					$html .='<a href="'.get_permalink($id).'" '.$linkcssclass.'><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' /></a>';
				} 

        if($url =="full_image") {
          $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
          $html .='<a href="'.$fullimage[0].'" '.$linkcssclass.'><img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' /></a>';
        } 

				if($url =="inactive") {
					$html .= '<img src="'.$thumb[0].'" width="'.$thumb[1].'" '.$alt.' />';
				}
		}
		
		if ( !has_post_thumbnail()) {  
				
				if($options['tshowcase_single_page']=="true" && $url =="active") {
									
						$html .='<a href="'.get_permalink($id).'" '.$linkcssclass.'><img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" /></a>';
						} 

				if($options['tshowcase_single_page']=="true" && $url =="active_new") {
									
						$html .='<a href="'.get_permalink($id).'" '.$linkcssclass.' target="_blank"><img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" /></a>';
						} 

				if($url =="active_custom") {
              $this_url = get_post_meta( $post->ID , '_tspersonal', true );
              if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }
  						$html .='<a href="'.$this_url.'" '.$linkcssclass.'><img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" /></a>';
						} 

				if($url =="active_custom_new") {
					 $this_url = get_post_meta( $post->ID , '_tspersonal', true );
            if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }		
						$html .='<a href="'.$this_url.'" '.$linkcssclass.' target="_blank"><img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" /></a>';
						} 

        if($url =="custom") {
          add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
          $urlperm = get_permalink($id);
          if($urlperm!='') {
            $html .='<a href="'.$urlperm.'" '.$linkcssclass.'><img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" /></a>';
          } else {
            $html .='<img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" />';
          }
        } 

				if($url =="active_user") {
						add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );			
						$html .='<a href="'.get_permalink($id).'" '.$linkcssclass.'><img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" /></a>';
						} 

        if($url =="full_image") {
            $html .='<a href="'.plugins_url( '/img/default.png', __FILE__ ).'"><img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" /></a>';

        } 

				if($url =="inactive") {
								
						$html .= '<img src="'.plugins_url( '/img/default.png', __FILE__ ).'" width="'.$width.'" />';
					
						}
								
					}
		
		
		$html .= '</div></td>';
	}
	

  //Title/Name Code
	
	if(in_array('name',$display)){
		
				if($options['tshowcase_single_page']=="true" && $url =="active") {
					$html .='<td><a href="'.get_permalink($id).'" '.$linkcssclass.'>'.$title.'</a></td>';
				} 	
				if($options['tshowcase_single_page']=="true" && $url =="active_new") {
					$html .='<td><a href="'.get_permalink($id).'" '.$linkcssclass.' target="_blank">'.$title.'</a></td>';
				} 	
				if($url =="active_custom") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
            if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }   
					$html .='<td><a href="'.$this_url.'" '.$linkcssclass.'>'.$title.'</a></td>';
				} 

				if($url =="active_custom_new") {
					$this_url = get_post_meta( $post->ID , '_tspersonal', true );
          if($this_url!='') { $this_url = $this_url; } else { $this_url = get_permalink($post->ID); }   
					$html .='<td><a href="'.$this_url.'" '.$linkcssclass.' target="_blank">'.$title.'</a></td>';
				} 	 	

        if($url =="custom") {
          add_filter( 'post_type_link', 'tshowcase_custom_link_empty', 10, 2 );
          $urlperm = get_permalink($id);
          if($urlperm!='') {
            $html .='<td><a href="'.$urlperm.'" '.$linkcssclass.'>'.$title.'</a></td>';
          } else {
            $html .='<td>'.$title.'</td>';
          }
        } 

				if($url =="active_user") {
					add_filter( 'post_type_link', 'tshowcase_author_link', 10, 2 );	
					$html .='<td><a href="'.get_permalink($id).'" '.$linkcssclass.'>'.$title.'</a></td>';
				} 		

				if($url =="inactive" || $url == "full_image") {
					$html .= "<td>".$title."</td>";
				}	
	
	}
	
  if(in_array('groups',$display)) {
 
    $tsgroups = '';
    $taxonomy = 'tshowcase-categories';
    $terms = wp_get_post_terms( $id, $taxonomy, array("fields" => "all") );  
    foreach ($terms as $term) {
      $tsgroups .= $term->name.', ';
    }
    $tsgroups = rtrim($tsgroups, ", ");

    $html .= "<td>";
      if($tsgroups!="") {   $html .= $icongroups.$tsgroups; }
    $html .= "</td>";
  
  }

  if(in_array('taxonomy',$display) && isset($options['tshowcase_second_tax'])) {
 
    $tsgroups = '';
    $taxonomy = 'tshowcase-taxonomy';
    $terms = wp_get_post_terms( $id, $taxonomy, array("fields" => "all") );  

    if(is_array($terms)) {

       foreach ($terms as $term) {
        $tsgroups .= $term->name.', ';
        }
        $tsgroups = rtrim($tsgroups, ", ");

    }

   

    $html .= "<td>";
      if($tsgroups!="") {   $html .= $icontax.$tsgroups; }
    $html .= "</td>";
  
  }


	
	if(in_array('position',$display)) {
	$tsposition = get_post_meta($id,'_tsposition',true);
	$html .= "<td>";
		if($tsposition!="") { 	$html .= $iconposition.$tsposition; }
	$html .= "</td>";
	
	}

  if(in_array('location',$display)){
  $tsloc = get_post_meta($id,'_tslocation',true);
  $html .= "<td>";
  if(($tsloc!="")) { $html .= $iconlocation.$tsloc; }
  $html .= "</td>";
  }
	
	if(in_array('email',$display)){
	$tsemail = htmlentities ( get_post_meta($id,'_tsemail',true) );
		$html .= "<td>";
		if(($tsemail!="")) { 
			$mailto = isset($options['tshowcase_mailto']);
			if($mailto): $tsemail = "<a href='mailto:".$tsemail."'>".$tsemail."</a>"; endif;
			$html .= $iconemail.$tsemail;
		}
		$html .= "</td>";
	}
	
	if(in_array('telephone',$display)){
	$tstel = get_post_meta($id,'_tstel',true);
	$html .= "<td>";

	if(($tstel!="")) { 

    if(isset($options['tshowcase_tellink'])) {

      $tstel = '<a href="tel:'.$tstel.'">'.$tstel.'</a>';

    }

    $html .= $icontel.$tstel; }
	  $html .= "</td>";
	}
	
	
	
	if(in_array('freehtml',$display)){
	$tsfreehtml = get_post_meta($id,'_tsfreehtml',true);
	$html .= "<td>";
	if(($tsfreehtml!="")) { $html .= $iconhtml.$tsfreehtml; }
	$html .= "</td>";
	}
	
	if(in_array('social',$display)){
	$social = tshowcase_get_social($id,true);
	$html .= "<td><div class='tshowcase-box-social'>".$social."</div></td>";
	}
	
	
	if(in_array('website',$display)){
		
	$tsweb = get_post_meta($id,'_tspersonal',true);
  $tswebanchor = get_post_meta($id,'_tspersonalanchor',true);
	$tswebstrip = tshowcase_strip_http($tsweb);

  if($tswebanchor!='') {

    $html .= "<td>";
    if(($tsweb!="")) { $html .= $iconpersonal."<a href='".$tsweb."' target='_blank'>".$tswebanchor."</a>";}
    $html .= "</td>";

    } 

  else {
    $html .= "<td>";
    if(($tsweb!="")) { $html .= $iconpersonal."<a href='".$tsweb."' target='_blank'>".$tswebstrip."</a>";}
    $html .= "</td>";
    }


	}
	
	
	
	$html .= "</tr>";
	
	endwhile;
	
	$html .= "</table></div>";
	return $html; 
}


//CSS & JS FUNCTIONS FOR EACH LAYOUT/STYLE


/* NORMAL STYLES */

function tshowcase_add_theme($theme,$layout) {
	
			global $ts_theme_names;
			
			$thadd = $ts_theme_names[$layout][$theme];
								
			wp_deregister_style( $thadd['name']);
		    wp_register_style($thadd['name'], plugins_url($thadd['link'], __FILE__ ),array(),false,'all');
			wp_enqueue_style($thadd['name'] );			
			
}



function tshowcase_default_layout() {
				
			wp_deregister_style( 'tshowcase-normal-style' );
		    wp_register_style( 'tshowcase-normal-style', plugins_url( 'css/normal.css', __FILE__ ),array(),false,'all');					            
        wp_enqueue_style( 'tshowcase-normal-style' );			
			
}



/*   JS for Slider */
function tshowcase_pager_layout($lshowcase_slider_count) {
				
			wp_deregister_script( 'tshowcase-bxslider' );
		    wp_register_script( 'tshowcase-bxslider', plugins_url( 'js/bxslider/jquery.bxslider.js', __FILE__ ),array('jquery'),false,false);
			wp_enqueue_script( 'tshowcase-bxslider' );			
			
			wp_deregister_script( 'tshowcase-bxslider-pager' );
		    wp_register_script( 'tshowcase-bxslider-pager', plugins_url( 'js/pager.js', __FILE__ ),array('jquery','tshowcase-bxslider'),false,false);
			wp_enqueue_script( 'tshowcase-bxslider-pager' );				
			
			
			$pagerarray = array( 'count' => $lshowcase_slider_count );
			wp_localize_script('tshowcase-bxslider-pager', 'tspagerparam', $pagerarray);

			//add_action( 'wp_print_footer_scripts', 'tshowcase_pager_code' );	
			
}


/* JS for ajax pagination */
add_action('wp_ajax_nopriv_tshowcase_shortcode_build', 'shortcode_tshowcase_ajax');
add_action('wp_ajax_tshowcase_shortcode_build', 'shortcode_tshowcase_ajax');


function shortcode_tshowcase_ajax($array) {

  //remove pagination, so it doesn't output
  $_POST['post']['pagination'] = 'false';

  //print_r($_POST);

  echo shortcode_tshowcase($_POST['post']);
  die();

}

function tshowcase_ajax_pagination($tshowcase_atts) {
              
      wp_deregister_script( 'tshowcase-ajax-pager' );
        wp_register_script( 'tshowcase-ajax-pager', plugins_url( 'js/ajax-pagination.js', __FILE__ ),array('jquery'),false,false);
      wp_enqueue_script( 'tshowcase-ajax-pager' );        
      
      wp_localize_script('tshowcase-ajax-pager', 'ts_atts', $tshowcase_atts);

      wp_localize_script( 'tshowcase-ajax-pager', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


      //add_action( 'wp_print_footer_scripts', 'tshowcase_pager_code' );  
      
}


/* JS For Filter */ 
function tshowcase_filter_code() {
	
	wp_deregister_script( 'tshowcase-filter' );
	wp_register_script( 'tshowcase-filter', plugins_url( '/js/filter.js', __FILE__ ),array('jquery','jquery-ui-core','jquery-effects-core'),false,false);
	wp_enqueue_script( 'tshowcase-filter' );
			
}

function tshowcase_enhance_filter_code() {
	
	wp_deregister_script( 'tshowcase-enhance-filter' );
	wp_register_script( 'tshowcase-enhance-filter', plugins_url( '/js/filter-enhance.js', __FILE__ ),array('jquery','jquery-effects-core'),false,false);
	wp_enqueue_script( 'tshowcase-enhance-filter' );
			
}

/* JS for Isotope filter */
function tshowcase_isotope_filter_code() {

  wp_deregister_script( 'tshowcase-isotope' );
  wp_register_script( 'tshowcase-isotope', plugins_url( '/js/isotope.pkgd.min.js', __FILE__ ),array('jquery',),false,false);
  wp_enqueue_script( 'tshowcase-isotope' );

  wp_deregister_script( 'tshowcase-cells-isotope' );
  wp_register_script( 'tshowcase-cells-isotope', plugins_url( '/js/cells-by-row.js', __FILE__ ),array('jquery','tshowcase-isotope'),false,false);
  wp_enqueue_script( 'tshowcase-cells-isotope' );
  
  wp_deregister_script( 'tshowcase-isotope-filter' );
  wp_register_script( 'tshowcase-isotope-filter', plugins_url( '/js/filter-isotope.js', __FILE__ ),array('jquery','tshowcase-isotope'),false,false);
  wp_enqueue_script( 'tshowcase-isotope-filter' );


  wp_deregister_script( 'tshowcase-imgs-loaded' );
  wp_register_script( 'tshowcase-imgs-loaded', plugins_url( '/js/imagesloaded.pkgd.min.js', __FILE__ ),array('jquery','tshowcase-isotope'),false,false);
  wp_enqueue_script( 'tshowcase-imgs-loaded' );
  
      
}

//Not in use anymore but not deleted for future reference and customizations

function tshowcase_pager_code() {
	global $tshowcase_pager_count;
	$i = 0;
	?>
    <script type="text/javascript">
	jQuery.noConflict();
	
	<?php while ($i<$tshowcase_pager_count) { 
	
	?>
	
	jQuery(document).ready(function(){
    var tsslider = jQuery('.tshowcase-bxslider-<?php echo $i; ?>').bxSlider({
      pagerCustom: '#tshowcase-bx-pager-<?php echo $i; ?>',
	  controls:false,
	  mode:'fade'
    	});

    // //custom hover code
    // jQuery('#tshowcase-bx-pager-'+<?php echo $i; ?>+' a').hover(function() {
				// var idslide = $(this).attr('data-slide-index');
				// tsslider.goToSlide(idslide);
			 //  	});


	
	
	<?php 
	$i++;
	} ?>
	 </script>
    
    <?php
	
}


// Add script and styles to admin edit/add new screen
function tshowcase_add_admin_scripts( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'tshowcase' === $post->post_type ) {     
            tshowcase_add_global_css();
            tshowcase_add_smallicons_css();
        }
    }
}
add_action( 'admin_enqueue_scripts', 'tshowcase_add_admin_scripts', 10, 1 );


/* CSS enqueue functions */ 

function tshowcase_add_global_css() {
       		wp_deregister_style( 'tshowcase-global-style' );
		    wp_register_style( 'tshowcase-global-style', plugins_url( '/css/global.css', __FILE__ ),array(),false,'all');
			wp_enqueue_style( 'tshowcase-global-style' );	

    } 
	

function tshowcase_add_smallicons_css() {
       		wp_deregister_style( 'tshowcase-smallicons' );
		    wp_register_style( 'tshowcase-smallicons', plugins_url( '/css/font-awesome/css/font-awesome.min.css', __FILE__ ),array(),false,'all');
			wp_enqueue_style( 'tshowcase-smallicons' );	

    } 


	
function tshowcase_get_image($id) {
$html = "";	
$options = get_option('tshowcase-settings');

if(isset($options['tshowcase_single_show_photo']) && has_post_thumbnail($id)) { 
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'tshowcase-thumb' ); 
    $alt = get_post_meta(get_post_thumbnail_id( $id ), '_wp_attachment_image_alt', true);
      if($alt!='') {
        $alt = 'alt="'.$alt.'"';
      }   
		$html .=   '<div><img itemprop="photo" '.$alt.' src="'.$image[0].'" width="'.$image[1].'" ></div>';
		//get_the_post_thumbnail($post->ID,'thumbnail');
		}
	return $html;	
	
}

function tshowcase_get_image_with_default_img($id) {
$html = ""; 
$options = get_option('tshowcase-settings');

if(isset($options['tshowcase_single_show_photo'])) {

if (has_post_thumbnail($id)) { 
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'tshowcase-thumb' ); 
    $html .=   '<div><img src="'.$image[0].'" width="'.$image[1].'" ></div>';
    //get_the_post_thumbnail($post->ID,'thumbnail');
    }

else {

$image = plugins_url( '/img/default.png', __FILE__ );
 
 $html .=   '<div><img src="'.$image.'" width="'.$options['tshowcase_img_width'].'"></div>';

}
}
  return $html; 
  
}

//Currently not available in this version - twitter feed
function tshowcase_get_twitter($id) {
	
	$options = get_option('tshowcase-settings');
	$tstwitter = get_post_meta( $id, '_tstwitter', true );
	$html ="";
	if(isset($options['tshowcase_single_show_twitter']) && ($tstwitter!="")) { 
	
	$title = "Latest Tweets";
	if(isset($options['tshowcase_twitter_title'])) {
		$title = $options['tshowcase_twitter_title'];
	}	
		
	$html .=   "<h3>".$title."</h3>";
	$html .= '';
	}
	return $html;
	
}

function tshowcase_get_information($id,$show,$display=array(),$singular=false) {
	
		$options = get_option('tshowcase-settings');
		$html="";
		
    $title = false;
		$position = in_array('position',$display);
		$email = in_array('email',$display);
		$tel = in_array('telephone',$display);
		$freehtml = in_array('freehtml',$display);
		$website = in_array('website',$display);
		$location = in_array('location',$display);
		$smallicons = in_array('smallicons',$display);
    $displaygroups = in_array('groups',$display);
    $displaytax = in_array('taxonomy',$display) && isset($options['tshowcase_second_tax']) ? true : false;
		
		if($singular) {
      $title = isset($options['tshowcase_single_show_title']);
			$position = isset($options['tshowcase_single_show_position']);
			$email = isset($options['tshowcase_single_show_email']);
			$tel = isset($options['tshowcase_single_show_telephone']);
			$freehtml = isset($options['tshowcase_single_show_freehtml']);
			$website = isset($options['tshowcase_single_show_website']);
			$location = isset($options['tshowcase_single_show_location']);
			$smallicons = isset($options['tshowcase_single_show_smallicons']);
      $displaygroups = isset($options['tshowcase_single_show_groups']);
      $displaytax = isset($options['tshowcase_single_show_taxonomy']) && isset($options['tshowcase_second_tax']) ? true : false;
			
			if($smallicons) {
				tshowcase_add_smallicons_css();
			}
			
		}
		
		
	
		$tsposition = get_post_meta( $id, '_tsposition', true );

		$tsemail = get_post_meta( $id, '_tsemail', true );
		
		
		
		$tstel = get_post_meta( $id, '_tstel', true );
		$tsfreehtml = get_post_meta( $id, '_tsfreehtml', true );
		$tspersonal = get_post_meta( $id, '_tspersonal', true );
    $tspersonalanchor = get_post_meta( $id, '_tspersonalanchor', true );
		$tslocation = get_post_meta( $id, '_tslocation', true );


		//to grab the free html from the main content
		//$tsfreehtml = do_shortcode(get_post_field('post_content', $id));

    $tsgroups = '';
    $taxonomy = 'tshowcase-categories';
    $terms = wp_get_post_terms( $id, $taxonomy, array("fields" => "all","orderby"=>"parent") );  
    foreach ($terms as $term) {

      if(strstr($term->description, 'http')) {

        $tsgroups .= '<a href="'.$term->description.'">'.$term->name.'</a>, ';
      
      }
      else {

        $tsgroups .= $term->name.', ';

      }
    }
    $tsgroups = rtrim($tsgroups, ", ");

    //for second taxonomy
    $tstax = '';
    if($displaytax) {
      $taxonomy2 = 'tshowcase-taxonomy';
      $terms = wp_get_post_terms( $id, $taxonomy2, array("fields" => "all") );  
      foreach ($terms as $term) {
        $tstax .= $term->name.', ';
      }
      $tstax = rtrim($tstax, ", ");
    }
    

		
		global $ts_small_icons;
		
		if($smallicons) {
    $icontitle = $ts_small_icons['title'];
		$iconposition = $ts_small_icons['position'];
		$iconemail = $ts_small_icons['email'];
		$icontel = $ts_small_icons['telephone'];
		$iconhtml = $ts_small_icons['html'];
		$iconpersonal = $ts_small_icons['website'];
		$iconlocation = $ts_small_icons['location'];
    $icongroups = $ts_small_icons['groups'];
    $icontax = $ts_small_icons['taxonomy'];
		} else {
    $icontitle = '';
		$iconposition = '';
		$iconemail = '';
		$icontel = '';
		$iconhtml = '';
		$iconpersonal = '';
		$iconlocation = '';	
    $icongroups = '';
    $icontax = '';
		}
		
		$info_array = array();


    //if it's for single page, we add the meta data for person type
    if($singular) {

      $divend = '</div>';
      $ipname = '<div style="display:inline-block" itemprop="name">';
      $iprole = '<div style="display:inline-block" itemprop="role">';
      $ipaddress ='<div style="display:inline-block" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">';
      $iplocality = '<div style="display:inline-block" itemprop="locality">';
      $ipurl = "itemprop='url'";
      $ipnote = 'itemprop ="note"';
      $ipemail = 'itemprop ="email"';
      $iptel = 'itemprop ="tel"';

    } else {

      $divend = '';
      $ipname = '';
      $iprole = '';
      $ipaddress ='';
      $iplocality = '';
      $ipurl = '';
      $ipnote = '';
      $ipemail = '';
      $iptel = '';

    }

    if(($title)) { 
    $info_array['title'] = '<div class="tshowcase-single-title">'.$icontitle.$ipname.get_the_title($id).$divend.'</div>'.$html;
    } 

    if($displaygroups && $tsgroups != '') {

      $info_array['groups'] = '<div class="tshowcase-single-groups">'.$icongroups.$tsgroups.'</div>';

    }

    if($displaytax && $tstax != '') {

      $info_array['taxonomy'] = '<div class="tshowcase-single-taxonomy">'.$icontax.$tstax.'</div>';

    }
	
		if(($position)&& ($tsposition!="")) { 
		$info_array['position'] = "<div class='tshowcase-single-position'>".$iconposition.$iprole.$tsposition.$divend."</div>"; 
		}		
		if(($email) && ($tsemail!="")) { 


			$mailto = isset($options['tshowcase_mailto']);



			if($mailto){ 

				//$tsemail = "<a href='mailto:$tsemail'>$tsemail</a>"; 
				$tsemail = tshowcase_mailto_filter($tsemail);

			} else {

				$tsemail = $tsemail;
			}

			//to avoid spam bots, we replace the @ with with html code
			$tsemail = str_replace("@", "&#64;", $tsemail);

			$info_array['email'] =   "<div class='tshowcase-single-email'>".$iconemail.$tsemail."</div>";

		}
		if(($tel) && ($tstel!="")) { 

      if(isset($options['tshowcase_tellink'])) {

      $tstel = '<a '.$iptel.' href="tel:'.$tstel.'">'.$tstel.'</a>';
      $info_array['telephone'] =   "<div class='tshowcase-single-telephone'>".$icontel.$tstel."</div>";
      
      } else {
        $info_array['telephone'] =   "<div ".$iptel." class='tshowcase-single-telephone'>".$icontel.$tstel."</div>";
      }

		
		}
		
		if(($location) && ($tslocation!="")) { 
    $info_array['location'] = $ipaddress;
		$info_array['location'] .=   "<div class='tshowcase-single-location'>".$iconlocation.$iplocality.$tslocation.$divend.$divend."</div>";
		}
		
		if(($freehtml) && ($tsfreehtml!="")){ 
    $tsfreehtml = do_shortcode($tsfreehtml);  
		$info_array['html'] =  "<div ".$ipnote." class='tshowcase-single-freehtml'>". $iconhtml.$tsfreehtml."</div>";
		
		}
		if(($website) && ($tspersonal!="")) { 
		$tspersonalt = tshowcase_strip_http($tspersonal);

      if($tspersonalanchor != '') {

          $info_array['website'] =   "<div class='tshowcase-single-website'>".$iconpersonal."<a href='".$tspersonal."' ".$ipurl." target='_blank'>".$tspersonalanchor."</a></div>";     


      }

      else {
        $info_array['website'] =   "<div class='tshowcase-single-website'>".$iconpersonal."<a href='".$tspersonal."' ".$ipurl." target='_blank'>".$tspersonalt."</a></div>";     
      }

		
    }
		
		//ordering
		global $ts_content_order;
		foreach ($ts_content_order as $info) {
			if(isset($info_array[$info])) {
			$html.=$info_array[$info];
			}
		}
		
		//Grab other custom fields
		//$html .= '<div>'.get_post_meta( $id, 'your_custom_field_name', true ).'</div>';

    //Display Date
    //$html .= 'Birthday: '.get_the_date('Y-m-d', $id);
		
		//place the title before the info
		//$html = '<div class="tshowcase-single-title">'.get_the_title($id).'</div>'.$html;

    //add a click here link
    //if(!$singular) {$html .= '<a href="'.get_permalink($id).'">Click for more info</a>'; }

    return $html;
		
}

function tshowcase_get_social($id,$show) {
	
		$html="";
		global $ts_social_order;
    global $ts_social_networks;
		
		if($show) {
			
			$options = get_option('tshowcase-settings');		

      $nofollow = '';
      if(isset($options['tshowcase_nofollow'])) {
        $nofollow = "rel='nofollow'";
      }		
		
			$tsemailico = get_post_meta( $id, '_tsemailico', true );

      if($tsemailico!=""){ 

          $options = get_option('tshowcase-settings');
          $mailto = isset($options['tshowcase_mailto']);

          if($mailto){ 

            $tsemailico = tshowcase_mailto_filter_ico($tsemailico);
            $tsemailico = str_replace("@", "&#64;", $tsemailico); 

          } 

      }
			
			$folder = isset($options['tshowcase_single_social_icons']) ? $options['tshowcase_single_social_icons'] : 'font';
			
			$social_array=array();

      //icon images where discontinued, so we make the option revert to 'font'
      if($folder!='font' && $folder!='font-gray'  ) {
        $folder='font';
      }

			if($folder=='font' || $folder=='font-gray'  ) {

				tshowcase_add_smallicons_css();

        $fontsize = isset($options['tshowcase_single_social_icons_size']) ? $options['tshowcase_single_social_icons_size'] : 'fa-lg';

				//other options: 'fa-lg','fa-2x', 'fa-3x' or none '';

        if($tsemailico!=""){ $html .=   "<a href='".$tsemailico."' ".$nofollow." target='_blank'><i class='fa fa-envelope-o ".$fontsize."'></i></a>"; }

        foreach ($ts_social_networks as $snkey => $sn) {
          if(get_post_meta( $id, '_ts'.$sn[0], true )!='') {
            $html .= "<a href='".get_post_meta( $id, '_ts'.$sn[0], true )."' ".$nofollow." target='_blank'><i class='fa ".$sn[2]." ".$fontsize."'></i></a>";
          }
        }

			}

	}
	
	if(isset($folder) && $folder == 'font-gray') {
		$html = '<div class="ts-social-gray">'.$html.'</div>';
	}

	return $html;
	
}




function tshowcase_latest_posts($id) {
		
	$options = get_option('tshowcase-settings');
	$html ="";
	

$tsuser = get_post_meta( $id, '_tsuser', true );
if(isset($options['tshowcase_single_show_posts'])) {
	
	if($tsuser!="0") {	
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'author' => $tsuser,
		'suppress_filters' => true
	);
		
	// The Query
	$tshowcase_posts_query = new WP_Query($args);	
	
	// The Loop
	if($tshowcase_posts_query->have_posts()) {
	
	$title = __('Latest Posts','tshowcase');
	if(isset($options['tshowcase_latest_title'])) {
		$title = $options['tshowcase_latest_title'];
	}	
		
	$html .=   "<h3>".$title."</h3>";
	$html .=   "<ul>";
	while ( $tshowcase_posts_query->have_posts() ) : $tshowcase_posts_query->the_post();
		$html .=   '<li><a href="'.get_permalink().'">' . get_the_title() . '</a></li>';
	endwhile;
	$html .=   "</ul>";
	}
	
	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();
	}
}

return $html;
	
}



// register settings
function register_tshowcase_settings() {
	register_setting( 'tshowcase-plugin-settings', 'tshowcase-settings');
}

//register default values
register_activation_hook(__FILE__, 'tshowcase_defaults');


function tshowcase_defaults() {

	$tmp = get_option('tshowcase-settings');
	
	//check for settings version
    if(!is_array($tmp)) {

		delete_option('tshowcase-settings'); 
		
		$arr = array(	"tshowcase_name_singular" => "Member",
						"tshowcase_name_plural" => "Team",
						"tshowcase_name_slug" => "team",
						"tshowcase_name_category" => "Groups",
            "tshowcase_name_tax2" => "Department",
						"tshowcase_thumb_width" => "160",
						"tshowcase_thumb_height" => "160",
						"tshowcase_thumb_crop" => "false",
						"tshowcase_single_page" => "true", 
						"tshowcase_single_page_style" => "vcard", 
						"tshowcase_single_show_posts" => "false",
						"tshowcase_single_social_icons" => "font",
            "tshowcase_nofollow" => "",
						"tshowcase_empty" => "settings added",
						"tshowcase_twitter_title" => "Latest Tweets", 
						"tshowcase_latest_title" => "Latest Posts",
						"tshowcase_single_show_photo" => "",
						"tshowcase_single_show_social" => "",
						"tshowcase_single_show_position" => "",
						"tshowcase_mailto" => "",
            "tshowcase_tellink" => "",
						"tshowcase_custom_css" => "",
            "tshowcase_custom_js" => "",
						"tshowcase_exclude_from_search" => "true",
            "tshowcase_ajax_pagination" => "true",
						"tshowcase_timg_width" => "50",
						"tshowcase_timg_height" => "50",
						"tshowcase_tpimg_width" => "50",
						"tshowcase_tpimg_height" => "50",					
							
		);
		
		update_option('tshowcase-settings', $arr);
	}
}


//New Icons
$tshowcase_wp_version =  floatval( get_bloginfo( 'version' ) );

if($tshowcase_wp_version >= 3.8) {
	add_action( 'admin_head', 'tshowcase_font_icon' );
}


function tshowcase_font_icon() {
?>

		<style> 
			#adminmenu #menu-posts-tshowcase div.wp-menu-image img { display: none;}
			#adminmenu #menu-posts-tshowcase div.wp-menu-image:before { content: "\f307"; }
		</style>


<?php
}


//Open in page template
add_filter('single_template','tshowcase_single_template');

function tshowcase_single_template($template) {


    $query_object = get_queried_object();
    $page_template = get_post_meta( $query_object->ID, '_tshowcase_page_template', true );

   
    if($page_template!='' && $page_template !='default') { 

        $my_post_type = 'tshowcase';

        //default templates
        $default_templates    = array();
        $default_templates[]  = 'single-{$object->post_type}-{$object->post_name}.php';
        $default_templates[]  = 'single-{$object->post_type}.php';
        $default_templates[]  = 'single.php';

        // apply template to tshowcase pages.
        if ( $query_object->post_type == $my_post_type ) {
            // if the page_template isn't empty, set it as the default_template
            if ( !empty( $page_template ) ) {
                $default_templates = $page_template;
            }
        }

        // locate the template and return it
        $template = locate_template( $default_templates, false );

    }

    else {


          global $post;

          if( !locate_template('single-tshowcase.php') && $post->post_type == 'tshowcase' ) {

              $options = get_option('tshowcase-settings');

                //do we have a default template to choose for events?
                if( isset($options['tshowcase_single_page_template']) && $options['tshowcase_single_page_template'] == 'page' ){
                  $post_templates = array('page.php','index.php');
                }else{

                    $temp_array = isset($options['tshowcase_single_page_template']) ? $options['tshowcase_single_page_template'] : null;
                    $post_templates = array($temp_array);
                }
                if( !empty($post_templates) ){
                    $post_template = locate_template($post_templates,false);
                    if( !empty($post_template) ) $template = $post_template;
                }
              

          }



    }





	return $template;

}

//Build Category Filter
function tshowcase_build_categories_filter($display,$category) {

	global $ts_labels;
	$html = '';
	
			if (in_array('filter',$display)) {
			tshowcase_filter_code();
			$html .= "<ul id='ts-filter-nav'>";
			}
			
			if (in_array('enhance-filter',$display)) {
			tshowcase_enhance_filter_code();
			$html .= "<ul id='ts-enhance-filter-nav'>";
			}

      if (in_array('isotope-filter',$display)) {
      tshowcase_isotope_filter_code();
      $html .= "<ul id='ts-isotope-filter-nav'>";
      }
					
			
			$html .= "<li id='ts-all' data-filter='*'>".__($ts_labels['filter']['all-entries-label'],'tshowcase')."</li>";

			$includecat = array();

			if($category!="" && $category!="0") { 

				 $cats = explode(',',$category);
				 

				 foreach ($cats as $cat) {
				 
				 	$term = get_term_by('slug', $cat, 'tshowcase-categories');
				 	array_push($includecat,$term->term_id);

				 }

				 $args = array(
				 	'include' => $includecat
				 	);

			}

			$args['orderby'] = 'slug';
			$args['order'] = 'ASC';
			$args['parent'] = 0;
			
      $terms = get_terms("tshowcase-categories",$args);

			 $count = count($terms);
			 if ( $count > 0 ){		 
					 foreach ( $terms as $term ) {


					 	//We check for children
					 	$childs = '';

					 	$children_args = array(
						    'orderby'	=> 'slug', 
						    'order'	=> 'ASC',
						    'child_of'	=> $term->term_id); 

					 	$children = get_terms("tshowcase-categories",$children_args);
					 	$children_count = count($children);

					 	if($children_count) {

					 		$childs .= '<ul>';
					 		foreach ( $children as $cterm ) {
					 			$childs .= "<li id='ts-id-".$cterm->term_id."' data-filter='.ts-id-".$cterm->term_id."'>".$cterm->name."</li>";
					 		}

					 		$childs .= '</ul>';

					 	}

					$html .= "<li id='ts-id-".$term->term_id."' data-filter='.ts-id-".$term->term_id."'>".$term->name.$childs."</li>";
					
					}		 
			 }
			$html .= "</ul>";
			

		return $html;

}


function tshowcase_archive_redirect() {
  
    if (is_post_type_archive('tshowcase')) {

        $options = get_option('tshowcase-settings');


        if(isset($options['tshowcase_archive_url']) && $options['tshowcase_archive_url'] != '') {

          $url = $options['tshowcase_archive_url'];
          wp_redirect( $url, 301 ); exit;

        }        
    }
} 


// to redirect the archive page
add_action('template_redirect', 'tshowcase_archive_redirect');



//To change the text on 'Published On'
/*
add_filter( 'gettext', 'ts_filter_published_on', 10000, 2 );
function ts_filter_published_on( $trans, $text ) {

    if( 'Published on: <b>%1$s</b>' == $text ) {
        global $post;
        switch( $post->post_type ) {
            case 'tshowcase': 
                return 'Member Birthday: <strong>%1$s</strong>';
            break;
            default: 
                return $trans;
            break;
        }
    }
    return $trans;
}
*/


/* VISUAL COMPOSER INTEGRATION */


// VISUAL COMPOSER CLASS

class tshowcase_VCExtendAddonClass {
    function __construct() {

        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );

    }

    public function tshowcasetype_output( $settings, $value ) {
         return __("By 'Saving Changes' this will render the saved settings from the Shortcode Generator page.", 'tshowcase'); 
      }
 
    public function integrateWithVC() {
        // Check if Visual Composer is installed
        if ( !defined('WPB_VC_VERSION') || !function_exists('vc_map')) {
            // Display notice that Visual Compser is required
            // add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }


    if(function_exists('vc_map')) {

      if(function_exists('vc_add_shortcode_param')) { 
        vc_add_shortcode_param( 'tshowcasetype', array($this,'tshowcasetype_output') );
      }
      
      
      //widget to display saved shortcode settings
      vc_map( array(
            "name" => __("Team Showcase", 'tshowcase'),
            "description" => __("Insert Team Showcase Layout", 'tshowcase'),
            "base" => "show-team",
            //"class" => "",
            //"front_enqueue_css" => plugins_url('js/visual_composer.css', __FILE__),
            //"front_enqueue_js" => plugins_url('js/visual_composer.js', __FILE__),
            "icon" => plugins_url('img/icon32.png', __FILE__),
            "category" => __('Content', 'js_composer'),
            "params" => array(
                array(
                  "description" => __("To use different settings you should build a unique shortcode and use it on a Text Block.", 'tshowcase'),
                  "type" => "tshowcasetype",
                  "param_name" => __("visual_composer_team_build",'tshowcase'),
                  "value" => 'true'
              )
            )
          ));
          //end vc_map

      //widget to display search form
      vc_map( array(
            "name" => __('Team Showcase Search','tshowcase'),
            "description" => __("Insert Team Search Form", 'tshowcase'),
            "base" => "show-team-search",
            "class" => "",
            //"front_enqueue_css" => plugins_url('includes/visual_composer.css', __FILE__),
            "front_enqueue_js" => plugins_url('includes/visual_composer.js', __FILE__),
            "icon" => plugins_url('images/icon32.png', __FILE__),
            "category" => __('Content', 'js_composer'),
            "params" => array(
                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Category Filter", 'tshowcase'),
                  "param_name" => "filter",
                  "value" => array(
                    'No' => 'false',
                    'Yes' => 'true',
                    ),
                  "description" => __("Display a category dropdown", 'tshowcase')
              ),

                 array(
                  "admin_label" => true,
                  "type" => "textfield",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Results URL", 'lshowcase'),
                  "param_name" => "url",
                  "value" => '',
                  "description" => __("URL to open to process the layout with the results. The results page should have a team showcase shortcode.", 'tshowcase')
              ),

                


            ),
           
          ));



    }

        
    }
}
// Finally initialize code
new tshowcase_VCExtendAddonClass();


//to search only on title field
add_filter( 'posts_search', 'tshowcase_search_by_title_only', 500, 2 );
function tshowcase_search_by_title_only( $search, &$wp_query )
{
    global $wpdb;

    $type = $wp_query->query_vars;

    if(isset($type['post_type']) && $type['post_type']=='tshowcase') {

      if ( empty( $search ) )
          return $search; // skip processing - no search term in query

      $q = $wp_query->query_vars;    
      $n = ! empty( $q['exact'] ) ? '' : '%';

      $search =
      $searchand = '';

      foreach ( (array) $q['search_terms'] as $term ) {
          $term = esc_sql( $wpdb->esc_like( $term ) );
          $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
          $searchand = ' AND ';
      }

      if ( ! empty( $search ) ) {
          $search = " AND ({$search}) ";
          if ( ! is_user_logged_in() )
              $search .= " AND ($wpdb->posts.post_password = '') ";
      }

      return $search;
    } 

    else {
    
      return $search;
    
    }
}


/* PAGE TEMPLATES APPLYED INDIVIDUALLY TO TEAM MEMBER ENTRIES */

function tshowcase_template_metabox() {
  add_meta_box(
    'tshowcase_template_metabox'
    , __( 'Page Template', 'tshowcase' )
    , 'tshowcase_metabox_markup'
    , 'tshowcase'
    , 'side'
    , 'core'
  );
}
add_action( 'add_meta_boxes', 'tshowcase_template_metabox' );


/* Markup to build Metabox */

function tshowcase_metabox_markup( $post ) {
    
    wp_nonce_field( basename(__FILE__), 'tshowcase_template_meta_nonce' );
    $current_template = get_post_meta( $post->ID, '_tshowcase_page_template', true);
    $template_options = get_page_templates();
    $box_label = '<label for="_tshowcase_page_template">'.__('Page Template','tshowcase').'</label>';
    $box_select = '<select name="_tshowcase_page_template">';
    $box_default_option = '<option value="default">'.__('Default','tshowcase').'</option>';
    $box_options = '';

    foreach (  $template_options as $name=>$file ) {
        if ( $current_template == $file ) {
            $box_options .= '<option value="' . $file . '" selected="selected">' . $name . '</option>';
        } else {
            $box_options .= '<option value="' . $file . '">' . $name . '</option>';
        }
    }

    echo $box_label;
    echo $box_select;
    echo $box_default_option;
    echo $box_options;
    echo '</select>';

}


/* Save the data */

function tshowcase_metabox_save( $post_id ) {
    $current_nonce = isset($_POST['tshowcase_template_meta_nonce']) ? $_POST['tshowcase_template_meta_nonce'] : '';
    $is_autosaving = wp_is_post_autosave( $post_id );
    $is_revision   = wp_is_post_revision( $post_id );
    $valid_nonce   = ( isset( $current_nonce ) && wp_verify_nonce( $current_nonce, basename( __FILE__ ) ) ) ? 'true' : 'false';


    if ( $is_autosaving || $is_revision || !$valid_nonce ) {
        return;
    }

    $cpt_page_template = isset($_POST['_tshowcase_page_template']) ? $_POST['_tshowcase_page_template'] : '';
    update_post_meta( $post_id, '_tshowcase_page_template', $cpt_page_template );
}
add_action( 'save_post', 'tshowcase_metabox_save' );




/* Shortcode to get a list of the team entries and associated users - useful to debug */

add_shortcode('show-team-users', 'tshowcase_user_matches');

function tshowcase_user_matches() {

       $html = '<ul>';

      //arguments for the team entries query
      $tsargs = array(
        'post_type' => 'tshowcase'
      );

      //perform the query
      $ts_query = new WP_Query( $tsargs );

      //loop them
      if ( $ts_query->have_posts() ) {

       while ( $ts_query->have_posts() ) : $ts_query->the_post();

         $user_id = get_post_meta( get_the_ID(), '_tsuser', true );

         if($user_id == '0') {
              
              $user_info = 'No User Associated';

         } else {

              $user_array = get_users( array( 'include' => array(intval($user_id)) ) );

              foreach ( $user_array as $user ) {
                $user_info = $user->display_name .' (User ID = '.$user->ID.')';
              }

         }

         $html .=   '<li><a href="'.get_permalink().'">' . get_the_title() . '</a> > '.$user_info. '</li>';
      
      endwhile;

        
      }
      /* Restore original Post Data */
      wp_reset_postdata();

      $html .= '</ul>';

      return $html;
}


function set_tshowcase_order($wp_query) {

    global $pagenow;
 
    // Get the post type from the query
    $post_type = isset($wp_query->query['post_type']) ? $wp_query->query['post_type'] : false;

    if ( is_admin() && is_post_type_archive( 'tshowcase' ) && isset($post_type) && $post_type == 'tshowcase' ) {

      // 'orderby' value can be any column name
      $wp_query->set('orderby', 'menu_order');

      // 'order' value can be ASC or DESC
      $wp_query->set('order', 'ASC');
    }
  
}
add_filter('pre_get_posts', 'set_tshowcase_order');

add_shortcode('show-team-count', 'tshowcase_team_count');
function tshowcase_team_count() { $count = wp_count_posts('tshowcase'); return $count->publish; }


//Use a custom order, by custom meta field, for example
function set_tshowcase_custom_order($wp_query) {

    
    $post_type = isset($wp_query->query['post_type']) ? $wp_query->query['post_type'] : false;

    if ( $post_type == 'tshowcase' ) {

      // 'orderby' value can be any column name
      $wp_query->set('meta_key', '_tsposition');
      $wp_query->set('orderby', 'meta_value');
      $wp_query->set('order', 'DESC');
    }
  
}
//add_filter('pre_get_posts', 'set_tshowcase_custom_order',99);


/* Shortcode to get custom meta from current user */
add_shortcode('show-team-info', 'tshowcase_member_info');
function tshowcase_member_info($atts) {
      global $post;
      return get_post_meta( $post->ID, '_ts'.$atts['field'], true );
}




/* Hook to redirect single page to user page if associated */

add_filter( 'author_link', 'tshowcase_force_author_link', 10, 2);
function tshowcase_force_author_link($link,$author_id) {
  
    $args = array(
       'post_type' => 'tshowcase',
       'meta_key'   => '_tsuser',
        'meta_value' => $author_id,
        'posts_per_page' => 1
    );

    $the_query = get_posts($args);
    if(count($the_query==1)) {

      foreach ( $the_query as $post ) {
       $link = get_permalink($post->ID);
      }

    }
    

    return $link;
}




?>