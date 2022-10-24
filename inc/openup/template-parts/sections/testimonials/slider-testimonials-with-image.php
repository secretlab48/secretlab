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

$theme = get_field( 'theme_ts' );
switch ( $theme ) {
    case 'green' :
        $wrapper_theme_class = 's-wave--primary-green';
        $button_theme_class = 'c-btn-primary--blue';
        break;
    case 'blue' :
        $wrapper_theme_class = 's-wave--primary-blue';
        $button_theme_class = 'c-btn-primary--dark-blue';
        break;
    default :
        $wrapper_theme_class = 's-wave--primary-green';
        $button_theme_class = 'c-btn-primary--blue';
}
$query_type = get_field( 'testimonials_query_type_ts' );
if ( $query_type == 'last' ) {
    $ppp = get_field( 'last_testimonials_quantity' );
    $testimonials = get_posts( array( 'post_type' => 'testimonials', 'posts_per_page' => 5, 'suppress_filter' => false, ) );
}
else if ( $query_type == 'selected' ) {
    $testimonials = get_field( 'select_testimonials_ts' );
}

?>

<section class="s-testimonials s-testimonials--image s-wave <?php echo $wrapper_theme_class; ?>">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>

    <div class="container text-center">
        <div class="s-single-text__slider JS-single-text">
            <div class="swiper-container ">
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $testimonial):

                        get_template_part('template-parts/components/testimonials-slider-item', null, [ 'testimonial' => $testimonial ] );

                    endforeach; ?>
                </div>
            </div>

            <div class="c-slider__nav-wrapper d-flex justify-content-between align-items-center">
                <div class="c-slider__nav-button c-slider__nav-button--prev">
                    <a href="#" class="c-btn-round c-btn-round--prev <?php echo $button_theme_class; ?>">
                        <svg class="icon-angle">
                            <use xlink:href="#icon-angle-left"></use>
                        </svg>
                    </a>
                </div>
                <div class="c-slider__nav-button c-slider__nav-button--next">
                    <a href="#" class="c-btn-round c-btn-round--next <?php echo $button_theme_class; ?>">
                        <svg class="icon-angle">
                            <use xlink:href="#icon-angle-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
