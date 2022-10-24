<?php /* Template Name: Themas */

if (!defined('ABSPATH')) exit;

get_header();

?>

<main id="main" role="main" tabindex="-1">

    <?php get_template_part('template-parts/sections/thema/thema-hero'); ?>

    <?php get_template_part('template-parts/sections/thema/thema-first-terms'); ?>

    <?php get_template_part('template-parts/sections/thema/text-with-image-and-link'); ?>

    <?php get_template_part('template-parts/sections/thema/thema-second-terms'); ?>

    <?php get_template_part('template-parts/sections/thema/cta-section'); ?>

</main>

<?php get_footer(); ?>
