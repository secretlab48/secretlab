<?php

global $post;

$prefix = ( $post->post_type == 'page' ) ? '' : 'post_text_with_title_section_';

$bg_color = get_sub_field($prefix . 'background_color' );
$layout = get_sub_field($prefix . 'layout' );
$title = get_sub_field($prefix . 'title' );
$contents = get_sub_field($prefix . 'content_box' );
$contents_class = 'has-contents';
if ( ! is_array( $contents ) ) {
    $contents_class = 'has-not-contents';
}
$bg_class = 's-title-text--' . $bg_color;
$box_class = 'c-title-text__contents-box row';
$column_class = '';

switch ( $layout ) {
    case 1 :
        $box_class .= ' c-title-text__layout-1';
        $column_class = 'col-12';
        break;
    case 2 :
        $box_class .= ' c-title-text__layout-2';
        $column_class = 'col-12 col-md-6';
        break;
    case 3 :
        $box_class .= ' c-title-text__layout-3';
        $column_class = 'col-12 col-md-6';
        break;
    case 4 :
        $box_class .= ' c-title-text__layout-4';
        $column_class = 'col-12';
        break;
}

?>

<section class="s-title-text">
    <div class="c-title-text__box <?php echo $bg_class; ?>">
        <div class="c-title-text container">
            <div class="<?php echo $box_class; ?> <?php echo $contents_class; ?>">
                <div class="c-title-text__title-box <?php echo $column_class; ?>">
                    <h5 class="c-title-text__title"><?php echo $title; ?></h5>
                </div>
                <?php if ( is_array( $contents ) && count( $contents ) > 0 ) : ?>
                <div class="c-title-text__content-box <?php echo $column_class; ?>">
                    <?php
                    foreach ( $contents as $i => $content ) {
                        echo '<div class="c-title-text__content">' . $content[ 'content' ] . '</div>';
                    }
                    ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
