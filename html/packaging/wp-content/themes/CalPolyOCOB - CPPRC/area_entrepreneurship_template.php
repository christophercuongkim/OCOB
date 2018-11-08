<?php// File: area_template_default.php ?>
<?php get_header(); ?>

<?php
/**
  *  Template Name: AAreas Entrepreneurship
*/
 get_sidebar('area2'); ?>
<style>
.moreInfo:hover {
  cursor: pointer;
}

.hidden, #moreInfo {
  display: none;
}
</style>

<div id="content">
  <div id="contentLine"></div>
  <?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post();

    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
  <div class="post"> <a name="topH1"></a>
    <h1><a href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
      </a></h1>
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