<?php 
function widgets_areas_initialization() {
	
	// FRONT PAGE WIDGET AREAS
	for ( $i = 1; $i<=4;$i++)
	{
		register_sidebar( array(
			'name' => 'FP Business Area No.'.$i,
			'id' => 'front-page-business-'.$i,
			'description' => 'Widget area for home business layout, location number '.$i.'.',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',		
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
		) );	
	}
	register_sidebar( array(
		'name' => 'FP Page News Area',
		'id' => 'front-page-news-area',
		'description' => 'Widget area that will be displayed only on your front page.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
	) );	
	for ( $i = 1; $i<=3;$i++)
	{
		register_sidebar( array(
			'name' => 'FP Presentation row #1 No.'.$i,
			'id' => 'front-page-presentation-row1-'.$i,
			'description' => 'Widget area for home presentation top row #1, location number '.$i.'.',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',		
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
		) );	
	}
	for ( $i = 1; $i<=2;$i++)
	{
		register_sidebar( array(
			'name' => 'FP Presentation row #3 No.'.$i,
			'id' => 'front-page-presentation-row3-'.$i,
			'description' => 'Widget area for home presentation top row #3, location number '.$i.'.',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',		
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
		) );	
	}	
	for ( $i = 1; $i<=3;$i++)
	{
		register_sidebar( array(
			'name' => 'FP Presentation row #4 No.'.$i,
			'id' => 'front-page-presentation-row4-'.$i,
			'description' => 'Widget area for home presentation top row #4, location number '.$i.'.',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',		
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
		) );	
	}		
	//PREDEFINED SIDEBARS
	register_sidebar( array(
		'name' => 'General Before All Widget Area',
		'id' => 'general-up-widget-area',
		'description' => 'Widget area that will be displayed before all other widgets.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
	) );
	
	//CUSTOM SIDEBARS
	$sidebars = sidebars_require();
	if ( count($sidebars) > 0 ):
		foreach ( $sidebars as $sidebar):
		   register_sidebar( array(
				'name' =>  $sidebar->NAME,
				'id' => str_replace(' ','-',strtolower($sidebar->NAME)),
				'description' => $sidebar->DESCRIPTION ,
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',		
				'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</li>',
			) );		
		   
		endforeach;
	endif; 					

	//PREDEFINED SIDEBARS
	register_sidebar( array(
			'name' => 'Search Widget Area',
			'id' => 'search-widget-area',
			'description' => 'Widget area that will be displayed only when viewing search results.' ,
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',		
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
		) );	
		
	register_sidebar( array(
		'name' => 'Front Page Widget Area',
		'id' => 'front-page-widget-area',
		'description' => 'Widget area that will be displayed only on your front page.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
	) );	

	register_sidebar( array(
		'name' => 'Single Post Widget Area',
		'id' => 'single-post-widget-area',
		'description' => 'Widget area that will be displayed only on single posts.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
	) );

	register_sidebar( array(
		'name' => 'Single Page Widget Area',
		'id' => 'single-page-widget-area',
		'description' => 'Widget area that will be displayed only on single pages.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
	) );

	register_sidebar( array(
		'name' => 'Archive Widget Area',
		'id' => 'archive-widget-area',
		'description' => 'Widget area that will be displayed only when viewing all archive listing.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
	) );

	register_sidebar( array(
		'name' => 'General After All Widget Area',
		'id' => 'general-down-widget-area',
		'description' => 'Widget area that will be displayed after all other widgets.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
	) );
	
	//FOOTER WIDGET AREAS
	
	for ( $i = 1; $i<=4;$i++)
	{
		register_sidebar( array(
			'name' => 'Footer Tabs Area No.'.$i,
			'id' => 'footer-tabs-'.$i,
			'description' => 'Widget area for footer tabs, location number '.$i.'.',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',		
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
		) );	
	}	
}
add_action( 'widgets_init', 'widgets_areas_initialization' );
?>