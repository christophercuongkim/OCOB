    <p>
     <input type="checkbox" name="<?php echo
     $this->get_field_name('currentPageOnly'); ?>" <?php if($currentPageOnly) echo
     'checked'; ?> id="<?php echo $this->get_field_id('currentPageOnly');
     ?>"></input> <label for="currentPageOnly"><?php _e('Show only subpages of
     current page', 'collapsing-pages');?></label>
     <input type="checkbox" name="<?php echo
     $this->get_field_name('showTopLevel'); ?>" <?php if(!$showTopLevel) echo
     'checked'; ?> id="<?php echo $this->get_field_id('showTopLevel');
     ?>"></input> <label for="showTopLevel"><?php _e('Hide top-level pages', 'collapsing-pages');?></label>
   </p>
    <p><?php _e('Sort by:', 'collapsing-pages');?>&nbsp;&nbsp;
     <select name="<?php echo $this->get_field_name('sort'); ?>">
     <option   <?php if($sort=='pageName') echo 'selected="selected"'; ?> id="<?php echo $this->get_field_id('sortPageName'); ?>" value='pageName'><?php _e('Page name', 'collapsing-pages');?></option>
     <option  <?php if($sort=='pageId') echo 'selected="selected"'; ?> id="<?php echo $this->get_field_id('sortPageId'); ?>" value='pageId'><?php _e('Page id', 'collapsing-pages');?></option>
     <option  <?php if($sort=='pageSlug') echo 'selected="selected"'; ?> id="<?php echo $this->get_field_id('sortPageSlug'); ?>" value='pageSlug'><?php _e('Page Slug', 'collapsing-pages');?></option>
     <option  <?php if($sort=='menuOrder') echo 'selected="selected"'; ?> id="<?php echo $this->get_field_id('sortMenuOrder'); ?>" value='menuOrder'><?php _e('Menu Order', 'collapsing-pages');?></option>
    </select>
    <select name="<?php echo $this->get_field_name('sortOrder'); ?>">
         <option <?php if($sortOrder=='ASC') echo 'selected="selected"'; ?> id="<?php echo $this->get_field_id('sortASC'); ?>" value='ASC'><?php _e('Ascending', 'collapsing-pages');?></option>
     <option   <?php if($sortOrder=='DESC') echo 'selected="selected"'; ?> id="<?php echo $this->get_field_id('sortDESC'); ?>" value='DESC'><?php _e('Descending', 'collapsing-pages');?></option>
    </select>
    </p>
    <p><?php _e('Expanding and collapse characters:', 'collapsing-pages');?><br />
     <strong>html:</strong> <input type="radio" name="<?php echo $this->get_field_name('expand'); ?>" <?php if($expand==0) echo 'checked'; ?> id="expand0" value='0'></input> <label for="expand0">&#9658;&nbsp;&#9660;</label>
     <input type="radio" name="<?php echo $this->get_field_name('expand'); ?>" <?php if($expand==1) echo 'checked'; ?> id="expand1" value='1'></input> <label for="expand1">+&nbsp;&mdash;</label>
     <input type="radio" name="<?php echo $this->get_field_name('expand'); ?>"
     <?php if($expand==2) echo 'checked'; ?> id="expand2" value='2'></input>
     <label for="expand2">[+]&nbsp;[&mdash;]</label>&nbsp;&nbsp;

     <input type="radio" name="<?php echo $this->get_field_name('expand'); ?>"
     <?php if($expand==4) echo 'checked'; ?> id="expand4" value='4'></input>
     <label for="expand4">custom</label>
     <?php _e('expand:', 'collapsing-pages'); ?>
     <input type="text" size='1' name="<?php echo $this->get_field_name('customExpand'); ?>" value="<?php echo $customExpand ?>" id="<?php echo $this->get_field_id('customExpand'); ?>"></input> 
     <?php _e('collapse:', 'collapsing-pages'); ?>
     <input type="text" size='1' name="<?php echo $this->get_field_name('customCollapse'); ?>" value="<?php echo $customCollapse ?>" id="<?php echo $this->get_field_id('customCollapse'); ?>"></input> 
     <?php _e('<strong>images:</strong>', 'collapsing-pages');?>
     <input type="radio" name="<?php echo $this->get_field_name('expand'); ?>"
     <?php if($expand==3) echo 'checked'; ?> id="expand0" value='3'></input>
     <label for="expand3"><img src='<?php echo get_settings('siteurl') .
     "/wp-content/plugins/collapsing-pages/" ?>img/collapse.gif' />&nbsp;<img
     src='<?php echo get_settings('siteurl') .
     "/wp-content/plugins/collapsing-pages/" ?>img/expand.gif' /></label>
    </p>
    <p><?php _e('Include pages at this depth:', 'collapsing-pages');?>&nbsp;&nbsp;
     <select name="<?php echo $this->get_field_name('depth'); ?>"  id="<?php echo $this->get_field_id('depth'); ?>">
        <option <?php if ($depth==-1) echo "selected='selected'" ?> value="-1"><?php _e('All levels (default)', 'collapsing-pages');?></option>
        <option <?php if ($depth==0) echo "selected='selected'" ?> value="0"><?php _e('Only main pages', 'collapsing-pages');?></option>
        <option <?php if ($depth==1) echo "selected='selected'" ?> value="1"><?php _e('Sub-pages', 'collapsing-pages');?></option>
        <option <?php if ($depth==2) echo "selected='selected'" ?> value="2"><?php _e('Sub-sub-pages', 'collapsing-pages');?></option>
        <option <?php if ($depth==3) echo "selected='selected'" ?>value="3"><?php _e('Sub-sub-sub-pages', 'collapsing-pages');?></option>
    </select> 
    </p>
    <p>
     <select name="<?php echo $this->get_field_name('inExcludePage'); ?>">
     <option  <?php if($inExcludePage=='include') echo 'selected'; ?> id="inExcludePageInclude-<?php echo $number ?>" value='include'><?php _e('Include', 'collapsing-pages');?></option>
     <option  <?php if($inExcludePage=='exclude') echo 'selected'; ?> id="inExcludePageExclude-<?php echo $number ?>" value='exclude'><?php _e('Exclude', 'collapsing-pages');?></option>
     </select>
     <?php _e('these pages (input slug or ID separated by commas):', 'collapsing-pages');?><br />
    <input type="text" name="<?php echo $this->get_field_name('inExcludePages') ?>" value="<?php echo $inExcludePages ?>"  
    id="<?php echo $this->get_field_id('inExcludePages'); ?>"></input> 
    </p>
    <p><?php _e('Auto-expand these pages (input slug or ID separated by commas):', 'collapsing-pages');?><br />
     <input type="text" name="<?php echo $this->get_field_name('defaultExpand'); ?>" value="<?php echo $defaultExpand ?>" id="<?php echo $this->get_field_id('defaultExpand'); ?>"></input> 
    </p>
    <p><?php _e('Clicking on page name:', 'collapsing-pages');?>
    <select name="<?php echo $this->get_field_name('linkToPage'); ?>">
     <option  
     <?php if($linkToPage) echo 'selected="selected"'; ?>
     id="<?php echo $this->get_field_id('linkToPageYes'); ?>"
     value='yes'><?php _e('Links to page', 'collapsing-pages');?></option>
     <option  <?php if(!$linkToPage) echo 'selected="selected"'; ?>
     id="<?php echo $this->get_field_id('linkToPageNo'); ?>"
     value='no'><?php _e('Expands to show sub-pages', 'collapsing-pages');?> </option>
    </select>
    </p>
   <p>
   <?php _e('Truncate Post Title to') ?>
   <input type="text" size='3' name="<?php echo $this->get_field_name('postTitleLength'); ?>"
   id="<?php echo $this->get_field_id('postTitleLength') ?>" value="<?php echo
   $postTitleLength; ?>"></input> <label
   for="postTitleLength"><?php _e('characters') ?></label>
   </p>
  <p><label for='<?php echo $this->get_field_id("style")?>'><?php _e('Style',
  'collapsing-pages')?></label>
  <select id='<?php echo $this->get_field_id("style")?>'
    name='<?php echo $this->get_field_name("style")?>'>
  <?php $styles = get_option('collapsPageStyles'); ?>
  <?php foreach ($styleOptions as $key =>$value): ?>
  <option value='<?php echo attribute_escape($key) ?>' 
  <?php if ($style == $key) echo "selected='selected'" ?>>
  <?php echo $value ?></option>
  <?php endforeach ?>
  </select>
  </p>
  <a style='cursor:pointer' onclick='showAdvanced("<?php echo $this->get_field_id('advanced') ?>", "<?php echo $this->get_field_id('arrow') ?>");'><span id="<?php echo $this->get_field_id('arrow') ?>">&#9654;</span> Advanced options</a>
  <div id="<?php echo $this->get_field_id('advanced') ?>" style='display:none;'>
   <p>
     <input type="checkbox" name="<?php echo
     $this->get_field_name('useCookies'); ?>"
