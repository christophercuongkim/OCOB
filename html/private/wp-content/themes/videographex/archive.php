<?php get_header(); ?>

<div id="wrapper">
<div id="mainbody">
<div id="content">

<?php if (have_posts()) : ?>
<?php $post = $posts[0]; ?>

<div class="post">
<?php if (is_category()) { ?>				
<h1><?php echo single_cat_title(); ?></h1>

<?php } elseif (is_month()) { ?>
<h1>Archives for <?php the_time('F Y'); ?></h1>

<?php } ?>

<?php while (have_posts()) : the_post(); ?>

<div class="window">

<div class="paneleft"><?php print_video_thumb($post) ?> </div>

<div class="paneright">
<h2 class="indextitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<div>
<p><?php the_excerpt(); ?></p>
<div class="postfeedback">
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
<?php the_tags(__('Tags: '), ', ', ' &#8212; '); ?>
<?php comments_popup_link(__('Comments'), __('Comments (1)'), __('Comments (%)'), 'commentslink', __('Comments off')); ?>
</div>
</div>
</div>
</div>

<?php endwhile; ?>

<div class="pagenavigation">
<div class="alignleft"><?php previous_posts_link('&laquo; Newer Videos') ?></div>
<div class="alignright"><?php next_posts_link('Older Videos &raquo;') ?></div>
</div>

<?php else : ?>

<h2>...?! Not Found.</h2>
<p class="postmeta">* * *</p>
<div>
<p>Sorry, but you are looking for something that isn't here.</p>
<p><?php include (TEMPLATEPATH . "/searchform.php"); ?></p>
</div>

<?php endif; ?>
</div>
</div>

<?php get_sidebar(); ?>
</div>
		
<?php get_footer(); ?>
