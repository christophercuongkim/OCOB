<!-- SOCIAL MEDIA + SEARCH -->
<div class="search sf_container">
	<form role="search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<fieldset class="sf_search">
			<input type="text" class="field sf_input" value="<?php the_search_query(); ?>" name="s" style="float: left;" />
			<input type="submit" class="button" value="Search" />
		</fieldset>
	</form>
</div>
<!-- /SOCIAL MEDIA + SEARCH -->