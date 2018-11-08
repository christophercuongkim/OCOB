<?php get_header(); ?>

<div id="wrapper">
<div id="mainbody">
<div id="content">

<h1 class="posttitle">Aaaackk! This is a 404 page.</h1>

<div>
<p>The page you are looking for no longer exists ... or <em>never</em> existed. </p>
<p>Try one of the following:</p>
<ul>
<li>Hit the "back" button on your browser.</li>
<li>Head on over to the <a href="<?php bloginfo('url'); ?>">front page</a>.</li>
<li>Click on a link in the sidebar.</li>
<li>Use the navigation menu at the top of the page.</li>
<li>Try searching ...</li>
</ul>
<h2><?php _e('Search'); ?></h2>
<p><?php include (TEMPLATEPATH . '/searchform.php'); ?></p>
</div>

</div>

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
