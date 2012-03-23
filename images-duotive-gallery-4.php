<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Galery - Duotive Fullwidth - One forth
 */
get_header(); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ) ?>/css/slideshows/duotive-fullwidth-gallery.css" />                    

	<div id="content-wrapper">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div id="fullWidthGallery" class="fullWidthGalleryforth">
                <div id="gallery-controls">
                    <a id="gallery-control-left" href="javascript: void(0)">left</a>
                    <a id="gallery-control-right" href="javascript: void(0)">right</a>
                </div>
                <?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );  ?> 
                <?php $attached_images = array_values($attached_images); ?>             
                <ul id="fullWidthGalleryUl" class="fullWidthGalleryforth">
					<?php for ( $i = 0; $i < count($attached_images); $i = $i + 3) : ?>
                        <li class="mainlevel forth">
                            <ul>
                            	<?php $thumbnail_src = wp_get_attachment_url($attached_images[$i]->ID); ?>
                            	<?php if ( $thumbnail_src != '' ): ?>
                                    <li>
                                        <a href="<?php echo $thumbnail_src; ?>" rel="gallery[modal]">
                                            <?php $website_url = get_bloginfo('wpurl'); ?>
                                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                       
                                            <span class="border"></span>
                                            <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=140&amp;w=238&amp;zc=1&amp;q=100" width="238" height="140" alt="<?php $description = $attached_images[$i]->post_content; if ( $description != '' ) echo $description;?>" />
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php $thumbnail_src = wp_get_attachment_url($attached_images[$i+1]->ID); ?>
                                <?php if ( $thumbnail_src != '' ): ?>
                                    <li>
                                        <a href="<?php echo $thumbnail_src; ?>" rel="gallery[modal]">
                                            <?php $website_url = get_bloginfo('wpurl'); ?>
                                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                       
                                            <span class="border"></span>
                                            <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=140&amp;w=238&amp;zc=1&amp;q=100" width="238" height="140" alt="<?php $description = $attached_images[$i+1]->post_content; if ( $description != '' ) echo $description;?>" /> 
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php $thumbnail_src = wp_get_attachment_url($attached_images[$i+2]->ID); ?>
                                <?php if ( $thumbnail_src != '' ): ?>
                                    <li>
                                        <a href="<?php echo $thumbnail_src; ?>" rel="gallery[modal]">
                                            <?php $website_url = get_bloginfo('wpurl'); ?>
                                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                       
                                            <span class="border"></span>
                                            <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=140&amp;w=238&amp;zc=1&amp;q=100" width="238" height="140" alt="<?php $description = $attached_images[$i+2]->post_content; if ( $description != '' ) echo $description;?>" />
                                        </a>
                                    </li>
                                <?php endif; ?>                                                                                                
                            </ul>
                        </li>
                    <?php endfor; ?>      
                </ul>                        
            </div>      
            <div id="content" class="content-full-width clearfix">
                <div class="page">
                    <?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
                    <?php if ( $slider_display == 0 ) : ?>      
                        <h1 class="page-title">
                           <?php the_title(); ?>
                        </h1>
                    <?php endif; ?>    
                    <div class="content">
                        <?php the_content(); ?>
                    <!--end of content -->
                    </div>
                <!-- end of page -->
                </div>
            <!-- end of content -->
            </div>         
        <?php endwhile; ?>
    <!--end of content-wrapper -->
    </div>
<?php get_footer(); ?>

