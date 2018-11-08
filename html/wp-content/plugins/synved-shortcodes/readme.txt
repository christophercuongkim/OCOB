=== WordPress Shortcodes ===
Contributors: Synved
Donate link: http://synved.com/wordpress-shortcodes/
Tags: AJAX, shortcode, shortcodes, tabs, UI, sections, accordions, layout, column, columns, link, links, url, permalink, permalinks, time, author, vcard, box, boxes, icons, button, buttons, free, content, plugin, image, edit, manage, Post, posts, image, thumbnail, categories, category, tag, tags, Taxonomy, user, template, Style, seo, page, pages, widget, CSS, editor, jquery, list, media, profile, shortlinks, filter, conditionals, if, condition, check
Requires at least: 3.1
Tested up to: 4.3
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An amazing set of great shortcodes: SEO-ready tabs, sections, buttons, links to any content, author cards, lists, layouts, conditionals and more!

== Description ==

[WordPress Shortcodes](http://synved.com/wordpress-shortcodes/ "WordPress Shortcodes – beautiful elements to spice up your site") is a free WordPress plugin that brings an amazing set of beautiful and useful elements to your site. The plugin comes bundled with the full set of elements, all absolutely free of charge.

Learn how you can use WordPress Shortcodes to [easily create import / export safe links to images and any other content](http://synved.com/blog/help/tutorials/wordpress-shortcodes-for-import-export-safe-urls/)!

> #### Eager to get a functioning example of how the shortcodes elements look and feel?
> Look at some basic example shortcodes on the [Stripefolio demo site](http://wpdemo.synved.com/stripefolio/shortcodes/). Note that the demo site only presents a limited subset, the best way to test the full set is to install the plugin and try it yourself!

If you want to take it to the next level and hugely improve the appearance of the elements and make them look more professional, you might want to consider purchasing the [SlickPanel skin](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/ "Transform the look of many elements in the Shortcodes plugin!").

There are many different kinds of elements that cover all your requirements. These include functionality for *User Interface creation*, *Layout management*, *Lists*, *Buttons*, *Message boxes*, *smart links* to easily link contents on your site without using full URLs but with IDs or names and a bunch of other useful tools such as the ability of adding hidden content in posts/pages, useful for making notes or comments.

Just use the intuitive shortcode editor to create a message box, error box or warning message on your site. Or create multi-column layouts, a fancy button, a highly stylized link card, a list of items with icons (like a feature list), or combine multiple nested shortcodes to create for instance a list of links or a list of buttons and much more.

The shortcode editor presents a very intuitive and easy to use interface, with many built-in presets that make inserting many commonly needed default shortcodes in your posts/pages a breeze! If you want you can also get [over 30+ extra useful amazing presets](http://synved.com/product/wordpress-shortcodes-extra-presets/) for covering almost all needs.

The plugin offers all common jQuery UI functionality as well like jQuery UI Accordions, JQuery UI Tabs, jQuery UI buttons and so on. The UI tabs provide many different features including full SEO compatible selection of active tab without need for JavaScript.

The plugin also offers conditional shortcodes that allow to render content only based on certain conditions, such as only if the user is logged in or if the user is an administrator, an editor, author or has a custom capability or if the current post is password protected or if it has a featured image (post thumbnail).

= Features =
* 26+ shortcodes and different elements!
* Create tabs, sections/accordions, layout, lists, links, buttons and more!
* Tabs are **SEO friendly** and work flawlessly without JavaScript!
* Fully WordPress compliant, using latest standards
* Quick and easy to use shortcodes editor **with instant previews**
* Shortcodes editor allows for easy insertion in posts/pages!
* The shortcode editor has full support for default presets and you can get [many extra useful presets](http://synved.com/product/wordpress-shortcodes-extra-presets/)
* Layout shortcodes allow for tight content organization
* Link shortcodes make importing and exporting content across sites much more reliable
* Links support a simple to use but *powerful template system* to tweak what is displayed and how it looks
* The custom template system makes it extremely easy to create custom **author and post cards** with thumbnails
* Shortcodes to hide content for adding comments and notes to posts and pages
* Many parameters for ultimate customization
* All parameters are documented in detail in the shortcodes editor
* **Conditional** shortcodes to show/hide content based on specific checks or conditions
* Many useful lightweight icons provided built-in
* Easy to adjust the look of shortcodes with built-in custom CSS field
* Optional slick and [professional skin available](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/)

= Example Shortcodes =

The following will create a series of 2 jQuery UI tabs on your site:
`[tabs]
[tab title="Tab 1"]
Tab Content 1.
[/tab]
[tab title="Tab 2"]
Tab Content 2.
[/tab]
[/tabs]`

The following will create a series of 2 jQuery UI accordions on your site:
`[sections]
[section title="Section 1"]
<p style="margin:5px 0;padding:0;">
Section Content 1.
</p>
[/section]
[section title="Section 2"]
<p style="margin:5px 0;padding:0;">
Section Content 2.
</p>
[/section]
[/sections]`

The following will create a list of links to various kinds of content on your site:
`[list icon=link]
  [item][link_post id=82 /][/item]
  [item][link_post id=66 /][/item]
  [item][link_page name="typography" /][/item]
  [item][link_page id=27 /][/item]
  [item][link_category slug="parent-category-iii" /][/item]
  [item][link_media id=6229 /][/item]
  [item][link_media title="Ice Pathway" /][/item]
[/list]`

The following will create **conditional content** only displayed when the post has a specific *tag* of "myposttag":
`[condition check="post_has_tag" param_1="myposttag"]<p>Test POST has TAG</p>[/condition]`

The following will create content conditionally shown only when the post is a specific *format* of "mypostformat":
`[condition check="post_format_is" param_1="mypostformat"]<p>Test post format</p>[/condition]`

This conditional shortcode will check for the **post info** of "review_status" is set to "reviewed":
`[condition check="post_info_is" param_1="review_status" param_2="reviewed"]<p>This post has reviews</p>[/condition]`

= Related Links: =

* [WordPress Shortcodes Official Page](http://synved.com/wordpress-shortcodes/ "WordPress Shortcodes – beautiful elements to spice up your site")
* [SlickPanel skin to make the elements look more professional](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/ "Transform the look of many elements in the Shortcodes plugin!")
* [Extra presets addon provides many useful additional presets](http://synved.com/product/wordpress-shortcodes-extra-presets/)
* [List of icons usable in shortcodes like buttons and lists](http://synved.com/blog/help/tutorials/wordpress-shortcodes-icons/)
* [Stripefolio theme demo](http://wpdemo.synved.com/stripefolio/) where you can see some of the shortcodes in action
* [The free Stripefolio theme](http://synved.com/stripefolio-free-wordpress-portfolio-theme/ "A free WordPress theme that serves as a readable blog and a full-screen portfolio showcase") the Official page for the theme in the above demo link

== Installation ==

1. Download the plugin
2. Simply go under the Plugins page, then click on Add new and select the plugin's .zip file
3. Alternatively you can extract the contents of the zip file directly to your *wp-content/plugins/* folder
4. Finally, just go under Plugins and activate the plugin

== Frequently Asked Questions ==

= How can I see the shortcodes in action? =

Have a look at the [Stripefolio theme demo](http://wpdemo.synved.com/stripefolio/shortcodes/) where you can see some of the shortcodes in action

== Screenshots ==

1. An example of creating tabs with the shortcodes and the [SlickPanel skin](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/)
2. An example of creating sections with the shortcodes and the [SlickPanel skin](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/)
3. An example of creating message boxes with the shortcodes and the [SlickPanel skin](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/)
4. An example of a user link shortcode customized as an author card or "vcard"
5. Same as the above but using the [SlickPanel skin](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/)
6. How the [SlickPanel skin](http://synved.com/product/wordpress-shortcodes-slickpanel-skin/ "Transform the look of many elements in the Shortcodes plugin!") will transform the look of the shortcodes
7. This is the Shortcodes Editor that pops up in the edit post interface
8. Another example of the Shortcodes Editor 
9. Another example of the Shortcodes Editor with the full list of shortcodes (using the old interface)
10. Another example of the Shortcodes Editor showing a partial list of some of the shortcodes (using the new interface)

== Changelog ==

= 1.6.36 =
* Fixed addon installer and added some documentation

= 1.6.35 =
* Adjusted descriptions and comments

= 1.6.34 =
* Added `post_has_term` conditional check

= 1.6.33 =
* Added `post_has_category` conditional check

= 1.6.32 =
* Added `post_has_tag` conditional check

= 1.6.31 =
* Added `is_category` conditional check

= 1.6.30 =
* Added `is_tag` conditional check

= 1.6.29 =
* Added `post_info_is` conditional check

= 1.6.28 =
* Added `post_format_is` conditional check

= 1.6.27 =
* Added `user_option_is` conditional check
* Small adjustments to conditional value checking, now supports bool conversion

= 1.6.26 =
* Added `user_meta_is` conditional check

= 1.6.25 =
* Small fix

= 1.6.24 =
* Small adjustments

= 1.6.23 =
* Added `post_meta_is` conditional check

= 1.6.22 =
* Added Quick Link preset for link_user shortcode

= 1.6.21 =
* Some minor adjustments

= 1.6.20 =
* Add target attribute to button shortcode to allow opening links in new tabs/windows

= 1.6.19 =
* Added extra conditional check match_cookie
* Renamed conditional checks match_xxx_argument to match_xxx (backwards compatible)

= 1.6.18 =
* Added extra conditional checks match_post_argument and match_request_argument

= 1.6.17 =
* Added extra conditional check match_query_argument
* Misc adjustments

= 1.6.16 =
* Added fifth column shortcode

= 1.6.15 =
* Added class attribute for list shortcode

= 1.6.14 =
* Added linked-image template for links, allows to easily create import/export safe links to media items
* Misc adjustments

= 1.6.13 =
* Adjusted versioning typo

= 1.6.12 =
* Fixed sections not opening correctly when using hash links

= 1.6.11 =
* Added extra conditional check is_post_sticky
* Misc adjustments

= 1.6.10 =
* Added extra conditional check post_has_featured_image

= 1.6.9 =
* Added extra conditional check user_can for custom capability check
* Misc adjustments

= 1.6.8 =
* Added extra conditional check is_post_protected
* Misc adjustments

= 1.6.7 =
* Added 2 extra conditional checks
* Misc adjustments

= 1.6.6 =
* Added initial implementation of conditional shortcodes, to insert conditional content
* Minor fixes
* Misc adjustments

= 1.6.5 =
* Fixed shortcode editor not displaying correctly in certain cases
* Minor adjustments

= 1.6.4 =
* Fixed button not appearing on "add post" pages

= 1.6.3 =
* Added hide shortcode, to add hidden notes and comments in posts and pages

= 1.6.2 =
* Fixed potential JavaScript error in rare cases
* Misc adjustments

= 1.6.1 =
* Fixed some issues on certain windows hosting
* Fixed installation of addons in certain peculiar environments
* Minor adjustments

= 1.6.0 =
* Added "plain" message boxes to display simple messages
* Added alignment parameter to all message boxes
* Minor adjustments

= 1.5.9 =
* Minor stability fixes and adjustments

= 1.5.8 =
* Fix sections height problem introduced in newest jQuery UI libraries
* Add parameter to control sections height

= 1.5.7 =
* Fix for potential conflicts with some other plugins

= 1.5.6 =
* Added template parameters in the link parameters documentation
* Fix a few notices for undefined indexes

= 1.5.5 =
* Fix descriptions and added link to Settings from plugins list
* Add image_link variable to visual item data 
* Replace span for divs in certain block-level shortcodes

= 1.5.4 =
* Added link_common shortcode to link to common built-in WordPress pages

= 1.5.3 =
* Add ability to collapse all sections by default
* Ensure log function is not called if not present
* Fix styles for 2012 theme

= 1.5.2 =
* Prevent some conflicts with other plugins
* Ensure tabs match look when JavaScript is disabled
* Fix some descriptions and texts
* Added "imitate" parameter to tabs
* Maximize compatibility for multiple jQuery versions

= 1.5.1 =
* Fixed warnings introduced by WordPress 3.5
* Fixed incompatibilities with jQuery UI stylesheets from other plugins

= 1.5 =
* Added Presets! Allowing for quick starting points and functionality demos
* Fixed a few small bugs and issues
* Added more parameters to a few shortcodes

= 1.4.8 =
* Fixed problem with layouts extend option not working properly
* Added some more screenshots

= 1.4.7 =
* First public release.


