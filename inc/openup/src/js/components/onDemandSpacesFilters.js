import {Spaces} from "./modules";

function openup_update_on_demand_space_nav_state(data) {
    $('.s-on-demand-spaces__filter__space_type_term').each(function (i, el) {
        const el_term = $(el).attr('data-space_type_term');
        if (data.space_type_term[el_term]) {
            $(el).addClass('current-item');
        } else {
            $(el).removeClass('current-item');
        }
    });

    $('.s-on-demand-spaces__filter__space_theme_term .s-on-demand-spaces__filter-trigger').removeClass('current-item');
    $('.s-on-demand-spaces__filter__space_theme_term').find("[data-space_theme_term='" + data.space_theme_term + "']").addClass('current-item');
    $('.s-on-demand-spaces__filter__space_theme_term').attr('data-space_theme_term', data.space_theme_term);

    $('.s-on-demand-spaces__filter__page').attr('data-page', data.page);

}

function onDemandSpacesNavClickHandler(e) {

    const _target = $(e.target).hasClass('s-on-demand-spaces__filter-trigger') ? $(e.target) : $(e.target).parents('.s-on-demand-spaces__filter-trigger');
    const data = {};
    const request_keys = ['space_type_term', 'space_theme_term', 'page'];
    data.space_type_term = {};

    if (_target.length > 0) {
        e.preventDefault();
        $('.s-on-demand-spaces__filter').each(function (i, el) {
            let attributes = el.dataset;
            for (const key in attributes) {
                if (request_keys.includes(key)) {
                    if (key == 'space_type_term') {
                        const value = $(el).hasClass('current-item') ? 1 : 0;
                        data.space_type_term[$(el).attr('data-space_type_term')] = value;
                    } else {
                        data[key] = attributes[key];
                    }
                }
            }
        });
        if ($(_target).hasClass('s-on-demand-spaces__filter__space_type_term')) {
            let term = $(_target).attr('data-space_type_term'),
                value = 0;
            if ($(_target).hasClass('current-item')) {
                value = 0;
            } else {
                value = 1;
            }
            data.space_type_term[term] = value;
            data.request_type = 'replace';
            data.page = 1;
        }
        if ($(_target).hasClass('s-on-demand-spaces__filter__trigger__space_theme_term')) {
            data.space_theme_term = Spaces.openupSetFilterParam(data.space_theme_term, $(_target).attr('data-space_theme_term'), _target);
            data.request_type = 'replace';
            data.page = 1;
        }
        if ($(_target).hasClass('s-on-demand-spaces-clear')) {
            data.space_theme_term = 0;
            data.space_type_term = 0;
            data.page = 1;
        }
        if ($(_target).hasClass('s-on-demand-spaces__filter__page')) {
            data.request_type = 'add';
            data.page = parseInt($(_target).attr('data-page')) + 1;
        }
        if (typeof data.space_theme_term == 'string') {
            data.space_theme_term = data.space_theme_term.split(',');
        }
        data.view = 'list';
        data.space_availability_type = 'on_demand';

        console.log(data);
        data.action = 'on_demand_spaces_request';
        $.ajax({
            'method': 'POST',
            'url': appLocations.admin_ajax,
            'data': data,
            'success': function (answer) {
                var result = JSON.parse(answer);
                $('body').removeClass('loading');
                //$('.s-on-demand-spaces').replaceWith(result.live_spaces_list);
                //$( document ).trigger( 'on-demand-space-ajax-request-finished', data );
                $('.spaces-service-box').html(result.live_spaces_list);
                const ajaxContentHeight = $('.spaces-service-box').height();
                $('.spaces-service-box .s-live-spaces__ajax-holder').detach().appendTo('.spaces-service-box');
                $('.spaces-service-box .s-on-demand-spaces').remove();
                $('.s-on-demand-spaces').addClass('replacing-content').animate({'height': ajaxContentHeight + 'px'}, 200, function () {
                    $('.s-on-demand-spaces').empty().append($('.spaces-service-box').html()).removeClass('replacing-content').css({'height': 'auto'});
                    $('.spaces-service-box').empty();
                });
                console.log('ajax finished');
                $('body').addClass('has-modal');
            },
            'error': function () {
                $('body').removeClass('loading');
            }
        });
    }

}

$(document).on('click', '.s-on-demand-spaces__load-more-button', function (e) {
    if ($(e.target).hasClass('disabled')) return false;
});

if ($('.s-on-demand-spaces').length > 0) {
    $(document).on('click', '.s-on-demand-spaces__filter', function (e) {
        onDemandSpacesNavClickHandler(e);
    });
}

