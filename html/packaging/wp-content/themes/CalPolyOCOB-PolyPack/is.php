<?php// File: is.php ?>
<?php /* Template Name: IS
*/ ?> 
<?php get_header(); ?>
<?php get_sidebar(); ?>
<!-- This is is.php -->
<!-- tyler was here yo-->
<div>
	<div id="content">
		<?php get_sidebar(); ?>
		<div>
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<link rel="StyleSheet" href="http://www.cob.calpoly.edu/wp-content/uploads/IS_2011/IS_Styles.css" type="text/css">                        
				<script type="text/javascript" src="http://www.cob.calpoly.edu/wp-content/uploads/IS_2011/IS_JavaScript.js"></script>
	
			<div id="post-<?php the_ID(); ?>" <?php if(function_exists('post_class')) : post_class(); else : echo 'class="post"'; endif; ?>>           			
				<h3 class="post-title"><?php the_title(); ?></h3>
      		<img src="http://www.cob.calpoly.edu/wp-content/uploads/IS_2011/ISBanner.gif" height="200px" style="margin-left:75px; float:left;">
				   <div class="IS_Links">
            
        <div class="clear"><br /></div>			
				<?php the_content(); ?>			
      
				</div>
				<div class="clear"></div>								
			</div>
            
            <?php edit_post_link('[edit page]', '<p>', '</p>'); ?>
		
		<?php endwhile; ?>
		
		<?php else : ?>
		
		<div class="box-left" id="searchform">
			<h3 class="post-title">Not found!</h3>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>		
		</div>
       
		<?php endif; ?>
	
	</div><!-- end content-left -->
	  	
	</div><!-- end content -->
</div><!-- end content-2col -->
<?php get_footer(); ?>