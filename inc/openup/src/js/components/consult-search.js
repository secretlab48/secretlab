$('.JS-consult-search').keyup(function (eventObject) {
    let searchLink = $(this).val();
    let pageID = $(this).data('page-id');
    let btn = $('.JS-serch-link');
    btn.removeAttr('href');

    $.ajax({
        url: appLocations.admin_ajax,
        type: 'POST',
        data: {
            'action': 'consult_ajax_search',
            'link_key': searchLink,
            'page_id': pageID,
        },
        success: function (result) {
            $('.JS-faq-search').addClass('active');
            $('.JS-search-list').fadeIn(250).html(result);
            $('.JS-search-consult-item').click(function (e) {
                e.preventDefault();
                $('.JS-faq-search').removeClass('active');
                let url = $(this).data('serch-consult-url');
                let titleUrl = $(this).text();
                $('.JS-consult-search').val(titleUrl);
                btn.prop("href", url);
            })
        },

        error: function (result) {
            console.warn(result);
        }
    });
});