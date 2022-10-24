<?php

if (!defined('ABSPATH')) exit;

get_header();

?>

<main id="main" role="main" tabindex="-1">

    <?php get_template_part('template-parts/sections/banners/main-hero'); ?>

    <?php get_template_part('template-parts/organisms/flexible-content-page'); ?>

    <?php get_template_part('template-parts/sections/newsletter-download'); ?>
</main>


<?php

get_footer();

?>
