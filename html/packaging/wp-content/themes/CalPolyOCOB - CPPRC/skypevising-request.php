<?php// File: skypevising-request.php ?>

<?php get_header(); ?>
<?php get_sidebar(); 

/**
  *  Template Name: Skypevising Request
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
        <?php date_default_timezone_set('America/Los_Angeles'); ?>
      </div>
      <div style="clear:both;"> </div>
      <style>
          ul.messages li{
            color:red;
            font-weight:bold;
          }
          </style>
      <form action="/scripts/form_skypevising.php" method="post" class="validate" style="width:650px; border:1px #CCC; padding:15px;">
        <fieldset>
          <legend>Please Complete Form Below:</legend>
          <p>Name:
            <input type="text"  name="name" maxlength="99" required title="Your full name is required." autofocus />
          </p>
          <p>EMPLID:
            <input type="text"  name="emplid" maxlength="25" class="required" title="Your Cal Poly EMPLID is required." />
          </p>
          <p>Cal Poly Email:
            <input type="email"  name="email" maxlength="25" style="width:8em;" class="required" title="Your Cal Poly email address is required." />
            &nbsp; &nbsp; 
            Cell / Primary Phone :
            <input type="text"  name="cphone" maxlength="15" class="required" style="width:6em;" title="Your Cell Phone is Required" />
          </p>
          <p>Major:
            <label>
              <input name="major" type="radio" value="BUS" />
              BUS</label>
            <label>
              <input name="major" type="radio" value="ECON" />
              ECON</label>
            <label>
              <input name="major" type="radio" value="IT" />
              IT</label>
          </p>
          <p>Skype Username:
            <input type="text"  name="skypeid" maxlength="35" class="required" title="Your Skype Username is required." />
          </p>
          <p><strong><em>The following times are available for Study Abroad and General Advising:
            </em></strong><br />
            To find the time that works best for you, visit the time converter website: <a href="http://www.timeanddate.com/worldclock/converter.html">http://www.timeanddate.com/worldclock/converter.html</a></p>
          <table width="450" border="1" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><strong>Study Abroad Questions</strong></td>
              <td align="center"><strong>General Advising</strong></td>
            </tr>
            <tr>
              <td align="center">Monday 2-3pm</td>
              <td align="center">Monday, Wednesday, Thursday, &amp; Friday 9am-4pm</td>
            </tr>
            <tr>
              <td align="center">Wednesday 9-10am</td>
              <td align="center">Tuesday 10am-4pm</td>
            </tr>
            <tr>
              <td align="center">Thursday 9-10am</td>
              <td align="center">Thursday &amp; Friday 9am-4pm</td>
            </tr>
          </table>
          <p><strong><em>Please note the following:
          </em></strong>
          <ul>
            <li>All appointments must be on the half hour</li>
            <li>All times are PST (Current SLO time - <?php echo date("m/d g:i a")?>) </li>
            <li>Appointment request must be made at least 48 hours in advance.</li>
          </ul>
          </p>
          <p>First Choice (Format MM/DD hh:mm am/pm):
            <input type="text"  name="appt1" maxlength="14" class="required" title="Your first choice appointment date and time is required." />
          </p>
          <p>Second Choice (Format MM/DD hh:mm am/pm):
            <input type="text"  name="appt2" maxlength="14" class="required" title="Your second choice appointment date and time is required." />
          </p>
          <p>Third Choice (Format MM/DD hh:mm am/pm):
            <input type="text"  name="appt3" maxlength="14" class="required" title="Your third choice appointment date and time is required." />
          </p>
<!--          <p>Desired Date of Appointment:
            <input type="date"  name="apptdate" maxlength="35" class="required" title="Your Desired Date is required." />
          </p>
          <p>Desired Time of Appointment (Pacific Time):</br>
            <input type="time"  name="appttime" maxlength="35" class="required" title="Your Desired Time is required." />
          </p> -->
          <p>In my appointment I would like to discuss:
            <label>
              <input name="liketodiscuss" type="radio" value="General advising" class="required" title="Please indicate if this appointment is regarding general advising" />
              General Advising</label>
            <label>
              <input name="liketodiscuss" type="radio" value="Study abroad specific questions" title="Please indicate if this appointment is regarding Study abroad specific questions"  />
              Study abroad specific questions</label>
            <label>
              <input name="liketodiscuss" type="radio" value="Both general advising and study abroad specific advising" title="Please indicate if this appointment is regarding both topics above" />
              Both general advising and study abroad specific advising</label>
          </p>
          </br>
          <p>Are you returning to San Luis Obispo next quarter?:
            <label>
              <input name="beyondquarter" type="radio" value="Yes" class="required" title="Please indicate if you plan on returning to San Luis Obispo next quarter" />
              Yes</label>
            <label>
              <input name="beyondquarter" type="radio" value="No" />
              No</label>
          </p>
          </br>
          <p>If your appointment is regarding study abroad, please indicate your program, city, and country:
            <input type="text"  name="program" maxlength="119" class="required" title="Please indicate your program, city, and country" />
          </p>
          </br>
          </br>
        </fieldset>
        <fieldset>
          <legend>Submit Form:</legend>
          <p> Upon submission you will receive a return email confirming your appointment request has been received.
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
