<?php
/*
Template Name: Portfolio - Sidebar - Slideshow - 2
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php
        $content = get_the_content();
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
		$title = get_the_title();
	?>       
<?php endwhile; ?>
<?php $portfolios = portfolio_require(); ?>
<?php $pagination = get_option('portfolio-sidebar-slideshow-2'); ?>
<?php foreach ( $portfolios as $portfolio) :?>
    <?php if ( is_page($portfolio->PAGE)): ?>
            <div id="content-wrapper">
				<?php get_sidebar(); ?>
                <div id="content">  	
				<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
                <?php if ( $slider_display == 0 ) : ?>                  
                    <h1 class="page-title">
                    	<?php echo $title; ?>
                    </h1>            
                <?php endif; ?>
				<?php if ($post->post_parent): ?>
                	<?php $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); ?>
                <?php else: ?>
                	<?php $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0"); ?>  
				<?php endif; ?>                   
				<?php if ($children) : ?>
                    <ul class="portfolio-sub-pages">
                    	<?php if ( $post->post_parent == 0 ) : ?>
                    		<li class="current_page_item"><a href="<?php echo the_permalink(); ?>"><?php echo __('View all','duotive'); ?></a></li>
						<?php else: ?>
                        	<?php $permalink = get_permalink($post->post_parent); ?>
                        	<li><a href="<?php echo $permalink; ?>"><?php echo __('View all','duotive'); ?></a></li>                            
                        <?php endif; ?>
                   		<?php echo $children; ?>
                    </ul>
                <?php endif; ?>
            	<?php if ( $content != '' ): ?>
                	<div class="portfolio-description">
	            		<?php echo $content; ?>
                    <!-- end of portfolio description -->
                    </div>
                <?php endif; ?>
	                <?php $transition = get_option('portfolio-sidebar-slideshow-2-transition'); ?>
                    <?php if ( $transition == '' ) $transition = 'random'; else $transition = get_option('portfolio-sidebar-slideshow-2-transition'); ?>
                    <script type="text/javascript">
						jQuery(document).ready(function($) {
							jQuery(".portfolio-slideshow").nivoSlider({effect:'<?php echo $transition; ?>',slices:6,animSpeed:500,pauseTime:3000,startSlide:0,directionNav:true,directionNavHide:false,controlNav:false,keyboardNav:false,manualAdvance:true, customChange: function(){}});		
						});					
					</script>                
				<?php 
                    global $more;
                    $more = 0;
					$counter = 1;
                    if ( is_front_page () ) $paged = get_query_var( 'page' );
                    $wp_query = new WP_Query('post_type=post&posts_per_page='.$pagination.'&cat='.$portfolio->CATEGORY.'&paged=' . $paged);
                    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
                ?>      
                	<div class="portfolio-two-column-slideshow<?php if ( $counter%2 == 0) echo ' portfolio-two-column-slideshow-last'; ?>">
						<?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );  ?>
                        <div class="portfolio-slideshow">
							<?php foreach ( $attached_images as $attached_image ): ?>
								<?php $thumbnail_src = wp_get_attachment_url($attached_image->ID); ?>
                                <?php $website_url = get_bloginfo('wpurl'); ?>
                                <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                    
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=340&amp;w=300&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />                            
                            <?php endforeach; ?>
                        </div>
                        <h2>
                            <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h2>                           
                        <div class="portfolio-content">
                            <?php the_content(''); ?>
                            <a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo __('Read More &#187;','duotive'); ?></a>
                        </div>
                    </div>
                    <?php if ( $counter%2 == 0 && $counter != $pagination) echo '<div class="line-sep"></div>'; ?>
                    <?php $counter++; ?>
                <?php endwhile;endif;?>
				<?php if(function_exists('wp_pagenavi')): ?>
                    <div id="navigation">
                        <?php wp_pagenavi();?>  
                    </div>                    
                <?php endif; ?>                          
                <!-- end of content -->
                </div>
			<!-- end of content wrapper -->                
			</div>   
	<?php endif;?>          
<?php endforeach;?>
<?php get_footer(); ?>