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
			wp_enqueue_script('rcsl-jquery-sliderPro-js', RCSL_PLUGIN_URL.'js/jquery.sliderPro.js', array('jquery'), '', true);
			
			/**   
             * css scripts
             */
			wp_enqueue_style('rcsl-slider-css', RCSL_PLUGIN_URL.'css/slider-pro.css');
			
            break;
        } //end of if
    } //end of foreach
}
add_action( 'wp', 'RCSLCherrySliderShortCodeDetect' );
