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
define( 'RCSL_PLUGIN_URL' , plugins_url( __FILE__ ) );
define( 'RCSL_TEXT_DOMAIN', 'cherry-slider' );

/*******************************************
* Global Variables
* variabili e costanti che sono usate per tutto il plug in
********************************************/

$rcsl_plugin_name = 'Cherry slider';

// retrievie our plugin settings from option table
// $mfp_options = get_option( 'mfp_settings' );

/*******************************************
* Includes
********************************************/

if ( is_admin() ) {
	include( 'include/installer.php' );
	include( 'include/register-posttype.php' );
	//include( 'include/admin-menu.php' );
	
	/*
	include( MFP_PLUGIN_PATH . 'include/slider-list.php' );
	include( MFP_PLUGIN_PATH . 'include/slider-create.php' );
	include( MFP_PLUGIN_PATH . 'include/slider-update.php' );
	*/

	/*
	include( MFP_PLUGIN_PATH . 'inc/scripts.php' );
    include( MFP_PLUGIN_PATH . 'inc/data-processing.php' );
    include( MFP_PLUGIN_PATH . 'inc/admin-page.php');
	*/
} else {
	// include for client side
	include( 'include/display-functions.php');
	
}


/*******************************************
* Images dimentions
********************************************/
add_image_size( 'rpggallery_admin_thumb', 300, 300, true ); 
add_image_size( 'rpggallery_admin_large', 500, 9999 ); 


