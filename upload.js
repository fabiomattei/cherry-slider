$j = jQuery.noConflict();
$j(document).ready(function() {

	/* user clicks button on custom field, runs below code that opens new window */
	$j('#upload_image').click(function() {

		/*Thickbox function aimed to show the media window. This function accepts three parameters:
		*
		* Name of the window: "In our case Upload a Image"
		* URL : Executes a WordPress library that handles and validates files.
		* ImageGroup : As we are not going to work with groups of images but just with one that why we set it false.
		*/
		tb_show('Upload a Image', 'media-upload.php?referer=media_page&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});
	// window.send_to_editor(html) is how WP would normally handle the received data. It will deliver image data in HTML format, so you can put them wherever you want.

	window.send_to_editor = function(html) {
		var image_url = $j('img', html).attr('src');
		$j('#image_path').val(image_url);
		tb_remove(); // calls the tb_remove() of the Thickbox plugin
		$j('#submit_button').trigger('click');
	}

});
