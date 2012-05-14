<?php get_header(); ?>

 	<div id="middle">

		<div class="container content-background">

			<!--BEGIN .page-title -->
			<div class="page-title">
			    <?php $blog = get_post(get_option('page_for_posts')); ?>
                <h1 class="page-title-heading ten columns"><?php echo $blog->post_title; ?></h1>

				    
			<!--END .page-title -->
			</div>

			<!--BEGIN main content-->
			<section class="main-content eleven columns top-margin">
            	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<ul>
				
				<!--BEGIN post -->
				<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				
				    <?php /* if the post has a WP 2.9+ Thumbnail */

					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
						<!-- BEGIN Image Thumbnail -->
						<div class="module-image five columns alpha scale-with-grid no-bottom">
	                    
							<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-archive-small'); /* post thumbnail settings configured in functions.php */ ?></a>
	                    <!-- END Image Thumbnail -->    
						</div>

					<?php } ?>

					
					<!--BEGIN five columns -->
					<div class="six columns alpha no-bottom">	
                			
	                	<!-- BEGIN .entry-title -->		
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> 
								<?php the_title(); ?>
							</a>
						<!-- END .entry-title -->
						</h1>

                        <!--BEGIN .entry-meta -->
                        <div class="entry-meta">
                        
								<p class="no-bottom"><?php _e('By', 'framework') ?> <?php the_author_posts_link(); ?>, <?php _e('On', 'framework') ?> <?php the_time( get_option('date_format') ); ?>
	                            <?php _e('With', 'framework') ?> <?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?> <?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></p>
                            
                        <!--END .entry-meta -->
                        </div>

                        
                        <!--BEGIN .entry-content -->
                        <div class="entry-content no-bottom">
                        
                            <?php the_excerpt(); ?>
                            <?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
                            
                        <!--END .entry-content -->
                        </div>
                    <!--END .five columns -->
                    </div>
	               
	                <div class="eleven columns alpha no-bottom">
	                	<hr>
	            	</div>
				
				<!--END post-->  
				</li>

				<?php endwhile; ?>

			</ul>

			<!--BEGIN .navigation-->
			<div class="navigation">
            
				<div class="nav-old"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
				<div class="nav-new"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
                
			<!--END .navigation-->
			</div>

			<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class(); ?>>
				
					<h1 class="entry-title">
						<?php _e('Error 404 - Not Found', 'framework') ?>
					</h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
					
						<p><?php _e("Sorry, but your search lead to no results.", "framework") ?></p>
					
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; ?>

			<!-- END main content -->
			</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>