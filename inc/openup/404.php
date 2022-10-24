<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package openup
 */

//ACF fields
$title = get_field('title_404', 'options');
$image = get_field('image_404', 'options');
$link = get_field('link_404', 'options');

get_header();

?>

<main id="main" role="main" tabindex="-1">

    <section class="s-full-page">
        <div class="container">
            <div class="row justify-content-center align-items-center flex-column">
                <div class="col-12">
                    <div class="s-full-page__logo-wrapper d-flex justify-content-center">
                        <?php the_custom_logo(); ?>
                    </div>
                </div>
                <?php if ($title): ?>
                    <div class="col-12 col-md-6">
                        <div class="c-intro text-center u-color-primary-dark-blue">
                            <h2 class="c-intro__title">
                                <?php echo $title; ?>
                            </h2>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($image): ?>
                    <div class="col-12">
                        <div class="s-popup__img-wrap">
                            <?php echo wp_get_attachment_image($image['ID'], 'full') ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($link): ?>
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <a href="<?php echo $link['url'] ?>" class="c-btn c-btn-primary--blue" target="<?php echo $link['target']; ?>">
                            <?php echo $link['title']; ?></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php
get_footer(); ?>
