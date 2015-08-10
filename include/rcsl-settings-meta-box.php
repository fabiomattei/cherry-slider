<?php
/**
 * Load Saved Ultimate Responsive Image Slider Pro Settings
 */
$PostId = $post->ID;
$RCSL_Slider_Settings = unserialize(get_post_meta( $PostId, RCSL_SETTINGS_KEY.$PostId, true));
if($RCSL_Slider_Settings['RCSL_Slider_Width'] && $RCSL_Slider_Settings['RCSL_Slider_Height']) {
	$RCSL_Slide_Title   	= $RCSL_Slider_Settings['RCSL_Slide_Title'];
	$RCSL_Auto_Slideshow   	= $RCSL_Slider_Settings['RCSL_Auto_Slideshow'];
	$RCSL_Sliding_Arrow   	= $RCSL_Slider_Settings['RCSL_Sliding_Arrow'];
	$RCSL_Slider_Navigation = $RCSL_Slider_Settings['RCSL_Slider_Navigation'];
	$RCSL_Navigation_Button = $RCSL_Slider_Settings['RCSL_Navigation_Button'];
	$RCSL_Slider_Width   	= $RCSL_Slider_Settings['RCSL_Slider_Width'];
	$RCSL_Slider_Height   	= $RCSL_Slider_Settings['RCSL_Slider_Height'];
}
?>
<style>

.thumb-pro th, .thumb-pro label, .thumb-pro h3, .thumb-pro{
	color:#31a3dd !important;
	font-weight:bold;
}
.caro-pro th, .caro-pro label, .caro-pro h3, .caro-pro{
	color:#DA5766 !important;
	font-weight:bold;
}
</style>
<?php require_once("tooltip.php"); ?>	
<input type="hidden" id="wl_action" name="wl_action" value="wl-save-settings">
<table class="form-table">
	<tbody>
		<tr id="L3">
			<th scope="row" colspan="2"><h2>Configure Settings For Slider Shortcode: <?php echo "[RCSL id=$PostId]"; ?></h2><hr></th>
		</tr>
		
		<tr id="L3">
			<th scope="row"><label>Display Slider Title</label></th>
			<td>
				<?php if(!isset($RCSL_Slide_Title)) $RCSL_Slide_Title = 1; ?>
				<input type="radio" name="wl-l3-slide-title" id="wl-l3-slide-title" value="1" <?php if($RCSL_Slide_Title == 1 ) { echo "checked"; } ?>> <i class="fa fa-check fa-2x"></i> 
				<input type="radio" name="wl-l3-slide-title" id="wl-l3-slide-title" value="0" <?php if($RCSL_Slide_Title == 0 ) { echo "checked"; } ?>> <i class="fa fa-times fa-2x"></i>
				<p class="description">
					Select Yes/No option to show/hide slide title above slider.
				</p>
			</td>
		</tr>
		
		<tr id="L3">
			<th scope="row"><label>Auto Play Slide Show</label></th>
			<td>
				<?php if(!isset($RCSL_Auto_Slideshow)) $RCSL_Auto_Slideshow = 1; ?>
				<input type="radio" name="wl-l3-auto-slide" id="wl-l3-auto-slide" value="1" <?php if($RCSL_Auto_Slideshow == 1 ) { echo "checked"; } ?>> <i class="fa fa-check fa-2x"></i> 
				<input type="radio" name="wl-l3-auto-slide" id="wl-l3-auto-slide" value="0" <?php if($RCSL_Auto_Slideshow == 0 ) { echo "checked"; } ?>> <i class="fa fa-times fa-2x"></i>
				<p class="description">
					Select Yes/No option to auto slide enable or disable into slider.
				</p>
			</td>
		</tr>
		
		<tr id="L3">
			<th scope="row"><label>Sliding Arrow</label></th>
			<td>
				<?php if(!isset($RCSL_Sliding_Arrow)) $RCSL_Sliding_Arrow = 1; ?>
				<input type="radio" name="wl-l3-sliding-arrow" id="wl-l3-sliding-arrow" value="1" <?php if($RCSL_Sliding_Arrow == 1 ) { echo "checked"; } ?>> <i class="fa fa-check fa-2x"></i> 
				<input type="radio" name="wl-l3-sliding-arrow" id="wl-l3-sliding-arrow" value="0" <?php if($RCSL_Sliding_Arrow == 0 ) { echo "checked"; } ?>> <i class="fa fa-times fa-2x"></i>
				<p class="description">
					Select Yes/No option to show or hide arrows on mouse hover on slide.
					<a href="#" id="p1" data-tooltip="#s1">Preview</a>
				</p>
			</td>
		</tr>
		
		<tr id="L3">
			<th scope="row"><label>Show Thumbnail</label></th>
			<td>
				<?php if(!isset($RCSL_Slider_Navigation)) $RCSL_Slider_Navigation = 1; ?>
				<input type="radio" name="wl-l3-navigation" id="wl-l3-navigation" value="1" <?php if($RCSL_Slider_Navigation == 1 ) { echo "checked"; } ?>> <i class="fa fa-check fa-2x"></i> 
				<input type="radio" name="wl-l3-navigation" id="wl-l3-navigation" value="0" <?php if($RCSL_Slider_Navigation == 0 ) { echo "checked"; } ?>> <i class="fa fa-times fa-2x"></i>
				<p class="description">
					Select Yes/No option to show or hide thumbnail based navigation under slides.
					<a href="#" id="p2" data-tooltip="#s2">Preview</a>
				</p>
			</td>
		</tr>
		
		<tr id="L3">
			<th scope="row"><label>Show Navigation Bullets</label></th>
			<td>
				<?php if(!isset($RCSL_Navigation_Button)) $RCSL_Navigation_Button = 1; ?>
				<input type="radio" name="wl-l3-navigation-button" id="wl-l3-navigation-button" value="1" <?php if($RCSL_Navigation_Button == 1 ) { echo "checked"; } ?>> <i class="fa fa-check fa-2x"></i> 
				<input type="radio" name="wl-l3-navigation-button" id="wl-l3-navigation-button" value="0" <?php if($RCSL_Navigation_Button == 0 ) { echo "checked"; } ?>> <i class="fa fa-times fa-2x"></i>
				<p class="description">
					Select Yes/No option to show or hide slider navigation buttons under image slider.
					<a href="#" id="p3" data-tooltip="#s3">Preview</a>
				</p>
			</td>
		</tr>
		
		<tr id="L3">
			<th scope="row"><label>Slider Width</label></th>
			<td>
				<?php if(!isset($RCSL_Slider_Width)) $RCSL_Slider_Width = 1000; ?>
				<input type="text" name="wl-l3-slider-width" id="wl-l3-slider-width" value="<?php echo $RCSL_Slider_Width; ?>">
				<p class="description">
					Enter your desired width for slider. Default width is 1000px.
					<a href="#" id="p4" data-tooltip="#s4">Preview</a>
				</p>
			</td>
		</tr>
		
		<tr id="L3">
			<th scope="row"><label>Slider Height</label></th>
			<td>
				<?php if(!isset($RCSL_Slider_Height)) $RCSL_Slider_Height = 500; ?>
				<input type="text" name="wl-l3-slider-height" id="wl-l3-slider-height" value="<?php echo $RCSL_Slider_Height; ?>">
				<p class="description">
					Enter your desired height for slider. Default height is 500px.
					<a href="#" id="p5" data-tooltip="#s5">Preview</a>
				</p>
			</td>
		</tr>
	</tbody>
</table>