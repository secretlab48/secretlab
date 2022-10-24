<?php

if (!defined('ABSPATH')) exit;

add_action('init', function () {

    $labels = openup_post_type_labels('FAQ', 'FAQ');

    $args = array(
        'description' => __('FAQ', 'openup'),
        'labels' => $labels,
        'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon'     => 'dashicons-feedback',
        'rewrite' => ['slug' => 'faq', 'with_front' => false],
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
    );

    register_post_type('faq', $args);
});

add_action('init', function () {

    $tax =  'faq_type';
    $type = ['faq'];

    $labels = openup_post_type_labels('Faq Type', 'Faq Type');

    $args = [
        'description'         => 'Faq Type',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'faq_type', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);
});

