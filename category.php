<?php
	/* CATEGORY PAGES TEMPLATE */
	get_header();
?>
<?php $sidebar = get_option('sidebar','right'); ?>
<div id="content-wrapper" class="sidebar-<?php echo $sidebar; ?>">
	<?php $category_description = category_description(); ?>
    <?php if ( ! empty( $category_description ) )	echo '<div class="category-description">' . $category_description . '</div>'; ?>
	<?php get_sidebar(); ?>
    <div id="content">  
		<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
        <?php if ( $slider_display == 0 ) : ?>
            <h1 class="page-title">
                <?php echo __('Category Archives: ','duotive').single_cat_title( '', false ); ?>
            <!--end of page title -->
            </h1>                  	
        <?php endif; ?>       
        <?php get_template_part( 'loop', 'index' ); ?>
    </div>
    <!-- end of content -->
<!--end of content wrapper -->
</div>
<?php get_footer(); ?>
