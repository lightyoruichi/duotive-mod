<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Duotive Shortcodes - Insert content holders and separators</title>
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
		var content_holders_value = document.getElementById('content_holders').value;
		var shortcode_content = '';

		if ( content_holders_value == 1 ) shortcode_content = ' [intro-paragraph]Intro paragraph content goes here.[/intro-paragraph] ';
		if ( content_holders_value == 2 ) shortcode_content = ' [note]Note content goes here[/note] ';
		if ( content_holders_value == 3 ) shortcode_content = ' [confirmation]Confirmation content goes here.[/confirmation] ';
		if ( content_holders_value == 4 ) shortcode_content = ' [error]Error content goes here.[/error] ';
		if ( content_holders_value == 5 ) shortcode_content = ' [box title="Box title goes here"]Box content goes here[/box] ';
		if ( content_holders_value == 6 ) shortcode_content = ' <a class="gototooltip" title="Tooltip content goes here. " href="#">link with tooltip</a> ';
		if ( content_holders_value == 7 ) shortcode_content = ' [quote author="Quote author goes here"]Quote content goes here[/quote] ';
		if ( content_holders_value == 8 ) shortcode_content = ' [quoteicon author="Quote author goes here"]Quote content goes here[/quoteicon] ';
		if ( content_holders_value == 9 ) shortcode_content = ' [quote-float]Float quote content goes here[/quote-float] ';
		if ( content_holders_value == 10 ) shortcode_content = ' [boxparagraph]Box paragraph content goes here[/boxparagraph] ';
		if ( content_holders_value == 11 ) shortcode_content = ' [big-sep] ';
		if ( content_holders_value == 12 ) shortcode_content = ' [line-sep] ';
		if ( content_holders_value == 13 ) shortcode_content = ' [button text="Button text" url="#"] ';
		if ( content_holders_value == 14 ) shortcode_content = ' [button type="mail" text="Send e-mail" url="email url"] ';
		if ( content_holders_value == 15 ) shortcode_content = ' [button type="download" text="Download file" url="#"] ';
		if ( content_holders_value == 16 ) shortcode_content = ' [button type="picture" text="Download picture" url="#"] ';
		if ( content_holders_value == 17 ) shortcode_content = ' [button type="video" text="Watch video" url="video url"]  ';
		if ( content_holders_value == 18 ) shortcode_content = ' [button type="large" text="Large button" url="#"] ';		
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
        <h3 class="page-title">Insert content shortcodes</h3>
		<div id="shorcode-manager">
        	<div class="table-row table-row-beforelast">     
				<label for="content_holders">Shortcode</label>
                <select id="content_holders">
                    <option value="1">Intro paragraph</option>
                    <option value="2">Note</option>
                    <option value="3">Confirmation</option>
                    <option value="4">Error</option>
                    <option value="5">Box</option>
                    <option value="6">URL with tooltip</option>                                                                                                                                                               
                    <option value="7">Quote</option>                    
                    <option value="8">Quote with icon</option>                    
                    <option value="9">Floating quote</option> 
					<option value="10">Box paragraph</option>
                    <option value="11">Big separator</option>
                    <option value="12">Line separator</option> 
                    <option value="13">Button</option>
                    <option value="14">Button mail</option>
                    <option value="15">Button download file</option>
                    <option value="16">Button download picture</option>
                    <option value="17">Button watch video</option>
                    <option value="18">Button large</option>                                                                                                    
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
