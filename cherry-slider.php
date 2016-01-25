<?php

/*
Plugin Name: Cherry Slider
Plugin URI: http://www.redcherries.net/cherry-slider
Description: TODO
Version: 1.0.0
Author: Red Cherries
Author URI: http://www.redcherries.net/
License: GPLv2
*/

/*******************************************
* Plugin CONSTANT
********************************************/
define( 'RCSL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'RCSL_PLUGIN_URL' , plugin_dir_url( __FILE__ ) );
define( 'RCSL_OPTIONS_STRING' , 'rc_cs_options' );
define( 'RCSL_ADMIN_OPTIONS_STRING' , 'rc_cs_admin_options' );
define( 'RCSL_TEXT_DOMAIN', 'cherry-slider' );
define( 'RCSL_SLUG',        'cherry-slider' );

define( 'RCSL_SETTINGS_KEY', 'RCSL_Gallery_Settings');

/*******************************************
* Global Variables
* variabili e costanti che sono usate per tutto il plug in
********************************************/

$rcsl_plugin_name = 'Cherry slider';

// retrievie our plugin settings from option table
// $mfp_options = get_option( 'mfp_settings' );

function rc_cs_create_options() {
	// front-end options: autoloaded
	add_option( RCSL_OPTIONS_STRING, array(
        'speed' => '800',
        'transition' => 'fade',
        'easing' => 'swing'
	));
	// back-end options: loaded only if explicitly needed
	add_option( RCSL_ADMIN_OPTIONS_STRING, array(
		'version' => '1.0',
		'donate_url' => 'http://x.y/z/',
		'advanced_options' => '1'
	), '', 'no' );
}


/*******************************************
* Images dimentions
********************************************/
add_image_size( 'rc_gallery_image', 1000, 300, true );
the_post_thumbnail( 'rc_gallery_image' );

add_filter( 'image_size_names_choose', 'rc_gallery_image_size' );
function rc_gallery_image_size( $sizes ) {
	return array_merge( $sizes, array(
		'rc_gallery_image' => __( 'Red Cherry Slider Img' ),
	) );
}

/*******************************************
* Includes
********************************************/

if ( is_admin() ) {
	// include admin side
    include( 'include/activation.php' );
	include( 'include/installer.php' );
	include( 'include/register-posttype.php' );
    include( 'include/admin-page.php' );

} else {
	// include for client side
	include( 'include/display-functions.php');
	include( 'include/display-shortcode.php');
}
