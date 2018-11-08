<ul class="widgets">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Left') ) { ?>

	<li class="widget widget_search">
		<h2><?php _e('Recent Posts','comet'); ?></h2>
		<ul>
			<?php wp_get_archives('type=postbypost&limit=5'); ?>
		</ul>
	</li>
	
	<li class="widget widget_categories">
		<h2><?php _e('Categories','comet'); ?></h2>
		<ul>
			<?php wp_list_categories('sort_column=name&title_li='); ?>
		</ul>
	</li>
		
	<li class="widget widget_archive">
		<h2><?php _e('Archives','comet'); ?></h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
	
	<li class="widget widget_meta">
		<h2>Meta</h2>
		<ul>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
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