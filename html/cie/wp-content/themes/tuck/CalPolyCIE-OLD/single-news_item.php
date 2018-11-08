<?php get_header(); ?>

<div class="binding subpage blog news-item">

	<header>

		<h1>News</h1>

	</header>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

			<?php echo cie_the_post_thumbnail_caption($post->ID); ?>

			<div class="copy">
				<div class="inner">

					<div class="byline">
						<span>by <a href="#" class="author"><?php the_author(); ?></a></span>
                        <span><?php the_date(); ?></span>
                        <span><?php the_category(', '); ?></span>
                        <span><?php the_tags(""); ?></span>
					</div>

					<?php the_content(); ?>

				</div>
			</div>

			<?php get_template_part('share','index'); ?>

		</article>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>



	<?php comments_template(); ?> 

</div>

<div class="binding">
	<?php previous_post_link('<div class="blog-prev-next"><div class="inner">Previous Story %link </div></div>'); ?>
	<?php next_post_link('<div class="blog-prev-next"><div class="inner">Next Story %link </div></div>'); ?>
</div>

<?php get_footer(); ?>