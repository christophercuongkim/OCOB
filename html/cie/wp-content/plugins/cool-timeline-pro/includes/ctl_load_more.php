<?php

add_action( 'wp_ajax_ctl_ajax_load_more', 'ctl_ajax_load_more_handler' );
add_action( 'wp_ajax_nopriv_ctl_ajax_load_more', 'ctl_ajax_load_more_handler' );

add_action( 'wp_ajax_ct_ajax_load_more', 'ct_ajax_load_more_handler' );
add_action( 'wp_ajax_nopriv_ct_ajax_load_more', 'ct_ajax_load_more_handler' );

add_action( 'wp_ajax_ct_cat_filters', 'ct_cat_filters_handler' );
add_action( 'wp_ajax_nopriv_ct_cat_filters', 'ct_cat_filters_handler' );

add_action( 'wp_ajax_st_cat_filters', 'st_cat_filters_handler' );
add_action( 'wp_ajax_nopriv_st_cat_filters', 'st_cat_filters_handler' );
function ctl_ajax_load_more_handler() {

     require(CTP_PLUGIN_DIR.'/includes/cool_timeline_custom_styles.php');
    $last_year = isset( $_POST['last_year'] )? $_POST['last_year']:0;
    $alternate = isset( $_POST['alternate'] )? $_POST['alternate']:0; 
    $attribute = isset( $_POST['attribute'] ) ? array_map( 'esc_attr', $_POST['attribute'] ) : array();
    if($attribute['designs'])
    {
        $design_cls='main-'.$attribute['designs'];
        $design=$attribute['designs'];
    }else{
        $gn_cls='main-default';
        $design='default';
    }
    $output = ''; $ctl_html = '';$ctl_format_html = ''; $ctl_animation='';
    $ctl_avtar_html = '';  $timeline_id = ''; $clt_icons='';

    $layout=$attribute['layout'] ?$attribute['layout']:'default';
  
    if (isset($attribute['animations'])) {
        $ctl_animation=$attribute['animations'];
    }else if($attribute['animation']){
        $ctl_animation=$attribute['animation'];
    }else{
        $ctl_animation ='bounceInUp';
    }
    if (isset($attribute['icons']) && $attribute['icons']=="YES"){
        $clt_icons='icons_yes';
    }else{
        $clt_icons='icons_no';
    }

    require(CTP_PLUGIN_DIR.'/includes/common-query.php');
    $args['paged']=esc_attr( $_POST['page'] );
    require(CTP_PLUGIN_DIR.'/includes/views/default.php');

    wp_send_json_success( $ctl_html );
    wp_die();
}

function ct_ajax_load_more_handler() {
     $ctl_html='';
    $last_year = isset( $_POST['last_year'] )? $_POST['last_year']:0;
    $alternate = isset( $_POST['alternate'] )? $_POST['alternate']:0;
    $args['paged']=esc_attr( $_POST['page'] );
    $attribute = isset( $_POST['attribute'] ) ? array_map( 'esc_attr', $_POST['attribute'] ) : array();
    $layout=$attribute['layout']?$attribute['layout']:'default';
    $pagination=$attribute['pagination'];
     if ($attribute['designs']) {
                    $design_cls = 'main-' . $attribute['designs'];
                    $design = $attribute['designs'];
                } else {
                    $design_cls = 'main-default';
                    $design = 'default';
                }

       $output='';
    
    require(CTP_PLUGIN_DIR.'/includes/views/content-timeline.php');

    wp_send_json_success( $ctl_html );
    wp_die();
    }

function ct_cat_filters_handler() {
    $ctl_html='';
   $term_slug=esc_attr( $_POST['termslug'] );
    $attribute = isset( $_POST['attribute'] ) ? array_map( 'esc_attr', $_POST['attribute'] ) : array();
    $layout=$attribute['layout']?$attribute['layout']:'default';
    $pagination=$attribute['pagination'];
    
    if($term_slug!="all"){
    $attribute['post-category']=$term_slug;
    }
     if ($attribute['designs']) {
                    $design_cls = 'main-' . $attribute['designs'];
                    $design = $attribute['designs'];
                } else {
                    $design_cls = 'main-default';
                    $design = 'default';
                }
     $output='';
    require(CTP_PLUGIN_DIR.'/includes/views/content-timeline.php');
    wp_send_json_success( $ctl_html );
    wp_die();
    }


    function st_cat_filters_handler() {
   
     $term_slug=esc_attr( $_POST['termslug'] );
    $attribute = isset( $_POST['attribute'] ) ? array_map( 'esc_attr', $_POST['attribute'] ) : array();

    $attribute['category']=$term_slug;

    if($attribute['designs'])
    {
        $design_cls='main-'.$attribute['designs'];
        $design=$attribute['designs'];
    }else{
        $gn_cls='main-default';
        $design='default';
    }
       require(CTP_PLUGIN_DIR.'/includes/cool_timeline_custom_styles.php');
    $output = ''; $ctl_html = '';$ctl_format_html = ''; $ctl_animation='';
    $ctl_avtar_html = '';  $timeline_id = ''; $clt_icons='';

    $layout=$attribute['layout'] ?$attribute['layout']:'default';
  
    if (isset($attribute['animations'])) {
        $ctl_animation=$attribute['animations'];
    }else if($attribute['animation']){
        $ctl_animation=$attribute['animation'];
    }else{
        $ctl_animation ='bounceInUp';
    }
    if (isset($attribute['icons']) && $attribute['icons']=="YES"){
        $clt_icons='icons_yes';
    }else{
        $clt_icons='icons_no';
    }
    require(CTP_PLUGIN_DIR.'/includes/common-query.php');
     $args['paged']=1;
    require(CTP_PLUGIN_DIR.'/includes/views/default.php');
    
    wp_send_json_success( $ctl_html );
    wp_die();
    }