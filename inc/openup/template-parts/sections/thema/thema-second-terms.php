<?php
$thema_terms = get_terms([
    'taxonomy' => 'thema_areas-taxonomy',
    'hide_empty' => false,
]);

?>
<section class="s-thema-term u-bg-secondary-skin">
    <div class="container">
        <?php
        $i = 0;
        foreach ($thema_terms as $thema_term):
            $title = get_field('thema_areas_secondary_title', $thema_term);
            $description = get_term_field('description', $thema_term);
            $add_info = get_field('thema_areas_add_additional_info', $thema_term);
            $title_add_info = get_field('thema_areas_title_additional_content', $thema_term);
            $content_add_info = get_field('thema_areas_additional_content', $thema_term);
            $add_link = get_field('thema_areas_add_link', $thema_term);
            $link = get_field('thema_areas_link', $thema_term);
            $i++;
            if ($i >= 5 && $i <= 8): ?>
                <div id="<?= $thema_term->slug ?>_<?= $thema_term->term_id ?>"
                     class="u-color-primary-dark-blue c-thema-card <?php if ($i % 2 == 0) echo 'c-thema-card--reverse'; ?>">

                    <div class="row">
                        <div class="col-12 col-md-6 order-2 order-md-1 align-self-center">
                            <?php if ($title): ?>
                                <h5 class="c-thema-card__title"><?php echo $title ?></h5>
                            <?php endif; ?>
                            <?php if ($description): ?>
                                <div class="c-thema-card__description"><?php echo $description ?></div>
                            <?php endif; ?>
                            <?php if ($add_info && $title_add_info): ?>
                                <div class="c-accordion-link JS-accordion">
                                    <div class="c-accordion-link__header JS-accordion--btn">
                                        <?php if ($title_add_info): ?>
                                            <h3 class="c-accordion-link__header-title u-color-primary-dark-blue">
                                                <?php echo $title_add_info; ?>
                                            </h3>
                                        <?php endif; ?>
                                        <svg class="icon">
                                            <use xlink:href="#icon-chevron-down"></use>
                                        </svg>
                                    </div>
                                    <div class="c-accordion-link__content JS-accordion--content">
                                        <?php if ($content_add_info): ?>
                                            <div class="c-wysiwyg">
                                                <?php echo $content_add_info; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($add_link && $link): ?>
                                <div class="c-thema-card__link">
                                    <a class="c-btn-link c-btn-link-primary--dark-blue c-btn-link--more"
                                       href="<?php echo $link['url'] ?>"
                                       target="<?php echo $link['target']; ?>">
                                        <?php echo $link['title']; ?>
                                        <svg class="icon">
                                            <use xlink:href="#icon-arrow-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6 order-1 order-md-2">
                            <img class="c-thema-card__img"
                                src="<?php echo esc_url(get_field('thema_areas_image', $thema_term)['url']); ?>"
                                alt="<?php echo esc_attr(get_field('thema_areas_image', $thema_term)['alt']); ?>"/>
                        </div>
                    </div>
                </div>
            <?php endif;
        endforeach; ?>
    </div>
</section>

