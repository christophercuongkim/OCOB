<?php// File: header.php ?>
<?php
/*
If we need maintainece time this goes up
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="en" />
<meta name="language" content="en" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="codebase" content="5.0" />
<meta name="google-site-verification" content="QYiq7vw5Z3M09b3lGg_jgwanFsOSNkqx1vtT4BHxWKo" />
<title><?php if (function_exists('is_tag') && is_tag()) { echo 'Tag Archive for &quot;'.$tag.'&quot; - '; }
			elseif (is_archive()) { wp_title(''); echo ' Archive - '; }
			elseif (is_search()) { echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
			elseif (!(is_404()) && (is_single()) || (is_page())) { echo 'OCOB - '; echo get_the_title();  }
			elseif (is_404()) { echo 'Not Found'; }
			/*if (is_home()) { bloginfo('description'); }
			elseif (!(is_404())){ bloginfo('name'); }*/ ?></title>
<meta name="Description" content="Description" />
<meta name="Keywords" content="Keywords" />
<meta name="comments" content="Comments" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="<?php bloginfo('template_directory'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/cp_screen.min.css" rel="stylesheet" type="text/css" />

<link href="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/cp_print.min.css" rel="stylesheet" type="text/css" media="print" />

<link href="//netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

<style>

    .mobile-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  visibility: hidden;
}
#mobile-nav-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  visibility: hidden;
  z-index: 999;
}
#mobile-right-nav-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  visibility: hidden;
  z-index: 9999;
}
#mobile-nav {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 56px;
  margin: 0;
/*  padding: 5px 0;*/
  background-color: #29551a;
  box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
  z-index: 9999;
}
#mobile-nav .navbar-toggle {
  margin: 5px 0;
  padding: 10px 0;
}
#mobile-nav .navbar-toggle .icon-bar {
  background-color: #fff;
}
#mobile-nav #menu-icon-open {
  line-height: 12px;
  font-size: 20px;
  color: #fff;
  visibility: hidden;
}
#mobile-main-nav {
  position: fixed;
  left: 0;
  top: 56px;
  width: 100%;
/*  height: 0;*/
  max-height: calc(100% - 56px);
  border: 0;
  z-index: 9995;
  overflow: auto;
  /*visibility: hidden;*/
}
#mobile-main-nav > ul {
  margin: 0;
  float: none;
  background-color: #29551a;
}
#mobile-main-nav > ul li {
  float: none;
  background-color: #29551a;
}
#mobile-main-nav > ul li .dropdown-toggle {
  background-image: url('../images/cp/plus.gif');
  background-position: right center;
  background-repeat: no-repeat;
}
#mobile-main-nav > ul li.open {
  background-color: rgba(0, 0, 0, 0.3);
}
#mobile-main-nav > ul li.open .dropdown-toggle {
  background-color: transparent;
}
#mobile-main-nav > ul li a {
  padding: 10px 15px;
  display: block;
  font-family: 'Calibri', sans-serif;
  font-weight: bold;
  font-size: 15px;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #fff;
}
#mobile-main-nav > ul li a:hover,
#mobile-main-nav > ul li a:focus {
  background-color: rgba(0, 0, 0, 0.3);
}
#mobile-main-nav > ul li .dropdown-menu {
  position: static;
  float: none;
  margin: 0;
  border: none;
  background-color: transparent;
  box-shadow: none;
}
#mobile-main-nav > ul li .dropdown-menu li {
  background-color: transparent;
}
#mobile-main-nav > ul li .dropdown-menu li a {
  border: none;
  font-weight: normal;
  text-transform: none;
  letter-spacing: 0;
  line-height: 20px;
}
#mobile-main-nav > ul li .dropdown-menu li a:hover {
  text-decoration: underline;
}

