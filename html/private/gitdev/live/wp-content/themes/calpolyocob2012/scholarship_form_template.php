<?php 
  /* Template Name: Scholarship Form Template */
?>
<?php get_header(); ?>  
<?php
    get_sidebar();
	?>
    <div id="content">
    <div id="contentLine"></div>
    
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
    <div class="post">
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <div class="entry">
      <?php the_content(); ?>
      <?php $custom_fields = get_post_custom(); ?>
      </div>

    
    </div>
<?php endwhile; ?>
<style>
radio {
}
</style>

    <form action="/OCOBWEB/frc-repository/themes/calpolyocob2012/scripts/scholarship_input.php" method="post">
      <input type="hidden" name="dev" value="themedev" />
          <fieldset style="width:600px; margin:10px auto 0 auto;"><legend>Page Access Login</legend>
            <p>If you are an enrolled Cal Poly student or their parent, please enter your full name and email address to access additional information.</p>
            <?php if($_GET['login_err']) echo '<p style="background:#FCC;">'.$_GET['login_err'].'</p>'; ?>
            <p>Are you currently an OCOB Senior with an Accounting Concentration and 135 units or more?<br>
            
              <input type="radio" name="concentration" value="Yes">Yes 
            <input type="radio" name="concentration" value="No">No
            </p>
            <p>If you wish to apply for a senior award, please check one of the following:<br>
              <input type="radio" name="radio" id="2" value="I will Attend the Accounting Awards Banquet MAY 17, 2014 (Strongly encouraged)">
            I will Attend the Accounting Awards Banquet MAY 17, 2014 (Strongly encouraged)<br>
            <input type="radio" name="radio" id="22" value="I will NOT be able to Attend the Accounting Awards Banquet MAY ">
            I will NOT be able to Attend the Accounting Awards Banquet MAY </p>
            <p>If you wish to be considered for a CPA review course award, check the course for which you wish to be considered. If you wish to be considered for either, check both.<br>
              <input id="checkbox_52eaa6a3655162" type="checkbox" value="3873" name="q1903[]">Becker/Conviser offers an award for full coverage for their CPA course review course.
              <br>
              <input id="checkbox_52eaa6a3655163" type="checkbox" value="3874" name="q1903[]">
             Rodger Phillips offers an award for full coverage for their CPA review course.
            </p>
            <p>Name:
              <input name="name" type="text" size="30" maxlength="60" />
            </p>
            <p>Student ID: 
              <input type="text" name="studentid" id="studentid">
            </p>
            <p>Email: 
            <input name="email" type="text" size="30" maxlength="60" /> 
            </p>
            <p>What total number of units do you expect to have completed upon graduation?<br>
              <input name="units" type="text" id="units" size="10">
            </p>
            <p>Enter your local phone number (format: 8056667777)<br>
              <input type="text" name="phone" id="phone">
            </p>
            <p>Enter your permanent address<br>
              <input type="text" name="address" id="address">
            </p>
            <h2>Career Plans:</h2>
            <p>Do you plan to sit for the CPA Exam?<br>
              <input type="radio" name="cpa" id="radio" value="Yes"> Yes
            <input type="radio" name="cpa" id="radio2" value="No"> No
</p>
            <p>Upon graduation, will you have accepted a position?<br>
              <input name="position" id="auto-rb0007" type="radio" value="Yes">Yes
               
              <input name="position" id="auto-rb0008" type="radio" value="No">No
            </p>
            <div id="yui_3_7_3_2_1391109796975_225">
              <label for="edit-q1901" id="yui_3_7_3_2_1391109796975_224">
              <p id="yui_3_7_3_2_1391109796975_"><span id="yui_3_7_3_2_1391109796975_222">If YES, with what firm/ company (include location/city)</span></p>
              <p>If NO, what type of work are you seeking and in what location?</p>
              </label>
            </div>
            <div id="yui_3_7_3_2_1391109796975_228">
              <textarea id="edit-q1901" name="q1901" rows="5" cols="60"></textarea>
            </div>
            <div>
              <label for="edit-q1902">
              <p>Do you have other plans upon graduation? (e.g. graduate school, Peace Corps, etc.)</p>
              </label>
            </div>
            <div>
              <textarea id="edit-q1902" name="q1902" rows="5" cols="60"></textarea>
            </div>
            <h2 id="yui_3_7_3_2_1391109796975_223">Extracurricular Activies and Community Service</h2>
            <div>
              <label for="edit-q1893">
              <p>List campus extracurricular activities  (e.g.: memberships, commitee assignments and officer positions). PLEASE indicate if you are a member of CPAC or SAAC, if you are a star-member of CPAC and/ or if you have coordinated or helped with any of the events put on by either of these organizations.</p>
              </label>
            </div>
            <div>
              <textarea id="edit-q1893" name="q1893" rows="5" cols="60"></textarea>
            </div>
            <div>
              <label for="edit-q1894">
              <p>List community service and other volunteer activities (not limited to activities in San Luis Obispo).</p>
              </label>
            </div>
            <div id="yui_3_7_3_2_1391109796975_210">
              <textarea id="edit-q1894" name="q1894" rows="5" cols="60"></textarea>
            </div>
            <div>
              <label for="edit-q1895">
              <p>List past empolyment positions including whether you have had or plan to have an internship.</p>
              </label>
            </div>
            <div>
              <textarea id="edit-q1895" name="q1895" rows="5" cols="60"></textarea>
            </div>
            <div>
              <p>I have completed the second part of the survey, which is my course and grade information.</p>
            </div>
            <div>
              <input id="checkbox_52eaa6a3655164" type="checkbox" value="Yes" name="q1896[]">YES
            </div>
            <div>
              <p>I have submitted a picture of myself to accounting (accounting@calpoly.edu) at Cal Poly for use at the Accounting Awards Banquet.</p>
            </div>
            <div>
              <input id="checkbox_52eaa6a3655165" type="checkbox" value="Yes" name="q1904[]">YES
              <br>
              <input id="checkbox_52eaa6a3655166" type="checkbox" value="No" name="q1904[]">NO
            </div>
            <p>&nbsp; 
            <input name="submit" type="submit" value="Submit"/> &nbsp; <span style="background:#FCC;"><em><strong>Note:</strong></em> Use the password <b>calpoly</b> when prompted.</span></p>
<input type="hidden" name="ipaddr" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />                
            </fieldset>
        </form>
<?php endif; ?>
      </div><!--main????Full-->
    </div> <!-- content -->
    <div class="clear"></div>

<?php get_footer(); ?>