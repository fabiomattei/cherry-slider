
jQuery(document).ready(function() {
    jQuery('#slide1_controls').on('click', 'span', function(){
        jQuery("#slide1_images").css("transform","translateX("+jQuery(this).index() * -450+"px)");
        jQuery("#slide1_controls span").removeClass("selected");
        jQuery(this).addClass("selected");
    });
});
