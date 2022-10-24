<?php
add_action('wp_ajax_team_consult_filter', 'team_consult_filter');
add_action('wp_ajax_nopriv_team_consult_filter', 'team_consult_filter');

function team_consult_filter()
{
    $team_id = $_POST['team_id'];
    $my_current_lang = apply_filters('wpml_current_language', NULL);
    $current_terms_id = $_POST['current_term'];

    $team_arg = [
        'post_type' => 'team',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'consult_type',
                'field' => 'id',
                'terms' => $current_terms_id
            )
        ),
        'meta_query' => array(
            array(
                'key' => 'team_active_languages',
                'value' => $my_current_lang,
                'compare' => 'LIKE',
            ),
        )
    ];

    if ($team_id):
        $team_arg = array(
            'post_type' => 'team',
            'p' => (int)$team_id,
        );
    endif;

    $team_query = new WP_Query($team_arg);
    if ($team_query):
        while ($team_query->have_posts()) : $team_query->the_post();
            $curent_terms = wp_get_object_terms(get_queried_object_id(), 'consult_type');
            $curent_term_id = $curent_terms[0]->term_id;
            get_template_part('template-parts/components/team-card');
        endwhile;
        wp_reset_postdata();
    endif;

    wp_die();
}

