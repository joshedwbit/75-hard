<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', '75Hard tracker')</title>
    <meta charset="UTF-8">
    <meta name="description" content="@yield('meta_description', 'Welcome to 75Hard fitness and diet tracker - this site can be used to log progress throughout your journey.')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="@yield('robots_meta', 'index, follow')">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('scripts')
    <title>Document</title>
</head>
<body id="app">
    <header></header>

    <main>
        @yield('content')
    </main>

    <footer></footer>
</body>
</html>