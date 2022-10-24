<?php

if (!defined('ABSPATH')) exit;

add_action('init', function () {

    $labels = openup_post_type_labels('Team', 'Teams');

    $args = array(
        'description' => __('Team', 'openup'),
        'labels' => $labels,
        'supports' => ['title', 'thumbnail', 'revisions'],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon'     => 'dashicons-groups',
        'rewrite' => ['slug' => 'team', 'with_front' => false],
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',

    );

    register_post_type('team', $args);
});

add_action('init', function () {
    
    $tax =  'team_position';
    $type = ['team'];

    $labels = openup_post_type_labels('Job Roles', 'Job Roles');

    $args = [
        'description'         => 'Job Roles',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'job-roles', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);
});

/*----------------------------------------
 Consult Types Taxonomy
------------------------------------------*/

add_action('init', function () {

    $tax =  'consult_type';
    $type = ['team', 'boek_consult'];

    $labels = openup_post_type_labels('Consult Types', 'Consult Types');

    $args = [
        'description'         => 'Consult Types',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'consult-types', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);
});


/*----------------------------------------
 Visible Flags Functionality
------------------------------------------*/

define( 'FLAGS_DIR_PATH_URI', get_stylesheet_directory_uri() . '/img/global/flags/' );
define( 'FLAGS_DIR_PATH', get_stylesheet_directory() . '/img/global/flags/' );

add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style( 'team-lang-sortable-css', get_template_directory_uri() . '/src/scss/admin/team-languages.css' );
    wp_enqueue_script( 'team-lang-sortable-js', get_template_directory_uri() . '/src/js/admin/team-languages.js' );
} );

add_filter( 'acf/load_field/name=team_visible_languages', 'team_visible_languages_field_checkbox' );

function team_visible_languages_field_checkbox( $field ) {
    global $wpdb, $post;

    if ( is_object( $post ) ) {
        $data = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key = 'team_visible_languages'");
        if (count($data) > 0) {
            $db_values = unserialize($data[0]->meta_value);
            if (is_array($db_values)) {
                $selected = $unselected = [];
                foreach ($field['choices'] as $choice_value => $choice_title) {
                    if (!in_array($choice_value, $db_values)) {
                        $unselected[$choice_value] = $choice_title;
                    }
                }
                foreach ($db_values as $db_value) {
                    $selected[$db_value] = $field['choices'][$db_value];
                }
                $field['choices'] = array_merge($selected, $unselected);
            }
        }
    }

    return $field;

}

function team_render_card_flags( $langs, $langs_quantity = 0 ) {

    $out =  '';
    $length = is_array( $langs ) ? count( $langs ) : 0;
    if ( $length > 0 ) {
        $langs_quantity = ( $langs_quantity > 0 ) ? $langs_quantity : count( $langs );
        $langs = array_slice( $langs, 0, $langs_quantity );
        $langs = array_reverse( $langs );
        $out .= '<div class="c-team-card__flags-box">';
        foreach ( $langs as $i => $lang ) {
            $style = '';
            $img_src = file_exists( FLAGS_DIR_PATH . $lang . '.svg' ) ? FLAGS_DIR_PATH_URI . $lang . '.svg' : FLAGS_DIR_PATH_URI . $lang . '.jpg';
            $out .= '<img class="c-team-card__flag ' . $lang . '-flag" ' . $style . ' src="' . $img_src . '" />';
        }
        $out .= '</div>';
    }

    return $out;

}

add_filter('manage_team_posts_columns', function( $columns ) {
    return array_merge( $columns, [ 'team_languages' => __( 'Languages', 'openup' ) ] );
});

add_action('manage_team_posts_custom_column', function( $column_key, $post_id ) {
    if ( $column_key == 'team_languages' ) {
        echo team_render_card_flags( get_field( 'team_visible_languages', $post_id ) );
    }
}, 10, 2);