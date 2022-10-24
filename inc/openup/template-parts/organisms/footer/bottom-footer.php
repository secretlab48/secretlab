<?php

if (!defined('ABSPATH')) exit;


//ACF

$footer_copyright = get_field('footer_option_copyright', 'option');

?>

<div class="o-footer__bottom u-bg-secondary-dark-blue"> 
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-7">
                <span class="o-footer__copyright text-center text-lg-left">
                    <?php _e('OpenUp ©', 'openup'); ?><?php echo date('Y') ?><?= $footer_copyright ? $footer_copyright : '' ?>
                </span>
            </div>
            <div class="col-12 col-lg-5">
                <?php if (have_rows('footer_option_logos', 'option')): ?>
                    <div class="o-footer__logos d-flex align-items-center justify-content-between">
                        <?php while (have_rows('footer_option_logos', 'option')) : the_row();
                            $logo = get_sub_field('footer_option_logo') ?>
                            <?php echo wp_get_attachment_image($logo['ID'],'full') ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>