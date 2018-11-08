<?php
if ( -1 == $number) {
  /* default options go here */
  $number = '%i%';
  $title = __('Pages', 'collapsing-pages');
  $showPostCount = 'yes';
  $sort='pageName';
  $sortOrder = 'ASC';
  $linkToPage='yes';
  $postTitleLength=0;
  $defaultExpand='';
  $expand='1';
  $customExpand='';
  $customCollapse='';
  $depth=-1;
  $inExcludePage='include';
  $inExcludePages='';
  $showPosts='yes';
  $showPages='no';
  $animate=0;
  $debug=0;
} else {
  $title = attribute_escape($options[$number]['title']);
  $showPostCount = $options[$number]['showPostCount'];
  $expand = $options[$number]['expand'];
  $customExpand = $options[$number]['customExpand'];
  $customCollapse = $options[$number]['customCollapse'];
  $depth = $options[$number]['depth'];
  $sort = $options[$number]['sort'];
  $sortOrder = $options[$number]['sortOrder'];
  $linkToPage = $options[$number]['linkToPage'];
  $postTitleLength = $options[$number]['postTitleLength'];
  $inExcludePages = $options[$number]['inExcludePages'];
  $inExcludePage = $options[$number]['inExcludePage'];
  $defaultExpand = $options[$number]['defaultExpand'];
  $showPosts = $options[$number]['showPosts'];
  $showPages = $options[$number]['showPages'];
  $animate = $options[$number]['animate'];
  $debug = $options[$number]['debug'];
}
?>
