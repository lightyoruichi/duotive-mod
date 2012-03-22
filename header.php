<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php load_theme_textdomain('duotive');?>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php $favicon = get_option('favicon'); if ( $favicon != '' ) echo ' <link rel="shortcut icon" href="'.$favicon.'" />'; ?>
	<?php wp_head(); ?>
    <?php $template_url = get_bloginfo( 'template_url' ); ?>
    <?php $maincss = get_option('maincss'); if ( $maincss == '' ) $maincss = 'yes'; else $maincss = get_option('maincss'); ?>
    <?php if ( $maincss == 'no' ) : ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/style.css" />
    <?php else : ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/style.min.css" />
    <?php endif; ?>
	<?php if ( isset($_SERVER['HTTP_USER_AGENT']) ):  ?>
        <?php if ( ereg('MSIE 8.0',$_SERVER['HTTP_USER_AGENT']) ) : ?>
            <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/ie8-only.css" />
        <?php endif; ?>
    <?php endif; ?> 
	<?php if ( isset($_SERVER['HTTP_USER_AGENT']) ):  ?>
        <?php if ( ereg('MSIE 7.0',$_SERVER['HTTP_USER_AGENT']) ) : ?>
            <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/ie7-only.css" />
        <?php endif; ?>
    <?php endif; ?>        
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/fonts.php" />    
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/slideshows/nivo-slider-general.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/main-theme-light.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/utilities/prettyPhoto.css" />    
    <!-- GET THE SLIDERS CSS -->
    <?php $slidertype =  get_option('slidertype'); if ( $slidertype == '' ) $slidertype='static-image'; else $slidertype =  get_option('slidertype'); ?>
    <?php switch ( $slidertype ) {
    	case 'static-image':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/static-slider.css" />';
        break; 			
    	case 'content':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/content-slider.css" />';
        break;
    	case 'accordion':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/accordion-slider.css" />';
        break; 	
    	case 'nivo':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/nivo-slider.css" />';
        break; 			
    	case 'presentation-slider':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/presentation-slider.css" />';
        break; 
    	case 'complex-slider':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/complex-slider.css" />';
        break; 
    	case 'gallery-slider':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/gallery-slider.css" />';
        break; 	
    	case 'fullwidth-slider':
    		echo '<link rel="stylesheet" type="text/css" media="all" href="'.$template_url.'/css/slideshows/fullwidth-slider.css" />';
        break; 			
  	} ?>    
    <!-- GET THE THEMES COLOR AND BACKGROUND -->
    <?php $themecolor =  get_option('themecolor'); ?>
    <?php if ( $themecolor == '' ) $themecolor = 'db6e0d'; ?>
    <?php $secondcolor =  get_option('secondcolor'); ?>
    <?php if ( $secondcolor == '' ) $secondcolor = 'db6e0d'; ?>    
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/skin.php?themecolor=<?php echo $themecolor; ?>&amp;secondcolor=<?php echo $secondcolor; ?>" />     
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_url; ?>/css/background-images.php?postid=<?php echo $wp_query->post->ID; ?>" />         
    <?php $customcss =  get_option('customcss'); ?>
    <?php if ( $customcss != '' ) : ?>
    <!-- GET CUSTOM CSS -->    
		<style>
            <?php echo $customcss; ?>
        </style>
	<?php endif; ?>
	<!-- GET THE SLIDER JAVASCRIPT -->
    <?php if ( $slidertype == '' ) $slidertype = 'content'; ?> 
    <?php if ( $slidertype == 'content' ): ?>
    	<?php $slidercontenttranstion =  get_option('slidercontenttranstion'); ?>
        <?php $slidercontentautoplay =  get_option('slidercontentautoplay'); ?>
        <?php $slidercontentspeed =  get_option('slidercontentspeed'); ?>
        <?php $slidercontentpause =  get_option('slidercontentpause'); ?>
        <?php if ( $slidercontenttranstion == '' ) $slidercontenttranstion = 'fade'; else $slidercontenttranstion =  get_option('slidercontenttranstion'); ?>
        <?php if ( $slidercontentautoplay == '' ) $slidercontentautoplay = 'true'; else $slidercontentautoplay =  get_option('slidercontentautoplay'); ?>
        <?php if ( $slidercontentspeed == '' ) $slidercontentspeed = '500'; else $slidercontentspeed =  get_option('slidercontentspeed'); ?> 
        <?php if ( $slidercontentpause == '' ) $slidercontentpause = '5000'; else $slidercontentpause =  get_option('slidercontentpause'); ?>                         
		<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/get-slideshow-js.php?type=<?php echo $slidertype; ?>&amp;transition=<?php echo $slidercontenttranstion; ?>&amp;auto=<?php echo $slidercontentautoplay; ?>&amp;speed=<?php echo $slidercontentspeed; ?>&amp;pause=<?php echo $slidercontentpause; ?>"></script>            
    <?php endif; ?> 
    <?php if ( $slidertype == 'accordion' ): ?> 
        <?php $slideraccordionsticky =  get_option('slideraccordionsticky'); ?> 
        <?php if ( $slideraccordionsticky == '' ) $slideraccordionsticky = 0; else $slideraccordionsticky =  get_option('slideraccordionsticky'); ?>                                    
        <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/jquery.kwicks.js"></script>
		<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/get-slideshow-js.php?type=<?php echo $slidertype; ?>&amp;sticky=<?php echo $slideraccordionsticky; ?>"></script>            
    <?php endif; ?> 
    <?php if ( $slidertype == 'nivo' ): ?>
        <?php $slidernivotransition =  get_option('slidernivotransition'); ?>
        <?php $slidernivoslices =  get_option('slidernivoslices'); ?>
        <?php $slidernivoboxcols =  get_option('slidernivoboxcols'); ?>
        <?php $slidernivoboxrows =  get_option('slidernivoboxrows'); ?>                
        <?php $slidernivoanimspeed =  get_option('slidernivoanimspeed'); ?>
        <?php $slidernivopausetime =  get_option('slidernivopausetime'); ?>
        <?php $slidernivodirectionnav =  get_option('slidernivodirectionnav'); ?>
        <?php $slidernivodirectionnavhide =  get_option('slidernivodirectionnavhide'); ?>  
        <?php $slidernivocontrolnav =  get_option('slidernivocontrolnav'); ?>                                        
        <?php if ( $slidernivotransition == '' ) $slidernivotransition = 'fade'; else $slidernivotransition =  get_option('slidernivotransition'); ?>  
        <?php if ( $slidernivoslices == '' ) $slidernivoslices = 8; else $slidernivoslices =  get_option('slidernivoslices'); ?>             
        <?php if ( $slidernivoboxcols == '' ) $slidernivoboxcols = 8; else $slidernivoboxcols =  get_option('slidernivoboxcols'); ?>             
        <?php if ( $slidernivoboxrows == '' ) $slidernivoboxrows = 8; else $slidernivoboxrows =  get_option('slidernivoboxrows'); ?>             
        <?php if ( $slidernivoanimspeed == '' ) $slidernivoanimspeed = 800; else $slidernivoanimspeed =  get_option('slidernivoanimspeed'); ?>                     
        <?php if ( $slidernivopausetime == '' ) $slidernivopausetime = 3000; else $slidernivopausetime =  get_option('slidernivopausetime'); ?>                             
        <?php if ( $slidernivodirectionnav == '' ) $slidernivodirectionnav = true; else $slidernivodirectionnav =  get_option('slidernivodirectionnav'); ?>                             
        <?php if ( $slidernivodirectionnavhide == '' ) $slidernivodirectionnavhide = true; else $slidernivodirectionnavhide =  get_option('slidernivodirectionnavhide'); ?>             
        <?php if ( $slidernivocontrolnav == '' ) $slidernivocontrolnav = true; else $slidernivocontrolnav =  get_option('slidernivocontrolnav'); ?>                                                                     
		<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/get-slideshow-js.php?type=<?php echo $slidertype; ?>&amp;transition=<?php echo $slidernivotransition; ?>&amp;slices=<?php echo $slidernivoslices; ?>&amp;boxrows=<?php echo $slidernivoboxrows; ?>&amp;boxcols=<?php echo $slidernivoboxcols; ?>&amp;animspeed=<?php echo $slidernivoanimspeed; ?>&amp;pausetime=<?php echo $slidernivopausetime; ?>&amp;directionnav=<?php echo $slidernivodirectionnav; ?>&amp;directionnavhide=<?php echo $slidernivodirectionnavhide; ?>&amp;controlnav=<?php echo $slidernivocontrolnav; ?>"></script>            
    <?php endif; ?>
    <!-- GET GOOGLE ANALYTICS CODE -->
    <?php $google_analytics =  get_option('google_analytics'); ?>
    <?php if ( $google_analytics != '' ) : ?>
            <?php echo $google_analytics; ?>
	<?php endif; ?> 
    <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>        
