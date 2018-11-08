<?php get_header();  ?>

<?php
/**
  *  Template Name: Directory Template Main
  *
  */

global $blog_id;
$entryID = $blog_id;
$theCat = get_field("dir_categories");

if ($blog_id == 3) 
{
  get_sidebar('area2');
} 
else 
{
	switch_to_blog($cpto->root_blog_id);
	get_sidebar();
	restore_current_blog();
}
?>

<style>
a {
	color: #717372;
}
a:hover {
	text-decoration: none;
}
.adj {
	font-size: 12px;
	color: #717372;
	font-weight: bold;
}

.mobileShow {
	display: none;
}

.fa {
	padding-left: 10px;
	font-size: 25px;
}

@media screen and (max-width:600px) {
	td{
    	display:block;
	}
	
	.mobileHide {
		display: none
	}
	
	.mobileShow {
		display: block;
	}

	.mobilePadding {
		padding-left: 2%;
		padding-right: 2%;
	}

	.mobileFloatLeft {
		float:left !important;
	}
	
	.mobileBold {
		font-weight:bold;
		color: #717372;
	}
	
	h2 {
		font-size: 25px;
		cursor: pointer;
	}
}
</style>

<?php
	function SortByLastName( $a, $b ) {
    $a_last = end(explode(' ', $a->post_title));
    $b_last = end(explode(' ', $b->post_title));
    return strcasecmp( $a_last, $b_last );
	}

	function GetTable($slug)
	{
		$chairSlug = $slug . "-chair";
		
		$idObj = get_category_by_slug($slug);
		$directoryID = $idObj->term_id;
		$args=array(
		'post_type' => 'faculty_profile',
		'post_status' => 'publish',
		'category__in' =>  $directoryID,
		'posts_per_page' => -1,
		'orderby' => 'meta_value', 'meta_key' => 'placement',
		'depth' => 1, 
		'order' => 'ASC');
		$the_query1 = new WP_Query($args);

		if($slug != "deans-office")
			usort($the_query1->posts, 'SortByLastName' );
	?>
		<table class="responsive" border="1">
			<tbody>
				<tr class="even mobileHide">
					<th scope="col" width="50%">Name</th>
					<th scope="col" width="15%">Phone</th>
					<th scope="col" width="25%">Email</th>
					<th scope="col" width="10%">Office</th>
				</tr>	
				<?php if(term_exists($chairSlug, 'category')): ?>
					<?php
						$idObj = get_category_by_slug($chairSlug);
						$directoryID = $idObj->term_id;
						$args=array(
						'post_type' => 'faculty_profile',
						'post_status' => 'publish',
						'category__in' =>  $directoryID,
						'posts_per_page' => -1,
						'orderby' => 'meta_value', 'meta_key' => 'placement',
						'depth' => 1, 
						'order' => 'ASC');
						$the_query = new WP_Query($args);
					?>
					<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<tr>
								<td><a href=<?php the_permalink(); ?>><span class="mobileBold"><?php the_title();?></span></a><?php if(get_field("position")) echo ", ";?> <?php echo the_field("position")?></td>
								<td class="mobileFloatLeft"><?php echo the_field("phone")?></td>
								<td class="mobileFloatLeft"><a href="mailto:<?php echo the_field("email")?>"><?php echo the_field("email")?></a></td>
								<td class="mobileFloatLeft"><?php echo the_field("office")?></td>
							</tr>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ( $the_query1->have_posts() ) : ?>
					<?php while ( $the_query1->have_posts() ) : $the_query1->the_post(); ?>
						<?php 
							$titleLine = get_the_title(); 
							if(get_field("has_profile_page"))
								$titleLine = "<a href=" . get_permalink()  .">" . get_the_title() . "</a>";						
							else if(get_field("external_profile"))
								$titleLine = "<a href=" . get_field("external_profile")  .">" . get_the_title() . "</a>";
							else if(get_field("is_on_staff_page"))
								$titleLine = "<a href= /directory/staff/#" . get_the_ID() .">" . get_the_title() . "</a>"		
						?>						
						<tr>
							<td><span class="mobileBold"><?php echo $titleLine ?></span><?php if(get_field("position")) echo ", ";?> <?php echo the_field("position")?></td>
							<td class="mobileFloatLeft"><?php echo the_field("phone")?></td>
							<td class="mobileFloatLeft"><a href="mailto:<?php echo the_field("email")?>"><?php echo the_field("email")?></a></td>
							<td class="mobileFloatLeft"><?php echo the_field("office")?></td>
						</tr>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</tbody>
		</table>
<?php } ?>

