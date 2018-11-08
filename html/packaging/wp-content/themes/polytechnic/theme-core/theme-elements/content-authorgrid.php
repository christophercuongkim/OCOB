
<article id="post-<?php the_ID(); ?>" class="five columns" <?php post_class(); ?>>
	<header class="entry-header clearfix">		
		<?php if(ot_get_option('show_title') != "off" ) : ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>

        <hr class="title"/>
	</header><!-- .entry-header -->

	<!-- Begin Post Meta -->
	<div class="entry-meta clearfix">

		<?php if(ot_get_option('show_post_meta') == "on" ) : ?>
			<?php if (has_post_thumbnail( $post->ID )) : ?>
				<?php
					$thumb = get_post_thumbnail_id(); 
					$image = vt_resize( $thumb, '', 520, 250, true );
				?>
				<div class="entry-media">
					<?php if ( !is_single() ) : ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
						<div class="entry-media-inner">
							<img src="<?php echo esc_url( $image['url'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>" />
						</div>
					<?php if ( !is_single() ) : ?></a><?php endif; ?>
				</div>
			<?php endif; ?>

		<?php else: ?>
			<?php if (has_post_thumbnail( $post->ID )) : ?>
				<?php
					$thumb = get_post_thumbnail_id(); 
					$image = vt_resize( $thumb, '', 765, 250, true );
				?>
				<div class="entry-media left">
					<?php if ( !is_single() ) : ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
						<div class="entry-media-inner">
							<img src="<?php echo esc_url( $image['url'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>" />
						</div>
					<?php if ( !is_single() ) : ?></a><?php endif; ?>
				</div>
			<?php endif; ?>

		<?php endif; ?>


		<?php if(ot_get_option('show_post_meta') == "on" ) : ?>
		 				
			<div class="meta-string">
				<span class="format-icon"><i class="gen-enclosed foundicon-page" title="Standard Post"></i></span>
				
				<?php if(ot_get_option('show_by') == "on" ) : ?>
					<div class="entry-meta-item">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe600;"></i></span>
						<span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
					</div>
				<?php else : ?>
					<!-- hAtom Requirement - Author -->
					<span class="vcard author"><span class="fn"></span></span>
				<?php endif; ?>

				<?php if(ot_get_option('show_date') == "on" ) : ?>
					<div class="entry-meta-item">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe616;"></i></span>					
						<span class="date updated"><?php the_time('F j, Y'); ?></span>
					</div>
				<?php else : ?>
					<!-- hAtom Requirement - Date -->
					<span class="date updated"></span>
				<?php endif; ?>

				<?php if(ot_get_option('show_categories') == "on" ) : ?>
					<div class="entry-meta-item">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe60e;"></i></span>	
						<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'mythology' ) );
							if ( $categories_list && mythology_categorized_blog() ) :
						?>
						<span class="cat-links clearfix">
							<?php printf( __( '%1$s', 'mythology' ), $categories_list ); ?>
						</span>
						<?php endif; // End if categories ?>
					</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_comments_count') == "on" ) : ?>
					<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<div class="entry-meta-item">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe611;"></i></span>	
							<span class=""><?php comments_popup_link( __( 'Leave a comment', 'mythology' ), __( '1 Comment', 'mythology' ), __( '% Comments', 'mythology' ) ); ?></span>
						</div>
					<?php endif; ?>
				<?php endif; ?>

			</div>
		
		<?php endif; ?>

	</div>
	<!-- /End Post Meta -->
	
	<?php if(ot_get_option('show_edit') == "on" ) : ?>
		<?php edit_post_link( __( 'Edit', 'mythology' ), '<span class="edit-link button">', '</span>' ); ?>
	<?php endif; ?>


</article><!-- #post-## -->