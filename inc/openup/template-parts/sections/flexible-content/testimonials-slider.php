<?php

/**
 *  Partial: Sections
 *
 *  Partial for loading Sections via file name using a class extending
 *  ACF's flexible content field.
 *
 * @see       inc/acf/acf-sections.php - Sections class
 * @see       inc/fields/* - Defined fields and Sections
 */

if (!defined('ABSPATH')) exit;


//ACF
$testimonials = get_sub_field('testimonial_slider');
$bg_section = get_sub_field('testimonial_section_background');
$testimonial_mark_enable = get_sub_field('testimonial_mark_enable');
$testimonial_quality_mark = get_sub_field('testimonial_quality_mark');

?>

<?php if ($testimonials): ?>

    <section
            class="s-testimonials s-testimonials--quality-mark s-wave <?= $bg_section == 'green' ? 's-wave--primary-green' : 's-wave--primary-blue'?> ">
        <div class="s-wave__inner-wrapper">
            <svg class="s-wave__icon icon-top">
                <use xlink:href="#wave-top-type-3"></use>
            </svg>
            <svg class="s-wave__icon icon-bottom">
                <use xlink:href="#wave-bottom-type-3"></use>
            </svg>
        </div>

        <div class="container text-center">
            <div class="s-single-text__slider JS-single-text">
                <div class="swiper-container ">
                    <div class="swiper-wrapper">
                        <?php foreach ($testimonials as $testimonial):
                            $testimonial_content = get_field( 'testimonial_content', $testimonial->ID );
                            ?>
                                <div class="swiper-slide">
                                    <div class="s-testimonials__slide">
                                        <div class="s-testimonials__text-container">
                                            <div class="s-testimonials__text">
                                                <?php echo $testimonial_content ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="c-slider__nav-wrapper d-flex justify-content-between align-items-center">
                    <div class="c-slider__nav-button c-slider__nav-button--prev">
                        <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--blue">
                            <svg class="icon-angle">
                                <use xlink:href="#icon-angle-left"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="c-slider__nav-button c-slider__nav-button--next">
                        <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--blue">
                            <svg class="icon-angle">
                                <use xlink:href="#icon-angle-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($testimonial_mark_enable && $testimonial_quality_mark): ?>
            <div class="c-quality-mark u-bg-primary-dark-blue">
                <label class="c-quality-mark__label"><?php echo $testimonial_quality_mark; ?></label>
            </div>
        <?php endif; ?>
    </section>

<?php endif; ?>