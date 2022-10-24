<?php
$section_type = get_sub_field('post_section_type');
$section_type = ( ! empty( $section_type ) ) ? $section_type : 'regular';
$title = get_sub_field('post_section_title');
$post_text = get_sub_field('post_text');

?>

<div class="c-post-text <?php echo $section_type; ?>-post_text-section u-color-primary-dark-blue">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="c-post-text__content-box">
                    <?php if ( $section_type != 'regular' && ! empty( $title ) ) : ?>
                    <div class="c-post-text__title">
                        <?php echo $title; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($post_text): ?>
                    <div class="c-wysiwyg">
                        <?php echo $post_text ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>