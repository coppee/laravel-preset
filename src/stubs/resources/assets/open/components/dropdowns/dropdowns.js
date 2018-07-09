const $ = require('jquery')

function DropDown(el) {
    this.dd = el;
    this.initEvents();
}

DropDown.prototype = {
    initEvents : function() {
        var obj = this;

        obj.dd.on('click', function(event){
            $(this).toggleClass('is-active');
            event.stopPropagation();
        });
    }
}

$(function()
{
    var dd = new DropDown( $('.js-dropdown') );
    $(document).click(function() {
        $('.js-dropdown').removeClass('is-active');
    });
});