<?php

/**
 * Load All RCSL Custom Post Type
 */
$IG_CPT_Name = "ris_gallery";
$atts = array( // a few default values
    'posts_per_page' => '3',
    'post_type' => RCSL_SLUG
);
$loop = new WP_Query( $atts );

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

while ( $loop->have_posts() ) : $loop->the_post();
    //get the post id
    $post_id = get_the_ID();

                $Title = get_the_title();
                $Desc = get_the_content();
                $i++;
                ?>
                <li>
                    <a href="#slide<?php echo $i; ?>">
                        <?php echo get_the_post_thumbnail( $post_id, 'rc_gallery_image', array( 'class' => 'imgclass', 'title' => '' ) ) ?>
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

<?php endwhile; ?>
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