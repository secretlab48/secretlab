<?php

if (!defined('ABSPATH')) exit;

global $wpdb, $post, $openup_data;

//ACF vars
$page_type = $openup_data[ 'page_type' ];

$menu_tel = get_field('main_menu_tel', 'option');
$menu_link = get_field('main_menu_link', 'option');
$top_menu = get_field( 'top_menu' );
?>

<div class="c-main-menu">
    <?php
        $menu_id = ( ! empty( $top_menu ) ) ? $top_menu : 'Main Menu';
        if ( $page_type == 'b2b' && $menu_id == 'Main Menu' ) {
            $default_menu = $wpdb->get_row( "SELECT * FROM wp_termmeta WHERE meta_key = 'default_b2b_menu' AND meta_value = 1" );
            $menu_id = ( is_object( $default_menu ) && $default_menu->meta_value == 1 ) ? $default_menu->term_id : 'Main Menu';
        }
            wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'menu' => $menu_id,
            'container_id' => 'cssmenu',
            'menu_class' => 'top-menu',
        ));
    ?>

    <div class="c-main-menu__consult-wrapper d-flex align-items-center d-xl-none">
        <ul class="c-main-menu__consult-list">
            <li class="c-main-menu__consult-item d-flex align-items-center">
                <a href="<?php echo $menu_tel['url']; ?>"><?php echo $menu_tel['title']; ?></a>
            </li>
            <li class="c-main-menu__consult-item d-flex align-items-center">
                <a href="<?php echo $menu_link['url']; ?>" target="<?php echo $menu_link['target']; ?>"><?php echo $menu_link['title']; ?></a>
            </li>
        </ul>
    </div>
</div>