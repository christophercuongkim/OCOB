<?php// File: category-default.php ?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">
  <div id="contentLine"></div>
  <div id="contentNav">
    <div id="contentNavInner"> </div>
  </div>
  <!--contentNav-->

  <div id="mainLeftFull">
    <h1 style="margin-bottom: 20px;">
      <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
      <?php /* If this is a category archive */ if (is_category()) { ?>
      &#8216;
      <?php single_cat_title(); ?>
      &#8217; Archive
      <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
      Posts Tagged &#8216;
      <?php single_tag_title(); ?>
      &#8217;
      <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
      Archive for
      <?php the_time('F jS, Y'); ?>
      :
      <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
      Archive for
      <?php the_time('F, Y'); ?>
      :
      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
      Archive for
      <?php the_time('Y'); ?>
      :
      <?php /* If this is an author archive */ } elseif (is_author()) { ?>
      Author Archive
      <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        Blog Archives
        <?php } ?>
    </h1>
    <?php
	    $currentYear = "";//the year that the last post had
	    $currentMonth = "";//the month that the last post had
	    $year = ""; //the year the post was made
	    $month = "";//the month the post was made
	    $day = "";//the day the post was made
	    $title = ""; //the title of the post
	    $link = "";//the link to where the full post is
		$timestr = NULL;
	
		//gets the right category
		$url = explode("/",$_SERVER[REQUEST_URI]);
		$index = sizeof($url) - 2;
		$slug =  $url[$index];
		
		$custom = get_post_custom();
		query_posts(array ( 'category_name' => $slug, 'posts_per_page' => -1 ));
		if(have_posts()) : ?>
    <?php while(have_posts()) : the_post();?>
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

    <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <!--mainLeftFull-->

</div>
<!--mainCol-->

<div class="clear"></div>
<?php get_footer(); ?>
