(function($) {

    var EngineAnimation = function() {};

    EngineAnimation.prototype = {
        'slideDown' : function($item, $linkClicked, options) {
            var self = this;
            if($linkClicked.data('header')) {
                if(options['toggle']) {
                    self.closeCollapses($item, $linkClicked, options);
                }
            }
            self.openCollapse($item, $linkClicked, options);
        },
        'slideUp' : function($linkClicked, options) {
            var self = this;
            self.closeCollapse($linkClicked, options);
        },
        'openCollapse' : function($item, $linkClicked, options) {
            var self = this;
            $item.find('a').removeClass('active');
            $linkClicked.parents('.toggleMenu-header').children('a').first().addClass('active');
            $linkClicked.data({ 'collapse' : 'open' });
            $linkClicked.addClass('active');
            self.changeDirectionIcon($linkClicked, 'v');
            var $collapse = $linkClicked.siblings(options['parent']);
            $collapse.slideDown();
        },
        'closeCollapses' : function($item, options) {
            var self = this;
            var $chidrenItem = $item.children(options['child']);
            $.each($chidrenItem, function() {
                var $links = $(this).find('a');
                $.each($links, function() {
                    var $link = $(this);
                    if($link.data('link')) {
                        var $collapse = $link.siblings(options['parent']);
                        if($link.data('collapse') == 'open') {
                            $link.data({ 'collapse' : 'close' });
                            self.changeDirectionIcon($link, '>');
                            $collapse.slideUp();
                        }
                    }
                });
            });
        },
        'closeCollapse' : function($linkClicked, options) {
            var self = this;
            var $links = $linkClicked.parent(options['child']).find('a');
            $.each($links, function() {
                var $link = $(this);
                var $collapse = $link.siblings(options['parent']);
                if($link.data('collapse') == 'open') {
                    $link.data({ 'collapse' : 'close' });
                    self.changeDirectionIcon($link, '>');
                    $collapse.slideUp();
                }
            });
        },
        'changeDirectionIcon' : function($target, icon) {
            var $itemIcon = $target.children('.nav-icon').first();
            $itemIcon.html(icon);
        }
    };

    $.jqToggleMenu.engineAnimation = new EngineAnimation();
})(jQuery);