<?php get_header(); ?>  
<?php
/**
  *  Template Name: IT Gallery
  */
    get_sidebar('area');
    ?> 
    <div id="content">
    <div id="contentLine"></div>
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
    
    <link type="text/css" href="http://www.cob.calpoly.edu/wp-content/uploads/it/styles/left.css" rel="stylesheet" />
<!--	Jake - This may cause issue with our jquery 1.6?	<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-->
		<script type="text/javascript" src="http://www.cob.calpoly.edu/wp-content/uploads/it/lib/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="http://www.cob.calpoly.edu/wp-content/uploads/it/lib/jquery.pikachoose.min.js"></script>
		<script language="javascript">
			$(document).ready(function (){
					$("#pikame").PikaChoose({carousel:true, carouselVertical:true});
				});
		</script>
    
   <?php echo get_the_post_thumbnail(); ?>
    <div id="mainLeftFull">
    <div class="post">
      <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <div class="entry">
      <?php the_content(); ?>
      </div>
    </div>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->
    </div> <!-- content -->
    <div class="clear"></div>
<?php get_footer(); ?>