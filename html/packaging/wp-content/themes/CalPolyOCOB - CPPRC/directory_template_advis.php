<?php// File: directory_template_advis.php ?>
<?php get_header();  ?>
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
	#content img {
		width: inherit;
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
  *  Template Name: Directory Template JavaScript Advising
  *
  */
global $blog_id;
if ($blog_id == 29) {
  get_sidebar('area1');
} else {
   switch_to_blog($cpto->root_blog_id);
	get_sidebar();
	restore_current_blog();
}


$directorySlug = get_field('dir_categories');
//switch_to_blog(39);
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
							<img src="<?php echo($image[0]); ?>" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:15px;width:auto;height:auto">
							<?php
							}
								$content = get_page($page_id)->post_content;
								echo($content);
							?>
							<table class="responsive" id="<?php echo $directoryID; ?>" summary="Provide table summary here" border="1">
								<tbody>

								</tbody>
							</table>

				<?php 	}	?>
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
						 /* 'depth' => 1, */
						  'order' => 'ASC');
						  $posts = get_posts($args);
						  $my_query = new WP_Query($args);
						  if( $my_query->have_posts() ) {
						  	while ($my_query->have_posts()) : $my_query->the_post();
							$category = get_the_category($post->ID);
							?>

							<table style="width:inherit;">
				            <?php
								foreach($category as $cat) {
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
										<td style="vertical-align:baseline;"><?php if($picture!=null){?>
											<img src="<?php echo($picture); ?>" style="margin-right:10px;display:table;padding: 10px; border-width: 1px;border-style: solid;border-color: #d1cfc7;max-width:150px;height:auto;">
											<?php } else { ?>
											<img src="http://www.cob.calpoly.edu/directory/files/2014/10/blankPhoto.jpg" style="margin-right:10px;display:table;padding: 10px; border-width: 1px;border-style: solid;border-color: #d1cfc7;max-width:150px;height:auto;">
											<?php } ?>
										</td>
										<td style="vertical-align:top;">
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
							}
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
