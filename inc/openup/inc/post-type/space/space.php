<?php

if (!defined('ABSPATH')) exit;

require_once( 'LiveStorm/livestorm.php' );

add_action('init', function () {

    $labels = openup_post_type_labels('Spaces', 'Spaces');

    $args = array(
        'description' => __('Space', 'openup'),
        'labels' => $labels,
        'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon'     => 'dashicons-video-alt3',
        'rewrite' => ['slug' => 'space', 'with_front' => false],
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'taxonomies' => array('space_type'),
    );

    register_post_type('space', $args);

    remove_post_type_support( 'space', 'editor' );

    add_rewrite_rule( '^spaces/([^/]+$)', 'index.php?post_type=space&name=$matches[1]' );
    add_rewrite_rule( '^es/espacios/([^/]+$)', 'index.php?post_type=space&name=$matches[1]' );

    add_filter( 'post_type_link', function( $post_link, $post, $leavename, $sample ) {

        global $openup_data;

        if ( $post->post_type == 'space' ) {
            if ( $openup_data[ 'current_lang' ] != 'es' ) {
                $post_link = str_replace( 'space', 'spaces', $post_link );
            }
        }

        return $post_link;

    }, 100, 4 );

});


add_action('init', function () {

    //$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?key=AIzaSyD4L6P1Woklqtryk5pn5BzXDaFV1InSaEQ&part=snippet&&part=contentDetails&id=qAKD7ifWtO4");
    //$json = json_decode($data);

    $tax =  'space_type';
    $type = ['space'];

    $labels = openup_post_type_labels('Space Type', 'Space Type');

    $args = [
        'description'         => 'Space Type',
        'labels'              => $labels,
        'hierarchical'        => true,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'show_in_quick_edit'  => true,
        'show_in_menu'        => true,
        'rewrite'             => ['slug' => 'space_type', 'with_front' => false],
    ];

    register_taxonomy($tax, $type, $args);
});


/* Functions */

function openup_get_timezoned_date( $ts, $timezone = 'Europe/Amsterdam', $format = 'Y-m-d H:i:s' ) {

    $dt = new DateTime();
    $dt->setTimestamp( $ts );
    $dt->setTimezone( new DateTimeZone( $timezone ) );

    return $dt->format( $format );

}


/* Service function - to get outer Request Param */

function openup_get_outer_request_param( $param_name = '' ) {
    $stores = [ $_GET, $_POST, $_COOKIE ];
    foreach ( $stores as $store ) {
        if ( ! empty( $store[ $param_name ] ) ) {
            return $store[ $param_name ];
        }
    }

    return false;
}

/* Service function - to get Request Params */

function openup_get_request( $default_request = false ) {

    $request = [];
    if ( ! $default_request ) {
        $default_request = [
            'space_availability_type' => 'live',
            'view' => 'list',
            'space_language' => 'en',
            'space_type_term' => [ 0 ],
            'space_theme_term' => [ 0 ],
            'request_type' => '',
            'request_month' => date('Ymd' ),
            'page' => 1
        ];
    }
    foreach ( $default_request as $name => $default_value ) {
        $outer_value = openup_get_outer_request_param( $name );
        $request[ $name ] = $outer_value ? $outer_value : $default_value;
    }

    return $request;

}

add_action( 'wp_ajax_live_spaces_request', 'openup_live_spaces_request' );
add_action( 'wp_ajax_nopriv_live_spaces_request', 'openup_live_spaces_request' );

function openup_live_spaces_request() {

    global $wpdb;

    $request = openup_get_request();

    ob_start();
    get_template_part( 'template-parts/sections/flexible-content/spaces/live/live-spaces-section', null, [ 'request' => $request ] );
    $out = ob_get_contents();
    ob_end_clean();

    echo json_encode( [ 'live_spaces_list' => $out ] );
    wp_die();

}

