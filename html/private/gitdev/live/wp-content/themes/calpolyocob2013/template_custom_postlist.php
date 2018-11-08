<?php get_header(); ?>
<?php
/**
  *  Template Name: Custom Post List
  */
      get_sidebar();
    ?>

<div id="content">
  <div id="contentLine"></div>
  <?php the_post(); 
    
    $quer = 'posts_per_page=10';
    $custom = get_post_custom();
    if(!isset($custom['list_categories'][0]) or $custom['list_categories'][0] == '')
    {
      echo "<b>ERROR: This tempate(Custom Post List) requires the custom field 'list_categories' to have a value<br />";
      echo "To set this custom field, make sure the 'Custom Fields' option is checked in 'Screen Options' when editing a page, then scroll down the 'Custom Fields' and add a field with the name 'list_categories' and the value of comma separated category IDs OR 'all' for all categories.</b>";
      exit();
    }
    else if(trim(strtolower($custom['list_categories'][0])) == 'all')
      $quer .= "";
    else
      $quer .= '&cat='.$custom['list_categories'][0];
    
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
  <div class="post"> <a name="topH1"></a>
    <h1><a href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
      </a></h1>
    <div class="entry">
      <?php the_content(); ?>
    </div>
    <?php
      global $page;
      //$args = array( 'numberposts' => 1, 'offset'=> 0, 'category' => 1 );
      //$myposts = get_posts( $args );
      //add_filter( 'excerpt_length', create_function( '', 'return 50;' ) );
      //$pages = get_posts(array('category' => '3,4' ));
      query_posts($quer);
      while ( have_posts() ) : the_post(); ?>
    <div class="articleEntry"><?php echo get_the_post_thumbnail($page->ID, 'thumbnail'); ?>
      <div>
        <h2><a href="<?php the_permalink(); ?>">
          <?php the_title();//echo $page->post_title; ?>
          </a></h2>
        <p class="subtitle">
          <?php //the_time("M j, Y"); ?>
        </p>
        <?php the_excerpt(); ?>
        <p><a class="continueReading" href="<?php the_permalink(); ?>">Continue reading &rsaquo;</a></p>
      </div>
    </div>
    <?php
      endwhile;    
      wp_reset_query();
    ?>
  </div>
</div>
<!--main????Full-->
</div>
<!-- content -->
<div class="clear"></div>
<?php get_footer(); ?>
