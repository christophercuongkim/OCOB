<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array('name'=>'sidebar2',
	'before_widget' => '', 
	'after_widget' => '', 
	'before_title' => '<h2>', 
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'sidebar3',
	'before_widget' => '', 
	'after_widget' => '', 
	'before_title' => '<h2>', 
	'after_title' => '</h2>',
	));
}

function improved_trim_excerpt($text) { 
global $post; 
if ( '' == $text ) { 
$text = get_the_content(''); 
$text = strip_shortcodes( $text );
$text = apply_filters('the_content', $text); 
$text = str_replace(']]>', ']]&gt;', $text); 
$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
$text = strip_tags($text);
$excerpt_length = 25; 
$words = explode(' ', $text, $excerpt_length + 1); 
if (count($words)> $excerpt_length) { 
array_pop($words); 
array_push($words, '...'); 
$text = implode(' ', $words); 
} 
} 
return $text; 
}

function print_video_thumb_backward($post, &$thumb_url) {
	$video_id = get_post_meta($post->ID, 'vids', true);
	if (! empty($video_id)) {	
			$thumb_url = 'http://img.youtube.com/vi/' . $video_id . '/2.jpg';
			return 1;
	}
}



function print_video_thumb_supported_site($post,&$thumb_url) {
	$content = $post->post_content;
	if (preg_match(video_pattern(),$content, $match)) {
		// video found
		$content = $match[0];
		preg_match('/^\[(\w+)/',$content,$video_type);
		switch ($video_type[1]) {
			case 'youtube':
				preg_match('/v=(.*?)[\s&\[]/',$content,$video_id);
				$thumb_url = 'http://img.youtube.com/vi/' . $video_id[1] . '/2.jpg';
				return 1;
			case 'googlevideo':
				preg_match('/docid=(.*?)[\s&\[]/',$content,$docid);
				$url = 'http://video.google.com/videofeed?docid=' . $docid[1];
    		$data = get_url($url);
				preg_match("/media:thumbnail url=\"([^\"]\S*)\"/siU",$data,$t_url); 
				$thumb_url = $t_url[1]; 
				return 1;
			case 'vimeo':
				preg_match('/\/(\d+)\[/',$content,$docid);
				$url = 'http://vimeo.com/api/clip/' . $docid[1] . '.php';
				$data = get_url($url);
				/* Bypass Vimeo Api problem: http://www.vimeo.com/forums/topic:11826 */
				preg_match('/thumbnail_large"\;s:\d+:"(.*?)"/',$data,$t_url);
				// $thumb_url = $t_url[0]['thumbnail_large'];
				$thumb_url = $t_url[1];
				return 1;
			case 'flv':
				preg_match('/\](.*?)\[/',$content,$url);
				$thumb_url = preg_replace('/\.((flv)|(swf)|(f4v))$/','.jpg',$url[1],1);
				return 1;
			case 'quicktime':
				preg_match('/\](.*?)\[/',$content,$url);
				$thumb_url = preg_replace('/\.mov$/','.jpg',$url[1],1);
				return 1;
			case 'dailymotion':
				preg_match('/\](.*?)\[/',$content,$url);
				$data = get_url($url[1]);
				preg_match('/\.addVariable\("preview",\s*"(.*?)"\)/',$data,$t_url);
				$thumb_url = urldecode($t_url[1]);
				return 1;
			case 'veoh':
				preg_match('/\/watch\/([[:alnum:]]+)[\s&\[]/',$content,$docid);
				$url = 'http://www.veoh.com/rest/video/' . $docid[1] . '/details';
				$data = get_url($url);
				preg_match('/fullHighResImagePath="(.*?)"/', $data, $t_url);
				$thumb_url = $t_url[1];
				return 1;
			case 'viddler':
				preg_match('/id=([[:alnum:]]+)/',$content,$docid);
				$thumb_url = 'http://cdn-thumbs.viddler.com/thumbnail_2_' . $docid[1] . '.jpg';
				return 1;
			case 'metacafe':
				preg_match('/\/watch\/([0-9]+)\//',$content,$docid);
				$thumb_url = 'http://s4.mcstatic.com/thumb/' . $docid[1] . '.jpg';
				return 1;
			case 'blip':
				preg_match('/posts_id=([[:alnum:]]+)/',$content,$docid);
				$url = 'http://blip.tv/rss/flash/' . $docid[1];
				$data = get_url($url);
				preg_match('/<blip:smallThumbnail>(.*?)<\/blip:smallThumbnail>/', $data, $t_url);
				$thumb_url = $t_url[1];
				return 1;
			case 'flickrvideo':
				preg_match('/\](.*?)\[/',$content,$url);
				preg_match('/\/([0-9]+)\/?\[/',$content,$docid);
				$data = get_url($url[1]);
				preg_match('/\.video_thumb_src\s*=\s*\'(\S+)\';/',$data,$t_url);
				$thumb_url = $t_url[1];
				return 1;
			case 'spike':
				preg_match('/\/([0-9]+)\/?\[/',$content,$docid);
				$thumb_url = 'http://dyn.ifilm.com/resize/image/stills/films/resize/istd/' . $docid[1] . '.jpg?width=160';
				return 1;
		}
	}
}

