<div class="author-box sixteen columns alpha omega theme_hook">    	
	<div class="four columns alpha">
		<div class="author-avatar">
			<a href="<?php echo esc_attr( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				<?php

				 /* * USAGE:
				 * <?php $imgURL = get_cupp_meta( $user_id, $size ); ?>
				 * or
				 * <img src="<?php echo esc_url( get_cupp_meta( $user_id, $size ) ); ?>">
				 * 
				 * Beginner WordPress template editing skill required. Place the above tag in your template and provide the two parameters.
				 * @param $user_id    Default: $post->post_author. Will accept any valid user ID passed into this parameter.
				 * @param $size       Default: 'thumbnail'. Accepts all default WordPress sizes and any custom sizes made by the add_image_size() function.
				 * @return {url}      Use this inside the src attribute of an image tag or where you need to call the image url. */

				// Retrieve The Post's Author ID
				$user_ID = get_the_author_meta('ID');
				// Set the image size. Accepts all registered images sizes and array(int, int)
				$size = 'author-avatar'; 
				// Get the image URL using the author ID and image size params
				if (get_cupp_meta( $user_ID, $size )):
				$imgURL = get_cupp_meta($user_ID, $size);
				else : 
				$imgURL = WP_THEME_URL . '/theme-core/theme-assets/images/default-author-image.jpg';
				endif;
				?>
				<!-- Print the image on the page -->
				<img class="theme_image" src="<?php echo esc_url ( $imgURL );?>"/>
				
			</a>
		</div>
	</div>

	<div class="twelve columns omega">
		<div class="author-description">
			<h3><?php echo esc_html( the_author_posts_link() ); ?></h3>
			<?php $authordesc = the_author_meta('description');
			if ( ! empty ( $authordesc ) ) :
				echo esc_html( the_author_meta('description') );
			/* else :
				$default_description = _e( 'Welcome to ', 'mythology');
				$default_description .= bloginfo('name');
				$default_description .= _e( '. Go ahead and click around, there is a ton of new stuff to check out.', 'mythology');
				echo esc_html( $default_description ); */
			endif; ?>
		</div>
	</div>
</div>