
<?php get_header(); ?>

<div id="wrapper">
<div id="mainbody">
<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h1 class="posttitle"><?php the_title(); ?></h1>			
<div>
<?php the_content_video(__('<p><strong>Continue Reading ...</strong></p>')); ?>
<?php wp_link_pages(); ?>
</div>

<?php endwhile; endif; ?>
<p>&nbsp;</p>
</div>

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
