jQuery(document).ready(function() {
	jQuery('img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});								   						   
	jQuery("#duotive-options div.table-row:even").addClass('table-row-alternative');
	jQuery("#duotive-options div.table-row:last").addClass('table-row-last');	
	jQuery('#subheader-overlay-color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
		},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});	
});