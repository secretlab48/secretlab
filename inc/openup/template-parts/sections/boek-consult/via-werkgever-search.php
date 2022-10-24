<?php

global $wp_query;
$page_id = $wp_query->post->ID;

$section_title = get_field('via_werkgever_two_step_title'); ?>

<section class="s-popup" id="step5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <header class="s-popup__header d-flex justify-content-center">
                    <a href="#step4"
                       class="s-popup__link-back d-flex justify-content-center justify-content-md-start align-items-center u-color-primary-dark-blue">
                        <svg class="icon">
                            <use xlink:href="#icon-angle-left"></use>
                        </svg>
                        <span class="d-none d-md-inline-block"><?php _e('Terug', 'openup'); ?></span>
                    </a>
                    <div class="s-popup__logo-wrapper d-flex align-items-center">
                        <?php the_custom_logo(); ?>
                    </div>
                </header>
            </div>
            <?php if ($section_title): ?>
                <div class="col-12 col-md-6">
                    <div class="s-popup__intro">
                        <div class="c-intro text-center u-color-primary-dark-blue">
                            <h2 class="c-intro__title">
                                <?php echo $section_title ?>
                            </h2>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                <div class="c-search-filter JS-faq-search u-color-primary-dark-blue" id="close-tag1">
                    <div class="c-search-filter__header">
                        <input type="text" class="c-search-filter__input JS-consult-search"
                               data-page-id="<?php echo $page_id ?>" placeholder="Search"/>
                        <a  class="c-btn-round c-btn-round--more c-btn-primary--blue JS-serch-link"  target="_blank">
                            <svg class="icon">
                                <use xlink:href="#icon-arrow-next"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="JS-search-list">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="s-popup__search-img-wrapper">
                    <img src="<?php echo get_template_directory_uri() ?>/img/media/men-media.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
