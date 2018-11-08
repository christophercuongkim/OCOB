<?php  
/* 
Template Name: ListChildren
*/  
?>
<?php get_header(); 
$PAGE = $post->ID;
?>

<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
  <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark">
    <?php the_title(); ?>
    </a></h1>
  <div class="post-text">
    <ul>
      <?php wp_list_pages("title_li=&child_of=$PAGE" ); ?>
    </ul>
  </div>
</div>
<?php get_footer(); ?>