function print_video_thumb_custom_field($post,&$thumb_url) {
	$t = get_post_meta($post->ID, 'video_thumb', true);
	if (! empty($t)) {
		$thumb_url = $t;
		return 1;
	}
}

function print_video_thumb_first_post_image($post,&$thumb_url) {
	$content = $post->post_content;
	if (preg_match('/<img[[:alnum:]\s-_=;:"\/]+src="(.*?)"/',$content, $match)) {
		$thumb_url = $match[1];
		return 1;
	}
}

function print_video_thumb_unsupported_site($post,&$thumb_url) {
	$content = $post->post_content;
	if (preg_match(video_pattern(),$content, $match)) {
		// video found
		$content = $match[0];
		preg_match('/^\[(\w+)/',$content,$video_type);
		switch ($video_type[1]) {
			case 'myspace':
				$thumb_url = get_template_directory_uri() . '/images/thumb_myspace.png';
				return 1;
		}
	}
}

function print_video_thumb($post) {
	print_video_thumb_backward($post,$thumb_url)
	 || print_video_thumb_custom_field($post,$thumb_url)
	 ||	print_video_thumb_supported_site($post,$thumb_url)
	 ||	print_video_thumb_first_post_image($post,$thumb_url)
	 || print_video_thumb_unsupported_site($post,$thumb_url);
	echo get_video_thumb(get_permalink($post->ID), $post->post_title,
					$thumb_url);
}

function get_video_thumb($url,$title,$img) {
	return '<a href="' . $url . '" title="' . $title . '"><img src="' .
		$img . '" alt="' . $title . '" width="130px" height="97px" /></a>';
}

function print_video($post) {
	// Backword compatibility with standard Videographer
	$video_id = get_post_meta($post->ID, 'vids', true);
	if (! empty($video_id)) {
			echo '<div class="vid">';
			wpyoutube('video', $video_id);
			echo '</div>';
			return;
	}
	$content = $post->post_content;
	if (preg_match(video_pattern(),$content, $match)) {
		// video found
		$content = $match[0];
		$content = apply_filters('the_content', $content);
		echo $content;
	}
}

function video_pattern() {
	$pattern = '/
		  (\[youtube(.*?)\[\/youtube\]) 					# YouTube video
		| (\[googlevideo(.*?)\[\/googlevideo\]) 	# Google video
		| (\[vimeo(.*?)\[\/vimeo\]) 							# Vimeo video
		| (\[flv(.*?)\[\/flv\])			 							# Flash video
		| (\[quicktime (.*?)\[\/quicktime \])			# Quicktime video
		| (\[dailymotion (.*?)\[\/dailymotion \])	# Quicktime video
		| (\[veoh (.*?)\[\/veoh \])								# Veoh video
		| (\[viddler\s+([[:alnum:]=&;]+)\])				# Viddler video
		| (\[metacafe (.*?)\[\/metacafe \])				# Veoh video
		| (\[blip\.tv\s+\?([[:alnum:]_=\-&;]+)\])	# Blip.tv video
		| (\[flickrvideo (.*?)\[\/flickrvideo \])	# Flickr Video video
		| (\[spike (.*?)\[\/spike \])							# Spike.com video
		| (\[myspace (.*?)\[\/myspace \])					# MySpace video
		/mx';
	return $pattern;
}

function get_the_content_video($more_link_text = null, $stripteaser = 0, $more_file = '')
{
  $content = get_the_content($more_link_text, $stripteaser, $more_file);
	// remove first video just show in print_video()
	$content = preg_replace(video_pattern(),'',$content,1);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function the_content_video($more_link_text = null, $stripteaser = 0, $more_file = '') {
	echo get_the_content_video($more_link_text, $stripteaser, $more_file);
}

function get_url($url) {
	$fp = fopen( $url, 'r' );
 	$data = "";
 	while( !feof( $fp ) ) {
 		$buffer = trim( fgets( $fp, 4096 ) );
 		$data .= $buffer;
 	}
	return $data;
}


remove_filter('the_excerpt', 'wpautop');
remove_filter('get_the_excerpt', 'wp_trim_excerpt'); 
add_filter('get_the_excerpt', 'improved_trim_excerpt'); 
?>
