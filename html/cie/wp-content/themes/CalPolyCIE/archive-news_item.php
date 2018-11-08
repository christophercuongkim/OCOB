<?php get_header(); ?>

<div class="binding subpage news update">

	<header>

		<h1>News</h1>

	</header>


	<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'news_item',
			'posts_per_page' => 5,
			'paged' => $paged
		);
		$WP_Query = new WP_Query( $args );
	?>

	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<article class="post news">

			<div class="post-meta"><?php the_time('F j, Y'); ?><?php if( has_term('', 'news_category') ) {?> | <?php echo get_the_term_list($post->ID, 'news_category','',', '); } ?></div>

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

			<?php echo cie_the_post_thumbnail_caption($post->ID); ?>

			<?php the_content(); ?>
					

		</article>

		<?php endwhile; ?>

	<?php 
		$prev_link = get_previous_posts_link(__('&laquo; Older Entries'));
		$next_link = get_next_posts_link(__('Newer Entries &raquo;'));
		if ($prev_link || $next_link):
	?>
	<div class="blog-pagination">
		<?php echo paginate_links(); ?>
	</div>
	<?php else: ?>
		<div class="pagination-buffer"></div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>