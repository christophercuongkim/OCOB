<?php get_header(); ?>

<div class="binding subpage main">


	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<header>

			<h1><?php the_title(); ?></h1>

		</header>

		<?php
		if($post->post_parent) {
			$children = wp_list_pages('sort_column=menu_order&depth=1&title_li=&child_of='.$post->post_parent.'&echo=0');
			$home = '<li><a href="'.get_the_permalink($post->post_parent).'">Home</a></li>';
		}

		else {
			$children = wp_list_pages('sort_column=menu_order&depth=1&title_li=&child_of='.$post->ID.'&echo=0');
			$home = '<li class="current_page_item"><a href="'.get_the_permalink($post->ID).'">Home</a></li>';
		}
		if ($children) { ?>

			<nav class="subpage-menu">
				<ul>
					<?php echo $home; ?>
					<?php echo $children; ?>
				</ul>
			</nav>  

		<?php } ?>
		<article class="post">

			<div class="copy">
				<div class="inner">

					<?php the_content(); ?>
					
				</div>
			</div>

		</article>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

	<?php 
		$prev_link = get_previous_posts_link(__('&laquo; Older Entries'));
		$next_link = get_next_posts_link(__('Newer Entries &raquo;'));
		if ($prev_link || $next_link):
	?>
	<div class="blog-pagination">
		<?php echo paginate_links(); ?>
	</div>
	<?php else: ?>
		<div class="pagination-buffer"></div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>