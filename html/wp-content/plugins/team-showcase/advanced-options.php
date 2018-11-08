<?php
//This file has stored global variables that the plugin uses.
//Altough they can be changed, don't forget to change them back if you upgrade this file.

//Ordering options won't affect table layout

//ORDER OF CONTENT 
//MAIN ORDER - name, details, social
$ts_display_order = array (
	1 => 'name',
	2 => 'details',
	3 => 'social'	
);
//CONTENT ORDER
//position,location,telephone,email,html,website
$ts_content_order = array (
	1 => 'title',
	2 => 'groups',
	3 => 'taxonomy',
	4 => 'position',
	5 => 'location',
	6 => 'telephone',
	7 => 'email',
	8 => 'html',
	9 => 'website'	
);

//SOCIAL ICONS ORDER
//linkedin,facebook,twitter,gplus,pinterest,youtube,vimeo,instagram,yelp
//OBSOLETE, use next array
$ts_social_order = array (
	1 => 'linkedin',
	2 => 'facebook',
	3 => 'twitter',
	4 => 'gplus',
	5 => 'youtube',
	6 => 'vimeo',
	7 => 'instagram',
	8 => 'yelp',
	9 => 'pinterest', 
	10 => 'email'

	
);


//Social Networks
$ts_social_networks = array(

	0 => array('linkedin','Linkedin','fa-linkedin-square',''),
	1 => array('facebook','Facebook','fa-facebook-square'),
	2 => array('twitter','Twitter','fa-twitter-square'),
	3 => array('gplus','Google Plus','fa-google-plus-square'),
	4 => array('youtube','Youtube','fa-youtube-square'),
	5 => array('vimeo','Vimeo','fa-vimeo-square'),
	6 => array('yelp','yelp','fa-yelp'),
	7 => array('pinterest','Pinterest','fa-pinterest-square'),
	8 => array('instagram','Instagram','fa-instagram'),
	9 => array('tumblr','Tumblr','fa-tumblr-square'),
	10 => array('behance','Behance','fa-behance-square'),
	11 => array('soundcloud','Soundcloud','fa-soundcloud'),
	12 => array('mixcloud','Mixcloud','fa-mixcloud'),
	13 => array('deviantart','Deviantart','fa-deviantart'),
	14 => array('dribbble','Dribbble','fa-dribbble'),
	15 => array('flickr','Flickr','fa-flickr'),
	16 => array('twitch','Twitch','fa-twitch'),
	17 => array('steam','Steam','fa-steam-square'),
	18 => array('www','WWW','fa-globe'),


	);


//ICONS
//see more at http://fortawesome.github.io/Font-Awesome/icons/
$ts_small_icons = array(
		'title' => '<i class="fa fa-user"></i>',
		'position' => '<i class="fa fa-chevron-circle-right"></i>',
		'email' => '<i class="fa fa-envelope"></i>',
		'telephone' => '<i class="fa fa-phone-square"></i>',
		'html' => '<i class="fa fa-align-justify"></i>',
		'website' => '<i class="fa fa-external-link"></i>',
		'location' => '<i class="fa fa-map-marker"></i>',
		'groups' => '<i class="fa fa-align-justify"></i>',
		'taxonomy' => '<i class="fa fa-align-justify"></i>',
);


//Labels