<?php if ($useCookies)  echo 'checked'; ?> id="<?php echo
$this->get_field_id('useCookies'); ?>"></input><label for="<?php echo
$this->get_field_id('useCookies'); ?>"><?php _e('Remember expanding and collapsing for each visitor (using cookies)', 'collapsing-pages'); ?></label>
   </p>
    <p>
     <input type="checkbox" name="<?php echo $this->get_field_name('expandWidget'); ?>"
<?php if ($expandWidget)  echo 'checked'; ?> id="collapsPage-expandWidget-<?php echo
$number ?>"></input> <label for="collapsPageexpandWidget"><?php _e('Make whole
widget collapsible', 'collapsing-pages');?></label>
    </p>
   <p>
     <input type="checkbox" id="<?php echo $this->get_field_id('accordion'); ?>" name="<?php echo $this->get_field_name('accordion'); ?>"
<?php if ($accordion)  echo 'checked'; ?> id="<?php echo $this->get_field_id('accordion'); ?>"></input><label for="<?php echo $this->get_field_id('accordion'); ?>"><?php _e('Accordion style', 'collapsing-pages')?> <a class='help' title='<?php _e('When expanding one parent page, close all others', 'collapsing-pages')?>'>?</a></label>   </p>
    <p>
     <input type="checkbox" name="<?php echo $this->get_field_name('debug'); ?>"
<?php if ($debug)  echo 'checked'; ?> id="collapsPage-debug-<?php echo
$number ?>"></input> <label for="collapsPageDebug"><?php _e('Show debugging information
(shows up as a hidden pre right after the title)', 'collapsing-pages');?></label>
    </p>
  </div>
  <script type='text/javascript'>
  function showAdvanced(advancedId, arrowId) {
    var advanced = document.getElementById(advancedId);
    var arrow = document.getElementById(arrowId);
    if (advanced.style.display=='none') {
      advanced.style.display='block';
      arrow.innerHTML='&#9660;';
    } else {
      advanced.style.display='none';
      arrow.innerHTML='&#9654;';
    }
  }
  </script>
