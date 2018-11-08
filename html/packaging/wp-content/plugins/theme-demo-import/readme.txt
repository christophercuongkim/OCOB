=== Theme Demo Import ===
Contributors: themely
Tags: import, content, demo, data, widgets, settings
Requires at least: 4.0.0
Tested up to: 4.9.6
Stable tag: 4.9.6
License: GPLv3 or later

Quickly import your theme's live demo content, widgets and settings with one click.

== Description ==

Quickly import your theme's live demo content, widgets and settings. This will provide a basic layout to build your website and speed up development.

This plugin will create a page in **APPEARANCE > Import Demo Content**.

If the theme you are using does not have any predefined import files, then you will be presented with three file upload inputs. 

First one is required and you will have to upload a demo content XML file, for the actual demo import. 

The second one is optional and will ask you for a WIE or JSON file for widgets import. You create that file using the [Widget Importer & Exporter](https://wordpress.org/plugins/widget-importer-exporter/) plugin. 

The third one is also optional and will import the customizer settings, select the DAT file which you can generate from [Customizer Export/Import](https://wordpress.org/plugins/customizer-export-import/) plugin (the customizer settings will be imported only if the export file was created from the same theme).

This plugin is based off the 'One Click Demo Import' plugin by @capuderg and @cyman, https://github.com/proteusthemes/one-click-demo-import.

As well as the improved WP Import 2.0 plugin by @humanmade, https://github.com/humanmade/WordPress-Importer.

== Installation ==

**From your WordPress dashboard**

1. Visit 'Plugins > Add New',
2. Search for 'Theme Demo Import' and install the plugin.
3. Activate 'Theme Demo Import' from your Plugins page.

Once the plugin is activated you will find the actual import page in **Appearance -> Import Demo Content.**

== Frequently Asked Questions ==

= I have activated the plugin. Where is the "Import Demo Content" page? =

You will find the import page in *wp-admin -> Appearance -> Import Demo Content*.

= Where are the demo import files and the log files saved? =

The files used in the demo import will be saved to the default WordPress uploads directory. An example of that directory would be: `../wp-content/uploads/2016/03/`.

The log file will also be registered in the *wp-admin -> Media* section, so you can access it easily.

= How to predefine demo imports? =

This question is for theme authors. To predefine demo imports, you just have to add the following code structure, with your own values to your theme (using the `theme-demo-import/import_files` filter):

`
function TDI_import_files() {
	return array(
		array(
			'import_file_name'           => 'Demo Import 1',
			'import_file_url'            => 'http://www.your_domain.com/tdi/demo-content.xml',
			'import_widget_file_url'     => 'http://www.your_domain.com/tdi/widgets.json',
			'import_customizer_file_url' => 'http://www.your_domain.com/tdi/customizer.dat',
			'import_preview_image_url'   => 'http://www.your_domain.com/tdi/preview_import_image1.jpg',
			'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
		),
		array(
			'import_file_name'           => 'Demo Import 2',
			'import_file_url'            => 'http://www.your_domain.com/tdi/demo-content2.xml',
			'import_widget_file_url'     => 'http://www.your_domain.com/tdi/widgets2.json',
			'import_customizer_file_url' => 'http://www.your_domain.com/tdi/customizer2.dat',
			'import_preview_image_url'   => 'http://www.your_domain.com/tdi/preview_import_image2.jpg',
			'import_notice'              => __( 'A special note for this import.', 'your-textdomain' ),
		),
	);
}
add_filter( 'theme-demo-import/import_files', 'TDI_import_files' );
`

You can set content import, widgets, and customizer import files. You can also define a preview image, which will be used only when multiple demo imports are defined, so that the user will see the difference between imports.

= How to automatically assign "Front page", "Posts page" and menu locations after the importer is done? =

You can do that, with the `theme-demo-import/after_import` action hook. The code would look something like this:

`
function TDI_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'theme-demo-import/after_import', 'TDI_after_import_setup' );
`

= What about using local import files (from theme folder)? =

You have to use the same filter as in above example, but with a slightly different array keys: `local_*`. The values have to be absolute paths (not URLs) to your import files. To use local import files, that reside in your theme folder, please use the below code. Note: make sure your import files are readable!

`
function TDI_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo Import 1',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'tdi/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'tdi/widgets.json',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'tdi/customizer.dat',
			'import_preview_image_url'     => 'http://www.your_domain.com/tdi/preview_import_image1.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
		),
		array(
			'import_file_name'             => 'Demo Import 2',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'tdi/demo-content2.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'tdi/widgets2.json',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'tdi/customizer2.dat',
			'import_preview_image_url'     => 'http://www.your_domain.com/tdi/preview_import_image2.jpg',
			'import_notice'                => __( 'A special note for this import.', 'your-textdomain' ),
		),
	);
}
add_filter( 'theme-demo-import/import_files', 'TDI_import_files' );
`

= How to handle different "after import setups" depending on which predefined import was selected? =

This question might be asked by a theme author wanting to implement different after import setups for multiple predefined demo imports. Lets say we have predefined two demo imports with the following names: 'Demo Import 1' and 'Demo Import 2', the code for after import setup would be (using the `theme-demo-import/after_import` filter):

`
function TDI_after_import( $selected_import ) {
	echo "This will be displayed on all after imports!";

	if ( 'Demo Import 1' === $selected_import['import_file_name'] ) {
		echo "This will be displayed only on after import if user selects Demo Import 1";

		// Set logo in customizer
		set_theme_mod( 'logo_img', get_template_directory_uri() . '/assets/images/logo1.png' );
	}
	elseif ( 'Demo Import 2' === $selected_import['import_file_name'] ) {
		echo "This will be displayed only on after import if user selects Demo Import 2";

		// Set logo in customizer
		set_theme_mod( 'logo_img', get_template_directory_uri() . '/assets/images/logo2.png' );
	}
}
add_action( 'theme-demo-import/after_import', 'TDI_after_import' );
`

= Can I add some code before the widgets get imported? =

Of course you can, use the `theme-demo-import/before_widgets_import` action. You can also target different predefined demo imports like in the example above. Here is a simple example code of the `theme-demo-import/before_widgets_import` action:

`
function TDI_before_widgets_import( $selected_import ) {
	echo "Add your code here that will be executed before the widgets get imported!";
}
add_action( 'theme-demo-import/before_widgets_import', 'TDI_before_widgets_import' );
`

= I'm a theme author and I want to change the plugin intro text, how can I do that? =

You can change the plugin intro text by using the `theme-demo-import/plugin_intro_text` filter:

`
function TDI_plugin_intro_text( $default_text ) {
	$default_text .= '<div class="TDI__intro-text">This is a custom text added to this plugin intro text.</div>';

	return $default_text;
}
add_filter( 'theme-demo-import/plugin_intro_text', 'TDI_plugin_intro_text' );
`

To add some text in a separate "box", you should wrap your text in a div with a class of 'TDI__intro-text', like in the code example above.

= How to disable generation of smaller images (thumbnails) during the content import =

This will greatly improve the time needed to import the content (images), but only the original sized images will be imported. You can disable it with a filter, so just add this code to your theme function.php file:

`add_filter( 'theme-demo-import/regenerate_thumbnails_in_content_import', '__return_false' );`

= How to change the location, title and other parameters of the plugin page? =

As a theme author you do not like the location of the "Import Demo Content" plugin page in *Appearance -> Import Demo Content*? You can change that with the filter below. Apart from the location, you can also change the title or the page/menu and some other parameters as well.

`
function TDI_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Theme Demo Import' , 'theme-demo-import' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Content' , 'theme-demo-import' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'theme-demo-import';

	return $default_settings;
}
add_filter( 'theme-demo-import/plugin_page_setup', 'TDI_plugin_page_setup' );
`

= I can't activate the plugin, because of a fatal error, what can I do? =

*Update: There is now a admin error notice, stating that the minimal PHP version required for this plugin is 5.3.2.*

You want to activate the plugin, but this error shows up:

*Plugin could not be activated because it triggered a fatal error*

This happens, because your hosting server is using a very old version of PHP. This plugin requires PHP version of at least **5.3.x**, but we recommend version *5.6.x*. Please contact your hosting company and ask them to update the PHP version for your site.


== License ==

Theme Demo Import uses 'One Click Demo Import' plugin script
https://github.com/proteusthemes/one-click-demo-import
(C) 2016 ProteusThemes.com
Licensed under the GNU General Public License v2.0,
http://www.gnu.org/licenses/gpl-2.0.html

Theme Demo Import uses 'Wordpress Importer' plugin script
https://github.com/humanmade/WordPress-Importer
(C) 2016 @humanmade
Licensed under the GNU General Public License v2.0,
http://www.gnu.org/licenses/gpl-2.0.html


== Copyright ==

Theme Demo Import, Copyright 2016 Ishmael 'Hans' Desjarlais

Theme Demo Import is distributed under the terms of the GNU GPL

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.


== Screenshots ==

1. screenshot1.png


== Changelog ==

**1.0.2 - 10/25/2016**

- Removed dependencies on 3rd party plugin
- Renamed classes for HM files
- Added license and copyright information to readme.txt file
- Updated the plugin description


**1.0.1 - 10/15/2016**

- Updated text strings
- Updated styles (UI)
- Removed unnecessary code


**1.0.0 - 10/10/2016**

- INITIAL RELEASE
