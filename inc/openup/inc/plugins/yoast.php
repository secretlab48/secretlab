<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('WPSEO_Options')) return;


//Remove Yoast HTML Comments
add_filter('wpseo_debug_markers', '__return_false');

//move yoast metabox to bottom of page
add_filter('wpseo_metabox_prio', function () {
    return 'low';
});
