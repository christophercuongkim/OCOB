<div id="sidebarright">

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2)) : else : ?>

<h2>Subscribe to RSS</h2>
<ul>
<li><a href="<?php bloginfo('rss2_url'); ?>" title="Syndicate this site using RSS"><img src="<?php bloginfo('template_directory'); ?>/images/rsslink.gif" border="none" alt="Subscribe to RSS" /> RSS</a></li>
<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="The latest comments to all posts in RSS"><img src="<?php bloginfo('template_directory'); ?>/images/rsslink.gif" border="none" alt="Subscribe to Comments" /> Comments RSS</a></li>
</ul>

<h2>Search</h2>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<h2>Pages</h2>
<ul><?php wp_list_pages('title_li=' ); ?></ul>

<h2><?php _e('Meta','ml'); ?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional','ml');?>"><?php _e('Valid','ml');?> <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
<li><a href="http://www.zoomstart.com">Zoomstart</a></li>
<?php wp_meta(); ?>
</ul>

<?php endif; ?>

</div>