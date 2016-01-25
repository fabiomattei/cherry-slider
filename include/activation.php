<?php

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

register_activation_hook( __FILE__, 'rc_cs_activate' );
