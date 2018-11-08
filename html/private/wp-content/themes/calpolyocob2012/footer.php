<?php// File: footer.php ?>
<?php
global $cpto;

/*
 * First Widget Area (Navigation)
 if ( is_active_sidebar( 'first-footer-widget-area' ) ):
    dynamic_sidebar( 'first-footer-widget-area' );
else:     ?>
    <div class="widget">
        <h2>Navigation</h2>
        <?php
        switch_to_blog($cpto->root_blog_id);
        wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'padded-menu'));
        restore_current_blog();
        ?>
    </div> <?php
endif;

/*
 * Second Widget Area (Recent News)

if ( is_active_sidebar( 'second-footer-widget-area' ) ):
    dynamic_sidebar( 'second-footer-widget-area' );
else:     ?>
    <div class="widget">
        <h2>Recent News</h2>
        <ul style="overflow:hidden;"  id="fixedheight">
			<?php
            switch_to_blog($cpto->news_blog_id);
            global $page;
            $pages = get_posts(array( 'numberposts' => 3, 'category' => 3 ));
            foreach( $pages as $page ):  ?>
                <li><b>
                    <a href="<?php echo get_permalink( $page->ID ); ?>">
                        <?php echo $page->post_title; ?></a></b><br />
                   <?php  echo date("l, F jS, o",strtotime($page->post_date)); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><a class="linkArrow" href="<?php echo home_url(); ?>">More news</a></p>
        <?php restore_current_blog(); ?>
    </div>
<?php
endif;

/*
 * Third Widget Area (Academic Areas)
 
if ( is_active_sidebar( 'third-footer-widget-area' ) ):
    dynamic_sidebar( 'third-footer-widget-area' );
else:     ?>
    <div class="widget">
        <h2>Academic Areas</h2>
        <div class="menu-footer-nav-container">
        <ul id="menu-footer-nav" class="padded-menu">
           <li class="menu-item"><a href="https://www.cob.calpoly.edu/aareas/accounting-and-law/">Accounting &amp; Law</a></li>
           <li class="menu-item"><a href="https://www.cob.calpoly.edu/aareas/economics/">Economics</a></li>
           <li class="menu-item"><a href="https://www.cob.calpoly.edu/aareas/finance/">Finance</a></li>
           <li class="menu-item"><a href="https://www.cob.calpoly.edu/aareas/industrial-technology/">Industrial Technology</a></li>
           <li class="menu-item"><a href="https://www.cob.calpoly.edu/aareas/management/">Management</a></li>
           <li class="menu-item"><a href="https://www.cob.calpoly.edu/aareas/marketing/">Marketing</a></li>
           <li class="menu-item"><a href="https://www.cob.calpoly.edu/aareas/entrepreneurship/">Entrepreneurship</a></li>
        </ul>
        </div>
    </div> <?php
endif;


/*
 * Fourth Widget Area (Giving)
 
if ( is_active_sidebar( 'fourth-footer-widget-area' ) ):
    dynamic_sidebar( 'fourth-footer-widget-area' );
else:     ?>
	<div class="widget">
		<h2>Choosing Orfalea</h2>
        <a href="/choosing-orfalea"><img src="<?php bloginfo('template_directory'); ?>/images/sample-images/widget_img5.png" alt="widget sample image" width="176" height="180" /></a>
		<p><a class="linkArrow" href="/choosing-orfalea">Discover Cal Poly</a></p>
	</div>
<?php
endif;

/*
 * Fifth Widget Area (Giving)
 
if ( is_active_sidebar( 'fifth-footer-widget-area' ) ){
    dynamic_sidebar( 'fifth-footer-widget-area' );
}elseif(get_current_blog_id() == 49){
	?>

	<?php
}else{     ?>
    <div class="widget">
    <h2 class="quickFix">Apply</h2>
    <a href="https://admissions.calpoly.edu/">
       <img class="widgetHead" src="<?php bloginfo('template_directory'); ?>/images/sample-images/widget_img4.png" alt="sample image snippet" width="176" height="180" /></a>
<!--     <p>Start your online application process now! Enter your email to create an ApplyNow account.</p> -->
    <p><a class="linkArrow" href="https://admissions.calpoly.edu/">Be a part of Cal Poly</a></p>
    </div>
<?php
}*/
?>

    <div id="footer">
        <div id="footerSocial">
            <!--<a href="https://www.facebook.com/CalPolyOrfaleaCollege" target="_blank"><img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/facebook.png" alt="Facebook" width="32" height="32"/></a>
            <a href="https://www.linkedin.com/groups?mostPopular=&amp;gid=79983&amp;trk=myg_ugrp_ovr" target="_blank"><img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/linkedin.png" alt="Linked In" width="32" height="32"/></a>
            <a href="https://twitter.com/#!/OrfaleaCollege" target="_blank"><img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/twitter.png" alt="Twitter" width="32" height="32"/></a>
             <a href="https://instagram.com/orfaleacollegeofbusiness" target="_blank"><img src="https://cob.calpoly.edu/wp-content/themes/calpolyocob2012/images/socialicons/instagram2.png" alt="instagram" width="32" height="32"/></a>-->

            <?php
            //if($cpto->debug_show_bid_footer):
            //echo '<h1>BID:'.get_current_blog_id().'</h1>';
            //endif;
            ?>
