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
$title = get_field('title_chat_bedankt');
$description = get_field('description_chat_bedankt');
$type_of_link = get_field('type_of_link_chat_bedankt');
$link = get_field('link_chat_bedankt');
$download_file = get_field('download_file_chat_bedankt');
$download_link_title = get_field('download_link_title_chat_bedankt');
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
            <?php if ($type_of_link == "link" && ! empty( $link['url'] ) ) : ?>
                <div class="col-12">
                    <div class="s-full-page__btn-wrapper d-flex justify-content-center">
                        <a href="<?php echo $link['url']; ?>"
                           target="<?php echo $link['target']; ?>"
                           class="c-btn c-btn-primary--blue"><?php echo $link['title']; ?></a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($type_of_link == "download" && $download_file && $download_link_title) : ?>
                <div class="col-12">
                    <div class="s-full-page__btn-wrapper d-flex justify-content-center">
                        <a href="<?php echo $download_file['url']; ?>" download class="c-btn c-btn-primary--blue">
                            <?php echo $download_link_title; ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
