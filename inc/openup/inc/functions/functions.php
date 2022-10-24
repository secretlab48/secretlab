<?php
require_once 'ajax-functions/ajax-functions.php';
require_once 'redirect-functions.php';

/* Remove xml-rpc */

add_filter('xmlrpc_enabled', '__return_false');

/* Set Global OpenUp Data */

add_action( 'init', function() {
    global $post, $openup_data;

    $openup_data = [];
    $openup_data[ 'page_type' ] = 'b2c';
    $openup_data[ 'current_lang' ] = apply_filters('wpml_current_language', NULL);
    $openup_data[ 'space_pages' ] = [
        'nl' => 'spaces', 'en' => 'spaces', 'de' => 'spaces', 'fr' => 'spaces', 'es' => 'espacios'
    ];

    add_rewrite_rule( '^blog/([^/]+$)', 'index.php?post_type=post&name=$matches[1]' );

    add_filter( 'post_link', function( $post_link, $post, $leavename ) {

        global $openup_data;

        if ( $post->post_type == 'post' ) {
            $post_link = str_replace( '/post/', '/blog/', $post_link );
        }

        return $post_link;

    }, 100, 4 );

    /* Strange bug - ACF format_value filter distorts 'team_slider_teams' value
       This is fix
       TODO - remove custom fix whenbug will gone with ACF update
    */

    add_filter( 'acf/format_value/type=relationship', function( $value, $post_id, $field ) {

        global $openup_data;

        $prefix = ( $openup_data[ 'current_lang' ] == 'nl' ) ? '' : $openup_data[ 'current_lang' ] . '_';
        $corrected_value = [];

        if ( $field[ 'name' ] == 'team_slider_teams' ) {
            $native_value = get_option( 'options_' . $prefix . 'team_slider_teams' );
            if ( is_array( $native_value ) && count( $native_value ) > 0 ) {
                foreach ($native_value as $id) {
                    $corrected_value[] = get_post($id);
                }
                $value = $corrected_value;
            }
        }

        return $value;

    }, 99, 3 );

} );

add_action( 'wp', function() {

    global $post, $openup_data;

    if ( is_singular() ) {
        $openup_data[ 'business_page_id' ] = apply_filters( 'wpml_object_id', 38851, 'page', true, $openup_data[ 'current_lang' ] );
        $openup_data[ 'business_page_url' ] = get_permalink( $openup_data[ 'business_page_id' ] );
        $pt = get_field( 'page_type', $post->ID );
        $pt = ( ! empty( $pt ) && $pt == 'b2b' ) ? 'b2b' : 'b2c';
        $pt = ( $post->post_type == 'business_post' || $post->post_type == 'case_study' ) ? 'b2b' : $pt;
        $openup_data[ 'page_type' ] = $pt;
    }

}, 15 );

/* Remove Logo Link on Ebook Post Types, if ACF settings on */

add_filter( 'get_custom_logo', function( $html, $blog_id ) {

    global $post, $openup_data;
    $hide_logo_redirect = ( isset( $post->post_type ) && $post->post_type == 'ebook' ) ? get_field( 'hide_logo_redirect', $post->ID ) : false;
    if ( $hide_logo_redirect ) {
        $html = preg_replace( array( '<\/a>', '/<a[^>]+>/' ), array( '/div', '<div class="custom-logo-link">' ), $html );
    }

    if ( is_singular() ) {
        $page_type = $openup_data[ 'page_type' ];
        if ( $page_type == 'b2b' ) {
            $business_page_url = $openup_data[ 'business_page_url' ];
            $html = preg_replace(
                [ '/href="[^"]+"/' ],
                [ 'href="' . $business_page_url . '"' ],
                $html);
        }
    }

    return $html;

}, 10, 2 );

/* Add Hotjar Tracking Code */

add_action ( 'wp_head', function() {

    if ( count( $_GET ) > 0 || is_singular( [ 'space' ] ) ) {
        echo '<meta name="robots" content="noindex,follow">';
    }
    echo "<!-- Hotjar Tracking Code for https://openup.com/ --> <script> (function(h,o,t,j,a,r){ h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)}; h._hjSettings={hjid:2755146,hjsv:6}; a=o.getElementsByTagName('head')[0]; r=o.createElement('script');r.async=1; r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv; a.appendChild(r); })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv='); </script>";

} );

/* ----- */

/* Add custom Linkedin Opengrapf Data */

add_filter( 'wpseo_opengraph_title', function( $title ) {

    global $wpdb, $post;

    if ( is_singular() && is_object( $post ) ) {
        $custom_title = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key REGEXP '^flexible_content_page.+linkedin_title';", ARRAY_A );
        return ( ! empty( $custom_title[ 'meta_value' ] ) ) ? $custom_title[ 'meta_value' ] : $title;
    }

}, 10, 1 );


add_filter( 'wpseo_opengraph_desc', function( $description ) {

    global $wpdb, $post;

    if ( is_singular() && is_object( $post ) ) {
        $custom_description = $wpdb->get_row( "SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key REGEXP '^flexible_content_page.+linkedin_description';", ARRAY_A );
        return ( ! empty( $custom_description[ 'meta_value' ] ) ) ? $custom_description[ 'meta_value' ] : $description;
    }

}, 10, 1 );


