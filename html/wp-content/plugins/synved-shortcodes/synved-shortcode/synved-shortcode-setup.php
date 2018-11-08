<?php

$synved_shortcode_options = array(
'synved_shortcode' => array(
	'label' => 'Shortcodes',
	'title' => 'WordPress Shortcodes',
	'tip' => synved_option_callback('synved_shortcode_page_settings_tip'),
	'link-target' => plugin_basename(synved_plugout_module_path_get('synved-shortcode', 'provider')),
	'render-fragment' => 'synved_shortcode_page_render_fragment',
	'sections' => array(
		'customize_look' => array(
			'label' => __('Customize Look', 'synved-shortcode'), 
			'tip' => synved_option_callback('synved_shortcode_section_customize_look_tip', __('Customize the look & feel of WordPress Shortcodes', 'synved-shortcode')),
			'settings' => array(
				'shortcode_widgets' => array(
					'default' => true, 'label' => __('Shortcodes In Widgets', 'synved-shortcode'), 
					'tip' => __('Allow shortcodes in Text widgets', 'synved-shortcode')
				),
				'shortcode_feed' => array(
					'default' => true, 'label' => __('Shortcodes In Feeds', 'synved-shortcode'), 
					'tip' => __('Allow shortcodes in Feeds (RSS, Atom, etc.)', 'synved-shortcode')
				),
				'custom_skin' => array(
					'default' => 'basic',
					'set' => synved_option_callback('synved_shortcode_custom_skin_set', 'basic=Basic'),
					'label' => __('Select Skin', 'synved-shortcode'), 
					'tip' => __('Select the skin to use for WordPress Shortcodes', 'synved-shortcode')
				),
				'skin_slickpanel' => array(
					'type' => 'addon',
					'target' => SYNVED_SHORTCODE_ADDON_PATH,
					'folder' => 'skin-slickpanel',
					'module' => 'synved-shortcode',
					'style' => 'addon-important',
					'label' => __('SlickPanel Skin', 'synved-shortcode'), 
					'tip' => synved_option_callback('synved_shortcode_option_skin_slickpanel_tip', __('Click the button to install the SlickPanel skin, get it <a target="_blank" href="http://synved.com/product/wordpress-shortcodes-slickpanel-skin/">here</a>.', 'synved-shortcode'))
				),
				'addon_extra_presets' => array(
					'type' => 'addon',
					'target' => SYNVED_SHORTCODE_ADDON_PATH,
					'folder' => 'extra-presets',
					'module' => 'synved-shortcode',
					'style' => 'addon-important',
					'label' => __('Extra Presets', 'synved-shortcode'), 
					'tip' => synved_option_callback('synved_shortcode_option_addon_extra_presets_tip', __('Click the button to install the "Extra Presets" addon, get it <a target="_blank" href="http://synved.com/product/wordpress-shortcodes-extra-presets/">here</a>.', 'synved-shortcode'))
				),
				'custom_style' => array(
					'type' => 'style',
					'label' => __('Extra Styles', 'synved-shortcode'), 
					'tip' => __('Any CSS styling code you type in here will be loaded after all of the WordPress Shortcodes styles.', 'synved-shortcode')
				),
			)
		)
	)
)
);

synved_option_register('synved_shortcode', $synved_shortcode_options);

synved_option_include_module_addon_list('synved-shortcode');


function synved_shortcode_page_settings_tip($tip, $item)
{
	if (!function_exists('synved_social_version'))
	{
		$tip .= ' <div style="background:#f2f2f2;font-size:110%;color:#444;margin-right:270px;padding:10px 15px;"><b>' . __('Note', 'synved-shortcode') . '</b>: ' . sprintf(__('The WordPress Shortcodes plugin is fully compatible with our free <a target="_blank" href="%1$s">Social Media Feather</a> plugin! Social Media Feather makes social sharing and following a breeze! You can install it using your <a href="%2$s">plugin installer</a>.', 'synved-shortcode'), 'http://synved.com/wordpress-social-media-feather/', add_query_arg(array('tab' => 'search', 's' => 'social media feather'), admin_url('plugin-install.php'))) . '</div>';
	}
	
	if (function_exists('synved_connect_support_social_follow_render'))
	{
		$tip .= synved_connect_support_social_follow_render();
	}
	
	return $tip;
}

