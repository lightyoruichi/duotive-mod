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
		var slideshow_type = document.getElementById('slideshow_type').value;
		var slideshow_width = document.getElementById('slideshow_width').value;
		var slideshow_height = document.getElementById('slideshow_height').value;
		
		var shortcode_content = '[slideshow effect="'+slideshow_type+'" width="'+slideshow_width+'" height="'+slideshow_height+'"]image urls go here separated by commas[/slideshow]';
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
        <h3 class="page-title">Insert a slideshow</h3>
		<div id="shorcode-manager">
        	<div class="table-row table-row-beforelast"> 
                <label>Slideshow effect:</strong></label>
                <select id="slideshow_type">
                    <option value="sliceDown">sliceDown</option>
                    <option value="sliceDownLeft">sliceDownLeft</option>
                    <option value="sliceUp">sliceUp</option>
                    <option value="sliceUpLeft">sliceUpLeft</option>
                    <option value="sliceUpDown">sliceUpDown</option>
                    <option value="sliceUpDownLeft">sliceUpDownLeft</option>
                    <option value="fold">fold</option>
                    <option value="fade">fold</option>
                    <option value="random">random</option>
                    <option value="slideInRight">slideInRight</option>
                    <option value="slideInLeft">slideInLeft</option>
                    <option value="boxRandom">boxRandom</option>
                    <option value="boxRain">boxRain</option>
                    <option value="boxRainReverse">boxRainReverse</option>
                    <option value="boxRainGrow">boxRainGrow</option>
                    <option value="boxRainGrowReverse">boxRainGrowReverse</option>                                                         
                </select>
            </div>
         	<div class="table-row table-row-beforelast"> 
                <label>Slideshow width:</strong></label>
                <input type="text" id="slideshow_width" />
            </div>                        
         	<div class="table-row table-row-beforelast"> 
                <label>Slideshow height:</strong></label>
                <input type="text" id="slideshow_height" />
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
