import Swiper from 'swiper';
import {Spaces} from "./modules";

function openup_spaces_nav_swiper_init() {

    window.calendarSwiper = new Swiper('.space__calendar-slider', {
        direction: 'horizontal',
        loop: false,
        allowTouchMove: false,
        navigation: {
            prevEl: $('.space__calendar-slider__nav-button__prev .icon-angle'),
            nextEl: $('.space__calendar-slider__nav-button__next .icon-angle'),
        },
        initialSlide: $('.space__calendar-slider').find('.space__calendar-slider__item.current-date').data('n'),
    });

    $(document).on('live-space-ajax-request-finished', function (e, data) {
        if (data.calendar_slider_direction) {
            if (data.calendar_slider_direction == 'next') {
                window.calendarSwiper.slideNext();
            } else {
                window.calendarSwiper.slidePrev();
            }
        }
    });

    $('[class^="space__calendar-slider__nav-button"]').on('click', function (e) {
        const currentSlideIndex = window.calendarSwiper.realIndex;
        const _target = $(e.target).hasClass('space__calendar-slider__nav-button') ? $(e.target) : $(e.target).parents('.space__calendar-slider__nav-button');
        let requestData = {'request_type': 'replace_calendar_table', 'view': 'calendar'};

        if ($(_target).data('direction') == 'next') {
            if (window.calendarSwiper.slides[currentSlideIndex + 1]) {
                requestData['request_month'] = $(calendarSwiper.slides[currentSlideIndex + 1]).data('date');
                requestData['calendar_slider_direction'] = 'next';
                liveSpacesNavClickHandler(e, requestData);
            }
        } else {
            if (window.calendarSwiper.slides[currentSlideIndex - 1]) {
                requestData['request_month'] = $(calendarSwiper.slides[currentSlideIndex - 1]).data('date');
                requestData['calendar_slider_direction'] = 'prev';
                liveSpacesNavClickHandler(e, requestData);
                openupPreviousMonth(requestData['request_month'])
            }
        }
    });

}

function liveSpacesNavClickHandler(e, requestData = null) {

    const _target = $(e.target).hasClass('s-live-spaces__filter-trigger') ? $(e.target) : $(e.target).parents('.s-live-spaces__filter-trigger');
    const data = {};
    if (_target.length > 0 || requestData) {
        e.preventDefault();
        $('.s-live-spaces__filter').each(function (i, el) {
            let attributes = el.dataset;
            for (const key in attributes) {
                if (key == 'space_type_term' || key == 'space_theme_term') {
                    data[key] = attributes[key].toString().split(',');
                } else {
                    data[key] = attributes[key];
                }
            }
        });
        if ($(_target).hasClass('s-live-spaces__filter-trigger__space_type_term')) {
            data.space_type_term = Spaces.openupSetFilterParam(data.space_type_term, $(_target).data('space_type_term'), _target);
            data.page = 1;
        }
        if ($(_target).hasClass('o-main-hero__spaces-card')) {
            data.space_type_term = Spaces.openupSetFilterParam(data.space_type_term, $(_target).data('space_type_term'), _target).slice(-1);
            data.page = 1;
        }
        if ($(_target).hasClass('s-live-spaces-clear')) {
            data.space_type_term = 0;
            data.space_theme_term = 0;
            data.page = 1;
        }
        if ($(_target).hasClass('s-live-spaces__filter-trigger__space_theme_term')) {
            data.space_theme_term = Spaces.openupSetFilterParam(data.space_theme_term, $(_target).data('space_theme_term'), _target);
            data.page = 1;
        }
        if ($(_target).hasClass('s-live-spaces__filter-trigger__pagination')) {
            data.page = parseInt($(_target).attr('data-page')) + 1;
            data.request_type = 'add';
        }
        if (data.view == 'calendar') {
            data.request_month = $('.swiper.s-live-spaces__filter').attr('data-request_month');
        }
        if ($(_target).hasClass('s-live-spaces__view-selector')) {
            data.view = ($(_target).attr('data-view') == 'list') ? 'calendar' : 'list';
            data.page = 1;
        }

        for (const key in requestData) {
            data[key] = requestData[key];
        }
        const post_id = $('body').attr('class').match(/page-id-(\d+)/);
        data.post_id = (typeof post_id[1] != 'undefined') ? post_id[1] : 0;
        console.log(data);
        data.action = 'live_spaces_request';
        $.ajax({
            'method': 'POST',
            'url': appLocations.admin_ajax,
            'data': data,
            'success': function (answer) {
                var result = JSON.parse(answer);
                $('body').removeClass('loading');
                //$('.s-live-spaces').replaceWith(result.live_spaces_list);
                $('.spaces-service-box').html(result.live_spaces_list);
                const ajaxContentHeight = $('.spaces-service-box').height();
                $('.spaces-service-box .s-live-spaces__ajax-holder').detach().appendTo('.spaces-service-box');
                $('.spaces-service-box .s-live-spaces').remove();
                $('.s-live-spaces').addClass('replacing-content').animate({'height': ajaxContentHeight + 'px'}, 200, function () {
                    $('.s-live-spaces').empty().append($('.spaces-service-box').html()).removeClass('list-view').removeClass('calendar-view').addClass(data.view + '-view').removeClass('replacing-content').css({'height': 'auto'});
                    $('.spaces-service-box').empty();
                    openup_spaces_nav_swiper_init();
                });
                $('.s-live-spaces__item__excerpt').children().contents().unwrap();
                openupPreviousMonth(data.request_month)
                console.log('ajax finished');
                $('body').addClass('has-modal');
                return false;

            },
            'error': function () {
                $('body').removeClass('loading');
            }
        });
    }

}

$(document).on('click', '.s-live-spaces__load-more-button', function (e) {
    if ($(e.target).hasClass('disabled')) return false;
});

if ($('.s-live-spaces').length > 0) {
    $(document).on('click', '.s-live-spaces__filter', function (e) {
        liveSpacesNavClickHandler(e);
    });
}

if ($('.space__calendar-slider').length > 0) {
    openup_spaces_nav_swiper_init();
}


$(document).on('click', function (e) {
    const dropDownContainer = $(e.target).parents('.c-drop-down');
    $('.c-drop-down.active').each(function (i, el) {
        $(el).find('.c-drop-down__list-wrap').slideUp(400, function () {
            $(el).removeClass('active');
        });
    });
    if ($(dropDownContainer).hasClass('active')) {
        $(dropDownContainer).find('.c-drop-down__list-wrap').slideUp(400, function () {
            $(dropDownContainer).removeClass('active');
        });
    } else {
        $(dropDownContainer).addClass('active');
        $(dropDownContainer).find('.c-drop-down__list-wrap').slideDown();
    }

});
$('.s-live-spaces__item__excerpt').children().contents().unwrap();


function openupPreviousMonth(requestMonth) {
    let now = new Date();
    let prevMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
    let prevMonthFormat = +new Date(prevMonth).toLocaleDateString('sv').replaceAll('-', '')

    if (prevMonthFormat == requestMonth) {
        $('.space__calendar-slider__nav-button__prev').addClass('disabled')
    } else {
        $('.space__calendar-slider__nav-button__prev').removeClass('disabled')
    }
}

