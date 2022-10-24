<?php
// ACF VARS
$back_link = get_sub_field('boek_consult_card_back_button');
$title = get_sub_field('boek_consult_card_section_title');
?>
<section class="s-popup active">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <header class="s-popup__header d-flex justify-content-center">
                    <?php if ($back_link): ?>
                        <a href="<?php echo $back_link['url'] ?>"
                           class="s-popup__link-back d-flex justify-content-center justify-content-md-start align-items-center u-color-primary-dark-blue">
                            <svg class="icon">
                                <use xlink:href="#icon-angle-left"></use>
                            </svg>
                            <span class="d-none d-md-inline-block"><?php _e('Terug', 'openup'); ?></span>
                        </a>
                    <?php endif; ?>
                    <div class="s-popup__logo-wrapper d-flex align-items-center">
                        <?php the_custom_logo(); ?>
                    </div>
                </header>
            </div>
            <?php if ($title): ?>
                <div class="col-12 col-md-6">
                    <div class="s-popup__intro">
                        <div class="c-intro text-center u-color-primary-dark-blue">
                            <h2 class="c-intro__title">
                                <?php echo $title ?>
                            </h2>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row justify-content-center">
            <?php if (have_rows('boek_consult_cards')): ?>
                <?php while (have_rows('boek_consult_cards')): the_row();
                    //ACF Vars
                    $link = get_sub_field('boek_consult_card_link');
                    $position_image = get_sub_field('boek_consult_card_img_position');
                    $card_description = get_sub_field('boek_consult_card_description');
                    $image = get_sub_field('boek_consult_card_img');
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="c-image-card__wrap">
                            <a href="<?php echo $link['url'] ?>"
                               target="<?php echo $link['target']; ?>"
                               class="c-image-card c-image-card--lg u-bg-secondary-skin u-color-primary-dark-blue">
                                <?php if ($link): ?>
                                    <span class="c-btn-link c-btn-link-primary--dark-blue c-btn-link--more">
                                        <?php echo $link['title']; ?>
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
