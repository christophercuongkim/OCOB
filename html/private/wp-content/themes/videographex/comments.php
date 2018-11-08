<div class="comments">
<div class="list">

<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) {
if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
?>

<p>This post is password protected. Enter the password to view comments.<p>

<?php
return;
}
}
$oddcomment = 'alt';
?>

<!-- You can start editing here. -->
<?php if ($comments) : ?>
<h2><?php comments_number('No Response', 'One Response', '% Responses' );?></h2> 
<ol>
<?php foreach ($comments as $comment) : ?>
<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
<p class="commenttitle"><strong><?php comment_author_link() ?></strong></p>
<p class="commentmeta"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> at <?php comment_time() ?><?php edit_comment_link('&nbsp;&nbsp;<strong>Edit Comment</strong>','',''); ?></a></p>
<span class="commentnumber"><?php $commentNumber++; echo $commentNumber; ?></span>
<div class="commentbody">
<?php echo get_avatar( $comment, 32 ); ?>
<?php comment_text() ?> 
<?php if ($comment->comment_approved == '0') : ?>
<p class="small"><em>Your comment is awaiting moderation.</em></p>
<?php endif; ?>  
</div>
</li>
<?php endforeach; ?>
</ol>

<?php else : ?>
<?php if ('open' == $post->comment_status) : ?> 
<?php else : ?>
<p>Comments are closed.</p>
<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?><br />
</div>

<p><?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post')); ?></p>

<!-- Comments Form-->
<h2><?php _e('Share your comments'); ?></h2>
<div id="formblock">
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>">Logout &raquo;</a></p>
<?php else : ?>

<p><label for="author"><strong><?php _e('Name'); ?></strong> <?php if ($req) _e('(required)'); ?></label><br /> 
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="70" tabindex="1" /></p>
<p><label for="email"><strong><?php _e('E-mail'); ?></strong> <?php if ($req) _e('(required, but will not be displayed)'); ?></label><br />  
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="70" tabindex="2" /></p>
<p><label for="url"><strong><?php _e('Your Website'); ?></strong> <?php _e('(optional)'); ?></label><br /> 
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="70" tabindex="3" /></p>

<?php endif; ?>

<p><label for="comments" id="comments"><strong><?php _e('Comments'); ?></strong></label><br />
<textarea name="comment" id="comment" cols="70" rows="10" tabindex="4"></textarea></p>
<p><input class="button" name="submit" id="submit" type="submit" tabindex="5" value="<?php _e('Submit Comment'); ?>" /></p>
<p><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>	
<?php do_action('comment_form', $post->ID); ?>
</form>
</div>
</div>
<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>
