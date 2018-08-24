const $ = require('jquery')

module.exports = {
    init: function (selector)
    {
        let newScrollTop = parseInt($(window).scrollTop())
        if (newScrollTop < 480) {
            $(selector).removeClass('is-visible')
        } else {
            $(selector).addClass('is-visible')
        }
    },
    click: function (selector)
    {
        $(selector).on('click', function (e) {
            e.preventDefault();
            $("html, body").animate({scrollTop: 0}, 500);
        });
    }
};
