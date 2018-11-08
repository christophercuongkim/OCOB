<?php

if (!class_exists('CoolTimelinePosttype')) {

    class CoolTimelinePosttype {

        /**
         * The Constructor
         */
        public function __construct() {
            // register actions
            add_action('init', array($this, 'cooltimeline_custom_post_type'));

            if(is_admin()){
            add_filter('manage_edit-cool_timeline_columns', array($this, 'add_new_cool_timeline_columns'));
            add_action('manage_cool_timeline_posts_custom_column', array($this, 'custom_columns'), 10, 2);
             add_action( 'wp_ajax_ctl_change_story_order',  array($this, 'ctl_change_story_order' ));
             }

            add_action('init', array($this, 'ctl_taxonomy'), 0);
             add_action('init', array($this, 'ctl_insert_category'), 0);
            add_action('init', array($this, 'add_custom_rewrite_rule'));
            add_action( 'save_post_cool_timeline',array($this,'mfields_set_default_object_terms' ),100 ,2);
     
            add_action( 'template_redirect',array($this,'ctl_template_redirect') );

            add_filter('parse_query',array($this, 'tsm_convert_id_to_term_in_query'));
            add_action('restrict_manage_posts',array($this, 'tsm_filter_post_type_by_taxonomy'));
            

        }

        // END public function __construct())
       
        // Register Custom Post Type
        function cooltimeline_custom_post_type() {

            $labels = array(
                'name' => _x('Timeline Stories', 'Post Type General Name', 'cool-timeline'),
                'singular_name' => _x('Timeline Stories', 'Post Type Singular Name', 'cool-timeline'),
                'menu_name' => __('Timeline Stories', 'cool-timeline'),
                'name_admin_bar' => __('Timeline Stories', 'cool-timeline'),
                'parent_item_colon' => __('Parent Item:', 'cool-timeline'),
                'all_items' => __('All Stories', 'cool-timeline'),
                'add_new_item' => __('Add New Story', 'cool-timeline'),
                'add_new' => __('Add New', 'cool-timeline'),
                'new_item' => __('New Story', 'cool-timeline'),
                'edit_item' => __('Edit Story', 'cool-timeline'),
                'update_item' => __('Update Story', 'cool-timeline'),
                'view_item' => __('View Story', 'cool-timeline'),
                'search_items' => __('Search Story', 'cool-timeline'),
                'not_found' => __('Not found', 'cool-timeline'),
                'not_found_in_trash' => __('Not found in Trash', 'cool-timeline'),
            );

             $ctl_options_arr = get_option('cool_timeline_options');
                if(isset($ctl_options_arr['post_type_slug']) && !empty($ctl_options_arr['post_type_slug']))
                   {
                    $slug_arr=array('slug' =>$ctl_options_arr['post_type_slug']);
                   } else{
                     $slug_arr=array('slug' => 'timeline');
                   }
               
            $args = array(
                'label' => __('cool-timeline', 'cool-timeline'),
                'description' => __('Timeline Post Type Description', 'cool-timeline'),
                'labels' => $labels,
                'supports' => array('title', 'editor', 'thumbnail', 'author'),
                'taxonomies' => array(),
                'hierarchical' => false,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'can_export' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'rewrite' =>$slug_arr ,
                'menu_icon'=>CTP_PLUGIN_URL.'/images/timeline-icon-222.png',
            );
            register_post_type('cool_timeline', $args);
        }

        // Register Custom Taxonomy
        function ctl_taxonomy() {

            $labels = array(
                'name' => _x('Categories', 'Taxonomy General Name', 'cool-timeline'),
                'singular_name' => _x('Category', 'Taxonomy Singular Name', 'cool-timeline'),
                'menu_name' => __('Categories', 'cool-timeline'),
                'all_items' => __('All Items', 'cool-timeline'),
                'parent_item' => __('Parent Item', 'cool-timeline'),
                'parent_item_colon' => __('Parent Item:', 'cool-timeline'),
                'new_item_name' => __('New Item Name', 'cool-timeline'),
                'add_new_item' => __('Add New Item', 'cool-timeline'),
                'edit_item' => __('Edit Item', 'cool-timeline'),
                'update_item' => __('Update Item', 'cool-timeline'),
                'view_item' => __('View Item', 'cool-timeline'),
                'separate_items_with_commas' => __('Separate items with commas', 'cool-timeline'),
                'add_or_remove_items' => __('Add or remove items', 'cool-timeline'),
                'choose_from_most_used' => __('Choose from the most used', 'cool-timeline'),
                'popular_items' => __('Popular Items', 'cool-timeline'),
                'search_items' => __('Search Items', 'cool-timeline'),
                'not_found' => __('Not Found', 'cool-timeline'),
                'no_terms' => __('No items', 'cool-timeline'),
                'items_list' => __('Items list', 'cool-timeline'),
                'items_list_navigation' => __('Items list navigation', 'cool-timeline'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'query_var' => true,
                    //'rewrite'               => array( 'slug' => 'categories' ),
            );
            register_taxonomy('ctl-stories', array('cool_timeline'), $args);
        }

        // insert default category
        public function ctl_insert_category() {
        if(!term_exists( 'timeline-stories', 'ctl-stories' )){
         $r=   wp_insert_term(
                    'Timeline Stories', // the term 
                    'ctl-stories', // the taxonomy
                    array(
                'description' => 'All timeline stories.',
                'slug' => 'timeline-stories',
               // 'parent' => 0
                    ) );
          }
        }

        function mfields_set_default_object_terms($post_id, $post) {
          if ('cool_timeline' === $post->post_type) {
             if ('publish' === $post->post_status) {
                    $defaults = array(
                        'ctl-stories' => array('timeline-stories')
                    );
                    $taxonomies = get_object_taxonomies($post->post_type);
                    foreach ((array) $taxonomies as $taxonomy) {
                        $terms = wp_get_post_terms($post_id, $taxonomy);
                        if (empty($terms) && array_key_exists($taxonomy, $defaults)) {
                            wp_set_object_terms($post_id, $defaults[$taxonomy], $taxonomy);
                        }
                    }
                }
            }
        }

        // register custom column for timeline stories 
        function add_new_cool_timeline_columns($gallery_columns) {
            $new_columns['cb'] = '<input type="checkbox" />';

            $new_columns['title'] = _x('Story Title', 'column name', 'cool-timeline');
           $new_columns['category'] = _x('Story Category', 'column name', 'cool-timeline');
            $new_columns['year'] = __('Story Year', 'cool-timeline');
            $new_columns['story_date'] = __('Story Date','cool-timeline');
        
           // $new_columns['images'] = __('Story Format', 'cool-timeline');
            $new_columns['label'] = __('Story Custom Label','cool-timeline');
            $new_columns['order'] = __('Story Custom Order','cool-timeline');
          //  $new_columns['date'] = _x('Published Date', 'column name', 'cool-timeline');
            return $new_columns;
        }

        // columns handler funciton
        function custom_columns($column, $post_id) {
         global   $post ;
          $story_based_on = get_post_meta($post_id, 'story_based_on', true);
          $story_format = get_post_meta($post_id, 'story_format', true);

            switch ($column) {
                 case "year":
                    if( $story_based_on=="default"){
                     $posted_year = get_post_meta($post_id, 'ctl_story_year', true);
                     echo"<p><strong>" . $posted_year . "</strong></p>";
                     }
                     break;

                    case "story_date":
                     if( $story_based_on=="default"){
                         $story_based_on = get_post_meta($post_id, 'story_based_on', true);
                         $ctl_story_date = get_post_meta($post_id, 'ctl_story_date', true);
                         echo"<p><strong>" . $ctl_story_date . "</strong></p>";
                    }
                    break;
                  case "label":
                  if($story_based_on=="custom"){
                         $ctl_story_lbl = get_post_meta($post_id, 'ctl_story_lbl', true);
                     echo"<p><strong>".$ctl_story_lbl."</strong></p>";
                    }
                  break;   
                case "order":
                  if($story_based_on=="custom"){
                     $ctl_story_order = get_post_meta($post_id, 'ctl_story_order', true);
                     echo'<div class="quick-order-update"><input size="5" value="'.$ctl_story_order.'" type="text" data-id="#pld-'.$post_id.'" name="clt_story_order" class="custom_story_order" data-post-id="'.$post_id.'"><img style="width:16px;display:none;margin-left:5px;" class="od_preloader" id="pld-'.$post_id.'" src="'.CTP_PLUGIN_URL.'images/order-preloader.gif"></div>';
                    }
                  break;
                /* If displaying the 'genre' column. */
                case 'category' :

                    /* Get the genres for the post. */
                    $terms = get_the_terms( $post_id, 'ctl-stories' );

                    /* If terms were found. */
                    if ( !empty( $terms ) ) {

                        $out = array();

                        /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                        foreach ( $terms as $term ) {
                            $out[] = sprintf( '<a href="%s">%s</a>',
                                esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'ctl-stories' => $term->slug ), 'edit.php' ) ),
                                esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'ctl-stories', 'display' ) )
                            );
                        }

                        /* Join the terms, separating them with a comma. */
                        echo join( ', ', $out );
                    }

                    /* If no terms were found, output a default message. */
                    else {
                        _e( '' );
                    }
                    break;
            }
        }

    function ctl_change_story_order() {
        $new_order = intval( $_POST['order'] );
        $p_id = intval( $_POST['post_id'] );
          if($new_order && $p_id){
           $rs= update_post_meta($p_id, 'ctl_story_order', $new_order);
          if($rs){
            echo json_encode(array('success'=>'true'));
          }else{
            echo json_encode(array('success'=>'false'));
          }
      }else{
            echo json_encode(array('success'=>'false'));
          }
          wp_die(); // this is required to terminate immediately and return a proper response
    }


        function add_custom_rewrite_rule() {

            // First, try to load up the rewrite rules. We do this just in case
            // the default permalink structure is being used.
            if (($current_rules = get_option('rewrite_rules'))) {

                // Next, iterate through each custom rule adding a new rule
                // that replaces 'movies' with 'films' and give it a higher
                // priority than the existing rule.
                $ctl_options_arr = get_option('cool_timeline_options');
                if(isset($ctl_options_arr['post_type_slug']) && !empty($ctl_options_arr['post_type_slug']))
                   {
                    $c_slug=$ctl_options_arr['post_type_slug'];
                   } else{
                     $c_slug='timeline';
                   }


                foreach ($current_rules as $key => $val) {
                    if (strpos($key, 'cool_timeline') !== false) {
                        add_rewrite_rule(str_ireplace('cool_timeline',$c_slug, $key), $val, 'top');
                    } // end if
                } // end foreach
            } // end if/else
            // ...and we flush the rules
            flush_rewrite_rules();
        }

        function ctl_template_redirect()
        {
            if(is_post_type_archive('cool_timeline' ))
            {
                wp_redirect( home_url( '/' ) );
                exit();
            }
        }
       
        
// end add_custom_rewrite_rule


    /**
     * Display a custom taxonomy dropdown in admin
     * @author coolhappy
     *
     */

    function tsm_filter_post_type_by_taxonomy() {
        global $typenow;
        $post_type = 'cool_timeline'; // change to your post type
        $taxonomy  = 'ctl-stories'; // change to your taxonomy
        if ($typenow == $post_type) {
            $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
            $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' => __("Show All {$info_taxonomy->label}"),
                'taxonomy'        => $taxonomy,
                'name'            => $taxonomy,
                'orderby'         => 'name',
                'selected'        => $selected,
                'show_count'      => true,
                'hide_empty'      => true,
            ));
        };
    }



    /**
     * Filter posts by taxonomy in admin
     * @author  coolhappy
     *
     */

    function tsm_convert_id_to_term_in_query($query) {
        global $pagenow;
        $post_type = 'cool_timeline'; // change to your post type
        $taxonomy  = 'ctl-stories'; // change to your taxonomy
        $q_vars    = &$query->query_vars;
        if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }


    } //class end

} // main



