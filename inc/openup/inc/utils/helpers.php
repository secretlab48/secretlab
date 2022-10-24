<?php

if (!defined('ABSPATH')) exit; 

/**
 *
 * Get Page ID by template name
 *
 * @param   string  $template_name name of template file example: page-templates/template-homepage.php
 * @return  int
 *
 */
function get_page_id_by_template($template_name)
{
    $template_name = trim($template_name);
    $pages = get_posts([
        'post_type' => 'page',
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_wp_page_template',
                'value' => $template_name,
                'compare' => '='
            ]
        ]
    ]);
    if (!empty($pages)) {
        foreach ($pages as $pages__value) {
            return $pages__value->ID;
        }
    }
    return (int) get_option('page_on_front');
}


function get_current_ids()
{
    global $post;
    $id = null;

    if (!is_object($post)) return;

    if (is_post_type_archive()) {
        $post_type = get_post_type($post->ID);
        $cpt = $post_type;
        $id = "cpt_$cpt";
    } elseif (is_home()) {
        $id = 'options';
    } elseif (is_front_page()) {
        $id = get_option('page_on_front');
    } else {
        $id = $post->ID;
    }
    return $id;
}
