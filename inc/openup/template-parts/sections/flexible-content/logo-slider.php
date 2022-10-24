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

//// Sections
//while (has_sub_field('sections')) :
//    ACF_Sections::render(get_row_layout());
//endwhile;


//ACF

$title = get_sub_field('logo_slider_section_title');
$description = get_sub_field('logo_slider_section_description');
$button_link = get_sub_field('logo_slider_section_link');
$button_background_color = get_sub_field('button_background_color');
$button_arrows_background_color = get_sub_field('button_arrows_background_color');
$button_arrows_background_color = ( ! empty( $button_arrows_background_color ) ) ? str_replace( '_', '-', $button_arrows_background_color ) : 'white';
$logos_link = get_sub_field('logo_slider_logos_link');
$bg_color = get_sub_field('background_color' );

?>
<section class="s-logo-slider s-logo-slider--<?php echo $bg_color; ?>">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="c-intro u-color-primary-dark-blue">
                    <?php if ($title): ?>
                        <h2 class="c-intro__title"><?php echo $title ?></h2>
                    <?php endif ?>
                    <?php if ($description): ?>
                        <div class="c-intro__description">
                            <?php echo $description ?>
                        </div>
                    <?php endif ?>
                    <?php if ($button_link): ?>
                    <div class="c-intro__link">
                        <a class="c-btn c-btn-primary--<?php echo str_replace( '_', '-', $button_background_color ); ?>" href="<?php echo $button_link['url']; ?>"
                           target="<?php echo $button_link['target']; ?>"><?php echo $button_link['title']; ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <?php if(have_rows('logos_slider')):  ?>
                    <div class="c-logo-slider c-logo-slider--primary-<?php echo str_replace( '_', '-', $bg_color ); ?> c-slider JS-logo-slider c-logo-slider--grad-left c-logo-slider--grad-right">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php while(have_rows('logos_slider')) : the_row();
                                $logo_img = get_sub_field('logo_item_image');
                                ?>
                                    <div class="swiper-slide">
                                        <div class="c-logo-slider__slide-wrap">
<!--                                            <div class="c-logo-slider__slide">-->
                                                <a class="c-logo-slider__slide-link" href="<?php echo $logos_link['url']; ?>"
                                                   target="<?php echo $logos_link['target']; ?>">
                                                    <?php echo wp_get_attachment_image($logo_img['ID'],'full') ?>
                                                </a>
<!--                                            </div>-->
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="c-slider__nav-button c-slider__nav-button--prev">
                            <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--<?php echo $button_arrows_background_color; ?>">
                                <svg class="icon">
                                    <use xlink:href="#icon-angle-left"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="c-slider__nav-button c-slider__nav-button--next">
                            <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--<?php echo $button_arrows_background_color; ?>">
                                <svg class="icon">
                                    <use xlink:href="#icon-angle-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
