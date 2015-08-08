<?php
	
$labels = array(
	'name' => _x( 'Ultimate Responsive Image Slider', RCSL_TEXT_DOMAIN ),
	'singular_name' => _x( 'Ultimate Responsive Image Slider', RCSL_TEXT_DOMAIN ),
	'add_new' => _x( 'Add New Image Slider', RCSL_TEXT_DOMAIN ),
	'add_new_item' => _x( 'Add New Image Slider', RCSL_TEXT_DOMAIN ),
	'edit_item' => _x( 'Edit Image Slider', RCSL_TEXT_DOMAIN ),
	'new_item' => _x( 'New Image Slider', RCSL_TEXT_DOMAIN ),
	'view_item' => _x( 'View Image Slider', RCSL_TEXT_DOMAIN ),
	'search_items' => _x( 'Search Image Slider', RCSL_TEXT_DOMAIN ),
	'not_found' => _x( 'No Image Slider found', RCSL_TEXT_DOMAIN ),
	'not_found_in_trash' => _x( 'No Image found in Trash', RCSL_TEXT_DOMAIN ),
	'parent_item_colon' => _x( 'Parent Image:', RCSL_TEXT_DOMAIN ),
	'all_items' => __( 'All Image Sliders', RCSL_TEXT_DOMAIN ),
	'menu_name' => _x( 'UR Image Slider', RCSL_TEXT_DOMAIN ),
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
