<?php
// ACF vars
$section_color = get_sub_field('section_calculator_color');
$section_title = get_sub_field('section_calculator_title');
$cost = get_sub_field('section_calculator_cost');
$cost_label = get_sub_field('section_calculator_cost_label');

switch ($section_color) {
    case 'skin':
        $bg_color = 's-calculator--primary-skin';
        $column_color = 's-calculator--column-skin';
        $text_color = 'u-color-primary-dark-blue';
        break;
    case 'blue':
        $bg_color = 's-calculator--primary-blue';
        $column_color = 's-calculator--column-blue';
        $text_color = 'u-color-primary-white';
        break;
    case 'green':
        $bg_color = 's-calculator--primary-green';
        $column_color = 's-calculator--column-green';
        $text_color = 'u-color-primary-white';
        break;
}
?>

<section class="s-calculator  s-calculator--column <?= $bg_color ?> <?= $column_color ?> <?= $text_color ?>">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-9 col-lg-5">
                <div class="s-calculator__container">
                    <?php if ($section_title): ?>
                        <h2 class="s-calculator__title">
                            <?php echo $section_title ?>
                        </h2>
                    <?php endif; ?>

                    <div class="s-calculator__cost-wrapper ">
                        <?php if ($cost): ?>
                            <div class="s-calculator__cost u-bg-primary-dark-blue u-color-primary-white">
                                <?php echo $cost ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($cost_label): ?>
                            <span class="s-calculator__cost-label">
                             <?php echo $cost_label ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="ol-12 col-lg-5">
                <?php get_template_part('template-parts/components/calculator'); ?>
            </div>
        </div>
    </div>
</section>
