<?php

	function contact_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Contact Page Manager Generator', 'Contact Page', 'manage_options', 'duotive-contact', 'contact_page');
	}

	function contact_page() 
	{
		if ( isset($_POST['contact_update']) && $_POST['contact_update'] == 'true' ) { contact_update(); }	
?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/duotive-admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/jqtransform.css" /> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.js" /></script>
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
                <li><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li> 
                <li class="active"><a href="admin.php?page=duotive-contact">Contact page</a></li>                                                                                
            </ul>
        </div>
        <div id="duotive-admin-panel">
            <h3>Contact page manager</h3>
            <ul>
                <li><a href="#general-settings">General settings</a></li>
                <li><a href="#sidebar-settings">Sidebar info</a></li>                
            </ul> 
            <div id="settings">          
                <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-contact" class="transform">
                    <input type="hidden" name="contact_update" value="true" />
                    <div id="general-settings"> 
                        <div class="table-row clearfix">
                            <label for="form_title">Contact form title:</label>
                            <input name="form_title" type="text" value="<?php echo get_option('form_title'); ?>" size="50" />
                        </div>                    
                        <div class="table-row clearfix">
                            <label for="destination_email">Destination e-mail:</label>
                            <input name="destination_email" type="text" value="<?php echo get_option('destination_email'); ?>" size="50" />
                            <img class="hint-icon" title="Type in the e-mail address where the e-mail from the contact form will be sent. Multiple e-mail addresses can be used, separated by commas." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row clearfix">
                            <label for="recaptcha">Use reCAPTCHA:</label>
                            <select name="recaptcha">
                                <?php $recaptcha = get_option('recaptcha'); ?>
                                <option value="no" <?php if ($recaptcha=='no') { echo 'selected'; } ?> >No</option>                                
                                <option value="yes" <?php if ($recaptcha=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            </select>
                            <img class="hint-icon" title="To use reCaptcha you will need to go to http://www.google.com/recaptcha and click on &quot;Use reCAPTCHA ON YOUR SITE&quot; button, and then on &quot;Sign up Now!&quot;. Type in your domain name as shown in the example then copy/paste the generated codes in the appropriate fields." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" /> 
                        </div> 
                        <div class="table-row clearfix">
                            <label for="recaptchapublickey">reCAPTCHA public key:</label>
							<input name="recaptchapublickey" type="text" value="<?php echo get_option('recaptchapublickey'); ?>" size="50" />                                                        
                        </div>
                        <div class="table-row clearfix">
                            <label for="recaptchaprivatekey">reCAPTCHA private key:</label>
							<input name="recaptchaprivatekey" type="text" value="<?php echo get_option('recaptchaprivatekey'); ?>" size="50" />                                                        
                        </div>                                                                        
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Save changes" class="button" />
                        </div>                                      
                    </div>
                    <div id="sidebar-settings">      
                        <div class="table-row clearfix">
                            <label for="contact_person_check">Enable contact person?</label>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('contact_person_check') == 1 ) echo 'checked="checked"';?>  name="contact_person_check" value="1">Yes</div>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('contact_person_check') == 0 ) echo 'checked="checked"';?>  name="contact_person_check" value="0">No</div>
                        </div>                      
                        <div class="table-row clearfix">
                            <label for="contact_person">Contact person:</label>
                            <input name="contact_person" type="text" value="<?php echo get_option('contact_person'); ?>" size="50" />
                        </div> 
                        <div class="table-row clearfix">
                            <label for="contact_person_check">Enable address?</label>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('address_check') == 1 ) echo 'checked="checked"';?>  name="address_check" value="1">Yes</div>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('address_check') == 0 ) echo 'checked="checked"';?>  name="address_check" value="0">No</div>
                        </div>                      
                        <div class="table-row clearfix">
                            <label for="contact_person">Address:</label>
                            <input name="address" type="text" value="<?php echo get_option('address'); ?>" size="50" />
                        </div> 
                        <div class="table-row clearfix">
                            <label for="phone_check">Enable phone?</label>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('phone_check') == 1 ) echo 'checked="checked"';?>  name="phone_check" value="1">Yes</div>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('phone_check') == 0 ) echo 'checked="checked"';?>  name="phone_check" value="0">No</div>
                        </div>                      
                        <div class="table-row clearfix">
                            <label for="phone">Phone:</label>
                            <input name="phone" type="text" value="<?php echo get_option('phone'); ?>" size="50" />
                        </div> 
                        <div class="table-row clearfix">
                            <label for="fax_check">Enable fax?</label>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('fax_check') == 1 ) echo 'checked="checked"';?>  name="fax_check" value="1">Yes</div>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('fax_check') == 0 ) echo 'checked="checked"';?>  name="fax_check" value="0">No</div>
                        </div>                      
                        <div class="table-row clearfix">
                            <label for="fax">Fax:</label>
                            <input name="fax" type="text" value="<?php echo get_option('fax'); ?>" size="50" />
                        </div>  
                        <div class="table-row clearfix">
                            <label for="mobile_check">Enable mobile?</label>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('mobile_check') == 1 ) echo 'checked="checked"';?>  name="mobile_check" value="1">Yes</div>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('mobile_check') == 0 ) echo 'checked="checked"';?>  name="mobile_check" value="0">No</div>
                        </div>                      
                        <div class="table-row clearfix">
                            <label for="mobile">Mobile:</label>
                            <input name="mobile" type="text" value="<?php echo get_option('mobile'); ?>" size="50" />
                        </div>
                        <div class="table-row clearfix">
                            <label for="email_check">Enable e-mail?</label>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('email_check') == 1 ) echo 'checked="checked"';?>  name="email_check" value="1">Yes</div>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('email_check') == 0 ) echo 'checked="checked"';?>  name="email_check" value="0">No</div>
                        </div>                      
                        <div class="table-row clearfix">
                            <label for="email">E-mail:</label>
                            <input name="email" type="text" value="<?php echo get_option('email'); ?>" size="50" />
                        </div>  
                        <div class="table-row clearfix">
                            <label for="info_check">Enable extra info?</label>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('info_check') == 1 ) echo 'checked="checked"';?>  name="info_check" value="1">Yes</div>
                            <div class="radio-in-line"><input type="radio" <?php if ( get_option('info_check') == 0 ) echo 'checked="checked"';?>  name="info_check" value="0">No</div>
                        </div>                      
                        <div class="table-row clearfix">
                            <label for="info">Extra info:</label>
                            <textarea name="info" cols="40" rows="8"><?php echo get_option('info'); ?></textarea>
                        </div>                                                                                                                                            
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Save changes" class="button" />
                        </div>
					</div>                        	
			        <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />                        	                    
                </form>                            
            </div>
        </div>    
    </div>        
<?php
	}
	function contact_update()
	{
		update_option('form_title',$_POST['form_title']);				
		update_option('destination_email',$_POST['destination_email']);
		update_option('recaptcha',$_POST['recaptcha']);	
		update_option('recaptchapublickey',$_POST['recaptchapublickey']);
		update_option('recaptchaprivatekey',$_POST['recaptchaprivatekey']);		
		update_option('contact_person_check',$_POST['contact_person_check']);
		update_option('contact_person',$_POST['contact_person']);	
		update_option('address_check',$_POST['address_check']);
		update_option('address',$_POST['address']);
		update_option('phone_check',$_POST['phone_check']);
		update_option('phone',$_POST['phone']);	
		update_option('fax_check',$_POST['fax_check']);
		update_option('fax',$_POST['fax']);	
		update_option('mobile_check',$_POST['mobile_check']);
		update_option('mobile',$_POST['mobile']);	
		update_option('email_check',$_POST['email_check']);
		update_option('email',$_POST['email']);	
		update_option('info_check',$_POST['info_check']);
		update_option('info',stripslashes($_POST['info']));			
	}	
	add_action('admin_menu', 'contact_admin_menu');

?>
