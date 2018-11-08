<?php
/**
 * @package Techotronic
 * @subpackage jQuery TinyTips
 *
 * @since 1.0
 * @author Arne Franken
 *
 * HTML for settings page
 */
?>
<script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function($) {
        //only one of the checkboxes is allowed to be selected.
        $("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytips]']").click(function() {
            if ($("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytips]']").is(':checked')) {
                $("#jquery-tinytips-autoTinytipsGalleries").attr("checked", false);
            }
        });
        $("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytipsGalleries]']").click(function() {
            if ($("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytipsGalleries]']").is(':checked')) {
                $("#jquery-tinytips-autoTinytips").attr("checked", false);
            }
        });

        //deactivate warning if auto Colorbox is activated
        $("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytips]']").click(function() {
            if ($("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytips]']").is(':checked')) {
                $("#jquery-tinytips-tinytipsWarningOff").attr("checked", true);
            }
        });

        //activate warning if auto Colorbox is deactivated
        $("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytips]']").click(function() {
            if (!$("input[name='<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytips]']").is(':checked')) {
                $("#jquery-tinytips-tinytipsWarningOff").attr("checked", false);
            }
        });

        //change screenshot if new theme is selected
        $("#jquery-tinytips-theme").change(function() {
            var src = $("option:selected", this).val();
            if ( src != "" ){
                var $imgTag = "<img src=\"" + "<?php echo JQUERYTINYTIPS_PLUGIN_URL; echo '/screenshot-' ; ?>" + src  + ".jpg\" />";
                $("#jquery-tinytips-theme_screenshot_image").empty().html($imgTag).fadeIn();
            }
        });
    });
    //]]>
</script>

