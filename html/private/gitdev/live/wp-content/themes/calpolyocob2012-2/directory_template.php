<?php get_header("header"); ?>
<!-- directory_template.php -->
<?php
/**
  *  Template Name: Directory Template
  *  
  */
switch_to_blog($cpto->root_blog_id);
get_sidebar(); 
restore_current_blog();
 
 $args = array(
	'type'                     => 'faculty_profile',
	'parent'                   => get_field('dir_categories'),
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,

); 
$topCategorySlug = get_field('top_category_slug');
$categories = get_categories( $args );

?>

<div id="content">
    <div id="contentLine"></div>
    	<div id="mainLeftFull">
     		<div class="post">
    			<h1><a name="topH1"></a>Directory</h1>
        			<div class="entry">
        				<p>
        	The faculty and staff directory is categories by department. Select a department below to view the contact list<?php echo get_field("directory_pdf") ? ", or <a href='".get_field("directory_pdf")."'>download</a> a printable version." : ".";  ?><br />
        <?php 
		$deansListIndex = -1;
		$index = 0;
		foreach($categories as $theCategory) {
			echo "| <a href='#".$theCategory->slug."'>".$theCategory->cat_name."</a> ";
			if($theCategory->slug == $topCategorySlug) {
				$deansListIndex = $index;
			}
			$index++;
		} 
		echo "|";
		if($deansListIndex != -1) {
			$temp = $categories[0];
			$categories[0] = $categories[$deansListIndex];
			$categories[$deansListIndex] = $temp;	
		}
		?>
    					</p>
        <?php
		foreach($categories as $theCategory) { //Loop through top level categories
			$subCategories = array();
			$subCatNames = array(); // Find if there is a duplicate
			//$idObj = get_category_by_slug($theCategory); 
			//$categoryName = $idObj->cat_name;
			$categoryID = $theCategory>cat_ID;
			$categoryName = $theCategory->cat_name;
			//Look for sub Categories
  		?>
    <?php 
		add_filter( 'posts_orderby' , 'posts_orderby_lastname' );
		$type = "faculty_profile";
		$args=array(
		  'post_type' => $type,
		  'cat' => $theCategory->cat_ID,
		  'post_status' => 'publish',
		  'posts_per_page' => -1,
		  'caller_get_posts'=> 1,
		  'orderby' => 'meta_value', 'meta_key' => 'placement',
		  'depth' => 1,
		  'order' => 'ASC');
  		$posts = get_posts($args);
  		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) { ?>
<h2 id="<?php echo $theCategory->slug; ?>"><?php echo $categoryName ?></h2>
<table class="table_directory" summary="Provide table summary here" border="1">
<tbody>
<tr class="even">
<th scope="col" width="50%">Name</th>
<th scope="col" width="15%">Phone *</th>
<th scope="col" width="25%">Email</th>
<th scope="col" width="10%">Office</th>
</tr>
<?php 
  			while ($my_query->have_posts()) : $my_query->the_post(); 
  				$parentCat = get_the_category(); 
				//$parentCatName = $parentCat[0]->cat_name;
				$parentCatName = array();
				foreach($parentCat as $theParentCat) {
					array_push($parentCatName, $theParentCat->cat_name);
				}
//echo "PARENT CAT: ".$parentCat[1]->cat_name;
				foreach($parentCatName as $theParentCatName) {
					if(!in_array($theCategory->cat_name, $parentCatName) && !in_array($theParentCatName, $subCatNames)) {
						array_push($subCategories, $parentCat[0]);
						array_push($subCatNames, $parentCat[0]->cat_name);
						continue;
					}
				}
				if(!in_array($theCategory->cat_name, $parentCatName)) {
					continue;
				}
				if(!get_field('swap_names')) { //If they do not check swap names
					$fullName = explode(" ", get_the_title($post->ID));
					$profName = end($fullName) . ",";
					foreach($fullName as $partName) {
						if($partName != end($fullName))
							$profName .= " " . $partName;
					}
				} else {
					$profName = get_the_title($post->ID);
				}
			  $position = (get_field('position'))? ', '.get_field('position'):'';
			  $phone = get_field("phone");
			  $email = get_field("email");
			  $office = get_field("office");
  ?>
    <tr><td><?php if(get_field("has_profile_page")) { ?>
    	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
     	<?php }
		//the_title();
		echo $profName;
		if(get_field("has_profile_page")) {
			echo "</a>";
		}
		echo $position; ?></td><td><?php echo $phone; ?></td><td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td><td><?php echo get_field("office"); ?></td></tr>
    <?php
  endwhile;
  
echo "</tbody>";
echo "</table>";
}
wp_reset_query();
//Sort categories by Category name
usort($subCategories, function($a, $b)
{
    return strcmp($a->cat_name, $b->cat_name);
});

