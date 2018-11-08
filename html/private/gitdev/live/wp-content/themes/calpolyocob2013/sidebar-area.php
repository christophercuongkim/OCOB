<!--
<div class="sidebar">

</div>
-->

<div id="rightCol">

<?php
if(!function_exists('get_post_top_ancestor_id')){
/**
 * Gets the id of the topmost ancestor of the current page. Returns the current
 * page's id if there is no parent.
 * 
 * @uses object $post
 * @return int 
 */
function get_post_top_ancestor_id(){
    global $post;
    
    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    
    return $post->ID;
}}
?>

<?php { $permalink = get_permalink($post->post_parent); } ?>

<?php if($post->post_parent || count(get_pages('child_of='.$post->ID)) > 0) {?>
<a style="text-decoration: none;" href="<?php echo $permalink; ?>"><h2>
<?php 
if($post->post_parent) {
  $parent_title = get_the_title($post->post_parent);
    echo $parent_title;
}
else { the_title(); }?>
</h2></a>
<!-- <h2><?php the_title(); ?></h2> -->
<ul class="clearfix">
    <?php wp_list_pages( array('title_li'=>'','depth'=>2,'child_of'=>get_post_top_ancestor_id()) ); ?>
</ul>
<?php }?>

<?php //if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : 

if ( is_active_sidebar( 'sidebar-widget-area' ) ) { ?>
<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
<?php }
else{ // what else
} ?>

<!-- OLD NAV IDEA
<?php
//if the post has a parent
if($post->post_parent){
  //collect ancestor pages
  $relations = get_post_ancestors($post->ID);
  //get child pages
  $result = $wpdb->get_results( "SELECT ID FROM wp_posts WHERE post_parent = $post->ID AND post_type='page'" );
  if ($result){
    foreach($result as $pageID){
      array_push($relations, $pageID->ID);
    }
  }
  //add current post to pages
  array_push($relations, $post->ID);
  //get comma delimited list of children and parents and self
  $relations_string = implode(",",$relations);
  //use include to list only the collected pages. 
  $sidelinks = wp_list_pages("title_li=&echo=0&include=".$relations_string);
}else{
  // display only main level and children
  $sidelinks = wp_list_pages("title_li=&echo=0&depth=1&child_of=".$post->ID);
}

if ($sidelinks) { ?>
  <h2><?php the_title(); ?></h2>
  <ul>
    <?php //links in <li> tags
    echo $sidelinks; ?>
  </ul>         
<?php } ?>
-->



<!-- <div id="footerSocial">
  <a href="https://www.facebook.com/CalPolyOrfaleaCollege"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/facebook.png" alt="Facebook" width="32" height="32"/></a>
  <a href="http://www.linkedin.com/groups?mostPopular=&amp;gid=79983&amp;trk=myg_ugrp_ovr"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/linkedin.png" alt="Linked In" width="32" height="32"/></a>
  <a href="https://twitter.com/#!/OrfaleaCollege"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/twitter.png" alt="Twitter" width="32" height="32"/></a>
  <a href="http://www.flickr.com/photos/30208331@N03/sets/"><img src="http://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/footer/flickr.png" alt="Flickr" width="32" height="32"/></a>
  <a href="http://www.youtube.com/CalPolyOCOB"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/youtube_icon.png" alt="YouTube" width="32" height="32"/></a>
  <a href="http://www.calpolylink.com/"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/polylink_icon.png" alt="Polylink" width="32" height="32"/></a>
</div> -->

<!-- 
<h2><a href="#">menu header-h2</a></h2>
<ul>
  <li><a href="#">First Tier 1</a>
    <ul>
      <li><a href="#">Second Tier 1</a>
        <ul>
          <li><a href="#">Third Tier 1</a></li>
          <li><a href="#">Third Tier 2 - with extra text that wraps to another line</a></li>
          <li><a href="#">Third Tier 3</a></li>
        </ul>
      </li>
      <li><a href="#">Second Tier 2</a></li>
      <li><a href="#">Second Tier 3 - with extra text that wraps to another line</a></li>
    </ul>
  </li>
  <li><a href="#">First Tier 2</a></li>
  <li><a href="#">First Tier 3 - with extra text that wraps to another line</a></li>
  <li><a href="#">First Tier 4</a></li>
  <li><a href="#">First Tier 5</a></li>
</ul>
<h2>Useful Links-h2</h2>
<ul>
  <li><a href="#">First Tier 1</a></li>
  <li><a href="#">First Tier 2</a></li>
  <li><a href="#">First Tier 3</a></li>
  <li><a href="#">First Tier 4</a></li>
  <li><a href="#">First Tier 5</a></li>
  <li><a href="#">First Tier 6</a></li>
</ul>
<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/sample-images/cal_to_action_button.jpg" alt="Support Ipsum" width="187" height="51" /></a>

<div id="dailyBox">
	<div>
        <h2>Tuesday  August 16, 2011</h2>
        	<img src="<?php bloginfo('template_directory'); ?>/images/sample-images/img4-50x50.jpg" alt="image" height="50px" width="50" />
            <h3><a href="#">San Luis Obispo</a></h3>
            <p>Cras egestas, turpis ac faucibus semper, purus ante facilisis.</p>
    </div>
</div>

<blockquote>
    <p>Homenum revelio suscipit quam eu felis vulputate tincidunt. In malesuada porta nisl vel euismond.</p>
    <p>&nbsp;&nbsp;&mdash;varrius aculumn</p>
</blockquote>

<div id="news">
    <h2>News</h2>
    <ul>
        <li><a href="#">Vestibulum Pretium Libero<br /><span>aug 19, 2011</span></a></li>
        <li><a href="#">Quisque sagittis Pulvinar Nisl, Non Iaculis Sem...<br /><span>aug 19, 2011</span></a></li>
        <li><a href="#">Aliquam a Lacus Enim<br /><span>aug 17, 2011</span></a></li>
        <li><a href="#">Maecenas ut Orci Ourus, in Scelerisque Enim<br /><span>aug 05, 2011</span></a></li>
        <li><a href="#">Pulvinar Pharetra Hendrerit Eget Reparo<br /><span>jul 23, 2011</span></a></li>
        <li><a href="#">Accio Wond<br /><span>jul 01, 2011</span></a></li>
        <li><a href="#">See All Articles</a></li>
    </ul>
</div>

<div id="newsColor">
    <h2>News</h2>
    <ul>
        <li><a href="#">
            Vestibulum Pretium Libero<br />
            <span>aug 19, 2011</span>
        </a></li>
        <li><a href="#">
            Quisque sagittis Pulvinar Nisl, Non Iaculis Sem...<br />
            <span>aug 19, 2011</span>
        </a></li>
        <li><a href="#">
            Aliquam a Lacus Enim<br />
            <span>aug 17, 2011</span>
        </a></li>
        <li><a href="#">
            Maecenas ut Orci Ourus, in Scelerisque Enim<br />
            <span>aug 05, 2011</span>
        </a></li>
        <li><a href="#">
            Pulvinar Pharetra Hendrerit Eget Reparo<br />
            <span>jul 23, 2011</span>
        </a></li>
        <li><a href="#">
            Accio Wond<br />
            <span>jul 01, 2011</span>
        </a></li>
        <li><a href="#">See All Articles</a></li>
    </ul>
</div>
-->

</div>