function synved_shortcode_page_render_fragment($fragment, $out, $params)
{
	if ($fragment == 'page-submit-tail')
	{
		$out .= '<div style="clear:both; margin-top: -12px;"><a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/synved-shortcodes?rate=5#postform" style="font-size:120%"><b>We need your help!</b> If you like the plugin, you can help us by leaving a 5-stars review! It only takes a minute and it\'s free!</a></a></div>';
	}
	
	return $out;
}

function synved_shortcode_section_customize_look_tip($tip, $item)
{
	if (!synved_option_addon_installed('synved_shortcode', 'skin_slickpanel'))
	{
		$tip .= '<p style="font-size:120%;"><b>Want a slicker, more professional look for your shortcodes? Get the <a target="_blank" href="http://synved.com/product/wordpress-shortcodes-slickpanel-skin/">SlickPanel skin</a></b>!</p> <a target="_blank" href="http://synved.com/product/wordpress-shortcodes-slickpanel-skin/"><img src="' . synved_shortcode_path_uri() . '/image/skin-slickpanel.png" /></a>';
	}
	
	return $tip;
}

function synved_shortcode_custom_skin_set($set, $item) 
{
	if ($set != null && !is_array($set))
	{
		$set = synved_option_item_set_parse($item, $set);
	}
	
	if (synved_option_addon_installed('synved_shortcode', 'skin_slickpanel'))
	{
		$set[]['slickpanel'] = 'SlickPanel';
	}
	
	return $set;
}

function synved_shortcode_option_skin_slickpanel_tip($tip, $item)
{
	if (synved_option_addon_installed('synved_shortcode', 'skin_slickpanel'))
	{
		$tip .= ' <span style="background:#eee;padding:5px 8px;">' . __('SlickPanel is already installed! You can use the button to re-install it.', 'synved-shortcode') . '</span>';
	}
	
	return $tip;
}

function synved_shortcode_option_addon_extra_presets_tip($tip, $item)
{
	if (synved_option_addon_installed('synved_shortcode', 'addon_extra_presets'))
	{
		$tip .= ' <span style="background:#eee;padding:5px 8px;">' . __('The "Extra Presets" addon is already installed! You can use the button to re-install it.', 'synved-shortcode') . '</span>';
	}
	
	return $tip;
}

function synved_shortcode_path_uri($path = null)
{
	$uri = plugins_url('/synved-shortcodes') . '/synved-shortcode';
	
	if (function_exists('synved_plugout_module_uri_get'))
	{
		$mod_uri = synved_plugout_module_uri_get('synved-shortcode');
		
		if ($mod_uri != null)
		{
			$uri = $mod_uri;
		}
	}
	
	if ($path != null)
	{
		if (substr($uri, -1) != '/' && $path[0] != '/')
		{
			$uri .= '/';
		}
		
		$uri .= $path;
	}
	
	return $uri;
}

