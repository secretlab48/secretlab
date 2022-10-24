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

$request = ! empty( $args[ 'request' ] ) ? $args[ 'request' ] : openup_get_request();
$request[ 'space_availability_type' ] = 'on_demand';
$request[ 'view' ] = 'list';
$request[ 'ppp' ] = 12;

$empty_term = new stdClass();
$empty_term->term_id = 0;
$empty_term->name = __( 'Filter(s) wissen', 'openup' );

$space_type_terms = get_terms( array(
    'taxonomy' => 'space_type',
    'hide_empty' => true,
) );

$space_theme_terms = get_terms( array(
    'taxonomy' => 'thema_areas-taxonomy',
    'hide_empty' => true,
) );
array_unshift($space_theme_terms, $empty_term );

$spaces = openup_do_spaces_on_demand_request( $request );
$pagination_disabled_class = ( count( $spaces->posts ) - ( $request[ 'page'] * $request[ 'ppp' ] ) ) > 0 ? '' : ' disabled';

?>

<section id="s-on-demand-spaces" class="s-on-demand-spaces <?php echo $request[ 'view' ]; ?>-view">
    <div class="s-live-spaces__ajax-holder">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between">
                <div class="s-on-demand-spaces__nav-box col-lg-12">
                    <h1 class="s-on-demand-spaces__section-title"><?php echo __( 'On-Demand', 'openup' ); ?></h1>
                    <div class="s-on-demand-spaces__section__nav-terms-box">
                        <?php
                            $request_type_terms = ! is_array( $request[ 'space_type_term' ] ) ? explode( ',', $request[ 'space_type_term' ] ) : $request[ 'space_type_term' ];
                            foreach ( $space_type_terms as $space_type_term ) {
                                $term_color = get_field('space_type_color_theme', $space_type_term->taxonomy . '_' . $space_type_term->term_id );
                                if ( $term_color != 'green' ) {
                                    $current_item_class = ( in_array( $space_type_term->term_id, $request_type_terms ) ) ? ' current-item' : '';
                                    echo '<div class="s-on-demand-spaces__filter s-on-demand-spaces__filter__space_type_term s-on-demand-spaces__filter-trigger c-btn-outline c-btn-outline-primary--dark-blue' . $current_item_class . '" href="/?space_type_term=' . $space_type_term->term_id . '" data-space_type_term="' . $space_type_term->term_id . '" data-request_type="replace" data-request_key="space_type_term" data-request_value="' . $space_type_term->term_id . '">' . $space_type_term->name . '</div>';
                                }
                            }
                        ?>
                        <div class="c-drop-down s-on-demand-spaces__filter s-on-demand-spaces__filter__space_theme_term color-theme__blue" data-space_theme_term="<?php echo implode( ',', $request[ 'space_theme_term' ] ); ?>">
                            <span class="c-drop-down__main u-bg-primary-skin">
                                <span class="c-drop-down__main-text"><?php echo __( 'Thema(s)', 'openup' ); ?></span>
                                <svg class="icon">
                                    <use xlink:href="#icon-chevron-down"></use>
                                </svg>
                            </span>
                            <div class="c-drop-down__list-wrap u-bg-primary-skin">
                                <ul class="c-drop-down__list">
                                    <?php
                                    foreach( $space_theme_terms as $space_theme_term ) :
                                        $active_theme_class = ( in_array($space_theme_term->term_id, $request[ 'space_theme_term' ] ) && $space_theme_term->term_id != 0  ) ? ' current-item' : '';
                                        ?>
                                        <li class="c-drop-down__list-item s-on-demand-spaces__filter-trigger s-on-demand-spaces__filter__trigger__space_theme_term<?php echo $active_theme_class; ?>" data-space_theme_term="<?php echo $space_theme_term->term_id; ?>" data-request_type="replace" data-request_key="space_theme_term" data-request_value="<?php echo $space_theme_term->term_id; ?>">
                                            <a class="u-color-primary-dark-blue" href="#">
                                                <?php echo $space_theme_term->name; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="s-on-demand-spaces__content-box col">
                    <div class="s-on-demand-spaces__list-box">
                        <div class="s-on-demand-spaces__list">
                            <?php get_template_part( 'template-parts/sections/flexible-content/spaces/on-demand/on-demand-spaces-' . $request[ 'view' ] . '-view', null, [ 'request' => $request, 'spaces' => $spaces ]  ); ?>
                        </div>
                        <div class="s-on-demand-spaces__blurred-bar"></div>
                    </div>
                    <div class="s-on-demand-spaces__load-more-box">
                        <a class="s-on-demand-spaces__load-more-button s-on-demand-spaces__filter s-on-demand-spaces__filter__page s-on-demand-spaces__filter__page s-on-demand-spaces__filter-trigger s-on-demand-spaces__filter-trigger__pagination c-btn-outline c-btn-outline-primary--dark-blue<?php echo $pagination_disabled_class; ?>" href="#" data-page="<?php echo $request[ 'page' ]; ?>" data-request_type="add" data-request_key="page" data-request_value="<?php echo $request[ 'page' ]; ?>"><?php echo __( 'Bekijk meer', 'openup' ); ?></a>
                    </div>
                </div>
            </div>
            <?php if( $spaces->post_count === 0 ){?>
            <div class="s-spaces__empty-box u-color-primary-white">
                <img src="<?php echo get_template_directory_uri() ?>/img/media/empty-ondemand.png" alt="empty-spaces">
                <div class="s-spaces__empty-title"><?php _e( 'Geen On Demand Spaces gevonden', 'openup' ) ?></div>
                <div class="s-spaces__empty-suptitle"><?php _e( 'Er zijn geen On Demand Spaces die overeenkomen met je zoekopdracht', 'openup' ) ?></div>
                <button class="c-btn c-btn-primary--dark-blue s-on-demand-spaces-clear s-on-demand-spaces__filter-trigger s-on-demand-spaces__filter" type="button"><?php _e( 'Filter(s) wissen', 'openup' ) ?></button>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
