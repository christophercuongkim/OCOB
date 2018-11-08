<?php// File: area_newsletter_template.php ?>
<?php get_header();


/**
  *  Template Name: Area Newsletter Template
  *  
  */
?>  
<style>
	.leftColoum{
		float: left;
		width: 45%;
		height: 350px;
		margin: 0 auto;
		display: inline-block;
	}
	
.rightColoum{
		float: right;
		width: 45%;
		height: 350px;
		margin: 0 auto;
		display: inline-block;
	}
	
	ul{	
    	padding-left: 20px;
    	list-style: disc;
    	
	}
	
	ul a{
		color: black;
	}
	
	ul a:hover{
		color: black;
	}
</style>
<?php
get_sidebar(); ?>

<div id="content">
  <div id="contentLine"></div>
  	<h2>
    <?php
	echo(get_the_title());
	?></h2>
	</br>
	<?php
$post_object = get_field('main_story');
$main_image = get_field('main_story_image');
$main_text = get_field('main_story_text');

if( $post_object ): 

	// override $post
	$post = $post_object;
	setup_postdata( $post ); 
	
	?>
	<img src="<?php echo($main_image);?>"/>
			
    <div>
    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    	<p>
    	<?php
    		echo($main_text);
    	?>
    	</br>
    		<b><a style="color:#0B531D;" href="<?php the_permalink(); ?>">Read More</a></b>
    	
    	</p>
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

<div style="display: inline-block; ">
<?php
	    $rows = get_field('sub_stories');
	    	foreach($rows as $row){
		    $post_object = $row['left_story'];
		    $left_text = $row['left_story_text'];
		    if( $post_object ): 

			// override $post
			$post = $post_object;
			setup_postdata( $post ); 
	
			
		?>
			<div class="leftColoum">
				<?php
				
					?>
					<div>
						<img src="<?php echo($row['left_story_image']);?>" style="max-height: 182px; margin: 0 auto; display: block; margin-bottom: 7px;"/>
					</div>
				<?php
				?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<p>
    	<?php
    		echo($left_text);
    	?>
    		</br>
    		<b><a style="color:#0B531D;" href="<?php the_permalink(); ?>">Read More</a></b>
    	
    	</p>
				
			</div>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; 
			
			$post_object = $row['right_story'];
			$right_text = $row['right_story_text'];
		    if( $post_object ): 

			// override $post
			$post = $post_object;
			setup_postdata( $post ); 
	
			
		?>
			<div class="rightColoum">
				<?php
				
					?>
					<div>
						<img src="<?php echo($row['right_story_image']);?>" style="max-height: 182px; margin: 0 auto; display: block; margin-bottom: 7px;"/>
					</div>
				<?php
				?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<p>
    	<?php
    		echo($right_text);
    	?>
				</br>
    		<b><a style="color:#0B531D;" href="<?php the_permalink(); ?>">Read More</a></b>
    	
    	</p>
				

			</div>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif;
	    }
	    ?></div>
	    <div>
		    <?php
	  echo(get_field('after_stories'));

	 ?>  
	    </div>
	   
	 
	
    

<?php endif; ?>
     
</div>
<!-- content -->

<div class="clear"></div>
<?php get_footer(); ?>