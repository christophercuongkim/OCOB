<?php include_once(dirname(__FILE__) . '/functions.php'); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php if(is_home() || is_search()) { bloginfo('name'); echo ' - '; bloginfo('description'); } else { wp_title('') ;} ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
</head>

<body>

<div id="headerwrap">

<div id="header">
<div style="float: left"><a href="<?php bloginfo('url'); ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/your_logo.png" alt="<?php bloginfo('name'); ?>" width="150" height="111" border="0" /></a></div>
<div class="header"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></div>
<div class="description"><?php bloginfo('description'); ?></div>
</div>

<div id="adheader">
<?php include (TEMPLATEPATH . '/ad_header.php'); ?>
</div>
</div>

<div class="navborder">&nbsp;</div>
<div id="navwrap">
<div id="navigation">
<ul>
<?php include (TEMPLATEPATH . '/top_nav.php'); ?>
</ul>
</div>
</div>

<div class="navborder">&nbsp;</div>
<div id="ledge">&nbsp;</div>
