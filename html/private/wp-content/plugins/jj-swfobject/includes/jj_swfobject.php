<?php

class JJ_SwfObject extends WP_Widget
{
  
  function JJ_SwfObject()
  {
    $widget_ops = array('classname' => 'jj-swfobject', 'description' => "Allows you to insert a swf file using a widget or a shortcode using the swfobject library.");
    $this->WP_Widget('jj-swfobject', 'JJ SwfObject', $widget_ops);
  }
  
  function widget($args, $instance)
  {
    global $wpdb;
    extract($args);

    // Set params
    $title = apply_filters('widget_title', $instance['title']);
    $html_id = $this->get_val($instance, 'html_id');
    $alt = $this->get_val($instance, 'alt', '', false);
    $path = $this->get_val($instance, 'path');
    $width = $this->get_val_numeric($instance, 'width');
    $height = $this->get_val_numeric($instance, 'height');
    $version = $this->get_val($instance, 'version', '9.0.0');
    $flashvars = $this->get_val($instance, 'flashvars', '{}', false);
    $params = $this->get_val($instance, 'params', '{}', false);
    $attributes = $this->get_val($instance, 'attributes', '{}', false);  
    $center = $this->get_val($instance, 'center'); 
    $shortcode = $this->get_val($instance, 'shortcode');
                      
    $container_class = '';
    if($center == '1')
    {
      $container_class = " swfobject_center";
    }
    $style_outer = '';
    $style_inner = '';               
    if($width != '')
    {
      $style_inner .= "width:" . $width . "px;";
    } 
    if($height != '')
    {
      $style_outer .= "height:" . $height . "px;overflow:hidden;";
      $style_inner .= "height:" . $height . "px;overflow:hidden;";        
    }
    if($style_outer != '')
    {
      $style_outer = " style=\"" . $style_outer . "\"";
    }
    if($style_inner != '')
    {
      $style_inner = " style=\"" . $style_inner . "\"";
    }    
    
    $express_install =  WPJJ_SWFOBJECT_plugin_url( 'swfobject/expressInstall.swf' );

    $output .= "\n      <div id=\"" . $html_id . "_container\" class=\"jj_swf_object_container" . $container_class . "\"" . $style_outer . ">";
    $output .= "\n        <div id=\"" . $html_id . "\" class=\"jj_swf_object_container_wrapper\"" . $style_inner . ">";
    if($alt != '')
    {
      $output .= "\n          " . $alt;
    }       
    $output .= "\n        </div>";
    $output .= "\n      </div>";
    
    $output .= "\n      <script type=\"text/javascript\">";
    $output .= "\n        swfobject.embedSWF(\"" . $path . "\", \"" . $html_id . "\", \"" . $width . "\", \"" . $height . "\", \"" .  $version  . "\", \"" . $express_install . "\", " . $flashvars . ", " . $params . ", " . $attributes . ");";
    $output .= "\n      </script>";
      
    if($shortcode != '1')
    {      
      echo $before_widget . "\n<ul class=\"ul_jj_swfobject\">\n    <li class=\"li_jj_swfobject\">" . $output . "\n    </li>\n  </ul>\n" . $after_widget;
    }
    else
    {
      echo $output;
    }
  }

  function get_val($instance, $key, $default = '', $escape = true)
  {
    $val = '';
    if(isset($instance[$key]))
    {
      $val = trim($instance[$key]);
    }
    if($val == '')
    {
      $val = $default;
    }
    if($escape)
    {
      $val = esc_attr($val);
    }
    return $val;
  }
  
  function get_val_numeric($instance, $key, $default = '')
  {
    $val = $this->get_val($instance, $key, $default, false);
    if($val != '' && !is_numeric($val))
    {
      $val = '';
    }
    return $val;
  }

  function form($instance)
  {
    global $wpdb;
    $instance = wp_parse_args((array) $instance, array(
      'title' => '',
      'html_id' => 'jj_swfobject',
      'alt' => '',
      'path' => '',
      'name' => '',
      'width' => '',
      'height' => '',
      'version' => '',
      'flashvars' => '',
      'params' => '',
      'attributes' => '',
      'center' => ''      
    ));
?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><strong>Widget title:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
  </p>   
  <p>
    <label for="<?php echo $this->get_field_id('html_id'); ?>"><strong>HTML id:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('html_id'); ?>" name="<?php echo $this->get_field_name('html_id'); ?>" value="<?php echo $instance['html_id']; ?>" class="widefat" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('alt'); ?>"><strong>Alternative Content:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('alt'); ?>" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $instance['alt']; ?>" class="widefat" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('path'); ?>"><strong>Path:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('path'); ?>" name="<?php echo $this->get_field_name('path'); ?>" value="<?php echo $instance['path']; ?>" class="widefat" />
  </p>      
  <p>
    <label for="<?php echo $this->get_field_id('width'); ?>"><strong>Width:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" size="3" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('height'); ?>"><strong>Height:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" size="3" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('version'); ?>"><strong>Version:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('version'); ?>" name="<?php echo $this->get_field_name('version'); ?>" value="<?php echo $instance['version']; ?>" size="3" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('flashvars'); ?>"><strong>Flashvars:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('flashvars'); ?>" name="<?php echo $this->get_field_name('flashvars'); ?>" value="<?php echo $instance['flashvars']; ?>" class="widefat" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('params'); ?>"><strong>Params:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('params'); ?>" name="<?php echo $this->get_field_name('params'); ?>" value="<?php echo $instance['params']; ?>" class="widefat" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('attributes'); ?>"><strong>Attributes:</strong></label><br />
    <input type="text" id="<?php echo $this->get_field_id('attributes'); ?>" name="<?php echo $this->get_field_name('attributes'); ?>" value="<?php echo $instance['attributes']; ?>" class="widefat" />
  </p>                    
  <p>
    <input type="checkbox" id="<?php echo $this->get_field_id('center'); ?>" style="vertical-align: middle;" name="<?php echo $this->get_field_name('center'); ?>" value="1"<?php if($instance['center'] == '1') { echo " checked=\"checked\""; } ?> />
    <label for="<?php echo $this->get_field_id('center'); ?>" style="vertical-align: middle;"><strong>Center content</strong></label><br />
  </p>  
<?php
  }

  function update($new_instance, $old_instance)
  {
    $new_instance['title'] = esc_attr($new_instance['title']);
    return $new_instance;
  }
}