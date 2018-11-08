<?php 
if(in_category(6) && $post->post_content == '')
{
	echo '<!-- This is a slider'	;
	echo ' Post Has Content -->';
	header("location:/");
}
get_header(); ?>  
<style>
#content {
	width:100%;
	border-right: none;
}
.post h2 {
	margin: 14px 0 8px 0;
font-size: 85%;
padding: 5px 8px;
line-height: 1.4em;
font-weight: bold;
color: #fff;
text-transform: uppercase;
text-shadow: #29551A 0 0.05em 0.05em;
background: #29551A;
border-top: #29551A solid 1px;
}
</style>
<!-- single.php -->
<?php
      //get_sidebar();
	  ?>
      <div id="content">
      <div id="contentLine"></div>
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
    
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
    
    <div class="post">
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
       <?php
		$meta_date = get_post_meta($post->ID, 'event_date', true);
		$event_date = NULL;
       	if($meta_date){
	   		$event_date = date("F j, Y",strtotime($meta_date));
			if($meta_date != "false") { // For the events that do not have a date, meta_date == false, Event Date will not show
				echo '<h4>Event Date - '.$event_date.'</h4>';
			}
		}
		?>
      <div class="entry">
      <?php the_content(); ?>
      </div>

    
    </div>
      <?php 
		  /*if(!$event_date){
			echo '<div class="clear"></div>';
			echo '<p></p><h4>Posted ';
			the_time("M j, Y");
			echo '</h4>';
		  }*/
	  ?>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->

    </div> <!-- content -->
        
        <div class="clear"></div>

<?php get_footer(); ?>
