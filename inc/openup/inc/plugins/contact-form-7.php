<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('WPCF7')) return;

class CF7Handler
{

    private $pages = null;

    function __construct($pages)
    {
        $this->pages = $pages;
        add_action('wp_enqueue_scripts', [$this, 'scrips_styles_loader'], 99);
    }

    /** 
     * removed unnecessary contact-form-7 scripts and styles
     * from pages where they not used
     **/
    function scrips_styles_loader()
    {
        if (!is_page($this->pages)) {
            wp_dequeue_script('contact-form-7');
            wp_dequeue_style('contact-form-7');
        }
    }
}

new CF7Handler(['contact']);
