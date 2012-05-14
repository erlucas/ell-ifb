<?php

/*--------------------------------------------------------------------------------------------------

	File: functions.php

	Description: Here are a set of custom functions used for this theme framework.
	Please be extremely careful when you are editing this file, because when things
	tend to go bad, they go bad big time. Well, you have been warned ! :-)

--------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------
	Registering WP3.0+ Custom Menu 
--------------------------------------------------------------------------------------------------*/

function register_menu() {
	register_nav_menu('main-menu', __('Main Menu'));
}
add_action('init', 'register_menu');

/*--------------------------------------------------------------------------------------------------
	Loading the Theme Translation Feature
--------------------------------------------------------------------------------------------------*/

load_theme_textdomain('framework');

/*--------------------------------------------------------------------------------------------------
	Registering the Sidebars
--------------------------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
		'name' => 'Main Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage Main',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer One',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer Two',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer Three',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

}

/*--------------------------------------------------------------------------------------------------
	Configuring WP2.9+ Thumbnails
--------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails'); //Adding theme support for post thumbnails
	add_custom_background(); //Adding Theme support for custom background
	add_theme_support('automatic-feed-links'); //Adding support for automatic feed links
	set_post_thumbnail_size( 75, 75, true );
	add_image_size( 'large', 610, 390, true );
	add_image_size( 'medium', 360, 225, true );
	add_image_size( 'small', 150, 100, true );
	add_image_size( 'thumbnail-archive', 610, 390, true );
	add_image_size( 'thumbnail-archive-small', 360, 260, true );
}

/*--------------------------------------------------------------------------------------------------
	Custom Wordpress Customisation
		a. Custom Gravatar
		b. Custom Excerpt Length
		c. Custom Excerpt String
		d. Separated Pings Listing
		e. Custom Useful is_multiple function
		f. Custom Login Logo
--------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------
		a. Custom Gravatar Image
--------------------------------------------------------------------------------------------------*/


if( !function_exists( 'zen_custom_gravatar' ) ) {
    function zen_custom_gravatar( $avatar_defaults ) {
        $zen_avatar = get_template_directory_uri() . '/images/gravatar.png';
        $avatar_defaults[$zen_avatar] = 'Custom Gravatar (/images/gravatar.png)';
        return $avatar_defaults;
    }
    
    add_filter( 'avatar_defaults', 'zen_custom_gravatar' );
}

/*--------------------------------------------------------------------------------------------------
		b. Custom Excerpt Length
--------------------------------------------------------------------------------------------------*/

function zen_custom_excerpt_length( $length ) {
	global $post;
	if ($post->post_type == 'post')
	return 42;
	else if ($post->post_type == 'portfolio')
	return 18;
}
add_filter('excerpt_length', 'zen_custom_excerpt_length');


/*--------------------------------------------------------------------------------------------------
		c. Custom Excerpt String Text
--------------------------------------------------------------------------------------------------*/

function zen_excerpt($excerpt) {
	return str_replace('[...]', '...', $excerpt); 
}
add_filter('wp_trim_excerpt', 'zen_excerpt');


/*--------------------------------------------------------------------------------------------------
		d. Separated Pings Listing
--------------------------------------------------------------------------------------------------*/

function zen_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

<?php }

/*--------------------------------------------------------------------------------------------------
		e. Custom is_multiple - Helpful function
--------------------------------------------------------------------------------------------------*/

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
}

/*--------------------------------------------------------------------------------------------------
		f. Custom Login Logo Support
--------------------------------------------------------------------------------------------------*/

function zen_wp_login_title() {
	echo get_option('blogname');
}
add_filter('login_headertitle', 'zen_wp_login_title');

function zen_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/custom-login-logo.png) !important; }
    </style>';
}

add_action('login_head', 'zen_custom_login_logo');

function zen_wp_login_url() {
	echo home_url();
}
add_filter('login_headerurl', 'zen_wp_login_url');

/*--------------------------------------------------------------------------------------------------
	Register and load common JS
--------------------------------------------------------------------------------------------------*/

