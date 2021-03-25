<?php

register_taxonomy('portfolios_cat', array( 'portfolio' ), array(
    'label' => __( 'Portfolios Taxonomy', 'recruit'),
    'labels' => array(
        'name' => __( 'Portfolios Categoties', 'recruit'),
        'singular_name' => __( 'Portfolios Category', 'recruit'),
        'search_items' => __('Search Portfolios Category', 'recruit'),
        'all_items' => __('All Portfolios Categories', 'recruit'),
        'parent_item' => __('Parent Portfolios Category', 'recruit'),
        'parent_item_colon' => __('Parent Portfolios Category', 'recruit'),
        'edit_item' => __('Edit Portfolios Category', 'recruit'),
        'update_item' => __('Update Portfolios Category', 'recruit'),
        'add_new_item' => __('Add Portfolios Category', 'recruit'),
        'new_item_name' => __('New Portfolios Category', 'recruit'),
        'menu_name' => __( 'Portfolios Category', 'recruit'),
    ),
    'description' => __( 'Portfolios Categories', 'recruit'),
    'public' => true,
    'show_in_nav_menus' => true,
    'show_ui' => true,
    'show_tagcloud' => true,
    'hierarchical' => true,
    //'rewrite'               => array('slug'=>'resume_cats', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
    'show_admin_column' => true,
));



register_post_type('portfolio' , array(
    'label' => __( 'portfolios', 'recruit' ),
    'labels' => array(
        'name' => __( 'portfolios', 'recruit' ),
        'singular_name' => __( 'Portfolios', 'recruit' ),
        'menu_name' => __( 'Portfolios', 'recruit' ),
        'all_items' => __( 'All Portfolios', 'recruit' ),
        'add_new' => __( 'Add Portfolio Post', 'recruit' ),
        'add_new_item' => __('Add New Portfolio', 'recruit' ),
        'edit' => __( 'Edit', 'recruit' ),
        'edit_item' => __( 'Edit Portfolio Post', 'recruit' ),
        'new_item' => __( 'New Portfolio Post', 'recruit' ),
    ),
    'description' => '',
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_rest' => false,
    'rest_base' => '',
    'show_in_menu' => true,
    'exclude_from_search' => false,
    'capability_type' => array( 'portfolio', 'portfolios' ),
    'map_meta_cap' => false,
    'capabilities' => array(
        'publish_posts' => 'publish_portfolios',
        'edit_posts' => 'edit_portfolios',
        'edit_others_posts' => 'edit_others_portfolios',
        'edit_published_posts' => 'edit_published_portfolios',
        'delete_posts' => 'delete_portfolios',
        'delete_others_posts' => 'delete_others_portfolios',
        'read_private_posts' => 'read_private_portfolios',
        'edit_post' => 'edit_portfolio',
        'delete_post' => 'delete_portfolio',
        'read_post' => 'read_portfolio',
    ),
    'hierarchical' => true,
    'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false, 'pages' => true, 'feeds' => false, 'feed' => false ),
    'has_archive' => 'portfolios',
    'query_var' => true,
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'author' ),
    'taxonomies' => array( 'portfolios_cat' ),
));


add_rewrite_rule( '^ru/blog/(.+)/page/(.+)/?$', 'index.php?category_name=$matches[1]&paged=$matches[2]&lang=ru', 'top' );
add_rewrite_rule( '^blog/(.+)/page/(.+)/?$', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top' );
add_rewrite_rule( '^ru/blog/(.+)/(.+)/?$', 'index.php?name=$matches[2]&lang=ru', 'top' );
add_rewrite_rule( '^blog/(.+)/(.+)/?$', 'index.php?name=$matches[2]', 'top' );
add_rewrite_rule( '^blog/(.+)/?$', 'index.php?category_name=$matches[1]', 'top' );
//flush_rewrite_rules();

remove_post_type_support( $post_type = 'portfolio', $supports = 'revisions' );

add_theme_support( 'responsive-embeds' );


add_action( 'admin_init', function() {

    //$role = get_role( 'student' );

    $role = get_role( 'administrator' );
    $role->add_cap( 'publish_portfolios' );
    $role->add_cap( 'edit_portfolios' );
    $role->add_cap( 'edit_others_portfolios' );
    $role->add_cap( 'edit_published_portfolios' );
    $role->add_cap( 'delete_portfolios' );
    $role->add_cap( 'delete_private_portfolios' );
    $role->add_cap( 'delete_others_portfolios' );
    $role->add_cap( 'read_private_portfolios' );
    $role->add_cap( 'edit_portfolio' );
    $role->add_cap( 'delete_portfolio' );
    $role->add_cap( 'read_portfolio' );

}, 99 );