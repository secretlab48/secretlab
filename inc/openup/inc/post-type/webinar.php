<?php

if (!defined('ABSPATH')) exit;

add_action('init', function () {

    $labels = openup_post_type_labels('Webinars', 'Webinars');

    $args = array(
        'description' => __('Webinar', 'openup'),
        'labels' => $labels,
        'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon'     => 'dashicons-format-video',
        'rewrite' => ['slug' => 'webinar', 'with_front' => false],
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'taxonomies' => array('post_tag', 'category'),
    );

    register_post_type('webinar', $args);
});


