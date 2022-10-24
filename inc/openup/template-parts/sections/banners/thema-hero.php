<?php
if (!defined('ABSPATH')) exit;

$theme_hero_title = get_field('theme_hero_title');
$theme_hero_description = get_field('theme_hero_description');
?>

<?php if ($theme_hero_title) : ?>
    <h2 class="o-banner__title"><?php echo $theme_hero_title; ?></h2>
<?php endif; ?>
<?php if ($theme_hero_description) : ?>
    <div class="o-banner__description c-wysiwyg">
        <?php echo $theme_hero_description; ?>
    </div>
<?php endif; ?>