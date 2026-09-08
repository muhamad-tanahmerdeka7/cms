@props(['variant' => 'primary'])

@php
    $variants = [
        'primary'   => 'bg-primary-100 text-primary-800',
        'success'   => 'bg-green-100 text-green-800',
        'danger'    => 'bg-red-100 text-red-800',
        'warning'   => 'bg-yellow-100 text-yellow-800',
        'secondary' => 'bg-secondary-100 text-secondary-800',
    ];
    $class = $variants[$variant] ?? $variants['primary'];
@endphp

<span {{ $attributes->merge(['class' => 'px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ' . $class]) }}>
    {{ $slot }}
</span>
