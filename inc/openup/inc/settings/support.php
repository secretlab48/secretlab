<?php

if (!defined('ABSPATH')) exit;

if (!function_exists('openup_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function openup_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Chiquita, use a find and replace
         * to change 'chiquita' to the name of your theme in all the template files.
         */
        load_theme_textdomain('openup', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');


        // image sizes
        //add_image_size('latest-news-thumb', 176, 176, true);

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'mobile-menu' => esc_html__('Mobile menu', 'openup'),
            'primary-menu' => esc_html__('Primary menu', 'openup'),
            'footer-menu' => esc_html__('Footer menu', 'openup'),
            'top-busines-menu' => esc_html__('Top Business menu', 'openup'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('openup_custom_background_args', [
            'default-color' => '#ffffff',
            'default-image' => '',
        ]));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', [
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ]);

        add_image_size('size_268_268', 268, 268, true);


    }
endif;
add_action('after_setup_theme', 'openup_setup');

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

function get_excerpt($limit, $source = null){

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'... <a href="'.get_permalink($post->ID).'">more</a>';
    return $excerpt;
}

// Enable Pinterest ads
add_action( 'wp_head', 'openup_add_pinterest_meta_header' );

function openup_add_pinterest_meta_header() {
    echo '<meta name="p:domain_verify" content="8b8ea2e2379156977728ad41a7304d27"/>';
}

