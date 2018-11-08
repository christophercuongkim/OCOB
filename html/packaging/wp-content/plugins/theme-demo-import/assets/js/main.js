jQuery( function ( $ ) {
	'use strict';

	$( '.js-tdi-import-data' ).on( 'click', function () {

		// Reset response div content.
		$( '.js-tdi-ajax-response' ).empty();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'TDI_import_demo_data' );
		data.append( 'security', tdi.ajax_nonce );
		data.append( 'selected', $( '#TDI__demo-import-files' ).val() );
		if ( $('#TDI__content-file-upload').length ) {
			data.append( 'content_file', $('#TDI__content-file-upload')[0].files[0] );
		}
		if ( $('#TDI__widget-file-upload').length ) {
			data.append( 'widget_file', $('#TDI__widget-file-upload')[0].files[0] );
		}
		if ( $('#TDI__customizer-file-upload').length ) {
			data.append( 'customizer_file', $('#TDI__customizer-file-upload')[0].files[0] );
		}

		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );

	});

	function ajaxCall( data ) {
		$.ajax({
			method:     'POST',
			url:        tdi.ajax_url,
			data:       data,
			contentType: false,
			processData: false,
			beforeSend: function() {
				$( '.js-tdi-ajax-loader' ).show();
			}
		})
		.done( function( response ) {

			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				ajaxCall( data );
			}
			else if ( 'undefined' !== typeof response.message ) {
				$( '.js-tdi-ajax-response' ).append( '<p>' + response.message + '</p>' );
				$( '.js-tdi-ajax-loader' ).hide();
			}
			else {
				$( '.js-tdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.js-tdi-ajax-loader' ).hide();
			}
		})
		.fail( function( error ) {
			$( '.js-tdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.js-tdi-ajax-loader' ).hide();
		});
	}

	// Switch preview images on select change event, but only if the img element .js-tdi-preview-image exists.
	// Also switch the import notice (if it exists).
	$( '#TDI__demo-import-files' ).on( 'change', function(){
		if ( $( '.js-tdi-preview-image' ).length ) {

			// Attempt to change the image, else display message for missing image.
			var currentFilePreviewImage = tdi.import_files[ this.value ]['import_preview_image_url'] || '';
			$( '.js-tdi-preview-image' ).prop( 'src', currentFilePreviewImage );
			$( '.js-tdi-preview-image-message' ).html( '' );

			if ( '' === currentFilePreviewImage ) {
				$( '.js-tdi-preview-image-message' ).html( tdi.texts.missing_preview_image );
			}
		}

		// Update import notice.
		var currentImportNotice = tdi.import_files[ this.value ]['import_notice'] || '';
		$( '.js-tdi-demo-import-notice' ).html( currentImportNotice );
	});

});
