
(function() {
  tinymce.create('tinymce.plugins.SynvedShortcode', {
    init : function(ed, url) {
      ed.addButton('synved_shortcode', {
        title : 'Insert a custom WordPress shortcode by Synved',
        image : url+'/tinymce_plugin.png',
        onclick : function() {
        	SynvedShortcode.performRequest('load-ui');
        	
		  		return false;
        }
      });
    },
    createControl : function(n, cm) {
      return null;
    },
    getInfo : function() {
      return {
        longname : 'Synved Shortcode',
        author : 'Synved',
        authorurl : 'http://synved.com/',
        infourl : 'http://synved.com/wordpress-shortcodes/',
        version : '1.0'
      };
    }
  });
  tinymce.PluginManager.add('synved_shortcode', tinymce.plugins.SynvedShortcode);
})();

