<?php

if (!defined('ABSPATH')) exit;

/**
 * Styles and Scripts Loader
 */
class ScriptStyleLoader
{

    const JQUERY = 'jquery';

    const openup_JS = 'openup_js';

    const openup_STYLES = 'openup_styles';

    const openup_FONTS = 'openup_fonts';

    /**
     * Constructor
     */
    function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'styles']);
        add_action('wp_enqueue_scripts', [$this, 'scripts']);
    }

    /**
     * Styles Loader
     */
    function styles()
    {
        //Remove the Gutenberg Block Library CSS
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');

        if (!is_admin()) {
            wp_register_style(self::openup_STYLES, mix('/dist/css/style.css'), false, null);
            wp_enqueue_style(self::openup_STYLES);
        }
    }

    /**
     * Scripts Loader
     */
    function scripts()
    {
        if (!is_admin()) {
            global $wp_query;

            wp_deregister_script(self::JQUERY);
            wp_register_script(self::JQUERY, mix('/dist/js/app.js'), [], null, true);
            //example: how to register additional js file
            //wp_register_script('some-prefix', mix('/dist/js/separateScriptExample.js'), [], null, true);

            wp_enqueue_script(self::JQUERY);
            //example: activating additional js file on some pages
            //if (is_page_template('page-templates/template-our-works.php') || is_home()) wp_enqueue_script('some-prefix');

            $script_vars = [
                'templateUrl' => get_stylesheet_directory_uri(),
                'page' => get_query_var('paged') ? get_query_var('paged') : 1,
                'max_page' => $wp_query->max_num_pages,
            ];

            wp_localize_script(self::openup_JS, 'scriptVars', $script_vars);
        }
    }

}

new ScriptStyleLoader;
