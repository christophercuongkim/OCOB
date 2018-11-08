<?php
/*
$valid_ips = array('129.65.176.171', '129.65.176.189', '129.65.90.57', '129.65.25.149'); #'129.65.176.189' wireless, '129.65.176.171' Jake wire
if (!in_array($_SERVER['REMOTE_ADDR'],$valid_ips)) {
	echo '<h1>Scheduled Maintenance</h1><p>The Orfalea College of Business website will be undergoing scheduled maintenance tonight from <strong>5pm to 7pm</strong> PST and will be available again by 7pm.</p>
	<p>Thank you for your patience as we make important upgrades to our website.</p>';
	exit();
}
*/
global $cpto;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><head>
<!-- -<meta charset="<?php bloginfo( 'charset' ); ?>" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="en" />
<meta name="language" content="en" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="codebase" content="5.0" />
<title>
<?php bloginfo('name');  echo ' &mdash; Cal Poly, San Luis Obispo';?>
</title>
<meta name="Description" content="Description" />
<meta name="Keywords" content="Keywords" />
<meta name="comments" content="Comments" />
<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php // bloginfo( 'stylesheet_url' ); ?>" /> -->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="<?php bloginfo('template_directory'); ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" /> 
<link href="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/cp_screen.min.css" rel="stylesheet" type="text/css" />

<link href="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/cp_print.min.css" rel="stylesheet" type="text/css" media="print" />

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0">
<style>
#agnosia-bootstrap-carousel {
	display:none;	
}
#sidebar-dropdown {
	display:none;
}
#navicon {
	display: none;
}

.green-button {
	margin-left: 13px;width: 45%;height: 75px;background: #357A37;color: white;border: none;font: 30px Calibri, Arial, Helvetica, sans-serif;
}		
</style>
<!-- Mobile Ready Sites -->
<?php if(is_page("Directory") || is_page("Undergraduate Programs") || (is_page() && !is_page("Orfalea College Distinguished Speaker Series")) || is_page("About the Orfalea College of Business") || is_page("Academic Areas") ||  get_field("directory_sub_blog_id") != "" || is_page("Homepage") || is_page("Orfalea College of Business Advising Center") || (get_post_type() == 'faculty_profile')) { ?>
<meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0">
<link href="<?php bloginfo('template_directory'); ?>/style-mobile.css" rel="stylesheet" type="text/css" />
<?php  } ?>
<!--[if IE 8]>
<link href="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie8_screen.min.css" rel="stylesheet" type="text/css" />
<link href="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie8_print.min.css" rel="stylesheet" type="text/css" media="print" />
<![endif]-->
<!--[if IE 7]>
<link href="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie7_screen.min.css" rel="stylesheet" type="text/css" />
<link href="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie7_print.min.css" rel="stylesheet" type="text/css" media="print" />
<![endif]-->
<link href="<?php bloginfo('template_directory'); ?>/css/screen.min.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/print.min.css" rel="stylesheet" type="text/css" media="print" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="https://webresource.its.calpoly.edu/jquery/1.6.4/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://webresource.its.calpoly.edu/jqueryui/1.8.20/jquery.ui.core.min.js" type="text/javascript"></script>
<script src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.1/common/jquery/noconflict.min.js" type="text/javascript"></script>
<script src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.1/common/jquery/smoothscroll.min.js" type="text/javascript"></script>
<script src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.1/common/jquery/zebrastriping.min.js" type="text/javascript"></script>

<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


<link rel="shortcut icon" href="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/favicon.ico" type="image/x-icon" />