<div class="wrap">
    <div>
    <?php screen_icon(); ?>
    <h2><?php printf(__('%1$s Settings', JQUERYTINYTIPS_TEXTDOMAIN), JQUERYTINYTIPS_NAME); ?></h2>
    <br class="clear"/>

    <?php settings_fields(JQUERYTINYTIPS_SETTINGSNAME); ?>

    <div class="postbox-container" style="width: 69%;">
    <form name="jquery-tinytips-settings-update" method="post" action="admin-post.php">
    <?php if (function_exists('wp_nonce_field') === true) wp_nonce_field('jquery-tinytips-settings-form'); ?>
    <div id="poststuff">
        <div id="jquery-tinytips-settings" class="postbox">
            <!--h3 id="tinytips-settings"><?php __('Settings', JQUERYTINYTIPS_TEXTDOMAIN); ?></h3-->
            <h3 id="tinytips-settings"><?php _e('Plugin settings', JQUERYTINYTIPS_TEXTDOMAIN); ?></h3>

            <div class="inside">

                <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="jquery-tinytips-autoTinytips"><?php printf(__('Automate %1$s for all links in pages, posts and galleries', JQUERYTINYTIPS_TEXTDOMAIN), JQUERYTINYTIPS_NAME); ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytips]" id="jquery-tinytips-autoTinytips" value="true" <?php echo ($this->tinytipsSettings['autoTinytips']) ? 'checked="checked"' : '';?>/>
                        <br/><?php _e('Automatically add tinytips-class to links in posts and pages. Also adds tinytips-class to links to images in galleries.', JQUERYTINYTIPS_TEXTDOMAIN); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="jquery-tinytips-autoTinytipsGalleries"><?php printf(__('Automate %1$s for links to images in WordPress galleries', JQUERYTINYTIPS_TEXTDOMAIN), JQUERYTINYTIPS_NAME); __('Automate %1$s for images in WordPress galleries only', JQUERYTINYTIPS_TEXTDOMAIN) ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[autoTinytipsGalleries]" id="jquery-tinytips-autoTinytipsGalleries" value="true" <?php echo ($this->tinytipsSettings['autoTinytipsGalleries']) ? 'checked="checked"' : '';?>/>
                        <br/><?php _e('Automatically add tinytips-class to links to images in WordPress galleries, but nowhere else.', JQUERYTINYTIPS_TEXTDOMAIN); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="jquery-tinytips-javascriptInFooter"><?php _e('Add JavaScript to footer', JQUERYTINYTIPS_TEXTDOMAIN); ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[javascriptInFooter]" id="jquery-tinytips-javascriptInFooter" value="true" <?php echo ($this->tinytipsSettings['javascriptInFooter']) ? 'checked="checked"' : '';?>/>
                        <br/><?php _e('Add JavaScript to footer instead of the header.', JQUERYTINYTIPS_TEXTDOMAIN); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="jquery-tinytips-removeLinkFromMetaBox"><?php _e('Remove link from Meta-box', JQUERYTINYTIPS_TEXTDOMAIN); ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[removeLinkFromMetaBox]" id="jquery-tinytips-removeLinkFromMetaBox" value="true" <?php echo ($this->tinytipsSettings['removeLinkFromMetaBox']) ? 'checked="checked"' : '';?>/>
                        <br/><?php _e('Remove the link to the developers site from the WordPress meta-box.', JQUERYTINYTIPS_TEXTDOMAIN); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="jquery-tinytips-debugMode"><?php _e('Activate debug mode', JQUERYTINYTIPS_TEXTDOMAIN); ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[debugMode]" id="jquery-tinytips-debugMode" value="true" <?php echo ($this->tinytipsSettings['debugMode']) ? 'checked="checked"' : '';?>/>
                        <br/><?php _e('Adds debug information and non-minified JavaScript to the page. Useful for troubleshooting.', JQUERYTINYTIPS_TEXTDOMAIN); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="jquery-tinytips-tinytipsWarningOff"><?php printf(__('Disable warning', JQUERYTINYTIPS_TEXTDOMAIN), JQUERYTINYTIPS_NAME); ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[tinytipsWarningOff]" id="jquery-tinytips-tinytipsWarningOff" value="true" <?php echo ($this->tinytipsSettings['tinytipsWarningOff']) ? 'checked="checked"' : '';?>/>
                        <br/><?php _e('Disables the warning that is displayed if the plugin is activated but the auto-tinytips feature for all links is turned off.', JQUERYTINYTIPS_TEXTDOMAIN); ?>
                    </td>
                </tr>
                </table>
                <p class="submit">
                    <input type="hidden" name="action" value="jQueryTinytipsUpdateSettings"/>
                    <input type="submit" name="jQueryTinytipsUpdateSettings" class="button-primary" value="<?php _e('Save Changes') ?>"/>
                </p>
            </div>
        </div>
        <div id="jquery-tinytips-plugin-settings" class="postbox">
            <h3 id="plugin-settings"><?php _e('Tinytips settings', JQUERYTINYTIPS_TEXTDOMAIN); ?></h3>

            <div class="inside">

                <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="jquery-tinytips-theme"><?php _e('Theme', JQUERYTINYTIPS_TEXTDOMAIN); ?></label>
                    </th>
                    <td>
                        <select name="<?php echo JQUERYTINYTIPS_SETTINGSNAME ?>[tinytipsTheme]" id="jquery-tinytips-theme" class="postform" style="margin:0">
                        <?php
                            foreach ($this->tinytipsThemes as $theme => $name) {
                                echo '<option value="' . esc_attr($theme) . '"';
                                selected($this->tinytipsSettings['tinytipsTheme'], $theme);
                                echo '>' . htmlspecialchars($name) . "</option>\n";
                            }
                        ?>
                        </select>
                        <br/><?php _e('Select the theme you want to use on your blog.', JQUERYTINYTIPS_TEXTDOMAIN); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="jquery-tinytips-theme_screenshot_image"><?php _e('Theme screenshot', JQUERYTINYTIPS_TEXTDOMAIN); ?>:</label>
                    </th>
                    <td height="185px">
                        <div id="jquery-tinytips-theme_screenshot_image">
                            <img src="<?php echo JQUERYTINYTIPS_PLUGIN_URL; echo '/screenshot-' . $this->tinytipsSettings['tinytipsTheme']; ?>.jpg"/>
                        </div>
                    </td>
                </tr>
                </table>
                <p class="submit">
                    <input type="hidden" name="action" value="jQueryTinytipsUpdateSettings"/>
                    <input type="submit" name="jQueryTinytipsUpdateSettings" class="button-primary" value="<?php _e('Save Changes') ?>"/>
                </p>

            </div>
        </div>
    </div>
    </form>

    <div id="poststuff">
        <div id="jquery-tinytips-delete_settings" class="postbox">
            <h3 id="delete_options"><?php _e('Delete Settings', JQUERYTINYTIPS_TEXTDOMAIN) ?></h3>

            <div class="inside">
                <p><?php _e('Check the box and click this button to delete settings of this plugin.', JQUERYTINYTIPS_TEXTDOMAIN); ?></p>

                <form name="delete_settings" method="post" action="admin-post.php">
                <?php if (function_exists('wp_nonce_field') === true) wp_nonce_field('jquery-delete_settings-form'); ?>
                    <p id="submitbutton">
                    <input type="hidden" name="action" value="jQueryTinytipsDeleteSettings"/>
                    <input type="submit" name="jQueryTinytipsDeleteSettings" value="<?php _e('Delete Settings', JQUERYTINYTIPS_TEXTDOMAIN); ?> &raquo;" class="button-secondary"/>
                    <input type="checkbox" name="delete_settings-true"/>
                </p>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="postbox-container" style="width: 29%;">
    <div id="poststuff">
        <div id="jquery-tinytips-topdonations" class="postbox">
            <h3 id="topdonations"><?php _e('Top donations', JQUERYTINYTIPS_TEXTDOMAIN) ?></h3>

            <div class="inside">
                <?php echo $this->getRemoteContent(JQUERYTINYTIPS_TOPDONATEURL); ?>
            </div>
        </div>
    </div>
    <div id="poststuff">
        <div id="jquery-tinytips-latestdonations" class="postbox">
            <h3 id="latestdonations"><?php _e('Latest donations', JQUERYTINYTIPS_TEXTDOMAIN) ?></h3>

            <div class="inside">
                <?php echo $this->getRemoteContent(JQUERYTINYTIPS_LATESTDONATEURL); ?>
            </div>
        </div>
    </div>
    <div id="poststuff">
        <div id="jquery-tinytips-donate" class="postbox">
            <h3 id="donate"><?php _e('Donate', JQUERYTINYTIPS_TEXTDOMAIN) ?></h3>

            <div class="inside">
                <p>
                    <?php _e('If you would like to make a small (or large) contribution towards future development please consider making a donation.', JQUERYTINYTIPS_TEXTDOMAIN) ?>
                </p>
