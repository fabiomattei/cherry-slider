<?php

/**
 * This functions check the loaded post, in case a shortcode is present id loads
 * necessary css and js in order to show the gallery
 *
 * It relies on a jquery dependency
 */
function RCSLCherrySliderShortCodeDetect() {
    global $wp_query;
    $Posts = $wp_query->posts;
    $Pattern = get_shortcode_regex();
    foreach ($Posts as $Post) {
		if ( strpos($Post->post_content, 'RCSL' ) ) {
			// loading js scripts
			wp_enqueue_script('rcsl-slippry-javascript', RCSL_PLUGIN_URL.'lib/slippry/slippry.min.js', array('jquery'), '', true);
			// loading css scripts
			wp_enqueue_style('rcsl-slippry-css', RCSL_PLUGIN_URL.'lib/slippry/slippry.css');

            break;
        } //end of if
    } //end of foreach
}
add_action( 'wp', 'RCSLCherrySliderShortCodeDetect' );
