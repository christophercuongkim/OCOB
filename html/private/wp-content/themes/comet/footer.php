		</div><!-- /c2 -->

		<div id="c1">

			<?php get_sidebar('left'); ?>

		</div><!-- /c3 -->

	</div><!-- /content -->

	<div id="footer">

		<a href="http://frostpress.com/themes/comet/" target="_blank" id="frostpress" title="Theme from Frostpress"></a>
		<a href="http://www.wordpress.org/" target="_blank" id="wordpress" title="Powered by WordPress"></a>

		<?php
		$fp_options = get_option('fp_options');
		
		echo $fp_options['fp_footer'];
		?>
		
	</div><!-- /footer -->

</div><!-- /wrap -->

<?php wp_footer(); ?>

</body>
</html>