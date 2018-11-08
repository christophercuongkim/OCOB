(function() {
	tinymce.PluginManager.requireLangPack('grpdocs');
	tinymce.create('tinymce.plugins.GrpdocsPlugin', {
		init : function(ed,url) {
			ed.addCommand('mceGrpdocs', function() {
				ed.windowManager.open( {
					file : url + '/../grpdocs-dialog.php',
					width : 470 + parseInt(ed.getLang('grpdocs.delta_width',0)),
					height : 560 + parseInt(ed.getLang('grpdocs.delta_height',0)),
					inline : 1}, {
						plugin_url : url,
                        someArg : 'custom arg'
					}
				)}
			);
			ed.addButton('grpdocs', {
				title : 'GroupDocs Viewer Embedder',
				cmd : 'mceGrpdocs',
				image : url + '/../images/grpdocs-button.png'
			});
		},
		createControl : function(n,cm) {
			return null
		},
		getInfo : function() { 
			return { 
				longname : 'GroupDocs Viewer Embedder',
				author : 'Marketplace Team',
				authorurl : 'http://www.groupdocs.com',
				infourl : 'http://www.groupdocs.com',
				version : "1.4.0"}
		}
	});

	tinymce.PluginManager.add('grpdocs',tinymce.plugins.GrpdocsPlugin)
})();
