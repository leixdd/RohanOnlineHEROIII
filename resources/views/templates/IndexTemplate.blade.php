<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/client.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/loading-btn.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/loading.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/font-awesome.min.css') }}" type="text/css" rel="stylesheet" />
    </head>
    <body>

        @include('navs.Indexnav')
        
        
        <div id="body-content" class="mt-3">
            @yield('content')
        </div>
        
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <!-- Your customer chat code -->
        <div class="fb-customerchat"
        attribution=setup_tool
        page_id="994850530718485">
        </div>

        <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/synapsygen.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/swal.js') }}"></script>
        <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/client.js') }}" type="text/javascript"></script>
        
        <script>
            
            $('.dropdown-menu').on('click', function (event) {
                event.stopPropagation();
            });


            $(document).keydown(function (event) {
                if (event.keyCode == 123) { // Prevent F12
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                    return false;
                }
            });


            $(document).on("contextmenu", function (e) {        
                e.preventDefault();
            });

            $(document).ready(function() {
                $('#modalx').click();
            });
        </script>
    </body>
</html>
