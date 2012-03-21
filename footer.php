<?php /* FOOTER TEMPLATE */ ?>
<!-- end of wrapper -->
</div>
<?php $footer = get_option('footer'); ?>
<?php if ( $footer == '' ) $footer = 'no'; else $footer = get_option('footer'); ?>
<?php if ( $footer == 'yes') : ?>
	<?php $footerpartners = get_option('footerpartners'); ?>
	<?php $footertabs = get_option('footertabs'); ?>    
    <?php if ( $footerpartners == '' ) $footerpartners = 'no'; else $footerpartners = get_option('footerpartners'); ?>
    <?php if ( $footertabs == '' ) $footertabs = 'yes'; else $footertabs = get_option('footertabs'); ?>	      
    <div id="footer-wrapper"<?php if ( $footertabs == 'no' && $footerpartners == 'no' ) echo ' class="footer-wrapper-no-content"'; ?>>
        <div id="footer-inner"<?php if ( $footertabs == 'no' && $footerpartners == 'no' ) echo ' class="footer-inner-no-content"'; ?>>
            <?php if ( $footerpartners == 'yes' ) : ?>
            	<?php $content = get_option('footerpartnerscontent'); ?>   
				<?php if ( $content != '' ) : ?>      
                    <div id="footer-partners-wrapper">
                        <h3><?php echo get_option('footerpartnerstitle'); ?></h3>
                        <div id="footer-partners-inner">             
                            <div id="footer-partners">
                                <ul>
                                    <?php 
                                        echo do_shortcode( $content );
                                    ?> 
                                </ul>
                            <!-- end of footer partners -->
                            </div>
                        <!-- end of footer partners wrapper -->
                        </div>            
                    <!-- end of footer partners wrapper -->
                    </div>
                <?php endif; ?>
			<?php endif; ?>                
            <?php if ( $footertabs == 'yes' ): ?>	
            	<?php $footertabsrows = get_option('footertabsrows'); ?>	
                <?php if ( $footertabsrows == '' ) $footertabsrows = 'one-third'; else $footertabsrows = get_option('footertabsrows'); ?>	        
                <div id="footer-tabs"<?php if ( $footerpartners == 'no' ) echo ' class="footer-tabs-no-partners"'; ?>>
                	<?php if ( $footertabsrows == 'one-forth' || $footertabsrows == 'one-third' || $footertabsrows == 'one-half' ) : ?>
						<?php if ( is_active_sidebar( 'footer-tabs-1' ) ) : ?>
                            <div class="tab <?php echo $footertabsrows; ?>">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-1' ); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
					<?php if ( $footertabsrows == 'one-forth' || $footertabsrows == 'one-third' || $footertabsrows == 'one-half' ) : ?>                    
						<?php if ( is_active_sidebar( 'footer-tabs-2' ) ) : ?>
                            <div class="tab <?php echo $footertabsrows; ?>">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-2' ); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ( $footertabsrows == 'one-forth' || $footertabsrows == 'one-third' ) : ?>
						<?php if ( is_active_sidebar( 'footer-tabs-3' ) ) : ?>
                            <div class="tab <?php echo $footertabsrows; ?>">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-3' ); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ( $footertabsrows == 'one-forth' ) : ?>
						<?php if ( is_active_sidebar( 'footer-tabs-4' ) ) : ?>
                            <div class="tab <?php echo $footertabsrows; ?>">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-4' ); ?>
                                </ul>
                            </div>
                        <?php endif; ?> 
                    <?php endif; ?>                                                            
                <!-- end of footer-tabs -->
                </div>
            <?php endif; ?>
			<?php $subfooter = get_option('subfooter'); ?>
            <?php if ( $subfooter == '' ) $subfooter = 'yes'; else $subfooter = get_option('subfooter'); ?>
            <?php if ( $subfooter == 'yes') : ?>            
                <div class="sep"></div>
                <div id="sub-footer-wrapper">
                    <div id="sub-footer">
                        <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'fallback_cb' => '', 'theme_location' => 'footer', 'show_home' => false ) ); ?>
                        <div id="copyright">
							<?php 
								$copyright = get_option('copyright');
								if ( $copyright == '' ) $copyright = 'created by <a href="http://www.duotive.com">duotive</a>';
								else $copyright = get_option('copyright'); 
								echo $copyright;
							?>
                        <!-- end of copyright -->
                        </div>
                    <!-- end of sub-footer -->
                    </div>
                <!-- end of sub-footer wrapper -->
                </div>
            <?php endif; ?>        
    
        <!-- end of footer inner -->
        </div>
    <!-- end of footer wrapper -->
    </div>
