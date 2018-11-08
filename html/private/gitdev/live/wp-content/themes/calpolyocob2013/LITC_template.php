

<?php get_header(); ?>
<!-- page.php -->

<?php
/**
  *  Template Name: LITC Template
*/

 get_sidebar('litc'); ?>

<div id="content">
  <div id="contentLine"></div>
  <?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post(); 
      
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
  <div class="post"> 
    <div class="entry">
      <?php the_content(); ?>
      <?php $custom_fields = get_post_custom(); ?>
    </div>
  </div>
  <?php endwhile; ?>
  <?php else: 
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
  ?>
  <div class="post"> <a name="topH1"></a>
    <h1>404 Error - Page Not Found</h1>
    <div class="entry">
      <p>Sorry, the page you were looking for was not found.</p>
    </div>
  </div>
  <?php endif; ?>
</div>
<!--main????Full-->

</div>
<!-- content -->

<div class="clear"></div>
<?php get_footer(); ?>
