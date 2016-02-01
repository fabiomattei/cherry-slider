<?php

/*
Plugin Name: Cherry Slider
Plugin URI: http://www.redcherries.net/cherry-slider
Version: 1.0.0
Author: Red Cherries
Author URI: http://www.redcherries.net/
License: GPLv2
Text Domain: chslider
Description: Cherry Slider gives the possibility of installing a slider in a wordpress website.

It is based on [Slippry](http://slippry.com/ "Slippry") a wonderful jQuery library that allows to create
sliders very easily and very quickly.

Cherry Slider creates a new post-type: cherry-slider

Each post that belong to this post-type will be a slide of the slider.
His title will be the slider title and the post-type text will be the subtitle.

Cherry Slider gives the possibility of controlling the following options:

transition
default: 'fade'
accepts: 'fade', 'horizontal', 'vertical', 'kenburns', false

speed
default: 800
accepts: any number (in milliseconds).

easing
default: 'swing'
accepts: any easing effect. See "http://jqueryui.com/resources/demos/effect/easing.html".
*/

/*******************************************
* Plugin CONSTANT
********************************************/
define( 'RCSL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'RCSL_PLUGIN_URL' , plugin_dir_url( __FILE__ ) );
define( 'RCSL_OPTIONS_STRING' , 'rc_cs_options' );
define( 'RCSL_ADMIN_OPTIONS_STRING' , 'rc_cs_admin_options' );
define( 'RCSL_SLUG',        'cherryslider' );  // it defines the post-type name

define( 'RCSL_SETTINGS_KEY', 'RCSL_Gallery_Settings');

/*******************************************
* Global Variables and options
********************************************/

$rcsl_plugin_name = 'Cherry slider';

$options = get_option( RCSL_OPTIONS_STRING );
if( !isset( $options['width'] ) ) $options['width'] = 1000;
if( !isset( $options['height'] ) ) $options['height'] = 300;

/*******************************************
* Images dimentions
* They depends from the options defined by the user.
* They sets a new "image_size"
********************************************/
add_image_size( 'rc_gallery_image', $options['width'], $options['height'], true );
the_post_thumbnail( 'rc_gallery_image' );

add_filter( 'image_size_names_choose', 'rc_gallery_image_size' );
function rc_gallery_image_size( $sizes ) {
	return array_merge( $sizes, array(
		'rc_gallery_image' => __( 'Red Cherry Slider Img', 'chslider' ),
	) );
}

/*******************************************
* Includes
********************************************/

if ( is_admin() ) {
	// include admin side
	include( 'include/installer.php' );
	include( 'include/register-posttype.php' );
    include( 'include/admin-page.php' );

} else {
	// include for client side
	include( 'include/display-functions.php');
	include( 'include/display-shortcode.php');
}


/*******************************************
 * Activation
 ********************************************/

/**
 * This function is triggered when plug in is activated
 */
function rc_cs_activate() {
    // cheking wordpress version
    If ( version_compare( get_bloginfo( 'version' ), '4.4', '<' ) ) {
        deactivate_plugins( basename( __FILE__ ) );
    }

    // adding default options
    // front-end options: autoloaded
    add_option( RCSL_OPTIONS_STRING, array(
        'speed'      => '800',
        'transition' => 'fade',
        'easing'     => 'swing',
		'width'      => 1000,
		'heigt'      => 300,
    ));
    // back-end options: loaded only if explicitly needed
    add_option( RCSL_ADMIN_OPTIONS_STRING, array(
        'version'          => '1.0',
        'donate_url'       => 'http://x.y/z/',
        'advanced_options' => '1'
    ), '', 'no' );

}

register_activation_hook( __FILE__, 'rc_cs_activate' );
