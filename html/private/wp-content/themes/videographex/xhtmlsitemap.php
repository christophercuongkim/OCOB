<?php
/*
Template Name: xhtmlsitemap
*/
?> 

<?php get_header(); ?>

<div id="wrapper">
<div id="mainbody">
<div id="content">
<h1><?php the_title(); ?></h1>

<h2>Categories</h2>
<ul><?php wp_list_cats('sort_column=name&optioncount=1&exclude=34, 35, 36'); ?></ul>

<h2>The Latest 100 Videos</h2>
<div class="postentry">
<ul>
<?php $archive_query = new WP_Query('showposts=100');
while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>

<h2>Monthly Archives</h2>
<ul><?php wp_get_archives('type=monthly'); ?></ul>

<h2>Pages</h2>
<ul><?php wp_list_pages('title_li='); ?></ul>

</div>
</div>

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
