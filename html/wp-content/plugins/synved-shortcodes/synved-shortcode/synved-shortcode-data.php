<?php

function synved_shortcode_data_get_display_item($atts, $type = null)
{
	$atts_def = array('id' => null, 'name' => null, 'slug' => null, 'title' => null, 'size' => null, 'email' => null, 'post_type' => null, 'taxonomy' => null, 'edit' => null, 'path' => null, 'scheme' => null, 'content' => null, 'tip' => null, 'abstract' => null, 'class' => null);
	$atts = shortcode_atts($atts_def, $atts);
	
	if ($type == null)
	{
		$type = 'post';
	}
	
	$id = $atts['id'];
	$name = $atts['name'];
	$slug = $atts['slug'];
	$title = $atts['title'];
	$size = $atts['size'];
	$email = $atts['email'];
	$post_type = $atts['post_type'];
	$taxonomy = $atts['taxonomy'];
	$edit = $atts['edit'];
	$path = $atts['path'];
	$scheme = $atts['scheme'];
	$pull_content = $atts['content'] == 'yes';
	$tip = $atts['tip'];
	$abstract = $atts['abstract'];
	$class = $atts['class'];

	if ($size != null)
	{
		$size_parts = explode('x', $size);
		$size_parts = array_map('intval', $size_parts);
		
		if (count($size_parts) > 1)
		{
			$size = $size_parts;
		}
		else if (is_numeric($size) && intval($size) > 0)
		{
			$size = array(intval($size), intval($size));
		}
	}
	
	$object = null;
	$item = array();
	
	switch ($type)
	{
		case 'post':
		case 'page':
		case 'media':
		{
			if ($post_type == null)
			{
				if ($type == 'media')
				{
					$post_type = 'attachment';
				}
			}
			else
			{
				$post_type = explode(',', $post_type);
				
				if (count($post_type) == 1)
				{
					$post_type = $post_type[0];
				}
			}
			
			if ($object == null && $id != null)
			{
				$object = get_post($id);
			}
		
			if ($name == null && $slug != null)
			{
				$name = $slug;
			}
			
			if ($object == null && $name != null)
			{
				$name_key = $type == 'page' ? 'pagename' : 'name';
				$posts = null;
				
				// Prioritize regular posts
				if ($type == 'post' && $post_type == null)
				{
					$posts = get_posts(array($name_key => $name, 'numberposts' => 1, 'post_type' => 'post'));
				}
				
				if ($post_type == null)
				{
					$post_type = get_post_types();
					
					unset($post_type['revision']);
					unset($post_type['nav_menu_item']);
				}
				
				if ($posts == null)
				{
					$posts = get_posts(array($name_key => $name, 'numberposts' => 1, 'post_type' => $post_type));
				}
				
				if ($posts != null)
				{
					$object = $posts[0];
				}
			}
			
			if ($object == null && $title != null)
			{
				if ($post_type == null)
				{
					$post_type = $type;
				}
				
				if (is_array($post_type))
				{
					global $wpdb;
					
					$post_type = array_values($post_type);
					$count = count($post_type);
					$params = array($title);
					$params = array_merge($params, $post_type);
					$db_query = 'SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type IN (' . str_repeat('%s,', $count - 1) . '%s)';
					$page = $wpdb->get_var($wpdb->prepare($db_query, $params));
					
					if ($page)
					{
						$object = get_page($page, OBJECT);
					}
				}
				else
				{
					$object = get_page_by_title($title, OBJECT, $post_type);
				}
			}
			
			if ($object != null)
			{
				$item['id'] = $object->ID;
				$item['title'] = apply_filters('the_title', $object->post_title, $object->ID);
				$item['link'] = apply_filters('the_permalink', get_permalink($object->ID), $object->ID);
				$item['tip'] = $item['title'];
				$item['abstract'] = apply_filters('the_excerpt', $object->post_excerpt, $object->ID);
				
				if ($pull_content)
				{
					$post_content = $object->post_content;
					$post_content = apply_filters('the_content', $object->post_content, $object->ID);
					$item['content'] = $post_content;
				}
				
				$thumb_id = $type == 'media' ? $object->ID : get_post_thumbnail_id($object->ID);
				
				if ($thumb_id != null)
				{
					if ($size == null)
					{
						$size = 'thumbnail';
					}
					
					$thumb = wp_get_attachment_image_src($thumb_id, $size);
					$alt = $item['title'];
					
					if ($thumb != null)
					{
						$item['thumbnail_src'] = $thumb[0];
						$item['thumbnail_width'] = $thumb[1];
						$item['thumbnail_height'] = $thumb[2];
						$item['thumbnail'] = '<img class="synved-shortcode-thumbnail" alt="' . esc_attr($alt) . '" src="' . esc_url($item['thumbnail_src']) . '" width="' . $item['thumbnail_width'] . '" height="' . $item['thumbnail_height'] . '" />';
					}
					
					$thumb = wp_get_attachment_image_src($thumb_id, 'full');
					
					if ($thumb != null)
					{
						$item['image_link'] = $thumb[0];
					}
				}
			}
			
			break;
		}
		case 'category':
		case 'tag':
		case 'term':
		{
			if ($taxonomy == null)
			{
				$taxonomy = $type == 'tag' ? 'post_tag' : $type;
			}
			
			if ($object == null && $id != null)
			{
				$object = get_term_by('id', $id, $taxonomy);
			}
		
			if ($object == null && $slug != null)
			{
				$object = get_term_by('slug', $slug, $taxonomy);
			}
		
			if ($name == null && $title != null)
			{
				$name = $title;
			}
		
			if ($object == null && $name != null)
			{
				$object = get_term_by('name', $name, $taxonomy);
			}
			
			if ($object != null)
			{
				$object = sanitize_term($object, $taxonomy);
				
				$item['id'] = $object->term_id;
				$item['title'] = $object->name;
				$item['link'] = get_term_link($object);
				$item['tip'] = $object->description;
				$item['abstract'] = $object->description;
			}
			
			break;
		}
		case 'user':
		{
			if ($object == null && $id != null)
			{
				$object = get_user_by('id', $id);
			}
		
			if ($object == null && $slug != null)
			{
				$object = get_user_by('slug', $slug);
			}
		
			if ($name == null && $title != null)
			{
				$name = $title;
			}
		
			if ($object == null && $name != null)
			{
				$object = get_user_by('login', $name);
			}
		
			if ($object == null && $email != null)
			{
				$object = get_user_by('email', $email);
			}
			
			if ($object != null)
			{
				$item['id'] = $object->ID;
				$item['title'] = $object->display_name;
				$item['link'] = get_author_posts_url($object->ID);
				$item['tip'] = null;
				$item['abstract'] = $object->user_description;
				
				if (is_array($size))
				{
					$size = (int) $size[0];
				}
				
				if ($size == null)
				{
					$size = (int) intval(get_option('thumbnail_size_w'));
				}
				
				$thumb = get_avatar($object->ID, $size);
				
				if ($thumb != null)
				{
					$match = null;
					preg_match('/src=("|\')(([^"\']|(?!\\1))+)\\1/i', $thumb, $match);
					
					$item['thumbnail_src'] = $match[2];
					$item['thumbnail_width'] = $size;
					$item['thumbnail_height'] = $size;
					$item['thumbnail'] = '<img class="synved-shortcode-thumbnail" src="' . esc_url($item['thumbnail_src']) . '" width="' . $item['thumbnail_width'] . '" height="' . $item['thumbnail_height'] . '" />';
				}
			}
			
			break;
		}
		case 'common':
		{
			if ($slug != null && $name == null)
			{
				$name = $slug;
			}
			
			$link = null;
			$func = $name . '_url';
			
			if (function_exists($func))
			{
				$link = $func($path, $scheme);					
			}
			else
			{
				$upload_dir = wp_upload_dir();
				
				switch ($name)
				{
					case 'upload':
					{
						$link = isset($upload_dir['url']) ? $upload_dir['url'] : '/';
					
						break;
					}
					case 'upload_base':
					{
						$link = isset($upload_dir['baseurl']) ? $upload_dir['baseurl'] : '/';
					
						break;
					}
					case 'template_base':
					{
						$link = get_template_directory_uri();
					
						break;
					}
					case 'stylesheet':
					{
						$link = get_stylesheet_uri();
					
						break;
					}
					case 'stylesheet_base':
					{
						$link = get_stylesheet_directory_uri();
					
						break;
					}
				}
			}
			
			if ($link != null)
			{
				$item['id'] = null;
				$item['title'] = ucwords(str_replace(array('_', '-'), ' ', $name));
				$item['link'] = $link;
				$item['tip'] = null;
				$item['abstract'] = null;
			}
			
			break;
		}
	}
	
	if ($item != null)
	{
		if ($edit != null)
		{
			$link = $item['link'];
			$edit_list = explode(',', $edit);
			
			if ($edit_list != null)
			{
				foreach ($edit_list as $edit_item)
				{
					$edit_item = trim($edit_item);
					$edit_parts = explode('=', $edit_item);
					$edit_name = $edit_parts[0];
					$edit_value = isset($edit_parts[1]) ? $edit_parts[1] : null;
				
					if ($edit_name[0] == '-')
					{
						$edit_name = substr($edit_name, 1);
						$link = remove_query_arg($edit_name, $link);
					}
					else
					{
						if ($edit_name[0] == '+')
						{
							$edit_name = substr($edit_name, 1);
						}
					
						$link = add_query_arg($edit_name, $edit_value, $link);
					}
				}
			}
			
			$item['link'] = $link;
		}
		
		if ($tip !== null)
		{
			$item['tip'] = $tip;
		}
		
		if ($abstract !== null)
		{
			$item['abstract'] = $abstract;
		}
		
		$item['class'] = $class;
		
		if ($object != null)
		{
			$item['object'] = $object;
		}
		
		$item['query'] = $atts;
		
		return apply_filters('synved_shortcode_data_get_display_item', $item);
	}
	
	return null;
}

?>
