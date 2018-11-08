<?php
/**
 *
 * Used for page.php
 *
 * @package mythology
 /**
MARKUP TEMPLATE:

article.hentry
	header.entry-header
		h1.entry-title
		hr.breadcrumbs-hr
		div.breadcrumbs
	div.entry-content
	footer.entry-footer
		span.edit-link
**/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if(get_custom_field('show_header') == '' OR get_custom_field('show_header') != 'off' ) : ?>
		<header class="entry-header clearfix">

		<?php if(get_custom_field('show_title') == '' OR get_custom_field('show_title') != 'off' ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>

		<!-- Page Breadcrumbs -->
		<?php if(get_custom_field('show_breadcrumbs') == 'on') : ?>
			<div class="breadcrumbs">
				<?php print mythology_breadcrumbs(); ?><br />
			</div>
		<?php endif; ?>

		<hr class="title"/>
	</header>
	<?php endif; ?>
	<!-- .entry-header -->

	<!-- Meta -->
	<?php if(get_custom_field('show_page_meta') == "on" ) : ?>

		<div class="theme_hook meta-string sixteen columns page-meta">
			<span class="format-icon"><i class="gen-enclosed foundicon-page" title="Standard Page"></i></span>
			
			<?php // AUTHOR ?>
			<?php if(get_custom_field('show_page_by') == "on" ) : ?>
				<div class="entry-meta-item columns">
					<span class="bullet"><i aria-hidden="true" data-icon="&#xe600;"></i></span>
					<span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
				</div>
			<?php else : ?>
				<!-- hAtom Requirement - Author -->
				<span class="vcard author"><span class="fn"></span></span>
			<?php endif; ?>

			<?php // DATE ?>
			<?php if(get_custom_field('show_page_date') == "on" ) : ?>
				<div class="entry-meta-item columns">
					<span class="bullet"><i aria-hidden="true" data-icon="&#xe616;"></i></span>					
					<span class="date updated"><?php the_modified_date('F j, Y'); ?></span>
				</div>
			<?php else : ?>
				<!-- hAtom Requirement - Date -->
				<span class="date updated"></span>
			<?php endif; ?>

			<?php // CATEGORIES ?>
			<?php if(get_custom_field('show_page_categories') == "on" ) : ?>
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
			<?php if(get_custom_field('show_page_comments_count') == "on" ) : ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<div class="entry-meta-item columns">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe611;"></i></span>	
						<span class=""><?php comments_popup_link( __( 'Leave a comment', 'mythology' ), __( '1 Comment', 'mythology' ), __( '% Comments', 'mythology' ) ); ?></span>
					</div>
				<?php endif; ?>
			<?php endif; ?>

		</div>

	<?php endif; ?>
	<!-- /End Meta -->

	<!-- hAtom Checks -->
	<?php if ( ( get_custom_field('show_page_meta') != "on" ) ) : ?>
		<div class="microformats-container">
			<!-- hAtom Requirement - Author -->
			<span class="vcard author"><span class="fn"></span></span>
			<!-- hAtom Requirement - Date -->
			<span class="date updated"></span>
		</div>
	<?php endif; ?>
	<!-- /End hAtom Checks -->

	<!-- The Content -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mythology' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<div class="after-content">

		<?php if(get_custom_field('show_page_tags') == "on" ) : ?>
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

		<?php if(get_custom_field('show_page_author_box') == "on" ) : ?>
			<div class="entry-option">
				<?php get_template_part( 'theme-core/theme-elements/element', 'authorbox' ); ?>
			</div>
		<?php endif; ?>

		<?php if(ot_get_option('show_edit') == "on" ) : ?>
			<?php edit_post_link( __( 'Edit', 'mythology' ), '<span class="edit-link button">', '</span>' ); ?>
		<?php endif; ?>

	</div>


	

</article><!-- #post-## -->