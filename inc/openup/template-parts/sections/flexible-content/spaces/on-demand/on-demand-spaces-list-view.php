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

$request = $args[ 'request' ];
$spaces = ! empty ( $args [ 'spaces' ] ) ? $args[ 'spaces' ] : openup_do_spaces_on_demand_request( $request );

if ( count( $spaces->posts ) ) {
    $spaces = array_slice( $spaces->posts, 0, ( $request[ 'page' ] * $request[ 'ppp' ] ) );
    for( $i = 0; $i < ( $request[ 'page' ] * $request[ 'ppp' ] ); $i++ ) {
        if ( ! empty( $spaces[ $i ] ) ) {
            $space = $spaces[ $i ];
            $single_space_data = openup_get_single_live_space_data( $space );
            $today_ts = strtotime('today midnight');
            $start_date_ts = strtotime( $single_space_data[ 'start_date' ] );
            $time_diff = $start_date_ts - $today_ts;
            $current_locale = setlocale(LC_ALL, 0);
            setlocale( LC_ALL, openup_get_locale_name() );
            $display_date = strftime( '%e %B', $start_date_ts );
            setlocale( LC_ALL, $current_locale);
            preg_match( '/watch\?v=(.+)$/', $single_space_data[ 'video_url' ], $yt_id  );
            $yt_id = $yt_id[1];
            ?>
            <div class="s-on-demand-spaces__item-box yt-popup__trigger on-demand-space-theme-<?php echo $single_space_data[ 'space_type_theme_color' ]; ?>"
                 data-yt_id="<?php echo $yt_id; ?>"
                 data-space_id="<?php echo $space->ID; ?>"
                 data-space_title="<?php echo $single_space_data[ 'title' ]; ?>"
                 data-space_start_date="<?php echo date('F j',strtotime( $single_space_data[ 'start_date' ] ) ); ?>"
                 data-space_type_term_name="<?php echo $single_space_data[ 'space_type_term' ]->name; ?>">
                <div class="s-on-demand-spaces__item__header-box">
                    <div class="s-on-demand-spaces__item__video-poster-box">
                        <?php echo wp_get_attachment_image( $single_space_data[ 'video_poster' ][ 'ID' ], 'full' ); ?>
                    </div>
                    <div class="s-on-demand-spaces__item__video-duration"><?php echo $single_space_data[ 'video_duration' ] ?></div>
                </div>
                <div class="s-on-demand-spaces__item__content-box">
                    <h6 class="s-on-demand-spaces__item__title-box"><span class="s-on-demand-spaces__item__title"><?php echo $single_space_data[ 'title' ]; ?></span></h6>
                    <div class="s-on-demand-spaces__item__date-terms-box">
                        <div class="s-on-demand-spaces__item__date"><?php echo $display_date ?> </div><b>&#183; </b>
                        <a class="s-on-demand-spaces__item__theme-term" href="/?space_theme=<?php echo $single_space_data[ 'space_theme_term' ]->term_id; ?>" data-space-type-term="<?php echo $single_space_data[ 'space_theme_term' ]->term_id; ?>"><?php echo $single_space_data[ 'space_theme_term' ]->name; ?></a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
