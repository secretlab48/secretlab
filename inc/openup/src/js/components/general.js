import {Popup, Cookie, Variables, Sticky} from "./modules";

let currentLang = $('body').attr('class').match(/([a-z]{2})-lang/);
currentLang = currentLang[1];
console.log(Cookie.getCookie('preferred_lang'));

    const sticky = new Sticky( '.s-steps-numerated .c-intro', '.s-steps-numerated__left', 767 );

    $.getJSON( 'https://api.ipregistry.co/?key=39t4hg8n6cp7tvkg&fields=connection,location.country.code&hostname=true&output=xml&pretty=true' )
        .done( function( data ) {
            let countryCode = (typeof data.location != 'undefined') ? data.location.country.code : 'UA';
            //countryCode = 'ES';
            console.log( data.location.country.code );
            $( document ).trigger('openup_' + countryCode + '_user_came');
        } )
        .fail( function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        } );

    if ( currentLang == 'en' && appLocations.esPopupData ) {

        $(document).on('openup_ES_user_came', function ( e ) {
            const popupContent = {
                className: 'o-modal-location',
                image: appLocations.esPopupData.src,
                title: appLocations.esPopupData.title,
                //description: appLocations.esPopupData.description,
                leftButton: {
                    text: appLocations.esPopupData.positiveButtonText,
                    link: appLocations.esPopupData.positiveButtonHref
                },
                rightButton: {
                    text: appLocations.esPopupData.negativeButtonText,
                    link: appLocations.esPopupData.negativeButtonHref
                },
            };
            Popup.fillPopup(popupContent);
            setTimeout(function () {
                Popup.openPopup();
            }, 300)
            $('.o-modal-location .right-button').on('click', Popup.closePopup.bind(Popup));
            $('.o-modal-location .right-button').on('click', function (e) {
                Cookie.setCookie('preferred_lang', currentLang, {'max-age': 2 * 60});
                return false;
            });
            $('.o-modal-location .left-button').on('click', function (e) {
                Cookie.setCookie('preferred_lang', 'es', {'max-age': 2 * 60});
            });
        });
    }

    $( document ).on( 'openup_IE_user_came', function( e ) {
      $( '.o-footer__contact-link.phone-number' ).text( appLocations[ 'ir_phone' ][ 'string' ] );
      $( '.o-footer__contact-link.phone-number' ).attr( 'href', 'tel:' + appLocations[ 'ir_phone' ][ 'phone' ] )
    } );

    $( document ).on( 'openup_UK_user_came', function( e ) {
        $( '.o-footer__contact-link.phone-number' ).text( appLocations[ 'uk_phone' ][ 'string' ] );
        $( '.o-footer__contact-link.phone-number' ).attr( 'href', 'tel:' + appLocations[ 'uk_phone' ][ 'phone' ] )
    } );

    if ( $( '.o-popup-form__form [name="session_id"]' ).length > 0 && $( '.o-spaces-hero__btn-message' ).length > 0 ) {
        const data = { 'action' : 'openup_get_session_data', 'session_id' : $( '.o-popup-form__form [name="session_id"]' ).val() }
        $.ajax({
            'method': 'POST',
            'url': appLocations.admin_ajax,
            'data': data,
            'success': function ( answer ) {
                answer = JSON.parse( answer );
                if ( answer.result ) {
                    if ( answer.session_data.data.attributes.registrants_count >= 20 ) {
                        $( '.o-spaces-hero__btn-message' ).parents( '.o-spaces-hero__btn' ).addClass( 'has-error' );
                        $( '.o-spaces-hero__btn-message' ).html( answer.message );
                    }
                }
            },
            'error': function () {
                $('body').removeClass('loading');
            }
        });
    }

    //--Add bg if main-hero true
    if(document.querySelector('.o-main-hero--column') != null) {
      let mainHero = document.querySelector('.o-main-hero'); 
      let mainHeader = document.querySelector('.o-header');
      let windowSize = window.innerWidth;
      let isMainHeroViolet = mainHero.classList.contains("o-main-hero--violet");
      let isMainHeroGreen = mainHero.classList.contains("o-main-hero--green");
      let isMainHeroBlue = mainHero.classList.contains("o-main-hero--blue");
      
      const isMainHeroColored = {
        "u-bg-primary-violet" : isMainHeroViolet,
        "u-bg-primary-green" : isMainHeroGreen,
        "u-bg-primary-blue" : isMainHeroBlue
      };

      function getColorBg(object, value) {
        let color = Object.keys(object).find(key => object[key] === value);
        if (color === undefined) {
          return 'u-bg-primary-skin';
        }
        return color
      }

      function setMainMenuBg(windowSize, mainHeroResult) {

        let isColored = getColorBg(mainHeroResult, true);
        mainHeader.classList.remove('u-bg-primary-skin');

        if(windowSize > 991 ) {
          mainHeader.classList.add(isColored); 
        } else {
          mainHeader.classList.remove(isColored); 
        }  
      };

      setMainMenuBg(windowSize, isMainHeroColored);

      let setMainHeroBg = function (windowSize) { 
        setMainMenuBg(windowSize, isMainHeroColored);
      };
      
      setMainHeroBg(windowSize); 

      $(window).resize(function() {
          let windowSize = window.innerWidth;
          setMainHeroBg(windowSize);
      });  
    }

    //--Smooth scrolling
    const speed = 1000;
    function headerOffset(){
        let headerOffset = 0
        if ($(window).width() <= 768) {
            headerOffset = 85
        }
        return headerOffset
    }

    $(window).resize(function () {
        headerOffset()
    });
    $('a[href*="#"]')
      .filter((i, a) => a.getAttribute('href').startsWith('#') || a.href.startsWith(`${location.href}#`))
      .unbind('click.smoothScroll')
      .bind('click.smoothScroll', event => {
        const targetId = event.currentTarget.getAttribute('href').split('#')[1];
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          event.preventDefault();
          $('html, body').animate({ scrollTop: $(targetElement).offset().top - headerOffset() }, speed);
        }
      });
    // button scroll top
    $(window).scroll(function () {
        if ($(window).scrollTop() > $(window).height() * 3) {
            $('#buttonTop').addClass('show');
        } else {
            $('#buttonTop').removeClass('show');
        }
    });
    $('#buttonTop').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, '500');
    });

      //--Set active popup
      function disablePopUp(item) {
        item.removeClass('active');
      }

      $('.s-popup a[href*="#"]')
        .filter((i, a) => a.getAttribute('href').startsWith('#') || a.href.startsWith(`${location.href}#`))
        .unbind('click')
        .bind('click', event => {
          event.preventDefault(); 
          const targetId = event.currentTarget.getAttribute('href').split('#')[1];
          const targetElement = document.getElementById(targetId);
          let sectionPopUp = document.getElementsByClassName("s-popup"); 
          disablePopUp($('.s-popup'));

          if(sectionPopUp[targetId]){
              if (targetId !== 'step6'){
                $("#step6").find('.s-popup__link-back').attr('href', `#${targetId}`);
              }
              targetElement.classList.add('active');
              if(targetId === 'step6'){
                var blogFilterMain = $('.JS-blog-filter').find('.c-blog-filter__main');
                var blogFilterContainer = $('.JS-blog-filter').find('.c-blog-filter__list-wrap');
                var blogFilterCategory = $('.JS-blog-filter').find('.c-blog-filter__list-item a');
                var blogFilterMainText = $('.JS-blog-filter').find('.c-blog-filter__main-text');
                $(blogFilterMain).click(function(){
                  $(this).parent().toggleClass('active');
          
                  if($(this).parent().hasClass('active')){
                    $(blogFilterContainer).slideDown(300);
                  }else{
                    $(blogFilterContainer).slideUp(300);
                  }
                });
                $(blogFilterCategory).click(function(event){
                  var blogFilterCategoryText = $(this).text();
                  $(blogFilterMain).parent().removeClass('active');
                  $(blogFilterContainer).slideUp(300,function(){
                    $(blogFilterMainText).text(blogFilterCategoryText); 
                  });
                  event.preventDefault();
                });
              }
          }
        });

    $.fn.textWidth = function(text, font) {
      if (!$.fn.textWidth.fakeEl) $.fn.textWidth.fakeEl = $('<span class="temporary-span">').hide().appendTo(document.body);
      $.fn.textWidth.fakeEl.text(text || this.val() || this.text()).css('font', font || this.css('font'));
      const width = $.fn.textWidth.fakeEl.width();
      $('temporary-span').remove();
      return width;
    };

    $('.o-spaces-hero__history').on('click', function (){
      window.history.back()
    })


