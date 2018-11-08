<?php get_header(); ?>

<?php if (have_posts()) : ?>
  
	<?php while (have_posts()) : the_post(); ?>

	<!-- post -->
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php if( is_single() ) { ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
	<?php } else { ?>
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php } ?>
		<div class="post-text">
		<?php
		if ( ! empty( $post->post_parent ) ) { ?>
			<p class="page-title">
				<?php _e('This is an attachment for the post','comet'); ?> <a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a>
			</p>
		<?php 
		}
			
		if ( wp_attachment_is_image() ) {
			$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
			foreach ( $attachments as $k => $attachment ) {
				if ( $attachment->ID == $post->ID )
					break;
			}
			$k++;
			// If there is more than 1 image attachment in a gallery
			if ( count( $attachments ) > 1 ) {
				if ( isset( $attachments[ $k ] ) )
					// get the URL of the next image attachment
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
				else
					// or get the URL of the first image attachment
					$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
			} else {
				// or, if there's only 1 image attachment, get the URL of the image
				$next_attachment_url = wp_get_attachment_url();
			}
		?>
			<p class="attachment">
				<?php echo wp_get_attachment_image( $post->ID, array( 900, 9999 ) ); ?>
			</p>
			
			<p><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></p>
						
			<div class="post">
				<div class="alignleft"><?php previous_image_link( false, '&larr; Previous Image' ); ?></div>
				<div class="alignright"><?php next_image_link( false, 'Next Image &rarr;' ); ?></div>
			</div>

		<?php } else { ?>
			<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
		<?php } ?>

		</div>
		<div class="post-meta">
			<div class="row">
				<?php if ( comments_open() ) { ?>
					<div class="alignright"><?php comments_popup_link(__('No Comments','comet'),__('1 Comment','comet'),__('% Comments','comet')); ?></div>
				<?php } ?>
				<span class="post-author">by <?php the_author_posts_link() ?> on </span><em><?php the_time('F j, Y') ?></em>
				&nbsp;&bull;&nbsp; <a href="<?php the_permalink() ?>" rel="bookmark">Permalink</a>
				<?php edit_post_link(__('Edit Post','comet'), ' &nbsp;&bull;&nbsp; ', ''); ?>
			</div>
		</div>
	</div>
	<!--/post -->
	
	<div class="sep"></div>

	<?php comments_template(); ?>
		
	<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; '.__('Older Posts','comet')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Posts','comet').' &raquo;') ?></div>
	</div>

	<?php else : ?>

	<div class="post">
		<h1 class="post-title"><?php _e('Post not found','comet'); ?></h1>
		<div class="post-text">
			<p><?php _e('The post you were looking for could not be found.','comet'); ?></p>
		</div>
	</div>
		
<?php endif; ?>

<?php get_footer(); ?>