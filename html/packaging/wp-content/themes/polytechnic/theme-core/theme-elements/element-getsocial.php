<ul class="social">

<?php 
	$social_icons_set = "circles"; 
	if (ot_get_option('social_icons_set')) : $social_icons_set = ot_get_option('social_icons_set'); endif; 
	?>

	<?php if (ot_get_option('social_google')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_google') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/google+.png" alt="google" title="Google+" /></a></li><?php endif; ?>
	<?php if (ot_get_option('social_twitter')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_twitter') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/twitter.png" alt="twitter" title="Twitter"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_facebook')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_facebook') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/fb.png" alt="facebook" title="Facebook" /></a></li><?php endif; ?>					
	<?php if (ot_get_option('social_youtube')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_youtube') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/youtube.png" alt="youtube" title="You Tube" /></a></li><?php endif; ?>
	<?php if (ot_get_option('social_vimeo')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_vimeo') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/vimeo.png" alt="vimeo" title="Vimeo" /></a></li><?php endif; ?>
	<?php if (ot_get_option('social_linkedin')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_linkedin') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/linkedin.png" alt="linkedin" title="LinkedIn" /></a></li><?php endif; ?>
	<?php if (ot_get_option('social_pinterest')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_pinterest') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/pinterest.png" alt="pinterest" title="Pinterest"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_skype')) : ?><li><a target="_blank" href="<?php echo esc_attr( ot_get_option('social_skype') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/skype.png" alt="skype" title="Skype"/></a></li><?php endif; ?>

	<?php if (ot_get_option('social_email')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_email') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/email.png" alt="email" title="Email"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_dribbble')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_skype') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/dribbble.png" alt="dribbble" title="Dribbble"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_evernote')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_evernote') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/evernote.png" alt="evernote" title="Evernote"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_flickr')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_flickr') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/flickr.png" alt="flickr" title="Flickr"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_foursquare')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_foursquare') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/foursquare.png" alt="foursquare" title="FourSquare"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_instagram')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_instagram') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/instagram.png" alt="instagram" title="Instagram"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_yelp')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_yelp') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/yelp.png" alt="yelp" title="Yelp"/></a></li><?php endif; ?>
	<?php if (ot_get_option('social_yahoo')) : ?><li><a target="_blank" href="<?php echo esc_url( ot_get_option('social_yahoo') ); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/yahoo.png" alt="yahoo" title="Yahoo"/></a></li><?php endif; ?>

		<?php
		if ( function_exists( 'ot_get_option' ) ) {
		if (ot_get_option('social_custom')) :
		  $slides = ot_get_option( 'social_custom' );
		  foreach( $slides as $slide ) {
		  	
		  	$slidelink = $slide['link'];
		  	$slideimage = $slide['image'];
		  	$slidetitle = $slide['title'];
		  	$lightboxlink = $lightbox_link;

			?>
			<li>
				<a target="_blank" href="<?php echo esc_url( $slidelink ); ?>" <?php echo esc_attr( $lightboxlink ); ?> >
					<img height="25" width="25" src="<?php echo esc_url( $slideimage ); ?>" title= "<?php echo esc_attr( $slidetitle ); ?>" alt="<?php echo esc_attr( $slidetitle ); ?>" />
				</a>
			</li>												
			<?php } 
		  
		endif;
		}
		?>
	
		<?php if (ot_get_option('social_rss') == 'on' ) : ?>
		<li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><img height="25" width="25" src="<?php echo esc_url( WP_THEME_URL ); ?>/mythology-core/core-assets/images/social-icons/<?php echo esc_attr( $social_icons_set ); ?>/rss.png" alt="RSS" title="RSS" /></a></li>
		<?php endif; ?>
</ul>