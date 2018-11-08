<div id="breadcrumb" style="display:none;"></div>
<?php 
/**
  * Template name: Homepage Choosing Orfalea
  */
get_header(); ?>
<div id="heroContainer">

    <a id="imageArrowLeft" href="javascript:void(0);">
        <img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Previous Article" />	
    </a> 
    
    <a id="imageArrowRight" href="javascript:void(0);">
        <img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Next Article" />
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
    $args = array( 'numberposts' => 10, 'offset'=> 0, 'category' => 6 );
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
                    <!-- <a href="<?php the_permalink(); ?>">Continue Reading ></a>  -->
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
            <img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_prev.png" alt="Previous Article" />
        </a>
    
        <a id="smallPause" href="javascript:void(0);">
            <img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_pause.png" alt="Pause Rotation" />
        </a>
        
        <a id="smallNext" href="javascript:void(0);">
            <img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_next.png" alt="Next Article" />
        </a>
    </div><!--smallControls-->

</div><!--heroContainer-->

<?php 
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);*/


get_footer(); ?>