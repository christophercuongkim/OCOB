<footer id="page-footer" class="clearfix">
	<div class="binding clearfix">

		<div class="footer-boxes">
			<?php dynamic_sidebar('footer-boxes'); ?>
			<div class="bottom-bar"><h3>Sponsored by:</h3><br />
			  <div class="box">
			  	<img src="<?php bloginfo('template_directory'); ?>/img/slocity.png" srcset="<?php bloginfo('template_directory'); ?>/img/slocity.png 1x, <?php bloginfo('template_directory'); ?>/img/slocity@2x.png 2x, <?php bloginfo('template_directory'); ?>/img/slocity@3x.png 3x">
			  </div>
			  <div class="box">
				<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2017/09/CoSLO-Official-Seal-CMYK-web.png" width="191px">
			  </div>
			</div>
			<div class="bottom-bar">

				<div class="box">
					<a href="http://www.calpoly.edu" alt="Cal Poly Home"><img src="<?php bloginfo('template_directory'); ?>/img/footer-logo@2x.png" srcset="<?php bloginfo('template_directory'); ?>/img/footer-logo.png 1x, <?php bloginfo('template_directory'); ?>/img/footer-logo@2x.png 2x" height="28" width="163" alt="Cal Poly" class="logo"><br/>Cal Poly Home</a> | <a href="http://www.calpoly.edu/cpfindit.html">Cal Poly Find It</a>
				</div>
				<div class="box">
					<strong>Cal&nbsp;Poly Center for Innovation&nbsp;&amp; Entrepreneurship</strong><br />
					<br />
					872 Higuera St<br />
					San Luis Obispo, CA 93401<br />
					<br />
					Tel: (805) 756-5171<br />
					Fax: (805) 756-5173<br />
					<a href="mailto:info-cie@calpoly.edu">info-cie@calpoly.edu</a>
				</div>

				<ul class="social">
					<li><a href="https://www.facebook.com/Cal-Poly-Center-for-Innovation-Entrepreneurship-209958182365806/"><img src="<?php bloginfo('template_directory'); ?>/img/social-fb.gif" srcset="<?php bloginfo('template_directory'); ?>/img/social-fb.gif 1x, <?php bloginfo('template_directory'); ?>/img/social-fb@2x.gif 2x" height="34" width="35" alt="Facebook"></a></li>
					<li><a href="https://twitter.com/CalPolyCIE"><img src="<?php bloginfo('template_directory'); ?>/img/social-tw.gif" srcset="<?php bloginfo('template_directory'); ?>/img/social-tw.gif 1x, <?php bloginfo('template_directory'); ?>/img/social-tw@2x.gif 2x" height="34" width="35" alt="Twitter"></a></li>
					<li><a href="https://www.linkedin.com/company/cal-poly-center-for-innovation-&-entrepreneurship"><img src="<?php bloginfo('template_directory'); ?>/img/social-in.gif" srcset="<?php bloginfo('template_directory'); ?>/img/social-li.gif 1x, <?php bloginfo('template_directory'); ?>/img/social-in@2x.gif 2x" height="34" width="35" alt="LinkedIn"></a></li>
					<li><a href="https://instagram.com/ciecalpoly"><img src="<?php bloginfo('template_directory'); ?>/img/social-ig.gif" srcset="<?php bloginfo('template_directory'); ?>/img/social-ig.gif 1x, <?php bloginfo('template_directory'); ?>/img/social-ig@2x.gif 2x" height="34" width="35" alt="Instagram"></a></li>
					<li><a href="https://www.youtube.com/channel/UCkEF4gndVMNnFHhHKQZFWvQ"><img src="<?php bloginfo('template_directory'); ?>/img/social-yt.gif" srcset="<?php bloginfo('template_directory'); ?>/img/social-yt.gif 1x, <?php bloginfo('template_directory'); ?>/img/social-yt@2x.gif 2x" height="34" width="35" alt="YouTube"></a></li>
					<li><a href="https://www.snapchat.com/add/calpolycie"><img src="<?php bloginfo('template_directory'); ?>/img/social-sc.gif" srcset="<?php bloginfo('template_directory'); ?>/img/social-sc.gif 1x, <?php bloginfo('template_directory'); ?>/img/social-sc@2x.gif 2x" height="34" width="35" alt="Snapchat"></a></li>
				</ul>

			</div>

		</div>

	</div>
</footer>

<nav id="mobile-menu">
	<div class="close">
		MENU
	</div>

	<div class="inner">
		<ul class="home-menu">
			<li><a href="<?php bloginfo('url'); ?>#learn">Learn</a></li>
			<li><a href="<?php bloginfo('url'); ?>#prepare">Prepare</a></li>
			<li><a href="<?php bloginfo('url'); ?>#launch">Launch</a></li>
			<li><a href="<?php bloginfo('url'); ?>#mentors">Mentors</a></li>
		</ul>
		<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search', 'label' ) ?>" />
		</form>
		<ul class="site-menu">
			<li><a href="<?php bloginfo('url'); ?>/slo-hothouse">SLO HotHouse</a></li>
			<li><a href="<?php bloginfo('url'); ?>/coworking">Coworking</a></li>
			<li><a href="<?php bloginfo('url'); ?>/news">News</a></li>
			<li><a href="<?php bloginfo('url'); ?>/events">Events</a></li>
			<li><a href="<?php bloginfo('url'); ?>/blog">Blog</a></li>
			<li><a href="<?php bloginfo('url'); ?>/about-cie">About CIE</a></li>
		</ul>
	</div>

</nav>
<?php wp_footer();wp_reset_query(); ?>
</body>
</html>
