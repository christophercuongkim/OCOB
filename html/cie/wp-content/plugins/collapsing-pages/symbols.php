<?php
  if ($expand==1) {
    $expandSym='+';
    $collapseSym='—';
  } elseif ($expand==2) {
    $expandSym='[+]';
    $collapseSym='[—]';
  } elseif ($expand==3) {
    $expandSym="<img src=\"". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-categories/" . 
         "img/expand.gif\" alt=\"expand\" />";
    $collapseSym="<img src=\"". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-categories/" . 
         "img/collapse.gif\" alt=\"collapse\" />";
  } elseif ($expand==4) {
    $expandSym=$customExpand;
    $collapseSym=$customCollapse;
  } else {
    $expandSym='&#x25BA;';
    $collapseSym='&#x25BC;';
  }
?>
