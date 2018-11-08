=== inline-javascript ===
Contributors: volca
Donate link: http://www.ooso.net/inline-js
Tags: post, javascript
Requires at least: 2.0.0
Tested up to: 3.0.1
Stable tag: 0.6

Plugin that insert inline javascript in Posts/Pages

== Description ==

Plugin that insert inline javascript in Posts/Pages

== Installation ==
English version:

1. Unzip
1. Copy inline-js.php to direcotry wp-contents/plugin and activate the plugin.
1. Setup
   1. Disable tag balancing ‘WordPress should correct invalidly nested XHTML automatically’ through the ‘Options / Write’ menu in WordPress
   1. Disable the WYSIWYG rich editor in the user’s settings through the ‘Users / Your Profile’ menu
   1. Assign the ‘unfiltered_html’ capability to the user. Assigning capabilities to roles or users is out of the scope of this plugin. Because WordPress has no built-in configuration menu in the admin menu to assign roles/capabilities, you need to install the <a href="http://im-web-gefunden.de/wordpress-plugins/role-manager/">role/capability manager plugins role-manager</a>.
1. Use [inline] and [/inline] tag around the javascript,and post it

中文版本:

1. 解压
1. 复制inline-js.php到wp-contents/plugin目录并激活插件.
1. 设置
  1. 在设置 / 撰写中关闭这个选项"WordPress 应当自动修正无效的 XHTML 嵌套"(‘WordPress should correct invalidly nested XHTML automatically)
  1. 在用户 / 您的个人资料中关闭Use the visual editor when writing
  1. 给你的帐号添加 ‘unfiltered_html’ 权限. 可以通过<a href="http://im-web-gefunden.de/wordpress-plugins/role-manager/">安装role-manager插件</a>来搞定。
1. 在写博客的时候使用[inline],[/inline]包住javascript，并发表

== Frequently Asked Questions ==

nothing yet

== Screenshots ==

nothing yet

== Changelog ==

= 0.6 =
1. works in the excerpt box
1. fix minor bug

= 0.5 =
1. works with && operator


== Arbitrary section ==

nothing yet

== A brief Markdown Example ==

eg.
<pre>
[inline]
&lt;script type="text/javascript"&gt;
document.write("hello world!");
&lt;/script&gt;
[/inline]
</pre>

== More Info ==

For more info, please visit [http://www.ooso.net/inline-js inline-javascript home page].

(For feedback/comments, please send an e-mail to: volca@tom.com ).