#mobile-main-nav {
    display: none;
}
#mobile-nav {
	 display:none;
	 top:0px;
	 left:0px;
	 width:100%;
 }
 /*
#mobile-main-nav > ul li .dropdown-toggle {
  background-image: url('../images/cp/plus.gif');
  background-position: right center;
  background-repeat: no-repeat;
}

#mobile-main-nav > ul li.open .dropdown-toggle {
  background-color: transparent;
}

#mobile-main-nav > ul li .dropdown-menu {
  position: static;
  float: none;
  margin: 0;
  border: none;
  background-color: transparent;
  box-shadow: none;
}

#mobile-main-nav > ul li .dropdown-menu li {
  background-color: transparent;
}

#mobile-main-nav > ul li .dropdown-menu li a {
  border: none;
  font-weight: normal;
  text-transform: none;
  letter-spacing: 0;
  line-height: 20px;
}
#mobile-main-nav > ul li .dropdown-menu li a:hover {
  text-decoration: underline;
} */
#mobile-nav-overlay {
  display: none !important;
}
</style>

<style>
#agnosia-bootstrap-carousel {
	display:none;
}
#sidebar-dropdown {
	display:none;
}
.sub-menu{
	width: 110%;
	margin-left: -10px;
	background-color: #f9f6ef;
}
.sub-menu-item{
	border-right: none;
}

h2 a:hover{
	border-bottom: none;
}

#thecplogo {
	width: 150px;
}
form #q {
	margin-top: 7px;
}
</style>
<!-- Mobile Ready Sites -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link href="<?php bloginfo('template_directory'); ?>/style-mobile.css" rel="stylesheet" type="text/css" />
<!--[if IE 8]>
<link href="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie8_screen.min.css" rel="stylesheet" type="text/css" />
<link href="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie8_print.min.css" rel="stylesheet" type="text/css" media="print" />
<![endif]-->
<!--[if IE 7]>
<link href="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie7_screen.min.css" rel="stylesheet" type="text/css" />
<link href="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/css/ie7_print.min.css" rel="stylesheet" type="text/css" media="print" />
<![endif]-->
<link href="<?php bloginfo('template_directory'); ?>/css/screen.min.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/main-over-rides.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="<?php bloginfo('template_directory'); ?>/css/dropdown.css" rel="stylesheet" type="text/css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://webresource.its.calpoly.edu/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
<script src="/wp-includes/js/jquery/jquery-migrate.js?ver=1.2.1"></script>
<!-- need no conflict to make zebra striping work -->
<script src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.1/common/jquery/noconflict.min.js" type="text/javascript"></script>
<script src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.1/common/jquery/zebrastriping.min.js" type="text/javascript"></script>
<!-- undo the no conflict so that the mobile slider works -->
<script>
var $ = jQuery.noConflict();
</script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/jquery.smooth-scroll.min.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function($){
	$('a').smoothScroll({excludeWithin: ['.carousel']});
});
</script>
<link rel="shortcut icon" href="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/favicon.ico" type="image/x-icon" />
<!--- Google captcha thanks to pfed -->
<script src='https://www.google.com/recaptcha/api.js'></script>
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
        <?php
		  wp_nav_menu(array( 'theme_location' => 'toplinksmenu',
		  'container' => false,
		  'menu_id' => 'toplinksmenu',
		  'menu_class' => NULL,
		  'fallback_cb' => false));
										  ?>
    </div> <!-- audienceNav -->
    <hr />
    <div id = "myCalPolyNav">
    	<a href="http://my.calpoly.edu/" id="login" >my CalPoly login</a>
    </div> <!-- myCalPolyNav -->
    <div id = "utilityNav">
        <ul>
            <li id="quicklinks"><a href="javascript:;">Quick Links</a>
                <?php wp_nav_menu(array( 'theme_location' => 'quicklinks',
										  'container' => false,
										  'menu_id' => 'quicklinksdropdown',
										  'menu_class' => NULL,
										  'fallback_cb' => false));

				?>
            </li>
            <li id="maps"><a href="http://maps.calpoly.edu/">Maps</a></li>
        </ul>
    </div> <!-- utilityNav -->
    <div id="headerContent">
        <div id="cplogo" style="margin-top:20px;margin-bottom:20px;"> <a href="<?php echo 'http://www.calpoly.edu';?>" ><img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.1/common/images_html/header/cp_logo_lrg.png" alt="Cal Poly, San Luis Obispo" id="thecplogo" title="" /></a> </div> <!-- cplogo -->
        <div id="deptName">
            <?php
