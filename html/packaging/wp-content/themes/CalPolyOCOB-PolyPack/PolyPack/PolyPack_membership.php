<?php// File: PolyPack_membership.php ?>
<?php get_header(); ?>


<?php
/**
  *  Template Name: Poly Pack Membership
*/

 //get_sidebar('polypack'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo(get_bloginfo("template_directory")); ?>/slick/slick.css"/>
  <style>
#bottomPost{
	margin-top: -10px;
}
.top{
	text-align: center;
}
.slider{
	width: 730px;
	overflow: visible;
	display: inline-block;
	border-top: 5px solid #29551a;
	padding-top: 1px;
	margin-top: 13px;
}
.sideSlider{
	width: 214px;
	height: 333px;
	display: inline-block;
	vertical-align: top;
	border-top: 5px solid #29551a;
	padding-top: 1px;
	margin-top: 13px;
	float: right;
}
#smallPrev{
	vertical-align: bottom;
}
#smallNext{
	vertical-align: bottom;
}
#breadcrumb{
	display: none;
}
.sideSlider h2{
	text-align: left;
	text-transform: uppercase;
	margin-left: 5px;
	font-size: 18px;
	color: #29551a;
}
.sideSlider p{
	text-align: left;
	margin-left: 14px;
	margin-right: 5px;
	overflow: hidden;
	max-height: 170px;
	line-height: 21px;
	font-size: 16px;
	font-family: "Times New Roman", Times, serif;
}
#imageArrowRight{
	display: inline;
	right:-25px;
}
.mobileText{
	display: none;
}
/* Dots */

.slick-dots
{
    position: absolute;
    bottom: -10px;

    display: block;

    width: 100%;
    padding: 0;

    list-style: none;

    text-align: center;
}
.slick-dots li
{
    position: relative;

    display: inline-block;

    width: 20px;
    height: 20px;
    margin: 0 5px;
    padding: 0;

    cursor: pointer;
}
.slick-dots li button
{
    font-size: 0;
    line-height: 0;

    display: block;

    width: 20px;
    height: 20px;
    padding: 5px;

    cursor: pointer;

    color: transparent;
    border: 0;
    outline: none;
    background: transparent;
}
.slick-dots li button:hover,
.slick-dots li button:focus
{
    outline: none;
}
.slick-dots li button:hover:before,
.slick-dots li button:focus:before
{
    opacity: 1;
}
.slick-dots li button:before
{
    font-family: 'slick';
    font-size: 20px;
    line-height: 20px;

    position: absolute;
    top: 0;
    left: 0;

    width: 20px;
    height: 20px;

    content: '•';
    text-align: center;

    opacity: .25;
    color: black;

    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.slick-dots li.slick-active button:before
{
    opacity: .75;
    color: black;
}
@media only screen and (max-width: 760px) {
	.mobileText{
		display: inherit;
		margin: 0 auto;
		display: block;
		width: 98%;
	}
	.sideSlider{
		display: none;
	}
	.slider{
		width: 98%;
		margin: 0 auto;
		display: block;
	}
	#imageArrowLeft, #imageArrowRight{
		display: none !important;
	}
	.widget:first-child{
		margin-top: 0;
	}
}

</style>
	<div class="slider">
	<?php

	//echo (str_replace("/polypack", "", get_bloginfo("template_directory")));
    global $post;
    $custom = get_post_custom();
	$homepage_category = "5";
    $args = array( 'numberposts' => $homepage_count, 'offset'=> 0, 'category' => $homepage_category );
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) :	setup_postdata($post);
			if(has_post_thumbnail( get_the_ID() )):
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large')[0];
			?>
			<div>
				<img data-lazy="<?php echo($large_image_url); ?>" class="attachment-post-thumbnail wp-post-image">
				<div class="mobileText"><?php the_excerpt(); ?></div>
			</div>
			<?php
		 endif;
	 endforeach;
	 ?>
	</div>
	<div class="sideSlider">
		<?php
		$args = array( 'numberposts' => $homepage_count, 'offset'=> 0, 'category' => $homepage_category );
	    $myposts = get_posts( $args );
	    foreach( $myposts as $post ) :	setup_postdata($post);
			if(has_post_thumbnail( get_the_ID() )):
				$title = get_the_title();
				$excerpt = get_the_excerpt();
				?>
				<div>
					<h2><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
				</div>
				<?php
			endif;
		endforeach;
		?>
	</div>



<script src="<?php echo get_bloginfo("template_directory"); ?>/slick/slick.min.js"></script>
<script>
	console.log("HELP");
	$(document).ready(function(){
		console.log("READY");
		$(".slider").slick({
			autoplay: true,
			dots: true,
			pauseOnHover: true,
			speed:1000,
			easing:"easeOutCubic",
			lazyLoad: 'ondemand',
			autoplaySpeed: 5000,
			asNavFor: '.sideSlider',
			prevArrow: '<div id="imageArrowLeft"><img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Previous Article" /></div>',
			nextArrow: '<div id="imageArrowRight"><img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Next Article" /></div>'
		});
		$(".sideSlider").slick({
			autoplay: true,
			pauseOnHover: true,
			autoplaySpeed: 5000,
			speed:1000,
			easing:"easeOutCubic",
			fade: true,
			asNavFor: '.slider',
			prevArrow: '<div id="smallPrev"><img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_prev.png" alt="Previous Article" /></div>',
			nextArrow: '<div id="smallNext"><img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_next.png" alt="Next Article" /></div>'
		});
	});

</script><!--main????Full-->


<!-- content -->

<div class="clear"></div>
<?php get_footer(); ?>
