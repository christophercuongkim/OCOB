<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package mythology
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if(ot_get_option('favicon')) : ?><link rel="shortcut icon" href="<?php echo esc_url( ot_get_option('favicon') ); ?>" type="image/gif" /><?php endif; ?>

<!-- Mobile Specific Metas 
================================================== -->	
<?php if (ot_get_option('responsive_toggle') != 'off') { ?>	  		
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
<?php } else { ?>		 
	<meta name="viewport" content="width=1300, maximum-scale=1, user-scalable=yes" />
<?php } ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php // Declare Global Layout Variables & Grab Their Values.
	global $is_handheld;
	global $myth_header_layout;
	global $myth_header_columns;
	global $myth_content_layout;
	global $myth_logo_layout_classes;
	global $myth_menu_layout_classes;
	global $myth_primary_layout_classes;
	global $myth_secondary_layout_classes; 
	get_layout_variables(); 
	?>

<div id="page" class="hfeed site">

	<?php do_action( 'before' ); ?>

	<!-- Check If Tophat Dropdown Is On -->
	<?php if (ot_get_option('top_hat_dropdown') == "on" ) : 

		// Set the columns class for each module.
		if(ot_get_option('tophat_columns_count') != '') : 
				$myth_header_columns = ot_get_option('tophat_columns_count');
			else : 
				$myth_header_columns = "sixteen columns";
			endif;

		?> 

		<!-- Start Tophat Dropdown -->
		<div class="super-container full-width" id="section-tophat-dropdown">
			<div class="th_slidingDiv" style="display: none;">
				<div class="container clearfix">
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('dropdown-widget-1') ) ?>
						</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('dropdown-widget-2') ) ?>
						</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('dropdown-widget-3') ) ?>
						</div>
					<div class="<?php echo esc_attr( $myth_header_columns ); ?>">
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('dropdown-widget-4') ) ?>
						</div>
		       	</div>
		    </div>
		</div>
		<!-- /End Tophat Dropdown -->

	<?php endif; ?>	
	<!-- /End Tophat Dropdown Check -->

	<!-- Get The Tophat -->
	<?php get_template_part( 'theme-core/theme-elements/element', 'tophat' ); ?>

	<!-- Start The Super-Header -->
	<div id="section-super-header" class="clearfix">
		<header id="section-header" class="clearfix" role="banner">
			<div class="container">
				<div class="sixteen columns">

					<!-- Site Header -->
					<div id="site-heading" class="five columns <?php echo esc_attr( $myth_logo_layout_classes ); ?> site-title alpha" role="heading">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>" rel="home">
						<h1 class="site-title"><?php if(ot_get_option('logo')) : $logopath = ot_get_option('logo'); ?>						
								<img id="site-logo" class="<?php echo esc_attr( $myth_logo_layout_classes ); ?>" src="<?php echo esc_url( $logopath ); ?>" alt="<?php bloginfo('name'); ?>" />
		        				<?php else : ?>
			        			<?php bloginfo('name'); ?>	
			        			<span id="site-description <?php echo esc_attr( $myth_logo_layout_classes ); ?>" class="site-description small"><?php bloginfo('description'); ?></span>	
			        			<?php endif; ?>		        		
			        	</h1>
			        	</a>
					</div>


					<!-- Menu -->
			  		<div id="section-navigation" class="clearfix" role="navigation">
						<div class="container">
							<div class="eleven columns omega <?php echo esc_attr( $myth_menu_layout_classes ); ?>">
								<nav id="site-navigation" class="" role="menu">
									<?php get_template_part( 'theme-core/theme-elements/element', 'navigation' ); ?>
								</nav>
							</div>
						</div>
					</div>
					
				</div>
			</div>

			<!-- Super Header Background And Color Overlay -->
			<div class="stripe_color"></div>
			<div class="stripe_image"></div>
		</header><!-- #masthead -->

		<!-- Check If Device Is Mobile/Handheld: if it is, don't load sticky-nav -->
		<?php if (is_handheld() != "true") : ?>
			<!-- Start Sticky Header -->
			<?php if (ot_get_option('sticky_header') == "on" ) : ?>

				<div id="section-sticky-header-background" class="scroll-dropdown-navigation clearfix"></div>
				<div id="section-sticky-header" class="scroll-dropdown-navigation clearfix">
					<div class="container">
						<div class="sixteen columns center center-text alpha omega">
							<div id="site-heading" class="left text-left site-title alpha" role="heading">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>" rel="home">
								<h1 class="site-title">
									<?php if(ot_get_option('sticky_logo')) : $stickylogopath = ot_get_option('sticky_logo'); ?>						
										<img id="site-logo" class="left text-left" src="<?php echo esc_url( $stickylogopath ); ?>" alt="<?php bloginfo('name'); ?>" />
					        		<?php endif; ?>		        		
					        	</h1>
					        	</a>
							</div>
							<nav id="site-navigation" class="" role="menu">
								<?php get_template_part( 'theme-core/theme-elements/element', 'sticky-header' ); ?>
							</nav>
			
						</div>
					</div>
				</div>

			<?php endif; ?> 
			<!-- /End Sticky Header -->
		<?php endif; ?>
		
	</div>
	<!-- /End The Super-Header -->

	<!-- Start The Content Section -->
	<div id="section-content" class="clearfix">
		<div class="container">
			<div class="sixteen columns">        

				<!-- Start Left Sidebars (left of the content area). The remaining options (right of the content area) are found in sidebar.php -->
				<?php // Global Layout Options
				global $myth_content_layout;
				global $tertiary_layout_classes; 
				if(ot_get_option('content_layout')) :
					$myth_content_layout = ot_get_option('content_layout');

					// Page Layout Options
					if( get_custom_field('content_layout') && get_custom_field('content_layout') != "default" ) :
						$myth_content_layout = get_custom_field('content_layout');
						endif;

					// If dual-outside sidebar is set.
					if( $myth_content_layout == "dual-outside-sidebar" ) : ?>
					<div id="tertiary" class="widget-area <?php echo esc_attr( $tertiary_layout_classes ); ?>" role="complementary">
						<?php do_action( 'before_sidebar' ); ?>
						<?php if ( ! dynamic_sidebar( 'default-widget-area-2' ) ) : ?>
						<?php endif; // end sidebar widget area ?>
					</div><!-- #tertiary -->

					<?php // If dual-left sidebar is set.
					elseif( $myth_content_layout == "dual-left-sidebar" ) : ?>
						<div id="tertiary" class="widget-area <?php echo esc_attr( $tertiary_layout_classes ); ?>" role="complementary">
							<?php do_action( 'before_sidebar' ); ?>
							<?php if ( ! dynamic_sidebar( 'default-widget-area-2' ) ) : ?>
							<?php endif; // end sidebar widget area ?>
						</div><!-- #tertiary -->
						<div id="secondary" class="widget-area <?php echo esc_attr( $myth_secondary_layout_classes ); ?>" role="complementary">
							<?php do_action( 'before_sidebar' ); ?>
							<?php if ( ! dynamic_sidebar( 'default-widget-area' ) ) : ?>
							<?php endif; // end sidebar widget area ?>
						</div><!-- #secondary -->

					<?php endif; 
				endif; ?>
				<!-- /End Left Sidebars -->
