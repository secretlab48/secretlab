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
$section_title = get_sub_field('steps_section_title');
$section_description = get_sub_field('steps_section_description');
$download_file = get_sub_field('steps_section_file_download');
$link_title = get_sub_field('steps_section_file_download_title');
$steps = get_sub_field('steps_section_steps');

?>

<section class="s-steps s-wave s-wave--primary-blue u-color-primary-dark-blue">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="c-intro">

                    <?php if ( $download_file && $link_title) : ?>
                        <div class="c-intro__btn d-flex d-md-none">
                            <a href="<?php echo $download_file['url']; ?>" download
                               class="c-btn c-btn-primary--dark-blue">
                                <?php echo $link_title ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="c-wysiwyg">
                    <?php if ($list_description) : ?>
                        <div class="s-info__title">
                            <?php echo $list_description; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (have_rows('section_list_list')) : ?>
                        <ul>
                            <?php while (have_rows('section_list_list')): the_row();
                                $list_item = get_sub_field('list_item');
                                ?>
                                <li><?php echo $list_item; ?></li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <?php if ($type_of_link == "link" && $section_link) : ?>
                    <div class="c-intro__btn d-flex d-md-none">
                        <a href="<?php echo $section_link['url']; ?>"
                           class="c-btn c-btn-primary--dark-blue"
                           target="<?php echo $section_link['target']; ?>">
                            <?php echo $section_link['title']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>