<?php /* Template Name: Home Slider Template */

if (!defined('ABSPATH')) exit;

get_header();

?>

    <main id="main" role="main" tabindex="-1">
<?php
$page_id = get_queried_object_id();

?>
        <?php get_template_part('template-parts/sections/banners/main-hero-slider'); ?>
        <?php get_template_part('template-parts/organisms/flexible-content-page'); ?>

    </main>

<?php get_footer(); ?>