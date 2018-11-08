<?php

class textWid{
	public $name;
	public $description;
	public $text;
}


$textWidgetsText = array();

$wid1 = new textWid();
$wid1->name = "Magazine";
$wid1->description = "Magazine Widget";
$wid1->text = '<a href="http://www.cob.calpoly.edu/givingedition"><img class="widgetHead" src="http://www.cob.calpoly.edu/wp-content/blogs.dir/1/files/2015/11/download_asset-5.jpg" alt="sample image snippet" width="176" height="180" /></a><p><a class="linkArrow" href="http://www.cob.calpoly.edu/ocobcareerfairs ">Learn More</a></p>';
array_push($textWidgetsText, $wid1);

foreach($textWidgetsText as $widget){
	$name = $widget->name;
	$description = $widget->description;
	$text = $widget->text;
	$evalText = '
		class '.$name.' extends WP_Widget
		{
		  function '.$name.'()
		  {
		    $widget_ops = array("classname" => "'.$name.'", "description" => "'.$description.'" );
		    $this->WP_Widget("$name", "$name", $widget_ops);
		  }
		 
		  function form($instance)
		  {
		    $instance = wp_parse_args( (array) $instance, array( "title" => "") );
		    $title = $instance["title"];
		?>
		  <p><label for="<?php echo $this->get_field_id("title"); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
		  }
		 
		  function update($new_instance, $old_instance)
		  {
		    $instance = $old_instance;
		    $instance["title"] = $new_instance["title"];
		    return $instance;
		  }
		 
		  function widget($args, $instance)
		  {
			global $cpto;
		    extract($args, EXTR_SKIP);
		 
		    echo $before_widget;
		    $title = empty($instance["title"]) ? " " : apply_filters("widget_title", $instance["title"]);
		 
		    if (empty($title) || $title == " "){
				$title = "'.$name.'";
			}
		    echo $before_title . $title . $after_title;;
		 
		    // WIDGET CODE GOES HERE
		    //echo "<h1>This is my new widget!</h1>";
			echo "'.$text.'";
			
		    echo $after_widget;
		  }
		 
		}
		add_action( "widgets_init", create_function("", "return register_widget(\''.$name.'\');") );';
	//eval($evalText);
}
	
?>