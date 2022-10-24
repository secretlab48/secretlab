<?php

if (!defined('ABSPATH')) exit;

add_action('init', function () {

    $labels = openup_post_type_labels('Case studies', 'Case studies');

    $args = array(
        'description' => __('Case studies', 'openup'),
        'labels' => $labels,
        'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon'     => 'dashicons-text',
        'rewrite' => ['slug' => 'case-study', 'with_front' => false],
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'taxonomies' => array('case_studies_tax'),
    );

    register_post_type('case_study', $args);

});


add_action('init', function () {

    $tax =  'case_studies_tax';
    $type = ['case_study'];

    $labels = openup_post_type_labels('Case Study Terms', 'Case Study Terms');

    $args = [
        'description'         => 'Case Study Terms',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'case-studies', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);

});