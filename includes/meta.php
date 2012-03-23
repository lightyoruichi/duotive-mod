<?php
/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend RW_Meta_Box class
 * Add field type: 'taxonomy'
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = '';

$meta_boxes = array();
	
	$sidebar_array = array("No Sidebar" => "No Sidebar" );
	$sidebars = sidebars_require();
	if ( count($sidebars) > 0 )
	{	
		$i = 0;
		foreach ( $sidebars as $sidebar)
		{
			$sidebar_array[$sidebar->NAME] = $sidebar->NAME;
		}
	}

	$subheaderpatterns = array();
	$subheaderpatterns['inherit-from-slideshow'] = 'Inherit from slideshow';
	$subheaderpatterns[''] = 'No pattern';
	$subheaderpatterns['subheader-pattern-dot'] = 'Dots';
	$subheaderpatterns['subheader-pattern-spaced-dot'] = 'Dots [ spaced ]';
	$subheaderpatterns['subheader-pattern-diagonal-left-dotted Dots'] = '[ left diagonal ]';
	$subheaderpatterns['subheader-pattern-diagonal-right-dotted Dots'] = '[ right diagonal ]';                                
	$subheaderpatterns['subheader-pattern-diagonal-left'] = 'Diagonal [ left ]';
	$subheaderpatterns['subheader-pattern-diagonal-right'] = 'Diagonal [ right ]'; 
	$subheaderpatterns['subheader-pattern-x'] = '[ x ]';                                                                                                        
	$subheaderpatterns['subheader-pattern-plus'] = '[ + ]';
	$subheaderpatterns['subheader-pattern-metal'] = 'Metal';
	$subheaderpatterns['subheader-pattern-box-1'] = 'Box [ 1 ]';
	$subheaderpatterns['subheader-pattern-box-2'] = 'Box [ 2 ]';
	$subheaderpatterns['subheader-pattern-grid-1'] = 'Grid [ 1 ]';
	$subheaderpatterns['subheader-pattern-grid-2'] = 'Grid [ 2 ]'; 
	$subheaderpatterns['subheader-pattern-grid-1'] = 'Grid [ 1 ]';
	$subheaderpatterns['subheader-pattern-diagonal-grid'] = 'Grid [ diagonal ]'; 
	$subheaderpatterns['subheader-pattern-vertical-lines'] = 'Lines [ vertical ]'; 
	$subheaderpatterns['subheader-pattern-horizontal-lines'] = 'Lines [ horizontal ]';
	$subheaderpatterns['subheader-pattern-vertical-zigzag'] = 'Zig Zag [ vertical ]';
	$subheaderpatterns['subheader-pattern-horizontal-zigzag'] = 'Zig Zag [ horizontal ]';
	
	$portfolio_behaviour = array();
	$portfolio_behaviour['Open portfolio item'] = 'Open portfolio item';
	$portfolio_behaviour['Open image in modal'] = 'Open image in modal';
	$portfolio_behaviour['Open video in modal'] = 'Open video in modal';

	$meta_boxes[] = array(
		'id' => 'duotive-options',
		'title' => 'Duotive Options',
		'pages' => array('post', 'page'),
		'fields' => array(
			array(
				'name' => 'Background image:',
				'desc' => 'Background image that will be displayed in this post or page only. The slideshow image will be inherited by default. Type "no-image" to get only a backgound color and a pattern.',
				'id' => $prefix . 'background-image',
				'type' => 'text'
			),		
			array(
				'name' => 'Subheader patterns:',
				'id' => $prefix . 'sub-header-pattern',
				'type' => 'select',
				'options' => $subheaderpatterns,
				'desc' => 'Select the pattern overlay for the post/page'
			),	
			array(
				'name' => 'Subheader pattern opacity:',
				'desc' => 'The subheader pattern opacity. Values are from 0.0 to 1.0.',
				'id' => $prefix . 'sub-header-opacity',
				'type' => 'text'
			),
			array(
				'name' => 'Color overlay:',
				'id' => $prefix . 'subheader-overlay-color',
				'type' => 'color',
				'desc' => 'Choose the color for the overlay with the picture. If this is left empty it will use the theme\'s color.'
			),		
			array(
				'name' => 'Sidebar name:',
				'id' => $prefix . 'sidebars',
				'type' => 'select',
				'options' => $sidebar_array,
				'desc' => 'Select the name of the sidebar you want to be displayed on this page/post'
			),
			array(
				'name' => 'Portfolio image behaviour:',
				'id' => $prefix . 'behaviour',
				'type' => 'select',
				'options' => $portfolio_behaviour,
				'desc' => 'What happens when you click the portfolio image.'
			),
			array(
				'name' => 'Portfolio video URL:',
				'desc' => 'URL for the video that will open when the portfolio image will be clicked.',
				'id' => $prefix . 'portfolio-video',
				'type' => 'text'
			)		
		)
	);

foreach ($meta_boxes as $meta_box) {
	$my_box = new RW_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/
?>