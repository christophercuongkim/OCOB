<?php// File: footer.php ?>
<?php global $cpto; ?>

<!--START FOOTER WIDGET CODE -->

<!-- First Widget Area (Recent News) -->
<?php if ( is_active_sidebar( 'first-footer-widget-area' )): ?>
    <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
<?php else: ?>
    <div class="widget">
        <h2>Recent News</h2>
        <ul style="overflow:hidden;"  id="fixedheight">
            <?php
            switch_to_blog($cpto->news_blog_id);
            global $page;
            $pages = get_posts(array( 'numberposts' => 3, 'category' => 15 ));
            foreach( $pages as $page ):  ?>
                <li>
                    <a href="<?php echo get_permalink( $page->ID ); ?>">
                        <?php echo $page->post_title; ?></a><br />
                   <?php  echo date("l, F jS, o",strtotime($page->post_date)); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><a class="linkArrow" href="<?php echo home_url(); ?>">More news</a></p>
        <?php restore_current_blog(); ?>
    </div>
<?php endif; ?>

<!-- Second Widget Area (Image) -->
<?php if ( is_active_sidebar( 'second-footer-widget-area' )):?>
    <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
<?php else: ?>
    <div class="widget">
        <?php include "/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area2.php" ?>
    </div>
<?php endif; ?>

<!-- Third Widget Area (Navigation) -->
<?php if ( is_active_sidebar( 'third-footer-widget-area' )): ?>
    <?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
<?php else: ?>
    <div class="widget">
        <?php include "/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area3.php" ?>
    </div> 
<?php endif; ?>


<!-- Fourth Widget Area (Choosing Orfalea) -->
<?php if ( is_active_sidebar( 'fourth-footer-widget-area' )):?>
    <?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
<?php else: ?>
    <div class="widget">
        <?php include "/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area4.php" ?>
    </div>
<?php endif; ?>

<!-- Fifth Widget Area (Giving) -->
<?php if ( is_active_sidebar( 'fifth-footer-widget-area' )): ?>
    <?php dynamic_sidebar( 'fifth-footer-widget-area' );?>
<?php else: ?>
    <div class="widget">
        <?php include "/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area5.php" ?>
    </div>
<?php endif ?>

<!-- END FOOTER WIDGET AREA -->

    <div id="footer">
        <div id="footerSocial">
            <a href="https://www.facebook.com/CalPolyOrfaleaCollege" target="_blank"><img src="/wp-content/themes/CalPolyOCOB-PolyPack/images/socialicons/facebook.png" alt="Facebook" width="32" height="32"/></a>
            <a href="http://www.linkedin.com/groups?mostPopular=&amp;gid=79983&amp;trk=myg_ugrp_ovr" target="_blank"><img src="/wp-content/themes/CalPolyOCOB-PolyPack/images/socialicons/linkedin.png" alt="Linked In" width="32" height="32"/></a>
            <a href="https://twitter.com/#!/OrfaleaCollege" target="_blank"><img src="/wp-content/themes/CalPolyOCOB-PolyPack/images/socialicons/twitter.png" alt="Twitter" width="32" height="32"/></a>
             <a href="http://instagram.com/orfaleacollegeofbusiness" target="_blank"><img src="/wp-content/themes/CalPolyOCOB-PolyPack/images/socialicons/instagram.png" alt="instagram" width="32" height="32"/></a>

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
            <li id="footerLogo"><a href="http://www.calpoly.edu/"><img src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/footer_logo.png" height="24" width="138" alt="Cal Poly" title="Go to Cal Poly Home" /></a></li>
        </ul>

        <ul>
            <li><a href="https://accessibility.calpoly.edu/website-accessibility-statement">Web Accessibility Statement</a></li>
            <li><a href="http://www.microsoft.com/en-us/download/search.aspx?q=viewer">Microsoft Viewers</a></li>
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
            }else if(parent.parent().attr("id") != "menu-footer-nav" && parent.attr('id') != "breadcrumb" && !parent.hasClass("noMenu") && !parent.hasClass("main-menu-item")  && window.location.href != "/" && !parent.is("h1") && !parent.is("h2")){
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
