(function($) {

    var Generator = function() {};

    Generator.prototype = {
        'addClassToggleMenuHeader' : function($item, children) {
            $item.children(children).addClass('toggleMenu-header');
        },
        'removeClassToggleMenuHeader' : function($item, children) {
            $item.children(children).removeClass('toggleMenu-header');
        },
        'childrenItem' : function(options) {
            return $('#' + options['id'] + ' > ' + options['child']);
        }
    };

    $.jqToggleMenu.generator = new Generator();
})(jQuery);