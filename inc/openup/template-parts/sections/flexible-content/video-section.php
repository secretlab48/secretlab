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

$section_bg = get_sub_field('video_section_background');
$section_title = get_sub_field('video_section_title');
$section_anchor = get_sub_field('video_section_anchor');
$section_anchor_html = ( ! empty( $section_anchor ) ) ? 'id="' . $section_anchor . '"' : '';
$section_description = get_sub_field('video_section_description');
$section_video = get_sub_field('video_section_video');

$wave_class = 'u-bg-primary-skin';

switch ($section_bg) {
    case 'white':
        $wave_class = 'u-bg-primary-white';
        break;
}
?>

<section <?php echo $section_anchor_html; ?> class="s-video u-bg-primary-skin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="c-intro text-center u-color-primary-dark-blue">
                    <?php if ($section_title) : ?>
                        <h2 class="c-intro__title"><?php echo $section_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($section_description) : ?>
                        <div class="c-intro__description">
                            <?php echo $section_description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($section_video) : ?>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="c-embed__wrapper">
                        <div class="c-embed__container">
                            <?php echo $section_video; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


