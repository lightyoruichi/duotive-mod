<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Frontpage Posts Layout
 */
?>
<?php get_header(); ?>
<div id="front-page-posts-wrapper">
    <div id="front-page-posts">
	<?php if ( get_option('fpp_intro') == '') $fpp_intro = 'yes'; else $fpp_intro = get_option('fpp_intro');?>
    <?php if ($fpp_intro=='yes'): ?>
        <div id="intro">
        	<?php if ( get_option('fpp_intro_heading') != '' ): ?>
           		<h1><?php echo get_option('fpp_intro_heading'); ?></h1>
            <?php endif; ?>
            <?php if ( get_option('fpp_intro_text') != '' ): ?>
            	<p><?php echo get_option('fpp_intro_text'); ?></p>
            <?php endif; ?>
        <!-- end of intro -->
        </div>    
	<?php endif; ?>
    <div id="columns" class="clearfix">
    	<?php $fpp_category = get_option('fpp_category'); ?>
		<?php if ( get_option('fpp_post_number') == '') $fpp_post_number = '-1'; else $fpp_post_number = get_option('fpp_post_number');?>
        <?php if ( get_option('fpp_content') == '') $fpp_content = 'yes'; else $fpp_content = get_option('fpp_content');?>
        <?php if ( get_option('fpp_title') == '') $fpp_title = 'yes'; else $fpp_title = get_option('fpp_title');?>
        <?php if ( get_option('fpp_date') == '') $fpp_date = 'yes'; else $fpp_date = get_option('fpp_date');?>                            
		<?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fpp_post_number.'&cat='.$fpp_category); ?>
            <?php if ( $wp_query->have_posts() ) : ?> 
                <!-- first collumn -->
                <?php $post_counter = 1; ?>
                <div class="col">
                    <?php while ( $wp_query->have_posts() ) : ?>
                        <?php $wp_query->the_post(); ?>
                        <?php $columns_destination = $post_counter%3; ?>
                        <?php if ( $columns_destination == 1 ) : ?>
                            <div class="post">             
                                <?php if ( has_post_thumbnail() ): ?>
									<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                                    <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                        <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=150&amp;w=280&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                    </a>                
                                <?php endif; ?>
                                <?php if ( $fpp_title == 'yes' ) : ?> 
                                    <h3>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>                           
                                <?php endif; ?>
                                <?php if ( $fpp_content == 'yes' ) : ?>                          
	                                <?php global $more; $more = 0; the_content(__('Read More &#187;','duotive')); ?>
                                <?php endif; ?>
                                <?php if ( $fpp_date == 'yes' ) : ?>
                                    <div class="post-date<?php if ( $fpp_title == 'no' && $fpp_content == 'no' ) echo ' post-date-no-border'; ?><?php if ( $fpp_title == 'yes' && $fpp_content == 'no' ) echo ' post-date-no-top'; ?>">
                                        <?php the_time('jS'); echo ' '; the_time('F'); echo ', '; the_time('Y'); echo ' '; ?>
                                    </div>
                                <?php endif; ?>
                            </div>                        
                        <?php endif; ?>
                        <?php $post_counter++; ?>
                    <?php endwhile;?>
                </div>
                <!-- end of first collumn -->
                <!-- second collumn -->
                <?php $post_counter = 1; ?>
                <div class="col">
                    <?php while ( $wp_query->have_posts() ) : ?>
                        <?php $wp_query->the_post(); ?>
                        <?php $columns_destination = $post_counter%3; ?>
                        <?php if ( $columns_destination == 2 ) : ?>
                            <div class="post">             
                                <?php if ( has_post_thumbnail() ): ?>
									<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                                    <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                        <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=150&amp;w=280&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                    </a>                
                                <?php endif; ?>
                                <?php if ( $fpp_title == 'yes' ) : ?> 
                                    <h3>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>                           
                                <?php endif; ?>                          
                                <?php if ( $fpp_content == 'yes' ) : ?>                          
	                                <?php global $more; $more = 0; the_content(__('Read More &#187;','duotive')); ?>
                                <?php endif; ?>
                                <?php if ( $fpp_date == 'yes' ) : ?>
                                    <div class="post-date<?php if ( $fpp_title == 'no' && $fpp_content == 'no' ) echo ' post-date-no-border'; ?><?php if ( $fpp_title == 'yes' && $fpp_content == 'no' ) echo ' post-date-no-top'; ?>">
                                        <?php the_time('jS'); echo ' '; the_time('F'); echo ', '; the_time('Y'); echo ' '; ?>
                                    </div>
                                <?php endif; ?>
                            </div>                        
                        <?php endif; ?>
                        <?php $post_counter++; ?>
                    <?php endwhile;?>
                </div>
                <!-- end of second collumn --> 
                <!-- third collumn -->
                <?php $post_counter = 1; ?>
                <div class="col col-last">
                    <?php while ( $wp_query->have_posts() ) : ?>
                        <?php $wp_query->the_post(); ?>
                        <?php $columns_destination = $post_counter%3; ?>
                        <?php if ( $columns_destination == 0 ) : ?>
                            <div class="post">             
                                <?php if ( has_post_thumbnail() ): ?>
									<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                                    <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                        <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=150&amp;w=280&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                    </a>                
                                <?php endif; ?>
                                <?php if ( $fpp_title == 'yes' ) : ?> 
                                    <h3>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>                           
                                <?php endif; ?>
                                <?php if ( $fpp_content == 'yes' ) : ?>                          
	                                <?php global $more; $more = 0; the_content(__('Read More &#187;','duotive')); ?>
                                <?php endif; ?>
                                <?php if ( $fpp_date == 'yes' ) : ?>
                                    <div class="post-date<?php if ( $fpp_title == 'no' && $fpp_content == 'no' ) echo ' post-date-no-border'; ?><?php if ( $fpp_title == 'yes' && $fpp_content == 'no' ) echo ' post-date-no-top'; ?>">
                                        <?php the_time('jS'); echo ' '; the_time('F'); echo ', '; the_time('Y'); echo ' '; ?>
                                    </div>
                                <?php endif; ?>
                            </div>                        
                        <?php endif; ?>
                        <?php $post_counter++; ?>
                    <?php endwhile;?>
                </div>
                <!-- end of third collumn -->                          
        <?php endif;?>
	<!-- end of columns -->
    </div>        
    <!-- end of front page posts -->
    </div>
<!-- end of front page posts wrapper -->
</div>
<?php get_footer(); ?>