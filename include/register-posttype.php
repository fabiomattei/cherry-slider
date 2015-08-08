<?php
	
$labels = array(
	'name' => _x( 'Cherry Slider', RCSL_TEXT_DOMAIN ),
	'singular_name' => _x( 'Cherry Slider', RCSL_TEXT_DOMAIN ),
	'add_new' => _x( 'Add New Cherry Slider', RCSL_TEXT_DOMAIN ),
	'add_new_item' => _x( 'Add New Cherry Slider', RCSL_TEXT_DOMAIN ),
	'edit_item' => _x( 'Edit Cherry Slider', RCSL_TEXT_DOMAIN ),
	'new_item' => _x( 'New Cherry Slider', RCSL_TEXT_DOMAIN ),
	'view_item' => _x( 'View Cherry Slider', RCSL_TEXT_DOMAIN ),
	'search_items' => _x( 'Search Cherry Slider', RCSL_TEXT_DOMAIN ),
	'not_found' => _x( 'No Cherry Slider found', RCSL_TEXT_DOMAIN ),
	'not_found_in_trash' => _x( 'No Image found in Trash', RCSL_TEXT_DOMAIN ),
	'parent_item_colon' => _x( 'Parent Image:', RCSL_TEXT_DOMAIN ),
	'all_items' => __( 'All Cherry Sliders', RCSL_TEXT_DOMAIN ),
	'menu_name' => _x( 'Cherry Slider', RCSL_TEXT_DOMAIN ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,
	'supports' => array( 'title' ),
	'public' => false,
	'show_ui' => true,
	'show_in_menu' => true,
	'menu_position' => 10,
	'menu_icon' => 'dashicons-format-gallery',
	'show_in_nav_menus' => false,
	'publicly_queryable' => false,
	'exclude_from_search' => true,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => false,
	'capability_type' => 'post'
);

register_post_type( RCSL_TEXT_DOMAIN, $args );

/**
 * Managin columns for post type list 
 */
function cherry_slider_columns( $columns ){
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Cherry Slider Title', RCSL_TEXT_DOMAIN ),
        'shortcode' => __( 'Slider Shortcode', RCSL_TEXT_DOMAIN ),
        'date' => __( 'Date', RCSL_TEXT_DOMAIN )
    );
    return $columns;
}

add_filter( 'manage_edit-cherry-slider_columns', 'cherry_slider_columns' );

/**
 * Populating columns with the right content
 */
function ris_gallery_manage_columns( $column, $post_id ){
    global $post;
    switch( $column ) {
      case 'shortcode' :
        echo '<input type="text" value="[RCSL id='.$post_id.']" readonly="readonly" />';
        break;
      default :
        break;
    }
}

add_action( 'manage_cherry-slider_posts_custom_column', 'ris_gallery_manage_columns' , 10, 2 );
