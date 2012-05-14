<?php

/*-----------------------------------------------------------------------------------

	Theme Shortcodes
 	Author: Zen Factory

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/

function zen_one_third( $atts, $content = null ) {
   return '<div class="one-third-short">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'zen_one_third');

function zen_one_third_last( $atts, $content = null ) {
   return '<div class="one-third-short last-column">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('one_third_last', 'zen_one_third_last');

function zen_two_third( $atts, $content = null ) {
   return '<div class="two-third-short">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'zen_two_third');

function zen_two_third_last( $atts, $content = null ) {
   return '<div class="two-third-short last-column">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('two_third_last', 'zen_two_third_last');

function zen_one_half( $atts, $content = null ) {
   return '<div class="one-half-short">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'zen_one_half');

function zen_one_half_last( $atts, $content = null ) {
   return '<div class="one-half-short last-column">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('one_half_last', 'zen_one_half_last');

function zen_one_fourth( $atts, $content = null ) {
   return '<div class="one-fourth-short">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'zen_one_fourth');

function zen_one_fourth_last( $atts, $content = null ) {
   return '<div class="one-fourth-short last-column">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('one_fourth_last', 'zen_one_fourth_last');

function zen_three_fourth( $atts, $content = null ) {
   return '<div class="three-fourth-short">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'zen_three_fourth');

function zen_three_fourth_last( $atts, $content = null ) {
   return '<div class="three-fourth-short last-column">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('three_fourth_last', 'zen_three_fourth_last');

/*-----------------------------------------------------------------------------------*/
/*	Quote
/*-----------------------------------------------------------------------------------*/

function zen_quote( $atts, $content = null ) {
   return '<div class="quote-wrap"><blockquote>' . do_shortcode($content) . '</blockquote></div><div class="clear"></div>';
}
add_shortcode('quote', 'zen_quote');

/*-----------------------------------------------------------------------------------*/
/*	Button
/*-----------------------------------------------------------------------------------*/


function zen_button( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'target'     => '_self',
		'style'   => 'red',
		'size'	=> 'small'
    ), $atts));
	
   return '<a class="button '.$size.' '.$style.'" href="'.$url.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'zen_button');


/*-----------------------------------------------------------------------------------*/
/*	Alert
/*-----------------------------------------------------------------------------------*/


function zen_alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'style'   => 'white'
    ), $atts));
	
   return '<div class="alert '.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert', 'zen_alert');

/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcodes
/*-----------------------------------------------------------------------------------*/

function zen_toggle( $atts, $content = null ) {
	
    extract(shortcode_atts(array(
		'title'    	 => 'Title goes here',
		'state'		 => 'open'
    ), $atts));

	
	$out .= "<div data-zen-toggle='".$state."' class=\"toggle\"><h4>".$title."</h4><div class=\"toggle-content\">".do_shortcode($content)."</div></div>";
	
    return $out;
	
}
add_shortcode('toggle', 'zen_toggle');

/*------------------------------------------------------------------------------------------------*/
/*	Tabs Shortcodes
/*------------------------------------------------------------------------------------------------*/

if (!function_exists('zen_tabs')) {
	function zen_tabs( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
		    $output .= '<div id="tabs-'. rand(1, 100) .'" class="tabs"><div class="tab-content">';
			$output .= '<ul class="navigation clearfix">';
			
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div></div>';
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	add_shortcode( 'tabs', 'zen_tabs' );
}

if (!function_exists('zen_tab')) {
	function zen_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div id="tab-'. sanitize_title( $title ) .'" class="tab">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'tab', 'zen_tab' );
}

?>