</head>
<body>
<?php $headertoolbar = get_option('headertoolbar'); ?>
<?php if ( $headertoolbar == '' ) $headertoolbar = 'yes'; else $headertoolbar = get_option('headertoolbar'); ?>
<?php if ( $headertoolbar == 'yes' ) : ?>
    <div id="toptoolbar-wrapper">
        <div id="toptoolbar">
        <a id="header-logo" href="<?php echo home_url( '/' ); ?>">
        <?php if ( $dt_headerLogo != '' ) : ?>
            <?php $vertical = get_option('dt_headerLogoVertical'); ?>
            <?php $horizontal = get_option('dt_headerLogoHorizontal'); ?>
            <?php if ( $vertical != '' && $horizontal != '' ) $class = ' style="margin-top:'.$vertical.'px; margin-left:'.$horizontal.'px;"'; ?>
            <img<?php echo $class; ?> src="<?php echo $dt_headerLogo; ?>" alt="<?php echo get_bloginfo('name'); ?>" />
        <?php endif; ?>
    </a>
			<?php $headertoolbarmenu = get_option('headertoolbarmenu'); ?>
            <?php if ( $headertoolbarmenu == '' ) $headertoolbarmenu = 'no'; else $headertoolbarmenu = get_option('headertoolbarmenu'); ?>
            <?php if ( $headertoolbarmenu == 'yes' ) : ?>
	            <?php wp_nav_menu( array( 'container_class' => 'mainmenu', 'fallback_cb' => '',  'show_home' => false ) ); ?>
            <?php endif; ?>
      		<?php $headersearch = get_option('headersearch'); ?>
            <?php if ( $headersearch == '' ) $headersearch = 'yes'; else $headersearch = get_option('headersearch'); ?>
            <?php if ( $headersearch == 'yes' ) : ?>          
                <form method="get" id="toptoolbarsearch" action="<?php echo bloginfo( 'wpurl' ); ?>">
                    <input class="searchbox" type="text" name="s" onFocus="if(this.value=='<?php echo __('Search...','duotive'); ?>') this.value='';" onBlur="if(this.value=='') this.value='<?php echo __('Search...','duotive'); ?>';" value="<?php echo __('Search...','duotive'); ?>" size="20" maxlength="20">
                    <input class="searchbutton" type="submit" value="&nbsp;" />
                </form> 
            <?php endif; ?>
            
            <?php if ( get_option('deviantart') != '' || get_option('facebook') != '' || get_option('flickr') != '' || get_option('myspace') != '' || get_option('rss') != '' || get_option('twitter') != '' || get_option('vimeo') != '' || get_option('youtube') != '' ): ?>
            <div id="toolbar-sharing">
            	<?php if ( get_option('deviantart') != '' ): ?>
                	<a href="<?php echo get_option('deviantart'); ?>" class="social-item deviantart" title="Deviantart" target="_blank">Deviantart</a>
				<?php endif; ?>
                <?php if ( get_option('facebook') != '' ): ?>                    
	                <a href="<?php echo get_option('facebook'); ?>" class="social-item facebook" title="Facebook" target="_blank">Facebook</a>	
				<?php endif; ?>	                    
				<?php if ( get_option('flickr') != '' ): ?>                    
                	<a href="<?php echo get_option('flickr'); ?>" class="social-item flickr" title="Flickr" target="_blank">Flickr</a>
				<?php endif; ?>	                    
				<?php if ( get_option('myspace') != '' ): ?>                
                	<a href="<?php echo get_option('myspace'); ?>" class="social-item myspace" title="Myspace" target="_blank">Myspace</a>
				<?php endif; ?>	                    
				<?php if ( get_option('rss') != '' ): ?>                
                	<a href="<?php echo get_option('rss'); ?>" class="social-item rss" title="RSS" target="_blank">RSS</a>
				<?php endif; ?>	                    
				<?php if ( get_option('twitter') != '' ): ?>                
                	<a href="<?php echo get_option('twitter'); ?>" class="social-item twitter" title="Twitter" target="_blank">Twitter</a>
				<?php endif; ?>	                    
				<?php if ( get_option('vimeo') != '' ): ?>                
                	<a href="<?php echo get_option('vimeo'); ?>" class="social-item vimeo" title="Vimeo" target="_blank">Vimeo</a>
				<?php endif; ?>	                    
				<?php if ( get_option('youtube') != '' ): ?>                
                	<a href="<?php echo get_option('youtube'); ?>" class="social-item youtube" title="Youtube" target="_blank">Youtube</a>
				<?php endif; ?>	
            <!-- end of toolbar sharing -->                                       
            </div>  
            <?php endif; ?>	                             
        <!-- end of top toolbar -->
        </div>
    <!-- end of top toolbar -->
    </div>