function openup_get_single_live_space_data( $space = null ) {

    $data = [];

    $data[ 'space_type_term' ] = wp_get_post_terms( $space->ID, 'space_type', [ 'fields' => 'all' ] );
    $data[ 'space_type_term' ] = ( ! empty( $data[ 'space_type_term' ][ 0 ] ) && is_object( $data[ 'space_type_term' ][ 0 ] ) ) ? $data[ 'space_type_term' ][ 0 ] : false;
    $data[ 'space_type_theme_color' ] = ( is_object( $data[ 'space_type_term' ] ) ) ? get_field('space_type_color_theme', $data[ 'space_type_term' ]->taxonomy . '_' . $data[ 'space_type_term' ]->term_id ) : 'green';
    $data[ 'space_theme_term' ] = wp_get_post_terms( $space->ID, 'thema_areas-taxonomy', [ 'fields' => 'all' ] );
    $data[ 'space_theme_terms' ] = $data[ 'space_theme_term' ];
    $data[ 'space_theme_term' ] = ( ! empty( $data[ 'space_theme_term' ][ 0 ] ) && is_object( $data[ 'space_theme_term' ][ 0 ] ) ) ? $data[ 'space_theme_term' ][ 0 ] : false;
    $data[ 'space_start_date_time' ] = explode( ' ', get_field( 'single_space_start_date_time', $space->ID ) );
    $data[ 'start_date' ] = ! empty( $data[ 'space_start_date_time' ][ 0 ] ) ? $data[ 'space_start_date_time' ][ 0 ] : '';
    $data[ 'start_time' ] = ! empty( $data[ 'space_start_date_time' ][ 1 ] ) ? $data[ 'space_start_date_time' ][ 1 ] : '';
    $data[ 'space_finish_date_time' ] = explode( ' ', get_field( 'single_space_finish_date_time', $space->ID ) );
    $data[ 'finish_date' ] = ( ! empty( $data[ 'space_finish_date_time' ][ 0 ] ) ) ? $data[ 'space_finish_date_time' ][ 0 ] : '';
    $data[ 'finish_time' ] = ! empty ( $data[ 'space_finish_date_time' ][ 1 ] ) ? $data[ 'space_finish_date_time' ][ 1 ] : '';
    $data[ 'title' ] = get_field( 'single_space_title', $space->ID );
    $data[ 'description' ] = get_field( 'single_space_description', $space->ID );
    $data[ 'excerpt' ] = implode( ' ', array_slice( explode( ' ', $data[ 'description' ] ),0, 11 ) );
    $data[ 'register_url' ] = get_field( 'single_space_register_url', $space->ID );
    $data[ 'register_url' ] = ( ! empty( $data[ 'register_url' ] ) ) ? $data[ 'register_url' ] : '#';
    $data[ 'video_url' ] = get_field( 'single_space_video_url', $space->ID );
    $data[ 'video_duration' ] = get_field( 'single_space_video_duration', $space->ID );
    $data[ 'video_poster' ] = get_field( 'single_space_video_poster', $space->ID );
    $data[ 'lang' ] = get_field('single_space_language', $space->ID );
    $data[ 'event' ] = get_post_meta( $space->ID,'openup_space_event', true );
    $data[ 'session' ] = get_post_meta( $space->ID, 'openup_space_session', true );
    $data[ 'room_link' ] = get_post_meta( $space->ID, 'openup_space_room_link', true );

    return $data;

}


add_action( 'wp_ajax_on_demand_spaces_request', 'openup_on_demand_spaces_request' );
add_action( 'wp_ajax_nopriv_on_demand_spaces_request', 'openup_on_demand_spaces_request' );

function openup_on_demand_spaces_request() {

    global $wpdb;

    $request = openup_get_request();
    if ( is_array( $_POST[ 'space_type_term' ] ) ) {
        $space_type_term = [];
        foreach ( $_POST[ 'space_type_term' ] as $term_id => $value ) {
            if ( $value == 1 ) {
                $space_type_term[] = $term_id;
            }
        }
        $space_type_term = ( count( $space_type_term ) > 0 ) ? $space_type_term : [ 0 ];
        $request[ 'space_type_term' ] = $space_type_term;
    }
    $request[ 'ppp' ] = 12;

    ob_start();
    get_template_part( 'template-parts/sections/flexible-content/spaces/on-demand/on-demand-spaces-section', null, [ 'request' => $request ] );
    $out = ob_get_contents();
    ob_end_clean();

    echo json_encode( [ 'live_spaces_list' => $out ] );
    wp_die();

}