//--Calc position text
let headerPosition = $('.o-banner__position-text');
let widthHeader = headerPosition.width();
let heightHeader = headerPosition.height();
let halfWidthHeader = parseInt(widthHeader, 10) / 1.4;

function spaceTop(halfWidthHeader) {
    headerPosition.css( { top : halfWidthHeader + 'px', left :  ( ( heightHeader - widthHeader ) / 2 ) + 'px' } );
}

spaceTop(halfWidthHeader);  
    
//-- Change slider btn color
let sectionWavePrimaryBlue = document.querySelectorAll('.s-wave--primary-blue'); 

sectionWavePrimaryBlue.forEach(item => {
  if (item != null) {   
    let btnRound = item.querySelectorAll(".c-btn-primary--blue");

    btnRound.forEach(btn => {
      btn.classList.add('c-btn-primary--dark-blue');
      btn.classList.remove('c-btn-primary--blue'); 
    });
  }
});

//Share sticky
if (document.querySelector('.JS-share-sticky') != null) {
  let shareSticky = document.querySelector('.JS-share-sticky'); 
  let windowWidth = window.innerWidth;
  let shareStickyLink = shareSticky.querySelectorAll('.c-share-sticky__link'); 


  let toggleShow = () => {
    shareSticky.classList.toggle('show'); 
  };

  let checkShowSticky = function(windowWidth) {   
    if (windowWidth < 992) { 
      shareSticky.addEventListener('click', toggleShow); 
    } else {
      shareSticky.classList.remove('show');
      shareSticky.addEventListener('click', toggleShow); 
    }
  };

  let setSingleStickyHeight = function() { 
    if (shareStickyLink.length === 1 && windowWidth < 992){
      let shareStickyLableHeight = shareSticky.querySelector('.c-share-sticky__label').offsetWidth;
      shareSticky.style.height = `${shareStickyLableHeight + 40}px`;
    } else {
      shareSticky.style.height = 'auto';
    }
  };
    
  window.addEventListener("resize", () => {
    windowWidth = window.innerWidth; 
    checkShowSticky(windowWidth); 
    setSingleStickyHeight();
  });

  checkShowSticky();
  setSingleStickyHeight(windowWidth);
}