<!--                <h5 id="donatePaypal">--><?php __('Donate using Paypal', JQUERYTINYTIPS_TEXTDOMAIN) ?><!--</h5>-->
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="business" value="G75G3Z6PQWXXQ" />
                    <input type="hidden" name="item_name" value="<?php _e('Techotronic Development Support' , JQUERYTINYTIPS_TEXTDOMAIN); ?>" />
                    <input type="hidden" name="item_number" value="jQuery Colorbox"/>
                    <input type="hidden" name="no_shipping" value="0"/>
                    <input type="hidden" name="no_note" value="0"/>
                    <input type="hidden" name="cn" value="<?php _e("Please enter the URL you'd like me to link to in the donors lists", JQUERYTINYTIPS_TEXTDOMAIN); ?>." />
                    <input type="hidden" name="return" value="<?php $this->getReturnLocation(); ?>" />
                    <input type="hidden" name="cbt" value="<?php _e('Return to Your Dashboard' , JQUERYTINYTIPS_TEXTDOMAIN); ?>" />
                    <input type="hidden" name="currency_code" value="USD"/>
                    <input type="hidden" name="lc" value="US"/>
                    <input type="hidden" name="bn" value="PP-DonationsBF"/>
                    <label for="preset-amounts"><?php _e('Select Preset Amount', JQUERYTINYTIPS_TEXTDOMAIN); echo ": "; ?></label>
                    <select name="amount" id="preset-amounts">
                        <option value="10">10</option>
                        <option value="20" selected>20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select><span><?php _e('USD',JQUERYTINYTIPS_TEXTDOMAIN) ?></span>
                    <br /><br /><?php _e('Or', JQUERYTINYTIPS_TEXTDOMAIN); ?><br /><br />
                    <label for="custom-amounts"><?php _e('Enter Custom Amount', JQUERYTINYTIPS_TEXTDOMAIN); echo ": "; ?></label>
                    <input type="text" name="amount" size="4" id="custom-amounts"/>
                    <span><?php _e('USD',JQUERYTINYTIPS_TEXTDOMAIN) ?></span>
                    <br /><br />
                    <input type="submit" value="<?php _e('Submit',JQUERYTINYTIPS_TEXTDOMAIN) ?>" class="button-secondary"/>
                </form>
            </div>
        </div>
    </div>
    <div id="poststuff">
        <div id="jquery-tinytips-translation" class="postbox">
            <h3 id="translation"><?php _e('Translation', JQUERYTINYTIPS_TEXTDOMAIN) ?></h3>

            <div class="inside">
                <p><?php _e('The english translation was done by <a href="http://www.techotronic.de">Arne Franken</a>.', JQUERYTINYTIPS_TEXTDOMAIN); ?></p>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="clear">
        <p>
            <br/>&copy; Copyright 2010 - <?php echo date("Y"); ?> <a href="http://www.techotronic.de">Arne Franken</a>
        </p>
    </div>
</div>