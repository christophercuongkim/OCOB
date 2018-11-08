<?php get_header(); ?>

<div class="binding subpage blog">

	<header>

		<h1>News</h1>

		<?php $term = get_term_by( 'slug', get_query_var( 'term' ), 'news_category' ); ?>


		<h2>Category: <span><?php echo $term->name; ?></span></h2>

	</header>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article class="post">

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

			<div class="copy">
				<div class="inner">

					<div class="byline">
						<span>by <a href="#" class="author"><?php the_author(); ?></a></span>
                        <span><?php the_date(); ?></span>
                        <span><?php echo get_the_term_list($post->ID, 'news_category','',', '); ?></span>
                        <span><?php comments_popup_link( 'No Comments Yet', '1 Comment', '% Comments', 'comments-link', 'Comments are off for this post'); ?></span>                    
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