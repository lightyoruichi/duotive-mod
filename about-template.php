<?php
/*
Template Name: About Template
*/
	get_header();
?>
<div style="width:100%">
<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=213021633772625182800.00046c9bd07d5d81e3e89&amp;ll=2.129039,103.387352&amp;spn=0.604658,0.621765&amp;t=m&amp;output=embed"></iframe>
<br /><small><a href="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=213021633772625182800.00046c9bd07d5d81e3e89&amp;ll=2.129039,103.387352&amp;spn=0.604658,0.621765&amp;t=m&amp;source=embed" style="color:#0000FF;text-align:left">View a larger map</a></small>
</div>

<?php if ( get_option('postsidebar') == '' ) $postsidebar = 'no'; else $postsidebar = get_option('postsidebar'); ?>
<div id="content-wrapper">
	<?php if ( $postsidebar == 'no' ) : ?>
		<?php get_sidebar(); ?>
    <?php endif; ?>
	<div id="content"<?php if ( $postsidebar == 'yes') echo ' class="content-full-width"'; ?>>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div id="single">
				<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
                <?php if ( $slider_display == 0 ) : ?>             
                    <h1 class="title">
                        <?php the_title(); ?>
                        <!--end of entry title -->
                    </h1>
                <?php endif; ?>
                <?php if ( get_option('postmeta') == '' ) $postmeta = 'yes'; else $postmeta = get_option('postmeta'); ?>
                <?php if ( $postmeta == 'yes' ): ?>
                    <div class="post-meta">
                        <span class="author"><?php echo __('posted by ','duotive'); ?><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>, </span>               
                        <span class="date"><?php the_time('jS'); echo ' '; the_time('F'); echo ' '; the_time('Y');?>, </span>
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
                <?php endif; ?>
                <?php if ( get_option('posttopimage') == '' ) $posttopimage = 'yes'; else $posttopimage = get_option('posttopimage'); ?>
                <?php if ( $posttopimage == 'yes' ): ?>               
					<?php if ( has_post_thumbnail() ): ?>
						<?php if ( $postsidebar == 'no' ) : ?>                    
                            <div class="post-image">
                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <a href="<?php echo $thumbnail_src; ?>"> 
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>				                            
                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=300&amp;w=630&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                </a>
                            </div>  
                        <?php else: ?>
                            <div class="post-image-full">
                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <a href="<?php echo $thumbnail_src; ?>"> 
                                    <?php $website_url = get_bloginfo('wpurl'); ?>
                                    <?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>				                            
                                    <img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=400&amp;w=960&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
                                </a>
                            </div>                          
                        <?php endif; ?>                      
                    <?php endif; ?>                  
                <?php endif; ?>
                <div class="entry-content">
                    <?php the_content('Read More'); ?>
                    <?php wp_link_pages( array( 'before' => '<span class="page-link">' . 'Pages:', 'after' => '</span>' ) ); ?>
                <!--end of entry content -->
                </div>
                <?php if ( get_the_author_meta( 'description' ) ) : ?>
                    <div id="author-info">
                        <div id="author-avatar">
							<?php $avatar_path = get_bloginfo('template_directory').'/images/default-avatar.png'; ?>
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '74', $default = $avatar_path ); ?>
                        <!--end of author avatar -->
                        </div>
                        <div id="author-description">
                            <h6><?php echo __('About ', 'duotive').get_the_author(); ?></h6>
                            <p><?php the_author_meta( 'description' ); ?></p>
                            <a class="more-url" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                            	<?php echo __('View all posts','duotive'); ?>
                            </a>                            
                        <!-- end of author description -->
                        </div>
                    <!-- end of author info -->
                    </div>
                <?php endif; ?>  
            <!--end of post -->
            </div>
            <div id="related-sep"></div>
			<?php
            	$relatedposts = get_option('relatedposts'); if ( $relatedposts == '' ) $relatedposts = 'off'; else $relatedposts = get_option('relatedposts');
				if ( $relatedposts != 'off' )
				{
					$relatedpostsnumber = get_option('relatedpostsnumber'); if ( $relatedpostsnumber == '' ) $relatedpostsnumber = 5; else $relatedpostsnumber = get_option('relatedpostsnumber');
					switch ( $relatedposts )
					{
						case 'category':
							$categories = get_the_category($post->ID);
							if ($categories) {
								$category_ids = array();
								foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
							
								$args=array(
									'category__in' => $category_ids,
									'post__not_in' => array($post->ID),
									'showposts'=> $relatedpostsnumber,
									'ignore_sticky_posts'=>1
								);
							}
						break;
						
						case 'tags':
							$tags = wp_get_post_tags($post->ID);
							if ($tags) {
								$tag_ids = array();
								foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
							
								$args=array(
									'tag__in' => $tag_ids,
									'post__not_in' => array($post->ID),
									'showposts'=> $relatedpostsnumber,
									'ignore_sticky_posts'=>1
								);
							}	
						break;							
					}
								
					$my_query = new wp_query($args);
					if( $my_query->have_posts() )
					{
						echo '<div id="related" class="clearfix">';
							echo '<h3>Related</h3>';
							echo '<ul>';
								$i = 1;
								while ($my_query->have_posts())
								{
									$my_query->the_post();
									?>
										<?php if ( has_post_thumbnail() ): ?>
											<li<?php if ( $i%5 == 0 && $postsidebar == 'no' ) echo ' class="last-related"'; ?>>
												<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
												<?php $website_url = get_bloginfo('wpurl'); ?>
												<?php $thumbnail_src = str_replace($website_url,'', $thumbnail_src); ?>                                          
												<a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
													<img src="<?php echo get_bloginfo('template_directory');?>/includes/timthumb.php?src=<?php echo $thumbnail_src; ?>&amp;h=74&amp;w=104&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" />
												</a>
											</li>
										<?php endif; ?>                        
									<?php
									$i++;
								}
							echo '</ul>';
						echo '</div>';
					}
				}
            ?>   
		<?php wp_reset_query(); ?>                    
        <?php if ( get_option('sharing') == '' ) $sharing = 'yes'; else $sharing = get_option('sharing'); ?>
        <?php if ( get_option('comments') == '' ) $comments = 'yes'; else $comments = get_option('comments'); ?>
        <?php if ( $sharing == 'yes') require_once('includes/sharing.php'); ?>
        <?php if ( $comments == 'yes') comments_template( '', true ); ?>
		<?php endwhile; ?>
    <!-- end of content -->
    </div>
<!--end of content wrapper -->    
</div>
<?php get_footer(); ?>
