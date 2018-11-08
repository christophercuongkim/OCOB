<?php
/*
Plugin Name: Polytechnic Courses
Plugin URI: http://themeisland.net
Description: This plugins creates a custom post type "Courses" that can be used for educational themes. It also includes a fallback template (polytechnic-single-course.php) which is used for this custom post type if the active theme does not include one.
Version: 2.0
Author: Theme Island Studios
Author URI: http://themeisland.net
License: GPLv2
*/

add_action( 'plugins_loaded', 'polytechnic_course_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function polytechnic_course_load_textdomain() {
  load_plugin_textdomain( 'mythology', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

/* ===================== * REGISTER POST TYPE *======================*/

add_action( 'init', 'create_polytechnic_course' );


function create_polytechnic_course() {
	register_post_type( 'polytechnic_courses',
		array(
			'labels' => array(
			'name' => __('Courses', 'mythology'),
			'singular_name' => __('Course', 'mythology'),
			'add_new' => __('Add New', 'mythology'),
			'add_new_item' => __('Add New Course', 'mythology'),
			'edit' => __('Edit', 'mythology'),
			'edit_item' => __('Edit Course', 'mythology'),
			'new_item' => __('New Course', 'mythology'),
			'view' => __('View', 'mythology'),
			'view_item' => __('View Course', 'mythology'),
			'search_items' => __('Search Courses', 'mythology'),
			'not_found' => __('No Courses found', 'mythology'),
			'not_found_in_trash' => __('No Courses found in Trash', 'mythology'),
			'parent' => __('Parent Course', 'mythology')
		),
		'rewrite' => array( 'slug' => 'courses', 'with_front' => false ),
		'public' => true,
		// 'show_in_menu' => true,
		// 'capability_type'     => 'polytechnic_courses',
		'map_meta_cap'        => true,
		'publicly_queryable'  => true,
		'menu_position' => 15,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'excerpt' ),
		//'taxonomies' => array( 'category' ),  //Adds support for Native WordPress Post Categories
		'taxonomies' => array( 'polytechnic_courses_category' ),  //Adds support for custom Polytechnic Course Categories
		'menu_icon' => /*plugins_url( 'images/image.png', __FILE__ )*/'dashicons-book-alt',
		// 'show_ui' => true,
		'has_archive' => true
		)
	);
}

/* ===================== * TAXONOMIES * ====================== */

/* Categories */

add_action( 'init', 'polytechnic_courses_category_taxonomy' );
 
function polytechnic_courses_category_taxonomy() {

	register_taxonomy(
		'polytechnic_courses_category',
		'polytechnic_courses',
		array(
			'labels' => array(
				'name' 						=> _x( 'Polytechnic Course Categories', 'taxonomy general name', 'mythology'),
				'singular_name'				=> _x( 'Polytechnic Course Category', 'taxonomy singular name', 'mythology' ),
				'search_items' 				=> __( 'Search Categories', 'mythology' ),
				'popular_items' 			=> __( 'Popular Categories', 'mythology' ),
				'all_items' 				=> __( 'All Categories', 'mythology' ),
				'parent_item' 				=> null,
				'parent_item_colon' 		=> null,
				'edit_item' 				=> __( 'Edit Category', 'mythology' ), 
				'update_item' 				=> __( 'Update Category', 'mythology' ),
				'add_new_item' 				=> __( 'Add Category', 'mythology' ),
				'new_item_name' 			=> __( 'New Category', 'mythology' ),
				'separate_items_with_commas' => __( 'Separate categories with commas', 'mythology' ),
				'add_or_remove_items' 		=> __( 'Add or remove categories', 'mythology' ),
				'choose_from_most_used' 	=> __( 'Choose from the most used categories', 'mythology' ),
				'menu_name' 				=> _x( 'Course Categories', 'course menu name', 'mythology' )
			),
			'show_admin_column'		=> true, //Add taxonomy column to the custom post type list
			'hierarchical'			=> true, // category-style instead of tag-style
			'public' 				=> true,
			'rewrite' 				=> array(
										'slug' => 'polytechnic-course-category',
										'with_front' => false,
										'hierarchical' => true
									)
		)
	);

}

/* ===================== * ADD META BOXES * ====================== */

add_action( 'admin_init', 'my_admin' );


function my_admin() {

	$post_types = array('polytechnic_courses', 'course');

	add_meta_box( 'polytechnic_course_meta_box',
		'Course Details',
		'display_polytechnic_course_meta_box',
		$post_types, 'normal', 'high' );
}


	function display_polytechnic_course_meta_box( $polytechnic_course ) {
		// Retrieve current name of the Course Number and Rating based on ID
		$course_description = esc_html( get_post_meta( $polytechnic_course->ID, 'course_description', true ) );
		$course_unique_id = esc_html( get_post_meta( $polytechnic_course->ID, 'course_unique_id', true ) );
		$course_number = esc_html( get_post_meta( $polytechnic_course->ID, 'course_number', true ) );
		$course_name = esc_html( get_post_meta( $polytechnic_course->ID, 'course_name', true ) );
		$course_time = esc_html( get_post_meta( $polytechnic_course->ID, 'course_time', true ) );
		$course_days = esc_html( get_post_meta( $polytechnic_course->ID, 'course_days', true ) );
		$course_room_number = esc_html( get_post_meta( $polytechnic_course->ID, 'course_room_number', true ) );
		$course_location = esc_html( get_post_meta( $polytechnic_course->ID, 'course_location', true ) );
		$course_prerequisites = esc_html( get_post_meta( $polytechnic_course->ID, 'course_prerequisites', true ) );
		$course_components = esc_html( get_post_meta( $polytechnic_course->ID, 'course_components', true ) );
		$course_credits = esc_html( get_post_meta( $polytechnic_course->ID, 'course_credits', true ) );
		$course_notes = esc_html( get_post_meta( $polytechnic_course->ID, 'course_notes', true ) );

	?>

	<table>
		<tr>
			<td style="width: 100%"><?php _e( 'Course Description', 'mythology' )?></td>
			<td>
				<textarea style="width: 100%;" type="text" size="80" name="polytechnic_course_description" /><?php echo $course_description; ?></textarea>
			</td>
		</tr>
		<tr>
			<td style="width: 100%"><?php _e( 'Course ID', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_unique_id" value="<?php echo $course_unique_id; ?>" />
			</td>
		</tr>
		<tr>
			<td style="width: 100%"><?php _e( 'Course Number(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_number" value="<?php echo $course_number; ?>" />
			</td>
		</tr>
		<tr>
			<td style="width: 100%"><?php _e( 'Course Name(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_name" value="<?php echo $course_name; ?>" />
			</td>
		</tr>
		<tr>
			<td style="width: 100%"><?php _e( 'Course Time(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_time" value="<?php echo $course_time; ?>" />
			</td>
		</tr>
		<tr>
			<td style="width: 100%"><?php _e( 'Course Day(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_days" value="<?php echo $course_days; ?>" />
			</td>
		</tr>
		<tr>
			<td style="width: 100%"><?php _e( 'Room Number', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_room_number" value="<?php echo $course_room_number; ?>" />
			</td>
		</tr>
		<tr>
			<td style="width: 100%"><?php _e( 'Location / Map', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_location" value="<?php echo $course_location; ?>" />
			</td>
		</tr>
			<tr>
			<td style="width: 100%"><?php _e( 'Prerequisite(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_prerequisites" value="<?php echo $course_prerequisites; ?>" />
			</td>
		</tr>
			<tr>
			<td style="width: 100%"><?php _e( 'Component(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_components" value="<?php echo $course_components; ?>" />
			</td>
		</tr>
			<td style="width: 100%"><?php _e( 'Credit(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_credits" value="<?php echo $course_credits; ?>" />
			</td>
		</tr>
			<td style="width: 100%"><?php _e( 'Note(s)', 'mythology' )?></td>
			<td>
				<input type="text" size="80" name="polytechnic_course_notes" value="<?php echo $course_notes; ?>" />
			</td>
		</tr>

	</table>
<?php }


/* ===================== * SAVE META BOXES * ====================== */

add_action( 'save_post', 'add_polytechnic_course_fields', 10, 2 );


function add_polytechnic_course_fields( $polytechnic_course_id,
	$polytechnic_course ) {

	$post_types = array('polytechnic_courses', 'course');

		// Check post type for Courses
		if ( ($polytechnic_course->post_type == 'polytechnic_courses') || ($polytechnic_course->post_type == 'course') ) {

			// Store data in post meta table if present in post data
			if ( isset( $_POST['polytechnic_course_description'] ) &&
				$_POST['polytechnic_course_description'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_description',$_POST['polytechnic_course_description'] );
			}

			if ( isset( $_POST['polytechnic_course_unique_id'] ) &&
				$_POST['polytechnic_course_unique_id'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_unique_id',$_POST['polytechnic_course_unique_id'] );
			}

			if ( isset( $_POST['polytechnic_course_number'] ) &&
				$_POST['polytechnic_course_number'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_number',$_POST['polytechnic_course_number'] );
			}

			if ( isset( $_POST['polytechnic_course_name'] ) &&
				$_POST['polytechnic_course_name'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_name',$_POST['polytechnic_course_name'] );
			}

			if ( isset( $_POST['polytechnic_course_time'] ) &&
				$_POST['polytechnic_course_time'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_time',$_POST['polytechnic_course_time'] );
			}

			if ( isset( $_POST['polytechnic_course_days'] ) &&
				$_POST['polytechnic_course_days'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_days',$_POST['polytechnic_course_days'] );
			}

			if ( isset( $_POST['polytechnic_course_room_number'] ) &&
				$_POST['polytechnic_course_room_number'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_room_number',$_POST['polytechnic_course_room_number'] );
			}

			if ( isset( $_POST['polytechnic_course_location'] ) &&
				$_POST['polytechnic_course_location'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_location',$_POST['polytechnic_course_location'] );
			}

			if ( isset( $_POST['polytechnic_course_prerequisites'] ) &&
				$_POST['polytechnic_course_prerequisites'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_prerequisites',$_POST['polytechnic_course_prerequisites'] );
			}

			if ( isset( $_POST['polytechnic_course_components'] ) &&
				$_POST['polytechnic_course_components'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_components',$_POST['polytechnic_course_components'] );
			}

			if ( isset( $_POST['polytechnic_course_credits'] ) &&
				$_POST['polytechnic_course_credits'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_credits',$_POST['polytechnic_course_credits'] );
			}

			if ( isset( $_POST['polytechnic_course_notes'] ) &&
				$_POST['polytechnic_course_notes'] != '' ) {
					update_post_meta( $polytechnic_course_id, 'course_notes',$_POST['polytechnic_course_notes'] );
			}else{
				delete_post_meta($polytechnic_course_id, 'course_notes');
			}


		}
}

/* ===================== * DEFAULT TEMPLATE * ====================== */

add_filter( 'template_include', 'include_template_function', 1 );


function include_template_function( $template_path ) {
	if ( get_post_type() == 'polytechnic_courses' ) {
		if ( is_single() ) {
			// checks if the file exists in the theme first, otherwise serve the file from the plugin
			if ( $theme_file = locate_template( array
				( 'polytechnic-single-course.php' ) ) ) {
					$template_path = $theme_file;
			}
			else {
				$template_path = plugin_dir_path( __FILE__ ) . '/polytechnic-single-course.php';
			}
		}
	}
	return $template_path;
} 

function custom_post_author_archive( &$query )
{
    if ( $query->is_author )
        $query->set( 'post_type', 'polytechnic_courses' );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' ); // run once!
}
add_action( 'pre_get_posts', 'custom_post_author_archive' );


?>