<?php// File: sitemap.php ?>

<?php get_header(); ?>
<?php
/**
 *  Template Name: Sitemap
 */
      get_sidebar();
	  ?>
      <div id="content">
      <div id="contentLine"></div>
      <div id="mainLeftFull">
    <div class="post">
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <div class="entry"><!--
<ul id="directory_atoz">
                  <li><a href="#A"> A </a></li>
                    <li><a href="#B"> B </a></li>
                    <li><a href="#C"> C </a></li>
                    <li><a href="#D"> D </a></li>
                    <li><a href="#E"> E </a></li>
                    <li><a href="#F"> F </a></li>
                    <li><a href="#G"> G </a></li>
                    <li><a href="#H"> H </a></li>
                    <li><a href="#I"> I </a></li>
                    <li><a href="#J"> J </a></li>
                    <li><a href="#K"> K </a></li>
                    <li><a href="#L"> L </a></li>
                    <li><a href="#M"> M </a></li>
                    <li><a href="#N"> N </a></li>
                    <li><a href="#O"> O </a></li>
                    <li><a href="#P"> P </a></li>
                    <li><a href="#Q"> Q </a></li>
                    <li><a href="#R"> R </a></li>
                    <li><a href="#S"> S </a></li>
                    <li><a href="#T"> T </a></li>
                    <li><a href="#U"> U </a></li>
                    <li><a href="#V"> V </a></li>
                    <li><a href="#W"> W </a></li>
                    <li><a href="#X"> X </a></li>
                    <li><a href="#Y"> Y </a></li>
                    <li class="directory_atoz_last"> <a href="#Z"> Z </a></li>
                </ul>
-->
        <?php pause_exclude_pages(); ?>
          <?php
		  $newpage = array();
          $myposts = get_posts('numberposts=-1');
		  ?>
          <?php if(have_posts()){
			  while(have_posts()){ the_post();
                  $meta = get_post_custom();
                  if(isset($meta['list_posts'][0]) && $meta['list_posts'][0] == '1')
                  {
                      foreach($myposts as $post):
                        $key = strtolower(strip_tags($post->post_title));
                        while(isset($newpage[$key]))
                        {
                            $key .= time();
                        }
                        $newpage[$key] = '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
                      endforeach;
                  }
              }
		  }
		#echo '<textarea>';
		#ksort($newpage);
		#var_dump($newpage);
		#echo '</textarea>';
		#echo '<ul>' . wp_list_pages(array('sort_column' => $page_sort_column, 'sort_order' => $page_sort_order, 'exclude' => $page_exclude, 'depth' => $page_depth, 'show_date' => $page_show_date, 'title_li' => '', 'echo' => '0')) . '</ul></div>';
		$pages = wp_list_pages(array('title_li' => '', 'echo' => '0', 'depth' => '-1', 'sort_order'=>'post_date', 'post_status'=> 'publish'));
		$pages = explode("\n", $pages);
		#echo '<textarea>';
		#var_dump($pages);
		#echo '</textarea>';
		foreach($pages as $page){
			$key = strtolower(strip_tags($page));
			while(isset($newpage[$key]))
			{
				$key .= time();
			}
			$newpage[$key] = $page;
		}
		ksort($newpage);
		$letter = NULL;
		function atoz_header($letter)
		{
			$letter = strtoupper($letter);
			echo '<h2><a id="'.$letter.'" name="'.$letter.'"></a>'.$letter.'</h2>';
			echo '<hr />';
			echo '<ul class="directory_atoz">';
		}
		foreach($newpage as $title => $link)
		{
			if(trim($title) == "" || trim($link) == "")
				continue;
			if($letter == NULL)
			{
				$letter = $title[0];
				atoz_header($letter);
			}
			elseif($title[0] != $letter)
			{
				$letter = $title[0];
				echo '</ul>
				<p class="backtotop"><a href="#topH1">Back to top</a></p>';
				atoz_header($letter);
			}
			echo $link;
		}
		echo '</ul>';

		?>
		<?php resume_exclude_pages(); ?>

      </div>
    </div>
  </div><!--main????Full-->
</div> <!-- content -->

<div class="clear"></div>

<?php get_footer(); ?>