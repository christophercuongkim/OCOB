<style type="text/css">
<?php /* Custom CSS Modifications from the Admin Panel */
global $theme_options; 

if (ot_get_option("theme_primary_color")) : $theme_primary_color = ot_get_option("theme_primary_color"); endif; 
if (get_custom_field("theme_primary_color")) : $theme_primary_color = get_custom_field("theme_primary_color"); endif;

if (ot_get_option("theme_secondary_color")) : $theme_secondary_color = ot_get_option("theme_secondary_color"); endif; 
if (get_custom_field("theme_secondary_color")) : $theme_secondary_color = get_custom_field("theme_secondary_color"); endif;

if (isset($theme_primary_color[0])) : ?>	

	/* Colorful Text : Primary States; */
	.theme_primary_color_text,
	a, a:visited, a:hover, a:focus, a:active,
	#page .current-menu-item .menu-item-title,
	.sf-menu li:hover .menu-item-title, .sf-menu li.sfHover .menu-item-title, .sf-menu li:hover .menu-item-subtitle, .sf-menu li.sfHover .menu-item-subtitle, .sf-menu li .menu-item-title:focus{	
		color: <?php echo esc_attr( $theme_primary_color ); ?> ; 
	}

	/* Primary Backgrounds */
	.theme_primary_color_bg,
	.sf-menu ul li:hover, .sf-menu ul li.sfHover,
	#page .tagcloud a,
	#section-tophat .left,
	#section-sub-footer .left{	
		background-color: <?php echo esc_attr( $theme_primary_color ); ?> ; 
	}

	#page .no-touch .dl-menuwrapper li a:hover{	
		background-color: <?php echo esc_attr( $theme_primary_color ); ?> !important; 
	}


	button, .button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"] {
	  background-color: <?php echo esc_attr( $theme_primary_color ); ?>;
	  border-color: <?php echo esc_attr( $theme_primary_color ); ?>;
	  color: white; }

	  button:hover, button:focus, .button:hover, .button:focus,
	  input[type="button"]:hover,
	  input[type="reset"]:hover,
	  input[type="submit"]:hover,
	  input[type="button"]:focus,
	  input[type="reset"]:focus,
	  input[type="submit"]:focus {
	    background-color: <?php echo esc_attr( $theme_primary_color ); ?>; }

	  button:hover, button:focus, .button:hover, .button:focus,
	  input[type="button"]:hover,
	  input[type="reset"]:hover,
	  input[type="submit"]:hover,
	  input[type="button"]:focus,
	  input[type="reset"]:focus,
	  input[type="submit"]:focus {
	    color: white; }

	#sf_results #sf_val ul li.sf_selected {
	    background-color: <?php echo esc_attr( $theme_primary_color ); ?> !important;
	    border-color: <?php echo esc_attr( $theme_primary_color ); ?> !important;
	    color: #FFFFFF !important;
	}

<?php endif;

/* Custom CSS (from user) */
echo esc_attr( ot_get_option('customcss') );
?> 
</style>

<?php /* Custom SCRIPTS (from user) */
echo esc_js( ot_get_option('customscripts') );
?> 