<!-- START PAGE CONTENT -->
<div id="content">
<div id="contentLine"></div>

<!-- Heading For Directory -->
<?php if($entryID == 8): ?>
<div class="mobilePadding">
	<h1>Directory</h1><br>
	<center>The faculty and staff directory is categorized by department. Select a department to view the contact list.</center><br>
	<div class="mobileHide">
		<center>| <a href="#dean">Dean's Office</a> | <a href="#accounting">Accounting</a> | <a href="#econ">Economics</a> | <a href="#entrepreneurship">Entrepreneurship</a> | <a href="#finance">Finance</a> | <a href="#grad">Graduate Program</a> | <a href="#itp">Industrial Technology & Packaging</a> | <a href="#mhi">Management, HR and Information Systems</a> | <a href="#marketing">Marketing</a> | <a href="#staff">Staff</a> |</center>
	</div>
</div>
<?php else: ?>
<h1><?php the_title() ?></h1>
<?php endif ?>

<?php switch_to_blog(8); ?>

<!-- Dean's Office -->
<?php if($entryID == 8): ?>
	<h2 id="dean" class="mobileHide">Dean's Office</h2>
	<h2 id="dean" class="mobileShow" onclick="toggleTable(this, 'deans-office-table')"><span class="fa fa-plus-circle"></span> Dean's Office</h2>
	<div id="deans-office-table" class="mobileHide">
		<?php GetTable("deans-office"); ?>
	</div>
<?php endif ?>

<!-- Accounting -->
<?php if($entryID == 8 || $theCat == "accounting"): ?>
	<h2 id="accounting" class="mobileHide">Accounting</h2>
	<h2 id="accounting" class="mobileShow" onclick="toggleTable(this, 'accounting-table')"><span class="fa fa-plus-circle"></span> Accounting</h2>
	<div id="accounting-table" class="mobileHide">
		<?php GetTable("accounting"); ?>

		<p class="adj">Adjunct Accounting Faculty</p>
		<?php GetTable("adjunct-accounting-faculty"); ?>
	</div>
<?php endif ?>

<!-- Economics -->
<?php if($entryID == 8 || $theCat == "economics"): ?>
	<h2 id="econ" class="mobileHide">Economics</h2>
	<h2 id="econ" class="mobileShow" onclick="toggleTable(this, 'economics-table')"><span class="fa fa-plus-circle"></span> Economics</h2>
	<div id="economics-table" class="mobileHide">
		<?php GetTable("economics"); ?>
			
		<p class="adj">Adjunct Economics Faculty</p>
		<?php GetTable("adjunct-economics-faculty"); ?>
	</div>
<?php endif ?>

<!-- Finance -->
<?php if($entryID == 8 || $theCat == "finance"): ?>
	<h2 id="finance" class="mobileHide">Finance</h2>
	<h2 id="finance" class="mobileShow" onclick="toggleTable(this, 'finance-table')"><span class="fa fa-plus-circle"></span> Finance</h2>
	<div id="finance-table" class="mobileHide">
		<?php GetTable("finance"); ?>

		<p class="adj">Adjunct Finance Faculty</p>
		<?php GetTable("adjunct-finance-faculty"); ?>
	</div>
<?php endif ?>

<!-- Grad -->
<?php if($entryID == 8 || $theCat == "graduate-programs"): ?>
	<h2 id="grad" class="mobileHide">Graduate Programs</h2>
	<h2 id="grad" class="mobileShow" onclick="toggleTable(this, 'graduate-programs-table')"><span class="fa fa-plus-circle"></span> Graduate Programs</h2>
	<div id="graduate-programs-table" class="mobileHide">
		<?php GetTable("graduate-programs"); ?>
	</div>
<?php endif ?>

<!-- ITP -->
<?php if($entryID == 8 || $theCat == "industrial-technology-packaging"): ?>
	<h2 id="itp" class="mobileHide">Industrial Technology & Packaging</h2>
	<h2 id="itp" class="mobileShow" onclick="toggleTable(this, 'industrial-technology-packaging-table')"><span class="fa fa-plus-circle"></span> Industrial Technology & Packaging</h2>
	<div id="industrial-technology-packaging-table" class="mobileHide">
		<?php GetTable("industrial-technology-packaging"); ?>

		<p class="adj">Adjunct Industrial Technology & Packaging Faculty</p>
		<?php GetTable("adjunct-industrial-technology-packaging-faculty"); ?>
	</div>
