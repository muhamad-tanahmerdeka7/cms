@props(['paginator'])

@if ($paginator->hasPages())
    <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200">
        <div class="flex-1 flex justify-between sm:hidden">
            {{-- Mobile --}}
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">Next</span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    sampai <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    dari <span class="font-medium">{{ $paginator->total() }}</span> data
                </p>
            </div>

            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 cursor-default rounded-l-md">‹</span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">‹</a>
                    @endif

                    {{-- Pages --}}
                    @foreach ($paginator->links()->elements as $element)
                        @if (is_string($element))
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default">…</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-300 cursor-default">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">›</a>
                    @else
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 cursor-default rounded-r-md">›</span>
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endif
