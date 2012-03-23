<?php
//CREATE DATABASE
	//CREATE FUNCTION
	function create_db3 () {
		global $wpdb;
		$create_query = 'CREATE TABLE `duotive_sidebars` (
							`ID` INT NOT NULL AUTO_INCREMENT ,
							`NAME` TEXT NOT NULL ,
							`DESCRIPTION` TEXT NOT NULL,
							PRIMARY KEY ( `ID` )
						) ENGINE = MYISAM ;
						';
		$create = $wpdb->get_results($create_query);
	}
	//CHECK FUNCTION
	if ( check_db_existance('duotive_sidebars') == '') create_db3();
	//INSERT FUNCTION
	function check_sidebar_existance($name) {
		global $wpdb;		
		$sidebar_existance_query = 'SELECT * FROM duotive_sidebars WHERE NAME="'.$name.'"';	
		$sidebar_existance = $wpdb->get_results($sidebar_existance_query);
		if ( $sidebar_existance[0]->NAME != '' ) return 1;
		else return 0;		
	}
	function insert_sidebar_in_db( $name='no-title',$description='no-text') {
			if ( check_sidebar_existance($name) == 0 )
			{
				global $wpdb;
				$name = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);
				$description = preg_replace("/[^a-zA-Z0-9\s]/", "", $description);				
				$insert_query = "INSERT INTO `duotive_sidebars` (`ID`, `NAME`, `DESCRIPTION`) VALUES ('NULL', '".$name."', '".$description."');";
				$insert = $wpdb->get_results($insert_query);
			}
	}	
	//DELETE SIDEBAR FORM DB
	function delete_sidebar($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM duotive_sidebars WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
	}	
	//GET PORTFOLIO PAGES FORM DB
	function sidebars_require () {
		global $wpdb;		
		$portfolio_require_query = 'SELECT * FROM duotive_sidebars ORDER BY ID ASC';	
		$portfolio_require = $wpdb->get_results($portfolio_require_query);
		return $portfolio_require;
	}	
function sidebars_admin_menu() 
{
	// ADD THE FPM OPTIONS PAGE TO ADMIN SIDEBAR
	add_submenu_page( 'duotive-panel', 'Duotive Sidebars', 'Sidebars', 'manage_options', 'duotive-sidebars', 'sidebars_page');
}

function sidebars_page() 
{
	// THE ACTUAL OPTIONS PAGE
?>	
    <?php if(isset($_POST['name']) && $_POST['name'] != '') : ?>
		<?php if(isset($_POST['name']) && $_POST['name'] != '') $name =  $_POST['name'];  ?>
        <?php if(isset($_POST['description'])) $desc =  $_POST['description']; else 'Sidebar created by duotive sidebar generator.' ?> 
        <?php if(isset($_POST['name'])) insert_sidebar_in_db($name,$desc); ?>
        <?php if(isset($_GET['delete'])) delete_sidebar($_GET['delete']); // IF CALLED DELETES A SIDEBAR ?>    
    <?php endif; ?>
    <?php if(isset($_GET['delete'])) delete_sidebar($_GET['delete']); // IF CALLED DELETES A SIDEBAR ?>        
    <?php // ADD INCLUDED CSS AND JS FILES ?>
	<script language="javascript">
	/* function for confirming you want to delete */
      function confirmAction() {
        return confirm("Are you sure you want to delete this sidebar?")
      }
	</script>     
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/duotive-admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/jqtransform.css" /> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.jqtransform.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.tools.min.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery-ui.min.js" /></script>        
    <script type="text/javascript">
		$(document).ready(function() {
			$(".transform").jqTransform();
			$( "#duotive-admin-panel" ).tabs();
			$("#duotive-admin-panel div.table-row:even").addClass('table-row-alternative');
			$('#addsidebar .table-row-last').prev('div').addClass('table-row-beforelast');
			$('#sidebars .table-row-last').prev('div').addClass('table-row-beforelast');
		});
	</script>    
<div class="wrap">
    <div id="duotive-logo">Duotive Admin Panel</div>
    <div id="duotive-main-menu">
        <ul>
            <li><a href="admin.php?page=duotive-panel">General settings</a></li>
            <li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            <li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            <li class="active"><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
			<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li> 
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
			<li><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li>
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>                                                                      
        </ul>
    </div>
    <div id="duotive-admin-panel">
    <h3>Sidebars</h3>
    <ul>
        <li><a href="#sidebars">Current sidebars</a></li> 
        <li class="plus"><a class="plus" href="#addsidebar"><span class="deco"></span>Add a new sidebars</a></li>         
	</ul>                   
        <div id="sidebars">
			<?php $sidebars = sidebars_require();?>
            <?php if ( count($sidebars) > 0 ): ?>
                <table cellpadding="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th align="center">Delete</th>                                        
                        </tr>
                    </thead>
                    <tbody>  
                        <?php $i = 0; ?>
                        <?php foreach ( $sidebars as $sidebar): ?>
                            <tr <?php if ( $i%2 == 0 ) echo ' class = "alternate"'; ?>>
                                <td align="center">
                                    <?php echo $sidebar->NAME; ?>
                                </td>
                                <td align="center">
                                    <?php echo $sidebar->DESCRIPTION; ?>
                                </td>
                                <td align="center">
                                    <a class="delete" title="Delete Sidebar" onClick="return confirmAction()" href="?page=duotive-sidebars&delete=<?php echo $sidebar->ID; ?>">DELETE</a> 
                                </td>
                            </tr>
                        <?php $i++; ?>  
                        <?php endforeach; ?>                                                                     
                    </tbody>            
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Delete</th>                                        
                        </tr>
                    </tfoot>     
                </table> 
			<?php else: ?>
                <div class="page-error">There aren't any custom sidebars added yet.</div>                            
            <?php endif; ?>               
        </div>
        <div id="addsidebar">
            <form action="" method="post" class="transform">
                <div class="table-row clearfix">
                    <label for="name">Sidebar name:</label>
                    <input size="50" name="name" type="text"  />
                </div>
                <div class="table-row clearfix">
                    <label for="description">Sidebar description:</label>
                    <textarea class="fullwidth" name="description" cols="50" rows="4"></textarea>
                </div>
                <div class="table-row table-row-last clearfix">
                    <input type="submit" name="search" value="Add sidebar" class="button" />	
                </div>	          
            </form>
        </div>        
    </ul>
    </div>
</div>
<?php
}

function sidebars_update()
{
}
add_action('admin_menu', 'sidebars_admin_menu');
function custom_sidebars_initialization() { 

} ?>
<?php add_action( 'widgets_init', 'custom_sidebars_initialization' );?>