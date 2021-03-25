<?php
/*
 *  Author: CA
 *  Custom functions, support, custom post types and more.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*------------------------------------*\
	Functions
\*------------------------------------*/





add_action( 'init', 'udft::init' );

class UDFT
{

    static function init()
    {

        require_once( 'inc/cpt.php' );

        if (function_exists('add_theme_support')) {

            add_theme_support('menus');
            add_theme_support('widgets');
            //add_theme_support( 'title-tag' );

            add_theme_support('post-thumbnails');
            add_image_size('single-post-picture', 470, 330, true );
            add_image_size('portfolio_archive', 860, 410, true );
            add_image_size('portfolio_carousel', 680, 330, true );

            load_theme_textdomain( 'udft', get_template_directory() . '/languages' );
        }

        add_filter('widget_text', 'do_shortcode');


        if ( ! is_admin() ) {

            wp_enqueue_style('app_css', get_template_directory_uri() . '/assets/css/app.css');


            wp_deregister_script( 'jquery' );
            wp_register_script('custom_js', get_template_directory_uri() . '/assets/js/app.js', array(), false, true);
            wp_enqueue_script('custom_js');
        }


        register_nav_menus(array(
            'header-location' => 'Top Memu',
            'main-location' => 'Main Memu',
            'footer-location' => 'Footer Menu'
        ));

        add_action( 'wp_enqueue_scripts', array( 'UDFT', 'add_ajax_data' ), 99 );
        add_filter( 'body_class', array( 'UDFT', 'bodyClass' ), 99 );
        add_filter( 'post_class', array( 'UDFT', 'postClass' ), 99, 3 );

        add_action( 'wp_ajax_udft_cf_request', 'udft_cf_request' );
        add_action( 'wp_ajax_nopriv_udft_cf_request', 'udft_cf_request' );

        add_post_type_support( 'page', 'excerpt' );

    }


    static function add_ajax_data()
    {

        wp_localize_script('custom_js', 'ajaxdata',
            array(
                'url' => admin_url('admin-ajax.php'),
            )
        );

    }


    static function get_template_part($template, $part_name = null, $mode = 'return')
    {

        if ($mode == 'return') {
            ob_start();
            get_template_part($template, $part_name);
            $out = ob_get_contents();
            ob_end_clean();

            return $out;
        } else {
            get_template_part($template);
        }

    }


    static function bodyClass( $classes ) {

        global $post;

        if ( is_singular( 'page' ) ) {

            global $sitepress;

            $id_en = apply_filters( 'wpml_object_id', $post->ID, get_post_type(), true, 'en' );
            $classes[] = 'page-' . strtolower( get_the_title( $id_en ) );

        }

        return $classes;

    }


    static function postClass( $classes, $class, $post_id ) {

        global $post;

        if ( is_singular( 'page' ) ) {

            if ( is_front_page() ) {
                $classes[] = 'fp-article';
            }

        }

        return $classes;

    }

}


/* CUSTOM */



add_filter('upload_mimes', 'kmwp_mime_types');

function kmwp_mime_types( $mimes ) {

    $mimes['svg'] = 'image/svg+xml';
    return $mimes;

}


function udft_site_socials() {

    $out =
            '<div class="site-socials">
                <a href="#" rel="noibdex, nofollw" class="fa fa-facebook"></a>
                <a href="#" rel="noibdex, nofollw" class="fa fa-twitter"></a>
                <a href="#" rel="noibdex, nofollw" class="fa fa-linkedin"></a>
            </div>';

    return $out;

}


add_shortcode( 'contact_form', 'udft_get_contact_form' );


