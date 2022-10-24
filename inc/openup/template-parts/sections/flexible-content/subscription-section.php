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

?>

<section id="subscription" class="s-subscription u-bg-primary-green">
    <div class="s-subscription__bg">
    </div>
    <div class="container">
        <?php if (have_rows('subscription_block')): ?>
            <div class="row justify-content-center justify-content-lg-between">
                <?php
                $i = 0;
                while (have_rows('subscription_block')): the_row();
                    $i++;
                    $subscription_title = get_sub_field('subscription_title');
                    $subscription_link = get_sub_field('subscription_link');
                    $subscription_mark_size = get_sub_field('subscription_mark_size');
                    $subscription_mark_label = get_sub_field('subscription_mark_label');
                    $subscription_mark_price = get_sub_field('subscription_mark_price');

                    ?>
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="c-subscription <?= ($i == 1) ? 'c-subscription--first' : 'c-subscription--wave c-subscription--second' ?>">
                            <?php if ($subscription_title): ?>
                                <h3 class="c-intro__title u-color-primary-white"><?php echo $subscription_title; ?></h3>
                            <?php endif; ?>
                            <?php if (have_rows('subscription_list')): ?>
                                <ul class="c-subscription__list u-color-primary-white">
                                    <?php while (have_rows('subscription_list')): the_row();
                                        $list_item = get_sub_field('list_item');
                                        ?>
                                        <li class="c-subscription__list-item"><?php echo $list_item; ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <?php if ($subscription_link): ?>
                                <div class="c-subscription__btn">
                                    <a href="<?php echo $subscription_link['url']; ?>"
                                       class="c-btn c-btn-primary--blue"
                                       target="<?php echo $subscription_link['target']; ?>">
                                        <?php echo $subscription_link['title']; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if ($subscription_mark_label || $subscription_mark_price): ?>
                                <div class="c-subscription__price">
                                    <div class="c-quality-mark  u-bg-secondary-dark-blue <?= ($subscription_mark_size == 'small') ? 'c-quality-mark--small' : '' ?>">
                                        <label class="c-quality-mark__label c-quality-mark__label--regular">
                                            <?php echo $subscription_mark_label; ?>
                                            <span class="c-subscription__price-text"><?php echo $subscription_mark_price ?></span>
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>