import Swiper from 'swiper';

//----------teams slider/ralated post

var doubleSlider = $('.JS-double-slider')

if ($(doubleSlider).length != 0) {
    $(doubleSlider).each(function () {
        var coverflowSlider = $(this).find('.c-slider--coverflow .swiper-container');
        var doubleSliderNext = $(this).find('.c-slider__nav-button--next');
        var doubleSliderPrev = $(this).find('.c-slider__nav-button--prev');

        function slideVisability() {
            var slidesItem = $(coverflowSlider).find('.swiper-slide');
            if ($(window).width() < 768) {
                $(slidesItem).each(function () {
                    setTimeout(() => {
                        $(this).addClass('invisible c-slider__slide-hidden').removeClass('c-slider__slide--right c-slider__slide--left');
                        if ($(this).hasClass('swiper-slide-active')) {
                            $(this).removeClass('invisible c-slider__slide-hidden');
                        } else if ($(this).hasClass('swiper-slide-next')) {
                            $(this).removeClass('invisible');
                            setTimeout(() => {
                                $(this).next().removeClass('invisible').addClass('c-slider__slide--right');
                            }, 10);
                        } else if ($(this).hasClass('swiper-slide-prev')) {
                            $(this).removeClass('invisible');
                            setTimeout(() => {
                                $(this).prev().removeClass('invisible').addClass('c-slider__slide--left');
                            }, 10);
                        }
                    }, 10);
                });
            } else {
                $(slidesItem).each(function () {
                    setTimeout(() => {
                        $(this).removeClass('invisible c-slider__slide-hidden')
                    }, 10);
                });
            }
        }

        var options;
        function swiperCoverflowInit(){
            var slidesPerview;
            if ($(doubleSlider).hasClass('s-related-posts')) {
                slidesPerview = 3
            } else {
                slidesPerview = 4
            }
            if ($(window).width() > 767) {
                options = {
                    loop: true,
                    slidesPerView: slidesPerview,
                    breakpoints: {
                        1200: {
                            slidesPerView: slidesPerview,
                        },
                        900: {
                            slidesPerView: 3,
                        },
                        767: {
                            slidesPerView: 2,
                            centeredSlides: false,
                            effect: 'slide'
                        }
                    },
                    navigation: {
                        nextEl: doubleSliderNext,
                        prevEl: doubleSliderPrev,
                    }
                }
            } else {
                options = {
                    grabCursor: true,
                    loop: true,
                    loopedSlides: 2,
                    slidesPerView: 'auto',
                    effect: 'coverflow',
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 200,
                        depth: 125,
                        modifier: 1,
                        slideShadows: false,
                    },
                    breakpoints: {
                        375: {
                            coverflowEffect: {
                                stretch: 328,
                            },
                        },
                        320: {
                            coverflowEffect: {
                                stretch: 355,
                            },
                        }
                    },
                    navigation: {
                        nextEl: doubleSliderNext,
                        prevEl: doubleSliderPrev,
                    },
                    on: {
                        activeIndexChange: function () {
                            slideVisability();
                        },

                        breakpoint: function () {
                            slideVisability();
                        }
                    }
                }
            }
            var swiperCoverflow = new Swiper((coverflowSlider), (options));
            slideVisability();
            $(window).on('resize', function () {
                setTimeout(() => {
                    swiperCoverflow.destroy()
                    swiperCoverflow = new Swiper((coverflowSlider), (options));
                    slideVisability();
                }, 20);
            })
        }
        swiperCoverflowInit();
        $(window).on('resize', function () {
            swiperCoverflowInit();
        })
    });
}
;

//----------logo slider

