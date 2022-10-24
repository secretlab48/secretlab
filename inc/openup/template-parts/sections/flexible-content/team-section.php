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

global $post;
//ACF Fields

$title = get_sub_field('teams_section_title');
$teams = get_sub_field('teams');

?>

<section class="s-team-list u-bg-secondary-skin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="s-team-list__title u-color-primary-dark-blue text-center">
                   <?php echo $title; ?>
                </h2>
            </div>
        </div>
        <div class="c-filter__contant JS-team-psychologen active">
            <div class="row">
                <div class="col-12 col-12 p-0 pr-md-3 pl-md-3">
                    <div class="s-team-list__container justify-content-left align-items-stretch flex-wrap d-none d-md-flex">
                        <?php if ($teams) : ?>

                            <?php foreach ($teams as $team):
                                openup_render_team_slider_card( $team );
                            endforeach; ?>

                            <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="s-team__slider-container d-md-none">
                        <div class="c-slider JS-double-slider">
                            <div class="c-slider--coverflow">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php if ($teams) : ?>
                                            <?php foreach ($teams as $team):
                                                echo '<div class="swiper-slide">';
                                                openup_render_team_slider_card( $team );
                                                echo '</div>';
                                            endforeach; ?>

                                            <?php wp_reset_postdata(); ?>
                                        <?php else: ?>
                                            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>