$ts_labels = array (

	'titles' => array(
				'info' => __('Aditional Information','tshowcase'),
				'social' => __('Social Profile Links','tshowcase')	
				),
	'help' => array(
				'social' => __('Use the complete URL to the profile page. Example: http://www.facebook.com/profile','tshowcase')	
				),
	
	'html' => array (
				'key' => 'html',
				'meta_name' => '_tsbio',
				'label' => __('Free HTML','tshowcase'),
				'description' => __('Short bio or tag line. Might be used when listing members with short descriptions.','tshowcase')
				),
	'position' => array (
				'key' => 'position',
				'meta_name' => '_tsposition',
				'label' => __('Job Title','tshowcase'),
				'description' => __('The job description, position or functions of this member.','tshowcase')
				),
	'email' => array (
				'key' => 'email',
				'meta_name' => '_tsemail',
				'label' => __('Email','tshowcase'),
				'description' => __('Contact email for this member. Might be visible to public.','tshowcase')
				),
	'location' => array (
				'key' => 'location',
				'meta_name' => '_tslocation',
				'label' => __('Location','tshowcase'),
				'description' => __('Location/Origin/Adress of this member. Might be visible to public.','tshowcase')
				),
	'telephone' => array (
				'key' => 'telephone',
				'meta_name' => '_tstel',
				'label' => __('Telephone','tshowcase'),
				'description' => __('Telephone contact. Might be visible to public.','tshowcase')
				),
	'user' => array (
				'key' => 'user',
				'meta_name' => '_tsuser',
				'label' => __('User/Author Profile','tshowcase'),
				'description' => __('If this member is associated with a user account select it here. Might be used to fetch latest published posts in the single member page.','tshowcase')
				),
	'website' => array (
				'key' => 'website',
				'meta_name' => '_tspersonal',
				'label' => __('Personal Website','tshowcase'),
				'description' => __('URL to personal website. Might be visible to public.','tshowcase')
				),

	'websiteanchor' => array (
				'key' => 'websiteanchor',
				'meta_name' => '_tspersonalanchor',
				'label' => __('Personal Website Anchor Text','tshowcase'),
				'description' => __('Text to display for the link. If blank URL will be used.','tshowcase')
				),

	'name' => array (
				'key' => 'name',
				'meta_name' => 'title',
				'label' => __('Name/Title','tshowcase'),
				'description' => __('Name of the entry.','tshowcase')
				),
	'photo' => array (
				'key' => 'photo',
				'meta_name' => 'featured_image',
				'label' => __('Photo/Image','tshowcase'),
				'description' => __('Featured Image of the entry.','tshowcase')
				),

	'photoshape' => array (
				'key' => 'photoshape',
				'meta_name' => 'imageshape',
				'label' => __('Image Shape','tshowcase'),
				'description' => __('Shape of Featured Image of the entry.','tshowcase')
				),

	'smallicons' => array (
				'key' => 'smallicons',
				'label' => __('Small Icons','tshowcase'),
				'description' => __('Small CSS Icons.','tshowcase')
				),
	'socialicons' => array (
				'key' => 'socialicons',
				'label' => __('Social Icons','tshowcase'),
				'description' => __('Social Icons.','tshowcase')
				),
	'filter' => array (
				'label' => __('Filter','tshowcase'),
				'all-entries-label' => __('All','tshowcase'),
	),
	'search' => array (
				'all-taxonomies' => __('All','tshowcase'),
				'search' => __('Search','tshowcase'),
				'results-for' => __('Results for ','tshowcase')
		),
	'pagination' => array (
				'next_page' => __('Next Page >','tshowcase'),
				'previous_page' => __('< Previous Page','tshowcase'),
				
		)

);

//Change to false if you don't want the help text on the title input to be changed on the Add New Entry screen
$ts_change_default_title_en = false;




//array of styles for the images and text
//takes the corresponding shortcode code and the css class
//wrap styles for tables and grid should go here also

$ts_wrapstyles = array(
	'normal-float' => 'ts-normal-float-wrap',
	'1-columns' => 'ts-responsive-wrap',
	'2-columns' => 'ts-responsive-wrap',
	'3-columns' => 'ts-responsive-wrap',
	'4-columns' => 'ts-responsive-wrap',
	'5-columns' => 'ts-responsive-wrap',
	'6-columns' => 'ts-responsive-wrap',
	'retro-box-theme' => 'ts-retro-style',
	'badge-theme' => 'ts-badge-style',
	'white-box-theme' => 'ts-white-box-style',
	'card-theme' => 'ts-theme-card-style',
	'odd-colored' => 'ts-table-odd-colored'
	);


