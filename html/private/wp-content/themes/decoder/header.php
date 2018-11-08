<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>
		<?php if ( is_home() ) { ?><?php bloginfo('description'); ?> &raquo; <? bloginfo('name'); ?><?php } ?>
		<?php if ( is_search() ) { ?><?php echo $s; ?> &raquo; <? bloginfo('name'); ?><?php } ?>
		<?php if ( is_single() ) { ?><?php wp_title(''); ?> &raquo; <? bloginfo('name'); ?><?php } ?>
		<?php if ( is_page() ) { ?><?php wp_title(''); ?> &raquo; <? bloginfo('name'); ?><?php } ?>
		<?php if ( is_category() ) { ?>Archive <?php single_cat_title(); ?> &raquo; <? bloginfo('name'); ?><?php } ?>
		<?php if ( is_month() ) { ?>Archive <?php the_time('F'); ?> &raquo; <? bloginfo('name'); ?><?php } ?>
		<?php if ( is_tag() ) { ?><?php single_tag_title();?> &raquo; <? bloginfo('name'); ?><?php } ?>
		<?php if ( is_404() ) { ?>Sorry, not found! &raquo; <? bloginfo('name'); ?><?php } ?>
</title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/lib/superfish.css" media="screen">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/superfish.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/supersubs.js"></script>

<script type="text/javascript"> 
 
    $(document).ready(function(){ 
        $("ul.sf-menu").supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    27,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();
    });
 
</script>

<?php if (is_singular()) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>

</head>

<body>

<div id="page">

<div id="header">

	<div id="blog-logo" class="clearfix">
   	<div id="cplogo" style="height: 133px; float: left;">
         <map id="CalPolyLogo" name="CalPolyLogo">
            <area coords="0,0,166,45" shape="rect" title="Go to Cal Poly Home" alt="Cal Poly" href="http://www.calpoly.edu"/>
            <area coords="0,45,166,100" shape="rect" title="Go to COB Home" alt="College of Business" href="http://www.cob.calpoly.edu"/>
            <area coords="0, 100, 166, 133" shape="rect" title="Go to San Luis Obispo" alt="San Luis Obispo" href="http://www.visitslo.com"/>
         </map>
         <img usemap="#CalPolyLogo" title="Got to Cal Poly Home" alt="Cal Poly" src="http://www.cob.calpoly.edu/media/images/logo3.png"/>
      </div>
		<h1 id="blog-title"><a href="<?php bloginfo('url'); ?>"><? bloginfo('name'); ?></a></h1>
		<h2 id="blog-description"><? bloginfo('description'); ?></h2>
	</div>

	<ul id="menu" class="sf-menu clearfix">
		<li class="cat_item<?php if(is_home()) echo ' current-cat'; ?>"><a href="<?php bloginfo('url'); ?>">Home</a></li>		
      <li class="cat_item"><a href="#">Kudos and News</a>
        <ul>
          <li><a href="<?php bloginfo('url'); ?>?page_id=3">Current Kudos</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=4">Archived Kudos</a></li>
          <li><a href="http://www.cob.calpoly.edu/enews/" target="_blank">College Publications</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=5">E-News Archives</a></li>
        </ul>
      </li>
	  <li><a href="">College Strategic Planning</a>
	    <ul>

          
          <li><a href="http://www.president.calpoly.edu/plans.asp" target="_blank">University Mission & Plans</a></li>

<li><a href="http://www.academicprograms.calpoly.edu/specialinitiatives/accessexcellence/" target="_blank">Cal Poly Access to Excellence</a></li>

          <li><a href="#">Archived Strategic Plan Documents...</a>
            <ul>
              <li><a href="<?php bloginfo('url'); ?>?page_id=10">Strategic Plan</a></li>
              <li><a href="<?php bloginfo('url'); ?>?page_id=11">Archived Strategic Plan Partnership</a></li>
              <li><a href="<?php bloginfo('url'); ?>?page_id=9">Community</a></li>
            </ul>


	    </ul>
	  </li>
      <li><a href="#">Assessment of Learning</a>
        <ul>
          <li><a href=" http://ocob-faculty.calpoly.edu/index.php/assessment-data-entry/">Assessment Data Entry</a></li>
          <li><a href="http://ocob-faculty.calpoly.edu/assessment-of-learning/">Assessment</a></li>
          <li><a href="/videos/category/assessment/">Assessment Videos</a></li>
          <li><a href="http://ocob-faculty.calpoly.edu/index.php/senior-projects/">Senior Projects</a></li>
          <li><a href="http://ocob-faculty.calpoly.edu/index.php/archived-syllabifall-2010-syllabi/">Current Syllabi</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=80">Archived Syllabi</a></li>
          <li><a href="http://www.cob.calpoly.edu/academic/fee.html" target="_blank">OCOB Academic Fees Spending Plan</a></li>



          
        </ul>
      </li>
      <li><a href="#">Faculty Development & Qualifications</a>
        <ul>
          <li><a href="<?php bloginfo('url'); ?>?page_id=110">Statements of Criteria and Standards</a></li>
          <li><a href="https://www.digitalmeasures.com/login/calpoly/faculty/login/showLoginPage.do" target="_blank">Digital Measures</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=121">MOU Article 20
</a></li>
          <li><a href="http://ocob-faculty.calpoly.edu/index.php/online-learning-news/" target="_blank">Faculty Resource Center - News</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=23">Funding Opportunities</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=112">Grant Awards</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=115">FAR, ARPT, Ranges</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=111">Faculty Seminars & Workshops</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=16">Professional Development Readings</a></li>
<li><a href="<?php bloginfo('url'); ?>?page_id=194">Journal Lists by Area</a></li>
      </ul>        
      </li>
      <li><a href="#">Toolbox</a>
        <ul>
          <li><a href="http://www.ctl.calpoly.edu/workshops/calendar_08-09.html" target="_blank">Center for Teaching and Learning</a></li>
          <li><a href="http://www.lib.calpoly.edu/staff/fvuotto/services/" target="_blank">Business Librarian Services</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=14">Current Committee Assignments</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=17">Current Committee Minutes</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=18">Archived Committee Minutes</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=19">Class Schedules</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=22">Advisory Council Information</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=119">Work Requests</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=24">Faculty Support</a></li>
          <li><a href="http://its.calpoly.edu/index.html" target="_blank">ITS</a></li>
          <li><a href="http://www.afd.calpoly.edu/hr/index.html" target="_blank">Human Resources</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=84">Information for New Faculty</a></li>
          <li><a href="<?php bloginfo('url'); ?>/support/CPsoftware4.pdf" target="_blank">Available Software</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=21">Mentoring</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=117">Travel Forms</a></li>
          <li><a href="<?php bloginfo('url'); ?>?page_id=116">Logo/Wordmark</a></li>
          <li><a href="http://www.calpoly.edu/staff/staff.html" target="_blank">Staff Tools</a></li>
        </ul>
      </li>
    </ul>
	<div id="rss">
		<a href="<?php bloginfo('rss2_url'); ?>">Subscribe to RSS Feed</a>
	</div>

</div><!-- end header -->
