<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package openup
 */

if (!defined('ABSPATH')) exit;

get_header();
global $post;

$thema_tax = get_the_terms($post->ID, 'thema_areas-taxonomy');
$read_time = get_field('advanced_post_option_read_time');
$authors = get_the_terms($post->ID, 'author-taxonomy');
while (have_rows('flexible_content_post')) : the_row();
$a = get_row_layout();
if (get_row_layout() == 'reviewer') {
    $reviewers = get_sub_field('reviewer');
}
endwhile;
?>

<main class="u-bg-secondary-skin" id="main" role="main" tabindex="-1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (function_exists('yoast_breadcrumb')):
                    yoast_breadcrumb('<div class="c-breadcrumbs" id="breadcrumbs">', '</div>');
                endif; ?>
            </div>
        </div>
    </div>
    <article class="s-blog-page u-color-primary-dark-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <h1 class="s-blog-page__title text-md-center"><?php the_title(); ?></h1>

                    <div class="s-blog-page__meta-wrapper">
                        <div class="c-meta-list c-meta-list--two-row d-flex align-items-center flex-wrap justify-content-start justify-content-md-center">
                            <div class="c-meta-list__item d-flex align-items-center">
                                <svg class="icon">
                                    <use xlink:href="#icon-calendar"></use>
                                </svg>
                                <span class="c-meta-list__text">
                                    <?php echo get_the_date(__('j M ‘y')); ?>
                                </span>
                            </div>
                            <?php if ($read_time) : ?>
                                <div class="c-meta-list__item d-flex align-items-center">
                                    <svg class="icon">
                                        <use xlink:href="#icon-watch"></use>
                                    </svg>
                                    <span class="c-meta-list__text">
                                        <?php echo $read_time; ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if ($thema_tax) : ?>
                                <div class="c-meta-list__item d-flex align-items-start justify-content-start justify-content-md-center">
                                    <svg class="icon">
                                        <use xlink:href="#icon-tag"></use>
                                    </svg>
                                    <?php foreach ($thema_tax as $tax): ?>
                                        <div class="d-flex flex-wrap">
                                            <a class="c-meta-list__text"
                                               href="<?php echo add_query_arg('themas', $tax->slug, get_post_type_archive_link('post')) ?>">
                                                <?php echo $tax->name; ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="c-meta-list c-meta-list--two-row d-flex align-items-center flex-wrap justify-content-start justify-content-md-center">
                            <?php if ($authors) : ?>
                                <div class="c-meta-list__item c-meta-list__item--author d-flex align-items-center not-underlined-item">
                                    <svg class="icon">
                                        <use xlink:href="#icon-edit"></use>
                                    </svg>
                                    <span class="c-meta-list__text">
                                        <?php echo $authors[0]->name; ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php
                            if ( ! empty( $reviewers ) && is_array( $reviewers ) && ( count( $reviewers ) > 0 ) ) :
                                foreach ( $reviewers as $i => $reviewer ) :
                                    $name = get_field( 'team_name', $reviewer->ID, true );
                                    $surname = get_field( 'team_surname', $reviewer->ID, true );
                                    ?>
                                    <div class="c-meta-list__item c-meta-list__item--author d-flex align-items-center">
                                        <svg class="icon">
                                            <use xlink:href="#search-loupe"></use>
                                        </svg>
                                        <span class="c-meta-list__text">
                                            <?php echo __( 'Gecontroleerd door psycholoog', 'openup' ); ?>
                                            <a class="c-meta-list__text" href="<?php echo get_permalink( $reviewer->ID ); ?>">
                                                <?php echo $name . ' ' . $surname ?>
                                            </a>
                                        </span>
                                    </div>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php get_template_part('template-parts/organisms/flexible-content-post'); ?>
        <div class="c-tag">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex align-items-center flex-wrap">
                        <?php if ($thema_tax) : ?>
                            <?php foreach ($thema_tax as $tax): ?>
                                <a class="c-btn c-btn--sm c-btn-secondary--gray"
                                   href="<?php echo add_query_arg('themas', $tax->slug, get_post_type_archive_link('post')) ?>">
                                    <?php echo $tax->name; ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php $tags = get_the_tags();
                        if($tags):
                        foreach ($tags as $tag):
                            $tag_link = get_tag_link($tag->term_id); ?>
                            <a class="c-btn c-btn--sm c-btn-secondary--gray" href="<?php echo $tag_link; ?>">
                                <?php echo $tag->name; ?>
                            </a>
                        <?php endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </article>
    <?php get_template_part('template-parts/sections/related-posts'); ?>

</main>

<?php get_footer(); ?>
