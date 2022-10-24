<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function openup_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Footer Column 1', 'openup'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'openup'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('B2B Footer Column 1', 'openup'),
        'id' => 'b2b-footer-1',
        'description' => esc_html__('Add widgets here.', 'openup'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column 2', 'openup'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'openup'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('B2B Footer Column 2', 'openup'),
        'id' => 'b2b-footer-2',
        'description' => esc_html__('Add widgets here.', 'openup'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'openup_widgets_init');



