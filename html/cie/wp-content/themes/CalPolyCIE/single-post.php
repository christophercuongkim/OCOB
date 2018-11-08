<?php get_header(); ?>

<div class="binding subpage blog">

	<header>

		<h1>Blog</h1>

	</header>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

			<?php echo cie_the_post_thumbnail_caption($post->ID); ?>

			<div class="copy">
				<div class="inner">

					<div class="byline">
						by <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?> | <?php the_date(); ?>
						<?php if( has_category() ) {?> | <?php the_category(', '); } ?>
						<?php if( has_tag() ) {?> | <?php the_tags(""); } ?>
					</div>

					<?php the_content(); ?>

				</div>
			</div>

		</article>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>


		<?php get_template_part('share','index'); ?>


</div>

<?php /* //comment out author + comments for now
<div class="blog-post-footer">
	<div class="inner">

		<?php echo get_wp_user_avatar(get_the_author_meta('ID')); ?>

		<div class="name">
			By <strong><?php the_author(); ?></strong>
		</div>
		<div class="contact">
			<a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="mailto:<?php the_author_meta('user_email'); ?>"><?php the_author_meta('user_email'); ?></a>
		</div>

		<p class="description"><?php the_author_meta('description'); ?></p>

	</div>
</div>
*/ ?>

<?php comments_template(); ?>
<div class="binding">
	<?php previous_post_link('<div class="blog-prev-next"><div class="inner">Previous Blog Post %link </div></div>'); ?>
	<?php next_post_link('<div class="blog-prev-next"><div class="inner">Next Blog Post %link </div></div>'); ?>
</div>

<div class="related-posts">
	<div class="binding">
		<h2>Related Blog Posts</h2>
<?php
	wp_reset_query();
    $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);

    if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    $args=array(
    'tag__in' => $tag_ids,
    'post__not_in' => array($post->ID),
    'posts_per_page'=>4, // Number of related posts to display.
    'ignore_sticky_posts'=>1,
    'post_type' => array( 'post' )
    );

    $my_query = new wp_query( $args );

    while( $my_query->have_posts() ) {
    $my_query->the_post();
    ?>

    <article class="post">
    	<div class="inner">
	        <h1><?php the_title(); ?></h1>
	        <?php the_excerpt(); ?>
	        <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
        </div>
    </article>

    <?php }
    }
    $post = $orig_post;
    wp_reset_query();
    ?>	</div>
</div>
<?php get_footer(); ?>