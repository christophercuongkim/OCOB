<?php// File: template_bus304_email.php ?>

<?php 
  /* Template Name: email */
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

    <form action="/scripts/bus304.php" method="get">
      <input type="hidden" name="dev" value="themedev" />
          <fieldset style="width:600px; margin:10px auto 0 auto;"><legend>Page Access Login</legend>
            <p>If you are an enrolled Cal Poly student or their parent, please enter your full name and email address to access additional information.</p>
            <?php if($_GET['login_err']) echo '<p style="background:#FCC;">'.$_GET['login_err'].'</p>'; ?>
            <p>Name: <input name="name" type="text" size="30" maxlength="60" /></p>
            <p>I am a: <select name="parent" >
            <option value="Student">Student</option>
            <option value="Parent">Parent</option>
            <option value="Other">Other</option>
            </select> (Select One)</p>
            <p>Email: <input name="email" type="text" size="30" maxlength="60" /> &nbsp; <input name="submit" type="submit" value="Submit"/> &nbsp; <span style="background:#FCC;"><em><strong>Note:</strong></em> Use the password <b>calpoly</b> when prompted.</span></p>
            
        <input type="hidden" name="ipaddr" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />                
            </fieldset>
        </form>
<?php endif; ?>
      </div><!--main????Full-->
    </div> <!-- content -->
    <div class="clear"></div>

<?php get_footer(); ?>