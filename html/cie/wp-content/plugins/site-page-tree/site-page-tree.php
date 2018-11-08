<?php
/*
Plugin Name: Site Page Tree
Description: Adds collapsible tree of pages and sub-pages as navigable hyperlinks
Author: Brett Mellor, mitcho (Michael Yoshitaka Erlewine)
Version: 0.5
Author URI: http://ecs.mit.edu
*/

add_action( 'wp_enqueue_scripts', 'site_page_tree_reg_scripts' );
add_action( 'widgets_init', 'site_page_tree_load' );

// stylesheet
add_action('wp_print_styles', 'site_page_tree_stylesheet');
function site_page_tree_stylesheet() {
	$styleURL = plugins_url('style.css', __FILE__); 
	$styleFile = WP_PLUGIN_DIR . '/site-page-tree/style.css';
	if ( file_exists($styleFile) ) {
		wp_register_style('site-page-tree-style', "$styleURL");
		wp_enqueue_style( 'site-page-tree-style');
		}	
	} // ci_admin_meta_stylesheet

function site_page_tree_load() {
	register_widget( 'site_page_tree' );
}

function site_page_tree_reg_scripts() {
	wp_register_script('site-page-tree-script', WP_PLUGIN_URL . '/site-page-tree/site-page-tree.js');
	wp_enqueue_script('site-page-tree-script');
}

class Site_Page_Tree extends WP_Widget {

	// $nodeNumbers as an array of page URLs.  Handily, the array index will be the same as the node/item number as used by the javascript page tree
	var $nodeNumbers = array();

	// $lineages is an associative array of all tree items with each tree item's lineage back to the root of the tree
	// the keys are the page URLs and the value for each key is an array of other page URLs that are above that page URL in the tree hierarchy
	// this information is used to expand only that portion of the tree around the current page, so that the current page may be highlighted in the tree
	var $lineages = array();
	// lineage of a particular node, get's built while recursing climb_tree
	var $lineage = array();

