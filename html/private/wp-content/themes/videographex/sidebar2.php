<div id="sidebarleft">

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1)) : else : ?>

<?php if (is_single()) { ?>

<h2>Related Videos</h2>
<ul>
<?php $current_cat=get_the_category();
$current_category = $current_cat[0]->cat_name; ?>
<?php $query= 'category_name=' . $current_category. '&orderby=date&showposts=10'; // concatenate the query ?> 
<?php query_posts($query); // run the query ?>
<?php while (have_posts()) : the_post(); ?>
<li class="recentposts"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
<?php endwhile;?>
<?php $sblinks = get_post_meta($post->ID, 'sb_links', true); ?>
<?php echo $sblinks ?>
</ul>

<?php } else { ?>

<h2>Latest Videos</h2>
<ul><?php wp_get_archives('type=postbypost&limit=10&format=custom&before=<li>&after=</li>'); ?></ul>

<?php } ?>

<?php endif; ?>

</div>
