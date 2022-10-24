<?php

$section_title = get_field('als_particulier_two_step_title');
$description = get_field('als_particulier_two_step_description');
$link = get_field('als_particulier_two_step_url');
$link_title = get_field('als_particulier_two_step_link_title');

?>

<section class="s-popup" id="step3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <header class="s-popup__header d-flex justify-content-center">
                    <a href="#step2"
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
            <div class="col-12 col-md-6">
                <div class="s-popup__intro">
                    <div class="c-intro text-center u-color-primary-dark-blue">
                        <?php if ($section_title): ?>
                            <h2 class="c-intro__title">
                                <?php echo $section_title ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ($description): ?>
                            <div class="c-intro__description">
                                <?php echo $description ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9 col-xl-7 ">
                <div class="c-intro__btn-wrap d-flex justify-content-center flex-column-reverse flex-lg-row">
                    <?php if ($link): ?>
                        <a href="<?php echo $link['url']?>" class="c-btn-outline c-btn-outline-primary--dark-blue my-1 my-lg-0 mx-lg-3"
                           target="<?php echo $link['target']; ?>"><?php echo $link['title']?></a>
                    <?php endif; ?>
                    <?php if ($link_title):?>
                    <a href="#step6" class="c-btn c-btn-primary--blue my-1 my-lg-0 mx-lg-3"><?php echo $link_title ?></a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
