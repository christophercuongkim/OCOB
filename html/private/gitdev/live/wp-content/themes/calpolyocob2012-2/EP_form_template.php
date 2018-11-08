<?php get_header(); ?>
<?php get_sidebar(); 

$mentorName = $_POST['mentor'];

/**
  *  Template Name: EP Request Mentor Form
  */
    ?> 
    <div id="content">
    <div id="contentLine"></div>
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
    echo get_the_post_thumbnail();
    ?>
    <div id="mainLeftFull">
    <div class="post">
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <div class="entry">
      <?php the_content(); ?>
      
        <p>Complete all questions on the form below to get connected to a Peer Mentor. Upon completion, you will receive a confirmation email.</p>
</div>
                    <div style="clear:both;">
                    </div>
                    <style>
          ul.messages li{
            color:red;
            font-weight:bold;
          }
          </style>
          <?php if($mentorName) { ?>
<form action="/EP_sendemail.php" method="post" class="validate" style="width:650px; border:1px #CCC; padding:15px;">  
<input type="hidden" name="type" value="mentorRequest" />
<fieldset>
  <legend>Mentor Selection</legend>
  <label for="Mentor">Mentor's Name</label>
  <input type="hidden" name="Mentor" value="<?php echo $mentorName; ?>" />
  <input type="text" disabled name="Mentor" width="30" value="<?php echo $mentorName; ?>" />    
</fieldset>
<fieldset>
  <legend>School Information</legend>

  <label for="Name">Name</label>
  <input name="Name" type="text" value="" class="required" title="Your name is required"/>
  <label for="Year">Year</label>
  <select name="Year">
  	<option value="Freshmen">Freshmen</option>
    <option value="Sophomore">Sophomore</option>
    <option value="Junior">Junior</option>
    <option value="Senior">Senior</option>
 </select>
 <label for="Major">Major</label>
 <input type="text" name="Major" />
 
 <label for="Concentration">Concentration</label>
 <input type="text" name="Concentration" />
 
  <label for="Interests">Interests:</label></p><p style="margin: -10px auto auto 20px;">
        <label><input name="Interests[]" type="checkbox" id="Interests[]" value="Resume" />
         Resume</label>
        <label><input name="Interests[]" type="checkbox" id="Interests[]" value="Job Interviews" />
         Job Interviews</label>
        <label><input name="Interests[]" type="checkbox" id="Interests[]" value="Choosing a concentration" />
         Choosing a concentration</label>
        <label><input name="Interests[]" type="checkbox" id="Interests[]" value="Networking" />
         Networking</label>
        Other: <input name="InterestsOther" type="text" id="InterestsOther" />
</fieldset>
<fieldset>
  <legend>Contact Information</legend>
  
  <label for="Email">Cal Poly Email</label>
  <input type="text"  name="Email" maxlength="25" style="width:8em;" class="required email" title="Your Cal Poly email address is required." />

  <label for="Phone">Cell / Primary Phone</label>
  <input type="text"  name="Phone" maxlength="15" style="width:6em;"  />
  
  <label for="Best Time to Contact">Best Time to Contact</label>
  <input type="text" name="Best Time to Contact" />
</fieldset>
  <fieldset>
  <legend>Submit</legend>
  <input style="float:right;" type="submit" name="Submit" value="Submit Form" />
  </fieldset>
</form>
<?php } else { ?>
<a href="../">Please select a mentor to get started</a>
<?php } ?>
      </div>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->
</div> <!-- content -->
        
        <div class="clear"></div>

<script src="/scripts/validatious-custom-0.9.1.min.js" type="text/javascript"></script>
<?php get_footer(); ?>