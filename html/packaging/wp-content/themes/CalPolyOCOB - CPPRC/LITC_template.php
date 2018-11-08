<?php// File: LITC_template.php ?>
<?php get_header(); ?>


<?php
/**
  *  Template Name: LITC Template
*/

 get_sidebar('litc'); ?>

<div id="content">

  <style>
#bottomPost{
	margin-top: -10px;
}
.top{
	text-align: center;
}
</style>


<?php /* ?> <!-- New Carousel -->
<?php
$i = 0;
 $currentPost = get_post();
 $count = 10;
 $category = 7;
    $args = array( 'numberposts' => $count, 'offset'=> 0,'orderby' => 'slider_num','order' => 'ASC', 'category_name' => 'slider' );
    $myposts = get_posts( $args );
    
    if(sizeof($myposts)>0){
?>
<div id="agnosia-bootstrap-carousel" class="carousel slide " style="display:block;margin-top:1em;width:100%;">
<ol class="carousel-indicators">
<?php
foreach( $myposts as $post ) {
if($i == 0) { ?>
	<li data-target="#agnosia-bootstrap-carousel" data-slide-to="0" class="active"></li>
 <?php } else  { ?>
<li data-target="#agnosia-bootstrap-carousel" data-slide-to="<?php echo $i; ?>"></li>
<?php }
$i++;
 } ?>
</ol>
<div class="carousel-inner">
<?php
$i = 0;
foreach( $myposts as $post ) :	setup_postdata($post);
if(has_post_thumbnail( get_the_ID() )):
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large')[0];
	if($i == 0) { ?>
	<div class="item active" data-slide-no="<?php echo $i; ?>">
			<?php } else {
			?>
<div class="item" data-slide-no="<?php echo $i; ?>">
<?php } ?>
<?php //the_post_thumbnail(); ?>
<img style="margin-bottom:0px; width:100%; height:auto;" src="<?php echo $large_image_url; ?>" />
<?php if (get_the_excerpt()) { ?>
<div class="carousel-caption "><p><?php the_excerpt(); ?></p></div>
<?php } ?>
</div>
<?php $i++;
endif;
endforeach; ?>
</div>
<a class="carousel-control left" href="#agnosia-bootstrap-carousel" data-slide="prev">‹</a><a class="carousel-control right" href="#agnosia-bootstrap-carousel" data-slide="next">›</a>
</div>
<script type="text/javascript">// <![CDATA[
jQuery(document).ready( function($) { $('#agnosia-bootstrap-carousel').carousel( { interval : 10000 , pause : "hover" } ); } );
// ]]&gt;</script>
<?php
}
?>
<!-- End Slider --> <?php */ ?>

	<?php getSlider(get_field('sliderID')); ?> 
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
