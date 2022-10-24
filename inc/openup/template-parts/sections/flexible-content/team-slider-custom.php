<?php

if (!defined('ABSPATH')) exit;

$data['title'] = get_sub_field('title' );
$data['description'] = get_sub_field('description' );
$data['teams'] = get_sub_field('teams' );
$data['link'] = get_sub_field('link' );
$data['s_bg'] = get_sub_field('background');

?>

<section class="team-slider-custom-section s-team <?php echo 'bg-' . $data['s_bg']; ?>">
    <?php openup_render_team_slider_section( $data ); ?>
</section>