</div>

        <ul id="footer_links">
            <li><a href="https://www.calpoly.edu/">CP Home</a></li>
            <li><a href="https://www.calpoly.edu/directory.html">Directory</a></li>
            <li><a href="https://maps.calpoly.edu/">Campus Maps &amp; Directions</a></li>
            <li><a href="https://www.elcorralbookstore.com/">Bookstore</a></li>
            <li><a href="https://registrar.calpoly.edu/acad_cal/">Calendar</a></li>
            <!--<li><a href="#">Sitemap</a></li>-->
            <li><a href="https://www.afd.calpoly.edu/hr/jobopportunities.asp">Employment</a></li>
            <li><a href="https://www.calpoly.edu/policy.html">Campus Policies</a></li>
            <li><a href="https://www.calpoly.edu/contactus.html">Contact Us</a></li>
            <li id="footerLogo"><a href="https://www.calpoly.edu/"><img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/footer_logo.png" height="24" width="138" alt="Cal Poly" title="Go to Cal Poly Home" /></a></li>
        </ul>

        <ul>
            <li><a href="https://get.adobe.com/reader/">Get Adobe Reader</a></li>
            <li><a href="https://www.microsoft.com/en-us/download/search.aspx?q=viewer">Microsoft Viewers</a></li>
        </ul>

        <div id="footer_deptinfo">
            <p>&#169; <?php echo(date("Y"))?> California Polytechnic State University &nbsp;<img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/footer_separator.jpg" alt="" height="10" width="1" />&nbsp; San Luis Obispo, California 93407<br />
            Phone: 805-756-1111</p>
        </div>
    </div>
   <!-- <script type="text/javascript" src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/jquery/calpoly.min.js"></script> -->
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/temp.js"></script>
   <!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/calpoly.ocobfix.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/css/print.min.css" rel="stylesheet" type="text/css" media="print" /> -->
        <div class="clear"></div>
    </div>
    <?php wp_footer(); ?>
    <script>
	    $(document).ready(function() {
			$('a[rel^="prettyPhoto"]').click(function(){
			//console.log("click")
			});
			//console.log("loaded click");
			$('a[rel^="prettyPhoto"]').click();
		});
	</script>
	<style>
	    .pageIsMenu{
		    background: #d2d0ca !important;
	    }
	    .parentIsMenu{
		    background: #dbd8d2 !important;
	    }
	    .parentIsMenu:hover{
		    background-color: #c5bdab !important;
	    }
	    .boldLink{
		    font-weight: bold;
	    }
    </style>
    <script>
	    //ends with function
	    if ( typeof String.prototype.endsWith != 'function' ) {
		  String.prototype.endsWith = function( str ) {
		    return this.substring( this.length - str.length, this.length ) === str;
		  }
		};

		function rightLink(href){
			var splits = window.location.href.split("/");
			var location = "";
			if(splits[splits.length-1].length == 0){
				location = splits[splits.length-2];
			}else{
				location = splits[splits.length-1];
			}
			//debug check fixes undefined error
			//console.log(typeof href);
			if(typeof href != 'undefined') {
				var obj = href.endsWith(location) || href.endsWith(location.concat("/"));
				return obj;
			}
			
		}

		function highlight(obj){
			var parent = obj.parent();
		    //if its on the top
		    if(parent.hasClass("sub-menu-item")){
			    parent.addClass("parentIsMenu");
			//if its not a main menu its on the side so change the link
		    }else if(parent.parent().attr("id") != "menu-footer-nav" && parent.attr('id') != "breadcrumb" && !parent.hasClass("noMenu") && !parent.hasClass("main-menu-item")  && window.location.href != "https://www.cob.calpoly.edu/" && !parent.is("h1") && !parent.is("h2")){
			 	obj.addClass("pageIsMenu");
		    }else if(parent.hasClass("noMenu")){
			    obj.addClass("boldLink");
		    }else if(parent.parent().attr("id") == "menu-footer-nav"){
			    parent.addClass("pageIsMenu");
		    }
		}
	    $(document).ready(function(){
		    $("a[href='"+window.location.href+"']").each(function(index,value){
			    highlight($(this));
		    });
		    $("a").each(function(index,value){
			   if(rightLink($(this).attr("href"))){
				   highlight($(this));
			   }
		    });
	    });
    </script>
    <div class="clear"></div>
</body>
</html>