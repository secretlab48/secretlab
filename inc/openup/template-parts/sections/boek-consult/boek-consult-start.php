<?php
//ACF Vars
$section_title = get_field('boek_consult_start_title');
?>

<section class="s-popup active" id="step1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <header class="s-popup__header d-flex justify-content-center">
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
            <?php endif ?>
        </div>
        <div class="row justify-content-center">
            <?php if (have_rows('boek_consult_start_cards_one')): ?>
                <?php while (have_rows('boek_consult_start_cards_one')): the_row();
                    //ACF Vars
                    $link_title = get_sub_field('boek_consult_card_link_title');
                    $position_image = get_sub_field('boek_consult_image_position');
                    $card_description = get_sub_field('boek_consult_card_text');
                    $image = get_sub_field('boek_consult_card_image');
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="c-image-card__wrap">
                            <a href="#step2" class="c-image-card c-image-card--lg u-bg-secondary-skin u-color-primary-dark-blue">
                                <?php if ($link_title): ?>
                                    <span class="c-btn-link c-btn-link-primary--dark-blue c-btn-link--more">
                                        <?php echo $link_title; ?>
                                        <svg class="icon">
                                            <use xlink:href="#icon-arrow-team"></use>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <?php if ($card_description): ?>
                                    <div class="c-image-card__description c-wysiwyg"><?php echo $card_description; ?></div>
                                <?php endif; ?>
                                <?php if ($image): ?>
                                    <div class="c-image-card__image <?= $position_image == 'right' ? 'c-image-card__image--right ' : '' ?>">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if (have_rows('boek_consult_start_cards_two')): ?>
                <?php while (have_rows('boek_consult_start_cards_two')): the_row();
                    //ACF Vars
                    $link_title = get_sub_field('boek_consult_card_link_title');
                    $position_image = get_sub_field('boek_consult_image_position');
                    $card_description = get_sub_field('boek_consult_card_text');
                    $image = get_sub_field('boek_consult_card_image');
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="c-image-card__wrap">
                            <a href="#step4" class="c-image-card c-image-card--lg u-bg-secondary-skin u-color-primary-dark-blue">
                                <?php if ($link_title): ?>
                                    <span class="c-btn-link c-btn-link-primary--dark-blue c-btn-link--more">
                                        <?php echo $link_title; ?>
                                        <svg class="icon">
                                            <use xlink:href="#icon-arrow-team"></use>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <?php if ($card_description): ?>
                                    <div class="c-image-card__description c-wysiwyg"><?php echo $card_description; ?></div>
                                <?php endif; ?>
                                <?php if ($image): ?>
                                    <div class="c-image-card__image <?= $position_image == 'right' ? 'c-image-card__image--right ' : '' ?>">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
