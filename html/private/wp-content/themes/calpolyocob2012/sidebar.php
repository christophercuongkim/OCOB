<?php// File: sidebar.php ?>

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
	}
}
?>
<?php 
		$menuID = get_post_custom_values("sidebarSelectArea")[0];
		//var_dump($menuID);
		if($menuID){
	    	showCustomFieldMenuSelector($menuID);
	    }else{
		    ?>
		    	<h2><a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a></h2>
			    <?php wp_nav_menu(array('theme_location' => 'sidebar')); ?>
		    <?php
	    }
	 ?>

<?php 
if ( is_active_sidebar( 'sidebar-widget-area' ) ) { ?>
<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
<?php }
else{ // what else
} ?>

</div>

<script>
console.log(<?php echo $menuID; ?>);
</script>
<?php 
//$items = wp_get_nav_menu_items( $menuID);
?> 