<!-- MOBILE MENU -->
<div id="responsive-nav" class="dl-menuwrapper">
	<button>Open Menu</button>
			
	<?php 
	if (has_nav_menu('responsive_menu')) {

	wp_nav_menu( array(
	 'container' =>false,
	 'theme_location' => 'responsive_menu',
	 'menu_class' => 'dl-menu',
	 'echo' => true,
	 'before' => '',
	 'after' => '',
	 'link_before' => '',
	 'link_after' => '',
	 'depth' => 0,
	 'walker' => new mobile_walker())
 	);

 	}
	?>

</div>
<!-- /END MOBILE MENU -->