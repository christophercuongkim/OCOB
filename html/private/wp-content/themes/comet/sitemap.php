<?php  
/* 
Template Name: Sitemap 
*/  
?>  
<?php get_header(); ?>

  <h3>Pages</h3>
  <ul><?php wp_list_pages("title_li=" ); ?></ul>
  <h3>Feeds</h3>
  <ul>
      <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>
      <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>
  </ul>
  <h3>Categories</h3>
  <ul><?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0&feed=RSS'); ?></ul>
  <h3>All Blog Posts:</h3>
  <ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8');
          while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
              <li>
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
               (<?php comments_number('0', '1', '%'); ?>)
              </li>
          <?php endwhile; ?>
  </ul>
  
  <h3>Archives</h3>
  <ul>
      <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
  </ul>

<?php get_footer(); ?>