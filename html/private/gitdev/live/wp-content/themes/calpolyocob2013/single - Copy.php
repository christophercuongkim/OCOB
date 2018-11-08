<?php get_header(); ?>
<?php

//		if(is_active_sidebar(1))
//		{
			get_sidebar();
			echo '<div id="content">';
			echo '<div id="contentLine"></div>';
			$full = '<div id="mainLeft">';   
			//echo get_the_post_thumbnail( $page->ID, 'post-headerimage');
			$enddiv = '</div> <!-- content -->';
/*		}else
		{
			$full = '<div id="mainColFull">';   
			$full .= get_the_post_thumbnail('post-headerimage');
			$enddiv = '';
		}    
		*/
		
		?> 
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php 
		/*if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		echo 'Home'
		//bloginfo('name');
		echo "</a> : ";
		if (is_category() || is_single()) {
			the_category('title_li=');
			if (is_single()) {
				echo " : ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}*/
		echo inner_doc_nav(get_the_content());
		echo $full;
		echo get_the_post_thumbnail('post-headerimage');
		?>
    <div class="post">
		<a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <h4><?php the_date(); ?></h4>
			<div class="entry">
			<?php the_content(); ?>
			</div>

		
		</div>
<?php endwhile; ?>

<?php endif; ?>
	    </div><!--mainLeft-->

  <?php
		echo $enddiv;
		?>  
        
        <div class="clear"></div>

<?php get_footer(); ?>