function headerSize($string)
{
	$i = strlen($string);
	if($i >= 25)
	{
		$i = 38 - floor((($i-25)/1.5));
		return ' style="font-size:'.$i.'px;" ';
	}
	return "";
}
$text = "Orfalea College of Business";
$url ="/";
if(get_theme_mod("OCOBdisplayTitle") !== FALSE && get_theme_mod("OCOBdisplayTitle")  != "Orfalea College of Business"){
	$text = get_theme_mod("OCOBdisplayTitle");
	$url = get_site_url();
}
?>
            <h2><a href="<?php echo($url); ?>"><?php echo($text);?></h2></a>
            <!-- added pre-wrap so tagline will not cut off on certain mobile web browsers -->
            <h3 style="font-size:21px; white-space:pre-wrap;"><?php echo get_bloginfo('description'); ?>
			</h3>
            <p></p>
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
var $ = jQuery.noConflict();

function addSubMenus(lastLi, url) {
    jQuery.ajax({
    type: "POST",
    url: "/wp-content/themes/CalPolyOCOB-PolyPack/custom_functions.php",
    dataType: 'json',
    data: {functionname: 'getSubmenu', arguments: url},
    success: function(obj) {
        if(obj.length == 0) {
            return;
        }
        $(lastLi).addClass("dropdown");
//        $(lastLi).find("a").first().addClass("dropdown-toggle").attr("data-toggle", "dropdown").attr("href", "#");
        $(lastLi).append("<button class='dropdown-toggle' data-toggle='dropdown' style=' background-color: transparent;background-image: none;border: 1px solid transparent;outline: 0; position: relative; top: -30px; padding-right: 18px; width:50px !important; float: right;' ><i style='float:right; font-size: 1.5em !important; color: white;' class='fa fa-plus'></i></button>");
        $(lastLi).append("<ul style='position:relative; top: -15px;' class='dropdown-menu' role='menu'></ul>");
        var ul = $(lastLi).find("ul").last();
        for(var i = 0; i < obj.length; i++) {
            $(ul).append("<li><a href='" + obj[i].url + "'>" + obj[i].title + "</a></li>");
        }
    }});
}



