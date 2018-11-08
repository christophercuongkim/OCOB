<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package mythology
 */

get_header(); 

$woo_page_ID = get_option( 'woocommerce_shop_page_id' );
$woo_page_layout = get_post_meta($woo_page_ID,'content_layout',true);

/* DECLARE CONTAINER VARIABLES & DEFAULTS */
global $myth_container_layout;

$myth_container_layout = "default";

if(ot_get_option('container_layout')) :
$myth_container_layout = ot_get_option('container_layout');
endif;

if( $myth_container_layout == "default" OR $myth_container_layout == "" OR $myth_container_layout == "full-width" ) :
$myth_container_layout = "container-full-width";

elseif ( $myth_header_layout == "fixed-width" ) :
$myth_container_layout = "container-fixed-width";

endif;
  

/* DECLARE LAYOUT VARIABLES & DEFAULTS */

global $myth_primary_layout_classes;
global $myth_secondary_layout_classes;
global $tertiary_layout_classes; 
global $myth_content_layout;

$myth_content_layout = "default";
$myth_primary_layout_classes = "eleven columns right";
$myth_secondary_layout_classes = "five columns left";

if(ot_get_option('content_layout')) :
	$myth_content_layout = ot_get_option('content_layout');

	// Page Layout Options
	if( ($woo_page_layout) && ($woo_page_layout != "default" ) ) :
		$myth_content_layout = $woo_page_layout;
	endif;

  	if( $myth_content_layout == "default" OR $myth_content_layout == "" OR $myth_content_layout == "right-sidebar" ) :
  		$myth_primary_layout_classes = "left twelve columns";
  		$myth_secondary_layout_classes = "right four columns";

  	elseif ( $myth_content_layout == "left-sidebar" ) :
  		$myth_primary_layout_classes = "right twelve columns";
  		$myth_secondary_layout_classes = "left four columns";

  	elseif ( $myth_content_layout == "no-sidebar" ) :
  		$myth_primary_layout_classes = "sixteen columns";
  		$myth_secondary_layout_classes = "hide";

  	elseif ( $myth_content_layout == "dual-left-sidebar" ) :
  		$myth_primary_layout_classes = "right eight columns";
  		$myth_secondary_layout_classes = "left four columns";
  		$tertiary_layout_classes = "left four columns";

  	elseif ( $myth_content_layout == "dual-right-sidebar" ) :
  		$myth_primary_layout_classes = "left eight columns";
  		$myth_secondary_layout_classes = "right four columns";
  		$tertiary_layout_classes = "right four columns";

  	elseif ( $myth_content_layout == "dual-outside-sidebar" ) :
  		$myth_primary_layout_classes = "left eight columns";
  		$myth_secondary_layout_classes = "right four columns";
  		$tertiary_layout_classes = "left four columns"; 

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

	<div id="primary" class="content-area <?php echo esc_attr( $myth_primary_layout_classes ); ?>">
		<main id="main" class="site-main" role="main">

			<?php woocommerce_content(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>