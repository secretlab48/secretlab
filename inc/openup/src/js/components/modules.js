export class Spaces {
    static openupSetFilterParam(prop, value, _target) {
        let currentValue = prop.toString().split(',');
        if ( value.toString() == '0' ) {
            currentValue.length = 0;
            currentValue.push(value);
            return currentValue;
        }
        if (!$(_target).hasClass('current-item')) {
            if (!currentValue.includes(value)) {
                currentValue.push(value);
            }
        } else {
            currentValue = this.openupRemoveArrayItem(currentValue, value);
        }

        if (currentValue.length > 0 && currentValue.includes('0')) {
            currentValue = this.openupRemoveArrayItem(currentValue, '0');
        }

        return currentValue;
    }

    static openupRemoveArrayItem(arr, value) {
        for (var i = arr.length - 1; i >= 0; i--) {
            if (arr[i] == value) {
                arr.splice(i, 1);
            }
        }
        return arr;
    }
}


export class Popup {
    static openPopup() {
        $('.o-modal').addClass('is-open');
    }

    static closePopupFromOutside(event) {
        let select = $('.o-modal-container');
        if ($(event.target).closest(select).length) return;
        $(event.currentTarget).removeClass('is-open');
        setTimeout(() => {
            this.clearPopup();
        }, 300)
    }

    static closePopup() {
        $('.o-modal').removeClass('is-open');
        setTimeout(() => {
            this.clearPopup();
        }, 300)
    }

    static clearPopup() {
        $('.o-modal-content__title, .o-modal-content__description, .o-modal .c-btn').empty();
        $('.o-modal-content__image img').attr('src', 'https://openup.nl/wp-content/themes/openup/img/icons/placeholder.png');
        $('.o-modal a').attr('href', '#');
        $('.o-modal').removeClass().addClass('o-modal');
        $('.updateModal').removeClass('hide-field')
    }

    static fillPopup(param) {
        let modalFields = document.querySelectorAll('.updateModal')
        let field = []
        modalFields.forEach(function (el) {
            field.push(el.dataset.content)
            $(el).addClass('hide-field')
            for (const key in param) {
                if(key === el.dataset.content){
                   const action = $(el).attr('data-action')
                    if(action == 'setClass'){
                        $(el).addClass(param[key]).removeClass('hide-field')
                    }else if(action == 'setSrc'){
                        $(el).attr('src', param[key]).removeClass('hide-field')
                    }else if(action == 'setHtml'){
                        $(el).text(param[key]).removeClass('hide-field')
                    }else if(action == 'setLink'){
                        $(el).text(param[key].text).attr('href',param[key].link).removeClass('hide-field')
                    }
                }
            }
        })
    }
}

export class Cookie {

    static getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    static setCookie(name, value, options = {}) {

        options = {
            path: '/',
            // при необходимости добавьте другие значения по умолчанию
            ...options
        };

        if (options.expires instanceof Date) {
            options.expires = options.expires.toUTCString();
        }

        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

        for (let optionKey in options) {
            updatedCookie += "; " + optionKey;
            let optionValue = options[optionKey];
            if (optionValue !== true) {
                updatedCookie += "=" + optionValue;
            }
        }

        document.cookie = updatedCookie;
    }


    static deleteCookie(name) {
        this.setCookie(name, "", {
            'max-age': -1
        })
    }

}

export class Sticky {

    sticky = {};

    constructor ( targetSelector, parentSelector, maxScreenWidth ) {
        this.init( targetSelector, parentSelector, maxScreenWidth )();
        $( window ).on( 'resize', this.init.call( this, targetSelector, parentSelector, maxScreenWidth ) );
    }

    init( targetSelector, parentSelector, maxScreenWidth ) {
        const _this = this;
        return function() {
            if ( $( window ).width() > maxScreenWidth ) {

                _this.sticky = {
                    'active': true,
                    'el': $( targetSelector )
                };
                _this.sticky.parent = _this.sticky.el.parents( parentSelector );
                _this.sticky.parent.offset = _this.sticky.parent.offset();
                _this.sticky.parent.bottom = _this.sticky.parent.offset.top + _this.sticky.parent.height();
                _this.sticky.width = _this.sticky.el.width();
                _this.sticky.height = _this.sticky.el.height();
                _this.sticky.offset = _this.sticky.el.offset();
                _this.sticky.bottom = _this.sticky.offset.top + _this.sticky.height;
                _this.sticky.scrollPostition = $(window).scrollTop();
                _this.sticky.scrolldirection = null;

                $( window ).on( 'scroll', _this.scrollHandler.apply( _this ) );

            } else {
                _this.sticky = {
                    'active': false,
                    'el': $( targetSelector )
                }
            }
            $( _this.sticky.el ).attr( 'style', '');
        }
    }

    scrollHandler() {
        const _this = this;
        return function() {
            if ( _this.sticky.active ) {
                const scrollTop = $( window ).scrollTop();
                if ( scrollTop > _this.sticky.scrollPostition ) {
                    _this.sticky.scrolldirection = 'down';
                } else {
                    _this.sticky.scrolldirection = 'up';
                }
                _this.sticky.scrollPostition = scrollTop;
                if ( _this.sticky.scrolldirection == 'down' ) {
                    if ( _this.sticky.parent.offset.top < scrollTop ) {
                        _this.sticky.el.css({
                            'position': 'fixed',
                            'left': _this.sticky.offset.left + 'px',
                            'width': _this.sticky.width + 'px',
                            'height': _this.sticky.height + 'px'
                        });
                        if ( ( _this.sticky.parent.bottom - _this.sticky.height ) > scrollTop) {
                            _this.sticky.el.css({
                                'top': '0px',
                            });
                        } else {
                            _this.sticky.el.css({
                                'top': ( _this.sticky.parent.bottom - _this.sticky.height - scrollTop ) + 'px',
                            });
                        }
                    }
                } else if ( _this.sticky.scrolldirection == 'up' ) {
                    if ( _this.sticky.parent.offset.top < scrollTop ) {
                        _this.sticky.el.css({
                            'position': 'fixed',
                            'left': _this.sticky.offset.left,
                            'width': _this.sticky.width + 'px',
                            'height': _this.sticky.height + 'px'
                        });
                        if ( ( _this.sticky.parent.bottom - _this.sticky.height ) > scrollTop ) {
                            _this.sticky.el.css({
                                'top': '0px',
                            });
                        } else {
                            _this.sticky.el.css({
                                'top': ( _this.sticky.parent.bottom - _this.sticky.height - scrollTop ) + 'px',
                            });
                        }
                    } else {
                        _this.sticky.el.css( { 'position': 'static' } );
                    }
                }
            } else {
                _this.sticky.el.css( { 'position': 'static' } );
            }
        }
    }
}

export class Variables {
    static blogFilter = $('.JS-blog-filter')
    static faqCategory = $('.JS-faq-category')
    static mediaSwitcher = $('.JS-filter-media')
}
