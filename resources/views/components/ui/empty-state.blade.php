@props(['icon' => '📭', 'title' => 'Tidak ada data', 'description' => 'Belum ada data yang tersedia.'])

<div class="text-center py-12">
    <div class="text-5xl mb-4">{{ $icon }}</div>
    <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
    <p class="mt-1 text-sm text-gray-500">{{ $description }}</p>
    @if(isset($action))
        <div class="mt-6">
            {{ $action }}
        </div>
    @endif
</div>
