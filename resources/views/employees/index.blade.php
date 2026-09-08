@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Karyawan</h1>
        @can('employee.create')
            <a href="{{ route('employees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Karyawan
            </a>
        @endcan
    </div>

    @if(session('success'))
        <x-ui.alert variant="success" dismissible>{{ session('success') }}</x-ui.alert>
    @endif
    @if(session('error'))
        <x-ui.alert variant="danger" dismissible>{{ session('error') }}</x-ui.alert>
    @endif

    <x-ui.card>
        <x-ui.table>
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Departemen</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($employees as $emp)
                    <tr>
                        <td class="px-4 py-2">{{ $emp->employee_code }}</td>
                        <td class="px-4 py-2">{{ $emp->name }}</td>
                        <td class="px-4 py-2">{{ $emp->department->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $emp->position->name ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <x-ui.badge :variant="$emp->status === 'active' ? 'success' : 'danger'">
                                {{ $emp->status }}
                            </x-ui.badge>
                        </td>
                        <td class="px-4 py-2">
                            @can('employee.update')
                                <a href="{{ route('employees.edit', $emp) }}" class="text-blue-600 hover:underline">Edit</a>
                            @endcan
                            @can('employee.delete')
                                <form action="{{ route('employees.destroy', $emp) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-2 hover:underline" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <x-ui.empty-state title="Belum ada karyawan" description="Klik tombol tambah untuk membuat karyawan." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-ui.table>
    </x-ui.card>
@endsection