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

global $wpdb, $openup_data;

$data = $args[ 'data' ];
$space = get_post( $data[ 'space' ] );

$single_space_data = openup_get_single_live_space_data( $space );
$today_ts = strtotime('today midnight');
$start_date_ts = strtotime( $single_space_data[ 'start_date' ] );
$time_diff = $start_date_ts - $today_ts;
$spaces_page_id = $wpdb->get_row( "SELECT posts.ID, posts.post_title, posts.post_name, icl.language_code FROM wp_posts AS posts INNER JOIN wp_icl_translations AS icl ON posts.ID = icl.element_id WHERE posts.post_name = '" . $openup_data[ 'space_pages' ][ $openup_data[ 'current_lang' ] ] . "' AND posts.post_status = 'publish' AND posts.post_type = 'page' AND icl.language_code = '" . $openup_data[ 'current_lang' ] . "' order by posts.ID ASC", ARRAY_N );
$spaces_page_id = ( ! empty( $spaces_page_id[ 0 ] ) ) ? $spaces_page_id[ 0 ] : 0;
$spaces_page_permalink = get_permalink( $spaces_page_id );
$current_locale = setlocale(LC_ALL, 0);
setlocale( LC_ALL, openup_get_locale_name() );
$display_date = strftime( '%e %B', $start_date_ts );
setlocale( LC_ALL, $current_locale);

$video_block = '';
$single_space_link = '<a class="s-live-spaces__item__single-link" href="' . get_permalink( $space->ID ) . '">' .  __( 'Bekijk Space', 'openup' ) . '</a>';
if ( $time_diff < 36000 ) {
    $video_link = '<div class="calendar-cell__item-card__empty-video_link">' . __( 'No available link', 'openup' ) . '</div>';
    if ( $single_space_data[ 'video_url' ] != '' ) {
        preg_match( '/watch\?v=(.+)$/', $single_space_data[ 'video_url' ], $yt_id  );
        $yt_id = $yt_id[1];
        $video_link = '<a class="calendar-cell__item-card__video-link yt-popup__trigger" href="' . $single_space_data[ 'video_url' ] . '" data-yt_id="' . $yt_id . '" data-space_id="' . $space->ID . '" data-space_title="' . $single_space_data[ 'title' ] . '" data-space_start_date="' . $display_date . '" data-space_type_term_name="' . $single_space_data[ 'space_type_term' ]->name . '">' . __( 'Kijk on-demand Spaces', 'openup' ) . '</a>';
    }
    $single_space_link = '';
    $video_block =
        '<div class="calendar-cell__item-card__video-box"><div class="calendar-cell__item-card__video-notice">' . __( 'Deze Space heeft al plaatsgevonden' ) . '</div>' . $video_link . '</div>';
}

?>

<div class="calendar-cell__item s-live-spaces__item-box live-space-theme-<?php echo $single_space_data[ 'space_type_theme_color' ]; ?>" style="z-index:<?php echo $data[ 'z-index' ]; ?>">
    <span><?php echo $single_space_data[ 'title' ]; ?></span>
    <div class="calendar-cell__item-card-box">
        <div class="calendar-cell__item-card">
            <div class="s-live-spaces__item__header-box">
                <div class="s-live-spaces__item__date-box">
                    <div class="s-live-spaces__item__date"><?php echo $display_date ?></div>
                    <div class="s-live-spaces__item__time-box">
                        <div class="s-live-spaces__item__time"><?php echo $single_space_data[ 'start_time' ] . ' - ' . $single_space_data[ 'finish_time' ]; ?></div>
                    </div>
                </div>
                <div class="s-live-spaces__item__theme-term-box">
                    <a class="s-live-spaces__item__theme-term" href="<?php echo $spaces_page_permalink; ?>/?space_theme=<?php echo $single_space_data[ 'space_theme_term' ]->term_id; ?>" data-space-type-term="<?php echo $single_space_data[ 'space_theme_term' ]->term_id; ?>"><?php echo $single_space_data[ 'space_theme_term' ]->name; ?></a>
                </div>
            </div>
            <div class="s-live-spaces__item__content-box">
                <a class="s-live-spaces__item__type-term" href="/?space_type=<?php echo $single_space_data[ 'space_type_term' ]->term_id; ?>" data-space-type-term="<?php echo $single_space_data[ 'space_type_term' ]->term_id; ?>"><?php echo $single_space_data[ 'space_type_term' ]->name; ?></a>
                <h6 class="s-live-spaces__item__title-box"><a class="s-live-spaces__item__title" href="<?php echo get_permalink( $space->ID ); ?>"><?php echo $single_space_data[ 'title' ]; ?></a></h6>
                <div class="s-live-spaces__item__excerpt"><?php echo $single_space_data[ 'description' ]; ?></div>
                <?php
                    echo $single_space_link;
                    echo $video_block;
                ?>
            </div>
        </div>
    </div>
</div>