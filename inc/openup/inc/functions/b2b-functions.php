<?php

class B2B_Render_Methods {

    static function blog_hero( $data ) {
        ?>

        <section class="o-main-hero o-main-hero--column o-main-hero--blog u-color-primary-dark-blue">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-5">
                        <div class="o-main-hero__container">
                            <?php if ($data[ 'title' ]) : ?>
                                <h1 class="o-main-hero__title"><?php echo $data[ 'title' ]; ?></h1>
                            <?php endif; ?>
                            <?php if ($data[ 'description' ]) : ?>
                                <div class="o-main-hero__description"><?php echo $data[ 'description' ]; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="o-main-hero__img-container">
                        <img src="/wp-content/themes/openup/img/global/man_blog.svg" alt="Blog Page Image"/>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }


    static function blog_last_post( $data ) {
        ?>
        <section class="s-last-post u-color-primary-white s-wave s-wave--primary-green">
            <div class="s-wave__inner-wrapper">
                <svg class="s-wave__icon icon-bottom">
                    <use xlink:href="#wave-bottom-type-3"></use>
                </svg>
            </div>

            <div class="container">
                <div class="row justify-content-md-between align-items-center">
                    <?php if ( $data[ 'blog_post' ] ): ?>
                        <?php foreach ( $data[ 'blog_post' ] as $post_item ):
                            //$post_id = apply_filters( 'wpml_object_id', $post_item->ID, 'post' );
                            $permalink = get_the_permalink($post_item->ID);
                            $title = get_the_title($post_item->ID);
                            $image = get_the_post_thumbnail($post_item->ID);
                            $read_time = get_field('advanced_post_option_read_time', $post_item->ID);
                            $small_description = get_field('advanced_post_option_small_description', $post_item->ID);
                            if ( $data[ 'type' ] == 'b2c' ) {
                                $authors = get_the_terms($post_item->ID, 'author-taxonomy');
                                $thema_tax = wp_get_post_terms($post_item->ID, 'thema_areas-taxonomy', array('fields' => 'names'));
                            }
                            elseif ( $data[ 'type' ] == 'b2b' ) {
                                $authors = get_the_terms($post_item->ID, 'business_posts_author_tax');
                                $thema_tax = wp_get_post_terms($post_item->ID, 'business_posts_themas_tax', array('fields' => 'names'));
                            }
                            ?>
                            <?php if ($image): ?>
                            <div class="col-md-5 col-lg-4 order-2 order-md-0 text-center">
                                <a href="<?php echo $permalink ?>" class="s-last-post__media-img">
                                    <?php echo $image ?>
                                </a>
                            </div>
                        <?php endif; ?>

                            <div class="col-md-7">
                                <?php if ($title): ?>
                                    <a href="<?php echo $permalink ?>" class="s-last-post__title"><?php echo $title ?></a>
                                <?php endif; ?>
                                <div class="s-last-post__meta-wrapper">
                                    <ul class="c-meta-list d-flex align-items-center flex-wrap">
                                        <!--<li class="c-meta-list__item d-flex align-items-center">
                                            <svg class="icon">
                                                <use xlink:href="#icon-calendar"></use>
                                            </svg>
                                            <span class="c-meta-list__text">
                                                <?php /*the_date('d M Y');*/ ?>
                                            </span>
                                        </li>-->
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
                                        <?php if ($authors) : ?>
                                            <li class="c-meta-list__item c-meta-list__item--author d-flex align-items-center">
                                                <svg class="icon">
                                                    <use xlink:href="#icon-edit"></use>
                                                </svg>
                                                <span class="c-meta-list__text">
                                                <?php echo $authors[0]->name; ?>
                                            </span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($thema_tax): ?>
                                            <li class="c-meta-list__item-wrapper u-grad-primary-green">
                                                <div class="c-meta-list__item c-meta-list__item--tag d-flex align-items-center">
                                                    <svg class="icon">
                                                        <use xlink:href="#icon-tag"></use>
                                                    </svg>
                                                    <?php foreach ($thema_tax as $tax) : ?>
                                                        <a href="<?php echo add_query_arg('themas', ( isset( $tax->slug ) ? $tax->slug : $tax ), get_post_type_archive_link('post')) ?>"
                                                           class="c-meta-list__text">
                                                            <?php echo $tax; ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
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
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php
    }


