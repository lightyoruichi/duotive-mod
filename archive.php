<?php
	/* ARCHIVE PAGES TEMPLATE */
	get_header();
?>
    <div id="content-wrapper">
        <?php if ( have_posts()) the_post();?>
        <?php rewind_posts();?>
        <?php get_sidebar(); ?>
        <div id="content">   
			<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
            <?php if ( $slider_display == 0 ) : ?>             
                <h1 class="page-title">
                    <?php if ( is_day() ) :
                        echo __('Daily Archives: ','duotive').'<span>'.get_the_date().'</span>';
                            elseif ( is_month() ) :
                                echo __('Monthly Archives: ','duotive').'<span>'.get_the_date('F Y').'</span>';
                                elseif ( is_year() ) :
                                    echo __('Yearly Archives: ','duotive').'<span>'.get_the_date('Y').'</span>';
                                    else :
                                        echo __('Blog Archives','duotive');
                    endif; ?>
                </h1>
            <?php endif; ?>                
            <?php get_template_part( 'loop', 'archive' ); ?>
        <!-- end of content -->    
    <!--end of content wrapper -->
    </div>
<!-- end of wrapper -->
</div>
<?php get_footer(); ?>
