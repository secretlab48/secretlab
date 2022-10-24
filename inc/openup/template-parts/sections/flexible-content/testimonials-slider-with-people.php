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
$testimonials = get_sub_field('testimonial_slider_with_people_slider_section');


?>

<?php if ($testimonials): ?>
    <section class="s-testimonials s-testimonials--quality-mark s-testimonials__client">
        <div class="container text-center">
            <div class="s-single-text__slider JS-testimonial">
                <div class="swiper-container ">
                    <div class="swiper-wrapper">
                        <?php foreach ($testimonials as $testimonial):
                            $testimonial_content = get_field('testimonial_content', $testimonial->ID);
                            $testimonial_name = get_field('slider_fields_with_people_name', $testimonial->ID);
                            $testimonial_font_size = get_field('slider_fields_with_people_font_size', $testimonial->ID);
                            $testimonial_company = get_field('slider_fields_with_people_company', $testimonial->ID);
                            $testimonial_prof = get_field('slider_fields_with_people_position', $testimonial->ID);
                            $testimonial_logo_company = get_field('slider_fields_with_people_logo', $testimonial->ID);
                            $testimonial_photo_people = get_field('slider_fields_with_people_photo_client', $testimonial->ID);
                            $testimonial_background = get_field('slider_fields_with_people_backrgound', $testimonial->ID);
                            $testimonial_background = (!empty($testimonial_background)) ? $testimonial_background : 'green';
                            $testimonial_font_size = (empty($testimonial_font_size) || $testimonial_font_size == 'default') ? '' : 'font-size-' . $testimonial_font_size;
                            ?>
                            <div class="swiper-slide">
                                <div class="s-testimonials__slide u-bg-secondary-<?php echo $testimonial_background; ?>">
                                    <picture>
                                        <source srcset="<?php echo get_template_directory_uri() ?>/img/global/circle-lightgreen-mob.svg"
                                                media="(max-width: 767px)">
                                        <img class="s-testimonials__client-wave"
                                             src="<?php echo get_template_directory_uri() ?>/img/global/elipse_green-horizontal.png"
                                             alt="background-wave">
                                    </picture>
                                    <div class="row justify-content-lg-between">
                                        <div class="s-testimonials__client-content">
                                            <div class="s-testimonials__text <?php echo $testimonial_font_size; ?>">
                                                <?php
                                                    $endpos = 227;
                                                    $endpos=$endpos+strlentag($testimonial_content,$endpos);
                                                    $tmpcontent=mb_strimwidth($testimonial_content, 0, $endpos, "...");
                                                    if(needsubstr($tmpcontent)){
                                                        $tmpcontent=substr($tmpcontent,0,strripos($tmpcontent,"<"))."...";
                                                    }
                                                    echo close_tags($tmpcontent);
                                                ?>
                                            </div>
                                            <?php if ($testimonial_name) { ?>
                                                <div class="s-testimonials__client-content-info"><?php echo $testimonial_name; ?>
                                                    @ <?php echo $testimonial_company; ?></div>
                                            <?php } ?>
                                            <div class="s-testimonials__client-content-prof"><?php echo $testimonial_prof; ?></div>
                                        </div>
                                        <div class="s-testimonials__client-pic">
                                            <?php if ($testimonial_photo_people) { ?>
                                                <div class="s-testimonials__client-photo">
                                                    <?php echo wp_get_attachment_image($testimonial_photo_people['ID'],'full') ?>

                                                    <?php if ($testimonial_logo_company) { ?>
                                                        <div class="s-testimonials__client-company u-bg-primary-white">
                                                            <?php echo wp_get_attachment_image($testimonial_logo_company['ID'],'full') ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="c-slider__nav-wrapper d-flex justify-content-between align-items-center">
                    <div class="c-slider__nav-button c-slider__nav-button--prev">
                        <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--dark-blue">
                            <svg class="icon-angle">
                                <use xlink:href="#icon-angle-left"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="c-slider__nav-button c-slider__nav-button--next">
                        <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--dark-blue">
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