import {Variables} from "./modules";
const speed = 1000;

if (document.querySelectorAll('#themas .JS-filter-item a') != null) {

    let url = window.location.href;
    let linksFilter = document.querySelectorAll('#themas .JS-filter-item a');
    let themasHrefArr = [];
    const reg = /themas=/gi;
    const countPostTag = (url.search("post/tag/") + 1);

    let newUrl = url.split(reg).pop();

    linksFilter.forEach(item => {
        themasHrefArr.push(item.getAttribute('href'));
    });

    let newThemasHrefArr = themasHrefArr.map(item => {
        return item.split(reg).pop();
    });

    let checkMatchedUrl = newThemasHrefArr.some(item => item == newUrl);

    if ((checkMatchedUrl && newUrl != url) || countPostTag != 0) {
        $('html, body').animate({scrollTop: $('.s-blog-posts').offset().top}, speed);
    }
}

if ($(Variables.blogFilter).length !== 0) {
    let blogFilterItem = $('.JS-filter-item');
    let scrollActive = localStorage.getItem('scroll');
    let scrollingTo = localStorage.getItem('top');

    if (scrollActive) {
        $('html, body').animate({scrollTop: $('.s-blog-posts').offset().top}, speed);
        localStorage.setItem('scroll', '');
    }

    $(blogFilterItem).each(function () {
        $(this).click(function () {
            if (!$(this).hasClass('JS-filter-item--job')) {
                let scrollTo = $(Variables.blogFilter).offset().top;
                localStorage.setItem('scroll', true);
                localStorage.setItem('top', scrollTo);
            }
        });
    });

    $(Variables.blogFilter).each(function () {
        let blogFilterContainer = $(this).find('.c-blog-filter__list-wrap');
        let blogFilterMain = $(this).find('.c-blog-filter__main');
        let blogFilterContainerWidth = $(blogFilterContainer).outerWidth();
        let blogFilterWidth = $(this).outerWidth();
        let blogTeamFilterItem = $('.JS-team-filter-item');

        if (blogFilterWidth <= blogFilterContainerWidth) {
            $(this).css('min-width', blogFilterContainerWidth);
            $(blogFilterContainer).css('width', '100%');
        } else {
            $(blogFilterContainer).css('width', '100%');
        }
        if (!$(this).hasClass('JS-blog-filter--teams') && !$(this).hasClass('JS-blog-filter--spaces')) {

            $(blogFilterMain).click(function () {
                $(this).parent().toggleClass('active');
                $(this).parents('.swiper-slide').siblings().find('.JS-blog-filter').removeClass('active');
                $(this).parents('.swiper-slide').siblings().find('.c-blog-filter__list-wrap').slideUp(300);

                if ($(this).parents('.swiper-slide').find('.JS-blog-filter').hasClass('active')) {
                    $(blogFilterContainer).slideDown(300);
                } else {
                    $(blogFilterContainer).slideUp(300);
                }
            });
        } else {
            if (!$(this).hasClass('JS-blog-filter--spaces')) {
                blogFilterMain.click(function () {
                    Variables.blogFilter.toggleClass('active');
                    blogFilterContainer.slideToggle(300);
                });

                blogTeamFilterItem.click(function () {
                    Variables.blogFilter.toggleClass('active');
                    blogFilterContainer.slideToggle(300);
                });
            }

        }

        $('.JS-filter-item--job').click(function () {

            $(Variables.blogFilter).removeClass('active');
            $(blogFilterContainer).slideUp(300);
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest(Variables.blogFilter).length) {
                $(Variables.blogFilter).removeClass('active');
                $(blogFilterContainer).slideUp(300);
            }
            e.stopPropagation();
        });
    });
}

$('.JS-blog-filter--spaces').on('click', function (e) {
    $(e.target).parents('.JS-blog-filter--spaces').toggleClass('active');
    $(e.target).parents('.JS-blog-filter--spaces').find('.c-blog-filter__list-wrap').slideToggle(300);
});