<?php endif; ?>    
	<?php wp_footer(); ?>
    
    <?php if ( !is_page_template('images-duotive-gallery-3.php') && !is_page_template('images-duotive-gallery-4.php') && !is_page_template('images-duotive-gallery-5.php') && !is_page_template('images-duotive-gallery-6.php') ) :?>
		<?php $slidertype =  get_option('slidertype'); if ( $slidertype == '' ) $slidertype='content'; else $slidertype =  get_option('slidertype'); ?>
        <?php if ( $slidertype == 'complex-slider' ): ?> 
            <?php $controls =  get_option('slidercomplexarrowcontrols'); if ( $controls == '' ) $controls = 1; else $controls =  get_option('slidercomplexarrowcontrols');  ?>	    
            <?php $gallery =  get_option('slidercomplexgallery'); if ( $gallery == '' ) $gallery = 1; else $gallery =  get_option('slidercomplexgallery');  ?>	
            <?php $description =  get_option('slidercomplexdescription'); if ( $description == '' ) $description = 1; else $description =  get_option('slidercomplexdescription');  ?>        
            <?php $duration =  get_option('slidercomplexduration'); if ( $duration == '' ) $duration = 1000; else $duration =  get_option('slidercomplexduration');  ?>        
            <?php $interval =  get_option('slidercomplexinterval'); if ( $interval == '' ) $interval = 4000; else $interval =  get_option('slidercomplexinterval');  ?>                        
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/duotive-slideshows/duotive-slider-complex.js"></script>     	       
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/get-slideshow-js.php?type=complex&amp;gallery=<?php echo $gallery; ?>&amp;description=<?php echo $description; ?>&amp;controls=<?php echo $controls; ?>&amp;duration=<?php echo $duration; ?>&amp;interval=<?php echo $interval; ?>"></script>            
        <?php endif; ?> 
        <?php if ( $slidertype == 'presentation-slider' ): ?> 
            <?php $controls =  get_option('sliderpresentationarrowcontrols'); if ( $controls == '' ) $controls = 1; else $controls =  get_option('sliderpresentationarrowcontrols');  ?>	    
            <?php $description =  get_option('sliderpresentationdescription'); if ( $description == '' ) $description = 1; else $description =  get_option('sliderpresentationdescription');  ?>
            <?php $hide =  get_option('sliderpresentationhide'); if ( $hide == '' ) $hide = 1; else $hide =  get_option('sliderpresentationhide');  ?>                 
            <?php $duration =  get_option('sliderpresentationduration'); if ( $duration == '' ) $duration = 1000; else $duration =  get_option('sliderpresentationduration');  ?>        
            <?php $interval =  get_option('sliderpresentationinterval'); if ( $interval == '' ) $interval = 8000; else $interval =  get_option('sliderpresentationinterval');  ?>                                
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/duotive-slideshows/duotive-slider-presentation.js"></script>     	       
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/get-slideshow-js.php?type=presentation&amp;controls=<?php echo $controls; ?>&amp;duration=<?php echo $duration; ?>&amp;interval=<?php echo $interval; ?>&amp;description=<?php echo $description; ?>&amp;hide=<?php echo $hide; ?>"></script>            
        <?php endif; ?>
        <?php if ( $slidertype == 'fullwidth-slider' ): ?>
            <?php $controls =  get_option('sliderfullwidtharrowcontrols'); if ( $controls == '' ) $controls = 1; else $controls =  get_option('sliderfullwidtharrowcontrols');  ?>	    
            <?php $gallery =  get_option('sliderfullwidthgallery'); if ( $gallery == '' ) $gallery = 1; else $gallery =  get_option('sliderfullwidthgallery');  ?>
            <?php $titles =  get_option('sliderfullwidthtitles'); if ( $titles == '' ) $titles = 1; else $titles =  get_option('sliderfullwidthtitles');  ?> 
            <?php $contentbox =  get_option('sliderfullwidthcontentbox'); if ( $contentbox == '' ) $contentbox = 1; else $contentbox =  get_option('sliderfullwidthcontentbox');  ?>                	            
            <?php $duration =  get_option('sliderfullwidthduration'); if ( $duration == '' ) $duration = 1000; else $duration =  get_option('sliderfullwidthduration');  ?>        
            <?php $interval =  get_option('sliderfullwidthinterval'); if ( $interval == '' ) $interval = 8000; else $interval =  get_option('sliderfullwidthinterval');  ?>                                
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/duotive-slideshows/duotive-slider-fullwidth.js"></script> 
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/get-slideshow-js.php?type=fullwidth&amp;controls=<?php echo $controls; ?>&amp;gallery=<?php echo $gallery; ?>&amp;titles=<?php echo $titles; ?>&amp;contentbox=<?php echo $contentbox; ?>&amp;duration=<?php echo $duration; ?>&amp;interval=<?php echo $interval; ?>"></script>                   
        <?php endif; ?>     
        <?php if ( $slidertype == 'gallery-slider' ): ?> 
            <?php $controls =  get_option('slidergalleryarrowcontrols'); if ( $controls == '' ) $controls = 1; else $controls =  get_option('slidergalleryarrowcontrols');  ?>	        
            <?php $description =  get_option('slidergallerydescription'); if ( $description == '' ) $description = 1; else $description =  get_option('slidergallerydescription');  ?>        
            <?php $duration =  get_option('slidergalleryduration'); if ( $duration == '' ) $duration = 1000; else $duration =  get_option('slidergalleryduration');  ?>        
            <?php $interval =  get_option('slidergalleryinterval'); if ( $interval == '' ) $interval = 7500; else $interval =  get_option('slidergalleryinterval');  ?>                                        
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/duotive-slideshows/duotive-slider-gallery.js"></script> 
            <script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/get-slideshow-js.php?type=gallery&amp;controls=<?php echo $controls; ?>&amp;description=<?php echo $description; ?>&amp;duration=<?php echo $duration; ?>&amp;interval=<?php echo $interval; ?>"></script>                   
        <?php endif; ?>
    <?php endif; ?>                        
    <?php if ( is_page_template('images-duotive-gallery-3.php') || is_page_template('images-duotive-gallery-4.php') || is_page_template('images-duotive-gallery-5.php') || is_page_template('images-duotive-gallery-6.php') ) :?>
		<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/duotive-slideshows/duotive-full-width-gallery.js"></script>    
        <script type="text/javascript">
			window.addEvent('load', function(){
				var dtSlideshow = new dtFullWidthGallery({
					container: $('fullWidthGallery'),
					arrowControls: true,
					transitionDuration: 1000,
					transitionInterval: 4000,
					<?php if ( is_page_template('images-duotive-gallery-3.php') ) echo 'thumbLiWidth:318'; ?>
					<?php if ( is_page_template('images-duotive-gallery-4.php') ) echo 'thumbLiWidth:240'; ?>
					<?php if ( is_page_template('images-duotive-gallery-5.php') ) echo 'thumbLiWidth:192'; ?>					
					<?php if ( is_page_template('images-duotive-gallery-6.php') ) echo 'thumbLiWidth:160'; ?>
				});
			});
        </script>    
    <?php endif; ?> 
</body>
</html>
