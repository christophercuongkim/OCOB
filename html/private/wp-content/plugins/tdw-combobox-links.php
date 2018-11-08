<?php
/*
 Plugin Name: TDW Combobox links
 Plugin URI: http://zazamataz.com/tdw-combobox-links.zip
 Description: displays the links in the sidebar as comboboxes
 Version: 0.01alpha
 Author: TDW
 Author URI: http://zazamataz.com/?page_id=693
 
 --------------------------------------------------
 
 TDW's experimental links as comboboxes code
 version 0.01alpha
 */
function tdw_combobox_links()
 {
 global $wpdb;
 $selector = "SELECT DISTINCT c.cat_name as cn, c.category_nicename as cname, c.category_description as cdesc,
                     l.link_name as ln, l.link_description as ldesc, l.link_url as lurl, l.link_id as lid
              FROM $wpdb->link2cat as l2c, $wpdb->links as l, $wpdb->categories as c
              WHERE l2c.category_id = c.cat_id AND l2c.link_id = l.link_id AND l.link_visible = 'Y'
              ORDER BY cn, ln";
 $la = $wpdb->get_results($selector, ARRAY_A);
 $s = count($la);
 $cvalue = "---do-not-use-this-category-name---Â‰ˆ≈ƒ÷";
 $ccat = 0;
 foreach($la as $e)
  {
  if($cvalue != $e['cn'])
   {//output a new category header and combo box here
   $cvalue = $e['cn'];
   if($ccat !== 0)
    {//first close old category
    echo '</select></form><br>';
    }//if
   //begin new category
   $ccat++;
   echo '<form id="lf' . $ccat . '" action=""><h3 title="' . $e['cdesc'] . '">' . $e['cn'] . '</h3>';
   echo '<select style="width: 120px" name="sel" onchange="window.location=(document.forms.lf' . $ccat . '.sel[document.forms.lf' . $ccat . '.sel.selectedIndex].value);">';
   echo '<option value="" title="mind the gap:)">&nbsp;</option>';
   }//if
  echo '<option value="' . $e['lurl'] . '" title="' . $e['ldesc'] . '">' . $e['ln'] . '</option>';
  }//foreach
 if($ccat !== 0)
  {//first close old category
  echo '</select></form>';
  }//if
 }//tdw_combobox_links
?>
