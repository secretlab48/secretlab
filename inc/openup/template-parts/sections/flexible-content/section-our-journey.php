<?php

//ACF vars
$imageJourneyStart = get_sub_field('section_our_journey_mage_start');
$imageJourneyStartMob = get_sub_field('section_our_journey_mage_start_mob');
$imageJourneyEnd = get_sub_field('section_our_journey_mage_end');
$imageJourneyEndMob = get_sub_field('section_our_journey_mage_end_mob');
$title = get_sub_field('section_our_journey_title');
$SlidesJourney = get_sub_field('section_our_journey_slider');
?>

<section class="s-our-journey">
    <div class="c-our-journey__background">
        <picture>
            <source srcset="/wp-content/themes/openup/img/global/circle-blue-mob.svg" media="(max-width: 575px)">
            <img src="/wp-content/themes/openup/img/global/circle-blue.svg" alt="background-blue">
        </picture>
    </div>
    <div class="container">
        <div class="c-our-journey__wrapper">
            <div class="c-our-journey__image">
                <picture>
                    <source srcset="<?php echo $imageJourneyStartMob['url']; ?>" media="(max-width: 575px)">
                    <img src="<?php echo $imageJourneyStart['url']; ?>" alt="<?php echo $imageJourneyStart['alt']; ?>">
                </picture>
            </div>
            <div class="c-our-journey__image">
                <picture>
                    <source srcset="<?php echo $imageJourneyEndMob['url']; ?>" media="(max-width: 575px)">
                    <img src="<?php echo $imageJourneyEnd['url']; ?>" alt="<?php echo $imageJourneyEnd['alt']; ?>">
                </picture>
            </div>
            <h2 class="c-intro__title"><?php echo $title; ?></h2>
            <div class="c-our-journey__sliderbox d-flex  justify-content-center">
                <div class="col-xl-7 c-our-journey__thread">
                    <div class="swiper c-our-journey__swiper">
                        <div class="swiper-wrapper">
                            <?php
                            if ($SlidesJourney) {
                                foreach ($SlidesJourney as $SlideJourney) {
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="c-our-journey__slide">
                                            <div class="c-our-journey__slide--month"><?php echo $SlideJourney['section_our_journey_slider_month']; ?></div>
                                            <div class="c-our-journey__slide--info"><?php echo $SlideJourney['section_our_journey_slider_info']; ?></div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <div class="c-slider__nav-wrapper d-flex justify-content-between align-items-center">
                    <div class="c-slider__nav-button c-slider__nav-button--prev">
                        <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--white">
                            <svg class="icon-angle">
                                <use xlink:href="#icon-angle-left"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="c-slider__nav-button c-slider__nav-button--next">
                        <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--white">
                            <svg class="icon-angle">
                                <use xlink:href="#icon-angle-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
