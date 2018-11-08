<?php

function bnw_init() 
{

	add_option('bnw_feed', 'http://zacklive.com/feed/');

}

function bnw_add_theme_page()
{
// if variables are empty we call the function bnw_init to set the default values
	if (get_option('bnw_feed') == '')
	{
		bnw_init();
	}
	
	if ($_GET['page'] == basename(__FILE__))
	{
		//if the form was submited we saved the changes
		if ('save' == $_REQUEST['action'])
		{
			if (isset($_REQUEST['bnw_feed']))
			{
				update_option('bnw_feed', $_REQUEST['bnw_feed']);
			}
			else
			{
				update_option('bnw_feed', 'Fill this field please');
			}
			header("Location: themes.php?page=functions.php&saved=true");
			die;
		}
	}
	
	// Addd the header (css + script) to the control panel
	add_action('admin_head', 'bnw_theme_page_head');
	
	//add_menu_page(page_title, menu_title, access_level/capability, file, [function]);
	add_theme_page('BlacknWhite Options', 'BlacknWhite Options', 'edit_themes', basename(__FILE__), 'bnw_theme_page');

}

function bnw_theme_page()
{
	if ( $_REQUEST['saved'] )
	{
		echo '<div id=¡±message¡± class=¡±updated fade¡±><p><strong>Options Saved</strong></p></div>';
	}
?>

	<div class="wrap">
		<div id="bnw">
			<h2>BlacknWhite Theme Options</h2>
			<form name="bnw" method="post" action="<?php $_SERVER['REQUST_URI']; ?>" >
				<input type="hidden" name"action" value="save" />
				<table class="optiontable">
					<tbody>
					<tr>
					<th>RSS Feed:</th>
					<td><input name="bnw_feed" id="bnw_feed" type="text" class="code" value="<?php echo get_option('bnw_feed'); ?>" />
					</td>
					</tr>
					</tbody>
				</table>
				<p class="submit"><input type="submit" name="Save" value="Apply" /></p>
			</form>
		</div>
	</div>

<?php
}

function bnw_theme_page_head()
{
?>
	<style type="text/css">
		p {margin-left:4px;}
		#bnw {margin: 5px; padding:10px;}
	</style>
<?php
}

if ( function_exists('register_sidebar') )
    register_sidebar();
?>