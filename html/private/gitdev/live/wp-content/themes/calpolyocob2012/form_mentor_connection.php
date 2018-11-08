<?php get_header(); ?>
<?php get_sidebar(); 

/**
  *  Template Name: Form- Mentor Connection
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
<form action="/scripts/form_mentor_connection.php" method="post" class="validate" style="width:650px; border:1px #CCC; padding:15px;">  
<fieldset>
  <legend>Who Are You</legend>
  <label for="name">What is your name?</label>
  <input type="text"  name="name" maxlength="50" class="required" title="Your name is required." />    
  
  <label for="major">What is your major?</label>
  <input type="text"  name="major" maxlength="50" class="required" title="Your major is required." />
  
  <label for="concentration">What concentration are you thinking about declaring (if applicable)?</label>
  <input type="text"  name="concentration" maxlength="50" />
  <label for="year">What year in school are you (i.e. first year, second year)?</label>
  <input type="text"  name="year" maxlength="50" class="required" title="Your year in school is required." /> 
</fieldset>
<fieldset>
  <legend>About You</legend>

  <label for="mentor_gender">Do you prefer a male or female peer mentor?</label>
  <label><input name="mentor_gender" type="radio" value="Male" class="required" title="Please indicate mentor gender preference (or no preference)." /> Male</label>
  <label><input name="mentor_gender" type="radio" value="Female" /> Female</label>
  <label><input name="mentor_gender" type="radio" value="No Preference" /> No Preference</label>
  
  <label for="activities">List three of your favorite activities or hobbies/interests.</label><br />
  <textarea name="activities" style="width:400px;" rows="2" class="required" title="Please include what you to do outside of school."></textarea>
  <label for="campus_activities">List any campus affiliated activities or programs you are involved or interested in.</label><br />
  <textarea name="campus_activities" style="width:400px;" rows="2" class="required" title=""></textarea>    
  <label for="mentor_benefit">Please explain how you believe you would benefit from receiving a mentor?</label><br />
  <textarea name="mentor_benefit" style="width:400px;" rows="2" class="required" title=""></textarea>    
  <label for="topics">Please list 3 topics you would like to discuss with your mentor.</label><br />
  <textarea name="topics" style="width:400px;" rows="2" class="required" title=""></textarea>
  
<p><strong>-On the spectrum below, please rate how you prefer to spend your free time?</strong>
<table class="rank" border="0" style="">
  <tr style="">
    <td width="150" style="text-align:center;" align="center"><p>1<br />
    Being around others, socializing and meeting new people</p></td>
    <td width="50" style="text-align:center;" align="center">2</td>
    <td width="150" style="text-align:center;" align="center"><p>3<br />
	An even balance of both</p></td>
    <td width="50" style="text-align:center;" align="center">4</td>
    <td width="150" style="text-align:center;" align="center"><p>5<br />
    Staying at home, relaxing by yourself</p></td>
  </tr>
  <tr style="">    
    </div></label></td>
    <td align="center"><label><div style="width:100%; height:100%; text-align:center;"><input name="ap_scale" type="radio" value="1" /></div></label></td>
    <td align="center"><label><div style="width:100%; height:100%; text-align:center;"><input name="ap_scale" type="radio" value="2" /></div></label></td>
    <td align="center"><label><div style="width:100%; height:100%; text-align:center;"><input name="ap_scale" type="radio" value="3" /></div></label></td>
    <td align="center"><label><div style="width:100%; height:100%; text-align:center;"><input name="ap_scale" type="radio" value="4" /></div></label></td>
    <td align="center"><label><div style="width:100%; height:100%; text-align:center;"><input name="ap_scale" type="radio" value="5" /></div></label></td>    
  </tr>
</table>
</p>
</fieldset>
<fieldset>
  <legend>How To Contact You</legend>
  
  <label for="email">Cal Poly Email</label>
  <input type="text"  name="email" maxlength="25" style="width:8em;" class="required email" title="Your Cal Poly email address is required." />

  <label for="cphone">Cell / Primary Phone</label>
  <input type="text"  name="cphone" maxlength="15" class="required" style="width:6em;" title="Your Cell Phone or primary phone number is Required" />
</fieldset>
  <fieldset>
  <legend>Submit</legend>
  <p>Upon submission you will receive a return email confirming your request has been received.</p>
  <input style="float:right;" type="submit" name="Submit" value="Submit Form" />
  </fieldset>
</form>
      </div>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->
</div> <!-- content -->
        
        <div class="clear"></div>

<script src="/scripts/validatious-custom-0.9.1.min.js" type="text/javascript"></script>
<?php get_footer(); ?>