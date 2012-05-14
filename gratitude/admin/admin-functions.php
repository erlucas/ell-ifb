<?php
/*-----------------------------------------------------------------------------------*/
/* The Head Hook
/*-----------------------------------------------------------------------------------*/
function zen_head() { do_action( 'zen_head' ); }

/*-----------------------------------------------------------------------------------*/
/* Adding the default options after activation */
/*-----------------------------------------------------------------------------------*/
function zen_option_setup(){

	$zen_array = array();
	add_option('zen_options',$zen_array);

	$template = get_option('zen_template');
	$saved_options = get_option('zen_options');
	
	foreach($template as $option) {
		
		if($option['type'] != 'heading'){
		
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
		
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$zen_array[$c_id] = $c_std; 
					}
		
				} else {
						
					update_option($id,$std);
					$zen_array[$id] = $std;
				
				}
			}
		
			else { 
				$zen_array[$id] = $db_option;
			}
		}
	}
	update_option('zen_options',$zen_array);
}
if (is_admin() && $pagenow == "themes.php" && isset($_GET['activated'] ) ) {
	add_action('admin_head','zen_option_setup');
}
/*-----------------------------------------------------------------------------------*/
/* The Admin Backend 
/*-----------------------------------------------------------------------------------*/

function zenfactory_admin_head() { 
	
	// Here you can easily tweak the message on theme activation
	?>
    
    <script type="text/javascript">
    jQuery(function(){
	var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=zenfactory'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    
	<?php
}
add_action('admin_head', 'zenfactory_admin_head'); 

?>