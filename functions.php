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
	
	
		//Custom made walker for wp_nav_menu
		
class UL_Class_Walker extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu sf-js-enabled";
  }
}


	//Hooks to add "placeholder" into Gravity form via Hooks

/* Add a custom field to the field editor (See editor screenshot) */
add_action("gform_field_standard_settings", "my_standard_settings", 10, 2);
function my_standard_settings($position, $form_id){
// Create settings on position 25 (right after Field Label)
if($position == 25){
?>
<li class="admin_label_setting field_setting" style="display: list-item; ">
<label for="field_placeholder">Placeholder Text
<!-- Tooltip to help users understand what this field does -->
<a href="javascript:void(0);" class="tooltip tooltip_form_field_placeholder" tooltip="&lt;h6&gt;Placeholder&lt;/h6&gt;Enter the placeholder/default text for this field.">(?)</a>
</label>
<input type="text" id="field_placeholder" class="fieldwidth-3" size="35" onkeyup="SetFieldProperty('placeholder', this.value);">
</li>
<?php
}
}

/* Now we execute some javascript technicalitites for the field to load correctly */
add_action("gform_editor_js", "my_gform_editor_js");
function my_gform_editor_js(){
?>
<script>
//binding to the load field settings event to initialize the checkbox
jQuery(document).bind("gform_load_field_settings", function(event, field, form){
jQuery("#field_placeholder").val(field["placeholder"]);
});
</script>
<?php
}

/* We use jQuery to read the placeholder value and inject it to its field */
add_action('gform_enqueue_scripts',"my_gform_enqueue_scripts", 10, 2);
function my_gform_enqueue_scripts($form, $is_ajax=false){
?>
<script>
jQuery(function(){
<?php
/* Go through each one of the form fields */
foreach($form['fields'] as $i=>$field){
/* Check if the field has an assigned placeholder */
if(isset($field['placeholder']) && !empty($field['placeholder'])){
/* If a placeholder text exists, inject it as a new property to the field using jQuery */
?>
jQuery('#input_<?php echo $form['id']?>_<?php echo $field['id']?>').attr('placeholder','<?php echo $field['placeholder']?>');
<?php
}
}
?>
});
</script>
<?php
}
?>	