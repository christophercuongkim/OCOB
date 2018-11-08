<?php
/**
 * Loads the child theme textdomain.
 */
function optimal_child_theme_setup() {
    load_child_theme_textdomain( 'optimal');
}
add_action( 'after_setup_theme', 'optimal_child_theme_setup' );

function optimal_child_enqueue_styles() {
    $parent_style = 'optimal-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'optimal-style', get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'optimal_child_enqueue_styles',99);

/**
 * Loads the child theme scripts
 */
function optimal_child_fonts() {  
    wp_enqueue_style( 'optimal-googlefonts', 'https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700,800|Poppins:100,300,400,500,600,700,800');
}  
add_action('wp_enqueue_scripts', 'optimal_child_fonts');

/**
 * Change Redux Defaults
 */
if (!function_exists('change_defaults')) {
    function change_defaults($defaults)
    {
        $defaults['button-color'] = '#f1c30f';
        $defaults['theme-color'] = '#f1c30f';
        $defaults['hero-bg'] = array(
                'background-image' => get_stylesheet_directory_uri() . '/images/bg-welcome.jpg',
                'background-size' => 'cover',
            );
        $defaults['hero-title'] = 'WELCOME TO';
        $defaults['hero-subtitle'] = "Optimal WordPress Theme";
        return $defaults;
    }
}
add_filter('redux/options/integral/defaults', 'change_defaults' );

/**
 * Change arguments for Redux Option values
 */
if (!function_exists('change_arguments')) {
    function change_arguments($args)
    {

        $args['menu_title'] = 'Optimal Options';
        $args['page_title'] = 'Optimal Options';

        return $args;
    }
}
add_filter('redux/options/integral/args', 'change_arguments' );

/**
 * Change theme option CSS output settings
 */
function optimal_options_output_css_settings() {
    global $integral;
    $color = $integral['theme-color'];
    echo "
        <style>
            .features .feature i, .services .feature span, .dark .heading .fa {color: {$color};}
            .features .feature:hover {background-color:{$color};}
            .features .feature:hover, .team p {border-color:{$color};}
        </style>";
}
add_action('wp_head', 'optimal_options_output_css_settings');

/**
 * User notice on theme activation
 */
function optimal_child_activation_notice() { ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e('Optimal is a child theme of Integral. Make sure you followed the', 'optimal'); ?> <a href="<?php echo esc_url('themes.php?page=integral-welcome'); ?>"><?php esc_html_e('Integral Setup Instructions', 'optimal'); ?></a> <?php _e('before using Optimal. Once setup, use the', 'optimal'); ?> <a href="<?php echo esc_url('admin.php?page=Optimal&tab=1'); ?>"><?php esc_html_e('Optimal Options Panel', 'optimal'); ?></a> <?php esc_html_e('to customize your website. Click', 'optimal'); ?> <strong><?php esc_html_e('RESET ALL', 'optimal'); ?></strong> <?php esc_html_e('to load the default settings for this theme.', 'optimal'); ?></p>
    </div>
<?php }
add_action('admin_notices', 'optimal_child_activation_notice');