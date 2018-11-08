<?php

/* ---------------------------------------------------------*/
/* PRE-LOAD ANY PLUGINS AT THEME ACTIVATION */ 
/* ---------------------------------------------------------*/
require_once( get_template_directory() . '/mythology-core/tgm-plugin-activation/class-tgm-plugin-activation.php' );
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {
    $plugins = array(

        // PREMIUM PLUGINS (INCLUDED WITH THEME) - SEE MYTHOLOGY-CORE/CORE-PLUGINS FOR FRAMEWORK INCLUDED PLUGINS

        array(
            'name'                  => 'Polytechnic Courses', // The plugin name
            'slug'                  => 'polytechnic-courses', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/theme-core/theme-plugins/polytechnic-courses.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Theme Customizer: Polytechnic', // The plugin name
            'slug'                  => 'styles-polytechnic', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/theme-core/theme-plugins/styles-polytechnic.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        // CORE PLUGINS (hosted on WP)
        array(
            'name'                  => 'Max Mega Menu', // The plugin name
            'slug'                  => 'megamenu', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/megamenu.latest-stable.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Responsive Menu', // The plugin name
            'slug'                  => 'responsive-menu', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/responsive-menu.latest-stable.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Custom Menu Wizard', // The plugin name
            'slug'                  => 'custom-menu-wizard', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/custom-menu-wizard.latest-stable.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Recent Posts Widget Extended', // The plugin name
            'slug'                  => 'recent-posts-widget-extended', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/recent-posts-widget-extended.latest-stable.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Image Widget', // The plugin name
            'slug'                  => 'image-widget', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/image-widget.latest-stable.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce', // The plugin name
            'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'The Events Calander', // The plugin name
            'slug'                  => 'the-events-calendar', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/the-events-calendar.latest-stable.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Shortcodes Ultimate', // The plugin name
            'slug'                  => 'shortcodes-ultimate', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/shortcodes-ultimate.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'                  => 'Dynamic To Top', // The plugin name
            'slug'                  => 'dynamic-to-top', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/theme-core/theme-plugins/dynamic-to-top.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Live Search Plugin', // The plugin name
            'slug'                  => 'ajaxy-search-form', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/theme-core/theme-plugins/ajaxy-search-form.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WordPress Importer', // The plugin name
            'slug'                  => 'wordpress-importer', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/wordpress-importer.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Widget Importer & Exporter', // The plugin name
            'slug'                  => 'widget-importer-exporter', // The plugin slug (typically the folder name)
            'source'                => 'https://downloads.wordpress.org/plugin/widget-importer-exporter.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        // WHY FORCE DEACTIVATE THESE?
        // These are some helpful tools included with the theme that you can use on your this project, and your next one.
        // The right thing to do here is to clean up after ourselves. If you really like one of these tools, though, feel free to just re-activate it. 

    );
    $theme_text_domain = 'mythology';
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => true,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            // 'notice_can_install_required'               => _n_noop( 'IMPORTANT! This theme REQUIRES the following plugin:<br /> %1$s. Do not proceed without installing and activating it!', 'IMPORTANT! This theme REQUIRES the following plugins: %1$s. Do not proceed without installing and activating them!' ), // %1$s = plugin name(s)
            'notice_can_install_required'               => _n_noop( 'IMPORTANT! This theme REQUIRES the following plugin:<br /> %1$s. Do not proceed without installing and activating it!', 'IMPORTANT! This theme REQUIRES the following plugins: %1$s. Do not proceed without installing and activating them! <br/><br/>Note: Installation will take a few minutes, so go ahead and select all > hit install and feel free make yourself a nice cup of coffee while you wait. These plugins are some powerful tools, so please be patient. If you run into issues, you are welcome to install these one at a time.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin have new versions available: %1$s. <br />To upgrade them, open the "Resources/Plugins" folder in your download package, then upload them to your WordPress Dashboard in the <strong>Plugins > Add New > Upload</strong> panel.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s. <br />To upgrade them, open the "Resources/Plugins" folder in your download package, then upload them to your WordPress Dashboard in the <strong>Plugins > Add New > Upload</strong> panel.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );
    tgmpa( $plugins, $config ); 
}

// if(function_exists('vc_set_as_theme')) vc_set_as_theme();

?>