$ts_boxstyles = array(
	'img-left'=>'ts-float-left',
	'img-right'=>'ts-float-right',
	'normal-float' => 'ts-normal-float',
	'1-column' => 'ts-col_1',
	'2-columns' => 'ts-col_2',
	'3-columns' => 'ts-col_3',
	'4-columns' => 'ts-col_4',
	'5-columns' => 'ts-col_5',
	'6-columns' => 'ts-col_6'
	);
	
$ts_innerboxstyles = array(
	'img-left'=>'ts-float-left',
	'img-right'=>'ts-float-right'
	);

$ts_txtstyles = array(
	'text-left'=>'ts-align-left',
	'text-right'=>'ts-align-right',
	'text-center'=>'ts-align-center'
	);

$ts_imgstyles = array(
		'img-rounded'=>'ts-rounded',
		'img-circle'=>'ts-circle',
		'img-square'=>'ts-square',
		'img-grayscale' =>'ts-grayscale',
		'img-grayscale-shadow' =>'ts-grayscale-shadow',
		'img-shadow' =>'ts-shadow',
		'img-left' =>'ts-img-left',
		'img-right' =>'ts-img-right',
		'img-white-border' => 'ts-white-border',
		//'img-hover-zoom' => 'ts-hover-zoom'
		);

$ts_infostyles = array(
	'img-left'=>'ts-float-left',
	'img-right'=>'ts-float-right'
	);
	
$ts_pagerstyles = array(
	'thumbs-left'=>'ts-pager-left',
	'thumbs-right'=>'ts-pager-right',
	'thumbs-below'=>'ts-pager-below',
	'thumbs-above'=>'ts-pager-above'
	);

$ts_pagerboxstyles = array(
	'thumbs-left'=>'ts-pager-box-right',
	'thumbs-right'=>'ts-pager-box-left',
	'thumbs-below'=>'ts-pager-box-above',
	'thumbs-above'=>'ts-pager-box-below'
	);





$ts_theme_names = array (

						'grid' => array(
										
										'default' => array (
															'key' => 'default',
															'name' => 'tshowcase-default-style',
															'link' => 'css/normal.css',
															'label' => __('Default','tshowcase')
															),
										'badge-theme' => array (
															'key' => 'badge-theme',
															'name' => 'tshowcase-badge-style',
															'link' => 'css/badge.css',
															'label' => __('Blue Badge Title','tshowcase')
															
															),

										'retro-box-theme' => array (
															'key' => 'retro-box-theme',
															'name' => 'tshowcase-retro-style',
															'link' => 'css/retro.css',
															'label' => __('Retro boxes','tshowcase')
															
															),
										'white-box-theme' => array (
															'key' => 'white-box-theme',
															'name' => 'tshowcase-white-box-style',
															'link' => 'css/white-box.css',
															'label' => __('White Box with Shadow','tshowcase')
															),
										'card-theme' => array (
															'key' => 'card-theme',
															'name' => 'tshowcase-card-theme-style',
															'link' => 'css/theme-card.css',
															'label' => __('Simple Card','tshowcase')
															)
										),
										
						'hover' => array(
									
									'default' => array (
														'key' => 'default',
														'name' => 'tshowcase-default-hover-style',
														'link' => 'css/normal-hover.css',
														'label' => __('Default','tshowcase')
														),
									'white-hover' => array (
														'key' => 'white-hover',
														'name' => 'tshowcase-white-hover-style',
														'link' => 'css/white-hover.css',
														'label' => __('White Hover','tshowcase')
														
														)
									),	
						'table' => array(
									
									'default' => array (
														'key' => 'default',
														'name' => 'tshowcase-default-table-style',
														'link' => 'css/table.css',
														'label' => __('Default','tshowcase')
														),
									'odd-colored' => array (
														'key' => 'odd-colored',
														'name' => 'tshowcase-odd-colored-table-style',
														'link' => 'css/table-odd-colored.css',
														'label' => __('Odd Rows Colored','tshowcase')
														
														)
									),	
						'pager' => array(
									
									'default' => array (
														'key' => 'default',
														'name' => 'tshowcase-default-pager-style',
														'link' => 'css/pager.css',
														'label' => __('Default','tshowcase')
														)
									)	

	);





?>