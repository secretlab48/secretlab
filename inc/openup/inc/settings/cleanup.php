<?php

if (!defined('ABSPATH')) exit;

/**
 * WPCleanUp
 * Some methods to clean up various grimey wp stuff.
 */
class WPCleanUp
{

    function __construct()
    {
        add_action('init', [$this, 'clean_head']);
    }

    function clean_head()
    {
        // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
        remove_action('wp_head', 'feed_links', 2);

        // removes all extra rss feed links
        remove_action('wp_head', 'feed_links_extra', 3);

        // remove really simple discovery link
        remove_action('wp_head', 'rsd_link');

        // remove wlwmanifest.xml (needed to support windows live writer)
        remove_action('wp_head', 'wlwmanifest_link');

        // remove wordpress version
        remove_action('wp_head', 'wp_generator');

        // Remove shortlink
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

        remove_action('wp_head', 'print_emoji_detection_script', 7);

        remove_action('wp_head', 'wp_oembed_add_discovery_links');

        remove_action('wp_head', 'wp_oembed_add_host_js');

        remove_action('wp_print_styles', 'print_emoji_styles');

        add_filter('emoji_svg_url', '__return_false');

    }
}

new WPCleanUp;
