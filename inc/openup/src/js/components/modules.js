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

export class Variables {
    static blogFilter = $('.JS-blog-filter')
    static faqCategory = $('.JS-faq-category')
    static mediaSwitcher = $('.JS-filter-media')
}
