<?php
/*
Template Name: Faculty CV Display
*/
?>

<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content"><!-- content -->

    <?php //the_content(); ?>
    <?php $custom_fields = get_post_custom(); ?>
    <div id="contentLine"></div>
    
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><h1><?php the_title(); ?></h1></a></h1>
		&nbsp;
		<div class="post-meta" style="padding-left: 25px; padding-right: 15px">
			<div class="row">				 
				<p>Posted when received -</em> Please contact <u><a href="mailto:ocob-online@calpoly.edu" target="_top">ocob-online@calpoly.edu</a></u> to submit a CV.</p>
				<table style="height: 651px; width: 100%;" border="0">
				<tbody>

				<tr>
				<td valign="top" width="34%"><em><strong><u>Accounting</u></strong></em>
				<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/acct" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>

				<td valign="top" width="34%"><em><strong><u>Economics</u></strong></em>
			 	<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/econ" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
	
				<td valign="top" width="34%"><em><strong><u>Finance</u></strong></em>
   				 <br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/fin" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store"]');?></td>
				</tr>
				
				<tr>						
   				<td valign="top" width="34%"><em><strong><u>ITP</u></strong></em>
    			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/itp" size="no" hcolor="black" color="green" icons="none" corners="sharp" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>

				<td valign="top" width="34%"><em><strong><u>Marketing</u></strong></em>
	  			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/marketing" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
				
   				<td valign="top" width="34%"><em><strong><u>MHRIS</u></strong></em>
    			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/mhris" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td> 
				</tr>

				<tr>		
 			  	<td valign="top" width="34%"><em><strong><u>Misc.</u></strong></em>
				<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/misc" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store"]');?></td>
				</tr>

				</tbody>
				</table>
			</div>
		</div>
	</div>
</div><!-- content -->

<div class="clear"></div>

<?php get_footer(); ?>
