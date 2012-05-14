<?php

/* ------------------------------------------------- */
/* 	Populating the Theme Options Panel with options
/* ------------------------------------------------- */

add_action('init','zen_options');

if (!function_exists('zen_options')) {
	
function zen_options() {
	
// define the template path for further use	
$GLOBALS['template_path'] = ZEN_DIRECTORY;	
	
// variables
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$shortname = "zen";

// populating option in array for use in theme
	global $zen_options;
		$zen_options = get_option('zen_options');

// access the WordPress Pages via an Array
	$zen_pages = array();
	
	$zen_pages_obj = get_pages('sort_column=post_parent,menu_order');    
	
	foreach ($zen_pages_obj as $zen_page) {
    	$zen_pages[$zen_page->ID] = $zen_page->post_name; }
	
	$zen_pages_tmp = array_unshift($zen_pages, "Select a page:");  
	     
// access the WordPress Categories via an Array
	$zen_categories = array();  
	
	$zen_categories_obj = get_categories('hide_empty=0');
	
	foreach ($zen_categories_obj as $zen_cat) {
    	$zen_categories[$zen_cat->cat_ID] = $zen_cat->cat_name;}
	
	$categories_tmp = array_unshift($zen_categories, "Select a category:");
// testing 
	$options_select = array("one","two","three","four","five"); 
	$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

// image linzen to options
	$options_image_link_to = array("image" => "Image","post" => "Post"); 

// image alignment radio box
	$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 


//
	$uploads_arr = wp_upload_dir();
	$all_uploads = get_option('zen_uploads');
	$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");	
	$all_uploads_path = $uploads_arr['path'];
	$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
	$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");



$options = array();


// General Settings

$options[] = array( "name" => __('General Settings','framework'),
                    "type" => "heading");
					
$options[] = array( "name" => __('Custom Favicon','framework'),
					"desc" => __('Upload a 16px x 16px .png/.gif image that will represent your site\'s favicon.','framework'),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");
										
$options[] = array( "name" => __('Email Address for Contact Page','framework'),
					"desc" => __('Enter the mail address where you\'d like to receive emails from the contact form. Leave blank to use admin email.','framework'),
					"id" => $shortname."_email",
					"std" => "example@zenthemes.com",
					"type" => "text");	
					
$options[] = array( "name" => __('Enable a Plain Text Logo','framework'),
					"desc" => __('Check this to enable a plain text logo instead of an image.','framework'),
					"id" => $shortname."_plain_logo",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => __('Custom Logo','framework'),
					"desc" => __('Upload a logo to your theme, or specify the image address of your online logo. (http://example.com/logo.png)','framework'),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");				
					
$options[] = array( "name" => __('Footer Copy','framework'),
					"desc" => __('Enter the text you would like to display in the footer of your site.','framework'),
					"id" => $shortname."_footer_text",
					"std" => "© 2012 <a href=\"http://themeforest.net/user/zenthemes/?ref=zenthemes\">Gratitude.</a> Crafted with love.<br />Powered by <a href=\"http://www.wordpress.org\">Wordpress</a>.",
					"type" => "textarea");

$options[] = array( "name" => __('Tracking Code','framework'),
					"desc" => __('Paste in your Analytics (Google or other) tracking code in here. It will be inserted just before the closing body tag of your theme.','framework'),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");                                                    
					
$options[] = array( "name" => __('FeedBurner URL','framework'),
					"desc" => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere','framework'),
					"id" => $shortname."_feedburner",
					"std" => "",
					"type" => "text");


// Styling Options

$options[] = array( "name" => __('Styling Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => __('Custom Accent','framework'),
					"desc" => __('Choose a custom accent colour for your website.','framework'),
					"id" => $shortname."_color_hover",
					"std" => "#2da1cb",
					"type" => "color");							
					
$options[] = array( "name" => __('Custom CSS','framework'),
                    "desc" => __('Quickly add some CSS to your theme by adding it to this block.','framework'),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");
					
					

					

// Homepage Settings


$options[] = array( "name" => __('Homepage Settings','framework'),
                    "type" => "heading");                                     
                    					
$options[] = array( "name" => __('Display Welcome Message','framework'),
					"desc" => __('Check this to enable the welcome message','framework'),
					"id" => $shortname."_enable_welcome_message",
					"std" => "true",
					"type" => "checkbox");
										
$options[] = array( "name" => __('Home Welcome Message','framework'),
					"desc" => __('The large welcome message that appears below the slider.','framework'),
					"id" => $shortname."_home_message",
					"std" => "Here you can display your awesome welcome message.",
					"type" => "textarea");														


// Slider Options	

$options[] = array( "name" => __('Slider Options','framework'),
					"type" => "heading");

$options[] = array( "name" => __('Enable Slider','framework'),
					"desc" => __('Check this to enable the slider on the homepage.','framework'),
					"id" => $shortname."_enable_slider",
					"std" => "false",
					"type" => "checkbox");
										
$options[] = array( "name" => __('Slider Image 1','framework'),
					"desc" => __('Image must be 960px x 300px','framework'),
					"id" => $shortname."_slider_1",
					"std" => "",
					"type" => "upload_min");
/*
$options[] = array( "name" => __('Slider Video 1','framework'),
					"desc" => __('Please input the video embed code (ONLY YouTube or Vimeo are accepted.)','framework'),
					"id" => $shortname."_slider_video_1",
					"std" => "",
					"type" => "textarea");					
*/					
$options[] = array( "name" => __('Slider Image 1 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_1",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 1 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_1",
					"std" => "",
					"type" => "text");					
					
$options[] = array( "name" => __('Slider Image 2','framework'),
					"desc" => __('Image must be 960px x 300px','framework'),
					"id" => $shortname."_slider_2",
					"std" => "",
					"type" => "upload_min");
/*
$options[] = array( "name" => __('Slider Video 2','framework'),
					"desc" => __('Please input the video embed code (ONLY YouTube or Vimeo are accepted.)','framework'),
					"id" => $shortname."_slider_video_2",
					"std" => "",
					"type" => "textarea");					
*/										
$options[] = array( "name" => __('Slider Image 2 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_2",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 2 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_2",
					"std" => "",
					"type" => "text");										
					
$options[] = array( "name" => __('Slider Image 3','framework'),
					"desc" => __('Image must be 960px x 300px','framework'),
					"id" => $shortname."_slider_3",
					"std" => "",
					"type" => "upload_min");
/*
$options[] = array( "name" => __('Slider Video 3','framework'),
					"desc" => __('Please input the video embed code (ONLY YouTube or Vimeo are accepted.)','framework'),
					"id" => $shortname."_slider_video_3",
					"std" => "",
					"type" => "textarea");						
*/					
$options[] = array( "name" => __('Slider Image 3 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_3",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 3 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_3",
					"std" => "",
					"type" => "text");							
					
$options[] = array( "name" => __('Slider Image 4','framework'),
					"desc" => __('Image must be 960px x 300px','framework'),
					"id" => $shortname."_slider_4",
					"std" => "",
					"type" => "upload_min");
/*
$options[] = array( "name" => __('Slider Video 4','framework'),
					"desc" => __('Please input the video embed code (ONLY YouTube or Vimeo are accepted.)','framework'),
					"id" => $shortname."_slider_video_4",
					"std" => "",
					"type" => "textarea");						
*/										
$options[] = array( "name" => __('Slider Image 4 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_4",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 4 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_4",
					"std" => "",
					"type" => "text");							
					
$options[] = array( "name" => __('Slider Image 5','framework'),
					"desc" => __('Image must be 960px x 300px','framework'),
					"id" => $shortname."_slider_5",
					"std" => "",
					"type" => "upload_min");
/*
$options[] = array( "name" => __('Slider Video 5','framework'),
					"desc" => __('Please input the video embed code (ONLY YouTube or Vimeo are accepted.)','framework'),
					"id" => $shortname."_slider_video_5",
					"std" => "",
					"type" => "textarea");						
*/					
$options[] = array( "name" => __('Slider Image 5 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_5",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 5 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_5",
					"std" => "",
					"type" => "text");							
					
// Social Media

$options[] = array( "name" => __('Social Media','framework'),
                    "type" => "heading");

$options[] = array( "name" => __('Enable RSS icon','framework'),
					"desc" => __('Check this to enable the RSS icon to be displayed.','framework'),
					"id" => $shortname."_enable_rss_icon",
					"std" => "true",
					"type" => "checkbox");					

$options[] = array( "name" => __('Enable FaceBook icon','framework'),
					"desc" => __('Check this to enable the FaceBook icon to be displayed.','framework'),
					"id" => $shortname."_enable_facebook_icon",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => __('FaceBook link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_facebook_link",
					"std" => "http://www.facebook.com/thezenthemes",
					"type" => "text");					

$options[] = array( "name" => __('Enable Pinterest icon','framework'),
					"desc" => __('Check this to enable the Pinterest icon to be displayed.','framework'),
					"id" => $shortname."_enable_Pinterest_icon",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => __('Pinterest link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_Pinterest_link",
					"std" => "#",
					"type" => "text");

$options[] = array( "name" => __('Enable Twitter icon','framework'),
					"desc" => __('Check this to enable the Twitter icon to be displayed.','framework'),
					"id" => $shortname."_enable_twitter_icon",
					"std" => "true",
					"type" => "checkbox");			

$options[] = array( "name" => __('Twitter link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_twitter_link",
					"std" => "https://twitter.com/zenwebfactory",
					"type" => "text");					
																	
$options[] = array( "name" => __('Enable Bloglovin icon','framework'),
					"desc" => __('Check this to enable the Bloglovin icon to be displayed.','framework'),
					"id" => $shortname."_enable_Bloglovin_icon",
					"std" => "true",
					"type" => "checkbox");		
					
$options[] = array( "name" => __('Bloglovin link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_Bloglovin_link",
					"std" => "#",
					"type" => "text");						

$options[] = array( "name" => __('Enable Google+ icon','framework'),
					"desc" => __('Check this to enable the Google+ icon to be displayed.','framework'),
					"id" => $shortname."_enable_googleplus_icon",
					"std" => "true",
					"type" => "checkbox");			
					
$options[] = array( "name" => __('Google+ link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_googleplus_link",
					"std" => "#",
					"type" => "text");							


// Menu Options

$options[] = array( "name" => __('Menu Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => "",
					"message" => __('The navigation settings below will be overwritten if you use WordPress 3.0 custom menus.','framework'),
					"type" => "note");
                    
$options[] = array( "name" => __('Exclude From Primary Navigation','framework'),
					"desc" => __('Enter a comma-separated list of any Page IDs you wish to exclude from the navigation (e.g. 1,2,3...)','framework'),
					"id" => $shortname."_primary_nav_exclude",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Menu Order','framework'),
					"desc" => __('Select the view order you wish to set for the main navigation.','framework'),
					"id" => $shortname."_primary_nav_order",
					"std" => "ID",
					"type" => "select",
					"options" => array('post_title', 'menu_order', 'ID'));
					



update_option('zen_themename',$themename);   

update_option('zen_shortname',$shortname);

update_option('zen_template',$options); 					  

}
}
?>
