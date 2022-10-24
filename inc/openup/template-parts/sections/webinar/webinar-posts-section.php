<?php
global $post;

$title = get_field('webinar_title');
$posts = get_field('webinar_posts_list');
?>

<section class="s-media u-bg-primary-skin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <?php if ($title): ?>
                    <div class="c-intro text-center u-color-primary-dark-blue">
                        <h2 class="c-intro__title"><?php echo $title; ?></h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ($posts): ?>
        <div class="c-filter__contant JS-content-media active">
            <div class="c-media-card__container">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <?php foreach ($posts as $post) :
                                setup_postdata($post);
                                $image = get_the_post_thumbnail();
                                $read_time = get_field('advanced_post_option_read_time');
                                $thema_tax = wp_get_post_terms($post->ID, 'thema_areas-taxonomy', array('fields' => 'names'));

                                ?>
                                <a href="<?php the_permalink(); ?>" class="c-media-card u-bg-secondary-skin">
                                    <div class="c-media-card__img">
                                        <?php if ($image) : ?>
                                            <?php echo $image; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="c-media-card__body u-color-primary-dark-blue">
                                        <h3 class="c-media-card__title u-color-primary-dark-blue">
                                            <?php echo the_title(); ?>
                                        </h3>
                                        <ul class="c-meta-list c-meta-list--two-row d-flex align-items-center flex-wrap">
                                            <li class="c-meta-list__item d-flex align-items-center">
                                                <svg class="icon">
                                                    <use xlink:href="#icon-calendar"></use>
                                                </svg>
                                                <span class="c-meta-list__text">
                                                <?php echo get_the_date(__('j M ‘y')); ?>
                                            </span>
                                            </li>
                                            <?php if ($read_time) :
                                                ?>
                                                <li class="c-meta-list__item d-flex align-items-center">
                                                    <svg class="icon">
                                                        <use xlink:href="#icon-watch"></use>
                                                    </svg>
                                                    <span class="c-meta-list__text">
                                                <?php echo $read_time; ?>
                                                    </span>
                                                </li>
                                            <?php endif; ?>
                                            <?php if ($thema_tax): ?>
                                                <li class="c-meta-list__item-wrapper">
                                                    <div class="c-meta-list__item c-meta-list__item--tag d-flex align-items-center flex-nowrap">
                                                        <svg class="icon">
                                                            <use xlink:href="#icon-tag"></use>
                                                        </svg>
                                                        <?php foreach ($thema_tax as $tax): ?>
                                                            <span class="c-meta-list__text">
                                                                <?php echo $tax; ?>
                                                            </span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </a>
                            <?php endforeach;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
