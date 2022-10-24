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

$section_bg = get_sub_field('card_with_link_background');
$section_title = get_sub_field('card_with_link_title');
$section_description = get_sub_field('card_with_link_description');
$link = get_sub_field('card_with_link__link');
?>

<section class="s-image-card s-image-card--wide <?php echo $section_bg == 'pink' ? 'u-bg-primary-skin ' : 'u-bg-secondary-skin' ?> ">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <?php if ($section_title) : ?>
                <div class="col-md-10 col-lg-8">
                    <div class="c-intro text-center u-color-primary-dark-blue">
                        <h2 class="c-intro__title"><?php echo $section_title; ?></h2>
                        <?php if ($section_description) : ?>
                            <div class="c-intro__description">
                                <p><?php echo $section_description; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php
        if (have_rows('card_with_link_repeater')): ?>
            <div class="row justify-content-center"> 
                <?php while (have_rows('card_with_link_repeater')): the_row();
                    $image = get_sub_field('card_image');
                    $card_title = get_sub_field('card_title');
                    ?>
                    <div class="col-12 col-md-6 col-lg-5">
                        <div class="c-image-card__wrap">
                            <div class="c-image-card u-bg-secondary-skin u-color-primary-dark-blue">
                                <h3 class="c-image-card__title"><?php echo $card_title ?></h3>
                                <?php if (have_rows('card_description')) : ?>
                                    <?php while (have_rows('card_description')): the_row();
                                        $card_link = get_sub_field('card_link');
                                        ?>
                                        <div class="c-image-card__link">
                                            <a href="<?php echo $card_link['url']; ?>"
                                               target="<?php echo $card_link['target']; ?>" class="c-btn-link c-btn-link-primary--dark-blue c-btn-link--more">
                                                <?php echo $card_link['title']; ?>
                                                <svg class="icon">
                                                    <use xlink:href="#icon-arrow-team"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php if ($image): ?>
                                    <div class="c-image-card__image c-image-card__image--right">
                                        <?php echo wp_get_attachment_image($image['ID'],'full') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?> 
            </div>
        <?php endif; ?>
        <?php if ($link): ?>
            <div class="row">
                <div class="col-12">
                    <div class="s-image-card__btn d-flex justify-content-center">
                        <a class="c-btn c-btn-primary--dark-blue"
                           href="<?php echo $link['url'] ?>"
                           target="<?php echo $link['target']; ?>"><?php echo $link['title'] ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


