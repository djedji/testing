<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel tutos</title>
    {{-- CSS : BootStrap original --}}
    {{ AutoloadFS::run("vendor/bootstrap/css/bootstrap.min.css") }}

    {{-- CSS : Theme BootStrap workbench site : http://binarycart.com/bclivedemos/01-05-2014/v1/bs-binary-admin/index.html --}}

    {{ HTML::style("vendor/bootstrap/css/font-awesome.css") }}
    

    {{-- CSS : my CSS --}}
    {{ HTML::style("owner/global/css/main.css") }}
    {{ HTML::style("owner/global/css/my.animation.css") }}

    {{-- SCRIPT : jQuery 2.0.3 --}}
    {{ HTML::script("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js") }}


    @yield('style')

</head>
<body>

    {{ $navbarDefault }}

    <div class="main-container">
        <nav class="main-block-left">
            <div id="main-sidebar" class="{{$pageName or 'homePage'}}">
                  {{ $mainSidebar }}
            </div>
        </nav> {{-- end nav side --}}

        <div class="main-block-right">
            <div class="main-content">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ $content or '' }}
                </div>
            </div>
        </div>
    </div>

    {{ AutoloadFS::run('owner/toggleMenu') }}

    {{-- Javascript --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // -------------------------------------
            // --- metis menu
            $('#toggle-menu').toggleMenu();

            // -------------------------------------
            // --- add form on page comments
            (function() {
                var form = '<form id="current-reply" action="/" method="POST" style="margin-top: 20px;display:none;">'+
                '<div class="form-group">'+
                '<textarea id="focus-cursor" class="form-control" rows="3" placeholder="Votre Réponse"></textarea>'+
                '</div>'+
                '<div class="form-group form-inline">'+
                '<input style="margin-right: 8px;" type="text" class="form-control" placeholder="Email"/>'+
                '<input type="password" class="form-control" placeholder="Password"/>'+
                '<input type="submit" class="btn btn-info pull-right"/>'+
                '</div>'+
                '</form>';
                var $replies = $('.toggle-reply');
                var $replyInput = $('.reply-toggle');

                $replies.click(function(e) {
                    e.preventDefault();
                    var $reply = $(this);
                    var $media = $reply.parents('.media-body').children('p').first();

                    if(!$reply.data('reply')) {
                        $media.after(form);
                        $('#current-reply').slideDown('slow');
                        $reply.data({ 'reply' : true });
                        $reply.text('Fermer');
                        $("#focus-cursor").focus();
                    } else {
                        $('#current-reply').slideUp('slow');
                        $reply.text('Répondre');
//                        $reply.data({ 'reply' : false });
                        $reply.removeData('reply');
                        $('#focus-cursor').focus();
                        setTimeout(function() {
                            $('#current-reply').remove();
                        }, 700);
                    }
                });
                var form1 = '<form action="/" method="POST" style="margin-top: 20px;">'+
                        '<div class="form-group">'+
                        '<textarea id="cursor-focus" class="form-control" rows="3" placeholder="Votre Réponse"></textarea>'+
                        '</div>'+
                        '<div class="form-group form-inline">'+
                        '<input style="margin-right: 8px;" type="text" class="form-control" placeholder="Email"/>'+
                        '<input type="password" class="form-control" placeholder="Password"/>'+
                        '<input type="submit" class="btn btn-info pull-right"/>'+
                        '</div>'+
                        '</form>';
                $replyInput.focus(function() {
                    $(this).replaceWith(form1);
                    $("#cursor-focus").focus();
                });
            })();

            // -------------------------------------
            // --- toggle box categories
            (function() {
                var $controls = $('.control');

                function removeClassAnim($target, className, style) {
                    setTimeout(function() {
                        $target.removeClass(className);
                        if(style) {
                            $target.css(style);
                        }
                    }, 530);
                }

                $controls.click(function(e) {
                    e.preventDefault();
                    var $control = $(this);
                    var $boxCategory = $control.parent().find('.filter-anim').first();

                    var show = $boxCategory.css('display');

                    if(show == 'none') {
                        $boxCategory.css({'display' : 'block'}).addClass('animated fadeInUp');
                        removeClassAnim($boxCategory, 'animated fadeInUp');
                    } else {
                        $boxCategory.addClass('animated fadeOutDown');
                        removeClassAnim($boxCategory, 'animated fadeOutDown', {'display' : 'none'});
                    }
                });
            })();

            // -------------------------------------
            // --- add event preventDefault on navbar with class navbar-active

            (function() {
                var currentPageName = $('#navbar').attr('class');
                var $elementsNavBar = $('.nav', '#navbar').find('a');
                var textNavBar, pageFinded = false;

                // create and add class nabar-active
                $.each($elementsNavBar, function() {
                    var $this = $(this);
                    textNavBar = $this.text();
                    textNavBar = textNavBar.toLowerCase();
                    textNavBar = textNavBar+'Page';
                    if(textNavBar == currentPageName.toLowerCase()) {
                        $this.addClass('navbar-active');
                        pageFinded = true;
                    }
                });

                // default navbar-active on home page
                if(!pageFinded) {
                    $('#navbar-home').addClass('navbar-active');
                }

                // event preventDefault on navbar-active
                $('.navbar-active').click(function(e) {
                    e.preventDefault();
                });
            })();

            // -------------------------------------
            // --- focus select table
            (function() {
                var $elemSelect = $('#scaffold-table');

                $elemSelect.change(function() {
                    window.location.href = $(this).val();
                });
            })();

            // -------------------------------------
            // --- add in form, input hidden with table name
            (function() {
                var $elemOption = $('#scaffold-table').find('option');
                var $form = $('#form');

                $.each($elemOption, function() {
                    if($(this).attr('selected')) {
                        tableName = $(this).text();
                        $form.prepend('<input type="hidden" name="tableName" id="tableName" value="'+tableName+'">');
                    }
                });
            })();

            // addClass shake
            (function() {
                var classElementHtml = ['.btn-shake'];
                $.each(classElementHtml, function(key,val) {
                    $(val).click(function() {
                        var $elem = $(this);
                        $elem.addClass('fail-shake');
                        setTimeout(function() {
                            $elem.removeClass('fail-shake');
                        }, 800);
                    });
                });
            })();
        });
    </script>
 {{-- end Javascript --}}

    @yield('scriptPage')

    @yield('scriptPagejQuery')
</body>
</html>