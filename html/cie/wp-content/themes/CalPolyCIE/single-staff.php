<?php get_header(); ?>

<div class="binding subpage staff">

	<header>

		<h1><?php the_title(); ?></h1>

	</header>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="copy">
				<div class="inner">

					<?php $staff_photo = get_field( 'staff_photo' ); ?>
					<?php if ( $staff_photo ) { ?>
						<?php echo wp_get_attachment_image( $staff_photo, 'full' ); ?>
					<?php } ?>

					<?php $staff_title = get_field( 'staff_title' ); ?>
					<?php if ( $staff_title ) { ?>
						<h2><?php the_field( 'staff_title' ); ?></h2>
					<?php } ?>

					<?php $staff_email = get_field( 'staff_email' ); ?>
					<?php if ( $staff_email ) { ?>
						<h5><em><a href="mailto:<?php the_field( 'staff_email' ); ?>"><?php the_field( 'staff_email' ); ?></a></em></h5>
					<?php } ?>

					<?php $staff_bio = get_field( 'staff_bio' ); ?>
					<?php if ( $staff_bio ) { ?>
						<?php the_field( 'staff_bio' ); ?>
					<?php } ?>

				</div>
			</div>

			<?php get_template_part('share','index'); ?>

		</article>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>


</div>


<?php get_footer(); ?>