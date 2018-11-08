var groupdocs_viewer_error_counter = 0;

(function ($) {
    $(function () {
        loadFileTree($);
    })
})(jQuery);


function loadFileTree($) {
    $('.aui-message').remove();
    groupdocs_keys_validation($);

    var private_key = $('#privateKey').val();
    var user_id = $('#userId').val();
    var parent = $("#groupdocsBrowser");
    var container = $("#groupdocsBrowserInner", parent);

    var opts = {
        script: 'tree_viewer/treeviewer.php?private_key=' + private_key + '&user_id=' + user_id,
        onTreeShow: function () {

        },
        onServerSuccess: function () {
            groupdocs_viewer_error_counter = 0;
            $("a", container).each(function () {
                var self = $(this);
                if (self.parent().hasClass("file")) {
                    document.getElementById('insert').disabled = false;
                    self.click(function (e) {
                        e.preventDefault();
                        if($("a", container).attr('style', 'border')){
                            $("a", container).removeAttr('style')
                        }
                        self.css( 'border', '3px solid red' );
                        var height = parseInt($('#height').val());
                        var width = parseInt($('#width').val());
                        var url = self.attr('rel');
                        jQuery("input[name='url']").val(url);
                        if (jQuery("input[name='download']").is(":checked") == true) {

                            var download = 'True';
                        } else {

                            var download = "False";
                        }

                        if (( jQuery('#quality').val() != 0 ) & ( jQuery('#quality').val() ) != null) {
                            var quality = jQuery('#quality').val();
                        }

                        if (jQuery("input[name='print']").is(":checked") == true) {
                            var print = "True";
                        } else {
                            var print = "False";
                        }

                        if (jQuery("input[name='use_pdf']").is(":checked") == true) {
                            var use_pdf = "True";
                        } else {
                            var use_pdf = "False";
                        }

                        if (jQuery("input[name='use_scrollbar']").is(":checked") == true) {
                            var use_scrollbar = "True";
                        } else {
                            var use_scrollbar = "False";
                        }
                        if (jQuery("input[name='fullscreen']").is(":checked") == true) {
                            var fullscreen = "True";
                        } else {
                            var fullscreen = "False";
                        }

                        var protocol = $("input[@name'protocol']:checked").val()
                        $('#shortcode').val('[grpdocsview file="' + self.attr('rel') + '" quality="' + quality + '" height="' + height + '" width="' + width + '" protocol="' + protocol + '" fullscreen="' + fullscreen + '" download="' + download + '" print="' + print + '" use_pdf="' + use_pdf + '" use_scrollbar="' + use_scrollbar + '"]');
                    })
                }
            });
        },
        onServerError: function (response) {
            groupdocs_viewer_error_counter += 1;
            if (groupdocs_viewer_error_counter < 3) {
                loadFileTree($);
            }
            else {
                show_server_error($);
            }
        }
    };
    container.fileTree(opts);
}

function show_server_error($) {
    var message = "Uh oh, looks like we are currently experiencing difficulties with our API, please be so kind as to drop an email to <a href='mailto:support@groupdocs.com'>support@groupdocs.com</a> to let them know, thanks or <a href='#' onclick='loadFileTree(jQuery);return false'>click here</a> to try again.";
    $('#groupdocsBrowserInner').append($("<div class='aui-message warning'>" + message + "</div>"));
}

function groupdocs_keys_validation($) {
    var private_key = $('#privateKey');
    var user_id = $('#userId');
    var error_massage = $('#groupdocs_keys_error');
    var errors = 0;

    error_massage.hide();
    private_key.removeClass('error');
    user_id.removeClass('error');

    if (private_key.val() == '') {
        private_key.addClass('error');
        errors += 1;
    }
    if (user_id.val() == '') {
        user_id.addClass('error');
        errors += 1;
    }

    if (errors != 0) {
        $('#groupdocs_keys_error').show();
    }
}
