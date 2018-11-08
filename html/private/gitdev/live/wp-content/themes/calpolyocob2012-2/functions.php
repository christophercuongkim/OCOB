<?php
class CPThemeOptions
{
  var $root_blog_id;
  var $debug_show_bid_footer;
}
$cpto = new CPThemeOptions();
/**
 *  THEME OPTIONS
 */
// Root BLOG ID (Default is 25)
$cpto->root_blog_id = 1;

// News / Events BLOG ID (Default is 26)
$cpto->news_blog_id = 26;
// News Category ID
$cpto->news_cat = 3;
// Events Category ID
$cpto->events_cat = 4;

// Academic Areas
$cpto->academic_areas_blog_id = 27;

// Undergrad
$cpto->undergraduate_blog_id = 28;

// Advising
$cpto->advising_blog_id = 29;

// About
$cpto->about_blog_id = 30;

// Outreach
$cpto->outreach_blog_id = 31;



/**
*   DEBUGGING OPTIONS
*/
//Show BLOGID in Footer
$cpto->debug_show_bid_footer = true;



/**
 *   Registration
 */
 
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
add_theme_support( 'menus' );
 
  if(function_exists('register_sidebar'))
    register_sidebar(array(
    'name' => __( 'Main Sidebar', 'calpolyocob2012' ),
    'id' => 'sidebar-widget-area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    ));

add_image_size( 'post-headerimage', 730, 200, true );

register_nav_menu( 'toplinksmenu', 'Top Links' );
register_nav_menu( 'mainmenulinks', 'Main Menu' ); // New Header menu
register_nav_menu( 'footer', 'Footer Navigation' );
register_nav_menu( 'sidebar', 'Sidebar Navigation' );
register_nav_menu( 'quicklinks', 'Quick Links' );

register_sidebar( array(
  'name' => __( 'First Footer Widget Area', 'calpolyocob2012' ),
  'id' => 'first-footer-widget-area',
  'description' => __( 'The first footer widget area', 'calpolyocob2012' ),
  'before_widget' => '<div class="widget">',//'<li id="%1$s" class="widget-container %2$s">',
  'after_widget' =>  '</div>', //'</li>',
  'before_title' => '<h2>',
  'after_title' =>  '</h2>',
) );

register_sidebar( array(
  'name' => __( 'Second Footer Widget Area', 'calpolyocob2012' ),
  'id' => 'second-footer-widget-area',
  'description' => __( 'The second footer widget area', 'calpolyocob2012' ),
  'before_widget' => '<div class="widget">',//'<li id="%1$s" class="widget-container %2$s">',
  'after_widget' =>  '</div>', //'</li>',
  'before_title' => '<h2>',
  'after_title' =>  '</h2>',
) );

register_sidebar( array(
  'name' => __( 'Third Footer Widget Area', 'calpolyocob2012' ),
  'id' => 'third-footer-widget-area',
  'description' => __( 'The third footer widget area', 'calpolyocob2012' ),
  'before_widget' => '<div class="widget">',//'<li id="%1$s" class="widget-container %2$s">',
  'after_widget' =>  '</div>', //'</li>',
  'before_title' => '<h2>',
  'after_title' =>  '</h2>',
) );

register_sidebar( array(
  'name' => __( 'Fourth Footer Widget Area', 'calpolyocob2012' ),
  'id' => 'fourth-footer-widget-area',
  'description' => __( 'The fourth footer widget area', 'calpolyocob2012' ),
  'before_widget' => '<div class="widget">',//'<li id="%1$s" class="widget-container %2$s">',
  'after_widget' =>  '</div>', //'</li>',
  'before_title' => '<h2>',
  'after_title' =>  '</h2>',
) );

register_sidebar( array(
  'name' => __( 'Fifth Footer Widget Area', 'calpolyocob2012' ),
  'id' => 'fifth-footer-widget-area',
  'description' => __( 'The fifth footer widget area', 'calpolyocob2012' ),
  'before_widget' => '<div class="widget">',//'<li id="%1$s" class="widget-container %2$s">',
  'after_widget' =>  '</div>', //'</li>',
  'before_title' => '<h2>',
  'after_title' =>  '</h2>',
) );
    
/**
 *    Custom Post Types
 */
 //Only show for Directory sub blog
 if(get_current_blog_id() == 39) {
	add_action( 'init', 'create_post_type_directory' );
 }
function create_post_type_directory() {
    register_post_type( 'faculty_profile',
        array(
            'labels' => array(
                'name' => __( 'Faculty Profiles' ),
                'singular_name' => __( 'Profile' ),
				'edit_item' => "Edit Profile",
				'view_item' => "View Profile",
				'new_item' => "New Profile"
            ),
        'taxonomies' => array('category'), 
		'show_ui' => true,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'profile'),
		'capability_type' => 'post',
		'menu_icon' => 'dashicons-id-alt'
        )
    );
	
}	

function change_post_menu_label_handbook() {
global $menu;
global $submenu;
$menu[5][0] = 'Handbook Entry';
$submenu['edit.php'][5][0] = 'Entry';
$submenu['edit.php'][10][0] = 'New Entry';
$submenu['edit.php'][16][0] = 'Entry Tags';
echo '';
}
function change_post_object_label_handbook() {
global $wp_post_types;
$labels = &$wp_post_types['post']->labels;
$labels->name = 'Entry';
$labels->singular_name = 'Entry';
$labels->add_new = 'New Entry';
$labels->add_new_item = 'New Entry';
$labels->edit_item = 'Edit Entry';
$labels->new_item = 'New Entry';
$labels->view_item = 'View Entry';
$labels->search_items = 'Search Entry';
$labels->name_admin_bar = 'Handbook Entry';
$labels->not_found = 'Not found';
$labels->not_found_in_trash = 'Not found in trash';
 }
if(get_current_blog_id() == 40) {
	 add_action( 'init', 'change_post_object_label_handbook' );
	add_action( 'admin_menu', 'change_post_menu_label_handbook' );
 }


    
/**
 *  Functions
 */
    
function megaMenuBox($parent, $double)    
{
  return 0;
}
    
function the_breadcrumb() {
echo ' menu ';
  /*if (!is_home()) {
    echo '<a href="';
    echo get_option('home');
    echo '">';
    echo 'Home'
    //bloginfo('name');
    echo "</a> : ";
    if (is_category() || is_single()) {
      the_category('title_li=');
      if (is_single()) {
        echo " : ";
        the_title();
      }
    } elseif (is_page()) {
      echo the_title();
    }
  }*/
}

/***********************************************************
* wsf_breadcrumbs() - Shows breadcrumbs in template
***********************************************************/
function wsf_breadcrumbs( $sep = '/', $label = 'Browsing' ) {
  global $cpto;
  global $post;


  // Create a constant for the separator, with space padding.
  $SEP = ' ' . $sep . ' ';
  $SEP2 = ' ' . $sep . ' ';
  
   // Do not show breadcrumbs on home or front pages.
   // So we will just return quickly (unless we're not root blog)
     if((is_home() || is_front_page()) && (!$front_page))
     {
      if(get_current_blog_id() == $cpto->root_blog_id)
        return;
      else
        $SEP2 = '';
    }

  echo '<div id="breadcrumb">';
  echo $label . ' ';
  if(get_current_blog_id() != $cpto->root_blog_id)
  {
  switch_to_blog($cpto->root_blog_id);
  echo wsf_make_link( get_bloginfo('url'), 'Home', get_bloginfo('name'), true ) . $SEP;
  restore_current_blog();
  echo wsf_make_link( get_bloginfo('url'), get_bloginfo('name'),'', true ) . $SEP2;
  }
  else
  {
  echo wsf_make_link( get_bloginfo('url'), 'Home', get_bloginfo('name'), true ) . $SEP;
  }
  
  if(is_single()) {
    the_category(', '); 
    echo $SEP;
   // Wordpess function that echoes your post title.
    the_title();
  }
  elseif(is_page()) 
  {
    $parent_id = $post->post_parent;
  $parents = array();
  while($parent_id) {
    $page = get_page($parent_id);
    $parents[]  = wsf_make_link( get_permalink($page->ID), get_the_title($page->ID) ) . $SEP;
    $parent_id  = $page->post_parent;
  }
  $parents = array_reverse($parents);
  foreach($parents as $parent) {
    echo $parent;
   }
   // Wordpess function that echoes your post title.
  //echo $SEP;
  if(!is_front_page())
  the_title();
  
  }elseif(is_category())
  {
    single_cat_title();
  }
  echo '</div>

';
}

/***********************************************************
* Helper Functions for template coding
***********************************************************/
function wsf_make_link ( $url, $anchortext, $title=null, $nofollow=false ) {
   if ( $title == null ) $title=$anchortext;
   $nofollow==true ? $rel=' rel="nofollow"' : $rel = ''; 

   $link = sprintf( '<a href="%s" title="%s" %s="">%s</a>', $url, $title, $rel, $anchortext );
   return $link;
}


function inner_doc_nav($content, $custom, $string = false)
{
  $xtra = '';
  if(isset($custom) && isset($custom['content_nav']) && !$string)
  {
    $xtra = $custom['content_nav'][0];
  }else if($string){
    $xtra = $custom;
  } else if($custom['using_custom_inner_nav'][0]) {
	  $xtra = '<!-- #BeginEditable "Table Of Contents" -->';
	  $xtra .= '<h2><strong>'.get_the_title().'</strong></h2>';
	  $xtra .= '<p>';
	  if($custom["location"][0])
	  $xtra .= '<span class="grey">Location</span> '.$custom["location"][0].'<br/>';
	  if($custom["phone"][0])
	  $xtra .= '<span class="grey">Phone</span> '.$custom["phone"][0].'</br>';
	  if($custom["fax"][0])
	  $xtra .= '<span class="grey">Fax</span> '.$custom["fax"][0].'</br>';
	  if($custom["addition_contact"][0])
	  $xtra .= $custom["addition_contact"][0].'</br>';
	  $xtra .= '</p>';
	  if($custom["email"][0])
	  $xtra .= '<p><a href="mailto:'.$custom["email"][0].'" target="_blank">'.$custom["email"][0].'</a></p>';
	  if($custom["hours"][0]) {
		  $xtra .= '<h2>'.$custom["custom_hours_header"][0].'</h2>';
		  $xtra .= '<p>';
		  //$xtra .= '<span class="grey">';
		  $xtra .= $custom["hours"][0];
		  $xtra .= '</p>';
	  }
	  $xtra = str_replace(array("\r\n","\r","\n"),'<br>', $xtra);
	  if($custom["custom_html"][0])
	  $xtra .= '<p>'.$custom["custom_html"][0].'</p>';
  }
  
  // Create side menu automatically for h2 tags
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $class = "[a-zA-Z0-9=#\"'_\- .,?;&/]";
  $class2 = "[a-zA-Z0-9=#\"'_\- .,?;&/<>]";
  $pattern = "%<h2\s$class*id\s*=\s*\"($class+)\"\s*$class*>($class2*)</(\s)*h2(\s)*>%";
  $match_count = preg_match_all ($pattern , $content, $match_out);
  $doc_nav = '';
  if($match_count > 1 || $xtra != '')
  {
    $doc_nav = '
      <div id="contentNav">
        <div id="contentNavInner">
          '.$xtra;
    if($match_count > 1 && $xtra == ''){
      $doc_nav .= '<h2>In this section:</h2>
            <ul>';
              for($i = 0; $i < $match_count; $i++)
              {
      $doc_nav .= "\t";
      $doc_nav .= '<li><a href="#'.$match_out[1][$i].'">'.strip_tags($match_out[2][$i]).'</a></li>';
      $doc_nav .= "\n";
              }
      $doc_nav .='
            </ul>';
    }
    $doc_nav .='</div>
      </div>  ';
    $doc_nav .='<div id="mainLeft">';
  }
  else
  {
    $doc_nav = '<div id="mainLeftFull">';  
  }
  return $doc_nav;
}

function posts_orderby_lastname ($orderby_statement) 
{
	global $wpdb;
  $orderby_statement = $wpdb->postmeta . ".meta_value ASC, RIGHT(post_title, LOCATE(' ', REVERSE(post_title)) - 1) ASC";
    return $orderby_statement;
}
?>
