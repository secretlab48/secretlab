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

$form_shortcode = get_sub_field('form_post_shortcode');
$form_css_class = get_sub_field('form_post_css_class');
$is_script = preg_match( '/<script\ssrc=/', $form_shortcode, $data_type );
$data = false;
if ( $is_script ) {
    $data = $form_shortcode;
}
else {
    $data = preg_match( '/activecampaign\sform=(\d+)/', $form_shortcode, $form_id );
    $data = ( ! empty( $form_id ) ) ? '<script src="https://open-up.activehosted.com/f/embed.php?id=' . $form_id[1] . '" type="text/javascript" charset="utf-8"></script>' : false;
}
?>

<?php if ( $data ) : ?>
    <section class="s-one-column <?= $form_css_class ?>">
        <div class="ac-form-box">
            <?php echo $data; ?>
        </div>
    </section>

<?php endif; ?>