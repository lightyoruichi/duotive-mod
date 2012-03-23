(function() {
    tinymce.create('tinymce.plugins.video', {
        init : function(ed, url) {
            ed.addButton('video', {
                title : 'Add video',
                image : url+'/video-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/video-window.php',
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
    tinymce.PluginManager.add('video', tinymce.plugins.video);
})();