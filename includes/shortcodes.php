<?php
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//COLUMNS SHORTCODES
		function onehalf( $atts, $content = null )
		{
			return '<div class="onehalf">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('onehalf', 'onehalf');
		
		function onehalflast( $atts, $content = null )
		{
			return '<div class="onehalf onehalflast">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('onehalflast', 'onehalflast');	
		
		function onethird( $atts, $content = null )
		{
			return '<div class="onethird">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('onethird', 'onethird');	
		
		function onethirdlast( $atts, $content = null )
		{
			return '<div class="onethird onethirdlast">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('onethirdlast', 'onethirdlast');	
		
		function oneforth( $atts, $content = null )
		{
			return '<div class="oneforth">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('oneforth', 'oneforth');	
		
		function oneforthlast( $atts, $content = null )
		{
			return '<div class="oneforth oneforthlast">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('oneforthlast', 'oneforthlast');
		
		function twothirds( $atts, $content = null )
		{
			return '<div class="twothirds">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('twothirds', 'twothirds');	
		
		function twothirdslast( $atts, $content = null )
		{
			return '<div class="twothirds twothirdslast">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('twothirdslast', 'twothirdslast');
		
		
		function threeforths( $atts, $content = null )
		{
			return '<div class="threeforths">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('threeforths', 'threeforths');	
		
		function threeforthslast( $atts, $content = null )
		{
			return '<div class="threeforths threeforthslast">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('threeforthslast', 'threeforthslast');										
			
	//TYPOGRAPHY SHORTCODES
	
		function line_sep( $atts, $content = null )
		{
			return '<div class="line-sep">&nbsp;</div>';
		}
		add_shortcode('line-sep', 'line_sep');
			
		function note( $atts, $content = null )
		{
			return '<div class="note">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('note', 'note');
		
		function confirmation( $atts, $content = null )
		{
			return '<div class="confirmation">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('confirmation', 'confirmation');
		
		function error( $atts, $content = null )
		{
			return '<div class="error">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('error', 'error');		
		
		function box( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "title" => ''
				), $atts));				
			return '<div class="box"><h4>'.$title.'</h4>'.remove_wpautop($content).'</div>';
		}
		add_shortcode('box', 'box');
		
		function quote_float( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "align" => ''
				), $atts));	
			switch($align)
			{
				case '': $align = ' quote-float-right'; break;
				case 'right': $align = ' quote-float-right'; break;
				case 'left': $align = ' quote-float-left'; break;								
			}								
			return '<div class="quote-float'.$align.'">"'.remove_wpautop($content).'"</div>';
		}
		add_shortcode('quote-float', 'quote_float');	
		
		function quote( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "author" => ''
				), $atts));				
			return '<div class="quote"><p>"'.remove_wpautop($content).'"</p><span class="author">&mdash; '.$author.'</span></div>';
		}
		add_shortcode('quote', 'quote');	
		
		function quoteicon( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "author" => ''
				), $atts));				
			return '<div class="quoteicon"><p>"'.remove_wpautop($content).'"</p><span class="author">&mdash; '.$author.'</span></div>';
		}
		add_shortcode('quoteicon', 'quoteicon');	
		
		function boxparagraph( $atts, $content = null )
		{
			return '<div class="boxparagraph">'.remove_wpautop($content).'</div>';
		}
		add_shortcode('boxparagraph', 'boxparagraph');							
		
		function diamondlist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="diamondlist">', remove_wpautop($content));
		}
		add_shortcode('diamondlist', 'diamondlist');
		
		function bulletlist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="bulletlist">', remove_wpautop($content));
		}
		add_shortcode('bulletlist', 'bulletlist');

		function pluslist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="pluslist">', remove_wpautop($content));
		}
		add_shortcode('pluslist', 'pluslist');
		
		function heartlist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="heartlist">', remove_wpautop($content));
		}
		add_shortcode('heartlist', 'heartlist');

		function dashlist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="dashlist">', remove_wpautop($content));
		}
		add_shortcode('dashlist', 'dashlist');	
		
		function squarelist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="squarelist">', remove_wpautop($content));
		}
		add_shortcode('squarelist', 'squarelist');
		
		function pointinglist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="pointinglist">', remove_wpautop($content));
		}
		add_shortcode('pointinglist', 'pointinglist');	
		
		function checklist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="checklist">', remove_wpautop($content));
		}
		add_shortcode('checklist', 'checklist');	
		
		function starlist( $atts, $content = null ) {
			return str_replace('<ul>', '<ul class="starlist">', remove_wpautop($content));
		}
		add_shortcode('starlist', 'starlist');												

		function intro_paragraph( $atts, $content = null ) {
			return '<p class="intro">'.remove_wpautop($content).'</p>';
		}
		add_shortcode('intro-paragraph', 'intro_paragraph');
		
		function big_sep( $atts, $content = null ) {
			return '<div class="big-sep"></div>';
		}
		add_shortcode('big-sep', 'big_sep');
		

		add_shortcode('intro-paragraph', 'intro_paragraph');
		
		function icon( $atts, $content = null ) {
			extract(shortcode_atts(array(
				  "number" => '1',										 
				  "size" => '48'
				), $atts));
			$number = str_replace('"','',$number);				
			$size = str_replace('"','',$size);
			$icon_url = get_bloginfo('template_directory').'/images/icons/';
			return '<img src="'.$icon_url.'icon-'.$number.'-'.$size.'.png" />';
		}
		add_shortcode('icon', 'icon');
		
		function button( $atts, $content = null ) {
			extract(shortcode_atts(array(
				  "url" => '#',										 
				  "text" => 'Button',
				  "type" => ''
				), $atts));		
			$icon_class = '';
			$button_rel = '';
			switch($type)
			{
				case 'download': 
					$icon_class = ' button-download';
				break;
				case 'large': 
					$icon_class = ' button-large';
				break;				
				case 'picture': 
					$icon_class = ' button-picture';
				break;	
				case 'mail': 
					$icon_class = ' button-mail';
					$url = 'mailto:'.$url;
				break;					
				case 'video':
					$icon_class = ' button-video';				
					$button_rel = ' rel="single-modal "';
				break;					
			}
			return '<a href="'.$url.'"'.$button_rel.' class="button'.$icon_class.'">'.$text.'</a>';
		}
		add_shortcode('button', 'button');			

	//IMAGE FRAMES SHORTCODES
	
		function imageframe( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "width" => '105',										 
				  "height" => '105',
				  "align" => 'none',
				  "pattern" => '1',
				  "alt" => ''
				), $atts));	
			
			$width = str_replace('px','',$width);
			$height = str_replace('px','',$height);			
			$class = '';
			switch($align)
			{
				case 'none': $class = '';break;
				case 'left': $class = 'image-frame-align-left';break;
				case 'right': $class = 'image-frame-align-right';break;			
			}
			switch($pattern)
			{
				case '1': $pattern = ' image-frame-dots-pattern';break;
				case '2': $pattern = ' image-frame-diagonal-right-pattern';break;	
				case '3': $pattern = ' image-frame-diagonal-left-pattern';break;	
				case '4': $pattern = ' image-frame-diagonal-metal-pattern';break;	
				case '5': $pattern = ' image-frame-diagonal-grid-pattern';break;	
				case '6': $pattern = ' image-frame-diagonal-grid-small-pattern';break;	
				case '7': $pattern = ' image-frame-mosaic-pattern';break;					
				case '8': $pattern = ' image-frame-grid-pattern';break;					
			}			
			$timthumb_url = get_bloginfo('template_directory').'/includes/timthumb.php';
			return
			'<a class="image-frame '.$class.$pattern.'" rel="gallery[modal]" href="'.$content.'" style="width:'.$width.'px;height:'.$height.'px;">
				<img src="'.$timthumb_url.'?src='.$content.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=100" alt="'.$alt.'" />
			</a>				
			';
		}
		add_shortcode('imageframe', 'imageframe');

	//SLIDESHOW SHORTCODE
		function slideshow( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "width" => '300',										 
				  "height" => '300',
				  "effect" => 'random'
				), $atts));	
			$width = str_replace('px','',$width);
			$height = str_replace('px','',$height);		
			$timthumb_url = get_bloginfo('template_directory').'/includes/timthumb.php';
			$images = explode(', ',$content);
			$random = rand(0,999999);
			$slideshow = '<script type="text/javascript">';
				$slideshow .= 'jQuery(window).load(function() {';
					$slideshow .= 'jQuery("#slider-'.$random.'").nivoSlider({controlNav:false,manualAdvance:true, directionNavHide:false, effect:\''.$effect.'\'});';
				$slideshow .= '});';
			$slideshow .= '</script>';
			$slideshow .= '<div id="slider-'.$random.'" class="slideshow-in-content"  style="width:'.$width.'px;height:'.$height.'px;">';
				foreach($images as $image) 
				{
					$slideshow .= '<img src="'.$timthumb_url.'?src='.$image.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q=100" />';
				}
			$slideshow .= '</div>';
			return $slideshow;
		}
		add_shortcode('slideshow', 'slideshow');			
			
	//DUOTIVE VIDEO PLAYER
		function duotive_video( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "width" => '940',										 
				  "height" => '400',
				  "source" => '',
				  "host" => 'youtube'
				), $atts));	
			$blog_url = get_bloginfo( 'template_url' );
   			$themecolor =  get_option('themecolor');
			if ( $host == 'self-hosted' ) $host = 'video';
			$random = rand(0,999999);
			switch ( $host )
			{
				case 'youtube':
					$source = str_replace('http://www.youtube.com/watch?v=','',$source);
					$source = str_replace('http://youtube.com/watch?v=','',$source);					
					$strip_top = strrpos($source,'&');
					if ( $strip_top > 0 ) $source = substr($source,0,$strip_top);		
				break;
				
				case 'vimeo':
					$source = str_replace('http://www.vimeo.com/','',$source);				
					$source = str_replace('http://vimeo.com/','',$source);
				break;
			}
			if ( $host == 'video' || $host == 'youtube' ) $playerheight = $height + 30;
			else $playerheight = $height;
    		if ( $themecolor == '' ) $themecolor = 'db6e0d';		
			$video = '<div class="duotive-multimedia-wrapper">';
				$video .= '<script type="text/javascript" language="javascript" src="'.$blog_url.'/includes/video-player/swfobject.js"></script>';
				$video .= '<script type="text/javascript">';
					$video .= 'var flashvars = {};';
						$video .= 'flashvars.type = "'.$host.'";';
						$video .= 'flashvars.url = "'.$source.'";';
						if ( $host == 'video' || $host == 'youtube' ) :
						$video .= 'flashvars.color = "0x'.$themecolor.'";';
						$video .= 'flashvars.hover = "0x000000";';
						$video .= 'flashvars.bgColor = "0xFFFFFF";';
						$video .= 'flashvars.borderColor = "0xCCCCCC";';
						$video .= 'flashvars.bufferColor = "0xe6e4df";';
						$video .= 'flashvars.progressBgColor = "0xEEEEEE";';
						$video .= 'flashvars.volumeBgColor = "0xCCCCCC";';
						else:
						$video .= 'flashvars.color = "'.$themecolor.'";';
						endif;
						$video .= 'flashvars.width = "'.$width.'";';
						$video .= 'flashvars.height = "'.$height.'";';
					$video .= 'var params = {};';
						$video .= 'params.bgcolor = "0x000000";';
						$video .= 'params.scale = "noscale";';
						$video .= 'params.salign = "tl";';						
						$video .= 'params.allowfullscreen = "true";';
						$video .= 'params.wmode = "opaque";';
					$video .= 'var attributes = {};';
					$video .= 'swfobject.embedSWF("'.$blog_url.'/includes/video-player/main.swf", "video-'.$random.'", "'.$width.'", "'.$playerheight.'", "9.0.0", false, flashvars, params, attributes);';
				$video .= '</script>';
				$video .= '<div id="video-'.$random.'">';
					$video .= '<a href="http://www.adobe.com/go/getflashplayer">';
						$video .= '<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />';
					$video .= '</a>';
				$video .= '</div>';
			$video .= '</div>';				
			echo $video;
		}
		add_shortcode('duotive-video', 'duotive_video');	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//FOOTER PARTNERS SHORTCODE
	function partner( $atts, $content = null ) {
    extract(shortcode_atts(array(
		  "logo" => '#',
		  "link" => '#'
		), $atts));	   
		return '
		<li>
			<a href="'.$link.'" target="_blank">
				<img src="'.$logo.'" />
			</a>
		</li>
		';								
	}
	add_shortcode('partner', 'partner');

?>