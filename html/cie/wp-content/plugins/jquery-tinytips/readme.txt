=== Plugin Name ===
Contributors: techotronic
Donate link: http://www.techotronic.de/donate/
Tags: jquery, tooltips, tinytips, mouseover
Requires at least: 3.0
Tested up to: 3.0
Stable tag: 1.1

Adds tinytips tooltips to links on your site. Comes with different themes.

== Description ==

Adds tinytips tooltips to links on your site. Comes with 8 different themes.
The tinytip can be added to a link using the WordPress visual editor.

The plugin can be automated to add the functionality for all links.

Tinytips tooltips are added for all links that have a "title" attribute.

See the <a href="http://www.techotronic.de/plugins/jquery-tinytips/">plugin page</a> for demo pages.

For more information visit the <a href="http://wordpress.org/extend/plugins/jquery-tinytips/faq/">FAQ</a>.
If you have questions or problems, feel free to write an email to blog [at] techotronic.de or write an entry at <a href="http://wordpress.org/tags/jquery-tinytips?forum_id=10">the jQuery Tinytips WordPress.org forum</a>

Localization

* English (en_EN) by <a href="http://www.techotronic.de/">Arne Franken</a>
* German (de_DE) by <a href="http://www.techotronic.de/">Arne Franken</a>

Includes <a href="http://plugins.jquery.com/project/tinytips">Tinytips</a> 1.1 jQuery plugin from <a href="http://www.mikemerritt.me/">Mike Merritt</a>.
Tinytips is licensed as <a href="http://www.mikemerritt.me/plugins/tinyTips/license.txt">free of charge for anyone</a>.
jQuery Colorbox uses the jQuery library version 1.4.2 bundled with WordPress 3.0.

== Installation ==

###Updgrading From A Previous Version###

To upgrade from a previous version of this plugin, use the built in update feature of WordPress or copy the files on top of the current installation.

###Installing The Plugin###

Either use the built in plugin installation feature of WordPress, or extract all files from the ZIP file, making sure to keep the file structure intact, and then upload it to `/wp-content/plugins/`. Then just visit your admin area and activate the plugin. That's it!

###Configuring The Plugin###

Go to the settings page and choose one of the themes bundled with the plugin and other settings.
Do not forget to activate auto Colorbox if you want Colorbox to work for all images.

**See Also:** <a href="http://codex.wordpress.org/Managing_Plugins#Installing_Plugins">"Installing Plugins" article on the WP Codex</a>

== Screenshots ==

<a href="http://www.techotronic.de/plugins/jquery-tinytips/theme-screenshots/">Please visit my site for screenshots</a>.

== Frequently Asked Questions ==

* Why is jQuery Tinytips not available in my language?

I speak German and English fluently, but unfortunately no other language well enough to do a translation.

Would you like to help? Translating the plugin is easy if you understand English and are fluent in another language.

* How do I translate jQuery Tinytips?

Take a look at the WordPress site and identify your langyage code:
http://codex.wordpress.org/WordPress_in_Your_Language


E.g. the language code for German is "de_DE".


Step 1) download POEdit (http://www.poedit.net/)


Step 2) download jQuery Colorbox (from your FTP or from http://wordpress.org/extend/plugins/jquery-tinytips/)


Step 3) copy the file localization/jquery-tinytips-en_EN.po and rename it. (in this case jquery-tinytips-de_DE.po)


Step 4) open the file with POEdit.


Step 5) translate all strings. Things like "{total}" or "%1$s" mean that a value will be inserted later.


Step 5a) The string that says "English translation by Arne ...", this is where you put your name, website (or email) and your language in. ;-)


Step 5b) (optional) Go to POEdit -> Catalog -> Settings and enter your name, email, language code etc


Step 6) Save the file. Now you will see two files, jquery-tinytips-de_DE.po and jquery-tinytips-de_DE.mo.


Step 7) Upload your files to your FTP server into the jQuery Tinytips directory (usually /wp-content/plugins/jquery-tinytips/)


Step 8) When you are sure that all translations are working correctly, send the po-file to me and I will put it into the next jQuery Tinytips version.

* My question isn't answered here. What do I do now?

Feel free to write an email to blog [at] techotronic.de or open a thread at <a href="http://wordpress.org/tags/jquery-tinytips?forum_id=10">the jQuery Tinytips WordPress.org forum</a>.

I'll include new FAQs in every new version. Promise.

== Changelog ==
= 1.1 (2011-01-16) =
* CHANGE: made plugin compatible to PHP4
* CHANGE: removed warning for PHP4

= 1.0 (2010-12-31) =
* NEW: initial release