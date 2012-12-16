<?php 

global $woo_options; 
$emailError = '';
$nameError = '';
$commentError = '';

//If the form is submitted
if(isset($_POST['submitted'])) {


	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError =  __('You forgot to enter your name.', 'woothemes'); 
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = __('You forgot to enter your email address.', 'woothemes');
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = __('You entered an invalid email address.', 'woothemes');
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = __('You forgot to enter your comments.', 'woothemes');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {
			
			$emailTo = get_option('woo_contactform_email'); 
			$subject = __('Contact Form Submission from ', 'woothemes').$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = __("Name: $name \n\nEmail: $email \n\nComments: $comments", 'woothemes');
			$headers = __('From: ', 'woothemes') .' <'.$emailTo.'>' . "\r\n" . __('Reply-To: ','woothemes') . $email;

			//Modified 2010-04-29 (fox)
			wp_mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = __('You emailed ', 'woothemes').get_bloginfo('title');
				$headers = __('From: ','woothemes') . '<'.$emailTo.'>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
}

?>

	<div id="contact" class="section"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			 <?php if(isset($emailSent) && $emailSent == true) { ?>
            
                <p class="info"><?php _e('Your email was successfully sent.', 'woothemes'); ?></p>
            
            <?php } else { ?>
		
				<div class="desc">
					<h2><?php echo $woo_options[ 'woo_contact_title' ]; ?></h2>
					
					<p class="desc"><?php echo $woo_options[ 'woo_contact_desc' ]; ?></p>
				</div>
				
				<div id="contact-form">
				
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <p class="alert"><?php _e('There was an error submitting the form.', 'woothemes'); ?></p>
                    <?php } ?>
					
					 <?php if ( get_option('woo_contactform_email') == '' ) { ?>
                        <p class="alert"><?php _e('E-mail has not been setup properly. Please add your contact e-mail!', 'woothemes'); ?></p>
                    <?php } ?>
				
					<form id="contact-us" action="<?php the_permalink(); ?>" method="post">
					
						<p>
							<label class="screen-reader-text">Name</label>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="Name:"							/>
							<?php if($nameError != '') { ?>
								<br /><span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
						</p>
						<p>
							<label class="screen-reader-text">Email</label>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email" placeholder="Email:" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</p>
						<p>
							<label class="screen-reader-text">Message</label>
							 <textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField" placeholder="Message:"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</p>
						<p>
							<button name="submit" type="submit"><span>Submit Message &nbsp;&rarr;</span></button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
						</p>
					
					</form>
								
				</div>
				
			<?php } ?>
			
		</div>
		
	</div></div><!-- End #contact -->
	
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	jQuery(document).ready(function() {
		jQuery('form#contact-us').submit(function() {
			jQuery('form#contact-us .error').remove();
			var hasError = false;
			jQuery('.requiredField').each(function() {
				if(jQuery.trim(jQuery(this).val()) == '') {
					var labelText = jQuery(this).prev('label').text();
					jQuery(this).parent().append('<span class="error"><?php _e('You forgot to enter your', 'woothemes'); ?> '+labelText+'.</span>');
					jQuery(this).addClass('inputError');
					hasError = true;
				} else if(jQuery(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
						var labelText = jQuery(this).prev('label').text();
						jQuery(this).parent().append('<span class="error"><?php _e('You entered an invalid', 'woothemes'); ?> '+labelText+'.</span>');
						jQuery(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = jQuery(this).serialize();
				jQuery.post(jQuery(this).attr('action'),formInput, function(data){
					jQuery('form#contact-us').slideUp("fast", function() {				   
						jQuery(this).before('<p class="tick"><?php _e('<strong>Thanks!</strong> Your email was successfully sent.', 'woothemes'); ?></p>');
					});
				});
			}
			
			return false;
			
		});
	});
	//-->!]]>
	</script>