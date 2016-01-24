<?php

/**
 * This function handle the short code
 */
function RCSLShortCode( $Id ) {
    ob_start();

    /**
     * Load Slider Layout Output
     */
    require( "display-layout.php" );

    wp_reset_query();
    return ob_get_clean();
}
add_shortcode( 'RCSL', 'RCSLShortCode' );
