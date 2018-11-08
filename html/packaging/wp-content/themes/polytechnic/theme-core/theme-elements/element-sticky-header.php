<!-- DESKTOP STICKY HEADER MENU -->
<div id="sticky-superfish-menu" class="dropdown-menu">
		
	<!-- DEFAULT NAVIGATION -->
	<?php 
	if (has_nav_menu('sticky_menu')) {

	wp_nav_menu( array(
		 'container' =>false,
		 'theme_location' => 'sticky_menu',
		 'menu_class' => 'menu text-center',
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