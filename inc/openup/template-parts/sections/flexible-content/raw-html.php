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

$html = get_sub_field( 'html' );
$css_class = get_sub_field( 'css_class' );

?>

<?php if ( ! empty( $html ) ) : ?>
<section class="s-raw-html <?php echo $css_class; ?>">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php echo $html; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>