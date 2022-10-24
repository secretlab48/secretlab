$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            let keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        })
    })
}


$(".JS--calculator-submit").click(function () {
    calculate();
});


$(".JS--calculator_count").enterKey(function (e) {
    e.preventDefault();
    calculate();

})

function calculate() {

    let employeesNumber = $('.JS--calculator_count').val();

    $.ajax({
        url: appLocations.admin_ajax,
        data: {
            action: "calculator",
            page: appLocations.page,
            employees_number: employeesNumber,
        },
        type: 'POST',
        beforeSend: function () {
        },

        success: function (data) {
            $('.JS--calculator-result').empty();
            $('.JS--calculator-result').append(data).fadeIn(250);

            let progressBar = $('.JS--bar-chart__progress');
            $.each(progressBar, function () {

                $(this).animate({width: $(this).data('progress') + '%'}, 2000);
            });

        },

        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}
