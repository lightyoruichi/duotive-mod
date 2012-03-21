<?php /* COMMENTS TEMPLATE */ ?>
<div id="comments">
	<?php if ( post_password_required() ) : ?>
		  <p class="nopassword">
		  	<?php echo __('This post is password protected. Enter the password to view any comments.','duotive'); ?>
		  </p>
          <!--end of comments -->
          </div>
    <?php return; endif; ?>
    
    <?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="comments-navigation">
                <div class="previous">
                    <?php previous_comments_link(__('Older Comments','duotive')); ?>
                <!--end of previous -->
                </div>
                <div class="next">
                    <?php next_comments_link(__('Newer Comments','duotive')); ?>
                <!--end of next -->
                </div>
            <!--end of comments navigation -->
            </div>
        <?php endif; ?>
        
        <ol class="commentlist">
			<?php wp_list_comments(array('callback' => 'comment_callback')); ?>
        </ol>
        
        
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="comments-navigation">
                <div class="previous">
                    <?php previous_comments_link(__('Older Comments','duotive')); ?>
                <!--end of previous -->
                </div>
                <div class="next">
                    <?php next_comments_link(__('Newer Comments','duotive')); ?>
                <!--end of next -->
                </div>
            <!--end of comments navigation -->
            </div>
        <?php endif; ?>
    
    <?php else :
		if ( ! comments_open() ) :
    ?>
        <p class="nocomments">
			<?php echo 'Comments are closed'; ?>
        </p>
    	<?php endif; ?>
    
    <?php endif;?>
    <?php comment_form(); ?>
<!-- end of comments -->
</div>
