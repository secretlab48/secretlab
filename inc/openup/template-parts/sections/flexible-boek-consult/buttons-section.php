<?php
// ACF VARS
$description = get_sub_field('boek_consult_buttons_section_description');
$back_link = get_sub_field('boek_consult_buttons_back_button');
$title = get_sub_field('boek_consult_buttons_section_title');
?>

<section class="s-popup active">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <header class="s-popup__header d-flex justify-content-center">
                    <?php if ($back_link): ?>
                        <a href="<?php echo $back_link['url'] ?>"
                           class="s-popup__link-back d-flex justify-content-center justify-content-md-start align-items-center u-color-primary-dark-blue">
                            <svg class="icon">
                                <use xlink:href="#icon-angle-left"></use>
                            </svg>
                            <span class="d-none d-md-inline-block"><?php _e('Terug', 'openup'); ?></span>
                        </a>
                    <?php endif; ?>
                    <div class="s-popup__logo-wrapper d-flex align-items-center">
                        <?php the_custom_logo(); ?>
                    </div>
                </header>
            </div>
            <div class="col-12 col-md-6">
                <div class="s-popup__intro">
                    <div class="c-intro text-center u-color-primary-dark-blue">
                        <?php if ($title): ?>
                            <h2 class="c-intro__title">
                                <?php echo $title ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ($description): ?>
                            <div class="c-intro__description">
                                <?php echo $description ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9 col-xl-7 ">
                <div class="c-intro__btn-wrap d-flex justify-content-center flex-column-reverse flex-lg-row">
                    <?php if (have_rows('boek_consult_buttons')): ?>
                        <?php while (have_rows('boek_consult_buttons')): the_row();
                            //ACF Vars
                            $link = get_sub_field('boek_consult_button_link');
                            $link_style = get_sub_field('boek_consult_button_style');
                            ?>
                            <?php if ($link): ?>
                                <a href="<?php echo $link['url'] ?>"
                                   target="<?php echo $link['target']; ?>"
                                   class=" <?= $link_style == 'outline' ? 'c-btn-outline c-btn-outline-primary--dark-blue ' : 'c-btn c-btn-primary--blue' ?> my-1 my-lg-0 mx-lg-3"><?php echo $link['title'] ?></a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