function openup_do_spaces_on_demand_request( $request ) {

    $today = date('Ymd');
    $tax_query = [];

    /* GroupSession Spaces must be exluded from query */
    $group_session_term = get_terms(array(
        'taxonomy'			=> 'space_type',
        'meta_query'		=> array(
            'relation'		=> 'AND',
            array(
                'key'			=> 'space_type_color_theme',
                'value'			=> 'green',
                'compare'		=> '='
            )
        )
    ));
    if ( ! empty( $group_session_term[ 0 ] ) ) {
        $group_session_term = $group_session_term[ 0 ];
        $tax_query[] =
            [
                'taxonomy' => 'space_type',
                'field'    => 'id',
                'terms'    => [ $group_session_term->term_id ],
                'operator' => 'NOT IN',
            ];
    }

    if ( ! empty( $request[ 'space_type_term' ] ) && count( $request[ 'space_type_term' ] ) > 0 && ! in_array( 0, $request[ 'space_type_term' ] ) ) {
        $tax_query[] =
            [
                'taxonomy' => 'space_type',
                'field' => 'term_id',
                'terms' => $request[ 'space_type_term' ]
            ];
    }
    if ( ! empty( $request[ 'space_theme_term' ] ) && count( $request[ 'space_theme_term' ] ) > 0 && ! in_array( 0, $request[ 'space_theme_term' ] ) ) {
        $tax_query[] =
            [
                'taxonomy' => 'thema_areas-taxonomy',
                'field' => 'term_id',
                'terms' => $request[ 'space_theme_term' ]
            ];
    }
    $meta_query = [
        [
            'key' => 'single_space_start_date_time',
            'value' => $today,
            'type' => 'DATE',
            'compare' => '<'
        ],
        [
            'key'		=> 'single_space_video_url',
            'value'		=> '',
            'compare'	=> '!='
        ]
    ];

    $spaces = new WP_Query(
        [
            'post_type' => 'space',
            'post_status' => 'publish',
            'tax_query' => $tax_query,
            'meta_query' => $meta_query,
            'paged' => 1,
            'posts_per_page' => -1,
            'meta_key'			=> 'single_space_start_date_time',
            'orderby'			=> 'meta_value',
            'order'				=> 'DESC'
        ]
    );

    return $spaces;

}

add_action( 'wp_ajax_openup_get_session_data', 'openup_get_session_data' );
add_action( 'wp_ajax_openup_get_session_data', 'openup_get_session_data' );

function openup_get_session_data() {

    global $wpdb, $openup_data;

    $session_id = $_POST[ 'session_id' ];

    LiveStormIntegration::init();
    $session = LiveStormIntegration::getEventSession( $session_id );
    if ( $session ) {
        $spaces_page_id = $wpdb->get_row( "SELECT posts.ID, posts.post_title, posts.post_name, icl.language_code FROM wp_posts AS posts INNER JOIN wp_icl_translations AS icl ON posts.ID = icl.element_id WHERE posts.post_name = '" . $openup_data[ 'space_pages' ][ $openup_data[ 'current_lang' ] ] . "' AND posts.post_status = 'publish' AND posts.post_type = 'page' AND icl.language_code = '" . $openup_data[ 'current_lang' ] . "' order by posts.ID ASC", ARRAY_N );
        $spaces_page_id = ( ! empty( $spaces_page_id[ 0 ] ) ) ? $spaces_page_id[ 0 ] : 0;
        $spaces_page_permalink = get_permalink( $spaces_page_id );
        $result = [ 'result' => true, 'session_data' => $session, 'message' => __( 'Het maximum aantal deelnemers voor deze Space is bereikt.', 'opentup' ) . '<a class="o-spaces-hero__btn-message__link" href="' . $spaces_page_permalink . '">' . __( 'Probeer één van onze andere Spaces', 'openup' ) . '</a>' ];
    }
    else {
        $result = [ 'result' => false ];
    }

    echo json_encode( $result );
    wp_die();

}


function openup_get_lang_name( $lang ) {
    $langs = [
        'en' => __( 'Engels', 'openup' ),
        'de' => __( 'Duits', 'openup' ),
        'fr' => __( 'Frans', 'openup' ),
        'nl' => __( 'Nederlands', 'openup' ),
        'es' => __( 'Spaans', 'openup' )
    ];

    return ( ! empty( $langs[ $lang ] ) ) ? $langs[ $lang ] : '';
}


function openup_get_locale_name() {

    $locales = [ 'nl' => 'nl_NL', 'en' => 'en_EN', 'de' => 'de_DE', 'fr' => 'fr_FR', 'es' => 'es_ES' ];
    $current_lang = apply_filters( 'wpml_current_language', NULL );

    return ( ! empty( $locales[ $current_lang ] ) ) ? $locales[ $current_lang ] : 'en_EN';

}

