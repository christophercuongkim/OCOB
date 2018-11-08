<?php
/*
Collapsing Pages version: 1.0.1
Copyright 2007 Robert Felty

This file is part of Collapsing Pages

		Collapsing Pages is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published by 
    the Free Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    Collapsing Pages is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Pages; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Helper functions
function checkCurrentPage($pageIndex, $pages) {
 /* this function checks whether a given pageIndex refers to the page that is
 * being displayed. If so, it adds all parent pages to the autoExpand array, so
 * that it is automatically expanded 
 */
  global $autoExpand;
	array_push($autoExpand, $pages[$pageIndex]->post_name);
	if ($pages[$pageIndex]->post_parent!=0) {
		for ($pageIndex2=0; $pageIndex2<count($pages); $pageIndex2++) {
		  if ($pages[$pageIndex2]->ID == $pages[$pageIndex]->post_parent) {
			  checkCurrentPage($pageIndex2,$pages);
		  }
		}
	}
}

function getSubPage($page, $pages, $parents,$subPageCount, $curDepth, $expanded) {
  global  $expandSym, $collapseSym, $expandSymJS, $collapseSymJS,
      $autoExpand,  $thisPage, $options;
  extract($options);
  if ($curDepth>=$depth && $depth!=-1) {
    return;
  }
  $curDepth++;
  $subPagePosts=array();
  if (in_array($page->ID, $parents)) {
    foreach ($pages as $page2) {
        $subPageLink2=''; // clear info from subPageLink2
      $self='';
      if ($page2->ID == $thisPage) {
        $self="class='self'";
      }
      if (in_array($page2->post_name, $autoExpand)) {
        $parent="parent";
      } else {
        $parent="";
      }
      if ($page->ID==$page2->post_parent) {
        $theID='collapsPage-' . $page2->ID . ":$number";

        if (!in_array($page2->ID, $parents) || ($curDepth>=$depth &&
            $depth!=-1)) {
          /* check to see if there are more subpages under this one. If the
         * page id is not in the parents array, then there should be no more
         * subpages, and we do not print a triangle dropdown, otherwise we do
         * */
          $subPageCount++;
          $subPageLinks.=( "<li class='collapsing pages item $parent'>" );
        } else {
          if (in_array($page2->post_name, $autoExpand) ||
              in_array($page2->title, $autoExpand) || 
              ($useCookies && $_COOKIE[$theID]==1)) {
            $symbol=$collapseSym;
            $expanded = 'block';
            $show = 'collapse';
            } else {
            $symbol=$expandSym;
            $expanded = 'none';
            $show = 'expand';
          }
          list ($subPageLink2, $subPageCount,$subPagePosts)= getSubPage($page2, $pages, $parents,$subPageCount, $curDepth,$expanded);
          $theUl .= "\n     <div id='$theID' style='display:$expanded;'><ul>\n";
					$subPageLinks.="<li class='collapsing pages $parent $show'>" .
							"<span class='collapsing pages $show>' ";
					$subPageLinks.="<span class='sym'>".$symbol;
					if ($linkToPage) {
						$subPageLinks.="</span></span>";
					} else {
						$subPageLinks.="</span>";
					}
        }
        $link2 = "<a $self href='".get_page_link($page2->ID)."' ";
        $page2PostTitle=apply_filters('the_title',$page2->post_title);
        if ($linkToPage) {
          if ( empty($page2->page_description) ) {
            $link2 .= 'title="' . attribute_escape(strip_tags($page2PostTitle)). '"';
          } else {
            $link2 .= 'title="' .
                wp_specialchars(apply_filters('page_description',
                $page2->page_description,$page2)) . '"';
          }
        }
        $link2 .= '>';
        $tmp_text = '';
        if ($postTitleLength>0 && strlen($page2PostTitle)>$postTitleLength) {
          $tmp_text = substr($page2PostTitle, 0, $postTitleLength );
          $tmp_text .= ' &hellip;';
        }

        $titleText = $tmp_text == '' ? $page2PostTitle : $tmp_text;
        $link2 .= $titleText. '</a>';
        if (!$linkToPage && in_array($page2->ID, $parents)) {
          $link2.="</span>";
        }
        $subPageLinks.= $link2;
        if (in_array($page2->ID, $parents) || ($curDepth>=$depth &&
            $depth!=-1)) 
          $subPageLinks .= $theUl;
        if (!in_array($page2->ID, $parents)) {
          $subPageLinks.="</li>\n";
        }
        // add in additional subpage information
        $subPageLinks.="$subPageLink2";
        // close <ul> and <li> before starting a new page
      }
    }
    if ($showTopLevel ) {
      if ($subPageCount>0 ) {
        $subPageLinks.= "      </ul>\n";
      }
      $subPageLinks.= "      </div>\n";
      $subPageLinks.= "      </li><!-- subpagecount = $subPageCount ending subpage -->\n";
    }
  }
  return array($subPageLinks,$subPageCount,$subPagePosts);
}
/* the page and tagging database structures changed drastically between wordpress 2.1 and 2.3. We will use different queries for page based vs. term_taxonomy based database structures */
//$taxonomy=false;
function list_pages($args) {
  global $wpdb, $expand, $expandSym, $collapseSym, $expandSymJS,
      $collapseSymJS, $animate, $depth, $thisPage, $wp_query, $options;
  include('defaults.php');
  $options=wp_parse_args($args, $defaults);
  extract($options);
  if (is_home()) {
    $thisPage = get_option('page_for_posts');
  } else {
    $thisPage = $wp_query->post->ID;
  }


  include('symbols.php');

	$inExclusionsPage = array();
	if ( !empty($inExcludePage) && !empty($inExcludePages) ) {
		$exterms = preg_split('/[,]+/',$inExcludePages);
    if ($inExcludePage=='exclude') {
      $in='NOT IN';
      if ( count($exterms) ) {
        foreach ( $exterms as $exterm ) {
          if (empty($inExclusionsPage))
            $inExclusionsPage = "'" . sanitize_title($exterm) . "'";
          else
            $inExclusionsPage .= ", '" . sanitize_title($exterm) . "' ";
        }
      }
    } else {
      global $includePages;
      if ($inExcludePages!='') {
        $includePages = preg_split('/[,]+/',$inExcludePages);
        for ($i =0; $i<count($includePages); $i++) {
          $includePages[$i]= sanitize_title($includePages[$i]);
        } 
      }
    }
  }
	if ( empty($inExclusionsPage) ) {
		$inExcludePageQuery = "AND post_name NOT IN ('')";
  } else {
    //$inExcludePageQuery ="AND post_name $in ($inExclusionsPage)
    //AND ID $in ($inExclusionsPage)";
  }
	if ( !empty($exclusions) ) {
		$exclusions .= ')';
  }

  global $autoExpand;
	if ($defaultExpand!='') {
		$autoExpand = preg_split('/[,]+/',$defaultExpand);
		for ($i =0; $i<count($autoExpand); $i++) {
			$autoExpand[$i]= sanitize_title($autoExpand[$i]);
		} 
  } else {
	  $autoExpand = array();
  }

  if ($sort!='') {
    if ($sort=='pageName') {
      $sortColumn="ORDER BY $wpdb->posts.post_title";
    } elseif ($sort=='pageId') {
      $sortColumn="ORDER BY $wpdb->posts.ID";
    } elseif ($sort=='pageSlug') {
      $sortColumn="ORDER BY $wpdb->posts.post_name";
    } elseif ($sort=='menuOrder') {
      $sortColumn="ORDER BY $wpdb->posts.menu_order";
    }
    $sortOrder = $sortOrder;
  } 


      $pagequery = "SELECT $wpdb->posts.ID, $wpdb->posts.post_parent,
      $wpdb->posts.post_title, $wpdb->posts.post_name,
      date($wpdb->posts.post_date) as 'date' FROM $wpdb->posts WHERE
      $wpdb->posts.post_status='publish' AND post_type='page' $inExcludePageQuery $sortColumn $sortOrder";
  $pages = $wpdb->get_results($pagequery);
  $parents=array();

  global $includePageArray;
  $includePageArray=array();
  for ($pageIndex=0; $pageIndex<count($pages); $pageIndex++) {
    if ($pages[$pageIndex]->post_parent!=0) {
      $parents[] =  $pages[$pageIndex]->post_parent;
    }
    if ($pages[$pageIndex]->ID == $thisPage) {
			checkCurrentPage($pageIndex,$pages);
		}
    // if only including certain pages, we build an array of those page ids 
    if ($inExcludePage=='include' && $inExcludePages!='') {
      if (in_array($pages[$pageIndex]->post_name, $includePages) ||
          in_array($pages[$pageIndex]->ID, $includePages)) {
        array_push($includePageArray, $pages[$pageIndex]->ID);
      }
    }
  }
  if ($debug==1) {
    echo "<li style='display:none' >";
    printf ("MySQL server version: %s\n", mysql_get_server_info());
    echo "\ncollapsPage options:\n";
    print_r($options);
    echo "PAGE QUERY: \n $pagequery\n";
    echo "\nPAGE QUERY RESULTS\n";
    print_r($pages);
    echo "\nAUTOEXPAND\n";
    print_r($autoExpand);
    echo "</li>";
  }
  foreach( $pages as $page ) {
    $theID='collapsPage-' . $page->ID . ":$number";
    if ($currentPageOnly && !in_array($page->post_name, $autoExpand))
      continue;
    if ($inExcludePage=='include' && $inExcludePages!='') {
      if (!in_array($page->ID, $includePageArray) &&
          !in_array($page->post_parent, $includePageArray)) {
        continue;
      }
    }
		$self='';
    if ($page->ID == $thisPage) {
      $self="class='self'";
    }
    if (in_array($page->post_name, $autoExpand)) {
      $parent="parent";
    } else {
      $parent="";
    }
    if ($page->post_parent==0) {
      $lastPage= $page->ID;
      // print out page name 
      $link = "<a $self href='".get_page_link($page->ID)."' ";
      $pagePostTitle=apply_filters('the_title',$page->post_title);
			if ($linkToPage) {
				if ( empty($page->page_description) ) {
					$link .= 'title="' . attribute_escape(strip_tags($pagePostTitle)). '"';
				} else {
					$link .= 'title="' .
              wp_specialchars(apply_filters('page_description',
              $page->page_description,$page)) . '"';
				}
      }
      $link .= '>';
			$tmp_text = '';
			if ($postTitleLength>0 && strlen($pagePostTitle)>$postTitleLength) {
				$tmp_text = substr($pagePostTitle, 0, $postTitleLength );
				$tmp_text .= ' &hellip;';
			}

			$titleText = $tmp_text == '' ? $pagePostTitle : $tmp_text;
      $link .= $titleText. '</a>';

      $subPageCount=0;
      $expanded='none';
      if (in_array($page->post_name, $autoExpand) ||
          in_array($page->ID, $autoExpand) ||
              ($useCookies && $_COOKIE[$theID]==1)) {
        $expanded='block';
      }
      $curDepth=0;
      if ($depth!=0) {
        list ($subPageLinks, $subPageCount, $subPagePosts) =
            getSubPage($page, $pages, $parents,$subPageCount,
            $curDepth, $expanded);
      }
			if (!$linkToPage && $subPageCount > 1) {
			  $link.='</span>';
			}
      if ($subPageCount>0) {
        if ($expanded=='block') {
          $show='collapse';
          $symbol=$collapseSym;
        } else {
          $show='expand';
          $symbol=$expandSym;
        }
        if (in_array($page->post_name, $autoExpand) ||
            in_array($page->ID, $autoExpand)) {
          $collapseTitle = 'title="' . __('Click to collapse'). '" ';
        } else {
          $collapseTitle = 'title="' . __('Click to expand'). '" ';
        }
        $theLi = "<li class='collapsing pages $parent $show'>" . 
            "<span $collapseTitle class='collapsing pages $show'>" . 
            "<span class='sym'>$symbol</span>";
        if ($linkToPage) {
          $theLi.="</span>";
        }
      } else {
        $theLi="<li id='" . $page->post_name . "-nav'" . 
          " class='collapsing pages item $parent'>";
      } 
      if ($showTopLevel) {
        $collapse_page_text = $theLi;
        $collapse_page_text .= $link;
        if ($subPageCount>0 ) {
          $collapse_page_text .= "\n     <div id='$theID' " .
              "style='display:$expanded;'><ul>\n";
        }
      }
      $collapse_page_text .= $subPageLinks;
      // close <ul> and <li> before starting a new page
      if ($subPageCount==0 ) {
        $collapse_page_text .="                  </li> <!-- ending page subcat count = $subPageCount-->\n";
      }
      print $collapse_page_text;
    }
  }
}
?>
