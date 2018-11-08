<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template' 
 * is selected in Events -> Settings -> Template -> Events Template.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

get_header(); ?>


<?php// if ( tribe_is_event() && is_single() ) ?> 

<?php if ( tribe_is_event() && is_singular() ) : ?>

	<div id="primary" class="left eleven columns">

		<main id="main" class="site-main" role="main">		

			<div id="tribe-events-pg-template">
				<?php tribe_events_before_html(); ?>
				<?php tribe_get_view(); ?>
				<?php tribe_events_after_html(); ?>
			</div> <!-- #tribe-events-pg-template -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>

<?php else: ?>
	
	<div id="primary" class="sixteen columns">

		<main id="main" class="site-main" role="main">		

			<div id="tribe-events-pg-template">
				<?php tribe_events_before_html(); ?>
				<?php tribe_get_view(); ?>
				<?php tribe_events_after_html(); ?>
			</div> <!-- #tribe-events-pg-template -->

		</main><!-- #main -->
	</div><!-- #primary -->


<?php endif; ?>


<?php get_footer(); ?>