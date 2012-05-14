<?php

/*-----------------------------------------------------------------------------------

	Add Portfolio Post Type

-----------------------------------------------------------------------------------*/


function zen_create_post_type_portfolios() 
{
	$labels = array(
		'name' => __( 'Portfolio'),
		'singular_name' => __( 'Portfolio' ),
		'add_new' => _x('Add New', 'slide'),
		'add_new_item' => __('Add New Portfolio'),
		'edit_item' => __('Edit Portfolio'),
		'new_item' => __('New Portfolio'),
		'view_item' => __('View Portfolio'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('No portfolios found'),
		'not_found_in_trash' => __('No portfolios found in Trash'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'rewrite' => array('slug' => __( 'portfolio' )),
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields', 'excerpt')
	  ); 
	  
	  register_post_type(__( 'portfolio' ),$args);
}




function zen_build_taxonomies(){
	register_taxonomy(__( "skillset" ), array(__( "portfolio" )), array("hierarchical" => true, "label" => __( "Skillsets" ), "singular_label" => __( "Skillset" ), "rewrite" => array('slug' => 'skillset', 'hierarchical' => true))); 
}

/* Enable Sorting of the Portfolio ------------------------------------------*/
function zen_create_portfolio_sort_page() {
    $zen_sort_page = add_submenu_page('edit.php?post_type=portfolio', 'Sort Portfolios', __('Sort Portfolios', 'framework'), 'edit_posts', basename(__FILE__), 'zen_portfolio_sort');
    
    add_action('admin_print_styles-' . $zen_sort_page, 'zen_print_sort_styles');
    add_action('admin_print_scripts-' . $zen_sort_page, 'zen_print_sort_scripts');
}

function zen_portfolio_sort() {
    $portfolios = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2><?php _e('Sort Portfolios', 'framework'); ?></h2>
        <p><?php _e('Click, drag, re-order. Portfolio at the top will appear first.', 'framework'); ?></p>

        <ul id="portfolio_list">
            <?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>
                <?php if( get_post_status() == 'publish' ) { ?>
                    <li id="<?php the_id(); ?>" class="menu-item">
                        <dl class="menu-item-bar">
                            <dt class="menu-item-handle">
                                <span class="menu-item-title"><?php the_title(); ?></span>
                            </dt>
                        </dl>
                        <ul class="menu-item-transport"></ul>
                    </li>
                <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
<?php }

function zen_save_portfolio_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}

function zen_print_sort_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('zen_portfolio_sort', get_template_directory_uri() . '/admin/js/zen_portfolio_sort.js');
}

function zen_print_sort_styles() {
    wp_enqueue_style('nav-menu');
}

function zen_portfolio_edit_columns($columns){  

        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => __( 'Portfolio Item Title' ),
            "type" => __( 'type' )
        );  
  
        return $columns;  
}  
  
function zen_portfolio_custom_columns($column){  
        global $post;  
        switch ($column)  
        {    
            case __( 'type' ):  
                echo get_the_term_list($post->ID, __( 'skillset' ), '', ', ','');  
                break;
        }  
}  

add_action( 'init', 'zen_create_post_type_portfolios' );
add_action( 'init', 'zen_build_taxonomies', 0 );


add_action('admin_menu', 'zen_create_portfolio_sort_page');
add_action('wp_ajax_portfolio_sort', 'zen_save_portfolio_sorted_order');


add_filter("manage_edit-portfolio_columns", "zen_portfolio_edit_columns");  
add_action("manage_posts_custom_column",  "zen_portfolio_custom_columns");  

?>