<!-- #comments -->
<div id="comments">

<?php
if ( post_password_required() ) {
	
	_e('This post is password protected. Enter the password to view any comments.','comet');
	echo "</div><!-- #comments -->";

	return;
}

// we have comments
if ( have_comments() ) { ?>
	
	<a href="#respond" class="alignright leave-one"><?php _e('Leave a comment','comet'); ?></a>
	<h3 class="comment-heading post-title"><?php comments_number(__('No Comments','comet'),__('1 Comment','comet'),__( '% Comments','comet') );?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
	<div class="navigation">
		<?php paginate_comments_links() ?>
	</div>
	<?php } ?>

	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=fp_comments'); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
	<div class="navigation">
		<?php paginate_comments_links() ?>
	</div>
	<?php } ?>

	<ol class="trackbacklist">
		<?php wp_list_comments('type=pingback&callback=fp_trackbacks'); ?>
	</ol>

<?php
// we dont have comments
} else {
	
	// comments are closed
	if ( ! comments_open() && ! is_page() ) {

		_e('Comments are closed.','comet');
		
	}

}


// comment form
if ( function_exists('comment_form') ) {
	
	comment_form();
	
} else { // using WordPress lower than 3.0

	if ('open' == $post->comment_status) { ?>

		<h2 class="comment-heading post-title"><?php comment_form_title(); ?></h2>
	
		<div id="respond">
	
		<?php if ( get_option('comment_registration') && !$user_ID ) { ?>
	
			<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	
		<?php } else { ?>
	
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
			<div class="cancel-comment-reply">
				<p><?php cancel_comment_reply_link(); ?></p>
			</div>
		
			<?php if ( $user_ID ) { ?>
	
				<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></p>
				<p><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
	
			<?php } else { ?>
			
				<p class="comment-form-author">
					<label for="author">Name</label>
					<span class="required">*</span>
					<input id="author" name="author" type="text" value="<?php echo $comment_author; ?>" size="30" <?php if ($req) echo "aria-required='true'"; ?> />
				</p> 
				<p class="comment-form-email">
					<label for="email">Email</label>
					<span class="required">*</span>
					<input id="email" name="email" type="text" value="<?php echo $comment_author_email; ?>" size="30" <?php if ($req) echo "aria-required='true'"; ?> />
				</p> 
				<p class="comment-form-url">
					<label for="url">Website</label>
					<input id="url" name="url" type="text" value="<?php echo $comment_author_url; ?>" size="30" />
				</p> 
		
			<?php } ?>
			
			<p class="comment-form-comment">
				<label for="comment">Comment</label>
				<textarea id="comment" name="comment" cols="45" rows="8"></textarea>
			</p>
			
			<p class="form-allowed-tags">
				You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code>
			</p>
			<p class="form-submit"> 
				<input name="submit" type="submit" id="submit" value="Post Comment" /> 
				<?php comment_id_fields(); ?>
			</p> 
	
			<?php do_action('comment_form', $post->ID); ?>
	
			</form><!-- /commentform -->
	
		<?php } // If registration required and not logged in ?>
		</div><!-- /respond -->
		
<?php
	}

} // if you delete this the sky will fall on your head ?>

</div><!-- #comments -->