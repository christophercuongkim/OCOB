<?php
/**
 *
 * Used for template-blog.php
 *
 * @package mythology
/**
MARKUP TEMPLATE:

article.hentry
	header.entry-header
		h1.entry-title
		div.entry-date
	div.entry-summary (excerpt)
	or div.entry-content (full content)
	footer.entry-footer
		span.cat-links
		span.tag-links
		span.comments-link
		span.edit-link
**/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">		
		<?php if(ot_get_option('show_title') != "off" ) : ?>
		<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php endif; ?>

		<?php if(ot_get_option('show_date') == "on" ) : ?>
			<div class="entry-date">
			<span class="date updated"><?php mythology_posted_on(); ?></span>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
				if ( has_excerpt() ) :
				    the_excerpt(); ?>
					<a href="<?php echo esc_url( get_permalink($post->ID) ); ?>" class="read-more"><?php __( 'Read more...', 'mythology' ); ?></a> <?php
				else :
				    the_content();
				endif;
			?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mythology' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if(ot_get_option('show_post_footer') == "on" ) : ?>
	<footer class="entry-footer">			
		<?php if(ot_get_option('show_categories') == "on" ) : ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'mythology' ) );
				if ( $categories_list && mythology_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'mythology' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
		<?php endif; ?>

		<?php if(ot_get_option('show_tags') == "on" ) : ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'mythology' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'mythology' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; ?>

		<?php if(ot_get_option('show_comments_count') == "on" ) : ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'mythology' ), __( '1 Comment', 'mythology' ), __( '% Comments', 'mythology' ) ); ?></span>
			<?php endif; ?>
		<?php endif; ?>

		<?php if(ot_get_option('show_edit') == "on" ) : ?>
			<?php edit_post_link( __( 'Edit', 'mythology' ), '<span class="edit-link button">', '</span>' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
	<?php endif; // End Post Footer Conditional ?>

</article><!-- #post-## -->