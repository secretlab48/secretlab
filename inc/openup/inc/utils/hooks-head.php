<?php

if (!defined('ABSPATH')) exit;


/**
 * Global Variables for Javascript stuff.
 */
add_action('wp_head', function () {
    global $wp_query;
    $json = array(
        'admin_ajax' => admin_url('admin-ajax.php'),
        'themeUrl' => get_bloginfo('template_directory'),
        'siteUrl' => get_home_url(),
        'page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
    );
    $json = apply_filters( 'openup_localize_vars', $json, 10, 1 );
    ?>
    <script>
        var appLocations = <?php echo json_encode($json, JSON_PRETTY_PRINT); ?>;
    </script>
    <?php
});


/**
 * Apply Global / Page Tracking To Header
 */
add_action('wp_head', function () {
    $global_tracking_meta = (class_exists('ACF')) ? get_field('global_tracking_metas', 'options') : null;
    $global_tracking_head = (class_exists('ACF')) ? get_field('global_tracking_head', 'options') : null;

    if ($global_tracking_meta) echo $global_tracking_meta;
    if ($global_tracking_head) echo $global_tracking_head;
});