add_filter( 'wpseo_opengraph_image', function( $img ) {

    global $wpdb, $post;

    if ( is_singular() && is_object( $post ) ) {
        if ( $post->post_type != 'space' ) {
            if ( empty( $img ) ) {
                $custom_img = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key REGEXP '^flexible_content_page.+linkedin_image';", ARRAY_A);
                if ((!empty($custom_img['meta_value']))) {
                    $img = wp_get_attachment_url($custom_img['meta_value']);
                } else {
                    $img = (!empty($img)) ? $img : get_stylesheet_directory_uri() . '/img/global/flags/linkedin-logo.png';
                }
            }
        }
        else if ( $post->post_type == 'space' ) {
            $meta_data = get_post_meta( $post->ID, 'single_space_linkedin_image', true );
            $img = ( ! empty( $img ) ) ? $img : wp_get_attachment_url( $meta_data );
        }
    }

    return $img;

}, 100, 1 );


use Yoast\WP\SEO\Presenters\Abstract_Indexable_Presenter;

class SEO_Image_Presenter extends Abstract_Indexable_Presenter {
    public function present() {
        $img = $this->get();
        return ! empty( $img ) ? '<meta property="og:image" content="' . esc_attr( $this->get() ) . '" />' : '';
    }

    public function get() {

        global $wpdb, $post;

        if ( count( $this->presentation->open_graph_images ) > 0 ) {
            return false;
        }

        $default_img = get_stylesheet_directory_uri() . '/img/global/flags/linkedin-logo.png';
        $yoast_image = $this->presentation->open_graph_image;
        $specified_img = null;
        if ( is_object( $post ) ) {
            if ( empty( $yoast_image ) ) {
                $specified_img = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key REGEXP '^flexible_content_page.+linkedin_image';", ARRAY_A);
                if ( ( ! empty( $specified_img[ 'meta_value' ] ) ) ) {
                    $specified_img = wp_get_attachment_url( $specified_img['meta_value'] );
                } else {
                    $specified_img = null;
                }
            }
        }

        $img = ( ! empty( $yoast_image ) ) ? $yoast_image : ( ! empty( $specified_img ) ? $specified_img : $default_img );

        return $img;
    }
}

function openup_add_my_presenter( $presenters ) {
    $presenters[] = new SEO_Image_Presenter();
    return $presenters;
}

add_filter( 'wpseo_frontend_presenters', 'openup_add_my_presenter' );

/* ----- */

add_action( 'save_post_space', function( $post_id, $post, $update ) {

    openup_set_single_space_linkeding_image( $post_id );

}, 10, 3 );


function openup_set_single_space_linkeding_image( $post_id ) {

    global $sitepress;

    $current_lang = apply_filters( 'wpml_current_language', NULL );
    $sitepress->switch_lang( 'nl' );
    $spaces_page_nl = get_page_by_path( 'spaces' );
    $linkedin_image_nl = custom_get_acf_fc_value( $spaces_page_nl->ID, 'flexible_content_page', 'linkedin_data' );
    $sitepress->switch_lang( $current_lang );
    $spaces_page_current_id = apply_filters( 'wpml_object_id', $spaces_page_nl->ID, 'page', true, $current_lang );
    $source_page = ( ! empty( $spaces_page_current_id ) ) ? get_post( $spaces_page_current_id ) : $spaces_page_nl;
    $linkedin_image = custom_get_acf_fc_value( $source_page->ID, 'flexible_content_page', 'linkedin_data' );
    $source_data = ( is_array( $linkedin_image ) ) ? $linkedin_image : $linkedin_image_nl;
    if ( is_array( $source_data ) ) {
        update_post_meta( $post_id, 'single_space_linkedin_image', $source_data[ 'linkedin_image' ] );
    }

}


function openup_set_all_spaces_linkedin_images() {

    $langs = [ 'en', 'de', 'fr', 'es' ];

    $spaces = get_posts([
        'post_type' => 'space',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ]);

    foreach( $spaces as $space_nl ) {
        openup_set_single_space_linkeding_image( $space_nl->ID );
        foreach( $langs as $lang ) {
            $space_translation_id = apply_filters( 'wpml_object_id', $space_nl->ID, 'space', true, $lang );
            if ( ! empty( $space_translation_id ) ) {
                openup_set_single_space_linkeding_image( $space_translation_id );
            }
        }
    }

}


/* Hack function, will be deleted when ACF Flexible Content bug is resolved */

