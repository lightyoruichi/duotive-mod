<?php /* LOOP TO DISPLAY POSTS */ ?>

<?php // NO POSTS TO DISPLAY? ?>
<?php if ( ! have_posts() ) : ?>
	<p class="intro"><?php echo __('Apologies, but no results were found for the requested archive.<br /> Perhaps searching will help find a related post.','duotive'); ?>
<?php endif; ?>
<?php // HAVE POSTS TO DISPLAY? ?>
<?php while ( have_posts() ) : the_post(); ?>
        <div class="post blog-classic">
            <h2>
                <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to ', 'duotive').the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>                        
            <?php if ( has_post_thumbnail() ): ?>
                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
                <a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&h=180&w=640&zc=1&q=100" alt="<?php the_title(); ?>" />
                </a>
            <?php endif; ?>
            <?php if(is_search()): ?>  
	            <?php the_excerpt(); ?>
            <?php else: ?>
    	        <?php the_content(''); ?>
	            <a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo __('Read More &#187;','duotive'); ?></a>                
            <?php endif; ?>
            <div class="post-meta">
                <span class="author"><?php echo __('posted by ','duotive'); ?><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>, </span>               
                <span class="post-date"><?php the_time('jS'); echo ' '; the_time('F'); echo ' '; the_time('Y');?></span>
                <?php if ( count( get_the_category() ) ) : ?>
                    <span class="categories-link">, <?php echo __('Categories:','duotive').' <span class="title">'.get_the_category_list( ', ' ).'</span>'; ?></span>                                     
                <?php endif; ?>                           
                <?php $tags_list = get_the_tag_list( '', ', ' ); ?>
                <?php if ( $tags_list ): ?>                     
                    <span class="tag-links">
                        <?php echo __('Tags:','duotive').' <span class="title">'.$tags_list.'</span>'; ?>
                    </span>
                <?php endif; ?>                                                  
            <!-- end of post meta -->
            </div>
        <!--end of blog-classic -->
        </div>
<?php endwhile;?>
<?php if(function_exists('wp_pagenavi')): ?>
	<div id="navigation">
		<?php wp_pagenavi();?>  
	</div>                    
<?php endif; ?>