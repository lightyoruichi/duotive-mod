<?php
function fpm_admin_menu() 
{
	// ADD THE FPM OPTIONS PAGE TO ADMIN SIDEBAR
	add_submenu_page( 'duotive-panel', 'Duotive Front Page Options', 'Frontpage', 'manage_options', 'duotive-front-page-manager', 'fpm_page');
}

function fpm_page() 
{
	// THE ACTUAL OPTIONS PAGE
?>	
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
		$( "#duotive-admin-panel" ).tabs();
    	$('#frontpagebusiness .table-row-last').prev('div').addClass('table-row-beforelast');
    	$('#frontpageposts .table-row-last').prev('div').addClass('table-row-beforelast');		
	
	});	
</script> 
	<div class="wrap">
    	<div id="duotive-logo">Duotive Admin Panel</div>
        <div id="duotive-main-menu">
        	<ul>
            	<li><a href="admin.php?page=duotive-panel">General settings</a></li>
            	<li class="active"><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            	<li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            	<li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li> 
				<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li>
				<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
				<li><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li>                                                                                               
                <li><a href="admin.php?page=duotive-contact">Contact page</a></li>
            </ul>
        </div>    
    	<div id="duotive-admin-panel">
        	<h3>Frontpage</h3>
        	<ul>
            	<li><a href="#frontpagebusiness">Business layout</a>
           		<li><a href="#frontpageposts">Posts layout</a>
           		<li><a href="#frontpagenews">News layout</a>                  
            	<li><a href="#frontpagepresentation">Presentation layout</a>                 
            </ul>
            <div id="frontpagepresentation">
				<?php if ( isset($_POST['front_page_presentation_update']) && $_POST['front_page_presentation_update'] == 'true') { front_page_presentation_update(); } // UPDATE OPTIONS ?>   
                <form method="POST" action="#frontpagepresentation" class="transform">
                    <input type="hidden" name="front_page_presentation_update" value="true" />
                    <div class="table-row clearfix">
                        <label for="fppre_intro">Enable intro?</label>
                        <select name="fppre_intro">
                            <?php if ( get_option('fppre_intro') == '') $fppre_intro = 'yes'; else $fppre_intro = get_option('fppre_intro');?>
                            <option value="yes" <?php if ($fppre_intro=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fppre_intro=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the intro message paragraph on the front page." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fppre_intro_heading">Intro heading:</label>
                        <input name="fppre_intro_heading" type="text" value="<?php echo get_option('fppre_intro_heading'); ?>" size="50" />
                    </div>  
                    <div class="table-row clearfix">
                        <label for="fppre_intro_text">Intro text:</label>
                        <textarea name="fppre_intro_text" class="fullwidth" rows="14" cols="50"><?php echo get_option('fppre_intro_text'); ?></textarea>
                    </div>                                              
                    <div class="table-row clearfix">
                        <label for="fppre_row1">Enable 3 top intro columns?</label>
                        <select name="fppre_row1">
                            <?php if ( get_option('fppre_row1') == '') $fppre_row1 = 'yes'; else $fppre_row1 = get_option('fppre_row1');?>
                            <option value="yes" <?php if ($fppre_row1=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fppre_row1=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>
                    <div class="table-row clearfix">
                        <label for="fppre_row2">Enable top posts?</label>
                        <select name="fppre_row2">
                            <?php if ( get_option('fppre_row2') == '') $fppre_row2 = 'yes'; else $fppre_row2 = get_option('fppre_row2');?>
                            <option value="yes" <?php if ($fppre_row2=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fppre_row2=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>                    
                    <div class="table-row clearfix">
                        <label for="fpp_category">Top posts categories:</label>
                        <?php
                            $fppre_row2_category = get_option('fppre_row2_category');
							$haystack = explode(',',$fppre_row2_category);							
                            $categories = get_categories();
                            echo '<ul class="categories_listing">';								
                                foreach($categories as $category):
                                    $validate = NULL;
                                    $checked = '';
									$validate = in_array($category->cat_ID,$haystack);
                                    if ( $validate != '' ) $checked = ' checked="checked"';
                                    echo '<li>';
                                        echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="fppre_row2_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                        echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                    echo '</li>';										
                                endforeach;
                            echo '</ul>';								
                        ?>                      
                    </div>                     
                    <div class="table-row clearfix">
                        <label for="fppre_row2_number">Top posts number:</label>
                        <input name="fppre_row2_number" type="text" value="<?php echo get_option('fppre_row2_number'); ?>" size="8" />                    
                    </div>
                    <div class="table-row clearfix">
                        <label for="fppre_row3">Enable 2 middle columns?</label>
                        <select name="fppre_row3">
                            <?php if ( get_option('fppre_row3') == '') $fppre_row3 = 'yes'; else $fppre_row3 = get_option('fppre_row3');?>
                            <option value="yes" <?php if ($fppre_row3=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fppre_row3=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>
                    <div class="table-row clearfix">
                        <label for="fppre_row4">Enable 3 middle columns?</label>
                        <select name="fppre_row4">
                            <?php if ( get_option('fppre_row4') == '') $fppre_row4 = 'yes'; else $fppre_row4 = get_option('fppre_row4');?>
                            <option value="yes" <?php if ($fppre_row4=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fppre_row4=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>
                    <div class="table-row clearfix">
                        <label for="fppre_row5">Enable bottom scroller?</label>
                        <select name="fppre_row5">
                            <?php if ( get_option('fppre_row5') == '') $fppre_row5 = 'yes'; else $fppre_row5 = get_option('fppre_row5');?>
                            <option value="yes" <?php if ($fppre_row5=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fppre_row5=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>
                    <div class="table-row clearfix">
                        <label for="fppre_row5_meta">Enable bottom scroller meta?</label>
                        <select name="fppre_row5_meta">
                            <?php if ( get_option('fppre_row5_meta') == '') $fppre_row5_meta = 'yes'; else $fppre_row5_meta = get_option('fppre_row5_meta');?>
                            <option value="yes" <?php if ($fppre_row5_meta=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fppre_row5_meta=='no') { echo 'selected'; } ?>>No</option>
                            <option value="tooltip" <?php if ($fppre_row5_meta=='tooltip') { echo 'selected'; } ?>>Use tooltip</option>
                        </select>
                    </div>                                        
                    <div class="table-row clearfix">
                        <label for="fpp_category">Bottom scroller categories:</label>
                        <?php
                            $fppre_row5_category = get_option('fppre_row5_category');
							$haystack = explode(',',$fppre_row5_category);
                            $categories = get_categories();
                            echo '<ul class="categories_listing">';								
                                foreach($categories as $category):
                                    $validate = NULL;
                                    $checked = '';
                                    $validate = in_array($category->cat_ID,$haystack);
                                    if ( $validate != '' ) $checked = ' checked="checked"';
                                    echo '<li>';
                                        echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="fppre_row5_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                        echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                    echo '</li>';										
                                endforeach;
                            echo '</ul>';								
                        ?>                      
                    </div>                     
                    <div class="table-row clearfix">
                        <label for="fppre_row5_number">Bttom scroller posts number:</label>
                        <input name="fppre_row5_number" type="text" value="<?php echo get_option('fppre_row5_number'); ?>" size="8" />                    
                    </div>                                                                                                 
                    <div class="table-row table-row-last clearfix">
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                        <input type="submit" name="search" value="Save changes" class="button" />	
                    </div>                     
				</form>                                
            </div>
            <div id="frontpagebusiness">
                <?php if ( isset($_POST['front_page_business_update']) && $_POST['front_page_business_update'] == 'true') { front_page_business_update(); } // UPDATE OPTIONS ?>   
                <form method="POST" action="#frontpagebusiness" class="transform">
                    <input type="hidden" name="front_page_business_update" value="true" />
                    <div class="table-row clearfix">
                        <label for="fpb_intro">Enable intro?</label>
                        <select name="fpb_intro">
                            <?php if ( get_option('fpb_intro') == '') $fpb_intro = 'yes'; else $fpb_intro = get_option('fpb_intro');?>
                            <option value="yes" <?php if ($fpb_intro=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpb_intro=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the intro message paragraph on the front page." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpb_intro_heading">Intro heading:</label>
                        <input name="fpb_intro_heading" type="text" value="<?php echo get_option('fpb_intro_heading'); ?>" size="50" />
                    </div>  
                    <div class="table-row clearfix">
                        <label for="fpb_intro_text">Intro text:</label>
                        <textarea name="fpb_intro_text" class="fullwidth" rows="14" cols="50"><?php echo get_option('fpb_intro_text'); ?></textarea>
                    </div>                           
                    <div class="table-row clearfix">
                        <label for="fpb_posts">Enable frontpage posts?</label>
                        <select name="fpb_posts">
                            <?php if ( get_option('fpb_posts') == '') $fpb_posts = 'yes'; else $fpb_posts = get_option('fpb_posts');?>
                            <option value="yes" <?php if ($fpb_posts=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpb_posts=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the content columns on the front page." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div> 
                    <div class="table-row clearfix">
                        <label for="fpb_posts_columns">Number of columns:</label>
                        <select name="fpb_posts_columns">
                            <?php if ( get_option('fpb_posts_columns') == '') $fpb_posts_columns = '3'; else $fpb_posts_columns = get_option('fpb_posts_columns');?>
                            <option value="2" <?php if ($fpb_posts_columns=='2') { echo 'selected'; } ?> >2 Columns</option>                    
                            <option value="3" <?php if ($fpb_posts_columns=='3') { echo 'selected'; } ?> >3 Columns</option>
                            <option value="4" <?php if ($fpb_posts_columns=='4') { echo 'selected'; } ?> >4 Columns</option>                                                                                                    
                        </select>
                    </div>              
                    <div class="table-row clearfix">
                        <label for="fpb_posts_number">Number of posts:</label>
                        <select name="fpb_posts_number">
                            <?php if ( get_option('fpb_posts_number') == '') $fpb_posts_number = '-1'; else $fpb_posts_number = get_option('fpb_posts_number');?>
                                <?php if ( $fpb_posts_columns == 2 ): ?>
                                    <option value="-1" <?php if ($fpb_posts_number=='-1') { echo 'selected'; } ?> >All</option>
                                    <option value="2" <?php if ($fpb_posts_number=='2') { echo 'selected'; } ?> >2 Posts</option>
                                    <option value="4" <?php if ($fpb_posts_number=='4') { echo 'selected'; } ?> >4 Posts</option>
                                    <option value="6" <?php if ($fpb_posts_number=='6') { echo 'selected'; } ?> >6 Posts</option>
                                    <option value="8" <?php if ($fpb_posts_number=='8') { echo 'selected'; } ?> >8 Posts</option>
                                    <option value="10" <?php if ($fpb_posts_number=='10') { echo 'selected'; } ?> >10 Posts</option>
                                    <option value="12" <?php if ($fpb_posts_number=='12') { echo 'selected'; } ?> >12 Posts</option>                                                                                                                        
                                <?php endif; ?>
                                <?php if ( $fpb_posts_columns == 3 ): ?>
                                    <option value="-1" <?php if ($fpb_posts_number=='-1') { echo 'selected'; } ?> >All</option>
                                    <option value="3" <?php if ($fpb_posts_number=='3') { echo 'selected'; } ?> >3 Posts</option>
                                    <option value="6" <?php if ($fpb_posts_number=='6') { echo 'selected'; } ?> >6 Posts</option>
                                    <option value="9" <?php if ($fpb_posts_number=='9') { echo 'selected'; } ?> >9 Posts</option>
                                    <option value="12" <?php if ($fpb_posts_number=='12') { echo 'selected'; } ?> >12 Posts</option>
                                    <option value="15" <?php if ($fpb_posts_number=='15') { echo 'selected'; } ?> >15 Posts</option>
                                    <option value="18" <?php if ($fpb_posts_number=='18') { echo 'selected'; } ?> >18 Posts</option>                                                                                                                        
                                <?php endif; ?>    
                                <?php if ( $fpb_posts_columns == 4 ): ?>
                                    <option value="-1" <?php if ($fpb_posts_number=='-1') { echo 'selected'; } ?> >All</option>
                                    <option value="4" <?php if ($fpb_posts_number=='4') { echo 'selected'; } ?> >4 Posts</option>
                                    <option value="8" <?php if ($fpb_posts_number=='8') { echo 'selected'; } ?> >8 Posts</option>
                                    <option value="12" <?php if ($fpb_posts_number=='12') { echo 'selected'; } ?> >12 Posts</option>
                                    <option value="16" <?php if ($fpb_posts_number=='16') { echo 'selected'; } ?> >16 Posts</option>
                                    <option value="20" <?php if ($fpb_posts_number=='20') { echo 'selected'; } ?> >20 Posts</option>
                                    <option value="24" <?php if ($fpb_posts_number=='24') { echo 'selected'; } ?> >24 Posts</option>                                                                                                                        
                                <?php endif; ?>                                                                                                                                                    
                        </select>
                    </div>            
                    <div class="table-row clearfix">
                        <label for="fpb_posts_category">Categories for posts:</label>
                        <?php
                            $fpb_posts_category = get_option('fpb_posts_category');
							$haystack = explode(',',$fpb_posts_category);
                            $categories = get_categories();
                            echo '<ul class="categories_listing">';								
                                foreach($categories as $category):
                                    $validate = NULL;
                                    $checked = '';
									$validate = in_array($category->cat_ID,$haystack);
                                    if ( $validate != '' ) $checked = ' checked="checked"';
                                    echo '<li>';
                                        echo '<input id="posts-category-'.$category->cat_ID.'" type="checkbox" name="fpb_posts_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                        echo '<label for="posts-category-'.$category->cat_ID.'">'.$category->name; 
                                    echo '</li>';										
                                endforeach;
                            echo '</ul>';								
                        ?>                      
                    </div>  
                    <div class="table-row clearfix">
                        <label for="fpb_bottom">Enable frontpage bottom?</label>
                        <select name="fpb_bottom">
                            <?php if ( get_option('fpb_bottom') == '') $fpb_bottom = 'yes'; else $fpb_bottom = get_option('fpb_bottom');?>
                            <option value="yes" <?php if ($fpb_bottom=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpb_bottom=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div> 
                    <div class="table-row clearfix">                
                        <label for="fpb_bottom_scroller">Enable content scroller?</label>
                        <select name="fpb_bottom_scroller">
                            <?php if ( get_option('fpb_bottom_scroller') == '') $fpb_bottom_scroller = 'yes'; else $fpb_bottom_scroller = get_option('fpb_bottom_scroller');?>
                            <option value="yes" <?php if ($fpb_bottom_scroller=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpb_bottom_scroller=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>  
                    <?php if ( $fpb_bottom_scroller == 'yes' ) : ?>
                        <div class="table-row clearfix">
                            <label for="fpb_bottom_scroller_title">Content scroller title:</label>
                            <input name="fpb_bottom_scroller_title" type="text" value="<?php echo get_option('fpb_bottom_scroller_title'); ?>" size="50" />
                        </div>                          
                        <div class="table-row clearfix">                
                            <label for="fpb_bottom_scroller_size">Content scroller size:</label>
                            <select name="fpb_bottom_scroller_size">
                                <?php if ( get_option('fpb_bottom_scroller_size') == '') $fpb_bottom_scroller_size = 'one-half'; else $fpb_bottom_scroller_size = get_option('fpb_bottom_scroller_size');?>
                                <option value="one-half" <?php if ($fpb_bottom_scroller_size=='one-half') { echo 'selected'; } ?> >One half</option>
                                <option value="two-thirds" <?php if ($fpb_bottom_scroller_size=='two-thirds') { echo 'selected'; } ?> >Two thirds</option>
                                <option value="three-forths" <?php if ($fpb_bottom_scroller_size=='three-forths') { echo 'selected'; } ?> >Three forths</option>                             
                                <option value="full-width" <?php if ($fpb_bottom_scroller_size=='full-width') { echo 'selected'; } ?> >Full width</option>
                            </select>
                        </div>
                        <div class="table-row clearfix">
                            <label for="fpb_bottom_scroller_category">Categories for scroller:</label>
                            <?php
                                $fpb_bottom_scroller_category = get_option('fpb_bottom_scroller_category');
								$haystack = explode(',',$fpb_bottom_scroller_category);
                                $categories = get_categories();
                                echo '<ul class="categories_listing">';								
                                    foreach($categories as $category):
                                        $validate = NULL;
                                        $checked = '';
										$validate = in_array($category->cat_ID,$haystack);
                                        if ( $validate != '' ) $checked = ' checked="checked"';
                                        echo '<li>';
                                            echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="fpb_bottom_scroller_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                            echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                        echo '</li>';										
                                    endforeach;
                                echo '</ul>';								
                            ?>                      
                        </div>
                        <div class="table-row clearfix">
                            <label for="fpb_bottom_scroller_number">Scroller post number:</label>
                            <input name="fpb_bottom_scroller_number" type="text" value="<?php echo get_option('fpb_bottom_scroller_number'); ?>" size="8" />
                            <img class="hint-icon" title="Enter the total number of posts that you want to be displayed on the frontpage bottom scroller. Type -1 if you want all your posts to be displayed." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>                                                   
                    <?php else: ?>
                        <div class="table-row clearfix">                
                            <label for="fpb_bottom_widget_areas">Widget areas columns?</label>
                            <select name="fpb_bottom_widget_areas">
                                <?php if ( get_option('fpb_bottom_widget_areas') == '') $fpb_bottom_widget_areas = '4'; else $fpb_bottom_widget_areas = get_option('fpb_bottom_widget_areas');?>
                                <option value="1" <?php if ($fpb_bottom_widget_areas=='1') { echo 'selected'; } ?> >1 Column</option>
                                <option value="2" <?php if ($fpb_bottom_widget_areas=='2') { echo 'selected'; } ?>>2 Columns</option>
                                <option value="3" <?php if ($fpb_bottom_widget_areas=='3') { echo 'selected'; } ?>>3 Columns</option>
                                <option value="4" <?php if ($fpb_bottom_widget_areas=='4') { echo 'selected'; } ?>>4 Columns</option>                                                        
                            </select>
                        </div>                         
                    <?php endif; ?>                                         
                    <div class="table-row table-row-last clearfix">
                    	<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                        <input type="submit" name="search" value="Save changes" class="button" />	
                    </div>	
                </form>  
            <!-- end of front page business -->                                 
            </div>
            <div id="frontpageposts">
                <?php if ( isset($_POST['front_page_posts']) && $_POST['front_page_posts'] == 'true') { front_page_posts_update(); } // UPDATE OPTIONS ?>   
                <form method="POST" action="#frontpageposts" class="transform">
                    <input type="hidden" name="front_page_posts" value="true" />
                    <div class="table-row clearfix">
                        <label for="fpp_intro">Enable intro?</label>
                        <select name="fpp_intro">
                            <?php if ( get_option('fpp_intro') == '') $fpp_intro = 'yes'; else $fpp_intro = get_option('fpp_intro');?>
                            <option value="yes" <?php if ($fpp_intro=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpp_intro=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the intro message paragraph on the front page." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpp_intro_heading">Intro heading:</label>
                        <input name="fpp_intro_heading" type="text" value="<?php echo get_option('fpp_intro_heading'); ?>" size="50" />
                    </div>  
                    <div class="table-row clearfix">
                        <label for="fpp_intro_text">Intro text:</label>
                        <textarea name="fpp_intro_text" class="fullwidth" rows="14" cols="50"><?php echo get_option('fpp_intro_text'); ?></textarea>
                    </div>                           
                    <div class="table-row clearfix">
                        <label for="fpp_category">Categories for posts:</label>
                        <?php
                            $fpp_category = get_option('fpp_category');
                            $categories = get_categories();
							$haystack = explode(',',$fpp_category);
                            echo '<ul class="categories_listing">';								
                                foreach($categories as $category):
                                    $validate = NULL;
                                    $checked = '';
									$validate = in_array($category->cat_ID,$haystack);
                                    if ( $validate != '' ) $checked = ' checked="checked"';
                                    echo '<li>';
                                        echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="fpp_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                        echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                    echo '</li>';										
                                endforeach;
                            echo '</ul>';								
                        ?>                      
                    </div>                     
                    <div class="table-row clearfix">
                        <label for="fpp_post_number">Number of posts:</label>
                        <input name="fpp_post_number" type="text" value="<?php echo get_option('fpp_post_number'); ?>" size="8" />                    
                        <img class="hint-icon" title="Enter the total number of posts that you want to be displayed on the frontpage. Type -1 if you want all your posts to be displayed." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpp_title">Enable title?</label>
                        <select name="fpp_title">
                            <?php if ( get_option('fpp_title') == '') $fpp_title = 'yes'; else $fpp_title = get_option('fpp_title');?>
                            <option value="yes" <?php if ($fpp_title=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpp_title=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>                     
                    <div class="table-row clearfix">
                        <label for="fpp_content">Enable content?</label>
                        <select name="fpp_content">
                            <?php if ( get_option('fpp_content') == '') $fpp_content = 'yes'; else $fpp_content = get_option('fpp_content');?>
                            <option value="yes" <?php if ($fpp_content=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpp_content=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div> 
                    <div class="table-row clearfix">
                        <label for="fpp_date">Enable date?</label>
                        <select name="fpp_date">
                            <?php if ( get_option('fpp_date') == '') $fpp_date = 'yes'; else $fpp_date = get_option('fpp_date');?>
                            <option value="yes" <?php if ($fpp_date=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpp_date=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>                                                                                             
                    <div class="table-row table-row-last clearfix">
                    	<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                        <input type="submit" name="search" value="Save changes" class="button" />	
                    </div>	
                </form>                 
            <!-- end of frontpageposts -->
            </div>
            <div id="frontpagenews">
                <?php if ( isset($_POST['front_page_news']) && $_POST['front_page_news'] == 'true') { front_page_news_update(); } // UPDATE OPTIONS ?> 
                <form method="POST" action="#frontpagenews" class="transform">
                    <input type="hidden" name="front_page_news" value="true" />
                    <div class="table-row clearfix">
                        <label for="fpn_sidebar">Enable sidebar?</label>
                        <select name="fpn_sidebar">
                            <?php if ( get_option('fpn_sidebar') == '') $fpn_sidebar = 'yes'; else $fpn_sidebar = get_option('fpn_sidebar');?>
                            <option value="yes" <?php if ($fpn_sidebar=='yes') { echo 'selected'; } ?> >Yes</option>
                            <option value="no" <?php if ($fpn_sidebar=='no') { echo 'selected'; } ?>>No</option>
                        </select>
                    </div>                      
                    <div class="table-row clearfix">
                        <label for="fpn_latest_news_title">Left articles title:</label>
                        <input name="fpn_latest_news_title" type="text" value="<?php echo get_option('fpn_latest_news_title'); ?>" size="50" />
                    </div>                     
                    <div class="table-row clearfix">
                        <label for="fpn_latest_news_category">Left articles categories:</label>
                        <?php
                            $fpn_latest_news_category = get_option('fpn_latest_news_category');
                            $categories = get_categories();
							$haystack = explode(',',$fpn_latest_news_category);
                            echo '<ul class="categories_listing">';								
                                foreach($categories as $category):
                                    $validate = NULL;
                                    $checked = '';
									$validate = in_array($category->cat_ID,$haystack);
                                    if ( $validate != '' ) $checked = ' checked="checked"';
                                    echo '<li>';
                                        echo '<input id="news-latest-category-'.$category->cat_ID.'" type="checkbox" name="fpn_latest_news_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                        echo '<label for="news-latest-category-'.$category->cat_ID.'">'.$category->name; 
                                    echo '</li>';										
                                endforeach;
                            echo '</ul>';								
                        ?>                      
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpn_latest_news_number">Left articles number:</label>
                        <input name="fpn_latest_news_number" type="text" value="<?php echo get_option('fpn_latest_news_number'); ?>" size="8" />                    
                        <img class="hint-icon" title="Enter the total number of posts that you want to be displayed. Type -1 if you want all your posts to be displayed." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpn_headlines_title">Main articles title:</label>
                        <input name="fpn_headlines_title" type="text" value="<?php echo get_option('fpn_headlines_title'); ?>" size="50" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpn_headlines_category">Main articles categories:</label>
                        <?php
                            $fpn_headlines_category = get_option('fpn_headlines_category');
                            $categories = get_categories();
							$haystack = explode(',',$fpn_headlines_category);							
                            echo '<ul class="categories_listing">';								
                                foreach($categories as $category):
                                    $validate = NULL;
                                    $checked = '';
									$validate = in_array($category->cat_ID,$haystack);
                                    if ( $validate != '' ) $checked = ' checked="checked"';
                                    echo '<li>';
                                        echo '<input id="news-headlines-category-'.$category->cat_ID.'" type="checkbox" name="fpn_headlines_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                        echo '<label for="news-headlines-category-'.$category->cat_ID.'">'.$category->name; 
                                    echo '</li>';										
                                endforeach;
                            echo '</ul>';								
                        ?>                      
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpn_headlines_number">Main articles number:</label>
                        <input name="fpn_headlines_number" type="text" value="<?php echo get_option('fpn_headlines_number'); ?>" size="8" />                    
                        <img class="hint-icon" title="Enter the total number of posts that you want to be displayed. Type -1 if you want all your posts to be displayed." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div> 
                    <div class="table-row clearfix">
                        <label for="fpn_headlines_number_intro">Main articles with image intro:</label>
                        <input name="fpn_headlines_number_intro" type="text" value="<?php echo get_option('fpn_headlines_number_intro'); ?>" size="8" />                    
                        <img class="hint-icon" title="Enter the number of posts you want to be displayed with an image and text." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpn_other_title">Bottom articles title:</label>
                        <input name="fpn_other_title" type="text" value="<?php echo get_option('fpn_other_title'); ?>" size="50" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpn_other_category">Bottom articles categories:</label>
                        <?php
                            $fpn_other_category = get_option('fpn_other_category');
							$haystack = explode(',',$fpn_other_category);							
                            $categories = get_categories();
                            echo '<ul class="categories_listing">';								
                                foreach($categories as $category):
                                    $validate = NULL;
                                    $checked = '';
									$validate = in_array($category->cat_ID,$haystack);
                                    if ( $validate != '' ) $checked = ' checked="checked"';
                                    echo '<li>';
                                        echo '<input id="news-headlines-category-'.$category->cat_ID.'" type="checkbox" name="fpn_other_category[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                        echo '<label for="news-headlines-category-'.$category->cat_ID.'">'.$category->name; 
                                    echo '</li>';										
                                endforeach;
                            echo '</ul>';								
                        ?>                      
                    </div>
                    <div class="table-row clearfix">
                        <label for="fpn_other_number">Bottom articles number:</label>
                        <input name="fpn_other_number" type="text" value="<?php echo get_option('fpn_other_number'); ?>" size="8" />                    
                        <img class="hint-icon" title="Enter the total number of posts that you want to be displayed. Type -1 if you want all your posts to be displayed." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                                                                                                                                                                     
                    <div class="table-row table-row-last clearfix">
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                        <input type="submit" name="search" value="Save changes" class="button" />	
                    </div>                                    
			</div>                            
		<!-- end of front page layouts -->            
		</div>            
	</div>        
	<?php
}

function front_page_presentation_update()
{
	update_option('fppre_intro',stripslashes($_POST['fppre_intro']));
	update_option('fppre_intro_heading',stripslashes($_POST['fppre_intro_heading']));	
	update_option('fppre_intro_text',stripslashes($_POST['fppre_intro_text']));	
	update_option('fppre_row1',$_POST['fppre_row1']);
	update_option('fppre_row2',$_POST['fppre_row2']);	
	if ( $_POST['fppre_row2_category'] != '' ) $fppre_row2_category = implode(',',$_POST['fppre_row2_category']); else $fppre_row2_category = '';	
	update_option('fppre_row2_category',$fppre_row2_category);
	update_option('fppre_row2_number',$_POST['fppre_row2_number']);
	update_option('fppre_row3',$_POST['fppre_row3']);
	update_option('fppre_row4',$_POST['fppre_row4']);
	update_option('fppre_row5',$_POST['fppre_row5']);
	update_option('fppre_row5_meta',$_POST['fppre_row5_meta']);	
	if ( $_POST['fppre_row5_category'] != '' ) $fppre_row5_category = implode(',',$_POST['fppre_row5_category']); else $fppre_row5_category = '';	
	update_option('fppre_row5_category',$fppre_row5_category);
	update_option('fppre_row5_number',$_POST['fppre_row5_number']);	
}
function front_page_business_update()
{
	update_option('fpb_intro',$_POST['fpb_intro']);
	update_option('fpb_intro_heading',stripslashes($_POST['fpb_intro_heading']));	
	update_option('fpb_intro_text',stripslashes($_POST['fpb_intro_text']));
	update_option('fpb_posts',$_POST['fpb_posts']);
	update_option('fpb_posts_number',$_POST['fpb_posts_number']);
	update_option('fpb_posts_columns',$_POST['fpb_posts_columns']);	
	if ( $_POST['fpb_posts_category'] != '' ) $fpb_posts_category = implode(',',$_POST['fpb_posts_category']); else $fpb_posts_category = '';
	update_option('fpb_posts_category', $fpb_posts_category);
	update_option('fpb_bottom',$_POST['fpb_bottom']);
	update_option('fpb_bottom_scroller',$_POST['fpb_bottom_scroller']);
	update_option('fpb_bottom_scroller_title',stripslashes($_POST['fpb_bottom_scroller_title']));	
	update_option('fpb_bottom_scroller_size',$_POST['fpb_bottom_scroller_size']);
	if ( $_POST['fpb_bottom_scroller_category'] != '' ) $fpb_bottom_scroller_category = implode(',',$_POST['fpb_bottom_scroller_category']); else $fpb_bottom_scroller_category = '';
	update_option('fpb_bottom_scroller_category', $fpb_bottom_scroller_category);
	update_option('fpb_bottom_scroller_number',$_POST['fpb_bottom_scroller_number']);	
	update_option('fpb_bottom_widget_areas',$_POST['fpb_bottom_widget_areas']);	
}
function front_page_posts_update()
{
	update_option('fpp_intro',$_POST['fpp_intro']);
	update_option('fpp_intro_heading',stripslashes($_POST['fpp_intro_heading']));	
	update_option('fpp_intro_text',stripslashes($_POST['fpp_intro_text']));
	if ( $_POST['fpp_category'] != '' ) $fpp_category = implode(',',$_POST['fpp_category']); else $fpp_category = '';	
	update_option('fpp_category',$fpp_category);	
	update_option('fpp_post_number',$_POST['fpp_post_number']);	
	update_option('fpp_title',$_POST['fpp_title']);		
	update_option('fpp_content',$_POST['fpp_content']);	
	update_option('fpp_date',$_POST['fpp_date']);
}
function front_page_news_update() 
{
	update_option('fpn_sidebar',$_POST['fpn_sidebar']);	
	update_option('fpn_latest_news_title',stripslashes($_POST['fpn_latest_news_title']));	
	if ( $_POST['fpn_latest_news_category'] != '' ) $fpn_latest_news_category = implode(',',$_POST['fpn_latest_news_category']); else $fpn_latest_news_category = '';	
	update_option('fpn_latest_news_category',$fpn_latest_news_category);	
	update_option('fpn_latest_news_number',$_POST['fpn_latest_news_number']);	
	update_option('fpn_headlines_title',stripslashes($_POST['fpn_headlines_title']));
	if ( $_POST['fpn_headlines_category'] != '' ) $fpn_headlines_category = implode(',',$_POST['fpn_headlines_category']); else $fpn_headlines_category = '';		
	update_option('fpn_headlines_category',$fpn_headlines_category);
	update_option('fpn_headlines_number',$_POST['fpn_headlines_number']);
	update_option('fpn_headlines_number_intro',$_POST['fpn_headlines_number_intro']);	
	update_option('fpn_other_title',stripslashes($_POST['fpn_other_title']));
	if ( $_POST['fpn_other_category'] != '' ) $fpn_other_category = implode(',',$_POST['fpn_other_category']); else $fpn_other_category = '';		
	update_option('fpn_other_category',$fpn_other_category);
	update_option('fpn_other_number',$_POST['fpn_other_number']);	
}
add_action('admin_menu', 'fpm_admin_menu');
?>