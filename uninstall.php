<?php

// If uninstall not called from WordPress exit
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();

// Delete option from options table
delete_option( 'rc_cs_options' );
delete_option( 'rc_cs_admin_options' );


// TODO check if I should delete posts from custom post type


