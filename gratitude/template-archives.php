<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>           
            
    <div id="middle">

        <div class="container content-background">

            <!--BEGIN .page-title -->
            <div class="page-title">
                <h1 class="page-title-heading ten columns"><?php the_title(); ?></h1>
                   
            <!--END .page-title -->
            </div>

            <!--BEGIN #main-content -->
            <section class="main-content top-margin eleven columns">
                        
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <!--BEGIN .post -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       
        
                            <!--BEGIN .entry-content -->
                            <div class="entry-content">
                        
                            <?php the_content(); ?>
                            
                                <!--BEGIN .archive-list -->
                                <div class="archive-list">

                                    <div class="six columns omega">
                                        <h2><?php _e('Latest 10 posts', 'framework') ?></h2>
                        
                                        <ul>
                                        <?php $archive_10 = get_posts('numberposts=10');
                                            foreach($archive_10 as $post) : ?>
                                            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    
                                    </div>
                                    
                                    <div class="five columns omega">
                                        <h2><?php _e('Archives by month:', 'framework') ?></h2>
                                    
                                        <ul>
                                            <?php wp_get_archives('type=monthly'); ?>
                                        </ul>
                                    </div>
                                    
                                    <div class="four columns omega">
                                        <h2><?php _e('Archives by subjects:', 'framework') ?></h2>
                                    
                                        <ul>
                                            <?php wp_list_categories( 'title_li=' ); ?>
                                        </ul>
                                    </div>
                                
                                <!--END .archive-list -->
                                </div>
                            
                            <!--END .entry-content -->
                            </div>

    				<!--END .post-->  
    				</div>

				<?php endwhile; ?>

			<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-404" <?php post_class(); ?>>
				
					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; ?>

        </section>


<?php get_sidebar(); ?>

<?php get_footer(); ?>