function custom_get_acf_fc_value( $pid, $acf_fc_name, $layout_name = null, $layout_field = null ) {

    global $wpdb;

    $fc_index = $wpdb->get_row( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = $pid AND meta_key = '" . $acf_fc_name . "';", OBJECT );
    if ( is_object( $fc_index ) ) {
        $fc_index = array_flip( unserialize( $fc_index->meta_value ) );
        if ( isset( $fc_index[ $layout_name ] ) ) {
            $index = $fc_index[ $layout_name ];
            $meta_key = $acf_fc_name . '_' . $index;
            $layouts = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE post_id = $pid AND meta_key LIKE '" . $meta_key . "%';", ARRAY_A );
            if ( is_array( $layouts ) && count( $layouts ) > 0 ) {
                $result = [];
                foreach ( $layouts as $layout ) {
                    if ( ! $layout_field ) {
                        $result[str_replace($meta_key . '_', '', $layout['meta_key'])] = $layout['meta_value'];
                    }
                    else {
                        if ( preg_match( '/' . $layout_field . '_(\d{1,3})_(.+)/', $layout['meta_key'], $index ) ) {
                            $result[ ( $index[ 1 ] + 1 ) ][ $index[ 2 ] ] = $layout['meta_value'];
                        }
                    }
                }
                return $result;
            }
        }
        else {
            return $fc_index;
        }
    }
    else {
        return false;
    }

}


/* Populate ACF Selects for Job Board Custom Items */


function openup_load_job_board_locations_choices( $field ) {

    global $wpdb, $post;

    if ( is_object( $post ) ) {
        $token = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key REGEXP '^flexible_content_page.+job_board_token';", OBJECT);
        if (!empty($token->meta_value)) {
            $jobsBoardData = new Jobs($token->meta_value);
            $jobsBoard = $jobsBoardData->boardData;
            $locations = $jobsBoardData->jobLocations;
            foreach ($locations as $i => $location) {
                $field['choices'][$location] = $location;
            }
        }
    }

    return $field;

}

add_filter( 'acf/load_field/name=job_board_custom_location', 'openup_load_job_board_locations_choices' );


function openup_load_job_board_departments_choices( $field ) {

    global $wpdb, $post;

    if ( is_object( $post ) ) {
        $token = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key REGEXP '^flexible_content_page.+job_board_token';", OBJECT);
        if (!empty($token->meta_value)) {
            $jobsBoardData = new Jobs($token->meta_value);
            $jobsBoard = $jobsBoardData->boardData;
            $departments = $jobsBoardData->getDepartments();
            foreach ($departments as $i => $department) {
                $field['choices'][$department] = $department;
            }
        }
    }

    return $field;

}

add_filter( 'acf/load_field/name=job_board_custom_department', 'openup_load_job_board_departments_choices' );


function openup_load_job_board_images_set_anchor_choices( $field ) {

    global $wpdb, $post;

    if ( is_object( $post ) ) {
        $token = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id = $post->ID AND meta_key REGEXP '^flexible_content_page.+job_board_token';", OBJECT);
        if (!empty($token->meta_value)) {
            $jobsBoardData = new Jobs($token->meta_value);
            $jobsBoard = $jobsBoardData->boardData;
            foreach ($jobsBoard['departments'] as $i => $department) {
                $field['choices'][strtolower($department['name'])] = $department['name'];
            }
        }
    }

    return $field;

}

add_filter( 'acf/load_field/name=job_board_images_set_anchor', 'openup_load_job_board_images_set_anchor_choices' );

/* Populate ACF Select for Page Footer Menu */


function openup_load_page_top_footer_menu_choices( $field ) {

    global $wpdb, $post;

    if ( is_object( $post ) ) {
        $current_lang = apply_filters( 'wpml_current_language', NULL );
        $menus = $wpdb->get_col( "SELECT element_id FROM " . $wpdb->prefix . "icl_translations AS icl WHERE element_type = 'tax_nav_menu' AND language_code = '" . $current_lang . "';" );
        if ( count( $menus ) > 0 ) {
            $field['choices'][0] = 'default menu';
            foreach ( $menus as $i => $menu_id ) {
                $menu = wp_get_nav_menu_object( $menu_id );
                $field[ 'choices' ][ $menu->term_id ] = $menu->name;
            }
        }
    }

    return $field;

}

add_filter( 'acf/load_field/name=footer_menu', 'openup_load_page_top_footer_menu_choices' );
add_filter( 'acf/load_field/name=top_menu', 'openup_load_page_top_footer_menu_choices' );

/* Populate ACF Select for First FAQs */

function openup_load_first_faqs_choices( $args, $field, $post_id ) {

    global $wpdb, $post;

    $taxs = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id = $post_id AND meta_key REGEXP 'faq_section_taxonomy';", OBJECT);
    if ( ! empty( $taxs ) && ! empty( $taxs->meta_value ) ) {
        $taxs = unserialize( $taxs->meta_value );
        $args['tax_query'] = [
            [
                'taxonomy' => 'faq_type',
                'field' => 'id',
                'terms' => $taxs
            ]
        ];
    }

    return $args;

}

add_filter( 'acf/fields/relationship/query/name=first_faqs', 'openup_load_first_faqs_choices', 99, 3 );


/* TinyMCE Drop Cap Button */

function openup_tiny_mce_add_buttons( $plugins ) {
    $plugins['openup_dropcap_plugin'] = get_template_directory_uri() . '/src/js/admin/tiny-mce.js';
    $plugins['openup_custom_list_plugin'] = get_template_directory_uri() . '/src/js/admin/custom-list-tiny-mce.js';
    return $plugins;
}

function openup_tiny_mce_register_buttons( $buttons ) {
    $newBtns = array(
        'openup_dropcap_button',
        'openup_custom_list_button'
    );
    $buttons = array_merge( $buttons, $newBtns );
    return $buttons;
}

add_action( 'init', 'openup_tiny_mce_new_buttons' );

function openup_tiny_mce_new_buttons() {
    add_filter( 'mce_external_plugins', 'openup_tiny_mce_add_buttons' );
    add_filter( 'mce_buttons', 'openup_tiny_mce_register_buttons' );
}

add_theme_support( 'editor-styles' );
add_action( 'admin_init', function() { add_editor_style('src/scss/admin/tiny-mce.css'); } );

/* TinyMCE  Drop Cap Button */

/* Filter to populate $script_vars */

add_filter( 'openup_localize_vars', function( $script_var ) {

    global $post, $openup_data;

    $current_lang = apply_filters( 'wpml_current_language', NULL );
    $preferred_lang = ! empty( $_COOKIE[ 'preferred_lang' ] ) ? $_COOKIE[ 'preferred_lang' ] : false;

    $ir_phone = get_field( 'footer_phone_ir', 'options' );
    preg_match_all('/[0-9]+/', $ir_phone, $ir_tel_number);
    $ir_tel_number = implode( ' ', $ir_tel_number[0] );
    $uk_phone = get_field( 'footer_phone_uk', 'options' );
    preg_match_all('/[0-9]+/', $uk_phone, $uk_tel_number);
    $uk_tel_number = implode( ' ', $uk_tel_number[0] );
    if ( is_singular( [ 'space' ] ) ) {
        global $post, $openup_data;

        $session_id = get_post_meta( $post->ID, 'openup_space_session', true );
        if ( ! empty( $session_id ) ) {
            LiveStormIntegration::init();
            $script_var[ 'liveStorm' ][ 'token' ] = LiveStormIntegration::$token;
            $script_var[ 'liveStorm' ][ 'session_id' ] = $session_id;
        }
    }

    if ( is_singular() ) {
        if ( $current_lang == 'en' && !$preferred_lang ) {
            $page_type = $openup_data[ 'page_type' ];
            $current_permalink = get_permalink( $post->ID );
            $es_post_id = apply_filters( 'wpml_object_id', $post->ID, 'page', false, 'es' );
            $es_permalink = ( ! empty( $es_post_id ) ) ? apply_filters( 'wpml_permalink', $current_permalink, 'es' ) : apply_filters( 'wpml_permalink', site_url(), 'es' );
            $default_target_location = ( $page_type == 'b2c' ) ? apply_filters( 'wpml_permalink', site_url(), 'es' ) : apply_filters( 'wpml_permalink', site_url(), 'es' ) . '/empresas/';
            $target_location = ( $post->ID == $es_post_id ) ? $default_target_location : $es_permalink;
            $script_var['esPopupData'] = [
                'src' => get_template_directory_uri() . '/img/icons/es-flag.png', 'title' => 'OpenUp ya está disponible en español 🎉', 'description' => 'Do you want to go to the Spanish website?', 'positiveButtonText' => 'Continua en español', 'positiveButtonHref' => $target_location, 'negativeButtonText' => 'Stay here', 'negativeButtonHref' => site_url()
            ];
        }
    }
    $script_var[ 'ir_phone' ] = [
        'string' => $ir_phone,
        'phone' => $ir_tel_number
    ];
    $script_var[ 'uk_phone' ] = [
        'string' => $uk_phone,
        'phone' => $uk_tel_number
    ];

    return $script_var;

} );


add_action( 'template_redirect', function() {

    global $wp_query, $post, $openup_data;

    /*if ( preg_match( '/\/?bxbl/', $_SERVER[ 'REQUEST_URI' ] ) ) {
        $wp_query->set_404();
        status_header( 404 );
        get_template_part( 404 );
        exit();
    }*/

    if ( ! is_admin() && ! wp_doing_ajax() && is_singular( [ 'page', 'post', 'busines_post', 'case_study' ] ) ) {
        $current_lang = apply_filters('wpml_current_language', NULL);
        $preferred_lang = ! empty( $_COOKIE[ 'preferred_lang' ] ) ? $_COOKIE[ 'preferred_lang' ] : false;
        $post_type = $post->post_type;

        if ( $current_lang != 'es' && $preferred_lang && $preferred_lang == 'es' ) {
            $page_type = $openup_data[ 'page_type' ];
            $current_permalink = get_permalink( $post->ID );
            $es_post_id = apply_filters( 'wpml_object_id', $post->ID, $post_type, false, 'es' );
            $es_permalink = apply_filters( 'wpml_permalink', $current_permalink, 'es' );
            $default_target_location = ( $page_type == 'b2c' ) ? apply_filters( 'wpml_permalink', site_url(), 'es' ) : apply_filters( 'wpml_permalink', site_url(), 'es' ) . '/empresas/';
            $target_location = ( $post->ID == $es_post_id ) ? $default_target_location : $es_permalink;
            wp_redirect( $target_location, $status = 302, $x_redirect_by = 'WordPress' );
        }
    }

} );


/* Function to render Team Slider Card */

function openup_render_team_slider_card( $team ) {

    $permalink = get_permalink($team->ID);
    $title = get_the_title($team->ID);
    $name = get_field('team_name', $team->ID);
    $surname = get_field('team_surname', $team->ID);
    $image = get_the_post_thumbnail($team->ID, $size = 'size_268_268');
    $team_position = get_the_terms($team->ID, 'team_position');
    ?>


        <div class="c-team-card__wrap">
            <a class="c-team-card" href="<?php echo $permalink ?>">
                <div class="c-team-card__img">
                    <?php echo $image ?>
                </div>
                <div class="c-team-card__body">
                    <div class="c-team-card__link c-btn-link c-btn-link-primary--dark-blue c-btn-link--more">
                        <div class="c-team-card__bio__box">
                            <div class="c-team-card__bio name"><?php echo $name; ?></div>
                            <div class="c-team-card__bio surname"><?php echo $surname; ?></div>
                        </div>
                        <?php echo team_render_card_flags( get_field( 'team_visible_languages', $team->ID ), 4 ); ?>
                    </div>
                    <?php if (is_array($team_position)) :
                        foreach ($team_position as $position) : ?>
                            <span class="c-team-card__info"> <?php echo $position->name; ?> </span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </a>
        </div>

<?php
}


/* Function to render Team Slider Card */


/* Function to render Team Slider Section ( Options based section ) */

function openup_render_team_slider_section( $data ) {

    ?>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="c-intro text-center u-color-primary-dark-blue">
                    <?php if ($data['title']): ?>
                        <h2 class="c-intro__title"> <?php echo $data['title'] ?></h2>
                    <?php endif; ?>
                    <?php if ($data['description']): ?>
                        <div class="c-intro__description">
                            <?php echo $data['description'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($data['teams']): ?>
                <div class="col-12 p-0">
                    <div class="s-team__slider-container">
                        <div class="c-slider JS-double-slider">
                            <div class="c-slider--coverflow ">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($data['teams'] as $team):
                                            $permalink = get_permalink($team->ID);
                                            $name = get_field('team_name', $team->ID);
                                            $surname = get_field('team_surname', $team->ID);
                                            $image = get_the_post_thumbnail($team->ID, $size = 'size_268_268');
                                            $team_position = get_the_terms($team->ID, 'team_position');
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="c-team-card__wrap">
                                                    <a href="<?php echo $permalink ?>" class="c-team-card">
                                                        <div class="c-team-card__img">
                                                            <?php echo $image ?>
                                                        </div>
                                                        <div class="c-team-card__body">
                                                            <div class="c-team-card__link c-btn-link c-btn-link-primary--dark-blue c-btn-link--more">
                                                                <div class="c-team-card__bio__box">
                                                                    <div class="c-team-card__bio name"><?php echo $name; ?></div>
                                                                    <div class="c-team-card__bio surname"><?php echo $surname; ?></div>
                                                                </div>
                                                                <?php echo team_render_card_flags( get_field( 'team_visible_languages', $team->ID ), 4 ); ?>
                                                            </div>
                                                            <?php if (is_array($team_position)) :
                                                                foreach ($team_position as $position) : ?>
                                                                    <span class="c-team-card__info"> <?php echo $position->name; ?> </span>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>


                            <div class="c-slider__nav-button c-slider__nav-button--prev">
                                <a href="#" class="c-btn-round c-btn-round--prev c-btn-primary--white">
                                    <svg class="icon">
                                        <use xlink:href="#icon-angle-left"></use>
                                    </svg>
                                </a>
                            </div>
                            <div class="c-slider__nav-button c-slider__nav-button--next">
                                <a href="#" class="c-btn-round c-btn-round--next c-btn-primary--white">
                                    <svg class="icon">
                                        <use xlink:href="#icon-angle-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="s-team__info text-center">
                    <?php if ($data['link']): ?>
                        <div class="s-team__btn d-flex justify-content-center">
                            <a href="<?php echo $data['link']['url'] ?>"
                               class="c-btn c-btn-primary--dark-blue"
                               target="<?php echo $data['link']['target']; ?>"><?php echo $data['link']['title'] ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $data['after_slider_text'] ) ): ?>
                        <div class="s-team__text u-primary-dark-blue">
                            <?php echo $data['after_slider_text'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
}


/* Function acf layout count */

function acf_admin_head_layout($field)
{
    ?>
        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $('[data-name=add-layout]').on('click', function () {
                        setTimeout(showmessage, 10);
                        function showmessage() {
                            let fcList = $('.acf-fc-popup li');
                            fcList.each(function () {
                                let index = $(this).index() + 1 + '. ';
                                $(this).find('a').prepend(index);
                            });
                        }
                    })
                });

            })(jQuery);
        </script>
        <?php
}
add_action('acf/input/admin_head', 'acf_admin_head_layout', 10, 1);

