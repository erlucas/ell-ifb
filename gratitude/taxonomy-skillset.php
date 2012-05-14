<?php get_header(); ?>

	
	<div id="middle">

		<div class="container content-background">

			<!--BEGIN .page-title -->
			<div class="page-title">
                <h1 class="page-title-heading ten columns"><?php the_title(); ?></h1>

				  
			<!--END .page-title -->
			</div>

			<!--BEGIN #main-content -->
			<section class="top-margin full-width">
 				<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>            	
                
                <?php 
            		query_posts( array(
	                'post_type' => 'portfolio',
	                'orderby' => 'menu_order',
	                'order' => 'ASC',
	                'posts_per_page' => -1,
	                'skillset' => $term->slug)); ?>
		    		
		    		<ul id="sort">
				        
				        <?php wp_list_categories( array('title_li' => '', 'taxonomy' => 'skillset', 'walker' => new Portfolio_Walker() ) ); ?>
					</ul>
                
	
				<?php while ( have_posts() ) : the_post(); ?>


                <!--BEGIN .recent-portfolio -->
                <div class="recent-portfolio">
				
                	<ul id="portfolio" class="portfolio-content section image-grid isotope">

                        	
                                <li <?php post_class("$term_list isotope-item portfolio columns omega"); ?> id="post-<?php the_ID(); ?>">
                                    
								    <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
									<div class="portfolio-entry">
										<div class="module-image portfolio-thumb">
										    <a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" rel="bookmark"><?php the_post_thumbnail('thumbnail-archive-small'); ?></a>
										</div>
											    
							                        <a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" rel="bookmark"><div class="portfolio-title"><?php the_title(); ?></div></a>
							                        <div class="portfolio-excerpt"><?php the_excerpt(); ?></div>
							        </div>

									<?php } ?>
                                    
                                
                                </li>
                      
                    </ul>
                        
                <!--END .recent-wrap -->
                </div>

                <?php endwhile; ?>

            <!--END #recent-portfolio .home-recent -->
            </div>

            <?php wp_reset_postdata(); ?>

        </section>
            

<?php get_footer(); ?>