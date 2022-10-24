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
$spaces = $args[ 'spaces' ];
$currentMonth = $args[ 'currentMonth' ];
$queryStartDate = $args[ 'queryStartDate' ];
$queryFinishDate = $args[ 'queryFinishDate' ];


?>

<div class="calendar">

    <?php
    $spaces_data = [];
    foreach( $spaces as $space ) {
        $start_date = get_field( 'single_space_start_date_time', $space->ID );
        $spaces_data[] = [ 'date' => date('Ymd', strtotime( $start_date ) ), 'space' => $space ];
    }

    $currentCycleDate = $queryStartDate;
    $finishCycleDate = date( 'Ymd', strtotime ( '+1 day' , strtotime ( $queryFinishDate ) ) );
    $i = 1;
    $left_sided_space_cards = [ 1, 2, 3, 4, 8, 9, 10, 11, 15, 16, 17, 18, 22, 23, 24, 25, 29, 30, 31, 32 ];
    $vacation_cells = [ 6, 7, 13, 14, 20, 21, 27, 28, 34, 35 ];
    $today = date('Ymd');
    while( $currentCycleDate != $finishCycleDate ) {
        $currentCycleDateTimeStamp = strtotime( $currentCycleDate );
        $currentCycleDateFormat = date('Ymd',$currentCycleDateTimeStamp);
        $currentCycleDateMonth = date( 'm', $currentCycleDateTimeStamp );
        $currentCycleDateMonthDay = date( 'j', $currentCycleDateTimeStamp );
        $cell_spaces = [];
        $z = count( $spaces_data );
        foreach ( $spaces_data as $data ) {
            if ( $data[ 'date'] == $currentCycleDate ) {
                $data[ 'z-index' ] = $z;
                ob_start();
                get_template_part( 'template-parts/sections/flexible-content/spaces/live/live-spaces-calendar-cell', null, [ 'data' => $data ] );
                $cell_spaces[] = ob_get_contents();
                ob_end_clean();
                $z -= 1;
            }
            else {

            }
        }
        $cell_spaces_html = ( count( $cell_spaces ) > 0 ) ? '<div class="calendar-cell__items">' . implode( '', $cell_spaces ) . '</div>' : '';
        $empty_css_class = ( count( $cell_spaces ) > 0 ) ? ' content-cell' : ' empty-cell';
        $current_month_cell_class = ( $currentCycleDateMonth == $currentMonth ) ? ' current-month-cell' : ' not-current-month-cell';
        $left_sided_space_cards_class = ( in_array( $i, $left_sided_space_cards ) ) ? ' left-sided-space-cards' : ' right-sided-space-cards';
        $vacation_cell_class = ( in_array( $i, $vacation_cells ) ) ?  ' vacation-day-cell' : ' regular-day-cell';
        ?>
        <div class="calendar-cell<?php echo $current_month_cell_class . $left_sided_space_cards_class . $vacation_cell_class . $empty_css_class; ?>">
            <div class="calendar-cell__month-day <?php echo $today == $currentCycleDateFormat ? 'calendar-cell__current-day' : null; ?>"><?php echo $currentCycleDateMonthDay; ?></div>
            <?php echo $cell_spaces_html; ?>
        </div>
        <?php $currentCycleDate = date( 'Ymd', strtotime ( '+1 day' , $currentCycleDateTimeStamp ) );
        $i++;
    }
    ?>

</div>
