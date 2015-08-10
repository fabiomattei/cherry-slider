<?php

/**
 * Load All RCSL Custom Post Type
 */
$IG_CPT_Name = "ris_gallery";
$AllSlides = array(  'p' => $Id['id'], 'post_type' => RCSL_SLUG, 'orderby' => 'ASC');
$loop = new WP_Query( $AllSlides );

while ( $loop->have_posts() ) : $loop->the_post();
//get the post id
$post_id = get_the_ID();

/**
 * Get All Slides Details Post Meta
 */
$RPGP_AllPhotosDetails = unserialize(base64_decode(get_post_meta( get_the_ID(), 'rcsl_all_photos_details', true)));
$TotalImages =  get_post_meta( get_the_ID(), 'rcsl_total_images_count', true );
$i = 1;
$j = 1;
?>
<script type="text/javascript">
jQuery( document ).ready(function( jQuery ) {
	jQuery('#out-of-the-box-demo').slippry({ 
		adaptiveHeight: false, 
	});
});
</script>
<style>
.slidercont {
    width:100%;
    height:350px;
    overflow: hidden;
    position: relative;
    z-index: 1;
}
</style>
<?php  if($RCSL_Slide_Title == 1) { ?>
<h3 class="uris-slider-title"><?php echo get_the_title( $post_id ); ?></h3>
<?php } ?>
<div id="example3_<?php echo $post_id; ?>" class="slidercont">
	<!-- start slippry -->
	<ul id="out-of-the-box-demo">
	<?php 
	foreach($RPGP_AllPhotosDetails as $RPGP_SinglePhotoDetails) {
	$Title = $RPGP_SinglePhotoDetails['rpgp_image_label'];
	$Desc = $RPGP_SinglePhotoDetails['rpgp_image_desc'];
	$Url = $RPGP_SinglePhotoDetails['rpgp_image_url'];
	$i++;
	?>
	  <li>
	    <a href="#slide<?php echo $i; ?>">
	      <img src="<?php echo $Url; ?>">
		<?php if($Title != "") { ?>
		<p class="sp-layer sp-white sp-padding title-in title-in-bg hide-small-screen" 
			data-position="centerCenter"
			data-vertical="-14%"
			data-show-transition="left" data-show-delay="500">
			<?php if(strlen($Title) > 100 ) echo substr($Title,0,100); else echo $Title; ?>
		</p>
		<?php } ?>

		<?php if($Desc != "") { ?>
		<p class="sp-layer sp-black sp-padding desc-in desc-in-bg hide-medium-screen" 
			data-position="centerCenter"
			data-vertical="14%"
			data-show-transition="right" data-show-delay="500">
			<?php if(strlen($Desc) > 300 ) echo substr($Desc,0,300)."..."; else echo $Desc; ?>
		</p>
		<?php } ?>
	    </a>
	  </li>
	<?php } //end for each ?>
	</ul>
	<!-- end slippry -->

	<?php 
	if($RCSL_Slider_Navigation == 1) {
	?>
	<!-- slides thumbnails div start -->
	<div class="sp-thumbnails">
		<?php 
		foreach($RPGP_AllPhotosDetails as $RPGP_SinglePhotoDetails) {
		$ThumbUrl = $RPGP_SinglePhotoDetails['rpggallery_admin_thumb'];
		$j++;
		?>
		<img class="sp-thumbnail" src="<?php echo $ThumbUrl; ?>"/>
		<?php } ?>
	</div>
	<?php } ?>
	<!-- slides thumbnails div end -->
	
</div>
<?php endwhile; ?>
