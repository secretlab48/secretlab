<?php /* Template Name: Logo Company Slider Hero Section and Testimonials With Image Slider Section */

if (!defined('ABSPATH')) exit;

get_header();

?>

    <main id="main" role="main" tabindex="-1">

        <?php get_template_part('template-parts/sections/banners/logo-company-slider-hero'); ?>

        <?php get_template_part('template-parts/sections/testimonials/slider-testimonials-with-image'); ?>

    </main>

<?php get_footer(); ?>