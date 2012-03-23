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
		var image_url = document.getElementById('image_url').value;
		var image_width = document.getElementById('image_width').value;
		var image_height = document.getElementById('image_height').value;
		var image_align = document.getElementById('image_align').value;
		var image_pattern = document.getElementById('image_pattern').value;
		var image_alt = document.getElementById('image_alt').value;				
		
		var shortcode_content = '';			
		shortcode_content = '[imageframe width='+image_width+' height='+image_height+' pattern="'+image_pattern+'" align="'+image_align+'" alt="'+image_alt+'"]'+image_url+'[/imageframe]';
		
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
        <h3 class="page-title">Insert image with frame</h3>
		<div id="shorcode-manager">              
            <div class="table-row table-row-alternative">
                <label>Image path:</label>        
                <input type="text" id="image_url" size="80" />            
            </div>
            <div class="table-row">
                <label>Image width:</label>        
                <input type="text" id="image_width" size="10" />            
            </div>
            <div class="table-row table-row-alternative">
                <label>Image height:</label>        
                <input type="text" id="image_height" size="10" />            
            </div>
            <div class="table-row table-row">
                <label>Image align:</label>         
                <select id="image_align" name="image_align">
                    <option value="left">Align Left</option>
                    <option value="right">Align Right</option>                    
                </select>               
            </div>
            <div class="table-row table-row-alternative">
                <label>Image alt:</label>        
                <input type="text" id="image_alt" size="80" />            
            </div>             
            <div class="table-row table-row-beforelast">
                <label>Image pattern:</label>         
                <select id="image_pattern" name="image_pattern">
                    <option value="1">Dots pattern</option>
                    <option value="2">Diagonal right</option>	
                    <option value="3">Diagonal left</option>
                    <option value="4">Diagonal metal</option>	
                    <option value="5">Diagonal grid</option>	
                    <option value="6">Diagonal grid small</option>	
                    <option value="7">Mosaic</option>					
                    <option value="8">Grid</option>	                    
                </select>               
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