    static function remove_query_arg( $keys_to_stay, $keys, $query = false ) {

        if ( is_array( $keys_to_stay ) ) { // Removing multiple keys.
            foreach ( $keys_to_stay as $k ) {
                foreach( $keys as $key ) {
                    if ( $key != $k ) {
                        $query = add_query_arg($key, false, $query);
                    }
                }
            }
            return $query;
        }

        foreach( $keys as $key ) {
            if ( $key != $keys_to_stay ) {
                $query = add_query_arg($key, false, $query);
            }
        }

        return $query;
    }


    static function blog_filter( $data ) {
        ?>
        <!--Filter Category-->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?php if ($data[ 'categories' ]) : ?>
                        <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue"
                             id="close-tag1">
                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                            <?php
                            if (empty($_GET[ $data[ 'params' ][ 0 ] ])):
                                _e('Alle types', 'openup');
                            elseif ($_GET[ $data[ 'params' ][ 0 ] ] == 'alle_types') :
                                _e('Alle types', 'openup');
                            else:
                                foreach ($data[ 'categories' ] as $category):
                                    if ($_GET[ $data[ 'params' ][ 0 ] ] == $category->slug)
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
                                           href="<?php echo add_query_arg($data[ 'params' ][ 0 ], 'alle_types', $data[ 'urlBlog' ] ) ?>">
                                            <?php _e('Alle types', 'openup'); ?>
                                        </a>
                                    </li>

                                    <?php foreach ($data[ 'categories' ] as $category) :
                                        $origURL = B2B_Render_Methods::remove_query_arg( $data[ 'params' ][ 0 ], $data[ 'params' ] );
                                        ?>
                                        <li class="c-blog-filter__list-item JS-filter-item">
                                            <a class=" u-color-primary-dark-blue"
                                               href="<?php echo add_query_arg($data[ 'params' ][ 0 ], $category->slug, $origURL) ?>">
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
                    <?php if ($data[ 'thema_areas' ]) : ?>

                        <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue"
                             id="themas">

                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                            <?php
                            if (empty($_GET[ $data[ 'params' ][ 1 ] ])):
                                _e("Alle thema's", 'openup');
                            elseif ($_GET[ $data[ 'params' ][ 1 ] ] == "alle_themas"):
                                _e("Alle thema's", 'openup');
                            else:
                                foreach ($data[ 'thema_areas' ] as $thema):
                                    if ($_GET[ $data[ 'params' ][ 1 ] ] == $thema->slug)
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
                                           href="<?php echo add_query_arg($data[ 'params' ][ 1 ], "alle_themas", $data[ 'urlBlog' ]) ?>">
                                            <?php _e("Alle thema's", 'openup'); ?>
                                        </a>
                                    </li>

                                    <?php foreach ($data[ 'thema_areas' ] as $thema) :
                                        $origURL = B2B_Render_Methods::remove_query_arg( $data[ 'params' ][ 1 ], $data[ 'params' ] );
                                        ?>
                                        <li class="c-blog-filter__list-item JS-filter-item">
                                            <a class="u-color-primary-dark-blue"
                                               href="<?php echo add_query_arg($data[ 'params' ][ 1 ], $thema->slug, $origURL) ?>">
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
                    <?php if ($data[ 'authors' ]) : ?>

                        <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue"
                             id="close-tag1">

                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                            <?php
                            if (empty($_GET[ $data[ 'params' ][ 2 ] ])):
                                _e('Alle auteurs', 'openup');
                            elseif ($_GET[ $data[ 'params' ][ 2 ] ] == 'alle_auteurs'):
                                _e('Alle auteurs', 'openup');
                            else:
                                foreach ($data[ 'authors' ] as $author):
                                    if ($_GET[ $data[ 'params' ][ 2 ] ] == $author->slug)
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
                                           href="<?php echo add_query_arg($data[ 'params' ][ 2 ], 'alle_auteurs', $data[ 'urlBlog' ]) ?>">
                                            <?php _e('Alle auteurs', 'openup'); ?>
                                        </a>
                                    </li>

                                    <?php foreach ($data[ 'authors' ] as $author) :
                                        $origURL = B2B_Render_Methods::remove_query_arg( $data[ 'params' ][ 2 ], $data[ 'params' ] );
                                        ?>
                                        <li class="c-blog-filter__list-item JS-filter-item">
                                            <a class="u-color-primary-dark-blue"
                                               href="<?php echo add_query_arg($data[ 'params' ][ 2 ], $author->slug, $origURL) ?>">
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
        <?php

    }


