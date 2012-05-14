<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Recent Portfolio/Work Widget
	Description: A widget that allows the display of recent portfolios/work.

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'zen_recent_activity_widget' );


// Register widget.
function zen_recent_activity_widget() {
	register_widget( 'ZEN_Recent_Activity_Widget' );
}

// Widget class.
class zen_recent_activity_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function ZEN_Recent_Activity_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 
		    'classname' => 'zen_recent_activity_widget', 
		    'description' => __('A widget that displays your recent activity.', 'framework') 
		);

		/* Widget control settings. */
		$control_ops = array( 
		    'width' => 300, 
		    'height' => 350, 
		    'id_base' => 'zen_recent_activity_widget' 
		);

		/* Create the widget. */
		$this->WP_Widget( 'zen_recent_activity_widget', __('Custom Recent Activity Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		// Force the number of activity items on home page
		if ( is_home() || is_front_page()) {
			function my_custom_query_filter( $query_string ) {
				$query_string .= '&per_page=5?';
				return $query_string;
			}
			add_filter( 'bp_dtheme_ajax_querystring', 'my_custom_query_filter' );
			
			// hide the "Load more" button
			$bpLoadMore = 'none';			
		}

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) { echo $before_title . $title . $after_title; }
?>
			
				<div ID="BuddyPress" class="activity">
					<?php locate_template( array( 'activity/activity-loop.php' ), true ); ?>
				</div><!-- .activity -->
	
				<?php do_action( 'bp_after_directory_activity_content' ); ?>
	
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
		'title' => 'Recent Activity',
		
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