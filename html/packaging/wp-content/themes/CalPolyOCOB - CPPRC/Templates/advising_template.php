<?php get_header(); 

/**
  *  Template Name: Advising
  */
?>
<style>
@media only screen and (max-width: 480px) {
	
.carousel-control.right, .carousel-control.left {
	top: 40% !important;
}	
}
@media only screen and (max-width: 540px) {

button {
	margin-left:5px !important;
	margin-right:5px !important;
	padding-left:0px !important;
	padding: 0px !important;
	width: 95% !important;
}
a img, a span { vertical-align: middle; }
#wrapper {
	padding-left:0px;
	padding-right:0px;
}
#mainLeft {
	margin-right: 0px;
	width:100%;
}
#content {
	padding: 0px !important;
}
}

@media 
only screen and (max-width: 760px) {
	#buttonDiv {
		width: 318px;
		margin: 0 auto;
	}
	#mainLeft img {
		width:10em;
		padding-right:3px;
		padding-left:3px;
	}
	button {
		width: 95% !important;
	}
}
</style>

<?php get_sidebar(); ?>
<!-- page.php -->
<div id="content">
    <div id="contentLine"></div>
                <!-- New Carousel -->
<div id="agnosia-bootstrap-carousel" class="carousel slide " style="display:block;margin-top:1em;width:100%;">
<ol class="carousel-indicators">
<?php  
$i = 0;
 $currentPost = get_post();
 $count = 10;
 $category = 7;
    $args = array( 'numberposts' => $count, 'offset'=> 0, 'category' => $category );
    $myposts = get_posts( $args );
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
<!-- End Slider -->
    <?php 
	/***    The Loop    ***/
	if(have_posts()): while(have_posts()) : 
		the_post(); 
		echo get_the_post_thumbnail();
		echo inner_doc_nav(get_the_content(), get_post_custom()); // Creates mainfull div 
	// Implicit <div id="mainleft">
		?>
        <div class="post"> <a name="topH1"></a>
            <h1><a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
                </a></h1>
            <div class="entry">
                <?php setup_postdata($currentPost); 
				the_content(); ?>
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
