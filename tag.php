<?php
	/* TAG PAGES TEMPLATE */
	get_header();
?>
<div id="content-wrapper">
	<?php get_sidebar(); ?>    
    <div id="content">    
		<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
        <?php if ( $slider_display == 0 ) : ?>         
            <h1 class="page-title">
                <?php echo __('Tag Archives: ','duotive').single_tag_title( '', false ); ?>
            <!-- end of page-title -->
            </h1>    
        <?php endif; ?>
            <?php get_template_part( 'loop', 'index' ); ?>
        <!-- end of content -->
    </div>
<!-- end of content wrapper -->
</div>
<?php get_footer(); ?>
