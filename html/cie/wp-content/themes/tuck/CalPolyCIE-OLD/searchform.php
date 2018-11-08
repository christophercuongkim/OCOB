<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label for="s">Search</label>
	<input type="search" id="s" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search', 'label' ) ?>" />
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>