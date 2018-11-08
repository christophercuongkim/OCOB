<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

	<!-- post -->
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="post-text">
		<?php
		the_content(__('Read the full post','comet').' &raquo;');
		wp_link_pages('before=<div class="post-pages">'.__('Pages','comet').':&after=</div>&next_or_number=number&pagelink=<span>%</span>');
		?>
		</div>
		<div class="post-meta">
			<div class="row">
				<?php /*if ( comments_open() ) { ?>
					<div class="alignright"><?php comments_popup_link(__('No Comments','comet'),__('1 Comment','comet'),__('% Comments','comet')); ?></div>
				<?php } */?>
				<?php edit_post_link(__('Edit Post','comet'), ' &nbsp;&bull;&nbsp; ', ''); ?>
			</div>
		</div>
	</div>
	<!--/post -->

	<div class="sep"></div>

	<?php endwhile; ?>

	<?php else : ?>

	<div class="post">
		<h1 class="post-title"><?php _e('Page not found','comet'); ?></h1>
		<div class="post-text">
			<p><?php _e('The page you were looking for could not be found.','comet'); ?></p>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>