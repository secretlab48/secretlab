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
$title = get_sub_field('contact_form_title');
$description = get_sub_field('contact_form_description');
$image = get_sub_field('contact_form_image');
$name = get_sub_field('contact_form_name');
$position = get_sub_field('contact_form_position');
$section_color = get_sub_field('contact_form_section_color');

switch($section_color){
    case 'green':
        $section_bg = 's-wave--primary-green';
        break;
    case 'blue':
        $section_bg = 's-wave--primary-blue';
        break;
    case 'skin':
        $section_bg = 's-wave--primary-skin';
        break;
    default :
        $section_bg = 's-wave--primary-green';
        break;
}

?>

<section class="s-contact s-contact--member s-wave <?php echo $section_bg ?> JS-contact-form" id="contactForm"> 
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div> 
    <div class="container">
        <div class="row justify-content-xl-between">
            <div class="col-12 col-lg-6 col-xl-5  <?= $title || $description ?  ' '  :  ' d-lg-flex justify-content-lg-end ' ?> ">
                <div class="c-intro">
                    <?php if ($title) : ?>
                        <h2 class="c-intro__title" <?= $image ? '' : ' style="text-align: right" ' ?> >
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <div class="c-intro__description c-wysiwyg">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="s-contact__member"  >
                    <?php if ($image) : ?>
                        <div class="s-contact__photo-wrap d-flex justify-content-center align-items-center">
                            <?php echo wp_get_attachment_image($image['ID'],'full', "", array( "class" => "s-contact__photo" )) ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($name && $position) : ?>
                        <div class="s-contact__member-desc text-center">
                            <p>
                                <strong><?php echo $name; ?></strong> - <?php echo $position; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-5"> 
                <div class="c-form">
                    <?php if (ICL_LANGUAGE_CODE == 'nl') :
                        get_template_part('template-parts/components/contact-forms/bedrijven-form-nl');

                    elseif (ICL_LANGUAGE_CODE == 'de') :
                        get_template_part('template-parts/components/contact-forms/bedrijven-form-de');

                    elseif (ICL_LANGUAGE_CODE == 'fr') :
                        get_template_part('template-parts/components/contact-forms/bedrijven-form-fr');
                    elseif (ICL_LANGUAGE_CODE == 'es') :
                        get_template_part('template-parts/components/contact-forms/bedrijven-form-es');
                    else :
                        get_template_part('template-parts/components/contact-forms/bedrijven-form-en');
                    endif; ?>
                </div> 
            </div>
        </div>
    </div>
</section>
