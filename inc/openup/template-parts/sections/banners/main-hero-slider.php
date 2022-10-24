<?php

if (!defined('ABSPATH')) exit;

$page_id = get_queried_object_id();
//ACF
$data = [];
$data['title'] = get_field('main_hero_slider_title', $page_id);
$data['description'] = get_field('main_hero_slider_description', $page_id);
$data['background_color_left'] = get_field('hero_slider_background_color', $page_id);
$data['background_color_left'] = ( ! empty( $data['background_color_left'] ) ) ? str_replace( '_', '-', $data['background_color_left'] ) : 'white';
$data['type_of_link'] = 'link'; //get_field('main_hero_slider_type_of_link');
$data['link'] = get_field('main_hero_slider_link', $page_id);
$data['btn_css_class'] = ( $data['background_color_left'] == 'blue' ) ? 'dark-blue' : 'blue';
$image_content = '/template-parts/components/banner-hero-slider';

openup_banner_hero_slider($data,$image_content);
?>