<?php endif; ?>
<div>
	<?php $headerpattern = get_option('headerpattern'); ?>
    <?php if ( $headerpattern == '' ) $headerpattern = ''; else $headerpattern = get_option('headerpattern'); ?>
	<div id="header-pattern" class="<?php echo $headerpattern; ?>">
    	<div id="header">
        	<?php $headerlogo = get_option('headerlogo'); ?>
            <a id="headerlogo" href="<?php echo home_url( '/' ); ?>">
				<?php if ( $headerlogo != '' ) : ?>
                	<?php $vertical = get_option('headerlogovertical'); ?>
                    <?php $horizontal = get_option('headerlogohorizontal'); ?>
                    <?php if ( $vertical != '' && $horizontal != '' ) $class = ' style="margin-top:'.$vertical.'px; margin-left:'.$horizontal.'px;"'; ?>
                    <img<?php echo $class; ?> src="<?php echo $headerlogo; ?>" />
                <?php else: ?>
                	<h1><?php bloginfo( 'name' ); ?></h1>
                <?php endif; ?>
        	</a>
 <nav id="mainmenu">
    	<ul class="menu-items-parent">
		    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s','fallback_cb' => 'false', 'walker' => new Walker_Nav_Menu() ) ); ?>

        </ul>
        <div class="highlight"></div>
        <div class="shadow"></div>
    </nav>               
        <!-- end of header -->
        </div>
    <!-- end of header pattern -->
    </div>