function udft_get_contact_form( $atts = array()  ) {

    $atts = shortcode_atts( array( 'slogun' => 'Lets go!', 'btn_caption' => 'send', 'placeholder_name' => 'Name', 'placeholder_email' => 'Email', 'placeholder_message' => 'Messge' ), $atts );

    $out =
    '<form class="cf" method="POST" action="/">
        <div class="custom-style-slogun">' . $atts['slogun'] . '</div>
        <div class="cf-inputs-box row">
            <div class="cf-input-box col-2">
                <div class="cf-input-holder">
                   <input class="cf-input" name="name">
                   <div class="cf-placeholder">' . $atts['placeholder_name'] . '</div>
                   <div class="cf-error-box"></div>
                </div>
            </div>
            <div class="cf-input-box col-2">
                <div class="cf-input-holder">
                    <input class="cf-input" name="email">
                    <div class="cf-placeholder">' . $atts['placeholder_email'] . '</div>
                    <div class="cf-error-box"></div>
                </div>
            </div>
        </div>
        <div class="cf-input-holder textarea">
            <textarea class="cf-textarea" name="message"></textarea>
            <div class="cf-placeholder">' . $atts['placeholder_message'] . '</div>
            <div class="cf-error-box"></div>
         </div>
         <button class="btn custom-style" type="submit"><span>' . $atts['btn_caption'] . '</span></button>
         <div class="form-result"></div>
    </form>';

    return $out;

}




add_shortcode( 'contact_section', 'udft_get_contact_section' );

function udft_get_contact_section( $atts = array() ) {

    $atts = shortcode_atts( array( 'title' => '', 'slogun' => 'Lets go!', 'btn_caption' => 'send', 'placeholder_name' => 'Name', 'placeholder_email' => 'Email', 'placeholder_message' => 'Messge' ), $atts );

    $out =
    '<div class="mpc row">
        <div class="mpc-left col">
            <div class="mpc-content-box">
                <h2 class="section-title">' . $atts['title'] . '</h2>
            </div>
        </div>
        <div class="mpc-right col">
            <div class="mpc-content-box">
                <div class="mpc-content">
                    <div class="mpc-contact-info">
                        <a class="mpc-email custom-style href="mailto:letsgo@secretlab.com.ua"><span>letsgo@secretlab.com.ua</span></a>
                        <a class="mpc-email custom-style href="phone:+380687255071"><span>+380687255071</span></a>                        
                    </div>' .
                    udft_get_contact_form( $atts ) .
                '</div>
            </div>
        </div>
    </div>';

    return $out;

}



function udft_cf_request() {

    $rawdata = isset( $_POST['data'] ) ? $_POST['data'] : false;

    if ( $rawdata ) {
        $data = array();
        $fields = array( 'name', 'email', 'message' );
        foreach( $rawdata as $i => $info ) {
            if ( in_array( $info['name'], $fields ) ) {
                $data[$info['name']] = $info['value'];
            }
        }
        $r = wp_mail( 'secretlab48@gmail.com', site_url() . ' - Site Form E-mail', 'Name - ' . $data['name'] . ';' . PHP_EOL . 'E-mail - ' . $data['email'] . ';' . PHP_EOL . 'Message - ' . $data['message'] );
        $result = 1;
        $content = __( 'Your request is send, We will connect with you in 2 hours', 'udft' );
    }
    else {
        $result = 0;
        $content = __( 'Techical problems occurred, try again later please', 'udft' );
    }

    echo json_encode( array( 'result' => $result, 'content' => $content ) );
    wp_die();

}


add_shortcode( 'get_portfolio_page_content', 'udft_get_portfolio_page_content' );

function udft_get_portfolio_page_content( $atts ) {

    $atts = shortcode_atts( array( ), $atts );

    $cats = get_terms( array( 'taxonomy' => 'portfolios_cat', 'hide_empty' => false, 'order_by' => 'slug' ) );
    $portfolios = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => -1 ) );

    $out = '<div class="portfolios-box">';

    $header = '<div class="portfolio-cats">';
    foreach ( $cats as $i => $cat ) {

        $activeClass = ( $i == 0 ) ? ' active' : '';
        $term_id = ( stripos( $cat->slug, 'all' ) === false ) ? $cat->term_id : 0;
        $header .= '<a class="portfolio-cat-item' . $activeClass . '" data-cat-id="' . $term_id . '">' . $cat->name . '</a>';

    }
    $header .= '</div>';

    $content = '<div class="portfolios-items-box"><div class="portfolio-grid-sizer"></div>';
    foreach ( $portfolios->posts as $i => $p ) {

        $img = get_the_post_thumbnail_url( $p->ID, 'portfolio_archive' );
        $fields = get_fields( $p->ID );
        $info = $fields['portfolio_set'][0]['info'];
        $terms = wp_get_post_terms( $p->ID, 'portfolios_cat', array('fields' => 'ids') );

        $content .=
            '<div class="portfolio-item-box">
                <a class="portfolio-item" href="' . get_permalink( $p->ID ) . '" data-item-cats="' . implode( ',', $terms ) . '">
                    <img class="portfolio-item__image" src="' . $img . '">
                    <div class="portfolio-item__info">
                        <div class="portfolio-item__name">' . $info['site_title'] . '</div>
                        <div class="portfolio-item__description">' . $info['site_text'] . '</div>
                    </div>
                </a>
            </div>';

    }
    $content .= '</div>';

    $out .= $header . $content . '</div>';

    return $out;

}


