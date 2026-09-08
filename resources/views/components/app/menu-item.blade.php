@props(['route', 'icon', 'label'])

@php
    $active = request()->routeIs($route) || request()->routeIs($route . '.*');
@endphp

<a href="{{ route($route) }}"
   class="flex items-center px-3 py-2.5 rounded-md text-sm font-medium transition-colors duration-150
          {{ $active ? 'bg-primary-600 text-white' : 'text-primary-100 hover:bg-primary-700 hover:text-white' }}">
    <span class="mr-3 text-lg">{{ $icon }}</span>
    {{ $label }}
</a>
