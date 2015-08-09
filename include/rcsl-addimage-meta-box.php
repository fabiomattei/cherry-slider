	<div id="rpggallery_container">
        <ul id="rpg_gallery_thumbs" class="clearfix">
			<?php
			/* load saved photos into ris */
			$WRIS_AllPhotosDetails = unserialize(base64_decode(get_post_meta( $post->ID, 'ris_all_photos_details', true)));
			$TotalImages =  get_post_meta( $post->ID, 'ris_total_images_count', true );
			if($TotalImages) {
				foreach($WRIS_AllPhotosDetails as $WRIS_SinglePhotoDetails) {
					$name = $WRIS_SinglePhotoDetails['rpgp_image_label'];
					$desc = $WRIS_SinglePhotoDetails['rpgp_image_desc'];						
					$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
					$url = $WRIS_SinglePhotoDetails['rpgp_image_url'];
					$url1 = $WRIS_SinglePhotoDetails['rpggallery_admin_thumb'];
					$url3 = $WRIS_SinglePhotoDetails['rpggallery_admin_large'];
					?>
					
					<li class="rpg-image-entry" id="rpg_img">
						<a class="gallery_remove rpggallery_remove" href="#gallery_remove" id="rpg_remove_bt" ><img src="<?php echo  WRIS_PLUGIN_URL.'img/Close-icon.png'; ?>" /></a>
						<div class="rpp-admin-inner-div1" >
							<img src="<?php echo $url1; ?>" class="rpg-meta-image" alt=""  style="">
							<input type="hidden" id="unique_string[]" name="unique_string[]" value="<?php echo $UniqueString; ?>" />
							<!--<input type="button" id="upload-background-<?php //echo $UniqueString; ?>" name="upload-background-<?php //echo $UniqueString; ?>" value="Upload Image" class="button-primary " onClick="ris_weblizar_image('<?php //echo $UniqueString; ?>')" />-->
						</div>
						<div class="rpp-admin-inner-div2" >
							<input type="text" id="rpgp_image_url[]" name="rpgp_image_url[]" class="rpg_label_text"  value="<?php echo $url; ?>"  readonly="readonly" style="display:none;" />
							<input type="text" id="rpggallery_admin_thumb[]" name="rpggallery_admin_thumb[]" class="rpg_label_text"  value="<?php echo $url1; ?>"  readonly="readonly" style="display:none;" />
							<input type="text" id="rpggallery_admin_large[]" name="rpggallery_admin_large[]" class="rpg_label_text"  value="<?php echo $url3; ?>"  readonly="readonly" style="display:none;" />
							<p>
								<label>Slide Title</label>
								<input type="text" id="rpgp_image_label[]" name="rpgp_image_label[]" value="<?php echo $name; ?>" placeholder="Enter Slide Title" class="rpg_label_text">
							</p>
							<p>
								<label>Slide Descriptions</label>
								<textarea rows="4" cols="50" id="rpgp_image_desc[]" name="rpgp_image_desc[]" placeholder="Enter Slide Descriptions" class="rpg_label_text"><?php echo $desc; ?></textarea>
							</p>
						</div>
					</li>
					<?php
				} // end of foreach
			} else {
				$TotalImages = 0;
			}
			?>
        </ul>
    </div>
	
	<!--Add New Image Button-->
	<div class="rpg-image-entry add_rpg_new_image" id="rpg_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select" >
		<div class="dashicons dashicons-plus"></div>
		<p>
			<?php _e('Add New Images', RCSL_TEXT_DOMAIN); ?>
		</p>
	</div>
	<div style="clear:left;"></div>
