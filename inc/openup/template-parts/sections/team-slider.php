<?php

if (!defined('ABSPATH')) exit;

$data = [];
$data['title'] = get_field('team_slider_title', 'option');
$data['description'] = get_field('section_description', 'option');
$data['teams'] = get_field('team_slider_teams', 'option');
$data['after_slider_text'] = get_field('team_slider_after_text', 'option');
$data['link'] = get_field('team_slider_link', 'option');
$data['s_bg'] = get_sub_field('team_slider_section_background');

?>

<section class="s-team <?php echo $data['s_bg'] == 'pink' ? 'u-bg-primary-skin ' : 'u-bg-secondary-skin' ?>">
    <?php openup_render_team_slider_section( $data ); ?>
</section>