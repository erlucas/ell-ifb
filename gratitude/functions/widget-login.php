<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Recent Portfolio/Work Widget
	Description: A widget that allows the display of recent portfolios/work.

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'zen_login_widget' );


// Register widget.
function zen_login_widget() {
	register_widget( 'ZEN_Login_Widget' );
}

// Widget class.
class zen_login_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function ZEN_Login_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 
		    'classname' => 'zen_login_widget', 
		    'description' => __('A widget that displays a login form for your users.', 'framework') 
		);

		/* Widget control settings. */
		$control_ops = array( 
		    'width' => 300, 
		    'height' => 350, 
		    'id_base' => 'zen_login_widget' 
		);

		/* Create the widget. */
		$this->WP_Widget( 'zen_login_widget', __('Custom Login Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;
if ( !is_user_logged_in() ) {
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) { echo $before_title . $title . $after_title; }
?>
			
		<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
			<p>
				<label for="user_login"><?php _e('Username') ?><br />
				<input style="width: 95%; margin-bottom: 5px;" type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" tabindex="10" /></label>
				<label for="user_pass"><?php _e('Password') ?><br />
				<input style="width: 95%" type="password" name="pwd" id="user_pass" class="input" value="" tabindex="20" /></label>
			</p>
		<?php do_action('login_form'); ?>
			
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button-primary button blue" value="<?php esc_attr_e('Sign In'); ?>" tabindex="100" style="width: 100%;" />
			</p>
		</form>

		<?php } ?>

	
	<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Login',
		'desc' => 'Sign up to begin browsing the members areas and interracting with the community.',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		

	
	<?php
	}
}
?>