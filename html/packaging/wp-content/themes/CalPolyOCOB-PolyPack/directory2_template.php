<?php// File: directory2_template.php ?>
<?php get_header();  ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
function show(id) {
	if(document.getElementById(id + "divm").style.display == "block") {
		document.getElementById(id + "divm").style.display = "none";
		document.getElementById(id + "icon").className = "fa fa-plus-circle";
	} else {
		document.getElementById(id + "divm").style.display = "block";
		document.getElementById(id + "icon").className = "fa fa-minus-circle";
	}
}
function extendRow(id) {
	if(document.getElementById(id + "P").style.display == "none") {
		document.getElementById(id + "P").style.display = "table-row";
		var active = document.getElementsByClassName("mpactive");
		for(var i = 0; i < active.length; i++) {
			active[i].style.display = "none";
			active[i].className = "";
		}
		var active = document.getElementsByClassName("fa-minus-square");
		for(var i = 0; i < active.length; i++) {
			active[i].className = "fa fa-plus-square";
		}
		document.getElementById(id).cells[0].innerHTML = '<i class="fa fa-minus-square"></i>';
		document.getElementById(id + "P").className = "mpactive";
	} else {
		document.getElementById(id).cells[0].innerHTML = '<i class="fa fa-plus-square"></i>';
		document.getElementById(id + "P").style.display = "none";
		document.getElementById(id + "P").className = "";
	}
}

//adds a professor to both the regular and responsive table
function addToTable(id, theName, thePhone, theEmail, theOffice) {
	var table = document.getElementById(id);
	if(table!=null){
		var mobTable = document.getElementById(id + "m");
		table.insert
		{
			var row = table.insertRow(-1);
			var name = row.insertCell(0);
			var phone = row.insertCell(1);
			var email = row.insertCell(2);
			var office = row.insertCell(3);
			name.innerHTML = theName;
			phone.innerHTML = thePhone;
			office.innerHTML = theOffice;
			email.innerHTML = theEmail;
			name.style.width = "50%";
			phone.style.width = "15%";
			email.style.width = "25%";
			office.style.width = "10%";
		}
		mobTable.insert
		{
			var mrow = mobTable.insertRow(-1);
			var mrow2 = mobTable.insertRow(-1);
			var icon = mrow.insertCell(0);
			var mname = mrow.insertCell(1);
			var mphone = mrow.insertCell(2);
			var mfiller = mrow2.insertCell(0);
			var memail = mrow2.insertCell(1);
			var moffice = mrow2.insertCell(2);
			icon.innerHTML = '<i class="fa fa-plus-square"></i>';
			mrow2.style.display = "none";
			memail.innerHTML = theEmail;
			if(theOffice)
			moffice.innerHTML = "Office: \n" + theOffice;
			moffice.style.float = "right";
			moffice.style.whiteSpace = "pre";
			mphone.style.whiteSpace = "pre";
			mphone.style.marginTop = "10px";
			memail.style.width = "60%";
			mrow.style.display = "table-row";
			mname.innerHTML = theName;
			mphone.innerHTML = "<a href='tel:"+thePhone+"'>"+thePhone+"</a>";
			mname.style.width = "60%";
			mphone.style.float = "right";
			mrow.setAttribute("id", id + "-" + mrow.rowIndex + "row");
			mrow2.setAttribute("id", id + "-" + mrow.rowIndex + "rowP");
			icon.setAttribute("onclick", "extendRow('" +  id + "-" + mrow.rowIndex + "row');");
		}
	}
}
</script>
<!-- styleizes the mobile stuff -->
<style>
.mobileDir, .mobileDirH, .mobileDirTable {
	display:none;
}
.mobileDirTable {
	width:100%;
}
.mpnotactive {
	display: none;
}
.mpactive {
	display: table-row;
}
.fa-plus-square, .fa-minus-square {
	cursor: pointer;
}
@media only screen and (max-width: 760px) {
	#categories {
		display: none;
	}
	.mobileDirH {
		display:block;
	}
	.mobileDirTable {
		display:inline-table;
	}
	.responsive {
		display: none;
	}
	.even, .odd {
		height:40px;
	}
	.fa {
		font-size: 40px;
	}
	h2 {
		font-size:28px;
	}
	caption {
		font-size: 18px !important;
	}
}
</style>
<div id="status">
</div>
<!-- directory_template.php -->
<?php
/**
  *  Template Name: Directory Template JavaScript
  *
  */
