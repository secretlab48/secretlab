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

$id_section = get_field('logo_slider_section_id');
$title = get_field('logo_slider_hero_title');
$description = get_field('logo_slider_hero_description');
$link = get_field('logo_slider_hero_link');
$form = get_field('logo_slider_hero_form');
$type_slider = get_field('logo_slider_hero_type');

?>

<section id="<?= $id_section ? $id_section : '' ?>"
         class="o-main-hero o-main-hero--logo o-main-hero--column o-main-hero--lg u-color-primary-dark-blue <?= $type_slider == 'logo' ? '' : 'o-main-hero--form' ?>">
    <div class="container">
        <div class="row <?= $type_slider == 'logo' ? 'align-items-center' : '' ?> justify-content-lg-between">
            <div class="col-12 col-md-9 col-lg-5">
                <div class="o-main-hero__container u-color-primary-dark-blue">
                    <?php if ($title): ?>
                        <h1 class="o-main-hero__title"><?php echo $title ?></h1>
                    <?php endif ?>
                    <?php if ($description): ?>
                        <div class="o-main-hero__description">
                            <?php echo $description ?>
                        </div>
                    <?php endif ?>
                    <?php if ($link): ?>
                        <div class="o-main-hero__btn">
                            <a class="c-btn c-btn-primary--blue" href="#contactForm"><?php echo $link['title'] ?></a>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <?php if ($type_slider == 'logo'): ?>
                    <div class="o-main-hero__logo-slider">
                        <?php if (have_rows('logotype_slider')): ?>
                            <div class="c-logo-slider c-logo-slider--primary-skin c-slider c-logo-slider--grad-right JS-logo-slider JS-logo-slider-hero">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php while (have_rows('logotype_slider')) : the_row();
                                            $logo_img = get_sub_field('logo_image');
                                            $logo_link = get_sub_field('logo_link');
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="c-logo-slider__slide-wrap">
                                                    <div class="c-logo-slider__slide">
                                                        <a class="c-logo-slider__slide-link"
                                                           href="<?php echo ( isset( $logo_link['url'] ) ? $logo_link['url'] : '' ); ?>">
                                                            <?php echo wp_get_attachment_image($logo_img['ID'], 'full') ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <div class="c-slider__nav-button c-slider__nav-button--prev">
                                    <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--white">
                                        <svg class="icon">
                                            <use xlink:href="#icon-angle-left"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="c-slider__nav-button c-slider__nav-button--next">
                                    <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--white">
                                        <svg class="icon">
                                            <use xlink:href="#icon-angle-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="">
                        <?php if ($form): ?>
                            <?php echo do_shortcode($form); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
