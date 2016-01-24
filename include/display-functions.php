<?php

/**
 * This functions check the loaded post, in case a shortcode is present id loads
 * necessary css and js in order to show the slider properly
 *
 * It relies on a jquery dependency
 */
function RCSLCherrySliderShortCodeDetect() {
    global $wp_query;
    $Posts = $wp_query->posts;
    foreach ($Posts as $Post) {
		if ( strpos($Post->post_content, 'RCSL' ) ) {
			// loading js scripts
			wp_enqueue_script('rcsl-slippry-javascript', RCSL_PLUGIN_URL.'js/red-cherries-slider.js', array(), '', true);
			// loading css scripts
			wp_enqueue_style('rcsl-slippry-css', RCSL_PLUGIN_URL.'css/red-cherries-slider.css');

            break;
        } //end of if
    } //end of foreach
}

add_action( 'wp', 'RCSLCherrySliderShortCodeDetect' );
