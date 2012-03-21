<?php
	/* ARCHIVE PAGES TEMPLATE */
	get_header();
?>
<div id="content-wrapper">
	<?php if ( have_posts() ) the_post(); ?>
    <?php get_sidebar(); ?>
    <div id="content"> 
		<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
        <?php if ( $slider_display == 0 ) : ?>      
            <h1 class="page-title">
                <?php echo __('Author Archives: ', 'duotive'); ?>
                <?php echo get_the_author(); ?>
            </h1>
        <?php endif; ?>
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
            <div id="author-info">
                <div id="author-avatar">
                    <?php $avatar_path = get_bloginfo('template_directory').'/images/default-avatar.png'; ?>
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '74', $default = $avatar_path ); ?>
                <!--end of author avatar -->
                </div>
                <div id="author-description">
                    <h4>
                        <?php echo __('About ', 'duotive').get_the_author(); ?>
                    </h4>
                    <p><?php the_author_meta( 'description' ); ?></p>
                    <a class="more-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                        <?php echo __('View all posts','duotive'); ?>
                    </a>                            
                <!-- end of author description -->
                </div>
            <!-- end of author info -->
            </div>
        <?php endif; ?>   
        <?php rewind_posts();?>
        <?php get_template_part( 'loop', 'archive' ); ?>
    <!-- end of content --> 
    </div>
<!--end of content wrapper -->
</div>
<?php get_footer(); ?>
