<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/views/central/sass/app.scss', 'resources/views/central/js/app.js', 'resources/views/central/css/app.css'])
</head>
<body>
    <div class="d-flex" id="wrapper">
        @include('central.navbar', ['section' => 'sidebar'])
        <div id="page-content-wrapper">
            @include('central.navbar', ['section' => 'topbar'])
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
