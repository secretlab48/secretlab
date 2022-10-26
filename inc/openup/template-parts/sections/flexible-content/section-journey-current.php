<?php

//ACF

$theme = get_sub_field( 'section_journey_current_background' );
$title = get_sub_field( 'section_journey_current_title' );
$description = get_sub_field( 'section_journey_current_description' );
$image = get_sub_field( 'section_journey_current_image' );
$anchor = get_sub_field('section_journey_current_anchor' );
$anchor_html = ( ! empty( $anchor ) ) ? ( 'id="' . $anchor . '"' ) : '';
$slider_items = get_sub_field( 'section_journey_current_slider_slider' );
$slider_date = get_sub_field( 'section_journey_current_slider_date' );
$slider_text = get_sub_field( 'section_journey_current_slider_text' );

$slider_with_image_class = $top_block_start = $top_block_end = '';
if ( ! empty( $image ) ) {
    $slider_with_image_class = "s-journey-slider";
    $top_block_start = '<div class="s-journey-slider__top-box"><div class="s-journey-slider__top-left">';
    $top_block_end = '</div><div class="s-journey-slider__top-right">' . wp_get_attachment_image( $image[ 'ID' ], 'full', false, [ 'class' => 's-journey-slider__image' ] ) . '</div></div>';
}

switch ( $theme ) {
    case 'green' :
        $wrapper_theme_class = 's-wave--primary-green';
        $button_theme_class = 'c-btn-primary--blue';
        break;
    case 'blue' :
        $wrapper_theme_class = 's-wave--primary-blue';
        $button_theme_class = 'c-btn-primary--dark-blue';
        break;
    case 'dark_blue' :
        $wrapper_theme_class = 's-wave--primary-dark-blue';
        $button_theme_class = 'c-btn-primary--blue';
        break;
    case 'skin' :
        $wrapper_theme_class = 's-wave--primary-skin';
        $button_theme_class = 'c-btn-primary--blue';
        break;
    default :
}

?>

<section <?php echo $anchor_html; ?> class="s-journey <?php echo $slider_with_image_class; ?> s-testimonials s-testimonials--image s-wave <?php echo $wrapper_theme_class; ?>">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container text-center">
        <?php echo $top_block_start; ?>
        <h2 class="c-intro__title"><?php echo $title; ?></h2>
        <?php if ( ! empty( $description ) ) : ?>
        <div class="c-intro__description"><?php echo $description; ?></div>
        <?php endif; ?>
        <?php echo $top_block_end; ?>
        <div class="s-single-text__slider s-journey__slider-container">
            <div class="s-journey__slider">
                <div class="swiper-wrapper">
                    <?php foreach ($slider_items as $slider_item): ?>
                        <div class="swiper-slide">
                            <div class="s-journey__slider-item">
                                <div class="s-journey__slider-container">
                                    <div class="s-journey__slider-date">
                                        <?php echo $slider_item['section_journey_current_slider_date']; ?>
                                    </div>
                                    <div class="s-journey__slider-text">
                                        <?php echo $slider_item['section_journey_current_slider_text']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  endforeach; ?>
                </div>
            </div>

            <div class="c-slider__nav-wrapper d-flex justify-content-between align-items-center">
                <div class="c-slider__nav-button c-slider__nav-button--prev">
                    <a href="#" class="c-btn-round c-btn-round--prev <?php echo $button_theme_class; ?>">
                        <svg class="icon-angle">
                            <use xlink:href="#icon-angle-left"></use>
                        </svg>
                    </a>
                </div>
                <div class="c-slider__nav-button c-slider__nav-button--next">
                    <a href="#" class="c-btn-round c-btn-round--next <?php echo $button_theme_class; ?>">
                        <svg class="icon-angle">
                            <use xlink:href="#icon-angle-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
