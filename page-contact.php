<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Page - Contact
 */
include('includes/recaptchalib.php');
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="content-wrapper">
        <div id="content" class="content-full-width"> 
			<?php $slider_display = get_option('slider_display'); if ( $slider_display == '' ) $slider_display = '1'; else $slider_display = get_option('slider_display'); ?>
            <?php if ( $slider_display == 0 ) : ?>
                <h1 class="page-title">
                    <?php echo $title; ?>
                </h1>                   	
            <?php endif; ?>                
            <?php if ( the_content() ): ?>
                <?php the_content(); ?>
            <?php endif; ?>
            <br /> 
			<div id="contact-page">
            	<div id="contact-sidebar-wrapper">
                	<div id="contact-sidebar">
	                	<ul>
                        	<?php if ( get_option('contact_person_check') == 1 ) : ?>
                                <li>
                                    <span class="contact-icon contact-icon-user">&nbsp;</span>
                                    <?php echo get_option('contact_person'); ?>
                                </li>                         
                            <?php endif; ?>
                            <?php if ( get_option('address_check') == 1 ) : ?>
                                <li>
                                    <span class="contact-icon contact-icon-address">&nbsp;</span>
                                    <p><?php echo get_option('address'); ?></p>
                                </li>
                            <?php endif; ?>
                            <?php if ( get_option('phone_check') == 1 ) : ?>
                        	<li>
                            	<span class="contact-icon contact-icon-phone">&nbsp;</span>
                                <?php echo get_option('phone'); ?>
                            </li> 
                            <?php endif; ?>
                            <?php if ( get_option('fax_check') == 1 ) : ?>
                        	<li>
                            	<span class="contact-icon contact-icon-fax">&nbsp;</span>
                                <?php echo get_option('fax'); ?>
                            </li> 
                            <?php endif; ?>
                            <?php if ( get_option('mobile_check') == 1 ) : ?>                            
                        	<li>
                            	<span class="contact-icon contact-icon-mobile">&nbsp;</span>
                                <?php echo get_option('mobile'); ?>
                            </li>
                            <?php endif; ?>  
                            <?php if ( get_option('email_check') == 1 ) : ?>                                                                                   
                        	<li>
                            	<span class="contact-icon contact-icon-email">&nbsp;</span>
                                <a href="mailto:<?php echo get_option('email'); ?>"><?php echo get_option('email'); ?></a>
                            </li> 
                            <?php endif; ?>
                            <?php if ( get_option('info_check') == 1 ) : ?>                                                                                                               
                        	<li>
                            	<span class="contact-icon contact-icon-info">&nbsp;</span>
                                <p><?php echo stripslashes(get_option('info')); ?></p>
                            </li>                                                        
                            <?php endif; ?>
                        </ul>
                    </div>
                <!-- end of contact sidebar wrapper -->
                </div>
                <div id="contact-confirmation-message" class="note"></div>
				<script type="text/javascript">
					 var RecaptchaOptions = {
						theme : 'custom',
						custom_theme_widget: 'recaptcha_widget'
					 };
                </script>                   
                <form id="contactform" method="post" class="jqtransformdone" action="<?php bloginfo('template_url'); ?>/page-contact-sender.php">
                	<?php $destination_email = get_option('destination_email'); if ( $destination_email == '' ) $destination_email = get_bloginfo('admin_email'); else $destination_email = get_option('destination_email'); ?>
                    <input type="hidden" name="admin_email" value="<?php echo $destination_email; ?>" />
                    <?php if ( get_option('form_title') != '' ) : ?>
                    	<h5><?php echo get_option('form_title'); ?></h5>
					<?php endif; ?>
                    <div class="formrow formhalfrow clearfix">                
                        <label for="name"><?php echo __('Name:','duotive'); ?></label>
                        <input id="name" type="text" name="name" class="required" size="38"/>
                    </div>
                    <div class="formrow formhalfrow clearfix">
                        <label for="email"><?php echo __('E-mail:','duotive'); ?></label>
                        <input id="email" type="text" name="email" class="required email" size="40"/>
                    </div>
                    <div class="formrow clearfix">
                        <label for="subject"><?php echo __('Subject:','duotive'); ?></label>
                        <input id="subject" type="text" name="subject" class="required" size="89"/>
                    </div>
                    <div class="formrow clearfix">
                        <label for="message"><?php echo __('Message:','duotive'); ?></label>
                        <textarea id="message" rows="10" cols="86" spellcheck="false" name="message" class="required"></textarea>
                    </div>
					<?php $recaptcha = get_option('recaptcha'); if( $recaptcha = '') $recaptcha = 'no'; else $recaptcha = get_option('recaptcha'); ?>
                    <?php if ( $recaptcha == 'yes' ): ?>
                        <div class="formrow clearfix">
                             <div id="recaptcha_widget" style="display:none">
                               <div id="recaptcha_image"></div>
                               <div id="recaptcha_controls">
                                   <div class="recaptcha_reload"><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
                                   <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                                   <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                                   <div class="recaptcha_help"><a href="javascript:Recaptcha.showhelp()">Help</a></div>
                               </div>                               
                               <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>
                               <span class="recaptcha_only_if_image">Enter the words above:</span>
                               <span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>
                               <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                             </div>
                             <script type="text/javascript"
                                src="http://www.google.com/recaptcha/api/challenge?k=<?php echo get_option('recaptchapublickey'); ?>">
                             </script>
                             <noscript>
                               <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo get_option('recaptchapublickey'); ?>"
                                    height="300" width="500" frameborder="0"></iframe><br>
                               <textarea name="recaptcha_challenge_field" rows="3" cols="40">
                               </textarea>
                               <input type="hidden" name="recaptcha_response_field"
                                    value="manual_challenge">
                             </noscript>
                        </div>
                    <?php endif; ?>
                    <div class="formrow clearfix">
                        <input type="submit" value="<?php echo __('Send Message','duotive'); ?>">
                        <div id="contact-form-loader"></div>
                    </div>
                </form> 
            </div>
        <!-- end of content -->
        </div>
    <!--end of content-wrapper -->
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>

