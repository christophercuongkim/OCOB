<?php 
/**
  * Template name: Homepage OCOB
  */
update_option('current_page_template','homepage');
get_header(); ?>
<?php 
$setup = 0;

 if(have_posts()) : 
		the_post(); 
		//var_dump(get_post_custom());
		$custom = get_post_custom();
		if(isset($custom['homepage_count'][0])){
			$homepage_count = $custom['homepage_count'][0];
			$setup++;
			
		}
		if(isset($custom['homepage_category'][0])){
			$homepage_category = $custom['homepage_category'][0];
			$setup++;
		}
		if(isset($custom['homepage_default'][0])){
			$homepage_count = 10;
			$homepage_category = 6;
			$setup = 2;
		}
		
		
 endif; 
 
 if($setup < 2)
 {
   ?>
   <div style="background-color:#FCC; border:1px solid red; padding: 10px;">
   	<p style="color:red;">To setup this page, use the custom variables: <br />
"<strong>homepage_category</strong>" to indicate the category number to load the posts from,<br />
"<strong>homepage_count</strong>" to indicate the maximum number of posts to load into the slider. <br />
<br />
To use the default settings as in the main blog (category: 6; count: 10) and hide this message, set the custom variable "<strong>homepage_default</strong>" to be "<strong>1</strong>".</p>
   </div>
   <?php 
	 
 }
 
 ?>

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
									<div class="scrollerImage"><?php the_post_thumbnail(); ?></div>
									<div class="heroTextHolder">
											<!-- <div class="articleDate"><?php the_date(); ?></div> -->
											<h2><?php the_title(); ?></h2>
											<?php the_excerpt(); ?>
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
<?php //the_post_thumbnail(); ?>
<img style="margin-bottom:0px" src="<?php echo $large_image_url; ?>" />
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
// ]]&gt;</script>
<?php 
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);*/


get_footer(); ?>