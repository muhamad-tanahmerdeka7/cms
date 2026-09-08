@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
    <div class="max-w-2xl">
        <x-ui.card header="Form Karyawan">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="employee_code" value="Kode Karyawan" />
                        <x-text-input id="employee_code" class="block mt-1 w-full" type="text" name="employee_code" :value="old('employee_code')" required />
                        <x-input-error :messages="$errors->get('employee_code')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="email" value="Email (untuk login)" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="phone" value="Telepon" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="gender" value="Jenis Kelamin" />
                        <x-ui.select name="gender" :options="['male' => 'Laki-laki', 'female' => 'Perempuan']" :selected="old('gender')" placeholder="Pilih" />
                    </div>
                    <div>
                        <x-input-label for="birth_date" value="Tanggal Lahir" />
                        <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" />
                        <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="join_date" value="Tanggal Bergabung" />
                        <x-text-input id="join_date" class="block mt-1 w-full" type="date" name="join_date" :value="old('join_date')" required />
                        <x-input-error :messages="$errors->get('join_date')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="status" value="Status" />
                        <x-ui.select name="status" :options="['active' => 'Aktif', 'inactive' => 'Nonaktif', 'resigned' => 'Resign']" :selected="old('status', 'active')" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="department_id" value="Departemen" />
                        <x-ui.select name="department_id" :options="$departments->pluck('name', 'id')->toArray()" :selected="old('department_id')" placeholder="Pilih" />
                    </div>
                    <div>
                        <x-input-label for="position_id" value="Jabatan" />
                        <x-ui.select name="position_id" :options="$positions->pluck('name', 'id')->toArray()" :selected="old('position_id')" placeholder="Pilih" />
                    </div>
                    <div>
                        <x-input-label for="shift_id" value="Shift" />
                        <x-ui.select name="shift_id" :options="$shifts->pluck('name', 'id')->toArray()" :selected="old('shift_id')" placeholder="Pilih" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4 border-t pt-4">
                    <div>
                        <x-input-label for="password" value="Password (untuk login)" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin membuat akun.</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="role" value="Role" />
                        <x-ui.select name="role" :options="$roles->pluck('name', 'name')->toArray()" :selected="old('role')" placeholder="Pilih Role" />
                    </div>
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <x-secondary-button type="button" onclick="window.history.back()">Batal</x-secondary-button>
                    <x-primary-button>Simpan</x-primary-button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection