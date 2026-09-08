<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Company Management'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-app.sidebar />

        <!-- Main content wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <x-app.navbar />

            <!-- Breadcrumb -->
            <x-app.breadcrumb />

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <x-app.footer />
        </div>
    </div>

    @stack('scripts')
</body>
</html>
