<?php
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//RESET POST BOX - DUOTIVE ADMIN IN POST/PAGE
	
	wp_register_style( 'duotive-wordpress-css', get_bloginfo('template_directory'). '/includes/duotive-admin-skin/css/duotive-wordpress.css' );
	wp_register_style( 'colorpicker-css', get_bloginfo('template_directory'). '/includes/duotive-admin-skin/css/colorpicker.css' );
	wp_register_script( 'jquery-colorpicker', get_bloginfo('template_directory'). '/includes/duotive-admin-skin/js/colorpicker.js' );
	wp_register_script( 'jquery-tools', get_bloginfo('template_directory'). '/includes/duotive-admin-skin/js/jquery.tools.min.js' );
	wp_register_script( 'duotive-wordpress-js', get_bloginfo('template_directory'). '/includes/duotive-admin-skin/js/duotive-wordpress.js' );
	if ( isset($_GET['page']) ) $page = $_GET['page']; else $page = '';
	if (is_admin() && $page != 'duotive-slider' && $page != 'duotive-front-page-manager' && $page != 'duotive-panel' && $page != 'duotive-sidebars' && $page != 'duotive-portfolios' && $page != 'duotive-blogs'  && $page != 'duotive-pricing-table'  && $page != 'duotive-contact' ) {
		wp_enqueue_style('duotive-wordpress-css');
		wp_enqueue_style('colorpicker-css');	
		wp_enqueue_script('jquery-tools');
		wp_enqueue_script('jquery-colorpicker');	
		wp_enqueue_script('duotive-wordpress-js');
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//DEFINE WORDPRESS MENUS
	register_nav_menu('toptoolbar', 'Top Toolbar Menu');
	register_nav_menu('primary', 'Main Menu');
	register_nav_menu('footer', 'Footer Menu');
	//MAIM MENU REWRITE
	class DuotiveMenuWalker extends Walker_Nav_Menu
	{
		function start_el(&$output, $item, $depth, $args) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
				$filtered_description = '';
				if ( strlen($item->description) > 30 ) $filtered_description = '';
				else $filtered_description = $item->description;
				if ( $filtered_description == '' ):
					$item_output .= '<span class="description">&nbsp;</span>';
				else:
					$item_output .= '<span class="description">'.$filtered_description.'</span>';
				endif;			
			$item_output .= '</a>';
			$item_output .= $args->after;
	 
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	class DuotiveMenuWalkerWithoutDescription extends Walker_Nav_Menu
	{
		function start_el(&$output, $item, $depth, $args) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '<span class="description">&nbsp;</span>';		
			$item_output .= '</a>';
			$item_output .= $args->after;
	 
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//WORDPRESS TITLE REWRITE
	function wp_title_filter( $title, $separator ) {
		
		// RSS FEEDS ARE NOT AFFECTED
		if ( is_feed() ) return $title;
	
		global $paged, $page;
	
		//SEARCH TITLE MODIFICATION
		if ( is_search() ) {
			$title = sprintf( __( 'Search results for %s', 'duotive' ), ' " ' . get_search_query() . ' " ' );
			// ADD PAGE NUMBER TO TITLE IF YOU HAVE MORE THAN ONE PAGE
			if ( $paged >= 2 )
				$title .= " $separator " . sprintf( __( 'Page %s', 'duotive' ), $paged );
				$title .= " $separator " .get_bloginfo( 'name', 'display' );
			return $title;
		}
	
		// ADD SITE NAME TO THE END OF THE TITLE TAG
		$title .= get_bloginfo( 'name', 'display' );
	
		// ADD DESCRIPTION TO TITLE TAG IF YOUR ARE ON YOUR HOME PAGE
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) $title .= " $separator " . $site_description;
	
		// ADD PAGE NUMBER TO TITLE IF YOU HAVE MORE THAN ONE PAGE
		if ( $paged >= 2 || $page >= 2 ) $title .= " $separator " .  sprintf( __( 'Page %s', 'duotive' ), max( $paged, $page ) );
	
		return $title;
	}
	add_filter( 'wp_title', 'wp_title_filter', 10, 2 );
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function duotive_gravatar( $avatar_defaults ) {
		$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';
		$avatar_defaults[$myavatar] = 'Duotive Default Avatar';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'duotive_gravatar' );
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//WORDPRESS COMMENT STRUCTURE REWRITE
	
	if ( ! function_exists( 'comment_callback' ) ) :
	function comment_callback( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-wrapper clearfix">
			<div class="avatar-wrapper">
				<?php echo get_avatar( $comment, 74 ); ?>
			<!-- end of avatar -->
			</div>
            <div class="comment-header">
            	<div class="author-reply">
	                <div class="author"><?php echo get_comment_author_link(); ?></div>
                    <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
				<!-- author reply -->                    
                </div>
                <div class="comment-date"><?php echo get_comment_date(); ?> at <?php echo get_comment_time(); ?></div> 
			<!-- end of comment header -->                               
            </div>            
			<div class="comment-body">
				<?php comment_text(); ?>
			<!-- end of comment body -->        
			</div>
		<!-- end of comment wrapper -->
		</div>
	  <?php
				break;
			case 'pingback'  :
			case 'trackback' :
	  ?>
			<li class="post pingback">
			  <p>
				<?php __( 'Pingback:', 'duotive' ); ?>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __('Edit', 'duotive'), ' ' ); ?>
			  </p>
			  <?php
				break;
		endswitch;
	}
	endif;
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//WORDPRESS EXCERPT REWRITES
	
	function new_excerpt_more($more) {
		global $post;
		$extra_space = '';
		if ( is_search() ) $extra_space = '<br />';
		return '...<br />'.$extra_space.'<a class="more-link'.$extra_class.'" href="'. get_permalink($post->ID) . '">' . __('Read More &#187;','duotive') . '</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	function new_excerpt_length($length) {
		return 20;
	}
	add_filter('excerpt_length', 'new_excerpt_length');

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//DISPLAY THE TITLE OUTSIDE LOOP


	function get_title_outside_loop() { ?>
		<?php if ( is_page() || is_single()): ?>
        	<?php global $post; ?>
        	<?php $title = apply_filters( 'the_title', wp_trim_words( get_the_title($post->ID), 8, '&hellip;' ) );?>
        	<h1 <?php if (strlen($title) > "42") { echo "class='long-post-title'"; }?>>
            <?php 
            echo $title;?></h1>
            <?php elseif ( is_author() ): ?>
            <h1>
            <?php echo __('Author Archives: ', 'duotive'); ?>
            <?php $author_id = get_query_var('author'); ?>
            <?php $author = get_userdata($author_id); ?>
            <?php if ( $author->last_name != '' ) : ?>
                <?php echo $author->last_name; ?>
                <?php echo $author->first_name; ?>  
            <?php else: ?>
                <?php echo $author->user_login; ?>                                  
            <?php endif; ?>          
            </h1>
        <?php elseif(is_category()): ?>   
            <h1><?php echo __('Category Archives: ','duotive').single_cat_title( '', false ); ?></h1>
        <?php elseif (is_tag()): ?>
            <h1><?php echo __('Tag Archives: ','duotive').single_tag_title( '', false ); ?></h1>                            
        <?php elseif (is_search()): ?>
            <?php if(have_posts()): ?>
                <h1><?php echo __('Search results for ','duotive').get_search_query(); ?></h1>
            <?php else: ?>
                <h1><?php echo __('Not Found','duotive'); ?></h1>
            <?php endif; ?>
        <?php elseif(is_archive()): ?>
            <h1>
                <?php if ( is_day() ) :
                    echo __('Daily Archives ','duotive').get_the_date();
                        elseif ( is_month() ) :
                            echo __('Monthly Archives ','duotive').get_the_date('F Y');
                            elseif ( is_year() ) :
                                echo __('Yearly Archives ','duotive').get_the_date('Y');
                                else :
                                    echo __('Blog Archives','duotive');
                endif; ?>                                
            </h1>
        <?php elseif(is_404()): ?>
            <h1>
                <?php echo __('Not Found','duotive'); ?>                            
            </h1>
        <?php endif; ?>
	<?php } 
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//ADD COMMENT FORM FILTERS
	
	add_filter('comment_form_default_fields', 'duotive_edit_comment_form');
	function duotive_edit_comment_form($arg) {
		if ( !isset($aria_req) ) $aria_req = '';
		$commenter = wp_get_current_commenter();
		$author_input_template = '<p class="comment-form-author">';
			$author_input_template .= '<label for="author">' . __( 'Name:', 'duotive'  ) . '</label> ' . '<span class="required">*</span>';
			$author_input_template .= '<input class="required" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . ' />';
		$author_input_template .= '</p>';
		$email_input_template = '<p class="comment-form-email">';
			$email_input_template .= '<label for="email">' . __( 'Email:', 'duotive'  ) . '</label> ' . '<span class="required">*</span>';
			$email_input_template .= '<input class="required email" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' />';
		$email_input_template .= '</p>';		
		$url_input_template = '<p class="comment-form-url">';
			$url_input_template .= '<label for="url">' . __( 'Website', 'duotive' ) . ' <span class="optional">( ' . __( 'optional', 'duotive' ) . ' ):</span></label>';
			$url_input_template .= '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />';
		$url_input_template .= '</p>';	
    	$arg['author'] = $author_input_template;
		$arg['email'] = $email_input_template;
    	$arg['url'] = $url_input_template;
    	return $arg;
	}	
	
	add_filter('comment_form_defaults', 'duotive_comment_field');
	function duotive_comment_field($arg) {
		$comment_field_template = '<p class="comment-form-comment">';
			$comment_field_template .= '<label for="comment">' . __( 'Comment:', 'duotive'  ) . '</label>' . '<span class="required">*</span>';
			$comment_field_template .= '<textarea class="required" id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>';
		$comment_field_template .= '</p>';	
		$arg['comment_field'] = $comment_field_template;
    	return $arg;
	}
	
	add_filter('comment_form_defaults', 'duotive_comment_labels');
	function duotive_comment_labels($arg) {
		$arg['title_reply'] = __( 'Leave a reply', 'duotive'  );
		$arg['title_reply_to'] = __( 'Leave a reply to %s', 'duotive'  );
		$arg['cancel_reply_link'] = __( 'Cancel reply', 'duotive'  );
		$arg['label_submit'] = __( 'Post Comment', 'duotive'  );
		$arg['comment_notes_before'] = '';
		$required_text = __('Required fields are marked ','duotive').'<span class="required">*</span>';
		$arg['comment_notes_after'] = '<p class="comment-notes">' . __( 'Your email address will not be published. ', 'duotive' ) . $required_text . '</p>';
    	return $arg;
	}	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//ADD UPLOAD BUTTON TO THE THEME	
	
	function duotive_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
	
	function duotive_admin_styles() {
		wp_enqueue_style('thickbox');
	}

	if (isset($_GET['page']) && ( $_GET['page'] == 'duotive-slider' || $_GET['page'] == 'duotive-panel' ) ) {
		add_action('admin_print_scripts', 'duotive_admin_scripts');
		add_action('admin_print_styles', 'duotive_admin_styles');
	}	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//WORDPRESS FILTERS
	
	add_theme_support('automatic-feed-links');	
	function add_oembed_div($html, $url, $attr) {
		return '<div class="duotive-video-embed">'.$html.'</div>';
	}
	add_filter('embed_oembed_html', 'add_oembed_div', 50, 3);
	
	function remove_wpautop($content) { 
		$content = do_shortcode( shortcode_unautop($content) ); 
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		return $content;
	}

	add_theme_support( 'post-thumbnails' );
	add_filter('widget_text', 'do_shortcode');
	add_filter('widget_title', 'do_shortcode');
	
	function remove_pagenavi_styles() {
		wp_deregister_style( 'wp-pagenavi' );
	}
	add_action( 'wp_print_styles', 'remove_pagenavi_styles', 100 );

?>