<?php get_header(); ?>
<?php get_sidebar(); 

/**
  *  Template Name: Travel Grant 2012-13
  */
    ?>

<div id="content">
  <?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post(); 
    echo get_the_post_thumbnail();
    ?>
  <div id="mainLeftFull">
    <div class="post"> <a name="topH1" id="topH1"></a>
      <h1><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a></h1>
      <div class="entry">
        <?php the_content(); ?>
      </div>
      <div style="clear:both;"> </div>
      <style>
          ul.messages li{
            color:red;
            font-weight:bold;
          }
          </style>
      <form action="/scripts/travel_grant_dev.php" method="post" class="validate" style="width:650px; border:1px #CCC; padding:15px;">
        <fieldset>
          <legend>Application Date:</legend>
          <input name="date" type="text" style="background:#DDD;" value="<?php echo date("M jS, Y"); ?>" readonly="readonly" />
        </fieldset>
        <fieldset>
          <legend>Student Info:</legend>
          <p>Name:
            <input type="text"  name="name" maxlength="99" class="required" title="Your full name is required." />
          </p>
          <p>EMPLID:
            <input type="text"  name="emplid" maxlength="25" class="required" title="Your Cal Poly EMPLID is required." />
          </p>
          <p>Currently enrolled Orfalea undergraduate?:
            <label>
              <input name="enrolled" type="radio" value="Yes" class="required" title="Please indicate if you are a currently enrolled Orfalea undergraduate." />
              Yes</label>
            <label>
              <input name="enrolled" type="radio" value="No" />
              No</label>
            &nbsp; &nbsp; &nbsp; Cumulative GPA:
            <input type="text"  name="cgpa" maxlength="6" class="required" style="width:3em;" title="Your Cal Poly cumulative GPA is required." />
          </p>
          <p>Cal Poly Email:
            <input type="text"  name="email" maxlength="25" style="width:8em;" class="required email" title="Your Cal Poly email address is required." />
            &nbsp; &nbsp; 
            Cell / Primary Phone :
            <input type="text"  name="cphone" maxlength="15" class="required" style="width:6em;" title="Your Cell Phone is Required" />
          </p>
          <p> Home Phone (optional):
            <input type="text"  name="hphone" maxlength="15"  style="width:6em;" class="" />
          </p>
        </fieldset>
        <fieldset>
          <legend>Destination Info:</legend>
          <p>Destination City &amp; Country:
            <input type="text"  name="dcountry" maxlength="50" class="required" title="Your destination country is required." />
          </p>
          <p>Is this an English-speaking region/country?:
            <label>
              <input name="english_speaking" type="radio" value="Yes" class="required" title="Please indicate if the destination country is English-speaking." />
              Yes</label>
            <label>
              <input name="english_speaking" type="radio" value="No" />
              No</label>
          </p>
          <p>Name of Program &amp; School/ Company: <em>(i.e. CEA &amp; University of New Haven)</em>
            <input type="text"  name="pname" maxlength="50" class="required" title="The name of program &amp; school/ company is required." />
          </p>
          <p>Duration abroad (in weeks):
            <input type="text"  name="weeks" maxlength="3" style="width:3em;" class="required" title="Duration abroad (in weeks) is required." />
          </p>
          <p>Quarters Abroad (check all that apply)
          </p>
          <div>
            <label class="inline_box">
              <input name="quarters[]" type="checkbox" value="winter" class="required" title="Winter Quarter Abroad" />
              Winter</label>
            <label class="inline_box">
              <input name="quarters[]" type="checkbox" class="required" id="spring_abroad" title="Spring Quarter Abroad" value="spring" />
              Spring</label>
            <label class="inline_box">
              <input name="quarters[]" type="checkbox" value="summer" class="required" title="Summer Quarter Abroad" id="summer_abroad" />
              Summer</label>
            <label class="inline_box">
              <input name="quarters[]" type="checkbox" value="fall" class="required" title="Fall Quarter Abroad" id="fall_abroad" />
              Fall</label>
              </div>
              <div style="clear:both;"></div>
        </fieldset>
        <fieldset>
          <legend>Class Level:</legend>
          <p>
            <label>
              <input name="clevel" type="radio" value="After studying abroad I will have 4-6 quarters of study remaining at Cal Poly." class="required" title="Please indicate class level." />
              After studying abroad I will have 4-6 quarters of study remaining at Cal Poly.</label>
            <br />
            <label>
              <input name="clevel" type="radio" value="After studying abroad I will have 3 quarters or less of study remaining at Cal Poly." />
              After studying abroad I will have 3 quarters or less of study remaining at Cal Poly.</label>
            <br />
            <label>
              <input name="clevel" type="radio" value="I will be graduating when my study abroad is complete, not returning to Cal Poly." />
              I will be graduating when my study abroad is complete, not returning to Cal Poly.</label>
            <br />
            Comments (Optional, 25 words or less):<br />
            <textarea name="clevel_comment"  rows="1"></textarea>
          </p>
        </fieldset>
        </BR>
        <fieldset>
          <legend>Language Immersion: (Check all that apply)</legend>
          <p>
            <label>
              <input name="immersion[]" type="checkbox" value="I will be in an intensive language immersion program." title="Please indicate language immersion."  />
              I will be in an intensive language immersion program.</label>
            <br />
            <label>
              <input name="immersion[]" type="checkbox" value="I will be living with a host family that is native to the country of my visit."/>
              I will be living with a host family that is native to the country of my visit.</label>
            <br />
            <label>
              <input name="immersion[]" type="checkbox" value="I will not be in an intensive language immersion program or living with a host family."/>
              I will not be in an intensive language immersion program or living with a host family.</label>
            <br />
            Comments (Optional, 25 words or less):<br />
            <textarea name="immersion_comment"  rows="1"></textarea>
          </p>
          <p><span style="font-size:12px; margin-top:-25px;">*Language immersion is a method of teaching a second language in which the target language (or L2) is used as the means of instruction. Unlike more traditional language courses, where the target language is simply the subject material, language immersion uses the target language as a teaching tool, surrounding or &quot;immersing&quot; students in the second language. In-class activities, such as math, science, social studies, and history, and those outside of the class, such as meals or everyday tasks, are conducted in the target language.</span></p>
        </fieldset>
        <fieldset>
          <legend>Progress to Degree:</legend>
          <p>
            <label>
              <input name="progress" type="radio" value="All units of study abroad will apply to my academic progress in GE, Support, Major or Minor." class="required" title="Please indicate progress to degree."  />
              All units of study abroad will apply to my academic progress in GE, Support, Major or Minor.</label>
            <br />
            <label>
              <input name="progress" type="radio" value="Some units of study abroad will apply to my academic progress in GE, Support, Major or Minor."/>
              Some units of study abroad will apply to my academic progress in GE, Support, Major or Minor.</label>
            <br />
            <label>
              <input name="progress" type="radio" value="No units will apply to my academic progress, except as 'free electives.'" />
              No units will apply to my academic progress, except as &quot;free electives.&quot;</label>
          </p>
          <p style="margin-top:-1em;">Number of applicable units (excluding 'free electives'):
            <input type="text"  name="prog_units" maxlength="3" class="required" style="width:2em;" title="The number of applicable units is required." />
            <br />
            I have obtained all approved course substitutions: &nbsp; &nbsp;
            <label>
              <input name="prog_subs" type="radio" value="Yes" class="required" title="Please indicate substitution approval status." />
              Yes</label>
            &nbsp; &nbsp;
            <label>
              <input name="prog_subs" type="radio" value="No"/>
              No</label>
            &nbsp; &nbsp;
            <label>
              <input name="prog_subs" type="radio" value="In Progress"/>
              In Progress</label>
          </p>
          Comments (Optional, 25 words or less):<br />
          <textarea name="progress_comment" rows="1"></textarea>
          </p>
        </fieldset>
        <fieldset>
          <legend>Statement of Purpose:</legend>
          <p> Please provide a statement of purpose that outlines the reasons you have decided to study abroad. What goals will it help you achieve? In what ways will you share the benefits of this study abroad experience with other students when you return to campus? (100 words or less)</p>
          <textarea name="purpose" rows="6" class="required" title="Please include a statement of purpose."></textarea>
          </p>
        </fieldset>
        <fieldset>
          <legend>College Service:</legend>
          <p> Please provide a short list of your service to the Orfalea College of Business. (25 words or less)</p>
          <textarea name="services" rows="2" class="required" title="Please include a short list of your service to the Orfalea College of Business."></textarea>
          </p>
        </fieldset>
        <fieldset>
          <legend>Submit Form:</legend>
          <p> Upon submission you will receive a return email confirming your application has been received.
            <input style="float:right;" type="submit" name="Submit" value="Submit Form" />
          </p>
        </fieldset>
      </form>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <!--main????Full--> 
</div>
<!-- content -->

<div class="clear"></div>
<script src="/scripts/validatious-custom-0.9.1.min.js" type="text/javascript"></script>
<?php get_footer(); ?>