function synved_shortcode_wp_register_common_scripts()
{
	$uri = synved_shortcode_path_uri();
	
	wp_register_style('synved-shortcode-jquery-ui', $uri . '/jqueryUI/css/snvdshc/jquery-ui-1.9.2.custom.min.css', false, '1.9.2');
	wp_register_style('synved-shortcode-layout', $uri . '/style/layout.css', false, '1.0');
	wp_register_style('synved-shortcode-jquery-ui-custom', $uri . '/style/jquery-ui.css', false, '1.0');
	
	wp_register_script('jquery-unselectable', $uri . '/script/jquery-unselectable.js', array('jquery'), '1.0.0');
	wp_register_script('jquery-babbq', $uri . '/script/jquery.ba-bbq.min.js', array('jquery'), '1.2.1');
	wp_register_script('jquery-scrolltab', $uri . '/script/jquery.scrolltab.js', array('jquery'), '1.0');
	wp_register_script('synved-shortcode-base', $uri . '/script/base.js', array('jquery-babbq', 'jquery-scrolltab', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-button', 'jquery-unselectable', 'jquery-ui-slider'), '1.0');
	
	// XXX exception, ensure slickpanel works with new update
	$slick_css_path = dirname(__FILE__) . '/addons/skin-slickpanel/style/jquery-ui.css';
	
	if (file_exists($slick_css_path))
	{
		$slick_css = file_get_contents($slick_css_path);
		
		if (strpos($slick_css, '.snvdshc') === false)
		{
			$slick_css_new = $slick_css;
			$slick_css_new = preg_replace('/(\\.((ui-tabs)|(ui-accordion))\\s)/i', '.snvdshc $1', $slick_css_new);
			$slick_css_new = str_replace('ui-tabs-selected', 'ui-tabs-active', $slick_css_new);
			
			$slick_css_new .= '
.snvdshc .ui-accordion .ui-accordion-content {
border-top-width:0;
}';
		
			if ($slick_css_new != $slick_css)
			{
				file_put_contents($slick_css_path, $slick_css_new);
			}
		}
	}
}

function synved_shortcode_enqueue_scripts()
{
	$uri = synved_shortcode_path_uri();
	
	synved_shortcode_wp_register_common_scripts();
	
	wp_register_script('synved-shortcode-custom', $uri . '/script/custom.js', array('synved-shortcode-base'), '1.0');
	
	wp_enqueue_style('synved-shortcode-jquery-ui');
	wp_enqueue_style('synved-shortcode-layout');
	wp_enqueue_style('synved-shortcode-jquery-ui-custom');
	
	wp_enqueue_script('synved-shortcode-custom');
}

function synved_shortcode_print_styles()
{
}

function synved_shortcode_admin_enqueue_scripts()
{
	$uri = synved_shortcode_path_uri();
	
	synved_shortcode_wp_register_common_scripts();
	
	wp_register_script('jquery-chosen', $uri . '/chosen/chosen.jquery.js', array('jquery'), '0.9.8');
	wp_register_script('synved-shortcode-script-admin', $uri . '/script/admin.js', array('synved-shortcode-base', 'jquery', 'suggest', 'media-upload', 'thickbox', 'jquery-ui-core', 'jquery-ui-progressbar', 'jquery-ui-dialog'), '1.0.0');
	wp_localize_script('synved-shortcode-script-admin', 'SynvedShortcodeVars', array('flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'), 'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'), 'ajaxurl' => admin_url('admin-ajax.php'), 'synvedSecurity' => wp_create_nonce('synved-shortcode-submit-nonce'), 'mainUri' => $uri, 'currentPost' => (isset($_GET['post']) ? $_GET['post'] : 0)));
	
	wp_register_style('synved-shortcode-admin', $uri . '/style/admin.css', array('thickbox', 'wp-pointer', 'wp-jquery-ui-dialog'), '1.0');
	wp_register_style('jquery-chosen', $uri . '/chosen/chosen.css', false, '0.9.8');
	
	$file = isset($GLOBALS['pagenow']) ? $GLOBALS['pagenow'] : null;
	$page = isset($_GET['page']) ? $_GET['page'] : null;
	$enqueue = false;
	
	if ($file == 'post.php' || $file == 'post-new.php' || ($file == 'options-general.php' && $page == synved_option_name_default('synved_shortcode')))
	{
		$enqueue = true;
	}
	
	if ($enqueue)
	{
		wp_enqueue_style('synved-shortcode-jquery-ui');
		wp_enqueue_style('farbtastic');
		wp_enqueue_style('jquery-chosen');
		wp_enqueue_style('synved-shortcode-layout');
		wp_enqueue_style('synved-shortcode-jquery-ui-custom');
		wp_enqueue_style('synved-shortcode-admin');
	
		wp_enqueue_script('plupload-all');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('suggest');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('farbtastic');
		wp_enqueue_script('jquery-chosen');
		wp_enqueue_script('synved-shortcode-script-admin');
	}
}

