<?php 
/**
  *  Template Name: Handbook Template
*/
get_header(); ?>

<!-- page.php -->
<div id="content" style="width:100%; border-right:none;">
    <div id="contentLine"></div>
    <?php 
	$cat_args=array(
  'orderby' => 'id',
  'order' => 'ASC'
   );
$categories=get_categories($cat_args);
$numCategories = count($categories);
	/***    The Loop    ***/
	if(have_posts()): while(have_posts()) : 
		the_post(); 
		echo get_the_post_thumbnail();
		echo inner_doc_nav(get_the_content(), get_post_custom()); // Creates mainfull div
	// Implicit <div id="mainleft">
		?>
        <div class="post"> <a name="topH1"></a>
            <h1><!--a href="<?php// the_permalink(); ?>"> -->
                <?php the_title(); ?>
                <!--</a>--></h1>
            <div class="entry">
                <?php the_content(); ?>
                <?php $i = 0; ?>
                <table cellpadding="0" cellspacing="0">
                <tbody>
                <?php
				foreach($categories as $category) {
					 $args=array(
     					'posts_per_page' => -1,
						  'category' => $category->term_id,
						  'orderby'=>'title',
						  'order' => 'ASC'
						);
						$posts=get_posts($args);
      if ($posts) {
		  if($i % 3 == 0) {
			echo "<tr>";
			}
		  echo "<td valign='top'>";
        echo '<p style="margin-bottom:1em;"><strong>' . $category->name.'</strong></p> ';
        foreach($posts as $post) {
          setup_postdata($post); ?>
          <a style="line-height:2em;" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
          <?php
        } // foreach($posts
		$i++;
      } // if ($posts
				}
				?>
                </tbody></table>
                <?php $custom_fields = get_post_custom(); ?>
            </div>
        </div>
    </div> <!--main(Full?)Left-->
	<?php 
	endwhile; 
	else: 
	?>
    <div class="mainLeftFull">
        <div class="post"> <a name="topH1"></a>
            <h1>404 Error - Page Not Found</h1>
            <div class="entry">
                <p>Sorry, the page you were looking for was not found.</p>
            </div>
        </div>
    </div><!--main(Full?)Left-->
<?php endif; ?>
</div><!-- content -->

<div class="clear"></div>

<?php get_footer(); ?>
