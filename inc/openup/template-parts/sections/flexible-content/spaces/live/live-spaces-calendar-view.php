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

$daysOfWeeks = [ __( 'ma', 'openup' ), __( 'di', 'openup' ), __( 'wo', 'openup' ), __( 'do', 'openup' ), __( 'vr', 'openup' ), __( 'za', 'openup' ), __( 'zo', 'openup' ) ];

$request = ( empty( $args[ 'request' ] ) ) ? openup_get_request() : $args[ 'request' ];
$request[ 'ppp' ] = -1;

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
$language_clause = [];
/*if ( ! empty( $request [ 'space_language' ] ) && $request[ 'space_language' ] != 'world' ) {
    $language_clause = [
        'key'		=> 'single_space_language',
        'value'		=> $request[ 'space_language' ],
        'compare'	=> '='
    ];
}*/

$currentMonthDateTimeStamp = strtotime( $request[ 'request_month' ] );
$currentMonthDate = date('Ymd', strtotime( $request[ 'request_month' ] ) );
$currentMonth = date('m', strtotime( $request[ 'request_month' ] ) );
$currentYear = date('Y', strtotime( $request[ 'request_month' ] ) );
$firstCurrentMonthDay = date('Ym01', $currentMonthDateTimeStamp );
$firstCurrentMonthDayWeekNumber = date('N', strtotime( $firstCurrentMonthDay ) );
$lastCurrentMonthDay = date('Ymt', $currentMonthDateTimeStamp );
$lastCurrentMonthDayWeekNumber = date('N', strtotime( $lastCurrentMonthDay ) );
$queryStartDateTimeStampt = ( strtotime ( '-' . ( $firstCurrentMonthDayWeekNumber - 1 ) . ' day' , strtotime ( $firstCurrentMonthDay ) ) );
$queryStartDate = date( 'Ymd', $queryStartDateTimeStampt );
$queryFinishDateTimeStampt = ( strtotime ( '+' . ( 7 - $lastCurrentMonthDayWeekNumber ) . ' day' , strtotime ( $lastCurrentMonthDay ) ) );
$queryFinishDate = date( 'Ymd', $queryFinishDateTimeStampt );
$meta_query = [
    /*[
        'key'		=> 'single_cpace_availability_type',
        'value'		=> 'live',
        'compare'	=> '='
    ],*/
    $language_clause,
    [
        'key' => 'single_space_start_date_time',
        'value' => $queryStartDate,
        'type' => 'DATE',
        'compare' => '>='
    ],
    [
        'key' => 'single_space_finish_date_time',
        'value' => $queryFinishDate,
        'type' => 'DATE',
        'compare' => '<='
    ],
];

$spaces = new WP_Query(
    [
        'post_type' => 'space',
        'post_status' => 'publish',
        'tax_query' => $tax_query,
        'meta_query' => $meta_query,
        'paged' => $request[ 'page' ],
        'posts_per_page' => -1,
        'meta_key'			=> 'single_space_start_date_time',
        'orderby'			=> 'meta_value',
        'order'				=> 'ASC',
        'supress_filters'   => false
    ]
);
$spaces = $spaces->posts;

$current_lang = apply_filters( 'wpml_current_language', null );
$space_start_dates = $wpdb->get_results( "SELECT posts.ID, meta.meta_value, icl.language_code FROM wp_postmeta AS meta INNER JOIN wp_icl_translations AS icl ON meta.post_id = icl.element_id INNER JOIN wp_posts AS posts ON meta.post_id = posts.ID WHERE meta.meta_key = 'single_space_start_date_time' AND posts.post_status = 'publish' AND icl.language_code = '" . $current_lang . "' order by meta_value ASC", ARRAY_N );
$space_start_dates_array = [];
$calendar_slider_items = '';
$data_request_month = 'none';
$n = 0;
foreach ( $space_start_dates as $i => $start_date ) {
    $ts = strtotime( $start_date[1] );
    $month = date( 'm', $ts );
    $year = date( 'Y', $ts );
    $index =  $year . $month .'01';
    if($currentYear == $year && $month >= $currentMonth - 1) {
        if (empty($space_start_dates_array[$index])) {
            $current_date_css_class = '';
            if ($currentYear == $year && $currentMonth == $month) {
                $current_date_css_class = ' current-date';
                $data_request_month = $index;
            }
            $space_start_dates_array[$index] = ['month' => $month, 'year' => $year];
            $current_locale = setlocale(LC_ALL, 0);
            setlocale( LC_ALL, openup_get_locale_name() );
            $month_year = strftime('%B %Y', $ts);
            setlocale( LC_ALL, $current_locale);
            $calendar_slider_items .= '<div class="space__calendar-slider__item swiper-slide' . $current_date_css_class . '" data-date="' . $index . '" data-n="' . $n . '">' . $month_year . '</div>';
            $n++;
        }
    }
}
$calendar_slider =
    '<div class="space__calendar-slider swiper s-live-spaces__filter" data-request_month="' . $data_request_month . '">
      <div class="space__calendar-slider__wrapper swiper-wrapper">' . $calendar_slider_items . '</div>
    
      <div class="space__calendar-slider__nav-button space__calendar-slider__nav-button__prev swiper-button-prev1" data-rirection="prev">
        <svg class="icon-angle">
            <use xlink:href="#icon-angle-left"></use>
        </svg>
      </div>
      <div class="space__calendar-slider__nav-button space__calendar-slider__nav-button__next swiper-button-next1" data-direction="next">
        <svg class="icon-angle">
            <use xlink:href="#icon-angle-right"></use>
        </svg>
      </div>
    </div>';


if ( count( $spaces ) > 0 || 1 == 1 ) : ?>
    <div class="s-live-spaces__calendar">
        <div class="calendar-wrapper">
            <div class="s-live-spaces__calendar-nav"><?php echo $calendar_slider; ?></div>
            <div class="calendar-week-days">
            <?php
                foreach( $daysOfWeeks as $daysOfWeek ) {
                    echo '<div class="day-name">' . $daysOfWeek . '</div>';
                }
            ?>
            </div>
            <?php
                get_template_part( 'template-parts/sections/flexible-content/spaces/live/live-spaces-calendar-table', null,
                    [
                        'request' => $request,
                        'spaces' => $spaces,
                        'currentMonth' => $currentMonth,
                        'queryStartDate' => $queryStartDate,
                        'queryFinishDate' => $queryFinishDate
                    ] );
            ?>
        </div>
    </div>
    <div class="s-live-spaces__space-type-color-themes">
        <?php
            $space_type_terms = get_terms( array(
                'taxonomy' => 'space_type',
                'hide_empty' => true,
            ) );
            foreach ( $space_type_terms as $space_type_term ) {
                $color = get_field('space_type_color_theme', $space_type_term->taxonomy . '_' . $space_type_term->term_id);
                echo '<div class="space_type_color_them-item color-' . $color . '">' . $space_type_term->name . '</div>';
            }
        ?>
    </div>
<?php
endif;