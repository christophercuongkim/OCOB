<?php
/**
 *
 * Used for single.php
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
	<header class="entry-header clearfix">
		<?php if(ot_get_option('show_title') != "off" ) : ?>
			<h1 class="entry-title"><?php the_title(); ?>
			</h1>
		<?php endif; ?>

       <hr class="title"/>
	</header><!-- .entry-header -->

	<!-- META -->
	<?php if(ot_get_option('show_post_meta') == "on" ) : ?>

		<!-- Begin Post Meta Container -->
		<div class="entry-meta clearfix">

			<?php if (ot_get_option('show_post_featured_image') != "off" && has_post_thumbnail( $post->ID )) : ?>
				<?php
					$thumb = get_post_thumbnail_id(); 
					$image = vt_resize( $thumb, '', 540, 228, true );
				?>
				<div class="entry-media eleven columns">
					<?php if ( !is_single() ) : ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
						<div class="entry-media-inner">
							<img class="theme_image" src="<?php echo esc_url( $image['url'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>" />
						</div>
					<?php if ( !is_single() ) : ?></a><?php endif; ?>
				</div>
			 				
				<div class="theme_hook meta-string five columns">
					<span class="format-icon"><i class="gen-enclosed foundicon-page" title="Standard Post"></i></span>
					
					<?php // AUTHOR ?>
					<?php if(ot_get_option('show_by') == "on" ) : ?>
						<div class="entry-meta-item">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe600;"></i></span>
							<span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
						</div>
					<?php else : ?>
						<!-- hAtom Requirement - Author -->
						<span class="vcard author"><span class="fn"></span></span>
					<?php endif; ?>

					<?php // DATE ?>
					<?php if(ot_get_option('show_date') == "on" ) : ?>
						<div class="entry-meta-item">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe616;"></i></span>					
							<span class="date updated"><?php the_modified_date('F j, Y'); ?></span>
						</div>
					<?php else : ?>
						<!-- hAtom Requirement - Date -->
						<span class="date updated"></span>
					<?php endif; ?>

					<?php // CATEGORIES ?>
					<?php if(ot_get_option('show_categories') == "on" ) : ?>
						<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'mythology' ) );
							if ( $categories_list && mythology_categorized_blog() ) :
						?>
						<div class="entry-meta-item">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe60e;"></i></span>	
							<span class="cat-links clearfix">
								<?php printf( __( '%1$s', 'mythology' ), $categories_list ); ?>
							</span>
						</div>
						<?php endif; // End if categories ?>
					<?php endif; ?>

					<?php // COMMENT COUNT ?>
					<?php if(ot_get_option('show_comments_count') == "on" ) : ?>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
							<div class="entry-meta-item">
								<span class="bullet"><i aria-hidden="true" data-icon="&#xe611;"></i></span>	
								<span class=""><?php comments_popup_link( __( 'Leave a comment', 'mythology' ), __( '1 Comment', 'mythology' ), __( '% Comments', 'mythology' ) ); ?></span>
							</div>
						<?php endif; ?>
					<?php endif; ?>

				</div>

			<?php else : ?>

				<div class="theme_hook meta-string sixteen columns">
					<span class="format-icon"><i class="gen-enclosed foundicon-page" title="Standard Post"></i></span>
					
					<?php // AUTHOR ?>
					<?php if(ot_get_option('show_by') == "on" ) : ?>
						<div class="entry-meta-item columns">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe600;"></i></span>
							<span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
						</div>
					<?php else : ?>
						<!-- hAtom Requirement - Author -->
						<span class="vcard author"><span class="fn"></span></span>
					<?php endif; ?>

					<?php // DATE ?>
					<?php if(ot_get_option('show_date') == "on" ) : ?>
						<div class="entry-meta-item columns">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe616;"></i></span>					
							<span class="updated"><?php the_modified_date('F j, Y'); ?></span>
						</div>
					<?php else : ?>
						<!-- hAtom Requirement - Date -->
						<span class="date updated"></span>
					<?php endif; ?>

					<?php // CATEGORIES ?>
					<?php if(ot_get_option('show_categories') == "on" ) : ?>
						<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'mythology' ) );
							if ( $categories_list && mythology_categorized_blog() ) :
						?>
						<div class="entry-meta-item columns">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe60e;"></i></span>	
							<span class="cat-links">
								<?php printf( __( '%1$s', 'mythology' ), $categories_list ); ?>
							</span>
						</div>
						<?php endif; // End if categories ?>
					<?php endif; ?>

					<?php // COMMENT COUNT ?>
					<?php if(ot_get_option('show_comments_count') == "on" ) : ?>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
							<div class="entry-meta-item columns">
								<span class="bullet"><i aria-hidden="true" data-icon="&#xe611;"></i></span>	
								<span class=""><?php comments_popup_link( __( 'Leave a comment', 'mythology' ), __( '1 Comment', 'mythology' ), __( '% Comments', 'mythology' ) ); ?></span>
							</div>
						<?php endif; ?>
					<?php endif; ?>

				</div>

			<?php endif; ?>
		</div>

	<?php else : ?>
		<?php if (has_post_thumbnail( $post->ID )) : ?>
			<?php
				$thumb = get_post_thumbnail_id(); 
				$image = vt_resize( $thumb, '', 765, 250, true );
			?>
			<div class="entry-media sixteen columns left">
				<?php if ( !is_single() ) : ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
				<?php if ( !is_single() ) : ?></a><?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<!-- /End Post Meta -->

	<!-- hAtom Checks -->
	<?php if ( ( ot_get_option('show_post_meta') != "on" ) ) : ?>
		<div class="microformats-container">
			<!-- hAtom Requirement - Author -->
			<span class="vcard author"><span class="fn"></span></span>
			<!-- hAtom Requirement - Date -->
			<span class="date updated"></span>
		</div>
	<?php endif; ?>
	<!-- /End hAtom Checks -->

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mythology' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if(ot_get_option('show_post_footer') == "on" ) : ?>

		<div class="after-content">

			<?php if(ot_get_option('show_tags') == "on" ) : ?>
				<?php $post_tags = wp_get_post_tags($post->ID);
					if(!empty($post_tags)) { ?>
						<div class="meta-tags theme_hook">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe60c;"></i></span>	
							<div class="meta-space">					
								<div class="tags clearfix">
									<?php the_tags('',','); ?>					
								</div>									
							</div>
						</div>
				<?php } ?>
			<?php endif; ?>

			<?php if(ot_get_option('show_author_box') == "on" ) : ?>
				<div class="entry-option">
					<?php get_template_part( 'theme-core/theme-elements/element', 'authorbox' ); ?>
				</div>
			<?php endif; ?>

			<?php if(ot_get_option('show_cross_links') == "on" ) : ?>
				<div class="sixteen columns alpha omega">
					<div class="entry-option">
						<?php mythology_content_nav( 'nav-below' ); // NEXT/PREV POST LINKS ?>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if(ot_get_option('show_comments') == "on" ) : ?>
			
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>
			<?php endif; ?>

			<?php if(ot_get_option('show_edit') == "on" ) : ?>
				<?php edit_post_link( __( 'Edit', 'mythology' ), '<span class="edit-link button">', '</span>' ); ?>
			<?php endif; ?>

		</div>

	<?php endif; ?>


</article><!-- #post-## -->