function openup_get_lang_menu_items() {

    $items = [
        'nl' => [ 'nl', 'en', 'de', 'fr', 'es' ],
        'en' => [ 'en', 'nl', 'de', 'fr', 'es' ],
        'de' => [ 'de', 'en', 'nl', 'fr', 'es' ],
        'fr' => [ 'fr', 'en', 'nl', 'de', 'es' ],
        'es' => [ 'es', 'en', 'nl', 'de', 'fr' ],
    ];

    return ( ! empty( $items[ ICL_LANGUAGE_CODE ] ) ) ? $items[ ICL_LANGUAGE_CODE ] : '';

}

add_action( 'wp_footer', function() {

    global $post;

    if ( is_object( $post ) ) {
        $layouts = get_post_meta($post->ID, 'flexible_content_page', true);
        if ( is_array( $layouts ) && in_array('live_spaces_section', $layouts ) ) {
            get_template_part('template-parts/sections/flexible-content/spaces/popups/youtube-video-popup');
            echo '<div class="spaces-service-box"></div>';
        }
    }
} );


function openup_update_system_options() {

    //openup_convert_posts_to_busines_posts( );
    //openup_set_all_spaces_linkedin_images();
    //return;

    //openup_convert_posts_to_busines_posts( );
    //openup_set_all_spaces_linkedin_images();
    //return;

    $result = [ 'got_google_sheet' => false, 'got_db_option' => false, 'values' => 0, 'db_result' => false ];

    $service = openup_get_google_service();

    $spreadsheetId = '1XQCARTeOqzEu_bA-xkJQorVS9pP6AIlYRxWStVsP5mo';

    $range = 'URL lijst';
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    if ( $values ) {
        array_shift( $values );
        $result[ 'got_google_sheet' ] = true;
        $result[ 'values' ] = count( $values );
        $options = get_option( 'openup_options' );
        if ( ! empty( $options ) ) {
            $result[ 'got_db_option' ] = true;
        }
        else {
            $options = [ 'livestorm' => '' ];
        }
        $options[ 'livestorm' ] = $values;
        $db_result = update_option('openup_options', $options, true);
    }
    $result[ 'db_result' ] = ( !empty( $db_result ) ) ? true : false;

    if ( count( $_GET ) == 0 ) {
        echo json_encode($result);
        wp_die();
    }
    else {
        return $result;
    }

}

add_action( 'admin_menu', function() {
    add_submenu_page( 'tools.php', 'Google Sheet Livestom Data', 'Google Sheet Livestom Data', 'manage_options', 'livestorm-data', 'openup_get_livestorm_admin_page' );
} );

function openup_get_livestorm_admin_page() {

    $options = get_option( 'openup_options' );

    $records = 0;
    if ( ! empty( $options[ 'livestorm' ] ) ) {
        $records = count( $options[ 'livestorm' ] );
    }

    echo '<div class="livestorm-data__box"><div class="livestorm-data__update"><span class="livestorm-data__records">Update local data</span><div class="livestorm-data__ajax"></div></div></div></div>';

}

add_action( 'wp_ajax_openup_livestorm_data_update', 'openup_update_system_options' );

add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_script( 'livestorm-admin', get_stylesheet_directory_uri() . '/src/js/admin/livestorm.js' );
} );


add_action( 'add_meta_boxes', 'openup_add_space_livestorm_box', 99 );
function openup_add_space_livestorm_box(){
    $screens = array( 'space' );
    add_meta_box( 'space_livestorm_box', 'LiveStorm Events & Sessions', 'openup_render_space_livestorm_box', $screens, 'normal', 'low' );
}

