<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Galery - Galleria
 */
get_header(); ?>
	<div id="content-wrapper">
        <div id="content" class="content-full-width clearfix">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <div class="page">
					<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
                    <?php if ( $slider_display == 0 ) : ?>      
                        <h1 class="page-title">
                                    <?php the_title(); ?>
                        </h1>
                    <?php endif; ?>    
				    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ) ?>/css/slideshows/galleria.css" />                    
					<script type="text/javascript" src="<?php bloginfo( 'template_url' ) ?>/js/galleria-1.2.2.min.js"></script>    
					<script type="text/javascript" >
						jQuery(document).ready(function($) {					
							Galleria.loadTheme('<?php bloginfo( 'template_url' ) ?>/js/galleria.classic.min.js');
							jQuery('#galleria').galleria();
						});
                    </script>       
                    <div id="galleria">
						<?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );  ?>
                        <?php foreach ( $attached_images as $attached_image ): ?>
                            <?php $thumbnail_src = wp_get_attachment_url($attached_image->ID); ?>
                            <a href="<?php echo $thumbnail_src; ?>">                                   
                                <?php $website_url = get_bloginfo('wpurl'); ?>
                                <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                 
                                <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=55&amp;w=90&amp;zc=1&amp;q=100" alt="<?php $description = $attached_image->post_content; if ( $description != '' ) echo $description;?>" title="<?php $title = $attached_image->post_title; if ( $title != '' ) echo $title;?>" />                            
                            </a>                            
                        <?php endforeach; ?>
                    </div>
                    <div class="content">
                        <?php the_content(); ?>
                    <!--end of content -->
                    </div>
                <!-- end of page -->
                </div>
            <?php endwhile; ?>
        <!-- end of content -->
        </div>
    <!--end of content-wrapper -->
    </div>
<?php get_footer(); ?>

