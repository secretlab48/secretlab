// Contact form
if ($('.JS-form').length !== 0) {
    $(".JS-form input, .JS-form textarea, .JS-form select").focus(function () {
        $(this).parent().siblings('label').addClass('has-value');
    })
        .blur(function () {
            var text_val = $(this).val();
            if (text_val === "") {
                $(this).parent().siblings('label').removeClass('has-value');
            }
        });
}

// popup
let backdropFilter = $("#backdropFilter");

$(".JS-open-modal").on("click", function (event) {
    event.preventDefault();
    if (!$(event.target).parents('.o-spaces-hero__btn').hasClass('has-error')) {
        backdropFilter.addClass('show');
        $('.popup.subscribe-livespaces').show();
        $('body').addClass('modal-open');
    }
});
$('.close-popup').click(function (e) {
    e.stopPropagation();
    backdropFilter.removeClass('show');
    $('body').removeClass('modal-open');
    $('html, body').animate({ scrollTop: 0 }, 300)
});

//radio btn checked
$('.o-popup-form__radio-input').on('click', function () {
    let placeholderSelect = $(this).siblings('.o-popup-form__dropdown').find('.o-popup-form__select').attr('data-placeholder');
    $('.o-popup-form__select').text(placeholderSelect);
    $('.o-popup-form__radio label').removeClass('error')
    const attr = $(this).parents('.o-popup-form__radio').find('.savedSearches').attr('data-dropdown_id');
    $('.o-popup-form__radio-input').removeClass('active')
    if ($(this).is(':checked')) {
        $(this).addClass('active')
    }
    $('.required-hidden').removeAttr('required')
    if ($(this).attr("id") === attr && $(this).hasClass('active')) {
        $('.o-popup-form__radio .o-popup-form__dropdown').hide(300);
        $(this).siblings('.o-popup-form__dropdown').show(300);
        $(this).siblings('.required-hidden').attr('required', true)
    } else {
        $('.required-hidden').removeAttr('required')
        $('.o-popup-form__radio .o-popup-form__dropdown').hide(300);
    }
    if ($(this).siblings('.required-hidden').attr('required') !== undefined) {
        $(this).siblings('.o-popup-form__dropdown').find('.o-popup-form__select').addClass('error')
    }


});

// radio btn selected
$('.o-popup-form__input').on('keyup', function () {
    let value = $(this).val();
    let $parent = $(this).closest('.o-popup-form__dropdown');
    let results = 0;
    let patt = new RegExp(value, "i");

    $('.o-popup-form__list-item', $parent).each(function (index) {
        $(this).hide();
        if ($(this).text().search(patt) >= 0) {
            $(this).show();
            results = 1;
        }
    });
    if (results == 0) {
        if (!$('.no-results', $parent).length) {
            $('.o-popup-form__list', $parent).append('<li class="no-results">No results found</li>');
        }
    } else {
        $('.no-results', $parent).remove();
    }
});

$('.o-popup-form__select').on('click', function () {
    $(this).addClass('active');
    $('.o-popup-form__select-open').hide();
    $(this).siblings('.o-popup-form__select-open').show();
    $(this).siblings('.o-popup-form__select-open').children('.searchInput').children('input').focus();
})


$('.o-popup-form__list-item').on('click', function () {
    let lineText = $(this).text();
    $('.o-popup-form__select').removeClass('active error');
    $(this).parents('.o-popup-form__select-open').siblings('.o-popup-form__select').text(lineText);
    $(this).parents('.o-popup-form__radio').find('.required-hidden').val(lineText)
    $('.o-popup-form__select-open').hide();
    $(this).siblings('.searchInput').find('.o-popup-form__input').val('');
    $('.o-popup-form__list-item').removeClass('current-item');
    $(this).addClass('current-item');
});
$('.searchInputClear').on('click', function () {
    $('.o-popup-form__input').val('').keyup();
});


$('html').on('click', function (e) {
    if ($(e.target).parents('.o-popup-form__dropdown').length == 0 && $(e.target).siblings('.o-popup-form__dropdown').length == 0 && $(e.target).children('.o-popup-form__dropdown').length == 0) {
        $('.o-popup-form__select-open').hide();
        $('.o-popup-form__select').removeClass('active');
        $('.o-popup-form__input').val('').keyup();
    }
});


