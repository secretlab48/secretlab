<?php
global $post;
$simple_form_id = get_sub_field('simple_form_id');
$section_title = get_sub_field('simple_form_title');
$form_shortcode = get_sub_field('simple_form_section_shortcode');
$section_bg_color = get_sub_field('section_bg_color');
$title_color = get_sub_field('section_title_color');
$wave_color = get_sub_field('section_wave_color');
$download = get_field('download_link_e-book', $post->ID);
$downl_class = '';
if (get_post_type(get_the_ID($post->ID)) == 'ebook'):
    $downl_class = 'JS--download-book';
endif;
?>

<?php if ($form_shortcode): ?>
    <section class="s-simple-form s-wave s-wave--primary-blue"
        <?= ($simple_form_id) ? 'id ="' . $simple_form_id . '" ' : ''; ?>
             style="background-color:<?php echo $section_bg_color; ?>">
        <div class="s-wave__inner-wrapper">
            <svg class="s-wave__icon icon-bottom" style="color:<?php echo $wave_color; ?>">
                <use xlink:href="#wave-bottom-type-3"></use>
            </svg>
        </div>

        <div class="container">
            <div class="row justify-content-md-between">
                <div class="col-12 col-md-5 col-xl-4">
                    <?php if ($section_title) : ?>
                        <div class="c-intro u-color-primary-dark-blue" style="color:<?php echo $title_color; ?>">
                            <h2 class="c-intro__title"><?php echo $section_title; ?></h2>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-7 col-xl-6">
                    <div class="s-simple-form__form-container <?php echo $downl_class; ?>"
                         data-current-download="<?php echo $download; ?>"
                         id="simple-form">
                        <?php echo $form_shortcode ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
