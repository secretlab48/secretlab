import $ from 'jquery';
import WOW from 'wow.js';

global.jQuery = $;
global.$ = $;

import { gsap, ScrollTrigger, Draggable, MotionPathPlugin, CSSRulePlugin, EaselPlugin, PixiPlugin,TextPlugin, ScrollToPlugin } from "./gsap/all";
gsap.registerPlugin( ScrollTrigger, Draggable, MotionPathPlugin, CSSRulePlugin, EaselPlugin, PixiPlugin,TextPlugin, ScrollToPlugin );


import fullpage from 'fullpage.js';
import Swiper from 'swiper';
import Isotope from 'isotope-layout';
import MagnetMouse from 'magnet-mouse';
import './text-animations/assets/jquery.fittext.js';
import './text-animations/assets/jquery.lettering.js';
import './text-animations/jquery.textillate.js';
import './jquery.magnific-popup.min.js';
import './modernizr-custom.js';


var fullPageInstance = new fullpage( '.fp-article', {
    navigation: true,
    afterSlideLoad: function( section, origin, destination, direction ) {
        console.log( section, origin, destination, direction );
    },
    responsiveWidth : 640
});

if ( $('.single-post').length > 0 ) {

    let thumb = gsap.utils.toArray('.single-post .single-post__thumb');
    gsap.from( thumb, {
        scrollTrigger: {
            //start: 'top top',
            end: 'bottom top',
            trigger: thumb,
            toggleClass: 'enabled',
        }
    });

    ScrollTrigger.matchMedia({
        "(min-width: 1140px)": function() {
            ScrollTrigger.create({
                trigger: '.single-post .sidebar-box',
                start: 'top top+=60',
                endTrigger: '.single-post .post.format-standard',
                end: 'bottom top+=60',
                pin: '.single-post .sidebar-box',
                pinSpacing: false,
            } )
        }
    });

    let ps = gsap.utils.toArray('.single-post article > *');
    ps.forEach((p) => {
        gsap.from(p, {
            scrollTrigger: {
                start: 'top bottom',
                end: 'bottom top',
                trigger: p,
                toggleClass: 'in-view'
            }
        });
    });

}


