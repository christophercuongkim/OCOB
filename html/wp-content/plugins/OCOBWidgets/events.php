<?php 
class Events extends WP_Widget
{
  function Events()
  {
    $widget_ops = array('classname' => 'Events', 'description' => 'NEW Displays Events' );
    $this->WP_Widget('Events', 'Events', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	if($title == '')
	{
		$title = 'Events';
	}
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
    //$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 	$title='Upcoming Events';
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
    $count = 0;
    function putStuff($pages,$count){
		foreach( $pages as $page ):
			//var_dump(get_post_meta($page->ID));
			if(strlen(get_post_meta($page->ID, 'custom_url', true)) > 1)
			{ $purl = get_post_meta($page->ID, 'custom_url', true); }else
			{ $purl = get_permalink( $page->ID );}
			
			if($count > 4){
				break;
			}
			$meta_date = get_post_meta($page->ID, 'event_date', true);
			if($meta_date == "false") {
				$time = "";	
			}
			else if($meta_date == ""){
				//$time = $page->post_date;
				//Don't run events without date
				continue;
			}else{
				$time = strtotime($meta_date);
				// If the event has already passed. (give or take 24 hours)
				//echo '<!-- '.$time.' - '.time().'+60*60*24 = '.($time - (time()+60*60*24)).'-->';
				if(time() > ($time+60*60*48))
				{
					continue;
				}
				$count++;
			}
			
			if(has_post_thumbnail($page->ID))
			{
				echo '<li class="img"><a href="'.$purl.'">'.get_the_post_thumbnail($page->ID).'</a></li>';	
			}else{
			// Note: text-transform removed at request. Keeps current caps rather than all caps
			echo '<li><h3>';
			echo '<a href="'.$purl.'">';
			echo $page->post_title.'</a></h3>';
			// This code will get the date form the page / post and display it. 
			//Removed by request, retained for future reuse if necessary.
	
			echo date("F j",$time); //"D, M jS, o"
			
			echo '</li>';
			}
		endforeach;
		return $count;
	}
    
	
	echo '<ul style="overflow:hidden;"  id="fixedheight">';
	$pages = array();
	//only on gradBusiness
	if(get_current_blog_id() == 11){
		$pages = get_posts(array( 'numberposts' => 10, 'category' => "4", 'orderby' => "meta_value", "meta_key" => "event_date", "order" => "ASC"));
		$count = putStuff($pages, 0);
	}
	switch_to_blog($cpto->news_blog_id);
	global $page;
	$pages = get_posts(array( 'numberposts' => 10, 'category' => $cpto->events_cat, 'orderby' => "meta_value", "meta_key" => "event_date", "order" => "ASC" ));
	putStuff($pages, $count);
	$count = 0;
	echo '</ul>';
	echo '<p><a class="linkArrow" href="'.home_url().'/category/events">More Events</a></p>';
	restore_current_blog();
	
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("Events");') );?>