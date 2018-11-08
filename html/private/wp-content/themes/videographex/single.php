<?php get_header(); ?>

<div id="wrapper">
<div id="mainbody">
<div id="contentsingle">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>">
<h1 class="posttitle"><?php the_title() ?></h1>
		
<?php print_video($post) ?>

<p class="postmeta"> 
<?php the_time('F j, Y') ?> <?php /* _e('at'); */ ?> <?php /* the_time() */ ?> &#183; By <?php the_author() ?> 
<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
</p>
<div class="postfeedbacksingle">
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
</div>

<?php the_content_video(__('<p><strong>Continue Reading ...</strong></p>')); ?>
<?php wp_link_pages(); ?>
			
</div>

<div id="adsinglepage">
<?php include (TEMPLATEPATH . '/ad_singlepage.php'); ?>
</div>
		
<?php comments_template(); ?>

<?php endwhile; ?>
<div class="pagenavigation">
<div class="alignleft"><?php next_post_link('&laquo; %link') ?></div>
<div class="alignright"><?php previous_post_link('%link &raquo;') ?></div>
</div>

<?php else : ?>

<h2><?php _e('Not Found'); ?></h2>
<p><?php _e('Sorry, but the page you requested cannot be found.'); ?></p>
<h3><?php _e('Search'); ?></h3>
<p><?php include (TEMPLATEPATH . '/searchform.php'); ?></p>
</div>

<?php endif; ?>
</div>

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

