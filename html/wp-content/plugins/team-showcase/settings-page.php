<?php  
  
//admin enque scrips
function tshowcase_enqueue_settings_js() {
	
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_deregister_style( 'tshowcase-settings-style' );
	wp_register_style( 'tshowcase-settings-style', plugins_url( 'css/settings.css', __FILE__ ),array(),false,false);
	wp_enqueue_style( 'tshowcase-settings-style' );		
}
  
  
//options page build 
function tshowcase_settings_page () { 

global $ts_labels;

//tshowcase_enqueue_settings_js();



			
?>




 <div class="wrap">
<h2><?php echo __('Settings','tshowcase'); ?></h2>
    <?php 
	if(isset($_GET['settings-updated']) && $_GET['settings-updated']=="true") { 
    $msg = __("Settings Updated","tshowcase");
    tshowcase_message($msg);
    } ?>
	<form method="post" action="options.php" id="dsform">
    <?php 
	  
    settings_fields( 'tshowcase-plugin-settings' ); 
    $options = get_option('tshowcase-settings'); 

    $options['tshowcase_single_photo_shape'] = isset($options['tshowcase_single_photo_shape']) ? $options['tshowcase_single_photo_shape'] : 'img-square';

	?>
    
<div id="tabs-left">

<div>
<table cellpadding="5" cellspacing="5">
  <tr>
    <td align="right" style="background-color:#f5f5f5;"><strong ><?php echo __('Image Sizes','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="right"><?php echo __('Main Image Size','tshowcase'); ?></td>
    <td nowrap><?php echo __('Width','tshowcase'); ?>: 
      <input name="tshowcase-settings[tshowcase_thumb_width]" type="text" value="<?php echo $options['tshowcase_thumb_width']; ?>" size="3" />
      <?php echo __('Height','tshowcase'); ?>:
      <input name="tshowcase-settings[tshowcase_thumb_height]" type="text" value="<?php echo $options['tshowcase_thumb_height']; ?>" size="3" />
      <?php echo __('Crop','tshowcase'); ?>: 
      <select name="tshowcase-settings[tshowcase_thumb_crop]">
        <option value="true" <?php selected($options['tshowcase_thumb_crop'], 'true' ); ?>><?php echo __('Yes','tshowcase'); ?></option>
        <option value="false" <?php selected($options['tshowcase_thumb_crop'], 'false' ); ?>><?php echo __('No','tshowcase'); ?></option>
        </select></td>
    <td><span class="howto">
      <?php echo __('
      This will be the size of the Images. When they are uploaded they will follow this settings. If you change this settings after the image is uploaded they will show scaled.</span></td>
      ','tshowcase'); ?>
  </tr>
  <tr>
    <td width="150" align="right"><?php echo __('Thumbnails Pager','tshowcase'); ?></td>
    <td nowrap>Width: 
      <input name="tshowcase-settings[tshowcase_tpimg_width]" type="text" value="<?php if(isset($options['tshowcase_tpimg_width'])):echo $options['tshowcase_tpimg_width']; endif; ?>" size="3" /> 
      Height: 
      <input name="tshowcase-settings[tshowcase_tpimg_height]" type="text" value="<?php if(isset($options['tshowcase_tpimg_height'])):echo $options['tshowcase_tpimg_height']; endif; ?>" size="3" /></td>
    <td><span class="howto"><?php echo __("This will be the size of the thumbnail images in the 'Thumbnails Pager' layout. Smaller value will prevail, if image doesn't match the size.",'tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td width="150" align="right"><?php echo __('Table Image Size','tshowcase'); ?></td>
    <td nowrap><?php echo __('Width','tshowcase'); ?>: 
      <input name="tshowcase-settings[tshowcase_timg_width]" type="text" value="<?php if(isset($options['tshowcase_timg_width'])):echo $options['tshowcase_timg_width']; endif; ?>" size="3" />
      <?php echo __('Height','tshowcase'); ?>: 
      <input name="tshowcase-settings[tshowcase_timg_height]" type="text" value="<?php if(isset($options['tshowcase_timg_height'])):echo $options['tshowcase_timg_height']; endif; ?>" size="3" /></td>
    <td><span class="howto"><?php echo __("This will be the size of the thumbnail images in the 'Table' layout. Smaller value will prevail, if image doesn't match the size.",'tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right"><?php echo __('Social Icons','tshowcase'); ?></td>
    <td nowrap><select name="tshowcase-settings[tshowcase_single_social_icons]">
      <option value="font"  <?php selected($options['tshowcase_single_social_icons'], 'font' ); ?> >Vector Font Icons</option>
       <option value="font-gray"  <?php selected($options['tshowcase_single_social_icons'], 'font-gray' ); ?> >Vector Font Icons (Gray Initial State)</option>
     <!-- <option value="round-32"  <?php selected($options['tshowcase_single_social_icons'], 'round-32' ); ?> >Round 32x32</option>
      <option value="round-24"  <?php selected($options['tshowcase_single_social_icons'], 'round-24' ); ?> >Round 24x24</option>
      <option value="round-20"  <?php selected($options['tshowcase_single_social_icons'], 'round-20' ); ?> >Round 20x20</option>
      <option value="round-16"  <?php selected($options['tshowcase_single_social_icons'], 'round-16' ); ?> >Round 16x16</option>
      <option value="square-32"  <?php selected($options['tshowcase_single_social_icons'], 'square-32' ); ?> >Square 32x32</option>
      <option value="square-24"  <?php selected($options['tshowcase_single_social_icons'], 'square-24' ); ?> >Square 24x24</option>
      <option value="square-20"  <?php selected($options['tshowcase_single_social_icons'], 'square-20' ); ?> >Square 20x20</option>
      <option value="square-16"  <?php selected($options['tshowcase_single_social_icons'], 'square-16' ); ?> >Square 16x16</option> -->
      </select></td>
    <td><span class="howto"><?php echo __('What Social Icons do you want to display?','tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right"><?php echo __('Icons Size','tshowcase'); ?></td>

    <?php 

    $options['tshowcase_single_social_icons_size'] = isset($options['tshowcase_single_social_icons_size']) ? $options['tshowcase_single_social_icons_size'] : 'fa-lg';

    ?>

    <td nowrap><select name="tshowcase-settings[tshowcase_single_social_icons_size]">
      <option value="fa-lg"  <?php selected($options['tshowcase_single_social_icons_size'], 'fa-lg' ); ?> >Normal</option>
       <option value="fa-2x"  <?php selected($options['tshowcase_single_social_icons_size'], 'fa-2x' ); ?> >2x</option>
      <option value="fa-3x"  <?php selected($options['tshowcase_single_social_icons_size'], 'fa-3x' ); ?> >3x</option>
      <option value="fa-4x"  <?php selected($options['tshowcase_single_social_icons_size'], 'fa-4x' ); ?> >4x</option>


    </select></td>
    <td><span class="howto"><?php echo __('What Social Icons do you want to display?','tshowcase'); ?></span></td>
  </tr>

  
  
  <tr>
    <td width="150" align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Linking Settings','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="right">mailto:active</td>
    <td nowrap><input name="tshowcase-settings[tshowcase_mailto]" type="checkbox" id="tshowcase-settings[tshowcase_mailto]" value="1" <?php if(isset($options['tshowcase_mailto'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('When active, emails will display as a link in the mailto:email format. ','tshowcase'); ?></span></td>
    </tr>
 
<tr>
    <td width="150" align="right">tel:active</td>
    <td nowrap><input name="tshowcase-settings[tshowcase_tellink]" type="checkbox" id="tshowcase-settings[tshowcase_tellink]" value="1" <?php if(isset($options['tshowcase_tellink'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('When active, telephone entries will display linked with the tel: protocol. ','tshowcase'); ?></span></td>
    </tr>

    <tr>
    <td width="150" align="right"><?php echo __('nofollow Social Links','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_nofollow]" type="checkbox" id="tshowcase-settings[tshowcase_nofollow]" value="1" <?php if(isset($options['tshowcase_nofollow'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('When active, social links will have the rel="nofollow" parameter.','tshowcase'); ?> </span></td>
  </tr>

   <tr>
    <td width="150" align="right"><?php echo __('Main Link CSS Class','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_linkcssclass]" type="text" id="tshowcase-settings[tshowcase_linkcssclass]" value="<?php if(isset($options['tshowcase_linkcssclass'])) { echo $options['tshowcase_linkcssclass']; } ?>" ></td>
    <td><span class="howto"><?php echo __('This will be the css class of the links that lead to the single page or custom URLs. It can be useful to place a class to use with a lightbox plugin for example.','tshowcase'); ?> </span></td>
  </tr>
   <tr>
    <td width="150" align="right"><?php echo __('Main Link rel attribute','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_linkrel]" type="text" id="tshowcase-settings[tshowcase_linkrel]" value="<?php if(isset($options['tshowcase_linkrel'])) { echo $options['tshowcase_linkrel']; } ?>" ></td>
    <td><span class="howto"><?php echo __('This will be the rel parameter of the links that lead to the single page or custom URLs. It can be useful to place a rel attribute to use with a lightbox plugin for example.','tshowcase'); ?> </span></td>
  </tr>

    <tr>
    <td width="150" align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Ajax Settings','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="right"><?php echo __('Ajax Pagination','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_ajax_pagination]" type="checkbox" id="tshowcase-settings[tshowcase_ajax_pagination]" value="1" <?php if(isset($options['tshowcase_ajax_pagination'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('If active, when pagination is enabled, it will be performed with ajax, so the page does not reload.','tshowcase'); ?>
    </span></td>
    </tr>

    <tr>
    <td width="150" align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Search Settings','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="right"><?php echo __('Exclude From General Search','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_exclude_from_search]" type="checkbox" id="tshowcase-settings[tshowcase_exclude_from_search]" value="1" <?php if(isset($options['tshowcase_exclude_from_search'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('If active it will exclude the Team Showcase entries from the General Search Results (General Search Form). <br /> You can place a Search Form specific for Team Showcase entries using the widget option available or placing the following shortcode in your page:<br /> 
      <code>[show-team-search filter="" url =""]</code> Where filter = true or false and url = link to a page where you have placed a Team Showcase shortcode (you can leave it blank and it will default to the theme search results page).','tshowcase'); ?>
    </span></td>
    </tr>

     <tr>
    <td width="150" align="right"><?php echo __('Autocomplete Suggestions','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_autocomplete]" type="checkbox" id="tshowcase-settings[tshowcase_autocomplete]" value="1" <?php if(isset($options['tshowcase_autocomplete'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('If enabled, when user writes on search input, autocomplete suggestions will display. Only the Name of members entries will be considered.','tshowcase'); ?>
    </span></td>
    </tr>

     <tr>
    <td width="150" align="right"><?php echo __('Go to single page','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_autocomplete_click]" type="checkbox" id="tshowcase-settings[tshowcase_autocomplete_click]" value="1" <?php if(isset($options['tshowcase_autocomplete_click'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('If enabled, when user clicks the suggestion, the single page for that entry will open','tshowcase'); ?>
    </span></td>
    </tr>

    <tr>
    <td width="150" align="right"><?php echo __('Search all fields','tshowcase'); ?></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_search_meta]" type="checkbox" id="tshowcase-settings[tshowcase_search_meta]" value="1" <?php if(isset($options['tshowcase_search_meta'])) { echo 'checked="checked"';}  ?>></td>
    <td><span class="howto"><?php echo __('When disabled, the search will only consider the Title/Name and content of each entry. When including all fields, you may experience speed issues.','tshowcase'); ?>
    </span></td>
    </tr>
  
  
  <tr>
    <td width="150" align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Single Page Settings','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right"><?php echo __('Active','tshowcase'); ?>:</td>
    <td nowrap><select name="tshowcase-settings[tshowcase_single_page]">
      <option value="true" <?php selected($options['tshowcase_single_page'], 'true' ); ?>><?php echo __('Yes','tshowcase'); ?></option>
      <option value="false" <?php selected($options['tshowcase_single_page'], 'false' ); ?>><?php echo __('No','tshowcase'); ?></option>
    </select></td>
    <td><span class="howto"><?php echo __("If active, single pages for each entry will be available.  <strong> If your single pages are not working and you get a 404 Page not Found error, try resaving your <a href='<?php echo get_admin_url(); ?>options-permalink.php'>permalink options</a>.",'tshowcase'); ?></strong></span></td>
  </tr>
  <tr>
    <td align="right"><?php echo __('Page Template:','tshowcase'); ?><br><span class="howto">This will be theme dependent</span></td>
    <?php $options['tshowcase_single_page_template'] = isset($options['tshowcase_single_page_template']) ? $options['tshowcase_single_page_template'] : 'post'; ?>
    <td nowrap><select name="tshowcase-settings[tshowcase_single_page_template]">
      <option value="post" <?php selected($options['tshowcase_single_page_template'], 'post' ); ?>>Post</option>
      <option value="page" <?php selected($options['tshowcase_single_page_template'], 'page' ); ?>>Page</option>
      <?php
      if (function_exists('get_page_templates')) { 

        $templates = get_page_templates();
         foreach ( $templates as $template_name => $template_filename ) { ?>
             <option value="<?php echo $template_filename; ?>" <?php selected($options['tshowcase_single_page_template'], $template_filename ); ?>><?php echo $template_name; ?></option>
         <?php }

      }
     
   ?>


    </select></td>
    <td><span class="howto"><?php echo __("This option will depend on your theme. Many themes display extra meta information on post pages such as <i>posted by</i> or <i>post date</i> information, which may not be desired. Usually, page templates contain the essential information. If you choose <i>Pages</i> then the team members will be shown using your theme default page template. <storng>Be aware that some themes will not work with this option</strong>, if so (or you want to make a custom page), you can create a file named <code>single-tshowcase.php</code> <a href='http://codex.wordpress.org/Post_Types#Template_Files'>as shown on the wordpress codex</a>, and leave this set to Posts.",'tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right"><?php echo __('Layout','tshowcase'); ?>:</td>
    <td nowrap><select name="tshowcase-settings[tshowcase_single_page_style]">
      <option value="none" <?php selected($options['tshowcase_single_page_style'], 'none' ); ?>><?php echo __('None','tshowcase'); ?></option>
      <option value="responsive" <?php selected($options['tshowcase_single_page_style'], 'responsive' ); ?>><?php echo __('Columns','tshowcase'); ?></option>
      <option value="vcard" <?php selected($options['tshowcase_single_page_style'], 'vcard' ); ?>><?php echo __('Information Card','tshowcase'); ?></option>
      </select></td>
    <td><span class="howto"><?php echo __('Choose the layout type for the single page.','tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right" nowrap><label for="tshowcase-settings[tshowcase_single_show_posts]"><?php echo __('Show Latest Posts','tshowcase'); ?></label></td>
    <td nowrap><input name="tshowcase-settings[tshowcase_single_show_posts]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_posts]" value="1"  <?php if(isset($options['tshowcase_single_show_posts'])) { echo 'checked="checked"';}  ?>>
      <input type="text" name="tshowcase-settings[tshowcase_latest_title]" id="tshowcase-settings[tshowcase_latest_title]" value="<?php if(isset($options['tshowcase_latest_title'])) { echo $options['tshowcase_latest_title'];}  ?>"></td>
    <td><span class="howto"><?php echo __('When active, if there is a user associated with with the entry, it will display his latest posts, if available.','tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right" valign="top" nowrap><?php echo __('Display:','tshowcase'); ?></td>
    <td nowrap><table border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_title]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_title]" value="1" <?php if(isset($options['tshowcase_single_show_title'])) { echo 'checked="checked"';}  ?>>
          </td>
        <td nowrap><?php echo __($ts_labels['name']['label'],'tshowcase'); ?></td>
      </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_social]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_social]" value="1" <?php if(isset($options['tshowcase_single_show_social'])) { echo 'checked="checked"';}  ?>>
          </td>
        <td nowrap><?php echo __($ts_labels['socialicons']['label'],'tshowcase'); ?></td>
      </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_smallicons]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_smallicons]" value="1" <?php if(isset($options['tshowcase_single_show_smallicons'])) { echo 'checked="checked"';}  ?>>
         </td>
        <td nowrap><?php echo __($ts_labels['smallicons']['label'],'tshowcase'); ?></td>
      </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_photo]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_photo]" value="1" <?php if(isset($options['tshowcase_single_show_photo'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo __($ts_labels['photo']['label'],'tshowcase'); ?> <select name="tshowcase-settings[tshowcase_single_photo_shape]" id="tshowcase-settings[tshowcase_single_photo_shape]">
              <option value="img-square" <?php selected($options['tshowcase_single_photo_shape'],'img-square'); ?>><?php echo __('Square (normal)','tshowcase'); ?></option>
              <option value="img-rounded" <?php selected($options['tshowcase_single_photo_shape'],'img-rounded'); ?>><?php echo __('Rounded Corners','tshowcase'); ?></option>
              <option value="img-circle" <?php selected($options['tshowcase_single_photo_shape'],'img-circle'); ?>><?php echo __('Circular','tshowcase'); ?></option>
        </select></td>
      </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_freehtml]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_freehtml]" value="1" <?php if(isset($options['tshowcase_single_show_freehtml'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo __($ts_labels['html']['label'],'tshowcase'); ?></td>
        </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_position]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_position]" value="1" <?php if(isset($options['tshowcase_single_show_position'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo __($ts_labels['position']['label'],'tshowcase'); ?></td>
        </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_email]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_email]" value="1" <?php if(isset($options['tshowcase_single_show_email'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo __($ts_labels['email']['label'],'tshowcase'); ?></td>
        </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_telephone]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_telephone]" value="1" <?php if(isset($options['tshowcase_single_show_telephone'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo __($ts_labels['telephone']['label'],'tshowcase'); ?></td>
        </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_location]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_location]" value="1" <?php if(isset($options['tshowcase_single_show_location'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo __($ts_labels['location']['label'],'tshowcase'); ?></td>
        </tr>
      <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_website]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_website]" value="1" <?php if(isset($options['tshowcase_single_show_website'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo __($ts_labels['website']['label'],'tshowcase'); ?></td>
        </tr>
      
     

        <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_groups]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_groups]" value="1" <?php if(isset($options['tshowcase_single_show_groups'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php echo $options['tshowcase_name_category']; ?></td>
        </tr>
       
     
       <?php
       if(isset($options['tshowcase_second_tax'])) { ?>
     

 <tr>
        <td nowrap><input name="tshowcase-settings[tshowcase_single_show_taxonomy]" type="checkbox" id="tshowcase-settings[tshowcase_single_show_taxonomy]" value="1" <?php if(isset($options['tshowcase_single_show_taxonomy'])) { echo 'checked="checked"';}  ?>></td>
        <td nowrap><?php if(isset($options['tshowcase_name_tax2'])) { echo $options['tshowcase_name_tax2']; } ?></td>
        </tr> 

        <?php } 
       ?> 

      </table></td>
    <td valign="top"><span class="howto"><?php echo __('Set of options to display in the single page.','tshowcase'); ?></span> </td>
  </tr>
  <tr>
    <td align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Archive Page','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><?php echo __('Archive Custom URL','tshowcase'); ?>:</td>
    <td nowrap><input type="text" name="tshowcase-settings[tshowcase_archive_url]" value="<?php if(isset($options['tshowcase_archive_url'])) { echo $options['tshowcase_archive_url']; } ?>" /></td>
    <td><span class="howto"><?php echo __('Sometimes breadcrumbs will link to the default theme archive page, which does not have the layout you want. You can setup here the URL you want the archive page to redirect to.','tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Feature Names','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><?php echo __('Singular Name','tshowcase'); ?>:</td>
    <td nowrap><input type="text" name="tshowcase-settings[tshowcase_name_singular]" value="<?php echo $options['tshowcase_name_singular']; ?>" /></td>
    <td><span class="howto"><?php echo __('These will be the labels for your features.','tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right"><?php echo __('Plural Name','tshowcase'); ?>:</td>
    <td nowrap><input type="text" name="tshowcase-settings[tshowcase_name_plural]" value="<?php echo $options['tshowcase_name_plural']; ?>" /></td>
    <td>&nbsp;</td>
  </tr>

<tr>
    <td align="right"><?php echo __('Slug','tshowcase'); ?>:</td>
    <td nowrap><input type="text" name="tshowcase-settings[tshowcase_name_slug]" value="<?php echo $options['tshowcase_name_slug']; ?>" /></td>
    <td><strong><span class="howto"><?php echo __("If you change this option, you might have to update/save the 'permalink' settings again. The slug value should be unique. There can't be any other page or post with the same slug as this.",'tshowcase'); ?></span></strong></td>
  

  </tr>

    <tr>
    <td align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Taxonomies','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td align="right"><?php echo __('Main Taxonomy','tshowcase'); ?>:</td>
    <td nowrap><input type="text" name="tshowcase-settings[tshowcase_name_category]" value="<?php echo $options['tshowcase_name_category']; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
        <td>&nbsp; </td>
        <td nowrap>
          <input name="tshowcase-settings[tshowcase_second_tax]" type="checkbox" id="tshowcase-settings[tshowcase_second_tax]" value="1" <?php if(isset($options['tshowcase_second_tax'])) { echo 'checked="checked"';}  ?>>      
          <?php echo __('Enable Second Taxonomy','ttshowcase'); ?></td>
      </tr>
   <tr>
    <td align="right"><?php echo __('Second Taxonomy','tshowcase'); ?>:</td>
    <td nowrap><input type="text" name="tshowcase-settings[tshowcase_name_tax2]" value="<?php if(isset($options['tshowcase_name_tax2'])) { echo $options['tshowcase_name_tax2']; }; ?>" /></td>
    <td><span class="howto"><strong><?php echo __('Attention! Beta Feature. Second taxonomy can only be used as a filter in the search form. Live filter will only allow you to filter by main category. You can use the parameter taxonomy="true" in your search shortcode to display the second dropdown filter.','tshowcase');?></strong></span></td>
  </tr>
  

   </tr>


  <tr>
    <td align="right" style="background-color:#f5f5f5;"><strong><?php echo __('Custom Styles & Scripts','tshowcase'); ?></strong></td>
    <td nowrap>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top"><?php echo __('Custom CSS','tshowcase'); ?>:</td>
    <td nowrap><textarea rows="6" columns="10" name="tshowcase-settings[tshowcase_custom_css]"><?php if(isset($options['tshowcase_custom_css'])) { echo $options['tshowcase_custom_css']; } ?></textarea></td>
    <td><span class="howto"><?php echo __('Place here any custom CSS you want to display together with the Team Showcase layout.','tshowcase'); ?></span></td>
  </tr>
  <tr>
    <td align="right" valign="top"><?php echo __('Custom JS','tshowcase'); ?>:</td>
    <td nowrap><textarea rows="6" columns="10" name="tshowcase-settings[tshowcase_custom_js]"><?php if(isset($options['tshowcase_custom_js'])) { echo $options['tshowcase_custom_js']; } ?></textarea></td>
    <td><span class="howto"><?php echo __('Place here any custom javascript you want to display together with the Team Showcase layout.','tshowcase'); ?></span></td>
  </tr>




  </table>
</div>

<div id="single"></div>

<div id="names"></div>
</div>
    
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</form>

<?php }


/* Advanced Settings Page */

function tshowcase_advanced_settings_page () { 


echo "Advanced Settings Page";


}

?>