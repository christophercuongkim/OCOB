<?php// File: page.php ?>
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

/**
  * Template name: International Business Tours Form Results Template
  */ 
?>

<div id="content">
    <div id="contentLine"></div>
    <?php 
	if(have_posts()): while(have_posts()) : 
		the_post(); 
		echo get_the_post_thumbnail();
		echo inner_doc_nav(get_the_content(), get_post_custom());?>
        <div class="post"> <a name="topH1"></a>
            <h1><!--a href="<?php// the_permalink(); ?>"> -->
                <?php the_title(); ?>
				
				<?php
					$files = scandir('/var/www/wp-content/forms/InternationalTravelForm');
					foreach($files as $file) {
						//echo($file->getFilename() . "<br>\n");
		
					}
				?>
                
        </div>
    </div> 
	<?php 
	endwhile; 
	else: 
	?>
<?php endif; ?>
</div>

<div class="clear"></div>

<?php get_footer(); ?>
