<?php

$title = get_sub_field( 'spaces_hero_banner_title' );
$description = get_sub_field( 'spaces_hero_banner_description' );
$live_spaces_link = get_sub_field( 'spaces_hero_banner_live_spaces_link' );
$live_spaces_link_color = get_sub_field( 'spaces_hero_banner_live_spaces_link_color' );
$on_demand_spaces_link = get_sub_field( 'spaces_hero_banner_on_demand_spaces_link' );
$on_demand_spaces_link_color = get_sub_field( 'spaces_hero_banner_on_demand_spaces_link_color' );
$type_sections = get_sub_field( 'spaces_hero_banner_type_sections' );
$live_spaces_link_color = ( ! empty( $live_spaces_link_color ) ) ? $live_spaces_link_color : 'white';
$on_demand_spaces_link_color = ( ! empty( $on_demand_spaces_link_color ) ) ? $on_demand_spaces_link_color : 'blue';
$categories = get_terms([
    'taxonomy' => 'space_type',
    'hide_empty' => false,
]);

?>

<section class="o-main-hero o-main-hero--ellipsis u-bg-primary-dark-blue u-color-primary-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                <h1 class="o-main-hero__title"><?php echo $title; ?></h1>
                <div class="o-main-hero__description">
                    <?php echo $description; ?>
                </div>
                <div class="o-main-hero__btn--wrap">
                    <?php
                    if ( ! empty( $live_spaces_link[ 'url' ] ) ) :
                        $href = $live_spaces_link[ 'url' ] == '#' ? '#s-live-spaces' : $live_spaces_link[ 'url' ];
                    ?>
                    <div class="o-main-hero__btn">
                        <a class="c-btn c-btn-primary--<?php echo $live_spaces_link_color; ?> live-spaces--btn" href="<?php echo $href; ?>"><?php echo $live_spaces_link[ 'title' ]; ?></a>
                    </div>
                    <?php endif; ?>
                    <?php
                    if ( ! empty( $on_demand_spaces_link[ 'url' ] ) ) :
                        $href = $on_demand_spaces_link[ 'url' ] == '#' ? '#s-on-demand-spaces' : $on_demand_spaces_link[ 'url' ];
                    ?>
                    <div class="o-main-hero__btn">
                        <a class="c-btn c-btn-primary--<?php echo $on_demand_spaces_link_color; ?> on-demand-spaces--btn" href="<?php echo $href; ?>"><?php echo $on_demand_spaces_link[ 'title' ]; ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <?php
                $page_url = get_permalink( get_the_ID() ) . '#s-live-spaces';
                foreach ($categories as $category):
                    $section_description = get_field('space_type_section_description', $category->taxonomy . '_' . $category->term_id);
                    $section_image = get_field('space_type_section_image', $category->taxonomy . '_' . $category->term_id);
                    $section_bg = get_field('space_type_color_theme', $category->taxonomy . '_' . $category->term_id);
                    ?>
                    <a href="<?php echo $page_url;  ?>" class="o-main-hero__spaces-card s-live-spaces__filter s-live-spaces__filter-trigger  u-bg-primary-<?php echo $section_bg; ?>" data-space_type_term="<?php echo $category->term_id; ?>">
                        <div class="o-main-hero__spaces-card-wave"></div>
                        <div class="o-main-hero__spaces-card-img">
                            <?php echo wp_get_attachment_image( $section_image[ 'ID' ], 'full' ); ?>
                        </div>
                        <h6><?php echo $category->name; ?></h6>
                        <?php if ($section_description) : ?>
                        <div class="o-main-hero__spaces-card-description">
                            <?php echo $section_description; ?>
                        </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>