<?php
if (floatval(phpversion()) < 5.3) {
    echo "Your PHP version is lower than 5.3 while this plugin require PHP 5.3 or higher. <br /> Please, update your PHP version first.";
    return;
}

// access wp functions externally
require_once('bootstrap.php');
//the check on exist tiny_mce_popup.js file
if (file_exists('../../../wp-includes/js/tinymce/tiny_mce_popup.js')){
 $tiny = '<script type="text/javascript" src="../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>';
}else{
 $tiny = '<script type="text/javascript" src="js/tiny_mce_popup.js"></script>';
}

ini_set('display_errors', '0');
error_reporting(E_ALL | E_STRICT);

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>GroupDocs Viewer Embedder</title>
        <script type="text/javascript" src="js/jquery-1.5.min.js"></script>
        <?php echo $tiny ?>
        <script type="text/javascript" src="js/grpdocs-dialog.js"></script>

        <script type="text/javascript" src="tree_viewer/lib/jquery_file_tree/jquery.file_tree.js"></script>
        <script type="text/javascript" src="tree_viewer/js/tree_viewer_page.js"></script>
        <link href="tree_viewer/lib/jquery_file_tree/jquery.file_tree.css" type="text/css" rel="stylesheet"/>

        <link href="css/grpdocs-dialog.css" type="text/css" rel="stylesheet"/>

    </head>
    <body>
    <form id='form' onsubmit="" method="post" action="" enctype="multipart/form-data">

        <table>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Client Id</strong><br/></td>
                <td valign="top"><input name="userId" type="text" class="opt dwl" id="userId" style="width:200px;"
                                        value="<?php echo get_option('viewer_userId'); ?>"/><br/>
                    <span id="uri-note"></span></td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>API Key</strong><br/></td>
                <td valign="top"><input name="privateKey" type="text" class="opt dwl" id="privateKey"
                                        style="width:200px;"
                                        value="<?php echo get_option('viewer_privateKey'); ?>"/><br/>
                    <span id="uri-note"></span></td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Height</strong></td>
                <td valign="top" style="width:200px;"><input name="height" type="text" class="opt dwl" id="height"
                                                             size="6" style="text-align:right" value="700"/>px
                </td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Width</strong></td>
                <td valign="top"><input name="width" type="text" class="opt dwl" id="width" size="6"
                                        style="text-align:right" value="600"/>px
                </td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Quality</strong></td>
                <td valign="top">
                    <select name='quality' id='quality'>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="70">70</option>
                        <option value="80">80</option>
                        <option value="90">90</option>
                        <option selected value="100">100</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Choose the protocol</strong></td>
                <td valign="top"><input type="radio" name="protocol" value="http" checked>http:// <input type="radio"
                                                                                                         name="protocol"
                                                                                                         value="https">https://
                </td>
            </tr>


        </table>
        <table>
            <tr>
                <td align="right"><strong>Allow Fullscreen: </strong><input type="checkbox" name="fullscreen" id="fullscreen"></td>
                <td align="right"><strong>Allow Download: </strong><input type="checkbox" name="download" id="download"></td>
                <td align="right"><strong style="margin-left: 20px">Allow print: </strong><input type="checkbox" name='print' id="print"></td>
            </tr>
            <tr>
                <td align="right"><strong style="margin-left: 20px">Text Selection: </strong><input type="checkbox" name="use_pdf" id="use_pdf"></td>
                <td align="right"><strong style="margin-left: 20px">Scrollbar: </strong><input type="checkbox" name="use_scrollbar" id="use_scrollbar"></td>
            </tr>
        </table>

        <div class="section">

            <ul class="tabs">
                <li class="current">Browse &amp; Embed</li>
                <li>Upload &amp; Embed</li>
                <li>Paste GUID</li>
            </ul>

            <div class="box visible">
                <strong>Select File</strong><br/>
	<span id="groupdocs_keys_error" style="display:none">WARNING: There is no user id and/or private key
		please enter them on GroupDocs Options page		
	</span>

                <div id="groupdocsBrowser">
                    <div id="groupdocsBrowserInner">
                    </div>
                </div>
            </div>

            <div class="box">
                <strong>Upload Document</strong><br/>
                <input name="file" type="file" class="opt dwl" id="file" style="width:200px;"/><br/>
                <span id="uri-note"></span>
            </div>

            <div class="box">

                <strong>Document Id (GUID)</strong><br/>
                <input name="url" type="text" class="opt dwl" id="url" style="width:200px;"/><br/>
                <span id="uri-note"></span>

            </div>
        </div>
        <!-- .section -->


        <fieldset>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td colspan="2">
                        <br/>
                        Shortcode Preview
                        <textarea name="shortcode" cols="72" rows="4" id="shortcode"></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
        <div class="mceActionPanel">
            <div style="float:left;margin-bottom:10px">
                <input type="button" id="insert" name="insert" value="Insert"
                       onclick="GrpdocsInsertDialog.insert();" <?php
                if (get_option("viewer_userId") == null) {
                    echo 'disabled';
                }
                ?>/>

            </div>

            <div style="float: right">
                <input type="button" id="cancel" name="cancel" value="Cancel" onclick="tinyMCEPopup.close();"/>
            </div>
        </div>
    </form>

    </body>
    </html>

