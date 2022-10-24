<?php

//ACF

$title = get_field('stable_image_title');
$description = get_field('stable_image_description');
$bg_color = '';
if (is_page_template('templates/template-archive-webinar.php')):
    $bg_color = 'o-main-hero--violet';
endif;
?>


<section class="o-main-hero <?php echo $bg_color; ?> o-main-hero--column o-main-hero--static-img u-color-primary-dark-blue">
    <div class="container">
        <div class="row"> 
            <div class="col-12 col-md-9 col-lg-5">
                <div class="o-main-hero__container">
                    <?php if ($title) : ?>
                        <h1 class="o-main-hero__title"><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <div class="o-main-hero__description"><?php echo $description; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (is_page_template('templates/template-archive-ebook.php')): ?>
                <div class="o-main-hero__img-container">
                    <img src="/wp-content/themes/openup/img/global/man-and-books.svg" alt="E-book Page Image"/>
                </div>
            <?php else: ?>
            <div class="o-main-hero__img-container"> 
                <img src="/wp-content/themes/openup/img/global/presentation.png" alt="Webinar Page Image"/>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>