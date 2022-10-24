<?php

global $wpdb;

$categories = get_categories(array(
    'taxonomy' => 'category',
    'hide_empty' => true,
));

$thema_areas = get_categories(array(
    'taxonomy' => 'thema_areas-taxonomy',
    'hide_empty' => true,
));

$authors = get_categories(array(
    'taxonomy' => 'author-taxonomy',
    'hide_empty' => true,
));

$urlPage = get_queried_object()->term_id;
?>

<!--Filter Category-->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <?php if ($categories) : ?>
                <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue"
                     id="close-tag1">
                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                            <?php
                            if (empty($_GET['cat'])):
                                _e('Alle types', 'openup');
                            elseif ($_GET['cat'] == 'alle_types') :
                                _e('Alle types', 'openup');
                            else:
                                foreach ($categories as $category):
                                    if ($_GET['cat'] == $category->slug)
                                        echo $category->name;
                                endforeach;
                            endif; ?>
                        </span>
                        <svg class="icon">
                            <use xlink:href="#icon-chevron-down"></use>
                        </svg>
                    </span>
                    <div class="c-blog-filter__list-wrap u-bg-primary-skin">
                        <ul class="c-blog-filter__list">
                            <li class="c-blog-filter__list-item JS-filter-item">
                                <a class="u-color-primary-dark-blue"
                                   href="<?php echo add_query_arg('cat', 'alle_types', $urlPage) ?>">
                                    <?php _e('Alle types', 'openup'); ?>
                                </a>
                            </li>

                            <?php foreach ($categories as $category) :
                                $paramaters = array('themas', 'author');
                                $origURL = remove_query_arg($paramaters);
                                ?>
                                <li class="c-blog-filter__list-item JS-filter-item">
                                    <a class=" u-color-primary-dark-blue"
                                       href="<?php echo add_query_arg('cat', $category->slug, $origURL) ?>">
                                        <?php echo $category->name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!--Filter Thema Areas-->
        <div class="swiper-slide">
            <?php if ($thema_areas) : ?>

                <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue"
                     id="themas">

                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                            <?php
                            if (empty($_GET['themas'])):
                                _e("Alle thema's", 'openup');
                            elseif ($_GET['themas'] == "alle_themas"):
                                _e("Alle thema's", 'openup');
                            else:
                                foreach ($thema_areas as $thema):
                                    if ($_GET['themas'] == $thema->slug)
                                        echo $thema->name;
                                endforeach;
                            endif; ?>
                        </span>
                        <svg class="icon">
                            <use xlink:href="#icon-chevron-down"></use>
                        </svg>
                    </span>
                    <div class="c-blog-filter__list-wrap u-bg-primary-skin" id="themas">
                        <ul class="c-blog-filter__list">
                            <li class="c-blog-filter__list-item JS-filter-item">
                                <a class="u-color-primary-dark-blue"
                                   href="<?php echo add_query_arg('themas', "alle_themas", $urlPage) ?>">
                                    <?php _e("Alle thema's", 'openup'); ?>
                                </a>
                            </li>

                            <?php foreach ($thema_areas as $thema) :
                                $paramaters = array('cat', 'author');
                                $origURL = remove_query_arg($paramaters);
                                ?>
                                <li class="c-blog-filter__list-item JS-filter-item">
                                    <a class="u-color-primary-dark-blue"
                                       href="<?php echo add_query_arg('themas', $thema->slug, $origURL) ?>">
                                        <?php echo $thema->name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!--        Filter Author -->
        <div class="swiper-slide">
            <?php if ($authors) : ?>

                <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue"
                     id="close-tag1">

                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                            <?php
                            if (empty($_GET['author'])):
                                _e('Alle auteurs', 'openup');
                            elseif ($_GET['author'] == 'alle_auteurs'):
                                _e('Alle auteurs', 'openup');
                            else:
                                foreach ($authors as $author):
                                    if ($_GET['author'] == $author->slug)
                                        echo $author->name;
                                endforeach;
                            endif; ?>
                        </span>
                        <svg class="icon">
                            <use xlink:href="#icon-chevron-down"></use>
                        </svg>
                    </span>
                    <div class="c-blog-filter__list-wrap u-bg-primary-skin">
                        <ul class="c-blog-filter__list ">
                            <li class="c-blog-filter__list-item JS-filter-item">
                                <a class="u-color-primary-dark-blue"
                                   href="<?php echo add_query_arg('author', 'alle_auteurs', $urlPage) ?>">
                                    <?php _e('Alle auteurs', 'openup'); ?>
                                </a>
                            </li>

                            <?php foreach ($authors as $author) :
                                $paramaters = array('themas', 'cat');
                                $origURL = remove_query_arg($paramaters);
                                ?>
                                <li class="c-blog-filter__list-item JS-filter-item">
                                    <a class="u-color-primary-dark-blue"
                                       href="<?php echo add_query_arg('author', $author->slug, $origURL) ?>">
                                        <?php echo $author->name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>