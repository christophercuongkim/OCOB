<?php
global $cpto;
?>

      	<div class="widget">
            <h2>Navigation</h2>
            
            <?php 
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
											
							/*wp_nav_menu(array('menu'  => 'Footer', 
											'container_class' => , 'footnav'));		*/	
											
							switch_to_blog($cpto->root_blog_id);
							wp_nav_menu(array('theme_location' => 'footer'));	
							restore_current_blog();
							//wp_nav_menu();	
//						wp_nav_menu();  // USE FOR SIDEBAR!
						
						?>
								<?php /*
                  switch_to_blog($cpto->events_blog_id);
                  global $page;
									$pages = get_posts(array( 'numberposts' => 3, 'category' => 4 ));
									foreach( $pages as $page ):
                ?>
                <li><a href="#"><?php echo get_the_post_thumbnail( $page->ID, array(50, 50)); ?></a>
                	<h3><a href="<?php echo get_permalink( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h3>
                  <?php $post_custom= get_post_custom($page->ID); ?>
                    <p><?php echo $post_custom['event_date'][0]; ?> </p>
                </li>
								<?php
									endforeach;		
								?>
          	</ul>
             <!-- <p><a class="linkArrow" href="<?php echo home_url(); ?>">
            	More events &amp; ticketing
              </a></p> -->
          <?php
			restore_current_blog();*/
			?>
        </div>
        
        <div class="widget">
          <h2>Recent News</h2>
          <ul style="overflow:hidden;"  id="fixedheight">
          	<?php 
			switch_to_blog($cpto->news_blog_id);
			global $page;
			//$args = array( 'numberposts' => 1, 'offset'=> 0, 'category' => 1 );
			//$myposts = get_posts( $args );
			$pages = get_posts(array( 'numberposts' => 3, 'category' => 3 ));
			foreach( $pages as $page ):  ?>
					<li><b><a href="<?php echo get_permalink( $page->ID ); ?>"><?php echo $page->post_title; ?></a></b><br />
						<?php echo date("l, F jS, o",strtotime($page->post_date)); ?> 
					</li>
					<?php
			endforeach;		
			?>
          </ul>
          <p><a class="linkArrow" href="<?php echo home_url(); ?>">
          More news
          </a></p>
          <?php
			restore_current_blog();
			?>
      	</div>
        
      
      	<div class="widget">
            <h2>Academic Areas</h2>
            <div class="menu-footer-nav-container">
            <ul id="menu-footer-nav" class="menu">
               <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/accounting-and-law/">Accounting &amp; Law</a></li>
               <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/economics/">Economics</a></li>
               <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/finance/">Finance</a></li>
               <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/industrial-technology/">Industrial Technology</a></li>
               <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/management/">Management</a></li>
               <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/marketing/">Marketing</a></li>
               <li class="menu-item"><a href="http://www.cob.calpoly.edu/aareas/entrepreneurship/">Entrepreneurship</a></li>

            </ul>
            </div>
        </div>
        
      
      	<div class="widget">
          <h2>Giving</h2>
          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/sample-images/widget_img2.jpg" alt="widget sample image" width="176" height="180" /></a>
          <p><a class="linkArrow" href="#">
          More on giving
          </a></p>
      	</div>
      	<div class="widget">
          <h2>Apply</h2>
          <img class="widgetHead" src="<?php bloginfo('template_directory'); ?>/images/sample-images/widget_img3.jpg" alt="sample image snippet" width="176" height="60" />
          <p>Start your online application process now! Enter your email to create an ApplyNow account.</p>
          <p><a class="linkArrow" href="#">Go to apply</a></p>
      	</div>



    
	<div id="footer">
        <div id="footerSocial">
            <a href="https://www.facebook.com/CalPolyOrfaleaCollege"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/facebook.png" alt="Facebook" width="32" height="32"/></a>
            <a href="http://www.linkedin.com/groups?mostPopular=&amp;gid=79983&amp;trk=myg_ugrp_ovr"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/linkedin.png" alt="Linked In" width="32" height="32"/></a>
            <a href="https://twitter.com/#!/OrfaleaCollege"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/twitter.png" alt="Twitter" width="32" height="32"/></a>
            <a href="http://www.flickr.com/photos/30208331@N03/sets/"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/flickr.png" alt="Flickr" width="32" height="32"/></a>
            <a href="http://www.youtube.com/CalPolyOCOB"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/youtube_icon.png" alt="YouTube" width="32" height="32"/></a>
            <a href="http://www.calpolylink.com/"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/polylink_icon.png" alt="Polylink" width="32" height="32"/></a>

            <?php 
			//if($cpto->debug_show_bid_footer):
			echo '<h1>BID:'.get_current_blog_id().'</h1>'; 
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
    <script type="text/javascript" src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/jquery/calpoly.min.js"></script>
   <!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/calpoly.ocobfix.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/css/print.min.css" rel="stylesheet" type="text/css" media="print" /> -->
        <div class="clear"></div>
	</div>
    <?php wp_footer(); ?>
</body>
</html>