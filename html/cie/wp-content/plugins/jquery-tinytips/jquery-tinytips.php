<?php
/**
 * @package Techotronic
 * @subpackage jQuery Tinytips
 *
 * Plugin Name: jQuery Tinytips
 * Plugin URI: http://www.techotronic.de/plugins/jquery-tinytips/
 * Description: Adds tinytips tooltips to links on your site. Comes with different themes.
 * Version: 1.1
 * Author: Arne Franken
 * Author URI: http://www.techotronic.de/
 * License: GPL
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */
?>
<?php
//define constants
define('JQUERYTINYTIPS_VERSION', '1.1');
define('TINYTIPSLIBRARY_VERSION', '1.1');

if (!defined('JQUERYTINYTIPS_PLUGIN_BASENAME')) {
    define('JQUERYTINYTIPS_PLUGIN_BASENAME', plugin_basename(__FILE__));
}
if (!defined('JQUERYTINYTIPS_PLUGIN_NAME')) {
    define('JQUERYTINYTIPS_PLUGIN_NAME', trim(dirname(JQUERYTINYTIPS_PLUGIN_BASENAME), '/'));
}
if (!defined('JQUERYTINYTIPS_NAME')) {
    define('JQUERYTINYTIPS_NAME', 'jQuery TinyTips');
}
if (!defined('JQUERYTINYTIPS_TEXTDOMAIN')) {
    define('JQUERYTINYTIPS_TEXTDOMAIN', 'jquery-tinytips');
}
if (!defined('JQUERYTINYTIPS_PLUGIN_DIR')) {
    define('JQUERYTINYTIPS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . JQUERYTINYTIPS_PLUGIN_NAME);
}
if (!defined('JQUERYTINYTIPS_PLUGIN_URL')) {
    define('JQUERYTINYTIPS_PLUGIN_URL', WP_PLUGIN_URL . '/' . JQUERYTINYTIPS_PLUGIN_NAME);
}
if (!defined('JQUERYTINYTIPS_PLUGIN_URL')) {
    define('JQUERYTINYTIPS_PLUGIN_URL', WP_PLUGIN_URL . '/' . JQUERYTINYTIPS_PLUGIN_NAME);
}
if (!defined('JQUERYTINYTIPS_PLUGIN_LOCALIZATION_DIR')) {
    define('JQUERYTINYTIPS_PLUGIN_LOCALIZATION_DIR', JQUERYTINYTIPS_PLUGIN_DIR . '/localization');
}
if (!defined('JQUERYTINYTIPS_SETTINGSNAME')) {
    define('JQUERYTINYTIPS_SETTINGSNAME', 'jquery-tinytips_settings');
}
if (!defined('JQUERYTINYTIPS_LATESTDONATEURL')) {
    define('JQUERYTINYTIPS_LATESTDONATEURL', 'http://tinytips.techotronic.de/latest-donations.php');
}
if (!defined('JQUERYTINYTIPS_TOPDONATEURL')) {
    define('JQUERYTINYTIPS_TOPDONATEURL', 'http://tinytips.techotronic.de/top-donations.php');
}

class jQueryTinytips {

    var $tinytipsThemes = array();

    var $tinytipsSettings = array();

    var $tinytipsDefaultSettings = array();

    /**
     * Plugin initialization
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function jQueryTinytips() {
    function jQueryTinytips() {
        if (!function_exists('plugins_url')) {
            return;
        }

        load_plugin_textdomain(JQUERYTINYTIPS_TEXTDOMAIN, false, '/jquery-tinytips/localization/');

        add_action('wp_head', array(& $this, 'buildWordpressHeader'));
        add_action('admin_post_jQueryTinytipsDeleteSettings', array(& $this, 'jQueryTinytipsDeleteSettings'));
        add_action('admin_post_jQueryTinytipsUpdateSettings', array(& $this, 'jQueryTinytipsUpdateSettings'));
        // add options page
        add_action('admin_menu', array(& $this, 'registerAdminMenu'));
        add_action('admin_notices', array(& $this, 'registerAdminWarning'));
        //register method for uninstall
        if (function_exists('register_uninstall_hook')) {
            register_uninstall_hook(__FILE__, array('jQueryTinytips', 'deleteSettingsFromDatabase'));
        }

        // Create the settings array by merging the user's settings and the defaults
        $usersettings = (array) get_option(JQUERYTINYTIPS_SETTINGSNAME);
        $defaultArray = $this->jQueryTinytipsDefaultSettings();
        $this->tinytipsSettings = wp_parse_args($usersettings, $defaultArray);

        //only add link to meta box
        if(isset($this->tinytipsSettings['removeLinkFromMetaBox']) && !$this->tinytipsSettings['removeLinkFromMetaBox']){
            add_action('wp_meta',array(& $this, 'renderMetaLink'));
        }

        if(isset($this->tinytipsSettings['autoTinytips']) && $this->tinytipsSettings['autoTinytips']){
            //write "colorbox-postID" to "img"-tags class attribute.
            //Priority = 100, hopefully the preg_replace is then executed after other plugins messed with the_content
            add_filter('the_content', array(& $this, 'addTinytipsGroupIdToImages'), 100);
            add_filter('the_excerpt', array(& $this, 'addTinytipsGroupIdToImages'), 100);
        }
        if(isset($this->tinytipsSettings['autoColorboxGalleries']) && $this->tinytipsSettings['autoColorboxGalleries']) {
            add_filter('wp_get_attachment_image_attributes', array(& $this, 'wpPostThumbnailClassFilter'));
        }

        //add CSS classes to "add link" dropdown menu
        add_filter('mce_css', array(& $this, 'addTinytipsLinkClasses'));

        // Create list of themes and their human readable names
        $this->tinytipsThemes = array(
            'light' => __('Light Theme', JQUERYTINYTIPS_TEXTDOMAIN),
            'yellow' => __('Yellow Theme', JQUERYTINYTIPS_TEXTDOMAIN),
            'orange' => __('Orange Theme', JQUERYTINYTIPS_TEXTDOMAIN),
            'red' => __('Red Theme', JQUERYTINYTIPS_TEXTDOMAIN),
            'green' => __('Green Theme', JQUERYTINYTIPS_TEXTDOMAIN),
            'blue' => __('Blue Theme', JQUERYTINYTIPS_TEXTDOMAIN),
            'purple' => __('Purple Theme', JQUERYTINYTIPS_TEXTDOMAIN),
            'dark' => __('Dark Theme', JQUERYTINYTIPS_TEXTDOMAIN)
        );

        if (!is_admin()) {
            // enqueue JavaScript and CSS files in wordpress
            wp_register_style('tinytips-css', plugins_url('css/tinyTips.css', __FILE__), array(), JQUERYTINYTIPS_VERSION, 'screen');
            wp_enqueue_style('tinytips-css');
            if($this->tinytipsSettings['debugMode']) {
                $jqueryTinytipsJavaScriptName = "js/jquery.tinyTips.js";
            }
            else {
                $jqueryTinytipsJavaScriptName = "js/jquery.tinyTips-min.js";
            }
            wp_enqueue_script('tinyTips', plugins_url($jqueryTinytipsJavaScriptName, __FILE__), array('jquery'), TINYTIPSLIBRARY_VERSION, $this->tinytipsSettings['javascriptInFooter']);
        }
    }

    // jQueryTinytips()

    /**
     * Renders plugin link in Meta widget
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function renderMetaLink() {
    function renderMetaLink() { ?>
        <li id="tinytipsLink"><?php _e('Using',JQUERYTINYTIPS_TEXTDOMAIN);?> <a href="http://www.techotronic.de/plugins/jquery-tinytips/" title="<?php echo JQUERYTINYTIPS_NAME ?>"><?php echo JQUERYTINYTIPS_NAME ?></a></li>
    <?php }

    // renderMetaLink()

    /**
     * Add Colorbox group Id to images.
     * function is called for every page or post rendering.
     * 
     * ugly way to make the images Colorbox-ready by adding the necessary CSS class.
     * unfortunately, Wordpress does not offer a convenient way to get certain elements from the_content,
     * so I had to do this by regexp replacement...
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     *
     * @param  $content
     * @return replaced content or excerpt
     */
    //public function addTinytipsGroupIdToImages($content) {
    function addTinytipsGroupIdToImages($content) {
        global
        $post;
        // match all img tags with this pattern
        $linkPattern = "/<a([^\>]*?)>/i";
        if (preg_match_all($linkPattern, $content, $linkTags)) {
            foreach ($linkTags[0] as $linkTag) {
                // only work on imgTags that do not already contain the String "colorbox-"
                if(!preg_match('/tinytips/i', $linkTag)){
                    if (!preg_match('/class/i', $linkTag)) {
                        // imgTag does not contain class-attribute
                        $pattern = $linkPattern;
                        $replacement = '<a class="tinytips" $1>';
                    }
                    else {
                        // imgTag already contains class-attribute
                        $pattern = "/<a(.*?)class=('|\")([A-Za-z0-9 \/_\.\~\:-]*?)('|\")([^\>]*?)>/i";
                        $replacement = '<a$1class=$2$3 tinytips$4$5>';
                    }
                    $replacedLinkTag = preg_replace($pattern, $replacement, $linkTag);
                    $content = str_replace($linkTag, $replacedLinkTag, $content);
                }
            }
        }
        return $content;
    }

    // addTinytipsGroupIdToImages()

    /**
     * Add colorbox-CSS-Class to WP Galleries
     * 
     * If wp_get_attachment_image() is called, filters registered for the_content are not applied on the img-tag.
     * So we'll need to manipulate the class attribute separately.
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     *
     * @param  $attribute class attribute of the attachment link
     * @return repaced attributes
     */
    //public function wpPostThumbnailClassFilter($attribute) {
    function wpPostThumbnailClassFilter($attribute) {
        global $post;
        $attribute['class'] .= ' tinytips ';
        return $attribute;
    }

    // wpPostThumbnailClassFilter()

    /**
     * Register the settings page in wordpress
     *
     * @since 1.0
     * @access private
     * @author Arne Franken
     */
    //private function registerSettingsPage() {
    function registerSettingsPage() {
        if (current_user_can('manage_options')) {
            add_filter('plugin_action_links_' . JQUERYTINYTIPS_PLUGIN_BASENAME, array(& $this, 'addPluginActionLinks'));
            add_options_page(JQUERYTINYTIPS_NAME, JQUERYTINYTIPS_NAME, 'manage_options', JQUERYTINYTIPS_PLUGIN_BASENAME, array(& $this, 'renderSettingsPage'));
        }
    }

    //registerSettingsPage()

    /**
     * Add settings link to plugin management page
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     *
     * @param  original action_links
     * @return action_links with link to settings page
     */
    //public function addPluginActionLinks($action_links) {
    function addPluginActionLinks($action_links) {
        $settings_link = '<a href="options-general.php?page=' . JQUERYTINYTIPS_PLUGIN_BASENAME . '">' . __('Settings', JQUERYTINYTIPS_TEXTDOMAIN) . '</a>';
        array_unshift($action_links, $settings_link);

        return $action_links;
    }

    //addPluginActionLinks()

    /**
     * Insert JavaScript and CSS for Colorbox into WP Header
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     *
     * @return wordpress header insert
     */
    //public function buildWordpressHeader() {
    function buildWordpressHeader() {
        ?>
        <!-- <?php echo JQUERYTINYTIPS_NAME ?> <?php echo JQUERYTINYTIPS_VERSION ?> | by Arne Franken, http://www.techotronic.de/ -->
        <?php
            // include TinyTips Javascript
            require_once 'includes/tinytips-javascript-loader.php';
            ?>
        <!-- <?php echo JQUERYTINYTIPS_NAME ?> <?php echo JQUERYTINYTIPS_VERSION ?> | by Arne Franken, http://www.techotronic.de/ -->
        <?php

    }

    //buildWordpressHeader()

    /**
     * Render Settings page
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function renderSettingsPage() {
    function renderSettingsPage() {
        require_once 'includes/settings-page.php';
    }

    //renderSettingsPage()

    /**
     * Registers the Settings Page in the Admin Menu
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function registerAdminMenu() {
    function registerAdminMenu() {
        if (function_exists('add_management_page') && current_user_can('manage_options')) {

            // update, uninstall message
            if (strpos($_SERVER['REQUEST_URI'], 'jquery-tinytips.php') && isset($_GET['jQueryTinytipsUpdateSettings'])) {
                $return_message = sprintf(__('Successfully updated %1$s settings.', JQUERYTINYTIPS_TEXTDOMAIN), JQUERYTINYTIPS_NAME);
            } elseif (strpos($_SERVER['REQUEST_URI'], 'jquery-tinytips.php') && isset($_GET['jQueryTinytipsDeleteSettings'])) {
                $return_message = sprintf(__('%1$s settings were successfully deleted.', JQUERYTINYTIPS_TEXTDOMAIN), JQUERYTINYTIPS_NAME);
            } else {
                $return_message = '';
            }
        }
        $this->registerAdminNotice($return_message);

        $this->registerSettingsPage();
    }

    // registerAdminMenu()

    /**
     * Registers Admin Notices
     *
     * @since 1.0
     * @access private
     * @author Arne Franken
     */
    //private function registerAdminNotice($notice) {
    function registerAdminNotice($notice) {
        if ($notice != '') {
            $message = '<div class="updated fade"><p>' . $notice . '</p></div>';
            add_action('admin_notices', create_function('', "echo '$message';"));
        }
    }

    // registerAdminNotice()

    /**
     * Registers the warning for admins
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function registerAdminWarning() {
    function registerAdminWarning() {
        if ($this->tinytipsSettings['tinytipsWarningOff'] || $this->tinytipsSettings['autoTinytips']) {
            return;
        }
        ?>

        <div class="updated" style="background-color:#f66;">
            <p>
                <a href="options-general.php?page=<?php echo JQUERYTINYTIPS_PLUGIN_BASENAME ?>"><?php echo JQUERYTINYTIPS_NAME ?></a> <?php _e('needs attention: the plugin is not activated to work automatically for all links.', JQUERYTINYTIPS_TEXTDOMAIN)?>
            </p>
        </div>
        <?php

    }

    // registerAdminWarning()

    /**
     * Default array of jQuery Tinytips settings
     *
     * @since 1.0
     * @access private
     * @static
     * @author Arne Franken
     */
    //private static function jQueryTinytipsDefaultSettings() {
    function jQueryTinytipsDefaultSettings() {

        // Create and return array of default settings
        return array(
            'jQueryTinytipsVersion' => JQUERYTINYTIPS_VERSION,
            'autoTinytips' => false,
            'tinytipsTheme' => 'light',
            'tinytipsWarningOff' => false,
            'tinytipsMetaLinkOff' => false,
            'javascriptInFooter' => false,
            'debugMode' => false,
            'removeLinkFromMetaBox' => false
        );
    }

    // jQueryTinytipsDefaultSettings()

    /**
     * Update jQuery Tinytips settings wrapper
     *
     * handles checks and redirect
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function jQueryTinytipsUpdateSettings() {
    function jQueryTinytipsUpdateSettings() {

        if (!current_user_can('manage_options'))
            wp_die(__('Did not update settings, you do not have the necessary rights.', JQUERYTINYTIPS_TEXTDOMAIN));

        //cross check the given referer for nonce set in settings form
        check_admin_referer('jquery-tinytips-settings-form');
        //get settings from plugins admin page
        $this->tinytipsSettings = $_POST[JQUERYTINYTIPS_SETTINGSNAME];
        //have to add jQueryColorboxVersion here because it is not included in the HTML form 
        $this->tinytipsSettings['jQueryTinytipsVersion'] = JQUERYTINYTIPS_VERSION;
        $this->updateSettingsInDatabase();
        $referrer = str_replace(array('&jQueryTinytipsUpdateSettings', '&jQueryTinytipsDeleteSettings'), '', $_POST['_wp_http_referer']);
        wp_redirect($referrer . '&jQueryTinytipsUpdateSettings');
    }

    // jQueryTinytipsUpdateSettings()

    /**
     * Update jQuery Tinytips settings
     *
     * handles updating settings in the WordPress database
     *
     * @since 1.0
     * @access private
     * @author Arne Franken
     */
    //private function updateSettingsInDatabase() {
    function updateSettingsInDatabase() {
        update_option(JQUERYTINYTIPS_SETTINGSNAME, $this->tinytipsSettings);
    }

    //updateSettings()

    /**
     * Delete jQuery Tinytips settings wrapper
     *
     * handles checks and redirect
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function jQueryTinytipsDeleteSettings() {
    function jQueryTinytipsDeleteSettings() {

        if (current_user_can('manage_options') && isset($_POST['delete_settings-true'])) {
            //cross check the given referer for nonce set in delete settings form
            check_admin_referer('jquery-delete_settings-form');
            $this->deleteSettingsFromDatabase();
            $this->tinytipsSettings = $this->jQueryTinytipsDefaultSettings();
        } else {
            wp_die(sprintf(__('Did not delete %1$s settings. Either you dont have the nececssary rights or you didnt check the checkbox.', JQUERYTINYTIPS_TEXTDOMAIN), JQUERYTINYTIPS_NAME));
        }
        //clean up referrer
        $referrer = str_replace(array('&jQueryTinytipsUpdateSettings', '&jQueryTinytipsDeleteSettings'), '', $_POST['_wp_http_referer']);
        wp_redirect($referrer . '&jQueryTinytipsDeleteSettings');
    }

    // jQueryTinytipsDeleteSettings()

    /**
     * Delete jQuery Tinytips settings
     *
     * handles deletion from WordPress database
     *
     * @since 1.0
     * @access private
     * @author Arne Franken
     */
    //private function deleteSettingsFromDatabase() {
    function deleteSettingsFromDatabase() {
        delete_option(JQUERYTINYTIPS_SETTINGSNAME);
    }

    // deleteSettings()

    /**
     * executed during activation.
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     */
    //public function activateJqueryTinytips() {
    function activateJqueryTinytips() {
        //do nothing at the moment
    }

    // activateJqueryTinytips()

    /**
     * Read HTML from a remote url
     *
     * @since 1.0
     * @access private
     * @author Arne Franken
     * 
     * @param string $url
     * @return the response
     */
    //private function getRemoteContent($url) {
    function getRemoteContent($url) {
        if ( function_exists('wp_remote_request') ) {

            $options = array();
            $options['headers'] = array(
                'User-Agent' => 'jQuery Tinytips V' . JQUERYTINYTIPS_VERSION . '; (' . get_bloginfo('url') .')'
             );

            $response = wp_remote_request($url, $options);

            if ( is_wp_error( $response ) )
                return false;

            if ( 200 != wp_remote_retrieve_response_code($response) )
                return false;

            return wp_remote_retrieve_body($response);
        }

        return false;
    }

    // getRemoteContent()

    /**
     * gets current URL to return to after donating
     *
     * @since 1.0
     * @access private
     * @author Arne Franken
     */
    //private function getReturnLocation(){
    function getReturnLocation(){
        $currentLocation = "http";
        $currentLocation .= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? "s" : "")."://";
        $currentLocation .= $_SERVER['SERVER_NAME'];
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
            if($_SERVER['SERVER_PORT']!='443') {
                $currentLocation .= ":".$_SERVER['SERVER_PORT'];
            }
        }
        else {
            if($_SERVER['SERVER_PORT']!='80') {
                $currentLocation .= ":".$_SERVER['SERVER_PORT'];
            }
        }
        $currentLocation .= $_SERVER['REQUEST_URI'];
        echo $currentLocation;
    }

    // getReturnLocation()

    /**
     * adds Colorbox CSS class to "add link" dialog
     *
     * @since 1.0
     * @access public
     * @author Arne Franken
     *
     * @param  $defaultCss
     * @return modified array
     */
    //public function addTinytipsLinkClasses($defaultCss) {
    function addTinytipsLinkClasses($defaultCss) {

        $jqueryTinytipsCss = JQUERYTINYTIPS_PLUGIN_URL . '/css/mce-tinytips.css';
        $defaultCss .= ',' . $jqueryTinytipsCss;

        return trim($defaultCss, ' ,');
    }

    // addTinytipsLinkClasses()
}

// class jQueryTinytips()
?><?php
/**
 * initialize plugin, call constructor
 *
 * @since 1.0
 * @access public
 * @author Arne Franken
 */
function jQueryTinytips() {
        global $jQueryTinytips;
        $jQueryTinytips = new jQueryTinytips();
}

// jQueryTinytips()

// add jQueryColorbox() to WordPress initialization
add_action('init', 'jQueryTinytips', 7);

// register method for activation
register_activation_hook(__FILE__, array('jQueryTinytips', 'activateJqueryTinytips'));
?>