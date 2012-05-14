<?php
/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function zen_head_css() {

		$shortname =  get_option('zen_shortname'); 
		$output = '';
		
		$custom_css = get_option('zen_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}

        /* Custom Highlight Color */
        $custom_highlight = get_option('zen_color_hover');
        if( !empty($custom_highlight) && $custom_highlight != '#' ) {
            $output .= "\n\n /* Custom Accent Colour */ \n\n";
            $output .= ".list-of-comments .by-author .avatar, \n.entry-meta a:hover, \n .module-image img:hover { background-color: $custom_highlight; }\n";
            $output .= "textarea:focus, \ninput[type=\"text\"]:focus, \ninput[type=\"password\"]:focus, \ninput[type=\"file\"]:focus, \n.flickr_badge_image img:hover, \nfooter a:hover { border-color: $custom_highlight; }\n";
            $output .= "ul#sort li.current a, ul#sort a:hover,\na:hover,\nfooter a:hover,\n #BuddyPress .standard-form#signup_form div div.error { color: $custom_highlight; }\n";
        }
		
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}
add_action('wp_head', 'zen_head_css');

/*-----------------------------------------------------------------------------------*/
/* - Add Favicon
/*-----------------------------------------------------------------------------------*/

function zen_favicon() {

	$shortname = get_option('zen_shortname');

	if (get_option($shortname . '_custom_favicon') != '') {

	echo '<link rel="shortcut icon" href="'. get_option('zen_custom_favicon') .'"/>'."\n";

	}

	else { ?>

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />

	<?php }
}
add_action('wp_head', 'zen_favicon');

/*-----------------------------------------------------------------------------------*/
/* - Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function zen_analytics(){
	$shortname =  get_option('zen_shortname');
	$output = get_option($shortname . '_google_analytics');

	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";

}
add_action('wp_footer','zen_analytics');


class Portfolio_Walker extends Walker_Category {
    function start_el(&$output, $category, $depth, $args) {
            extract($args);

            $cat_name = esc_attr( $category->name );
            $cat_name = apply_filters( 'list_cats', $cat_name, $category );
            $link = '<a href="' . esc_attr( get_term_link($category) ) . '" ';
            $link .= 'data-filter="' . $category->slug . '" ';
            if ( $use_desc_for_title == 0 || empty($category->description) )
                    $link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
            else
                    $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
            $link .= '>';
            $link .= $cat_name . '</a>';

            if ( !empty($feed_image) || !empty($feed) ) {
                    $link .= ' ';

                    if ( empty($feed_image) )
                            $link .= '(';

                    $link .= '<a href="' . get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) . '"';

                    if ( empty($feed) ) {
                            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
                    } else {
                            $title = ' title="' . $feed . '"';
                            $alt = ' alt="' . $feed . '"';
                            $name = $feed;
                            $link .= $title;
                    }

                    $link .= '>';

                    if ( empty($feed_image) )
                            $link .= $name;
                    else
                            $link .= "<img src='$feed_image'$alt$title" . ' />';

                    $link .= '</a>';

                    if ( empty($feed_image) )
                            $link .= ')';
            }

            if ( !empty($show_count) )
                    $link .= ' (' . intval($category->count) . ')';

            if ( !empty($show_date) )
                    $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);

            if ( 'list' == $args['style'] ) {
                    $output .= "\t<li";
                    $class = 'cat-item cat-item-' . $category->term_id;
                    if ( !empty($current_category) ) {
                            $_current_category = get_term( $current_category, $category->taxonomy );
                            if ( $category->term_id == $current_category )
                                    $class .=  ' current-cat';
                            elseif ( $category->term_id == $_current_category->parent )
                                    $class .=  ' current-cat-parent';
                    }
                    $output .=  ' class="' . $class . '"';
                    $output .= ">$link\n";
            } else {
                    $output .= "\t$link<br />\n";
            }
    }
}


?>