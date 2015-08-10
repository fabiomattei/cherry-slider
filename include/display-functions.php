<?php
	
/**
 * This functions check the loaded post, in case a shortcode is present id loads
 * necessary css and js to show the gallery
 */
function RCSLCherrySliderShortCodeDetect() {
    global $wp_query;
    $Posts = $wp_query->posts;
    $Pattern = get_shortcode_regex();
    foreach ($Posts as $Post) {
		if ( strpos($Post->post_content, 'RCSL' ) ) {
			/**
             * js scripts
             */
			wp_enqueue_script('rcsl-slippry-javascript', RCSL_PLUGIN_URL.'js/slippry.min.js', array('jquery'), '', true);
			
			/**   
             * css scripts
             */
			wp_enqueue_style('rcsl-slippry-css', RCSL_PLUGIN_URL.'css/slippry.css');
			
            break;
        } //end of if
    } //end of foreach
}
add_action( 'wp', 'RCSLCherrySliderShortCodeDetect' );
