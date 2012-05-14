<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Recent Portfolio/Work Widget
	Description: A widget that allows the display of recent portfolios/work.

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'zen_register_widget' );


// Register widget.
function zen_register_widget() {
	register_widget( 'ZEN_Register_Widget' );
}

// Widget class.
class zen_register_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function ZEN_Register_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 
		    'classname' => 'zen_register_widget', 
		    'description' => __('A widget that displays a register form for your users.', 'framework') 
		);

		/* Widget control settings. */
		$control_ops = array( 
		    'width' => 300, 
		    'height' => 350, 
		    'id_base' => 'zen_register_widget' 
		);

		/* Create the widget. */
		$this->WP_Widget( 'zen_register_widget', __('Custom Register Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$desc = $instance['desc'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		
if ( !is_user_logged_in() ) {
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) { echo $before_title . $title . $after_title; }
?>

		<br />
				<hr style="margin: 0;" />

				<h2><?php echo $desc; ?> <a href="<?php echo site_url(); ?>/register" class="button large red">Sign Up</a></h2>
				

				<hr style="margin: 0;" />
		<br />

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
		$instance['desc'] = strip_tags( $new_instance['desc'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Register',
		'desc' => 'Not yet a member?  ',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Description: Text Input -->
    	<p>
    		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'framework') ?></label>
    		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
    	</p>
        

	
	<?php
	}
}
?>