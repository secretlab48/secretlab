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
$intro_text = get_field('intro_text','option');

?>

<section class="s-row-logo u-bg-secondary-skin">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap flex-xl-nowrap align-items-center justify-content-center justify-content-xl-between">
                <p class="s-row-logo__text u-color-primary-dark-blue">
                    <?php echo $intro_text; ?>
                </p>
                <?php if (have_rows('logos', 'option')): ?>
                    <div class="s-row-logo__icon-wrap d-flex justify-content-center flex-wrap">
                        <?php while (have_rows('logos', 'option')): the_row();
                            $logo_image = get_sub_field('logo_image', 'option');
                            $logo_link = get_sub_field('logo_link', 'option');
                        ?>
                            <div class="s-row-logo__icon-inner">
                                <a href="<?php echo $logo_link['url']; ?>" class="s-row-logo__icon-link"
                                   target="<?php echo $logo_link['target']; ?>">
                                    <?php echo wp_get_attachment_image($logo_image['ID'],'full') ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
