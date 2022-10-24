<?php
add_action('init', function () {

    $tax =  'thema_areas-taxonomy';
    $type = ['thema', 'post', 'team', 'testimonials', 'ebook', 'webinar', 'space'];

    $labels = openup_post_type_labels('Thema Areas', 'Thema Areas');

    $args = [
        'description'         => 'Thema Areas',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'thema-areas', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);
});


