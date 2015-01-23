(function($, win) {

    var AddData = function() {};

    AddData.prototype = {
        'onLinksHeader' : function($item, options) {
            var self = this;
            self.options = options;
            self.setItems($item, self.options);
            if(self.options['collapse']) {
                self.closeCollapse();
            }
            self.setActive($item);
        },
        'setItems' : function($item, options) {
            var self = this;
            options['link'] = true;
            options['temporary'] = true;
            var $child = $item.children(options['child']);
            var $links = $child.children('a');
            $child.addClass('toggleMenu-header');
            $links.data(options);
            $links.data({'header' : true});
            self.$links = $item.find('a');
            self.$item = $item;
            self.options = options;
            self.addDataOnLinks();
        },
        'addDataOnLinks' : function() {
            var self = this;
            $.each(self.$links, function() {
                var $link = $(this);
                if(self.hasCollapse($link)) {
                    $link.data(self.options);
                    self.insertIconDirection($link, '>');
                }
            });
        },
        'hasCollapse' : function($target) {
            var self = this;
            return $target.siblings(self.options['parent']).first().length;
        },
        'collapse' : function($target) {
            var self = this;
            return $target.siblings(self.options['parent']).first();
        },
        'closeCollapse' : function() {
            var self = this;
            $.each(self.$links, function() {
                var $link = $(this);
                var $collapse = self.collapse($link);
                if($link.data('link')) {
                    if($collapse.css('display') == 'none') {
                        self.closeChildrenOfCollapse($link);
                    }
                }
            });
        },
        'closeChildrenOfCollapse' : function($target) {
            var self = this;
            $.each($target.parent(self.options['child']).find('a'), function() {
                var $link = $(this);
                if($link.data('link')) {
                    self.collapse($link).hide();
                    $link.data({ 'collapse' : 'close' });
                }
            });
        },
        'setActiveWithAjax' : function($item) {
            //var self = this, $link;
            //var lgtLinks = self.$links.length;
            //$.post(win.location.href)
            //    .done(function(data) {
            //        for(var i = 0; i < lgtLinks; i++) {
            //            $link = $(self.$links[i]);
            //            if($link.attr('href') == data) {
            //                var $headerLink = $link.parents('.toggleMenu-header').children('a').first().addClass('active');
            //                $link.addClass('active');
            //                self.openCollapses($item, $headerLink);
            //                i = lgtLinks;
            //            }
            //        }
            //    })
            //    .fail(function() {
            //        console.log('Error Ajax!');
            //    });
        },
        'setActive' : function($item) {
            var self = this, $link;
            var lgtLinks = self.$links.length;
            var url = win.location.href;
            for(var i = 0; i < lgtLinks; i++) {
                $link = $(self.$links[i]);
                if($link.attr('href') == url || $link.attr('href') + '/' == url) {
                    var $headerLink = $link.parents('.toggleMenu-header').children('a').first().addClass('active');
                    $link.addClass('active');
                    self.openCollapses($item, $headerLink);
                    i = lgtLinks;
                }
            }

        },
        'openCollapses' : function($item, $headerLink) {
            var self = this, $links = $headerLink.parents('.toggleMenu-header').find('a');
            var lgtLinks = $links.length, $link;
            for(var i = 0; i < lgtLinks; i++) {
                $link = $($links[i]);
                if($link.data('header')) {
                    $link.data('collapse', 'open');
                    self.collapse($link).slideDown();
                    self.insertIconDirection($link, 'v');
                    if($link.hasClass('active')) {
                        i = lgtLinks;
                    }
                }
            }
            $item.find('.collapse').removeClass('collapse');
        },
        'insertIconDirection' : function($target, icon) {
            var $itemIcon = $target.children('.nav-icon').first();
            if($itemIcon.length) {
                $itemIcon.html(icon);
            } else {
                $target.append('<span class="nav-icon">'+icon+'</span>');
            }
        }
    };

    $.jqToggleMenu.addData = new AddData();
})(jQuery, window);