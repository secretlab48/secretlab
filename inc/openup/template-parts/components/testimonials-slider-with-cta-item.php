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
    $logo = '<img src="' . $slider_fields['logo']['sizes']['thumbnail'] . '" title="' . $logo_title . '" alt="' . $logo_alt . '"/>';
}
else {
    $logo = '';
}
$content = get_field( 'testimonial_content', $testimonial->ID );

?>

<div class="swiper-slide">
    <div class="s-testimonials__slide">
        <div class="s-testimonials__text-container">
            <div class="s-testimonials__text">
                <?php echo $content; ?>
            </div>
            <?php if ( $logo && ( strlen( $name ) > 0 || strlen( $position ) > 0 ) ) : ?>
            <div class="d-flex align-items-center s-testimonials__author">
                <div class="s-testimonials__slide-img">
                    <?php echo $logo; ?>
                </div>
                <div class="s-testimonials__author-info">
                    <h3 class="s-testimonials__author-name">
                        <?php echo $name; ?>
                    </h3>
                    <h4 class="s-testimonials__author-desc">
                        <?php echo $position; ?>
                    </h4>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
