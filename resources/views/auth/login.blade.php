@extends('layouts.guest')

@section('content')
    <div class="text-center mb-6">
        <h1 class="text-2xl font-semibold text-primary-800">Selamat Datang (Welcome)</h1>
        <p class="text-sm text-primary-500 mt-1">Masuk untuk melanjutkan ke aplikasi</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-primary-700" />
            <x-text-input id="email"
                          class="block mt-1 w-full border-primary-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg"
                          type="email"
                          name="email"
                          :value="old('email')"
                          placeholder="you@example.com"
                          required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Kata Sandi')" class="text-primary-700" />
            <x-text-input id="password"
                          class="block mt-1 w-full border-primary-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg"
                          type="password"
                          name="password"
                          placeholder="••••••••"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-primary-300 text-primary-600 shadow-sm focus:ring-primary-500"
                       name="remember">
                <span class="ml-2 text-sm text-primary-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-primary-600 hover:text-primary-900 underline"
                   href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Sandi?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="mb-4">
            <x-primary-button class="w-full justify-center py-3 bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 text-base rounded-lg">
                {{ __('Masuk (Log In)') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center text-sm text-primary-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary-700 font-semibold hover:underline">
                Daftar Baru
            </a>
        </div>
    </form>
@endsection