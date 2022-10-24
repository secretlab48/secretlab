<?php

$testimonial = $args['testimonial'];

$permalink = get_permalink( $testimonial->ID );
$slider_fields = get_field( 'slider_fields', $testimonial->ID );
$name = ( $slider_fields['name'] ) ? $slider_fields['name'] : '';
$position = ( $slider_fields['position'] ) ? $slider_fields['position'] : '';
$logo = ( $slider_fields['logo'] ) ? $slider_fields['logo'] : false;
if ( $logo ) {
    $logo_title = get_the_title($logo['ID']);
    $logo_alt = get_post_meta($logo['ID'], '_wp_attachment_image_alt', true);
    $logo_alt = ($logo_alt != '') ? $logo_alt : $logo_title;
    $logo = '<img src="' . $slider_fields['logo']['sizes']['medium'] . '" title="' . $logo_title . '" alt="' . $logo_alt . '"/>';
}
else {
    $logo = '';
}
$content = get_field( 'testimonial_content', $testimonial->ID );

?>

<div class="swiper-slide">
    <div class="s-testimonials__slide">
        <div class="s-testimonials__text-container d-flex flex-column flex-md-row align-items-center">
            <div class="s-testimonials__image">
                <?php echo $logo; ?>
            </div>
            <div class="s-testimonials__text">
                <p>
                    <?php echo $content; ?>
                </p>
                <div class="s-testimonials__author-desc text-center u-color-primary-white">
                    <?php echo $name . ' ' . $position; ?>
                </div>
            </div>
        </div>
    </div>
</div>