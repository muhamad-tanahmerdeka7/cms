<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Company Management'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-app.sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <x-app.navbar />

            <!-- Breadcrumb -->
            <x-app.breadcrumb />

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
                @yield('content')
            </main>

            <!-- Footer -->
            <x-app.footer />
        </div>
    </div>

    @stack('scripts')
</body>
</html>