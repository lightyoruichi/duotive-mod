<?php
//CREATE DATABASE
	//CREATE FUNCTION
	function create_db2 () {
		global $wpdb;
		$create_query = 'CREATE TABLE `duotive_portfolio` (
							`ID` INT NOT NULL AUTO_INCREMENT ,
							`PAGE` TEXT NOT NULL ,
							`CATEGORY` TEXT NOT NULL,
							PRIMARY KEY ( `ID` )
						) ENGINE = MYISAM ;
						';
		$create = $wpdb->get_results($create_query);
	}
	//CHECK FUNCTION
	if ( check_db_existance('duotive_portfolio') == '') create_db2();
	function insert_portfolio_in_db( $page='no-title',$category='no-text') {
			global $wpdb;
			if ( is_array($category)):
				$category_to_insert = '';
				$array_lenght = sizeof($category);						
				$i = 1;
				foreach($category as $cat):
					if ( $i < $array_lenght ) $category_to_insert .= $cat.', ';
					else $category_to_insert .= $cat;
					$i++;
				endforeach;
			else:
				$category_to_insert = $category;
			endif;
			$insert_query = "INSERT INTO `duotive_portfolio` (`ID`, `PAGE`, `CATEGORY`) VALUES ('NULL', '".$page."', '".$category_to_insert."');";
			$insert = $wpdb->get_results($insert_query);
	}	
	//GET PORTFOLIO PAGES FORM DB
	function portfolio_require () {
		global $wpdb;		
		$portfolio_require_query = 'SELECT * FROM duotive_portfolio ORDER BY ID ASC';	
		$portfolio_require = $wpdb->get_results($portfolio_require_query);
		return $portfolio_require;
	}
	//DELETE PORTFOLIO PAGES FORM DB
	function delete_portfolio($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM duotive_portfolio WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
	}	
	// ADD THE PORTFOLIO OPTIONS PAGE TO ADMIN
	function portfolio_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Portfolio Options', 'Portfolios', 'manage_options', 'duotive-portfolios', 'portfolio_page');
	}

	function portfolio_page() 
	{
	
		if ( isset($_POST['portfolio_update']) && $_POST['portfolio_update'] == 'true' ) { portfolio_update(); }
		
?>
	<?php $categories = ''; $pages = ''; ?>
	<?php if(isset($_POST['categories'])) $categories = $_POST['categories']; ?>
    <?php if(isset($_POST['pages'])) $pages = $_POST['pages']; ?>
    <?php if( $categories != '' && $pages != '' ) insert_portfolio_in_db($pages,$categories); ?>   
   	<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/duotive-admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/colorpicker.css" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/jqtransform.css" /> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/colorpicker.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.jqtransform.js" /></script> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.tools.min.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery-ui.min.js" /></script>        
    <script type="text/javascript">
		$(document).ready(function() {
			jQuery('#duotive-admin-panel img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});									 								   
			$(".transform").jqTransform();
			$("#duotive-admin-panel" ).tabs();
			$("#duotive-admin-panel div.table-row:even").addClass('table-row-alternative');
			$('#settings .table-row-last').prev('div').addClass('table-row-beforelast');
			$('#addportfolio .table-row-last').prev('div').addClass('table-row-beforelast');			
		});
	</script> 
<div class="wrap">
    <div id="duotive-logo">Duotive Admin Panel</div>
    <div id="duotive-main-menu">
        <ul>
            <li><a href="admin.php?page=duotive-panel">General settings</a></li>
            <li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            <li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            <li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li> 
            <li class="active"><a href="admin.php?page=duotive-portfolios">Portfolios</a></li> 
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
			<li><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li>
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>           
        </ul>
    </div>
    <div id="duotive-admin-panel">
    	<h3>Portfolios</h3>
        <ul>
            <li><a href="#settings">Portfolios settings</a></li>
            <li><a href="#portfolios">Current portfolios</a></li>
            <li class="plus"><a class="plus" href="#addportfolio"><span class="deco"></span>Add a new portfolio</a></li>            
        </ul>
        <div id="settings">
            <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-portfolios#settings" class="transform">
	            <input type="hidden" name="portfolio_update" value="true" />  
                <div class="table-row clearfix">     
                    <label for="portfolio-full-imagegrid">Full-width image-grid items/page:</label>
                    <input type="text" name="portfolio-full-imagegrid" value="<?php echo get_option('portfolio-full-imagegrid'); ?>"/>
                </div>                 
                <div class="table-row clearfix">     
                    <label for="portfolio-full-1columns">Full-width 1 column items/page:</label>
                    <input type="text" name="portfolio-full-1columns" value="<?php echo get_option('portfolio-full-1columns'); ?>"/>
                </div>
                <div class="table-row clearfix">     
                    <label for="portfolio-full-2columns">Full-width 2 columns items/page:</label>
                    <input type="text" name="portfolio-full-2columns" value="<?php echo get_option('portfolio-full-2columns'); ?>"/>
                </div>                                
                <div class="table-row clearfix">     
                    <label for="portfolio-full-2columns-2">Full-width 2 columns #2 items/page:</label>
                    <input type="text" name="portfolio-full-2columns-2" value="<?php echo get_option('portfolio-full-2columns-2'); ?>"/>
                </div>
                <div class="table-row clearfix">     
                    <label for="portfolio-full-3columns">Full-width 3 columns + B&W items/page:</label>
                    <input type="text" name="portfolio-full-3columns" value="<?php echo get_option('portfolio-full-3columns'); ?>"/>
                </div> 
                <div class="table-row clearfix">     
                    <label for="portfolio-full-5columns-circle">Full-width 5 circle items/page:</label>
                    <input type="text" name="portfolio-full-5columns-circle" value="<?php echo get_option('portfolio-full-5columns-circle'); ?>"/>
                </div>  
                <div class="table-row clearfix">     
                    <label for="portfolio-sidebar-circle">With sidebar circle + B&W items/page:</label>
                    <input type="text" name="portfolio-sidebar-circle" value="<?php echo get_option('portfolio-sidebar-circle'); ?>"/>
                </div>   
                <div class="table-row clearfix">     
                    <label for="portfolio-sidebar-square">With sidebar square + B&W items/page:</label>
                    <input type="text" name="portfolio-sidebar-square" value="<?php echo get_option('portfolio-sidebar-square'); ?>"/>
                </div>                   
                <div class="table-row clearfix">     
                    <label for="portfolio-sidebar-slideshow">With sidebar slideshow items/page:</label>
                    <input type="text" name="portfolio-sidebar-slideshow" value="<?php echo get_option('portfolio-sidebar-slideshow'); ?>"/>
                </div> 
                <div class="table-row clearfix">     
                    <label for="portfolio-sidebar-slideshow-transition">With sidebar slideshow transition:</label>
                    <select name="portfolio-sidebar-slideshow-transition">
                      	<?php $portfolio_sidebar_slideshow_transition = get_option('portfolio-sidebar-slideshow-transition'); ?>
                        <option value="sliceDown" <?php if ($portfolio_sidebar_slideshow_transition=='sliceDown') { echo 'selected'; } ?> >sliceDown</option>
                        <option value="sliceDownLeft" <?php if ($portfolio_sidebar_slideshow_transition=='sliceDownLeft') { echo 'selected'; } ?> >sliceDownLeft</option>
                        <option value="sliceUp" <?php if ($portfolio_sidebar_slideshow_transition=='sliceUp') { echo 'selected'; } ?> >sliceUp</option>
                        <option value="sliceUpLeft" <?php if ($portfolio_sidebar_slideshow_transition=='sliceUpLeft') { echo 'selected'; } ?> >sliceUpLeft</option>
                        <option value="sliceUpDown" <?php if ($portfolio_sidebar_slideshow_transition=='sliceUpDown') { echo 'selected'; } ?> >sliceUpDown</option>
                        <option value="sliceUpDownLeft" <?php if ($portfolio_sidebar_slideshow_transition=='sliceUpDownLeft') { echo 'selected'; } ?> >sliceUpDownLeft</option>
                        <option value="fold" <?php if ($portfolio_sidebar_slideshow_transition=='fold') { echo 'selected'; } ?> >fold</option>
                        <option value="fade" <?php if ($portfolio_sidebar_slideshow_transition=='fade') { echo 'selected'; } ?> >fade</option>
                        <option value="random" <?php if ($portfolio_sidebar_slideshow_transition=='random') { echo 'selected'; } ?> >random</option>
                        <option value="slideInRight" <?php if ($portfolio_sidebar_slideshow_transition=='slideInRight') { echo 'selected'; } ?> >slideInRight</option>
                        <option value="slideInLeft" <?php if ($portfolio_sidebar_slideshow_transition=='slideInLeft') { echo 'selected'; } ?> >slideInLeft</option>
                        <option value="boxRandom" <?php if ($portfolio_sidebar_slideshow_transition=='boxRandom') { echo 'selected'; } ?> >boxRandom</option>                            
                        <option value="boxRain" <?php if ($portfolio_sidebar_slideshow_transition=='boxRain') { echo 'selected'; } ?> >boxRain</option>                            
                        <option value="boxRainReverse" <?php if ($portfolio_sidebar_slideshow_transition=='boxRainReverse') { echo 'selected'; } ?> >boxRainReverse</option>                            
                        <option value="boxRainGrow" <?php if ($portfolio_sidebar_slideshow_transition=='boxRainGrow') { echo 'selected'; } ?> >boxRainGrow</option>                            
                        <option value="boxRainGrowReverse" <?php if ($portfolio_sidebar_slideshow_transition=='boxRainGrowReverse') { echo 'selected'; } ?> >boxRainGrowReverse</option>                                                                                                                                            
                    </select>
                    <img class="hint-icon" title="The transition effect between the images in the slideshow." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                </div>                   
                <div class="table-row clearfix">     
                    <label for="portfolio-sidebar-slideshow-2">With sidebar slideshow 2 items/page:</label>
                    <input type="text" name="portfolio-sidebar-slideshow-2" value="<?php echo get_option('portfolio-sidebar-slideshow-2'); ?>"/>
                </div>
                <div class="table-row clearfix">     
                    <label for="portfolio-sidebar-slideshow-2-transition">With sidebar slideshow 2 transition:</label>
                    <select name="portfolio-sidebar-slideshow-2-transition">
                      	<?php $portfolio_sidebar_slideshow2_transition = get_option('portfolio-sidebar-slideshow-2-transition'); ?>
                        <option value="sliceDown" <?php if ($portfolio_sidebar_slideshow2_transition=='sliceDown') { echo 'selected'; } ?> >sliceDown</option>
                        <option value="sliceDownLeft" <?php if ($portfolio_sidebar_slideshow2_transition=='sliceDownLeft') { echo 'selected'; } ?> >sliceDownLeft</option>
                        <option value="sliceUp" <?php if ($portfolio_sidebar_slideshow2_transition=='sliceUp') { echo 'selected'; } ?> >sliceUp</option>
                        <option value="sliceUpLeft" <?php if ($portfolio_sidebar_slideshow2_transition=='sliceUpLeft') { echo 'selected'; } ?> >sliceUpLeft</option>
                        <option value="sliceUpDown" <?php if ($portfolio_sidebar_slideshow2_transition=='sliceUpDown') { echo 'selected'; } ?> >sliceUpDown</option>
                        <option value="sliceUpDownLeft" <?php if ($portfolio_sidebar_slideshow2_transition=='sliceUpDownLeft') { echo 'selected'; } ?> >sliceUpDownLeft</option>
                        <option value="fold" <?php if ($portfolio_sidebar_slideshow2_transition=='fold') { echo 'selected'; } ?> >fold</option>
                        <option value="fade" <?php if ($portfolio_sidebar_slideshow2_transition=='fade') { echo 'selected'; } ?> >fade</option>
                        <option value="random" <?php if ($portfolio_sidebar_slideshow2_transition=='random') { echo 'selected'; } ?> >random</option>
                        <option value="slideInRight" <?php if ($portfolio_sidebar_slideshow2_transition=='slideInRight') { echo 'selected'; } ?> >slideInRight</option>
                        <option value="slideInLeft" <?php if ($portfolio_sidebar_slideshow2_transition=='slideInLeft') { echo 'selected'; } ?> >slideInLeft</option>
                        <option value="boxRandom" <?php if ($portfolio_sidebar_slideshow2_transition=='boxRandom') { echo 'selected'; } ?> >boxRandom</option>                            
                        <option value="boxRain" <?php if ($portfolio_sidebar_slideshow2_transition=='boxRain') { echo 'selected'; } ?> >boxRain</option>                            
                        <option value="boxRainReverse" <?php if ($portfolio_sidebar_slideshow2_transition=='boxRainReverse') { echo 'selected'; } ?> >boxRainReverse</option>                            
                        <option value="boxRainGrow" <?php if ($portfolio_sidebar_slideshow2_transition=='boxRainGrow') { echo 'selected'; } ?> >boxRainGrow</option>                            
                        <option value="boxRainGrowReverse" <?php if ($portfolio_sidebar_slideshow2_transition=='boxRainGrowReverse') { echo 'selected'; } ?> >boxRainGrowReverse</option>                                                                                                                                            
                    </select>
                    <img class="hint-icon" title="The transition effect between the images in the slideshow." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                </div>                                                                 
                <div class="table-row table-row-last clearfix">
                    <input type="submit" name="search" value="Save changes" class="button" />
                    <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                </div>	                
            </form>            
        </div>  
        <div id="portfolios">
            <?php if(isset($_GET['delete']) && $_GET['delete'] != '') delete_portfolio($_GET['delete']); // IF CALLED DELETES A SLIDE BY ID ?>		        
			<?php $portfolios = portfolio_require();?>
            <?php if ( count($portfolios) > 0 ): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Category IDs</th>
                            <th>Page</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; ?>
                        <?php foreach ( $portfolios as $portfolio): ?>
                        <tr <?php if($counter%2 == 0 ) echo ' class="alternate"'; ?>>
                            <td>
                             <?php echo $portfolio->CATEGORY; ?>
                            </td>
                            <td>
                                <?php echo $portfolio->PAGE; ?>
                            </td>
                            <td align="center">
                                <a class="delete" title="Delete Portfolio Item" onClick="return confirmAction()" href="?page=duotive-portfolios&delete=<?php echo $portfolio->ID; ?>#portfolios">DELETE</a> 
                            </td>
                        </tr>
                        <?php $counter++; ?>
                        <?php endforeach; ?>                    
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>Category IDs</th>
                    <th>Page</th>
                    <th>Edit</th>
                    </tr>
                    </tfoot>                      
                </table>
			<?php else: ?>
            	<div class="page-error">There aren't any portfolios added yet.</div>              
			<?php endif; ?>         
        </div>
        <div id="addportfolio">
            <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-portfolios#addportfolio" class="transform">
                <div class="table-row clearfix">
                	<label>Select categories:</label>
					<?php 
                    $categories = get_categories();
                    echo '<ul class="categories">';								
						foreach($categories as $category):
							echo '<li>';
								echo '<input type="checkbox" name="categories[]" value="'.$category->cat_ID.'">';
								echo $category->name; 									
							echo '</li>';										
						endforeach;
                    echo '</ul>';								
                    ?>  
                </div>
                <div class="table-row clearfix">
                	<label for="pages">Page to deploy to:</label>
                    <select name="pages">  
						<?php 
							global $wpdb;
							$page_query = "SELECT post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title != 'Auto Draft' AND post_status != 'trash' ORDER BY post_title ASC ";
							$pages = $wpdb->get_results($page_query);
							foreach ( $pages as $page ):
								echo '<option value="'.$page->post_title.'" >'.$page->post_title.'</option>';					
							endforeach;
                        ?>
                    </select>                 
                </div>
                <div class="table-row table-row-last  clearfix">
                	<input type="submit" class="button" value="Add portfolio"/>
                </div>
            </form>        
        </div>
    </div>    
</div>	           
<?php
	}

	function portfolio_update()
	{
		update_option('portfolio-full-1columns',$_POST['portfolio-full-1columns']);
		update_option('portfolio-full-2columns',$_POST['portfolio-full-2columns']);
		update_option('portfolio-full-3columns',$_POST['portfolio-full-3columns']);		
		update_option('portfolio-full-2columns-2',$_POST['portfolio-full-2columns-2']);		
		update_option('portfolio-full-imagegrid',$_POST['portfolio-full-imagegrid']);
		update_option('portfolio-full-5columns-circle',$_POST['portfolio-full-5columns-circle']);
		update_option('portfolio-sidebar-circle',$_POST['portfolio-sidebar-circle']);
		update_option('portfolio-sidebar-square',$_POST['portfolio-sidebar-square']);		
		update_option('portfolio-sidebar-slideshow',$_POST['portfolio-sidebar-slideshow']);
		update_option('portfolio-sidebar-slideshow-2',$_POST['portfolio-sidebar-slideshow-2']);
		update_option('portfolio-sidebar-slideshow-transition',$_POST['portfolio-sidebar-slideshow-transition']);
		update_option('portfolio-sidebar-slideshow-2-transition',$_POST['portfolio-sidebar-slideshow-2-transition']);		
	}

add_action('admin_menu', 'portfolio_admin_menu');

?>
