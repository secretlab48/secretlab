jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><img src="/wp-content/themes/openup/img/icons/icon-angle-down.svg" alt=""></div><div class="quantity-button quantity-down"><img src="/wp-content/themes/openup/img/icons/icon-angle-down.svg" alt=""></div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function () {
    let spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');
    btnUp.click(function () {
        let oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
        let oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });
});