function synved_shortcode_admin_print_styles()
{
	// Tries to fix WordPress SEO generic selector conflicts
	global $wp_scripts;
	global $wp_styles;
	
	if (isset($wp_scripts))
	{
		if ($wp_scripts->query('jigoshop_script', 'queue'))
		{
			$wp_scripts->dequeue('jigoshop_script');
			$wp_scripts->enqueue('jigoshop_script');
			
#			$wp_scripts->dequeue('synved-shortcode-custom');
#			$wp_scripts->enqueue('synved-shortcode-custom');
		}
	}
	
	if (isset($wp_styles))
	{
		$color = get_user_meta(get_current_user_id(), 'admin_color', true);
		
		if ($wp_styles->query('metabox-tabs', 'queue'))
		{
			$wp_styles->dequeue(array('metabox-tabs', 'metabox-' . $color));
			$wp_styles->enqueue(array('metabox-tabs', 'metabox-' . $color));
			
			$wp_styles->dequeue('synved-shortcode-jquery-ui-custom');
			$wp_styles->enqueue('synved-shortcode-jquery-ui-custom');
			
			if ($wp_styles->query('synved-shortcode-skin-slickpanel-layout', 'queue'))
			{
				$wp_styles->dequeue('synved-shortcode-skin-slickpanel-layout');
				$wp_styles->enqueue('synved-shortcode-skin-slickpanel-layout');
			}
			
			if ($wp_styles->query('synved-shortcode-skin-slickpanel-jquery-ui', 'queue'))
			{
				$wp_styles->dequeue('synved-shortcode-skin-slickpanel-jquery-ui');
				$wp_styles->enqueue('synved-shortcode-skin-slickpanel-jquery-ui');
			}
		}
	}
}

function synved_shortcode_wp_tinymce_plugin($plugin_array)
{
	$plugin_array['synved_shortcode'] = synved_shortcode_path_uri() . '/script/tinymce_plugin.js';

	return $plugin_array;
}

function synved_shortcode_wp_tinymce_button($buttons) 
{
	array_push($buttons, '|', 'synved_shortcode');
	
	return $buttons;
}

