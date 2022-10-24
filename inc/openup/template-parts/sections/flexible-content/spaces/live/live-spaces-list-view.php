<?php

/**
 *  Partial: Sections
 *
 *  Partial for loading Sections via file name using a class extending
 *  ACF's flexible content field.
 *
 * @see       inc/acf/acf-sections.php - Sections class
 * @see       inc/fields/* - Defined fields and Sections
 */

if (!defined('ABSPATH')) exit;

global $wpdb;

$request = ( empty( $args[ 'request' ] ) ) ? openup_get_request() : $args[ 'request' ];
$request[ 'ppp' ] = 5;

$current_lang = apply_filters( 'wpml_current_language', NULL );
$thema_page_id = apply_filters( 'wpml_object_id', 662, 'page', true, $current_lang );
$themas_page_url = get_permalink( 662 );

$tax_query = [];
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

$today = date('Ymd');
$meta_query = [
    [
        'key' => 'single_space_start_date_time',
        'value' => $today,
        'type' => 'DATE',
        'compare' => '>='
    ],
];

$spaces_query_object = new WP_Query(
    [
        'post_type' => 'space',
        'post_status' => 'publish',
        'tax_query' => $tax_query,
        'meta_query' => $meta_query,
        'paged' => 1,
        'posts_per_page' => ( ( $request[ 'page' ] * $request[ 'ppp' ] ) + 1 ),
        'meta_key'			=> 'single_space_start_date_time',
        'orderby'			=> 'meta_value',
        'order'				=> 'ASC',
        'supress_filters'   => false
    ]
);

if ( count( $spaces_query_object->posts ) ) {
    //$spaces = array_slice( $spaces->posts, ( $request[ 'page' ] - 1 ) * $request[ 'ppp' ], ( $request[ 'ppp' ] + 1 ) );
    $spaces = $spaces_query_object->posts;
    $needs_pagination = ( count( $spaces ) - ( $request[ 'page' ] * $request[ 'ppp' ] ) > 0 ) ? 1 : 0;
    $wpdb->openup_live_spaces_list_needs_pagination = $needs_pagination;
    for( $i = 0; $i < ( $request[ 'page' ] * $request[ 'ppp' ] ); $i++ ) {
        if ( ! empty( $spaces[ $i ] ) ) {
            $space = $spaces[ $i ];
            $single_space_data = openup_get_single_live_space_data( $space );
            $last_space_in_month = $last_space_in_month_class = '';
            $display_date = date('D j F', strtotime( $single_space_data[ 'start_date' ] ) );
            if ( ! empty( $spaces[ $i + 1 ] ) ) {
                $next = $spaces[ $i + 1 ];
                $next_start_date_time = explode( ' ', get_field( 'single_space_start_date_time', $next->ID ) );
                $next_start_date = $next_start_date_time[ 0 ];
                $next_month = date('m', strtotime( $next_start_date ) );
                $next_month_name = date('F', strtotime( $next_start_date ) );
                $current_month = date('m', strtotime( $single_space_data[ 'start_date' ] ) );
                $current_month_name = date("F", mktime(null, null, null, $current_month, 1) );
                $last_space_in_month = ( $current_month != $next_month ) ? true : false;
                $last_space_in_month_class = $last_space_in_month ? ' last-space-in-month' : '';
            }
            ?>
            <div class="s-live-spaces__item-box live-space-theme-<?php echo $single_space_data[ 'space_type_theme_color' ] . $last_space_in_month_class; ?>">
                <a class="s-live-spaces__item-link" href="<?php echo get_permalink( $space->ID ); ?>"></a>
                <div class="s-live-spaces__item__header-box">
                    <div class="s-live-spaces__item__date">
                        <?php
                        $current_locale = setlocale(LC_ALL, 0);
                        setlocale( LC_ALL, openup_get_locale_name() );
                        $display_date = strftime( '%a %e %b', strtotime( $display_date ) );
                        echo $display_date;
                        setlocale( LC_ALL, $current_locale);
                        ?>
                    </div>
                    <div class="s-live-spaces__item__time-box">
                        <div class="s-live-spaces__item__time"><?php echo $single_space_data[ 'start_time' ] . ' - ' . $single_space_data[ 'finish_time' ]; ?></div>
                    </div>
                </div>
                <div class="s-live-spaces__item__content-box">
                    <div class="s-live-spaces__item__terms-box">
                        <a class="s-live-spaces__item__type-term" href="/?space_type=<?php echo $single_space_data[ 'space_type_term' ]->term_id; ?>" data-space-type-term="<?php echo $single_space_data[ 'space_type_term' ]->term_id; ?>"><?php echo $single_space_data[ 'space_type_term' ]->name; ?></a>
                        <a class="s-live-spaces__item__theme-term" href="<?php echo $themas_page_url . '#' . $single_space_data[ 'space_theme_term' ]->slug . '_' . $single_space_data[ 'space_theme_term' ]->term_id; ?>" data-space-type-term="<?php echo $single_space_data[ 'space_theme_term' ]->term_id; ?>"><?php echo $single_space_data[ 'space_theme_term' ]->name; ?></a>
                    </div>
                    <h6 class="s-live-spaces__item__title-box"><span class="s-live-spaces__item__title"><?php echo $single_space_data[ 'title' ]; ?></span></h6>
                    <div class="s-live-spaces__item__excerpt"><?php echo $single_space_data[ 'description' ]; ?></div>
                </div>
            </div>
            <?php
            if ( $last_space_in_month ) : ?>
                <div class="s-live-spaces__month-divider"><div class="s-live-spaces__month-name"><?php echo $next_month_name; ?></div></div>
            <?php
            endif;
        }
    }
}
if( $spaces_query_object->post_count === 0 ){?>
    <div class="s-spaces__empty-box u-color-primary-dark-blue">
        <img src="<?php echo get_template_directory_uri() ?>/img/media/empty-spaces.png" alt="empty-spaces">
        <div class="s-spaces__empty-title"><?php _e( 'Geen Live Spaces gevonden', 'openup' ) ?></div>
        <div class="s-spaces__empty-suptitle"><?php _e( 'Er zijn geen Live Spaces die overeenkomen met je zoekopdracht', 'openup' ) ?></div>
        <button class="c-btn c-btn-primary--blue s-live-spaces-clear s-live-spaces__filter s-live-spaces__filter-trigger" type="button"><?php _e( 'Filter(s) wissen', 'openup' ) ?></button>
    </div>
<?php }