add_filter( 'template_include', function( $template ) {

    global $post;

    if ( is_singular( 'page' ) ) {
        $id_en = apply_filters( 'wpml_object_id', $post->ID, get_post_type(), true, 'en' );
        if ( $id_en == 146 ) {
            $template = get_stylesheet_directory() . '/assets/templates/page-about.php';
        }
    }

    return str_replace( array( 'category.php', 'search.php' ), 'index.php', $template );

} );


add_filter( 'wp_revisions_to_keep', function( $num, $post ) {
    if ( post_type_supports( $post->post_type, 'revisions' ) )
        $num = 0;

    return $num;

}, PHP_INT_MAX, 2 );



add_action( 'widgets_init', function() {

    register_sidebar( array(
        'name' => __( 'Single Post Sidebar', 'wpmu' ),
        'id' => 'single-post-widget',
        'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));

} );




add_action('phpmailer_init','send_smtp_email');
function send_smtp_email( $phpmailer )
{
    $phpmailer->SMTPDebug = 0;
    $phpmailer->isSMTP();
    $phpmailer->Host = "smtp.gmail.com";
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = "465";
    $phpmailer->Username = "zhekas361@gmail.com";
    $phpmailer->Password = "ab124578";
    $phpmailer->SMTPSecure = "ssl";
    $phpmailer->CharSet = 'UTF-8';

    $phpmailer->isHTML( true );

    $phpmailer->smtpConnect(
        array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        )
    );


    //$phpmailer->setFrom( 'anfrage@hausnotruf.de', 'Service', true );
    //$phpmailer->addReplyTo( 'anfrage@hausnotruf.de', 'Information1' );
    //$phpmailer->Sender = 'anfrage@hausnotruf.de';

    //$phpmailer->Subject = 'New Lead1';


}


add_filter( 'post_link', function( $link, $post ) {

    $link = explode( '/', rtrim( $link, '/' ) );

    $empty = new stdClass();
    $empty->name = 'not-categorixed';

    $terms = wp_get_post_terms( $post->ID, 'category', ['fields' => 'all'] );
    $cat = ( count( $terms ) > 0 ) ? $terms[0] : $empty->name;
    foreach( $terms as $term ) {
        if( get_post_meta( $post->ID, '_yoast_wpseo_primary_category',true ) == $term->term_id ) {
            $cat = $term;
        }
    }

    $lang = '';
    if ( ICL_LANGUAGE_CODE == 'ru' ) {
        $lang = '/ru';
    }

    $link = site_url() . $lang . '/blog/' . $cat->name . '/' . $link[ ( count( $link ) - 1 ) ];

    return $link;

}, 99, 2 );


add_filter( 'term_link', function( $termlink, $term, $taxonomy ) {

    if ( $taxonomy == 'category' ) {
        $termlink = str_replace('category/', 'blog/', $termlink);
    }

    return $termlink;

}, 10, 3 );



add_filter('wpml_is_redirected', 'ret_fls');
function ret_fls($q){
    if(strpos($q, 'yacht')){
        return false;
    }
}

add_filter( 'wpml_current_ls_language_url_endpoint', function( $url, $post_lang, $data, $current_endpoint ) {

    if ( is_singular( 'post' ) ) {
        if ($post_lang == 'ru' && $data['code'] == 'en') {
            $url = str_replace('ru/', '', $url);
        } else if ($post_lang == 'en' && $data['code'] == 'ru') {
            $url = str_replace('/blog', '/ru/blog', $url);
        }
    }

    return $url;

}, 10, 4 );


/*add_filter( 'pre_get_posts', function( $query ) {

    if ( !is_admin() && is_main_query() &&( ( is_home() ) || is_category() ) ) {
        $query->set( 'posts_per_page', 1 );
    }

    return $query;

} );*/



