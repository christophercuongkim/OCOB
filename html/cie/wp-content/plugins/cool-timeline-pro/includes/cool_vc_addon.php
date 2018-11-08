<?php
if (!class_exists('CoolVCAddon')) {

    class CoolVCAddon
    {
        /**
         * The Constructor
         */
        public function __construct()
        {
            // We safely integrate with VC with this hook
            add_action( 'init', array($this, 'ctl_vc_addon' ) );
        }

        function ctl_vc_addon(){
            if (  defined( 'WPB_VC_VERSION' ) ) {

                $terms = get_terms(array(
                    'taxonomy' => 'ctl-stories',
                    'hide_empty' => false,
                ));
                $ctl_terms_l=array();
                $ctl_terms_l['All Categories']=0;

                if (!empty($terms) || !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $ctl_terms_l[$term->name] =$term->slug ;
                    }
                }
               $date_formats= array(
                    __( "Default",'cool-timeline' ) => "default",
                    __( "F j",'cool-timeline' ) => "F j",
                    __( "F j Y",'cool-timeline') => "F j Y",
                    __( "Y-m-d",'cool-timeline' ) => "Y-m-d",
                    __( "m/d/Y",'cool-timeline') => "m/d/Y",
                    __( "d/m/Y",'cool-timeline') => "d/m/Y",
                    __( "F j Y g:i A",'cool-timeline') => "F j Y g:i A",
                    __( "Y",'cool-timeline') => "Y",
                     __( "Custom",'cool-timeline') => "custom",
                    );
                    $designs=  array(
                                __( "Default",'cool-timeline' ) => "default",
                                __( "Flat Design",'cool-timeline') => "design-2",
                                __( "Classic Design",'cool-timeline') => "design-3",
                                __( "Elegant Design",'cool-timeline') => "design-4",
                                __( "Clean Design",'cool-timeline') => "design-5",
                                 __( "Modern Design",'cool-timeline') => "design-6"
                            );

              $animation_effects=array(
                                __( "bounceInUp",'cool-timeline' ) => "bounceInUp",
                                __( "bounceInDown",'cool-timeline') => "bounceInDown",
                                __( "bounceInLeft",'cool-timeline' ) => "bounceInLeft",
                                __( "bounceInRight",'cool-timeline' ) => "bounceInRight",
                                __( "slideInDown",'cool-timeline') => "slideInDown",
                                __( "slideInUp",'cool-timeline' ) => "slideInUp",
                                __( "slideInLeft",'cool-timeline') => "slideInLeft",
                                __( "slideInRight",'cool-timeline' ) => "slideInRight",
                                __( "shake",'cool-timeline') => "shake",
                                __( "wobble",'cool-timeline' ) => "wobble",
                                __( "swing",'cool-timeline') => "swing",
                                __( "jello",'cool-timeline' ) => "jello",
                                __( "flip",'cool-timeline') => "flip",
                                __( "fadein",'cool-timeline') => "fadein",
                                __( "rotatein",'cool-timeline') => "rotatein",
                                __( "None",'cool-timeline' ) => "none",
                            );
                vc_map(array(
                    "name" => __("Cool Timeline Default", 'cool-timeline'),
                    "description" => __("Create Stories Timeline", 'cool-timeline'),
                    "base" => "cool-timeline",
                    "class" => "",
                    "controls" => "full",
                     "icon" => plugins_url('../images/timeline-icon2-32x32.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "cool-timeline_my_class"
                    "category" => __('Cool Timeline', 'cool-timeline'),
                    //'admin_enqueue_js' => array(plugins_url('assets/cool-timeline.js', __FILE__)), // This will load js file in the VC backend editor
                    //'admin_enqueue_css' => array(plugins_url('assets/cool-timeline_admin.css', __FILE__)), // This will load css file in the VC backend editor
                    "params" => array(
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Select Stories Category",'cool-timeline'),
                            "param_name" => "category",
                            "value" =>$ctl_terms_l,
                            "description" => __( "Create Category Specific Timeline (By Default - All Categories)",'cool-timeline' ),

                            'save_always' => true,
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Timeline Type",'cool-timeline'),
                            "param_name" => "type",
                            "value" => array(
                                __( "Vertical Timeline (Default)",'cool-timeline' ) => "default",
                                __( "Horizontal Timeline",'cool-timeline') => "horizontal"

                            ),
                            "description" => __('','cool-timeline' ),
                            'save_always' => true,
                        ),

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Vertical Timeline Layout",'cool-timeline'),
                            "param_name" => "layout",
                            "value" => array(
                                __( "Vertical Both side",'cool-timeline' ) => "default",
                                __( "Vertical one sided",'cool-timeline') => "one-side",
                                  __( "Compact Layout",'cool-timeline') => "compact",
                              ),
                            'save_always' => true,
                            "description" => __( "Select your timeline layout ",'cool-timeline' ),
                            "dependency" => array("element" => "type", "value" => array("default"))

                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Timeline Designs",'cool-timeline'),
                            "param_name" => "designs",
                            "value" =>  $designs,
                            'save_always' => true,
                            "description" => __( 'Choose Timeline Designs (Check Vertical Designs & Horizontal Designs )
                       <br><a target="_blank" href="http://www.cooltimeline.com/cool-timeline-pro-vertical-designs">Vertical Timeline demos</a>
                          |   <a target="_blank" href="http://www.cooltimeline.com/horizontal-timeline-designs-demos">Horizontal Timeline demos</a>','cool-timeline' ),
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Display Stories Blocks/Columns",'cool-timeline'),
                            "param_name" => "items",
                            "value" => array(
                                __( "Select number of items",'cool-timeline' ) => "",
                                __(1,'cool-timeline') => 1,
                                __(2,'cool-timeline') => 2,
                                __(3,'cool-timeline') =>3,
                                __(4,'cool-timeline') => 4
                            ),
                            "description" =>   __('*This Options Is Not For Default Design. (<a href="http://www.cooltimeline.com/horizontal-timeline-flat-design">Horizontal Timeline</a>','cool-timeline'),
                            'save_always' => true,
                            "description" => __( "This options is not for default desgin.",'cool-timeline' ),
                            "dependency" => array("element" => "type", "value" => array("content-timeline","horizontal"))
                        ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Autoplay Stories settings ?",'cool-timeline'),
                            "param_name" => "autoplay",
                            "value" => array(
                            __("False",'cool-timeline') =>'false',
                             __("True",'cool-timeline') =>'true',
                           ),
                           'save_always' => true,
                           "dependency" => array("element" => "type", "value" => array("content-timeline","horizontal"))
                        ),
                          array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Timeline Starting from Story e.g(2)", 'cool-timeline'),
                            "param_name" => "start-on",
                            "value" => __(0,'cool-timeline'),
                            'save_always' => true,
                            "description" => __("", 'cool-timeline'),
                             "dependency" => array("element" => "type", "value" => array("content-timeline","horizontal"))

                        ),
                
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Timeline skin",'cool-timeline'),
                            "param_name" => "skin",
                            "value" => array(
                                __( "Default",'cool-timeline' ) => "default",
                                __( "Light",'cool-timeline') => "light",
                                __( "dark",'cool-timeline') => "dark",
                            ),
                            "description" => __( "Create Light, Dark or Colorful Timeline",'cool-timeline' ),
                            'save_always' => true,
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Timeline Based On",'cool-timeline'),
                            "param_name" => "based",
                            "value" => array(
                                __( "Default (Date Based)",'cool-timeline' ) => "default",
                                __( "Custom Order Number",'cool-timeline') => "custom",
                            ),
                            "description" => __( "Show either date or custom label/text along with timeline stories.",'cool-timeline' ),
                            'save_always' => true,
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Order",'cool-timeline'),
                            "param_name" => "order",
                            "value" => array(
                                __( "DESC",'cool-timeline' ) => "DESC",
                                __( "ASC",'cool-timeline') => "ASC",
                            ),
                            "description" => __( "Timeline Stories order like:- DESC(2017-1900) , ASC(1900-2017)",'cool-timeline' ),
                            'save_always' => true,
                        ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Date Formats",'cool-timeline'),
                            "param_name" => "date-format",
                            "value" =>$date_formats,
                            "description" => __( "Timeline Stories dates custom formats",'cool-timeline' ),
                            'save_always' => true,
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Show number of Stories", 'cool-timeline'),
                            "param_name" => "show-posts",
                            "value" => __(20,'cool-timeline'),
                            'save_always' => true,
                            "description" => __("You Can Show Pagination After These Posts In Vertical Timeline.", 'cool-timeline')

                        ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Story Content",'cool-timeline'),
                            "param_name" => "story-content",
                            "value" => array(
                                __( "Summary",'cool-timeline' ) => "short",
                                __( "Full Text",'cool-timeline') => "full"

                            ),
                            "description" => __('','cool-timeline' ),
                            'save_always' => true,
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Icons",'cool-timeline'),
                            "param_name" => "icons",
                            "value" => array(
                                __( "YES",'cool-timeline' ) => "YES",
                                __( "NO",'cool-timeline') => "NO",
                            ),
                            "description" => __( "Display Icons In Timeline Stories. By default Is Dot.",'cool-timeline' ),
                            'save_always' => true,
                        ),

                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Compact Layout Date&Title positon",'cool-timeline'),
                            "param_name" => "compact-ele-pos",
                            "value" => array(
                                __( "On top date/label below title",'cool-timeline' ) => "main-date",
                                __( "On top title below date/label",'cool-timeline') => "main-title",
                            ),
                            "description" => __( "",'cool-timeline' ),
                            'save_always' => true,
                        ),
                          array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Pagination ?",'cool-timeline'),
                            "param_name" => "pagination",
                            "value" => array(
                                __( "Default",'cool-timeline' ) => "default",
                                __( "Ajax Load More",'cool-timeline') => "ajax_load_more"
                              ),
                            'save_always' => true,
                              "description" => __( "",'cool-timeline' ),
                            "dependency" => array("element" => "type", "value" => array("default"))

                        ),
                          array(
                            "type" => "dropdown",
                            "class" => "",
                             "heading" => __( "Enable category filters ?",'cool-timeline'),
                            "param_name" => "filters",
                            "value" => array(
                                 __( "No",'cool-timeline' ) => "no",
                                __( "Yes",'cool-timeline') => "yes"
                              ),
                            'save_always' => true,
                          //   "description" => __( " ",'cool-timeline' ),
                            "dependency" => array("element" => "type", "value" => array("default")

                                ),
                             ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Animations Effect",'cool-timeline'),
                            "param_name" => "animations",
                            "value" =>$animation_effects,
                            "description" => __( "Add Animations Effect Inside Timeline. You Can Check Effects Demo From <a  target='_blank' href='https://daneden.github.io/animate.css/'>Animate.css</a>.",'cool-timeline' ),
                            'save_always' => true,
                            "dependency" => array("element" => "type", "value" => array("default"))
                        )

                    )
                ));

                /*
                 * content timeline shortcode
                 */

                vc_map(array(
                    "name" => __("Cool Content Timeline", 'cool-timeline'),
                    "description" => __("Create Blog Posts Timeline", 'cool-timeline'),
                    "base" => "cool-content-timeline",
                    "class" => "",
                    "controls" => "full",
                    "icon" => plugins_url('../images/timeline-icon2-32x32.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "cool-timeline_my_class"
                    "category" => __('Cool Timeline', 'js_composer'),
                    //'admin_enqueue_js' => array(plugins_url('assets/cool-timeline.js', __FILE__)), // This will load js file in the VC backend editor
                    //'admin_enqueue_css' => array(plugins_url('assets/cool-timeline_admin.css', __FILE__)), // This will load css file in the VC backend editor
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Content Post type", 'cool-timeline'),
                            "param_name" => "post-type",
                            "value" => __("post", 'cool-timeline'),
                            "description" => __('Don\'t Change This If You Are Creating Blog Posts Timeline or Define Content Type Of Your Timeline Like:- Posts', 'cool-timeline'),
                            'save_always' => true,

                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Taxonomy Name ", 'cool-timeline'),
                            "param_name" => "taxonomy",
                            "value" => __("category", 'cool-timeline'),
                            "description" => __("Don't Change This If You Are Creating Blog Posts Timeline or Define Content Type Taxonomy.", 'cool-timeline'),
                            'save_always' => true

                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Category Specific Timeline (Add category(s) slug - comma separated)", 'cool-timeline'),
                            "param_name" => "post-category",
                            "value" => __("", 'cool-timeline'),
                            'save_always' => true,
                            "description" => __("Show Category Specific Blog Posts. Like For cooltimeline.com/category/fb-history/ it will be <b>fb-history</b>", 'cool-timeline')

                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Tag Specific Timeline (Add Category Slug)", 'cool-timeline'),
                            "param_name" => "tags",
                            "value" => __("", 'cool-timeline'),
                            'save_always' => true,
                            "description" => __("Show Tag Specific Blog Posts. Like For cooltimeline.com/tag/fb-history/ it will be <b>fb-history</b>.", 'cool-timeline')

                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Timeline Layout",'cool-timeline'),
                            "param_name" => "layout",
                            "value" => array(
                                __( "Default Layout (Vertical Both side)",'cool-timeline' ) => "default",
                                __( "One Side Layout (Vertical one sided)",'cool-timeline') => "one-side",
                                 __( "Compact Layout",'cool-timeline') => "compact",
                                __( "Horizontal Layout",'cool-timeline') => "horizontal",
                            ),
                            'save_always' => true,
                            "description" => __( "Select your timeline layout ",'cool-timeline' )


                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Timeline Designs",'cool-timeline'),
                            "param_name" => "designs",
                            "value" => $designs,
                            'save_always' => true,
                            "description" => __( 'Choose Timeline Designs (Check Vertical Designs & Horizontal Designs )
                       <br><a target="_blank" href="http://www.cooltimeline.com/cool-timeline-pro-vertical-designs">Vertical Timeline demos</a>
                          |   <a target="_blank" href="http://www.cooltimeline.com/horizontal-timeline-designs-demos">Horizontal Timeline demos</a>','cool-timeline' ),
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Display Stories Blocks/Columns",'cool-timeline'),
                            "param_name" => "items",
                            "value" => array(
                                __( "Select no of items",'cool-timeline' ) => "",
                                __(1,'cool-timeline') => 1,
                                __(2,'cool-timeline') => 2,
                                __(3,'cool-timeline') =>3,
                                __(4,'cool-timeline') => 4
                            ),
                            "description" =>   __( "Horizontal Layout (This option only for content timeline)",'cool-timeline'),
                            'save_always' => true,
                            "description" => __( "*This Options Is Not For Default Design. (Check Demo Here)",'cool-timeline' ),
                            "dependency" => array("element" => "layout", "value" => array("horizontal"))
                        ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Autoplay Stories settings ?",'cool-timeline'),
                            "param_name" => "autoplay",
                            "value" => array(
                            __("False",'cool-timeline') =>'false',
                             __("True",'cool-timeline') =>'true',
                           ),
                           'save_always' => true,
                           "dependency" => array("element" => "layout", "value" => array("horizontal"))
                        ),
                         array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Timeline Starting From Story e.g(2)", 'cool-timeline'),
                            "param_name" => "start-on",
                            "value" => __(0,'cool-timeline'),
                            'save_always' => true,
                            "description" => __("", 'cool-timeline'),
                            "dependency" => array("element" => "layout", "value" => array("horizontal"))
                             ),

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Timeline skin",'cool-timeline'),
                            "param_name" => "skin",
                            "value" => array(
                                __( "Default",'cool-timeline' ) => "default",
                                __( "Light",'cool-timeline') => "light",
                                __( "dark",'cool-timeline') => "dark",
                            ),
                            "description" => __( "Create Light, Dark or Colorful Timeline.",'cool-timeline' ),
                            'save_always' => true,
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Order",'cool-timeline'),
                            "param_name" => "order",
                            "value" => array(
                                __( "DESC",'cool-timeline' ) => "DESC",
                                __( "ASC",'cool-timeline') => "ASC",
                            ),
                            "description" => __( "Timeline Stories order like:- DESC(2017-1900) , ASC(1900-2017)",'cool-timeline' ),
                            'save_always' => true,
                        ),
                          array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Date Formats",'cool-timeline'),
                            "param_name" => "date-format",
                            "value" =>$date_formats,
                            "description" => __( "Timeline Stories dates custom formats",'cool-timeline' ),
                            'save_always' => true,
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Show number of posts", 'cool-timeline'),
                            "param_name" => "show-posts",
                            "value" => __(20,'cool-timeline'),
                            'save_always' => true,
                            "description" => __("You Can Show Pagination After These Posts In Vertical Timeline.", 'cool-timeline')

                        ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Story Content",'cool-timeline'),
                            "param_name" => "story-content",
                            "value" => array(
                                __( "Summary",'cool-timeline' ) => "short",
                                __( "Full Text",'cool-timeline') => "full"

                            ),
                            "description" => __('','cool-timeline' ),
                            'save_always' => true,
                        ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Pagination ?",'cool-timeline'),
                            "param_name" => "pagination",
                            "value" => array(
                                __( "Default",'cool-timeline' ) => "default",
                                __( "Ajax Load More",'cool-timeline') => "ajax_load_more"
                              ),
                            'save_always' => true,
                             "description" => __( "Note:-Ajax Load More Is Not Available For Horizontal layout.",'cool-timeline' ),
                            "dependency" => array("element" => "layout", "value" => array("default","one-side","compact")

                                ),
                             ),
                         array(
                            "type" => "dropdown",
                            "class" => "",
                             "heading" => __( "Enable category filters ?",'cool-timeline'),
                            "param_name" => "filters",
                            "value" => array(
                                 __( "No",'cool-timeline' ) => "no",
                                __( "Yes",'cool-timeline') => "yes"
                              ),
                            'save_always' => true,
                             "description" => __( "Note:-Please add value in Taxonomy field before using it.",'cool-timeline' ),
                            "dependency" => array("element" => "layout", "value" => array("default","one-side","compact")

                                ),
                             ),
                         
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Icons",'cool-timeline'),
                            "param_name" => "icons",
                            "value" => array(
                                __( "YES",'cool-timeline' ) => "YES",
                                __( "NO",'cool-timeline') => "NO",
                            ),
                            "description" => __( "Display Icons In Timeline Stories. By default Is Dot.",'cool-timeline' ),
                            'save_always' => true,
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => __( "Animations Effect",'cool-timeline'),
                            "param_name" => "animations",
                            "value" =>$animation_effects,
                            "description" => __( "Add Animations Effect Inside Timeline. You Can Check Effects Demo From <a  target='_blank' href='https://daneden.github.io/animate.css/'>Animate.css</a>.",'cool-timeline' ),
                            'save_always' => true,
                         //   "dependency" => array("element" => "type", "value" => array("default"))
                          )

                    )
                ));


            }
        }
    }
}