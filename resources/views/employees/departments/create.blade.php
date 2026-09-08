@extends('layouts.app')

@section('title', 'Tambah Departemen')

@section('content')
    <div class="max-w-2xl">
        <x-ui.card header="Form Departemen">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <x-input-label for="code" value="Kode" />
                    <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="name" value="Nama Departemen" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="description" value="Deskripsi" />
                    <x-ui.textarea id="description" name="description" rows="3">{{ old('description') }}</x-ui.textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Aktif</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-2">
                    <x-secondary-button type="button" onclick="window.history.back()">Batal</x-secondary-button>
                    <x-primary-button>Simpan</x-primary-button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection