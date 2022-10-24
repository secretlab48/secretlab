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

global $post;

//ACF fields
$section_title = get_sub_field('horizontal_cards_section_title');
$horizontal_cards = get_sub_field('horizontal_cards');
$section_background_color = get_sub_field('section_background_color');
$section_background_color = ( ! empty( $section_background_color ) ) ? str_replace( '_', '-', get_sub_field('section_background_color') ) : 'skin';
$cards_button_color = get_sub_field('cards_button_color');
$cards_button_color = ( ! empty( $cards_button_color ) ) ? str_replace( '_', '-', get_sub_field('cards_button_color') ) : 'blue';
switch ( $section_background_color ) {
    case 'white' :
    case 'skin' :
        $text_color = 'dark-blue';
        break;
    case 'green' :
    case 'blue' :
    case 'dark-blue' :
        $text_color = 'white';
        break;
    default :
        $text_color = 'dark-blue';
}
?>
<section class="s-thema-term s-thema-term--bedrijven u-bg-secondary-<?php echo $section_background_color; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php if ($section_title) : ?>
                <h2 class="o-banner__title u-color-primary-<?php echo $text_color; ?>"><?php echo $section_title; ?></h2>
                <?php endif; ?>
            </div>
        </div>
        <?php
        if(have_rows('horizontal_cards')):
        $i = 0;
        while (have_rows('horizontal_cards')): the_row();
            $i++;

            $card_title = get_sub_field('card_title');
            $card_description = get_sub_field('card_description');
            $images_layout = get_sub_field('images_layout');
            if ( $images_layout == 1 ) {
                $layout_class = ' has-single-image';
                $card_image = get_sub_field('card_image');
            }
            else if ( $images_layout == 2 ) {
                $layout_class = ' has-team-gallery';
                $team_members = get_sub_field('team_members');
                $type_of_link = get_sub_field( 'type_of_link' );
                $link = $anchor = null;
                if ( $type_of_link == 'link' ) {
                    $link = get_sub_field('link');
                }
                else if ( $type_of_link == 'anchor' ) {
                    $anchor = get_sub_field('job_board_images_set_anchor');
                }
            }
            //$card_auto_image_height = get_post_meta( $post->ID, 'flexible_content_page_1_horizontal_cards_' . ( $i - 1 ) . '_card_auto_image_height', true );
            $checked_title = get_sub_field( 'add_checked' );
            $checked_title_class = ( $checked_title == 1 ) ? ' u-check-mark' : '';
            $card_auto_image_height = get_sub_field( 'card_auto_image_height' );
            $card_auto_image_height_class = ( $card_auto_image_height != 1 ) ? '' : ' img-auto-height ';
            ?>

                <div class="u-color-primary-<?php echo $text_color; ?> c-thema-card
                     <?php if ($i % 2 == 0) echo 'c-thema-card--reverse'; echo $layout_class ?>">
                    <div class="row">
                        <div class="col-12 col-md-6 order-2 order-md-1 align-self-center">
                            <div class="c-thema-card__body">
                            <?php if ($card_title): ?>
                                <h5 class="c-thema-card__title<?php echo $checked_title_class; ?>"><?php echo $card_title; ?></h5>
                            <?php endif; ?>
                            <?php if ($card_description): ?>
                                <div class="c-thema-card__description"><?php echo $card_description; ?></div>
                            <?php endif; ?>
                            </div>
                            <?php if ( $images_layout == 2 && ! empty( $link ) ) : ?>
                            <a class="c-btn c-btn-primary--<?php echo $cards_button_color; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                            <?php endif; ?>
                            <?php if ( $images_layout == 2 && ! empty( $anchor ) ) : ?>
                                <a class="job-board-btn anchor-btn c-btn c-btn-primary--<?php echo $cards_button_color; ?>" href="#department-<?php echo strtolower( str_replace( ' ', '-', $anchor ) ); ?>"><?php echo __( 'Team careers', 'openup' ); ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="c-thema-card__image-box col-12 col-md-6 order-1 order-md-2">
                            <?php
                                if ( $images_layout == 1 ) {
                                    echo wp_get_attachment_image($card_image['ID'], 'full', "", array("class" => "c-thema-card__img" . $card_auto_image_height_class));
                                }
                                else if ( $images_layout == 2 ) {
                                    foreach ( $team_members as $team_member ) {
                                        echo
                                            '<div class="c-thema-card__team-card">
                                                <a class="c-thema-card__team-card_link" href="' . $team_member[ 'link' ] . '">' .
                                                    wp_get_attachment_image( $team_member[ 'image' ][ 'ID' ], 'full', "", array( "class" => "c-thema-card__team-card_img" ) ) .
                                                '</a>
                                                <div class="c-thema-card__team-card_name">' . $team_member[ 'name' ] . '</div>
                                                <div class="c-thema-card__team-card_position">' . $team_member[ 'position' ] . '</div>
                                             </div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
        <?php endwhile;
        endif;
        ?>
    </div>
</section>
