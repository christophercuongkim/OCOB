
<h1>Footer Text! </h1>
<?php
global $cpto;

/*
 * First Widget Area (Navigation)
 */
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
 */
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
 */
if ( is_active_sidebar( 'third-footer-widget-area' ) ):
    dynamic_sidebar( 'third-footer-widget-area' );
else:     ?>
    <div class="widget">
        <h2>Academic Areas</h2>
        <div class="menu-footer-nav-container">
        <ul id="menu-footer-nav" class="padded-menu">
           <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/accounting-and-law/">Accounting &amp; Law</a></li>
           <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/economics/">Economics</a></li>
           <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/finance/">Finance</a></li>
           <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/industrial-technology/">Industrial Technology</a></li>
           <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/management/">Management</a></li>
           <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/marketing/">Marketing</a></li>
           <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/entrepreneurship/">Entrepreneurship</a></li>
        </ul>
        </div>
    </div> <?php
endif;


/*
 * Fourth Widget Area (Giving)
 */
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
 */
if ( is_active_sidebar( 'fifth-footer-widget-area' ) ):
    dynamic_sidebar( 'fifth-footer-widget-area' );
else:     ?>
    <div class="widget">
    <h2>Apply Now</h2>
    <a href="http://admissions.calpoly.edu/"><img class="widgetHead" src="<?php bloginfo('template_directory'); ?>/images/sample-images/widget_img4.png" alt="sample image snippet" width="176" height="180" /></a>

    <p><a class="linkArrow" href="http://admissions.calpoly.edu/">Be a part of Cal Poly</a></p>
    </div>
<?php
endif;
?>   

    <div id="footer">
        <div id="footerSocial">
            <a href="https://www.facebook.com/CalPolyOrfaleaCollege"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/facebook.png" alt="Facebook" width="32" height="32"/></a>
            <a href="http://www.linkedin.com/groups?mostPopular=&amp;gid=79983&amp;trk=myg_ugrp_ovr"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/linkedin.png" alt="Linked In" width="32" height="32"/></a>
            <a href="https://twitter.com/#!/OrfaleaCollege"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/twitter.png" alt="Twitter" width="32" height="32"/></a>

            <?php 
            //if($cpto->debug_show_bid_footer):
            //echo '<h1>BID:'.get_current_blog_id().'</h1>'; 
            //endif;
            ?>
</div>

        <ul id="footer_links">
            <li><a href="http://www.calpoly.edu/">CP Home</a></li> 
            <li><a href="http://www.calpoly.edu/directory.html">Directory</a></li> 
            <li><a href="http://maps.calpoly.edu/">Campus Maps &amp; Directions</a></li> 
            <li><a href="http://www.elcorralbookstore.com/">Bookstore</a></li> 
            <li><a href="http://registrar.calpoly.edu/acad_cal/">Calendar</a></li> 
            <!--<li><a href="#">Sitemap</a></li>--> 
            <li><a href="http://www.afd.calpoly.edu/hr/jobopportunities.asp">Employment</a></li> 
            <li><a href="http://www.calpoly.edu/policy.html">Campus Policies</a></li> 
            <li><a href="http://www.calpoly.edu/contactus.html">Contact Us</a></li>
            <li id="footerLogo"><a href="http://www.calpoly.edu/"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/footer_logo.png" height="24" width="138" alt="Cal Poly" title="Go to Cal Poly Home" /></a></li>    
        </ul>
            
        <ul>
            <li><a href="http://get.adobe.com/reader/">Get Adobe Reader</a></li>
            <li><a href="http://office.microsoft.com/en-us/downloads/">Microsoft Viewers</a></li> 
        </ul>
        
        <div id="footer_deptinfo">
            <p>&#169; 2012 California Polytechnic State University &nbsp;<img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/footer_separator.jpg" alt="" height="10" width="1" />&nbsp; San Luis Obispo, California 93407<br />
            Phone: 805-756-1111</p>
        </div>  
    </div>
   <!-- <script type="text/javascript" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/jquery/calpoly.min.js"></script> -->
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/temp.js"></script>
   <!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/calpoly.ocobfix.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/css/print.min.css" rel="stylesheet" type="text/css" media="print" /> -->
        <div class="clear"></div>
    </div>
    <?php wp_footer(); ?>
    <div class="clear"></div>
</body>
</html>