<?php
//ACF
$slider_items = get_field('main_hero_slider_slider');
$slider_mode_class = ( count( $slider_items ) == 1 ) ? ' single-image-mode' : '';
?>

<div class="c-main-hero__slider-wrapper">
        <div class="c-main-hero__slider<?php echo $slider_mode_class; ?>">
            <div class="swiper-wrapper">
                <?php foreach ($slider_items as $slider_item): ?>
                    <div class="swiper-slide">
                        <div class="c-main-hero__slider-item">
                                    <?php echo wp_get_attachment_image($slider_item['main_hero_slider_slider_image']['ID'], 'full') ?>
                        </div>
                    </div>
                <?php  endforeach; ?>
            </div>
        <?php if ( count( $slider_items ) > 1 ) : ?>
        <div class="c-slider__nav-wrapper d-flex justify-content-between align-items-center">
            <div class="c-slider__nav-button c-slider__nav-button--prev">
                <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--white">
                    <svg class="icon-angle">
                        <use xlink:href="#icon-angle-left"></use>
                    </svg>
                </a>
            </div>
            <div class="swiper-pagination"></div>
            <div class="c-slider__nav-button c-slider__nav-button--next">
                <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--white">
                    <svg class="icon-angle">
                        <use xlink:href="#icon-angle-right"></use>
                    </svg>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

