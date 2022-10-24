<?php

global $post, $openup_data, $wpdb;

if (!defined('ABSPATH')) exit;

//ACF vars
$page_type = $openup_data[ 'page_type' ];
if ( $page_type == 'b2c' ) {
    $sql_prefix = '';
    $button_mobile = get_field('book_session_button_mobile', 'option');
    $button_desktop = get_field('book_session_button_desktop', 'option');
    $session_menu = get_field('book_session_menu', 'option');
    $session_menu_field_name = 'book_session_menu';
}
else if ( $page_type == 'b2b' ) {
    $sql_prefix = 'b2b_';
    $button_mobile = get_field('book_session_button_mobile_b2b', 'option');
    $button_desktop = get_field('book_session_button_desktop_b2b', 'option');
    $session_menu = get_field('book_session_menu_b2b', 'option');
    $session_menu_field_name = 'book_session_menu_b2b';
}

$consult_menu_mode_class = '';
$sql_lang_prefix = ( $openup_data[ 'current_lang' ] == 'nl' ) ? '' : $openup_data[ 'current_lang' ] . '_';
$consult_menu_items = $wpdb->get_results( "SELECT * FROM `wp_options` WHERE `option_name` REGEXP '^options_" . $sql_lang_prefix . "book_session_menu_" . $sql_prefix . "[0-9]+_link'" );
if ( count( $consult_menu_items ) == 0 ) {
    $consult_menu_mode_class = ' wrapped-mode';
}

?>

<?php if ($button_desktop): ?>
    <div class="d-none d-xl-flex c-main-menu__nav-list-wrapper<?php echo $consult_menu_mode_class; ?>">
        <a class="c-btn-outline c-btn-outline-primary--dark-blue" href="<?php echo $button_desktop['url']; ?>">
            <?php echo $button_desktop['title']; ?>
        </a>
        <?php if( have_rows($session_menu_field_name, 'option') ): ?>
            <ul class="c-main-menu__nav-list">
                <?php while( have_rows($session_menu_field_name, 'option') ): the_row();
                    $link = get_sub_field('link', 'option');
                    if ( ! empty( $link[ 'url' ] ) ) :
                    ?>
                    <li class="c-main-menu__nav-item">
                        <a href="<?php echo $link['url'] ?>" class="c-main-menu__nav-link" target="<?php echo $link['target']; ?>">
                            <?php echo $link['title'] ?>
                        </a>
                    </li>
                <?php endif; endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php if ($button_mobile): ?>
    <div class="d-flex d-xl-none">
        <a href="<?php echo $button_mobile['url'] ?>" class="c-btn c-btn-primary--blue" target="<?php echo $button_mobile['target']; ?>">
            <?php echo $button_mobile['title'] ?>
        </a>
    </div>
<?php endif; ?>



