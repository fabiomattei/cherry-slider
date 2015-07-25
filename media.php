<?php


// Add the page to the admin menu.
add_action('admin_menu', 'ink_menu_page' );

// Register javascript.
add_action('admin_enqueue_scripts', 'enqueue_admin_js' );

// Add function on admin initalization.
add_action('admin_init', 'ink_options_setup' );

// Call Function to store value into database.
add_action('init', 'store_in_database' );

// Call Function to delete image.
add_action('init', 'delete_image' );

// Add CSS rule.
add_action('admin_enqueue_scripts', 'add_stylesheet' );



/**
* Function will add option page under Appearance Menu.
*/
function ink_menu_page() {
	add_theme_page( 'media_uploader', 'Media Uploader', 'edit_theme_options', 'media_page', 'media_uploader' );
}

//Function that will display the options page.
function media_uploader() {
	global $wpdb;
	$img_path = get_option('ink_image');
	?>

	<form class="ink_image" method="post" action="#">
		<h2> <b>Upload your Image from here </b></h2>
		<input type="text" name="path" class="image_path" value="<?php echo $img_path; ?>" id="image_path">
		<input type="button" value="Upload Image" class="button-primary" id="upload_image"/> Upload your Image from here.
		<div id="show_upload_preview">

			<?php if(! empty($img_path)){
				?>
				<img src="<?php echo $img_path ; ?>">
				<input type="submit" name="remove" value="Remove Image" class="button-secondary" id="remove_image"/>
				<?php } ?>
		</div>
		<input type="submit" name="submit" class="save_path button-primary" id="submit_button" value="Save Setting">

	</form>
	<?php
}

//Call three JavaScript library (jquery, media-upload and thickbox) and one CSS for thickbox in the admin head.

function enqueue_admin_js() {
	wp_enqueue_script('media-upload'); //Provides all the functions needed to upload, validate and give format to files.
	wp_enqueue_script('thickbox'); //Responsible for managing the modal window.
	wp_enqueue_style('thickbox'); //Provides the styles needed for this window.
	wp_enqueue_script('script', plugins_url('upload.js', __FILE__), array('jquery'), '', true); //It will initialize the parameters needed to show the window properly.
}

//Function that will add stylesheet file.
function add_stylesheet(){
	wp_enqueue_style( 'css/style-admin', plugins_url( 'stylesheet.css', __FILE__ ));
}

// Here it check the pages that we are working on are the ones used by the Media Uploader.
function ink_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		// Now we will replace the 'Insert into Post Button inside Thickbox'
		add_filter('gettext', 'replace_window_text' , 1, 2);
		// gettext filter and every sentence.
	}
}

/*
* Referer parameter in our script file is for to know from which page we are launching the Media Uploader as we want to change the text "Insert into Post".
*/
function replace_window_text($translated_text, $text) {
	//echo 'fabio'.$translated_text;
	if ('Insert into Post' == $text) {
		$referer = strpos(wp_get_referer(), 'media_page');
		if ($referer != '') {
			return __('Upload Image', 'ink');
		}
	}
	return $translated_text;
}

// The Function store image path in option table.
function store_in_database(){
	if(isset($_POST['submit'])){
		$image_path = $_POST['path'];
		update_option('ink_image', $image_path);
	}
}

// Below Function will delete image.
function delete_image() {
	if(isset($_POST['remove'])){
		global $wpdb;
		$img_path = $_POST['path'];

		// We need to get the images meta ID.
		$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($img_path) . "' AND post_type = 'attachment'";
		$results = $wpdb->get_results($query);

		// And delete it
		foreach ( $results as $row ) {
			wp_delete_attachment( $row->ID ); //delete the image and also delete the attachment from the Media Library.
		}
		delete_option('ink_image'); //delete image path from database.
	}
}
