<?php// File: LITC_templateTEST.php ?>

<?php get_header(); ?>

<?php
/**
  *  Template Name: LITC Template TEST
*/

 get_sidebar('litc'); ?>

<div id="content">
  <div id="contentLine"></div>
  <style>
#bottomPost{
	margin-top: -10px;
}
.top{
	text-align: center;
}
</style>
<!-- New Carousel -->
<?php
$i = 0;
 $currentPost = get_post();
 $count = 10;
 $category = 7;
    $args = array( 'numberposts' => $count, 'offset'=> 0,'orderby' => 'slider_num','order' => 'ASC', 'category_name' => 'slider' );
    $myposts = get_posts( $args );
   if(sizeof($myposts)>0){
?>

<div id="LITCCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php
			foreach( $myposts as $post ) {
				if($i == 0) { ?>
    				<li data-target="#LITCCarousel" data-slide-to="0" class="active"></li>
    	<?php 	}else{ ?>
					<li data-target="#LITCCarousel" data-slide-to="<?php echo($i); ?>"></li>
		<?php 	}
				$i++;
			}
		?>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  	<?php
  		$i = 0;
  		foreach( $myposts as $post ) :	setup_postdata($post);
  			if(has_post_thumbnail( get_the_ID() )): $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large')[0];
  			if($i == 0) { ?>
  				<div class="item active">
			<?php } else { ?>
				<div class="item">
			<?php } ?>
			<img src="<?php echo $large_image_url; ?>" />
			<?php if (get_the_excerpt()) { ?>
				<div class="carousel-caption "><p><?php the_excerpt(); ?></p></div>
			<?php } ?>
				</div>
<?php $i++; endif; endforeach; ?>
  </div>
  
  <!-- Controls -->
  <a class="left carousel-control" href="#LITCCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only"><</span>
  </a>
  <a class="right carousel-control" href="#LITCCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">></span>
  </a>
  
</div>
<?php }?>
<script>
$(document).ready(function(){
	$("#LITCCarousel").carousel({
		interval: 2000
	});
});
</script>
<!-- End Slider -->
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