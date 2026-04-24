<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title ?? ''}}</title>
    <meta name="description" content="{{$description??''}}">
    <meta name="robots" content="noindex, nofollow"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head_scripts')
</head>
<body class="admin-body bg-zinc-950">
<div id="app" class="admin-app bg-zinc-950">
    <main class="main admin-main bg-zinc-900 min-h-screen">
        @yield('content')
    </main>
</div>
</body>
</html>
