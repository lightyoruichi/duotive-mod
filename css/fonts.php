<?php header("Content-type: text/css"); ?>
<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
?>
<?php $font = get_option('font'); ?>
<?php if ( $font != '' ): ?>
	<?php $fontfamily = str_replace('custom/','',$font); ?>
@font-face {
    font-family: '<?php echo $fontfamily; ?>';
    src: url('<?php echo get_bloginfo( 'template_url' ); ?>/fonts/<?php echo $font; ?>-webfont.eot');
    src: url('<?php echo get_bloginfo( 'template_url' ); ?>/fonts/<?php echo $font; ?>-webfont.eot?iefix') format('eot'),
         url('<?php echo get_bloginfo( 'template_url' ); ?>/fonts/<?php echo $font; ?>-webfont.woff') format('woff'),
         url('<?php echo get_bloginfo( 'template_url' ); ?>/fonts/<?php echo $font; ?>-webfont.ttf') format('truetype'),
         url('<?php echo get_bloginfo( 'template_url' ); ?>/fonts/<?php echo $font; ?>-webfont.svg#webfontQ5EXXZTZ') format('svg');
    font-weight: normal;
    font-style: normal;
}
<?php endif; ?>
#sub-header-content h1,
#fullwidth-slider #slider-text li a,
#fullwidth-slider #contentbox li h5,
#front-page-business .front-page-post h3 a:link,
#front-page-business .front-page-post h3 a:visited,
#toptoolbar .menu-toptoolbar ul li a,
.menu-header ul:first-child > li > a,
#content-slider-wrapper .side-description .content strong,
#content div.blog-modern-wrapper span.post-date,
#content div.blog-modern-wrapper span.post-comments a,
#content #blog-accordion span.post-date strong,
#content #blog-accordion span.post-date strong em,
#content #blog-accordion span.post-comments a,
#content #blog-accordion h3 a,
#content .blog-modern-wrapper .post-big-meta span.post-date strong,
#content .tabs ul.ui-tabs-nav li a,
#content div.quote-float,
#content table thead tr th,
#content p.intro,
#content table.pricing tr.buttons td a.button,
#content .button-large:link,
#content .button-large:visited,
#navigation .wp-pagenavi span.pages,
li.twitter a.follow-url,
#sidebar #calendar_wrap caption,
#comments div.comment-header div.author,
#comments div.comment-header div.author a:link,
#comments div.comment-header div.author a:visited,
#author-description a.more-url:link,
#author-description a.more-url:visited,
#respond h3 a:link,
#respond h3 a:visited,
#intro p,
h1,
h1 a,
h2,
h2 a,
h3,
h3 a,
h4,
h5,
h6,
h6 a
{
	font-family:<?php if ( $font != '' ) echo $fontfamily.','; ?> Georgia, "Times New Roman", serif;
}