<?php
/**
 * Template Name: News Page
 *
 * @package WordPress
 * @subpackage calpoly-cie
 * @since Cal Poly CIE 1.0
 */
get_header(); ?>

<div class="binding subpage news page">

	<header>

		<h1>News</h1>

	</header>


	<?php
		$args = array( 'post_type' => 'news_item', 'posts_per_page' => 5 );
		$loop = new WP_Query( $args );
	?>

	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

		<article class="post news">

			<div class="post-meta"><?php the_date(); ?> | <?php the_category(', '); ?> | <?php comments_popup_link( 'No Comments Yet', '1 Comment', '% Comments', 'comments-link', 'Comments are off for this post'); ?></div>

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>


			<?php the_excerpt(); ?>

			<a href="<?php the_permalink(); ?>">Read More</a>
					

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