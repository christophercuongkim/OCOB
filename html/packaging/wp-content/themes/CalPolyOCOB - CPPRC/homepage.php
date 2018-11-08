<?php// File: homepage.php ?>
<?php
/**
  * Template name: Homepage OCOB
  */
include("header.php") ?>
<a name="topH1"></a>
<?php /*
<div id="heroContainer">

    <a id="imageArrowLeft" href="javascript:void(0);">
        <img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Previous Article" />
    </a>

    <a id="imageArrowRight" href="javascript:void(0);">
        <img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Next Article" />
    </a>

    <div id="imageScrollerContainer">
    <!--DO NOT EDIT THIS FRAMEWORK CODE FOR ROTATOR-->
    	<div id="heroTextVisible" aria-live="polite">
    		<div class="articleDate"></div>
            <h2></h2>
            <p></p>
            <a href="#"></a>
<!--             <a id="readAllStories" href="#">Read All Stories ></a> -->
        </div><!--heroTextVisible-->
    <!--END OF DON'T EDIT SECTION-->

    <div id="imageScrollerWindow">
	<?php
    global $post;
    $args = array( 'numberposts' => $homepage_count, 'offset'=> 0, 'category' => $homepage_category );
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) :	setup_postdata($post);
			if(has_post_thumbnail( get_the_ID() )):
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
			?>
			<!--Begin Article 1. This article will appear first-->

							<div class="heroBlock">
									<div class="scrollerImage"><?php
										$flag = 0;
										if(get_post_custom_values("video",get_the_ID())[0] == 1){
											$flag = 1;
											echo "<a href=\"".get_post_custom_values("full_link",get_the_ID())[0]."\" rel=\"prettyPhoto\" data-lightbox-type=\"iframe\">";
										}
									?><?php the_post_thumbnail(); ?>
									<?php if($flag == 1) echo "</a>"; ?></div>
									<div class="heroTextHolder">
											<!-- <div class="articleDate"><?php the_date(); ?></div> -->
											<h2>Orfalea College of Business</h2>
											<?php the_excerpt();?>
                                            <?php if(get_field("url_link")) { ?>
											<!--<a href="<?php //echo get_field("url_link"); ?>">More Info</a>-->
                                            <?php } ?>
									</div><!--heroTextHolder-->
							</div><!--heroBlock-->
			<!--End Article 1-->
		  <?php
		 endif;
	 endforeach; ?>

        </div><!--imageScrollerWindow-->

    	<div class="spacer"></div>

    </div><!--heroTextVisible-->

    <div id="smallControls">
        <a id="smallPrev" href="javascript:void(0);">
            <img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_prev.png" alt="Previous Article" />
        </a>

        <a id="smallPause" href="javascript:void(0);">
            <img  style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_pause.png" alt="Pause Rotation" />
        </a>

        <a id="smallNext" href="javascript:void(0);">
            <img style="max-width:none;" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_next.png" alt="Next Article" />
        </a>
    </div><!--smallControls-->

</div><!--heroContainer-->

<!-- Mobile Scroller -->
<div id="agnosia-bootstrap-carousel" class="carousel slide " style="margin-top:1em;">
<ol class="carousel-indicators">
<?php
$i = 0;
 global $post;
    $args = array( 'numberposts' => $homepage_count, 'offset'=> 0, 'category' => $homepage_category );
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

<?php
//the_post_thumbnail();
/*Hey Bo, this is where I added the functionality to open a new window if the slide is a video.
$isVideo =  get_post_custom_values("video",get_the_ID())[0];
$theVideo = get_post_custom_values("full_link",get_the_ID())[0];
if ( $isVideo == 1) {?>

	<a href="<?php echo $theVideo ?>" target="_blank" title="Go To Video - (Opens New Window)"><img style="margin-bottom:0px" src="<?php echo $large_image_url; ?>" /></a>
<?php } else { ?>
<img style="margin-bottom:0px" src="<?php echo $large_image_url; ?>" />
<?php } ?>

<div class="carousel-caption "><p><?php the_excerpt(); ?></p></div>
</div>
<?php $i++;
endif;
endforeach; ?>
</div>
<a class="carousel-control left" href="#agnosia-bootstrap-carousel" data-slide="prev">‹</a><a class="carousel-control right" href="#agnosia-bootstrap-carousel" data-slide="next">›</a>
</div>
<script type="text/javascript">// <![CDATA[
jQuery(document).ready( function($) { $('#agnosia-bootstrap-carousel').carousel( { interval : 10000 , pause : "hover" } ); } );
// ]]&gt;</script> <?php */ 

getSlider(get_field('sliderID')); ?>

<?php
 		$id=get_the_ID();
 		$post = get_post($id);
 		$content = apply_filters('the_content', $post->post_content);
 		//echo $content;
 		?>

<?php


get_footer(); ?>