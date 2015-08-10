<?php

/**
 * This function handle the short code
 */
function RCSLShortCode( $Id ) {
    ob_start();

	/**
     * Load Saved Responsive Image Slider Settings
     */
    if(!isset($Id['id'])) {
        $Id['id'] = "";
    } else {
		$RCSL_Id = $Id['id'];
		$RCSL_Gallery_Settings_Key = RCSL_SETTINGS_KEY.$RCSL_Id;
		$RCSL_Gallery_Settings = unserialize(get_post_meta( $RCSL_Id, $RCSL_Gallery_Settings_Key, true));
		if($RCSL_Gallery_Settings['RCSL_Slider_Width'] && $RCSL_Gallery_Settings['RCSL_Slider_Height']) {
			$RCSL_Slide_Title   		= $RCSL_Gallery_Settings['RCSL_Slide_Title'];
			$RCSL_Auto_Slideshow   		= $RCSL_Gallery_Settings['RCSL_Auto_Slideshow'];
			$RCSL_Sliding_Arrow   		= $RCSL_Gallery_Settings['RCSL_Sliding_Arrow'];
			$RCSL_Slider_Navigation   	= $RCSL_Gallery_Settings['RCSL_Slider_Navigation'];
			$RCSL_Navigation_Button   	= $RCSL_Gallery_Settings['RCSL_Navigation_Button'];
			$RCSL_Slider_Width   		= $RCSL_Gallery_Settings['RCSL_Slider_Width'];
			$RCSL_Slider_Height   		= $RCSL_Gallery_Settings['RCSL_Slider_Height'];
		}
	}

	/**
	 * Load Slider Layout Output
	 */
	require( "display-layout.php" );
	
	wp_reset_query();
    return ob_get_clean();
}
add_shortcode( 'RCSL', 'RCSLShortCode' );
