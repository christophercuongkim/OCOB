<?php 
    //if on news and events, 404 redirects to the homepage
    if(get_current_blog_id() == 4)
        header("Location: /newsevents/#404");
?>

<?php get_header(); ?>
<?php get_sidebar(); ?>
<!-- 404.php -->

<div id="content">
    <div id="contentLine"></div>
    <div class="mainLeftFull">
        <div class="post"> <a name="topH1"></a>
            <h1>404 Error - Page Not Found</h1>
            <div class="entry">
                <p>Sorry, the page you were looking for was not found.</p>
            </div>
        </div>
    </div><!--main(Full?)Left-->
</div><!-- content -->

<div class="clear"></div>

<?php get_footer(); ?>
