<?php
global $post;
$curent_terms = wp_get_object_terms(get_queried_object_id(), 'consult_type');
$curent_term_id = $curent_terms[0]->term_id;
$cur_terms = get_the_terms($post->ID, 'team_position');
$name = get_field( 'team_name', $post->ID );
$surname = get_field( 'team_surname', $post->ID );

// ACF VARS

$rows = get_field('taxonomy_with_link');
$team_active_url = '';
if ( is_array( $rows ) ) :
    $team_active_url = isset( $rows[0]['team_active_url'] ) ? $rows[0]['team_active_url'] : '#';
    foreach ($rows as $row) :
        $active_url = $row['team_active_url'];
        $url_taxonomy = $row['team_active_url_taxonomy'];
        if ($url_taxonomy == $curent_term_id):
            $team_active_url = $active_url;
        endif;
    endforeach;
endif;

?>

<div class="c-team-card__wrap">
    <a href="<?= $team_active_url; ?>" class="c-team-card">
        <div class="c-team-card__img">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="c-team-card__body">
            <div class="c-team-card__link c-btn-link c-btn-link-primary--dark-blue c-btn-link--more">
                <div class="c-team-card__bio__box">
                    <div class="c-team-card__bio name"><?php echo $name; ?></div>
                    <div class="c-team-card__bio surname"><?php echo $surname; ?></div>
                </div>
                <?php echo team_render_card_flags( get_field( 'team_visible_languages', $post->ID ), 4 ); ?>
                <!--<svg class="icon"><use xlink:href="#icon-arrow-team"></use></svg>-->
            </div>
            <?php
            if (is_array($cur_terms)) : ?>
                <?php foreach ($cur_terms as $cur_term): ?>
                    <span class="c-team-card__info">
                        <?php echo $cur_term->name; ?>
                    </span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </a>
</div>
