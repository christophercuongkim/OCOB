<?php
/**
 * The Template for displaying all single courses.
 *
 * @package mythology
 */

get_header(); ?>

  <div id="primary" class="<?php echo esc_attr( $primary_layout_classes ); ?>">
    <main id="main" class="site-main" role="main">

    <?php $mypost = array( 'post_type' => 'polytechnic_courses', );
        $loop = new WP_Query( $mypost ); ?>
        <!-- Cycle through all posts -->
        <?php while ( $loop->have_posts() ) : $loop->the_post();?>

      <?php// get_template_part( 'theme-core/theme-elements/content', 'course' ); ?>


      <!-- ===== START THE COURSE MARKUP ========================================= -->

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header clearfix">

          <h1 class="entry-title"><?php the_title(); ?></h1>
          <hr class="title"/>

        </header>

        <!-- Begin Course Meta -->
        <div class="entry-meta clearfix">

          <div class="two columns">
            <?php if (has_post_thumbnail( $post->ID )) : ?>
              <div class="entry-media">
                  <div class="entry-media-inner">
                   <?php the_post_thumbnail( array(100,100) ); ?>
                  </div>
              </div>
            <?php endif; ?>
          </div>

          <div class="fourteen columns">
            <strong>Course ID: </strong>
            <?php echo esc_html( get_post_meta( get_the_ID(), 'course_number', true ) ); ?>
          </div>

        </div>
        <!-- /End Post Meta -->

        <div class="entry-content">
          <?php the_content(); ?>
          <?php
            wp_link_pages( array(
              'before' => '<div class="page-links">' . __( 'Pages:', 'mythology' ),
              'after'  => '</div>',
            ) );
          ?>
        </div><!-- .entry-content -->

        <div class="after-content">

          <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() )
              comments_template();
          ?>

          <?php if(ot_get_option('show_edit') == "on" ) : ?>
            <?php edit_post_link( __( 'Edit', 'mythology' ), '<span class="edit-link button">', '</span>' ); ?>
          <?php endif; ?>

        </div>


      </article><!-- #post-## -->

    <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php wp_reset_query(); ?>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>