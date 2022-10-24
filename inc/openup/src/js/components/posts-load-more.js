$(".JS--load-more").click(function () {
    newsLoadMore();
});

function newsLoadMore() {
    let maxPages = $('.s-blog-posts__container').data('pages');
    let currentPostType = $('.JS--load-more').data('current-post-type');
    let currentTaxonomy = $('.JS--load-more').data('current-taxonomy');
    let currentTerm = $('.JS--load-more').data('current-term');

    $.ajax({
        url: appLocations.admin_ajax,
        data: {
            action: "load_more_posts",
            page: appLocations.page,
            post_type: currentPostType,
            taxonomy: currentTaxonomy,
            term: currentTerm,
        },
        type: 'POST',
        beforeSend: function () {
        },

        success: function (data) {
            $('.JS--post-container').append(data).fadeIn(250);
            appLocations.page++;
            if (appLocations.page == maxPages) {
                $('.JS--load--container').remove();
            }
        },

        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

$(".b2b-JS--load-more").click(function ( e ) {
    let maxPages = $('.s-blog-posts__container').data('pages');
    let currentPostType = $( e.target ).data('current-post-type');
    let currentTaxonomy = $( e.target ).data('current-taxonomy');
    let currentTerm = $( e.target ).data('current-term');
    let page = $( e.target ).data( 'page' ) + 1;

    $.ajax({
        url: appLocations.admin_ajax,
        data: {
            action: "load_more_posts",
            page: page,
            post_type: currentPostType,
            taxonomy: currentTaxonomy,
            term: currentTerm,
        },
        type: 'POST',
        beforeSend: function () {
        },

        success: function (data) {
            $('.JS--post-container').append(data).fadeIn(250);
            $( e.target ).data( 'page', page );
            if ( ( page * 3 + 3 ) >= $( '.s-blog-posts__container' ).data( 'found-posts' ) ) {
                $( e.target ).remove();
            }
        },

        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
});

$(".c-accordion__load-more-btn").click(function () {
    faqsLoadMore();
});

$('.JS-faq-load .c-accordion__card').last().addClass('last-question')

function faqsLoadMore() {
    let pageId = $('.c-accordion').attr('data-id');
    let pageFilter = $('.JS-faq-load').attr('data-filter');
    let postId = [].map.call(document.querySelectorAll('.JS-accordion'), function (el) {
        return el.dataset.post;
    })
    $.ajax({
        url: appLocations.admin_ajax,
        data: {
            action: "faq_load_more",
            pageId: pageId,
            postId: postId,
            pageFilter: pageFilter
        },
        type: 'POST',
        success: function (data) {
            $('.c-accordion').append(data);
            $('.c-accordion__blurred-bar').prev().removeClass('last-question');
            if ('' === data) {
                $('.c-accordion__load-more-box').remove();
                $('.c-accordion__blurred-bar').remove();
                return;
            }


        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

