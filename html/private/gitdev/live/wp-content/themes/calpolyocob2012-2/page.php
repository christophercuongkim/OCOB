<?php // Redirect the old faculty pages

$url = get_permalink();
$urlparts = explode("/", $url);
if(in_array("faculty", $urlparts)) {
	$slug = $urlparts[4]; 
	if(!$slug) {
		header("Location: http://cob.calpoly.edu/directory/");
	} else {
		header("Location: http://cob.calpoly.edu/directory/profile/". $slug);
	}
 }
?>
<?php get_header(); ?>
<?php get_sidebar(); 
?>

<!-- page.php -->
<div id="content">
    <div id="contentLine"></div>
    <?php 
	/***    The Loop    ***/
	if(have_posts()): while(have_posts()) : 
		the_post(); 
		echo get_the_post_thumbnail();
		echo inner_doc_nav(get_the_content(), get_post_custom()); // Creates mainfull div
	// Implicit <div id="mainleft">
		?>
        <div class="post"> <a name="topH1"></a>
            <h1><!--a href="<?php// the_permalink(); ?>"> -->
                <?php the_title(); ?>
                <!--</a>--></h1>
            <div class="entry">
                <?php the_content(); ?>
                <?php $custom_fields = get_post_custom(); ?>
            </div>
        </div>
    </div> <!--main(Full?)Left-->
	<?php 
	endwhile; 
	else: 
	?>
    <div class="mainLeftFull">
        <div class="post"> <a name="topH1"></a>
            <h1>404 Error - Page Not Found</h1>
            <div class="entry">
                <p>Sorry, the page you were looking for was not found.</p>
            </div>
        </div>
    </div><!--main(Full?)Left-->
<?php endif; ?>
</div><!-- content -->

<div class="clear"></div>

<?php get_footer(); ?>
