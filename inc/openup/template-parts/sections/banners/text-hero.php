<?php
if (!defined('ABSPATH')) exit;

$text_hero_title = get_field('text_hero_title');
$text_hero_description = get_field('text_hero_description');
?>

<?php if ($text_hero_title or $text_hero_description) : ?>
    <section class="o-banner--full text-center u-color-primary-dark-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <?php if ($text_hero_title) : ?>
                        <h2 class="o-banner__title"><?php echo $text_hero_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($text_hero_description) : ?>
                        <div class="o-banner__description c-wysiwyg"> 
                            <?php echo $text_hero_description; ?> 
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>