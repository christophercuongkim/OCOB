<?php// File: travel_grant.php ?>

<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php
/*
Template Name: Travel Grant Fall 2012
*/
session_start();
?>
<!-- This is travel_grant.php -->

<div id="content-2col">
<div id="content" class="clearfix">
	<?php get_sidebar(); ?>
	<div id="content-left">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>		
				<div id="post-<?php the_ID(); ?>" <?php if(function_exists('post_class')) : post_class(); else : echo 'class="post"'; endif; ?>>				
					<h3 class="post-title">Orfalea Competitive Travel Grant Application<br />
						<span style="color:red;">Due Wednesday November 14th</span>
					</h3>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
					<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>
                    <script>
						$(function() {
							$( "#datepicker" ).datepicker();
						});
					</script>
					<?php the_content(); ?>
					
					<div class="clear"></div>
					
					<?php edit_post_link('[edit page]', '<p>', '</p>'); ?>
					<div style="width:630px; float:left; margin:5px;">
						<p>The Orfalea College of Business is looking to award grants to students who plan on studying abroad through any Cal Poly Affiliate Program during Winter, Spring, Summer, and/or Fall 2013. Applicants who are selected may be granted up to $2000. Students will be evaluated on the following criteria:</p>
						<ul style="list-style:disc outside none;">
							<li>Number of quarters remaining at Cal Poly after study abroad program is completed to share their international experience</li>
							<li>Length of time spent in study abroad program</li>
							<li>Depth of cultural immersion</li>
							<li>Intensity of language immersion</li>
							<li>Amount of units that will apply to academic progress in GE, Support, Major, or Minor</li>
							<li>Campus involvement</li>
						</ul>
					</div>
                    <div style="clear:both;"></div>
                    <style>
					ul.messages li{
						color:red;
						font-weight:bold;
					}
					</style>

					<form action="/scripts/travel_grant_dev.php" method="post" class="validate" style="width:650px; border:1px #CCC; padding:15px;">
						<p><strong>Date</strong>: <input name="date" type="text" style="background:#DDD;" value="<?php echo date("M jS, Y"); ?>" readonly="readonly" />
							&nbsp; &nbsp; &nbsp; <strong>Name</strong>:
							<input type="text"  name="name" maxlength="99" class="required" title="Your full name is required." /> 
							&nbsp; &nbsp; &nbsp; &nbsp; 
						 <strong>EMPLID</strong>:
							<input type="text"  name="emplid" maxlength="25" class="required" title="Your Cal Poly EMPLID is required." />
						</p>
						<p><strong>Currently enrolled Orfalea undergraduate?</strong>:
							<label><input name="enrolled" type="radio" value="Yes" class="required" title="Please indicate if you are a currently enrolled Orfalea undergraduate." /> Yes</label>
							<label><input name="enrolled" type="radio" value="No" /> No</label>
							<strong>&nbsp; &nbsp; &nbsp; Cumulative GPA</strong>:
							<input type="text"  name="cgpa" maxlength="6" class="required" style="width:3em;" title="Your Cal Poly cumulative GPA is required." />
						</p>
						<div style="clear:both;"></div>
						<p><strong>Destination City &amp; Country</strong>:
						  <input type="text"  name="dcountry" maxlength="50" class="required" title="Your destination country is required." /></p>
						<p><strong>Is this an English-speaking region/country?</strong>:
							<label><input name="english_speaking" type="radio" value="Yes" class="required" title="Please indicate if the destination country is English-speaking." /> Yes</label>
							<label><input name="english_speaking" type="radio" value="No" /> No</label>
						</p>
						<p><strong>Name of Program & School/ Company</strong>: <em>(i.e. CEA &amp; University of New Haven)</em>
					  <input type="text"  name="pname" maxlength="90" class="required" title="The name of program & school/ company is required." /></p>
						<p><strong>Duration abroad (in weeks)</strong>:
							<input type="text"  name="weeks" maxlength="3" style="width:3em;" class="required" title="Duration abroad (in weeks) is required." /></p>
						<p><strong>Quarters Abroad (check all that apply)</strong>:	
							<label>
						    <input name="winter_abroad" type="checkbox" value="unchecked" class="required" title="Winter Quarter Abroad" /> 
						  Winter</label>
                          <label>
						    <input name="spring_abroad" type="checkbox" class="required" id="spring_abroad" title="Winter Quarter Abroad" value="Spring abroad" /> 
						  Spring</label>
                          <label>
						    <input name="summer_abroad" type="checkbox" value="Summer abroad" class="required" title="Winter Quarter Abroad" id="summer_abroad" /> 
						  Summer</label>
                          <label>
						    <input name="fall_abroad" type="checkbox" value="Fall abroad" class="required" title="Winter Quarter Abroad" id="fall_abroad" /> 
						  Fall</label></p>			
						<p><strong>Cal Poly Email</strong>:
							<input type="text"  name="email" maxlength="25" style="width:8em;" class="required email" title="Your Cal Poly email address is required." /> &nbsp; &nbsp; 
						<strong>Cell / Primary Phone </strong>:
							<input type="text"  name="cphone" maxlength="15" class="required" style="width:6em;" title="Your Cell Phone is Required" />
						  &nbsp; &nbsp; <strong>Home Phone (optional)</strong>:
							<input type="text"  name="hphone" maxlength="15"  style="width:6em;" class="" />
						</p>
						<br />
						<hr />
						<p><strong>Class Level</strong>:<br />
							<label><input name="clevel" type="radio" value="After studying abroad I will have 4-6 quarters of study remaining at Cal Poly." class="required" title="Please indicate class level." /> After studying abroad I will have 4-6 quarters of study remaining at Cal Poly.</label><br />
							<label><input name="clevel" type="radio" value="After studying abroad I will have 3 quarters or less of study remaining at Cal Poly." /> After studying abroad I will have 3 quarters or less of study remaining at Cal Poly.</label>
							<br />
							<label><input name="clevel" type="radio" value="I will be graduating when my study abroad is complete, not returning to Cal Poly." /> I will be graduating when my study abroad is complete, not returning to Cal Poly.</label><br />
							Comments (Optional, 25 words or less):<br />
							<textarea name="clevel_comment" style="width:500px;" rows="1"></textarea>
						</p>
							
						
							
							
						<p><strong>Language Immersion<span style="color:red;">*</span></strong>:<br />
							<label><input name="immersion" type="radio" value="I will be in an intensive language immersion program." class="required" title="Please indicate language immersion."  /> I will be in an intensive language immersion program.</label><br />
							<label><input name="immersion" type="radio" value="I will be living with a family native to the country of my visit."/> I will be living with a family native to the country of my visit.</label><br />
							<label><input name="immersion" type="radio" value="There will be no specified language or cultural experience."/> There will be no specified language or cultural experience.</label><br />
							Comments (Optional, 25 words or less):<br />
							<textarea name="immersion_comment" style="width:500px;" rows="1"></textarea>
						</p>
						<span style="font-size:10px; margin-top:-25px;">
							*<strong>Language immersion</strong> is a method of teaching a second language in which the target language (or L2) is used as the means of instruction. Unlike more traditional language courses, where the target language is simply the subject material, language immersion uses the target language as a teaching tool, surrounding or "immersing" students in the second language. In-class activities, such as math, science, social studies, and history, and those outside of the class, such as meals or everyday tasks, are conducted in the target language.
						</span>
						<p>&nbsp;</p>
						<p><strong>Progress to Degree</strong>:<br />
							<label><input name="progress" type="radio" value="All units of study abroad will apply to my academic progress in GE, Support, Major or Minor." class="required" title="Please indicate progress to degree."  /> All units of study abroad will apply to my academic progress in GE, Support, Major or Minor.</label><br />
							<label><input name="progress" type="radio" value="Some units of study abroad will apply to my academic progress in GE, Support, Major or Minor."/> Some units of study abroad will apply to my academic progress in GE, Support, Major or Minor.</label><br />
							<label><input name="progress" type="radio" value="No units will apply to my academic progress, except as 'free electives.'" /> No units will apply to my academic progress, except as "free electives."</label>
						</p>
						<p style="margin-top:-1em;">Number of applicable units (excluding 'free electives'): <input type="text"  name="prog_units" maxlength="3" class="required" style="width:2em;" title="The number of applicable units is required." /><br />
							I have obtained all approved course substitutions: &nbsp; &nbsp;
							<label><input name="prog_subs" type="radio" value="Yes" class="required" title="Please indicate substitution approval status." /> Yes</label> &nbsp; &nbsp;
							<label><input name="prog_subs" type="radio" value="No"/> No</label> &nbsp; &nbsp;
							<label><input name="prog_subs" type="radio" value="In Progress"/> In Progress</label>
						</p>
							
						Comments (Optional, 25 words or less):<br />
						<textarea name="progress_comment" style="width:500px;" rows="1"></textarea></p>
						<p>
							<strong>Statement of Purpose</strong>: Please provide a statement of purpose that outlines the reasons you have decided to study abroad. What goals will it help you achieve? In what ways will you share the benefits of this study abroad experience with other students when you return to campus? (100 words or less)
							<textarea name="purpose" style="width:600px;" rows="6" class="required" title="Please include a statement of purpose."></textarea>
						</p>
						<p>
							<strong>College Service</strong>: Please provide a short list of your service to the Orfalea College of Business. (25 words or less)
							<textarea name="services" style="width:600px;" rows="2" class="required" title="Please include a short list of your service to the Orfalea College of Business."></textarea>
						</p>
						<hr />
						<p>
							Upon submission you will receive a return email confirming your application has been received. <input style="float:right;" type="submit" name="Submit" value="Submit Form" />
						</p>
					</form>
			
			
			<?php endwhile; ?>
		
		<?php else : ?>		
			<div class="box-left" id="searchform">
				<h3 class="post-title">Not found!</h3>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>		
			</div>
		<?php endif; ?>	
	</div><!-- end content-left -->	  
</div><!-- end content -->
</div><!-- end content-2col -->

<script src="/scripts/validatious-custom-0.9.1.min.js" type="text/javascript"></script>
<?php get_footer(); ?>