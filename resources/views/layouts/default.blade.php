<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')

    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script defer src="{{ asset('js/app.js') }}"></script>
</head>
<body>

    <section class="section">
        <div class="container">

            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a class="navbar-item" href="/">
                        <i class="fas fa-home fa-2x"></i>
                    </a>

                    @auth
                        <a href="board/create" class="navbar-item">
                            Add a board
                        </a>
                    @endauth

                </div>

                <div class="navbar-end">
                    @auth
                        <p class="navbar-item">Hi {{ Auth::user()->name }},</p>
                        <div class="buttons">
                            <a href="{{ route('logout') }}" class="button is-primary" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <strong>Logout</strong>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="navbar-item">
                            <div class="buttons">
                                <a href="{{ route('login') }}" class="button is-primary">
                                    <strong>Login</strong>
                                </a>
                                <a href="{{ route('register') }}" class="button is-light">
                                    Register
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>

            </nav>
        </div>

        @yield('content')

    </section>
</body>
</html>
