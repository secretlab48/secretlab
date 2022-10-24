<?php

/**
 *  Partial: Sections
 *
 *  Partial for loading Sections via file name using a class extending
 *  ACF's flexible content field.
 *
 * @see       inc/acf/acf-sections.php - Sections class
 * @see       inc/fields/* - Defined fields and Sections
 */

if (!defined('ABSPATH')) exit;

$page_id = get_queried_object_id();

//ACF
$data = [];
$data['title'] = get_field('main_hero_title', $page_id);
$data['description'] = get_field('main_hero_description', $page_id);
$data['background_color_left'] = get_field('background_color_left', $page_id);
$data['background_color_left'] = ( ! empty( $data['background_color_left'] ) ) ? str_replace( '_', '-', $data['background_color_left'] ) : 'white';
$data['background_color_right'] = get_field('background_color_right', $page_id);
$data['background_color_right'] = ( ! empty( $data['background_color_right'] ) ) ? str_replace( '_', '-', $data['background_color_right']) : 'skin';
$data['number_img'] = get_field('number_of_images', $page_id);
$data['image'] = get_field('main_hero_img', $page_id);
$data['image_two'] = get_field('main_hero_img_two', $page_id);
$data['type_of_link'] = get_field('type_of_link');
$data['link'] = get_field('main_hero_link', $page_id);
$data['download_file'] = get_field('download_file_hero');
$data['download_link_title'] = get_field('download_link_title_hero');
$data['quote_triangle'] = get_field('quote__triangle', $page_id);
$data['btn_css_class'] = ( $data['background_color_left'] == 'blue' ) ? 'dark-blue' : 'blue';

$image_content = '/template-parts/components/banner-hero-image';

openup_banner_hero_slider($data,$image_content);
?>

