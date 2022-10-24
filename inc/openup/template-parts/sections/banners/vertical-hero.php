<?php
if (!defined('ABSPATH')) exit;

//ACF fields
$hero_title = get_field('vertical_hero_title');
$hero_description = get_field('vertical_hero_description');
$number_image = get_field('number_of_images');
$hero_image = get_field('vertical_hero_image');
$hero_image_two = get_field('vertical_hero_image_two');
?>

<section class="o-main-hero o-main-hero--row u-color-primary-dark-blue">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-8">
                <div class="o-main-hero__container text-center">
                    <?php if ($hero_title) : ?>
                        <h1 class="o-main-hero__title"><?php echo $hero_title; ?></h1>
                    <?php endif; ?>
                    <?php if ($hero_description) : ?>
                        <div class="o-main-hero__description">
                            <?php echo $hero_description; ?>
                        </div>
                    <?php endif; ?>
                    <div class="o-main-hero__btn justify-content-center">
                        <a href="#subscription" class="c-btn-round c-btn-round--down c-btn-primary--white">
                            <svg class="icon">
                                <use xlink:href="#icon-chevron-down"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="o-main-hero__img-wrap <?= $hero_image_two && $number_image == 'two' ? 'o-main-hero__two-img' : 'o-main-hero__one-img' ?>">
                    <div class="o-main-hero__img-container">
                        <?php if ($hero_image) : ?>
                            <div class="o-main-hero__img">
                                <?php echo wp_get_attachment_image($hero_image['ID'],'full') ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($hero_image_two && $number_image == 'two') : ?>
                            <div class="o-main-hero__img">
                                <?php echo wp_get_attachment_image($hero_image_two['ID'],'full') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
