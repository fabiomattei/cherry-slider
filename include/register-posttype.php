<?php
	
$labels = array(
	'name' => _x( 'Cherry Slider', RCSL_TEXT_DOMAIN ),
	'singular_name' => _x( 'Cherry Slider', RCSL_TEXT_DOMAIN ),
	'add_new' => _x( 'Add New Cherry Slider', RCSL_TEXT_DOMAIN ),
	'add_new_item' => _x( 'Add New Cherry Slider', RCSL_TEXT_DOMAIN ),
	'edit_item' => _x( 'Edit Cherry Slider', RCSL_TEXT_DOMAIN ),
	'new_item' => _x( 'New Cherry Slider', RCSL_TEXT_DOMAIN ),
	'view_item' => _x( 'View Cherry Slider', RCSL_TEXT_DOMAIN ),
	'search_items' => _x( 'Search Cherry Slider', RCSL_TEXT_DOMAIN ),
	'not_found' => _x( 'No Cherry Slider found', RCSL_TEXT_DOMAIN ),
	'not_found_in_trash' => _x( 'No Image found in Trash', RCSL_TEXT_DOMAIN ),
	'parent_item_colon' => _x( 'Parent Image:', RCSL_TEXT_DOMAIN ),
	'all_items' => __( 'All Cherry Sliders', RCSL_TEXT_DOMAIN ),
	'menu_name' => _x( 'Cherry Slider', RCSL_TEXT_DOMAIN ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,
	'supports' => array( 'title' ),
	'public' => false,
	'show_ui' => true,
	'show_in_menu' => true,
	'menu_position' => 10,
	'menu_icon' => 'dashicons-format-gallery',
	'show_in_nav_menus' => false,
	'publicly_queryable' => false,
	'exclude_from_search' => true,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => false,
	'capability_type' => 'post'
);

register_post_type( RCSL_TEXT_DOMAIN, $args );

/**
 * Managin columns for post type list in the administration page
 */
function cherry_slider_columns( $columns ){
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Cherry Slider Title', RCSL_TEXT_DOMAIN ),
        'shortcode' => __( 'Slider Shortcode', RCSL_TEXT_DOMAIN ),
        'date' => __( 'Date', RCSL_TEXT_DOMAIN )
    );
    return $columns;
}

add_filter( 'manage_edit-cherry-slider_columns', 'cherry_slider_columns' );

/**
 * Populating columns in the list with the right content in the administration page
 */
function cherry_slider_manage_columns( $column, $post_id ){
    global $post;
    switch( $column ) {
      case 'shortcode' :
        echo '<input type="text" value="[RCSL id='.$post_id.']" readonly="readonly" />';
        break;
      default :
        break;
    }
}

add_action( 'manage_cherry-slider_posts_custom_column', 'cherry_slider_manage_columns' , 10, 2 );


function rcsl_admin_enqueue_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('rpgp-media-uploader-js', RCSL_PLUGIN_URL . 'js/rcsl-media-uploader.js', array('jquery'));
	wp_enqueue_media();
	
	//custom add image box css
	wp_enqueue_style('ris-meta-css', RCSL_PLUGIN_URL.'css/ris-meta.css');
	
	//tool-tip js & css
	wp_enqueue_script('ris-tool-tip-js',RCSL_PLUGIN_URL.'tooltip/jquery.darktooltip.min.js', array('jquery'));
	wp_enqueue_style('ris-tool-tip-css', RCSL_PLUGIN_URL.'tooltip/darktooltip.min.css');
}

add_action('admin_enqueue_scripts', 'rcsl_admin_enqueue_scripts' );
add_action('admin_enqueue_scripts', 'rcsl_admin_enqueue_scripts' );

/**
 * Adding all metaboxes necessasry for the slider
 */
function add_all_cherry_slider_meta_boxes() {
	add_meta_box( __('Add Images', RCSL_TEXT_DOMAIN), __('Add Images', RCSL_TEXT_DOMAIN),  'rcsl_generate_add_image_meta_box_function' , RCSL_SLUG, 'normal', 'low' );
	add_meta_box( __('Apply Setting On Ultimate Responsive Image Slider', RCSL_TEXT_DOMAIN), __('Apply Setting On Ultimate Responsive Image Slider', RCSL_TEXT_DOMAIN), 'rcsl_settings_meta_box_function' , RCSL_SLUG, 'normal', 'low');
	add_meta_box ( __('Copy Image Slider Shortcode', RCSL_TEXT_DOMAIN), __('Copy Image Slider Shortcode', RCSL_TEXT_DOMAIN), 'rcsl_shotcode_meta_box_function' , RCSL_SLUG, 'side', 'low');
}

add_action( 'add_meta_boxes', 'add_all_cherry_slider_meta_boxes' );

/**
 * This function display Add New Image interface
 * Also loads all saved gallery photos into photo gallery
 */
function rcsl_generate_add_image_meta_box_function( $post ) {?>
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
							<a class="gallery_remove rpggallery_remove" href="#gallery_remove" id="rpg_remove_bt" ><img src="<?php echo RCSL_PLUGIN_URL.'img/close-icon.png'; ?>" /></a>
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
				<?php _e('Add New Images', WRIS_TEXT_DOMAIN); ?>
			</p>
		</div>
		<div style="clear:left;"></div>
        <?php
}

function rcsl_settings_meta_box_function( $post ) { 
	require_once( 'rcsl-settings-meta-box.php' );
}

function rcsl_shotcode_meta_box_function() { ?>
	<p><?php _e("Use below shortcode in any Page/Post to publish your slider", RCSL_TEXT_DOMAIN);?></p>
	<input readonly="readonly" type="text" value="<?php echo "[URIS id=".get_the_ID()."]"; ?>">
	<?php 
}