function openup_custom_admin_js() {
    ?>
    <style>
        #space_typechecklist .wpseo-make-primary-term,
        #space_typechecklist .wpseo-is-primary-term {
            opacity: 0;
        }
    </style>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('#space_typechecklist .selectit').on('click', function (){
                    setTimeout(()=>{
                        $(this).parent().siblings('.wpseo-primary-term').find('.selectit input').trigger('click')
                    },10)
                })

            });
        })(jQuery);
    </script>
    <?php
    $create_page_mode = get_field('page_creation_mode_on_default_language', 'option');
    if(ICL_LANGUAGE_CODE !== 'nl' && ICL_LANGUAGE_CODE !== 'all' && ($create_page_mode === NULL || $create_page_mode)){ ?>
    <script>

        (function ($) {
            $(document).ready(function () {
                console.log('qqq')
                $('a[href*="post-new.php?post_type"]').each(function(index, element) {
                    if($(element).attr("href") !== 'post-new.php?post_type=acf-field-group'){
                        $(element).addClass('hidden-btn')
                        $('a[href="post-new.php"], a.page-title-action').addClass('hidden-btn')
                    }
                })
                $('.hidden-btn').on('click', function (){
                    alert('Page does not exist in main language Dutch')
                    return false;
                })
            });
        })(jQuery);
    </script>
<?php } }
add_action('admin_footer', 'openup_custom_admin_js');


