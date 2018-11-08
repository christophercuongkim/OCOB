	<?php
		$title = get_the_title();
		$link = get_the_permalink();
	?>
	<div class="social-links">
		<div class="top"></div>
		<ul>
			<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($link); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/sub-social-fb@2x.png" height="29" width="29" alt="Facebook"></a></li>
			<li><a href="https://twitter.com/home?status=<?php echo urlencode($title); ?>+<?php echo urlencode($link); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/sub-social-tw@2x.png" height="29" width="29" alt="Twitter"></a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo urlencode($link); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/sub-social-gp@2x.png" height="29" width="29" alt="Google+"></a></li>
			<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($link); ?>&title=<?php echo urlencode($link); ?>&summary=&source="><img src="<?php bloginfo('template_directory'); ?>/img/sub-social-li@2x.png" height="29" width="29" alt="LinkedIn"></a></li>
		</ul>
	</div>