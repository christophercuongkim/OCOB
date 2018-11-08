<?php
/**
 * Widget
 */
class Tshowcase_Search_Widget extends WP_Widget

{
	public

	function __construct()
	{
		$options = get_option( 'tshowcase-settings' );
		$name = $options['tshowcase_name_singular'];
		$nameplural = $options['tshowcase_name_plural'];
		$widgetname = $nameplural." Search Form";
		$widget_ops = array(
			'classname' => 'tshowcase_widget',
			'description' =>  $name . ' Search Form'
		);
		parent::__construct( 'tshowcase_widget', $widgetname, $widget_ops);
	}

	public

	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$taxonomies = isset($instance['taxonomies']) ? $instance['taxonomies'] : 'false';
		$taxonomies2 = isset($instance['taxonomies-2']) ? $instance['taxonomies-2'] : 'false';
		$custom_fields = isset($instance['custom_fields']) ? $instance['custom_fields'] : 'false';
		$url = isset($instance['url']) ? $instance['url'] : $_SERVER["PHP_SELF"];
		echo $before_widget;
		if (!empty($title)) echo $before_title . $title . $after_title;
		echo tshowcase_search_form ($title,$taxonomies,$taxonomies2,$custom_fields,$url);
		echo $after_widget;
	}

	public

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['taxonomies'] = $new_instance['taxonomies'];
		$instance['taxonomies-2'] = $new_instance['taxonomies-2'];
		$instance['custom_fields'] = $new_instance['custom_fields'];
		$instance['url'] = strip_tags($new_instance['url']);
		return $instance;
	}

	public

	function form($instance)
	{
		$options = get_option( 'tshowcase-settings' );
		$groups = $options['tshowcase_name_category'];
		global $ts_labels;
		$instance = wp_parse_args((array)$instance, array(
			'title' => '',
			'taxonomies' => '0',
			'custom_fields' => '0',
			'url' => ''
		));
		$title = strip_tags($instance['title']);
		$taxonomies = $instance['taxonomies'];
		$custom_fields = $instance['custom_fields'];
		$url = strip_tags($instance['url']);
		
?>
        <p><label for="<?php
		echo $this->get_field_id( 'title' ); ?>"><?php echo __('Title','tshowcase'); ?>:</label>
        <input class="widefat" id="<?php
		echo $this->get_field_id( 'title' ); ?>" name="<?php
		echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php
		echo esc_attr($title); ?>" /></p>

		 <p>
         <label for="<?php
		echo $this->get_field_id( 'taxonomies' ); ?>"><?php echo __('Display','tshowcase'); ?> <?php echo $groups; ?> <?php echo __('Filter','tshowcase'); ?>:
        </label>
        <select id="<?php
		echo $this->get_field_id( 'taxonomies' ); ?>" name="<?php
		echo $this->get_field_name( 'taxonomies' ); ?>">
          <option value="true" <?php
		selected($taxonomies, 'true' ); ?>><?php echo __('Yes','tshowcase'); ?></option>
          <option value="false" <?php
		selected($taxonomies, 'false' ); ?>><?php echo __('No','tshowcase'); ?></option>
        </select></p>

        <?php
        if(isset($options['tshowcase_second_tax'])) { ?>

        <p>
         <label for="<?php
		echo $this->get_field_id( 'taxonomies-2' ); ?>"><?php echo __('Display','tshowcase'); ?> <?php echo $options['tshowcase_name_tax2']; ?> <?php echo __('Filter','tshowcase'); ?>:
        </label>
        <select id="<?php
		echo $this->get_field_id( 'taxonomies-2' ); ?>" name="<?php
		echo $this->get_field_name( 'taxonomies-2' ); ?>">
          <option value="true" <?php
		selected($taxonomies, 'true' ); ?>><?php echo __('Yes','tshowcase'); ?></option>
          <option value="false" <?php
		selected($taxonomies, 'false' ); ?>><?php echo __('No','tshowcase'); ?></option>
        </select></p>

    	<?php
    	}

    	?>


        <!-- NOT AVAILABLE YET
		<p><label for="<?php
		echo $this->get_field_id( 'custom_fields' ); ?>">Search <?php echo $ts_labels['titles']['info']; ?> Fields:</label>
         <select id="<?php
		echo $this->get_field_id( 'custom_fields' ); ?>" name="<?php
		echo $this->get_field_name( 'custom_fields' ); ?>">
          <option value="true" <?php
		selected($custom_fields, 'true' ); ?>>Yes</option>
          <option value="false" <?php
		selected($custom_fields, 'false' ); ?>>No</option>
        </select>
        <span class="howto">Will slow down search if active</span></p>
    	-->

		<p><label for="<?php
		echo $this->get_field_id( 'url' ); ?>"><?php echo __('Results URL','tshowcase'); ?>:</label>
        <input class="widefat" id="<?php
		echo $this->get_field_id( 'url' ); ?>" name="<?php
		echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php
		echo esc_attr($url); ?>" />
		<span class="howto"><?php echo __('Include the URL of the page where you applied a Team Showcase shortcode. If empty it will default to the search results page template of current Theme.','tshowcase'); ?></span>
		</p>
       
        <?php
	}
}