/*function make_script_async( $tag, $handle, $src ){
    if ( 'jquery' != $handle ) {
        return $tag;
    }
    return str_replace( '<script', '<script async', $tag );
}
add_filter( 'script_loader_tag', 'make_script_async', 10, 3 );

add_filter('style_loader_tag',function($tag, $handle, $src, $media){
    if ( 'openup_styles' != $handle ) {
        return $tag;
    }
    $noScriptStr = '<noscript>' . $tag . '</noscript>';
    preg_match('/(<link[^>]+)>/',$tag,$matches);
    $finalTag = preg_replace('/\/$/','',$matches[1],1) . ' media="none" onload="if(media!=\'all\')media=\'all\'"' . ' />' . $noScriptStr;
    return $finalTag;
},10,4);*/

/* Function header */
function openup_header_sections($logo) {
    $page_id = get_queried_object_id();
    $hide_menu = get_field('hide_menu', $page_id);
    ?>
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <div class="o-header__logo d-flex align-items-center">
                    <?php echo $logo; ?>
                </div>
            </div>
            <?php if ($hide_menu || is_404()): ?>

            <?php else: ?>
                <div class="col-auto">
                    <div class="o-header__nav-block d-flex align-items-center justify-content-end">
                        <div class="c-main-menu__link-wrap  d-flex align-items-center d-xl-none">
                            <a href="#" class="c-main-menu__link JS-link-menu--open">
                                <svg class="icon">
                                    <use xlink:href="#icon-mobile-burger"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="c-main-menu-mobile">
                            <div class="c-main-menu-mobile__inner d-xl-flex align-items-start align-items-xl-center flex-column flex-xl-row">
                                <div class="c-main-menu-mobile__header d-flex align-items-center justify-content-between d-xl-none">
                                    <div class="o-header__logo d-flex align-items-center">
                                        <?php echo $logo; ?>
                                    </div>
                                    <div class="c-main-menu__link-wrap  d-flex align-items-center d-xl-none">
                                        <a href="#" class="c-main-menu__link JS-link-menu--close">
                                            <svg class="icon">
                                                <use xlink:href="#icon-main-close"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <?php get_template_part('template-parts/components/navigation/main-menu'); ?>

                                <div class="c-main-menu-mobile__footer d-flex align-items-start justify-content-between justify-content-xl-center">
                                    <?php do_action('wpml_add_language_selector') ?>

                                    <?php get_template_part('template-parts/components/buttons/consult'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/* Add Language class to Body HTML element */

add_filter( 'body_class', function( $classes ) {
    $current_lang = apply_filters( 'wpml_current_language', NULL );
    return array_merge( $classes, array( $current_lang . '-lang' ) );
} );

/* Service function - to get requested OpenUp Option ( wp_options Table ) */

function openup_get_option( $option = false ) {

    $options = get_option( 'openup_options' );

    if ( ! empty( $option ) ) {
        return ( ! empty( $options[ $option ] ) ) ? $options[ $option ] : false;
    }

    return $options;

}


/* Add text ellipsis */
function close_tags($content)
{
    $position = 0;
    $open_tags = array();
    $ignored_tags = array('br', 'hr', 'img');
    while (($position = strpos($content, '<', $position)) !== FALSE)
    {
        if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match))
        {
            $tag = strtolower($match[2]);
            if (in_array($tag, $ignored_tags) == FALSE)
            {
                if (isset($match[1]) AND $match[1] == '')
                {
                    if (isset($open_tags[$tag]))
                        $open_tags[$tag]++;
                    else
                        $open_tags[$tag] = 1;
                }
                if (isset($match[1]) AND $match[1] == '/')
                {
                    if (isset($open_tags[$tag]))
                        $open_tags[$tag]--;
                }
            }
            $position += strlen($match[0]);
        }
        else
            $position++;
    }
    foreach ($open_tags as $tag => $count_not_closed)
    {
        $content .= str_repeat("</{$tag}>", $count_not_closed);
    }

    return $content;
}
function strlentag($testimonial_content,$endpos){
    $strlentag=0;
    $it_tag=false;
    for($i=0;$i<=strlen($endpos)-1;$i++){
        if($testimonial_content[$i]=="<")$it_tag=true;
        if($it_tag==true)$strlentag++;
        if($testimonial_content[$i]==">")$it_tag=false;
    }
    return $strlentag;
}
function needsubstr($testimonial_content){
    $open=0;
    $close=0;
    for($i=0;$i<strlen($testimonial_content);$i++){

        if($testimonial_content[$i]=="<")$open++;
        if($testimonial_content[$i]==">")$close++;}
    if($open==$close) {return false;}else{return true;}
}

