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

//ACF

$theme = get_field( 'theme' );
switch ( $theme ) {
    case 'green' :
        $wrapper_theme_class = 'o-main-hero--green';
        $button_theme_class = 'c-btn-primary--blue';
        break;
    case 'blue' :
        $wrapper_theme_class = 'o-main-hero--blue';
        $button_theme_class = 'c-btn-primary--dark-blue';
        break;
    case 'light' :
        $wrapper_theme_class = '';
        $button_theme_class = 'c-btn-primary--blue';
        break;
    default :
        $wrapper_theme_class = 'u-bg-primary-green';
        $button_theme_class = 'c-btn-primary--blue';
}
$query_type = get_field( 'testimonials_query_type' );
if ( $query_type == 'last' ) {
    $ppp = get_field( 'last_testimonials_quantity' );
    $testimonials = get_posts( array( 'post_type' => 'testimonials', 'posts_per_page' => 5, 'suppress_filter' => false, ) );
}
else if ( $query_type == 'selected' ) {
    $testimonials = get_field( 'select_testimonials' );
}
$cta_text = get_field( 'cta_text' );
$cta_button_text = get_field( 'cta_button_text' );
$cta_link = get_field( 'cta_link' );

?>

<section class="o-main-hero o-main-hero--column u-color-primary-dark-blue o-main-hero--testimonials <?php echo $wrapper_theme_class; ?>">
    <div class="container">
        <div class="row justify-content-md-center justify-content-lg-between">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="s-single-text__slider s-single-text__slider--oval JS-single-text">
                    <div class="swiper-container ">
                        <div class="swiper-wrapper">
                            <?php foreach ($testimonials as $testimonial):

                                get_template_part('template-parts/components/testimonials-slider-with-cta-item', null, [ 'testimonial' => $testimonial ] );

                            endforeach; ?>
                        </div>
                    </div>

                    <div class="c-slider__nav-wrapper d-flex justify-content-between align-items-center">
                        <div class="c-slider__nav-button c-slider__nav-button--prev">
                            <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--white">
                                <svg class="icon-angle">
                                    <use xlink:href="#icon-angle-left"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="c-slider__nav-button c-slider__nav-button--next">
                            <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--white">
                                <svg class="icon-angle">
                                    <use xlink:href="#icon-angle-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="o-main-hero__img-wrap o-main-hero__one-img">
                    <div class="o-main-hero__img-container">
                        <div class="o-main-hero__card">
                            <p class="o-main-hero__card-text">
                                <?php echo $cta_text; ?>
                            </p>
                            <a class="c-btn <?php echo $button_theme_class; ?> d-block" href="<?php echo $cta_link; ?>">
                                <?php echo $cta_button_text; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
