<?php

	function table_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Pricing Tables', 'Pricing tables', 'manage_options', 'duotive-pricing-table', 'table_page');
	}

	function table_page() 
	{
	
?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/duotive-admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/jqtransform.css" /> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.jqtransform.js" /></script> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.tools.min.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery-ui.min.js" /></script>        
    <script type="text/javascript">
		$(document).ready(function() {
			$(".transform").jqTransform();
			$("#settings div.table-row:even").addClass('table-row-alternative');
	    	$('#settings .table-row-last').prev('div').addClass('table-row-beforelast');	
			$("#create-table div.table-row:even").addClass('table-row-alternative');
	    	$('#create-table .table-row-last').prev('div').addClass('table-row-beforelast');			
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
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li> 
			<li class="active"><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li> 
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>                                                                               
        </ul>
    </div>
    <div id="duotive-admin-panel">
    	<h3>Pricing table generator</h3>
        	<?php if ( !isset($_POST['product_number_processor']) ): ?> 
				<?php if ( !isset($_POST['product_number']) ): ?>
                    <div id="settings" class="ui-tabs-panel">
                        <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-pricing-table" class="transform">
                            <div class="table-row clearfix">     
                                <label for="product_number">Products:</label>
                                <input type="text" size="10" name="product_number"/>
                            </div>
                            <div class="table-row clearfix">     
                                <label for="product_feature_number">Features / product:</label>
                                <input type="text" size="10" name="product_feature_number"/>
                            </div>
                            <div class="table-row table-row-last clearfix">
                                <input type="submit" name="search" value="Create table" class="button" />
                                <input id="setting-up-save" type="submit" name="search" value="Create table" class="button" />	
                            </div>	                                    
                        </form>                	   
                    </div> 
                <?php else: ?>
                    <?php $product_number = $_POST['product_number']; ?>
                    <?php $product_feature_number = $_POST['product_feature_number']; ?>     
                    <div id="create-table" class="ui-tabs-panel">
                        <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-pricing-table">
                            <input type="hidden" value="<?php echo $product_number; ?>" name="product_number_processor" />
                            <input type="hidden" value="<?php echo $product_feature_number; ?>" name="product_feature_number_processor" />                        
                            <div class="table-row clearfix">  
                                <div class="pricing-table-heading">Product names:</div>
                                <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
                                    <input type="text" size="24" name="product_name_<?php echo $i; ?>"/>
                                <?php endfor; ?>                   
                            </div>  
                            <div class="table-row clearfix">  
                                <div class="pricing-table-heading">Product price:</div>                          
                                <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
                                    <input type="text" size="24" name="product_price_<?php echo $i; ?>"/>
                                <?php endfor; ?>                   
                            </div> 
                            <div class="table-row clearfix">  
                                <div class="pricing-table-heading">Subscription period:</div>                             
                                <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
                                    <input type="text" size="24" name="product_subscription_<?php echo $i; ?>"/>
                                <?php endfor; ?>                   
                            </div>
                            <div class="table-row clearfix">  
                                <div class="pricing-table-heading">Button text:</div>                             
                                <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
                                    <input type="text" size="24" name="product_button_text_<?php echo $i; ?>"/>
                                <?php endfor; ?>                   
                            </div>
                            <div class="table-row clearfix">  
                                <div class="pricing-table-heading">Button URL:</div>                             
                                <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
                                    <input type="text" size="24" name="product_button_url_<?php echo $i; ?>"/>
                                <?php endfor; ?>                   
                            </div>
                            <?php for ( $j = 1; $j <= $product_number; $j++ ): ?>
                                <div class="table-row clearfix">  
                                    <div>Feature name -> feature description:</div> 
                                    <input type="text" size="24" name="product_feature_name_<?php echo $j; ?>" />                            
                                    <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
                                        <input type="text" size="24" name="product_feature_<?php echo $j.$i; ?>"/>
                                    <?php endfor; ?>                   
                                </div>                                               
                            <?php endfor; ?> 
                            <div class="table-row table-row-last clearfix">
                                <input type="submit" name="search" value="Get code" class="button" />
                            </div>	                                                                                                       
                        </form>
                    </div>
                <?php endif; ?> 
			<?php else: ?>
            	<?php
				      	$product_number = $_POST['product_number_processor'];
				      	$product_feature_number = $_POST['product_feature_number_processor'];
				?>	
                <textarea cols="110" rows="40">	
<table class="pricing"> 
    <thead>
        <tr>   
            <th>&nbsp;</th>                    
            <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
            <th><h4><?php echo $_POST['product_name_'.$i]; ?></h4></th>
            <?php endfor; ?>
        </tr>
    </thead>
    <tbody>
    	<tr class="pricing">
    		<td>&nbsp;</td>
            <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
            	<td><h3><?php echo $_POST['product_price_'.$i]; ?></h3><span class="note"><?php echo $_POST['product_subscription_'.$i]; ?></span></td>
            <?php endfor; ?> 
        </tr>
		<tr class="buttons">
	        <td>&nbsp;</td>
            <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
            	<td><a class="button" href="<?php echo $_POST['product_button_url_'.$i]; ?>"><?php echo $_POST['product_button_text_'.$i]; ?></a></td>
			<?php endfor; ?>                            
		</tr>
		<?php for ( $j = 1; $j <= $product_feature_number; $j++ ): ?>        
        <tr class="content">
            <td><?php echo $_POST['product_feature_name_'.$j]; ?></td>
            <?php for ( $i = 1; $i <= $product_number; $i++ ): ?>
            <td><?php $features = str_replace('[yes]','<div class="yes"></div>',$_POST['product_feature_'.$j.$i]); echo str_replace('[no]','<div class="no"></div>',$features); ?></td>                             
            <?php endfor; ?>
        </tr>                
        <?php endfor; ?>
    </tbody>        	                        
</table>                        
				</textarea>                        
            <?php endif; ?>                   
	</div>
</div>        
<?php
	}
	add_action('admin_menu', 'table_admin_menu');

?>
