<?php 
/*
 *  Template Name: Undergraduate Programs New
 */
get_header(); ?>  

<style>
p {
	font-size: .9em;
    font-weight: normal;
    line-height: 1.5em;
    margin: 5px 0 10px;
    color: #323232;
    font-family: 'Open Sans', 'Trebuchet MS', Verdana, sans-serif;
}
.line{
	background: url(https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_css/content/thickthinline.gif) top left repeat-x;
}

.lineBot{
	background: url(https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_css/content/thickthinline.gif) bottom left repeat-x;
}

.background { background-color: #F9F6EF;}
p a {
 	font-size: 13px !important;
    font-weight: bold;
    display: block;
    text-decoration: none;
    color: #323232;
    font-family: 'Open Sans', 'Trebuchet MS', Verdana, sans-serif;
    margin-top: 15px;
    margin-bottom:15px;
}

h6 {
  	font-size: 23px;
	font-weight: normal;
  	margin-top: 4px;
    padding-bottom: 0;
	margin-bottom: 0;
    color: #323232;
	font-family: 'Open Sans', 'Trebuchet MS', Verdana, sans-serif;
}

h3 a {
    font-family: 'Open Sans', 'Trebuchet MS', Verdana, sans-serif !important;
	text-decoration: underline !important;
}
</style>

<?php get_sidebar('area'); ?> 

   <div id="content">
   <div id="contentLine"></div>
   <?php if(have_posts()) : ?>
  	<?php while(have_posts()) : the_post(); 
    
      echo get_the_post_thumbnail();
   ?>
    <div id="mainLeftFull">
    <div class="post">
      <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <div> 
 		&nbsp;
		<?php the_field('top_text'); ?>
		&nbsp;
		<div>
		<h1 data-toggle="collapse" data-target="#majors" style="padding: 25px 0 0 0; cursor: pointer;" onclick="changePlusImage('majorImg')"><img style="cursor:pointer" class="size-full wp-image-1131 alignleft" src="http://www.cob.calpoly.edu/undergrad/files/2016/10/PlusButton.jpg" height="30" width="30")" id="majorImg" onclick="changePlusImage('majorImg')">MAJORS</h1>
		<div id="majors" class="collapse">
		<hr>
		<?php $count=0;  
    		if( have_rows('program') ):   
 
    		//Loop through the different undergrad areas for main content...
    		while ( have_rows('program') ) : the_row(); 
  		?>
     
   	<div style="font: 24px bold 'Calibri', Arial, Helvetica, sans-serif; padding: 10px; float: center;"><img style="cursor:pointer" data-toggle="collapse" data-target="#demo<?php echo $count?>" class="size-full wp-image-1131 alignleft" src="http://www.cob.calpoly.edu/undergrad/files/2016/09/DropButton-e1472778922661.png" height="30" width="30" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><h6 style="cursor:pointer" data-toggle="collapse" data-target="#demo<?php echo $count?>" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><?php echo get_sub_field('program_name'); ?></h6></div>
    	&nbsp;
	   <div id="demo<?php echo $count?>" class="collapse line background" >
	        <span style="position:relative; top: -50px;" id="<?php echo str_replace(" ", "", get_sub_field('program_name')); ?>"></span>
	        <div style="overflow: auto; padding-top: 20px;">
	        <div style="width: 24%; display: inline-block; vertical-align: top;"><img src="<?php echo the_sub_field('photo'); ?>" alt="<?php echo the_sub_field('program_name'); ?> Picture" />
	          <p style='font-family: "Calibri", Arial, Helvetica, sans-serif;'>
	            <?php if(get_sub_field("location") != null) : ?>
	            <span class="grey">Location:</span><br /> <?php echo the_sub_field("location"); ?>  <br />
	            <?php endif; 
	            if(get_sub_field("phone") != null) : ?>
	            <span class="grey">Phone:</span><br /> <?php echo the_sub_field("phone"); ?> <br />
	            <?php endif;
	            if (get_sub_field("area_chair") != null) : ?>
	            <span class="grey">Area Chair:</span><br /> <?php echo the_sub_field("area_chair"); ?> <br />
	            <?php endif;
	            if (get_sub_field("admin_coordinator") != null) : ?>
	            <span class="grey">Admin. Coordinator:</span><br /> <?php echo the_sub_field("admin_coordinator"); ?><br /><br />
	            <?php endif; 
	            if( have_rows('custom_fields') ) :
	            while ( have_rows('custom_fields') ) : the_row(); ?>
	            <span class="grey"><?php the_sub_field('label'); ?>:</span><br /> <?php the_sub_field("value"); ?><br />
	            <?php endwhile;
	            endif;
	            ?>
	          </p>
	        </div>
	        <div style="display: inline-block; width: 72%; float: right;"><h3><a href="<?php echo the_sub_field('program_link'); ?>"><?php echo the_sub_field("program_name"); ?></a></h3>
	          <p>
	          <?php echo the_sub_field("description"); ?>
				 </p>
				</div>
	      </div>
		<div data-toggle="collapse" data-target="#demo<?php echo $count?>" style="cursor: pointer;" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><i>Collapse</i></div>
		<div class="lineBot">&nbsp</div>
	   </div>
		
	   <?php $count++;     
			endwhile;
	      endif;
	   ?>
		</div>
		</div>

	
		<div>
		<h1 data-toggle="collapse" data-target="#concentrations" style="padding: 25px 0 0 0; cursor: pointer;" onclick="changePlusImage('concImg')"><img style="cursor:pointer" class="size-full wp-image-1131 alignleft" src="http://www.cob.calpoly.edu/undergrad/files/2016/10/PlusButton.jpg" height="30" width="30")" id="concImg" onclick="changePlusImage('concImg')">CONCENTRATIONS</h1>
		<div id="concentrations" class="collapse">
		<hr>
		<?php   
			if( have_rows('concentration') ):
				    
			//Loop through the different undergrad areas for main content...
			while ( have_rows('concentration') ) : the_row();
		?>
				     
			<div style="font: 24px bold 'Calibri', Arial, Helvetica, sans-serif; padding: 10px; float: center;"><img style="cursor:pointer" data-toggle="collapse" data-target="#demo<?php echo $count?>" class="size-full wp-image-1131 alignleft" src="http://www.cob.calpoly.edu/undergrad/files/2016/09/DropButton-e1472778922661.png" height="30" width="30" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><h6 style="cursor:pointer" data-toggle="collapse" data-target="#demo<?php echo $count?>" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><?php echo get_sub_field('program_name'); ?></h6></div>
			&nbsp;
			<div id="demo<?php echo $count?>" class="collapse line background">
				      <span style="position:relative; top: -50px;" id="<?php echo str_replace(" ", "", get_sub_field('program_name')); ?>"></span>
				       <div style="overflow: auto; padding-top: 20px;">
				        <div style="width: 24%; display: inline-block; vertical-align: top;"><img src="<?php echo the_sub_field('photo'); ?>" alt="<?php echo the_sub_field('program_name'); ?> Picture" />
				          <p style='font-family: "Calibri", Arial, Helvetica, sans-serif;'>
				            <?php if(get_sub_field("location") != null) : ?>
				            <span class="grey">Location:</span><br /> <?php echo the_sub_field("location"); ?>  <br />
				            <?php endif; 
				            if(get_sub_field("phone") != null) : ?>
				            <span class="grey">Phone:</span><br /> <?php echo the_sub_field("phone"); ?> <br />
				            <?php endif;
				            if (get_sub_field("area_chair") != null) : ?>
				            <span class="grey">Area Chair:</span><br /> <?php echo the_sub_field("area_chair"); ?> <br />
				            <?php endif;
				            if (get_sub_field("admin_coordinator") != null) : ?>
				            <span class="grey">Admin. Coordinator:</span><br /> <?php echo the_sub_field("admin_coordinator"); ?><br /><br />
				            <?php endif; 
				            if( have_rows('custom_fields') ) :
				            while ( have_rows('custom_fields') ) : the_row(); ?>
				            <span class="grey"><?php the_sub_field('label'); ?>:</span><br /> <?php the_sub_field("value"); ?><br />
				            <?php endwhile;
				            endif;
				            ?>
				          </p>
				        </div>
				        <div style="display: inline-block; width: 72%; float: right;"><h3><a href="<?php echo the_sub_field('program_link'); ?>"><?php echo the_sub_field("program_name"); ?></a></h3>
				          <p>
				          <?php echo the_sub_field("description"); ?>
				          </p>
				        </div>
				      </div>
					<div data-toggle="collapse" data-target="#demo<?php echo $count?>" style="cursor: pointer;" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><i>Collapse</i></div>
					<div class="lineBot">&nbsp;</div>
				   </div>
						
				   <?php $count++;  
				    endwhile;
				      endif;
				   ?>
		</div>
		</div>

		<div>
		<h1 data-toggle="collapse" data-target="#minors" style="padding: 25px 0 0 0; cursor: pointer;" onclick="changePlusImage('minorImg')"><img style="cursor:pointer" class="size-full wp-image-1131 alignleft" src="http://www.cob.calpoly.edu/undergrad/files/2016/10/PlusButton.jpg" height="30" width="30")" id="minorImg" onclick="changePlusImage('minorImg')">MINORS</h1>
		<div id="minors" class="collapse">
		<hr>
		<?php 
		    if( have_rows('minor') ):
		    
		    //Loop through the different undergrad areas for main content...
		    while ( have_rows('minor') ) : the_row(); 
		  ?>
		     
		   <div style="font: 24px bold 'Calibri', Arial, Helvetica, sans-serif; padding: 10px; float: center;"><img style="cursor:pointer" data-toggle="collapse" data-target="#demo<?php echo $count?>" class="size-full wp-image-1131 alignleft" src="http://www.cob.calpoly.edu/undergrad/files/2016/09/DropButton-e1472778922661.png" height="30" width="30" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><h6 style="cursor:pointer" data-toggle="collapse" data-target="#demo<?php echo $count?>" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><?php echo get_sub_field('program_name'); ?></h6></div>
		    &nbsp;
		   <div id="demo<?php echo $count?>" class="collapse line background">
		        <span style="position:relative; top: -50px;" id="<?php echo str_replace(" ", "", get_sub_field('program_name')); ?>"></span>
		        <div style="overflow: auto; padding-top: 20px;">
		        <div style="width: 24%; display: inline-block; vertical-align: top;"><img src="<?php echo the_sub_field('photo'); ?>" alt="<?php echo the_sub_field('program_name'); ?> Picture" />
		          <p style='font-family: "Calibri", Arial, Helvetica, sans-serif;'>
		            <?php if(get_sub_field("location") != null) : ?>
		            <span class="grey">Location:</span><br /> <?php echo the_sub_field("location"); ?>  <br />
		            <?php endif; 
		            if(get_sub_field("phone") != null) : ?>
		            <span class="grey">Phone:</span><br /> <?php echo the_sub_field("phone"); ?> <br />
		            <?php endif;
		            if (get_sub_field("area_chair") != null) : ?>
		            <span class="grey">Area Chair:</span><br /> <?php echo the_sub_field("area_chair"); ?> <br />
		            <?php endif;
		            if (get_sub_field("admin_coordinator") != null) : ?>
		            <span class="grey">Admin. Coordinator:</span><br /> <?php echo the_sub_field("admin_coordinator"); ?><br /><br />
		            <?php endif; 
		            if( have_rows('custom_fields') ) :
		            while ( have_rows('custom_fields') ) : the_row(); ?>
		            <span class="grey"><?php the_sub_field('label'); ?>:</span><br /> <?php the_sub_field("value"); ?><br />
		            <?php endwhile;
		            endif;
		            ?>
		          </p>
		        </div>
		        <div style="display: inline-block; width: 72%; float: right;"><h3><a href="<?php echo the_sub_field('program_link'); ?>"><?php echo the_sub_field("program_name"); ?></a></h3>
		          <p>
		          <?php echo the_sub_field("description"); ?>
					 </p>
		        </div>
		      </div>
			<div data-toggle="collapse" data-target="#demo<?php echo $count?>" style="cursor: pointer;" id="<?php echo $count?>" onclick="changeImage(<?php echo $count?>)"><i>Collapse</i></div>
			<div class="lineBot">&nbsp;</div>
		   </div>
				
		   <?php $count++;  
		   	endwhile;
		      endif;
		   ?>
		</div>
		</div>
          </div>
        </div>
   <?php endwhile; ?>
  <?php endif; ?>
     
 </div><!--main????Full-->
    </div> <!-- content -->
    <div class="clear"></div>


