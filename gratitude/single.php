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
	                
	                    
	                    <?php /* if the post has a WP 2.9+ Thumbnail */
						if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
						<div class="module-image">
	                    
							<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-archive'); /* post thumbnail settings configured in functions.php */ ?></a>
	                        
						</div>
						<?php } ?>	                    
	    
	                        <!--BEGIN .entry-content -->
	                        <div class="entry-content eleven columns alpha omega top-margin bot-margin" style="margin-left:0px;" id="main-content">
	                        
	                            <?php the_content(); ?>
	                            
	                        <!--END .entry-content -->
	                        </div>
	                          
					<!--END post-->  
					</div>

					<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
					<div id="author-info">
					
						<div id="author-avatar">
					
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) ); ?>
					
						</div><!-- #author-avatar -->
					
						<div id="author-description">
					
							<h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
					
							<div id="author-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyeleven' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
					
						</div><!-- #author-description -->
					
					</div><!-- #entry-author-info -->
					<?php endif; ?>

					<?php endwhile; ?>
	                
	                <?php comments_template('', true); ?>
	                

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

<?php get_sidebar(); ?>

<?php get_footer(); ?>