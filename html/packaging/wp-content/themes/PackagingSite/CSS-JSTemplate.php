<?php
/*
 *
 *   Template Name: CSS/JS Page
 *
 */

get_header(); ?>

<style>
    <?php echo the_field('css'); ?>
</style>


    <div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">

        <main id="main" class="site-main" role="main">      

            <?php while ( have_posts() ) : the_post(); ?>
                <div class="pagePadding">
                    <div class="topImage imageBorder"><?php echo get_the_post_thumbnail(null, "100%"); ?></div>
                    <?php get_template_part( 'theme-core/theme-elements/content', 'page' ); ?>
                </div>

                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>

            <?php endwhile; // end of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<script>
    <?php echo the_field('js'); ?>
</script>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>