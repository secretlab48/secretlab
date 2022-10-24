<?php
global $post;
global $wp_query;
$read_time = get_field('advanced_post_option_read_time');
$category = get_the_category();
$thema_tax = wp_get_post_terms($post->ID, 'thema_areas-taxonomy', array('fields' => 'names'));

?>
<div class="c-media-card__wrapper">
    <a href="<?php echo get_the_permalink(); ?>" class="c-media-card u-bg-secondary-skin c-media-card--column">
        <div class="c-media-card__img">
            <?php echo get_the_post_thumbnail(); ?>
        </div>
        <div class="c-media-card__body u-color-primary-dark-blue">
            <h3 class="c-media-card__title u-color-primary-dark-blue"><?php echo get_the_title() ?></h3>
            <ul class="c-meta-list c-meta-list--two-row d-flex align-items-center flex-wrap">
          <!--      <li class="c-meta-list__item d-flex align-items-center">
                    <svg class="icon">
                        <use xlink:href="#icon-calendar"></use>
                    </svg>
                    <span class="c-meta-list__text">
                        <?php /*echo get_the_date('d M Y'); */?>
                    </span>
                </li> -->

                <?php if ($read_time): ?>
                    <li class="c-meta-list__item d-flex align-items-center">
                        <svg class="icon">
                            <use xlink:href="#icon-watch"></use>
                        </svg>
                        <span class="c-meta-list__text">
                            <?php echo $read_time; ?>
                        </span>
                    </li>
                <?php endif; ?>

                <?php if (get_post_type( get_the_ID($post->ID) ) == 'ebook' ): ?>
                <?php else: ?>
                    <?php if ($thema_tax): ?>
                        <li class="c-meta-list__item c-meta-list__item--tag d-flex align-items-start">
                            <svg class="icon">
                                <use xlink:href="#icon-tag"></use>
                            </svg>
                            <div class="d-flex flex-wrap w-100">
                                <?php foreach ($thema_tax as $tax) :?>
                                <span class="c-meta-list__text c-meta-list__separate">
                                    <?php echo trim($tax, ''); ?>
                                </span>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php if (get_post_type( get_the_ID($post->ID) ) == 'ebook' ): ?>
                    <?php $tags = get_the_tags();
                    if ($tags): ?>
                        <li class="c-meta-list__item c-meta-list__item--tag d-flex align-items-start">
                            <svg class="icon">
                                <use xlink:href="#icon-tag"></use>
                            </svg>
                            <div class="d-flex flex-wrap w-100">
                                <?php foreach ($tags as $tag):
                                    $tag_link = get_tag_link($tag->term_id); ?>
                                    <span class="c-meta-list__text">
                                        <?php echo $tag->name; ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php endif;
                    ?>
                <?php else: ?>
                <?php endif; ?>
            </ul>
        </div>
    </a>
</div>