var logoSlider = $('.JS-logo-slider');
if (logoSlider.length !== 0) {
    $(logoSlider).each(function () {
        var logoSliderContainer = $(this).find('.swiper-container');
        var logoSliderWrap = $(this).find('.swiper-wrapper');
        var logoSliderSlide = $(this).find('.swiper-slide');
        var logoElem = $(this).find('.s-two-column-slider__slide');
        var logoSliderNext = $(this).find('.c-slider__nav-button--next');
        var logoSliderPrev = $(this).find('.c-slider__nav-button--prev');
        var logoSwiper = new Swiper((logoSliderContainer), {
            slidesPerView: 'auto',
            slidesPerColumn: 2,
            slidesPerColumnFill: 'row',
            navigation: {
                nextEl: logoSliderNext,
                prevEl: logoSliderPrev
            },
            breakpoints: {
                768: {
                    slidesPerColumn: 3,
                }
            },
            on: {
                sliderMove: function () {
                    if (logoSwiper.isBeginning) {
                        $(logoSlider).removeClass('c-logo-slider--grad-left');
                        $(logoSlider).addClass('c-logo-slider--grad-right');
                    } else if (logoSwiper.isEnd) {
                        $(logoSlider).removeClass('c-logo-slider--grad-right');
                        $(logoSlider).addClass('c-logo-slider--grad-left');
                    } else {
                        $(logoSlider).addClass('c-logo-slider--grad-left c-logo-slider--grad-right')
                    }
                },

                reachBeginning: function () {
                    $(logoSlider).removeClass('c-logo-slider--grad-left');
                    $(logoSlider).addClass('c-logo-slider--grad-right');
                },

                reachEnd: function () {
                    $(logoSlider).removeClass('c-logo-slider--grad-right');
                    $(logoSlider).addClass('c-logo-slider--grad-left');
                },
            }
        });

        logoSwiper.on('setTransition', function () {
            if (logoSwiper.isBeginning) {
                $(logoSlider).removeClass('c-logo-slider--grad-left');
                $(logoSlider).addClass('c-logo-slider--grad-right');
            } else if (logoSwiper.isEnd) {
                $(logoSlider).removeClass('c-logo-slider--grad-right');
                $(logoSlider).addClass('c-logo-slider--grad-left');
            } else {
                $(logoSlider).addClass('c-logo-slider--grad-left c-logo-slider--grad-right');
            }
        });

        if ($(this).hasClass('JS-logo-slider-hero')) {
            logoSwiper.params.breakpoints[320] = {slidesPerColumn: 3};
            logoSwiper.update();
        } else if ($(this).hasClass('JS-two-column-slider')) {
            logoSwiper.params.breakpoints[320] = {slidesPerColumn: 1};
            logoSwiper.params.freeMode = true;
            logoSwiper.params.noSwipingClass = 'swiper-slide';
            logoSwiper.params.noSwiping = false;
            logoSwiper.update();
            var logoElemLen = logoElem.length;

            function resizeScreen() {
                var logoSliderContainerWidth = $(logoSliderContainer).outerWidth();
                var slideFirstRow = [];
                var slideSecondRow = [];

                $(logoElem).each(function (index, element) {
                    if (index >= logoElemLen / 2) {
                        slideFirstRow.push($(element).outerWidth());
                    } else {
                        slideSecondRow.push($(element).outerWidth());
                    }
                })

                var slideFirstRowWidth = slideFirstRow.reduce(function (a, b) {
                    return a + b;
                });
                var slideSecondRowWidth = slideSecondRow.reduce(function (a, b) {
                    return a + b;
                });

                if (slideSecondRow < slideFirstRowWidth) {
                    $(logoSliderSlide).css('width', slideFirstRowWidth + 1 + 'px');
                } else {
                    $(logoSliderSlide).css('width', slideSecondRowWidth + 1 + 'px');
                }
                if (logoSliderContainerWidth > slideFirstRowWidth) {
                    $(logoSlider).removeClass('c-logo-slider--grad-right c-logo-slider--grad-left');
                    logoSwiper.params.noSwiping = true;
                    logoSwiper.update();
                } else {
                    $(logoSlider).addClass('c-logo-slider--grad-right');
                    logoSwiper.translateTo(0, 0, 0);
                    logoSwiper.params.noSwiping = false;
                    logoSwiper.update();
                }
            }

            resizeScreen();

            $(window).resize(function () {
                resizeScreen();
            });
        }

        $(window).resize(function () {
            logoSwiper.translateTo(0, 0, 0);
            logoSwiper.update();
        });

        /* remove left or right fade on page loaded if start of slider or slider is to short to have paging */
        if (logoSwiper.isBeginning) {
            $(logoSlider).removeClass('c-logo-slider--grad-left');
            $(logoSlider).addClass('c-logo-slider--grad-right');
        } else if (logoSwiper.isEnd) {
            $(logoSlider).removeClass('c-logo-slider--grad-right');
            $(logoSlider).addClass('c-logo-slider--grad-left');
        }

    });
}

