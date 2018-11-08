	<div id="footer">
		Copyright &copy; 2008 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> &middot; Subscribe 
		<?php 
		global $options;
				foreach ($options as $value) {
				if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
				}
		if ($bnw_rss_feed) {
			?>
			<a href="<?php echo $bnw_rss_feed; ?>">
				<?php if ($bnw_rss_title) {
							echo $bnw_rss_title;
						} else {
							echo "RSS Feed";
						} ?></a>
			<?php } else { ?>
			<a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a>
			<?php
			} ?> now<br />
		Powered by <a href="http://wordpress.org/" target="_blank">WordPress</a> &middot; <a href="http://zacklive.com/new-black-and-white-wordpress-theme/300/" target="_blank">Black n White</a> Theme by <a href="http://zacklive.com/" target="_blank">Zack</a>
	</div>
<div class="cle"></div>
</div>
<?php wp_footer(); ?>
</body>

</html>