@props(['header' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden border border-primary-100']) }}>
    @if($header)
        <div class="border-b border-primary-200 px-5 py-4 bg-primary-50">
            <h3 class="text-lg font-semibold text-primary-800">{{ $header }}</h3>
        </div>
    @endif

    <div class="px-5 py-4">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="border-t border-primary-200 px-5 py-3 bg-primary-50/50">
            {{ $footer }}
        </div>
    @endif
</div>
