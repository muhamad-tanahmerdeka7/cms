<header class="bg-white shadow-sm border-b border-primary-200">
    <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center">
            <button @click="sidebarOpen = !sidebarOpen"
                class="text-primary-600 hover:text-primary-800 focus:outline-none md:mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <span class="text-primary-700 text-sm hidden md:inline">Selamat datang, {{ auth()->user()->name }}</span>
        </div>

        <div class="flex items-center space-x-3">
            {{-- Notifikasi --}}
            <button class="text-primary-600 hover:text-primary-800 relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
            </button>

            {{-- Profile Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <div
                        class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-sm font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm text-primary-700 hidden md:block">{{ auth()->user()->name }}</span>
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-primary-100">
                    {{-- Link Profil sementara dihapus untuk menghindari error --}}
                    {{-- <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-primary-700 hover:bg-primary-50">Profil</a> --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-primary-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
