<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mythology
 */
?>
			</div>
		</div>
	</div><!-- #content -->

	<!-- Check If Footer Is On -->
	<?php if ( ot_get_option('show_footer') != "off" ) :

		// Set the columns class for each module.
		if(ot_get_option('footer_columns_count') != '') : 
		$myth_header_columns = ot_get_option('footer_columns_count');
		else : 
		$myth_header_columns = "one-third column";
		endif;
	?> 

		<!-- Start Footer Section -->
		<div id="section-footer" class="clearfix">
			<div class="container">

				<!-- Start Pre-Footer -->
				<div id="pre-footer-image" class="sixteen columns">
					<?php if(ot_get_option('pre-footer-image')) : $prefooterimage = ot_get_option('pre-footer-image'); ?>						
						<img class="" src="<?php echo esc_url( $prefooterimage ); ?>" alt="" />
	    			<?php endif; ?>		        		
				</div>

				<div id="pre-footer-blurb" class="sixteen columns">
					<?php if(ot_get_option('pre-footer-blurb')) : $prefooterblurb = ot_get_option('pre-footer-blurb'); ?>	

						<div class="vc_separator vc_separator_align_center vc_sep_double">
							<span class="vc_sep_holder vc_sep_holder_l">
								<span class="vc_sep_line"></span>
							</span>
							<h2>
								<?php // echo esc_html( $prefooterblurb ); ?>
								<?php 
								$ot_pfb = ot_get_option('prefooterblurb');
								$esc_ot_pfb = htmlspecialchars($ot_pfb, ENT_QUOTES);
								print htmlspecialchars_decode($esc_ot_pfb);
								?>
							</h2>
							<span class="vc_sep_holder vc_sep_holder_r">
								<span class="vc_sep_line"></span>
							</span>
						</div>

	    			<?php endif; ?>		        		
				</div>
				<!-- /End Pre-Footer -->

				<!-- Start Footer Widgets -->
				<div class="sixteen columns">
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-1') ) ?>
					</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-2') ) ?>
					</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-3') ) ?>
					</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-4') ) ?>
					</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-5') ) ?>
					</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-widget-6') ) ?>
					</div>
				</div>
				<!-- /End Footer Widgets -->

				<!-- Start Post-Footer Image -->
				<div id="footer-image" class="sixteen columns">
					<?php if(ot_get_option('post-footer-widget')) : $footerimage = ot_get_option('post-footer-widget'); ?>						
						<img class="" src="<?php echo esc_url( $footerimage ); ?>" alt="" />
	    			<?php endif; ?>		        		
				</div>
				<!-- /End Post-Footer Image -->

			</div>
		</div><!-- #colophon -->
		<!-- /End The Footer Section -->

	<?php endif; ?>
	<!-- /End Footer Check -->

	<!-- Start Sub-Foooter Check -->
	<?php if ( ot_get_option('show_sub_footer') != "off" ) : ?>

		<!-- Start Sub-Foooter -->
		<footer id="section-sub-footer" class="site-sub-footer clearfix" role="contentinfo">
			<div class="container">
				<div class="sixteen columns">

					<div class="columns left">
						<?php if (ot_get_option('footer_blurb_left')) : 
							// print ot_get_option('footer_blurb_left'); 
							$ot_fbl = ot_get_option('footer_blurb_left');
							$esc_ot_fbl = htmlspecialchars($ot_fbl, ENT_QUOTES);
							print htmlspecialchars_decode($esc_ot_fbl);
						endif; ?>
					</div><!-- .site-info -->

					<div class="columns right">
						<?php if (ot_get_option('footer_blurb_right')) : 
							// print ot_get_option('footer_blurb_right');
							$ot_fbr = ot_get_option('footer_blurb_right');
							$esc_ot_fbr = htmlspecialchars($ot_fbr, ENT_QUOTES);
							print htmlspecialchars_decode($esc_ot_fbr);
						endif; ?>
						<?php if (ot_get_option('footer_social') == 'on') : get_template_part( 'theme-core/theme-elements/element', 'getsocial' ); endif; ?>
					</div>	

				</div>
			</div>
		</footer><!-- #colophon -->
		<!-- /End Sub-Foooter -->

	<?php endif; ?>
	<!-- /End Sub-Foooter Check -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>