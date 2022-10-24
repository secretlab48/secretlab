<?php

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects($items, $args)
{
    foreach ($items as &$item) {
        // vars
        $menu_label_element = get_field('menu_label_element', $item);
        $line_decoration = get_field('menu_label_line_decoration', $item);

        if ($menu_label_element) {
            array_push($item->classes, 'menu-item__label');
        }

        if ($menu_label_element && $line_decoration) {
            array_push($item->classes, 'c-main-menu__top-line');
        }
    }
    return $items;

}
