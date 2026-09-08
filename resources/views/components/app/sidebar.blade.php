<aside x-show="sidebarOpen"
       class="w-64 bg-gray-800 text-white flex-shrink-0 overflow-y-auto transition-all duration-300"
       x-transition:enter="transition ease-in-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0">

    <div class="flex items-center justify-between p-4 border-b border-gray-700">
        <a href="{{ route('dashboard') }}" class="text-xl font-semibold tracking-wide">
            {{ config('app.name', 'Company MS') }}
        </a>
        <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white">
            ✕
        </button>
    </div>

    <nav class="mt-4 px-2 space-y-1">
        {{-- Dashboard --}}
        <x-app.menu-item route="dashboard" icon="🏠" label="Dashboard" />

        {{-- HR Modules --}}
        @can('employee.view')
            <x-app.menu-item route="employees.index" icon="👥" label="Karyawan" />
        @endcan

        @can('attendance.view')
            <x-app.menu-item route="attendance.index" icon="📅" label="Absensi" />
        @endcan

        @can('leave.view')
            <x-app.menu-item route="leaves.index" icon="📄" label="Izin / Cuti" />
        @endcan

        @can('overtime.view')
            <x-app.menu-item route="overtime.index" icon="⏰" label="Lembur" />
        @endcan

        {{-- Inventory Module --}}
        @can('inventory.view')
            <div class="pt-2 mt-2 border-t border-gray-700">
                <x-app.menu-item route="inventory.products.index" icon="📦" label="Produk" />
                <x-app.menu-item route="inventory.stock-in.index" icon="📥" label="Barang Masuk" />
                <x-app.menu-item route="inventory.stock-out.index" icon="📤" label="Barang Keluar" />
                <x-app.menu-item route="inventory.stock-card.index" icon="📊" label="Kartu Stok" />
            </div>
        @endcan

        {{-- Reports --}}
        @can('report.view')
            <div class="pt-2 mt-2 border-t border-gray-700">
                <x-app.menu-item route="reports.attendance" icon="📊" label="Laporan Absensi" />
                <x-app.menu-item route="reports.stock" icon="📈" label="Laporan Stok" />
            </div>
        @endcan

        {{-- Settings --}}
        @can('settings.view')
            <div class="pt-2 mt-2 border-t border-gray-700">
                <x-app.menu-item route="settings.users.index" icon="👤" label="Pengguna" />
                <x-app.menu-item route="settings.roles.index" icon="🔑" label="Peran" />
            </div>
        @endcan
    </nav>
</aside>

{{-- Overlay mobile --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false"
     class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">
</div>
