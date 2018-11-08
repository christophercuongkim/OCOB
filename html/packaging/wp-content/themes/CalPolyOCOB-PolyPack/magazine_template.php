<?php get_header(); ?>

<?php
/**
  *  Template Name: Magazine Template
*/

 get_sidebar('area'); 
 ?>
 
<div id="content">
<style>
.splitRight {
	width: 40%;	
}
.splitLeft {
	width: 40%;
}
 </style>
  <div id="contentLine"></div>
<!-- content -->

<?php
   the_content();
?>
<!-- end of content -->
</div>

<div class="clear"></div>
<?php get_footer(); ?>
