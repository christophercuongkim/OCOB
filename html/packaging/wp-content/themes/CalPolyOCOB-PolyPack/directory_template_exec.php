<?php// File: directory_template_exec.php ?>
<?php get_header();  ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
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

.pictureTD{
	vertical-align:baseline;
}

.execPic{
	margin-right:10px;
	padding: 10px;
	border-width: 1px;
	border-style: solid;
	border-color: #d1cfc7;
	max-width:150px;
	height:auto;
}

.paragraphTD{
	vertical-align:top;
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

	.execPic{
		margin: 0 auto;
		display: block;
	}

	.pictureTD{
		display: block;
	}

	.paragraphTD{
		display: block;
	}
}
</style>
<!-- other styles -->
<style>
	table .even{
		background-color:inherit;
	}
	table .odd{
		background-color:inherit;
	}
</style>
<!-- directory_template.php -->
<?php
/**
  *  Template Name: Directory Template JavaScript Executive
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


$directorySlug = get_field('dir_categories');
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
    	    <h1><a name="topH1"></a><?php wp_title(''); ?></h1>
        	   <div class="entry">
        	      <p>
                  <?php
				     if($directoryID != 2) { ?>
					 <?php if (has_post_thumbnail( $post->ID ) ){ ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
						?>
						<img src="<?php echo($image[0]); ?>"
						   style="display:block;margin-left:auto;margin-right:auto;margin-bottom:15px;max-width:100%;height:auto">
						<?php
						   }
						   $content = get_page($page_id)->post_content;
						   echo($content);
						?>
						<table class="responsive" id="<?php echo $directoryID; ?>" summary="Provide table summary here" border="1">
						   <tbody>

						   </tbody>
						</table>

				<?php }	?>
    			   </p>

				<?php
						add_filter( 'posts_orderby' , 'posts_orderby_lastname' );
						$type = "faculty_profile";
						$args=array(
						  'post_type' => $type,
						  'post_status' => 'publish',
						  'parent'  => $directoryID,
						  'cat' =>  $directoryID,
						  'posts_per_page' => -1,
						  'orderby' => 'meta_value', 'meta_key' => 'placement',
						  'order' => 'ASC');
						  $posts = get_posts($args);
						  $my_query = new WP_Query($args);
						  if( $my_query->have_posts() ) {
						  	while ($my_query->have_posts()) : $my_query->the_post();
							$category = get_the_category($post->ID);
							?>

							<table style="width:inherit;">
				            <?php
									$fullName = explode(" ", get_the_title($post->ID));
									$execName = "";
									for($i = 0; $i<count($fullName);$i++){
										$execName .= $fullName[$i] . " ";
									}
									$picture = wp_get_attachment_image_src(get_field('exec_picture'), 'single-post-thumbnail')[0];
									$about = nl2br(get_field('about'));
									?>
									<a name="<?php echo ($post->post_name); ?>"></a>
									<tr>
										<td class="pictureTD"><?php if($picture!=null){?>
											<img class="execPic" src="<?php echo($picture); ?>">
											<?php } else { ?>
											<img class="execPic"
											   src="http://www.cob.calpoly.edu/directory/files/2014/10/blankPhoto.jpg">
											<?php } ?>
										</td>
										<td class="paragraphTD">
											<p align="left" style="font-size:20px;">
												<strong><?php echo($execName); ?></strong>

												<?php
												if(get_field('graduation_information')!=null)
													echo(" - ".get_field('graduation_information'));
												?>
												<p style="font-size:16px;"><?php echo($about); ?></p>
											</p>
										</td>
									</tr>

									<?php
							endwhile;
						}
								?>
							</table>


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