//Drop down sidebar mobile stuff
$( document ).ready(function() {
	var count = 0;
	$(".menu li a").each(function(i) {
		if(this.textContent != ""){
			$("#sidebar-select").append($("<option></option>")
	         .attr("value",this.getAttribute("href"))
	         .text(this.textContent));
			 count = count + 1;
		}
	});
	$("#sidebar-select option").each(function(i) {
		if(this.getAttribute("value") == document.URL) {
			this.setAttribute("selected", "selected");
		}
	}); 
	$("#cpUl li").each(function(i) {
        if(i != 0) {
            var id = $('#mobile-navbar-list').append($("<li></li>")
             .attr("href",this.getAttribute("href"))
             .html(this.innerHTML));
            addSubMenus($(id).find("li").last()[0], this.children[0].pathname);

        }
	});
    $("#navbar .menu-item-depth-0").each(function(i) {
        if(i != 0) {
            var id = $('#mobile-navbar-list').append($("<li></li>")
            .append($("<a></a>")
            .attr("href",this.children[0].getAttribute("href"))
             .html(this.children[0].innerHTML)));
            addSubMenus($(id).find("li").last()[0], this.children[0].pathname);

        }
	});
	$(".responsive-full").each(function(i) {
		var curWidth = this.getAttribute("width");
		if(curWidth.slice(-2) != "px") {
			curWidth = curWidth + "px";
		}
		$(this).css("max-width", curWidth);
	});
	/*if(count == 0) {
		$("#sidebar-dropdown").hide();
	}else{
		$("#defaultNav").empty().append("Navigation...");
	}*/

    $("#mobile-main-nav").on('show.bs.collapse', function(e) {
		var width = $('body').width();
		$('body').css({
      'overflow': 'hidden',
      'padding-right': ($('body').width() - width) + 'px'
    });
		$("#mobile-nav-overlay").css('visibility', 'visible');
		$("#mobile-nav-overlay").fadeIn();
		$("#mobile-main-nav").css('visibility', 'visible');
    });


    $("#mobile-main-nav").on('hidden.bs.collapse', function(e) {
		$('body').css({
			'overflow': '',
			'padding-right': ''
		});
		$("#mobile-main-nav").css('visibility', '');
		$("#mobile-nav-overlay").fadeOut(function() {
			$("#mobile-nav-overlay").css('visibility', '');
		});
	});

	$("#mobile-nav-overlay").click(function() {
		$("#mobile-main-nav").collapse('hide');
    $("#mobile-nav-overlay").fadeOut(function() {
      $("#mobile-nav-overlay").css('visibility', '');
    });
	});

});
</script>

<div id="mobile-nav" class="visible-xs visible-sm row">
    <div style="width:200px; float:left;">
        <a href="http://www.calpoly.edu/"><img src="<?php echo get_template_directory_uri(); ?>/images/cp_logo_white.jpg" alt="Cal Poly" title="Go to Cal Poly Home"></a>
    </div>
    <div class="col-xs-6 text-right" style="margin-right:10px; width:30px; float:right;">
        <!--<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-disable-scrolling="false">-->
        <button type="button" class="navbar-toggle" style="background-color: transparent;     background-image: none;
    border: 1px solid transparent; outline: 0;" data-toggle="collapse" data-target="#mobile-main-nav">
<!--            	<span id="menu-icon-closed" class="glyphicon glyphicon-menu-hamburger"></span>--><i class="fa fa-bars fa-2x" style="color:white; font-size:2em !important;"></i>
            <span id="menu-icon-open" class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
</div>
    <div id="mobile-main-nav" class="collapse"><!-- #BeginLibraryItem "/Library/main-nav.lbi" -->

<ul id="mobile-navbar-list" class="nav navbar-nav">
    <li><a href="/">Home</a></li>
<!--
    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Academic</a>
          <ul class="dropdown-menu" role="menu">
              <li><a href="academic/index.html">Academic Home</a></li>
              <li><a href="academic/masters.html">Master's Degree Programs</a></li>
              <li><a href="academic/certificate.html">Professional Certificate Programs</a></li>
              <li><a href="academic/dietetic.html">Dietetic Internship</a></li>
              <li><a href="academic/waterlead.html">Water Leadership &amp; Management</a></li>
              <li><a href="https://grad.calpoly.edu/students/continuous.html">Continuous Enrollment</a></li>
          </ul>
    </li>
-->
</ul><!-- #EndLibraryItem -->
    </div>

    <div id="mobile-nav-overlay" style="display: none;"></div>

<!--Sidebar Dropdown-->
<div id="sidebar-dropdown">
<select id="sidebar-select" style="width:100%;" onchange="window.location.href = this.value" >
<option value="" id="defaultNav">Sidebar Navigation</option>
</select>
</div>


<?php
//used to make non-mobile main menu dropdowns
class myWalker extends Walker_Nav_Menu {

// add classes to ul sub-menus
function start_lvl( &$output, $depth ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        'sub-menu',
        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
        'menu-depth-' . $display_depth
        );
    $class_names = implode( ' ', $classes );

    // build html
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}

// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth, $args ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}
?>
<script>
$(document).ready(function() {
	//cleans up submenu css
	$(".sub-menu-item").each(function(index){
		$(this).css("border-right","none");
	});
});

    </script>

<?php
if(has_nav_menu("mainmenulinks") ) {
	?>
	<div id='cp'>
		<ul id='navbar' class='menu'>
			<li>
				<a href="/">
					<img height="24" width="20" src="<?php echo get_template_directory_uri();?>/images/home.png" alt="Orfalea College of Business" />
				</a>
			</li>
			<?php
			wp_nav_menu(array('theme_location' => 'mainmenulinks', 'container_id' => 'cp', "container" => 'false', "items_wrap" => '%3$s', 'walker' => new myWalker));
			 ?>
		 	<li id="searchli">
	            <div id="search">
	                <form id="gs" method = "get" title = "Search Form" action="https://search.calstate.edu/search">
	                    <div>
	                        <input type="hidden" name="site" value="slo-CalPoly" />
	                        <input type="hidden" name="output" value="xml_no_dtd" />
	                        <input type="hidden" name="client" value="slo-CalPoly" />
	                        <input type="hidden" name="proxystylesheet" value="slo-CalPoly" />
	                        <input type="hidden" name="sitesearch" value="/" />
	                        <input type="text" id="q" name="q" placeholder="search" title="Search this site" alt="Search Text" maxlength="256"/>
	                        <input type="image" id="searchSubmit" name="submit" src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/header/search-arrow.png" alt="Go" title="Submit Search Query" />
	                    </div>
	                </form>
	            </div>
	        </li>
        </ul>
    </div><?php
} else { ?>
	<div id = "cp">
	<ul id="cpUl" class="Mainmenu">
        <li>
        	<a href="/">
	        	<img height="24" width="20" src="<?php echo get_template_directory_uri(); ?>/images/home.png" alt="Orfalea College of Business" />
	        </a>
	    </li>
        <?php
		/**
			*		To add a custom menu, create an array: array('Title','/url/')
      *   Changed the 'About' Page to its new location
			*/
		$top_nav = array(
      array('About', '/about-the-orfalea-college-of-business'),
			array('Directory', '/directory'),
			array('Student Services', '/studentservices/'),
			array('Undergraduate Programs', '/undergrad/'),
// 			$cpto->academic_areas_blog_id,
// 			$cpto->undergraduate_blog_id,
			array('Graduate Programs', '/gradbusiness/'),
			array('Alumni', '/alumni/'), //Added by PFed
			 );
		foreach($top_nav as $nav_bid)
		{
			$style = '';
			if(is_int($nav_bid))
			{
				if(get_current_blog_id() == $nav_bid)
				{
					$style = ' style="font-weight:bold;" ';
				}
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
                <form id="gs" method = "get" title = "Search Form" action="https://search.calstate.edu/search">
                    <div>
                        <input type="hidden" name="site" value="slo-CalPoly" />
                        <input type="hidden" name="output" value="xml_no_dtd" />
                        <input type="hidden" name="client" value="slo-CalPoly" />
                        <input type="hidden" name="proxystylesheet" value="slo-CalPoly" />
                        <input type="hidden" name="sitesearch" value="/" />
                        <input type="text" id="q" name="q" placeholder="Search" title="Search this site" alt="Search Text" maxlength="256"/>
                        <input type="image" id="searchSubmit" name="submit" src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/header/search-arrow.png" alt="Go" title="Submit Search Query" />
                    </div>
                </form>
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
if($pgtemp[count($pgtemp)-1] != 'homepage.php' && get_post_type() != "faculty_profile"){
	wsf_breadcrumbs(' : ','');
} else if(get_post_type() == "faculty_profile") { ?>
	<div id="breadcrumb"> <a href="/" title="Orfalea College of Business" rel="nofollow" =""="">Home</a>&nbsp; : &nbsp;<a href="/directory" title="Directory" rel="nofollow" =""="">Directory</a></div>

<?php }?>

