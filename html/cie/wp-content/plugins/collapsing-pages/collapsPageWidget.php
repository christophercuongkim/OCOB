<?php 
class collapsPageWidget extends WP_Widget {
  function __construct() {
    $widget_ops = array('classname' => 'widget_collapspage', 'description' =>
    'Collapsible page listing' );
		$control_ops = array (
			'width' => '500', 
			'height' => '400'
			);
    $this->WP_Widget('collapspage', 'Collapsing Pages', $widget_ops,
    $control_ops);
  }
 
  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    $thetitle = apply_filters('widget_title', $instance['title']);
    $expandWidget=$instance['expandWidget'];
    $instance['number'] = $this->get_field_id('top');
    $instance['number'] = preg_replace('/[a-zA-Z-]/', '', $instance['number']);
    if ($expandWidget) {
      $animate=$instance['animate'];
      $expand=$instance['expand'];
      include('symbols.php'); 
      $title ="<span class='collapsing pages collapse' " . 
          "onclick='expandCollapse(event, \"$expandSymJS\", \"$collapseSymJS\", $animate, ".
          "\"collapsing pages\"); return false'>" .
          "<span class='sym'>$collapseSym</span>".
      $thetitle . "</span>"; 
    } else {
      $title=$thetitle;
    }
        
    echo $before_widget;
    if (!empty($title))
      echo $before_title . $title . $after_title;
    echo "<ul id='" . $this->get_field_id('top') .
    	  "' class='collapsing pages list'>\n";
    if( function_exists('collapsPage') ) {
      collapsPage($instance);
    } else {
      wp_list_pages();
    }
    echo "</ul>\n";

    echo $after_widget;
  }

 
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    include('updateOptions.php');
    return $instance;
  }
 
  function form($instance) {
    include('defaults.php');
    include('collapsPageStyles.php');
    $options=wp_parse_args($instance, $defaults);
    extract($options);
?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
    include('collapsPageOptions.php');
  }
}
function registerCollapsPageWidget() {
  register_widget('collapsPageWidget');
}
	add_action('widgets_init', 'registerCollapsPageWidget');
