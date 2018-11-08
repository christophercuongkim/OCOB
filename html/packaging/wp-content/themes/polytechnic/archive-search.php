<?php
/**
 * The template for displaying Search Results pages for Polytechnic Courses
 *
 * @package mythology
 */

get_header(); ?>

    <section id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?> polytechnic_courses">
        <main id="main" class="site-main" role="main">

        <!-- Cycle through all posts -->
        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'mythology' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                <hr class="title">
            </header><!-- .page-header -->

            <!-- Start the table -->
            <table id="course-list">
                <tbody>

                    <!-- Start the table header row -->
                    <tr class="course-list-header">
                        <th class="course-id">
                            <?php _e( 'Course ID', 'mythology' ); ?>
                        </th>
                        <th class="course-number">
                            <?php _e( 'Course Number', 'mythology' ); ?>
                        </th>
                        <th class="course-name">
                            <?php _e( 'Course Name', 'mythology' ); ?>
                        </th>
                        <th class="course-instructor">
                            <?php _e( 'Instructor', 'mythology' ); ?>
                        </th>
                        <th class="course-room-number">
                            <?php _e( 'Room Number', 'mythology' ); ?>
                        </th>
                        <th class="course-days">
                            <?php _e( 'Days', 'mythology' ); ?>
                        </th>
                        <th class="course-time">
                            <?php _e( 'Time', 'mythology' ); ?>
                        </th>
                        <th class="course-credits">
                            <?php _e( 'Credits', 'mythology' ); ?>
                        </th>
                        <th class="course-prerequisites">
                            <?php _e( 'Prerequisites', 'mythology' ); ?>
                        </th>
                    </tr>
                    <!-- /End the table header row -->
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                            

                                    <?php
                                        /* Include the Post-Format-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                         */
                                        get_template_part( 'theme-core/theme-elements/content', 'course-list' );
                                        //get_template_part( 'theme-core/theme-elements/content', 'authorgrid' );
                                    ?>

                    <?php endwhile; ?>

                </tbody>
            </table>
            <!-- /End the table -->

            <?php mythology_content_nav( 'nav-below' ); ?>

        <?php else : ?>

            <?php get_template_part( 'theme-core/theme-elements/content', 'none' ); ?>

        <?php endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>