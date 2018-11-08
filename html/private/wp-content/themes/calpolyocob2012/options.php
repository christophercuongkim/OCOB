<?php
// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');
add_action( 'admin_init', 'register_my_cool_plugin_settings' );

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('My Cool Plugin Settings', 'Cool Settings', 'edit_posts', 'my_cool_plugin_settings_page');

	//call register settings function
	
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
	register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
	register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
}

function my_cool_plugin_settings_page() {
echo "<h1>Hello</h1>";

} ?>