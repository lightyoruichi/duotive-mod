<?php header("Content-type: text/css"); ?>
<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );

	$slideshow_background_image =  get_option('slideshow_background_image'); 
    if ( $slideshow_background_image == '' ) $slideshow_background_image = 'disabled';
     $slideshow_background_color =  get_option('slideshow_background_color');
    if ( $slideshow_background_color == '' ) $slideshow_background_color = 'disabled'; 
?>
#slideshow-wrapper {
	<?php if ( $slideshow_background_color == 'disabled' ) : ?>
    	background-color: #FFF;
    <?php else: ?>
    	background-color: #<?php echo $slideshow_background_color; ?>;
    <?php endif; ?>
    <?php if ( $slideshow_background_image == 'disabled' ) : ?>
		background-image:none;
    <?php else: ?>
   		background-image: url(<?php echo $slideshow_background_image; ?>);
    <?php endif; ?>
    background-repeat:  no-repeat;
    background-position: center center;
}
<?php $sliderpatternopacity = get_option('sliderpatternopacity'); ?>
#slideshow-pattern{
	opacity:<?php echo $sliderpatternopacity; ?>;
    filter: alpha(opacity=<?php echo 100*(float)$sliderpatternopacity; ?>);
    -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo 100*(float)$sliderpatternopacity; ?>)";
}
<?php 
    $themecolor =  get_option('themecolor');
    if ( $themecolor == '' ) $themecolor = 'db6e0d';
	if ( isset($_GET['postid']) ):
		$postid = $_GET['postid'];
		$sub_header_background_image = get_post_meta($postid, "background-image", true);
		$sub_header_overlay_color_cleaned = str_replace('#', '', get_post_meta($postid, "subheader-overlay-color", true));
		$sub_header_overlay_color = '#'.$sub_header_overlay_color_cleaned;
		$sub_header_opacity = get_post_meta($postid, "sub-header-opacity", true);
	endif; 
	if ( $sub_header_overlay_color == '#' ) $sub_header_overlay_color = '#'.$themecolor;
	if ( $sub_header_opacity == '' ) $sub_header_opacity = 0.5;
?>
<?php if ( $sub_header_background_image != 'no-image') : ?>
<?php if ( $sub_header_background_image == '' ) $sub_header_background_image = $slideshow_background_image; ?>
#sub-header-content-wrapper {
    background-image: url(<?php echo $sub_header_background_image; ?>);
    background-repeat:  no-repeat;
    background-position: center center;
}
<?php endif; ?>
#sub-header-content-pattern {
	opacity:<?php echo $sub_header_opacity; ?>;
    filter: alpha(opacity=<?php echo 100*(float)$sub_header_opacity; ?>);
    -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo 100*(float)$sub_header_opacity; ?>)";
}
#sub-header-color-overlay {
	background:<?php echo $sub_header_overlay_color; ?>;
}