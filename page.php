<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Page - Full width and no comments
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