//Changes list item check marks to the figures type 
if (document.querySelectorAll('.c-step-list__item-checkmark') != null && 
    document.querySelector('.JS-step-list-numeric') != null) {
 
  const stepList = document.querySelector('.JS-step-list-numeric');
  const stepListItem = stepList.querySelectorAll('.c-step-list__item-checkmark'); 

  stepListItem.forEach((item, index) => { 
    index = index + 1;
  
    if(stepList != null) {
      item.textContent = `${index}`; 
    }
  });
} 

//Set logo banner direction
if (document.querySelector('.s-logo-banner__icon') != null ) {
  let logoItemCount = document.querySelectorAll(".s-logo-banner__icon").length; 
  let logoMainCol = document.querySelector(".JS-logo-direction"); 
  let windowWidth = window.innerWidth;

  let setDirection = function (){
    if (logoItemCount > 6 && windowWidth < 992) {
      logoMainCol.classList.remove('flex-md-row'); 
    } else if (logoItemCount > 6 && windowWidth > 992) {
      logoMainCol.classList.add('flex-md-row'); 
    }
  };

  window.addEventListener("resize", () => {
    windowWidth = window.innerWidth;  
    setDirection();  
  });

  setDirection();  
}


//Check is href empty 
if(document.querySelector('.JS-check-href') != null) {
    document.querySelectorAll('.JS-check-href').forEach(item => {
    let attribute = item.getAttribute('href');
    if (attribute === '#' || attribute === "") {
      item.style.cursor = "auto";

      item.addEventListener('click', (e) => { 
        e.preventDefault();
      }); 
    }
  });
}

