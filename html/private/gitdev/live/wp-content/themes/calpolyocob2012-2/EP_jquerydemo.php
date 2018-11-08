<?php get_header(); ?>
<!-- page.php -->

<?php
/**
  *  Template Name: EP Jquery Demo Page
  */

 get_sidebar(); ?>
<style>
/* Mentor styles, temporarily here for testing. Should go into main CSS */
.mentor_name{
	cursor:pointer;	
}
.mentor_profile{
	display:none;
	border:1px solid black;
	padding:10px;	
}
.mn_selected{
	font-size:15px;
	color:green;
	text-decoration:underline;
	font-weight:bold;	
}
</style>

    <div id="content">
        <div id="contentLine"></div>
<h1>jQuery Mentor Name Click Example</h1>
<br />
<p>The Executive Partners Program of the Orfalea College of Business is an organization of Senior Executives and
College Administrators who volunteer their time to share their business experience and expertise. The program was
developed to utilize the executive and entrepreneurial talent in the San Luis Obispo area to benefit Cal Poly
students. The program matches students with local professionals who will be able to mentor students on career
options and give insights into the practical environment of their career choice.</p>
<p><a class="mentor_name" id="m1" href="#m1p">Lorem Ipsum</a></p>
<p><a class="mentor_name" id="m2" href="#m2p">Jquery Detects</a></p>
<p><a class="mentor_name" id="m3" href="#m3p">Entre Talent</a></p>
<p><a class="mentor_name" id="m4" href="#m4p">San Luis</a></p>
<p><a class="mentor_name" id="m5" href="#m5p">Gave Insights</a></p>
<p><a class="mentor_name" id="m6" href="#m6p">Sixth Mentor</a></p>
<h1 class="mentor_profile" id="m1p">Mentor 1</h1>
<h1 class="mentor_profile" id="m2p">Mentor 2</h1>
<h1 class="mentor_profile" id="m3p">Mentor 3</h1>
<h1 class="mentor_profile" id="m4p">Mentor 4</h1>
<h1 class="mentor_profile" id="m5p">Mentor 5</h1>
<h1 class="mentor_profile" id="m6p">Mentor 6</h1>

<h1>jQuery Sample Header Demo.</h1>
<p>Nothing to see here, another dirty stinkin' commit test.</p>

    </div>
    </div>
<!-- content -->
<div class="clear"></div>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery('.mentor_name').click(function(){
		showMentor(jQuery(this).attr('id'));
	});
	
	function showMentor(id){
		jQuery('.mentor_name').each(function(){ jQuery(this).removeClass('mn_selected');});
		jQuery('#'+id).addClass('mn_selected');
		jQuery('.mentor_profile').hide();
		jQuery('#'+id+'p').show();				
	}
});
</script>
<?php get_footer(); ?>
