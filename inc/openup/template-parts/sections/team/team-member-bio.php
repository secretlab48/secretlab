<?php
$team_description = get_field('team_description');
$team_link = get_field('team_link');
$team_thumbnail = get_the_post_thumbnail();

global $post;
$tax_team_position = wp_get_post_terms($post->ID, 'team_position', array('fields' => 'all'));
$tax_thema_areas = wp_get_post_terms($post->ID, 'thema_areas-taxonomy', array('fields' => 'all'));
?>


<section class="s-single-team o-banner o-banner--two-card u-color-primary-dark-blue ">
    <div class="container"> 
        <div class="row">
            <div class="col-12 col-lg-7 col-xl-8 order-2 order-lg-1">
                <div class="o-banner__intro-container">
                    <h1 class="o-banner__title"><?php the_title(); ?></h1>

                    <?php if ($tax_thema_areas) { ?>
                        <div class="o-banner__meta-wrapper d-flex flex-wrap align-items-center justify-content-start">
                            <svg class="icon">
                                <use xlink:href="#icon-tag"></use>
                            </svg> 
                            <?php foreach ($tax_thema_areas as $term) { ?>
                                <span class="o-banner__meta"><?php echo $term->name; ?></span>
                            <?php } ?> 
                        </div>
                    <?php } ?>

                    <?php echo team_render_card_flags( get_field( 'team_visible_languages', $post->ID ) ); ?>

                    <?php if ($team_description) : ?>
                        <div class="o-banner__description c-wysiwyg">
                            <?php echo $team_description; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($team_link): ?>
                        <div class="o-banner__link d-flex">
                            <a class="c-btn c-btn-primary--blue" href="<?php echo $team_link['url'] ?>"
                               target="<?php echo $team_link['target']; ?>"><?php echo $team_link['title'] ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div> 
            <div class="col-12 col-lg-5 col-xl-4 order-1 order-lg-2">
                <div class="o-banner__photo-container">
                    <?php if ($tax_team_position) : ?> 
                        <?php foreach ($tax_team_position as $term) { ?>
                            <div class="o-banner__position" style="background-color:<?php the_field('job_role_color', $term); ?>">
                                <!--<h5 class="o-banner__position-text"><?php /*echo $term->name;*/ ?></h5>-->
                            </div>
                        <?php } ?> 
                    <?php endif; ?>

                    <?php if ($team_thumbnail) : ?>
                        <div class="o-banner__foto"><?php echo $team_thumbnail; ?></div>
                    <?php endif; ?> 
                </div>
            </div>
        </div> 
    </div>
</section>

