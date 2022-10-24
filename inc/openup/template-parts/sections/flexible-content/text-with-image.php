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

$sect_twi_title = get_sub_field('section_text_with_image_title');
$sect_twi_description = get_sub_field('section_text_with_image_description');
$sect_twi_image = get_sub_field('section_text_with_image_image');
$sect_twi_position = get_sub_field('section_text_with_image_position');
?>

<section>
    <div class="container">
        <div class="c-thema-card s-text-image <?php echo $sect_twi_position == 'right' ? ' ' : 'c-thema-card--reverse' ?>">
            <div class="row ">
                <div class="col-12 col-md-6 order-2 order-md-1 align-self-center">
                    <?php if ($sect_twi_title): ?>
                        <h5 class="c-thema-card__title"><?php echo $sect_twi_title; ?></h5>
                    <?php endif; ?>
                    <?php if ($sect_twi_description): ?>
                        <div class="c-thema-card__description"><?php echo $sect_twi_description; ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-2">
                    <?php if ($sect_twi_image): ?>
                        <?php echo wp_get_attachment_image($sect_twi_image['ID'],'full', "", array( "class" => "c-thema-card__img" )) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>