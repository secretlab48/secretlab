<?php

//ACF
$title_position = get_sub_field('side_title_text_section_title_position');
$title = get_sub_field('side_title_text_section_title');
$description = get_sub_field('side_title_text_section_description');

?> 

<section class="o-banner o-banner--side u-color-primary-dark-blue">
    <div class="container">
        <div class="row justify-content-lg-between align-items-lg-start">
            <?php if ($title): ?>
                <div class="col-12 col-lg-5 <?= $title_position == 'right' ? 'order-lg-2' : '' ?>"> 
                        <h2 class="o-banner__title"><?php echo $title ?></h2> 
                </div>
            <?php endif; ?>
            <?php if ($description): ?>
                <div class="col-12 col-lg-6 <?= $title_position == 'right' ? 'order-lg-1' : '' ?>">
                    <div class="o-banner__description c-wysiwyg pt-lg-4">
                        <div class="c-wysiwyg">
                            <?php echo $description ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
