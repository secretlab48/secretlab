let selectInput = $('.c-search-filter__input');
let toPostBtn = $('.JS-to-post-btn');

$('.JS-faq-search-input').keyup(function (eventObject) {
    let postKey = $(this).val();
    let postType = $(this).data('post-type');
    let postTerm = $(this).data('terms-id');

    $.ajax({
        url: appLocations.admin_ajax,
        type: 'POST',
        data: {
            'action': 'faq_ajax_search',
            'post_key': postKey,
            'post_type': postType,
            'post_term': postTerm,
        },
        success: function (result) {
            $('.JS-faq-search').addClass('active');
            $('.JS-faq-list-container').fadeIn(250).html(result);
            $('.JS-faq-list-link').click(function (e) {
                $('.JS-faq-search').removeClass('active');
                $('.JS-faq-list-container').find('ul').remove();
                $faqPostTitle = $(this).text();
                $faqPostId = $(this).data('faq-post-id');
                selectInput.val($faqPostTitle);
                selectedPost($faqPostId);
                $(toPostBtn).removeClass('c-btn-round--transparent');
                $(toPostBtn).addClass('c-btn-primary--blue');
            });
        },
        error: function (result) {
            console.warn(result);
        }
    });
});

function selectedPost($id) {
    $.ajax({
        url: appLocations.admin_ajax,
        type: 'POST',
        data: {
            'action': 'faq_to_selected_post',
            'post_id': $id,
        },
        success: function (result) {
            $('.JS-faq-search-container').html(result);
            $('.JS-to-post-btn').toggleClass('d-none');
            $('.JS-to-back-btn').toggleClass('d-none');
            $('.JS-accordion:first').find(".JS-accordion--btn").addClass('active').next().slideDown(300);
        },
        error: function (result) {
            console.warn(result);
        }
    });

}

$(document).on('click', function (e) {
    if (!$(e.target).closest('.c-search-filter__header').length && !$(e.target).closest('.c-search-filter__list-wrap').length) {
        var selectInput = $('.JS-faq-search');

        if (!toPostBtn.hasClass('c-btn-primary--blue')) {
            $('.JS-faq-search').removeClass('active');
            selectInput.val('');
        }
    }
    e.stopPropagation();
});

$('.JS-to-back-btn').click(function () {
    location.reload();
})


