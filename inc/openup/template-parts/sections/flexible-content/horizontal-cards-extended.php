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
$section_title = get_sub_field('card_extended_title');
$section_anchor = get_sub_field('card_extended_anchor');
$section_anchor = ( ! empty( $section_anchor ) ) ? 'id="' . str_replace( '#', '', $section_anchor ) . '"' : '';
$cards = get_sub_field('card_extended_repeater');
?>
<section class="s-horizontal-cards-extended u-bg-secondary-skin">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php if ($section_title) : ?>
                    <h2 <?php echo $section_anchor; ?> class="o-banner__title u-color-primary-dark-blue"><?php echo $section_title; ?></h2>
                <?php endif; ?>
            </div>
        </div>
        <?php
        if(have_rows('card_extended_repeater')):
            $i = 0;
            while (have_rows('card_extended_repeater')): the_row();
                $i++;

                $card_title = get_sub_field('card_extended_title');
                $card_title_checked = get_sub_field( 'card_extended_symbol_checked_to_title' );
                $card_title_checked_class = $card_title_checked ? ' u-check-mark' : '';
                $check_symbol = get_sub_field('card_extended_symbol_checked_to_title' );
                $card_description = get_sub_field('card_extended_description');
                $card_images = get_sub_field('card_extended_images');
                $slider_class = count( $card_images ) > 1 ? ' card_extended__images-slider swiper' : '';
                $card_image = $card_images[0];
                $card_image_position = get_sub_field('card_extended_images_position' );
                $images_aspect_ratio = get_sub_field('card_extended_images_aspect_ratio');
                $button = get_sub_field('card_extended_button');
                switch ( $images_aspect_ratio ) {
                    case 1 :
                        $images_aspect_ratio_class = 'aspect_ratio_1x1';
                        break;
                    case 2 :
                        $images_aspect_ratio_class = 'aspect_ratio_4x3';
                        break;
                    case 3 :
                        $images_aspect_ratio_class = 'aspect_ratio_3x4';
                        break;
                    case 4 :
                        $images_aspect_ratio_class = 'aspect_ratio_16x9';
                        break;
                }

                ?>

                <div class="u-color-primary-dark-blue horizontal-card-extended <?php if ($card_image_position == 'left') echo ' ' . 'horizontal-card-extended--reverse'; ?>">
                    <div class="row">
                        <div class="col-12 col-md-6 order-2 order-md-1 align-self-center">
                            <div class="horizontal-card-extended__body">
                                <?php if ($card_title): ?>
                                    <h5 class="horizontal-card-extended__title<?php echo $card_title_checked_class; ?>"><?php echo $card_title; ?></h5>
                                <?php endif; ?>
                                <?php if ($card_description): ?>
                                    <div class="horizontal-card-extended__description"><?php echo $card_description; ?></div>
                                <?php endif; ?>
                                <?php if ( ! empty( $button ) ) : ?>
                                    <div class="horizontal-card-extended__button">
                                        <a class="c-btn c-btn-primary--blue" href="<?php echo $button[ 'url' ]; ?>"
                                           target="<?php echo $button['target']; ?>"><?php echo $button[ 'title' ]; ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 order-1 order-md-2 horizontal-card-extended__image">
                            <div class="horizontal-card-extended__img-box-container<?php echo ' ' . $images_aspect_ratio_class; ?>">
                                <div class="horizontal-card-extended__images-box aspect_ratio__box <?php echo $slider_class; ?>">
                                    <?php if ( $slider_class != '' ) echo '<div class="swiper-wrapper">'; ?>
                                    <?php foreach( $card_images as $card_image ) : ?>
                                        <div class="horizontal-card-extended__img-box swiper-slide">
                                            <?php echo wp_get_attachment_image($card_image['ID'],'full', "", array( "class" => "horizontal-card-extended__img aspect-rated" )) ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if ( $slider_class != '' ) echo '</div>'; ?>
                                </div>
                                <?php if ( $slider_class != '' ) : ?>
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
                                    <div class="swiper-pagination"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
        endif;
        ?>
    </div>
</section>
