<?php get_header();  ?>

<style>
.hasPhoto{
	margin-right:10px;
	display:table;
	padding: 10px;
	border-width: 1px;
	border-style: solid;
	border-color: #d1cfc7;
	width:150px;
	height:auto;
}
.blankPhoto{
	margin-right:10px;
	display:table;
	padding: 10px;
	border-width: 1px;
	border-style: solid;
	border-color: #d1cfc7;
	width:150px;
	height:auto;
}
</style>

<?php
/**
  *  Template Name: Directory Template Test
  *
  */

 $args = array(
	'type'                     => 'faculty_profile',
	'parent'                   => get_field('dir_categories'),
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
							<img src="<?php if(ctype_digit($image[0])){echo(wp_get_attachment_url($image[0]));}else{echo($image[0]);} ?>" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:15px;width:auto;height:auto">
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
	    			function nameSort($post1, $post2)
	    			{
		    			return explode(" ", get_the_title($post1->ID))[1] > explode(" " ,get_the_title($post2->ID))[1];
	    			}
	    		?>

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
							  $peopleArry = array();
						  	while ($my_query->have_posts()) : $my_query->the_post();
								array_push($peopleArry, $post);
							endwhile;
							usort($peopleArry, 'nameSort');
							foreach($peopleArry as $post)
							{
								$category = get_the_category($post->ID);
							if(get_field("has_profile_page") == 1 || true)
							{
								?>
								<div id="<?php echo $post->ID; ?>"></div>
								<table style="width:inherit;">
					            <?php
									foreach($category as $cat) {
										//cat 28 is the staff category
										if($cat->parent == 12 || $cat->cat_ID == 12)
										{
											$fullName = explode(" ", get_the_title($post->ID));
											$execName = "";
											for($i = 0; $i<count($fullName);$i++){
												$execName .= $fullName[$i] . " ";
											}
											$condName = "";
											for($i = 0; $i<count($fullName);$i++){
												$condName .= $fullName[$i];
											}
											$picture = get_field('picture');
											$about = get_field('about');
											if(get_field('picture_upload') != null || $picture !=null){
											?>
											<tr>
												<td style="vertical-align:baseline;width:150px;padding-right: 30px;"><?php if($picture!=null){?>
													<img src="<?php if(ctype_digit($picture)){echo(wp_get_attachment_url($picture));}else{echo($picture);} ?>" class="hasPhoto">
													<?php } else if(get_field('picture_upload') != null) { ?>
													<img src="<?php if(ctype_digit(get_field('picture_upload'))){echo(wp_get_attachment_url(get_field('picture_upload')));}else{echo(get_field('picture_upload'));} ?>" class="hasPhoto">
													<?php } else { ?>
													<img src="http://www.cob.calpoly.edu/directory/files/2014/10/blankPhoto.jpg" class="blankPhoto">
													<?php } ?>
												</td>
												<td style="vertical-align:top;">
													<p align="left" style="font-size:20px;">
														<strong><?php
															if(get_field('has_profile_page') == true)
															{
																echo "<a href='" . get_permalink() . "' style='font-size:20px;'>";
															}
															if(get_field('external_profile') != null &&
																strrpos(get_field('external_profile'), "http://www.cob.calpoly.edu/directory/economics") === FALSE)
															{
																echo "<a href='" . get_field('external_profile') . "' style='font-size:20px;'>";
															}
															 echo($execName);
															 if(get_field('has_profile_page') == true || get_field('external_profile') != null)
															{
																echo "</a>";
															}
															 ?></strong>
														<?php
														if(get_field('position')!=null)
															echo(" - ".get_field('position'));
														?>
														<p style="font-size:16px;">
															<br/>
															E-mail: <a style="font-size:inherit;" href="mailto:<?php echo(get_field('email'));?>"><?php echo(get_field('email')); ?></a> Phone: <?php echo(get_field('phone')); ?><br/>
															Office: <?php echo(get_field('office')); ?><br/>
															<br/>
															<?php echo(get_field('excerpt')); ?><br/>
														</p>
													</p>
												</td>
											</tr>

										<?php
										}}
								}
							}
							}
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
//switch_to_blog($cpto->root_blog_id);
restore_current_blog();
get_footer();
// restore_current_blog();
 ?>
