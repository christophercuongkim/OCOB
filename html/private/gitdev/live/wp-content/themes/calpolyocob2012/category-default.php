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
		$timestr = NULL;
		if(is_category() && get_query_var('cat') == $cpto->events_cat){
			query_posts('cat='.$cpto->events_cat.'&order=desc&orderby=meta_value&meta_key=event_date');
		}
		if(have_posts()) : ?>
    <?php while(have_posts()) : the_post();
        if(get_query_var('cat') == $cpto->events_cat){
			$meta_date = get_post_meta($post->ID, 'event_date', true);
			$timestr = strtotime($meta_date);
			echo '<!--';
			var_dump($meta_date, strtotime($meta_date));
			echo '-->';
        } 
		?>
    <div class="articleEntry"><?php echo get_the_post_thumbnail($page->ID, 'thumbnail'); ?>
      <div>
        <h2><a href="<?php the_permalink(); ?>">
          <?php the_title();//echo $page->post_title; ?>
          </a></h2>
        <p class="subtitle">
          <?php if($timestr != NULL){ echo date("F j, Y",$timestr); }else{/*the_time("M j, Y");*/ }?>
        </p>
        <?php the_excerpt(); ?>
        <p><a class="continueReading" href="<?php the_permalink(); ?>">Continue reading &rsaquo;</a></p>
      </div>
    </div>
    <!-- <div class="post">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>


			<div class="entry">
			<?php the_content(); ?>
			</div>

		</div> -->
    
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <!--mainLeftFull--> 
  
</div>
<!--mainCol-->

<div class="clear"></div>
<?php get_footer(); ?>
