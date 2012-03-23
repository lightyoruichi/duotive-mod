<?php
	/* INDEX TEMPLATE */
	get_header();
?>
	<div id="content-wrapper" class="clearfix">
			<?php get_sidebar(); ?>
            <div id="content">        
                <?php get_template_part( 'loop', 'index' ); ?>
            <!-- end of content -->
            </div>
    <!-- end of content wrapper -->
    </div>
    
<?php get_footer(); ?>
