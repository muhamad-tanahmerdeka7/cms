@props(['route', 'icon', 'label'])

@php
    $active = request()->routeIs($route) || request()->routeIs($route . '.*');
@endphp

<a href="{{ route($route) }}"
   class="flex items-center px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150
          {{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <span class="mr-3 text-lg">{{ $icon }}</span>
    {{ $label }}
</a>
