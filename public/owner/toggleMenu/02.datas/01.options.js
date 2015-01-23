(function($) {

    var Options = function() {};

    Options.prototype = {
        'defaultOptions' : function() {
            return {
                'id' : 'toggle-menu',
                'toggle' : true,
                'collapse' : 'close', // close or open
                'parent' : 'ul',
                'child' : 'li'
            };
        },
        'extendObject' : function(obj1, obj2) {
            return $.extend({}, obj1, obj2);
        },
        'makeOptions' : function(options) {
            var self = this;
            return self.extendObject(self.defaultOptions(), options);
        }
    };

    $.jqToggleMenu.options = new Options();
})(jQuery);