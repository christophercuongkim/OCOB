<?php get_header(); ?>
<!-- faculty_template.php -->
<?php
/**
  *  Template Name: Faculty Template
  *  
  */
  
get_sidebar(); ?>

<div id="content">
  <div id="contentLine"></div>
    <?php if(have_posts() && is_callable(get_field)) : ?>
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
    <?php
    	else: 
			if(!is_callable(get_field)){
				echo '<div class="post"> <a name="topH1"></a><div class="entry"><h3>Configuration Error.</h3><p>This page is dependent on the Advanced Custom Fields plugin. Please verify it is correctly configured.</p></div></div>';
			}else{
				error404();
			}
		endif; ?>
</div>
<!-- content -->

<div class="clear"></div>
<?php get_footer(); ?>

<?php
function error404(){
	echo'<div class="post"> <a name="topH1"></a>
        <h1>404 Error - Page Not Found</h1>
        <div class="entry">
            <p>Sorry, the page you were looking for was not found.</p>
        </div></div>';
}