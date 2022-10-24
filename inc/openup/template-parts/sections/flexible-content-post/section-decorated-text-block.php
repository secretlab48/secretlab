<?php

if (!defined('ABSPATH')) exit;

$background_color = str_replace( '_', '-', get_sub_field( 'post_decorated_text_block_background_color' ) );
$content_tag = get_sub_field( 'post_decorated_text_block_content_tag' );
$font_size_template = ( $content_tag == 'h3' ) ? 'large' : 'medium';
$content = get_sub_field( 'post_decorated_text_block_content' );

?>

<section class="s-post-decorated-text-block">
    <div class="s-post-decorated-text-block-content-box s-wave--primary-<?php echo $background_color; ?>">
        <div class="s-wave__inner-wrapper">
            <svg class="s-wave__icon icon-top">
                <use xlink:href="#wave-top-type-3"></use>
            </svg>
            <svg class="s-wave__icon icon-bottom">
                <use xlink:href="#wave-bottom-type-3"></use>
            </svg>
        </div>

        <div class="s-post-decorated-text-block__content container text-center font-size-template-<?php echo $font_size_template; ?>">
            <div class="row justify-content-center">
                <div class="s-post-decorated-text-block__content__column col-md-12">
                    <?php echo '<' . $content_tag . '>' . $content . '</' . $content_tag . '>'; ?>
                </div>
            </div>
        </div>
    </div>
</section>
