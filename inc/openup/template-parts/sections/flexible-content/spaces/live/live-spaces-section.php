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

global $post, $wpdb;
$post_id = ( ! empty( $post->ID ) ) ? $post->ID : $_POST[ 'post_id' ];

$view_type = get_sub_field( 'live_spaces_section_view_type' );

$request = openup_get_request();
$request[ 'ppp' ] = ( $request[ 'view' ] == 'list' ) ? 5 : -1;
$request[ 'view' ] = ! empty( $view_type ) ? $view_type : $request[ 'view' ];

$empty_term = new stdClass();
$empty_term->term_id = 0;
$empty_term->name = __( 'Filter(s) wissen', 'openup' );

$space_type_terms = get_terms( array(
    'taxonomy' => 'space_type',
    'hide_empty' => true,
) );
array_unshift($space_type_terms, $empty_term );

$space_theme_terms = get_terms( array(
    'taxonomy' => 'thema_areas-taxonomy',
    'hide_empty' => true,
) );
array_unshift($space_theme_terms, $empty_term );

$switcher_cation = $request[ 'view' ] == 'list' ? __( 'Kalender', 'openup' ) : __( 'Lijst', 'openup' );

?>

<section id="s-live-spaces" class="s-live-spaces <?php echo $request[ 'view' ]; ?>-view">
    <div class="s-live-spaces__ajax-holder">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between">
                <h1 id="s-live-spaces__langs" class="s-live-spaces__section-title"><?php echo __( 'Live Spaces', 'openup' ); ?></h1>
                <div class="s-live-spaces__nav-box col">
                    <div class="s-live-spaces__langs-box s-live-spaces__left-item-box s-live-spaces__filter__faked s-live-spaces__filter__space_language" data-space_language="<?php echo $request[ 'space_language' ];  ?>">
                        <?php
                            $langs = openup_get_lang_menu_items();
                            $query_string = ( ! empty( $_SERVER['QUERY_STRING'] ) ) ? '?' . $_SERVER['QUERY_STRING'] : '';
                            foreach ( $langs as $lang ) {
                                $active_lang_class = ( $lang == ICL_LANGUAGE_CODE ) ? ' active' : '';
                                $page_id = apply_filters( 'wpml_object_id', $post_id, 'page', true, $lang );
                                $page_url = apply_filters( 'wpml_permalink', get_permalink( $page_id ), $lang ) . '#s-live-spaces';
                                echo '<a class="s-live-spaces__lang-link' . $active_lang_class . ' s-live-spaces__filter-trigger" href="' . $page_url . '" data-space_language="' . $lang . '"><img src="' . get_stylesheet_directory_uri() . '/img/global/flags/' . $lang . '.svg" /></a>';
                            }
                        ?>
                    </div>
                    <div class="s-live-spaces__right-item-box">
                        <div class="s-live-spaces__right-item">
                            <div class="c-drop-down s-live-spaces__filter s-live-spaces__filter__space_type_term color-theme__dark-blue" data-space_type_term="<?php echo implode( ',', $request[ 'space_type_term' ] ); ?>">
                                <span class="c-drop-down__main u-bg-primary-skin">
                                    <span class="c-drop-down__main-text"><?php echo __( 'Type Space', 'openup' ); ?></span>
                                    <svg class="icon">
                                        <use xlink:href="#icon-chevron-down"></use>
                                    </svg>
                                </span>
                                <div class="c-drop-down__list-wrap u-bg-primary-skin">
                                    <ul class="c-drop-down__list">
                                        <?php
                                            foreach( $space_type_terms as $space_type_term ) :
                                                $active_type_class = ( in_array( $space_type_term->term_id, $request[ 'space_type_term' ] ) && $space_type_term->term_id != 0 ) ? ' current-item' : '';
                                        ?>
                                                <li class="c-drop-down__list-item s-live-spaces__filter-trigger s-live-spaces__filter-trigger__space_type_term<?php echo $active_type_class; ?>" data-space_type_term="<?php echo $space_type_term->term_id; ?>">
                                                    <a class="u-color-primary-dark-blue" href="#">
                                                        <?php echo $space_type_term->name; ?>
                                                    </a>
                                                </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="c-drop-down s-live-spaces__filter s-live-spaces__filter__space_theme_term color-theme__dark-blue" data-space_theme_term="<?php echo implode( ',', $request[ 'space_theme_term' ] ); ?>">
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
                                            $active_theme_class = ( in_array( $space_theme_term->term_id, $request[ 'space_theme_term' ] ) && $space_theme_term->term_id != 0  ) ? ' current-item' : '';
                                    ?>
                                        <li class="c-drop-down__list-item s-live-spaces__filter-trigger s-live-spaces__filter-trigger__space_theme_term<?php echo $active_theme_class; ?>" data-space_theme_term="<?php echo $space_theme_term->term_id; ?>">
                                            <a class="u-color-primary-dark-blue" href="#">
                                                <?php echo $space_theme_term->name; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="s-live-spaces__view-selector-box s-live-spaces__right-item">
                            <div class="s-live-spaces__view-selector s-live-spaces__filter s-live-spaces__filter-trigger" data-view="<?php echo $request[ 'view' ]; ?>"><?php echo $switcher_cation; ?></div>
                        </div>
                    </div>
                </div>
                <div class="s-live-spaces__content-box col">
                    <div class="s-live-spaces__content">
                        <div class="s-live-spaces__items" data-view="<?php echo $request[ 'view' ]; ?>">
                            <?php
                                get_template_part( 'template-parts/sections/flexible-content/spaces/live/live-spaces-' . $request[ 'view' ] . '-view', null, [ 'request' => $request ] );
                                $pagination_disabled_class = ( ! empty( $wpdb->openup_live_spaces_list_needs_pagination ) && $wpdb->openup_live_spaces_list_needs_pagination == 1 ) ? '' : ' disabled';
                            ?>
                        </div>
                        <?php if ( $request[ 'view' ] == 'list' ) : ?>
                            <div class="s-live-spaces__blurred-bar"></div>
                        <?php endif; ?>
                    </div>
                    <?php if ( $request[ 'view' ] == 'list' ) : ?>
                    <div class="s-live-spaces__load-more-box">
                        <a class="s-live-spaces__load-more-button s-live-spaces__filter s-live-spaces__filter__page s-live-spaces__filter-trigger s-live-spaces__filter-trigger__pagination c-btn-outline c-btn-outline-primary--dark-blue<?php echo $pagination_disabled_class; ?>" href="#" data-page="<?php echo $request[ 'page' ]; ?>"><?php echo __( 'Bekijk meer Spaces', 'openup' ); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>