//----------single img slider

var singleImg = $('.JS-single-image');

const singleImgSlide = $('.JS-single-image .s-single-img__slide');
const singleImgNavWrapper = $('.JS-single-image .c-slider__nav');

function setSliderNavWrapperWidth(slide, navWrapper) {
    let slideWidth = slide.width();
    navWrapper.css('width', slideWidth + 'px');
}

setSliderNavWrapperWidth(singleImgSlide, singleImgNavWrapper);
$(window).resize(function () {
    setSliderNavWrapperWidth(singleImgSlide, singleImgNavWrapper);
});
if ($(singleImg).length !== 0) {
    $(singleImg).each(function () {
        var sliderContainer = $(this).find('.swiper-container');
        var slideNext = $(this).find('.c-slider__nav-button--next');
        var slidePrev = $(this).find('.c-slider__nav-button--prev');
        var swiperSlide = $(this).find('.swiper-slide');
        var loop = false;
        if ($(this).hasClass('slider-infinity')) {
            loop = true;
        }
        ;
        var singleImgSwiper = new Swiper((sliderContainer), {
            loop: loop,
            slidesPerView: 'auto',
            centeredSlides: true,
            navigation: {
                nextEl: slideNext,
                prevEl: slidePrev,
            }
        });
    });
}

//----------Single text slider

var singleText = $('.JS-single-text');

if ($(singleText).length !== 0) {
    $(singleText).each(function () {
        var sliderContainer = $(this).find('.swiper-container');
        var sliderSlide = $(this).find('.swiper-slide');
        var slideNext = $(this).find('.c-slider__nav-button--next');
        var slidePrev = $(this).find('.c-slider__nav-button--prev');

        var singleTextSwiper = new Swiper((sliderContainer), {
            loop: true,
            slidesPerView: 1,
            centeredSlides: true,
            navigation: {
                nextEl: slideNext,
                prevEl: slidePrev,
            }
        });

        if ($('.swiper-slide-active').hasClass('JS-testimonials-slide-label-text')) {
            $('.JS-wave-testimonial--bottom').addClass('down');
        } else {
            $('.JS-wave-testimonial--top').addClass('down');
        }

        singleTextSwiper.on('slideNextTransitionStart', function () {
            if ($('.swiper-slide-active').hasClass('JS-testimonials-slide-label-text')) {
                $('.JS-wave-testimonial--bottom').addClass('down');
                $('.JS-wave-testimonial--top').removeClass('down');
            } else {
                $('.JS-wave-testimonial--bottom').removeClass('down');
                $('.JS-wave-testimonial--top').addClass('down');
            }
        })
        singleTextSwiper.on('slidePrevTransitionStart', function () {
            if ($('.swiper-slide-active').hasClass('JS-testimonials-slide-label-text')) {
                $('.JS-wave-testimonial--bottom').addClass('down');
                $('.JS-wave-testimonial--top').removeClass('down');
            } else {
                $('.JS-wave-testimonial--bottom').removeClass('down');
                $('.JS-wave-testimonial--top').addClass('down');
            }
        })
    });
}
//-------------post slider
var postSlider = $('.JS-post-slider');

if ($(postSlider).length !== 0) {
    $(postSlider).each(function () {
        var sliderContainer = $(this).find('.swiper-container');
        var slideNext = $(this).find('.c-slider__nav-button--next');
        var slidePrev = $(this).find('.c-slider__nav-button--prev');

        var postSliderSwiper = new Swiper((sliderContainer), {
            loop: true,
            slidesPerView: 'auto',
            centeredSlides: true,
            navigation: {
                nextEl: slideNext,
                prevEl: slidePrev,
            }
        });
    });
}

//---------Thema filters

var filterSlider = $('.JS-filter-slider');
var themaFilterSlider = $('.JS-thema-filters');

