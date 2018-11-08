<style>
.mentorAvail{
	cursor: pointer;
	-webkit-box-shadow: 0 1px 0 rgba(0,0,0,.05);
	box-shadow: 0 1px 0 rgba(0,0,0,.05);
	background-color: #53a93f;
	border: 1px solid #53a93f;
	color: #fff;
	text-shadow: none;
	padding: 8px 15px;
	margin-left:auto;
	margin-right:auto;
}
.mentorAvail:hover {
	border-color: #4c8534;
	color: #fff;
}
.mentorAvail:active {
	background-color: #4c8534;
}

.mentorFull{
	cursor: pointer;
	-webkit-box-shadow: 0 1px 0 rgba(0,0,0,.05);
	box-shadow: 0 1px 0 rgba(0,0,0,.05);
	background-color: #E60000;
	border: 1px solid #E60000;
	color: #fff;
	text-shadow: none;
	padding: 8px 15px;
	margin-left:auto;
	margin-right:auto;
}
.mentorFull:hover {
	border-color: #4c8534;
	color: #fff;
}
.mentorFull:active {
	background-color: #E60000;
}
</style>

<?php 
if(in_category(6) && $post->post_content == '')
{
	echo '<!-- This is a slider'	;
	echo ' Post Has Content -->';
	header("location:/");
}
get_header(); ?>  
<!-- single.php -->
<?php
      get_sidebar();
	  ?>
      <div id="content">
      <div id="contentLine"></div>
    <?php if(have_posts()) : ?> 
	<?php while(have_posts()) : the_post(); 
    
    
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
    
    <div class="post">
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
       
      <div class="entry">
      <?php 
	  
	  $mentorAvailable = get_post_custom_values("mentor_available", $id);
	  $mentorAvailable = $mentorAvailable[0]; 
	  if(has_post_thumbnail()) { ?>
      <div id="photo" style="float:left; display:inline; margin:0px 10px 0px 0px;">
      <center>
      <?php echo get_the_post_thumbnail($page->ID, 'thumbnail'); ?> <br />
      <?php 
	  ?>
	  <?php if($mentorAvailable == "false") { 
	  $buttonText = (get_option("EP_mentorNotAvailable") != "") ? get_option("EP_mentorNotAvailable") : "Not Available";
	  ?>
      <button class="mentorFull" id='mentorFull'><?php echo $buttonText; ?></button>
	  <?php } else { 
	  $buttonText = (get_option("EP_addMentorButton") != "") ? get_option("EP_addMentorButton") : "Add Mentor";
	  ?>
      <form action="../mentor-request-form/" method="post">
      <input type="hidden" id="mentor" name="mentor" value="<?php the_title(); ?>" size="20" />
      <button class="mentorAvail" id='mentorAvail'><?php echo $buttonText; ?></button>
      </form>
      <?php } ?>
      </center>
      </div>
      <?php } ?>
      <?php the_content(); ?>
      <?php if(!has_post_thumbnail()) { ?>
      <?php if($mentorAvailable == "false") { 
	  $buttonText = (get_option("EP_mentorNotAvailable") != "") ? get_option("EP_mentorNotAvailable") : "Not Available";
	  ?>
      <button class="mentorFull" id='mentorFull'><?php echo $buttonText; ?></button>
	  <?php } else { 
	  $buttonText = (get_option("EP_addMentorButton") != "") ? get_option("EP_addMentorButton") : "Add Mentor";
	  ?>
      <form action="../mentor-request-form/" method="post">
      <input type="hidden" id="mentor" name="mentor" value="<?php the_title(); ?>" size="20" />
      <button class="mentorAvail" id='mentorAvail'><?php echo $buttonText; ?></button>
      </form>
      <?php } ?>
      <?php } ?>
      </div>
      

    
    </div>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->

    </div> <!-- content -->
        
        <div class="clear"></div>

<?php get_footer(); ?>
