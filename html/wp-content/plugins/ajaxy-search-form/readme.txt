=== Plugin Name ===
Contributors: n-for-all
Donate link: http://ajaxy.org/
Version: 3.0.8
Tags: facebook, live search, ajax search, category search, predictive search
Requires at least: 4.0.0
Tested up to: 4.6.0
Stable tag: 3.0.8

A facebook like ajaxy live search for wordpress, this plugin uses the same functionality as facebook to retrieve the results from your blog.

== Description ==

* This plugin is a an ajax live search that uses the same theme as facebook search, it uses ajax and jQuery to get results from wordpress.

* 4 themes have been added one light and one dark to fit most blogs need and i am also available to customise each theme to suit your blog.

* this plugin can search categories, post tags, post types, taxonomies and supports woocommerce products search and more to go.

* This plugin was a scratch when i created it, Now it is competing with the best wordpress live search plugins out there, it is now supporting all customisation offered by the best live search plugins for wordpress.


== Installation ==

1. Go to plugin, click add new and search for ajax live search, Alternatively you can upload `ajaxy-search-form` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

-Styles are broken?

Each theme has its own styles and might conflict with the search form styles.

- jQuery is undefined?

i have seen a lot of blogs that are having this issue, the problem relies when you include jQuery more than once in your blog file, please note the ajax live search doesn’t include custom jQuery, it uses wordpress built in jQuery script, so make sure there are no other plugins injecting another jQuery version into the HTML.

== Screenshots ==
1. screenshot-2.jpg
2. screenshot-1.jpg

== Changelog ==
= 3.0.8 =
	minor fixes and upgrades, a new Light Theme added
= 3.0.7 =
	minor fixes and upgrades
= 3.0.6 =
	minor fixes and upgrades
= 3.0.5 =
	minor fixes and upgrades
= 3.0.4 =
	Code enhancemend, backend enhancments, speed, more quality code and much more
	Quick View of New Features: 
		WooCommerce search
		Author Search
		Taxonomy Search
		Right to Left Languages Support for arabic and farsi
		Localization Support
		Shortcode Generator
		Enhanced Search and code
		Custom Fields Template tags are added
	
= 3.0.0 = 

New Features: 
	
	Shortcode [ajaxy-live-search] added with parameters:
		label // search label
		expand // expand input field on click
		width // input field width
		border // input field border
		credits // whether to show or hide author credits
		show_category // whether to show or hide category results in search box
		show_post_category // whether to show or hide post_category results in search box
		post_types // limit search to post_types ( comma seperated list of post_type names)
		searchUrl // customize the search url, (%s will be replaced with the search value)
		delay // delay time before searching
		iwidth // input width or the width of the input field
		width // width of the search results field
		ajaxUrl // ajax url to call plugin functions
		
	multiple shortcodes can be inserted on same page
= 2.2.9 =	
= 2.2.8 = 

Support for wordpress > 3.5, remove filter option to get_search_form is added

= 2.2.7 = 

blank theme added

= 2.2.5 = 

fix for WPML exclude results

= 2.2.4 = 

fix for WPML sorting results

= 2.2.3 = 

add dismiss option to remove promotion message from admin backend

= 2.2.2 = 

- strip shortcodes
- reset settings
- errors and warning removal
- fix for search content
- fix for excluding pages
- new filters and actions added

= 2.2.1 = 

Adding support for ajaxy search tracker to track search keywords

= 2.2.0 =

* bug fixes

= 2.1.9 =

* fix for content search

= 2.1.6 =

* specify the id of existing search box and ajaxy with implement the search there.
* fixed custom scrollbars.
* hide on page resize.
* qtranslate with Live Search.

= 2.1.5 =

* display posts results under category, example if you search for category "cat", all posts under this category will be shown under "cat" section, to enable this search mode, go to templates, edit the category template and set "Show "Posts under Category" to show.
* added scrollbars for more results and less size.

= 2.1.4 =

* Basic support for WPML plugin
* Fixed Excluding show posts under each template to show all posts
* Fixed javascript bug that conflicts with other themes scripts 

= 2.1.3 =

* Fixed search url for latin characters

= 2.1.2 =

* Fixed invalid url when clicking enter in the search form input box

= 2.1.1 =

* Added the ability customise the "see more results" box and to change the search url
* Added the ability to sort out the results returned in the frontend 

= 2.1.0 =

* Added the ability to remove specific categories/post types from the search


= 2.0.2 =

* fixed carriage return "on click"

= 2.0.1 =

* fixed styles for twentyeleven theme

= 2.0.0 =

* Added themes support
* Added widget box
* Added results box settings to be independent from the search form settings
* Multiple search forms can work on the same page
* Added cropping to images + fetching image from within content if there is no featured image
* Added a preview page so that the settings can be viewed on the admin page
* Used wordpress default list table for a better usability

= 1.0.5 =
* fixed taxonomy search to return result for same taxonomy

= 1.0.4 =
* Added Search post tags and custom taxonomy

= 1.0.3 =
* fixed some bugs with css to be compatible with all blogs

= 1.0.1 =
* fixed some bugs with css
* fixed some bugs with the script (show more button)

= 1.0 =
* First version. Basic stable version.

1. Search categories
2. Search custom post types
3. Templates customisable from backend

