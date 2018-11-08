<!-- DESKTOP MENU -->
<div id="secondary-superfish-menu" class="dropdown-menu">
		
	<!-- DEFAULT NAVIGATION -->
	<?php 
	if (has_nav_menu('secondary_menu')) {

	wp_nav_menu( array(
		 'container' =>false,
		 'theme_location' => 'secondary_menu',
		 'menu_class' => 'menu text-right',
		 'echo' => true,
		 'before' => '',
		 'after' => '',
		 'link_before' => '',
		 'link_after' => '',
		 'depth' => 0,
		 // 'walker' => new mythology_walker()
		 )
	 ); 
	 
	} else {
		// wp_nav_menu();
	}

	?>
	<!-- /DEFAULT NAVIGATION -->
				 
</div>
<!-- /DESKTOP MENU -->