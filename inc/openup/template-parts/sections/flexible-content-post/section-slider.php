<?php

if (!defined('ABSPATH')) exit;


?>

<section class="s-slider-post c-slider JS-post-slider">
    <?php
    if (have_rows('slider_post')): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php while (have_rows('slider_post')): the_row();
                                $image = get_sub_field('slider_post_item');
                                ?>
            
                                <div class="swiper-slide">
                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                </div>
            
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-slider__nav d-flex justify-content-between align-items-center">
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
</section>
