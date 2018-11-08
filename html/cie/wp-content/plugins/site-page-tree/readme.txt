=== Site Page Tree ===
Contributors: bmellor, mitchoyoshitaka
Author: Brett Mellor, mitcho (Michael Yoshitaka Erlewine
Author URI: http://ecs.mit.edu/
Tags: page tree, subpage, site navigation, collapsible, expandable, menu
Requires at least: 3.1
Tested up to: 3.5
Stable tag: 0.5

Sidebar widget displays a navigable tree of pages and subpages with expand/collapse capability. 

== Description ==

This plugin adds a widget that will display a hierarchical tree of all pages and subpages on your site.  Drag it to be displayed in any widget area. 

Each item in the tree is the title of a page or subpage on your site, which is a hyperlink that will navigate the browser to that page.  A deep hierarchy of a large number of pages and subpages is thus reduced to a neatly organized and easily accessible menu.  Pages at the same hierarchical level are displayed in alphabetical order.  

On a page load, the tree will automatically expand only the branches necessary to reveal and highlight the page currently being viewed.  "Expand All" and "Collapse All" features allow you to easily open up and close the entire tree to help find a page buried somewhere in the hierarchy.  Reclaim all your vertical real estate altogether with "Show" and "Hide" features.  

The JavaScript implementation for this plugin is based largely on the [Tigra Tree Menu](http://www.softcomplex.com/products/tigra_tree_menu/) free JavaScript DHTML navigation system.

This plugin is a component of the [MIT Educational Collaboration Space](http://ecs.mit.edu) project.

== Installation ==

1. Upload the `site-page-tree` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. From the Widgets menu, drag the Site Page Widget to the widget area in which you would like to display the page tree.

== Frequently Asked Questions ==

= Your question here! =

Our answer here!

== Screenshots ==

1. A collapsed page tree.  
2. A fully expanded page tree.
3. A partially expanded page tree.  The page tree will automatically expand in a limited manner, in order to reveal and highlight the page which is currently being viewed.  

== Changelog ==

= 0.5 =
* [Code cleanup](https://wordpress.org/support/topic/plugin-site-page-tree-warnings-with-wp_debug)

= 0.4 =
* show/hide mechanism reimplemented using jquery.  The default state is "hidden," state selection is maintained during session with a javascript cookie
* stylesheet added to plugin directory and registered/enqueued by plugin

= 0.3 =
* removed some hard coded styling and put in some classes instead

= 0.2 =
* removed addslashes() from line 185 that was causing post titles to display escaped 
* list pages by menu_order field instead of alphabetical

= 0.1 =
* Initial public release.

