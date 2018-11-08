<?php
/*
Plugin Name: OCOB Sidebar (styled)
Plugin URI: http://www.cob.calpoly.edu
Description: Add Global OCOB Academic Areas Menu widget
Version: 0.1
Author URI: http://www.cob.calpoly.edu
*/
 
 
class OcobSidebarWidget extends WP_Widget
{
  function OcobSidebarWidget()
  {
    $widget_ops = array('classname' => 'OcobSidebarWidget', 'description' => 'Displays a Sidebar (Styled)' );
    $this->WP_Widget('OcobSidebarWidget', 'Ocob Sidebar Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'content' => '' ) );
    $title = $instance['title'];
    $content = $instance['content'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('content'); ?>">Content: <textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" rows="15"><?php echo attribute_escape($content); ?></textarea></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['content'] = $new_instance['content'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
	global $cpto;
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $content = empty($instance['content']) ? ' ' : apply_filters('widget_title', $instance['content']);
 
    if (empty($title) || $title == " "){
		$title = "";
	}
    echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
    $content = str_replace("\n", "<br/>", $content);
	echo htmlspecialchars_decode($content);
	
	
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("OcobSidebarWidget");') );?>