<?php
	/* SEARCH PAGES TEMPLATE */
	get_header();
?>
<div id="content-wrapper">
	<?php get_sidebar(); ?>
	<div id="content">
		<?php if ( have_posts() ) : ?>
			<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
            <?php if ( $slider_display == 0 ) : ?>         
                <h1 class="page-title">
                    <?php echo __('Search results for ','duotive').get_search_query(); ?>
                <!-- end of page title -->
                </h1>
			<?php endif; ?>            
            <?php get_template_part( 'loop', 'search' ); ?>            
        <?php else : ?>
            <div class="post clearfix">
				<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
                <?php if ( $slider_display == 0 ) : ?>            
                    <h1 class="entry-title">
                        <?php echo __('Not Found','duotive'); ?>
                    <!--end of entry-title -->
                    </h1>
               <?php endif; ?>     
                <div class="entry-content">
                    <p class="intro"><?php echo __('Apologies, but no results were found for your search criteria. Please try again with another search criteris.','duotive'); ?></p>
                    <?php get_search_form(); ?>
                <!--end of entry content -->
                </div>
            </div>
        <?php endif; ?>
	<!-- end of content -->
    </div>       
<!--end of content-wrapper -->
</div>
<?php get_footer(); ?>
