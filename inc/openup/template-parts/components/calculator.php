<?php
$section_color = get_sub_field('section_calculator_color');
$form_label = get_field('option_calculator_form_label', 'option');
$input_label = get_field('option_calculator_input_label', 'option');

switch ($section_color) {
    case 'skin':
        $bg_color = 'c-calculator--skin';
        break;
    case 'blue':
        $bg_color = 'c-calculator--blue';
        break;
    case 'green':
        $bg_color = 'c-calculator--green';
        break;
}
?>
<!-- /t -->

<div class="c-calculator <?= $bg_color ?>">
    <?php if ($form_label): ?>
        <p class="c-calculator__label">
            <?php echo $form_label ?>
        </p>
    <?php endif; ?>
    <form class="" action="">
        <label class="c-calculator__input-label">
            <?= $input_label ? $input_label : '' ?>
        </label>
        <div class="c-calculator__form">
            <div class="c-calculator__input-wrap">
                <div class="quantity">
                    <input type="number" min="1" max="1000" value="0" step="1"  class="JS--calculator_count">
                </div>
            </div>
            <div class="c-calculator__btn">
                <button class="JS--calculator-submit c-btn <?= $section_color == 'blue' ? 'c-btn-primary--dark-blue' : 'c-btn-primary--blue' ?> "
                        type="button"><?php _e('Bereken', 'openup') ?></button>
            </div>
        </div>
    </form>

    <div class="c-calculator__result JS--calculator-result">
        <ul class="c-calculator_result">
            <li class="c-calculator_result-item">
                <div class="c-calculator_result-item-wrap">
                    <span class="c-calculator_result-text"><?php echo __('Werknemers met mentale klachten ', 'openup'); ?></span>
                    <span class="u-semibold">0</span>
                </div>
            </li>
            <li class="c-calculator_result-item">
                <div class="c-calculator_result-item-wrap">
                    <span class="c-calculator_result-text"><?php echo __('Aantal verzuimdagen per jaar', 'openup'); ?> </span>
                    <span class="u-semibold">0</span>
                </div>
            </li>
            <li class="c-calculator_result-item">
                <div class="c-calculator_result-item-wrap">
                    <span class="c-calculator_result-text"><?php echo __('Verzuimkosten (jaarlijks) ', 'openup'); ?></span>
                    <span class="u-semibold">0</span>
                </div>
                <div class="c-calculator__bar-chart">
                    <span class="c-calculator__bar-chart--inner" ></span>
                </div>

            </li>
            <li class="c-calculator_result-item">
                <div class="c-calculator_result-item-wrap">
                    <span class="c-calculator_result-text"><?php echo __('OpenUp jaarabonnement ', 'openup'); ?></span>
                    <span class="u-semibold">0</span>
                </div>
                <div class="c-calculator__bar-chart">
                    <span class="c-calculator__bar-chart--inner" ></span>
                </div>
            </li>
        </ul>
    </div>
</div>