global $blog_id;
if ($blog_id == 27) {
  get_sidebar('area2');
} else {
   switch_to_blog($cpto->root_blog_id);
	get_sidebar();
	restore_current_blog();
}

$directorySlug = get_field('dir_categories'); //
$topCategorySlug = get_field('top_category_slug');
//switch_to_blog(8);
switch_to_blog(get_field("directory_sub_blog_id"));
$idObj = get_category_by_slug($directorySlug);
$directoryID = $idObj->term_id;
$directoryName = $idObj->cat_name;
 $args = array(
	'type'                     => 'faculty_profile',
	'parent'                   => $directoryID,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
);
$categories = get_categories( $args );
?>
<div id="content">
    <div id="contentLine"></div>
    	<div id="mainLeftFull">
     		<div class="post">
    			<h1><a name="topH1"></a>Directory</h1>
        			<div class="entry">
        				<p>
	        			<?php
		        			if(get_field("df_categories") != 0){

		        			}else{
	        			?>
                        <?php if(is_page("Directory")) { ?>
							The faculty and staff directory is categorized by department. Select a department below to view the contact list<?php echo 	get_field("directory_pdf") ? ", or <a href='".get_field("directory_pdf")."'>download</a> a printable version." : ".";  ?><br />
							<div id="categories">
								<p><center>
									<?php
										$deansListIndex = -1;
										$index = 0;
										foreach($categories as $theCategory) {
											echo $theCategory->cat_ID;
											echo "| <a href='#".$theCategory->slug."'>".$theCategory->cat_name."</a> ";
											if($theCategory->slug == $topCategorySlug) {
												$deansListIndex = $index;
											}
											$index++;
										}
										if(count($categories) != 0) {
											echo "|";
										}
										//make sure the deans list is the first one
										if($deansListIndex != -1) {
											$temp = $categories[0];
											$categories[0] = $categories[$deansListIndex];
											$categories[$deansListIndex] = $temp;
										}
										echo "</center></p></div>";
						}
						if($directoryID != 2) { ?>
							<h2 class="mobileDirH" style="cursor:pointer;"  onclick="show('<?php echo $directoryID; ?>');">
								<i id="<?php echo $theCategory->cat_ID; ?>icon" class="fa fa-plus-circle"></i>
								<?php echo $directoryName; ?>
							</h2>
							<div id="<?php echo $directoryID; ?>divm" class="mobileDir" style="width:100%;" >
								<table class="mobileDirTable" id="<?php echo $directoryID; ?>m" style="width:100%">
									<tbody>
									</tbody>
								</table>
							</div>
							<table class="responsive" id="<?php echo $directoryID; ?>" summary="Provide table summary here" border="1">
								<tbody>
									<tr class="even">
										<th scope="col" width="50%">Name</th>
										<th scope="col" width="15%">Phone</th>
										<th scope="col" width="25%">Email</th>
										<th scope="col" width="10%">Office</th>
									</tr>
								</tbody>
							</table>
				<?php 	}	?>
    					</p>
						<?php
						foreach($categories as $theCategory) { //Loop through top level categories
							echo $theCategory->cat_ID;
							 $args = array(
							 	'type'                     => 'faculty_profile',
							 	'parent'                   => $theCategory->cat_ID,
							 	'orderby'                  => 'name',
							 	'order'                    => 'ASC',
							 	'hide_empty'               => 1,
							 );
							 $theUnorderedSubCategories = get_categories($args);
							 $bottomCats = array();
							 $topCats = array();
							 foreach($theUnorderedSubCategories as $cat){//order the subcategories
								 if((get_field('major_group',$cat->taxonomy.'_'.$cat->term_id)) == "1"){
									 array_push($topCats, $cat);
								 } else {
								 	array_push($bottomCats, $cat);
								 	}
							 }
							 $theSubCategories = array_merge($topCats,$bottomCats);
				?>
							<h2 class="mobileDirH" style="cursor:pointer;"  onclick="show('<?php echo $theCategory->cat_ID; ?>');">
								<i id="<?php echo $theCategory->cat_ID; ?>icon" class="fa fa-plus-circle"></i>
								<?php echo $theCategory->cat_name; ?>
							</h2>
							<div id="<?php echo $theCategory->cat_ID; ?>divm" class="mobileDir" style="width:100%;">
								<table class="mobileDirTable" id="<?php echo $theCategory->cat_ID; ?>m" style="width:100%">
									<tbody>
									</tbody>
								</table>
								<?php
								$bigCats = array();
								foreach($theSubCategories as $cat) {
									if(get_field('top_level_category',$cat->taxonomy.'_'.$cat->term_id)[0] == "yes"){
										array_push($bigCats, $cat);
									} else {
										echo "<table class='mobileDirTable' id='".$cat->cat_ID."m'>";
										echo "<caption><strong>".$cat->cat_name."</strong></caption>";
										echo "</table>";
									}
								}
								?>
							</div>
						<?php
							foreach($bigCats as $cat){
								echo '<h2 class="mobileDirH" style="cursor:pointer;"  onclick="show(\''.$cat->cat_ID.'\');">';
								echo '<i id="'.$cat->cat_ID.'icon" class="fa fa-plus-circle"></i> ';
								echo $cat->cat_name;
								echo '</h2>';
								echo '<div id="'. $cat->cat_ID.'divm" class="mobileDir" style="width:100%;">';
								echo '<table class="mobileDirTable" id="'.$cat->cat_ID.'m" style="width:100%">';
								echo '<tbody></tbody></table></div>';
							}
						?>
							<h2 class="responsive" id="<?php echo $theCategory->slug; ?>"><?php echo $theCategory->cat_name ?></h2>
							<table class="responsive" summary="Provide table summary here" border="1" id="<?php echo $theCategory->cat_ID; ?>">
								<tbody>
									<tr class="even">
										<th scope="col" width="50%">Name</th>
										<th scope="col" width="15%">Phone</th>
										<th scope="col" width="25%">Email</th>
										<th scope="col" width="10%">Office</th>
									</tr>
								</tbody>
							</table>
				<?php
							$bigCats = array();
							foreach($theSubCategories as $cat) {
								if(get_field('top_level_category',$cat->taxonomy.'_'.$cat->term_id)[0] == "yes"){
									array_push($bigCats, $cat);
								} else {
									echo "<table class='responsive' id='".$cat->cat_ID."'>";
									echo "<caption><strong>".$cat->cat_name."</strong></caption>";
									echo "</table>";
								}
							}
							foreach($bigCats as $cat){
								echo '<h2 class="responsive" id="'.$theCategory->slug.'">'.$cat->cat_name.'</h2>';
								echo '<table class="responsive" summary="Provide table summary here" border="1" id="'.$cat->cat_ID.'">';
								echo '<tbody>
											<tr class="even">
												<th scope="col" width="50%">Name</th>
												<th scope="col" width="15%">Phone</th>
												<th scope="col" width="25%">Email</th>
												<th scope="col" width="10%">Office</th>
											</tr>
										</tbody>
									</table>';
							}
						}
				?>
				<?php }//end df categories else ?>
        </div><!-- entry -->
    </div><!-- post -->
</div><!-- Main(?Full)Left -->
</div>
<!-- content -->
<div class="clear"></div>
<?php
restore_current_blog();
get_footer();
 ?>

<script type="text/javascript" src="/scripts/faculty/facultyProfile.js"></script>
