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

$sect_twil_title = get_sub_field('section_text_with_image_and_link_title');
$sect_twil_description = get_sub_field('section_text_with_image_and_link_description');
$sect_twil_image = get_sub_field('section_text_with_image_and_link_image');
$sect_twil_link = get_sub_field('section_text_with_image_and_link_link');
$sect_twil_bg = get_sub_field('section_text_with_image_and_link_background');
$sect_twil_fontsize = get_sub_field('section_text_with_image_and_link_title_size');
$sect_twil_reverse = get_sub_field('section_text_with_image_and_link_image_reverse');
$sect_twil_bg = ( ! empty( $sect_twil_bg ) ) ? str_replace( '_', '-', $sect_twil_bg ) : 'green';
$sect_twil_color = $sect_twil_bg == 'skin' ? 'u-color-primary-dark-blue' : 'u-color-primary-white';
$sect_twil_btn = $sect_twil_bg == 'blue' ? 'c-btn-primary--dark-blue' : 'c-btn-primary--blue';
$sect_twil_fontsize = $sect_twil_fontsize == 'default' ? '' : 'font-size-'.$sect_twil_fontsize.'-decreased';
?>


<section class="s-two-column s-two-column--cta s-wave s-wave--primary-<?php echo $sect_twil_bg ?>">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon s-wave__icon-type-2 icon-bottom <?php if($sect_twil_reverse){?>icon-bottom-reverse<?php } ?>">
            <use xlink:href="#wave-bottom-type-2"></use>
        </svg>
    </div>

    <div class="container">
        <div class="row justify-content-md-between <?php if($sect_twil_reverse){?>flex-row-reverse<?php } ?>">
            <div class="col-12 col-lg-4 order-2 order-lg-1">
                <div class="s-two-column__img-box text-left">
                    <?php if ($sect_twil_image): ?>
                        <?php echo wp_get_attachment_image($sect_twil_image['ID'],'full') ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-7 order-1 order-lg-2">
                <div class="c-intro  <?php echo $sect_twil_color; ?>">
                    <?php if ($sect_twil_title): ?>
                        <h2 class="c-intro__title <?php echo $sect_twil_fontsize; ?>">
                            <?php echo $sect_twil_title; ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ($sect_twil_description): ?>
                        <div class="c-intro__description">
                            <?php echo $sect_twil_description; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($sect_twil_link): ?>
                        <div class="c-intro__link">
                            <a class="c-btn <?php echo $sect_twil_btn; ?>"
                               href="<?php echo $sect_twil_link['url']; ?>"
                               target="<?php echo $sect_twil_link['target']; ?>">
                                <?php echo $sect_twil_link['title']; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
