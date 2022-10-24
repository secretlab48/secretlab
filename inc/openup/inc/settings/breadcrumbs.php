<?php

add_filter('wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link');

function yoast_seo_breadcrumb_append_link($links)
{

    if (is_singular('team')) {
        $breadcrumb[] = array(
            'url' => site_url('/team/'),
            'text' => 'Team',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }

    if (is_singular('blog')) {
        $breadcrumb[] = array(
            'url' => site_url('/blog/'),
            'text' => 'Blog',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }

    if (is_404()) {
        $breadcrumb[] = array(
            'text' => __('Error 404'),
        );
        array_splice($links, 2, -2, $breadcrumb);
    }

    return $links;
}


