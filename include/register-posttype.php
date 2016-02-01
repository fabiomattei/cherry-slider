<?php
	
$labels = array(
	'name' => _x( 'Cherry Slider', 'chslider' ),
	'singular_name' => _x( 'Cherry Slider', 'chslider' ),
	'add_new' => _x( 'Add New Slide', 'chslider' ),
	'add_new_item' => _x( 'Add New Slide', 'chslider' ),
	'edit_item' => _x( 'Edit Slide', 'chslider' ),
	'new_item' => _x( 'New Slide', 'chslider' ),
	'view_item' => _x( 'View Slide', 'chslider' ),
	'search_items' => _x( 'Search Slide', 'chslider' ),
	'not_found' => _x( 'No Slide found', 'chslider' ),
	'not_found_in_trash' => _x( 'No Slide found in Trash', 'chslider' ),
	'parent_item_colon' => _x( 'Parent Slide:', 'chslider' ),
	'all_items' => __( 'All Slides', 'chslider' ),
	'menu_name' => _x( 'Cherry Slider', 'chslider' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,
	'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
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

register_post_type( RCSL_SLUG, $args );
