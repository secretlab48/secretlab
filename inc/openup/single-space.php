<?php /* Template Name: Spaces single*/

global $post;

get_header();

$space_type = get_field( 'single_cpace_availability_type', $post->ID );
$data = openup_get_single_live_space_data( $post );
preg_match( '/watch\?v=(.+)$/', $data[ 'video_url' ], $yt_id  );
$yt_id = ( ! empty( $yt_id[1] ) ) ? $yt_id[1] : '';
$current_lang = apply_filters( 'wpml_current_language', NULL );
$thema_page_id = apply_filters( 'wpml_object_id', 662, 'page', true, $current_lang );
$themas_page_url = get_permalink( 662 );
if ( $data[ 'space_type_theme_color' ] == 'blue' ) {
    $bg_color = 'blue';
    $text_color = 'white';
    $btn_bg_color = 'c-btn-primary--dark-blue';
}
else if( $data[ 'space_type_theme_color' ] == 'green' ) {
    $bg_color = 'green';
    $text_color = 'white';
    $btn_bg_color = 'c-btn-primary--blue';
}
else if( $data[ 'space_type_theme_color' ] == 'skin' ) {
    $bg_color = 'skin';
    $text_color = 'dark-blue';
    $btn_bg_color = 'c-btn-primary--blue';
}

?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php get_template_part('template-parts/organisms/flexible-content-page'); ?>
            <section class="o-main-hero o-spaces-hero u-bg-primary-<?php echo $bg_color; ?> u-color-primary-<?php echo $text_color; ?>">
                <div class="container">
                    <div class="row justify-content-lg-between o-spaces-hero__row">
                        <div class="col-12 col-lg-5 o-spaces-hero__container u-bg-secondary-<?php echo $bg_color; ?>">
                            <div class="o-spaces-hero__history">
                                <span></span>
                                <?php echo __( 'Spaces to OpenUp', 'openup' ); ?>
                            </div>
                            <h1 class="o-main-hero__title"><?php echo $data[ 'title' ]; ?></h1>
                            <div class="o-spaces-hero__tag">
                                <?php echo $data[ 'space_type_term' ]->name; ?>
                            </div>
                            <ul class="o-spaces-hero__list">
                                <li>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/calendar.png"
                                         alt="">
                                    <span>
                                        <?php
                                        $current_locale = setlocale(LC_ALL, 0);
                                        setlocale( LC_ALL, openup_get_locale_name() );
                                        echo strftime( '%A %e %B %Y', strtotime( $data[ 'start_date' ] ) );/*date( 'l j F Y', strtotime( $data[ 'start_date' ] ) );*/
                                        setlocale( LC_ALL, $current_locale);
                                        ?>, <?php echo $data[ 'start_time' ]; ?> - <?php echo $data[ 'finish_time' ]; ?></span>
                                </li>
                                <li class="o-spaces-hero__list__theme_terms_box">
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/tag.png" alt="">
                                    <?php if ( $data[ 'space_theme_terms' ] ) : ?>
                                        <div class="o-spaces-hero__list__theme_terms">
                                            <?php
                                                foreach( $data[ 'space_theme_terms' ] as $theme_term ) : ?>
                                                    <a href="<?php echo $themas_page_url . '#' . $theme_term->slug . '_' . $theme_term->term_id; ?>"><?php echo $theme_term->name; ?></a>
                                            <?php
                                                endforeach;
                                            ?>
                                        </div>
                                        <?php
                                    endif;
                                    ?>
                                </li>
                                <li>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/Union.png" alt="">
                                    <span><?php echo ucfirst( openup_get_lang_name( ICL_LANGUAGE_CODE ) ); ?></span>
                                </li>
<!--                                <li>-->
<!--                                    <img src="--><?php //echo get_template_directory_uri() ?><!--/img/global/triangle.png"-->
<!--                                         alt="">-->
<!--                                    <a href="--><?php //echo $data[ 'room_link' ]; ?><!--" target="_blank">--><?php //echo __( 'Bekijk Space', 'openup' ); ?><!--</a>-->
<!--                                </li>-->
                            </ul>
                            <div class="o-main-hero__description">
                                <p>
                                    <?php echo $data[ 'description' ]; ?>
                                </p>
                            </div>
                            <div class="o-spaces-hero__btn--wrap">
                                <!--<div class="o-spaces-hero__btn">
                                    <a class="c-btn c-btn-primary--white" href="<?php echo $data[ 'register_url' ]; ?>"><?php echo __( 'Add to calendar', 'openup' ); ?></a>
                                </div>-->
                                <div class="o-spaces-hero__btn">
                                    <?php
                                    if ( $data[ 'space_type_theme_color' ] == 'green' ) :
                                    ?>
                                    <div class="o-spaces-hero__btn-message"></div>
                                    <?php
                                    endif;
                                    ?>
                                    <button class="c-btn JS-open-modal <?php echo $btn_bg_color; ?>" data-yt_id="<?php echo $yt_id; ?>" data-space_id="<?php echo $post->ID; ?>" data-space_title="<?php echo $data[ 'title' ]; ?>" data-space_start_date="<?php echo date('F j',strtotime( $data[ 'start_date' ] ) ); ?>" data-space_type_term_name="<?php echo $data[ 'space_type_term' ]->name; ?>"><?php echo __( 'Aanmelden voor Space', 'openup' ); ?></button>
                                </div>
                            </div>
                            <?php
                            $langs = openup_get_lang_menu_items();
                            $langs_items = [];
                            $native_permalink = get_permalink( $post->ID );
                            foreach ( $langs as $lang ) {
                                if ( $lang != ICL_LANGUAGE_CODE ) {
                                    $lang_post_id = apply_filters('wpml_object_id', $post->ID, 'space', false, $lang);
                                    if ( $lang_post_id ) {
                                        $lang_post_permalink = apply_filters( 'wpml_permalink', $native_permalink, $lang );
                                        $langs_items[] = '<a class="o-spaces-hero__available-langs__post" href="' . $lang_post_permalink . '" data-space_language="' . $lang . '"><img src="' . get_stylesheet_directory_uri() . '/img/global/flags/' . $lang . '.svg" /></a>';
                                    }
                                }
                            }
                            if ( count( $langs_items ) > 0 ) :
                            ?>
                            <div class="o-spaces-hero__available-langs__box">
                                <div class="o-spaces-hero__available-langs__title"><?php echo __( 'Deze space is ook beschikbaar in:', 'openup' ); ?></div>
                                    <div class="o-spaces-hero__available-langs">
                                    <?php echo implode( '', $langs_items ); ?>
                                    </div>
                            </div>
                            <?php
                            endif;
                            ?>
                        </div>
                        <div class="col-12 col-md-8 col-lg-5 o-spaces-hero__media">
                            <div class="o-spaces-hero__img">
                                <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php

get_footer(); ?>
