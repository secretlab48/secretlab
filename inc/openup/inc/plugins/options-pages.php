<?php

if (!defined('ABSPATH')) exit;

/**
 * Create Global Elements Menu Item
 */
if (function_exists('acf_add_options_page')) {

	# Site Globals (Parent)
	$site_globals = acf_add_options_page(array(
		'page_title' 	=> 'Options',
		'menu_title' 	=> 'Options',
		'icon_url'		=> 'dashicons-admin-generic',
		'redirect' 		=> true
	));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '1',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Blog Posts Settings',
        'menu_title'	=> 'Blog Posts',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '2',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Book Session Settings B2C',
        'menu_title'	=> 'Book Session B2C',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '3',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Book Session Settings B2B',
        'menu_title'	=> 'Book Session B2B',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '4',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Team Section Settings',
        'menu_title'	=> 'Team Slider',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '5',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Row With Round Logo Settings',
        'menu_title'	=> 'Row With Round Logo',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '6',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Logo Row Main Settings',
        'menu_title'	=> 'Logo Row Main',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '7',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Logo Row MKB Settings',
        'menu_title'	=> 'Logo Row MKB',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '8',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Page 404 Settings',
        'menu_title'	=> 'Page 404 ',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '9',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Archive Blog B2C Settings',
        'menu_title'	=> 'Archive Blog B2C',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '10',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Archive Blog B2B Settings',
        'menu_title'	=> 'Archive Blog B2B',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '10',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Calculator',
        'menu_title'	=> 'Calculator',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '11',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'General',
        'menu_title'	=> 'General',
        'parent_slug'	=> $site_globals['menu_slug'],
        'position'    =>  '12',
    ));

}
