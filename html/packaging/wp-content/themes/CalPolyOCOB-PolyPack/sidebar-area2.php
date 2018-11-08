<?php// File: sidebar-area2.php ?>
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
<?php if($post->post_parent || count(get_pages('child_of='.$post->ID)) > 0) {?>

<?php { $permalink = get_permalink($post->post_parent); } ?>


<!-- <h2><?php the_title(); ?></h2> -->
    <?php
	    $menuID = get_post_custom_values("sidebarSelectArea")[0];
	    showCustomFieldMenuSelector($menuID);
	     ?>
<?php }?>

<?php //if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : 

if ( is_active_sidebar( 'sidebar-widget-area' ) ) { ?>
<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
<?php }
else{ // what else
} ?>


</div>

<?php
	$menuName = get_post_custom_values("rightNavMenuSelection");
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$string = "";
	foreach ( $menus as $menu ) {
		// this echoes a list of all the menus with a comma behind them...
		$string .= $menu->name . ', ';
	}
	//move the following line to replace the content of the clearfix_menu when ready
	//custom field will replace Economics Area
	//wp_nav_menu(array('menu' => 'Economics Area'));
?>

<script>
	console.log("Hello <?php echo ($menuName); ?>");
</script>