if ($(filterSlider).length !== 0) {
    if ($(filterSlider).hasClass('JS-post-filter-slider')) {
        $('#page').css('overflow-x', 'hidden');
    }
    $(filterSlider).each(function () {
        var sliderContainer = $(this).find('.swiper-container');
        var sliderSlide = $(this).find('.swiper-slide');
        var sliderContentArr = [];
        $(sliderSlide).each(function () {
            var sliderSlideWidth = $(this).outerWidth();
            sliderContentArr.push(sliderSlideWidth);
        });

        var sliderContentWidth = sliderContentArr.reduce(function (a, b) {
            return a + b;
        });

        var filterSliderSwiper = new Swiper((sliderContainer), {
            slidesPerView: 'auto',
            freeMode: true,
            noSwipingClass: 'swiper-slide',
            noSwiping: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                sliderMove: function () {
                    if (filterSliderSwiper.isBeginning) {
                        $(filterSlider).removeClass('c-logo-slider--grad-left');
                        $(filterSlider).addClass('c-logo-slider--grad-right');
                    } else if (filterSliderSwiper.isEnd) {
                        $(filterSlider).removeClass('c-logo-slider--grad-right');
                        $(filterSlider).addClass('c-logo-slider--grad-left');
                    } else {
                        $(filterSlider).addClass('c-logo-slider--grad-left c-logo-slider--grad-right')
                    }
                },

                reachBeginning: function () {
                    $(filterSlider).removeClass('c-logo-slider--grad-left');
                    $(filterSlider).addClass('c-logo-slider--grad-right');
                },

                reachEnd: function () {
                    $(filterSlider).removeClass('c-logo-slider--grad-right');
                    $(filterSlider).addClass('c-logo-slider--grad-left');
                },
            }
        });

        function resizeScreen() {
            var sliderContainerWidth = $(sliderContainer).width();
            if (sliderContentWidth <= sliderContainerWidth) {
                filterSliderSwiper.params.noSwiping = true;
                filterSliderSwiper.update();
                $(filterSlider).removeClass('c-logo-slider--grad-right');
                $(filterSlider).removeClass('c-logo-slider--grad-left');

                $('.JS-post-filter-slider .swiper-wrapper, .JS-thema-filters .swiper-wrapper').css('justify-content', 'center');
                $('.swiper-button-prev').css('display', 'none');
                $('.swiper-button-next').css('display', 'none');
            } else {
                filterSliderSwiper.params.noSwiping = false;
                filterSliderSwiper.update();
                $(filterSlider).addClass('c-logo-slider--grad-right');
                $('.JS-post-filter-slider .swiper-wrapper, .JS-thema-filters .swiper-wrapper').css('justify-content', '');
                $('.swiper-button-prev').css('display', 'block');
                $('.swiper-button-next').css('display', 'block');
            }
        }

        if ($(this).hasClass('JS-faq-category')) {
            var slideActive = localStorage.getItem('slide');
            var slideSwipe = localStorage.getItem('slideSwipe');
            filterSliderSwiper.on('click', function () {
                var clickedCategory = filterSliderSwiper.clickedIndex;
                localStorage.setItem('slide', clickedCategory);
                localStorage.setItem('slideSwipe', true);
            })
            if (slideSwipe) {
                console.log(+slideActive);
                console.log(+filterSliderSwiper.slides.length);
                if (+slideActive + 1 == +filterSliderSwiper.slides.length) {
                    console.log('true');
                    filterSliderSwiper.slideTo(slideActive, 0);
                    filterSliderSwiper.on('slideChangeTransitionEnd', function () {
                        $(filterSlider).removeClass('c-logo-slider--grad-right');
                    });
                } else {
                    filterSliderSwiper.slideTo(slideActive, 0);
                }
                localStorage.setItem('slideSwipe', '');
            }
        }

        resizeScreen();

        $(window).resize(function () {
            resizeScreen();
        });
    });
}


//----------horizontal-card-extended slider

var CESS = $('.card_extended__images-slider');
var CESSArray = [];

if ($(CESS).length !== 0) {
    CESS.each(function (i, el) {
        CESSArray[i] = new Swiper((el), {
            observer: true,
            observeParents: true,
            loop: true,
            slidesPerView: 1,
            watchSlidesVisibility: true,
            navigation: {
                prevEl: $(el).parents('.horizontal-card-extended__img-box-container').find('.c-slider__nav-button--prev')[0],
                nextEl: $(el).parents('.horizontal-card-extended__img-box-container').find('.c-slider__nav-button--next')[0],
            },
            pagination: {
                el: $(el).parents('.horizontal-card-extended__img-box-container').find('.swiper-pagination'),
                clickable: true,
                type: 'bullets'
            },
        });
    });
}


