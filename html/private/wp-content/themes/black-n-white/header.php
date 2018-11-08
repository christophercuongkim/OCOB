<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	
</head>

<body>
<div id="wrapper">
<?php /* This code retrieves all our admin options. */
	global $options;
	foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { 
		$$value['id'] = $value['std']; 
	} else { 
		$$value['id'] = get_settings( $value['id'] ); }
	}
?>
	<div id="header">
		<?php if ($bnw_logo_url) { ?>
			<div id="logo">
				<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $bnw_logo_url ?>" alt="<?php bloginfo('name'); ?>" /></a>
			</div>
		<?php } else { ?>
			<div id="htitle">
				<a href="<?php bloginfo('url'); ?>"><h1><?php bloginfo('name'); ?></h1></a>
			</div>
		<?php } ?>
		<?php if ($bnw_no_desc == "false") { ?>
			<div id="desc">
				<?php bloginfo('description'); ?>
			</div>
		<?php } ?>
		<div id="navmenu">
		<ul>
			<li><a href="<?php echo get_settings('home'); ?>">Home</a></li>
			<?php 
				wp_list_pages('sort_column=menu_order&depth=1&title_li='); 

				if ($bnw_rss_feed) {
				?>
					<li><a href="<?php echo $bnw_rss_feed; ?>">
					<?php if ($bnw_rss_title) {
						echo $bnw_rss_title;
					} else {
						echo "RSS Feed";
					} ?></a></li>
				<?php } else { ?>
					<li><a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a></li>
				<?php } ?>
		</ul>
		</div>
	</div>

<?php

?>
