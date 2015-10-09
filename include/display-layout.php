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
		adaptiveHeight: true, 
	});
});
</script>
<style>
.sy-slides-wrap {
	max-height: 520px;
}
</style>
<?php  if($RCSL_Slide_Title == 1) { ?>
<h3 class="uris-slider-title"><?php echo get_the_title( $post_id ); ?></h3>
<?php } ?>
<div id="example3_<?php echo $post_id; ?>" class="slidecont">
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
	      <img src="<?php echo $Url; ?>" class="imgclass">
		<?php if($Title != "") { ?>
		<p class="slider-title">
			<?php if(strlen($Title) > 100 ) echo substr($Title,0,100); else echo $Title; ?>
		</p>
		<?php } ?>

		<?php if($Desc != "") { ?>
		<p class="slider-description" >
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
