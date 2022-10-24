<div class="c-share-sticky">
    <div class="c-share-sticky__inner JS-share-sticky d-flex align-items-center justify-content-center a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style"
         style="right:0px; top:150px;">
         <?php if (have_rows('share_icons_settings', 'option')): ?>
            <?php while (have_rows('share_icons_settings', 'option')): the_row();
                $btn_class = get_sub_field('share_button_class');
                $btn_icon = get_sub_field('share_icon');
                ?>
                <a class="d-lg-none c-share-sticky__label-link a2a_dd"></a>
                <label class="c-share-sticky__label">
                    <?php _e('Share', 'openup'); ?>
                </label>
                <div>
                    <?php if ($btn_class && $btn_icon): ?>
                        <a class="c-share-sticky__link a2a_dd  <?php echo $btn_class; ?>">
                            <img src="<?php echo $btn_icon['url'] ?>" alt="<?php echo $btn_icon['alt'] ?>">
                        </a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>