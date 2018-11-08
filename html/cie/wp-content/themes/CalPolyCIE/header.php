<?php

$baseURL = get_bloginfo('url');

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<div id="cal-poly-bar">
		<div class="inner">
			<a href="http://calpoly.edu/">
				<img src="<?php bloginfo('template_directory'); ?>/img/cal-poly-header-logo.png" srcset="<?php bloginfo('template_directory'); ?>/img/cal-poly-header-logo.png 1x, <?php bloginfo('template_directory'); ?>/img/cal-poly-header-logo@2x.png 2x, <?php bloginfo('template_directory'); ?>/img/cal-poly-header-logo@3x.png 3x" alt="Cal Poly San Luis Obispo">
			</a>
		</div>
	</div>

	<div id="top-bar">
		<div class="inner">
			<a href="<?php bloginfo('url'); ?>">
				<img class="logo" src="<?php bloginfo('template_directory'); ?>/img/header-logo.png" alt="Cal Poly Center For Innovation and Entrepeneurship" height="47" width="206">
			</a>
			<?php get_search_form(); ?>
			<div class="menus">
				<nav id="site-nav">
					<ul>
						<li><a href="<?= $baseURL ?>/slo-hothouse"<?php if ( is_page_template('template-hothouse.php')) echo ' class="active"'; ?>>SLO HotHouse</a></li>
						<li><a href="<?= $baseURL ?>/coworking"<?php if ( is_page_template('template-coworking.php')) echo ' class="active"'; ?>>Coworking</a></li>
						<li><a href="<?= $baseURL ?>/news"<?php if ( is_post_type_archive('news_item') || is_singular('news_item') || is_tax('news_category') ) echo ' class="active"'; ?>>News</a></li>
						<li><a href="<?= $baseURL ?>/events"<?php if ( is_tribe_calendar() ) echo ' class="active"'; ?>>Events</a></li>
						<li><a href="<?= $baseURL ?>/blog"<?php if ( is_home() || is_category() || is_tag() || is_singular('post') ) echo ' class="active"'; ?>>Blog</a></li>
						<li><a href="<?= $baseURL ?>/about-cie"<?php if ( is_page_template('template-about.php')) echo ' class="active"'; ?>>About CIE</a></li>
					</ul>
				</nav>
				<nav id="home-nav">
					<ul>
						<li><a href="<?= $baseURL ?>#learn"<?php if ( is_page_template( 'template-learn.php' ) ) echo ' class="active"'; ?>>Learn</a></li>
						<li><a href="<?= $baseURL ?>#prepare">Prepare</a></li>
						<li><a href="<?= $baseURL ?>#launch"<?php if ( is_page_template( 'template-launch.php' ) ) echo ' class="active"'; ?>>Launch</a></li>
						<li><a href="<?= $baseURL ?>#mentors"<?php if ( is_page_template( 'template-mentors.php' ) ) echo ' class="active"'; ?>>Mentors</a></li>
					</ul>
				</nav>
			</div>
			<div id="hamburger">
				Menu
			</div>
		</div>

	</div>