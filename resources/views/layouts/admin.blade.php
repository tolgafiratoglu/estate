<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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

        <div class="modal" id="delete_confirm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __("admin.confirm_action") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __("admin.confirm_delete_action_detail") }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="delete-confirm-yes btn btn-primary">{{ __("admin.confirm_action_yes") }}</button>
                    <button type="button" class="confirm-close btn btn-secondary" data-dismiss="modal">{{ __("admin.confirm_action_close") }}</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal" id="remove_confirm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __("admin.confirm_action") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __("admin.confirm_remove_action_detail") }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="remove-confirm-yes btn btn-primary">{{ __("admin.confirm_action_yes") }}</button>
                    <button type="button" class="confirm-close btn btn-secondary" data-dismiss="modal">{{ __("admin.confirm_action_close") }}</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal" id="restore_confirm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __("admin.confirm_action") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __("admin.confirm_restore_action_detail") }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="restore-confirm-yes btn btn-primary">{{ __("admin.confirm_action_yes") }}</button>
                    <button type="button" class="confirm-close btn btn-secondary" data-dismiss="modal">{{ __("admin.confirm_action_close") }}</button>
                </div>
                </div>
            </div>
        </div>

        <main>
            <div class="admin-wrapper wide-box">
                <div class="admin-sidebar-wrapper shadowed-content">
                    <ul>
                        <li @if($module=='dashboard')class="active"@endif>
                            <i class="fas fa-tachometer-alt"></i><a href="{{ url('admin') }}">Dashboard</a>
                        </li>
                        <li @if($module=='users')class="active"@endif>
                            <i class="fas fa-user-tie"></i><a href="{{ url('admin/users') }}">Users</a>
                        </li>
                        <li @if($module=='property')class="active"@endif>
                            <i class="far fa-building"></i><a href="{{ url('admin/property') }}">Properties</a>
                        </li>
                        <li @if($module=='location')class="active"@endif>
                            <i class="far fa-map"></i><a href="{{ url('admin/location') }}">Location</a>
                        </li>
                        <li @if($module=='media')class="active"@endif>
                            <i class="fas fa-photo-video"></i><a href="{{ url('admin/media') }}">Media</a>
                        </li>
                        <li @if($module=='property_type')class="active"@endif>
                            <i class="fas fa-city"></i><a href="{{ url('admin/property-type') }}">Property Type</a>
                        </li>
                        <li @if($module=='property_status')class="active"@endif>
                            <i class="far fa-folder"></i><a href="{{ url('admin/property-status') }}">Property Status</a>
                            @if($module=='property_status')
                                <ul>
                                    <li><i class="fas fa-plus"></i><a href="{{ url('admin/property-status/new') }}">New</a></li>
                                    <li><i class="fas fa-trash"></i><a href="{{ url('admin/property-status?deleted=1') }}">Trash</a></li>
                                </ul>
                            @endif
                        </li>
                        <li @if($module=='interior_feature')class="active"@endif>
                            <i class="fas fa-couch"></i><a href="{{ url('admin/interior-feature') }}">Interior Feature</a>
                        </li>
                        <li @if($module=='exterior_feature')class="active"@endif>
                            <i class="fas fa-school"></i><a href="{{ url('admin/exterior-feature') }}">Exterior Feature</a>
                        </li>
                    </ul>
                    <ul style="margin-top: 1rem !important;">
                        <li @if($module=='system_settings')class="active"@endif>
                            <i class="fas fa-cogs"></i><a href="{{ url('admin/settings') }}">System Settings</a>
                        </li>
                        <li @if($module=='system_defaults')class="active"@endif>
                            <i class="fas fa-sliders-h"></i><a href="{{ url('admin/defaults') }}">System Defaults</a>
                        </li>
                        <li @if($module=='system_limits')class="active"@endif>
                            <i class="fas fa-screwdriver"></i><a href="{{ url('admin/limits') }}">System Limits</a>
                        </li>
                        <li @if($module=='system_images')class="active"@endif>
                            <i class="fas fa-image"></i><a href="{{ url('admin/images') }}">System Images</a>
                        </li>
                    </ul>    
                </div>
                <div class="admin-content-wrapper shadowed-content">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
