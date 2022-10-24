<?php
global $post;

$fields = get_fields( $post->ID );
$requsted_term_id = isset( $_POST['current_term'] ) ? $_POST['current_term'] : null;
$taxonomies_with_link = get_field( 'taxonomy_with_link', $post->ID );
$cur_terms = get_the_terms($post->ID, 'team_position');
$current_tax_url = null;
foreach ( $taxonomies_with_link as $i => $tax ) {
    if ( $tax['team_active_url_taxonomy'] == $requsted_term_id ) {
        $current_tax_url = $tax['team_active_url'];
    }
}
$name = get_field( 'team_name', $post->ID );
$surname = get_field( 'team_surname', $post->ID );


?>
<div class="c-team-card__wrap">
    <a href="<?= $requsted_term_id && $current_tax_url ? $current_tax_url : ''?>" class="c-team-card">
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