<!-- end of header wrapper -->
</div>
<?php $slider = get_option('slider'); ?>
<?php $slider_display = get_option('slider_display'); ?>
<?php if ( $slider == '' ) $slider = 'on'; else $slider = get_option('slider'); ?>
<?php if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>

<?php if ( $slider == 'on'): ?> 
	<?php if ( $slider_display == 1 ): ?>
        <?php if ( is_front_page() || is_page_template('front-page-business.php') || is_page_template('front-page-news.php') || is_page_template('front-page-posts.php') || is_page_template('front-page-presentation.php') ): ?>
            <div id="slideshow-wrapper">
	            <?php $sliderpattern = get_option('sliderpattern'); ?>
                <div id="slideshow-pattern" class="<?php echo $sliderpattern; ?>"></div>
                    <div id="slideshow-border-top">
                        <?php get_slider_code($slidertype); ?>                               
                    <!-- end of slideshow border top -->
                    </div>                  
            <!-- end of slideshow wrapper -->
            </div>
		<?php else: ?>
        	<div id="sub-header-content-wrapper">
            	<?php	
					$sliderpattern = get_option('sliderpattern');
					if ( isset($post->ID) ) $sub_header_pattern = get_post_meta($post->ID, "sub-header-pattern", true);
					if ( isset($sub_header_pattern) && $sub_header_pattern == 'inherit-from-slideshow'  ) $sub_header_pattern = $sliderpattern;
					if ( is_search() || is_author() || is_category() || is_tag() || is_archive() || is_404() ) $sub_header_pattern = $sliderpattern;
				?>
            		<div id="sub-header-content-pattern" class="<?php echo $sub_header_pattern; ?>"></div>
                	<div id="sub-header-color-overlay"></div>
                    <div id="sub-header-content">
						<?php echo get_title_outside_loop(); ?>                          
                    <!-- end of sub-header-content -->
                    </div>                       
            <!-- end of sub-header-content -->
            </div>            
        <?php endif; ?>            
    <?php else: ?> 
            <div id="slideshow-wrapper">
	            <?php $sliderpattern = get_option('sliderpattern'); if ( $sliderpattern == '' ) $sliderpattern = 'subheader-pattern-dot'; ?>
                <div id="slideshow-pattern" class="<?php echo $sliderpattern; ?>"></div>
                <div id="slideshow-border-top">
                    <?php get_slider_code($slidertype); ?>                               
                <!-- end of slideshow border top -->
                </div>                  
            <!-- end of slideshow wrapper -->
            </div>
    <?php endif; ?>
<?php else: ?>
    <div id="sub-header-content-wrapper">
        <?php	
            $sliderpattern = get_option('sliderpattern');
            $sub_header_pattern = get_post_meta($post->ID, "sub-header-pattern", true);
            if ( $sub_header_pattern == 'inherit-from-slideshow'  ) $sub_header_pattern = $sliderpattern;
            if ( is_search() || is_author() || is_category() || is_tag() || is_archive() || is_404() ) $sub_header_pattern = $sliderpattern;
        ?>
        <div id="sub-header-content-pattern" class="<?php echo $sub_header_pattern; ?>"></div>
        <div id="sub-header-color-overlay"></div>
        <div id="sub-header-content">
            <?php echo get_title_outside_loop(); ?>                          
        <!-- end of sub-header-content -->
        </div>                       
    <!-- end of sub-header-content -->
    </div>    
<?php endif; ?>
<div id="wrapper">