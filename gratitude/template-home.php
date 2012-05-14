<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

    <div id="middle">

        <div class="container content-background">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			
            <?php
			// Getting the slider images for later use
			$image1 = get_option('zen_slider_1'); 
			$image2 = get_option('zen_slider_2'); 
			$image3 = get_option('zen_slider_3'); 
			$image4 = get_option('zen_slider_4'); 
			$image5 = get_option('zen_slider_5');
         /* $video1 = get_option('zen_slider_video_1'); 
            $video2 = get_option('zen_slider_video_2'); 
            $video3 = get_option('zen_slider_video_3');     Videos included in slider, in future release.
            $video4 = get_option('zen_slider_video_4'); 
            $video5 = get_option('zen_slider_video_5');*/
			
			$imageUrl1 = get_option('zen_slider_url_1'); 
			$imageUrl2 = get_option('zen_slider_url_2'); 
			$imageUrl3 = get_option('zen_slider_url_3'); 
			$imageUrl4 = get_option('zen_slider_url_4'); 
			$imageUrl5 = get_option('zen_slider_url_5'); 
			
			?>
            
            
            <?php $sliderEnabled = get_option('zen_enable_slider'); ?>
            <?php 
			//Checking if slider is enabled
			if($sliderEnabled == 'true') : ?>
                        
            <!--BEGIN #flex-container -->
            <div class="flex-container">
                
                <!--BEGIN .flexslider -->
                <div class="flexslider">
                   	
                    <ul class="slides">

						<?php if($image1 != '') : ?>
                        <li>
                            <?php if($imageUrl1 != '') : ?>
                            <a href="<?php echo $imageUrl1; ?>"><img src="<?php echo $image1; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-1" src="<?php echo $image1 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'zen_slider_cap_1' ) != '' ) : ?>
                            <p class="flex-caption"><?php echo get_option( 'zen_slider_cap_1' ); ?></p>
                            <?php endif; ?>
                        </li>

                        <?php endif; ?>

                        <?php if($image2 != '') : ?>
                        <li>
                            <?php if($imageUrl2 != '') : ?>
                            <a href="<?php echo $imageUrl2; ?>"><img src="<?php echo $image2; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-2" src="<?php echo $image2 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'zen_slider_cap_2' ) != '' ) : ?>
                            <p class="flex-caption"><?php echo get_option( 'zen_slider_cap_2' ); ?></p>
                            <?php endif; ?>
                        </li>

                        <?php endif; ?>

                        <?php if($image3 != '') : ?>
                        <li>
                            <?php if($imageUrl3 != '') : ?>
                            <a href="<?php echo $imageUrl3; ?>"><img src="<?php echo $image3; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-3" src="<?php echo $image3 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'zen_slider_cap_3' ) != '' ) : ?>
                            <p class="flex-caption"><?php echo get_option( 'zen_slider_cap_3' ); ?></p>
                            <?php endif; ?>                       
                        </li>

                        <?php endif; ?>

                        <?php if($image4 != '') : ?>
                        <li>
                            <?php if($imageUrl4 != '') : ?>
                            <a href="<?php echo $imageUrl4; ?>"><img src="<?php echo $image4; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-4" src="<?php echo $image4 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'zen_slider_cap_4' ) != '' ) : ?>
                            <p class="flex-caption"><?php echo get_option( 'zen_slider_cap_4' ); ?></p>
                            <?php endif; ?>                            
                        </li>

                        <?php endif; ?>

                        <?php if($image5 != '') : ?>
                        <li>
                            <?php if($imageUrl5 != '') : ?>
                            <a href="<?php echo $imageUrl5; ?>"><img src="<?php echo $image5; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-5" src="<?php echo $image5 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'zen_slider_cap_5' ) != '' ) : ?>
                            <p class="flex-caption"><?php echo get_option( 'zen_slider_cap_5' ); ?></p>
                            <?php endif; ?>                            
                        </li>

                        <?php endif; ?>
                	</ul>
                
                <!--END .flexslider -->
                </div>
                
            <!--END #flex-container -->
            </div>
            
            <?php endif; ?>
            
            
            <!-- Getting the #home-message -->
            <?php if(get_option('zen_enable_welcome_message') == 'true') : ?>
            
                <!--BEGIN #home-message -->
                <div class="sixteen columns no-bottom">
                
                    <div id="call-to-action">
                        <div class="feature"><h1><?php echo stripslashes(get_option('zen_home_message')); ?></h1></div>
                    </div>
                
                </div>
                <!--END #home-message -->
            
            <?php endif; ?>
            
            <!--BEGIN #main-content -->
            <section class="main-content top-margin eleven columns"> 
                             
                  <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Main' ) ) ?>
                  <div style="clear:both">
                  <?php the_content(); ?>  
                  </div>
            </section>
            
            <aside class="sidebar top-margin five columns">
            <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Sidebar' ) ) ?>
            </aside>
            
        <?php endwhile; ?>

        <?php endif; ?>            

        <!--END .container-->        
		</div>
    <!--END #middle-->
    </div>

</div>

<?php get_footer(); ?>