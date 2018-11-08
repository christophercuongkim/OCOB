<?php
//add shortcode generator page
function tshowcase_shortcode_page_add() {
	
	$menu_slug = 'edit.php?post_type=tshowcase';
	$submenu_page_title = __('Shortcode Generator','tshowcase');
    $submenu_title = __('Shortcode Generator','tshowcase');
	$capability = 'manage_options';
    $submenu_slug = 'tshowcase_shortcode';
    $submenu_function = 'tshowcase_shortcode_page';
    $defaultp = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
	
	
	add_action($defaultp, 'tshowcase_enqueue_admin_js');
	
   }

function tshowcase_enqueue_admin_js() {
	
	//Slider JS
	wp_deregister_script( 'tshowcase-bxslider' );
	wp_register_script( 'tshowcase-bxslider', plugins_url( '/js/bxslider/jquery.bxslider.js', __FILE__ ),array('jquery'),false,false);
	wp_enqueue_script( 'tshowcase-bxslider' );	
	
	//Filter JS
	wp_deregister_script( 'tshowcase-filter' );
	wp_register_script( 'tshowcase-filter', plugins_url( '/js/filter.js', __FILE__ ),array('jquery','jquery-ui-core','jquery-effects-core'),false,false);
	wp_enqueue_script( 'tshowcase-filter' );
	
	wp_deregister_script( 'tshowcase-enhance-filter' );
	wp_register_script( 'tshowcase-enhance-filter', plugins_url( '/js/filter-enhance.js', __FILE__ ),array('jquery','jquery-ui-core','jquery-effects-core'),false,false);
	wp_enqueue_script( 'tshowcase-enhance-filter' );

  wp_deregister_script( 'tshowcase-isotope' );
  wp_register_script( 'tshowcase-isotope', plugins_url( '/js/isotope.pkgd.min.js', __FILE__ ),array('jquery',),false,false);
  wp_enqueue_script( 'tshowcase-isotope' );

  wp_deregister_script( 'tshowcase-imgs-loaded' );
  wp_register_script( 'tshowcase-imgs-loaded', plugins_url( '/js/imagesloaded.pkgd.min.js', __FILE__ ),array('jquery','tshowcase-isotope'),false,false);
  wp_enqueue_script( 'tshowcase-imgs-loaded' );

  wp_deregister_script( 'tshowcase-cells-isotope' );
  wp_register_script( 'tshowcase-cells-isotope', plugins_url( '/js/cells-by-row.js', __FILE__ ),array('jquery','tshowcase-isotope'),false,false);
  wp_enqueue_script( 'tshowcase-cells-isotope' );
  
  wp_deregister_script( 'tshowcase-isotope-filter' );
  wp_register_script( 'tshowcase-isotope-filter', plugins_url( '/js/filter-isotope.js', __FILE__ ),array('jquery','tshowcase-isotope','tshowcase-isotope'),false,false);
  wp_enqueue_script( 'tshowcase-isotope-filter' );	
	
	wp_deregister_script('tshowcaseadmin');
	wp_register_script( 'tshowcaseadmin', plugins_url( '/js/shortcode-builder.js' , __FILE__ ), array('jquery') );
	wp_enqueue_script( 'tshowcaseadmin' );
	
	// in javascript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'tshowcaseadmin', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	
	
	//All themes
	global $ts_theme_names;	
	foreach ($ts_theme_names as $themearray) {	
		foreach($themearray as $theme) {		
		wp_deregister_style( $theme['name']);
		wp_register_style($theme['name'], plugins_url($theme['link'], __FILE__ ),array(),false,false);
		wp_enqueue_style($theme['name'] );	
		}
	}
	
			
				

	//global styles
	wp_deregister_style( 'tshowcase-global-style' );
	wp_register_style( 'tshowcase-global-style', plugins_url( '/css/global.css', __FILE__ ),array(),false,false);
	wp_enqueue_style( 'tshowcase-global-style' );	
			
	//small icons
	wp_deregister_style( 'tshowcase-smallicons' );
	wp_register_style( 'tshowcase-smallicons', plugins_url( '/css/font-awesome/css/font-awesome.min.css', __FILE__ ),array(),false,false);
	wp_enqueue_style( 'tshowcase-smallicons' );	
	
}



add_action('wp_ajax_tshowcase', 'tshowcase_run_preview');

function tshowcase_run_preview() {	
	
	$orderby = $_POST['porder'];
	$limit = $_POST['plimit'];
  $exclude = $_POST['pexclude'];
  $idsfilter = $_POST['pidsfilter'];
	$category = $_POST['pcategory'];
	$url =  $_POST['purl'];
	$layout = $_POST['playout'];
	$style = $_POST['pstyle'];
	$display = $_POST['pdisplay']; 
	$img = $_POST['pimg'];
  $pagination = 'false';
  $searchact = 'false'; 

  $taxonomy = isset($_POST['ptax']) ? $_POST['ptax'] : '0';	 
  $showid= isset($_POST['show_id']) ? $_POST['show_id'] : 'true'; 
  $relation= isset($_POST['prelation']) && $_POST['prelation'] !='' ? $_POST['prelation'] : 'OR';
  $page = isset($_POST['page']) ? $_POST['page'] : 1;

  $id = isset($_POST['id']) ? $_POST['id'] : '0';
  
  $atts=array();


	$html = build_tshowcase($orderby,$limit,$idsfilter,$exclude,$category,$url,$layout,$style,$display,$pagination,$img,$searchact,$showid,$relation,$page,$id,$taxonomy,$atts);

	echo $html;
	die(); // this is required to return a proper result
}



