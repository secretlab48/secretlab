<?php

/* Template Name: Blog Page */

if (!defined('ABSPATH')) exit;

get_header();

?>

    <main id="main" role="main" tabindex="-1">

        <?php get_template_part('template-parts/sections/banners/blog-hero'); ?>

        <?php get_template_part('template-parts/sections/blog/blog-last-post'); ?>

        <?php get_template_part('template-parts/sections/blog/blog-posts'); ?>

        <?php get_template_part('template-parts/sections/blog/blog-subscribe'); ?>

    </main>

<?php

get_footer();

?>