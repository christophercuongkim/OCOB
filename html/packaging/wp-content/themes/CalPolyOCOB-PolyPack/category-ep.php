<?php// File: category-ep.php ?>
<style>
.mentorList {
  display: block;
  margin-left:25px;
  margin-right: auto;
}
</style>

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
      <?php /* If this is a category archive */  ?>
      <?php
	  $chars = array("/", " ");
	   $cat = get_query_var('cat');
  $yourcat = get_category ($cat);
  $photoName = ucwords( $yourcat->name );
		$photoName = str_replace("&", "", $photoName);
		$photoName = str_replace(" amp;", "", $photoName);
		$photoName = str_replace($chars, "_", $photoName);
		echo "<img style='margin:0px;' src='http://www.cob.calpoly.edu/wp-content/uploads/EPIcons/".$photoName.".png' title='$theCategory' height='25px' width='25px'/> "; 
		 single_cat_title();
		 ?>
    
    </h1>
    <?php
		$mentorsCatArr = array();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts($query_string . '&showposts=-1&paged=' . $paged);
		if(have_posts()) : ?>
    <?php while(have_posts()) : the_post();	
		array_push($mentorsCatArr, get_the_title());	
	endwhile;
	wp_reset_postdata();
	function lastNameSort($a, $b) {
		$aLast = end(explode(' ', $a));
		$bLast = end(explode(' ', $b));
	
		return strcasecmp($aLast, $bLast);
	}
	usort($mentorsCatArr, 'lastNameSort');
	?>
    <div class="mentorList">
    <?php foreach($mentorsCatArr as $mentorName) {
		$post = get_page_by_title( $mentorName, "OBJECT", "post" );
		$id = $post->ID; ?>
    <div class="mentor" style="float:left; margin: 0px 5px 5px 0px; height:200px; width:210px; overflow:hidden;">
    
          <center>
    		<a href="<?php the_permalink($id); ?>">
          <?php if(has_post_thumbnail( $id )) {
			  echo get_the_post_thumbnail($id, array(100,100));
		  } else {
			  echo "<img src='http://www.cob.calpoly.edu/executive-partners/files/2013/10/no_image.gif' width='100px' height='100px' />"; 
          } ?>
          <br /><u>
          <?php echo "<h3 style='margin-bottom:5px;'>".get_the_title($id)."</h3>"; //Mentors name ?></u>
          
          </a>
          <?php
		  $excerpt = get_post_custom_values("excerpt", $id);
			echo $excerpt[0]; ?>
            </center>
    </div>    
    <?php 
	} ?>
    </div>
    <?php endif; ?>
  </div>
  <!--mainLeftFull--> 
  
</div>
<!--mainCol-->

<div class="clear"></div>
<?php get_footer(); ?>
