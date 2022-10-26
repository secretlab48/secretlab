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
//ACF fields
$section_title = get_sub_field('steps_section_title' );
$anchor = get_sub_field('steps_section_anchor' );
$anchor_html = ( ! empty( $anchor ) ) ? ( 'id="' . $anchor . '"' ) : '';
$title_tag = get_sub_field( 'steps_section_title_tag_type' );
$title_tag = ( !empty( $title_tag ) ) ? $title_tag : 'h1';
$section_description = get_sub_field('steps_section_description' );
$download_file = get_sub_field('steps_section_file_download' );
$steps = get_sub_field('steps_section_steps' );

?>

<section <?php echo $anchor_html; ?> class="s-steps-numerated s-wave s-wave--primary-green u-color-primary-white">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="s-steps-numerated__left col-12 col-md-6">
                <div class="c-intro">

                    <<?php echo $title_tag; ?> class="c-intro__heading"><?php echo $section_title; ?></<?php echo $title_tag; ?>>

                    <?php if ( $download_file ) : ?>
                        <div class="c-intro__btn d-flex">
                            <a href="<?php echo $download_file['url']; ?>"
                               class="c-btn c-btn-primary--blue"
                               target="<?php echo $download_file['target']; ?>" download>
                                <?php echo $download_file[ 'title' ]; ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="s-steps-numerated__right col-12 col-md-6">

                <div class="c-wysiwyg">
                    <?php if ( $section_description ) : ?>
                        <div class="s-info__title">
                            <?php echo $section_description; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php
                    if ( count( $steps ) > 0 ) :
                    ?>
                      <ul class="s-steps-numerated__list c-step-list c-step-list--checked">
                          <?php
                          foreach ( $steps as $i => $step ) :
                              $title_tag = ( ! empty( $step[ 'title_tag' ] ) ) ? $step[ 'title_tag' ] : 'h5';
                          ?>
                          <li class="s-steps-numerated__list-item c-step-list__item">
                              <span class="c-step-list__item-checkmark"><?php echo ( $i + 1 ); ?></span>
                              <span>
                                  <div class="s-steps-numerated__step-number"><?php echo __( 'Trin', 'openup' ) . ' ' . ( $i + 1 ); ?></div>
                                  <<?php echo $title_tag; ?> class="c-step-list__item-title"><?php echo $step[ 'title' ]; ?></<?php echo $title_tag; ?>>
                                  <div class="c-step-list__item-info"><?php echo $step[ 'description' ]; ?></div>
                              </span>
                          </li>
                          <?php
                          endforeach;
                          ?>
                      </ul>
                    <?php
                    endif;
                ?>


            </div>
        </div>
    </div>
</section>