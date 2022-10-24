<?php

global $post;

$p = null;
if ( ! empty( $args[ 'post' ] ) ) {
    $p = $post;
    $post = $args[ 'post' ];
}

$content = get_field('content_editor_faq', $post->ID);
$add_link_list = get_field('add_link_list', $post->ID);
$link_list_faq = get_field('link_list_faq', $post->ID);
$add_image_faq = get_field('add_image_faq', $post->ID);
$image_faq = get_field('image_faq', $post->ID);
?>
<div class="c-accordion__card JS-accordion" data-post="<?php echo $post->ID; ?>">
    <div class="c-accordion__btn JS-accordion--btn">
        <h3 class="c-accordion__btn-label u-color-primary-dark-blue"><?php echo get_the_title() ?></h3>
        <svg class="icon">
            <use xlink:href="#icon-chevron-down"></use>
        </svg>
    </div>
    <div class="c-accordion__content <?= $add_image_faq && $image_faq ? '' : 'c-accordion__content--full' ?> JS-accordion--content">
        <div class="<?= $add_image_faq && $image_faq ? 'c-accordion__content--image' : '' ?>">
            <div class="c-accordion__description">
                <?php if ($content) : ?>
                    <div class="c-wysiwyg u-color-primary-dark-blue">
                        <?php echo $content; ?>
                    </div>
                <?php endif; ?>
                <?php
                if ($add_link_list && $link_list_faq):
                    if (have_rows('link_list_faq')) : ?>
                        <?php while (have_rows('link_list_faq')): the_row();
                            $link_faq = get_sub_field('link_faq');
                            ?>
                            <div class="c-accordion__link">
                                <a href="<?php echo $link_faq['url']; ?>"
                                    class="c-btn-link c-btn-link-primary--dark-blue c-btn-link--more"
                                   target="<?php echo $link_faq['target']; ?>">
                                    <?php echo $link_faq['title']; ?>
                                    <svg class="icon">
                                        <use xlink:href="#icon-arrow-team"></use>
                                    </svg>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endif; ?>
    
            </div>
            <?php if ($add_image_faq && $image_faq): ?>
                <div class="c-accordion__img-wrap">
                    <img class="c-accordion__img" src="<?php echo $image_faq['url']; ?>"
                            alt="<?php echo $image_faq['alt']; ?>"/>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    if ( $p ) {
        $post = $p;
    }
?>
