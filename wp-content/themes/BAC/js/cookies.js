// Set Cookie

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

// Get Cookie

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

jQuery(document).ready(function(){
    var isAccepted = getCookie('cookies-accepted');
    // console.log(isAccepted);
    if(!isAccepted && jQuery('.cookies_banner').length) {
        setTimeout(function(){
            jQuery('body').css({
                'overflow': 'hidden'
            });
            jQuery('.cookies_banner').show().animate({
                opacity: 1
            }, 1000);
        }, 2000);
    }
    jQuery(document).on('click', '.cookies_banner-accept', function () {
        setCookie('cookies-accepted', 1, {
            expires: 2610000
        });
        jQuery('.cookies_banner').hide();
        jQuery('body').css({
            'overflow': 'auto'
        });
    })
});