<?php// File: footer.php ?>
<?php global $cpto; ?>

<!-- FOOTER WIDGET CODE WOULD GO HERE IF THEY WANTED THEM (could copy from other theme -->

    <div id="footer">
        <div id="footerSocial">
            <a href="/" target="_blank"><img src="/wp-content/themes/CalPolyOCOB - CPPRC/images/socialicons/facebook.png" alt="Facebook" width="32" height="32"/></a>
            <a href="/" target="_blank"><img src="/wp-content/themes/CalPolyOCOB - CPPRC/images/socialicons/linkedin.png" alt="Linked In" width="32" height="32"/></a>
            <a href="/" target="_blank"><img src="/wp-content/themes/CalPolyOCOB - CPPRC/images/socialicons/twitter.png" alt="Twitter" width="32" height="32"/></a>
             <a href="/" target="_blank"><img src="/wp-content/themes/CalPolyOCOB - CPPRC/images/socialicons/instagram.png" alt="instagram" width="32" height="32"/></a>

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
