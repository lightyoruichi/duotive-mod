<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Frontpage Business Layout
 */
?>
<?php get_header(); ?>
<div id="content-wrapper">
    <div id="front-page-business">
        <?php if ( get_option('fpb_intro') == '') $fpb_intro = 'yes'; else $fpb_intro = get_option('fpb_intro');?>
        <?php if ($fpb_intro=='yes'): ?>
            <div id="intro">
            	<?php if ( get_option('fpb_intro_heading') != '' ): ?>
                	<h1><?php echo get_option('fpb_intro_heading'); ?></h1>
                <?php endif; ?>
                <?php if ( get_option('fpb_intro_text') != '' ): ?>
                	<p><?php echo get_option('fpb_intro_text'); ?></p>
                <?php endif; ?>
                <div class="sep">&nbsp;</div>
            <!-- end of intro -->
            </div>
		<?php endif; ?>            
		<?php if ( get_option('fpb_posts') == '') $fpb_posts = 'yes'; else $fpb_posts = get_option('fpb_posts');?>  
        <?php if ( $fpb_posts == 'yes') : ?>          
            <div id="front-page-posts" class="clearfix">
                <?php $fpb_posts_category = get_option('fpb_posts_category'); ?>
                <?php $fpb_posts_number = get_option('fpb_posts_number');?>
                <?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fpb_posts_number.'&cat='.$fpb_posts_category); ?>
                <?php $front_page_posts_clear = 1; ?>
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <?php if ( get_option('fpb_posts_columns') == '') $fpb_posts_columns = '3'; else $fpb_posts_columns = get_option('fpb_posts_columns');?>
                    <?php if ( $fpb_posts_columns == 2 ) : ?>
                        <div class="front-page-post-two front-page-post<?php if ($front_page_posts_clear%2==0) echo ' front-page-post-last'; ?>">
                            <h3>
                                <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>                
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <?php $website_url = get_bloginfo('wpurl'); ?>
                                <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                                <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=230&amp;w=445&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                </a>                
                            <?php endif; ?>
                            <?php the_excerpt(); ?>
                        </div>
                        <?php if ($front_page_posts_clear%2==0) echo '<div class="front-page-post-sep"></div>'; ?>
                        <?php $front_page_posts_clear++; ?>
                    <?php endif; ?>                         
                    <?php if ( $fpb_posts_columns == 3 ) : ?>
                        <div class="front-page-post-three front-page-post<?php if ($front_page_posts_clear%3==0) echo ' front-page-post-last'; ?>">
                            <h3>
                                <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>                
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <?php $website_url = get_bloginfo('wpurl'); ?>
                                <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                                <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=140&amp;w=280&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                </a>                
                            <?php endif; ?>
                            <?php the_excerpt(); ?>
                        </div>
                        <?php if ($front_page_posts_clear%3==0) echo '<div class="front-page-post-sep"></div>'; ?>
                        <?php $front_page_posts_clear++; ?>
                    <?php endif; ?>
                    <?php if ( $fpb_posts_columns == 4 ) : ?>
                        <div class="front-page-post-four front-page-post<?php if ($front_page_posts_clear%4==0) echo ' front-page-post-last'; ?>">
                            <h3>
                                <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>                
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <?php $website_url = get_bloginfo('wpurl'); ?>
                                <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                                <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=100&amp;w=197&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                </a>                
                            <?php endif; ?>
                            <?php the_excerpt(); ?>
                        </div>
                        <?php if ($front_page_posts_clear%4==0) echo '<div class="front-page-post-sep"></div>'; ?>
                        <?php $front_page_posts_clear++; ?>
                    <?php endif; ?>                        
                <?php endwhile;?> 
                <div class="sep"></div>
            <!-- end of front page posts -->
            </div>
        <?php endif; ?> 
        <?php if ( get_option('fpb_bottom') == '') $fpb_bottom = 'yes'; else $fpb_bottom = get_option('fpb_bottom');?>  
        <?php if ( $fpb_bottom == 'yes') : ?> 
            <div id="front-page-bottom">                
                <?php if ( get_option('fpb_bottom_scroller') == '') $fpb_bottom_scroller = 'yes'; else $fpb_bottom_scroller = get_option('fpb_bottom_scroller');?>           
                <?php if ( get_option('fpb_bottom_scroller_size') == '') $fpb_bottom_scroller_size = 'one-half'; else $fpb_bottom_scroller_size = get_option('fpb_bottom_scroller_size');?>
                <?php if ( $fpb_bottom_scroller == 'yes') : ?>                      
                    <?php
                        switch($fpb_bottom_scroller_size)
                        {
                            case 'full-width':
                                $widget_area_number = 0;
                            break;
                            case 'two-thirds':
                                $widget_area_number = 1;
                                $widget_area_class_one = ' one-third';
                            break;
                            case 'three-forths':
                                $widget_area_number = 1;
                                $widget_area_class_one = ' one-forth';
                            break;
                            case 'one-half':
                                $widget_area_number = 2;
                                $widget_area_class_one = ' one-forth';
                                $widget_area_class_two = ' one-forth';
                            break;							
                        }
                    ?>
                    <?php if ( $widget_area_number != 0 ) : ?>        			
                        <div id="front-page-botton-widgets">
                            <?php if ( $widget_area_number == 1 || $widget_area_number == 2 ) : ?>
                                <?php if ( is_active_sidebar( 'front-page-business-1' ) ) : ?>
                                    <div class="column<?php echo $widget_area_class_one; ?>">
                                        <ul>
                                            <?php dynamic_sidebar( 'front-page-business-1' ); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ( $widget_area_number == 2 ) : ?>
                                <?php if ( is_active_sidebar( 'front-page-business-2' ) ) : ?>
                                    <div class="column<?php echo $widget_area_class_two; ?>">
                                        <ul>
                                            <?php dynamic_sidebar( 'front-page-business-2' ); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>                            
                        </div>
                    <?php endif; ?>                 
                    <div id="bottom-content-scroll-wrapper" class="<?php echo $fpb_bottom_scroller_size; ?>">
                        <h3><?php echo get_option('fpb_bottom_scroller_title'); ?></h3>
                        <div id="bottom-content-scroll">
                            <?php $fpb_bottom_scroller_category = get_option('fpb_bottom_scroller_category'); ?>
                            <?php $fpb_bottom_scroller_number = get_option('fpb_bottom_scroller_number'); ?>                                
                            <?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fpb_bottom_scroller_number.'&cat='.$fpb_bottom_scroller_category); ?>
                            <ul>
                                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?> 
                                    <li>
                                        <?php if ( has_post_thumbnail() ): ?>
                                            <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                            <?php $website_url = get_bloginfo('wpurl'); ?>
                                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                                            <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=130&amp;w=170&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                            </a>   
                                            <div class="sep"></div>             
                                        <?php endif; ?> 
                                        <div class="content">                            
                                            <h3>
                                                <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <?php global $more; $more = 0; the_content(__('Read More &#187;','duotive')); ?>    
                                        </div>
                                    </li>                       
                                <?php endwhile; ?>                 
                            </ul>
                        <!-- end of bottom content scroller -->                        
                        </div>
                    <!-- end of bottom content scroller wrapper -->                        
                    </div>
                <?php else: ?>
                    <?php if ( get_option('fpb_bottom_widget_areas') == '') $fpb_bottom_widget_areas = '4'; else $fpb_bottom_widget_areas = get_option('fpb_bottom_widget_areas');?>
                    <?php 
                        switch($fpb_bottom_widget_areas)
                        {
                            case '1': $widget_area_class = ' full-width-widget-area'; break;
                            case '2': $widget_area_class = ' one-half-widget-area'; break;
                            case '3': $widget_area_class = ' one-third-widget-area'; break;
                            case '4': $widget_area_class = ' one-forth-widget-area'; break;								
                        }
                    ?>
                    <div id="front-page-botton-widgets">
                        <?php if ( $fpb_bottom_widget_areas == 1 || $fpb_bottom_widget_areas == 2 || $fpb_bottom_widget_areas == 3 || $fpb_bottom_widget_areas == 4 ) : ?>
                            <?php if ( is_active_sidebar( 'front-page-business-1' ) ) : ?>
                                <div class="column<?php echo $widget_area_class; ?>">
                                    <ul>
                                        <?php dynamic_sidebar( 'front-page-business-1' ); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ( $fpb_bottom_widget_areas == 2 || $fpb_bottom_widget_areas == 3 || $fpb_bottom_widget_areas == 4 ) : ?>
                            <?php if ( is_active_sidebar( 'front-page-business-2' ) ) : ?>
                                <div class="column<?php echo $widget_area_class; ?>">
                                    <ul>
                                        <?php dynamic_sidebar( 'front-page-business-2' ); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>  
                        <?php if ( $fpb_bottom_widget_areas == 3 || $fpb_bottom_widget_areas == 4 ) : ?>
                            <?php if ( is_active_sidebar( 'front-page-business-3' ) ) : ?>
                                <div class="column<?php echo $widget_area_class; ?>">
                                    <ul>
                                        <?php dynamic_sidebar( 'front-page-business-3' ); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?> 
                        <?php if ( $fpb_bottom_widget_areas == 4 ) : ?>
                            <?php if ( is_active_sidebar( 'front-page-business-4' ) ) : ?>
                                <div class="column<?php echo $widget_area_class; ?>">
                                    <ul>
                                        <?php dynamic_sidebar( 'front-page-business-4' ); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>                                                                                    
                    </div>
                <?php endif; ?>                        
            <!-- end of front page bottom -->
            </div>
        <?php endif; ?>                                      
    <!-- end of front page business -->
    </div>    
<!-- end of content wrapper -->
</div>
<?php get_footer(); ?>