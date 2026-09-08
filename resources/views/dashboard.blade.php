@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-ui.alert variant="success" dismissible>
        Selamat datang, {{ auth()->user()->name }}!
    </x-ui.alert>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <x-ui.card header="Total Karyawan">
            <p class="text-3xl font-bold">150</p>
        </x-ui.card>
        <!-- ... -->
    </div>
@endsection