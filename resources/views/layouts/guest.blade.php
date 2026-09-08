<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CorpConnect') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-primary-100 via-primary-200 to-primary-300 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden p-8 border border-primary-200">
            <div class="text-center mb-6">
                <a href="/" class="text-3xl font-bold text-primary-700 tracking-wider">
                    {{ config('app.name', 'CorpConnect') }}
                </a>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>
</html>