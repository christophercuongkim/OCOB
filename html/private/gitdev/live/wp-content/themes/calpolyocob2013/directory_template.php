<?php get_header("header"); ?>
<!-- directory_template.php -->
<?php
/**
  *  Template Name: Directory Template
  *  
  */

 get_sidebar(); ?>

<div id="content">
    <div id="contentLine"></div>
    <?php if(have_posts() && is_callable(get_field)) : ?>
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

				wp_reset_postdata();
				?>
        </div><!-- entry -->
    </div><!-- post -->
    <?php endwhile;
	
    	else: 
			if(!is_callable(get_field)){
				echo '<div class="post"> <a name="topH1"></a><div class="entry"><h3>Configuration Error.</h3><p>This page is dependent on the Advanced Custom Fields plugin. Please verify it is correctly configured.</p></div></div>';
			}else{
				error404();
			}
		endif; ?>
</div><!-- Main(?Full)Left -->
</div>
<!-- content -->

<div class="clear"></div>
<?php get_footer(); ?>

<?php
function error404(){
	echo'<div class="post"> <a name="topH1"></a>
        <h1>404 Error - Page Not Found</h1>
        <div class="entry">
            <p>Sorry, the page you were looking for was not found.</p>
        </div></div>';
}
function printCategory_rows($catid){
	$args = array('category' => $catid, 'post_type' => array('post', 'employee_profile'));
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