<?php
	/* 
	 * 	Add this to support sites with sites with threaded comments enabled.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	//wp_head();
	
	wp_get_archives('type=monthly&format=link');
?>
</head>
<!-- Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-7650667-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Jake's Collapse-O-Matic Javascript Fix-->
<script type='text/javascript'>
var colomatduration = 'fast';
var colomatslideEffect = 'slideFade';
</script>
<body>
<div id="wrapper">
<div id="header">
    <div id = "accessibilityNav">
        <ul>
            <li><a href="#topH1" id="skip" title="skip to content">Skip to Content</a></li>
            <li><a href="http://www.calpoly.edu/help.html" id="helpLink" title="help">?</a></li>
        </ul>
    </div><!-- accessibilityNav -->
    <div id = "audienceNav">
        <?php /* wp_nav_menu(array( 'theme_location' => 'toplinks', 
										  'container' => false, 
										  'menu_class' => NULL,
										  'menu_id' => 'toplinksmenu',
										  'fallback_cb' => false));  */
		  wp_nav_menu(array( 'theme_location' => 'toplinksmenu', 
		  'container' => false, 
		  'menu_id' => 'toplinksmenu', 
		  'menu_class' => NULL,
		  'fallback_cb' => false));
										  ?>
        <!--
    <ul>
      <li><a href="#">Current Students</a></li>
      <li><a href="#">Prospective Students</a></li>
      <li><a href="#">Parents</a></li>
      <li><a href="#">Business Community</a></li>
      <li><a href="#">Faculty &amp; Staff</a></li>
      <li><a href="#">Alumni</a></li>
    </ul>
    --> 
    </div> <!-- audienceNav -->
    <hr />
    <div id = "myCalPolyNav"> 
    	<a href="http://my.calpoly.edu/" id="login" >my CalPoly login</a> 
    </div> <!-- myCalPolyNav -->
    <div id = "utilityNav">
        <ul>
            <li id="azindex"><a href="sitemap/">A - Z Index</a>
                <ul id="azindexdropdown">
                    <li class="lightGreen"><a href="sitemap/#A">A</a></li>
                    <li class="lightGreen"><a href="sitemap/#B">B</a></li>
                    <li class="darkGreen"><a href="sitemap/#C">C</a></li>
                    <li class="darkGreen"><a href="sitemap/#D">D</a></li>
                    <li class="lightGreen"><a href="sitemap/#E">E</a></li>
                    <li class="lightGreen"><a href="sitemap/#F">F</a></li>
                    <li class="darkGreen"><a href="sitemap/#G">G</a></li>
                    <li class="darkGreen"><a href="sitemap/#H">H</a></li>
                    <li class="lightGreen"><a href="sitemap/#I">I</a></li>
                    <li class="lightGreen"><a href="sitemap/#J">J</a></li>
                    <li class="darkGreen"><a href="sitemap/#K">K</a></li>
                    <li class="darkGreen"><a href="sitemap/#L">L</a></li>
                    <li class="lightGreen"><a href="sitemap/#M">M</a></li>
                    <li class="lightGreen"><a href="sitemap/#N">N</a></li>
                    <li class="darkGreen"><a href="sitemap/#O">O</a></li>
                    <li class="darkGreen"><a href="sitemap/#P">P</a></li>
                    <li class="lightGreen"><a href="sitemap/#Q">Q</a></li>
                    <li class="lightGreen"><a href="sitemap/#R">R</a></li>
                    <li class="darkGreen"><a href="sitemap/#S">S</a></li>
                    <li class="darkGreen"><a href="sitemap/#T">T</a></li>
                    <li class="lightGreen"><a href="sitemap/#U">U</a></li>
                    <li class="lightGreen"><a href="sitemap/#V">V</a></li>
                    <li class="darkGreen"><a href="sitemap/#W">W</a></li>
                    <li class="darkGreen"><a href="sitemap/#X">X</a></li>
                    <li class="lightGreen"><a href="sitemap/#Y">Y</a></li>
                    <li class="lightGreen"><a href="sitemap/#Z">Z</a></li>
                </ul>
            </li>
            <li id="quicklinks"><a href="javascript:;">Quick Links</a>
                <?php wp_nav_menu(array( 'theme_location' => 'quicklinks', 
										  'container' => false, 
										  'menu_id' => 'quicklinksdropdown', 
										  'menu_class' => NULL,
										  'fallback_cb' => false)); 
						/*
						$args =  array(
											'theme_location'  => 'footer',
											'menu'            => , 
											'container'       => false, 
											'container_class' => , 
											'container_id'    => ,
											'menu_class'      => , 
											'menu_id'         => ,
											'echo'            => true,
											'fallback_cb'     => false,
											'before'          => ,
											'after'           => ,
											'link_before'     => ,
											'link_after'      => ,
											'items_wrap'      => '<ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
											'depth'           => 0,
											'walker'          => );*/
