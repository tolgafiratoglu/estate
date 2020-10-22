<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Estate') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/webview-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <script src='//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=false&key=AIzaSyDhLnCaYqsOFz3DelD1Sjls5ozSuHvK5lA&ver=1.0.0'></script>
    <script src="{{ asset('js/webview.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/common.js') }}" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div class="content-wrapper">
        @if($headerSettings["show_menu"] == true)
            <div class="header-top-wrapper">
                <div class="header-social-media">

                </div>
                <div class="header-info-email">
                    {{ $headerDefaults["email"] }}    
                </div>
                <div class="header-language">
                    
                </div>
            </div>
            <div class="header-wrapper">
                <div class="header-boxed">
                    <div class="header-content-wrapper">
                        <div class="header-left-side-wrapper">
                            @if($headerSettings["show_upload_button"] == true)
                                <div class="header-logo-wrapper">
                                    <a href="{{ URL::to('/') }}">
                                        @if($headerLogo != NULL)
                                            <img style="vertical-align: baseline;" src="{{ $headerLogo }}">
                                        @else    
                                            <img style="vertical-align: baseline;" src="{{ asset('image/logo.png') }}" />
                                        @endif
                                    </a>    
                                </div>
                            @endif
                        </div>
                        <div class="header-right-side-wrapper">
                            @if($headerSettings["show_upload_button"] == true)
                                <div class="header-upload-button">
                                    <a href="{{ URL::to('/property/new') }}">
                                        {{ __("Upload") }}
                                    </a>    
                                </div>
                            @endif
                            @if($headerSettings["show_authentication"] == true)
                                <div class="header-authentication">
                                    <ul>
                                        <li><a href="{{ URL::to('/login') }}">{{ __("Login") }}</a></li>
                                        <li><a href="{{ URL::to('/register') }}">{{ __("Register") }}</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="header-left-side-wrapper hide-in-mobile">
                            <div class="header-menu-wrapper">
                                <div class="header-menu">
                                    {!! $headerMenu !!}
                                </div> <!-- .header-menu -->                    
                            </div> <!-- .header-menu-wrapper -->
                        </div> <!-- header-left-side-wrapper -->
                    </div> <!-- header-content-wrapper -->
                </div> <!-- .header-boxed -->
            </div> <!-- .header-wrapper -->
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div><!-- .content-wrapper -->
</div>
</body>
</html>
