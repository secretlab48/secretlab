<?php
$page_id = get_queried_object_id();
//ACF
$number_img = get_field('number_of_images', $page_id);
$image = get_field('main_hero_img', $page_id);
$image_id = is_array( $image ) ? $image['ID'] : $image;
$image_two = get_field('main_hero_img_two', $page_id);
$image_two_id = is_array( $image_two ) ? $image_two['ID'] : $image_two;
?>

<div class="col-12 col-lg-6">
    <div class="o-main-hero__img-wrap <?= $image_two && $number_img == 'two' ? 'o-main-hero__two-img' : 'o-main-hero__one-img' ?>">
        <div class="o-main-hero__img-container">
            <?php if ($image) : ?>
                <div class="o-main-hero__img">
                    <?php echo wp_get_attachment_image($image_id,'full') ?>
                </div>
            <?php endif; ?>
            <?php if ($image_two && $number_img == 'two') : ?>
                <div class="o-main-hero__img">
                    <?php echo wp_get_attachment_image($image_two_id,'full') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

