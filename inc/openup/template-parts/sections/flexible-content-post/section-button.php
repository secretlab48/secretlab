<?php

$align = get_sub_field('post_button_align');
$color_theme = str_replace( '_', '-', get_sub_field('post_button_color_theme') );
$link = get_sub_field('post_button');

if ( ! empty( $link ) ) :
?>

<div class="c-post-button">
    <div class="container">
        <div class="row">
            <div class="post-button-box <?php echo $align; ?>ed col-12">
                <a class="c-btn c-btn-primary--<?php echo $color_theme; ?>" href="<?php echo $link[ 'url' ]; ?>"
                   target="<?php echo $link['target']; ?>"><?php echo $link[ 'title' ]; ?> </a>
            </div>
        </div>
    </div>
</div>

<?php
endif;
?>