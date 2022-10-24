import {Variables} from "./modules";

if ($(Variables.faqCategory).length !== 0) {
    let scrollActive = localStorage.getItem('scroll');
    let scrollingTo = localStorage.getItem('top');

    if (scrollActive) {
        if ($(this).hasClass('JS-faq-category--section')) {
            console.log('true');
            $('body,html').stop().animate({scrollTop: scrollingTo - 80}, 0);
        } else {
            $('body,html').stop().animate({scrollTop: scrollingTo - 80}, 0);
        }
        localStorage.setItem('scroll', '');
    }

    $(Variables.faqCategory).each(function () {
        $(this).click(function () {
            let scrollTo = $(this).offset().top;
            localStorage.setItem('scroll', true);
            localStorage.setItem('top', scrollTo);
        })
    })
}