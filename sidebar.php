<?php /* SIDEBAR */ ?>
<?php $sidebar = ''; ?>
<?php $sidebar = get_option('sidebar'); if ( $sidebar == '' ) $sidebar = 'sidebar-right'; else $sidebar = get_option('sidebar');?>

<div id="sidebar"<?php if ($sidebar == 'sidebar-left' ) echo ' class="sidebar-left"'; ?>>
	<?php if ( is_active_sidebar( 'general-up-widget-area' ) ) : ?>
        <ul>
            <?php dynamic_sidebar( 'general-up-widget-area' ); ?>
        </ul>
    <?php endif; ?>
	<?php 
	if ( is_single() || is_page() )
	{
		$sidebar =  get_post_meta($post->ID, "sidebars", true);
		$sidebar = str_replace(' ','-',strtolower($sidebar));
		if ($sidebar != '' )
		{
			if ( is_active_sidebar($sidebar) )
			{
				echo '<ul>';
					dynamic_sidebar($sidebar);
				echo '</ul>';
			}
		}
	}
	?>
	<?php if(is_front_page()): ?>
        <?php if ( is_active_sidebar( 'front-page-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'front-page-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>    
    <?php if(is_single()): ?>
        <?php if ( is_active_sidebar( 'single-post-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'single-post-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>   
    <?php if(is_page()): ?>
        <?php if ( is_active_sidebar( 'single-page-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'single-page-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>     
    <?php if(is_category()): ?>
        <?php if ( is_active_sidebar( 'category-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'category-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>     
    <?php if(is_archive()): ?>
        <?php if ( is_active_sidebar( 'archive-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'archive-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?> 
    <?php if(is_search()): ?>
        <?php if ( is_active_sidebar( 'search-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'search-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>            
	<?php if ( is_active_sidebar( 'general-down-widget-area' ) ) : ?>
        <ul>
            <?php dynamic_sidebar( 'general-down-widget-area' ); ?>
        </ul>
    <?php endif; ?>    
<!--end of sidebar -->
</div>