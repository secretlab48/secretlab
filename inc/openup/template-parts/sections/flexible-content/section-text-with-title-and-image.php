<?php

$bg_color = get_sub_field('background_color' );
$layout = get_sub_field('layout' );
$image_position = get_sub_field('image_position' );
$title = get_sub_field('title' );
$title_font_size = get_sub_field( 'title_font_size' );
$title_font_size = ( ! empty( $title_font_size ) && $title_font_size != 'default' ) ? $title_font_size : null;
$title_font_size_style = ( $title_font_size ) ? ' style="font-size:' . $title_font_size . 'px;"' : '';
$contents = get_sub_field('contents' );
$image = get_sub_field('image' );
$contents_class = 'has-contents';
if ( ! is_array( $contents ) ) {
    $contents_class = 'has-not-contents';
}
$bg_class = 's-title-text-image--' . $bg_color;
$image_position_class = ( ! empty( $image_position ) ) ? ' c-title-text-image__image-' . $image_position : '';
$box_class = 'c-title-text-image__contents-box c-title-text-image__layout-' . $layout . ' row' . $image_position_class;
$column_class = '';

?>

<section class="s-title-text-image">
    <div class="c-title-text-image__box <?php echo $bg_class; ?>">
        <div class="c-title-text-image container">
            <div class="<?php echo $box_class; ?> <?php echo $contents_class; ?>">
                <?php
                switch ( $layout ) {
                    case 1 : ?>
                        <div class="c-title-text-image__title-text-box col-12 col-md-6">
                            <div class="c-title-text-image__title-box">
                                <h5 class="c-title-text-image__title"<?php echo $title_font_size_style; ?>><?php echo $title; ?></h5>
                            </div>
                            <?php if ( is_array( $contents ) && count( $contents ) > 0 ) : ?>
                            <div class="c-title-text-image__inner-contents-box">
                                <?php
                                foreach ( $contents as $i => $content ) {
                                    echo '<div class="c-title-text-image__content">' . $content[ 'content' ] . '</div>';
                                }
                                ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="c-title-text-image__image-box col-12 col-md-6">
                            <?php echo wp_get_attachment_image( $image['id'], 'full', false, [ 'class' => 'c-title-text-image__image' ] ); ?>
                        </div>
                        <?php
                        break;
                    case 2 : ?>
                        <div class="c-title-text-image__title-image-box col-12 col-md-6">
                            <div class="c-title-text-image__title-box">
                                <h5 class="c-title-text-image__title"<?php echo $title_font_size_style; ?>><?php echo $title; ?></h5>
                            </div>
                            <div class="c-title-text-image__image-box">
                                <?php echo wp_get_attachment_image( $image['id'], 'full', false, [ 'class' => 'c-title-text-image__image' ] ); ?>
                            </div>
                        </div>
                        <?php if ( is_array( $contents ) && count( $contents ) > 0 ) : ?>
                            <div class="c-title-text-image__inner-contents-box  col-12 col-md-6">
                                <?php
                                foreach ( $contents as $i => $content ) {
                                    echo '<div class="c-title-text-image__content">' . $content[ 'content' ] . '</div>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        break;
                    case 3 : ?>
                        <div class="c-title-text-image__title-text-image-box">
                            <div class="c-title-text-image__title-box">
                                <h5 class="c-title-text-image__title"<?php echo $title_font_size_style; ?>><?php echo $title; ?></h5>
                            </div>
                            <div class="c-title-text-image__image-box">
                                <?php echo wp_get_attachment_image( $image['id'], 'full', false, [ 'class' => 'c-title-text-image__image' ] ); ?>
                            </div>
                            <?php if ( is_array( $contents ) && count( $contents ) > 0 ) : ?>
                                <div class="c-title-text-image__inner-contents-box">
                                    <?php
                                    foreach ( $contents as $i => $content ) {
                                        echo '<div class="c-title-text-image__content">' . $content[ 'content' ] . '</div>';
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                        break;
                }
                ?>
            </div>
        </div>
    </div>
</section>
