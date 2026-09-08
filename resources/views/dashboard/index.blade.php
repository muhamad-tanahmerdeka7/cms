@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <x-ui.card class="border-l-4 border-primary-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm text-primary-600">Total Karyawan</p>
                    <p class="text-2xl font-bold text-primary-800">{{ $totalEmployees }}</p>
                </div>
                <div class="text-3xl text-primary-400">👥</div>
            </div>
        </x-ui.card>

        <x-ui.card class="border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm text-green-600">Hadir Hari Ini</p>
                    <p class="text-2xl font-bold text-green-700">{{ $presentToday }}</p>
                </div>
                <div class="text-3xl text-green-400">✅</div>
            </div>
        </x-ui.card>

        <x-ui.card class="border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm text-yellow-600">Terlambat</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $lateToday }}</p>
                </div>
                <div class="text-3xl text-yellow-400">⏰</div>
            </div>
        </x-ui.card>

        <x-ui.card class="border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm text-red-600">Izin Pending</p>
                    <p class="text-2xl font-bold text-red-700">{{ $pendingLeaves }}</p>
                </div>
                <div class="text-3xl text-red-400">📄</div>
            </div>
        </x-ui.card>
    </div>

    <!-- Grafik & Tabel -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Grafik Kehadiran Bulanan -->
        <x-ui.card header="Monthly Attendance" class="bg-white">
            <div style="height: 200px;">
                <canvas id="attendanceChart"></canvas>
            </div>
            <div class="flex justify-center mt-2 space-x-4 text-xs">
                <span class="flex items-center"><span
                        class="inline-block w-3 h-3 bg-primary-500 rounded-full mr-1"></span> Present</span>
                <span class="flex items-center"><span class="inline-block w-3 h-3 bg-red-400 rounded-full mr-1"></span>
                    Absent</span>
            </div>
        </x-ui.card>

        <!-- Projected Attendance & Log -->
        <x-ui.card header="Projected Attendance & Log">
            <x-ui.table>
                <thead class="bg-primary-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-primary-700 uppercase">Month</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-primary-700 uppercase">Number of
                            Employees</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary-100">
                    @foreach ($monthlyData->take(6) as $data)
                        <tr>
                            <td class="px-4 py-2 text-primary-800">{{ $data['month'] }} {{ $data['year'] }}</td>
                            <td class="px-4 py-2 text-primary-700">{{ $data['present'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </x-ui.table>
        </x-ui.card>
    </div>

    <!-- Notifikasi Tim & Kalender -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Notifikasi Tim -->
        <x-ui.card header="Notifikasi Tim" class="lg:col-span-1">
            <ul class="space-y-2">
                @foreach ($teamNotifications as $notif)
                    <li class="flex justify-between items-center border-b border-primary-50 pb-2">
                        <span class="text-primary-800">{{ $notif['name'] }}</span>
                        <span
                            class="text-xs text-primary-600 bg-primary-100 px-2 py-0.5 rounded-full">{{ $notif['status'] }}</span>
                    </li>
                @endforeach
            </ul>
        </x-ui.card>

        <!-- Kalender Log (Attendance Calendar) -->
        <x-ui.card header="Attendance Calendar & Log" class="lg:col-span-2">
            <div class="grid grid-cols-5 sm:grid-cols-7 md:grid-cols-10 gap-1">
                @foreach ($calendarLog as $day)
                    <div class="text-center p-1 bg-primary-50 rounded {{ $day['count'] > 0 ? 'bg-primary-200' : '' }}">
                        <div class="text-xs text-primary-600">{{ $day['day'] }}</div>
                        <div class="text-xs text-primary-800 font-bold">{{ substr($day['date'], 0, 3) }}</div>
                    </div>
                @endforeach
            </div>
            <div class="mt-2 text-xs text-primary-600">* Warna menunjukkan jumlah kehadiran</div>
        </x-ui.card>
    </div>

    <!-- Log Kehadiran Terbaru -->
    <x-ui.card header="Log Kehadiran">
        <x-ui.table>
            <thead class="bg-primary-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-primary-700 uppercase">Tanggal</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-primary-700 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-primary-700 uppercase">Jam Masuk</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-primary-700 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary-100">
                @foreach ($attendanceLog as $log)
                    <tr>
                        <td class="px-4 py-2 text-primary-800">{{ $log['date'] }}</td>
                        <td class="px-4 py-2 text-primary-800">{{ $log['employee'] }}</td>
                        <td class="px-4 py-2 text-primary-700">{{ $log['check_in'] }}</td>
                        <td class="px-4 py-2">
                            <x-ui.badge :variant="match ($log['status']) {
                                'present', 'late' => 'success',
                                'absent' => 'danger',
                                default => 'secondary',
                            }">
                                {{ ucfirst($log['status']) }}
                            </x-ui.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-ui.table>
    </x-ui.card>

    <!-- Script Chart.js -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('attendanceChart').getContext('2d');
                const labels = @json($monthlyData->pluck('month'));
                const present = @json($monthlyData->pluck('present'));
                const absent = @json($monthlyData->pluck('absent'));

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Present',
                                data: present,
                                backgroundColor: 'rgba(245, 158, 11, 0.6)',
                                borderColor: 'rgba(245, 158, 11, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Absent',
                                data: absent,
                                backgroundColor: 'rgba(239, 68, 68, 0.6)',
                                borderColor: 'rgba(239, 68, 68, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection