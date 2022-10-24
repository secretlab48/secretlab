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
$theme_category_section_heading = get_sub_field('theme_category_section_heading');
$theme_category_section_description = get_sub_field('theme_category_section_description');
$theme_category_section_image = get_sub_field('theme_category_section_image');
?>

<section class="s-two-column s-wave s-wave--primary-green">  
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon s-wave__icon-type-2 icon-bottom">
            <use xlink:href="#wave-bottom-type-2"></use>
        </svg> 
    </div>

    <div class="container">
        <div class="row justify-content-md-between">
            <div class="col-12 col-lg-4 order-2 order-lg-1">
                <?php if ($theme_category_section_image) : ?>
                <div class="s-two-column__img-box text-left">
                    <?php echo wp_get_attachment_image($theme_category_section_image['ID'],'full') ?>
                </div>
                <?php endif; ?>
            </div> 
            <div class="col-12 col-lg-7 order-1 order-lg-2">

                <div class="c-intro u-color-primary-white c-wysiwyg">
                    <?php if ($theme_category_section_heading) : ?>
                    <h2 class="c-intro__title"><?php echo $theme_category_section_heading; ?></h2>
                    <?php endif; ?>
                    <?php if ($theme_category_section_description) : ?>
                    <div class="c-intro__description">
                        <p><?php echo $theme_category_section_description; ?></p>
                    </div>
                    <?php endif; ?>
                </div> 
 
                <div class="s-two-column-slider d-md-none JS-logo-slider JS-two-column-slider c-slider c-logo-slider--grad-right">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">  
                            <div class="swiper-slide d-flex flex-wrap"> 
                            <?php
                                $args = array(
                                    'taxonomy' => 'thema_areas-taxonomy',
                                    'hide_empty' => false,
                                    'parent' => 0,
                                );

                                $terms = get_terms($args);
                                if ($terms && !is_wp_error($terms)) {

                                    foreach ($terms as $term) {
                                        $link = get_field('thema_areas_link', $term);
                                        ?>
                                            <div class="s-two-column-slider__slide">  
                                                <a href="<?php echo $link['url'] ?>"
                                                class="c-btn-secondary c-btn-secondary--green">
                                                    <?php echo $term->name; ?>
                                                </a>
                                            </div>
                                    <?php }
                                }
                                ?>  
                            </div>
                        </div>
                    </div> 
                </div>   
                <ul class="s-two-column__list d-none d-md-flex flex-wrap"> 
                    <?php
                        $args = array(
                            'taxonomy' => 'thema_areas-taxonomy',
                            'hide_empty' => false,
                            'parent' => 0,
                        );

                        $terms = get_terms($args);
                        if ($terms && !is_wp_error($terms)) {

                            foreach ($terms as $term) {
                                $link = get_field('thema_areas_link', $term);
                                ?>
                                <li class="s-two-column__item">
                                    <a href="<?php echo $link['url'] ?>"
                                    class="c-btn-secondary c-btn-secondary--green">
                                        <?php echo $term->name; ?>
                                    </a>  
                                </li> 
                            <?php }
                        }
                    ?>   
                </ul>  
            </div>
        </div>
    </div>
</section>