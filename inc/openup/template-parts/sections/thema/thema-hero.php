<?php
$thema_terms = get_terms([
    'taxonomy' => 'thema_areas-taxonomy',
    'hide_empty' => false,
]);

?>
<section class="s-thema-hero u-color-primary-dark-blue u-bg-secondary-skin">
    <div class="container">
        <div class="row justify-content-center text-md-center">
            <div class="col-md-10 col-lg-8">
                <?php get_template_part('template-parts/sections/banners/thema-hero'); ?>
            </div>
            <div class="col-12">
                <div class="c-thema-filters JS-thema-filters JS-filter-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ($thema_terms as $thema_term): ?>
                                <div class="swiper-slide">
                                    <div class="c-thema-filters__item">
                                        <a class="u-color-primary-dark-blue"
                                        href="#<?=$thema_term->slug?>_<?=$thema_term->term_id?>">
                                        <div class="c-thema-filters__btn">
                                            <div class="c-thema-filters__img-wrap u-bg-primary-white">
                                                <img class="c-thema-filters__img" src="<?php echo esc_url(get_field('thema_areas_icon', $thema_term)['url']); ?>"
                                                alt="<?php echo esc_attr(get_field('thema_areas_icon', $thema_term)['alt']); ?>"/>
                                            </div>
                                            <span class="c-thema-filters__text"><?php echo $thema_term->name ?></span>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>