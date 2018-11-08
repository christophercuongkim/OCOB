<?php get_header(); ?>

<div class="binding subpage blog">

	<header>

		<h1>Blog</h1>

	</header>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article class="post">

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

			<div class="copy">
				<div class="inner">

					<div class="byline">
						by <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?> | <?php the_date(); ?>
						<?php if( has_category() ) {?> | <?php the_category(', '); } ?>
						<?php if( has_tag() ) {?> | <?php the_tags(""); } ?>
					</div>

					<?php the_content(); ?>
					
					<footer>
						<?php comments_popup_link( 'No Comments Yet', '1 Comment', '% Comments', 'comments-link', 'Comments are off for this post'); ?> 
					</footer>

				</div>
			</div>

		</article>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

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