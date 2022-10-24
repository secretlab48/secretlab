<?php
function openup_banner_hero_slider($data, $image_content){

    ?>

    <section
            class="o-main-hero o-main-hero--column u-color-primary-dark-blue <?php if(!empty($data['quote_triangle'])): echo 'o-main-hero--triangle'; endif;?> <?php if(!empty($data['number_img'])): $data['number_img'] == 'one' ? 'o-main-hero--md' : ''; endif; ?> o-main-hero--bg-left-<?php if(!empty($data['background_color_left'])): echo $data['background_color_left']; endif; ?> <?php if(!empty($data['background_color_right'])): echo 'o-main-hero--bg-right-'.$data['background_color_right']; endif; ?> <?php if (get_page_template_slug() == 'templates/template-home-with-slider.php') : echo ' o-main-hero__slider-section'; endif; ?>">
        <div class="container">
            <div class="row justify-content-lg-between">
                <div class="col-12 col-md-9 col-lg-5">
                    <div class="o-main-hero__container">
                        <?php if ($data['title']) : ?>
                            <h1 class="o-main-hero__title"><?php echo $data['title']; ?></h1>
                        <?php endif; ?>
                        <?php if ($data['description']) : ?>
                            <div class="o-main-hero__description"><?php echo $data['description']; ?></div>
                        <?php endif; ?>

                        <?php if (is_page_template('templates/template-ebook-bedankt.php')): ?>
                            <div class="o-main-hero__btn">
                                <a class="c-btn c-btn-primary--blue downloadResult" href="#">
                                    <?php echo esc_html($data['link']['title']); ?>
                                </a>
                            </div>
                        <?php elseif ($data['type_of_link'] == 'link' && $data['link']): ?>
                            <div class="o-main-hero__btn">
                                <a class="c-btn c-btn-primary--<?php echo $data['btn_css_class']; ?>"
                                   href="<?php echo esc_url($data['link']['url']); ?>"
                                   target="<?php echo esc_attr($data['link']['target']); ?>">
                                    <?php echo esc_html($data['link']['title']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($data['type_of_link'] == 'download' && $data['download_file'] && $data['download_link_title']): ?>
                            <div class="o-main-hero__btn">
                                <a class="c-btn c-btn-primary--blue" href="<?php echo $data['download_file']['url']; ?>"
                                   download>
                                    <?php echo $data['download_link_title']; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="o-main-hero__triangle"></div>
                </div>
                <?php get_template_part($image_content); ?>
            </div>
        </div>
    </section>

<?php } ?>