function synved_shortcode_ajax_callback()
{
	check_ajax_referer('synved-shortcode-submit-nonce', 'synvedSecurity');

	if (!isset($_POST['synvedAction']) || $_POST['synvedAction'] == null) 
	{
		return;
	}

	$action = $_POST['synvedAction'];
	$params = isset($_POST['synvedParams']) ? $_POST['synvedParams'] : null;
	$response = null;
	$response_html = null;
	
	if (is_string($params))
	{
		$parms = json_decode($params, true);
		
		if ($parms == null)
		{
			$parms = json_decode(stripslashes($params), true);
		}
		
		$params = $parms;
	}
	
	switch ($action)
	{
		case 'load-ui':
		{
			$uri = synved_shortcode_path_uri();
#			
#			$response_html .= '
#<script type="text/javascript" src="' . '' . '" />';

#			if (synved_option_addon_installed('synved_shortcode', 'skin_slickpanel'))
#			{
#				$set[]['slickpanel'] = 'SlickPanel';
#			}
			
			if (current_user_can('edit_posts') || current_user_can('edit_pages'))
			{
				$response_html .= '
<div class="synved-shortcode-edit-popup">';

				if (!synved_option_addon_installed('synved_shortcode', 'skin_slickpanel'))
				{
					$response_html .= '
<a target="_blank" href="http://synved.com/product/wordpress-shortcodes-slickpanel-skin/" style=""><img align="center" src="' . $uri . '/image/skin-slickpanel-thin.png" style="clear:both;margin-top:5px;border:solid 1px #aaa;"/></a>';
				}

				$response_html .= '<h3 class="popup-title">' . __('Select your shortcode, edit it, preview it and confirm when you\'re done!', 'synved-shortcode') . '</h3>';
				$response_html .= '
<form action="" method="post">
<div class="synved-shortcode-edit-ui">';

				$list = synved_shortcode_list();
				$extra_fields = null;
				$help_html = null;
				
				$response_html .= '
<div class="synved-shortcode-edit-ui-selector">
<div class="selector-item" style="float:left;">
<div class="selector-label" style="float:left;margin-top:3px;margin-right:8px;">
<label for="synved_shortcode_list">' . __('Shortcode', 'synved-shortcode') . ':</label>
</div>
<select name="synved_shortcode_list" id="synved_shortcode_list">';

				$list_html = array();
				$group_labels = array();

				foreach ($list as $shortcode_name => $shortcode_item)
				{
					$name_alt = $shortcode_item['name_alt'];
					$label = $shortcode_item['label'];
					$group = $shortcode_item['group'];
					$callback = $shortcode_item['callback'];
					$internal = $shortcode_item['internal'];
					$default = $shortcode_item['default'];
					$help = $shortcode_item['help'];
					$presets = $shortcode_item['preset_list'];
					
					if ($internal == false)
					{
						$tip = null;
						$args = null;
						$group_name = null;
						$group_label = null;
						
						if ($group != null)
						{
							if (is_array($group))
							{
								$group_name = isset($group['name']) ? $group['name'] : null;
								$group_label = isset($group['label']) ? $group['label'] : null;
							}
							else
							{
								$group_name = $group;
								$group_label = synved_shortcode_item_label_create($group_name);
							}
							
							$group_labels[$group_name] = $group_label;
						}
							
						if ($help != null)
						{
							if (is_string($help))
							{
								$tip = $help;
							}
							else if (is_array($help))
							{
								$tip = isset($help['tip']) ? $help['tip'] : null;
								$args = isset($help['parameters']) ? $help['parameters'] : null;
							}
							
							$help_html .= '
<div class="synved-shortcode-help-item" id="' . esc_attr('synved-shortcode-help-item-' . $shortcode_name) . '">';
				
							$help_html .= '
<div class="help-tip">
<b>[' . $name_alt . ']</b> --> ' . $tip . '
</div>';
							
							if ($presets != null)
							{
								$help_html .= '
<div class="presets-tip">
' . __('Remember that you can also use the <strong>Preset</strong> selector at the top-right to see examples on how to use the shortcode.', 'synved-shortcode') . '
</div>';
							}

							if ($args != null)
							{
								$help_html .= '
<div class="help-parameter-list-wrap">';

								$help_html .= '
<h4 class="ui-title">' . __('Parameters', 'synved-shortcode') . ':</h4>';

								$help_html .= '
<ul class="help-parameter-list">';
								
								foreach ($args as $arg_name => $arg_tip)
								{
									$help_html .= '
<li class="help-parameter-tip">
<b>' . $arg_name . '</b>: <i>'  . $arg_tip . '</i>
</li>';
								}
								
								$help_html .= '
</ul>';
								$help_html .= '
</div>';
							}

							$help_html .= '
</div>';
						}
						
						$title = $tip != null ? (' title="' . esc_attr($tip) . '"') : null;
						
						if (!isset($list_html[$group_name]))
						{
							$list_html[$group_name] = null;
						}
						
						$list_html[$group_name] .= '
<option value="' . esc_attr($shortcode_name) . '"' . $title . '>' . $label . '</option>';
					
						$extra_fields .= '
<select name="shortcode_preset[' . esc_attr($shortcode_name) . ']">';
						
						$extra_fields .= '
<option selected="selected" value="' . esc_attr('default') . '" data-content="' . esc_attr($default) . '" title="' . esc_attr(__('The default preset', 'synved-shortcode')) . '">' . esc_attr(__('Default', 'synved-shortcode')) . '</option>';

						if ($presets != null)
						{
							$preset_list_html = array();
							$preset_group_labels = array();
							
							foreach ($presets as $preset_name => $preset)
							{
								$preset_label = $preset['label'];
								$preset_group = $preset['group'];
								$preset_tip = $preset['tip'];
								$preset_content = $preset['content'];
								
								$preset_group_name = null;
								$preset_group_label = null;
						
								if ($preset_group != null)
								{
									if (is_array($preset_group))
									{
										$preset_group_name = isset($preset_group['name']) ? $preset_group['name'] : null;
										$preset_group_label = isset($preset_group['label']) ? $preset_group['label'] : null;
									}
									else
									{
										$preset_group_name = $preset_group;
										$preset_group_label = synved_shortcode_item_label_create($preset_group_name);
									}
							
									$preset_group_labels[$preset_group_name] = $preset_group_label;
								}
								
								if ($preset_label == null)
								{
									$preset_label = synved_shortcode_item_label_create($preset_name);
								}
								
								if ($preset_tip != null)
								{
									$preset_tip = ' title="' . esc_attr($preset_tip) . '"';
								}
								
								$preset_list_html[$preset_group_name] .= '
<option value="' . esc_attr($preset_name) . '" data-content="' . esc_attr($preset_content) . '"' . $preset_tip . '>' . $preset_label . '</option>';
								
							}
				
							if (isset($preset_list_html[null]))
							{
								$preset_list_html_keys = array_keys($preset_list_html);
								$preset_list_html_values = array_values($preset_list_html);
					
								$preset_list_html_index = array_search(null, $preset_list_html_keys);
					
								if ($preset_list_html_index !== false && $preset_list_html_index > 0)
								{
									$preset_list_html_value = $preset_list_html_values[$preset_list_html_index];
						
									unset($preset_list_html_keys[$preset_list_html_index]);
									unset($preset_list_html_values[$preset_list_html_index]);
						
									array_unshift($preset_list_html_keys, null);
									array_unshift($preset_list_html_values, $preset_list_html_value);
						
									$preset_list_html = array_combine($preset_list_html_keys, $preset_list_html_values);
								}
							}
							
							foreach ($preset_list_html as $preset_group_name => $preset_item_html)
							{
								if ($preset_group_name != null)
								{
									$extra_fields .= '
<optgroup label="' . $preset_group_labels[$preset_group_name] . '">';
								}
					
								$extra_fields .= $preset_item_html;
					
								if ($preset_group_name != null)
								{
									$extra_fields .= '
</optgroup>';
								}
							}
						}
						
//<optgroup label="' . __('Custom', 'synved-shortcode') . '">
						$extra_fields .= '
<option value="custom" data-content="' . esc_attr($default) . '" title="' . esc_attr(__('The custom preset, holds the temporarily customized shortcode code', 'synved-shortcode')) . '">' . esc_attr(__('<Custom>', 'synved-shortcode')) . '</option>';
//</optgroup>
							
						$extra_fields .= '
</select>';
					}
				}
				
				if (isset($list_html[null]))
				{
					$list_html_keys = array_keys($list_html);
					$list_html_values = array_values($list_html);
					
					$list_html_index = array_search(null, $list_html_keys);
					
					if ($list_html_index !== false && $list_html_index > 0)
					{
						$list_html_value = $list_html_values[$list_html_index];
						
						unset($list_html_keys[$list_html_index]);
						unset($list_html_values[$list_html_index]);
						
						array_unshift($list_html_keys, null);
						array_unshift($list_html_values, $list_html_value);
						
						$list_html = array_combine($list_html_keys, $list_html_values);
					}
				}
				
				foreach ($list_html as $group_name => $shortcode_item_html)
				{
					if ($group_name != null)
					{
						$response_html .= '
<optgroup label="' . $group_labels[$group_name] . '">';
					}
					
					$response_html .= $shortcode_item_html;
					
					if ($group_name != null)
					{
						$response_html .= '
</optgroup>';
					}
				}

				$response_html .= '
</select>
<div class="shortcode-extra-fields" style="display:none">' . $extra_fields . '</div>
</div>
<div class="selector-item" style="float:right;">
<div class="selector-label" style="float:left;margin-top:3px;margin-right:8px;">
<label for="synved_preset_list">' . __('Preset', 'synved-shortcode') . ':</label>
</div>
<select name="synved_preset_list" id="synved_preset_list">
</select>';

				if (!synved_option_addon_installed('synved_shortcode', 'addon_extra_presets'))
				{
					$response_html .= '
<a target="_blank" href="http://synved.com/product/wordpress-shortcodes-extra-presets/" style="display:block;text-align:right;font-weight:bold;">GET 30+ EXTRA AMAZING PRESETS!</a>';
				}

				$response_html .= '
</div>
<div style="clear:both">
</div>
</div>';

				$response_html .= '
<div class="synved-shortcode-edit-ui-viewer">';

				$response_html .= '
<div class="ui-code-wrap">
<div class="ui-wrap ui-wrap-left">';

				$response_html .= '
<h4 class="ui-title">' . __('Code', 'synved-shortcode') . ':</h4>
<textarea name="synved_shortcode_code" class="ui-code"></textarea>';

				$response_html .= '
</div>
</div>';

				$response_html .= '
<div class="ui-preview-wrap">
<div class="ui-wrap ui-wrap-right">';

				$response_html .= '
<h4 class="ui-title">' . __('Preview', 'synved-shortcode') . ': <img class="preview-loader" style="visibility:hidden" src="' . $uri . '/image/ajax-loader.gif" /></h4>
<div class="ui-preview"></div>';

				$response_html .= '
</div>
</div>';

				$response_html .= '
</div>';

				$response_html .= '<div style="clear:both"></div>';
				
				$response_html .= '
<div class="synved-shortcode-edit-ui-help">
<div class="ui-help-wrap">';

#				$response_html .= '
#<h3 class="">' . __('Help', 'synved-shortcode') . ':</h3>';
				$response_html .= '
<div class="ui-help"></div>';

				$response_html .= '
</div>';

				if ($help_html != null)
				{
					$help_html = '
<div class="synved-shortcode-help" style="display:none;">
' . $help_html . '
</div>';

					$response_html .= $help_html;
				}

				$response_html .= '
</div>';

				$response_html .= '
</div>';

				$response_html .= '<div style="clear:both"></div>';

				$response_html .= '
<div class="synved-shortcode-edit-actions">';

				$response_html .= '<button class="action-confirm button-primary">' . __('Confirm and add shortcode', 'synved-shortcode') . '</button>';

				$response_html .= '
<div style="float:right"><a target="_blank" href="http://synved.com/wordpress-shortcodes/">WordPress Shortcodes</a> by <a target="_blank" href="http://synved.com">Synved</a>';

				if (function_exists('synved_connect_support_social_follow_render_small'))
				{
					$response_html .= ' ' . synved_connect_support_social_follow_render_small();
				}

				if (!synved_option_addon_installed('synved_shortcode', 'skin_slickpanel'))
				{
					$response_html .= ' &raquo; <a target="_blank" href="http://synved.com/product/wordpress-shortcodes-slickpanel-skin/">BE SLICK AND SUPPORT US!</a> &laquo;';
				}
				
				$response_html .= '
</div>';
				
				$response_html .= '<div style="clear:both; margin: 10px 0 60px 0;"><a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/synved-shortcodes?rate=5#postform" style="font-size:120%"><b>We need your help!</b> If you like the plugin, you can help us by leaving a 5-stars review! It only takes a minute and it\'s free!</a></a></div>';

				$response_html .= '
</div>';
				
				$response_html .= '
</form>
</div>';
			}
			
			break;
		}
		case 'preview-code':
		{
			if (current_user_can('edit_posts') || current_user_can('edit_pages'))
			{
				$code = isset($params['code']) ? $params['code'] : null;
				
				if (get_magic_quotes_gpc() || get_magic_quotes_runtime() || true) 
				{
					$code = stripslashes($code);
				}
				
				$response_html = do_shortcode($code);
			}
			
			break;
		}
	}

	while (ob_get_level() > 0) 
	{
		ob_end_clean();
	}

	if ($response != null) 
	{
		$response = json_encode($response);

		header('Content-Type: application/json');

		echo $response;
	}
	else if ($response_html != null) 
	{
		header('Content-Type: text/html');

		echo $response_html;
	}
	else 
	{
		header('HTTP/1.1 403 Forbidden');
	}

	exit();
}

