<?php

class SynvedObjectArrayWrapper implements ArrayAccess
{
	private $_input;
	
	
	public function __construct($input)
	{
		$this->_input = $input;
	}
	
	public function offsetExists ($offset)
	{
		if (is_object($this->_input))
		{
			return isset($this->_input->$offset);
		}
		
		if (is_array($this->_input))
		{
			return isset($this->_input[$offset]);
		}
		
		return false;
	}
	
	public function offsetGet ($offset)
	{
		if ($this->offsetExists($offset))
		{
			if (is_object($this->_input))
			{
				return $this->_input->$offset;
			}
		
			if (is_array($this->_input))
			{
				return $this->_input[$offset];
			}
		}
		
		return null;
	}
	
	public function offsetSet ($offset, $value)
	{
		if (is_object($this->_input))
		{
			$this->_input->$offset = $value;
		}
		
		if (is_array($this->_input))
		{
			$this->_input[$offset] = $value;
		}
	}
	
	public function offsetUnset ($offset)
	{
		if (is_object($this->_input))
		{
			unset($this->_input->$offset);
		}
		
		if (is_array($this->_input))
		{
			unset($this->_input[$offset]);
		}
	}
}


function synved_shortcode_item_name_sanitize($name)
{
	return str_replace(array('-'), '_', $name);
}

function synved_shortcode_item_label_create($name)
{
	return __(ucwords(str_replace(array('-', '_'), ' ', $name)));
}

function synved_shortcode_item_template_expand($template_text, $list, $nested_list = null, $conserve_tags = false, $max_nesting = 5)
{
	if ($nested_list == null)
	{
		$nested_list = '.*';
	}
	
	$matches = null;
	$replaced = array();

	while (preg_match_all('/%%(\\w+)%%/', $template_text, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE) > 0 && $max_nesting > 0)
	{
		$max_nesting--;
			
		$done = array();
		
		foreach ($matches as $match)
		{
			if (isset($done[$match[0][0]]))
			{
				continue;
			}
			
			$var = $match[1][0];
			$offset = $match[0][1];
			$parts = explode('_', $var);
			$root = array_shift($parts);
			$private = false;
			
			if ($root == null)
			{
				$private = true;
				$root = '_' . array_shift($parts);
			}
			
			$replace = null;
			$suffix = null;
			$var_name = null;
			$var_name_full = null;
			
			if ($parts != null)
			{
				$suffix = array_pop($parts);
			
				if (in_array($suffix, array('attribute', 'markup')))
				{
					$var_name = implode('_', $parts);
					$parts[] = $suffix;
				}
				else
				{
					$parts[] = $suffix;
					$var_name = implode('_', $parts);
					$suffix = null;
				}
				
				$var_name_full = implode('_', $parts);
			}
			
			if (isset($list[$root]))
			{
				// replace from list of variables passed in
				$root_list = $list[$root];
				$root_nested = null;
				$level = 0;
				
				if (is_string($nested_list))
				{
					$root_nested = $nested_list;
				}
				else if (isset($nested_list[$root]))
				{
					$root_nested = $nested_list[$root];
				}
				
				while ($replace === null)
				{
					if (is_object($root_list) && !($root_list instanceof ArrayAccess))
					{
						$root_list = new SynvedObjectArrayWrapper($root_list);
					}
					
					if (is_scalar($root_list))
					{
						if ($var_name == null)
						{
							$replace = $root_list;
						}
						
						break;
					}
					else if (isset($root_list[$var_name_full]))
					{
						$replace = $root_list[$var_name_full];
						
						break;
					}
					else if (isset($root_list[$var_name]))
					{
						$replace = $root_list[$var_name];
						
						break;
					}
					else if ($root_nested != null && $parts != null)
					{
						$root_new = array_shift($parts);
						
						if (isset($root_list[$root_new]))
						{
							$root_list = $root_list[$root_new];
							$var_name = implode('_', $parts);
							$var_name_full = $var_name;
							
							if ($suffix != null)
							{
								$var_name_full .= '_' . $suffix;
							}
						
							if (is_string($root_nested))
							{
								$result = @preg_match($root_nested, $root_new);
							
								if ($result === false)
								{
									$result = preg_match('/' . $root_nested . '/i', $root_new);
								}
							
								if ($result < 1)
								{
									break;
								}
							}
							else if (is_int($root_nested))
							{
								if ($level > $root_nested)
								{
									break;
								}
							}
							else if (isset($root_nested[$root_new]))
							{
								$root_nested = $root_nested[$root_new];
							}
							else
							{
								break;
							}
						}
						else
						{
							break;
						}
					}
					else
					{
						break;
					}
				
					$level++;
				}
				
				// XXX exception? used when both %%test_name%% and %%test_name_sub%% are valid
				while (is_array($replace))
				{
					if (isset($replace[null]))
					{
						$replace = $replace[null];
					}
					else
					{
						$replace = null;
					}
				}
			}
			else
			{
				// replace with some defaults where applicable
				switch ($root)
				{
					case 'time':
					{
						$replace = time();
					
						break;
					}
				}
			}

			if ($replace !== null && $suffix != null)
			{
				switch ($suffix)
				{
					case 'attribute':
					{
						$value = $replace;
						
						if ($value != null)
						{
							$attr_map = array('link' => 'href', 'tip' => 'title', 'class' => 'class');
							$attr_name = isset($attr_map[$root]) ? $attr_map[$root] : null;
							
							if ($attr_name != null)
							{
								$replace = ' ' . $attr_name . '="' . esc_attr($value) . '"';
							}
						}
						
						break;
					}
					case 'markup':
					{
						$value = $replace;
						$replace = '<div class="synved-content-' . $root . '"><p>' . str_replace(array("\r\n", "\n"), '</p><p>', $value) . '</p></div>';
						
						break;
					}
				}
			}
			
			if (!$conserve_tags || $replace !== null)
			{
				$template_text = str_replace($match[0][0], $replace, $template_text);
			}
			
			$done[$match[0][0]] = true;
		}
	}
	
	return $template_text;
}

