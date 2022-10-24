<?php

$post_image = get_sub_field('image_for_post');
$position_image = get_sub_field('position_image_for_post');

$position_class = '';
switch ($position_image) {
    case 'left':
        $position_class = 'justify-content-start';
        break;
    case 'center':
        $position_class = 'justify-content-center';
        break;
    case 'right':
        $position_class = 'justify-content-end';
        break;
}
?>

<?php if ($post_image): ?>
    <div class="c-post-image">
        <div class="container">
            <div class="row <?php echo $position_class; ?>">
                <div class="col-12 col-md-10 col-lg-8">
                    <img class="" src="<?php echo $post_image['url'] ?>" alt="<?php echo $post_image['alt'] ?>">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>