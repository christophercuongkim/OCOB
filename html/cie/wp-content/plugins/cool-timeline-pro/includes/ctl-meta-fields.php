<?php 

         /*
            Creating Meta boxes for timeline stories section
         */

       function clt_meta_boxes() {
            /*
             * configure your meta box
             */
            $config = array(
                'id' => 'demo_meta_box', // meta box id, unique per meta box 
                'title' => __('Timeline story settings', 'cool-timeline'), // meta box title
                'pages' => array('cool_timeline'), // post types, accept custom post types as well, default is array('post'); optional
                'context' => 'normal', // where the meta box appear: normal (default), advanced, side; optional
                'priority' => 'high', // order of meta box: high (default), low; optional
                'fields' => array(), // list of meta fields (can be added by field arrays) or using the class's functions
                'local_images' => false, // Use local or hosted images (meta box images for add/remove)
                'use_with_theme' => false            //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
            );
            
            for ($i = 1000; $i <= 2050; $i++) {
                $story_year_list[$i] = $i;
            }
            /*
             * Initiate your meta box
             */
            $my_meta = new AT_Meta_Box($config);

            /*
             * Add fields to your meta box
             */
             $my_meta->addRadio('story_based_on', array('default' => __('Date Based', 'cool-timeline'), 'custom' => 
                __('Custom Order Based', 'cool-timeline')), array('name' => __('Story Based On', 'cool-timeline'), 
                'class'=>'story_based_on',

                'std' => array('default')));
                
            $my_meta->addSelect('ctl_story_year', $story_year_list, array('name' =>__('Story Year  <span class="ctl_required">*</span>', 'apc'), 'desc' =>__('<p class="ctl_required">Please select story year.</p>', 'apc'), 
                'class'=>'date_based',
                'std' => array(date('Y'))
                ));
           
            $my_meta->addDate('ctl_story_date', array('name' =>__('Story Date / Year <span class="ctl_required">*</span>','cool-timeline'), 'desc' =>__('<p class="ctl_required">Please select story Story Date / Year / Time using datepicker only. <strong>Date Format( mm/dd/yy hh:mm )</strong></p>','cool-timeline'),
             'std' => date('m/d/Y h:m a'),
             'format' =>__('d MM yy','cool-timeline'),
                 'class'=>'date_based'
                ));
            
           $my_meta->addText('ctl_story_lbl',array('name'=>__('Add custom label','cool-timeline'),
                'desc' =>__(' ','cool-timeline'),
                'class'=>'custom_based'
                )); 
           $my_meta->addText('ctl_story_lbl_2',array('name'=>__('Add second custom label','cool-timeline'),
                'class'=>'custom_based',
                'desc' =>__('','cool-timeline'))); 

           $my_meta->addText('ctl_story_order',array('name' =>__('Order<span class="ctl_required">*</span>', 'cool-timeline'), 
                'desc' =>__('<p class="ctl_required">Please enter story Order.</p>', 'cool-timeline'),
               'class'=>'custom_based',
                ));

             //radio field
            $my_meta->addRadio('story_format', array('default' => __('Default(Image)', 'cool-timeline'), 'video' => __('Video', 'cool-timeline'), 'slideshow' => __('Slideshow', 'cool-timeline')), array('name' => __('Story Format', 'cool-timeline'), 
                'class'=>'story_format',
                'std' => array('default')));

            /*
             * To Create a reapeater Block first create an array of fields
             * use the same functions as above but add true as a last param
             */

            $repeater_fields[] = $my_meta->addImage('ctl_slide', array('name' => __('Slide', 'cool-timeline')), true);
              
            /*
             * Then just add the fields to the repeater block
             */
            //repeater block
            $my_meta->addRepeaterBlock('re_', array('inline' => true, 'name' => __('Add slideshow slides', 'cool-timeline'),
                  'class'=>'story_format_slideshow',
             'fields' => $repeater_fields));

            /*
             * Don't Forget to Close up the meta box declaration
             */

            $my_meta->addTextarea('ctl_video', array('name' => __('Add Youtube video url e.g <small>https://www.youtube.com/watch?v=PLHo6uyICVk</small>', 'cool-timeline'),'class'=>'story_format_video'));

            $my_meta->addRadio('img_cont_size', array('full' => __('Full', 'cool-timeline'), 'small' => __('Small', 'cool-timeline')), array('name' => __('Story image size', 'cool-timeline'),
                'class'=>'story_format_image',
             'std' => array('full')));
            
            $my_meta->addText('story_custom_link',array('name'=>__('Story custom link','cool-timeline'),
                'desc' =>__('','cool-timeline'))); 
             //Color field
            $my_meta->addColor('ctl_story_color',array('name'=>__('Story Color','cool-timeline')));
            //Finish Meta Box Deceleration
        
         $my_meta->addCheckbox('use_img_icon',array('name'=>'Use Image Icon instead of font awesome icons'));
         $my_meta->addImage('story_img_icon',array('name'=>'Select Image Icon'));
           
            $my_meta->Finish();
        }

        ?>