<?php 

function mythology_register_menus() {
   /* Register Navigation */
    register_nav_menus( array(
    'primary_menu' => __( 'Primary Menu', 'mythology' ),
    'secondary_menu' => __( 'Secondary (Tophat) Menu', 'mythology' ),
    'sticky_menu' => __( 'Sticky Header Menu', 'mythology' ),
    'responsive_menu' => __( 'Mobile Menu', 'mythology' )
  ) );
}
add_action('init', 'mythology_register_menus'); /* Run the above function at the init() hook */


function responsive_menu_plugin_check() {
  if ( is_plugin_active( 'responsive-menu/responsive-menu.php' ) ) {
    //plugin is activated
    add_action('admin_enqueue_scripts','load_my_script');
    function load_my_script() {
      global $pagenow;
      if ( $pagenow == 'nav-menus.php') {
        wp_enqueue_script('jquery');
        wp_register_script( 'doc-helper', get_template_directory_uri() . '/theme-core/theme-functions/doc.helpers/js/responsive-menu-active.js', false, null, true);
        wp_enqueue_script( 'doc-helper' );
      }
    }

  } else {

    add_action('admin_enqueue_scripts','load_my_script');
    function load_my_script() {
      global $pagenow;
      if ( $pagenow == 'nav-menus.php') {
        wp_enqueue_script('jquery');
        wp_register_script( 'doc-helper', get_template_directory_uri() . '/theme-core/theme-functions/doc.helpers/js/responsive-menu-inactive.js', false, null, true);
        wp_enqueue_script( 'doc-helper' );
      }
    }
  }
}
add_action( 'admin_init', 'responsive_menu_plugin_check' );


/* ---------------------------------------------------------*/
/* NAVIGATION WALKER - DESKTOP (allows for description) */ 
/* ---------------------------------------------------------
class mythology_walker extends Walker_Nav_Menu
{
      //function start_el(&$output, $item, $depth, $args){
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li data-uk-dropdown="" title="'. $item->title . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<div class="menu-item-title">';
           $append = '</div>';
           $description  = ! empty( $item->description ) ? '<div class="menu-item-subtitle small">'.esc_attr( $item->description ).'</div>' : '';

           if($depth != 0)
           {
              $description = $append = $prepend = "";
           } 

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'><span>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</span></a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
*/



/* ---------------------------------------------------------*/
/* MOBILE WALKER - MOBILE */ 
/* ---------------------------------------------------------*/
class mobile_walker extends Walker_Nav_Menu
{
      //function start_el(&$output, $item, $depth, $args){
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';
           
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li title="'. $item->title . '"' . $value . $class_names .'>';
      
           $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
           
           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
                   
           $prepend = '<div class="top sans">';
           $append = '</div>';
           
           $description  = ! empty( $item->title ) ? '<div class="bottom">'.esc_attr( $item->attr_title ).'</div>' : '';     
               
           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }           

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function start_lvl(&$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);    
      
        $output .= "\n$indent<ul class=\"dl-submenu level-".$depth."\"><li class=\"dl-back\"><a href=\"#\">Back</a></li>";        
      $output .= "\n";
    }
}

?>