    static function blog_posts( $data ) {

        $prefix = ( $data[ 'post_type' ] == 'business_post' ) ? 'b2b-' : '';
        $page = ( ! empty( $data[ 'page' ] ) ) ? $data[ 'page' ] : '';

        if ( $data[ 'posts_query' ] ): ?>
            <section class="s-blog-posts u-bg-secondary-skin">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="o-banner__title u-color-primary-dark-blue text-center"><?php _e('Tips en inzichten van onze psychologen', 'openup'); ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div class="s-blog-post__filter JS-post-filter-slider JS-filter-slider">
                                <?php get_template_part('template-parts/components/filters/' . $data[ 'filter-template-name' ] ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="js-filter">
                        <div class="s-blog-posts__container" data-pages="<?= $data[ 'posts_query' ]->max_num_pages; ?>" data-found-posts="<?php echo $data[ 'posts_query' ]->found_posts; ?>">
                            <div class="row JS--post-container ">
                                <?php
                                while ($data[ 'posts_query' ]->have_posts()) : $data[ 'posts_query' ]->the_post(); ?>
                                    <div class="col-md-6 col-lg-4 JS--posts--item">
                                        <?php get_template_part('template-parts/components/' . $data[ 'post-template-name' ] ); ?>
                                    </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                        <?php if ($data[ 'posts_query' ]->max_num_pages > 1): ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="JS--load--container">
                                        <div class="c-load-more text-center d-flex justify-content-center">
                                            <a class="c-btn c-btn-primary--dark-blue <?php echo $prefix; ?>JS--load-more"
                                               data-current-post-type="<?php echo $data[ 'post_type' ]; ?>"
                                               data-current-term="<?php echo $data[ 'curent_term' ] ?>"
                                               data-current-taxonomy="<?php echo $data[ 'curent_taxonomy' ] ?>"
                                               data-page="<?php echo $page; ?>"
                                               href="javascript:void(0);"><?php echo __('Meer laden', 'openup'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif;

    }


    static function blog_subscribe( $data ) {
        ?>

            <section class="s-subscribe s-wave s-wave--primary-skin u-color-primary-dark-blue">
                <div class="s-wave__inner-wrapper">
                    <svg class="s-wave__icon s-wave__icon-type-2 icon-bottom">
                        <use xlink:href="#wave-bottom-type-2"></use>
                    </svg>
                </div>
                <div class="container">
                    <div class="row justify-content-lg-between">
                        <?php if ($data[ 'title' ]): ?>
                            <div class="col-12 col-lg-6">
                                <div class="c-intro">
                                    <h2 class="c-intro__title"><?php echo $data[ 'title' ]; ?> </h2>

                                    <?php if ($data[ 'description' ]): ?>
                                        <div class="c-intro__description">
                                            <p><?php echo $data[ 'description' ] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 col-lg-5">
                            <div class="s-subscribe__form">
                                <div>
                                    <?php
                                    $form_path = STYLESHEETPATH . '/template-parts/components/' . $data[ 'form-paths' ][ ICL_LANGUAGE_CODE ] . '.php';
                                    if ( file_exists( $form_path ) ) {
                                        get_template_part('template-parts/components/' . $data[ 'form-paths' ][ ICL_LANGUAGE_CODE ] );
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php
    }

}