@props(['items' => []])

@if(count($items) > 0)
    <nav class="bg-white border-b border-gray-200 px-4 py-2 text-sm" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
            <li>
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/>
                    </svg>
                </a>
            </li>
            @foreach($items as $item)
                <li class="flex items-center">
                    <span class="text-gray-400 mx-2">/</span>
                    @if(isset($item['url']))
                        <a href="{{ $item['url'] }}" class="text-gray-600 hover:text-gray-900">{{ $item['label'] }}</a>
                    @else
                        <span class="text-gray-900 font-medium">{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
