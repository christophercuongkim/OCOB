<!-- Top Hat -->
<?php if (get_option_tree('top_hat') != 'off') : ?>
<div id="section-tophat" class="clearfix full-width">

	<!-- 960 Container -->
	<div class="container">			
		
		<div class="sixteen columns">
					
			<div class="left">

				<!-- DROPDOWN TOGGLE BUTTON -->
				<?php if (ot_get_option('top_hat_dropdown') == "on" ) : ?>
		    	<div class="th_banner" >
		        	<div class="th_show_hide th_flag_toggle" >

	        			<div class="th_trigger arrow">
	        				<i aria-hidden="true" data-icon="&#xe62b;"></i>    				
	        			</div>

		        		<?php if(ot_get_option('top_hat_blurb')) : ?>
		        			<div class="th_trigger blurb">
		        				<?php // echo esc_html( ot_get_option('top_hat_blurb') ); ?>
		        				<?php 
								$ot_thb = ot_get_option('top_hat_blurb');
								$esc_ot_thb = htmlspecialchars($ot_thb, ENT_QUOTES);
								print htmlspecialchars_decode($esc_ot_thb);
								?>
		        			</div> &nbsp;
		        		<?php endif; ?>

		            </div>
		        </div>
		        <?php endif; ?>    
		        <!-- /End DROPDOWN TOGGLE BUTTON -->

			</div>							
			
			<div class="right">
				<!-- Menu -->
		  		<div class="tophat_navigation">
					<div class="container">

						<nav>
							<?php get_template_part( 'theme-core/theme-elements/element', 'secondary-navigation' ); ?>
						</nav>

                        <?php if (ot_get_option('top_hat_login') == "on" ) : ?>
                            <?php
    						if ( class_exists( 'WooCommerce' ) ) { ?>

    							<span class="account">
    							<?php global $woocommerce;
    								if ( is_user_logged_in() ) : 
    								?>
    									<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php _e('My Account','mythology'); ?> </a>
    								<?php else : ?>
    									<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('Login / Register','mythology'); ?>"><?php _e('Login / Register','mythology'); ?></a>
    								<?php endif; ?>
    									<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>"><?php _e('Cart','mythology'); ?> </a>
    							</span>

    						<?php } else {
    						  // you don't appear to have WooCommerce activated
    						}
    						?>
                        <?php endif; ?>

                        <?php if (ot_get_option('top_hat_right_blurb') ) : ?>

                            <div class="right-blurb">
                                <div class="blurb"><?php printf( ot_get_option('top_hat_right_blurb') ); ?></div>
                            </div>
                            
                        <?php endif; ?>

					</div>
				</div>

				<?php if(ot_get_option('top_hat_social') == "on" ) :
							get_template_part( 'theme-core/theme-elements/element', 'getsocial' );
						endif; ?>

                <?php if (ot_get_option('top_hat_search') == "on" ) : ?>

                    <div class="search">
                        <?php if(class_exists('AJAXY_SF_WIDGET')) :
                            get_search_form();
                        else : ?>           
                            <?php get_template_part( 'theme-core/theme-elements/element', 'searchform' ); 
                            // get_search_form(); 
                            ?>
                        <?php endif; ?>
                    </div>
                    
                <?php endif; ?>

			</div>	
			
		</div>
		
	</div>

<div class="stripe_color"></div>
</div>
<?php endif; ?>