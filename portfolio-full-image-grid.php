<?php
/*
Template Name: Portfolio - Full - Image Grid
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
<?php $pagination = get_option('portfolio-full-imagegrid'); ?>
<?php foreach ( $portfolios as $portfolio) :?>
    <?php if ( is_page($portfolio->PAGE)): ?>
            <div id="content-wrapper">
                <div id="content" class="content-full-width">	
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
				<?php 
                    global $more;
                    $more = 0; 
                    if ( is_front_page () ) $paged = get_query_var( 'page' );
                    $wp_query = new WP_Query('post_type=post&posts_per_page='.$pagination.'&cat='.$portfolio->CATEGORY.'&paged=' . $paged);
                    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
                ?>      
                	<div class="portfolio-grid-wrapper">
                        <h2>
                            <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h2>                     
						<?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );  ?>
                        <div class="portfolio-grid">
                        	<?php $image_counter = 1; ?>
							<?php foreach ( $attached_images as $attached_image ): ?>
								<?php $thumbnail_src = wp_get_attachment_url($attached_image->ID); ?>
                                <a class="tooltip-title<?php if ( $image_counter%4 == 0 ) echo ' image-grid-last'; ?>" href="<?php echo $thumbnail_src; ?>" rel="portfolio[modal]" title="<?php $title = $attached_image->post_content; if ( $title != '' ) echo $title; else echo 'Please add image description in wordpress admin panel.' ?>">                                   
									<?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                 
	                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=159&amp;w=238&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />                            
                                </a>
                                <?php $image_counter++; ?>
                            <?php endforeach; ?>
                        </div> 
                        <a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo __('Read More &#187;','duotive'); ?></a>                            
                                               
                    </div>
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