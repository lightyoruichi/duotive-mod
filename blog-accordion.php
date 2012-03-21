<?php
/*
Template Name: Blog - Accordion Layout
*/
	get_header();
?>
	<?php $blogs = blog_require();?>
    <?php $pagination = get_option('blogaccordionpagination'); ?>    
    <?php $title = get_the_title(); ?>    
	<?php foreach ( $blogs as $blog) :?> 
		<?php if ( is_page($blog->PAGE)): ?>
        	<?php $blog_ids = $blog->CATEGORIES; ?>
            <div id="content-wrapper">
				<?php get_sidebar(); ?>
                <div id="content">
	                <?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
                	<?php if ( $slider_display == 0 ) : ?>
                        <h1 class="page-title">
                            <?php echo $title; ?>
                        </h1>                   	
                    <?php endif; ?>                 
                	<div id="blog-accordion">	
						<?php 
                            global $more;
                            $more = 0; 
							if ( is_front_page () ) $paged = get_query_var( 'page' );
                            $wp_query = new WP_Query('post_type=post&posts_per_page='.$pagination.'&cat='.$blog_ids.'&paged=' . $paged);
                            if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
                        ?>                    
                        <h3>
                            <span class="post-date">
                                <strong><?php the_time('j');?><em><?php the_time('S');?></em></strong>
                                <small><?php the_time('F');?></small>
                                <?php the_time('Y');?>
                            </span>                         
                            <a href="#" rel="nofollow">
                                <?php the_title(); ?>
                            </a>                                                
                        <!-- end of post big meta -->
                        </h3>                    
                        <div class="post">
                                <?php if ( $post->comment_status == 'open' ) : ?>
                                    <span class="post-comments">
                                        <span class="sep"></span>                                        
                                        <?php comments_popup_link('0','1','%','title',''); ?>                                 
                                    </span>    
                                <?php endif; ?>  
                                <div class="post-content">                                       
                                    <?php if ( has_post_thumbnail() ): ?>
											<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                            <?php $website_url = get_bloginfo('wpurl'); ?>
                                            <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                          
                                        <a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                            <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=180&amp;w=550&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                        </a>
                                    <?php endif; ?>  
                                    <?php the_content(''); ?>
                                    <a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo __('Read More &#187;','duotive'); ?></a>
                                    <div class="post-meta">
                                        <span class="author"><?php echo __('posted by ','duotive'); ?><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>, </span> 
                                        <?php if ( count( get_the_category() ) ) : ?>
                                            <span class="categories-link"><?php echo __('Categories:','duotive').' <span class="title">'.get_the_category_list( ', ' ).'</span>'; ?></span>                                     
                                        <?php endif; ?>                           
                                        <?php $tags_list = get_the_tag_list( '', ', ' ); ?>
                                        <?php if ( $tags_list ): ?>                     
                                            <span class="tag-links">
                                                <?php echo __('Tags:','duotive').' <span class="title">'.$tags_list.'</span>'; ?>
                                            </span>
                                        <?php endif; ?>                                                  
                                    <!-- end of post meta -->
                                    </div>
                                <!-- end of post content -->    
                                </div>                                        
                            <!--end of post -->
                            </div>                  
                        <?php endwhile; endif;?>
					<!-- end of blog accordion -->                     
                    </div>                        
                    <?php if(function_exists('wp_pagenavi')): ?>
                        <div id="navigation" class="navigation-blog-accordion">
                            <?php wp_pagenavi();?>  
                        </div>                    
                    <?php endif; ?>
                <!-- end of content -->
                </div>
            <!--end of content wrapper -->      
            </div>
        <?php endif;?>        
	<?php endforeach; ?>        
<?php get_footer(); ?>