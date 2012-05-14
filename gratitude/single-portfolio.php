<?php get_header(); ?>
            
        <div id="middle">

            <div class="container content-background">

            <!--BEGIN .page-title -->
            <div class="page-title">
                <h1 class="page-title-heading ten columns"><?php the_title(); ?></h1>

                  
            <!--END .page-title -->
            </div>

                <!--BEGIN main content-->
                <section class="main-content top-margin eleven columns">
                        
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>                           

                    <!--BEGIN post -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">   
                    
                        
                        <?php 
                            $embeded_code = get_post_meta(get_the_ID(), 'zen_portfolio_embed_code', true);
                            ?>
                            
                        <?php if($embeded_code != '') : ?>
                            
                        <!--BEGIN .video-slider -->
                        <div class="zen_video">
                                
                            <!--BEGIN .video-post -->
                            <div class="video-post">
                                
                                <?php echo stripslashes(htmlspecialchars_decode($embeded_code)); ?>
                                
                            <!--END .post-video -->
                            </div>
                            
                        <!--END .video-slider -->
                        </div>
                            
                        <?php elseif ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>

                        <div class="module-image">
                        
                            <a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-archive'); /* post thumbnail settings configured in functions.php */ ?></a>
                            
                        </div>
                        <?php endif; ?>

                            <!--BEGIN .entry-content -->
                            <div class="entry-content eleven columns alpha omega top-margin bot-margin" style="margin-left:0px;" id="main-content">
                            
                                <?php the_content(); ?>
                                
                            <!--END .entry-content -->
                            </div>
                            
                    <!--END post-->  
                    </div>

                <?php endwhile; ?>
                <?php else : ?>

                    <!--BEGIN #post-0-->
                    <div id="post-0" <?php post_class(); ?>>
                    
                        <h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
                    
                        <!--BEGIN .entry-content-->
                        <div class="entry-content">
                            <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
                        <!--END .entry-content-->
                        </div>
                    
                    <!--END #post-0-->
                    </div>

                <?php endif; ?>
                
                
                <!--END main content-->
                </section>

        <!--BEGIN .sidebar four columns-->
        <aside class="sidebar top-margin five columns">
        
            <?php if ((get_post_meta($post->ID, 'zen_portfolio_client', true) != '') || (get_post_meta($post->ID, 'zen_portfolio_date', true) != '') || (get_post_meta($post->ID, 'zen_portfolio_url', true) != '')) : ?>
            <div class="client-column-details">
                <?php if (get_post_meta($post->ID, 'zen_portfolio_client', true) != '') : ?><p class="no-bottom client-details"><strong>Client : </strong> <?php echo get_post_meta($post->ID, 'zen_portfolio_client', true); ?></p><?php endif; ?>
                <?php if (get_post_meta($post->ID, 'zen_portfolio_date', true) != '') : ?><p class="no-bottom client-details"><strong>On : </strong> <?php echo get_post_meta($post->ID, 'zen_portfolio_date', true); ?></p><?php endif; ?>
                <?php if (get_post_meta($post->ID, 'zen_portfolio_url', true) != '') : ?><p class="no-bottom client-details"><strong>Website : </strong> <a href="<?php echo get_post_meta($post->ID, 'zen_portfolio_url', true); ?>"><?php echo get_post_meta($post->ID, 'zen_portfolio_url', true); ?></a></p><?php endif; ?>
            </div>

            <?php endif; ?>
        <!--END .sidebar .four columns-->
        </aside>      
            
<?php get_footer(); ?>