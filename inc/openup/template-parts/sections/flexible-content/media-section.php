<?php
global $post;

$media_section_image = get_sub_field('media_section_image');
$media_section_link = get_sub_field('media_section_link');

$terms1 = get_sub_field('category_select');
$terms2 = get_sub_field('second_category_select');


$posts_first = get_posts(array(
    'category' => $terms1,//media
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'suppress_filters' => 0
));

$posts_second = get_posts(array(
    'category' => $terms2,
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'suppress_filters' => 0
));
?>

<section class="s-media u-bg-secondary-skin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <ul class="d-flex flex-column flex-md-row justify-content-center align-items-center flex-wrap u-color-primary-dark-blue JS-filter-media">
                    <?php if ($terms1):
                        $term_name = get_category($terms1); ?>
                        <li class="c-filter__link JS-filter--media active"><?php echo $term_name->name; ?></li>
                    <?php endif; ?>
                    <?php if ($terms2) :
                        $term_name = get_category($terms2); ?>
                        <li class="c-filter__link JS-filter--blog"><?php echo $term_name->name; ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="c-filter__contant JS-content-media active">
        <div class="c-media-card__container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php foreach ($posts_first as $post) :
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
                                        <?php endif;
                                        ?>
                                        <?php if ($thema_tax): ?>
                                            <li class="c-meta-list__item-wrapper">
                                                <div class="c-meta-list__item c-meta-list__item--tag d-flex align-items-center flex-nowrap">
                                                    <svg class="icon">
                                                        <use xlink:href="#icon-tag"></use>
                                                    </svg>
                                                    <span class="c-meta-list__text">
                                                      <?php echo implode(', ', $thema_tax); ?>
                                                    </span>
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
    <div class="c-filter__contant JS-content-blog">
        <div class="c-media-card__container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-10">
                        <?php
                        foreach ($posts_second as $post) :
                            setup_postdata($post);
                            $image = get_the_post_thumbnail();
                            $read_time = get_field('advanced_post_option_read_time');
                            $thema_tax = wp_get_post_terms($post->ID, 'thema_areas-taxonomy', array('fields' => 'names'));
                            $authors = get_the_terms($post->ID, 'author-taxonomy');
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
                                    <ul class="c-meta-list d-flex align-items-center flex-wrap">
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
                                            <li class="c-meta-list__item d-flex align-items-center">
                                                <svg class="icon">
                                                    <use xlink:href="#icon-tag"></use>
                                                </svg>
                                                <span class="c-meta-list__text">
                                                        <?php echo implode(', ', $thema_tax); ?>
                                                    </span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($authors) :
                                            $author = array_shift($authors);
                                            ?>
                                            <li class="c-meta-list__item d-flex align-items-center">
                                                <svg class="icon">
                                                    <use xlink:href="#icon-edit"></use>
                                                </svg>

                                                <span class="c-meta-list__text">
                                                <?php echo $author->name; ?>
                                                </span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </a>
                            <!-- <div class="c-media-card__wrapper">
                            </div> -->
                        <?php endforeach;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($media_section_link) : ?>
        <div class="s-media__btn d-flex justify-content-center">
            <a href="<?php echo $media_section_link['url']; ?>"
               target="<?php echo $media_section_link['target']; ?>"
               class="c-btn c-btn-primary--dark-blue">
                <?php echo $media_section_link['title']; ?>
            </a>
        </div>
    <?php endif; ?>
    <?php if ($media_section_image) : ?>
        <div class="s-media__img">
            <img src="<?php echo $media_section_image['url']; ?>" height="<?php echo $media_section_image['height']; ?>" width="<?php echo $media_section_image['width']; ?>" alt="<?php echo $media_section_image['alt']; ?>">
        </div>
    <?php endif; ?>
</section>
