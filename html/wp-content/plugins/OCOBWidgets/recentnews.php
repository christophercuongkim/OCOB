<?php
class RecentNews extends WP_Widget
{
  function RecentNews()
  {
    $widget_ops = array('classname' => 'RecentNews', 'description' => 'NEW Displays Recent News' );
    $this->WP_Widget('RecentNews', 'Recent News', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	if($title == '')
	{
		$title = 'Recent News';
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
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
	
	echo '<ul style="overflow:hidden;"  id="fixedheight">';
	switch_to_blog($cpto->news_blog_id);
	global $page;
	$pages = get_posts(array( 'numberposts' => 4,  'category' => $cpto->news_cat ));
	$count = 0;
	foreach( $pages as $page ):
		$meta_date = get_post_meta($page->ID, 'event_date', true);
		// Note: text-transform removed at request. Keeps current caps rather than all caps
		echo '<li><p>';
		if(get_field('url', $page->ID)) { ?>
			<a href="<?php the_field('url', $page->ID); ?>">
            <?php 
		} else {
			echo '<a href="'.get_permalink( $page->ID ).'">';
		}
		echo $page->post_title.'</a></p>';
		// This code will get the date form the page / post and display it. 
		//Removed by request, retained for future reuse if necessary.

		//echo date("F j",strtotime($time)); //"D, M jS, o"
		
		echo '</li>';
	endforeach;
	echo '</ul>';
	echo '<p><a class="linkArrow" href="'.home_url().'">More News</a></p>';
	restore_current_blog();
	
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("RecentNews");') );




//GRAD PROGRAMS



class OCOBNews
  {
	  public $meta_date;
	  public $url;
	  public $permalink;
	  public $title;
  }

class GraduateRecentNews extends WP_Widget
{
  function GraduateRecentNews()
  {
    $widget_ops = array('classname' => 'GraduateRecentNews', 'description' => 'NEW Displays Recent News for Graduate Programs' );
    $this->WP_Widget('GraduateRecentNews', 'Graduate Recent News', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	if($title == '')
	{
		$title = 'Recent News';
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
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
	
	echo '<ul style="overflow:hidden;"  id="fixedheight">';
	switch_to_blog($cpto->news_blog_id);
	global $page;
	$allNews = array();
	//news from News and Events sub blog
	$pages = get_posts(array( 'numberposts' => 4,  'category' => 8 ));
	$count = 0;
	foreach($pages as $page){
		$news = new OCOBNews();
		$news->meta_date = $page->post_date;
		$news->url = get_field('url', $page->ID);
		$news->permalink = get_permalink( $page->ID );
		$news->title = $page->post_title;
		array_push($allNews, $news);
	}
	restore_current_blog();
	//Grad Programs main site news
	$pages = get_posts(array( 'numberposts' => 4,  'category' => 21 ));
	$count = 0;
	foreach($pages as $page){
		$news = new OCOBNews();
		$news->meta_date = $page->post_date;
		$news->url = get_field('url', $page->ID);
		$news->permalink = get_permalink( $page->ID );
		$news->title = $page->post_title;
		array_push($allNews, $news);
	}
	$homeURL = get_permalink(1211);
	function cmp($a, $b)
	{
	    return strcmp($a->meta_date, $b->meta_date);
	}
	usort($allNews, "cmp");
	$fourNews = array_slice($allNews, 0,4);
	foreach( $fourNews as $news ):
		$meta_date = $news->meta_date;
		// Note: text-transform removed at request. Keeps current caps rather than all caps
		echo '<li><p>';
		if($news->url) { ?>
			<a href="<?php $news->url ?>">
            <?php 
		} else {
			echo '<a href="'.$news->permalink.'">';
		}
		echo $news->title.'</a></p>';
		// This code will get the date form the page / post and display it. 
		//Removed by request, retained for future reuse if necessary.

		//echo date("F j",strtotime($time)); //"D, M jS, o"
		
		echo '</li>';
	endforeach;
	echo '</ul>';
	echo '<p><a class="linkArrow" href="'.$homeURL.'">More News</a></p>';
	
	
// 	$gradProgramsPosts = get_posts(array( 'numberposts' => 4, 'category' => ));
	
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("GraduateRecentNews");') );

?>