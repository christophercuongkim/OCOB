<?php// File: news_template.php ?>
<?php get_header(); ?>
<?php
	/**
	*  Template Name: News Posting
	*/
	get_sidebar();
?>
<div id="content">
  <div id="contentLine"></div>
  <?php the_post();

    $quer = 'posts_per_page=-1';
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
    $currentYear = "";//the year that the last post had
    $currentMonth = "";//the month that the last post had
    $year = ""; //the year the post was made
    $month = "";//the month the post was made
    $day = "";//the day the post was made
    $title = ""; //the title of the post
    $link = "";//the link to where the full post is
    ?>
<div class="post news"> <a name="topH1"></a>
    <h1 class="heavy news">Latest News</h1>
    <div id="404" style="display: none">
      <h2><b><br>The URL you entered does not exist.<br><br>It could be that the URL has changed, but the post is still active. Try looking through the list below, or using the search tool in the sidebar on the right.<br></b></h2>
    </div>
    <div class="entry news">
	<p>
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
      <?php
	  $year = get_the_time("Y");
	  $month = get_the_time("M");
	  $day = get_the_time("j");

	  if($year != $currentYear){
		  $currentYear = $year
		  ?>
		  <p></p><p></p><h1 class="year"><?php the_time("Y");?> News Releases</h1><?php
	  }
	  if($month != $currentMonth){
		  $currentMonth = $month
		  ?>
		  </p><h2><?php the_time("F");?></h2><?php
	  }
	  ?>
    <div class="newsEntry">
	  <?php the_time("m/j/y"); ?>
      <a href="<?php the_permalink(); ?>" style="text-decoration: underline;font-size: inherit">
      	<?php the_title();//echo $page->post_title; ?>
      </a>
    </div>
    <?php
      endwhile;
      wp_reset_query();
    ?>
    <p>
  </div>
</div>
<!--main????Full-->
</div>
<!-- content -->
<div class="clear"></div>

<script>

  if(window.location.hash == "#404")
    $("#404").show();

</script>
<?php get_footer(); ?>