<script language="javascript">

	//Responsible for changing the arrow images on collape/uncollapse
    function changeImage(id) {
		if (document.getElementById(id).src == "http://www.cob.calpoly.edu/undergrad/files/2016/09/DropButton-e1472778922661.png") 
        {
            document.getElementById(id).src = "http://www.cob.calpoly.edu/undergrad/files/2016/09/DropButton2.png";
        }
        else 
        {
            document.getElementById(id).src = "http://www.cob.calpoly.edu/undergrad/files/2016/09/DropButton-e1472778922661.png";
        }
    }

	//Responsible for changing the plus/minus images on collape/uncollapse
	function changePlusImage(id) {

        if (document.getElementById(id).src == "http://www.cob.calpoly.edu/undergrad/files/2016/10/PlusButton.jpg") 
        {
            document.getElementById(id).src = "http://www.cob.calpoly.edu/undergrad/files/2016/10/MinusButton.jpg";
        }
        else 
        {
            document.getElementById(id).src = "http://www.cob.calpoly.edu/undergrad/files/2016/10/PlusButton.jpg";
        }
    }

	//Allows for the use of category names(majors, concentrations, minors) as URL hashes. When used in the form cob.calpoly.edu/undergrad/#CATEGORY, that category will load expanded
	$(document).ready(function () {
	    if(location.hash != null && location.hash != ""){
	        $('.collapse').removeClass('in');
	        $(location.hash + '.collapse').collapse('show');
	    }
		//document.getElementById(location.hash).src = "http://www.cob.calpoly.edu/undergrad/files/2016/10/PlusButton.jpg";
	});
</script>

<?php get_footer(); ?>