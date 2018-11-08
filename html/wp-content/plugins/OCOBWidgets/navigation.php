<?php
class Navigation extends WP_Widget
{
  function Navigation()
  {
    $widget_ops = array('classname' => 'Navigation', 'description' => 'NEW Navigation' );
    $this->WP_Widget('Navigation', 'Navigation widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
    if($title == '')
	{
		$title = 'Navigation';
	}
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
    name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
  //cpto is in the function.php in the theme folder
	global $cpto;
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
       //Make these changes in functions.php
	     switch_to_blog($cpto->root_blog_id);
       wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'padded-menu'));
       ?>
       <style>.menu-footer-nav-container ul li a{display:initial;}</style>
       <?php
       restore_current_blog();
	
	
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("Navigation");') );?>