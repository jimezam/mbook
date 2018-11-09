<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" onload="load">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
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
                        <!-- Home -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('bookbrowser.index') }}" role="button">
                                {{ __('Navegador') }}
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <!-- Home -->
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('home') }}" role="button">
                                    {{ __('Tablero') }}
                                </a>
                            </li>
                            <!-- mBooks -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Libros') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('mbooks.index') }}">
                                        <i class="fas fa-list-ul"></i>&nbsp;&nbsp;&nbsp;{{ __('Listar') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('mbooks.create') }}">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;{{ __('Agregar') }}
                                    </a>
                                </div>
                            </li>
                            <!-- User's menu -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;{{ __('Logout') }}
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

        <main class="py-4">

            <!-- Espacio para los mensajes flash enviados entre solicitudes -->
            @if(Session::has('success'))
            <div class="container">
                <article class="alert alert-success">
                    {{ Session::get('success') }}
                </article>
            </div>
            @endif

            @if(Session::has('failure'))
            <div class="container">
                <article class="alert alert-danger">
                    {{ Session::get('failure') }}
                </article>
            </div>
            @endif

            <!-- Diálogo modal para mostrar la realización de una operación asíncrona -->
            <div id="loading" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Trabajando</h5>
                        </div>
                        <div class="modal-body">
                            <p><i class="fas fa-spinner"></i> &nbsp;&nbsp;Por favor espera un momento ...</p>
                        </div>
                    </div>
                </div>
            </div>         

            @yield('content')
        </main>
    </div>
</body>
</html>
