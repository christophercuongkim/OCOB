<!-- comments -->
<div id="comments">
<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) {
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';

	/* calculate number of comments and trackbacks */
	$totComments = 0;
	$totTrackbacks = 0;

	foreach ($comments as $comment) 
		{
		if (get_comment_type() != "comment")
			{ $totTrackbacks++; }
		else 
			{ $totComments++; }
	}
?>

<?php if ($comments) : ?>
	<h2><?php 

	if ($totComments==0)
		{ echo("No Comments"); }
	elseif ($totComments==1)
		{ echo("1 Comment"); }
	else
		{ echo("$totComments Comments"); }

	?></h2>

	<ol class="commentlist">

	<?php 
	foreach ($comments as $comment) :
	
	if (get_comment_type()=="comment") : ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="comment-reply">
		<?php edit_comment_link(__('Edit',comet),'','') ?>
	</div>
	<div class="comment-author">
		<?php echo get_avatar($comment,$size='40' ); ?>
		<cite class="fn"><?php comment_author_link() ?></cite>
		<div class="comment-meta">
			<a href="#comment-<?php comment_ID() ?>"><?php comment_date() ?> at <?php comment_time() ?></a>
		</div>
	</div>
	<?php comment_text() ?>
	<?php if ($comment->comment_approved == '0') : ?>
		<p><em>Your comment is awaiting moderation</em></p>
	<?php endif; ?>
</li> 

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>

	<?php endif; endforeach; ?>
	</ol>

<?php
	/* List all trackbacks */
	if ($totTrackbacks != 0) : ?>

	<h2><?php 

	if ($totTrackbacks==0)
		{ echo("No Trackbacks"); }
	elseif ($totTrackbacks==1)
		{ echo("1 Trackback"); }
	else
		{ echo("$totTrackbacks Trackbacks"); }

	?></h2>
	<ul>

<?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type()!="comment") : ?>

	<li id="comment-<?php comment_ID() ?>">
		<?php comment_date() ?>: <?php comment_author_link() ?>
	</li>
	
<?php endif; endforeach; ?>

	</ul>

<?php endif; ?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<h2>Leave a Reply</h2>

<div id="respond">

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="25" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author">Name <?php if ($req) echo "(required)"; ?></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="25" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="25" tabindex="3" />
<label for="url">Website</label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" class="button" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<p>Using <a href="http://gravatar.com/" target="_blank">Gravatars</a> in the comments - get your own and be recognized!</p>

<p><strong>XHTML:</strong> These are some of the tags you can use: <code>&lt;a href=""&gt; &lt;b&gt; &lt;blockquote&gt; &lt;code&gt; &lt;em&gt; &lt;i&gt; &lt;strike&gt; &lt;strong&gt;</code></p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; ?>
</div>

<?php endif; ?>
</div>
<!-- /comments -->