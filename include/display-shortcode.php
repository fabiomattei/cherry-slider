<?php

/**
 * this function handle the short code
 */
function RCSLShortCode( $Id ) {

    ob_start();

	/**
     * Load Saved Responsive Image Slider Settings
     */
    if(!isset($Id['id'])) {
        $Id['id'] = "";
		
    } else {
		$WRIS_Id = $Id['id'];
		$WRIS_Gallery_Settings_Key = "WRIS_Gallery_Settings_".$WRIS_Id;
		$WRIS_Gallery_Settings = unserialize(get_post_meta( $WRIS_Id, $WRIS_Gallery_Settings_Key, true));
		if($WRIS_Gallery_Settings['WRIS_L3_Slider_Width'] && $WRIS_Gallery_Settings['WRIS_L3_Slider_Height']) {
			$WRIS_L3_Slide_Title   		    = $WRIS_Gallery_Settings['WRIS_L3_Slide_Title'];
			$WRIS_L3_Auto_Slideshow   		= $WRIS_Gallery_Settings['WRIS_L3_Auto_Slideshow'];
			$WRIS_L3_Sliding_Arrow   		= $WRIS_Gallery_Settings['WRIS_L3_Sliding_Arrow'];
			$WRIS_L3_Slider_Navigation   	= $WRIS_Gallery_Settings['WRIS_L3_Slider_Navigation'];
			$WRIS_L3_Navigation_Button   	= $WRIS_Gallery_Settings['WRIS_L3_Navigation_Button'];
			$WRIS_L3_Slider_Width   		= $WRIS_Gallery_Settings['WRIS_L3_Slider_Width'];
			$WRIS_L3_Slider_Height   		= $WRIS_Gallery_Settings['WRIS_L3_Slider_Height'];
		}
	}

	/**
	 * Load Slider Layout Output
	 */
	require( "display-layout.php" );
	?>
	<?php
	wp_reset_query();
    return ob_get_clean();
}
add_shortcode( 'RCSL', 'RCSLShortCode' );