function synved_shortcode_init()
{
	$object_list = array();
	
	if (is_admin())
	{
		$exclude_list = array();
		
		if (isset($_POST['synvedPost']))
		{
			$synved_post = (int) $_POST['synvedPost'];
			
			if ($synved_post > 0)
			{
				$exclude_list[] = $synved_post;
			}
		}
		
		if (isset($_GET['post']))
		{
			$synved_post = (int) $_GET['post'];
			
			if ($synved_post > 0 && array_search($synved_post, $exclude_list) === false)
			{
				$exclude_list[] = $synved_post;
			}
		}
		
		$args = array('numberposts' => 1, 'orderby' => 'random', 'exclude' => $exclude_list);
		$args['post_type'] = 'post';
		$posts = get_posts($args);
		$post = $posts != null ? $posts[0] : null;
		
		$args['post_type'] = 'post';
		if ($post != null)
		{
			$args['exclude'][] = $post->ID;
		}
		$posts = get_posts($args);
		$post2 = $posts != null ? $posts[0] : null;
		
		$args['post_type'] = 'page';
		$posts = get_posts($args);
		$page = $posts != null ? $posts[0] : null;
		
		$args['post_type'] = 'attachment';
		$args['post_status'] = null;
		$posts = get_posts($args);
		$media = $posts != null ? $posts[0] : null;
		
		$object_list['post'] = $post;
		$object_list['post-2'] = $post2;
		$object_list['page'] = $page;
		$object_list['media'] = $media;
	}
	
	synved_shortcode_register_list();
	
	$err_rep = error_reporting(0);
	
	synved_shortcode_register_presets($object_list);
	
	if (function_exists('synved_shortcode_addon_extra_presets_register'))
	{
		synved_shortcode_addon_extra_presets_register($object_list);
	}
	
	error_reporting($err_rep);
	
	if (current_user_can('edit_posts') || current_user_can('edit_pages'))
	{
		if (get_user_option('rich_editing') == 'true')
		{
			add_filter('mce_external_plugins', 'synved_shortcode_wp_tinymce_plugin');
			add_filter('mce_buttons', 'synved_shortcode_wp_tinymce_button');
		}
	}

	$priority = defined('SHORTCODE_PRIORITY') ? SHORTCODE_PRIORITY : 11;
	
	if (synved_option_get('synved_shortcode', 'shortcode_widgets'))
	{
		remove_filter('widget_text', 'do_shortcode', $priority);
		add_filter('widget_text', 'do_shortcode', $priority);
	}
	
	if (synved_option_get('synved_shortcode', 'shortcode_feed'))
	{
		remove_filter('the_content_feed', 'do_shortcode', $priority);
		remove_filter('the_excerpt_rss', 'do_shortcode', $priority);
		add_filter('the_content_feed', 'do_shortcode', $priority);
		add_filter('the_excerpt_rss', 'do_shortcode', $priority);
	}
	
  add_action('wp_ajax_synved_shortcode', 'synved_shortcode_ajax_callback');
  add_action('wp_ajax_nopriv_synved_shortcode', 'synved_shortcode_ajax_callback');

	if (!is_admin())
	{
		if (isset($_GET['synved_dynamic_tab']))
		{
			ob_start();
		}
		
		add_action('wp_enqueue_scripts', 'synved_shortcode_enqueue_scripts');
		//add_action('wp_print_styles', 'synved_shortcode_print_styles');
	}
}

add_action('init', 'synved_shortcode_init');
add_action('admin_enqueue_scripts', 'synved_shortcode_admin_enqueue_scripts');
add_action('admin_print_styles', 'synved_shortcode_admin_print_styles', 1);

?>
