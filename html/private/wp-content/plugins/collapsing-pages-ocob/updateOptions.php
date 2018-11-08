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
      if( isset($new_instance['animate'])) {
        $animate= 1 ;
      } else {
        $animate=0;
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
      if ($new_instance['showPosts']) {
        $showPosts= true ;
      } else {
        $showPosts=false;
      }
      $depth=$new_instance['depth'];
      $postTitleLength=$new_instance['postTitleLength'];
      $useCookies=true;
      if (!isset($new_instance['useCookies'])) {
        $useCookies= false ;
      }
      $instance = compact(
          'title','sort','sortOrder','defaultExpand',
          'expand','inExcludePage','inExcludePages', 'depth',
          'animate', 'debug', 'showPosts', 'customExpand', 'customCollapse',
          'linkToPage', 'postTitleLength','expandWidget', 'useCookies');

?>
