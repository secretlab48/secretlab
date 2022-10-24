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
$intro_text = get_field('sections_intro_text','option');
$section_bg_color = get_field('sections_bg_color','option');
$intro_text_color = get_field('sections_intro_text_color','option');
$section_link = get_field('sections_link','option');

?>

<section class="s-logo-banner <?php if(empty($section_bg_color)): echo 'u-bg-secondary-skin'; else: echo ''; endif; ?>"
    <?php if(!empty($section_bg_color)): echo 'style="background-color:'.$section_bg_color.';"'; endif; ?>>
    <a class="s-logo-banner__link JS-check-href" href="<?php echo $section_link['url']; ?>" target="<?php echo $section_link['target']; ?>">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between JS-logo-direction"> 
                    <div class="s-logo-banner__text" >
                        <p class="<?php if(empty($intro_text_color)): echo 'u-color-primary-dark-blue'; else: echo ''; endif; ?>"
                            <?php if(!empty($intro_text_color)): echo 'style="color:'.$intro_text_color.';"'; endif; ?>>
                            <?php echo $intro_text; ?>
                        </p>
                    </div>
                    <?php if (have_rows('logos_sections','option')): ?>
                        <div class="row w-100 d-flex flex-md-nowrap justify-content-md-between align-items-center">
                            <?php while (have_rows('logos_sections','option')): the_row();
                                $logo_image = get_sub_field('item_logo_image','option'); ?>
                                <div class="col-4 col-md-auto">
                                    <div class="s-logo-banner__icon-wrap">
                                        <?php echo wp_get_attachment_image($logo_image['ID'],'full', "", array( "class" => "s-logo-banner__icon" )) ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </a>
</section>
