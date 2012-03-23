<?php 
//ADD BUTTON FOR IMAGE FRAMES
add_action('init', 'add_button_image');  
function add_button_image() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_image');
		add_filter('mce_buttons', 'register_button_image');
	}
}

function register_button_image($buttons) {
	array_push($buttons, "image");
	return $buttons;
}

function add_plugin_image($plugin_array) {  
	$plugin_array['image'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/image/image-plugin.js';  
	return $plugin_array;  
}
//ADD BUTTON EMBEDDED VIDEO
add_action('init', 'add_button_video');  
function add_button_video() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_video');
		add_filter('mce_buttons', 'register_button_video');
	}
}

function register_button_video($buttons) {
	array_push($buttons, "video");
	return $buttons;
}

function add_plugin_video($plugin_array) {  
	$plugin_array['video'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/video/video-plugin.js';  
	return $plugin_array;  
}
//ADD BUTTON FOR LISTS
add_action('init', 'add_button_lists');  
function add_button_lists() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_lists');
		add_filter('mce_buttons', 'register_button_lists');
	}
}

function register_button_lists($buttons) {
	array_push($buttons, "lists");
	return $buttons;
}

function add_plugin_lists($plugin_array) {  
	$plugin_array['lists'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/lists/lists-plugin.js';  
	return $plugin_array;  
}  
//ADD BUTTON FOR COLUMNS
add_action('init', 'add_button_columns');  
function add_button_columns() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_columns');
		add_filter('mce_buttons', 'register_button_columns');
	}
}

function register_button_columns($buttons) {
	array_push($buttons, "columns");
	return $buttons;
}

function add_plugin_columns($plugin_array) {  
	$plugin_array['columns'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/columns/columns-plugin.js';  
	return $plugin_array;  
}  
//ADD BUTTON FOR CONTENT HOLDERS
add_action('init', 'add_button_content_holders');  
function add_button_content_holders() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_content_holders');
		add_filter('mce_buttons', 'register_button_content_holders');
	}
}

function register_button_content_holders($buttons) {
	array_push($buttons, "contentHolders");
	return $buttons;
}

function add_plugin_content_holders($plugin_array) {  
	$plugin_array['contentHolders'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/content-holders/content-holders-plugin.js';  
	return $plugin_array;  
}  
//ADD BUTTON FOR SLIDESHOW
add_action('init', 'add_button_slideshow');  
function add_button_slideshow() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_slideshow');
		add_filter('mce_buttons', 'register_button_slideshow');
	}
}

function register_button_slideshow($buttons) {
	array_push($buttons, "slideshow");
	return $buttons;
}

function add_plugin_slideshow($plugin_array) {  
	$plugin_array['slideshow'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/slideshow/slideshow-plugin.js';  
	return $plugin_array;  
}
//ADD BUTTON FOR TABS
add_action('init', 'add_button_tabs');  
function add_button_tabs() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_tabs');
		add_filter('mce_buttons', 'register_button_tabs');
	}
}

function register_button_tabs($buttons) {
	array_push($buttons, "tabs");
	return $buttons;
}

function add_plugin_tabs($plugin_array) {  
	$plugin_array['tabs'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/tabs/tabs-plugin.js';  
	return $plugin_array;  
}
//ADD BUTTON FOR ACCORDION
add_action('init', 'add_button_accordion');  
function add_button_accordion() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_accordion');
		add_filter('mce_buttons', 'register_button_accordion');
	}
}

function register_button_accordion($buttons) {
	array_push($buttons, "accordion");
	return $buttons;
}

function add_plugin_accordion($plugin_array) {  
	$plugin_array['accordion'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/accordion/accordion-plugin.js';  
	return $plugin_array;  
}
//ADD BUTTON FOR TOUR
add_action('init', 'add_button_tour');  
function add_button_tour() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_tour');
		add_filter('mce_buttons', 'register_button_tour');
	}
}

function register_button_tour($buttons) {
	array_push($buttons, "tour");
	return $buttons;
}

function add_plugin_tour($plugin_array) {  
	$plugin_array['tour'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/tour/tour-plugin.js';  
	return $plugin_array;  
}
//ADD BUTTON FOR Q/A
add_action('init', 'add_button_qa');  
function add_button_qa() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_qa');
		add_filter('mce_buttons', 'register_button_qa');
	}
}

function register_button_qa($buttons) {
	array_push($buttons, "qa");
	return $buttons;
}

function add_plugin_qa($plugin_array) {  
	$plugin_array['qa'] = get_bloginfo('template_url').'/includes/duotive-shortcode-manager/shortcodes/qa/qa-plugin.js';  
	return $plugin_array;  
}
?>