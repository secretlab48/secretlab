<?php

if (!defined('ABSPATH')) exit;

add_action('init', function () {

    $labels = openup_post_type_labels('Testimonials', 'Testimonials');

    $args = array(
        'description' => __('Testimonial', 'openup'),
        'labels' => $labels,
        'supports' => ['title', 'revisions'],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon'     => 'dashicons-megaphone',
        'rewrite' => ['slug' => 'testimonials', 'with_front' => false],
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
    );

    register_post_type('testimonials', $args);
});



