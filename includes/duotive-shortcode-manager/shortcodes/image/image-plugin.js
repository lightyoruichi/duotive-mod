(function() {
    tinymce.create('tinymce.plugins.image', {
        init : function(ed, url) {
            ed.addButton('image', {
                title : 'Add image',
                image : url+'/image-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/image-window.php',
						width : 800,
						height : 430,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('image', tinymce.plugins.image);
})();