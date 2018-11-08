=== JJ SwfObject ===
Contributors: JJ Coder
Donate link: http://www.redcross.org.nz/donate
Tags: flash, swf, swfobject, widget, shortcode
Requires at least: 2.8
Tested up to: 3.1
Stable tag: 1.0.5

Allows you to insert a swf file using a widget or a shortcode using the swfobject library.

== Description ==

Allows you to insert a swf file using a widget or a shortcode.

You can specify the following parameters:

NOTE: sc means shortcode:

- Title: Title. Leave blank for no title. (sc: title="My Title")
- Alternate Content. Content to display if can't embed flash. (sc: alt="Flash required")
- HTML id: HTML id to use. Defaults to 'jj_swfobject'. Needs to be different for multiple instances on same page. (sc: html_id="jj_swfobject")
- Path: Rath to swf. (sc: title="")
- Width: Width of swf. (sc: width="")
- Height: Height of swf. (sc: height="")
- Version: Flash version required. Defaults to '9.0.0'. (sc: version="")
- Flashvars: Fashvars for swf. eg, {name1:"hello",name2:"world",name3:"foobar"} (sc: flashvars="")
- Params: Params for swf. eg, {menu:"false"} (sc: params="")
- Attributes: Attributes for swf. eg, {id:"myDynamicContent",name:"myDynamicContent"} (sc: attributes="")

Check out swfobject documentation for more info. (http://code.google.com/p/swfobject/wiki/documentation)

Shortcode Examples:

- [jj-swfobject path="/mypath" html_id="banner" width="200" height="200" version="9.0.0"]

Try out my other plugins:

- JJ NextGen JQuery Slider (http://wordpress.org/extend/plugins/jj-nextgen-jquery-slider/)
- JJ NextGen JQuery Carousel (http://wordpress.org/extend/plugins/jj-nextgen-jquery-carousel/)
- JJ NextGen JQuery Cycle (http://wordpress.org/extend/plugins/jj-nextgen-jquery-cycle/)
- JJ NextGen Unload (http://wordpress.org/extend/plugins/jj-nextgen-unload/)
- JJ NextGen Image List (http://wordpress.org/extend/plugins/jj-nextgen-image-list/)

== Installation ==

Please refer to the description for requirements and how to use this plugin.

1. Copy the entire directory from the downloaded zip file into the /wp-content/plugins/ folder.
2. Activate the "JJ SwfObject" plugin in the Plugin Management page.
3. Refer to the description to use the plugin as a widget and or a shortcode.

== Frequently Asked Questions ==

Question: 

- How can I upload swf files using wordpress Media?

Answer: 

- Try adding code below to your functions.php file

`if ( ! function_exists( 'add_my_mime_types' ) ) :
function add_my_mime_types($existing_mimes=array()) {
  $existing_mimes['swf'] = 'application/x-shockwave-flash';
  return $existing_mimes;
}
endif;
add_filter('upload_mimes', 'add_my_mime_types');`

Question:

- How can I use plugin inside normal PHP code?

Answer:

- echo do_shortcode('[jj-swfobject path="/mypath" html_id="banner" width="200" height="200" version="9.0.0"]');

Question:

- Doesn't work after upgrade? or Doesn't work with this theme?
  
Answer:

- Please check that you don't have two versions of jQuery loading, this is the problem most of the time. Sometimes a theme puts in <br> tags at the end of newlines aswell.

== Screenshots ==

1. Widget controls.

== Changelog ==

- 1.0.5: FAQ.
- 1.0.4: Donate to Christchurch Quake.
- 1.0.2: Readme.
- 1.0.1: FAQ.
- 1.0.0: First version.

== Contributors ==
