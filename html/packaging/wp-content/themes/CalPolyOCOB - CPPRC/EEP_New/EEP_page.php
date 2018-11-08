<?php// File: EEP_page.php ?>

<?php get_header(); ?>

<?php
/**
  *  Template Name: EEP Page Template
*/

 get_sidebar('eepNew'); ?>

<div id="content">
  <div id="contentLine"></div>
  <style>
#bottomPost{
	margin-top: -10px;
}
.top{
	text-align: center;
}

.top img{
	float: inherit;
	padding: inherit;
}


</style>

  <?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post(); ?>
	<?php
    echo get_the_post_thumbnail();?>
    <!-- <div id="mainLeft"> -->
    <?php
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
