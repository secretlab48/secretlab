import {Variables} from "./modules";

if ($(Variables.mediaSwitcher).length !== 0) {
    let mediaSwitcherContainerMedia = $('.JS-content-media');
    let mediaSwitcherContainerBlog = $('.JS-content-blog');

    $(Variables.mediaSwitcher).find('.JS-filter--media').on('click', function () {
        if (!$(this).hasClass('active')) {
            $(this).siblings().removeClass('active');
            $(this).toggleClass('active');
            $(mediaSwitcherContainerBlog).removeClass('active');
            $(mediaSwitcherContainerMedia).addClass('active');
        }
    });

    $(Variables.mediaSwitcher).find('.JS-filter--blog').on('click', function () {
        if (!$(this).hasClass('active')) {
            $(this).siblings().removeClass('active');
            $(this).toggleClass('active');
            $(mediaSwitcherContainerMedia).removeClass('active');
            $(mediaSwitcherContainerBlog).addClass('active');
        }
    });
}

