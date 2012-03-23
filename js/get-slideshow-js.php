<?php
	$slider_type = $_GET['type'];
	switch($slider_type) {
		case 'fullwidth':
			$slider_controls = $_GET['controls'];
			$slider_gallery = $_GET['gallery'];
			$slider_titles = $_GET['titles'];
			$slider_contentbox = $_GET['contentbox'];			
			$slider_duration = $_GET['duration'];
			$slider_interval = $_GET['interval'];		
			echo 'window.addEvent("load", function(){';
				echo 'var slider = new dtFullWidthSlider({';
					echo 'container: $("fullwidth-slider"),';
					echo 'arrowControls: '.$slider_controls.',';
					echo 'gallery: '.$slider_gallery.',';
					echo 'slideTitles: '.$slider_titles.',';
					echo 'contentBox: '.$slider_contentbox.',';
					echo 'transitionDuration: '.$slider_duration.',';
					echo 'transitionInterval: '.$slider_interval.'';
				echo '});';
			echo '});';
		break;
		case 'presentation':
			$slider_controls = $_GET['controls'];
			$slider_description = $_GET['description'];
			$slider_description_autohide = $_GET['hide'];			
			$slider_duration = $_GET['duration'];
			$slider_interval = $_GET['interval'];			
			echo 'window.addEvent("load", function(){';
				echo 'var dtSlideshow = new dtSliderPresentation({';
					echo 'container: $("presentation-slider"),';
					echo 'arrowControls: '.$slider_controls.',';
					echo 'description: '.$slider_description.',';
					echo 'descriptionAutoHide: '.$slider_description_autohide.',';
					echo 'transitionDuration: '.$slider_duration.',';
					echo 'transitionInterval: '.$slider_interval.'';
				echo '});';
			echo '});';
		break;
		case 'complex':
			$slider_controls = $_GET['controls'];		
			$slider_gallery = $_GET['gallery'];
			$slider_description = $_GET['description'];
			$slider_duration = $_GET['duration'];
			$slider_interval = $_GET['interval'];			
			echo 'window.addEvent("load", function(){';
				echo 'var slider = new duotiveSlide({';
					echo 'container: $("complex-slider"),';
					echo 'arrowControls: '.$slider_controls.',';
					echo 'description: '.$slider_description.',';
					echo 'gallery: '.$slider_gallery.',';
					echo 'transitionDuration: '.$slider_duration.',';
					echo 'transitionInterval: '.$slider_interval.'';					
				echo '});';
			echo '});';
		break;
		case 'gallery':
			$slider_controls = $_GET['controls'];	
			$slider_description = $_GET['description'];		
			$slider_duration = $_GET['duration'];
			$slider_interval = $_GET['interval'];				
			echo 'window.addEvent("load", function(){';
				echo 'var dtSlideshow = new dtSliderGallery({';
					echo 'container: $("gallery-slider"),';
					echo 'arrowControls: '.$slider_controls.',';
					echo 'description: '.$slider_description.',';
					echo 'transitionDuration: '.$slider_duration.',';
					echo 'transitionInterval: '.$slider_interval.'';
				echo '});';
			echo '});';
		break;		
		case 'content':
			$slider_transition = $_GET['transition'];
			$slider_speed = $_GET['speed'];
        	$slider_auto = $_GET['auto'];
			$slider_pause = $_GET['pause'];			
			echo 'jQuery(document).ready(function($) {';
				echo '$("#content-slider ul li img").hide();';
				echo '$(window).bind("load", function() {';
					echo '$("#content-slider ul li img").fadeIn(500);';
					echo '$("#content-slider ul").bxSlider({';
						echo 'mode: "'.$slider_transition.'",';
						echo 'speed : '.$slider_speed.',';
						echo 'auto: '.$slider_auto.',';					
						echo 'pause : '.$slider_pause.',';					
						echo 'infiniteLoop: true';
					echo '});'; 					
				echo '});';												        
            echo '});';
    	break;
		case 'accordion':
			$slider_sticky = $_GET['sticky'];			
			echo 'jQuery(document).ready(function($) {';
				echo '$("#accordion-slider ul").hide();';
				echo '$(window).bind("load", function() {';
					echo '$("#accordion-slider ul").fadeIn(500);';
				echo '});';												  
				echo '$("#accordion-slider ul").kwicks({';
					echo 'max: 600,';
					echo 'spacing:  2,';
					echo 'sticky: '.$slider_sticky;
				echo '});';
				echo '$("#accordion-slider ul li").hover(function(){';
						echo '$(this).find("div").stop().animate({"opacity": 1, "left": 0}, 500,"linear");';
					echo '},function(){';
						echo '$(this).find("div").stop().animate({"opacity": 0, "left": -600}, 500,"linear");';
				echo '});';
            echo '});';					
		break;
		case 'nivo':
			$slider_transition = $_GET['transition'];
			$slider_slices = $_GET['slices'];
			$slider_boxrows = $_GET['boxrows'];
			$slider_boxcols = $_GET['boxcols'];
			$slider_animspeed = $_GET['animspeed'];
			$slider_pausetime = $_GET['pausetime'];
			$slider_directionnav = $_GET['directionnav'];
			$slider_directionnavhide = $_GET['directionnavhide'];			
			$slider_controlnav = $_GET['controlnav'];			
			echo 'jQuery(document).ready(function() {';
				echo 'jQuery("#nivo-slider").hide();';
				echo 'jQuery(window).bind("load", function() {';
					echo 'jQuery("#nivo-slider").fadeIn(500);';
					echo 'jQuery("#nivo-slider").nivoSlider({';
						echo 'effect: "'.$slider_transition.'",';
						echo 'slices: '.$slider_slices.',';
						echo 'boxRows: '.$slider_boxrows.',';
						echo 'boxCols: '.$slider_boxcols.',';					
						echo 'animSpeed: '.$slider_animspeed.',';
						echo 'pauseTime: '.$slider_pausetime.',';
						echo 'directionNav: '.$slider_directionnav.',';
						echo 'directionNavHide: '.$slider_directionnavhide.',';
						echo 'controlNav: '.$slider_controlnav.',';					
						echo 'captionOpacity: 1,';
						if ( $slider_animspeed >= 1000 ) $content_animspeed = $slider_animspeed - 500;
						else $content_animspeed = 600;
						echo 'beforeChange: function(){jQuery("#nivo-slider div.nivo-caption").animate({"bottom": -500}, '.$content_animspeed.',"linear");},';
						echo 'afterChange: function(){jQuery("#nivo-slider div.nivo-caption").animate({"bottom": 0}, '.$content_animspeed.',"linear");}';					
					echo '});';					
				echo '});';												  
            echo '});';
    	break;		
	}
?>