foreach($subCategories as $subCategory) {
		$type = "faculty_profile";
	$args=array(
  'post_type' => $type,
  'cat' => $subCategory->cat_id,
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'caller_get_posts'=> 1,
  'orderby' => 'meta_value', 'meta_key' => 'placement',
  'depth' => 1,
  'order' => 'ASC');
  $posts = get_posts($args);
  $my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {
	echo "<table class='table_directory'>";
	echo "<caption><strong>".$subCategory->cat_name."</strong></caption>";
  	while ($my_query->have_posts()) : $my_query->the_post(); 
  		$parentCat = get_the_category(); 
		$parentCatName = $parentCat[0]->cat_name;
		if($parentCatName != $subCategory->cat_name) {
			array_push($subCategories, $parentCat[0]);
			continue;
		}
		$position = (get_field('position'))? ', '.get_field('position'):'';
		$phone = get_field("phone");
		$email = get_field("email");
		$office = get_field("office"); 
		if(!get_field('swap_names')) { //If they do not check swap names
			$fullName = explode(" ", get_the_title($post->ID));
			$profName = end($fullName) . ",";
			foreach($fullName as $partName) {
				if($partName != end($fullName))
					$profName .= " " . $partName;
			}
		} else {
			$profName = get_the_title($post->ID);
		}
		?>
        
    	<tr><td width="50%">
    	<?php if(get_field("has_profile_page")) { ?>
    	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
     	<?php }
		//the_title();
		echo $profName;
		if(get_field("has_profile_page")) {
			echo "</a>";
		}
		echo $position; ?></td><td width="15%"><?php echo $phone; ?></td><td width="25%"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td><td width="10%"><?php echo get_field("office"); ?></td></tr>
    <?php
	endwhile; //end listing of subcategory
	
echo "</tbody>";
echo "</table>";
} //closing if

wp_reset_query();
} //end sub category loop
} //End Major Category Loop 
remove_filter( 'posts_orderby' , 'posts_orderby_lastname' );

/*

	if(have_posts() && is_callable(get_field)) : ?>
    <?php while(have_posts()) : the_post(); 
      
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
    <div class="post">
    <h1><a name="topH1"></a>Directory</h1>
        <div class="entry">
            <?php the_content(); ?>
                <?php
				$dir_categories = explode(',', get_field('dir_categories'));
				
				$args = array('child_of' => trim(get_field('dir_categories')));
				$cats = get_categories($args);
				foreach($cats as $catid){
					if($catid->parent == get_field('dir_categories')){
						printCategory($catid);
					}
				}

				wp_reset_postdata(); */
				?>
        </div><!-- entry -->
    </div><!-- post -->
    <?php /*endwhile;
	
    	else: 
			if(!is_callable(get_field)){
				echo '<div class="post"> <a name="topH1"></a><div class="entry"><h3>Configuration Error.</h3><p>This page is dependent on the Advanced Custom Fields plugin. Please verify it is correctly configured.</p></div></div>';
			}else{
				error404();
			}
		endif;  */?>
</div><!-- Main(?Full)Left -->
</div>
<!-- content -->

<div class="clear"></div>
<?php 
//switch_to_blog($cpto->root_blog_id);
get_footer();
// restore_current_blog();
 ?>

