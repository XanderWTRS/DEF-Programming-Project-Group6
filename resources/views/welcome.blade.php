<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EhB MediaLab</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="body-class">
    <header>
        <img src="{{ asset('assets/logo/logo-trans.png') }}" alt="logo EhB">
    </header>
    @if (Route::has('login'))
        <nav class="nav">
            @auth
                @if (Auth::user()->isAdmin())
                    <a href="{{ url('/admin-dashboard') }}" class=""><span>Home</span></a>
                @else
                    <a href="{{ url('/home') }}" class=""><span>Home</span></a>
                @endif
            @else
                <a href="{{ route('login') }}" class="button-welcome"><span>Log in</span></a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="button-welcome"><span>Register</span></a>
                @endif
            @endauth
        </nav>
    @endif
</body>

</html>
