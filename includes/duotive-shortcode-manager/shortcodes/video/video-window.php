<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Duotive Shortcodes</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php
		//GET THE CURRENT WORDPRESS INSTALL LOCATION
        $url_with_file = $_SERVER['HTTP_REFERER'];
        $file_pos = strpos($url_with_file,"/wp-admin");
        $url = substr($url_with_file, 0,$file_pos);
    ?>    
    <!-- GET THE NECESARY JAVASCRIPT AND CSS -->
    <link rel="stylesheet" type="text/css" href="../../duotive_shortcode_style.css" />
	<script language="javascript" type="text/javascript" src="<?php echo $url; ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $url; ?>/wp-includes/js/jquery/jquery.js?ver=1.4.2"></script>
	<script language="javascript" type="text/javascript">
	function insertShortcode() {
		var video_type = document.getElementById('video_type').value;
		var video_source = document.getElementById('video_source').value;		
		var video_url = document.getElementById('video_url').value;
		var video_width = document.getElementById('video_width').value;
		var video_height = document.getElementById('video_height').value;
		
		var shortcode_content = '';			
		switch(video_type)
		{
			case 'embed':
				shortcode_content = ' [embed width="'+video_width+'" height="'+video_height+'"]'+video_url+'[/embed] ';
			break;
			case 'self-hosted':
				shortcode_content = ' [duotive-video host="'+video_source+'" source="'+video_url+'" width="'+video_width+'" height="'+video_height+'"] ';
			break;			
		}
		
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcode_content);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
</head>
<body>
	<form action="#">  
        <h3 class="page-title">Insert video with frame</h3>
		<div id="shorcode-manager">              
            <div class="table-row table-row-alternative">
                <label>Video type:</label>        
                <select type="text" id="video_type">
                	<option value="embed">Embeded video</option>           
                    <option value="self-hosted">With dedicated player</option>
                </select>
            </div> 
            <div class="table-row table-row-alternative">
                <label>Video source <small>( for dedicated player )</small> :</label>        
                <select type="text" id="video_source">
                	<option value="youtube">Youtube</option>           
                    <option value="self-hosted">Self-hosted</option>
                </select>
            </div>                   
            <div class="table-row table-row-alternative">
                <label>Video URL:</label>        
                <input type="text" id="video_url" size="80" />            
            </div>
            <div class="table-row">
                <label>Video width:</label>        
                <input type="text" id="video_width" size="10" />            
            </div>
            <div class="table-row table-row-alternative">
                <label>video height:</label>        
                <input type="text" id="video_height" size="10" />            
            </div>
            <div class="table-row table-row-last">            
                <input type="button" value="Close" onclick="tinyMCEPopup.close();" />
                <input type="submit" value="Insert" onclick="insertShortcode();" />                 
            </div>     
        </div>
	</form>
</body>
</html>
<?php

?>
