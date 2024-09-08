<!DOCTYPE html>
<html lang="hu" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    @yield('content')
    @vite(['resources/js/app.js'])
</body>
</html>