	function Site_Page_Tree() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'site-page-tree', 'description' => __('Adds collapsible tree of pages and sub-pages', 'site-page-tree') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'site-page-tree' );

		/* Create the widget. */
		$this->WP_Widget( 'site-page-tree', __('Site Page Tree', 'site-page-tree'), $widget_ops, $control_ops );
	}

	function widget( $args ) {
		extract( $args );

		$title = __("Page Tree", "site-page-tree");

		echo $before_widget;
		echo $before_title . $title . $after_title;

		$count=0;
		$this->display();
		
		echo $after_widget;
	}

	function display() {
		$sitename = get_bloginfo('name');
		$siteurl = get_bloginfo('url');
		$tree_data = $this->climb_tree(array(array(0, $sitename, $siteurl)));
		// not sure why this has to be in an array with a redundant wrapper, but... okay... - mitcho
		$tree_data = apply_filters( 'site_page_tree_data', $tree_data );
	
		echo "<span id='page_tree_show'>show/hide page tree</span><br>
			<span><a href='#' onclick=\"expand_all('my_tree'); return false;\">" . __("Expand all", "site-page-tree") . "</a> | <a href='#' onclick=\"expand_all('my_tree', true); return false;\">" . __("Collapse all", "site-page-tree") . "</a></span>
			";
	
		$icon_folder = apply_filters( 'site_page_tree_icons_url',  WP_PLUGIN_URL . '/site-page-tree/icons/' );
	
		echo "<script type='text/javascript'>
	
	var TREE_TPL = {
		'target'  : '_self',	// name of the frame links will be opened in
						// other possible values are: _blank, _parent, _search, _self and _top
		
	/* root leaf icon normal		*/	'icon_32' : '{$icon_folder}base.gif', 
	/* root leaf icon selected		*/	'icon_36' : '{$icon_folder}base.gif',   
		
	/* root icon normal			*/	'icon_48' : '{$icon_folder}folderopen.gif',   
	/* root icon selected			*/	'icon_52' : '{$icon_folder}folderopen.gif',   
	/* root icon opened			*/	'icon_56' : '{$icon_folder}folderopen.gif', 
	/* root icon selected opened		*/	'icon_60' : '{$icon_folder}folderopen.gif',  
		
	/* node icon normal			*/	'icon_16' : '{$icon_folder}folder.gif',
	/* node icon selected			*/	'icon_20' : '{$icon_folder}foldersel-closed.gif', 
	/* node icon opened			*/	'icon_24' : '{$icon_folder}folderopen.gif', 
	/* node icon selected opened 		*/	'icon_28' : '{$icon_folder}foldersel.gif', 
	
	/* leaf icon normal			*/	'icon_0'  : '{$icon_folder}page.gif', 
	/* leaf icon selected 			*/	'icon_4'  : '{$icon_folder}pagesel.gif', 
	
	/* empty image				*/	'icon_e'  : '{$icon_folder}empty.gif', 
	/* vertical line				*/	'icon_l'  : '{$icon_folder}empty.gif',
	/* junction for leaf			*/	'icon_2'  : '{$icon_folder}joinbottom.gif', 	
	/* junction for last leaf		*/	'icon_3'  : '{$icon_folder}join.gif',       	
	/* junction for closed node		*/	'icon_18' : '{$icon_folder}plusbottom.gif',	
	/* junction for last closed node	*/ 	'icon_19' : '{$icon_folder}plus.gif',			
	/* junction for opened node		*/	'icon_26' : '{$icon_folder}minusbottom.gif',	
	/* junction for last opended node	*/	'icon_27' : '{$icon_folder}minus.gif'			
	};
	
	var TREE_DATA = ";
	echo json_encode($tree_data);
	echo ";
	my_tree = new tree(TREE_DATA, TREE_TPL);
	";
	
		// open the branches that lead to the current page, so that we can highlight see and highlight the current page
		// this will be easier if we do this:
		$nodeLookup = array_flip($this->nodeNumbers);
		// the url is really the key, not the node number
	
		// What is the URL of the page we're looking at?  We need to know this in order to expand the page tree and highlight the current page
		global $post;
		$pageURL = get_permalink($post->ID);
	
		foreach($this->lineages as $page => $line) {
			if ($pageURL == $page) {
				foreach ($line as $nodeURL) {
					// if non-zero... because the root node is open by default
					if ($nodeLookup[$nodeURL] != 0)
						echo "my_tree.toggle(".$nodeLookup[$nodeURL].");\n";
				}
				break;
			}
		}
		// highlight the tree item corresponding to the current page being displayed
		foreach ($nodeLookup as $nodeURL => $num) {
			if ($pageURL == $nodeURL) {
				echo "my_tree.select($num);\n";
				break;
			}
		}
		echo "</script>";
		
	} // page_tree_display
	
	
	function climb_tree($ancestors) {

		$return_data = array();

		foreach($ancestors as $ancestor) {
			// [0] is ID, [1] is title, [2] is permalink
	
			// add the current page to the $nodeNumbers array.  It will get the same key number as the tigra tree menu script will assign to this node/item
			$this->nodeNumbers[] = $ancestor[2];
	
			// add the lineage for this particular node to the array of lineages
			$key = $ancestor[2];
			$this->lineages[$key] = $this->lineage;
	
			// Setup node_data for the ancestor
			$node_data = array($ancestor[1], $ancestor[2]);
	
			// get all of the descendants for each ancestor
			$wp_descendants_obj = get_posts(array('numberposts' => -1, 'orderby' => 'menu_order', 'order'=> 'ASC', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $ancestor[0]));
	
			// convert wp descendants object to an array of arrays of IDs and post titles
			$descendants = array();
			foreach($wp_descendants_obj as $wp_descendant) {
				$descendants[] = array($wp_descendant->ID, $wp_descendant->post_title, get_permalink($wp_descendant->ID));
			} // foreach wp_descedants_obj
	
			// If it has descendants, append them to the node_data.
			if(!empty($descendants)) {
				// add the current node to the running lineage
				$this->lineage[] = $ancestor[2]; 
				$node_data = array_merge($node_data, $this->climb_tree($descendants));
			}

			// All done constructing the node_data... append to return_data
			$return_data[] = $node_data;
	
		} // foreach ancestors
	
		// remove the last node from the running lineage
		array_pop($this->lineage);
		
		return $return_data;
	}

} //class

?>