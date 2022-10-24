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

$text_content = get_field('text_content');
?>

<section class="s-text-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <?php if ($text_content) : ?>
                    <div class="c-wysiwyg">
                        <?php echo $text_content; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
