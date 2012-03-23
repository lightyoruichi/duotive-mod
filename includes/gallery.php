<?php
	add_filter( 'post_gallery', 'duotive_gallery', 10, 2 );
	function duotive_gallery ( $output, $attr) {
		global $post, $wp_locale;
	
		static $instance = 0;
		$instance++;
	
		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}
	
		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		), $attr));
	
		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';
	
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
	
		if ( empty($attachments) )
			return '';
	
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
	
		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';
	
		$selector = "gallery-{$instance}";
	
		$output = '<div class="gallery-wrapper">';
		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
			$template_directory = get_bloginfo('template_directory');
			$class = '';
			if ( $columns > 0 &&  ++$i % $columns == 0 ) $class = ' duotive-gallery-item-last';
			$output .= "<{$itemtag} class='duotive-gallery-item".$class."'>";
			$output .= "<{$icontag} class='gallery-icon pageflip'>";
				$output .= "<span class=\"icon icon-zoom\">&nbsp;</span>";
				$output .=  "<img class=\"flip\" src=\"$template_directory/images/page_flip.png\" />";
				$output .= "$link";
			$output .= "</{$icontag}>";
			$output .= "<dd>&nbsp;</dd>";
/*			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "<{$captiontag} class='gallery-caption'>";
				$output .= wptexturize($attachment->post_excerpt);
				$output .= "</{$captiontag}>";
			}
*/			
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && $i % $columns == 0 ) $output .= '<div class="duotive-gallery-separator"></div>';
		}
	
		$output .= "</div>";
	
		return $output;
	}

	// IMAGE SIZES FOR GALLERY ON FULL WIDTH	
	add_image_size( 'onethirdsquare', 300, 300, true );
	add_image_size( 'oneforthsquare', 217, 217, true );
	add_image_size( 'onefifthsquare', 168, 168, true );
	add_image_size( 'onesixthsquare', 135, 135, true );
	
	add_image_size( 'onethirdlandscape', 300, 200, true );
	add_image_size( 'oneforthlandscape', 217, 146, true );
	add_image_size( 'onefifthlandscape', 168, 112, true );
	add_image_size( 'onesixthlandscape', 135, 90, true );
	
	add_image_size( 'onethirdportrait', 300, 400, true );
	add_image_size( 'oneforthportrait', 217, 320, true );	
	
	//IMAGE SIZE FOR GALLERY WITH SIDEBAR
	add_image_size( 'onehalfsquare-inpost', 300, 300, true );
	add_image_size( 'onethirdsquare-inpost', 190, 190, true );	
	add_image_size( 'oneforthsquare-inpost', 135, 135, true );
	
	add_image_size( 'onehalflandscape-inpost', 300, 200, true );
	add_image_size( 'onethirdlandscape-inpost', 190, 122, true );	
	add_image_size( 'oneforthlandscape-inpost', 135, 86, true );
	
	add_image_size( 'onehalfportrait-inpost', 300, 400, true );
	add_image_size( 'onethirdportrait-inpost', 190, 256, true );	
	add_image_size( 'oneforthportrait-inpost', 135, 183, true );	
	
?>