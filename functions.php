<?php
if ( !is_admin() ) {
	//ENQUEUE JS SCRIPTS FRONTEND
   	$dir = get_bloginfo('template_directory');
	wp_deregister_script("jquery");
	wp_enqueue_script("jquery", $dir."/js/jquery.js", false, null);
	wp_enqueue_script("jquery.scripts", $dir."/js/jquery.scripts.js", false, null);		
    wp_enqueue_script("jquery.custom", $dir."/js/jquery.custom.js", false, null); 
 	wp_enqueue_script("mootools", $dir."/js/mootools.js", false, null, true); 
}

	//ADD ADMIN TO THEME
	require_once('includes/duotive-admin/duotive-main.php');
	require_once('includes/duotive-admin/duotive-front-page-manager.php');		
	require_once('includes/duotive-admin/duotive-slider.php');	
	require_once('includes/duotive-admin/duotive-sidebars.php');	
	require_once('includes/duotive-admin/duotive-portfolios.php');
	require_once('includes/duotive-admin/duotive-blogs.php');
	require_once('includes/duotive-admin/duotive-pricingtable.php');	
	require_once('includes/duotive-admin/duotive-contact.php');
	//ADD FUNCTIONALITY TO THEME
	require_once('includes/gallery.php');	
	require_once('includes/shortcodes.php');	
	require_once('includes/widget-areas.php');
	require_once('includes/wordpress-reset-functions.php');
	require_once('includes/meta-framework.php');		
	require_once('includes/meta.php');	
	require_once('includes/duotive-shortcode-manager/duotive-shortcode-manager.php');
?>