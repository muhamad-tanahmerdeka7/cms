@props(['variant' => 'info', 'dismissible' => false])

@php
    $variants = [
        'info'    => 'bg-blue-50 border-blue-400 text-blue-800',
        'success' => 'bg-green-50 border-green-400 text-green-800',
        'warning' => 'bg-yellow-50 border-yellow-400 text-yellow-800',
        'danger'  => 'bg-red-50 border-red-400 text-red-800',
    ];
    $class = $variants[$variant] ?? $variants['info'];
@endphp

<div x-data="{ show: true }" x-show="show"
     {{ $attributes->merge(['class' => 'border-l-4 p-4 rounded-md ' . $class]) }}>
    <div class="flex items-start">
        <div class="flex-1">
            {{ $slot }}
        </div>
        @if($dismissible)
            <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-600">
                ✕
            </button>
        @endif
    </div>
</div>
