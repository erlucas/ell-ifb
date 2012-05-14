<?php
/*
Template Name: Full Width
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

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="full-width">
	                        
	                <?php the_content(); ?>
	                            
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
	
	<!--END #middle-->
	</div>


<?php get_footer(); ?>