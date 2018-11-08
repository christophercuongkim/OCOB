<?php 
class AcademicAreas extends WP_Widget
{
  function AcademicAreas()
  {
    $widget_ops = array('classname' => 'AcademicAreas', 'description' => 'NEW Displays Academic Areas' );
    $this->WP_Widget('AcademicAreas', 'Academic Areas', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
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
	global $cpto;
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (empty($title) || $title == " "){
		$title = "Academic Areas";
	}
    echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
    //echo "<h1>This is my new widget!</h1>";
	echo '
	<div class="menu-footer-nav-container">
		<ul id="menu-footer-nav" class="padded-menu">
		<li class="menu-item">
			<a href="http://www.cob.calpoly.edu/academic/accounting-and-law/">Accounting &amp; Law</a></li>
		<li class="menu-item">
			<a href="http://www.cob.calpoly.edu/academic/economics/">Economics</a></li>
		<li class="menu-item">
			<a href="http://www.cob.calpoly.edu/academic/finance/">Finance</a></li>
		<li class="menu-item">
			<a href="http://www.cob.calpoly.edu/academic/industrial-technology/">Industrial Technology</a></li>
		<li class="menu-item">
			<a href="http://www.cob.calpoly.edu/academic/management/">Management</a></li>
		<li class="menu-item">
			<a href="http://www.cob.calpoly.edu/academic/marketing/">Marketing</a></li>
		<li class="menu-item">
			<a href="http://www.cob.calpoly.edu/academic/entrepreneurship/">Entrepreneurship</a></li>
		</ul>
	</div>';
	
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("AcademicAreas");') );?>