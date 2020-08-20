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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/webview-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <script src='//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=false&key=AIzaSyDhLnCaYqsOFz3DelD1Sjls5ozSuHvK5lA&ver=1.0.0'></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/common.js') }}" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div class="content-wrapper">
        <div class="header-wrapper">
            <div class="header-boxed">
                <div class="header-content-wrapper">
                    <div class="header-left-side-wrapper">
                        <div class="header-logo-wrapper">
                            <a href="{{ URL::to('/') }}">
                                <img style="vertical-align: baseline;" src="{{ asset('image/logo.png') }}" />
                            </a>    
                        </div>
                    </div>
                    <div class="header-right-side-wrapper">
                        {{ $menu }}
                    </div>
                    <div class="header-left-side-wrapper hide-in-mobile">
                        <div class="header-menu-wrapper">
                            <div class="header-menu">
                            <ul id="menu-header-menu" class="menu">
                                        <li id="menu-item-34" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-34"><a href="http://themes.qualstudio.com/artifex/">Layouts</a>
                                        <ul class="sub-menu">
                                        <li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children menu-item-35"><a href="http://themes.qualstudio.com/artifex/">Classic View</a>
                                        <ul class="sub-menu">
                                        <li id="menu-item-225" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-225"><a href="http://themes.qualstudio.com/artifex/">With Sidebar</a></li>
                                        <li id="menu-item-224" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-224"><a href="http://themes.qualstudio.com/artifex/219-2/">Without Sidebar</a></li>
                                        </ul>
                                        </li>
                                        <li id="menu-item-41" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-41"><a href="http://themes.qualstudio.com/artifex/blog-grid-view-2/">Grid</a>
                                        <ul class="sub-menu">
                                        <li id="menu-item-43" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-43"><a href="http://themes.qualstudio.com/artifex/blog-grid-view-2/">Grid 2 Each</a></li>
                                        <li id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40"><a href="http://themes.qualstudio.com/artifex/blog-grid-view-3/">Grid 3 Each</a></li>
                                        </ul>
                                        </li>
                                        <li id="menu-item-38" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-38"><a href="http://themes.qualstudio.com/artifex/blog-masonry-view-2/">Masonry</a>
                                        <ul class="sub-menu">
                                        <li id="menu-item-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-42"><a href="http://themes.qualstudio.com/artifex/blog-masonry-view-2/">Masonry 2 Each</a></li>
                                        <li id="menu-item-37" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-37"><a href="http://themes.qualstudio.com/artifex/blog-masonry-view-3/">Masonry 3 Each</a></li>
                                        </ul>
                                        </li>
                                        <li id="menu-item-39" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-39"><a href="http://themes.qualstudio.com/artifex/blog-list-view/">List View</a></li>
                                        <li id="menu-item-155" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-155"><a href="#">Pagination</a>
                                        <ul class="sub-menu">
                                        <li id="menu-item-223" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-223"><a href="http://themes.qualstudio.com/artifex/">AJAX Based</a></li>
                                        <li id="menu-item-156" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-156"><a href="http://themes.qualstudio.com/artifex/infinite-scroll/">Infinite Scroll</a></li>
                                        <li id="menu-item-159" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a href="http://themes.qualstudio.com/artifex/prev-next-pagination/">Prev Next</a></li>
                                        <li id="menu-item-222" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-222"><a href="http://themes.qualstudio.com/artifex/219-2/">Standard</a></li>
                                        </ul>
                                        </li>
                                        </ul>
                                        </li>
                                        <li id="menu-item-254" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-254"><a href="#">Headers</a>
                                        <ul class="sub-menu">
                                        <li id="menu-item-253" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-253"><a href="http://themes.qualstudio.com/artifex/header-layout-1-2-2/">Header Layout 1</a></li>
                                        <li id="menu-item-252" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-252"><a href="http://themes.qualstudio.com/artifex/header-layout-1-2/">Header Layout 2</a></li>
                                        <li id="menu-item-251" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-251"><a href="http://themes.qualstudio.com/artifex/header-layout-2-1/">Header Layout 3</a></li>
                                        <li id="menu-item-250" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-250"><a href="http://themes.qualstudio.com/artifex/247-2/">Header Layout 4</a></li>
                                        </ul>
                                        </li>
                                        <li id="menu-item-160" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-160"><a href="#">Posts</a>
                                        <ul class="sub-menu">
                                        <li id="menu-item-161" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-161"><a href="http://themes.qualstudio.com/artifex/2017/09/06/141/">Standard Post</a></li>
                                        <li id="menu-item-162" class="menu-item menu-item-type-post_type menu-item-object-post current-menu-item menu-item-162"><a href="http://themes.qualstudio.com/artifex/2018/06/07/a-new-movie-on-friendship-sacrifice-and-deep-emotions/">Gallery Post</a></li>
                                        <li id="menu-item-163" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-163"><a href="http://themes.qualstudio.com/artifex/2017/11/23/expect-the-worst/">Audio Post</a></li>
                                        <li id="menu-item-164" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-164"><a href="http://themes.qualstudio.com/artifex/2017/08/21/dont-build-cities-build-destinies-instead/">Video Post</a></li>
                                        </ul>
                                        </li>
                                        <li id="menu-item-61" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-61"><a href="http://themes.qualstudio.com/artifex/shortcodes/">Shortcodes</a></li>
                                        <li id="menu-item-96" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-96"><a href="http://themes.qualstudio.com/artifex/say-hello/">Say Hello</a></li>
                                    </ul>
                            </div> <!-- .header-menu -->                    
                            </div> <!-- .header-menu-wrapper -->
                        </div> <!-- header-left-side-wrapper -->
                    </div> <!-- header-content-wrapper -->
                </div> <!-- .header-wrapper -->
            </div><!-- .content-wrapper -->
        <!--
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
