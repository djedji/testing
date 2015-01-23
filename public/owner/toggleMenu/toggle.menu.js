(function($, win) {

    var ToggleMenu = function($item, options) {
        var self = this;
        // class parser
        self.parser = $.jqToggleMenu.parser;
        self.engineAnimation = $.jqToggleMenu.engineAnimation;
        var params = $.jqToggleMenu.options.makeOptions(options);
        self.parser.addDataOn($item, params);
        self.addEventClick($item, params);
    };

    ToggleMenu.prototype = {
        'addEventClick' : function($item, options) {
            var self = this;
            $item.find('a').click(function(e) {
                e.preventDefault();
                var $linkClicked = $(this);
                if($linkClicked.data('link')) {
                    if($linkClicked.data('collapse') == 'close') {
                        self.engineAnimation.slideDown($item, $linkClicked, options);
                    } else {
                        self.engineAnimation.slideUp($linkClicked, options);
                    }
                }
            });
        }
    };

    $.fn.toggleMenu = function(options) {
        return new ToggleMenu(this, options);
    };
})(jQuery, window);