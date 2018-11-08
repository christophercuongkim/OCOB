<?php
/**
 * Plugin Name: Custom Field Menu Selector
 * Plugin URI: N/A
 * Description: Custom Field Menu Selector for OCOB
 * Version: 1.0.0
 * Author: Bo Oelkers
 * Author URI: N/A
 * License: Open Source
 */

/**
 * Function used by Wordpress Admin Page Edit pages
 * This funciton adds the postbox to the screen with all of the menus listed for the subblog
 */
function addCustomMenu(){
	//gets a list of menus from the current subblog
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$string = "";
	?>
	<div class="postbox  acf_postbox default">
		<h3>Right Side Menu</h3>
		<div class="inside">
			<div class="field">
				Right Side Menu : <select id='rightNavMenuSelection' name='rightNavMenuSelection' onchange='updateVal(this.value)'>
					<option value='INHERIT_FROM_PARENT'>Inherit from parent</option> <!-- looks at the parent (and up the chain) for a menu -->
					<option value='NONE_MENU'>No Menu</option> <!-- option for no menu to be displayed -->
					<?php
					foreach ( $menus as $menu ) {
						// this echoes a list of all the menus with a comma behind them...
						echo "<option value='".$menu->term_id."'>".$menu->name."</option>";
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	//selects the already choosen option if one exists, done though JQuery as simpliest solution
	jQuery('[name=rightNavMenuSelection] option').filter(function() {
    	return (jQuery(this).val() == "<?php echo get_post_meta( get_the_ID(), "sidebarSelectArea", true); ?>"); //To select the previous value
	}).prop('selected', true);
	</script>
	<?php
}
/**
 * Function used by template pages to render menus based on the menu id
 * $menuID is either the id number of the menu to be displayed or it is a keyword that describes the course of action to take
 * this function prints out the menu in the spot that the method is called, does not return anything
 */
function showCustomFieldMenuSelector($menuID){
	//make sure we are not getting an empty string
	if($menuID != "" && strlen($menuID) > 0)
    {
	    //No Menu
	    if($menuID == "NONE_MENU"){
		    //Do Nothing
		//Inherit the menu from the parent or grandparent ect.
	    }else if($menuID == "INHERIT_FROM_PARENT"){
		    $id = "";
		    $parentID = get_the_ID();
		    $link = get_permalink();
		    //loop through parents until a menu is found
		    while($id == "" || $id == "INHERIT_FROM_PARENT" && $parentID != False)
		    {
			    //$parentID will be false if a page has no parent
			    $parentID = wp_get_post_parent_id($parentID);
			    $link = get_permalink($parentID);
			    $id = get_post_custom_values("sidebarSelectArea",$parentID)[0];
		    }
		    //if no parent is found we will attemp to use the blog title to find a menu, otherwise we will use the menu found
		    if($parentID != False){
			    $name = wp_get_nav_menu_object($id)->name;
			    echo "<h2><a href=\"$link\">$name</a></h2>";
		    	wp_nav_menu(array('menu'=>$id));
		    }else{
			    $blog_title = get_bloginfo();
			    $link = get_bloginfo('url');
			    echo "<h2><a href=\"$link\">$blog_title</a></h2>";
			    wp_nav_menu(array('menu'=>$blog_title));
		    }
		//if we get a number, then just get the menu and print it out
	    }else{
		    $name = wp_get_nav_menu_object($menuID)->name;
		    //var_dump($name);
	    	echo "<h2><a href=\"".get_permalink()."\">$name</a></h2>";
	    	wp_nav_menu(array('menu'=>$menuID));
	    }
    }
}


/**
 * Function used by Wordpress Admin Save Post
 * saves the rightNavMenuSelection when the page is saved
 */
function saveMyData($postID){
	$selection = $_POST['rightNavMenuSelection'];
	update_post_meta($postID, "sidebarSelectArea", $selection);
}
add_action('edit_page_form','addCustomMenu');
add_action('save_post','saveMyData');
?>