<?php// File: sidebar-area.php ?>

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

<!--
<?php if($post->post_parent || count(get_pages('child_of='.$post->ID)) > 0) {?>
<a style="text-decoration: none;" href="<?php echo $permalink; ?>"><h2>
<?php 
if($post->post_parent) {
  $parent_title = get_the_title($post->post_parent);
    echo $parent_title;
}
else { the_title(); }?>
</h2></a>

<ul class="clearfix">
    <?php 
	    	wp_list_pages( array('title_li'=>'','depth'=>2,'child_of'=>get_post_top_ancestor_id()) ); 
	?>
</ul>
<?php }?>
-->

<?php 
if ( is_active_sidebar( 'sidebar-widget-area' ) ) { ?>
<?php 
	 	$menuID = get_post_custom_values("sidebarSelectArea")[0];
	    showCustomFieldMenuSelector($menuID);
	    dynamic_sidebar( 'sidebar-widget-area' ); 
		?>
<?php }
else{ // what else
} ?>

</div>
<script>
	console.log('<?php echo get_post_custom_values("sidebarSelectArea")[0]; ?>')	;
</script>