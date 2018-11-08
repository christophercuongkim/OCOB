<?php 

	/* THEME LOGIN */

	/* LOAD STYLES */
	function my_login_stylesheet() {
	    if (ot_get_option('custom_login') == "on" ) :

	    	/* ENQUEUE STYLESHEET */
	    	wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/theme-core/theme-functions/login/login-styles.css' );

	    	/* ENQUEUE JS */
	    	wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/theme-core/theme-functions/login/login-styles.js' );
			
			/* LAYOUT/POSITION OF LOGIN FORM */
			if(ot_get_option('custom_login_align') == "left" ) : ?>
				
				<style type="text/css">
					body.login div#login {
					  margin: auto;
					  padding: 8% 0 0;
					  position: absolute;
					  left: 15%;
					  width: 320px;
					}
				</style>

			<?php elseif(ot_get_option('custom_login_align') == "right" ) : ?>

				<style type="text/css">
					body.login div#login {
					  margin: auto;
					  padding: 8% 0 0;
					  position: absolute;
					  right: 15%;
					  width: 320px;
					}
				</style>

			<?php elseif(ot_get_option('custom_login_align') == "center" ) : ?>

			<?php endif;

			/* LAYOUT/POSITION OF FOOTER TEXT */
			if(ot_get_option('login_footer_blurb_align') == "left" ) : ?>
				
				<style type="text/css">
					body.login div#login #section-login-footer {
					  bottom: 10%;
					  clear: both;
					  display: block;
					  float: left;
					  left: 10%;
					  position: fixed;
					}
				</style>

			<?php elseif(ot_get_option('login_footer_blurb_align') == "right" ) : ?>
				
				<style type="text/css">
					body.login div#login #section-login-footer {
					  bottom: 10%;
					  clear: both;
					  display: block;
					  float: right;
					  right: 10%;
					  position: fixed;
					}
				</style>

			<?php endif;
		endif;
	}
	add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

	/* LOAD LOGO LINK */
	function my_login_logo_url() {
		if (ot_get_option('custom_login') == "on" ) :
	    	return home_url();
	    endif;
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	/*function my_login_logo_url_title() {
	    return 'Your Site Name and Info';
	}
	add_filter( 'login_headertitle', 'my_login_logo_url_title' );
	*/

	

	/* LOAD FOOTER WIDGET */
	function custom_login_message() {
		if (ot_get_option('custom_login') == "on" ) :

			if(ot_get_option('login_footer_blurb')) : 
							
				$footerblurb = ot_get_option('login_footer_blurb');
				$message = "<div id='section-login-footer'>{$footerblurb}</div>";

				return $message;

			endif;

			
		endif;
		
		}
	add_filter('login_message', 'custom_login_message');

	/* LOAD LOGO AND BG IMAGE */
	function my_login_logo() {
	    if (ot_get_option('custom_login') == "on" ) :
		    if (ot_get_option('login_logo')) : ?>
		    	<style type="text/css">
			        body.login div#login h1 a {
			            background-image: url(<?php echo esc_attr( ot_get_option('login_logo') ); ?>);
			            padding-bottom: 30px;
			        }
			    </style>
			<?php endif;

			/* Add in Size and Repeat Options */

			if (ot_get_option('login_background_color')) : ?>
		    	<style type="text/css">
			        body.login {
					background-color: <?php echo esc_attr( ot_get_option('login_background_color') ); ?>;
					}
			    </style>
			<?php endif;
			if (ot_get_option('login_bgimage')) : ?>
		    	<style type="text/css">
			        body.login {
					background-image: url(<?php echo esc_attr( ot_get_option('login_bgimage') ); ?>);
					}
			    </style>
			<?php endif;
		endif;}
	add_action( 'login_enqueue_scripts', 'my_login_logo' );	

?>