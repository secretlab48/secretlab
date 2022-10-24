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

$section_bg = get_sub_field('card_section_background');
$enable_decoration_image = get_sub_field('card_background_image_enable');
$decoration_image = get_sub_field('card_section_background_image');
$background_wave_enable = get_sub_field('background_wave_enable');

$section_title = get_sub_field('card_section_title');
$section_description = get_sub_field('card_section_description');

$type_of_link = get_sub_field('card_section_type_of_link');
$link = get_sub_field('card_section_link');
$download_file = get_sub_field('card_section_download_file');
$download_link_title = get_sub_field('card_section_download_link_title');

$wave_class = 's-wave--primary-green';

switch ($section_bg) {
    case 'skin':
        $wave_class = 's-wave--primary-skin';
        break;
    case 'blue':
        $wave_class = 's-wave--primary-blue';
        break;
    case 'white':
        $wave_class = 's-wave--primary-white';
        break;
}

?>

<section class="s-image-card s-wave <?php echo $wave_class ?> ">
    <?php if ($enable_decoration_image && $decoration_image) : ?>
        <div class="s-image-card__decoration-img">
            <?php echo wp_get_attachment_image($decoration_image['ID'],'full') ?>
        </div>
    <?php endif; ?>
    <div class="s-wave__inner-wrapper <?= $background_wave_enable ? '' : 'd-none' ?>">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>      
        </svg>
        <?php if ($enable_decoration_image && $decoration_image) : ?>
            <svg class="s-wave__icon icon-bottom icon-bottom--type2 d-none d-md-block">
                <use xlink:href="#wave-bottom-type-2"></use>
            </svg>
            <svg class="s-wave__icon icon-bottom d-md-none">
                <use xlink:href="#wave-bottom-type-3"></use>
            </svg>
        <?php else: ?>
            <svg class="s-wave__icon icon-bottom">
                <use xlink:href="#wave-bottom-type-3"></use>
            </svg>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <?php if ($section_title) : ?>
                <div class="col-md-10 col-lg-8">
                    <div class="c-intro text-center u-color-primary-dark-blue">
                        <h2 class="c-intro__title"><?php echo $section_title; ?></h2>
                        <?php if ($section_description) : ?>
                            <div class="c-intro__description">
                                <?php echo $section_description; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php
        if (have_rows('cards_repeater')): ?>
            <div class="row justify-content-center"> 
                <?php while (have_rows('cards_repeater')): the_row();
                    $enable_image_or_number = get_sub_field('enable_image_or_number');
                    $position_image = get_sub_field('position_image');
                    $image = get_sub_field('card_image');
                    $number = get_sub_field('card_number');
                    $add_checked = get_sub_field('add_checked');
                    $card_title = get_sub_field('card_title');
                    $card_description = get_sub_field('card_description');
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="c-image-card__wrap">
                            <div class="c-image-card c-image-card--sm u-bg-secondary-skin u-color-primary-dark-blue <?php if ($enable_image_or_number == 'number' && $number): echo 'c-image-card--sm'; endif;?> <?php echo $position_image == 'right' ? 'inner-c-image-card__image--right' : 'inner-c-image-card__image--left' ?>">
                                <?php if ($card_title): ?>
                                    <h3 class="c-image-card__title <?= $add_checked ? 'u-check-mark' : '' ?>"><?php echo $card_title; ?></h3>
                                <?php endif; ?>
                                <?php if ($card_description): ?>
                                    <div class="c-image-card__description c-wysiwyg"><?php echo $card_description; ?></div>
                                <?php endif; ?>
                                <?php if ($enable_image_or_number == 'image' && $image): ?>
                                    <div class="c-image-card__image <?= $position_image == 'right' ? 'c-image-card__image--right ' : '' ?>">
                                        <?php echo wp_get_attachment_image($image['ID'],'full') ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($enable_image_or_number == 'number' && $number): ?>
                                    <div class="c-image-card__number">
                                        <p><?php echo $number; ?><span>%</span></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?> 
            </div>
        <?php endif; ?>
        <?php if ($type_of_link == "link" && $link): ?>
            <div class="row">
                <div class="col-12">
                    <div class="s-image-card__btn text-center">
                        <a class="c-btn c-btn-primary--dark-blue"
                           href="<?php echo $link['url'] ?>"
                           target="<?php echo $link['target']; ?>"><?php echo $link['title'] ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($type_of_link == "download" && $download_file && $download_link_title): ?>
            <div class="row">
                <div class="col-12">
                    <div class="s-image-card__btn text-center">
                        <a class="c-btn c-btn-primary--dark-blue"
                           href="<?php echo $download_file['url'] ?>" download><?php echo $download_link_title; ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


