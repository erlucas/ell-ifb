    
    <!--END .container content-background-->
    </div>

<!--END #middle -->
</div> 

<!--BEGIN #bottom -->
<div id="bottom">

    <div class="container">

        <!-- BEGIN #footer-container -->
        <footer class="footer-container container sixteen columns" style="margin-top: 40px; ">             
                    
            <!-- BEGIN .widget-section -->
            <div class="widget-section six columns alpha no-bottom">
                
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer One' ) ) ?>
                
            <!-- END .widget-section -->   
            </div>
                    
            <!-- BEGIN .widget-section -->
            <div class="widget-section five columns no-bottom">
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Two' ) ) ?>
                        
            <!-- END .widget-section -->   
            </div>
                    
            <!-- BEGIN .widget-section -->
            <div class="widget-section five columns omega no-bottom">
                    
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer Three' ) ) ?>
                        
            <!-- END .widget-section -->   
            </div>
            
            <!--Begin .alignright .copyright -->
            <div class="six columns alpha omega">
            
                    <p class="copyright">

                    <?php echo get_option(' zen_footer_text '); ?>

                    </p>
            <!--/.alignright-->
            </div>            
            
                
            <!-- END .widget-wrap -->
            </div>


                    
        <!--END #footer-container -->
        </footer>		



    <!--END .container -->
    </div>

<!--END #bottom -->
</div>

    <!-- Theme Hook -->
	<?php wp_footer(); ?>
			
<!--END body-->
</body>
<!--END html-->
</html>