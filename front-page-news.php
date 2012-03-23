<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Frontpage News Layout
 */
?>
<?php get_header(); ?>
<div id="front-page-news-wrapper">
    <div id="front-page-news">
    	<div id="left-content">
        	<?php $fpn_latest_news_title = get_option('fpn_latest_news_title'); ?>
        	<?php if ( $fpn_latest_news_title != '' ): ?>
            	<h3><?php echo $fpn_latest_news_title; ?></h3>
            <?php endif;?>    
			<?php $fpn_latest_news_category = get_option('fpn_latest_news_category'); ?>
            <?php $fpn_latest_news_number = get_option('fpn_latest_news_number');?>            
			<?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fpn_latest_news_number.'&cat='.$fpn_latest_news_category); ?>
            <?php while ( $wp_query->have_posts() ) : ?>
                <?php $wp_query->the_post(); ?>
                    <div class="post">
                        <h3>
                            <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h3>                                              
						<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                        <?php $website_url = get_bloginfo('wpurl'); ?>
                        <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                        <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                            <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=174&amp;w=294&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                        </a>                
                        <?php global $more; $more = 0; the_content(__('Read More &#187;','duotive')); ?>
                    </div>                        
            <?php endwhile;?>
        <!-- end of left content -->
        </div>
        <div id="news-content-wrapper">
            <?php $fpn_sidebar = get_option('fpn_sidebar'); ?>
            <?php if ( $fpn_sidebar == '' ) $fpn_sidebar = 'yes'; else $fpn_sidebar = get_option('fpn_sidebar'); ?>
            <?php if ( $fpn_sidebar == 'no' ) $class = ' class="full-width-content"'; ?>        
            <div id="content"<?php echo $class; ?>>
				<?php $fpn_headlines_title = get_option('fpn_headlines_title'); ?>
				<?php $fpn_headlines_number = get_option('fpn_headlines_number'); ?>
				<?php $fpn_headlines_number_intro = get_option('fpn_headlines_number_intro'); ?>                                
                <?php if ( $fpn_headlines_title != '' ): ?>
                    <h3><?php echo $fpn_headlines_title; ?></h3>
                <?php endif;?>  
                <?php $fpn_headlines_category = get_option('fpn_headlines_category'); ?>               
                <?php $with_content_start = 1; ?>
                <?php if ( $fpn_headlines_number_intro == '' ) $with_content = 3; else $with_content = $fpn_headlines_number_intro; ?>
                <?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fpn_headlines_number.'&cat='.$fpn_headlines_category); ?>
                <?php while ( $wp_query->have_posts() ) : ?>
                    <?php $wp_query->the_post(); ?>
                        <?php if ( $with_content_start <= $with_content ) : ?>
                            <div class="post">
									<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                  <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=94&amp;w=129&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                </a> 
                                <div class="post-content">                    
                                    <a class="title" href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                    <?php global $more; $more = 0; the_content(__('Read More &#187;','duotive')); ?>
                                </div>
                            </div> 
                        <?php else: ?>
                            <div class="just-title-element">
                               <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                               </a>                       
                            </div>
                        <?php endif; ?> 
                        <?php $with_content_start++; ?>                      
                <?php endwhile;?>
            <!-- end of content -->
            </div> 
            <?php $fpn_sidebar = get_option('fpn_sidebar'); ?>
            <?php if ( $fpn_sidebar == '' ) $fpn_sidebar = 'yes'; else $fpn_sidebar = get_option('fpn_sidebar'); ?>
            <?php if ( $fpn_sidebar == 'yes' ): ?>
                <div id="content-sidebar">
                    <?php if ( is_active_sidebar( 'front-page-news-area' ) ) : ?>
                        <ul>
                            <?php dynamic_sidebar( 'front-page-news-area' ); ?>
                        </ul>
                    <?php endif; ?>
                <!-- end of content-sidebar -->
                </div>
            <?php endif; ?>
            <div id="bottom-posts">
				<?php $fpn_other_title = get_option('fpn_other_title'); ?>                              
                <?php if ( $fpn_other_title != '' ): ?>
                    <h3><?php echo $fpn_other_title; ?></h3>
                <?php endif;?> 
				<?php $fpn_other_category = get_option('fpn_other_category'); ?>
                <?php $fpn_other_number = get_option('fpn_other_number');?>                 
                <?php $limiter = 1; ?>
                <?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fpn_other_number.'&cat='.$fpn_other_category); ?>
                <?php while ( $wp_query->have_posts() ) : ?>
                    <?php $wp_query->the_post(); ?>                                          
						<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                        <?php $website_url = get_bloginfo('wpurl'); ?>
                        <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>  
                        <a class="image-wrapper<?php if ( $limiter%5 == 0 ) echo ' image-wrapper-last'; ?>" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                            <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=74&amp;w=104&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                        </a>     
                     <?php $limiter++; ?>                                
                <?php endwhile;?>                           
            <!-- end of bottom-posts -->
            </div>
		<!-- end of news content wrapper -->
        </div>                           
    <!-- end of front page news -->
    </div>
<!-- end of front page news wrapper -->
</div>
<?php get_footer(); ?>