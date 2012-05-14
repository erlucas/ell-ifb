<?php
/*
Template Name: Contact
*/
?>

<?php 

	// Setting up Errors
	$mailError = '';
	$nameError = '';
	$commentError = '';

if (isset($_POST['submitted'])) {

		if (trim($_POST['contact-name']) === '') {

			$nameError = 'Please enter your name.';
			$hasError = true;

		} else {

			$name = trim($_POST['contact-name']);

		}
		
		if (trim($_POST['mail']) === '')  {
			
			$mailError = 'Please enter your email address.';
			$hasError = true;
		
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['mail']))) {
		
			$mailError = 'You entered an invalid email address.';
			$hasError = true;
		
		} else {
		
			$mail = trim($_POST['mail']);
		
		}
			
		if (trim($_POST['comment']) === '') {
		
			$commentError = 'Please enter a message.';
			$hasError = true;
		
		} else {
		
			if (function_exists('stripslashes')) {
		
				$comment = stripslashes(trim($_POST['comment']));
		
			} else {
		
				$comment = trim($_POST['comment']);
		
			}
		
		}
			
		if(!isset($hasError)) {
			
			$mailTo = get_option('zen_mail');
			
			if (!isset($mailTo) || ($mailTo == '') ){
				
				$mailTo = get_option('admin_mail');
			
			}
			
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $mail \n\nComment: $comment";
			$headers = 'From: '.$name.' <'.$mailTo.'>' . "\r\n" . 'Reply-To: ' . $mail;
			
			mail($mailTo, $subject, $body, $headers);
			$mailSent = true;
		}
	
} ?>

<?php get_header(); ?>

	<div id="middle">

		<div class="container content-background">

			<!--BEGIN .page-title -->
			<div class="page-title">
        
                <h1 class="page-title-heading ten columns"><?php the_title(); ?></h1>

				   
		
			<!--END .page-title -->
			</div>

            
			<!--BEGIN #main-content -->
			<section class="main-content top-margin eleven columns">
	            		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .post -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
	    
	                    <!--BEGIN .entry-content -->
						<div class="entry-content">

						<?php if(isset($mailSent) && $mailSent == true) { ?>
	    
	                        <div class="alert green">
	    
	    						<h1><?php _e('Email Sent!', 'framework') ?></h1>
	                            <p><?php _e('Thanzen, your mail was sent successfully.', 'framework') ?></p>
	    
	                        </div>
	    
	                    <?php } else { ?>
	    
	                        <?php the_content(); ?>
	            
	                        <?php if(isset($hasError) || isset($captchaError)) { ?>
	                        
	                            <p class="error"><?php _e('Sorry, an error occurred.', 'framework') ?><p>
	                        
							<?php } ?>
	        
	                        <form id="contact-form" method="post" action="<?php the_permalink(); ?>">
	                        
	                            <ul class="contact-form">
	                        
	                                <li>

	                                	<p>

	                                		<label for="contact-name"><small><?php _e('Your Name: ', 'framework') ?> <span>*</span></small></label>
	                        
	                                    	<input class="required" name="contact-name" id="contact-name" value="<?php if(isset($_POST['contact-name'])) echo $_POST['contact-name'];?>" type="text" />
	                        
	                                    <?php if($nameError != '') { ?>
	                        
	                                        <span class="error"><?php echo $nameError; ?></span> 
	                        
	                                    <?php } ?>
	                        
	                                    </p>
	                        
	                                </li>
	                    
	                                <li>

	                                	<p>

	                                		<label for="mail"><small><?php _e('Your E-mail: ', 'framework') ?><span>*</span></small></label>
	                        
	                                    	<input class="required mail" name="mail" id="mail" value="<?php if(isset($_POST['mail']))  echo $_POST['mail']; ?>" type="text" />
	                        
	                                    <?php if($mailError != '') { ?>
	                        
	                                        <span class="error"><?php echo $mailError; ?></span>
	                        
	                                    <?php } ?>
	                        
	                                    </p>
	                        
	                                </li>
	                    
	                        
	                                <li class="textarea">

	                                	<p>
	                                		<label for="comment-text"><small><?php _e('Your Message: ', 'framework') ?><span>*</span></small>
	                                		</label>
	                        
		                                    <textarea name="comment" id="comment-text" class="required">
		                                    	<?php if(isset($_POST['comment'])) { 
			                                    		if(function_exists('stripslashes')) { 
				                                    			echo stripslashes($_POST['comment']); 
				                                    	} else { echo $_POST['comment']; } } ?>
				                            </textarea>
		                        
	                                    <?php if($commentError != '') { ?>
	                        
	                                        <span class="error"><?php echo $commentError; ?></span> 
	                        
	                                    <?php } ?>
	                        
	                                    </p>
	                        
	                                </li>
	                    
	                                <li class="button">
	                        
	                                    <button id="submit" type="submit"><?php _e('Contact us!', 'framework') ?></button>
	                        
	                                </li>
	                        
	                            </ul>
	                        
	                        </form>
	                    
						<?php } ?>

	                    <!-- END .entry-content -->
	                    </div>   
                          
				<!--END posts-->  
				</div>

				<?php endwhile; ?>

			<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-0">
				
					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						
                        <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
					
                    <!--END .entry-content-->
					</div>
				
				<!--END #post-404-->
				</div>

			<?php endif; ?>
			<!--END #main-content .twelve .columns-->

		</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>