function openup_render_space_livestorm_box( $post, $meta ) {

    global $wpdb, $post;

    $out = wp_nonce_field( plugin_basename(__FILE__), 'openup_space_nonce', true, false );
    $openup_space_event = get_post_meta( $post->ID, 'openup_space_event', 1 );
    $openup_space_session = get_post_meta( $post->ID, 'openup_space_session', 1 );
    $openup_space_room_link = get_post_meta( $post->ID, 'openup_space_room_link', 1 );

    $a = 'ebe47b868ddfae8afc6d9ff200c735f8';

    $events = LiveStormIntegration::getEvents( [ 'filter' => [ 'scheduling_status' => 'upcoming' ] ] );
    if ( ! empty( $events->data ) && count( $events->data ) > 0 ) {
        $out .=
            '<div class="ls-admin__events">
                <input type="text" class="openup_space_event" name="openup_space_event" value="'. $openup_space_event . '" />
                <input type="text" class="openup_space_session" name="openup_space_session" value="'. $openup_space_session . '" />
                <input type="text" class="openup_space_room_link" name="openup_space_room_link" value="'. $openup_space_room_link . '" />
                <div class="ls-admin__events-box">';
        foreach( $events->data as $i => $event ) {
            $event_attrs = $event->attributes;
            $css_active_class = ( ( $openup_space_event == $event->id ) ) ? ' active' : '';
            $out .=
                '<div class="ls-admin__event' . $css_active_class . '" data-event_id="' . $event->id . '">
                         <div class="ls-admin__event__name">' . $event_attrs->title . '</div>';
            $sessions = LiveStormIntegration::getEventSessions( $event->id, [ 'filter' => [ 'status' => null ] ] );
            if ( count( $sessions->data ) > 0 ) {
                $out .= '<div class="ls-admin__event__sessions">';
                foreach( $sessions->data as $session ) {
                    $session_attrs = $session->attributes;
                    $is_selected_session = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE meta_key = 'openup_space_session' AND meta_value = '" . $session->id . "'" );
                    $can_be_reselected_css_class = $is_selected_session_css_class = $is_recommended_item_css_class = '';
                    if ( $is_selected_session ) {
                        $current_lang = apply_filters( 'wpml_current_language', null );
                        $is_selected_session_css_class = ' selected-session-already';
                        $can_be_reselected_css_class = ( $post->ID == $is_selected_session->post_id ) ? ' can-be-reselected' : '';
                        if ( $current_lang != 'nl' ) {
                            $parent_post_id = apply_filters( 'wpml_object_id', $post->ID, 'space', false, 'nl' );
                            $is_selected_session_by_parent_space = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE post_id = " . $parent_post_id . " AND meta_key = 'openup_space_session' AND meta_value = '" . $session->id . "'" );
                            if ( $is_selected_session_by_parent_space ) {
                                $is_recommended_item_css_class = ' recommended-item';
                            }
                        }
                    }

                    $css_active_class = ( $openup_space_session == $session->id ) ? ' active' : '';
                    $out .= '<div class="ls-admin__event__session' . $css_active_class . $is_selected_session_css_class . $can_be_reselected_css_class . $is_recommended_item_css_class . '" data-session_id="' . $session->id . '" data-room_link="' . $session_attrs->room_link . '">'. $session_attrs->status . ', ' . openup_get_timezoned_date($session_attrs->estimated_started_at, $session_attrs->timezone, 'Y-m-d H:i:s') . ', ' . $session_attrs->timezone . '</div>';
                }
                $out .= '</div>';
            }
            $out .= '</div>';
            usleep( 215000 );
        }
        $out .= '</div>';
    }

    $screens = $meta['args'];

    echo $out;

}

add_action( 'acf/save_post', 'openup_space_post_type_save_postdata' );

function openup_space_post_type_save_postdata( $post_id ) {

    $p = get_post( $post_id );

    if ( !empty( $p->post_type ) && $p->post_type == 'space' ) {
        if (!wp_verify_nonce($_POST['openup_space_nonce'], plugin_basename(__FILE__)) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE))
            return;

        if (!empty($_POST['openup_space_event']) && !empty($_POST['openup_space_session'])) {
            if ($_POST['openup_space_event'] != 'empty') {
                $event = LiveStormIntegration::getEvent($_POST['openup_space_event']);
                if ($event) {
                    $event_attrs = $event->data->attributes;
                    $session = LiveStormIntegration::getEventSession($_POST['openup_space_session']);
                    if ($session) {
                        $session_attrs = $session->data->attributes;
                        $start_date = openup_get_timezoned_date($session_attrs->estimated_started_at, $session_attrs->timezone, 'Y-m-d H:i:s');
                        $finish_time = $session_attrs->estimated_started_at + $event_attrs->estimated_duration * 60;
                        $finish_date = openup_get_timezoned_date($finish_time, $session_attrs->timezone, 'Y-m-d H:i:s');
                        update_post_meta($post_id, 'openup_space_event', $_POST['openup_space_event']);
                        update_post_meta($post_id, 'openup_space_session', $_POST['openup_space_session']);
                        update_post_meta($post_id, 'openup_space_room_link', $session_attrs->room_link);
                        update_field('single_space_start_date_time', $start_date, $post_id);
                        update_field('single_space_finish_date_time', $finish_date, $post_id);
                    }
                }
            } else {
                delete_post_meta($post_id, 'openup_space_event');
                delete_post_meta($post_id, 'openup_space_session');
                delete_post_meta($post_id, 'openup_space_room_link');
                update_field('single_space_start_date_time', '', $post_id);
                update_field('single_space_finish_date_time', '', $post_id);
            }
        }
    }
}


