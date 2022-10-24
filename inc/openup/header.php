<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package openup
 */

if (!defined('ABSPATH')) exit;
global $post;
$global_tracking_body = (class_exists('ACF')) ? get_field('global_tracking_body', 'options') : null;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
# Global / Page Tracking
if ($global_tracking_body) : echo $global_tracking_body; endif;

$data = null;
if ( is_singular( 'space' ) ) {
    $data = openup_get_single_live_space_data( $post );
}

$page_id = get_queried_object_id();
$background_color_left_hero_slider = get_field('hero_slider_background_color', $page_id);
$background_color_left = get_field('background_color_left', $page_id);

$header_style = openup_header_styles($data);
$header_style .= (in_array($background_color_left, ['skin', 'white']) && get_page_template_slug() != 'templates/template-home-with-slider.php') || in_array($background_color_left_hero_slider, ['skin', 'white']) ? ' o-header-darken-logo' : '';
$header_style .= (in_array($background_color_left, ['green', 'blue', 'dark_blue']) && get_page_template_slug() != 'templates/template-home-with-slider.php') || in_array($background_color_left_hero_slider, ['green', 'blue', 'dark_blue']) ? '  o-header-light-logo' : '';
?>

<div id="page" class="site">
    <?php if (is_page_template('templates/template-consult.php')
        || is_page_template('templates/template-chat-bedankt.php')
        || is_page_template('templates/template-consult-booking.php')
        || is_page_template('templates/template-boek-consult-post.php')
        || is_page_template('templates/template-video-bedankt.php')): ?>
    <?php else: ?>
        <header class="o-header <?php echo $header_style ?>" id="header-main">
            <?php get_template_part('template-parts/organisms/header/header-main'); ?>
            <?php get_template_part('template-parts/organisms/header/main-menu'); ?>
        </header>
    <?php endif; ?>
    <div id="content" class="site-content">


