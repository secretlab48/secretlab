<?php

if (!defined('ABSPATH')) exit;

get_header();

?>

<main id="main" role="main" tabindex="-1">

    <?php get_template_part('template-parts/components/breadcrumbs'); ?>

    <?php get_template_part('template-parts/sections/team/team-member-bio'); ?>

    <?php get_template_part('template-parts/sections/team/team-member-testimonial'); ?>

</main>


<?php

get_footer();

?>
