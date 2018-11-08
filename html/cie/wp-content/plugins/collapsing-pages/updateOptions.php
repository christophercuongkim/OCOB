<?php
      $title=$new_instance['title'];
      $sortOrder= 'ASC' ;
      if ($new_instance['sortOrder'] == 'DESC') {
        $sortOrder= 'DESC' ;
      }
      if ($new_instance['sort'] == 'pageName') {
        $sort= 'pageName' ;
      } elseif ($new_instance['sort'] == 'pageId') {
        $sort= 'pageId' ;
      } elseif ($new_instance['sort'] == 'pageSlug') {
        $sort= 'pageSlug' ;
      } elseif ($new_instance['sort'] == 'menuOrder') {
        $sort= 'menuOrder' ;
      } elseif ($new_instance['sort'] == '') {
        $sort= '' ;
        $sortOrder= '' ;
      }
      $expand= $new_instance['expand'];
      $customExpand= $new_instance['customExpand'];
      $customCollapse= $new_instance['customCollapse'];
      $inExcludePage= $new_instance['inExcludePage'];
      if( isset($new_instance['accordion'])) {
        $accordion= 1 ;
      } else {
        $accordion=0;
      }
      $debug=false;
      if (isset($new_instance['debug'])) {
        $debug= true ;
      }
      $expandWidget=false;
      if (isset($new_instance['expandWidget'])) {
        $expandWidget= true ;
      }
      if ($new_instance['linkToPage']=='yes') {
        $linkToPage=true;
      } else {
        $linkToPage=false;
      }
      $inExcludePages=addslashes($new_instance['inExcludePages']);
      $defaultExpand=addslashes($new_instance['defaultExpand']);
      if ($new_instance['currentPageOnly']) {
        $currentPageOnly= true ;
      } else {
        $currentPageOnly=false;
      }
      if ($new_instance['showTopLevel']) {
        $showTopLevel= false ;
      } else {
        $showTopLevel=true;
      }
      $depth=$new_instance['depth'];
      $postTitleLength=$new_instance['postTitleLength'];
      $useCookies=true;
      if (!isset($new_instance['useCookies'])) {
        $useCookies= false ;
      }
/* update style settings */
      $style = $new_instance['style'];
/*
    $id = $this->get_field_id('list');
    $widgetStyle = $new_instance['style'];
    $styles = get_option('collapsPageStyles');
    $styles[$id] = $this->set_style($widgetStyle, $id);
    update_option('collapsPageStyles', $styles);
    $out = var_export($id, TRUE);
    $handle = fopen('collapsewidget.txt', 'w');
    fwrite($handle, $out);
    fclose($handle);
    */

      $instance = compact(
          'title','sort','sortOrder','defaultExpand', 'showTopLevel',
          'expand','inExcludePage','inExcludePages', 'depth', 'style',
          'accordion', 'debug', 'currentPageOnly', 'customExpand', 'customCollapse',
          'linkToPage', 'postTitleLength','expandWidget', 'useCookies');

?>
