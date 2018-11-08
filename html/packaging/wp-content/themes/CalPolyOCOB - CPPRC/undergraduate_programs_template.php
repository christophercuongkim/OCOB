<?php// File: undergraduate_programs_ template.php ?>
<?php get_header(); ?>  
<style>
p {
  font-size: .9em;
    font-weight: normal;
    line-height: 1.5em;
    margin: 5px 0 10px;
    color: #323232;
    font-family: 'Open Sans', 'Trebuchet MS', Verdana, sans-serif;
}
.entry > div {
  background: url(https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_css/content/thickthinline.gif) top left repeat-x;
}
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

h3 a {
      font-family: 'Open Sans', 'Trebuchet MS', Verdana, sans-serif !important;
    text-decoration: underline !important;
}
</style>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>

<?php
/**
  *  Template Name: Undergraduate Programs
  */
    get_sidebar('area');
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
      <p><center>
        <?php
         if( have_rows('program') ):

      // loop through the rows of data
        while ( have_rows('program') ) : the_row();

        ?> | <a href="#<?php echo str_replace(" ", "", get_sub_field('program_name')); ?>"><?php echo the_sub_field('program_name'); ?></a><?php

        endwhile;
        endif;
        ?> |
     </center> </p>
      <?php
      if( have_rows('program') ):

      // loop through the rows of data
      while ( have_rows('program') ) : the_row(); ?>
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
<?php
      endwhile;

      endif;
      ?>
      </div>
    </div>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->
    </div> <!-- content -->
    <div class="clear"></div>
<?php get_footer(); ?>