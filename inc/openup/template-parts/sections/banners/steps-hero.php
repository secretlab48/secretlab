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
//ACF fields
$section_title = get_field('steps_hero_title');
$section_description = get_field('steps_hero_description');
$step_mark_enabled = get_field('step_mark_enabled');
$step_mark = get_field('step_mark');
$type_step_bullets = get_field('type_step_bullets');
?>
<section class="s-steps s-steps--quality-mark s-wave s-wave--primary-green u-color-primary-white">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon s-wave__icon-type-3 icon-bottom d-none d-md-block">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>

        <svg class="s-wave__icon s-wave__icon-type-2 icon-bottom d-block d-md-none">
            <use xlink:href="#wave-bottom-type-2"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="c-intro">
                    <?php if ($section_title) : ?>
                        <h2 class="c-intro__title"><?php echo $section_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($section_description) : ?>
                        <div class="c-intro__description c-wysiwyg">
                            <?php echo $section_description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (have_rows('steps_hero_steps')): ?>
                <div class="col-12 col-md-6">
                    <ul class="c-step-list <?= $type_step_bullets == 'checked' ? 'c-step-list--checked' : 'c-step-list--numeric JS-step-list-numeric'?>">
                        <?php while (have_rows('steps_hero_steps')): the_row();
                            $steps_title = get_sub_field('steps_title');
                            $type_item = get_sub_field('type_item');
                            $link = get_sub_field('steps_link');
                            $steps_description = get_sub_field('steps_description');
                            ?>
                            <li class="c-step-list__item">
                                <span class="c-step-list__item-checkmark"></span>
                                <span>
                                    <?php if ($steps_title) : ?>
                                        <h5 class="c-step-list__item-title"><?php echo $steps_title; ?></h5>
                                    <?php endif; ?>
                                    <?php if ($steps_description && $type_item == 'text') : ?>
                                        <p class="c-step-list__item-info"><?php echo $steps_description; ?></p>
                                    <?php endif; ?>
                                    <?php if ($link && $type_item == 'link') : ?>
                                        <div class="c-step-list__link-more">
                                            <a href="<?php echo $link['url']?>" class="c-btn-link c-btn-link-primary--white c-btn-link--more"
                                               target="<?php echo $link['target']; ?>">
                                                <?php echo $link['title']?> 
                                                <svg class="icon">
                                                    <use xlink:href="#icon-arrow-team"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($step_mark_enabled && $step_mark) : ?>
        <div class="c-quality-mark u-bg-primary-dark-blue">
            <label class="c-quality-mark__label">
                <?php echo $step_mark; ?>
            </label>
        </div>
    <?php endif; ?>
</section>
