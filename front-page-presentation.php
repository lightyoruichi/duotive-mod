<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Frontpage Presentation
 */
?>
<?php get_header(); ?>
<div id="front-page-presentation-wrapper" class="clearfix">
	<div id="content" class="content-full-width clearfix">
        <?php if ( get_option('fppre_intro') == '') $fppre_intro = 'yes'; else $fppre_intro = get_option('fppre_intro');?>
        <?php if ($fppre_intro=='yes'): ?>
            <div id="intro">
                <?php if ( get_option('fppre_intro_heading') != '' ): ?>
                	<h1><?php echo get_option('fppre_intro_heading'); ?></h1>
				<?php endif; ?>
                <?php if ( get_option('fppre_intro_text') != '' ): ?>
                	<p><?php echo get_option('fppre_intro_text'); ?></p>
                <?php endif; ?>
                             <img style="float: right; margin-top:-74px;" src="http://beta.tandemic.com/images/people2.png" />

                <div class="sep">&nbsp;</div>
                 <div style="float:right; margin-top: -20px;">
                    <a href="/yb-hoo-song-chang/" class="more-link">YB Hoo<br> Seong<br> Chang</a>
                    <a href="/dato-seri-hishammuddin-tun-hussein/" class="more-link">Dato' Seri<br> Hishammuddin<br> Tun Hussein</a>
                    <a href="/yb-encik-vidyananthan-al-ramanadhan/" class="more-link">YB Encik<br> Vidyananthan<br> Ramanadhan</a>
                 </div>
            <!-- end of intro -->
            </div>
		<?php endif; ?>      
        <h3 class="dshh">Dato' Seri Hishammuddin Hussein</h3>
		<?php if ( get_option('fppre_row1') == '') $fppre_row1 = 'yes'; else $fppre_row1 = get_option('fppre_row1');?>    
        <?php if ( $fppre_row1 == 'yes' ): ?>
            <div id="front-page-presentation-row-1" class="clearfix">
                <?php if ( is_active_sidebar( 'front-page-presentation-row1-1' ) ) : ?>
                    <div class="onethird">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row1-1' ); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'front-page-presentation-row1-2' ) ) : ?>
                    <div class="sep"></div>
                    <div class="onethird">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row1-2' ); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'front-page-presentation-row1-3' ) ) : ?>
                    <div class="sep"></div>
                    <div class="onethird onethirdlast">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row1-3' ); ?>
                        </ul>
                    </div>
                <?php endif; ?> 
            <!-- end front page presentation row 1 -->                  
            </div>
		<?php endif; ?>
		<?php if ( get_option('fppre_row2') == '') $fppre_row2 = 'yes'; else $fppre_row2 = get_option('fppre_row2');?>    
        <?php if ( $fppre_row2 == 'yes' ): ?>
			<div id="front-page-presentation-row-2" class="clearfix">
				<?php $fppre_row2_category = get_option('fppre_row2_category'); ?>
                <?php $fppre_row2_number = get_option('fppre_row2_number');?>            
                <?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fppre_row2_number.'&cat='.$fppre_row2_category); ?>
                <?php $i = 1 ;?>
                <?php while ( $wp_query->have_posts() ) : ?>
                    <?php $wp_query->the_post(); ?>
                    <div class="post<?php if ( $i%4 == 0 ) echo ' last-post'; ?>">                                              
                        <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                        <?php $website_url = get_bloginfo('wpurl'); ?>
                        <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                        <a class="image-wrapper" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                            <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=120&amp;w=217&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                        </a>
                        <h6>
                            <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h6>                                            
                        <?php global $more; $more = 0; the_excerpt(__('Read More &#187;','duotive')); ?>
                    </div>
                    <?php if ( $i%4 == 0 ) echo '<div class="post-sep"></div>'; ?>
                    <?php $i++; ?>                        
                <?php endwhile;?>
        		<div class="big-sep"></div>                 
            <!-- end of front page presentation row 2 -->
            </div>
		<?php endif; ?>
		<?php if ( get_option('fppre_row3') == '') $fppre_row3 = 'yes'; else $fppre_row3 = get_option('fppre_row3');?>    
        <?php if ( $fppre_row3 == 'yes' ): ?>
            <div id="front-page-presentation-row-3" class="clearfix">
                <?php if ( is_active_sidebar( 'front-page-presentation-row3-1' ) ) : ?>
                    <div class="onehalf">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row3-1' ); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'front-page-presentation-row3-2' ) ) : ?>
                    <div class="onehalf onehalflast">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row3-2' ); ?>
                        </ul>
                    </div>
                <?php endif; ?> 
            <!-- end front page presentation row 3 -->                  
            </div>
		<?php endif; ?> 
		<?php if ( get_option('fppre_row4') == '') $fppre_row4 = 'yes'; else $fppre_row4 = get_option('fppre_row4');?>    
        <?php if ( $fppre_row4 == 'yes' ): ?>
            <div id="front-page-presentation-row-4" class="clearfix">          
                <?php if ( is_active_sidebar( 'front-page-presentation-row4-1' ) ) : ?>
                    <div class="onethird">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row4-1' ); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'front-page-presentation-row4-2' ) ) : ?>
                    <div class="onethird">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row4-2' ); ?>
                        </ul>
                    </div>
                <?php endif; ?> 
                <?php if ( is_active_sidebar( 'front-page-presentation-row4-3' ) ) : ?>
                    <div class="onethird onethirdlast">
                        <ul>
                            <?php dynamic_sidebar( 'front-page-presentation-row4-3' ); ?>
                        </ul>
                    </div>
                <?php endif; ?>                 
            <!-- end front page presentation row 5 -->                  
            </div>
		<?php endif; ?>
		<?php if ( get_option('fppre_row5') == '') $fppre_row5 = 'yes'; else $fppre_row5 = get_option('fppre_row5');?>    
        <?php if ( $fppre_row5 == 'yes' ): ?>
            <div id="front-page-presentation-row-5-wrapper">        
                <div id="front-page-presentation-row-5" class="clearfix">
                    <?php $fppre_row5_category = get_option('fppre_row5_category'); ?>
                    <?php $fppre_row5_number = get_option('fppre_row5_number');?>
					<?php if ( get_option('fppre_row5_meta') == '') $fppre_row5_meta = 'yes'; else $fppre_row5_meta = get_option('fppre_row5_meta');?>                       
                    <?php $wp_query = new WP_Query('post_type=post&posts_per_page='.$fppre_row5_number.'&cat='.$fppre_row5_category); ?>
                    <ul>
                    <?php while ( $wp_query->have_posts() ) : ?>
                        <?php $wp_query->the_post(); ?>
                        <li class="post">                                              
                            <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                            <?php $website_url = get_bloginfo('wpurl'); ?>
                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>               
                            <a class="image-wrapper<?php if ( $fppre_row5_meta == 'tooltip' ) echo ' move-to-tooltip'; ?>" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=120&amp;w=217&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                            </a>
                            <?php if ( $fppre_row5_meta == 'yes' ): ?>
                                <h6>
                                    <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h6>
                                <span class="date"><?php the_time('jS'); echo ' '; the_time('F'); echo ' '; the_time('Y');?> </span>
                            <?php endif; ?>
                        </li>                        
                    <?php endwhile;?>
                    </ul>                
                <!-- end of front page presentation row 5 -->
                </div>
            <!-- end of front page presentation row 5 wrapper -->            
            </div>            
		<?php endif; ?>                                                    
	</div>        
</div>        
<?php get_footer(); ?>