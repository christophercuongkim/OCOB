<?php// File: form_phorm.php ?>
<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/scripts/phorms/forms/phorms.php";
include($path);

// Set up the form
$p_id = 42;
$form = new CommentForm(Phorm::POST, false, array('post_id'=>$p_id, 'notify'=>true));

// Check form validity
$valid = $form->is_valid();
?>
<?php get_header(); ?>
<?php get_sidebar(); 

/**
  *  Template Name: Form- phorm test
  */
  
    ?> 
    <div id="content">
    <div id="contentLine"></div>
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
    echo get_the_post_thumbnail();
    ?>
    <div id="mainLeftFull">
    <div class="post">
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <div class="entry">
      <?php the_content(); 

	  ?>
      
        <p>Complete all questions on the form below to get connected to a Peer Mentor. Upon completion, you will receive a confirmation email.</p>
</div>
                    <div style="clear:both;">
                    </div>
                    <style>
          ul.messages li{
            color:red;
            font-weight:bold;
          }
          </style>
		<style>
			table { border: 1px solid #ccc; padding: 2px 4px; }
			th { vertical-align: top; text-align: right; }
			td { vertical-align: top; }
			thead th { text-align: center; font-size: 16pt; background-color: #ccc; }
			.phorm_error { color: #bb0000; font-size: 10pt; text-align: left; font-style: oblique; }
			.phorm_help { margin: 0; padding: 2px; font-size: 10pt; font-style: oblique; color: #666; }
		</style>
		<?= $form->open("http://www.cob.calpoly.edu/phorm-test/") ?>
<?php  ?>
					<?php if ( $form->has_errors() ): ?>
					<p class="phorm_error">Please correct the following errors.</p>
					<?php endif ?>
                    <fieldset><legend>Field</legend>
					<?= $form ?>
							<input type="button" value="Clear form" onClick="javascript:location.href='<?= $_SERVER['PHP_SELF'] ?>'" />
							<input type="submit" value="Submit" />
                            </fieldset>
		<?= $form->close() ?>
		
		<h4>Raw POST data:</h4>
		<?php var_dump($_POST); ?>
	
		<hr />
	
		<?php if ($form->is_bound() && $valid): ?>
			<h4>Processed and cleaned form data:</h4>
			<? $form->report() ?>
		<?php elseif ($form->has_errors()): ?>
			<h4>Errors:</h4>
			<?php var_dump($form->get_errors()); ?>
		<?php else: ?>
			<p><em>The form is unbound.</em></p>
		<?php endif ?>
      </div>
<?php endwhile; ?>

<?php endif; ?>
      </div><!--main????Full-->
</div> <!-- content -->
        
        <div class="clear"></div>

<script src="/scripts/validatious-custom-0.9.1.min.js" type="text/javascript"></script>
<?php get_footer(); ?>