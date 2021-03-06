<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    @yield('header')

    <!-- Styles -->
    {{-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- right Side Of Navbar -->
                    <div class="navbar-nav mr-auto">
                        <a href="/" class="nav-item nav-link">help</a>
                    
                    </div>

                    <!-- left Side Of Navbar -->
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
        <div class="container">
            <div class="row py-4">
                @if (Auth::check() && Auth::user()->is_admin)
                    
                    <div class=" col-lg-3 col-md-12 mb-3">
                        <div class="list-group">
                            <a href="{{ route('home') }}" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }} list-group-item list-group-item-action">home</a>    
                            <a href="{{ route('services.index') }}" class="{{ Route::currentRouteName() == 'services.index' ? 'active' : '' }} list-group-item list-group-item-action">services</a>    
                            <a href="{{ route('categories.index') }}" class="{{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }} list-group-item list-group-item-action">categories</a>    
                            <a href="{{ route('users.index') }}" class="{{ Route::currentRouteName() == 'users.index' ? 'active' : '' }} list-group-item list-group-item-action">users</a>    
                            <a href="{{ route('servicecodes.index') }}" class="{{ Route::currentRouteName() == 'servicecodes.index' ? 'active' : '' }} list-group-item list-group-item-action">service codes</a>  
                            <a href="{{ route('bundles.index') }}" class="{{ Route::currentRouteName() == 'bundles.index' ? 'active' : '' }} list-group-item list-group-item-action">Bundles List</a>
                            <a href="{{ route('orders.admin_show') }}" class="{{ Route::currentRouteName() == 'orders.admin_show' ? 'active' : '' }} list-group-item list-group-item-action">Orders List</a>    
                            <a href="{{ route('giftcards.index') }}" class="{{ Route::currentRouteName() == 'giftcards.index' ? 'active' : '' }} list-group-item list-group-item-action">Gift Cards</a>    

                            
                            
                            
                        </div>
                    </div>
                @endif
                    <div class="col col-md-9">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @yield('content')
                    </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
</body>
</html>
