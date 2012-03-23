<?php  
add_action('admin_menu', 'create_duotive_menu');  
function create_duotive_menu() {  
	add_menu_page('Duotive Option Panel', 'Duotive', 'manage_options', 'duotive-panel', 'duotivesettings', get_bloginfo( 'template_url' ).'/includes/duotive-admin/ico.png','64');
	add_action( 'admin_init', 'register_duotive_settings' );  
}  
function register_duotive_settings() {  
	register_setting( 'duotivesettings', 'themecolor' );
	register_setting( 'duotivesettings', 'font' );	
	register_setting( 'duotivesettings', 'secondcolor' );
	register_setting( 'duotivesettings', 'favicon' );	
	register_setting( 'duotivesettings', 'headertoolbar' ); 
	register_setting( 'duotivesettings', 'headertoolbarmenu' ); 	
	register_setting( 'duotivesettings', 'headersearch' ); 
	register_setting( 'duotivesettings', 'headerpattern' ); 
	register_setting( 'duotivesettings', 'headerlogo' );
	register_setting( 'duotivesettings', 'mainmenu' );
	register_setting( 'duotivesettings', 'footer' );
	register_setting( 'duotivesettings', 'footerpartners' );
	register_setting( 'duotivesettings', 'footerpartnerstitle' );
	register_setting( 'duotivesettings', 'footerpartnerscontent' );	
	register_setting( 'duotivesettings', 'footertabs' );
	register_setting( 'duotivesettings', 'footertabsrows' );	
	register_setting( 'duotivesettings', 'subfooter' );
	register_setting( 'duotivesettings', 'copyright' );	
} 
function general_settings_update()
{
	update_option('font',$_POST['font']);
	update_option('sidebar',$_POST['sidebar']);	
	update_option('themecolor',$_POST['themecolor']);
	update_option('secondcolor',$_POST['secondcolor']);
	update_option('toptoolbar_wrapper_background',$_POST['toptoolbar_wrapper_background']);
	update_option('favicon',$_POST['favicon']);
}
function header_settings_update()
{
	update_option('headertoolbar',$_POST['headertoolbar']);
	update_option('headertoolbarmenu',$_POST['headertoolbarmenu']);	
	update_option('deviantart',$_POST['deviantart']);
	update_option('facebook',$_POST['facebook']);
	update_option('flickr',$_POST['flickr']);
	update_option('myspace',$_POST['myspace']);
	update_option('rss',$_POST['rss']);
	update_option('twitter',$_POST['twitter']);
	update_option('vimeo',$_POST['vimeo']);
	update_option('youtube',$_POST['youtube']);	
	update_option('headersearch',$_POST['headersearch']);
	update_option('headerpattern',$_POST['headerpattern']);
	update_option('headerlogo',$_POST['headerlogo']);
	update_option('headerlogovertical',$_POST['headerlogovertical']);
	update_option('headerlogohorizontal',$_POST['headerlogohorizontal']);	
	update_option('mainmenu',$_POST['mainmenu']);	
}
function footer_settings_update()
{
	update_option('footer',$_POST['footer']);
	update_option('footerpartners',$_POST['footerpartners']);
	update_option('footerpartnerstitle',$_POST['footerpartnerstitle']);
	update_option('footerpartnerscontent',stripslashes($_POST['footerpartnerscontent']));
	update_option('footertabs',$_POST['footertabs']);
	update_option('footertabsrows',$_POST['footertabsrows']);
	update_option('subfooter',$_POST['subfooter']);
	update_option('copyright',stripslashes($_POST['copyright']));	
}
function advanced_settings_update() {
	update_option('maincss',stripslashes($_POST['maincss']));	
	update_option('customcss',stripslashes($_POST['customcss']));
	update_option('google_analytics',stripslashes($_POST['google_analytics']));		
}
function single_settings_update() {
	update_option('postmeta',$_POST['postmeta']);	
	update_option('posttopimage',$_POST['posttopimage']);	
	update_option('postsidebar',$_POST['postsidebar']);		
	update_option('relatedposts',$_POST['relatedposts']);
	update_option('relatedpostsnumber',$_POST['relatedpostsnumber']);
	update_option('sharing',$_POST['sharing']);
	update_option('comments',$_POST['comments']);	
}
function duotivesettings() {  
?>  
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/duotive-admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/colorpicker.css" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/jqtransform.css" /> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/colorpicker.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.jqtransform.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.tools.min.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery-ui.min.js" /></script>        
    <script type="text/javascript">
      $(document).ready(function() {
		jQuery('#duotive-admin-panel img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});									 
        $('#themecolor,#secondcolor,#toptoolbar_wrapper_background').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val(hex);
                $(el).ColorPickerHide();
            },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            })
            .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });
		$("#general-settings div.table-row:even").addClass('table-row-alternative');
		$("#single-settings div.table-row:even").addClass('table-row-alternative');		
		$("#header-settings div.table-row:even").addClass('table-row-alternative');
		$("#advanced-settings div.table-row:even").addClass('table-row-alternative');		
		$("#footer-settings div.table-row:even").addClass('table-row-alternative');		
    	$('#general-settings .table-row-last').prev('div').addClass('table-row-beforelast');
    	$('#single-settings .table-row-last').prev('div').addClass('table-row-beforelast');		
    	$('#header-settings .table-row-last').prev('div').addClass('table-row-beforelast');
    	$('#advanced-settings .table-row-last').prev('div').addClass('table-row-beforelast');		
    	$('#footer-settings .table-row-last').prev('div').addClass('table-row-beforelast');		
        $(".transform").jqTransform();
        $("#duotive-admin-panel" ).tabs();
		
		jQuery('#headerlogo_button').click(function() {
			 formfield = jQuery('#headerlogo').attr('name');
			 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			 destination = 'add-logo';			 
			 return false;
		});
		jQuery('#favicon_button').click(function() {
			 formfield = jQuery('#favicon').attr('name');
			 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			 destination = 'add-favicon';			 
			 return false;
		});		
		window.send_to_editor = function(html) {
			switch(destination)
			{ 
				case 'add-favicon':
					imgurl2 = jQuery('img',html).attr('src');
					jQuery('#favicon').val(imgurl2);
				break;			
				case 'add-logo':
					imgurl2 = jQuery('img',html).attr('src');
					jQuery('#headerlogo').val(imgurl2);
				break;
			}
			tb_remove();
		}
		
		$( "#headerlogoverticalslider" ).slider({
			range: 'min',
			value:$( "#headerlogovertical" ).val(),
			min: -30,
			max: 30,
			step: 1,
			slide: function( event, ui ) {
				$( "#headerlogovertical" ).val( ui.value );
			}
		});
		$( "#headerlogovertical" ).val($( "#headerlogoverticalslider" ).slider( "value" ) );
		
		$( "#headerlogohorizontalslider" ).slider({
			range: 'min',
			value:$( "#headerlogohorizontal" ).val(),
			min: -30,
			max: 30,
			step: 1,
			slide: function( event, ui ) {
				$( "#headerlogohorizontal" ).val( ui.value );
			}
		});
		$( "#headerlogohorizontal" ).val($( "#headerlogohorizontalslider" ).slider( "value" ) );	
		
		jQuery('#predef_color_1').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('db6e0d');
			jQuery('#secondcolor').val('f1e9c6');
			jQuery('#toptoolbar_wrapper_background').val('dbd3b2');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_2').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('754bb3');
			jQuery('#secondcolor').val('f1e9c6');
			jQuery('#toptoolbar_wrapper_background').val('dbd3b2');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_3').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('b9b480');
			jQuery('#secondcolor').val('d9d396');
			jQuery('#toptoolbar_wrapper_background').val('b8b165');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_4').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('93353f');
			jQuery('#secondcolor').val('eeb69d');
			jQuery('#toptoolbar_wrapper_background').val('e88e77');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_5').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('6f2e72');
			jQuery('#secondcolor').val('e1a2e4');
			jQuery('#toptoolbar_wrapper_background').val('4f3339');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_6').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('e1b006');
			jQuery('#secondcolor').val('ebdca6');
			jQuery('#toptoolbar_wrapper_background').val('4f3339');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_7').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('00c8fa');
			jQuery('#secondcolor').val('acdae6');
			jQuery('#toptoolbar_wrapper_background').val('003947');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_8').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('961539');
			jQuery('#secondcolor').val('efb7c6');
			jQuery('#toptoolbar_wrapper_background').val('a84a64');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_9').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('167f39');
			jQuery('#secondcolor').val('8ecfa4');
			jQuery('#toptoolbar_wrapper_background').val('044c29');			
			jQuery('#general-settings form').submit();
		});
		jQuery('#predef_color_10').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('513928');
			jQuery('#secondcolor').val('edccb4');
			jQuery('#toptoolbar_wrapper_background').val('377a54');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_11').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('e34446');
			jQuery('#secondcolor').val('f6b699');
			jQuery('#toptoolbar_wrapper_background').val('e36d6f');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_12').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('00cfc3');
			jQuery('#secondcolor').val('addad7');
			jQuery('#toptoolbar_wrapper_background').val('004f4b');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_13').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('1c9bfa');
			jQuery('#secondcolor').val('8ac5f1');
			jQuery('#toptoolbar_wrapper_background').val('14468f');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_14').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('f25116');
			jQuery('#secondcolor').val('f0debc');
			jQuery('#toptoolbar_wrapper_background').val('f2be5c');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_15').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('659aa6');
			jQuery('#secondcolor').val('a0e6f6');
			jQuery('#toptoolbar_wrapper_background').val('075473');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_16').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('8a6e56');
			jQuery('#secondcolor').val('cbb9aa');
			jQuery('#toptoolbar_wrapper_background').val('bd783d');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_17').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('9ab04d');
			jQuery('#secondcolor').val('e1f1a9');
			jQuery('#toptoolbar_wrapper_background').val('312528');			
			jQuery('#general-settings form').submit();
		});	
		jQuery('#predef_color_18').click(function() {
			jQuery('.predef_color').removeClass('predef_active');
			$(this).addClass('predef_active');
			jQuery('#themecolor').val('a32500');
			jQuery('#secondcolor').val('eda48f');
			jQuery('#toptoolbar_wrapper_background').val('2b2922');			
			jQuery('#general-settings form').submit();
		});			
      });
    </script>
    <div class="wrap">
    	<div id="duotive-logo">Duotive Admin Panel</div>
        <div id="duotive-main-menu">
        	<ul>
            	<li class="active"><a href="admin.php?page=duotive-panel">General Settings</a></li>
            	<li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            	<li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            	<li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
				<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li> 
				<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
				<li><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li> 
                <li><a href="admin.php?page=duotive-contact">Contact page</a></li>                                                                                             
            </ul>
        </div>
        <div id="duotive-admin-panel">
	    	<h3>General settings</h3>        
            <ul>
                <li><a href="#general-settings">General</a></li>
				<li><a href="#header-settings">Header</a></li>
				<li><a href="#footer-settings">Footer</a></li>
				<li><a href="#single-settings">Article settings</a></li>                
                <li><a href="#advanced-settings">Advanced</a></li>                                
            </ul>
            <div id="general-settings">
                <?php if ( isset($_POST['general-settings']) && $_POST['general-settings'] == 'true') { general_settings_update(); } ?>
            	<form method="post" action="#general-settings" class="transform">
                    <input type="hidden" name="general-settings" value="true" />
                    <div class="table-row clearfix">
                    	<label>Predefined colors:</label>
                        <div id="predef_color_wrapper">
                            <a id="predef_color_1" class="predef_color<?php if ( get_option('themecolor') == 'db6e0d' && get_option('secondcolor') == 'f1e9c6' && get_option('toptoolbar_wrapper_background') == 'dbd3b2'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 1</a>
                            <a id="predef_color_2" class="predef_color<?php if ( get_option('themecolor') == '754bb3' && get_option('secondcolor') == 'f1e9c6' && get_option('toptoolbar_wrapper_background') == 'dbd3b2'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 2</a>
                            <a id="predef_color_3" class="predef_color<?php if ( get_option('themecolor') == 'b9b480' && get_option('secondcolor') == 'd9d396' && get_option('toptoolbar_wrapper_background') == 'b8b165'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 3</a>
                            <a id="predef_color_4" class="predef_color<?php if ( get_option('themecolor') == '93353f' && get_option('secondcolor') == 'eeb69d' && get_option('toptoolbar_wrapper_background') == 'e88e77'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 4</a>
                            <a id="predef_color_5" class="predef_color<?php if ( get_option('themecolor') == '6f2e72' && get_option('secondcolor') == 'e1a2e4' && get_option('toptoolbar_wrapper_background') == '4f3339'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 5</a>
                            <a id="predef_color_6" class="predef_color<?php if ( get_option('themecolor') == 'e1b006' && get_option('secondcolor') == 'ebdca6' && get_option('toptoolbar_wrapper_background') == '4f3339'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 6</a>
                            <a id="predef_color_7" class="predef_color<?php if ( get_option('themecolor') == '00c8fa' && get_option('secondcolor') == 'acdae6' && get_option('toptoolbar_wrapper_background') == '003947'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 7</a>
                            <a id="predef_color_8" class="predef_color<?php if ( get_option('themecolor') == '961539' && get_option('secondcolor') == 'efb7c6' && get_option('toptoolbar_wrapper_background') == 'a84a64'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 8</a>
                            <a id="predef_color_9" class="predef_color<?php if ( get_option('themecolor') == '167f39' && get_option('secondcolor') == '8ecfa4' && get_option('toptoolbar_wrapper_background') == '044c29'  ) echo ' predef_active'; ?>" href="javascript:void(0);">Color 9</a>                                                                                                                                                                                                
                            <a id="predef_color_10" class="predef_color<?php if ( get_option('themecolor') == '513928' && get_option('secondcolor') == 'edccb4' && get_option('toptoolbar_wrapper_background') == '377a54'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 10</a>
                            <a id="predef_color_11" class="predef_color<?php if ( get_option('themecolor') == 'e34446' && get_option('secondcolor') == 'f6b699' && get_option('toptoolbar_wrapper_background') == 'e36d6f'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 11</a>
                            <a id="predef_color_12" class="predef_color<?php if ( get_option('themecolor') == '00cfc3' && get_option('secondcolor') == 'addad7' && get_option('toptoolbar_wrapper_background') == '004f4b'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 12</a>
                            <a id="predef_color_13" class="predef_color<?php if ( get_option('themecolor') == '1c9bfa' && get_option('secondcolor') == '8ac5f1' && get_option('toptoolbar_wrapper_background') == '14468f'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 13</a>
                            <a id="predef_color_14" class="predef_color<?php if ( get_option('themecolor') == 'f25116' && get_option('secondcolor') == 'f0debc' && get_option('toptoolbar_wrapper_background') == 'f2be5c'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 14</a>
                            <a id="predef_color_15" class="predef_color<?php if ( get_option('themecolor') == '659aa6' && get_option('secondcolor') == 'a0e6f6' && get_option('toptoolbar_wrapper_background') == '075473'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 15</a>
                            <a id="predef_color_16" class="predef_color<?php if ( get_option('themecolor') == '8a6e56' && get_option('secondcolor') == 'cbb9aa' && get_option('toptoolbar_wrapper_background') == 'bd783d'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 16</a>
                            <a id="predef_color_17" class="predef_color<?php if ( get_option('themecolor') == '9ab04d' && get_option('secondcolor') == 'e1f1a9' && get_option('toptoolbar_wrapper_background') == '312528'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 17</a>
                            <a id="predef_color_18" class="predef_color<?php if ( get_option('themecolor') == 'a32500' && get_option('secondcolor') == 'eda48f' && get_option('toptoolbar_wrapper_background') == '2b2922'  ) echo ' predef_active'; ?> predef_color_last" href="javascript:void(0);">Color 18</a>                                                                                                                                                                                                
                        </div>
                    </div>                  
                    <div class="table-row clearfix">            
                        <label for="themecolor">Theme color:</label>
                        <input type="text" size="6" name="themecolor" id="themecolor" value="<?php echo get_option('themecolor'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="secondcolor">Secondary theme color:</label>
                        <input type="text" size="6" name="secondcolor" id="secondcolor" value="<?php echo get_option('secondcolor'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="toptoolbar_wrapper_background">Toolbox background color:</label>
                        <input type="text" size="6" name="toptoolbar_wrapper_background" id="toptoolbar_wrapper_background" value="<?php echo get_option('toptoolbar_wrapper_background'); ?>" />              
                    </div>
                    <div class="table-row clearfix">
                        <label for="sidebar">Sidebar location:</label>
                        <select name="sidebar">
                            <?php $sidebar = get_option('sidebar'); ?>
							<option value="sidebar-right" <?php if ($sidebar=='sidebar-right') { echo 'selected'; } ?> >On right side</option>                                                        
                            <option value="sidebar-left" <?php if ($sidebar=='sidebar-left') { echo 'selected'; } ?> >On left side</option>
                        </select> 
                    </div>                                          
                    <div class="table-row clearfix">
					<?php
                        $absolute_path = __FILE__;
                        $path_to_file = explode( 'wp-content', $absolute_path );
                        $path_to_wp = $path_to_file[0];
                        $theme_path = get_bloginfo('template_directory');
                        $website_url = get_bloginfo('wpurl').'/';
                        $theme_path = str_replace($website_url,'', $theme_path);
                        $fonts_path = $path_to_wp.$theme_path.'/fonts/custom/';
						$fonts = array();
						
                        if ( is_dir($fonts_path) )
                        {
                            $k = 0;
                            $fonts_path = $fonts_path.'*.ttf';
							if ( glob($fonts_path) )
							{
								foreach(glob($fonts_path) as $font)
								{
									$font_name = pathinfo($font);
									$font_title = str_replace('-webfont.ttf', '',$font_name['basename']);
									$font_title = ereg_replace("[^A-Za-z0-9]", " ", $font_title);
									$font_title = ucwords($font_title);
									$font_title = trim($font_title);
									$font_name = str_replace('-webfont.ttf', '',$font_name['basename']);
									$fonts[$k]['name'] = $font_name;
									$fonts[$k]['title'] = $font_title;
									$k++;
								}
							}
                        }
                    ?>
                        <label for="font">Font:</label>
                        <select name="font">
                            <?php $font = get_option('font'); ?>
                            <option value="BergamoStd-Regular" <?php if ($font=='BergamoStd-Regular') { echo 'selected'; } ?> >Bergamo Std Regular</option>
                            <option value="DroidSerif-Regular" <?php if ($font=='DroidSerif-Regular') { echo 'selected'; } ?> >Droid Serif Regular</option>
                            <option value="Quattrocento-Regular" <?php if ($font=='Quattrocento-Regular') { echo 'selected'; } ?> >Quattrocento Regular</option>
                            <option value="Garogier_unhinted" <?php if ($font=='Garogier_unhinted') { echo 'selected'; } ?> >Garogier</option>
                            <option value="GriffosFont" <?php if ($font=='GriffosFont') { echo 'selected'; } ?> >Griffos</option>
                            <option value="new_athena_unicode" <?php if ($font=='new_athena_unicode') { echo 'selected'; } ?> >New Athena Unicode</option>
                            <option value="texgyretermes-regular" <?php if ($font=='texgyretermes-regular') { echo 'selected'; } ?> >TexGyretermes Regular</option>
                            <option value="texgyretermes-italic" <?php if ($font=='texgyretermes-italic') { echo 'selected'; } ?> >TexGyretermes Italic</option>
                            <option value="BEBAS___" <?php if ($font=='BEBAS___') { echo 'selected'; } ?> >BEBAS</option>
                            <option value="SlingLight" <?php if ($font=='SlingLight') { echo 'selected'; } ?> >Sling Light</option>
                            <option value="Hattori_Hanzo" <?php if ($font=='Hattori_Hanzo') { echo 'selected'; } ?> >Hattori Hanzo</option>
                            <option value="Sansation_Light" <?php if ($font=='Sansation_Light') { echo 'selected'; } ?> >Sansation Light</option>   
                            <?php if ( count($fonts) > 0 ): ?>
                            	<?php foreach($fonts as $newfont): ?>
                                	<option value="<?php echo 'custom/'.$newfont['name']; ?>" <?php if ($font == 'custom/'.$newfont['name']) { echo 'selected'; } ?> ><?php echo $newfont['title']; ?></option>   
                                <?php endforeach; ?>
							<?php endif;?>
                        </select>
                        <img class="hint-icon" title="To use custom fonts you need to download the font's @font-face kit (from www.fontsquirrel.com) and place the 4 files (*.ttf, *.eot, *.woff, *.svg) that you find in the archive to &quot;themes/duotive-three/fonts/custom/&quot;. IMPORTANT: Not all the fonts will go well with the theme in sense of line-height and apperance." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                                        
                    <div class="table-row clearfix">
                        <label for="favicon">Favicon URL</label>
                        <input type="text" size="50" id="favicon" name="favicon" value="<?php echo get_option('favicon'); ?>" />                                      
                        <span class="upload_or">OR</span>
                        <input id="favicon_button" type="button" value="Upload favicon" />
                    </div>                                                             
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>	                         
                </form>
			<!-- end of header settings -->                
			</div>
            <div id="header-settings">
            	<?php if ( isset($_POST['header-settings']) && $_POST['header-settings'] == 'true') { header_settings_update(); } ?> 
            	<form method="post" action="#header-settings" class="transform">  
                	<input type="hidden" name="header-settings" value="true" />             
                    <div class="table-row clearfix">
                        <label for="headertoolbar">Use header toolbox:</label>
                        <select name="headertoolbar">
                            <?php $headertoolbar = get_option('headertoolbar'); ?>
                            <option value="yes" <?php if ($headertoolbar=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($headertoolbar=='no') { echo 'selected'; } ?> >No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the area above the header that can contain custom links, social network menu or the Search form." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="headertoolbarmenu">Use header toolbox menu:</label>
                        <select name="headertoolbarmenu">
                            <?php $headertoolbarmenu = get_option('headertoolbarmenu'); ?>
                            <option value="yes" <?php if ($headertoolbarmenu=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($headertoolbarmenu=='no') { echo 'selected'; } ?> >No</option>
                        </select> 
                    </div>                               
                    <div class="table-row clearfix">
                        <label for="headersearch">Use header toolbox search:</label>
                        <select name="headersearch">
                            <?php $headersearch = get_option('headersearch'); ?>
                            <option value="yes" <?php if ($headersearch=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($headersearch=='no') { echo 'selected'; } ?> >No</option>
                        </select> 
                    </div>
                    <div class="table-row clearfix">
                        <label for="headerpattern">Header pattern</label>
                        <select name="headerpattern">
                            <?php $headerpattern = get_option('headerpattern'); ?>
                            <option value="" <?php if ($headerpattern=='') { echo 'selected'; } ?> >No pattern</option>
                            <option value="header-pattern-dot" <?php if ($headerpattern=='header-pattern-dot') { echo 'selected'; } ?> >Dots</option>
                            <option value="header-pattern-spaced-dot" <?php if ($headerpattern=='header-pattern-spaced-dot') { echo 'selected'; } ?> >Dots [ spaced ]</option> 
                            <option value="header-pattern-diagonal-left-dotted" <?php if ($headerpattern=='header-pattern-diagonal-left-dotted') { echo 'selected'; } ?> >Dots [ left diagonal ]</option>
                            <option value="header-pattern-diagonal-right-dotted" <?php if ($headerpattern=='header-pattern-diagonal-right-dotted') { echo 'selected'; } ?> >Dots [ right diagonal ]</option>                                
                            <option value="header-pattern-diagonal-left" <?php if ($headerpattern=='header-pattern-diagonal-left') { echo 'selected'; } ?> >Diagonal [ left ]</option>
                            <option value="header-pattern-diagonal-right" <?php if ($headerpattern=='header-pattern-diagonal-right') { echo 'selected'; } ?> >Diagonal [ right ]</option> 
                            <option value="header-pattern-x" <?php if ($headerpattern=='header-pattern-x') { echo 'selected'; } ?> >[ x ]</option>                                                                                                        
                            <option value="header-pattern-plus" <?php if ($headerpattern=='header-pattern-plus') { echo 'selected'; } ?> >[ + ]</option>
                            <option value="header-pattern-metal" <?php if ($headerpattern=='header-pattern-metal') { echo 'selected'; } ?> >Metal</option>
                            <option value="header-pattern-box-1" <?php if ($headerpattern=='header-pattern-box-1') { echo 'selected'; } ?> >Box [ 1 ]</option>
                            <option value="header-pattern-box-2" <?php if ($headerpattern=='header-pattern-box-2') { echo 'selected'; } ?> >Box [ 2 ]</option>
                            <option value="header-pattern-grid-1" <?php if ($headerpattern=='header-pattern-grid-1') { echo 'selected'; } ?> >Grid [ 1 ]</option>
                            <option value="header-pattern-grid-2" <?php if ($headerpattern=='header-pattern-grid-2') { echo 'selected'; } ?> >Grid [ 2 ]</option> 
                            <option value="header-pattern-grid-1" <?php if ($headerpattern=='header-pattern-grid-1') { echo 'selected'; } ?> >Grid [ 1 ]</option>
                            <option value="header-pattern-diagonal-grid" <?php if ($headerpattern=='header-pattern-diagonal-grid') { echo 'selected'; } ?> >Grid [ diagonal ]</option> 
                            <option value="header-pattern-vertical-lines" <?php if ($headerpattern=='header-pattern-vertical-lines') { echo 'selected'; } ?> >Lines [ vertical ]</option> 
                            <option value="header-pattern-horizontal-lines" <?php if ($headerpattern=='header-pattern-horizontal-lines') { echo 'selected'; } ?> >Lines [ horizontal ]</option> 
                            <option value="header-pattern-vertical-zigzag" <?php if ($headerpattern=='header-pattern-vertical-zigzag') { echo 'selected'; } ?> >Zig Zag [ vertical ]</option>
                            <option value="header-pattern-horizontal-zigzag" <?php if ($headerpattern=='header-pattern-horizontal-zigzag') { echo 'selected'; } ?> >Zig Zag [ horizontal ]</option>                                                                                                
                        </select>
                        <img class="hint-icon" title="Choose a pattern that will be applied on the header's background." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />               	                                                                                                                                                                               
                    </div>
                    <div class="table-row clearfix">
                        <label for="headerlogo">Logo URL</label>
                        <input type="text" size="50" id="headerlogo" name="headerlogo" value="<?php echo get_option('headerlogo'); ?>" />                                      
                        <span class="upload_or">OR</span>
                        <input id="headerlogo_button" type="button" value="Upload logo" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="headerlogovertical">Logo vertical alignment</label>
                        <input type="text" size="4" id="headerlogovertical" name="headerlogovertical" value="<?php echo get_option('headerlogovertical'); ?>" />                                      
                        <div id="headerlogoverticalslider"></div>
                        <img class="hint-icon" title="Distance between the logo and the top of the header." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>  
                    <div class="table-row clearfix">
                        <label for="headerlogohorizontal">Logo horizontal alignment</label>
                        <input type="text" size="4" id="headerlogohorizontal" name="headerlogohorizontal" value="<?php echo get_option('headerlogohorizontal'); ?>" />                                      
                        <div id="headerlogohorizontalslider"></div>
                        <img class="hint-icon" title="Distance between the logo and the left side of the header." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                        
                    </div>                                        
                    <div class="table-row clearfix">
                        <label for="mainmenu">Main menu style</label>
                        <select name="mainmenu">
                            <?php $mainmenu = get_option('mainmenu'); ?>
                            <option value="with-description" <?php if ($mainmenu=='with-description') { echo 'selected'; } ?> >With descripton</option>                                        
                            <option value="without-description" <?php if ($mainmenu=='without-description') { echo 'selected'; } ?> >Without descripton</option>                                            
                        </select>               
                    </div>
                    <div class="table-row clearfix">            
                        <label for="deviantart">Deviantart URL:</label>
                        <input type="text" size="50" name="deviantart" value="<?php echo get_option('deviantart'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="facebook">Facebook URL:</label>
                        <input type="text" size="50" name="facebook" value="<?php echo get_option('facebook'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="flickr">Flickr URL:</label>
                        <input type="text" size="50" name="flickr" value="<?php echo get_option('flickr'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="myspace">Myspace URL:</label>
                        <input type="text" size="50" name="myspace" value="<?php echo get_option('myspace'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="rss">RSS URL:</label>
                        <input type="text" size="50" name="rss" value="<?php echo get_option('rss'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="twitter">Twitter URL:</label>
                        <input type="text" size="50" name="twitter" value="<?php echo get_option('twitter'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="vimeo">Vimeo URL:</label>
                        <input type="text" size="50" name="vimeo" value="<?php echo get_option('vimeo'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="youtube">Youtube URL:</label>
                        <input type="text" size="50" name="youtube" value="<?php echo get_option('youtube'); ?>" />              
                    </div>                                                                                                                                                                                    
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />
                        <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />		
                    </div>	                         
				</form>                         
			<!-- end of header settings -->
            </div>
            <div id="footer-settings">
            	<?php if ( isset($_POST['footer-settings']) && $_POST['footer-settings'] == 'true') { footer_settings_update(); } ?> 
            	<form method="post" action="#footer-settings" class="transform"> 
					<input type="hidden" name="footer-settings" value="true" />                 
                    <div class="table-row clearfix">
                        <label for="footer">Use footer:</label>
                        <select name="footer">
                            <?php $footer = get_option('footer'); ?>
                            <?php if ( $footer == '' ) $footer = 'yes'; else $footer = get_option('footer'); ?>                        
                            <option value="yes" <?php if ($footer=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($footer=='no') { echo 'selected'; } ?> >No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the footer completely." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div> 
                    <?php if ( $footer == 'yes' ) : ?>
                        <div class="table-row clearfix">
                            <label for="footerpartners">Use footerpartners:</label>
                            <select name="footerpartners">
                                <?php $footerpartners = get_option('footerpartners'); ?>
                                <?php if ( $footerpartners == '' ) $footerpartners = 'yes'; else $footerpartners = get_option('footerpartners'); ?> 
                                <option value="yes" <?php if ($footerpartners=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                                <option value="no" <?php if ($footerpartners=='no') { echo 'selected'; } ?> >No</option>
                            </select> 
                        </div>   
                        <?php if ( $footerpartners == 'yes' ): ?>
                            <div class="table-row clearfix">            
                                <label for="footerpartnerstitle">Parters title:</label>
                                <input type="text" size="50" name="footerpartnerstitle" value="<?php echo get_option('footerpartnerstitle'); ?>" />              
                            </div>  
                            <div class="table-row clearfix">            
                                <label for="footerpartnerscontent">Partners content:</label>
                                <textarea cols="60" rows="15" name="footerpartnerscontent"><?php echo get_option('footerpartnerscontent'); ?></textarea>            
                                <img class="hint-icon" title="Here you can add your partners' logos in this format: [partner logo=URL_TO_IMG link=URL_TO_WEBSITE]" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                            </div>
                        <?php endif; ?>                                                                                 	
                        <div class="table-row clearfix">
                            <label for="footertabs">Use footertabs:</label>
                            <select name="footertabs">
                                <?php $footertabs = get_option('footertabs'); ?>
                                <option value="yes" <?php if ($footertabs=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                                <option value="no" <?php if ($footertabs=='no') { echo 'selected'; } ?> >No</option>
                            </select> 
                        </div>  
                        <?php if ( $footertabs == 'yes' ): ?>
                            <div class="table-row clearfix">
                                <label for="footertabsrows">Footer tabs rows:</label>
                                <select name="footertabsrows">
                                    <?php $footertabsrows = get_option('footertabsrows'); ?>
                                    <option value="one-half" <?php if ($footertabsrows=='one-half') { echo 'selected'; } ?> >2 Columns</option>                                
                                    <option value="one-third" <?php if ($footertabsrows=='one-third') { echo 'selected'; } ?> >3 Columns</option>
                                    <option value="one-forth" <?php if ($footertabsrows=='one-forth') { echo 'selected'; } ?> >4 Columns</option>                                 
                                </select> 
                            </div>                    
                        <?php endif; ?>               
                        <div class="table-row clearfix">
                            <label for="subfooter">Use sub-footer:</label>
                            <select name="subfooter">
                                <?php $subfooter = get_option('subfooter'); ?>
                                <option value="yes" <?php if ($subfooter=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                                <option value="no" <?php if ($subfooter=='no') { echo 'selected'; } ?> >No</option>
                            </select> 
                        </div> 
                        <?php if ( $subfooter == 'yes' ) : ?>
                            <div class="table-row clearfix">            
                                <label for="copyright">Copyright text:</label>
                                <textarea cols="50" rows="3" name="copyright"><?php echo get_option('copyright'); ?></textarea>            
                            </div>    
                        <?php endif; ?> 	                         
                    <?php endif; ?>
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />
                        <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />		
                    </div>                    
				</form>                                 
            <!-- end of footer settings -->
            </div>
            <div id="single-settings">
            	<?php if ( isset($_POST['single-settings']) && $_POST['single-settings'] == 'true') { single_settings_update(); } ?>  
            	<form method="post" action="#single-settings" class="transform">
	                <input type="hidden" name="single-settings" value="true" /> 
                    <div class="table-row clearfix">
                        <label for="postmeta">Enable meta:</label>
                        <select name="postmeta">
                            <?php $postmeta = get_option('postmeta'); ?>
                            <option value="yes" <?php if ($postmeta=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($postmeta=='no') { echo 'selected'; } ?> >No</option>
                        </select> 
                    </div>
                    <div class="table-row clearfix">
                        <label for="posttopimage">Enable top image:</label>
                        <select name="posttopimage">
                            <?php $posttopimage = get_option('posttopimage'); ?>
                            <option value="yes" <?php if ($posttopimage=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($posttopimage=='no') { echo 'selected'; } ?> >No</option>
                        </select> 
                    </div>
                    <div class="table-row clearfix">
                        <label for="postsidebar">Disable sidebar:</label>
                        <select name="postsidebar">
                            <?php $postsidebar = get_option('postsidebar'); ?>
                            <option value="no" <?php if ($postsidebar=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($postsidebar=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>                                                            
                    <div class="table-row clearfix">
                        <label for="relatedposts">Related items:</label>
                        <select name="relatedposts">
                            <?php $relatedposts = get_option('relatedposts'); ?>
                            <option value="yes" <?php if ($relatedposts=='off') { echo 'selected'; } ?> >Off</option>
                            <option value="tags" <?php if ($relatedposts=='tags') { echo 'selected'; } ?> >Tags related</option>
                            <option value="category" <?php if ($relatedposts=='category') { echo 'selected'; } ?> >Category related</option>                            
                        </select>
                        <img class="hint-icon" title="Choose the type of the articles showed in the Related posts' section." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="relatedpostsnumber">Related items number:</label>
                        <input type="text" size="10" name="relatedpostsnumber" value="<?php echo get_option('relatedpostsnumber'); ?>" />              
                    </div>    
                    <div class="table-row clearfix">
                        <label for="sharing">Enable sharing:</label>
                        <select name="sharing">
                            <?php $sharing = get_option('sharing'); ?>
                            <option value="yes" <?php if ($sharing=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($sharing=='no') { echo 'selected'; } ?> >No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the sharing section on the posts' pages." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" /> 
                    </div> 
                    <div class="table-row clearfix">
                        <label for="comments">Enable comments:</label>
                        <select name="comments">
                            <?php $comments = get_option('comments'); ?>
                            <option value="yes" <?php if ($comments=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($comments=='no') { echo 'selected'; } ?> >No</option>
                        </select> 
                    </div>                                                                          
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>                
				</form>                    	                
            <!-- end of single settins -->
            </div>                                             
            <div id="advanced-settings">
            	<?php if ( isset($_POST['advanced-settings']) && $_POST['advanced-settings'] == 'true') { advanced_settings_update(); } ?>
            	<form method="post" action="#advanced-settings" class="transform"> 
					<input type="hidden" name="advanced-settings" value="true" />
                    <div class="table-row clearfix">
                        <label for="maincss">Use compressed css:</label>
                        <select name="maincss">
                            <?php $maincss = get_option('maincss'); ?>
                            <option value="yes" <?php if ($maincss=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($maincss=='no') { echo 'selected'; } ?> >No</option>
                        </select> 
                    </div>                      
                    <div class="table-row clearfix">            
                        <label for="customcss">Custom css:</label>
                        <textarea cols="50" rows="15" name="customcss"><?php echo get_option('customcss'); ?></textarea>           
                        <img class="hint-icon" title="Here you can add your custom CSS rules." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="google_analytics">Google analytics code:</label>
                        <textarea cols="50" rows="15" name="google_analytics"><?php echo get_option('google_analytics'); ?></textarea>           
                        <img class="hint-icon" title="If it's needed, you can insert your Google analytics code here." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                                             
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>
				</form>                    	                
            <!-- end of advanced settins -->
            </div>                
        </div>        
    </form> 
<!--end of wrap -->    
</div>
<?php } ?>