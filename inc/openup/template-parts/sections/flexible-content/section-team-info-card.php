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

//ACF fields
$section_title = get_sub_field('section_team_info_card_title');
$section_description = get_sub_field('section_team_info_card_description');
$section_anchor = get_sub_field('section_team_info_card_anchor');
$section_anchor_html = ( ! empty( $section_anchor ) ) ? 'id="' . $section_anchor . '"' : '';

$teams = custom_get_acf_fc_value( $post->ID, 'flexible_content_page', 'section_team_info_card', 'teams' );
$swiper_class = $swiper_html_start = $swiper_html_end = $swiper_item_class = $swiper_buttons = '';
if ( count( $teams ) > 4 ) {
    $swiper_html_start = '<div class="s-team-list__swiper-container swiper"><div class="swiper-wrapper">';
    $swiper_item_class = 'swiper-slide';
    $swiper_buttons =      '<div class="c-slider__nav-button c-slider__nav-button--prev">
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
                            </div>';
    $swiper_html_end = '</div>' . $swiper_buttons . '</div>';
}
?>
<section class="s-team-list u-bg-secondary-skin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="c-intro text-center u-color-primary-dark-blue">
                    <?php if ($section_title): ?>
                        <h2 class="c-intro__title"> <?php echo $section_title ?></h2>
                    <?php endif; ?>
                    <?php if ($section_description): ?>
                        <div class="c-intro__description">
                            <?php echo $section_description ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="c-filter__contant JS-team-psychologen active">
            <div class="row">
                <div class="col-12 col-12 p-0 pr-md-3 pl-md-3">
                    <?php if (have_rows('teams')) : ?>
                        <div class="s-team-list__container <?php echo $swiper_class; ?> justify-content-left align-items-stretch flex-wrap d-none d-md-flex justify-content-center">
                            <?php echo $swiper_html_start; ?>
                            <?php while (have_rows('teams')): the_row();
                                $team_name = get_sub_field('team_name');
                                $team_foto = get_sub_field('team_foto');
                                $team_position = get_sub_field('team_position');
                                $team_telephone = get_sub_field('team_telephone_number');
                                $team_email = get_sub_field('team_email');
                                ?>
                                <div class="c-team-card__wrap <?php echo $swiper_item_class; ?>">
                                    <div class="c-team-card c-team-card--hover-none">
                                        <div class="c-team-card__img">
                                            <img src="<?php echo $team_foto['url'] ?>"
                                                 alt="<?php echo $team_foto['alt'] ?>"/>
                                        </div>
                                        <div class="c-team-card__body"> 
                                            <?php if ($team_name): ?>
                                                <h6 class="c-team-card__name">
                                                    <?php echo $team_name; ?> 
                                                </h6>
                                            <?php endif; ?> 
                                            
                                            <?php if ($team_position) : ?>
                                                <span class="c-team-card__info"> <?php echo $team_position; ?></span>
                                            <?php endif; ?>
                                            <div>
                                                <?php if ($team_email) : ?>
                                                    <a class="c-team-card__info c-team-card__info--link c-team-card__info--link-email" href="mailto:<?php echo $team_email; ?>"> 
                                                        <?php echo $team_email; ?> 
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($team_telephone) : ?>
                                                    <a class="c-team-card__info c-team-card__info--link" href="tel:<?php echo $team_telephone; ?>">
                                                        <?php echo $team_telephone; ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php echo $swiper_html_end; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (have_rows('teams')) : ?>
                        <div class="s-team__slider-container d-md-none">
                            <div class="c-slider JS-double-slider">
                                <div class="c-slider--coverflow">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php while (have_rows('teams')): the_row();
                                                $team_name = get_sub_field('team_name');
                                                $team_surname = get_sub_field('team_surname');
                                                $team_foto = get_sub_field('team_foto');
                                                $team_position = get_sub_field('team_position');
                                                $team_telephone = get_sub_field('team_telephone_number');
                                                $team_email = get_sub_field('team_email');
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="c-team-card__wrap">
                                                        <div class="c-team-card c-team-card--hover-none">
                                                            <div class="c-team-card__img">
                                                                <?php echo wp_get_attachment_image($team_foto['ID'],'full') ?>
                                                            </div>

                                                            <div class="c-team-card__body"> 
                                                                <?php if ($team_name): ?>
                                                                    <h6 class="c-team-card__name">
                                                                        <?php echo $team_name; ?> 
                                                                    </h6>
                                                                <?php endif; ?> 
                                                                
                                                                <?php if ($team_position) : ?>
                                                                    <span class="c-team-card__info"> <?php echo $team_position; ?></span>
                                                                <?php endif; ?>
                                                                <div>
                                                                    <?php if ($team_email) : ?>
                                                                        <a class="c-team-card__info c-team-card__info--link c-team-card__info--link-email" href="mailto:<?php echo $team_email; ?>"> 
                                                                            <?php echo $team_email; ?> 
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <?php if ($team_telephone) : ?>
                                                                        <a class="c-team-card__info c-team-card__info--link" href="tel:<?php echo $team_telephone; ?>">
                                                                            <?php echo $team_telephone; ?>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>