function tshowcase_shortcode_page() { 
	$options = get_option('tshowcase-settings');	
	$categories = $options['tshowcase_name_category'];
  $taxonomies = isset($options['tshowcase_name_tax2']) ? $options['tshowcase_name_tax2'] : '2nd Taxonomy';

  $tax2 = isset($options['tshowcase_second_tax']) ? true : false;
	
	global $ts_labels;
	global $ts_theme_names;

  $s_settings = get_option( 'tshowcase_shortcode_settings', '' );
  $selectedv = array();

  if($s_settings!='') {
    foreach ($s_settings as $key => $value) {
      if(!isset($selectedv[$value['name']])) {
        $selectedv[$value['name']] = $value['value'];
      } else {
        $selectedv[$value['name']] = $selectedv[$value['name']].'|'.$value['value'];
      }
      
    }
  }

?>
	
<h1>Shortcode Generator</h1>
<table cellpadding="5" cellspacing="5">
  <tr>
    <td width="20%" valign="top"><div class="postbox" style="width:360px;">
      <form id="shortcode_generator" style="padding:20px;">
        <h2><?php echo __('What entries do you want to display?','tshowcase'); ?></h2>
        <?php

          $multiple = isset($selectedv['multiple']) ? 'checked' : '';

          ?>
         Multiple <?php echo $categories; ?> Selection <input <?php echo $multiple; ?> name="multiple" type="checkbox" id="multiple" onChange="tshowcaseshortcodegenerate()" value="multiple">
        <span id="multiplemsg" class="howto"></span>
        <p>
          <label for="category"><?php echo $categories; ?>:</label>

          <?php

          $current_category = isset($selectedv['category']) ? $selectedv['category'] : null;
          if($current_category != null) {
            $current_category = explode('|',$current_category);
          }

          ?>

          <select id="category" name="category" onChange="tshowcaseshortcodegenerate()" <?php if(isset($selectedv['multiple'])) { echo "multiple='multiple'"; } ?>>
            <option value="0" <?php if(is_array($current_category) && in_array("0", $current_category)) { echo "selected"; } ?> >All</option>
            <?php 
		
				 $terms = get_terms("tshowcase-categories");
				 $count = count($terms);

				 if ( $count > 0 ){

           
					 
					 foreach ( $terms as $term ) {
             $select_echo = '';
             if(is_array($current_category) && in_array($term->slug, $current_category)) { $select_echo = "selected = 'selected'"; }

					    echo "<option ".$select_echo." value='".$term->slug."'>".$term->name."</option>";
						 }
					 
				 }
		
		?>
            </select>
          </p>

           <?php if($tax2)  { ?>

            <p>
          <label for="relation"><?php echo __('Relation','tshowcase'); ?></label>
          <select id="relation" name="relation" onChange="tshowcaseshortcodegenerate()">

            <?php
            $relation = isset($selectedv['relation']) ? $selectedv['relation'] : null;
            ?>

            <option value="AND" <?php selected($relation,'AND'); ?>><?php echo __('AND','tshowcase'); ?></option>
            <option value="OR" <?php selected($relation,'OR'); ?>><?php echo __('OR','tshowcase'); ?></option>
           </select>
          </p>
             
          <p>

         <label for="taxonomies"><?php echo $taxonomies; ?>:</label>

          <?php

          $current_tax = isset($selectedv['taxonomy']) ? $selectedv['taxonomy'] : null;
          if($current_tax != null) {
            $current_tax = explode('|',$current_tax);
          }

          ?>

          <select id="taxonomy" name="taxonomy" onChange="tshowcaseshortcodegenerate()" <?php if(isset($selectedv['multiple'])) { echo "multiple='multiple'"; } ?>>
            <option value="0" <?php if(is_array($current_tax) && in_array("0", $current_tax)) { echo "selected"; } ?> >All</option>
            <?php 
    
         $terms = get_terms("tshowcase-taxonomy");
         $count = count($terms);

         if ( $count > 0 ){

           
           
           foreach ( $terms as $term ) {
             $select_echo = '';
             if(is_array($current_tax) && in_array($term->slug, $current_tax)) { $select_echo = "selected = 'selected'"; }

              echo "<option ".$select_echo." value='".$term->slug."'>".$term->name."</option>";
             }
           
         }
    
    ?>
            </select>


          </p>

          <?php }  else { ?>

          <input type="hidden" id="taxonomy" name="taxonomy" value="0">
          <input type="hidden" id="relation" name="relation" value="OR">

          <?php } ?>
        
        <p>
          <label for="orderby"><?php echo __('Order By','tshowcase'); ?></label>
          <select id="orderby" name="orderby" onChange="tshowcaseshortcodegenerate()">

            <?php
            $current_order = isset($selectedv['orderby']) ? $selectedv['orderby'] : null;
            ?>

            <option value="none" <?php selected($current_order,'none'); ?>><?php echo __('Default (Order Field)','tshowcase'); ?></option>
            <option value="title" <?php selected($current_order,'title'); ?>><?php echo __('Name','tshowcase'); ?></option>
             <option value="lastname" <?php selected($current_order,'lastname'); ?>><?php echo __('Last Word in Name','tshowcase'); ?></option>
            <option value="ID" <?php selected($current_order,'ID'); ?>><?php echo __('ID','tshowcase'); ?></option>
            <option value="date" <?php selected($current_order,'date'); ?>><?php echo __('Date','tshowcase'); ?></option>
            <option value="modified" <?php selected($current_order,'modified'); ?>><?php echo __('Modified Date','tshowcase'); ?></option>
            <option value="rand" <?php selected($current_order,'random'); ?>><?php echo __('Random','tshowcase'); ?></option>
            </select>
          </p>
        <p>
          <label for="limit"><?php echo __('Number of entries to display','tshowcase'); ?>:</label>
          <?php $current_limit = isset($selectedv['limit']) ? $selectedv['limit'] : '0'; ?>
          <input size="3" id="limit" name="limit" type="text" value="<?php echo $current_limit; ?>" onChange="tshowcaseshortcodegenerate()" />
          <span class="howto"> <?php echo __('Leave blank or 0 to display all','tshowcase'); ?></span></p>
        
        
        </p>
        <?php

          $pagination = isset($selectedv['pagination']) ? 'checked' : '';

          ?>
        <p>
          <label for="pagination"><?php echo __('Pagination','tshowcase'); ?>:</label>
          <input name="pagination" type="checkbox" id="pagination" value="true" <?php echo $pagination; ?> onChange="tshowcaseshortcodegenerate()">
          <span class="howto"> <?php echo __('You should set a limit above for the pagination to work properly.','tshowcase'); ?></span>
          
        
        
        </p>
         <?php $idsfilter = isset($selectedv['idsfilter']) ? $selectedv['idsfilter'] : '0'; ?>
        <p>
          <label for="idsfilter"><?php echo __('IDs to display','tshowcase'); ?>:</label>
          <input size="10" id="idsfilter" name="idsfilter" type="text" value="<?php echo $idsfilter ?>" onChange="tshowcaseshortcodegenerate()" />
          <span class="howto"> <?php echo __('(Comma sperated ID values of specific entries you want to display. Example: 7,11. Leave blank or 0 to display all)','tshowcase'); ?></span></p>
        
        
        </p>

        <?php $exclude = isset($selectedv['exclude']) ? $selectedv['exclude'] : '0'; ?>
        <p>
          <label for="exclude"><?php echo __('IDs to exclude','tshowcase'); ?>:</label>
          <input size="10" id="exclude" name="exclude" type="text" value="<?php echo $exclude ?>" onChange="tshowcaseshortcodegenerate()" />
          <span class="howto"> <?php echo __('(Comma sperated ID values of specific entries you want to exclude. Example: 7,11. Leave blank or 0 to display all)','tshowcase'); ?></span></p>
        
        
        </p>
        
        
        <h2><?php echo __('What information do you want to display:','tshowcase'); ?></h2>
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td><input name="name" type="checkbox" id="name" onChange="tshowcaseshortcodegenerate()" value="name" <?php if($s_settings != '') { if(isset($selectedv['name'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="name"><?php echo $ts_labels['name']['label']; ?></label></td>
            <td><input name="photo" type="checkbox" id="photo" onChange="tshowcaseshortcodegenerate()" value="photo" <?php if($s_settings != '') { if(isset($selectedv['photo'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="photo"><?php echo $ts_labels['photo']['label']; ?></label></td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td><input name="smallicons" type="checkbox" id="smallicons" value="smallicons" onChange="tshowcaseshortcodegenerate()" <?php if($s_settings != '') { if(isset($selectedv['smallicons'])) { echo 'checked'; }} else { echo ''; }  ?>>
              <label for="smallicons"><?php echo $ts_labels['smallicons']['label']; ?></label>
              &nbsp;</td>
            <td colspan="2"><span class="howto"><?php echo __('Will display small icons before the information','tshowcase'); ?></span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td><input name="social" type="checkbox" id="social" onChange="tshowcaseshortcodegenerate()" value="social" <?php if($s_settings != '') { if(isset($selectedv['social'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="social"><?php echo $ts_labels['socialicons']['label']; ?></label></td>
            <td><label for="position">
              <input name="position" type="checkbox" id="position" onChange="tshowcaseshortcodegenerate()" value="position" <?php if($s_settings != '') { if(isset($selectedv['position'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <?php echo $ts_labels['position']['label']; ?></label></td>
            <td><label for="location">
              <input name="location" type="checkbox" id="location" value="location" onChange="tshowcaseshortcodegenerate()" <?php if($s_settings != '') { if(isset($selectedv['location'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <?php echo $ts_labels['location']['label']; ?> &nbsp;</label></td>
            </tr>
          <tr>
            <td><input name="email" type="checkbox" id="email" onChange="tshowcaseshortcodegenerate()" value="email" <?php if($s_settings != '') { if(isset($selectedv['email'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="email"><?php echo $ts_labels['email']['label']; ?></label>
              &nbsp;</td>
            <td> <input name="freehtml" type="checkbox" id="freehtml" value="freehtml" onChange="tshowcaseshortcodegenerate()" <?php if($s_settings != '') { if(isset($selectedv['freehtml'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="freehtml"><?php echo $ts_labels['html']['label']; ?></label>&nbsp;</td>
            <td><input name="telephone" type="checkbox" id="telephone" value="telephone" onChange="tshowcaseshortcodegenerate()" <?php if($s_settings != '') { if(isset($selectedv['telephone'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="telephone"><?php echo $ts_labels['telephone']['label']; ?> </label></td>
            </tr>
          <tr>
            <td><input name="website" type="checkbox" id="website" value="website" onChange="tshowcaseshortcodegenerate()" <?php if($s_settings != '') { if(isset($selectedv['website'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="website"><?php echo $ts_labels['website']['label']; ?></label></td>
            <td><input name="dgroups" type="checkbox" id="dgroups" value="groups" onChange="tshowcaseshortcodegenerate()" <?php if($s_settings != '') { if(isset($selectedv['dgroups'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="dgroups"><?php echo $categories; ?></label></td>
            <td>
              <?php if($tax2)  { ?>
              <input name="dgroups2" type="checkbox" id="dgroups2" value="groups2" onChange="tshowcaseshortcodegenerate()" <?php if($s_settings != '') { if(isset($selectedv['dgroups2'])) { echo 'checked'; }} else { echo 'checked'; }  ?>>
              <label for="dgroups"><?php echo $taxonomies; ?></label></td>
              <?php } else {
                ?>
                <input name="dgroups2" type="hidden" id="dgroups2" value="">

              <?php } ?> 
            </tr>
          </table>

          <?php
            $current_singleurl = isset($selectedv['singleurl']) ? $selectedv['singleurl'] : 'inactive';
            ?>
        
        <p>
          <label for="singleurl"><?php echo __('Entry Link:','tshowcase'); ?></label>
          <select id="singleurl" name="singleurl" onChange="tshowcaseshortcodegenerate()">
            <option value="inactive" <?php selected($current_singleurl,'inactive'); ?>><?php echo __('Inactive','tshowcase'); ?></option>
            <option value="active" <?php selected($current_singleurl,'active'); ?>><?php echo __('Active (Default)','tshowcase'); ?></option>
            <option value="active_new" <?php selected($current_singleurl,'active_new'); ?>><?php echo __('Active (Default - New Page):','tshowcase'); ?></option>
            <option value="active_custom" <?php selected($current_singleurl,'active_custom'); ?>><?php echo __('Active (Personal URL Field)','tshowcase'); ?></option>
            <option value="active_custom_new" <?php selected($current_singleurl,'active_custom_new'); ?>><?php echo __('Active (Personal URL Field - New Page)','tshowcase'); ?></option>
       <!--     <option value="custom" <?php selected($current_singleurl,'custom'); ?>><?php echo __('Personal URL (Defaults to Inactive)','tshowcase'); ?></option> -->
            <option value="active_user" <?php selected($current_singleurl,'active_user'); ?>><?php echo __('Active (User URL)','tshowcase'); ?></option>
            <option value="full_image" <?php selected($current_singleurl,'full_image'); ?>><?php echo __('Full Size Image','tshowcase'); ?></option>

            </select>
        </p>
        
        <h2><?php echo __('How do you want it to look like?','tshowcase'); ?></h2>

        <?php
            $current_preset = isset($selectedv['preset']) ? $selectedv['preset'] : 'content-below-simple-grid';
            ?>
        
        <div style="border:1px solid #ccc; background:#FFF; padding:10px;">
        <?php echo __('Load a layout preset:','tshowcase'); ?>
          <br>
          <select name="preset" id="preset" onChange="tshowcasepreset()">
          <option value="none" <?php selected($current_preset,'none'); ?>>None</option>
           <option value="polaroid" <?php selected($current_preset,'polaroid'); ?>>Polaroid Grid </option>
           <option value="white-polaroid" <?php selected($current_preset,'white-polaroid'); ?>>White Polaroid Grid </option>
           <option value="gray-card-grid" <?php selected($current_preset,'gray-card-grid'); ?>>Gray Card Grid </option>
           <option value="circle-grid" <?php selected($current_preset,'circle-grid'); ?>>Circle Centered Grid</option>
           <option value="content-right-simple-grid" <?php selected($current_preset,'content-right-simple-grid'); ?>>Simple Grid with content right</option>
           <option value="content-below-simple-grid" <?php selected($current_preset,'content-below-simple-grid'); ?>>Simple Grid with content below</option>
           <option value="hover-circle-white-grid" <?php selected($current_preset,'hover-circle-white-grid'); ?>>Circle Images With Info on Hover I</option>
           <option value="hover-circle-grid" <?php selected($current_preset,'hover-circle-grid'); ?>>Circle Images With Info on Hover II</option>
           <option value="hover-square-grid" <?php selected($current_preset,'hover-square-grid'); ?>>Squared Images With Info on Hover</option>
           <option value="simple-table" <?php selected($current_preset,'simple-table'); ?>>Simple Table Layout</option>
            <option value="simple-pager" <?php selected($current_preset,'simple-pager'); ?>>Simple Thumbnails Pager</option>
             <option value="circle-pager" <?php selected($current_preset,'circle-pager'); ?>>Circle Thumbnails Pager</option>
               <option value="gallery-pager" <?php selected($current_preset,'gallery-pager'); ?>>Gallery style Thumbnails Pager</option>
                 
        </select>
          <span class="howto"><?php echo __('Choosing a  preset will automaticaly select predefined values for the visuals.
        You can then adjust the options to your needs.','tshowcase'); ?></span></div>
        
         <?php
            $current_layout = isset($selectedv['layout']) ? $selectedv['layout'] : 'grid';
            ?>
        
        <p>
          <label for="layout"><?php echo __('Layout','tshowcase'); ?>:</label>
          <select id="layout" name="layout" onChange="tshowcaseshortcodegenerate()">
            <option value="grid" <?php selected($current_layout,'grid'); ?>><?php echo __('Grid','tshowcase'); ?></option>
            <option value="hover" <?php selected($current_layout,'hover'); ?>><?php echo __('Hover Grid','tshowcase'); ?></option>
            <option value="pager" <?php selected($current_layout,'pager'); ?>><?php echo __('Thumbnails Pager','tshowcase'); ?></option>
            <option value="table" <?php selected($current_layout,'table'); ?>><?php echo __('Table','tshowcase'); ?></option>
            </select>
          </p>
        
        <div id="columnsdiv">

          <?php
            $current_columns = isset($selectedv['columns']) ? $selectedv['columns'] : '2-columns';
            ?>
          
          <p>
            <label for="columns"><?php echo __('Columns','tshowcase'); ?>:</label>
            <select name="columns" id="columns" onChange="tshowcaseshortcodegenerate()">
              <option value="normal-float" <?php selected($current_columns,'normal-float'); ?>><?php echo __('Normal Float','tshowcase'); ?></option>
              <option value="1-column" <?php selected($current_columns,'1-column'); ?>><?php echo __('1 Column','tshowcase'); ?></option>
              <option value="2-columns"  <?php selected($current_columns,'2-columns'); ?>>2 <?php echo __('Columns','tshowcase'); ?></option>
              <option value="3-columns" <?php selected($current_columns,'3-columns'); ?>>3 <?php echo __('Columns','tshowcase'); ?></option>
              <option value="4-columns" <?php selected($current_columns,'4-columns'); ?>>4 <?php echo __('Columns','tshowcase'); ?></option>
              <option value="5-columns" <?php selected($current_columns,'5-columns'); ?>>5 <?php echo __('Columns','tshowcase'); ?></option>
              <option value="6-columns" <?php selected($current_columns,'6-columns'); ?>>6 <?php echo __('Columns','tshowcase'); ?></option>
              </select>
            </p>
          
          </div>          
        <div id="griddiv">

          <?php
            $current_filtergrid = isset($selectedv['filtergrid']) ? $selectedv['filtergrid'] : 'inactive';
            ?>
        
         <div style="border:1px solid #ccc; background:#FFF; padding:5px;">
          <label for="filtergrid"><?php echo $categories.' '.$ts_labels['filter']['label']; ?>:</label>
           <select name="filtergrid" id="filtergrid" onChange="tshowcaseshortcodegenerate()">
             
             <option value="inactive" <?php selected($current_filtergrid,'inactive'); ?>><?php echo __('Inactive','tshowcase'); ?></option>
             <option value="filter" <?php selected($current_filtergrid,'filter'); ?>><?php echo __('Active - Hide Filter','tshowcase'); ?></option>
             <option value="enhance-filter" <?php selected($current_filtergrid,'enhance-filter'); ?>><?php echo __('Active - Enhance Filter','tshowcase'); ?></option>
             <option value="isotope-filter" <?php selected($current_filtergrid,'isotope-filter'); ?>><?php echo __('Active - Isotope Hide Filter','tshowcase'); ?></option>

           </select>
           <span class="howto"><?php echo __('When active, a jQuery Category filter will display above the Grid.','tshowcase'); ?> </span>
          </div>
        
          <?php
            $current_gridstyling = isset($selectedv['grid-styling']) ? $selectedv['grid-styling'] : null;
            ?>

          <p>Theme: 
            <label for="grid-styling"></label>
            <select name="grid-styling" id="grid-styling" onChange="tshowcaseshortcodegenerate()">
              
              <?php 
		   foreach ($ts_theme_names['grid'] as $tbstyle) {
		   ?>
              
              <option value="<?php echo $tbstyle['key'] ?>" <?php selected($current_gridstyling,$tbstyle['key']); ?>><?php echo $tbstyle['label'] ?></option>
              
              <?php } ?>
              </select>
            </p>
          
          <?php
            $current_composition = isset($selectedv['composition']) ? $selectedv['composition'] : 'img-left';
            ?>
          
          <p>
            <label for="composition"><?php echo __('Composition','tshowcase'); ?>:</label>
            <select name="composition" id="composition" onChange="tshowcaseshortcodegenerate()">
              <option value="img-left" <?php selected($current_composition,'img-left'); ?>><?php echo __('Image Left - Content Right','tshowcase'); ?></option>
              <option value="img-right" <?php selected($current_composition,'img-right'); ?>><?php echo __('Content Right - Image Left','tshowcase'); ?></option>
              <option value="img-above" <?php selected($current_composition,'img-above'); ?>><?php echo __('Image Above - Content Below','tshowcase'); ?></option>
              </select>
            </p>
          </div>
        
        <div id="pagerdiv">
          
          <div style="border:1px solid #ccc; background:#FFF; padding:5px;">
          <label for="filterpager"><?php echo $categories.' '.$ts_labels['filter']['label']; ?>:</label>
           <select name="filterpager" id="filterpager" onChange="tshowcaseshortcodegenerate()">

            <?php
            $current_filterpager = isset($selectedv['filterpager']) ? $selectedv['filterpager'] : 'inactive';
            ?>
             
             <option value="inactive" <?php selected($current_filterpager,'inactive'); ?>><?php echo __('Inactive','tshowcase'); ?></option>
             <option value="filter" <?php selected($current_filterpager,'filter'); ?>><?php echo __('Active - Hide Filter','tshowcase'); ?></option>
             <option value="enhance-filter" <?php selected($current_filterpager,'enhance-filter'); ?>><?php echo __('Active - Enhance Filter','tshowcase'); ?></option>
             
           </select>
           <span class="howto"><?php echo __('When active, a jQuery Category filter will display above the Grid.','tshowcase'); ?>','tshowcase'); ?> </span>
          </div>
  
          <?php
            $current_pagerstyling = isset($selectedv['pager-styling']) ? $selectedv['pager-styling'] : null;
            ?>

          <p>Theme: 
            <label for="pager-styling"></label>
            <select name="pager-styling" id="pager-styling" onChange="tshowcaseshortcodegenerate()">
              
              <?php 
		   foreach ($ts_theme_names['pager'] as $tbstyle) {
		   ?>
              
              <option value="<?php echo $tbstyle['key'] ?>" <?php selected($current_pagerstyling,$tbstyle['key']); ?>><?php echo $tbstyle['label'] ?></option>
              
              <?php } ?>
              </select>
            </p>
          
          <p>
            <label for="pagercomposition"><?php echo __('General Composition','tshowcase'); ?>:</label>

             <?php
            $current_pagercomposition = isset($selectedv['pagercomposition']) ? $selectedv['pagercomposition'] : 'thumbs-left';
            ?>

            
            <select name="pagercomposition" id="pagercomposition" onChange="tshowcaseshortcodegenerate()">
              <option value="thumbs-left" <?php selected($current_pagercomposition,'thumbs-left'); ?>><?php echo __('Thumnails Left - Content Right','tshowcase'); ?></option>
              <option value="thumbs-right" <?php selected($current_pagercomposition,'thumbs-right'); ?>><?php echo __('Content Left - Thumbnails Right','tshowcase'); ?></option>
              <option value="thumbs-below" <?php selected($current_pagercomposition,'thumbs-below'); ?>><?php echo __('Content Above - Thumbnails Below','tshowcase'); ?></option>
              <option value="thumbs-above" <?php selected($current_pagercomposition,'thumbs-above'); ?>><?php echo __('Content Below - Thumbnails Above','tshowcase'); ?></option>
              </select>
            </p>

             <?php
            $current_pagerimgcomposition = isset($selectedv['pagerimgcomposition']) ? $selectedv['pagerimgcomposition'] : 'img-above';
            ?>
          <p>
            <label for="pagerimgcomposition"><?php echo __('Image Composition','tshowcase'); ?>:</label>
            <select name="pagerimgcomposition" id="pagerimgcomposition" onChange="tshowcaseshortcodegenerate()">
              <option value="img-left" <?php selected($current_pagerimgcomposition,'img-left'); ?>><?php echo __('Image Left - Content Right','tshowcase'); ?></option>
              <option value="img-right" <?php selected($current_pagerimgcomposition,'img-right'); ?>><?php echo __('Content Right - Image Left','tshowcase'); ?></option>
              <option value="img-above" <?php selected($current_pagerimgcomposition,'img-above'); ?>><?php echo __('Image Above - Content Below','tshowcase'); ?></option>
              </select>
            </p>
          </div>
        
        
        <div id="tablediv">
          <p><?php echo __('Theme','tshowcase'); ?>: 
            <label for="table-styling"></label>

            <?php
            $current_tablestyling = isset($selectedv['table-styling']) ? $selectedv['table-styling'] : null;
            ?>

            <select name="table-styling" id="table-styling" onChange="tshowcaseshortcodegenerate()">
              
              <?php 
		   foreach ($ts_theme_names['table'] as $tbstyle) {
		   ?>
              
              <option value="<?php echo $tbstyle['key'] ?>" <?php selected($current_tablestyling,$tbstyle['key']); ?>><?php echo $tbstyle['label'] ?></option>
              
              <?php } ?>
              </select>
            </p>
          </div>
        
        <div id="hoverdiv">
        
         <div style="border:1px solid #FFF; background:#FFF; padding:5px;">
          <label for="filter"><?php echo $categories.' '.$ts_labels['filter']['label']; ?>:</label>

          <?php
            $current_filterhover = isset($selectedv['filterhover']) ? $selectedv['filterhover'] : 'inactive';
            ?>

           <select name="filterhover" id="filterhover" onChange="tshowcaseshortcodegenerate()">
             <option value="filter" <?php selected($current_filterhover,'filter'); ?>><?php echo __('Active - Hide Effect','tshowcase'); ?></option>
             <option value="enhance-filter" <?php selected($current_filterhover,'enhance-filter'); ?>><?php echo __('Active - Enhance Effect','tshowcase'); ?></option>
             <option value="isotope-filter" <?php selected($current_filterhover,'isotope-filter'); ?>><?php echo __('Active - Isotope Hide Filter','tshowcase'); ?></option>
             <option value="inactive" <?php selected($current_filterhover,'inactive'); ?>><?php echo __('Inactive','tshowcase'); ?></option>

           </select>
           <span class="howto"><?php echo __('When active, a jQuery Category filter will display above the Grid.','tshowcase'); ?>  </span>
          </div>
        
          <p><?php echo __('Theme','tshowcase'); ?>:
            <label for="hover-styling"></label>
            <?php
            $current_hoverstyling = isset($selectedv['hover-styling']) ? $selectedv['hover-styling'] : null;
            ?>
            <select name="hover-styling" id="hover-styling" onChange="tshowcaseshortcodegenerate()">
              
              <?php 
		   foreach ($ts_theme_names['hover'] as $tbstyle) {
		   ?>
              
              <option value="<?php echo $tbstyle['key'] ?>" <?php selected($current_hoverstyling,$tbstyle['key']); ?>><?php echo $tbstyle['label'] ?></option>
              
              <?php } ?>
              </select>
            </p>
          
          
         
          
          </div>
        
        <div id="imgdiv">
          <?php
            $current_imgstyle = isset($selectedv['imgstyle']) ? $selectedv['imgstyle'] : null;
            ?>
          <p><?php echo __('Image Shape','tshowcase'); ?>:
            <select id="imgstyle" name="imgstyle" onChange="tshowcaseshortcodegenerate()">
              <option value="img-square" <?php selected($current_imgstyle,'img-square'); ?>><?php echo __('Square (normal)','tshowcase'); ?></option>
              <option value="img-rounded" <?php selected($current_imgstyle,'img-rounded'); ?>><?php echo __('Rounded Corners','tshowcase'); ?></option>
              <option value="img-circle" <?php selected($current_imgstyle,'img-circle'); ?>><?php echo __('Circular','tshowcase'); ?></option>
              
              </select>
            </p>
          <?php
            $current_imgeffect = isset($selectedv['imgeffect']) ? $selectedv['imgeffect'] : null;
            ?>
          <p><?php echo __('Image Effect','tshowcase'); ?>:
            <select id="imgeffect" name="imgeffect" onChange="tshowcaseshortcodegenerate()">
              <option value="" <?php selected($current_imgeffect,''); ?>>None</option>
              <option value="img-grayscale" <?php selected($current_imgeffect,'img-grayscale'); ?>><?php echo __('Grayscale','tshowcase'); ?></option>
              <option value="img-shadow" <?php selected($current_imgeffect,'img-shadow'); ?>><?php echo __('Shadow Highlight','tshowcase'); ?></option>
                <option value="img-white-border" <?php selected($current_imgeffect,'img-white-border'); ?>><?php echo __('White Border','tshowcase'); ?></option>
              <option value="img-grayscale-shadow" <?php selected($current_imgeffect,'img-grayscale-shadow'); ?>><?php echo __('Shadow Highlight & Grayscale','tshowcase'); ?></option>
              
              </select>
            </p>
          </div>
        <p>
            <?php
            $current_textalign = isset($selectedv['textalign']) ? $selectedv['textalign'] : 'text-left';
            ?>
          
          <label for="textalign"> <?php echo __('Text-Align','tshowcase'); ?>:</label>
          <select name="textalign" id="textalign" onChange="tshowcaseshortcodegenerate()">
            <option value="text-left" <?php selected($current_textalign,'text-left'); ?>><?php echo __('Left','tshowcase'); ?></option>
            <option value="text-right" <?php selected($current_textalign,'text-right'); ?>><?php echo __('Right','tshowcase'); ?></option>         
            <option value="text-center" <?php selected($current_textalign,'text-center'); ?>><?php echo __('Center','tshowcase'); ?></option>
            </select>
          </p>
        <div id="imgsize" style="border-top:1px dashed #CCC;">
          <p><?php echo __('Image Size Override','tshowcase'); ?>: 

            <?php
            $current_img = isset($selectedv['img']) ? $selectedv['img'] : '';
            ?>

            <label for="img"></label>
            <input type="text" name="img" id="img" onChange="tshowcaseshortcodegenerate()" value="<?php echo $current_img; ?>">
            <br>
            <span class="howto"><?php echo __("Leave blank to use default values.<br>
              In case you want to override the default image size settings, use this field to put the width and height values in the following format: width,height <br>
              ex. 100,100. <br>
            Width value will prevail if images don't have exactly this size.","tshowcase"); ?></span></p>
          </div>
        
        
        
        </form>
      </div>
      <div id="howto"><a href="http://cmoreira.net/team-showcase/" target="_blank"><?php echo __('Browse examples</a> or read more about the shortcode options at the <a href="http://cmoreira.net/team-showcase/documentation#shortcodes" target="_blank">online documentation of the plugin</a>.','tshowcase'); ?></div></td>
    <td width="80%" valign="top">

      <form>
        <?php 

        $s_settings = get_option( 'tshowcase_shortcode_settings', '' );
        //print_r($s_settings);

        ?>
        <a class="button-primary" onclick="tshowcase_save_shortcode_settings();"><?php echo __('Save Settings','tshowcase'); ?></a>
        <span class="tshowcase_message_area"></span>
        <span class="howto"><?php echo __('You can use the shortcode [show-team] without parameters to use the latest saved settings.','tshowcase'); ?></span>
      </form>

      <h3>Shortcode</h3>
      <span class="howto"><?php echo __('Use this shortcode to display the list of Members with the currently selected options. <br> 
      Just copy this piece of text and place it where you want it to display in your posts, pages or text widgets.','tshowcase'); ?></span>
      <div id="shortcode_div" style="padding:10px; background-color:#fff;border-left:4px solid #7ad03a;-webkit-box-shadow:0 1px 1px 0 rgba(0,0,0,.1);box-shadow:0 1px 1px 0 rgba(0,0,0,.1); margin-top:5px;">
      
      <textarea id="shortcode" style="width:100%; height:55px;"></textarea>

      </div>

      
    <h3>Preview</h3>
    
    <div id="preview-warning" style="padding:5px; margin:10px 0px 30px 0px; border-radius:2px; font-weight:bold; font-size:0.9em; border:1px solid #CCC; background-color:#F5f5f5;"><?php echo __("Attention!
      This is a preview only. The visuals might differ after applying the shortcode on your page due to extra styling rules that your Theme might have or the available space.","tshowcase"); ?> </div> 
    
    <div id="tshowcase_id_0" class='tspreview'>
  
    </div>
    <div style="clear:both; margin:20px 10px;">

    <h3><?php echo __('PHP Function','tshowcase'); ?></h3>
      <?php echo __('Use this PHP function to display the list of Members directly in your theme files!','tshowcase'); ?>
      <div id="phpcode_div" style="padding:10px; background-color:#fff;border-left:4px solid #7ad03a;-webkit-box-shadow:0 1px 1px 0 rgba(0,0,0,.1);box-shadow:0 1px 1px 0 rgba(0,0,0,.1)"> 
        <textarea id="phpcode" style="width:100%; height:55px;"></textarea>
      </div>
    


    <form style="margin-top:20px;">

        <a class="button-primary" onclick="tshowcase_save_shortcode_settings();"><?php echo __('Save Settings','tshowcase'); ?></a>
        <span class="tshowcase_message_area"></span>
        <span class="howto"><?php echo __('You can use the shortcode <strong>[show-team]</strong> without parameters to use the latest saved settings.','tshowcase'); ?></span>
      
        <input type="hidden" id="current_shortcode" value="" />

      </form>


    </div>
 
       


    </td>
  </tr>
</table>


<script type="text/javascript">

  jQuery(document).ready(function($){

    <?php
    if($s_settings=='') {
      echo 'tshowcasepreset();';
    } else {
      echo 'tshowcaseshortcodegenerate();';
    } ?>

  });
</script>

 
    
<?php } 

 add_action( 'wp_ajax_tshowcase_save_shortcode_data', 'tshowcase_save_shortcode_data');

 function tshowcase_save_shortcode_data() {

    if(isset($_POST['options'])) {
      update_option('tshowcase_shortcode_settings', $_POST['options'] );
      update_option('tshowcase_shortcode', $_POST['shortcode'] );
    }
    
 }


?>