<?php
/**
 * Plugin Name: Office Hours
 * Plugin URI: N/A
 * Description: Display's office hours on Faculty Profiles
 * Version: 9000.0.0
 * Author: OCOB Web Team
 * Author URI: N/A
 * License: Open Source
 */

add_action('admin_menu', 'office_hour_menu');
add_action( 'admin_init', 'register_office_hour' );

function office_hour_menu() {

	//create new top-level menu
	add_options_page('Office Hour Settings', 'Office Hour Settings', 'read', 'office_hour_settings', 'office_hour_settings_options_page');

	//call register settings function

}


function register_office_hour() {
	//register our settings
	register_setting( 'office_hour_settings_options', 'office_hour_settings_options', 'office_hour_settings_options_validate' );

	add_settings_section('office_hour_settings_main', 'Office Hour Settings', 'office_hour_settings_section_text', 'office_hour_settings');

	switch_to_blog(8);
	//get all of the different categories for the faculty profiles
	$categories = array();
	$args = array(
		'type' => 'faculty_profile',
	);
	$categories = get_categories($args);
	$realCats = array();
	//for each category get the slug and the name and make a
	//dictionary between the slug and the display name
	foreach($categories as $cat){
		$id = $cat->slug;
		$name = $cat->name;
		$realCats[$id] = $name;
	}
	restore_current_blog();

	foreach($realCats as $slug => $name){
		$dynFunc = create_function("", '$options = get_option(\'office_hour_settings_options\');
		echo "<input class=\'file_upload\' id=\'office_hour_settings_'.$slug.'\' name=\'office_hour_settings_options['.$slug.']\' size=\'40\' type=\'text\' value=\'{$options[\''.$slug.'\']}\' /><a href=\'#\' data-slug=\''.$slug.'\' class=\'file_upload_button\'>Upload</a>";');
		add_settings_field('office_hour_settings_'.$slug, $name.' PDF', $dynFunc, 'office_hour_settings', 'office_hour_settings_main');
	}

}

function office_hour_settings_options_validate($input) {
	return $input;
}

//the following function is never used but servers as an example of the dynamically created function where example is the name of category
function example_setting() {
	$options = get_option('office_hour_settings_options');
	echo "<input class='file_upload' id='office_hour_settings_example' name='office_hour_settings_options[example]' size='40' type='text' value='{$options['example']}' /><a href='#' class='file_upload_button'>Upload</a>";
}

function office_hour_settings_section_text() {
	echo '<p>All of the Office Hour PDFs go here</p>';
}

//page
function office_hour_settings_options_page() {
	if(function_exists( 'wp_enqueue_media' )){
	    wp_enqueue_media();
	}else{
	    wp_enqueue_style('thickbox');
	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
	}
	?>
	<div>
		<h1>You're Awesome</h1>
		<form action="options.php" method="post" enctype="multipart/form-data">
			<?php settings_fields('office_hour_settings_options'); ?>
			<?php do_settings_sections('office_hour_settings'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<script>
		var slug = '';
	    jQuery(document).ready(function($) {
	        jQuery('.file_upload_button').click(function(e) {
	            e.preventDefault();
				var slug = $(this).data("slug");
	            var custom_uploader = wp.media({
	                title: ''+slug+' PDF',
	                button: {
	                    text: 'Upload PDF'
	                },
	                multiple: false  // Set this to true to allow multiple files to be selected
	            });
	            custom_uploader.on('select', function() {
	                var attachment = custom_uploader.state().get('selection').first().toJSON();
	                jQuery('#office_hour_settings_'+slug).val(attachment.url);

	            });
	            custom_uploader.open();
	        });
	    });
	</script>
	<?php
}


 ?>