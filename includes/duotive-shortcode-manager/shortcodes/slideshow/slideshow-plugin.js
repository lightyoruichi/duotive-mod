(function() {
    tinymce.create('tinymce.plugins.slideshow', {
        init : function(ed, url) {
            ed.addButton('slideshow', {
                title : 'Add a slideshow',
                image : url+'/slideshow-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/slideshow-window.php',
						width : 510,
						height : 310,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('slideshow', tinymce.plugins.slideshow);
})();