/*

        <ul id="quicklinksdropdown">
            <li><a href="#">Academic Advising</a></li>
            <li><a href="#">Economics</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Other Departments</a></li>
            <li><a href="#">This is actually a menu!</a></li>
            <li><a href="#">Aren't you shocked?</a></li>
        </ul>
*/
?>
            </li>
            <li id="maps"><a href="http://maps.calpoly.edu/">Maps</a></li>
        </ul>
    </div> <!-- utilityNav -->
    <div id="headerContent">
        <div id="cplogo" style="margin-top:20px;margin-bottom:20px;"> <a href="<?php echo 'http://www.calpoly.edu';//get_bloginfo('url'); ?>" ><img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.1/common/images_html/header/cp_logo_lrg.png" alt="Cal Poly, San Luis Obispo" id="thecplogo"  width="150" height="75"title="" /></a> </div> <!-- cplogo -->
        <div id="deptName">
            <?php
function headerSize($string)
{
	$i = strlen($string);
	if($i < 25)
	{
		return "";
	}
	else
	{
		$i = 38 - floor((($i-25)/1.5));
		return ' style="font-size:'.$i.'px;" ';
	}
}
?>
            <!-- Removed by FG to see if we can keep the Header text static <h2><a <?php echo headerSize(get_bloginfo('name'));?>href="<?php echo get_bloginfo('url'); ?>"> <?php echo get_bloginfo('name'); ?></a></h2> -->
            <h2><a href="http://www.cob.calpoly.edu">Orfalea College of Business</a></h2>
            <h3><a href="<?php echo 'http://www.cob.calpoly.edu';get_bloginfo('url'); ?>"><?php echo get_bloginfo('description'); ?></a>
			<?php //echo preg_replace('/\.php$/', '', __FILE__); ?></h3>
            <p><?php //echo date("D M j G:i:s T Y", filemtime( __FILE__)); ?> <?php //echo round((time() - filemtime( __FILE__))/60) ; ?></p>
        </div> <!-- deptName -->
    </div> <!-- headerContent -->
</div> <!-- header -->

<!-- Three bar Navigation -->
<script>
function toggleNav(id) {
	if(document.getElementById(id).style.display == "none") {
		document.getElementById(id).style.display = "block";
	} else { 
		document.getElementById(id).style.display = "none";
	}
}
$( document ).ready(function() {
     $("#navicon_img").click(function(){
	   if( $('#navicon_nav').css("display") == "none")
          { 
		  $('#navicon_nav').slideDown('slow'); 
		  }
       else 
          { 
		  $('#navicon_nav').slideUp("slow");
		   }
	});
}); 
//Drop down sidebar
$( document ).ready(function() {
	var count = 0;
	$(".menu li a").each(function(i) {
		$("#sidebar-select").append($("<option></option>")
         .attr("value",this.getAttribute("href"))
         .text(this.textContent));
		 count = count + 1;
		 console.log("HEY");
		
	});
	$("#sidebar-select option").each(function(i) {
		if(this.getAttribute("value") == document.URL) {
			this.setAttribute("selected", "selected");
		}
	});
	$("#cpUl li").each(function(i) {
		$('#navicon_nav').append($("<li></li>")
         .attr("href",this.getAttribute("href"))
         .html(this.innerHTML));
	});
	$(".responsive-full").each(function(i) {
		var curWidth = this.getAttribute("width");
		if(curWidth.slice(-2) != "px") {
			curWidth = curWidth + "px";
		}
		$(this).css("max-width", curWidth);
	});
	if(count == 0) {
		$("#sidebar-dropdown").hide();
	}
});

