<?php

/**
 * This function handle the short code
 */
function RCSLShortCode( $Id ) {
	global $post;

	$atts = array( // a few default values
		'posts_per_page' => '3',
		'post_type' => RCSL_SLUG,
	);

	$posts = new WP_Query( $atts );

	ob_start();
    $out = '<div id="slide1_container" class="shadow">
  				<div id="slide1_images">';

    if ($posts->have_posts()) {

        while ($posts->have_posts()) {
            $posts->the_post();

            $out .= get_the_post_thumbnail( $post_id, 'rc_gallery_image', array( 'class' => '' ) );

        } // end while loop

    } else {
        return; // no posts found
    }

    $out .= '</div>
</div>
<p id="slide1_controls"><span class="selected">Image 1</span><span>Image 2</span><span>Image 3</span><span>Image 4</span></p>';

	echo $out;

	return ob_get_clean();
}

add_shortcode( 'RCSL', 'RCSLShortCode' );
