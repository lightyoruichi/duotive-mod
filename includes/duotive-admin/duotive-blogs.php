<?php
//CREATE DATABASE
	//CREATE FUNCTION
	function create_db4 () {
		global $wpdb;
		$create_query = 'CREATE TABLE `duotive_blog` (
							`ID` INT NOT NULL AUTO_INCREMENT ,
							`PAGE` TEXT NOT NULL ,
							`CATEGORIES` TEXT NOT NULL,
							PRIMARY KEY ( `ID` )
						) ENGINE = MYISAM ;
						';
		$create = $wpdb->get_results($create_query);
	}
	//CHECK FUNCTION
	if ( check_db_existance('duotive_blog') == '') create_db4();
	function insert_blog_in_db( $page='no-title',$category='no-text') {
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
			$insert_query = "INSERT INTO `duotive_blog` (`ID`, `PAGE`, `CATEGORIES`) VALUES ('NULL', '".$page."', '".$category_to_insert."');";
			$insert = $wpdb->get_results($insert_query);
	}	
	//GET blog PAGES FORM DB
	function blog_require () {
		global $wpdb;		
		$blog_require_query = 'SELECT * FROM duotive_blog ORDER BY ID ASC';	
		$blog_require = $wpdb->get_results($blog_require_query);
		return $blog_require;
	}
	//DELETE blog PAGES FORM DB
	function delete_blog($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM duotive_blog WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
	}	
	// ADD THE blog OPTIONS PAGE TO ADMIN
	function blog_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Blog Options', 'Blogs', 'manage_options', 'duotive-blogs', 'blog_page');
	}

	function blog_page() 
	{
	
		
?>
	<?php $categories = ''; $pages = ''; ?>
	<?php if(isset($_POST['categories'])) $categories = $_POST['categories']; ?>
    <?php if(isset($_POST['pages'])) $pages = $_POST['pages']; ?>
    <?php if( $categories != '' && $pages != '' ) insert_blog_in_db($pages,$categories); ?>        
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
			$(".transform").jqTransform();
			$("#duotive-admin-panel" ).tabs();
			$("#duotive-admin-panel div.table-row:even").addClass('table-row-alternative');
			$('#settings .table-row-last').prev('div').addClass('table-row-beforelast');
			$('#addblog .table-row-last').prev('div').addClass('table-row-beforelast');			
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
            <li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li>
            <li class="active"><a href="admin.php?page=duotive-blogs">Blogs</a></li>
			<li><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li>
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>                                                                                    
        </ul>
    </div>
    <div id="duotive-admin-panel">
    	<h3>Blogs</h3>
        <ul>
            <li><a href="#settings">Blogs settings</a></li>
            <li><a href="#blogs">Current blogs</a></li>
            <li class="plus"><a class="plus" href="#addblog"><span class="deco"></span>Add a new blog</a></li>            
        </ul> 
        <div id="settings">
			<?php if ( isset($_POST['blog_update']) && $_POST['blog_update'] == 'true' ) { blog_update(); }  ?>
            <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-blogs#settings" class="transform">
	            <input type="hidden" name="blog_update" value="true" />  
                <div class="table-row clearfix">     
                    <label for="blogdualcolumnspagination">Dual columns posts/page:</label>
                    <input type="text" name="blogdualcolumnspagination" value="<?php echo get_option('blogdualcolumnspagination'); ?>"/>
                </div>
                <div class="table-row clearfix">     
                    <label for="blogclassicpagination">Classic posts/page:</label>
                    <input type="text" name="blogclassicpagination" value="<?php echo get_option('blogclassicpagination'); ?>"/>
                </div>   
                <div class="table-row clearfix">     
                    <label for="blogaccordionpagination">Accordion posts/page:</label>
                    <input type="text" name="blogaccordionpagination" value="<?php echo get_option('blogaccordionpagination'); ?>"/>
                </div>
                <div class="table-row clearfix">     
                    <label for="blogfullpagination">Full width posts/page:</label>
                    <input type="text" name="blogfullpagination" value="<?php echo get_option('blogfullpagination'); ?>"/>
                </div> 
                <div class="table-row clearfix">     
                    <label for="blogmodernpagination">Modern posts/page:</label>
                    <input type="text" name="blogmodernpagination" value="<?php echo get_option('blogmodernpagination'); ?>"/>
                </div>
                <div class="table-row table-row-last clearfix">
                    <input type="submit" name="search" value="Save changes" class="button" />
                    <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                </div>	                                 
            </form>            
        </div>
        <div id="blogs">
			<?php if(isset($_GET['delete']) && $_GET['delete'] != '') delete_blog($_GET['delete']); // IF CALLED DELETES A SLIDE BY ID ?> 
            <?php $blogs = blog_require();?>
            <?php if ( count($blogs) > 0 ): ?>
                <table cellpadding="0">
                    <thead>
                        <tr>
                            <th>Category IDs</th>
                            <th>Page</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; ?>
                        <?php foreach ( $blogs as $blog): ?>
                        <tr <?php if($counter%2 == 0 ) echo ' class="alternate"'; ?>>
                            <td>
                                <?php echo $blog->CATEGORIES; ?>
                            </td>
                            <td>
                                <?php echo $blog->PAGE; ?>
                            </td>
                            <td align="center">
                                <a class="delete" title="Delete blog Item" onClick="return confirmAction()" href="?page=duotive-blogs&delete=<?php echo $blog->ID; ?>#blogs">DELETE</a> 
                            </td>
                        </tr>
                        <?php $counter++; ?>
                        <?php endforeach; ?>                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Category IDs</th>
                            <th>Page</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>                      
                </table>
			<?php else: ?>
            	<div class="page-error">There aren't any blogs added yet.</div>              
			<?php endif; ?>                     
        </div> 
        <div id="addblog">
            <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-blogs#addblog" class="transform">
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
                	<input type="submit" class="button" value="Add blog"/>
                </div>            	
            </form>
        </div>                
	</div>
</div>                
<?php
	}

	function blog_update()
	{
		update_option('blogdualcolumnspagination',$_POST['blogdualcolumnspagination']);
		update_option('blogclassicpagination',$_POST['blogclassicpagination']);	
		update_option('blogaccordionpagination',$_POST['blogaccordionpagination']);	
		update_option('blogfullpagination',$_POST['blogfullpagination']);	
		update_option('blogmodernpagination',$_POST['blogmodernpagination']);			
	}

add_action('admin_menu', 'blog_admin_menu');

?>
