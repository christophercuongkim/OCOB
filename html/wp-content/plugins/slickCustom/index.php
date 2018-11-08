<?php
/**
 * Plugin Name: Slick Slider Custom
 * Plugin URI: N/A
 * Description: Generates function and shortcode when a slider custom post type is saved
 * Version: 900.0.0
 * Author: Mitchell Overfield
 * Author URI: N/A
 * License: Open Source
 */

/**
 * Save new Script when Faculty Profile is updated
 *
 * @param int $post_id The ID of the post.
 * @param post $post the post.
 */

 function getFileUsablePathLocal($file) {
	$dir = plugin_dir_path( $file );
	$dir = explode("/", $dir);
	for ($i = 1; $i < 3; $i++) {
		unset($dir[$i]);
	}
	$dir = implode('/', $dir);
	return $dir;
}

function temp_func ($atts) {
	$dir = getFileUsablePathLocal(__FILE__); //this is in functions.php, but porting it over here for plugin portablity.
	$atts = shortcode_atts( array(
		'id' => '',
		'small' => false
	), $atts, 'slider' );
	if (strlen($atts['id']) > 0) {
		$custom = get_fields($atts['id']);
	} else {
		print_r("INVALID SLIDER ID");
		die();
	}
	//$custom = get_fields($id);
	$rs = '';
	$rs .= '<link rel="stylesheet" type="text/css" href="/wp-content/plugins/slickCustom/slick/slick.css"/>';
	$rs .= '<link rel="stylesheet" type="text/css" href="/wp-content/plugins/slickCustom/slick/customSlick.css"/>';
	$rs .= '<div class="slider" style="">';
	//var_dump($rs);

	$first = 0;

    foreach ($custom['slides'] as $image) {

		//$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large')[0];
		$rs .= '<div>';
		if($first == 0){
			$first = 1;
			$rs .= '<img src="' . $image['sizes']['large'] . '" class="attachment-post-thumbnail wp-post-image slick-slider-image" style="width : 730" alt= "">';
		}else{
			$rs .= '<img data-lazy="' . $image['sizes']['large'] . '" class="attachment-post-thumbnail wp-post-image slick-slider-image" style="width : 730" alt= "">';
		}

		$rs .=	'<div class="mobileText">' . $image['description'] . '</div>';
		$rs .= '</div>';
	}
	//return $rs;
	$rs .= '</div>';
	if ($atts['small'] == true) {
		$rs .= '<!-- ';
	}
	$rs .= '<div class="sideSlider">';
		foreach ($custom['slides'] as $image) {
				$title = $image['title'];
				$excerpt = $image['description'];

				$rs .= '<div>';
				$rs .= '<h2>' . $title . '</h2>';
				$rs .= $excerpt;
				$rs .= '</div>';

		}
	$rs .= '</div>';
	if ($atts['small'] == true) {
		$rs .= ' -->';
	}

	$rs .= '<script src="/wp-content/plugins/slickCustom/slick/customSlick.js"></script>';
	$rs .= '<script src="/wp-content/plugins/slickCustom/slick/slick.min.js"></script>';
	//var_dump($rs);
	return $rs;
}

function selectSliderMarkup($post) {
	$rs = '';
	$args = array( 'numberposts' => -1, 'offset'=> 0, 'post_type' => 'slick_sliders');
    $myposts = get_posts( $args );
    $radioVal = get_post_meta($post->ID, "sliderID", true);
    //echo('rVal: ' . $radioVal . '<br>');
    foreach( $myposts as $slider ) :	//setup_postdata($post);
		$rs .= '<input type="radio" name="sliderID" value="' . $slider->ID . '"';
		//echo('id: ' . $slider->ID . '<br>');
		if ($slider->ID == $radioVal) {
			$rs .= 'checked> ' . $slider->post_title . '<br>';
		} else {
			$rs .= '> ' . $slider->post_title . '<br>';
		}

	endforeach;
		$rs .= '<br>';
		echo ($rs);
}
function alertInter($string) {
	var_dump( $string );
	die();
	//this wont save the post so make sure to remove the die command
}

function displayMetabox($post) {
	$sliderActive = get_field('has_slider', $post->ID);
	//var_dump($sliderActive);
	//die();
	if($sliderActive == true){
		add_meta_box('selectSlider', 'Select Slider', 'selectSliderMarkup', 'page', 'normal', 'high', null);
	}
}


add_action( 'init', 'create_post_type_slick' );
function create_post_type_slick() {
	register_post_type( 'slick_sliders',
		array(
			'labels' => array(
				'name' => __( 'Slick Sliders' ),
				'singular_name' => __( 'Slick Slider' ),
				'edit_item' => "Edit Slider",
				'view_item' => "View Slider",
				'new_item' => "New Slider"
			),
			'taxonomies' => array('category'),
			'show_ui' => true,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slick_sliders'),
			'capability_type' => 'post',
			'supports' => array( 'title', 'editor','author','thumbnail','custom-fields', 'revisions' ),
			'menu_icon' => 'dashicons-slides'
		)
	);
}

function save_slider($post_id, $post, $update) {
	$sliderActive = get_field('has_slider', $post->ID);
	$sliderIDVal = '';
	if($sliderActive == true){
		if(isset($_POST["sliderID"]))
	    {
	        $sliderIDVal = $_POST["sliderID"];
	    }
	    update_post_meta($post_id, "sliderID", $sliderIDVal);
	}
}


add_shortcode('slider', 'temp_func');
add_action( 'add_meta_boxes_page', 'displayMetabox' );
add_action("save_post", "save_slider", 10, 3);

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_573a45a0de737',
	'title' => 'Slick Slider Content',
	'fields' => array (
		array (
			'key' => 'field_573a45b376b53',
			'label' => 'Slides',
			'name' => 'slides',
			'type' => 'gallery',
			'instructions' => 'Add slide pictures and edit slide descriptions',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_573a45ca76b54',
			'label' => 'Small Slider',
			'name' => 'small_slider',
			'type' => 'true_false',
			'instructions' => 'Check this if you want your slider to not have the side slider, also giving room for a sidebar on the page',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'slick_sliders',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

endif;

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_573a3fe3430ff',
	'title' => 'Slider Active',
	'fields' => array (
		array (
			'key' => 'field_573a3ff98c33a',
			'label' => 'Has Slider',
			'name' => 'has_slider',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

add_action("init", "addFunction");

function addFunction() {
	eval("function getSlider(\$sliderID) { echo do_shortcode('[slider id=' . \$sliderID . ' small=' . get_field('small_slider', \$sliderID) . ']'); }");
}





?>