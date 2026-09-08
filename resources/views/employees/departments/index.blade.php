@extends('layouts.app')

@section('title', 'Data Departemen')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Departemen</h1>
        @can('employee.create')
            <a href="{{ route('departments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Departemen
            </a>
        @endcan
    </div>

    @if (session('success'))
        <x-ui.alert variant="success" dismissible>{{ session('success') }}</x-ui.alert>
    @endif
    @if (session('error'))
        <x-ui.alert variant="danger" dismissible>{{ session('error') }}</x-ui.alert>
    @endif

    <x-ui.card>
        <x-ui.table>
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($departments as $dept)
                    <tr>
                        <td class="px-4 py-2">{{ $dept->code }}</td>
                        <td class="px-4 py-2">{{ $dept->name }}</td>
                        <td class="px-4 py-2">{{ $dept->description ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <x-ui.badge :variant="$dept->is_active ? 'success' : 'danger'">
                                {{ $dept->is_active ? 'Aktif' : 'Nonaktif' }}
                            </x-ui.badge>
                        </td>
                        <td class="px-4 py-2">
                            @can('employee.update')
                                <a href="{{ route('departments.edit', $dept) }}" class="text-blue-600 hover:underline">Edit</a>
                            @endcan
                            @can('employee.delete')
                                <form action="{{ route('departments.destroy', $dept) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-2 hover:underline"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <x-ui.empty-state title="Belum ada departemen"
                                description="Klik tombol tambah untuk membuat departemen." />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-ui.table>
    </x-ui.card>
@endsection