//----------our journey slider
var ourJourney = $('.c-our-journey__swiper');
var ourJourneyArray = [];

if ($(ourJourney).length !== 0) {
    ourJourney.each(function (i, el) {
        ourJourneyArray[i] = new Swiper((el), {
            slidesPerView: 5,
            spaceBetween: 35,
            navigation: {
                prevEl: $(el).parents('.c-our-journey__sliderbox').find('.c-slider__nav-button--prev')[0],
                nextEl: $(el).parents('.c-our-journey__sliderbox').find('.c-slider__nav-button--next')[0],
            },
            pagination: {
                el: $(el).parents('.c-our-journey__sliderbox').find('.swiper-pagination'),
                clickable: true,
                type: 'bullets'
            },
            breakpoints: {
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 35,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                575: {
                    slidesPerView: 3,

                },
                320: {
                    spaceBetween: 0,
                    slidesPerView: 4,
                    direction: "vertical",
                }
            },
        });
    });
}

//----------our journey current slider
var journeyCurrent = $('.s-journey__slider');
var journeyCurrentArray = [];

if ($(journeyCurrent).length !== 0) {
    journeyCurrent.each(function (i, el) {
        journeyCurrentArray[i] = new Swiper((el), {
            slidesPerView: 5,
            spaceBetween: 30,
            loop: false,
            navigation: {
                prevEl: $(el).parents('.s-journey__slider-container').find('.c-slider__nav-button--prev')[0],
                nextEl: $(el).parents('.s-journey__slider-container').find('.c-slider__nav-button--next')[0],
            },
            breakpoints: {
                1200: {
                    slidesPerView: 5,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 25,
                },
                575: {
                    slidesPerView: 3,

                },
                320: {
                    slidesPerView: 2.3,
                }
            },
        });
    });
}


//----------main hero slider
var heroSlider = $('.c-main-hero__slider:not(.single-image-mode)');
if ( heroSlider.length > 0 ) {
    var heroSliderArray = [];
    if (heroSlider.find('.swiper-slide').length == 1) {
        $(this).find('.swiper-wrapper').addClass("disabled");
        $(this).find('.swiper-pagination').addClass("disabled");
        $(this).find('.c-slider__nav-button').addClass("disabled");
    }
    if ($(heroSlider).length !== 0) {
        heroSlider.each(function (i, el) {
            heroSliderArray[i] = new Swiper((el), {
                slidesPerView: 1,
                loop: true,
                navigation: {
                    prevEl: $(el).find('.c-slider__nav-button--prev')[0],
                    nextEl: $(el).find('.c-slider__nav-button--next')[0],
                },
                pagination: {
                    el: $(el).find('.swiper-pagination'),
                    clickable: true,
                    type: 'bullets'
                }
            });
        });
    }
}


var teamListSwiper = $( '.s-team-list__swiper-container.swiper' );
if ( teamListSwiper.length > 0 ) {
    new Swiper( teamListSwiper, {
        loop: true,
        observer: true,
        observeParents: true,
        watchSlidesVisibility: true,
        slidesPerView: 4,
        spaceBetween: 32,
        navigation: {
            prevEl: $(teamListSwiper).find('.c-slider__nav-button--prev')[0],
            nextEl: $(teamListSwiper).find('.c-slider__nav-button--next')[0],
        },
        breakpoints: {
            992: {
                slidesPerView: 4,
                spaceBetween: 25,
            },
            480: {
                slidesPerView: 3,
            },
            320: {
                slidesPerView: 2,
            }
        },
    } );
}


//----------testimonial slider

var testimonialSlider = $('.JS-testimonial');
if ($(testimonialSlider).length !== 0) {
    $(testimonialSlider).each(function () {
        var testimonialContainer = $(this).find('.swiper-container');
        var singleTextSwiper = new Swiper((testimonialContainer), {
            loop: true,
            slidesPerView: 1,
            centeredSlides: true,
            spaceBetween: 10,
            navigation: {
                nextEl: $(this).find('.c-slider__nav-button--next'),
                prevEl: $(this).find('.c-slider__nav-button--prev'),
            },
            breakpoints: {
                575: {
                    spaceBetween: 30,
                },
            }
        });
    })
}

