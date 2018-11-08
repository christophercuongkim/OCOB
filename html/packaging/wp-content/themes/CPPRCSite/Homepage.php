<?php
/*
 *
 *   Template Name: Homepage
 *
 */

get_header(); ?>

    <div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">

        <main id="main" class="site-main" role="main">      
            <div style="margin: 0 auto; width:80%">
                <?php getSlider(get_field('sliderID')); ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>