//Closes menu if you click out of div
$('*').click(function(e){
       if( e.target.id == 'navicon' || e.target.id ==  "navicon_img")
          { return true; }
        else if( document.getElementById("navicon_nav").style.display != "none")
          { 
		  $('#navicon_nav').slideUp("slow");
		  if(document.getElementById("navicon_nav").style.display == "none") {
		  }
		   }

 });
</script>
<div id="navicon">
<img id="navicon_img" src="http://www.cob.calpoly.edu/wp-content/uploads/media/images/threelines.png" style="position:absolute; right:0px; top: 0px; width:75px; height: auto; cursor:pointer;"/>
<ul id="navicon_nav" style="display: none;">
<?php //echo '<li><a href="http://www.cob.calpoly.edu/"><img height="24" width="20" src="'. get_template_directory_uri().'/images/home.png" alt="Orfalea College of Business" /></a></li>';
?>
<?php
//wp_nav_menu(array('theme_location' => 'mainmenulinks', "container" => 'false', "items_wrap" => '%3$s'));
?>
</ul>
</div>
<div id="sidebar-dropdown">
<select id="sidebar-select" style="width:100%;" onchange="window.location.href = this.value" >
<option value="">Navigation...</option>
</select>
</div>   

<?php if(has_nav_menu("mainmenulinks") /*&& wp_nav_menu(array('theme_location' => 'mainmenulinks', 'echo' => '0'))*/ ) {
	echo "<div id='cp'>";
echo "<ul id='cpU1'>";
echo '<li><a href="http://www.cob.calpoly.edu/"><img height="24" width="20" src="'. get_template_directory_uri().'/images/home.png" alt="Orfalea College of Business" /></a></li>';
	wp_nav_menu(array('theme_location' => 'mainmenulinks', 'container_id' => 'cp', "container" => 'false', "items_wrap" => '%3$s'));
	 ?>
    <li id="searchli">
            <div id="search">
                <form id="gs" method = "get" title = "Search Form" action="http://search.calstate.edu/search">
                    <div>
                        <input type="hidden" name="site" value="slo-CalPoly" />
                        <input type="hidden" name="output" value="xml_no_dtd" />
                        <input type="hidden" name="client" value="slo-CalPoly" />
                        <input type="hidden" name="proxystylesheet" value="slo-CalPoly" />
                        <input type="hidden" name="sitesearch" value="www.cob.calpoly.edu" />
                        <input type="text" id="q" name="q" value="Search" title="Search this site" alt="Search Text" maxlength="256"/>
                        <input type="image" id="searchSubmit" name="submit" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/header/search-arrow.png" alt="Go" title="Submit Search Query" />
                    </div>
                </form>
                <!--
        <form method = "get" title = "Search Form" action="http://search.calstate.edu/search">
          <div>
            <input type="hidden" name="site" value="slo-CalPoly" />
            <input type="hidden" name="output" value="xml_no_dtd" />
            <input type="hidden" name="client" value="slo-CalPoly" />
            <input type="hidden" name="proxystylesheet" value="slo-CalPoly" />
            <input type="hidden" name="sitesearch" value="departmentURL.calpoly.edu" />
            <input type="text" id="q" name="q" value="Search" title="Search this site" alt="Search Text" maxlength="256"/>
            <input type="image" id="searchSubmit" name="submit" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/header/search-arrow.png" alt="Go" title="Submit Search Query" />
          </div>
        </form> --> 
            </div>
        </li>
        <?php
		echo "</ul></div>";
} else { ?>
<div id = "cp">
<ul id="cpUl">
        <li><a href="http://www.cob.calpoly.edu/"><img height="24" width="20" src="<?php echo get_template_directory_uri(); ?>/images/home.png" alt="Orfalea College of Business" /></a></li>
        <?php 
		/**
			*		To add a custom menu, create an array: array('Title','/url/')
      *   Changed the 'About' Page to its new location
			*/
		$top_nav = array(
      // $cpto->about_blog_id,
      array('About Us', '/about-the-orfalea-college-of-business'),
			array('Directory', '/directory'),
      $cpto->advising_blog_id, 
			$cpto->academic_areas_blog_id,
			$cpto->undergraduate_blog_id,
			array('Graduate Programs', 'http://mba.calpoly.edu'),
			 );
			 
			 
		foreach($top_nav as $nav_bid)
		{
				$style = '';
			if(is_int($nav_bid))
			{
				if(get_current_blog_id() == $nav_bid)
					$style = ' style="font-weight:bold;" '; // background-color:#A8BB9F;
				switch_to_blog($nav_bid);
				$name = get_bloginfo('name');
				$url = home_url();
				restore_current_blog();
			}
			else
			{
				$name = $nav_bid[0];
				$url = $nav_bid[1];
				$cur_uri = $_SERVER['REQUEST_URI'];
				// Bold for About, Directory
				echo '<!-- '.$cur_uri.' -->';
				switch($name)
				{
					case 'About Us':
						echo '<!-- About: '.strpos($cur_uri, 'about-').', ab: '.$name.' -->';
						if((strpos($cur_uri, 'about-') == 1)){	
							$style = ' style="font-weight:bold;" ';
						}
						break;
					case 'Directory':
						if (strpos($cur_uri, 'directory') == 1){
							$style = ' style="font-weight:bold;" ';
						}else if (strpos($cur_uri, 'faculty') == 1){	
							$style = ' style="font-weight:bold;" ';
						}
						break;
				}
				
					
				
			}
			echo '<li class="noMenu" '.$style.'><a href="'.$url.'">'.$name.'</a></li>';
				$style = '';
		}
		?>
        <li id="searchli">
            <div id="search">
                <form id="gs" method = "get" title = "Search Form" action="http://search.calstate.edu/search">
                    <div>
                        <input type="hidden" name="site" value="slo-CalPoly" />
                        <input type="hidden" name="output" value="xml_no_dtd" />
                        <input type="hidden" name="client" value="slo-CalPoly" />
                        <input type="hidden" name="proxystylesheet" value="slo-CalPoly" />
                        <input type="hidden" name="sitesearch" value="www.cob.calpoly.edu" />
                        <input type="text" id="q" name="q" value="Search" title="Search this site" alt="Search Text" maxlength="256"/>
                        <input type="image" id="searchSubmit" name="submit" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/header/search-arrow.png" alt="Go" title="Submit Search Query" />
                    </div>
                </form>
                <!--
        <form method = "get" title = "Search Form" action="http://search.calstate.edu/search">
          <div>
            <input type="hidden" name="site" value="slo-CalPoly" />
            <input type="hidden" name="output" value="xml_no_dtd" />
            <input type="hidden" name="client" value="slo-CalPoly" />
            <input type="hidden" name="proxystylesheet" value="slo-CalPoly" />
            <input type="hidden" name="sitesearch" value="departmentURL.calpoly.edu" />
            <input type="text" id="q" name="q" value="Search" title="Search this site" alt="Search Text" maxlength="256"/>
            <input type="image" id="searchSubmit" name="submit" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/header/search-arrow.png" alt="Go" title="Submit Search Query" />
          </div>
        </form> --> 
            </div>
        </li>
        <?php restore_current_blog();  ?>
   </ul>
    </div> <!-- cp -->
 <?php } ?>
  

<div id="bottom_bar"></div>
<!--HeadNav-->
<?php 
$pgtemp = explode('/',get_page_template());
echo '<!-- Jake:  '.$pgtemp[count($pgtemp)-1]. ' -->';
if($pgtemp[count($pgtemp)-1] != 'homepage.php' && get_post_type() != "faculty_profile"){
	wsf_breadcrumbs(' : ',''); 
} else if(get_post_type() == "faculty_profile") { ?>
<div id="breadcrumb"> <a href="http://www.cob.calpoly.edu" title="Orfalea College of Business" rel="nofollow" =""="">Home</a>&nbsp; : &nbsp;<a href="http://www.cob.calpoly.edu/directory" title="Directory" rel="nofollow" =""="">Directory</a></div>

<?php }



?>
