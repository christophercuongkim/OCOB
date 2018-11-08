<?php 
/*
Plugin Name: WP Advanced Code Editor
Plugin URI: http://www.techlyzer.com/wp-advanced-code-editor
Description: Integrates the EasyArea advanced code editor to WordPress, complete with syntax hilighting, line numbering, and full screen editing! Not compatabile with the WYSIWYG editor. Turn it off!
Author: John Kolbert
Version: 1.0
Author URI: http://www.techlyzer.com/

Copyright Notice

Portions of this plugin file Copyright © 2008 by Techlyzer.com

Permission is hereby granted, free of charge, to any person obtaining a copy of 
this software and associated documentation files (the "Software"), to deal in 
the Software without restriction, including without limitation the rights to use, 
copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the 
Software, and to permit persons to whom the Software is furnished to do so, 
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all 
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION 
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

=========EditArea===========
The EditArea script was entirely written by Christophe Dolivet (http://www.cdolivet.net/editarea/) 
and released under the GNU Lesser General Public License. Its license can be found here: 
http://www.gnu.org/copyleft/lesser.html. Its license agreement remains entact.
============================

*/

// Pre-2.6 compatibility
if ( !defined('WP_CONTENT_URL') ) {
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
    }
if ( !defined('WP_CONTENT_DIR') ) {
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
    }
 
// Guess the location
$plugin_path = WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__));
$plugin_url = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__));


function code_editor_header(){
	global $plugin_url;
	$post   = 'post';
	$page = 'page';

	if ((strpos($_SERVER['REQUEST_URI'], $post)) || (strpos($_SERVER['REQUEST_URI'], $page))){
  		echo '<script language="javascript" type="text/javascript" src="'.$plugin_url.'/edit_area/edit_area_full.js"></script>
			<script language="javascript" type="text/javascript">
			editAreaLoader.init({
			id : "content"		// textarea id
			,syntax: "html"			// syntax to be uses for highgliting
			,start_highlight: true		// to display with highlight mode on start-up
			});
			</script>';
			}
}

add_action('admin_head', 'code_editor_header');
?>