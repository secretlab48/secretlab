<?php

add_action('wp_ajax_calculator', 'calculator');
add_action('wp_ajax_nopriv_calculator', 'calculator');

function calculator()
{
    $employees_number = $_POST['employees_number'];
    $losses_days = get_field('option_calculator_losses_days', 'option');
    $percent = get_field('option_calculator_percent', 'option');
    $average_cost = get_field('option_calculator_average_cost','option' );
    $cost = get_field('option_calculator_cost', 'option');


    $mental_issues_employees = $employees_number * ( $percent / 100);
    $total_amount = $mental_issues_employees * $losses_days * $average_cost;
    $employees_dealing = $mental_issues_employees * $losses_days;
    $jaarabonnement = $employees_number * $cost;
    
    ?>

    <ul class="c-calculator_result">
        <li class="c-calculator_result-item">
            <div class="c-calculator_result-item-wrap">
                <span><?php echo __('Werknemers met mentale klachten ', 'openup'); ?></span>
                <span><?php echo $mental_issues_employees ?></span>
            </div>
        </li>
        <li class="c-calculator_result-item">
            <div class="c-calculator_result-item-wrap">
                <span><?php echo __('Aantal verzuimdagen per jaar', 'openup'); ?> </span>
                <span><?php echo $employees_dealing ?></span>
            </div>
        </li>
        <li class="c-calculator_result-item">
            <div class="c-calculator_result-item-wrap">
                <span><?php echo __('Verzuimkosten (jaarlijks) ', 'openup'); ?></span>
                <span><span>€ <?php echo $total_amount ?></span></span>
            </div>
            <div class="c-calculator__bar-chart">
                <span class="c-calculator__bar-chart--inner JS--bar-chart__progress" data-progress="100" ></span>
            </div>

        </li>
        <li class="c-calculator_result-item c-calculator_result-item-last">
            <div class="c-calculator_result-item-wrap">
                <span><?php echo __('OpenUp jaarabonnement ', 'openup'); ?></span>
                <span>€ <?php echo $jaarabonnement ?> </span> 
               <?php $diffcalc =  round((($jaarabonnement  * '100' ) / $total_amount) * 2.5);  ?>
            </div>
            <div class="c-calculator__bar-chart">
                <span class="c-calculator__bar-chart--inner JS--bar-chart__progress" data-progress ="<?php echo $diffcalc ?>" ></span>
            </div>
        </li>
    </ul>
    <?php
    wp_die();
}




