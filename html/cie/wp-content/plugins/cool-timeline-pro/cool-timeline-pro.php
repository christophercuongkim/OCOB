<?php 
/*
  Plugin Name:Cool Timeline Pro
  Plugin URI:http://www.cooltimeline.com
  Description:Use Cool Timeline pro wordpress plugin to showcase your life or your company story in a vertical timeline format. Cool Timeline Pro is an advanced timeline plugin that creates responsive vertical storyline automatically in chronological order based on the year and date of your posts.
  Version:2.7.1
  Author:Cool Timeline Team
  Author URI:http://www.cooltimeline.com
  License:GPL2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages 
  Text Domain:cool-timeline
 */
/** Configuration * */

if (!defined('CTLPV')){
    define('CTLPV', '2.7.1');

}

/*
    Defined constant for later use
 */
define('CTP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CTP_PLUGIN_DIR', plugin_dir_path(__FILE__));
defined( 'CTP_FA_DIR' ) or define( 'CTP_FA_DIR', CTP_PLUGIN_DIR.'/fa-icons/' );
defined( 'CTP_FA_URL' ) or define( 'CTP_FA_URL', CTP_PLUGIN_URL.'/fa-icons/'  );

if (!class_exists('CoolTimelinePro')) {

    class CoolTimelinePro {

        /**
         * Construct the plugin objects
         */
        public function __construct() {

            //set plugin path for later use
            $this->plugin_path = plugin_dir_path(__FILE__);
            // Installation and uninstallation hooks
            register_activation_hook(__FILE__ , array($this,'ctp_activation_before'));
           
           //include the main class files
             $this->clt_include_files();

             if(is_admin()){

             //Adding plugin settings link  
            $plugin = plugin_basename(__FILE__);
            add_filter("plugin_action_links_$plugin", array($this, 'plugin_settings_link'));   

             //Fixed bridge theme confliction using this action hook
            add_action( 'wp_print_scripts', array($this,'ctl_deregister_javascript'), 100 );
          
            add_action('admin_enqueue_scripts',array($this, 'ctl_custom_order_js'));

            // add a tinymce button that generates our shortcode for the user
            add_action('after_setup_theme', array($this, 'ctl_add_tinymce'));
            add_action( 'admin_notices',array($this,'cool_admin_messages'));
            add_action( 'wp_ajax_ctl_hideRating',array($this,'ctl_pro_HideRating' ));
            }else{
            
             add_action( 'init', array($this,'fa_icons_tp_tags' ) );
            
              }

           // Add image size for Avatar image
            add_image_size('ctl_avatar', 250, 250, true); // Hard crop left top
           
           //Hooked plugin translation function 
            add_action('plugins_loaded', array($this, 'clt_load_plugin_textdomain'));
       
         }

         function ctl_custom_order_js($hook) {
             $current_page=ctl_get_ctp();
            if($current_page!="cool_timeline" ) 
                return;
            wp_enqueue_script( 'ctl-admin-js',CTP_PLUGIN_URL.'js/ctl_admin.js',array('jquery'));
             wp_localize_script( 'ctl-admin-js', 'ajax_object',
             array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
         }
         
          public function clt_include_files(){

           // Register cooltimeline post type for timeline stories
            require_once CTP_PLUGIN_DIR . 'includes/cool_timeline_posttype.php';

            // contain common function for plugin
            require_once CTP_PLUGIN_DIR . 'includes/ctl-helpers.php';
            require_once CTP_PLUGIN_DIR . 'includes/ctl_load_more.php';


         if(is_admin()){
                //automatic updates 
              require_once(dirname(__FILE__) . "/includes/class.wp-auto-plugin-update.php");

            // including plugin settings panel class
             require_once( CTP_PLUGIN_DIR ."admin-page-class/admin-page-class.php");
            // including timeline stories meta boxes class 
            require_once CTP_PLUGIN_DIR . "meta-box-class/my-meta-box-class.php";
            // Vc addon for timeline shortcode
            require_once CTP_PLUGIN_DIR . "includes/cool_vc_addon.php";
            // included timeline stories icon handler class
            require CTP_PLUGIN_DIR .'fa-icons/fa-icons-class.php';
           
            require CTP_PLUGIN_DIR .'/includes/ctl-meta-fields.php';
            /*
             * Options panel
             */
            $this->ctl_option_panel();
            /*
             *  custom meta boxes 
             */
             clt_meta_boxes();
             new CoolVCAddon();
             new Ctl_Fa_Icons();

          } else{

             /*
             * Frontend files
             */
        
            require_once CTP_PLUGIN_DIR . 'includes/cool_timeline_shortcode.php';
            require_once CTP_PLUGIN_DIR . 'includes/ct-shortcode-new.php';
            require_once CTP_PLUGIN_DIR . 'includes/cool_timeline_custom_styles.php';

             new CoolTimelineShortcode();
             new CoolContentTimeline();

          }
            
             $cool_timeline_posttype = new CoolTimelinePosttype();
         }



      /*
        Perform some actions on plugin activation time
       */   
    function ctp_activation_before() {

        if (is_plugin_active( 'cool-timeline/cooltimeline.php' ) ) 
            {
            deactivate_plugins( 'cool-timeline/cooltimeline.php' );
           }
            update_option("cool-timelne-v",CTLPV);
            update_option("cool-timelne-type","PRO");
          
            update_option("cool-timelne-installDate",date('Y-m-d h:i:s') );
            update_option("cool-timelne-ratingDiv","no");

          $ctl_settings=get_option('cool_timeline_options');
          if(is_array($ctl_settings) && !empty($ctl_settings)){
          if(isset($ctl_settings['enable_navigation']) && in_array('enable_navigation', $ctl_settings)){
             update_option("ctl-can-migrate","no");
            }else{
               update_option("ctl-can-migrate","yes");
            }
           }else{
            update_option("ctl-can-migrate","yes");
           }
    }
        
        /*
            Loading translation files of plugin 
         */

        function clt_load_plugin_textdomain() {
         $rs = load_plugin_textdomain('cool-timeline', FALSE, basename(dirname(__FILE__)) . '/languages/');
        }

        // Add the settings link to the plugins page
        function plugin_settings_link($links) {
            $settings_link = '<a href="options-general.php?page=cool_timeline_page">Settings</a>';
            array_unshift($links, $settings_link);
            return $links;
        }
        /**
         * Include other PHP scripts for the plugin
         * @return void
         *
         **/
        public function fa_icons_tp_tags() {
            // Files specific for the front-ned
            if ( ! is_admin() ) {
                // Load template tags (always last)
                include CTP_PLUGIN_DIR .'fa-icons/includes/template-tags.php';
            }
        }

        /*
        * Fixed Bridge theme confliction
        */
        function ctl_deregister_javascript() {

            if(is_admin()) {
                $screen = get_current_screen();
                if ($screen->base == "toplevel_page_cool_timeline_page") {
                    wp_deregister_script('default');
                }
            }
        }

        /*
            Creating plugin settings panel
         */

        function ctl_option_panel() {

            /**
             * configure your admin page
             */
            $config = array(
                'menu' => array('top' => 'cool_timeline'), //sub page to settings page
                'page_title' => __('Cool Timeline Pro', 'cool-timeline'), //The name of this page 
                'capability' => 'manage_options', // The capability needed to view the page
                'option_group' => 'cool_timeline_options', //the name of the option to create in the database
                'id' => 'cool_timeline_page', // meta box id, unique per page
                'fields' => array(), // list of fields (can be added by field arrays)
                'local_images' => false, // Use local or hosted images (meta box images for add/remove)
                'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
            );

            /**
             * instantiate your admin page
             */
            $options_panel = new BF_Admin_Page_Class_Pro($config);
            $options_panel->OpenTabs_container('');

            /**
             * define your admin page tabs listing
             */
            $options_panel->TabsListing(array(
                'links' => array(
                    'options_1' => __('General Settings', 'cool-timeline'),
                    'options_2' => __('Style Settings', 'cool-timeline'),
                    'options_3' => __('Typography Settings', 'cool-timeline'),
                    'options_4' => __('Stories Settings', 'cool-timeline'),
                    'options_5' => __('Date Settings', 'cool-timeline'),
                    'options_7' => __('Navigation Settings', 'cool-timeline'),
                    'options_8' => __('Timeline Display', 'cool-timeline'),
                    'options_11' => __('Content Timeline Settings', 'cool-timeline'),
                    'options_6' => __('Extra Settings', 'cool-timeline'),
                     'options_10' => __('Migrations', 'cool-timeline'),
                    
                )
            ));

            /**
             * Open admin page first tab
             */
            $options_panel->OpenTab('options_1');

            /**
             * Add fields to your admin page first tab
             * 
             * Simple options:
             * input text, checbox, select, radio 
             * textarea
             */
            //title
            $options_panel->Title(__("General Settings", "cool-timeline"));
            $options_panel->addText('title_text', array('name' => __('Timeline Title (Default) ', 'cool-timeline'), 'std' => 'Cool Timeline', 'desc' => __('', 'cool-timeline')));

            //select field
            $options_panel->addSelect('title_tag', array('h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6'), array('name' => __('Title Heading Tag ', 'cool-timeline'), 'std' => array('h1'), 'desc' => __('', 'cool-timeline')));
            $options_panel->addRadio('title_alignment', array('left' => 'Left',
                'center' => 'Center', 'right' => 'Right'), array('name' => __('Title Alignment ?', 'cool-timeline'), 'std' => array('center'), 'desc' => __('', 'cool-timeline')));
            $options_panel->addRadio('display_title', array('yes' => 'Yes',
                'no' => 'No'), array('name' => __('Display Title ?', 'cool-timeline'), 'std' => array('yes'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addText('post_per_page', array('name' => __('Number of stories to display ?', 'cool-timeline'), 'std' =>20, 'desc' => __('This option is overridden by shortcode. Please check shortcode generator.', 'cool-timeline')));
         
            $options_panel->addText('content_length', array('name' => __('Content Length ? ', 'cool-timeline'), 'std' => 50, 'desc' => __('Please enter no of words', 'cool-timeline')));
            //Image field
            
            $options_panel->addImage('user_avatar', array('name' => __('Timeline default Image', 'cool-timeline'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addRadio('desc_type', array('short' => 'Short (Default)',
                'full' => 'Full (with HTML)'), array('name' => __('Stories Description?', 'cool-timeline'), 'std' => array('short'), 'desc' => __('This option is overridden by shortcode in V2.1. Please check shortcode generator.', 'cool-timeline')));

            $options_panel->addRadio('display_readmore', array('yes' => 'Yes',
                'no' => 'No'), array('name' => __('Display read more ?', 'cool-timeline'), 'std' => array('yes'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addText('read_more_lbl', array('name' => __('Stories Read more Text', 'cool-timeline'), 'std' => '', 'desc' => __('', 'cool-timeline')));


            $options_panel->addRadio('posts_orders', array('DESC' => 'DESC',
                'ASC' => 'ASC'), array('name' => __('Stories Order ?', 'cool-timeline'), 'std' => array('DESC'), 'desc' => __('This option is overridden by shortcode. Please check your shortcode generator.', 'cool-timeline')));
              //select field
              $options_panel->CloseTab();

			 /**
             * Open admin page secondsetting-error-tgmpa tab
             */
            $options_panel->OpenTab('options_2');
            $options_panel->Title(__("Style Settings", "cool-timeline"));
            /**
             * To Create a Conditional Block first create an array of fields (just like a repeater block
             * use the same functions as above but add true as a last param
             */
            $Conditinal_fields[] = $options_panel->addColor('bg_color', array('name' => __('Background Color', 'cool-timeline')), true);

            /**
             * Then just add the fields to the repeater block
             */
            //conditinal block 
            $options_panel->addCondition('background', array(
                'name' => __('Container Background ', 'cool-timeline'),
                'desc' => __('', 'cool-timeline'),
                'fields' => $Conditinal_fields,
                'std' => false
            ));

            //Color field
            $options_panel->addColor('content_bg_color', array('name' => __('Story Background Color', 'cool-timeline'), 'std' =>'#f9f9f9', 'desc' => __('', 'cool-timeline')));

            $options_panel->addColor('content_color', array('name' => __('Content Font Color', 'cool-timeline'),'std' =>'#666666', 'desc' => __('', 'cool-timeline')));
            $options_panel->addColor('title_color', array('name' => __('Story Title Color', 'cool-timeline'),'std' =>'#fff', 'desc' => __('', 'cool-timeline')));

            $options_panel->addColor('circle_border_color', array('name' => __('Circle Color', 'cool-timeline'), 'std' =>'#222222', 'desc' => __('', 'cool-timeline')));

            $options_panel->addColor('line_color', array('name' => __('Line Color', 'cool-timeline'), 'std' =>'#000', 'desc' => __('', 'cool-timeline')));
            //Color field
            $options_panel->addColor('first_post', array('name' => __('First Color', 'cool-timeline'), 'std' =>'#02c5be', 'desc' => __('', 'cool-timeline')));
            $options_panel->addColor('second_post', array('name' => __('Second Color', 'cool-timeline'), 'std' =>'#f12945', 'desc' => __('', 'cool-timeline')));
            // $options_panel->addColor('third_post',array('name'=> __('Third Post','cool-timeline'),'std'=>array('#000'), 'desc' => __('','cool-timeline')));
            $options_panel->CloseTab();

			
			
            /**
             * Open admin page third tab
             */
            $options_panel->OpenTab('options_3');

            //title
            $options_panel->Title(__("Typography Settings", "cool-timeline"));
            $options_panel->addTypo('main_title_typo', array('name' => __("Main Title", "cool-timeline"), 'std' => array('size' => '22px', 'color' => '#000000', 'face' => 'arial', 'style' => 'normal'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addTypo('post_title_typo', array('name' => __("Story Title", "cool-timeline"), 'std' => array('size' => '20px', 'color' => '#000000', 'face' => 'arial', 'style' => 'normal'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addRadio('post_title_text_style', array('lowercase' => 'Lowercase',
                'uppercase' => 'Uppercase', 'capitalize' => 'Capitalize',
                'none' => 'None'    
                ), array('name' => __('Story Title Style ?', 'cool-timeline'), 'std' => array('capitalize'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addTypo('post_content_typo', array('name' => __("Story Content", "cool-timeline"), 'std' => array('size' => '14px', 'color' => '#000000', 'face' => 'arial', 'style' => 'normal'), 'desc' => __('', 'cool-timeline')));



            $options_panel->CloseTab();

           

            /**
             * Open admin page third tab
             */
            $options_panel->OpenTab('options_4');
            $options_panel->Title(__("Stories Settings", "cool-timeline"));
           $options_panel->addText('post_type_slug', array('name' => __('Custom slug of timeline stories', 'cool-timeline'), 'std' => '', 'desc' => __('Remember to save the permalink again in settings -> Permalinks.', 'cool-timeline')));

            //An optionl descrption paragraph
            $options_panel->addParagraph(__("Animation Effects option is added in shortcode generator in Version 1.9 or Later","cool-timeline"));

            $options_panel->addRadio('stories_images', array('popup' => 'In Popup',
                'single' => 'Story detail link','disable_links'=>'Disable links'), array('name' => __('Stories Images?', 'cool-timeline'), 'std' => array('popup'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addRadio('ctl_slideshow', array('true' => 'Enable',
                'false' => 'Disable'), array('name' => __('Stories Slideshow ?', 'cool-timeline'), 'std' => array('true'), 'desc' => __('', 'cool-timeline')));

             $options_panel->addRadio('ctl_goback', array('true' => 'Enable',
                'false' => 'Disable'), array('name' => __('Show go to back link ?', 'cool-timeline'), 'std' => array('true'), 'desc' => __('Show go back to timeline link on single story(detail) page.', 'cool-timeline')));
        
            $options_panel->addText('ctl_goback_lbl', array('name' => __('Go Back Link Text', 'cool-timeline'), 'std' =>"Go Back", 'desc' => __('Add change Go to back link text', 'cool-timeline')));

            $options_panel->addRadio('slider_animation', array('slide' => 'Slide',
                'fade' => 'FadeIn'), array('name' => __('Slider animation ?', 'cool-timeline'), 'std' => array('slide'), 'desc' => __('', 'cool-timeline')));
        
            $options_panel->addText('animation_speed', array('name' => __('Slide Show Speed ?', 'cool-timeline'), 'std' => '5000', 'desc' => __('Enter the speed in milliseconds 1000 = 1 second', 'cool-timeline')));

            $options_panel->addText('default_icon', array('name' => __('Stories Default Icon', 'cool-timeline'), 'std' => '', 'desc' => __('Please add stories default  icon class from here <a target="_blank" href="http://fontawesome.io/icons">Font Awesome</a>', 'cool-timeline')));


            $options_panel->CloseTab();


            /**
             * Open admin page third tab
             */
            $options_panel->OpenTab('options_5');
            $options_panel->Title(__("Stories Date Settings", "cool-timeline"));
            $options_panel->addRadio('disable_months', array('yes' => 'Yes',
                'no' => 'no'), array('name' => __('Disable Stories Dates ?', 'cool-timeline'), 'std' => array('no'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addRadio('ctl_date_formats', array('M d' => date('M d'),
                'F j, Y' => date('F j, Y'), 'Y-m-d' => date('Y-m-d'),
                'm/d/Y' => date('m/d/Y'), 'd/m/Y' => date('d/m/Y')
                    ), array('name' => __('Stories Date Formats ?', 'cool-timeline'), 'std' => array('M d'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addText('custom_date_formats', array('name' => __('Custom date formats', 'cool-timeline'), 'std' => '', 'desc' => __('Stories date formats   e.g  D,M,Y <a  target="_blank" href="http://php.net/manual/en/function.date.php">Click here to view more</a>', 'cool-timeline')));

            $options_panel->addRadio('custom_date_style', array('no' => 'No(Default style)',
                'yes' => 'Yes'), array('name' => __('Enable custom date styles', 'cool-timeline'), 'std' => array('no'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addTypo('ctl_date_typo', array('name' => __("Stories date Font style", "cool-timeline"), 'std' => array('size' => '22px', 'color' => '#000000', 'face' => 'arial', 'style' => 'normal'), 'desc' => __('', 'cool-timeline')));
           
		   $options_panel->addRadio('custom_date_color', array('no' => 'No(Default style)',
                'yes' => 'Yes'), array('name' => __('Enable custom date Color', 'cool-timeline'), 'std' => array('no'), 'desc' => __('', 'cool-timeline')));
		   $options_panel->addColor('ctl_date_color', array('name' => __('Stories date color', 'cool-timeline'), 'std' =>'#000000', 'desc' => __('', 'cool-timeline')));



            $options_panel->CloseTab();

            /**
             * Open admin page third tab
             */
            $options_panel->OpenTab('options_7');
            $options_panel->Title(__("Timeline Scrolling Navigation settings", "cool-timeline"));
            $options_panel->addRadio('enable_navigation', array('yes' => 'Yes',
                'no' => 'no'), array('name' => __('Enable Scrolling  Navigation ?', 'cool-timeline'), 'std' => array('yes'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addRadio('navigation_position', array(
                'left' => 'Left Side', 'right' => 'Right Side','bottom' => 'Bottom Fixed ',
                    ), array('name' => __('Scrolling Navigation Position ?', 'cool-timeline'), 'std' => array('right'), 'desc' => __('', 'cool-timeline')));

            $options_panel->addRadio('enable_pagination', array('yes' => 'Yes',
                'no' => 'No'), array('name' => __('Enable Pagination ?', 'cool-timeline'), 'std' => array('yes'), 'desc' => __('Pagination settings added in shortcode Generator in version 2.4', 'cool-timeline')));

            $options_panel->CloseTab();

            /**
             * Open admin page third tab
             */
            $options_panel->OpenTab('options_6');
            /**
             * Editor options:
             * WYSIWYG (tinyMCE editor)
             * Syntax code editor (css,html,js,php)
             */
            //code editor field
            $options_panel->addCode('custom_styles', array('name' =>
            __('Custom Styles', 'cool-timeline'), 'syntax' => 'css'));
            // Close 3rd tab
            //title
            //  $options_panel->Title(__("Editor Options","cool-timeline"));
            //wysiwyg field
           // $options_panel->addWysiwyg('no_posts', array('name' => __('No Timeline Posts content', 'cool-timeline'), 'desc' => __('', 'cool-timeline')));

            $options_panel->CloseTab();

            /**
             * Open admin page third tab
             */
            $options_panel->OpenTab('options_8');
            //An optionl descrption paragraph
            $options_panel->addParagraph(__('<img src="https://res.cloudinary.com/cooltimeline/image/upload/v1512558943/add-cool-timeline-shortcode.png" style="width:100%">', "cool-timeline"));
            $options_panel->addParagraph(__('<img style="width:100%" src="https://res.cloudinary.com/cooltimeline/image/upload/v1512558943/add-category-based-timeline.png">', "cool-timeline"));
            $options_panel->addParagraph(__('Please use below added shortcode for default timeline. <br><br>
		<code><strong>[cool-timeline layout="default" designs="default" skin="default" category="{add here category-slug}" show-posts="10" order="DESC" icons="NO" animations="bounceInUp" date-format="default" story-content="short" based="default" compact-ele-pos="main-date" pagination="default" filters="no"] </strong> </code>', "cool-timeline"));

            $options_panel->addParagraph(__('Please use below added shortcode for multiple timeline (category based timeline). <br> <br> <code><strong>[cool-timeline layout="default" designs="default" skin="default" category="{add here category-slug}" show-posts="10" order="DESC" icons="NO" animations="bounceInUp" date-format="default" story-content="short" based="default" compact-ele-pos="main-date" pagination="default" filters="no"] </strong></code>', "cool-timeline"));

          $options_panel->addParagraph(__('Horizontal Timeline. <br><br>
		<code><strong>[cool-timeline layout="horizontal" category="{add here category-slug}" skin="default" designs="default" show-posts="20" order="DESC" items="" icons="NO" story-content="short" date-format="default" based="default" autoplay="false" start-on="0"]</strong> </code>', "cool-timeline"));

            $options_panel->addParagraph(__('Vertical Content Timeline(any post type). <br><br>
		<code><strong>[cool-content-timeline post-type="post" post-category="" tags="" story-content="short" taxonomy="category" layout="default" designs="default" skin="default" show-posts="10" order="DESC" icons="NO" animations="bounceInUp" date-format="default" pagination="default" filters="no"]</strong> </code>', "cool-timeline"));

            $options_panel->addParagraph(__('Horizontal Content Timeline(any post type). <br><br>
        <code><strong>[cool-content-timeline post-type="post" post-category="" tags="" autoplay="false" story-content="short" taxonomy="category" layout="horizontal" designs="default" skin="default" show-posts="10" order="DESC" start-on="0" icons="NO" items="" date-format="default"]</strong> </code>', "cool-timeline"));
            $options_panel->CloseTab();

           /**
             * Open admin page third tab
             */
            $options_panel->OpenTab('options_11');
            $options_panel->addRadio('post_meta', array(
                'yes' => 'Yes', 'no' => 'No'
                    ), array('name' => __('Display Post Meta (Categries,Tags) ?', 'cool-timeline'), 'std' => array('yes'), 'desc' => __('', 'cool-timeline')));

            $options_panel->CloseTab();
            /**
             * Open admin page 7th tab
             */
            $options_panel->OpenTab('options_10');
             $options_panel->Title(__("Story Migrations","cool-timeline"));
              $options_panel->content_migration();

            $options_panel->CloseTab();
            $options_panel->CloseTab();

        }

        /*
            Adding shortcode generator in TinyMCE editor
         */
        public function ctl_add_tinymce() {
         global $typenow;
         if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
              return;
        }

        if ( get_user_option('rich_editing') == 'true' ) {
       add_filter('mce_external_plugins', array(&$this, 'ctl_add_tinymce_plugin'));
            add_filter('mce_buttons', array(&$this, 'ctl_add_tinymce_button'));
          }    

        }

        /*
            Creating TinyMCE plugin for shortcode generator
         */
    
        public function ctl_add_tinymce_plugin($plugin_array) {
            $plugin_array['cool_timeline'] =CTP_PLUGIN_URL.'js/shortcode-btn.js';
            return $plugin_array;
        }

        // Add the button key for address via JS
        function ctl_add_tinymce_button($buttons) {
            array_push($buttons, 'cool_timeline_shortcode_button');
            return $buttons;
        }

        // end tinymce button functions           

        /**
         * Activate the plugin
         */
        public function activate() {
          /*  if ( is_plugin_active('cool-timeline/cool-timeline.php') ) {
                deactivate_plugins('cool-timeline/cool-timeline.php');
            }
            // Compare versions.
         /*   if ( version_compare(phpversion(),  '5.6', '<') ) {
               deactivate_plugins( plugin_basename( __FILE__ ) );
                return false;
               // wp_die( 'This plugin requires PHP Version 5.2.  Sorry about that.' );

             } */
               // Do activate Stuff now.

        }
        // END public static function activate

        /**
         * Deactivate the plugin
         */
        public function deactivate() {

        }

      

        /*
            Integrated Admin noticed for rating
         */

        public function cool_admin_messages() {
      
         if( !current_user_can( 'update_plugins' ) ){
            return;
         }
        $install_date = get_option( 'cool-timelne-installDate' );
        $ratingDiv =get_option( 'cool-timelne-ratingDiv' )!=false?get_option( 'cool-timelne-ratingDiv'):"no";

         $dynamic_msz='<div class="cool_fivestar update-nag" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);">
          <p>Dear Cool Timeline PRO Plugin User, Hopefully you\'re happy with our plugin. <br> May I ask you to give it a <strong>5-star rating</strong> on Wordpress? 
            This will help to spread its popularity and to make this plugin a better one.
            <br><br>Your help is much appreciated.Thank you very much!
            <ul>
                <li class="float:left"><a href="https://codecanyon.net/item/cool-timeline-pro-wordpress-timeline-plugin/reviews/17046256" class="thankyou button button-primary" target="_new" title="I Like Cool Timeline" style="color: #ffffff;-webkit-box-shadow: 0 1px 0 #256e34;box-shadow: 0 1px 0 #256e34;font-weight: normal;float:left;margin-right:10px;">I Like Cool Timeline PRO</a></li>
                <li><a href="javascript:void(0);" class="coolHideRating button" title="I already did" style="">I already rated it</a></li>
                <li><a href="javascript:void(0);" class="coolHideRating" title="No, not good enough" style="">No, not good enough, i do not like to rate it!</a></li>
            </ul>
        </div>
        <script>
        jQuery( document ).ready(function( $ ) {

        jQuery(\'.coolHideRating\').click(function(){
            var data={\'action\':\'ctl_hideRating\'}
                 jQuery.ajax({
            
            url: "' . admin_url( 'admin-ajax.php' ) . '",
            type: "post",
            data: data,
            dataType: "json",
            success: function(e) {
                if (e.success=="true") {
                   jQuery(\'.cool_fivestar\').slideUp(\'fast\');
             
                }
            }
             });
            })
        
        });
        </script>';

                $display_date = date( 'Y-m-d h:i:s' );
                $install_date= new DateTime( $install_date );
                $current_date = new DateTime( $display_date );
                $difference = $install_date->diff($current_date);
              $diff_days= $difference->days;
           if (isset($diff_days) && $diff_days>=7 && $ratingDiv == "no" ) {
                echo $dynamic_msz;
                }
               
           }   
       /*
        Ajax Callback for rating button
        */    

     public function ctl_pro_HideRating() {
        $rs=update_option( 'cool-timelne-ratingDiv','yes' );
         echo  json_encode( array("success"=>"true") );
        exit;
        }
 }
    //end class
}

if(is_admin()){
    foreach (array('post.php','post-new.php','edit-tags.php','term.php') as $hook) {

        add_action("admin_head-$hook", 'ctl_admin_head');
    }

}

/**
 * Localize Script
 */
function ctl_admin_head() {

    $plugin_url = plugins_url('/', __FILE__);
   if(version_compare(get_bloginfo('version'),'4.5.0', '>=') ){
    $terms = get_terms(array(
     'taxonomy' => 'ctl-stories',
    'hide_empty' => false,
     ));
    }else{
            $terms = get_terms('ctl-stories', array('hide_empty' => false,
        ) );
      }

    if (!empty($terms) || !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $ctl_terms_l[$term->slug] =$term->slug;
        }
    }


    if (isset($ctl_terms_l) && array_filter($ctl_terms_l) != null) {
        $category =json_encode($ctl_terms_l);
    } else {
        $category = json_encode(array('0' => 'No category'));
    }
    ?>
    <!-- TinyMCE Shortcode Plugin -->
<script type='text/javascript'>
   var ctl_cat_obj = {
        'category':'<?php echo $category; ?>'
    };
</script>
    <style type="text/css">
	.mce-container[aria-label="Add Cool Timeline Shortcode"],
    .mce-container[aria-label="Add Vertical Content Timeline Shortcode"],
    .mce-container[aria-label="Add Horizontal Content Timeline Shortcode"]
     {margin-top:38px;}
	.mce-container[aria-label="Add Cool Timeline Shortcode"], 
    .mce-container[aria-label="Add Horizontal Content Timeline Shortcode"],
    .mce-container[aria-label="Add Vertical Content Timeline Shortcode"]
     {max-height:100%;}
    .mce-container[aria-label="Add Vertical Content Timeline Shortcode"] .mce-reset,
    .mce-container[aria-label="Add Horizontal Content Timeline Shortcode"] .mce-reset
     {
    max-height: calc(100% - 58px);
    overflow-y: scroll;
    overflow-x: hidden;
	margin-top:50px;
        }
   .mce-container[aria-label="Add Cool Timeline Shortcode"] .mce-reset {
    max-height: calc(100% - 58px);
    overflow-y: scroll;
    overflow-x: hidden;
	margin-top:50px;
        }
	.mce-container[aria-label="Add Cool Timeline Shortcode"] 
    .mce-foot .mce-abs-layout, 
    .mce-container[aria-label="Add Vertical Content Timeline Shortcode"] .mce-foot .mce-abs-layout,
    .mce-container[aria-label="Add Horizontal Content Timeline Shortcode"] .mce-foot .mce-abs-layout {
    position: fixed;
    background: #ddd;
	top:0;
		}
    </style>
    <!-- TinyMCE Shortcode Plugin -->
    <?php
}

// instantiate the plugin class
 new CoolTimelinePro();

