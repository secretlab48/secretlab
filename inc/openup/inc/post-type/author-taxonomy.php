<?php
add_action('init', function () {

    $tax =  'author-taxonomy';
    $type = ['thema', 'post', 'team','testimonials', 'ebook', 'webinar'];

    $labels = openup_post_type_labels('Author', 'Author');

    $args = [
        'description'         => 'Author',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'author', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);
});


