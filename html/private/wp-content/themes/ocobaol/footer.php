		</div><!-- /c2 -->
		
		<div style="clear:both; width: 100%; height: 20px;"></div>
		<!--<div id="c3">-->

			<?php //get_sidebar('right'); ?>

		<!--</div>--><!-- /c3 -->

	</div><!-- /content -->

	<div id="footer">

		
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