	                            
	                        <!--END .entry-content -->
	                        </div>     
	                          
					<!--END .post-->  
					</div>



			<!--END main-content -->
			</section>

		<!--BEGIN .sidebar four columns-->
		<aside class="sidebar top-margin five columns">
			
			<?php 
			if(!is_page()) :
			/* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ) : ?>
				
                <?php
				
				endif;
			else:
			/* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) : ?>
                
                <?php
				endif;
			endif;
			?>
		
		<!--END .sidebar .four columns-->
		</aside>