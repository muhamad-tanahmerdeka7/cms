@props(['header' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden']) }}>
    @if($header)
        <div class="border-b border-gray-200 px-5 py-4">
            <h3 class="text-lg font-semibold text-gray-800">{{ $header }}</h3>
        </div>
    @endif

    <div class="px-5 py-4">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="border-t border-gray-200 px-5 py-3 bg-gray-50">
            {{ $footer }}
        </div>
    @endif
</div>
