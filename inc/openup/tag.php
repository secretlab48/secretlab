<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package openup
 */

if (!defined('ABSPATH')) exit;

get_header();

?>

<main id="main" role="main" tabindex="-1">

    <?php get_template_part('template-parts/sections/banners/blog-hero'); ?>

    <?php get_template_part('template-parts/sections/blog/blog-last-post'); ?>

    <?php get_template_part('template-parts/sections/tags/tag-posts'); ?>

    <?php get_template_part('template-parts/sections/blog/blog-subscribe'); ?>

</main>

<?php

get_footer();

?>

