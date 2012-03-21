<?php 
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once('includes/recaptchalib.php');	

	$publickey = get_option('recaptchapublickey');
	$privatekey = get_option('recaptchaprivatekey');
	
	$captcha_empty = 'You forgot to fill in the security code.';	
	$captcha_error = 'The value you entered in the security field didn\'t match.';
	$mail_success = 'The e-mail was sent successfully.';
	$mail_error = 'The e-mail could not be sent. Please try again.';
	
	$resp = null;
	$error = null;
	
	$recaptcha = get_option('recaptcha'); if( $recaptcha = '') $recaptcha = 'no'; else $recaptcha = get_option('recaptcha');
	
	if ( isset($_POST['contact_widget']) ) $contact_widget = $_POST['contact_widget']; else $contact_widget = 0;
	if ( $contact_widget == 0 )
	{
		if ( $recaptcha == 'yes' )
		{
			if ($_POST["recaptcha_response_field"])
			{
					$resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
					if ($resp->is_valid)
					{
						if ( isset($_POST['admin_email'])) $to = $_POST['admin_email'];
						if ( isset($_POST['name'])) $name = $_POST['name'];
						if ( isset($_POST['email'])) $email = $_POST['email'];
						if ( isset($_POST['subject'])) $subject = $_POST['subject'];
						if ( isset($_POST['message'])) $message = $_POST['message'];
						if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) 
						{
							$headers = "MIME-Version: 1.0\r\n";
							$headers .= "From: ".$name." <".$email."> \r\n";
							$headers .= "Reply-to:".$email."\r\n";
							$headers .= "X-Priority: 3\r\n";
							$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							$headers .= "X-Mailer: PHP mailer\r\n";
							
							if ( $name ) $mail = 'Name: '.$name.'<br />';
							if ( $subject ) $mail .= 'Subject: '.$subject.'<br />';
							if ( $message ) $mail .= 'Message: '.$message;
							
							if ( $subject == '' ) $subject = 'A new contact message from your website.';			
							
							if ( $mail ) $mail_tester = wp_mail($to, $subject, $mail, $headers);
							if ( $mail_tester == 1 )
							{
								echo $mail_success;						
							}
							else
							{
								echo $mail_error;							
							}
						}
					} 
					else
					{
						echo $captcha_error;
					}
			}
			else 
			{
				echo $captcha_empty;
			}
		}
		else
		{
			if ( isset($_POST['admin_email'])) $to = $_POST['admin_email'];
				if ( isset($_POST['name'])) $name = $_POST['name'];
				if ( isset($_POST['email'])) $email = $_POST['email'];
				if ( isset($_POST['subject'])) $subject = $_POST['subject'];
				if ( isset($_POST['message'])) $message = $_POST['message'];
				if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) 
				{
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "From: ".$name." <".$email."> \r\n";
					$headers .= "Reply-to:".$email."\r\n";
					$headers .= "X-Priority: 3\r\n";
					$headers .= "Content-Type: text/html; charset=utf-8\r\n";
					$headers .= "X-Mailer: PHP mailer\r\n";
					
					if ( $name ) $mail = 'Name: '.$name.'<br />';
					if ( $subject ) $mail .= 'Subject: '.$subject.'<br />';
					if ( $message ) $mail .= 'Message: '.$message;
					
					if ( $subject == '' ) $subject = 'A new contact message from your website.';			
					
					if ( $mail ) $mail_tester = wp_mail($to, $subject, $mail, $headers);
					if ( $mail_tester == 1 )
					{
						echo $mail_success;						
					}
					else
					{
						echo $mail_error;							
					}
				}	
		}
	}
	else
	{
		if ( isset($_POST['admin_email'])) $to = $_POST['admin_email'];
			if ( isset($_POST['name'])) $name = $_POST['name'];
			if ( isset($_POST['email'])) $email = $_POST['email'];
			if ( isset($_POST['subject'])) $subject = $_POST['subject'];
			if ( isset($_POST['message'])) $message = $_POST['message'];
			if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) 
			{
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From: ".$name." <".$email."> \r\n";
				$headers .= "Reply-to:".$email."\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8\r\n";
				$headers .= "X-Mailer: PHP mailer\r\n";
				
				if ( $name ) $mail = 'Name: '.$name.'<br />';
				if ( $subject ) $mail .= 'Subject: '.$subject.'<br />';
				if ( $message ) $mail .= 'Message: '.$message;
				
				if ( $subject == '' ) $subject = 'A new contact message from you\'re website.';			
				
				if ( $mail ) $mail_tester = wp_mail($to, $subject, $mail, $headers);
				
				if ( $mail_tester == 1 )
				{
					echo $mail_success;						
				}
				else
				{
					echo $mail_error;							
				}
			}	
	}
?>