add_action( 'widgets_init', 'register_tshowcase_search_widget' );
/**
 * Register widget
 *
 * This functions is attached to the 'widgets_init' action hook.
 */

function register_tshowcase_search_widget()
{
	register_widget( 'Tshowcase_Search_Widget' );
}


function tshowcase_search_form ($title,$taxonomies,$taxonomies2,$custom_fields,$url) { 

	$options = get_option( 'tshowcase-settings' );
	$nameplural = $options['tshowcase_name_plural'];
	$groups = $options['tshowcase_name_category'];
	global $ts_labels;
	tshowcase_add_search_css();
	$html = '';

	$autocomplete = (isset($options['tshowcase_autocomplete']) ? true : false);
	$autocompleteclick = (isset($options['tshowcase_autocomplete_click']) ? true : false);

	//autocomplete code
	if($autocomplete) {

		wp_enqueue_script( 'jquery-ui-autocomplete' );

		$targs = array( 'post_type' => 'tshowcase',
					   'orderby' => 'title', 
					   'order' => 'ASC', 
					   'posts_per_page'=> -1, 
					   'nopaging'=> true,				   
					   );


		$tquery = new WP_Query( $targs );

		$html .= '<script>
		jQuery( document ).ready(function() { var availableTags = [';

		while ( $tquery->have_posts() ) : $tquery->the_post(); 

		$html .= '{label:"'.the_title_attribute( 'echo=0' ).'",value:"'.the_title_attribute( 'echo=0' ).'",url:"'.get_permalink().'"},';

		

		endwhile;

		wp_reset_postdata();

		$html .= ' ];
			    jQuery( ".ts_text_search" ).autocomplete({
			      source: availableTags,
			      appendTo: "#tshowcasesearch",';

			      if($autocompleteclick) {
			      	$html .= 'select: function( event, ui ) {window.location.href = ui.item.url;},';
			      }
			     
		$html .='	       
			      open: function() { 
				        jQuery("#tshowcasesearch .ui-autocomplete").width(jQuery("#tshowcasesearch .ts_text_search").outerWidth()); 
				    }  
			    });
			  });
		</script>';

	}
	


	//end autocomplete code


	

	$placeholder = __($ts_labels['search']['search'],'tshowcase')." ". $nameplural;

	$value = (isset($_GET['s']) ? $_GET['s'] : '');
	$value = (isset($_GET['search']) ? sanitize_text_field($_GET['search']) : $value);

	$value = sanitize_text_field(stripslashes($value));

	$value = str_replace('"', "", $value);
	$value = str_replace("'", "", $value);

	$cat = (isset($_GET['tshowcase-categories']) ? $_GET['tshowcase-categories'] : '');
	$tax = (isset($_GET['tshowcase-taxonomy']) ? $_GET['tshowcase-taxonomy'] : '');


	
	$hiddentype = '';
	$searchstring = 'search';

	if($url == "") {
		$url = site_url('/');
		$hiddentype = '<input type="hidden" name="post_type" value="tshowcase" />';
		$searchstring = 's';
	}


    $html .= '<form role="search" action="'.$url.'" method="get" id="tshowcasesearch">';
    $html .= '<input type="text" name="'.$searchstring.'" placeholder="'.$placeholder.'" class="ts_text_search" value="'.$value.'" />';

   if($taxonomies=="true") { 
     
      $html .= '<select id="tshowcase-categories" name="tshowcase-categories" class="ts_select_categories">';
      $html .= '      <option value="">'.__($ts_labels['search']['all-taxonomies'],'tshowcase').' '.$groups. '</option>';
            
            	 $args = array('hide_empty' => false, 'hierarchical' => true, 'parent' => 0); 
				 $terms = get_terms("tshowcase-categories",$args);
				 $count = count($terms);
				
				 if ( $count > 0 ){
					 
					foreach ( $terms as $term ) { 
					 	$selected = '';
					 	if($cat==$term->slug) {
					 		$selected = ' selected ';
					 	}

					    $html .= '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';

					    $args = array(
			                'hide_empty'    => false, 
			                'hierarchical'  => true, 
			                'parent'        => $term->term_id
			            ); 
			            $childterms = get_terms("tshowcase-categories", $args);

			            foreach ( $childterms as $childterm ) {
			            	$selected = '';
			            	if($cat==$childterm->slug) {
						 		$selected = ' selected ';
						 	}
			                $html .= '<option value="' . $childterm->slug . '" '.$selected.'> - ' . $childterm->name . '</option>';
			                
			            }

					}
					 
				 }
		
		
        $html .= '    </select>';


    }

     if($taxonomies2=="true") { 
        //second taxonomy form
         if(isset($options['tshowcase_second_tax'])) { 

         	$taxlabel = isset($options['tshowcase_name_tax2']) ? $options['tshowcase_name_tax2'] : 'Groups';

         	$html .= '<select id="tshowcase-taxonomy" name="tshowcase-taxonomy" class="ts_select_categories">';
		      $html .= '      <option value="">'.__($ts_labels['search']['all-taxonomies'],'tshowcase').' '.$taxlabel. '</option>';
		            
		            	 $args = array('hide_empty' => false, 'hierarchical' => true, 'parent' => 0); 
						 $terms = get_terms("tshowcase-taxonomy",$args);
						 $count = count($terms);
						
						 if ( $count > 0 ){
							 
							foreach ( $terms as $term ) { 
							 	$selected = '';
							 	if($tax==$term->slug) {
							 		$selected = ' selected ';
							 	}

							    $html .= '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';

							    $args = array(
					                'hide_empty'    => false, 
					                'hierarchical'  => true, 
					                'parent'        => $term->term_id
					            ); 
					            $childterms = get_terms("tshowcase-taxonomy", $args);

					            foreach ( $childterms as $childterm ) {
					            	$selected = '';
					            	if($cat==$childterm->slug) {
								 		$selected = ' selected ';
								 	}
					                $html .= '<option value="' . $childterm->slug . '" '.$selected.'> - ' . $childterm->name . '</option>';
					                
					            }

							}
							 
						 }
				
				
		        $html .= '    </select>';



         }


           
     } 

   $html .= $hiddentype;
   $html .= ' <input type="submit" alt="'.__('Search','tshowcase').'" value="'.__('Search','tshowcase').'" />';
   $html .= '	</form>';

   return $html;

}

function tshowcase_add_search_css() {
       		wp_deregister_style( 'tshowcase-search-style' );
		    wp_register_style( 'tshowcase-search-style', plugins_url( '/css/search-forms.css', __FILE__ ),array(),false,'all');
			wp_enqueue_style( 'tshowcase-search-style' );	

    } 


?>