<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

	<div id="middle">

		<div class="container content-background">

			<!--BEGIN .page-title -->
			<div class="page-title">
                <h1 class="page-title-heading ten columns"><?php the_title(); ?></h1>

				   
					</div>
			<!--END .page-title -->
			</div>

			<!--BEGIN #main-content -->
			<section class="top-margin full-width">
            	
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    
                                        
				    <ul id="sort">
				        <li><a href="#all" data-filter="portfolio" class="active"><?php _e('All', 'framework'); ?></a></li>
				        <?php wp_list_categories( array('title_li' => '', 'taxonomy' => 'skillset', 'walker' => new Portfolio_Walker() ) ); ?>
				    </ul>

                <?php endwhile; ?>
                
                <!--BEGIN .recent-portfolio -->
                <div class="recent-portfolio">
				
                	<ul id="portfolio" class="portfolio-content section image-grid isotope">
                    
						<?php 	    $args = array(
						                'post_type' => 'portfolio',
						                'orderby' => 'menu_order',
                						'order' => 'ASC',
						                'posts_per_page' => -1
								    );
								    $query = new WP_Query( $args );
									while ( $query->have_posts() ) : $query->the_post(); ?>
										
										<?php 
										    $terms =  get_the_terms( $post->ID, 'skillset' ); 
										    $term_list = '';
										    if( is_array($terms) ) {
										        foreach( $terms as $term ) {
						    				        $term_list .= $term->slug;
						    				        $term_list .= ' ';
						    				    }
									        }
										?>

                        	
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
                                    
                                    <?php
        						      $count++;
        						    ?>
                                
                                </li>

                        <?php endwhile; wp_reset_query(); ?>
                      
                    </ul>
                        
                <!--END .recent-wrap -->
                </div>

            <!--END #recent-portfolio .home-recent -->
            </div>

        </section>
            

<?php get_footer(); ?>