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

$related_posts_title = get_sub_field('related_posts_title');
$related_posts = get_sub_field('related_posts');
?>


<section class="s-related-posts s-wave s-wave--primary-skin JS-double-slider">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="c-intro text-center">
                    <h2 class="c-intro__title u-color-primary-dark-blue"><?php echo $related_posts_title; ?></h2>
                </div>
            </div>
        </div>
        <?php if ($related_posts) : ?>
            <div class="row">
                <div class="col-12 p-0">
                    <div class="c-slider">
                        <div class="c-slider--coverflow">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach ($related_posts as $post) :
                                        setup_postdata($post);
                                        $image = get_the_post_thumbnail();
                                        $read_time = get_field('advanced_post_option_read_time');
                                        $thema_tax = wp_get_post_terms($post->ID, 'thema_areas-taxonomy', array('fields' => 'names'));
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="c-media-card__wrapper">

                                                <a href="<?php the_permalink(); ?>"
                                                   class="c-media-card u-bg-secondary-skin c-media-card--column">
                                                    <div class="c-media-card__img">
                                                        <?php if ($image) : ?>
                                                            <?php echo $image; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="c-media-card__body u-color-primary-dark-blue">
                                                        <h3 class="c-media-card__title u-color-primary-dark-blue">
                                                            <?php echo the_title(); ?>
                                                        </h3>
                                                        <ul class="c-meta-list d-flex align-items-center flex-wrap">
                                                            <li class="c-meta-list__item">
                                                                <svg class="icon">
                                                                    <use xlink:href="#icon-calendar"></use>
                                                                </svg>
                                                                <span class="c-meta-list__text">
                                                                    <?php echo get_the_date(__('j M ‘y')); ?>
                                                                </span>
                                                            </li>
                                                            <?php if ($read_time) : ?>
                                                                <li class="c-meta-list__item">
                                                                    <svg class="icon">
                                                                        <use xlink:href="#icon-watch"></use>
                                                                    </svg>
                                                                    <span class="c-meta-list__text">
                                                                <?php echo $read_time; ?>
                                                            </span>
                                                                </li>
                                                            <?php endif; ?>

                                                            <?php if ($thema_tax) : ?>
                                                                <li class="c-meta-list__item">
                                                                    <svg class="icon">
                                                                        <use xlink:href="#icon-tag"></use>
                                                                    </svg>
                                                                    <?php foreach ($thema_tax as $tax) : ?>
                                                                        <span class="c-meta-list__text c-meta-list__separate">
                                                                        <?php echo $tax; ?>
                                                                    </span>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                    wp_reset_postdata(); ?>
                                </div>
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
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


