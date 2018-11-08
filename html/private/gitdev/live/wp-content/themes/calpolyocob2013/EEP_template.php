

<?php get_header(); ?>
<!-- page.php -->

<?php
/**
  *  Template Name: EEP Template
  *  Notes: Currently the site will populate all the post (Mentors) names, but the formatting is not right
*/

 get_sidebar(); ?>

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
      <?php $custom_fields =  get_post_custom(); ?>
      <div id="mentors">
<?php

$args = array(
  'child_of' => 4
  );
$categories = get_categories($args);
  foreach($categories as $category) { 
    $categoryID = get_cat_ID( $category->name);
	$mentorsArgs = array('category' => $categoryID);
$mentors = get_posts( $mentorsArgs );
foreach ( $mentors as $mentor ) {  // The list of all Mentors below
echo $mentor->post_title . "<br />";
?>
	
<?php } 
wp_reset_postdata();
  } 
?>

  </div>
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
