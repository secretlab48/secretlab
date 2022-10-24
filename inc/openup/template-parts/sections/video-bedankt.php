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

//ACF fields
$title = get_field('title_video_bedankt');
$description = get_field('description_video_bedankt');
$first_link = get_field('first_link_video_bedankt');
$second_link = get_field('second_link_video_bedankt');

?>

<section class="s-full-page">
    <div class="container">
        <div class="row justify-content-center align-items-center flex-column">
            <div class="col-12">
                <div class="s-full-page__logo-wrapper d-flex justify-content-center">
                    <?php the_custom_logo(); ?>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="c-intro text-center u-color-primary-dark-blue">
                    <?php if ($title) : ?>
                        <h2 class="c-intro__title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <div class="c-intro__description c-wysiwyg">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-md-7 col-lg-9 col-xl-7 ">
                <div class="s-full-page__btn-wrapper d-flex justify-content-center">
                    <div class="c-intro__btn-wrap d-flex justify-content-center flex-column-reverse flex-lg-row">
                        <?php if ($first_link) : ?>
                            <a href="<?php echo $first_link['url']; ?>"
                               target="<?php echo $first_link['target']; ?>"
                               class="c-btn-outline c-btn-outline-primary--dark-blue my-1 my-lg-0 mx-lg-3">
                                <?php echo $first_link['title']; ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($second_link) : ?>
                        <a href="<?php echo $second_link['url']; ?>"
                           class="c-btn c-btn-primary--blue my-1 my-lg-0 mx-lg-3">
                            <?php echo $second_link['title']; ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>