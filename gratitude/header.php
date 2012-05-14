<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- Zen Factory, powered by WordPress -->

<!-- BEGIN head -->
<head>

	<!-- Basic Page Needs -->
    <title><?php
    if (is_home()) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif(is_page_template('template-home.php')) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_single() || is_page()) { single_post_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_search()) { _e('Search Results', 'framework'); echo " ".wp_specialchars($s); }
    elseif (is_category() || is_tag()) { single_cat_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    else { echo trim(wp_title(' ',false)); }
    ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
    
	<!-- CSS -->
   	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/flexslider.css" type="text/css" media="screen" />
        
    <!-- RSS & Pingbaczen -->
   	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php 
    $feed = get_option(' zen_feedburner ');
    if ($feed != '')
    {
        echo get_option(' zen_feedburner ');
    }
    else
    {
        bloginfo('rss2_url');
    } ?>" />
   	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
    
    <!-- Theme Hook -->
    <?php wp_head(); ?> 
    
    <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
  
</head>
<!-- END head section -->

<body <?php body_class(); ?>>
<!-- START body -->

<div id="top">

    <!-- START .container -->
    <div class="container">

        <!-- START header .sixteen columns -->
    	<header class="top-margin">

    		<!-- START hgroup -->
    		<hgroup>

                <!-- START #logo -->
    			<h1 class="logo">
                <?php 
    					/*
                        If the "plain text logo" is set in theme options -> using text
                        if a logo url has been set in theme options -> using image
    					if none of the above then -> default logo.png */
    					
                        if (get_option('zen_plain_logo') == 'true') { ?>
                        <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                        <?php } elseif (get_option('zen_logo')) { ?>
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('zen_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                        <?php } else { ?>
                        <a href="<?php echo home_url(); ?>"><div class="logo-image"></div></a>
                        <?php } ?>
                
                <!-- END #logo -->
                </h1>
                <div id="google-ad"><a href="http://pinterest.com/_ifb/"><img src="wp-content/themes/gratitude/images/pinterest.png" /></a></div>
              <div class="header-right">
                  <div class="uber-nav">
	                <a href="/help">Help</a>|<a href="/join">Join!</a><a id="login-button" href="/wp-admin">Login</a>
	              </div>
                  <div class="social-container four top-margin">

                        <!-- .social -->
                        <div class="social clearfix">
                        
                        <?php //Checking if the icon is needed from the options panel ?>
                        <?php if(get_option('zen_enable_facebook_icon') == 'true') : ?>
                            <a href="<?php $feed = get_option(' zen_feedburner ');
                                            // if feedburner URL is provided in the Theme Options Panel it uses it
                                            if ($feed != '')
                                            {
                                                echo get_option(' zen_feedburner ');
                                            }
                                            else
                                            {
                                                // else it uses the standard RSS link
                                                bloginfo('rss2_url');
                                            } ?>
                                            ">
                                <span class="social-icon rss"></span>
                            </a>
                        <?php endif; ?>

                        <?php //Checking if the icon is needed from the options panel ?>
                        <?php if(get_option('zen_enable_facebook_icon') == 'true') : ?>
                            <?php //Using the icon link from the options panel ?>
                            <a href="<?php echo get_option( 'zen_facebook_link' ); ?>"><span class="social-icon facebook"></span></a>
                        <?php endif; ?>        

                        <?php //Checking if the icon is needed from the options panel ?>
                        <?php if(get_option('zen_enable_pinterest_icon') == 'true') : ?>        
                            <?php //Using the icon link from the options panel ?>
                            <a href="<?php echo get_option( 'zen_pinterest_link' ); ?>"><span class="social-icon pinterest"></span></a>
                        <?php endif; ?>
                        
                        <?php //Checking if the icon is needed from the options panel ?>                
                        <?php if(get_option('zen_enable_twitter_icon') == 'true') : ?>        
                            <?php //Using the icon link from the options panel ?>
                            <a href="<?php echo get_option( 'zen_twitter_link' ); ?>"><span class="social-icon twitter"></span></a>
                        <?php endif; ?>

                        <?php //Checking if the icon is needed from the options panel ?>
                        <?php if(get_option('zen_enable_bloglovin_icon') == 'true') : ?>        
                            <?php //Using the icon link from the options panel ?>
                            <a href="<?php echo get_option( 'zen_bloglovin_link' ); ?>"><span class="social-icon bloglovin"></span></a>
                        <?php endif; ?>

                        <?php //Checking if the icon is needed from the options panel ?>                
                        <?php if(get_option('zen_enable_googleplus_icon') == 'true') : ?>        
                            <?php //Using the icon link from the options panel ?>
                            <a href="<?php echo get_option( 'zen_googleplus_link' ); ?>"><span class="social-icon gplus"></span></a>
                        <?php endif; ?>
                                
                        </div>
                        <!-- END .social -->
                    <!--END social-container --> 
                 </div>   <!--END header-right --> 
                    </div>                           
        	</hgroup>
    		<!-- END hgroup -->
            
            <!-- START nav -->
    		<nav class="twelve columns alignleft float-left alpha">
            
                <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'main-menu', 
                        'container' => '', 
                        'before' => '<span>/</span>',
                    ) ); 
                ?>
                
    		</nav>
            <!-- END nav -->

    	</header>
    	<!-- END header -->
        
    </div>
    <!-- END container -->

</div>



