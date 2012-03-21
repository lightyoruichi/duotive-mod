<?php
	/* 404 ERROR PAGE TEMPLATE */
	get_header();
?>
<?php $sidebar = get_option('sidebar','right'); ?>
<div id="content-wrapper" class="clearfix sidebar-<?php echo $sidebar; ?>">
	<?php get_sidebar(); ?>
	<div id="content">
            <div class="post">
				<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
                <?php if ( $slider_display == 0 ) : ?>             
                    <h1 class="entry-title">
                        <?php echo __('Not Found','duotive'); ?>
                    </h1>
                <?php endif; ?>                
                <div class="entry-content">
                    <p class="intro">
                        <?php echo __('Apologies, but the page you requested could not be found. Perhaps searching will help.', 'duotive'); ?>
                    </p>
                    <?php get_search_form(); ?>
                <!--end of entry content -->
                </div>
            <!--end of post -->
            </div>
        <!-- end of content -->
        </div>
    <!--end of content-wrapper -->
    </div>
    
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>