$(document).ready( function() {

    var wow = new WOW();
    wow.init( { live : true } );

    /*let mm = new MagnetMouse({
        magnet: {
            element: '.menu-manage'
        },
        follow: {
            element: '.cursor-follow'
        }
    });

    mm.init();*/


    if ( $('.portfolios-items-box').length > 0 ) {
        var grid = document.querySelector('.portfolios-items-box');
        var iso = new Isotope( grid, {
            itemSelector: '.portfolio-item-box',
            percentPosition: true,
            masonry: {
                columnWidth: '.portfolio-grid-sizer'
            }
        });
        var filterBy;

        function filterByCats(el) {
            var cats = $(el).find('a').attr('data-item-cats');
            cats = cats.split(',');

            if (cats.includes(filterBy) || filterBy == 0) {
                return true;
            } else {
                return false;
            }
        }

        $('.portfolio-cat-item').on('click', function (e) {
            e.preventDefault();
            $('.portfolio-cat-item').removeClass('active');
            $(e.target).addClass('active');
            filterBy = $(e.target).attr('data-cat-id');
            iso.arrange({filter: filterByCats});
        });

    }



    if ( $('.posts-archive-items-box').length > 0 ) {
        var grid = document.querySelector('.posts-archive-items-box');
        var iso = new Isotope( grid, {
            itemSelector: '.post-archive-item-box',
            percentPosition: true,
            masonry: {
                columnWidth: '.post-archive-item-box__grid-sizer',
                gutter: 20
            }
        });
    }



    function locateSides() {
        $('.logo-box').css( { 'left' : ( $('.site-wrapper').offset().left ) + 'px' } );
        if ( $('body').hasClass('home') && ( $( window ).width() > 640 ) ) {
            $('.footer').css({'left': ($(window).width() - $('.site-wrapper').offset().left - 62) + 'px'});
        }
    }

    $(window).on( 'resize', function() {
        locateSides();
    } );

    locateSides();



    $('.menu-manage').on( 'click', function( e ) {
        if ( !$('body').hasClass('main-menu-opened') ) {
            $('body').addClass('main-menu-opening');
            setTimeout(
                function() {
                    $('body').addClass('main-menu-opened');
                    $('.main-menu li').each( function( i, el ) {
                        setTimeout( function() {
                            //$(el).textillate({ in: { effect: 'fadeInLeft' } } ).textillate( 'in' );
                            $(el).addClass( 'visible-item' );
                        }, ( i * 200 ) );
                    } );
                }, 300 );
        }
        else {
            $('.main-menu li').each( function( i, el ) {
                setTimeout( function() {
                    $(el).removeClass( 'visible-item' );
                }, ( i * 100 ) );
            } );
            setTimeout( function() {
                $('body').removeClass('main-menu-opening');
                setTimeout( function() { $('body').removeClass('main-menu-opened'); }, 300 );
            }, ( $('.main-menu li').length * 100 ) );

        }
    } );


    if ( $('.mp-1').length > 0 ) {

        $('.mp-1 .text-show p').each(
            function( i, el ) {
                $(el).attr( 'data-n', ( i + 1 ) );
                if ( i == 0 ) {
                    $(el).addClass( 'active-line' );
                }
                $(el).textillate({
                    in: {
                        effect: 'fadeInLeftBig',
                    },
                    out: {
                        effect: 'fadeOut',
                        sync: true,
                        delayScale: 0
                    },
                    loop: false,
                });
            }
        );

        var MPTextInterval = setInterval(
            function () {
                var next, current;
                $('.mp-1 .text-show p').each( function( i, el ) {
                    if ( $(el).hasClass('active-line') ) {
                        $(el).removeClass('active-line');
                        current = $(el).attr( 'data-n' );
                    }
                } );
                next = ( current == $('.mp-1 .text-show p').length ) ? 1 : ( parseInt( current ) + 1 );
                $('.mp-1 .text-show p[data-n="' + next + '"]').addClass('active-line').textillate('in');
            },
            5000
        );

        $('.video').magnificPopup({
            type: 'iframe',
        });

    }



    function custom_validate( form, rules ) {

        var methods = {

            'checkPhone' : function (el) {

                var val = $(el).val().replace(/-|\(|\)|\+|\s/g, '');
                if (val.length > 10)
                    return true;
                else
                    return false;

            }

        }

        var args, errors = [];

        if ( rules )
            args = rules;


        $(form).find('input, select, textarea').each(function (i, el) {

            Object.keys(args).map(function (key, index) {
                var mode = 'any-case';
                if (key == $(el).attr('name')) {
                    var check = args[key], result;
                    $.each(check, function (i, method) {
                        if (method['mode']) {
                            mode = method['mode'];
                        }
                        if ( mode == 'any-case' || ( mode == 'if-filled'  && $(el).val().length > 0) ) {
                            if (method['function']) {
                                console.log(method['function']);
                                if ( !method['function'](el) ) {
                                    errors[key] = method['error'];
                                    return false
                                }
                            }
                            else if (method['regexp']) {
                                if ( !$(el).val().match( method['regexp'] ) ) {
                                    errors[key] = method['error'];
                                    return false;
                                }
                            }
                        }
                    });
                }
            });

        });
        //console.log(Object.keys(errors).length);
        if ( Object.keys(errors).length == 0 ) return true;
        else return errors;

    }



    $( 'form.cf' ).on( 'submit', function( e )  {

        e.preventDefault();

        var rules = {
            'name': [
                {'regexp': /.{1,50}/, 'error': 'Field must be not empty'},
                {'regexp': /^\w{1}/i, 'error': 'Field must contain at least one word'}
            ],
            'email': [
                {'regexp': /.{1,50}/, 'error': 'Field must be not empty'},
                { 'regexp': /^.\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/im, 'error': 'Field must be a valid E-mail.' }
            ],
            'message': [
                {'regexp': /.{1,50}/, 'error': 'Field must be not empty'},
            ],
        }

        var errors = custom_validate( $(e.target), rules );

        if ( Object.keys(errors).length > 0 ) {
            for ( let field in errors ) {
                let el = $('input[name="' + field + '"], textarea[name="' + field + '"]');
                if ( $(el).length > 0 ) {
                    $(el).parents('.cf-input-holder').addClass('has-error').find('.cf-error-box').html(errors[field]);
                }
            }
        }
        else {
            $('body').addClass('loading');
            $(e.target).removeClass('got-result');
            $.ajax({
                'method': 'POST',
                'url': ajaxdata.url,
                'data': { 'action': 'udft_cf_request', 'data' : $(e.target).serializeArray() },
                'success': function ( answer ) {
                    var result = JSON.parse(answer);
                    $('body').removeClass('loading');
                    $(e.target).addClass('got-result').find('.form-result').html(result.content);
                },
                'error': function () {
                    $('body').removeClass('loading');
                }
            });
        }
    } );


    $('form input, form textarea').on( 'focus', function( e ) {
        $(e.target).parents('.cf-input-holder').addClass('focuced').removeClass('has-error').find('.cf-error-box').empty();
        $(e.target).parents('form').removeClass('got-result');
    } );

    $('form input, form textarea').on( 'blur', function( e ) {
        let value = $(e.target).val();
        $(e.target).parents('.cf-input-holder').removeClass('focuced').removeClass('has-error').find('.cf-error-box').empty();
        if ( value.length > 0 ) {
            $(e.target).parents('.cf-input-holder').addClass('filled');
        }
        else {
            $(e.target).parents('.cf-input-holder').removeClass('filled');
        }
    } );


    const portfolioSwiper = new Swiper( '.swiper-container', {
        direction: 'horizontal',
        loop: true,
    } );

    $('.portfolio-feature-box').magnificPopup({
        type: 'image',
        delegate: 'a',
        removalDelay: 500,
        callbacks: {
            beforeOpen: function() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        closeOnContentClick: true,
        midClick: true
    });


    portfolioSwiper.on('slideChange', function ( swiper ) {
        $('.swiper-pagination-item').each( function( i, el ) {
            if ( ( i + 1 ) != portfolioSwiper.activeIndex ) {
                $(el).removeClass('active');
            }
            else if ( ( i + 1 ) == portfolioSwiper.activeIndex ){
                $(el).addClass('active');
            }
        } );
        if ( portfolioSwiper.activeIndex == ( $('.swiper-pagination-item').length + 1 ) ) {
            $($('.swiper-pagination-item')[0]).addClass('active');
        }
        if ( portfolioSwiper.activeIndex == 0 ) {
            $($('.swiper-pagination-item')[$('.swiper-pagination-item').length - 1]).addClass('active');
        }
    });

    $('.swiper-pagination-item').on( 'click', function( e ) {
        let currentNumber = parseInt($(this).text());
        portfolioSwiper.slideTo( currentNumber );
        $(this).addClass('active');
    });

} );