/* Add multi-color in header */

function openup_header_styles($data): string {
    $page_id = get_queried_object_id();
    $layouts = get_post_meta($page_id, 'flexible_content_page', true);
    $background_color_left_hero_slider = get_field('hero_slider_background_color', $page_id);
    $background_color_left_hero_slider = (!empty($background_color_left_hero_slider)) ? str_replace('_', '-', $background_color_left_hero_slider) : '';
    $background_color = get_field('background_color_right', $page_id);
    $background_color = (!empty($background_color)) ? str_replace('_', '-', $background_color) : '';

    if ($background_color && get_page_template_slug() != 'templates/template-home-with-slider.php') {
        return 'o-header-secondary u-bg-primary-' . $background_color;
    }
    if (((is_array($layouts)) && in_array('section_title_and_people', $layouts))) {
        return 'o-header-secondary u-bg-primary-green';
    }
    if ($background_color_left_hero_slider && get_page_template_slug() == 'templates/template-home-with-slider.php') {
        return 'o-header-transparent u-bg-primary-'.$background_color_left_hero_slider;
    }
    if (is_array( $layouts ) && ( in_array( 'live_spaces_section', $layouts ) || in_array( 'on_demand_spaces_section', $layouts))) {
        return 'o-header-secondary u-bg-primary-dark-blue o-header-spaces';
    }
    if($data && $data[ 'space_type_theme_color' ] == 'blue'){
        return 'o-header-secondary u-bg-primary-blue o-header-light-logo o-header-spaces';
    }
    if($data && $data[ 'space_type_theme_color' ] == 'green'){
        return 'o-header-secondary u-bg-primary-green o-header-light-logo o-header-spaces';
    }
    if($data && $data[ 'space_type_theme_color' ] == 'skin'){
        return 'o-header-secondary u-bg-primary-skin o-header-darken-logo o-header-spaces';
    }
    return '';
}


