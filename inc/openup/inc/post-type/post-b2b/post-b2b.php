<?php

if (!defined('ABSPATH')) exit;

add_action('init', function () {

    $labels = openup_post_type_labels('Business Posts', 'Business Posts');

    $args = array(
        'description' => __('Business Posts', 'openup'),
        'labels' => $labels,
        'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon'     => 'dashicons-building',
        'rewrite' => ['slug' => 'business-post', 'with_front' => false],
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'taxonomies' => array('posts_b2b'),
    );

    register_post_type('business_post', $args);

});


add_action('init', function () {

    $tax =  'business_posts_types_tax';
    $type = ['business_post'];

    $labels = openup_post_type_labels('Business Posts Types', 'Business Posts Types');

    $args = [
        'description'         => 'Business Post Type',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'business-types', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);


    $tax =  'business_posts_themas_tax';
    $type = ['business_post'];

    $labels = openup_post_type_labels('Business Posts Themas', 'Business Posts Themas');

    $args = [
        'description'         => 'Business Post Thema',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'business-themas', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);


    $tax =  'business_posts_author_tax';
    $type = ['business_post'];

    $labels = openup_post_type_labels('Business Posts Authors', 'Business Posts Authors');

    $args = [
        'description'         => 'Business Post Author',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'business-authors', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);


});