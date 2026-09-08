@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'fullWidth' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-md focus:outline-none transition-colors duration-150 disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary'   => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2',
        'secondary' => 'bg-secondary-200 text-secondary-800 hover:bg-secondary-300 focus:ring-2 focus:ring-secondary-400 focus:ring-offset-2',
        'success'   => 'bg-green-600 text-white hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2',
        'danger'    => 'bg-red-600 text-white hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2',
        'warning'   => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2',
        'outline'   => 'border border-primary-300 text-primary-700 hover:bg-primary-50 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
    if ($fullWidth) $classes .= ' w-full';
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