<?php
if (!empty($_POST) && !empty($_FILES)) {

    $file = $_FILES['file'];
    $error_text = true; // Show text or number
    define("UPLOAD_ERR_EMPTY", 5);
    if ($file['size'] == 0 && $file['error'] == 0) {
        $file['error'] = 5;
    }
    $upload_errors = array(
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension.",
        UPLOAD_ERR_EMPTY => "File is empty." // add this to avoid an offset
    );
    // error: report what PHP says went wrong
    $err = ($error_text) ? $upload_errors[$file['error']] : $file['error'];
    if ($file['error'] !== 0) {
        echo "<div class='red'>" . $err . "</div>";
    } else {

        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/APIClient.php');
        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/StorageApi.php');
        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/GroupDocsRequestSigner.php');
        include_once(dirname(__FILE__) . '/tree_viewer/lib/groupdocs-php/FileStream.php');

        $uploads_dir = dirname(__FILE__);

        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = $_FILES["file"]["name"];
        $fs = FileStream::fromFile($tmp_name);


        $signer = new GroupDocsRequestSigner(strip_tags(trim($_POST['privateKey'])));
        $apiClient = new APIClient($signer);
        $api = new StorageApi($apiClient);

        $result = $api->Upload(strip_tags(trim($_POST['userId'])), $name, 'uploaded', null, null, $fs);

        if (!empty($_POST['download'])) {
            $download = 'True';
        } else {
            $download = 'False';
        };
        if (!empty($_POST['print'])) {
            $print = 'True';
        } else {
            $print = 'False';
        };
        if (!empty($_POST['use_pdf'])) {
            $use_pdf = 'True';
        } else {
            $use_pdf = 'False';
        };
        if (!empty($_POST['use_scrollbar'])) {
            $use_scrollbar = 'True';
        } else {
            $use_scrollbar = 'False';
        };
        if (!empty($_POST['fullscreen'])) {
            $fullscreen = 'True';
        } else {
            $fullscreen = 'False';
        };

        echo "<script>
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, '[grpdocsview file=\"" . @$result->result->guid . "\" quality=\"" .(int)strip_tags(trim($_POST['quality'])) . "\" height=\"" . (int)strip_tags(trim($_POST['height'])) . "\" width=\"" . (int)strip_tags(trim($_POST['width'])) . "\" protocol=\"" . $_POST['protocol'] . "\" fullscreen=\"" . $fullscreen . "\" download=\"" . $download . "\" print=\"" . $print . "\" use_pdf=\"" . $use_pdf . "\" use_scrollbar=\"" . $use_scrollbar . "\"]');
			tinyMCEPopup.close();</script>";
        die;
    }
}

