(function($) {

    var Parser = function() {
        var self = this;
        self.addData = $.jqToggleMenu.addData;
    };

    Parser.prototype = {
        'addDataOn' : function($item, options) {
            var self = this;
            self.addData.onLinksHeader($item, options);
        }
    };

    $.jqToggleMenu.parser = new Parser();
})(jQuery);