/* Filter Yoast Breadcrumbs */

add_filter( 'wpseo_breadcrumb_links', 'openup_breadcrumb_links_filter' );

function openup_breadcrumb_links_filter( $crumbs ){

    global $wpdb, $post, $openup_data;

    if ( is_singular( [ 'post', 'business_post' ] ) ) {
        $template_name = ( $post->post_type == 'post' ) ? 'templates/template-posts.php' : 'templates/template-business-posts.php';
        $blogs = $wpdb->get_results( "SELECT icl.language_code, posts.* FROM wp_posts AS posts
                                            LEFT JOIN wp_postmeta ON ( posts.ID = wp_postmeta.post_id )
                                            INNER JOIN wp_icl_translations AS icl ON wp_postmeta.post_id = icl.element_id
                                            WHERE (post_type = 'page' AND post_status = 'publish') 
                                            AND wp_postmeta.meta_key = '_wp_page_template'
                                            AND wp_postmeta.meta_value = '" . $template_name . "'
                                            AND ( icl.language_code = '" . $openup_data[ 'current_lang' ]  . "' OR icl.language_code = 'nl' )
                                            ORDER BY posts.post_title ASC", OBJECT_K );
        if ( !empty( $blogs[ $openup_data[ 'current_lang' ] ] ) ) {
            $blog = $blogs[ $openup_data[ 'current_lang' ] ];
            $blog_item = [
                    'url' => get_permalink( $blog->ID ),
                    'text' => __( 'Blog', 'openup' ),
                    'id' => $blog->ID
            ];
            $crumbs = array_merge( array_slice( $crumbs, 0, 1), array( $blog_item ), array_slice( $crumbs, 1 ) );
        }

        if ( $openup_data[ 'page_type' ] == 'b2b' ) {
            $crumbs[ 0 ][ 'url' ] = $openup_data[ 'business_page_url' ];
        }
    }

    return $crumbs;
}


/* Function acf taxonomy relationship merge */
function acf_tax_relationship($field)
{
    ?>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {

                if (typeof acf == 'undefined') { return; }
                $(document).on('change', '[data-key="field_60534838042cf"] .acf-input select', function(e) {
                    update_cities_on_state_change(e, $);
                });
                $('[data-key="field_60534838042cf"] .acf-input select').trigger('ready');

                function update_cities_on_state_change(e, $) {
                    if (this.request) {
                        this.request.abort();
                    }
                    let target = $(e.target);
                    let state = target.val();
                    console.log(state)
                    if (!state) {
                        return;
                    }

                    if( this.request) {
                        this.request.abort();
                    }

                    let data = {};

                    data.action = 'acf_tax_ajax';
                    data.faq_ids = state;

                    this.request = $.ajax({
                        url:		acf.get('ajaxurl'),
                        data:		data,
                        type:		'post',
                        dataType:	'json',
                        async: true,
                        success: function(json){
                            console.log('json',json)
                            let list = $('[data-name=first_faqs]').find('.choices-list');
                            list.html('');
                            if (!json) {
                                return;
                            }
                            let walk = function (data) {
                            let html = '';

                            if ($.isArray(data)) {
                                data.map(function (item) {
                                    html += walk(item);
                                });
                            } else if ($.isPlainObject(data)) {
                                if (data.children !== undefined) {
                                    html += '<li><span class="acf-rel-label">' + acf.escHtml(data.text) + '</span><ul class="acf-bl">';
                                    html += walk(data.children);
                                    html += '</ul></li>';
                                } else {
                                    html += '<li><span class="acf-rel-item" data-id="' + acf.escAttr(data.id) + '">' + acf.escHtml(data.text) + '</span></li>';
                                }
                            }
                                return html;
                            };
                            let html = walk(json.results);
                            list.html(html);
                            let valCheck = [...document.querySelectorAll('.values-list li span')];
                            let valVariable = [...document.querySelectorAll('.choices-list li span')]
                            let valDataL = []
                            let valDataR = []
                            valVariable.forEach(itemL => {
                                valDataL.push(itemL.dataset.id)
                            })
                            valCheck.forEach(itemR => {
                                valDataR.push(itemR.dataset.id)
                            })
                            valDataL.forEach(dataL => {
                                valDataR.forEach(dataR => {
                                    if(dataL === dataR){
                                        let disabledItem = [...document.querySelectorAll('.choices-list .acf-rel-item[data-id="' + dataL + '"]')]
                                        disabledItem.forEach(disItem => {
                                            disItem.classList.add('disabled')
                                        })
                                    }
                                })
                            })

                        }
                    });
                }
            });
        })(jQuery);

    </script>
    <?php
}
add_action('acf/input/admin_head', 'acf_tax_relationship', 10, 1);

