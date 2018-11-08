<?php
/*
 *
 *   Template Name: Syposium Speakers Template
 *
 */

get_header(); 

function SortByLastName( $a, $b ) {
    $a_last = end(explode(' ', $a->post_title));
    $b_last = end(explode(' ', $b->post_title));
    return strcasecmp( $a_last, $b_last );
}
?>
    <link rel='stylesheet' id='vc_inline_css-css'  href='https://www.cob.calpoly.edu/studentservices/wp-content/plugins/js_composer/assets/css/js_composer_frontend_editor.min.css' type='text/css' media='all' />

    <div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">

        <main id="main" class="site-main" role="main">    
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'theme-core/theme-elements/content', 'page' ); ?>

                <?php
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>

            <?php endwhile; ?>
            <section class="vc_section">
                <div class="vc_row wpb_row vc_row-fluid">
                    <?php 
                    $args = array(
                        'post_type'=> 'symposium_speakers',
                        'category__in' => get_category_by_slug(get_field("year_to_display"))->term_id,
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'order' => 'ASC'
                    );    
                    $query = new WP_Query($args); 
                    usort($query->posts, 'SortByLastName');
                    if($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>   
                            <div class="vc_row wpb_row vc_row-fluid">
                                <div class="wpb_column vc_column_container vc_col-sm-3">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="wpb_single_image wpb_content_element vc_align_left">
        
                                                <figure class="wpb_wrapper vc_figure">
                                                    <div class="vc_single_image-wrapper   vc_box_border_grey">
                                                        <img width="150" height="150" src="<?php echo get_the_post_thumbnail_url(null, "thumbnail") ?>" class="vc_single_image-img attachment-thumbnail" alt="">
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column vc_column_container vc_col-sm-9">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <h2 style="text-align: left;font-family:Arimo;font-weight:400;font-style:normal" class="vc_custom_heading">
                                                <?php 
                                                    the_title();
                                                    if(get_field("title_addition") != "")
                                                        echo( ", " . get_field("title_addition"));
                                                ?>
                                            </h2>   
                                            <b> 
                                            <?php    
                                                if(get_field("company_name") != "")
                                                    echo(get_field("company_name"));
                                             ?>
                                            </b>
                                            <div class="wpb_text_column wpb_content_element ">
                                                <div class="wpb_wrapper">
                                                    <p><?php the_content() ?></p>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>