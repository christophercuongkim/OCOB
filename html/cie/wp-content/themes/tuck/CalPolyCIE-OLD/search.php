<?php get_header(); ?>

<div class="binding subpage search">

	<header>

		<h1>Search</h1>

		<h2>Search Term: <span><?php the_search_query(); ?></span></h2>

	</header>


	<div class="copy">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article class="post news">

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php the_excerpt(); ?>	

			<p class="url"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>		

		</article>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>

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