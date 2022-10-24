<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('Ai1wm_Main_Controller')) return;

/* Excluding Folders while migrating with All-in-One WP Migration */
add_filter('ai1wm_exclude_content_from_export', function ($exclude_filters) {
    $exclude_filters[] = 'themes/openup/node_modules';
    /* $exclude_filters[] = 'updraft'; */
    return $exclude_filters;
});
