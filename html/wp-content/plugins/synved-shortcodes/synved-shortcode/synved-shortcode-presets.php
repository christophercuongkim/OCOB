<?php

function synved_shortcode_register_presets($object_list)
{
	foreach ($object_list as $object_name => $object)
	{
		$object_list[$object_name] = (array) $object;
	}
	
	$post_id = isset($object_list['post']['ID']) ? $object_list['post']['ID'] : 0;
	$post_name = isset($object_list['post']['post_name']) ? $object_list['post']['post_name'] : null;
	$post2_id = isset($object_list['post-2']['ID']) ? $object_list['post-2']['ID'] : 0;
	$post2_name = isset($object_list['post-2']['post_name']) ? $object_list['post-2']['post_name'] : null;
	$page_id = isset($object_list['page']['ID']) ? $object_list['page']['ID'] : 0;
	$page_name = $page_id ? get_page_uri($page_id) : null;
	$media_id = isset($object_list['media']['ID']) ? $object_list['media']['ID'] : 0;
	$media_title = isset($object_list['media']['post_title']) ? $object_list['media']['post_title'] : null;
	$user_id = get_current_user_id();
	
	$site_url = home_url();
	
	synved_shortcode_item_preset_add(
'tabs', 
'[%%_synved_name%%]
[%%_synved_name_tab%% title="Tab 1"]
[%%_synved_name_sections%%]
[%%_synved_name_section%% title="Section 1"]
<p style="margin:5px 0;padding:0;">
Section Content 1.
</p>
[/%%_synved_name_section%%]
[%%_synved_name_section%% title="Section 2"]
<p style="margin:5px 0;padding:0;">
Section Content 2.
</p>
[/%%_synved_name_section%%]
[/%%_synved_name_sections%%]
[/%%_synved_name_tab%%]
[%%_synved_name_tab%% title="Tab 2"]
Tab Content 2.
[/%%_synved_name_tab%%]
[/%%_synved_name%%]',
'tabbed_sections');

	synved_shortcode_item_preset_add(
'sections', 
'[%%_synved_name%%]
[%%_synved_name_section%% title="Section 1"]
[%%_synved_name_tabs%%]
[%%_synved_name_tab%% title="Tab 1"]
Tab Content 1.
[/%%_synved_name_tab%%]
[%%_synved_name_tab%% title="Tab 2"]
Tab Content 2.
[/%%_synved_name_tab%%]
[/%%_synved_name_tabs%%]
[/%%_synved_name_section%%]
[%%_synved_name_section%% title="Section 2"]
<p style="margin:5px 0;padding:0;">
Section Content 2.
</p>
[/%%_synved_name_section%%]
[/%%_synved_name%%]',
'sectioned_tabs');

	synved_shortcode_item_preset_add(
'list', 
'[%%_synved_name%% icon=link]
[%%_synved_name_item%%][%%_synved_name_link_post%% id="' . $post_id . '" name="' . $post_name . '"][/%%_synved_name_item%%]
[%%_synved_name_item%%][%%_synved_name_link_page%% id="' . $page_id . '" name="' . $page_name . '"][/%%_synved_name_item%%]
[%%_synved_name_item%%][%%_synved_name_link_media%% id="' . $media_id . '" title="' . $media_title . '"][/%%_synved_name_item%%]
[%%_synved_name_item%%][%%_synved_name_link_category%% id=1][/%%_synved_name_item%%]
[/%%_synved_name%%]',
'links_list');

	synved_shortcode_item_preset_add(
'full', 
'[%%_synved_name%% width="38%"]Example layout content[/%%_synved_name%%]',
'custom_width');
	synved_shortcode_item_preset_add(
'full', 
'[%%_synved_name%%]
[%%_synved_name_half%% flow="start"]Left column[/%%_synved_name_half%%]
[%%_synved_name_half%% flow="end"]Right column[/%%_synved_name_half%%]
[/%%_synved_name%%]',
'two_columns', array('group' => 'two_columns'));
	synved_shortcode_item_preset_add(
'full', 
'[%%_synved_name%%]
[%%_synved_name_third%% flow="start"]Left column[/%%_synved_name_third%%]
[%%_synved_name_third%% flow="hold"]Center column[/%%_synved_name_third%%]
[%%_synved_name_third%% flow="end"]Right column[/%%_synved_name_third%%]
[/%%_synved_name%%]',
'three_columns', array('group' => 'three_columns'));

	synved_shortcode_item_preset_add(
'half', 
'[%%_synved_name_full%%]
[%%_synved_name_half%% flow="start"]Left column[/%%_synved_name_half%%]
[%%_synved_name_half%% flow="end"]Right column[/%%_synved_name_half%%]
[/%%_synved_name_full%%]',
'two_columns');

	synved_shortcode_item_preset_add(
'third', 
'[%%_synved_name_full%%]
[%%_synved_name_third%% flow="start"]Left column[/%%_synved_name_third%%]
[%%_synved_name_third%% flow="hold"]Center column[/%%_synved_name_third%%]
[%%_synved_name_third%% flow="end"]Right column[/%%_synved_name_third%%]
[/%%_synved_name_full%%]',
'three_columns');

	synved_shortcode_item_preset_add(
'success', 
'[%%_synved_name%%]
Operation accomplished successfully, please check the [%%_synved_name_link_page%% name="' . $page_name . '"]status page[/%%_synved_name_link_page%%].
[/%%_synved_name%%]',
'success_link');
	synved_shortcode_item_preset_add(
'warning', 
'[%%_synved_name%%]
This is the wrong place, please check the [%%_synved_name_link_post%% name="' . $post_name . '"]right place[/%%_synved_name_link_post%%].
[/%%_synved_name%%]',
'wrong_place');

	synved_shortcode_item_preset_add(
'button', 
'[%%_synved_name%% icon="link" tag="128 KB" link="' . $site_url . '"]Download PDF[/%%_synved_name%%]',
'tagged_button');
	
	synved_shortcode_item_preset_add(
'link_post',
'[%%_synved_name%% name="' . $post_name . '"]',
'post_by_name');
	synved_shortcode_item_preset_add(
'link_post',
'[%%_synved_name%% name="' . $post_name . '" template="url"]',
'only_post_url', array('label' => __('Only Post URL', 'synved-shortcode')));
	synved_shortcode_item_preset_add(
'link_post',
'[%%_synved_name%% id="' . $post_id . '" template="card-full"]',
'post_card', array('group' => 'post_cards'));
	
	synved_shortcode_item_preset_add(
'link_page',
'[%%_synved_name%% name="' . $page_name . '"]',
'page_by_name');
	synved_shortcode_item_preset_add(
'link_page',
'[%%_synved_name%% name="' . $page_name . '" template="url"]',
'only_page_url', array('label' => __('Only Page URL', 'synved-shortcode')));
	synved_shortcode_item_preset_add(
'link_page',
'[%%_synved_name%% id="' . $page_id . '" template="card-full"]',
'page_card', array('group' => 'page_cards'));
	
	synved_shortcode_item_preset_add(
'link_media',
'[%%_synved_name%% title="' . $media_title . '"]',
'media_by_title');
	synved_shortcode_item_preset_add(
'link_media',
'[%%_synved_name%% title="' . $media_title . '" template="url"]',
'only_media_url', array('label' => __('Only Media URL', 'synved-shortcode')));
#	synved_shortcode_item_preset_add(
#'link_media',
#'[%%_synved_name%% id="' . $media_id . '" template="card-full"]',
#'media_card', array('group' => 'media_cards'));

	synved_shortcode_item_preset_add(
'link_user',
'[%%_synved_name%% id=' . get_current_user_id() . ' template="custom"]
<a class="synved-link-anchor %%class%%" href="%%link%%"%%tip_attribute%%>%%title%% - %%abstract%%</a> 
[/%%_synved_name%%]',
'quick_link');
	synved_shortcode_item_preset_add(
'link_user',
'[%%_synved_name%% id=' . get_current_user_id() . ' template="card-full"]',
'author_card', array('group' => 'author_cards'));

	synved_shortcode_item_preset_add(
'link_common',
'[%%_synved_name%% name="upload" template="url"]',
'only_common_url', array('label' => __('Only Link URL', 'synved-shortcode')));
}
