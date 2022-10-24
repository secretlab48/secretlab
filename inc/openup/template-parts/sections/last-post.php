<?php
global $post;
$page_id = get_queried_object_id();
$blog_post = '';
$bg_color = '';
$bg_position = '';
if (is_page_template('templates/template-archive-ebook.php')):
    $last_post_arg = [
        'post_type' => array('ebook'),
        'posts_per_page' => 1,
    ];
    $blog_post = get_field('post_last_post');
    $bg_color = 's-wave--primary-green';
    foreach ($blog_post as $post):
        $bg_position_enable = get_field('image_position', $post->ID);
        switch ($bg_position_enable) {
            case 'top':
                $bg_position = 's-last-post-media--top';
                break;
            case 'center':
                $bg_position = 's-last-post-media--center';
                break;
        }
    endforeach;
else:
    $last_post_arg = [
        'post_type' => array('webinar'),
        'posts_per_page' => 1,
    ];
    $blog_post = get_field('webinar_last_post');
    $bg_color = 's-wave--primary-blue';
    $bg_position = 's-last-post-media--center';
endif;


$last_post_query = new WP_Query($last_post_arg);

?>

<section class="s-last-post <?php echo $bg_position; ?> u-color-primary-white s-wave <?php echo $bg_color; ?>">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>

    <div class="container">
        <div class="row justify-content-md-between">
            <?php if ($blog_post): ?>
                <?php foreach ($blog_post as $post):
                    $permalink = get_permalink($post->ID);
                    $title = get_the_title($post->ID);
                    $image = get_the_post_thumbnail($post->ID);
                    $read_time = get_field('advanced_post_option_read_time', $post->ID);
                    $small_description = get_field('advanced_post_option_small_description', $post->ID);
                    $authors = get_the_terms($post->ID, 'author-taxonomy');
                    $video = get_field('webinars_video', $post->ID);
                    ?>
                    <div class="col-md-5 col-lg-4 order-2 order-md-0 text-center">
                        <?php if (get_post_type(get_the_ID($post->ID)) == 'ebook'): ?>
                            <?php if ($image): ?>
                                <a href="<?php echo $permalink ?>" class="s-last-post__media-img">
                                    <?php echo $image ?>
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo $permalink ?>" class="s-last-post__media-video">
                                <div class="c-embed__container">
                                    <?php echo $video; ?>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-7">
                        <?php if ($title): ?>
                            <h2 class="s-last-post__title"><?php echo $title ?></h2>
                        <?php endif; ?>
                        <div class="s-last-post__meta-wrapper">
                            <ul class="c-meta-list c-meta-list--two-row d-flex align-items-center flex-wrap">
                                <li class="c-meta-list__item d-flex align-items-center">
                                    <svg class="icon">
                                        <use xlink:href="#icon-calendar"></use>
                                    </svg>
                                    <span class="c-meta-list__text">
                                        <?php the_date('d M Y'); ?>
                                    </span>
                                </li>
                                <?php if ($read_time) : ?>
                                    <li class="c-meta-list__item d-flex align-items-center">
                                        <svg class="icon">
                                            <use xlink:href="#icon-watch"></use>
                                        </svg>
                                        <span class="c-meta-list__text">
                                        <?php echo $read_time ?>
                                    </span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_post_type(get_the_ID($post->ID)) == 'ebook'): ?>
                                <?php else: ?>
                                    <?php if ($authors) : ?>
                                        <li class="c-meta-list__item d-flex align-items-center">
                                            <svg class="icon">
                                                <use xlink:href="#icon-edit"></use>
                                            </svg>
                                            <?php foreach ($authors as $author) : ?>
                                                <span class="c-meta-list__text">
                                                <?php echo $author->name; ?>
                                            </span>
                                            <?php endforeach; ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php $tags = get_the_tags();
                                if ($tags): ?>
                                    <li class="c-meta-list__item c-meta-list__item--tag d-flex align-items-center flex-nowrap">
                                        <svg class="icon">
                                            <use xlink:href="#icon-tag"></use>
                                        </svg>
                                        <?php foreach ($tags as $tag):
                                            $tag_link = get_tag_link($tag->term_id); ?>
                                            <a href="<?php echo $tag_link; ?>" class="c-meta-list__text">
                                                <?php echo $tag->name; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php if ($small_description): ?>
                            <div class="s-last-post__description">
                                <?php echo $small_description ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($permalink): ?>
                            <div class="s-last-post__link">
                                <a href="<?php echo $permalink ?>"
                                   class="c-btn-link c-btn-link--more c-btn-link--primary-white">
                                    <?php _e('Meer lezen', 'openup'); ?>

                                    <svg class="icon">
                                        <use xlink:href="#icon-arrow-team"></use>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <?php if ($last_post_query->have_posts()): ?>
                    <?php while ($last_post_query->have_posts()) : $last_post_query->the_post();
                        $permalink = get_permalink($post->ID);
                        $image = get_the_post_thumbnail($post->ID);
                        $title = get_the_title($post->ID);
                        $read_time = get_field('advanced_post_option_read_time');
                        $small_description = get_field('advanced_post_option_small_description');
                        $authors = get_the_terms($post->ID, 'author-taxonomy');
                        $video = get_field('webinars_video', $post->ID);
                        ?>
                        <div class="col-md-5 col-lg-4 order-2 order-md-0 text-center">
                            <?php if (get_post_type(get_the_ID($post->ID)) == 'ebook'): ?>
                                <?php if ($image): ?>
                                    <a href="<?php echo $permalink ?>" class="s-last-post__media-img">
                                        <?php echo $image ?>
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo $permalink ?>" class="s-last-post__media-video">
                                    <div class="c-embed__container">
                                        <?php echo $video; ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-7">
                            <?php if ($title): ?>
                                <h2 class="s-last-post__title"><?php echo $title ?></h2>
                            <?php endif; ?>
                            <div class="s-last-post__meta-wrapper">
                                <ul class="c-meta-list d-flex align-items-center flex-wrap">
                                    <li class="c-meta-list__item d-flex align-items-center">
                                        <svg class="icon">
                                            <use xlink:href="#icon-calendar"></use>
                                        </svg>
                                        <span class="c-meta-list__text">
                                        <?php the_date('d M Y'); ?>
                                    </span>
                                    </li>
                                    <?php if ($read_time) : ?>
                                        <li class="c-meta-list__item d-flex align-items-center">
                                            <svg class="icon">
                                                <use xlink:href="#icon-watch"></use>
                                            </svg>
                                            <span class="c-meta-list__text">
                                                <?php echo $read_time ?>
                                            </span>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (is_page_template('templates/template-archive-ebook.php')): ?>
                                    <?php else: ?>
                                        <?php if ($authors) : ?>
                                            <li class="c-meta-list__item d-flex align-items-center">
                                                <svg class="icon">
                                                    <use xlink:href="#icon-edit"></use>
                                                </svg>
                                                <span class="c-meta-list__text">
                                                    <?php echo $authors[0]->name; ?>
                                                </span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php $tags = get_the_tags();
                                    if ($tags): ?>
                                        <li class="c-meta-list__item d-flex align-items-center">
                                            <svg class="icon">
                                                <use xlink:href="#icon-tag"></use>
                                            </svg>
                                            <?php foreach ($tags as $tag):
                                                $tag_link = get_tag_link($tag->term_id); ?>
                                                <span class="c-meta-list__text">
                                                    <?php echo $tag->name; ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </li>
                                    <?php endif;
                                    ?>
                                </ul>
                            </div>
                            <?php if ($small_description): ?>
                                <div class="s-last-post__description">
                                    <?php echo $small_description ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($permalink): ?>
                                <div class="s-last-post__link">
                                    <a href="<?php echo $permalink ?>"
                                       class="c-btn-link c-btn-link--more c-btn-link--primary-white">
                                        <?php _e('Meer lezen', 'openup'); ?>

                                        <svg class="icon">
                                            <use xlink:href="#icon-arrow-team"></use>
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
