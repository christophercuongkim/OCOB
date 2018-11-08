<?php get_header(); ?>  
<?php
/**
  *  Template Name: 1 Pager - No Navigation
  */
      get_sidebar('area2');
?>
    <div id="content">
    <div id="contentLine"></div>
    
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
    echo get_the_post_thumbnail();
    ?>
    <div id="mainLeftFull">
    <div class="post">
 
      <div class="entry">
      <?php the_content(); ?>
      </div>

    
    </div>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->

    </div> <!-- content -->
        
        <div class="clear"></div>

<?php get_footer(); ?>