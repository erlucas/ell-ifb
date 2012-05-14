<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- Zen Factory, powered by WordPress -->

<!-- BEGIN head -->
<head>

	<!-- Basic Page Needs -->
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
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
    	<header class="sixteen columns top-margin">

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

    <div id="middle">

        <div class="container content-background">

            <!--BEGIN .page-title -->
            <div class="page-title">
                <h1 class="page-title-heading ten columns"><?php the_title(); ?></h1>

                   
            <!--END .page-title -->
            </div>

            <!--BEGIN #main-content -->
            <section id="BuddyPress" class="main-content top-margin eleven columns">
                        
                    
                    <!--BEGIN .post -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       
        
                            <!--BEGIN .entry-content -->
                            <div class="entry-content">