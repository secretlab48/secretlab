<?php

/* Template Name: Business Blog Page */

if (!defined('ABSPATH')) exit;

global $post;

get_header();

?>

    <main id="main" role="main" tabindex="-1">

        <?php get_template_part('template-parts/sections/banners/b2b/blog-hero'); ?>

        <?php get_template_part('template-parts/sections/blog/b2b/blog-last-post'); ?>

        <?php get_template_part('template-parts/sections/blog/b2b/blog-posts'); ?>

        <?php get_template_part('template-parts/sections/blog/b2b/blog-subscribe'); ?>

    </main>

<?php

get_footer();

?>