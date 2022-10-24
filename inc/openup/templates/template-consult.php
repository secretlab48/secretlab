<?php /* Template Name: Boek Consult Template */

if (!defined('ABSPATH')) exit;

get_header(); ?>

    <main id="main" role="main" tabindex="-1">

        <?php get_template_part('template-parts/sections/boek-consult/boek-consult-start'); ?>

        <?php get_template_part('template-parts/sections/boek-consult/als-particulier'); ?>

        <?php get_template_part('template-parts/sections/boek-consult/als-particulier-two-step'); ?>

        <?php get_template_part('template-parts/sections/boek-consult/via-werkgever'); ?>

        <?php get_template_part('template-parts/sections/boek-consult/via-werkgever-search'); ?>

        <?php get_template_part('template-parts/sections/boek-consult/teams'); ?>

    </main>

<?php get_footer(); ?>