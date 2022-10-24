<?php

if (!defined('ABSPATH')) exit; 

class UIAdminSetup
{

    public static $instance;

    /**
     * Init
     */
    public static function init()
    {
        if (is_null(self::$instance))
            self::$instance = new UIAdminSetup();
        return self::$instance;
    }

    /**
     * SetUp Constructor
     */
    private function __construct()
    {
        $this->no_front_adminbar();
        add_action('wp_before_admin_bar_render', array($this, 'admin_bar'));
        add_action('admin_menu', array($this, 'remove_menu_items'));
        add_filter('menu_order', array($this, 'menu_order'));
        add_filter('custom_menu_order', array($this, 'menu_order'));
    }

    /**
     * Backend Admin Bar Cleanup
     */
    function admin_bar()
    {
        global $wp_admin_bar;

        // Remove Menu Items
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('about');
        $wp_admin_bar->remove_menu('wporg');
        $wp_admin_bar->remove_menu('documentation');
        $wp_admin_bar->remove_menu('support-forums');
        $wp_admin_bar->remove_menu('feedback');
        //$wp_admin_bar->remove_menu('site-name');
        $wp_admin_bar->remove_menu('view-site');
        $wp_admin_bar->remove_menu('updates');
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content');
    }

    /**
     * Remove Front End Admin Bar
     */
    function no_front_adminbar()
    {
        add_filter('show_admin_bar', '__return_false');
    }

    /**
     * Remove Items
     * Remove menu items if not super user (me)
     */
    function remove_menu_items()
    {
        global $current_user;

        # Always Remove
        remove_menu_page('edit-comments.php');
        //remove_menu_page('edit.php?post_type=acf-field-group');
        //remove_menu_page( 'themes.php' );

        # If not admin remove
        if (!current_user_can('administrator')) {
            remove_menu_page('plugins.php');
            //remove_menu_page('tools.php');
        }
    }

    /**
     * Order Remaining Menu Items
     */
    function menu_order($menu_order)
    {
        if (!$menu_order) return true;

        return array(
            'index.php',
            'edit.php',
            'edit.php?post_type=business_post',
            'edit.php?post_type=case_study',
            'edit.php?post_type=page',
            'upload.php',
            'edit.php?post_type=team',
            'edit.php?post_type=thema',
            'edit.php?post_type=boek_consult',
            'edit.php?post_type=ebook',
            'edit.php?post_type=testimonials',
            'edit.php?post_type=faq',
            'users.php',
            'separator2',
            'plugins.php',
            'tools.php',
            'options-general.php',
            'contacts',
            'themes.php',
        );
    }

}

UIAdminSetup::init();




