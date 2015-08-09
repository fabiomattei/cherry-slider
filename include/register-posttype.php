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
 * Managin columns for post type list in the administration page
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
 * Populating columns in the list with the right content in the administration page
 */
function cherry_slider_manage_columns( $column, $post_id ){
    global $post;
    switch( $column ) {
      case 'shortcode' :
        echo '<input type="text" value="[RCSL id='.$post_id.']" readonly="readonly" />';
        break;
      default :
        break;
    }
}

add_action( 'manage_cherry-slider_posts_custom_column', 'cherry_slider_manage_columns' , 10, 2 );

/**
 * Adding all metaboxes necessasry for the slider
 */
function add_all_cherry_slider_meta_boxes() {
	add_meta_box( __('Add Images', RCSL_TEXT_DOMAIN), __('Add Images', RCSL_TEXT_DOMAIN),  'rcsl_generate_add_image_meta_box_function' , RCSL_SLUG, 'normal', 'low' );
	add_meta_box( __('Apply Setting On Ultimate Responsive Image Slider', RCSL_TEXT_DOMAIN), __('Apply Setting On Ultimate Responsive Image Slider', RCSL_TEXT_DOMAIN), 'rcsl_settings_meta_box_function' , RCSL_SLUG, 'normal', 'low');
	add_meta_box ( __('Copy Image Slider Shortcode', RCSL_TEXT_DOMAIN), __('Copy Image Slider Shortcode', RCSL_TEXT_DOMAIN), 'rcsl_shotcode_meta_box_function' , RCSL_SLUG, 'side', 'low');
}

add_action( 'add_meta_boxes', 'add_all_cherry_slider_meta_boxes' );

/**
 * This function display Add New Image interface
 * Also loads all saved gallery photos into photo gallery
 */
function rcsl_generate_add_image_meta_box_function( $post ) {
	require_once( 'rcsl-addimage-meta-box.php' );
}

function rcsl_settings_meta_box_function( $post ) { 
	require_once( 'rcsl-settings-meta-box.php' );
}

function rcsl_shotcode_meta_box_function() { ?>
	<p><?php _e("Use below shortcode in any Page/Post to publish your slider", RCSL_TEXT_DOMAIN);?></p>
	<input readonly="readonly" type="text" value="<?php echo "[URIS id=".get_the_ID()."]"; ?>">
	<?php 
}