<?php endif ?>

<!-- Entrepreneurship -->
<?php if($entryID == 8 || $theCat == "entrepreneurship"): ?>
	<h2 id="entrepreneurship" class="mobileHide">Entrepreneurship</h2>
	<h2 id="entrepreneurship" class="mobileShow" onclick="toggleTable(this, 'entrepreneurship-table')"><span class="fa fa-plus-circle"></span> Entrepreneurship</h2>
	<div id="entrepreneurship-table" class="mobileHide">
		<?php GetTable("entrepreneurship"); ?>
	</div>
<?php endif ?>

<!-- Management, HR and Information Systems -->
<?php if($entryID == 8 || $theCat == "management-hr-and-information-systems"): ?>
	<h2 id="mhi" class="mobileHide">Management, HR and Information Systems</h2>
	<h2 id="mhi" class="mobileShow" onclick="toggleTable(this, 'management-hr-and-information-systems-table')"><span class="fa fa-plus-circle"></span> Management, HR and Information Systems</h2>
	<div id=management-hr-and-information-systems-table class="mobileHide">
		<?php GetTable("management-hr-and-information-systems"); ?>

		<p class="adj">Adjunct Management, HR and Information Systems Faculty</p>
		<?php GetTable("adjunct-management-faculty"); ?>

		<p class="adj">Management, HR and Information Systems Emeritus</p>
		<?php GetTable("hr-and-information-systems-emeritus"); ?>
	</div>
<?php endif ?>

<!-- Marketing -->
<?php if($entryID == 8 || $theCat == "marketing"): ?>
	<h2 id="marketing" class="mobileHide">Marketing</h2>
	<h2 id="marketing" class="mobileShow" onclick="toggleTable(this, 'marketing-table')"><span class="fa fa-plus-circle"></span> Marketing</h2>
	<div id="marketing-table" class="mobileHide">
		<?php GetTable("marketing"); ?>
		<p class="adj">Adjunct Marketing Faculty</p>
		<?php GetTable("adjunct-marketing-faculty"); ?>
	</div>
<?php endif ?>

<!-- Staff -->
<?php if($entryID == 8 || $theCat == "staff"): ?>
	<h2 id="staff" class="mobileHide">Staff</h2>
	<h2 id="staff" class="mobileShow" onclick="toggleTable(this, 'staff-table')"><span class="fa fa-plus-circle"></span> Staff</h2>
	<div id="staff-table" class="mobileHide">
		<?php GetTable("staff"); ?>
		<p class="adj">Advising Center</p>
		<?php GetTable("advising-center"); ?>
		<p class="adj">Center for Innovation and Entrepreneurship</p>
		<?php GetTable("center-for-innovation-and-entrepreneurship"); ?>
		<p class="adj">Information and Support Services</p>
		<?php GetTable("information-and-support-services"); ?>
		<p class="adj">Instructional Designer</p>
		<?php GetTable("instructional-designer"); ?>
		<p class="adj">IT Lab Coordinator</p>
			<?php GetTable("it-lab-coordinator"); ?>
		<p class="adj">Library</p>
			<?php GetTable("library"); ?>
		<p class="adj">Low Income Taxpayer Clinic</p>
			<?php GetTable("low-income-taxpayer-clinic"); ?>
		<p class="adj">Technology Center and Computer Labs</p>
			<?php GetTable("technology-center-and-computer-labs"); ?>
	</div>
<?php endif ?>

<?php restore_current_blog(); ?>

</div>
<!-- END PAGE CONTENT -->

<div class="clear"></div>
<?php
	get_footer();
?>

<script>
function toggleTable(ref, id){
	if($("#" + id).is(':visible')){
		$("#" + id).hide();
	}
	else{
		$("#" + id).show();
	}
	
	if(ref.firstChild.className == "fa fa-plus-circle"){
		ref.firstChild.classList.remove("fa-plus-circle")
		ref.firstChild.classList.add("fa-minus-circle")
	}
	else {
		ref.firstChild.classList.remove("fa-minus-circle")
		ref.firstChild.classList.add("fa-plus-circle")
	}
}
</script>
