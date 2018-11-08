<?php
/*
Collapsing Pages version: 0.6.1
Copyright 2007 Robert Felty

    Collapsing Pages is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    Collapsing Pages is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Pages; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

check_admin_referer();

$options=get_option('collapsPageOptions');
$widgetOn=0;
$number='%i%';
if (empty($options)) {
  $number = '-1';
} elseif (!isset($options['%i%']['title']) || 
    count($options) > 1) {
  $widgetOn=1; 
}

if( isset($_POST['resetOptions']) ) {
  if (isset($_POST['reset'])) {
    delete_option('collapsPageOptions');   
		$widgetOn=0;
    $number = '-1';
  }
} elseif (isset($_POST['infoUpdate'])) {
  $style=$_POST['collapsPageStyle'];
  $defaultStyles=get_option('collapsPageDefaultStyles');
  $selectedStyle=$_POST['collapsPageSelectedStyle'];
  $defaultStyles['selected']=$selectedStyle;
  $defaultStyles['custom']=$_POST['collapsPageStyle'];

  update_option('collapsPageStyle', $style);
  update_option('collapsPageSidebarId', $_POST['collapsPageSidebarId']);
  update_option('collapsPageDefaultStyles', $defaultStyles);

  if ($widgetOn==0) {
    include('updateOptions.php');
  }
}
include('processOptions.php');
?>
<div class=wrap>
 <form method="post">
  <h2><? _e('Collapsing Pages Options', 'collapsPage'); ?></h2>
  <fieldset name="Collapsing Pages Options">
    <p>
 <?php _e('Id of the sidebar where collapsing pages appears:', 'collapsing-pages'); ?>
   <input id='collapsPageSidebarId' name='collapsPageSidebarId' type='text' size='20' value="<?php echo
   get_option('collapsPageSidebarId')?>" onchange='changeStyle("collapsPageStylePreview","collapsPageStyle", "collapsPageDefaultStyles", "collapsPageSelectedStyle", false);' />
   <table>
     <tr>
       <td>
  <input type='hidden' id='collapsPageCurrentStyle' value="<?php echo
stripslashes(get_option('collapsPageStyle')) ?>" />
  <input type='hidden' id='collapsPageSelectedStyle'
  name='collapsPageSelectedStyle' />
<label for="collapsPageStyle"><?php _e('Select style:', 'collapsing-pages'); ?></label>
       </td>
       <td>
       <select name='collapsPageDefaultStyles' id='collapsPageDefaultStyles'
         onchange='changeStyle("collapsPageStylePreview","collapsPageStyle", "collapsPageDefaultStyles", "collapsPageSelectedStyle", false);' />
       <?php
    $url = get_settings('siteurl') . '/wp-content/plugins/collapsing-pages';
       $styleOptions=get_option('collapsPageDefaultStyles');
       //print_r($styleOptions);
       $selected=$styleOptions['selected'];
       foreach ($styleOptions as $key=>$value) {
         if ($key!='selected') {
           if ($key==$selected) {
             $select=' selected=selected ';
           } else {
             $select=' ';
           }
           echo '<option' .  $select . 'value="'.
               stripslashes($value) . '" >'.$key . '</option>';
         }
       }
       ?>
       </select>
       </td>
       <td><?php _e('Preview', 'collapsing-pages'); ?><br />
       <img style='border:1px solid' id='collapsPageStylePreview' alt='preview'/>
       </td>
    </tr>
    </table>
    <?php _e('You may also customize your style below if you wish', 'collapsing-pages'); ?><br />
   <input type='button' value='<?php _e("restore current style", "collapsing-pages"); ?>'
onclick='restoreStyle();' /><br />
   <textarea onchange='changeStyle("collapsPageStylePreview","collapsPageStyle", "collapsPageDefaultStyles", "collapsPageSelectedStyle", true);' cols='78' rows='10' id="collapsPageStyle"name="collapsPageStyle"><?php echo stripslashes(get_option('collapsPageStyle'))?></textarea>
    </p>
<script type='text/javascript'>

function changeStyle(preview,template,select,selected,custom) {
  var preview = document.getElementById(preview);
  var pageStyles = document.getElementById(select);
  var selectedStyle;
  var hiddenStyle=document.getElementById(selected);
  var pageStyle = document.getElementById(template);
  if (custom==true) {
    selectedStyle=pageStyles.options[pageStyles.options.length-1];
    selectedStyle.value=pageStyle.value;
    selectedStyle.selected=true;
  } else {
    for(i=0; i<pageStyles.options.length; i++) {
      if (pageStyles.options[i].selected == true) {
        selectedStyle=pageStyles.options[i];
      }
    }
  }
  hiddenStyle.value=selectedStyle.innerHTML
  preview.src='<?php echo $url ?>/img/'+selectedStyle.innerHTML+'.png';
  var sidebarId=document.getElementById('collapsPageSidebarId').value;

  if (sidebarId!='') {
    var theStyle = selectedStyle.value.replace(/#[a-zA-Z]+\s/g, '#'+sidebarId + ' ');
  } else {
    var theStyle = selectedStyle.value.replace(/#[a-zA-Z]+\s/g, '');
  }
  pageStyle.value=theStyle
}

function restoreStyle() {
  var defaultStyle = document.getElementById('collapsPageCurrentStyle').value;
  var pageStyle = document.getElementById('collapsPageStyle');
  pageStyle.value=defaultStyle;
}
  changeStyle('collapsPageStylePreview','collapsPageStyle', 'collapsPageDefaultStyles', 'collapsPageSelectedStyle', false);

</script>
  </fieldset>
  <div class="submit">
   <input type="submit" name="infoUpdate" value="<?php _e('Update options', 'collapsPage'); ?> &raquo;" />
  </div>
 </form>
</div>