function admin_thumb_uris( $id ) {
		$image  = wp_get_attachment_image_src($id, 'rpggallery_admin_original', true);
        $image1 = wp_get_attachment_image_src($id, 'rpggallery_admin_thumb', true);
        $image3 = wp_get_attachment_image_src($id, 'rpggallery_admin_large', true);
		$UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        ?>
		<li class="rpg-image-entry" id="rpg_img">
			<a class="gallery_remove rpggallery_remove" href="#gallery_remove" id="rpg_remove_bt" ><img src="<?php echo RCSL_PLUGIN_URL.'img/close-icon.png'; ?>" /></a>
			<div class="rpp-admin-inner-div1" >
				<img src="<?php echo $image1[0]; ?>" class="rpg-meta-image" alt=""  style="">
				<!--<input type="button" id="upload-background-<?php //echo $UniqueString; ?>" name="upload-background-<?php //echo $UniqueString; ?>" value="Upload Image" class="button-primary " onClick="ris_weblizar_image('<?php //echo $UniqueString; ?>')" />-->
				</div>
			<div class="rpp-admin-inner-div1" >
				<input type="text" id="rpgp_image_url[]" name="rpgp_image_url[]" class="rpg_label_text"  value="<?php echo $image[0]; ?>"  readonly="readonly" style="display:none;" />
				<input type="text" id="rpggallery_admin_thumb[]" name="rpggallery_admin_thumb[]" class="rpg_label_text"  value="<?php echo $image1[0]; ?>"  readonly="readonly" style="display:none;" />
				<input type="text" id="rpggallery_admin_large[]" name="rpggallery_admin_large[]" class="rpg_label_text"  value="<?php echo $image3[0]; ?>"  readonly="readonly" style="display:none;" />
				<p>
					<label>Slide Title</label>
					<input type="text" id="rpgp_image_label[]" name="rpgp_image_label[]" placeholder="Enter Slide Title Here" class="rpg_label_text">
				</p>
				<p>
					<label>Slide Description</label>
					<textarea rows="4" cols="50" id="rpgp_image_desc[]" name="rpgp_image_desc[]" placeholder="Enter Slide Description Here" class="rpg_label_text"></textarea>
				</p>
			</div>
		</li>
        <?php
    }

function ajax_get_thumbnail_uris() {
    echo admin_thumb_uris( $_POST['imageid'] );
    die;
}
add_action('wp_ajax_uris_get_thumbnail', 'ajax_get_thumbnail_uris' );

function add_image_meta_box_save($PostID) {
if(isset($PostID) && isset($_POST['rpgp_image_url'])) {
		$TotalImages = count($_POST['rpgp_image_url']);
		$ImagesArray = array();
		if($TotalImages) {
			for($i=0; $i < $TotalImages; $i++) {
				$image_label = stripslashes($_POST['rpgp_image_label'][$i]);
				$image_desc = stripslashes($_POST['rpgp_image_desc'][$i]);
				$url = $_POST['rpgp_image_url'][$i];
				$url1 = $_POST['rpggallery_admin_thumb'][$i];
				$url3 = $_POST['rpggallery_admin_large'][$i];
				$ImagesArray[] = array(
					'rpgp_image_label' => $image_label,
					'rpgp_image_desc' => $image_desc,
					'rpgp_image_url' => $url,
					'rpggallery_admin_thumb' => $url1,
					'rpggallery_admin_large' => $url3,
				);
			}
			update_post_meta($PostID, 'ris_all_photos_details', base64_encode(serialize($ImagesArray)));
			update_post_meta($PostID, 'ris_total_images_count', $TotalImages);
		} else {
			$TotalImages = 0;
			update_post_meta($PostID, 'ris_total_images_count', $TotalImages);
			$ImagesArray = array();
			update_post_meta($PostID, 'ris_all_photos_details', base64_encode(serialize($ImagesArray)));
		}
	}
}
add_action('save_post', 'add_image_meta_box_save', 9, 1);

//save settings meta box values
function ris_settings_meta_save($PostID) {
	if(isset($PostID) && isset($_POST['wl_action']) == "wl-save-settings") {

		$RCSL_Slide_Title				=	$_POST['wl-l3-slide-title'];
		$RCSL_Auto_Slideshow			=	$_POST['wl-l3-auto-slide'];
		$RCSL_Sliding_Arrow				=	$_POST['wl-l3-sliding-arrow'];
		$RCSL_Slider_Navigation			=	$_POST['wl-l3-navigation'];
		$RCSL_Navigation_Button			=	$_POST['wl-l3-navigation-button'];
		$RCSL_Slider_Width				=	$_POST['wl-l3-slider-width'];
		$RCSL_Slider_Height				=	$_POST['wl-l3-slider-height'];
		
		$RCSL_Settings_Array = serialize( array(
			'RCSL_Slide_Title'  			=> $RCSL_Slide_Title,
			'RCSL_Auto_Slideshow'  			=> $RCSL_Auto_Slideshow,
			'RCSL_Sliding_Arrow'  			=> $RCSL_Sliding_Arrow,
			'RCSL_Slider_Navigation'  		=> $RCSL_Slider_Navigation,
			'RCSL_Navigation_Button'  		=> $RCSL_Navigation_Button,
			'RCSL_Slider_Width'  			=> $RCSL_Slider_Width,
			'RCSL_Slider_Height'  			=> $RCSL_Slider_Height,
		) );
		
		$RCSL_Gallery_Settings = "RCSL_Settings_".$PostID;
		update_post_meta($PostID, $RCSL_Gallery_Settings, $RCSL_Settings_Array);
	}
}
add_action('save_post', 'ris_settings_meta_save', 9, 1);