<?php
function error404(){
	echo'<div class="post"> <a name="topH1"></a>
        <h1>404 Error - Page Not Found</h1>
        <div class="entry">
            <p>Sorry, the page you were looking for was not found.</p>
        </div></div>';
}
function printCategory_rows($catid){
	$args = array('category' => $catid, 'post_type' => array('post', 'faculty_profile'));
	$posts = get_posts($args);
	foreach($posts as $post){
		// Add comma if position
		$position = (get_field('position', $post->ID))? ', '.get_field('position', $post->ID):'';
		$phone = get_field('phone', $post->ID);
		// Add mailto link if position
		$email = (get_field('email', $post->ID))? 
					'<a href="mailto:'.get_field('email', $post->ID).'">'.get_field('email', $post->ID).'</a>' :
					'';
		$office = get_field('office', $post->ID);
		
		if(!in_category($catid, $post->ID))
			continue;
		echo '<tr class="odd">
		<td><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>'.$postion.'</td>
		<td>'.$phone.'</td>
		<td>'.$email.'</a></td>
		<td>'.$office.'</td>
		</tr>';
	}
	/*
	query_posts(array('category__in' => array($catid)));
	while(have_posts()) { 
		the_post();

		wp_reset_postdata();
	}*/
}
function printCat_tableStart($name, $headings=true){
	echo'<table class="table_directory" summary="'.$name.' Directory Listing" border="1">';
	if($headings){
		echo'	<tbody>
		<tr class="even">
		<th scope="col" width="50%">Name</th>
		<th scope="col" width="15%">Phone *</th>
		<th scope="col" width="25%">Email</th>
		<th scope="col" width="10%">Office</th>
		</tr>';
	}
}
function printCat_tableEnd(){
	echo'</tbody></table>';
}
function printCategory($catinfo){
	$name = $catinfo->name;
	$parent = $catinfo->parent;
	$id = $catinfo->term_id;
	
	
	// Print Title
	echo '<h2>'.$name.'</h2>';
	
	// Print Table
	printCat_tableStart($name, true);
	
	// Get All Posts in Category
	printCategory_rows($id);
	printCat_tableEnd();
	
	// Get Child Category				
	$args = array('child_of' => $id);
	$cats = get_categories($args);
	foreach($cats as $catid){
		if($catid->parent == $id){
			echo '<h3>'.$catid->name.'</h3>';
			printCat_tableStart($name, true);
			printCategory_rows($catid->term_id);
			printCat_tableEnd();
		}
	}
	
	/*
	$args = array('child_of' => $id);
	var_dump(get_categories($args));*/

	/*echo '
<tr class="odd">
<td><a href="http://www.cob.calpoly.edu/faculty/doug-cerf/">Doug Cerf</a>, Dean,&nbsp;Interim</td>
<td>805-756-2871</td>
<td><a href="mailto:dcerf@calpoly.edu">dcerf@calpoly.edu</a></td>
<td>03-455</td>
</tr>
<tr class="even">
<td><a title="Anderson, Bradford" href="/faculty/bradford-anderson/">Bradford Anderson</a>, Associate Dean</td>
<td>805-756-5210</td>
<td><a href="mailto:bpanders@calpoly.edu">bpanders@calpoly.edu</a></td>
<td>03-408</td>
</tr>
<tr class="odd">
<td><a href="http://www.cob.calpoly.edu/faculty/rosemary-wild/">Rosemary Wild</a>, Associate Dean, Interim</td>
<td>805-756-5210</td>
<td><a href="mailto:rwild@calpoly.edu">rwild@calpoly.edu</a></td>
<td>03-408</td>
</tr>
<tr class="even">
<td>McKinlay, Kris, Assistant Dean</td>
<td>805-756-2912</td>
<td><a href="mailto:kmckinla@calpoly.edu">kmckinla@calpoly.edu</a></td>
<td>03-455</td>
</tr>
<tr class="odd">
<td>Tina Guerrero, Director of Development</td>
<td>805-756-5743</td>
<td><a href="mailto:ctguerre@calpoly.edu">ctguerre@calpoly.edu</a></td>
<td>03-455</td>
</tr>
<tr class="even">
<td><a href="staff/#flores">Dolores Flores</a>, AA/S</td>
<td>805-756-7449</td>
<td><a href="mailto:mdflores@calpoly.edu">mdflores@calpoly.edu</a></td>
<td>03-455</td>
</tr>
<tr class="odd">
<td>Sally Guess, AA/S</td>
<td>805-756-2809</td>
<td><a href="mailto:sguess@calpoly.edu">sguess@calpoly.edu</a></td>
<td>03-455</td>
</tr>
<tr class="even">
<td>Dean\'s Office Fax</td>
<td>805-756-5452</td>
<td></td>
<td>03-455</td>
</tr>
<tr class="odd">
<td>Faculty Fax</td>
<td>805-756-1473</td>
<td></td>
<td>03-400</td>
</tr>
';*/
}
?>