add_action("wp_ajax_acf_tax_ajax" , "acf_tax_ajax");
function acf_tax_ajax(){
    $obj = new acf_field_relationship_custom();
    $options = ['field_key' => 'first_faqs'];
    $response = $obj->get_ajax_query($options);
    echo json_encode($response );

    wp_die();

}

class acf_field_relationship_custom extends acf_field {
    function get_ajax_query( $options = array() ) {
        $options = wp_parse_args(
            $options,
            array(
                'post_id'   => 0,
                's'         => '',
                'field_key' => '',
                'paged'     => 1,
                'post_type' => '',
                'taxonomy'  => '',
            )
        );
        // load field
        $field = acf_get_field( $options['field_key'] );
        if ( ! $field ) {
            return false;
        }
        // vars
        $results   = array();
        $args      = array();
        $s         = false;
        $is_search = false;
        // paged
        $args['posts_per_page'] = 20;
        $args['paged']          = intval( $options['paged'] );
        // search
        if ( $options['s'] !== '' ) {
            // strip slashes (search may be integer)
            $s = wp_unslash( strval( $options['s'] ) );
            // update vars
            $args['s'] = $s;
            $is_search = true;
        }
        // post_type
        if ( ! empty( $options['post_type'] ) ) {
            $args['post_type'] = acf_get_array( $options['post_type'] );
        } elseif ( ! empty( $field['post_type'] ) ) {
            $args['post_type'] = acf_get_array( $field['post_type'] );
        } else {
            $args['post_type'] = acf_get_post_types();
        }
        // taxonomy
        if ( ! empty( $options['taxonomy'] ) ) {
            // vars
            $term = acf_decode_taxonomy_term( $options['taxonomy'] );
            // tax query
            $args['tax_query'] = array();
            // append
            $args['tax_query'][] = array(
                'taxonomy' => $term['taxonomy'],
                'field'    => 'slug',
                'terms'    => $term['term'],
            );
        } elseif ( ! empty( $field['taxonomy'] ) ) {
            // vars
            $terms = acf_decode_taxonomy_terms( $field['taxonomy'] );
            // append to $args
            $args['tax_query'] = array(
                'relation' => 'OR',
            );
            // now create the tax queries
            foreach ( $terms as $k => $v ) {
                $args['tax_query'][] = array(
                    'taxonomy' => $k,
                    'field'    => 'slug',
                    'terms'    => $v,
                );
            }
        }
        // filters
        $args['tax_query'] = [
            [
                'taxonomy' => 'faq_type',
                'field' => 'id',
                'terms' => $_POST['faq_ids']
            ]
        ];
//        $args = apply_filters( 'acf/fields/relationship/query', $args, $field, $options['post_id'] );
        $args = apply_filters( 'acf/fields/relationship/query/name=' . $field['name'], $args, $field, $options['post_id'] );
        $args = apply_filters( 'acf/fields/relationship/query/key=' . $field['key'], $args, $field, $options['post_id'] );
        // get posts grouped by post type
        $groups = acf_get_grouped_posts( $args );
        // bail early if no posts
        if ( empty( $groups ) ) {
            return false;
        }
        // loop
        foreach ( array_keys( $groups ) as $group_title ) {
            // vars
            $posts = acf_extract_var( $groups, $group_title );
            // data
            $data = array(
                'text'     => $group_title,
                'children' => array(),
            );
            // convert post objects to post titles
            foreach ( array_keys( $posts ) as $post_id ) {
                $posts[ $post_id ] = $this->get_post_title( $posts[ $post_id ], $field, $options['post_id'] );
            }
            // order posts by search
            if ( $is_search && empty( $args['orderby'] ) && isset( $args['s'] ) ) {
                $posts = acf_order_by_search( $posts, $args['s'] );
            }
            // append to $data
            foreach ( array_keys( $posts ) as $post_id ) {
                $data['children'][] = $this->get_post_result( $post_id, $posts[ $post_id ] );
            }
            // append to $results
            $results[] = $data;
        }
        // add as optgroup or results
        if ( count( $args['post_type'] ) == 1 ) {
            $results = $results[0]['children'];
        }
        // vars
        $response = array(
            'results' => $results,
            'limit'   => $args['posts_per_page'],
        );
        // return
        return $response;
    }
    function get_post_result( $id, $text ) {
        // vars
        $result = array(
            'id'   => $id,
            'text' => $text,
        );
        // return
        return $result;
    }
    function get_post_title( $post, $field, $post_id = 0, $is_search = 0 ) {
        // get post_id
        if ( ! $post_id ) {
            $post_id = acf_get_form_data( 'post_id' );
        }
        // vars
        $title = acf_get_post_title( $post, $is_search );
        // featured_image
        if ( acf_in_array( 'featured_image', $field['elements'] ) ) {
            // vars
            $class     = 'thumbnail';
            $thumbnail = acf_get_post_thumbnail( $post->ID, array( 17, 17 ) );
            // icon
            if ( $thumbnail['type'] == 'icon' ) {
                $class .= ' -' . $thumbnail['type'];
            }
            // append
            $title = '<div class="' . $class . '">' . $thumbnail['html'] . '</div>' . $title;
        }
        // filters
        $title = apply_filters( 'acf/fields/relationship/result', $title, $post, $field, $post_id );
        $title = apply_filters( 'acf/fields/relationship/result/name=' . $field['_name'], $title, $post, $field, $post_id );
        $title = apply_filters( 'acf/fields/relationship/result/key=' . $field['key'], $title, $post, $field, $post_id );
        // return
        return $title;
    }
}
