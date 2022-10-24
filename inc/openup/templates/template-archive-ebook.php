<?php
/* Template Name: Archive E-book */

if (!defined('ABSPATH')) exit;

get_header();

?>

<main id="main" role="main" tabindex="-1">

    <?php get_template_part('template-parts/sections/banners/stable-image-hero'); ?>

    <?php get_template_part('template-parts/sections/last-post'); ?>

    <?php get_template_part('template-parts/sections/ebook/ebook-posts'); ?>

    <?php get_template_part('template-parts/sections/logo-row'); ?>
</main>

<?php

get_footer();

?>