function zen_register_js() {
	if (!is_admin()) {
		
		//Registering Javascripts
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9');
		wp_register_script('jquery-ui-custom',  get_template_directory_uri() . '/js/jquery-ui-1.8.5.custom.min.js', 'jquery', '1.8.5');
		wp_register_script('jquery.easing',		get_template_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery', '1.3');
		wp_register_script('superfish',     	get_template_directory_uri() . '/js/superfish.js', 'jquery');
		wp_register_script('isotope',			get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery');
		wp_register_script('flexslider',		get_template_directory_uri() . '/js/jquery.flexslider.min.js', 'jquery');
		wp_register_script('zen_custom',     	get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', TRUE);
		wp_register_script('buddypress',     	get_template_directory_uri() . '/js/jquery.buddypress.js', 'jquery');


		//Registering Stylesheets
		wp_register_style('skeleton_css',   	get_template_directory_uri() . '/css/skeleton.css');
		wp_register_style('light_css',      	get_template_directory_uri() . '/css/light.css');
		wp_register_style('flexslider_css', 	get_template_directory_uri() . '/css/flexslider.css');
		wp_register_style('buddypress_css',		get_template_directory_uri() . '/css/bp.css');
		wp_register_style('bbpress_css',		get_template_directory_uri() . '/css/bbpress.css');

				
		//Enqueueing javascript		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-custom');
		wp_enqueue_script('jquery.easing');
		wp_enqueue_script('superfish');
		wp_enqueue_script('buddypress');
		wp_enqueue_script('zen_custom');

		//Enqueue stylesheets
		wp_enqueue_style('style_css');
		wp_enqueue_style('skeleton_css');
		wp_enqueue_style('light_css');
		wp_enqueue_style('buddypress_css');
	}
}
add_action('init', 'zen_register_js');

//Deregistering and registering my own styles for bbPress.
function bbpress_register_asset()
{
	wp_enqueue_style( 'bbpress_css' );
	wp_dequeue_style( 'bbpress-style' );	
}
if(!is_admin()){ add_action('bbp_enqueue_scripts', 'bbpress_register_asset'); }

function zen_enqueue_scripts() {
	// load homepage scripts
	if (is_page_template('template-home.php'))		
		wp_enqueue_script('flexslider'); 
		wp_enqueue_style('flexslider_css'); 

    // load Isotope on the portolio template page
    if( is_page_template( 'template-portfolio.php' ) )
    	wp_enqueue_script('isotope');

	if(is_singular()) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 

	if ( is_page_template( 'template-contact.php' ) ) 
		wp_enqueue_script('validation');
}
add_action('wp_print_scripts', 'zen_enqueue_scripts');

if( !function_exists( 'zen_contactform_validate' ) ) {
    function zen_contactform_validate() {

    	if (is_page_template('template-contact.php')) { ?>
    	
    		<script type="text/javascript">
    			jQuery(document).ready(function(){
    				jQuery("#contact-form").validate();
    			});
    		</script>
    	
    	<?php }
    }
    
    add_action('wp_head', 'zen_contactform_validate');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zen_browser_body_class' ) ) {
    function zen_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';
	
		if($is_iphone) $classes[] = 'iphone';
		return $classes;
    }
    
    add_filter('body_class','zen_browser_body_class');
}


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function zen_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
     	<!--BEGIN .comment -->
    	<div class="comment-content commentary-no-<?php comment_ID(); ?> <?php if($isByAuthor == true) : ?>by-author<?php endif; ?>">
      
    	<?php echo get_avatar($comment,$size='35'); ?>
    		
    		<!--BEGIN .comment-author -->
    		<div class="comment-author commentary">
      
    			<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
         
         	<!--END .comment-author -->
    		</div>

    		<!--BEGIN .comment-meta -->
      		<div class="comment-meta">
      
      			<a class="comment-time" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('[Edit]'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

      		<!--END .comment-meta -->
    		</div>
      
    	<?php if ($comment->comment_approved == '0') : ?>
      
        	<em class="moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
        	<br />
         
      	<?php endif; ?>
	  		
	  		<!--BEGIN .comment-entry -->
      		<div class="comment-entry commentary">
      
    			<?php comment_text() ?>

      		<!--END .comment-entry -->
			</div>
      
		<!--END .comment -->      
    	</div>

<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Setting the new options to true
/*-----------------------------------------------------------------------------------*/

if(!get_option('zen_lightbox'))
	update_option('zen_lightbox', 'true');
	
if(!get_option('zen_enable_welcome_message'))
	update_option('zen_enable_welcome_message', 'true');


/*-----------------------------------------------------------------------------------*/
/*	Load Widgets, Shortcodes & BuddyPress AJAX
/*-----------------------------------------------------------------------------------*/

// Add the Latest Tweets Custom Widget
include("functions/widget-tweets.php");

// Add the Theme Shortcodes
include("functions/theme-shortcodes.php");

// Add the Flickr Photos Custom Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

// Add the Custom Recent Blog Posts
include("functions/widget-blogposts.php");

// Add the Custom BuddyPress Activity
include("functions/widget-buddypressactivity.php");

// Add the Custom Recent Portfolio
include("functions/widget-recentportfolios.php");

// Add the Custom Login
include("functions/widget-login.php");

// Add the Custom Register
include("functions/widget-register.php");

// Add the Theme Post types
include("functions/theme-posttypes.php");

// Add the Portfolio Meta
include("functions/theme-portfoliometa.php");

// Add the Theme BuddyPress
include("functions/theme-buddypress.php");

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets & BuddyPress related actions
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
add_action('bp_member_header_actions', 'bp_add_friend_button' );
add_action('bp_member_header_actions', 'bp_send_public_message_button' );
add_action('bp_member_header_actions', 'bp_send_private_message_button' );

/*-----------------------------------------------------------------------------------*/
/*	Load Theme Options
/*-----------------------------------------------------------------------------------*/

define('ZEN_FILEPATH', TEMPLATEPATH);
define('ZEN_DIRECTORY', get_template_directory_uri());

require_once (ZEN_FILEPATH . '/admin/admin-functions.php');
require_once (ZEN_FILEPATH . '/admin/admin-interface.php');
require_once (ZEN_FILEPATH . '/functions/theme-options.php');
require_once (ZEN_FILEPATH . '/functions/theme-functions.php');
require_once (ZEN_FILEPATH . '/tinymce/tinymce.loader.php');
?>