function synved_shortcode_item_prepare_text($name, $text)
{
	global $synved_shortcode;
	
	$name_list = array();
	
	foreach ($synved_shortcode['list'] as $item_name => $item)
	{
		$name_list[$item_name] = $item['name_alt'];
		
		if ($name == $item_name)
		{
			$name_list[null] = $item['name_alt'];
		}
	}
	
	$list = array('_synved' => array('name' => $name_list));
	
	return synved_shortcode_item_template_expand($text, $list, null, true);
}
	
function synved_shortcode_item_group_set($name, $group_name, $group_label = null)
{
	global $synved_shortcode;
	
	if (isset($synved_shortcode['list'][$name]))
	{
		$group = $group_name;
		
		if ($group_label != null)
		{
			$group = array('name' => $group_name, 'label' => $group_label);
		}
		
		$synved_shortcode['list'][$name]['group'] = $group;
	}
}

function synved_shortcode_item_default_set($name, $default)
{
	global $synved_shortcode;
	
	if (isset($synved_shortcode['list'][$name]))
	{
		$default = synved_shortcode_item_prepare_text($name, $default);
		
		$synved_shortcode['list'][$name]['default'] = $default;
	}
}

function synved_shortcode_item_help_set($name, $help)
{
	global $synved_shortcode;
	
	if (isset($synved_shortcode['list'][$name]))
	{
		$synved_shortcode['list'][$name]['help'] = $help;
	}
}

function synved_shortcode_item_preset_add($name, $preset, $preset_name = null, $preset_meta = null)
{
	global $synved_shortcode;
	
	if (isset($synved_shortcode['list'][$name]))
	{
		if ($preset_name == null)
		{
			$preset_name = 'preset_' . (count($synved_shortcode['list'][$name]['preset_list']) + 1);
		}
		
		if (!isset($preset_meta['label']))
		{
			$preset_meta['label'] = null;
		}
		
		if (!isset($preset_meta['tip']))
		{
			$preset_meta['tip'] = null;
		}
		
		if (!isset($preset_meta['group']))
		{
			$preset_meta['group'] = null;
		}
		
		$preset = synved_shortcode_item_prepare_text($name, $preset);
		$preset_meta['content'] = $preset;
		
		$synved_shortcode['list'][$name]['preset_list'][$preset_name] = $preset_meta;
	}
}

