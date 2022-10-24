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

?>

<main class="u-bg-secondary-skin" id="main" role="main" tabindex="-1">

    <article class="single-case-study_article">
        <?php get_template_part('template-parts/organisms/flexible-content-page'); ?>
        <?php get_template_part('template-parts/organisms/flexible-content-post'); ?>
    </article>
    <?php get_template_part('template-parts/sections/related-posts'); ?>


</main>

<?php get_footer(); ?>