add_action( 'wp_ajax_openup_assign_attendee_to_event', 'openup_assign_attendee_to_event' );
add_action( 'wp_ajax_nopriv_openup_assign_attendee_to_event', 'openup_assign_attendee_to_event' );

function openup_get_guzzlehttp_error( $e ) {

    $errors = json_decode($e->getResponse()->getBody()->getContents(), true);
    $errors = ( $errors[ 'errors' ] ) ? $errors[ 'errors' ] : [ [ 'title' => 'No available data', 'detail' => 'It is not possible to decode error message' ] ];
    $error = $errors[ 0 ];

    return $error;

}

function openup_assign_attendee_to_event () {

    global $openup_data, $wpdb;

    if ( ! empty( $_POST[ 'session_id' ] ) ) {
        $spaces_page = $wpdb->get_row( "SELECT posts.ID, posts.post_title, posts.post_name, icl.language_code FROM wp_posts AS posts INNER JOIN wp_icl_translations AS icl ON posts.ID = icl.element_id WHERE posts.post_name = '" . $openup_data[ 'space_pages' ][ $openup_data[ 'current_lang' ] ] . "' AND posts.post_status = 'publish' AND posts.post_type = 'page' AND icl.language_code = '" . $openup_data[ 'current_lang' ] . "' order by posts.ID ASC", OBJECT );
        $spaces_page_link = get_permalink( $spaces_page->ID );
        $session_id = $_POST[ 'session_id' ];
        $field_names = ['first_name', 'email', 'employer', 'openup_friends_and_family', 'not_offered_by_organization'];
        $fields = $result = [];

        foreach ($field_names as $field_name) {
            if (!empty($_POST[$field_name])) {
                $fields[] = ['id' => $field_name, 'value' => $_POST[$field_name]];
            }
        }

        try {
            $request = LiveStormIntegration::registerSessionAttendee($session_id, $fields);
            $result = [ 'result' => 1, 'title' => __( 'Dankjewel!', 'openup' ), 'content' => __( 'Controleer je inbox voor de uitnodiging.', 'openup' ), 'button_link' => $spaces_page_link, 'error' => '' ];
        }
        catch( Exception $e ) {
            $error = openup_get_guzzlehttp_error( $e );
            $error_messages = [
                '/person has already been invited/' => [ 'title' => __( 'Oeps', 'openup' ), 'description' => __( 'Dit e-mailadres staat al ingeschreven voor deze sessie.', 'openup' ), 'button_title' => __( 'Bekijk agenda', 'openup' ), 'button_link' => $spaces_page_link ],
                '/session already joined/' => [ 'title' => __( 'Oeps', 'openup' ), 'description' => __( 'Dit e-mailadres staat al ingeschreven voor deze sessie.', 'openup' ), 'button_title' => __( 'Bekijk agenda', 'openup' ), 'button_link' => $spaces_page_link ],
                '/reached the limit for/' => [ 'title' => __( 'Deze groepssessie is vol', 'openup' ), 'description' => __( 'Er zijn helaas geen plekken meer beschikbaar voor deze sessie. Bekijk onze agenda om je aan te melden voor een andere sessie.', 'openup' ), 'button_title' => __( 'Bekijk agenda', 'openup' ), 'button_link' => $spaces_page_link ]
            ];
            $show_predefined_messages = false;
            foreach ( $error_messages as $pattern => $data ) {
                if ( preg_match( $pattern . 'i', $error[ 'title' ] ) || preg_match( $pattern . 'i', $error[ 'detail' ] ) ) {
                    $result = [ 'result' => 0, 'title' => $data[ 'title' ], 'content' => $data[ 'description' ], 'button_title' => $data[ 'button_title' ], 'button_link' => $data[ 'button_link' ], 'error' => 'error-message'];
                    $show_predefined_messages = true;
                }
            }
            if ( !$show_predefined_messages ) {
                $result = [ 'result' => 0, 'title' => $error[ 'title' ], 'content' => $error[ 'detail' ], 'button_title' => __( 'Doorgaan', 'openup' ), 'error' => 'error-message'];
            }
        }

    }

    echo json_encode( $result );
    wp_die();

}



