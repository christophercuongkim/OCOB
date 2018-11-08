<?php 

/* =============================================================================
    Include the Option-Tree Google Fonts Plugin 
    ========================================================================== */

  global $ot_options;
  $ot_options = get_option( 'option_tree' );

    // default fonts used in this theme, even though there are no google fonts
    $default_theme_fonts = array(
    'arial' => 'Arial, Helvetica, sans-serif',
    'helvetica' => 'Helvetica, Arial, sans-serif',
    'georgia' => 'Georgia, "Times New Roman", Times, serif',
    'tahoma' => 'Tahoma, Geneva, sans-serif',
    'times' => '"Times New Roman", Times, serif',
    'trebuchet' => '"Trebuchet MS", Arial, Helvetica, sans-serif',
    'verdana' => 'Verdana, Geneva, sans-serif'
    );

    defined('OT_FONT_DEFAULTS') or define('OT_FONT_DEFAULTS', serialize($default_theme_fonts));
    defined('OT_FONT_API_KEY') or define('OT_FONT_API_KEY', 'AIzaSyAeA4ipDEoRqvJKQctOhYufUmXJFkQjviY'); // enter your own Google Font API key here
    defined('OT_FONT_CACHE_INTERVAL') or define('OT_FONT_CACHE_INTERVAL', 0); // Checking once a week for new Fonts. The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

  // get the OT-Google-Font plugin file
  include_once( get_template_directory().'/mythology-core/option-tree-google-fonts/ot-google-fonts.php' );

    /* NOTE that we have made some changes to the ot-google-fonts.php file. 
      For starters, we've editted the $path variable so that it works in mythology-core.
      Next, we've removed the nag-box that shows up for errors and success messages.
      Last - we've also filtered out the font-color picker from OptionTree (see filter below) to prevent fix issues.
    */

  // get the google font array - build in ot-google-fonts.php
  $google_font_array = ot_get_google_font(OT_FONT_API_KEY, OT_FONT_CACHE_INTERVAL);

  // Now apply the fonts to the font dropdowns in theme options with the build in OptionTree hook
  function ot_filter_recognized_font_families( $array, $field_id ) {

    global $google_font_array;

    // loop through the cached google font array if available and append to default fonts
    $font_array = array();
    if($google_font_array){
        foreach($google_font_array as $index => $value){
            $font_array[$index] = $value['family'];
        }
    }

    // put both arrays together
    $array = array_merge(unserialize(OT_FONT_DEFAULTS), $font_array);

    return $array;

  }
  add_filter( 'ot_recognized_font_families', 'ot_filter_recognized_font_families', 1, 2 );    

  // REMOVE FONT-COLOR FROM TYPOGRAPHY FIELDS (for OT GOOGLE FONTS).
  function filter_typography_headings( $array, $field_id ) {
    // COMMENT OUT LINES FOR FIELDS THAT YOU WANT TO REMOVE FROM VIEW
    $array = array(
    // 'font-color', 
    'font-family',
    //'font-size',
    'font-style',
    'font-variant',
    'font-weight',
    'letter-spacing',
    //'line-height',
    //'text-decoration',
    'text-transform'
    );  
    return $array;
  }
  add_filter( 'ot_recognized_typography_fields', 'filter_typography_headings', 10, 2 );

  ?>