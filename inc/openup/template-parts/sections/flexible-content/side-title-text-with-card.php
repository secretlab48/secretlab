<?php

//ACF
$title_position = get_sub_field('side_title_text_with_cards_title_position');
$title = get_sub_field('side_title_text_with_cards_title');
$description = get_sub_field('side_title_text_with_cards_description');
$link = get_sub_field('side_title_text_with_cards_link');

?>
<div class="u-bg-primary-blue">
    <section class="o-banner o-banner--programma o-banner--full u-color-primary-dark-blue">
        <div class="container">
            <div class="row justify-content-lg-between align-items-start">
                <?php if ($title): ?>
                    <div class="col-12 col-lg-6 <?= $title_position == 'right' ? 'order-lg-2' : '' ?>">
                        <h2 class="o-banner__title pr-md-3 mb-lg-0"><?php echo $title ?></h2>
                    </div>
                <?php endif; ?>
                <?php if ($description): ?>
                    <div class="col-12 col-lg-6 <?= $title_position == 'right' ? 'order-lg-1' : '' ?>">
                        <div class="o-banner__description mt-lg-4">
                            <div class="c-wysiwyg">
                                <?php echo $description ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div> 
        </div>
    </section>

    <section class="s-image-card pt-0">
        <div class="container">
            <?php
            if (have_rows('side_title_text_with_cards_repeater')): ?>
                <div class="row justify-content-center"> 
                    <?php while (have_rows('side_title_text_with_cards_repeater')): the_row();
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
                                <div class="c-image-card u-bg-secondary-skin u-color-primary-dark-blue <?php if ($enable_image_or_number == 'number' && $number): echo 'c-image-card--sm'; endif;?>">
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
        <?php if ($link) : ?>
        <div class="row">
            <div class="col-12">
                <div class="s-image-card__btn text-center">
                    <a class="c-btn c-btn-primary--dark-blue "
                        href="<?php echo $link['url']?>"
                        target="<?php echo $link['target']; ?>"><?php echo $link['title']?></a>
                </div>
            </div>
        </div>
        <?php endif ?>
        </div>
    </section>
</div>