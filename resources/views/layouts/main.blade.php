<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    @yield('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark" data-topbar="dark">

    <div id="layout-wrapper">

        @include('partials.header')

        @include('partials.sidebar')

        @yield('content')

    </div>


    <!-- JAVASCRIPT -->
    <script type="text/javascript" src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript">
        var observe;
        var text = document.getElementById('autoresize');

        function redirectTo(url) {
            console.log(url);
            window.location.assign(url);
        }

        function goBack() {
            window.history.back();
        }

        function reload() {
            window.location.reload();
        }

        function resize () {
            text.style.height = 'auto';
            text.style.height = text.scrollHeight+'px';
        }
        
        function delayedResize () {
            window.setTimeout(resize, 0);
        }
        
        function init () {
            if (window.attachEvent) {
                observe = function (element, event, handler) {
                    if (element) {
                        element.attachEvent('on'+event, handler);
                    }
                };
            } else {
                observe = function (element, event, handler) {
                    if (element) {
                        element.addEventListener(event, handler, false);
                    }
                };
            }
            
            if (text) {
                observe(text, 'change',  resize);
                observe(text, 'cut',     delayedResize);
                observe(text, 'paste',   delayedResize);
                observe(text, 'drop',    delayedResize);
                observe(text, 'keydown', delayedResize);

                text.focus();
                text.select();
                resize();
            }
        }

        $(document).ready(function() {
            $("#flip").click(function() {
                $("#panel").slideDown("slow");
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            init();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    @yield('script')

    <!-- App js -->
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>

    {!! Toastr::message() !!}

</body>

</html>