<ul class="widgets">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Left') ) { ?>

	<li class="widget widget_search">
		<h2><?php _e('Recent Posts','comet'); ?></h2>
		<ul>
			<?php wp_get_archives('type=postbypost&limit=5'); ?>
		</ul>
	</li>
	
	<li class="widget widget_links">
		<h2><?php _e('Bookmarks','comet'); ?></h2>
		<ul>
			<?php wp_list_bookmarks('title_li&categorize=0'); ?>
		</ul>
	</li>

<?php } ?>

</ul><!-- /widgets -->