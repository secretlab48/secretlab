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

$testimonials = get_sub_field('testimonial_quality_slider')

?>

<?php if (get_sub_field('testimonial_quality_slide')): ?>

    <section
            class="s-testimonials s-testimonials--quality-mark s-testimonials--two-col s-wave s-wave--primary-blue">
            <div class="s-wave__inner-wrapper">
                <svg class="s-wave__icon icon-top JS-wave-testimonial--top">
                    <use xlink:href="#wave-top-type-3"></use>
                </svg>
                <svg class="s-wave__icon icon-bottom d-none d-xl-block JS-wave-testimonial--bottom">
                    <use xlink:href="#wave-top-type-3"></use>
                </svg>
                <svg class="s-wave__icon icon-bottom d-xl-none">
                    <use xlink:href="#wave-bottom-type-3"></use>
                </svg>
            </div>

        <div class="container text-center">
            <div class="s-single-text__slider JS-single-text">
                <div class="swiper-container ">
                    <div class="swiper-wrapper align-items-center">
                        <?php while (have_rows('testimonial_quality_slide')) : the_row();
                            $slide_type = get_sub_field('testimonial_quality_slide_type');
                            $testimonial_post = get_sub_field('testimonial_quality_slide');
                            $quality_rounded_items = get_sub_field('testimonial_quality_rounded_items_slide');

                            ?>

                            <?php if ($slide_type == 'rounded_quote' && $quality_rounded_items): ?>
                                <div class="swiper-slide d-flex justify-content-center flex-column flex-md-row align-items-md-start">
                                    <?php while (have_rows('testimonial_quality_rounded_items_slide')) : the_row();
                                        $rounded_item_type = get_sub_field('rounded_item_type');
                                        $rounded_item_first_label = get_sub_field('rounded_item_first_label');
                                        $rounded_item_second_label = get_sub_field('rounded_item_second_label');
                                        $rounded_item_icon = get_sub_field('rounded_item_icon');
                                        $rounded_item_bottom_text = get_sub_field('rounded_item_bottom_text');

                                        ?>
                                        <div class="s-testimonials__slide s-testimonials__slide--quality">
                                            <div class="s-testimonials__quality-wrapper u-color-primary-white">
                                                <?php if ($rounded_item_type == 'text' && $rounded_item_first_label || $rounded_item_second_label) : ?>
                                                    <div class="s-testimonials__quality-label-wrapper">
                                                        <div class="s-testimonials__quality-label-inner-wrapper d-flex align-items-end">
                                                            <?php if ($rounded_item_first_label) : ?>
                                                                <label class="s-testimonials__quality-label"><?php echo $rounded_item_first_label; ?></label>
                                                            <?php endif; ?>
                                                            <?php if ($rounded_item_second_label) : ?>
                                                                <span> <?php echo $rounded_item_second_label ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($rounded_item_type == 'icon' && $rounded_item_icon) : ?>
                                                    <div class="s-testimonials__quality-label-wrapper s-testimonials__quality-label-wrapper--icon">
                                                        <?php echo wp_get_attachment_image($rounded_item_icon['ID'],'full') ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($rounded_item_bottom_text) : ?>
                                                    <div class="s-testimonials__quality-desk">
                                                        <?php echo $rounded_item_bottom_text; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>

                            <?php elseif ($slide_type == 'text_testimonial' && $testimonial_post):
                                $testimonial_content = get_field('testimonial_content', $testimonial_post->ID);
                                $type_quality_top = get_field('testimonial_type_quality_top', $testimonial_post->ID);
                                $quality_top_img = get_field('testimonial_quality_img', $testimonial_post->ID);
                                $quality_top_text = get_field('testimonial_quality_text', $testimonial_post->ID);
                                $quality_bottom = get_field('testimonial_quality_text_bottom', $testimonial_post->ID)

                                ?>
                                <div class="swiper-slide JS-testimonials-slide-label-text">
                                    <div class="s-testimonials__slide">
                                        <div class="s-testimonials__quality-wrapper u-color-primary-dark-blue">
                                            <?php if ($quality_top_text && $type_quality_top == 'text') : ?>
                                                <div class="s-testimonials__quality-label-wrapper">
                                                    <label class="s-testimonials__quality-label"><?php echo $quality_top_text; ?></label>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($quality_top_img && $type_quality_top == 'img') : ?>
                                                <div class="s-testimonials__quality-label-wrapper">
                                                    <?php echo wp_get_attachment_image($quality_top_img['ID'],'full') ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($quality_bottom) : ?>
                                                <div class="s-testimonials__quality-desk">
                                                    <?php echo $quality_bottom; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($testimonial_content) : ?>
                                        <div class="s-testimonials__text-container">
                                            <div class="s-testimonials__text">
                                                <?php echo $testimonial_content ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile ?>
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
    </section>

<?php endif; ?>