let email = $('.email-validate');
const validateEmail = (email) => {
    let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(String(email).toLowerCase());
}
email.blur(function () {
    if (!validateEmail(email.val())) {
        $('.error-validate').addClass('error');
        $('.o-popup-form ._submit').attr('disabled', true)
    } else {
        $('.error-validate').removeClass('error');
        $('.o-popup-form ._submit').removeAttr('disabled')
    }
});
$('.o-popup-form ._submit').on('click', function () {
    if (!$('.o-popup-form__radio-input').is(":checked")) {
        $('.o-popup-form__radio label').addClass('error')
    }
    if (!validateEmail(email.val())) {
        $('.error-validate').addClass('error');
        $('.o-popup-form ._submit').attr('disabled', true)
    }
})


$('.o-popup-form').on('submit', function (e) {
    e.preventDefault();
    const data = {};
    data.employer = data.openup_friends_and_family = data.not_offered_by_organization = 0;
    $('.o-popup-form__form input.ls-value').each(function (i, el) {
        if (!$(el).hasClass('last-radio--item')) {
            data[$(el).attr('name')] = $(el).val();
        } else {
            if ($(el).is(':checked')) {
                data[$(el).attr('data-name')] = 1;
            }
        }
    });
    $('.o-popup-form__form li.ls-value.current-item').each(function (i, el) {
        data[$(el).attr('data-key')] = $(el).attr('data-value');
    });
    data.action = 'openup_assign_attendee_to_event';
    console.log(data);
    $('body').addClass('loading');
    $.ajax({
        'method': 'POST',
        'url': appLocations.admin_ajax,
        'data': data,
        'success': function (answer) {
            var result = JSON.parse(answer);
            $('body').removeClass('loading');
            console.log(result);
            $('.popup.subscribe-livespaces').hide();
            $('.backdrop-filter').addClass('has-message');
            $('.o-popup-form__message').find('.o-popup-form__message__title').html(result.title);
            $('.o-popup-form__message').find('.o-popup-form__message__content').html(result.content);
            if ( typeof result.button_title != 'undefined' ) {
                $('.o-popup-form__message').find('.c-btn.close-message').html(result.button_title);
            }
            if ( typeof result.button_link != 'undefined' ) {
                $('.o-popup-form__message').find('.c-btn.close-message').attr( 'data-redirection', result.button_link );
            }
            $('.o-popup-form__message').addClass(result.error);
        },
        'error': function () {
            $('body').removeClass('loading');
        }
    });
});

$('.close-message').on('click', function (e) {
    if ( typeof $( e.target ).attr( 'data-redirection' ) == 'undefined' ) {
        backdropFilter.removeClass('has-message show');
        $('body').removeClass('modal-open');
        $('#radioBtn3').trigger('click')
        $('.o-popup-form__radio-input').prop('checked', false)
        $('.required-hidden').val('')
        $('.o-popup-form__radio-input').removeClass('active')
        $('.o-popup-form__select').text($('.o-popup-form__select').attr('data-placeholder'));
        $('.o-popup-form__message').find('.o-popup-form__message__title').empty();
        $('.o-popup-form__message').find('.o-popup-form__message__content').empty();
        $('.o-popup-form__message').removeClass('error-message');
        $('html, body').animate({scrollTop: 0}, 300)
    }
    else {
        window.location.href = $( e.target ).attr( 'data-redirection' );
        $( '.close-message' ).removeAttr( 'data-redirection' );
    }
});

$(document).on('click', '.yt-popup__trigger', function (e) {
    const _target = ($(e.target).hasClass('yt-popup__trigger')) ? $(e.target) : $(e.target).parents('.yt-popup__trigger');
    const attributes = _target[0].dataset;
    let data = [];
    for (const key in attributes) {
        data[key] = attributes[key];
    }
    const iframe =
        '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + data.yt_id + '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

    e.preventDefault();
    $('.yt-popup__box .yt-popup__title').html(data.space_title);
    $('.yt-popup__box .yt-popup__date').html(data.space_start_date + ',');
    $('.yt-popup__box .yt-popup__space_type_term').html(data.space_type_term_name);
    $('.yt-popup__box .yt-popup__content').html(iframe);
    $('.yt-popup__box').addClass('active');

});

$('.yt-popup__box .yt-poput__closer').on('click', function (e) {
    openup_hide_youtube_popup();
});

function openup_hide_youtube_popup() {
    $('.yt-popup__box .yt-popup__title').empty();
    $('.yt-popup__box .yt-popup__date').empty();
    $('.yt-popup__box .yt-popup__space_type_term').empty();
    $('.yt-popup__box .yt-popup__content').empty();
    $('.yt-popup__box').removeClass('active');
}

$(document).on('click', '.yt-popup__box-bg', function (e) {
    openup_hide_youtube_popup();
});
