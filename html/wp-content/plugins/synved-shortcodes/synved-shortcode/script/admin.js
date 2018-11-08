// Copyright (c) 2011 Synved Ltd.
// All rights reserved
jQuery.noConflict();

if (jQuery(document).insertAtCaret == undefined)
{
	jQuery.fn.extend({
		insertAtCaret: function(myValue){
			return this.each(function(i) {
				if (document.selection) {
				  //For browsers like Internet Explorer
				  this.focus();
				  sel = document.selection.createRange();
				  sel.text = myValue;
				  this.focus();
				}
				else if (this.selectionStart || this.selectionStart == '0') {
				  //For browsers like Firefox and Webkit based
				  var startPos = this.selectionStart;
				  var endPos = this.selectionEnd;
				  var scrollTop = this.scrollTop;
				  this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
				  this.focus();
				  this.selectionStart = startPos + myValue.length;
				  this.selectionEnd = startPos + myValue.length;
				  this.scrollTop = scrollTop;
				} else {
				  this.value += myValue;
				  this.focus();
				}
			})
		}
	});
}

var SynvedShortcode = {
	
	doingRequest : false,
	oldShortcode : null,
	oldPreset : null,
	previewTimer : null,
	
	reset: function ()
	{
		this.oldShortcode = null;
		this.oldPreset = null;
		this.previewTimer = null;
	},
	
	_log: function (obj)
	{
		if (typeof(console) !== undefined && typeof(console.log) !== undefined)
		{
			console.log(obj);
		}
	},
	
	performRequest: function (action, params) 
	{
		if (this.doingRequest)
			return;
			
		this.doingRequest = true;
		
		if (params == undefined || params == null) 
		{
			params = {}
		}
		
		var jqXHR = jQuery.ajax(
			SynvedShortcodeVars.ajaxurl,
			{
				type : 'POST',
				data : {
					action : 'synved_shortcode',
					synvedSecurity : SynvedShortcodeVars.synvedSecurity,
					synvedAction : action,
					synvedParams : params,
					synvedPost : SynvedShortcodeVars.currentPost
				},
				success : function( response ) {
					SynvedShortcode.actionStarted(action, params, response, this);
					SynvedShortcode.doingRequest = false;
				},
				error : function( jqXHR, textStatus, errorThrown ) {
					SynvedShortcode.actionFailed(action, params, errorThrown, this);
					SynvedShortcode.doingRequest = false;
				}
			}
		);
		
		return jqXHR;
	},
	
	actionStarted: function (action, params, response, request) 
	{
		if (action == 'load-ui')
		{
			this.reset();
			
			tb_show('WordPress Shortcodes by Synved', '#TB_inline');
			var tb = jQuery("#TB_window");

			if (tb)
			{
				var tbCont = tb.find('#TB_ajaxContent');
				
				tb.css('min-width', '780px');
				//tbCont.css({ width : tbCont.parent().width(), height : '100%' });
				tbCont.css({ height : '100%' });
				tbCont.innerWidth(tbCont.parent().width());
				
				if (response == null || response == '-1' || response.length < 4)
				{
					response = '<div style="font-size:12pt;font-weight:bold;margin:10px;">Session expired, please reload the page.</div>';
				}
				
				tbCont.html(response);
				
				tbCont.find('[name=synved_shortcode_list]').chosen().change(function (e) {
					SynvedShortcode.updatePreview();
				});
				
				tbCont.find('[name=synved_preset_list]').chosen().change(function (e) {
					SynvedShortcode.updatePreview();
				});
				
				tbCont.find('[name=synved_shortcode_code]').keyup(function (e) {
					SynvedShortcode.updatePreview();
				});
				
				tbCont.find('.synved-shortcode-edit-actions .action-confirm').click(function (e) {
					e.preventDefault();
					
					var code = tb.find('[name=synved_shortcode_code]');
					
					if (tinyMCE.activeEditor != null && tinyMCE.activeEditor.selection.getSel() != null)
					{
						tinyMCE.activeEditor.selection.setContent(code.val());
					}
					else
					{
						jQuery('#content').insertAtCaret(code.val());
					}
					
					tb_remove();
					
					return false;
				});
				
				this.updatePreview(true);
			}
		}
		else if (action == 'preview-code')
		{
			var tb = jQuery("#TB_window");
			var preview = tb.find('.synved-shortcode-edit-ui-viewer .ui-preview');
			
			preview.html(response);
			
			tb.find('.synved-shortcode-edit-ui-viewer .preview-loader').css('visibility', 'hidden');
			
			synved_shortcode_apply_all(preview);
		}
	},
	
	actionFailed: function (action, params, error, request) 
	{
		if (action == 'preview-code')
		{
			var tb = jQuery("#TB_window");
			var preview = tb.find('.synved-shortcode-edit-ui-viewer .ui-preview');
			
			preview.html('');
			
			tb.find('.synved-shortcode-edit-ui-viewer .preview-loader').css('visibility', 'hidden');
		}
	},
	
	updatePreview: function (isInit)
	{
		var tb = jQuery('#TB_window');
		var select = tb.find('[name=synved_shortcode_list]');
		var presets = tb.find('[name=synved_preset_list]');
		var code = tb.find('[name=synved_shortcode_code]');
		var current = select.val();
		var currentCode = code.val();
		var currentPreset = presets.val();
		
		this._log(this.oldShortcode);
		this._log(current);
		this._log(this.oldPreset);
		this._log(currentPreset);
		
		if (this.oldShortcode == current && this.oldPreset == currentPreset)
		{
			var presetsContents = presets.find('option');
			var presetDefault = presetsContents.filter('[value="default"]');
			var presetMatch = null;
			
			if (presetDefault.size() > 0 && presetDefault.attr('data-content') == currentCode)
			{
				presetMatch = presetDefault.val();
			}
			else
			{
				presetsContents.each(function () {
					var jt = jQuery(this);
				
					if (jt.attr('data-content') == currentCode)
						presetMatch = jt.val();
				});
			}
			
			this._log(presetMatch);
			
			if (presetMatch == null)
			{
				presetMatch = 'custom';
			}
			
			if (presetMatch == 'custom')
			{
				presets.find('option[value="' + presetMatch + '"]').attr('data-content', currentCode);
				presets.trigger('liszt:updated');
			}
			
			if (presetMatch != currentPreset)
			{
				this.oldPreset = currentPreset = presetMatch;
				
				presets.val(presetMatch);
				presets.trigger('liszt:updated');
			}
		}
		
		if (this.oldShortcode != current)
		{
			var oldElem = tb.find('[name=shortcode_preset\\[' + this.oldShortcode + '\\]]');
			var elem = tb.find('[name=shortcode_preset\\[' + current + '\\]]');
			
			oldElem.empty().append(presets.children().clone());
			presets.empty().append(elem.children().clone()).trigger('liszt:updated');
			
			this.oldPreset = null;
			currentPreset = presets.val();
			
			var helpItem = tb.find('.synved-shortcode-help #synved-shortcode-help-item-' + current);
			tb.find('.ui-help-wrap .ui-help').html(helpItem.clone());
		}
		
		if (this.oldPreset != currentPreset)
		{
			var presetElem = presets.find('option[value="' + currentPreset + '"]');
			var presetContent = presetElem.attr('data-content');
			code.val(presetContent);
		}
	
		this.oldShortcode = current;
		this.oldPreset = currentPreset;
		
		var elems = tb.find('form').serializeArray();
		var items = {};
		
		for (elem in elems)
		{
			items[elem.name] = elem.value;
		}
		
		if (this.previewTimer != null)
		{
			clearTimeout(this.previewTimer);
			
			this.previewTimer = null;
		}
		
		if (!isInit)
		{
			tb.find('.synved-shortcode-edit-ui-viewer .preview-loader').css('visibility', 'visible');
		}
		
		var obj = this;
		
		this.previewTimer = setTimeout(function () {
			obj.performRequest('preview-code', { 'code' : code.val(), 'items' : items }); 
		}, 250);
	}
};

jQuery(document).ready(function() 
{
	if (typeof(QTags) != undefined)
	{
  	//QTags.addButton('synved_shortcode', 'shortcode', function () { SynvedShortcode.performRequest('load-ui') });
	}
  
  var btn = jQuery('<a href="#">Shortcode</a>').append(jQuery('<img />').attr('src', SynvedShortcodeVars.mainUri + '/image/plugin_button.png')).attr('title', 'Insert a custom WordPress shortcode by Synved').click(function (e) {
  	e.preventDefault();
  	
  	SynvedShortcode.performRequest('load-ui');
  	
  	return false;
  });
  jQuery('#wp-content-media-buttons').append(btn);
});

