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

$title = get_sub_field( 'title' );
$description = get_sub_field( 'description' );
$anchor = get_sub_field( 'anchor' );
$anchor_html = ( ! empty( $anchor ) ) ? 'id="' . $anchor . '"' : '';
$bg_color = get_sub_field( 'background_color' );
$bg_color = str_replace( '_', '-', $bg_color );
$text_color = ( $bg_color == 'skin' ) ? 'dark-blue' : 'white';
$list = get_sub_field( 'list' );
$calendly_html = get_sub_field( 'calendly_html' );

?>

<section <?php echo $anchor_html; ?> class="s-calendly u-bg-primary-<?php echo $bg_color; ?> u-color-primary-<?php echo $text_color; ?>" >
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between">
            <div class="s-calendly__text-content-box col-12 col-md-6 col-lg-6">
                <h2 class="c-intro__title"><?php echo $title; ?></h2>
                <div class="c-thema-card__description"><?php echo $description; ?></div>
                <?php
                if ( ! empty( $list ) && count( $list ) > 0 ) :
                ?>
                <ul class="c-subscription__list">
                    <?php
                    foreach ( $list as $i => $list_item ) :
                    ?>
                    <li class="c-subscription__list-item"><?php echo $list_item[ 'item' ]; ?></li>
                    <?php
                    endforeach;
                    ?>
                </ul>
                <?php
                endif;
                ?>
            </div>
            <div class="s-calendly__entity-box col-12 col-md-6 col-lg-6">
                <div class="s-calendly__entity">
                    <?php echo $calendly_html; ?>
                </div>
            </div>
        </div>
    </div>
</section>